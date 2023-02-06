<?php

namespace App\Http\Controllers;

use App\Models\KursiMobil;
use App\Models\Mobil;
use App\Models\Pesanan;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class PesananController extends Controller
{
   use ApiResponse;
   public function index()
   {

      $x['title']    = 'Kelola Data Pesanan';
      $data = Pesanan::with('jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan');

      if (request()->ajax()) {
         return  datatables()->of($data)
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
            ->editColumn('jumlah_kursi', function ($data) {
               return $data->getjumlahKursiPesanan();
            })
            ->rawColumns(['action', 'bukti_pembayaran', 'status_pesanan', 'status_pembayaran'])
            ->make(true);
      }
      return view('app.pesanan.index', $x, compact(['data']));
   }

   public function store(Request $request)
   {
      try {
         if ($request->id) {
            $jadwal = Pesanan::find($request->id);
            $input = $request->all();
            $jadwal->fill($input)->save();
         } else {
            $input = $request->all();
            (new Pesanan())->fill($input)->save();
         }

         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function detail($id_pesanan)
   {

      $data = Pesanan::with('user','jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan', 'kursi_pesanan.kursi_mobil')
         ->where('id', $id_pesanan)->first();

      $kursi_mobil =  Mobil::with('supir')->where('id',$data->mobil_id)->first();
     
      $kursi_pesanan = $data->kursi_pesanan->pluck('kursi_mobil.nama');


      $x['title']    = 'Detail Pesanan ( ' . $data->first()->kode_pesanan . ' )';
      return view('app.pesanan.detail', $x, compact(['data', 'kursi_mobil', 'kursi_pesanan']));
   }



   public function updateVerifikasiPembayaran(Request $request)
   {
      try {
         $pesanan = Pesanan::find($request->id);
         if ($pesanan->status_pembayaran == 'BELUM') {
            $pesanan->update([
               'status_pembayaran' => 'LUNAS'
            ]);
            return redirect()->back()->with('success-modal', ["title" => 'Berhasil Verifikasi Pembayaran']);
         } else {
            $pesanan->update([
               'status_pembayaran' => 'BELUM'
            ]);
            return redirect()->back()->with('success-modal', ["title" => 'Berhasil Membatalkan Verifikasi Pembayaran']);
         }
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }


   public function updateStatusPesanan(Request $request)
   {
      try {
         $pesanan = Pesanan::find($request->pesanan_id);
         $pesanan->update([
            'status_pesanan' => $request->status_pesanan
         ]);
         return redirect()->back()->with('success-modal', ["title" => 'Berhasil Merubah Status Pesanan']);
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }




   public function edit(Pesanan $pesanan)
   {
      return $this->success('Data Pesanan', $pesanan);
   }

   public function destroy(Pesanan  $pesanan)
   {
      try {
         $pesanan->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
