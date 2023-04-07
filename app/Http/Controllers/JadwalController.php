<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\KursiMobil;
use App\Models\Lokasi;
use App\Models\Mobil;
use App\Models\Pesanan;
use App\Models\TourGaleri;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class JadwalController extends Controller
{
   public function index()
   {
      $x['title']    = 'Kelola Jadwal Travel';
      $x['lokasi']    = Lokasi::get();
      $x['mobil']    = Mobil::get();
      if (request()->ajax()) {
         $data = Jadwal::with('mobil', 'supir', 'lokasi_tujuan_r', 'lokasi_keberangkatan_r');
         return  datatables()->of($data)
            ->addIndexColumn()

            ->addColumn('action', function ($data) {
               return view('app.jadwal.action', compact('data'));
            })
            ->editColumn('tour_brosur', function ($data) {
               if ($data->jenis_pesanan == 'TRAVEL') {
                  return "-";
               }
               if ($data->jenis_pesanan == 'TOUR') {
                  return '<a target="_blank" href="' . $data->getFotoBrosur() . '"><img class="foto_mobil" src="' . $data->getFotoBrosur() .
                     '" height="100px" width="100px"; style="object-fit: cover;"></a>';
               }
            })
            ->editColumn('tour_min_orang', function ($data) {
               if ($data->jenis_pesanan == 'TRAVEL') {
                  return "-";
               }
               if ($data->jenis_pesanan == 'TOUR') {
                  return $data->tour_min_orang . " Orang";
               }
            })

            ->rawColumns(['action', 'tour_brosur'])
            ->make(true);
      }
      return view('app.jadwal.index', $x);
   }

   public function store(Request $request)
   {

      try {

         DB::beginTransaction();


         $old = Jadwal::find($request->id)?->tour_brosur;
         if ('images/' . $request->file('tour_brosur')->getClientOriginalName() != $old) {
            $image_path = $request->file('tour_brosur')->store('images', 'public');
         } else {
            $image_path = $old;
         }

         if ($request->id) {
            $jadwal = Jadwal::find($request->id);
            $input['supir_id'] =  Mobil::find($request->mobil_id)->supir_id;

            $input = $request->all();
            $input = $request->except('tour_galeri');
            $input['tour_brosur'] = $image_path;
            $jadwal->fill($input)->save();
            

            $foto = $request->file('tour_galeri');
            $fotoNames = [];
            foreach ($foto as $fotos) {
               $fotoNames[] = $fotos->getClientOriginalName();
            }
   
            $store = TourGaleri::where('jadwal_id', $request->id)->get(); 
      

            foreach ($store  as $value) {
               $cek2 = Str::of($value->foto)->contains($fotoNames);
               if ($cek2 == false) {
                  TourGaleri::destroy($value->id);
               }
            }
   
            foreach ($foto as $key => $value) {
               $cek = Str::of("images/".$value->getClientOriginalName())->contains($store->pluck('foto')->toArray());
               //cek insert new  
               if ($cek == false) {

                  $image_path = $value->store('images', 'public');
   
                  $storeGaleri = new TourGaleri();
                  $storeGaleri->jadwal_id = $request->id;
                  $storeGaleri->foto =  $image_path;
                  $storeGaleri->origin = $value->getClientOriginalName();
                  $storeGaleri->save();
               }
               TourGaleri::where('foto', $value->getClientOriginalName())
                  ->update(['position' => $key]);
            }
         } else {

            $input = $request->all();
            $input = $request->except('tour_galeri');
            $input['tour_brosur'] = $image_path;
            $input['supir_id'] =  Mobil::find($request->mobil_id)->supir_id;
            $jadwal = Jadwal::create($input);

            $tour_galeri = $request->file('tour_galeri');

            foreach ($tour_galeri as $key => $value) {
               $image_path = $value->store('images', 'public');
               $storeGaleri = new TourGaleri();
               $storeGaleri->jadwal_id = $jadwal->id;
               $storeGaleri->foto =  $image_path;
               $storeGaleri->origin = $value->getClientOriginalName();
               $storeGaleri->save();
            }
         }

         DB::commit();
         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

 

   public function edit(Jadwal $jadwal)
   {
      return $this->success('Data Jadwal', $jadwal);
   }

   public function show(Jadwal $jadwal)
   {
      $x['title']    = 'Detail Jadwal';
      $data = Pesanan::with('jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan', 'kursi_pesanan.kursi_mobil')
         ->where('jadwal_id', $jadwal->id);
      $kursi_tersedia =  KursiMobil::where('mobil_id', $jadwal->mobil_id)->with(['kursi_pesanan' => function ($query) use ($data) {
         $query->whereIn('id',  $data->pluck('id'));
      }])->whereNotIn('tipe', ['SUPIR', 'KOSONG'])->doesntHave('kursi_pesanan');
      $kursi_pesanan =  KursiMobil::with('kursi_pesanan')->where('mobil_id', $jadwal->mobil_id)
         ->whereNotIn('tipe', ['SUPIR', 'KOSONG'])->has('kursi_pesanan')->whereHas(
            'kursi_pesanan',
            function (EloquentBuilder $query) use ($data) {
               $query->whereIn('pesanan_id', $data->pluck('id'));
            }
         );
      $total_kursi =  KursiMobil::where('mobil_id', $jadwal->mobil_id)->whereNotIn('tipe', ['SUPIR', 'KOSONG']);
      if (request()->ajax()) {
         return  datatables()->eloquent($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pesanan.action', compact('data'));
            })
            ->editColumn('bukti_pembayaran', function ($data) {
               if (!empty($data->bukti_pembayaran)) {
                  return '<a target="_blank" href="' . $data->getBuktiPembayaranUrl() . '" class=""><i class="far fa-eye"></i> Lihat</a>';
               }
            })
            ->editColumn('status_pembayaran', function ($data) {
               if ($data->status_pembayaran == 'BELUM') {
                  return '<span class="badge badge-secondary">Belum Verifikasi</span>';
               } else if ($data->status_pembayaran == 'LUNAS') {
                  return '<span class="badge badge-success">Dibayar</span>';
               }
            })
            ->editColumn('status_pesanan', function ($data) {
               if ($data->status_pesanan == 'PROSES') {
                  return '<span class="badge badge-secondary">Proses</span>';
               } else if ($data->status_pesanan == 'SELESAI') {
                  return '<span class="badge badge-success">Selesai</span>';
               } else if ($data->status_pesanan == 'DITOLAK') {
                  return '<span class="badge badge-danger">Ditolak</span>';
               }
            })
            ->addColumn('kursi_pesanan', function ($data) {
               if ($data->kursi_pesanan) {
                  return $data->kursi_pesanan->pluck('kursi_mobil.nama')->implode(', ', '');
               }
            })
            ->addColumn('jumlah_kursi', function ($data) {
               return $data->kursi_pesanan->pluck('kursi_mobil.nama')->count();
            })
            ->rawColumns(['action', 'bukti_pembayaran', 'status_pesanan', 'status_pembayaran', 'kursi_pesanan', 'jumlah_kursi'])
            ->make(true);
      }
      $kursi_mobil =  Mobil::with('supir')->where('id', $jadwal->mobil_id)->first();
      return view('app.jadwal.detail', $x, compact(['jadwal', 'kursi_mobil', 'total_kursi', 'kursi_pesanan', 'kursi_tersedia']));
   }

   public function showKursi(Jadwal $jadwal)
   {
      $x['title']    = 'Detail Jadwal';
      $data = Pesanan::with('jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan', 'kursi_pesanan.kursi_mobil')
         ->where('jadwal_id', $jadwal->id);
      $kursi_tersedia =  KursiMobil::where('mobil_id', $jadwal->mobil_id)->with(['kursi_pesanan' => function ($query) use ($data) {
         $query->whereIn('id',  $data->pluck('id'));
      }])->whereNotIn('tipe', ['SUPIR', 'KOSONG'])->doesntHave('kursi_pesanan');
      $kursi_pesanan =  KursiMobil::with('kursi_pesanan')->where('mobil_id', $jadwal->mobil_id)
         ->whereNotIn('tipe', ['SUPIR', 'KOSONG'])->has('kursi_pesanan')->whereHas(
            'kursi_pesanan',
            function (EloquentBuilder $query) use ($data) {
               $query->whereIn('pesanan_id', $data->pluck('id'));
            }
         );
      $total_kursi =  KursiMobil::where('mobil_id', $jadwal->mobil_id)->whereNotIn('tipe', ['SUPIR', 'KOSONG']);
      $kursi_mobil =  Mobil::with('supir')->where('id', $jadwal->mobil_id)->first();
      return view('app.jadwal.detail', $x, compact(['jadwal', 'kursi_mobil', 'total_kursi', 'kursi_pesanan', 'kursi_tersedia']));
   }

   public function destroy(Jadwal $jadwal)
   {
      try {
         $jadwal->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }

   public function createTour()
   {
      $x['lokasi']    = Lokasi::get();
      $x['mobil']    = Mobil::get();
      return view('app.jadwal.create-tour', $x);
   }

   public function editJadwalTour($id)
   {
      $x['lokasi']    = Lokasi::get();
      $x['mobil']    = Mobil::get();

      $jadwal = Jadwal::with('tour_galeri')->where('id', $id)->first();
      
      return view('app.jadwal.edit-tour', $x, compact(['jadwal']));
   }
}
