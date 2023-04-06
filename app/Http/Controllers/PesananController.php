<?php

namespace App\Http\Controllers;

use App\Action\Notif\Notif;
use App\Models\KursiMobil;
use App\Models\KursiPesanan;
use App\Models\Mobil;
use App\Models\Pesanan;
use App\Models\TokenFCM;
use App\Models\User;
use App\Services\Notif as ServicesNotif;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
   use ApiResponse;
   public function index()
   {

      $x['title']    = 'Data Pesanan';
    

      if(request()->filter_pesanan == "all"){
         $data = Pesanan::with('jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan');
       
      }else{
         $data = Pesanan::with('jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan');
         $data->where('status_pesanan', 'PROSES')->where('status_pembayaran', 'BELUM');
      }

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
               else if ($data->status_pesanan == 'DIBATALKAN') {
                  return '<span class="badge badge-danger">Dibatalkan oleh Pelanggan</span>';
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

      $rating="";
     
      $rating_no = 5 - $data->rating_nilai;
      
      for ($i=0; $i < $data->rating_nilai; $i++) { 
         $rating .=  '<span class="fa fa-star checked"></span>';
      }
      for ($i=0; $i < $rating_no; $i++) { 
         $rating .=  '<span class="fa fa-star"></span>';
      }
     


      $x['title']    = 'Detail Pesanan ( ' . $data->kode_pesanan . ' )';
      return view('app.pesanan.detail', $x, compact(['data', 'kursi_mobil', 'kursi_pesanan','rating']));
   }



   public function updateVerifikasiPembayaran(Request $request, ServicesNotif $notif)
   {
      try {
         $pesanan = Pesanan::find($request->id);
         $token = TokenFCM::where('user_id', $pesanan->user_id)->get()->pluck('token')->toArray();
         if ($pesanan->status_pembayaran == 'BELUM') {
            $pesanan->update([
               'status_pembayaran' => 'LUNAS',
               'status_pesanan' => 'SELESAI'
            ]);   
            $notif->kirim('Konfirmasi Pembayaran','kode Pesanan ( '.$pesanan->kode_pesanan.' ) Berhasil diverifikasi oleh Admin',$token);
            return redirect()->back()->with('success-modal', ["title" => 'Berhasil Verifikasi Pembayaran']);
         } else {
            $pesanan->update([
               'status_pembayaran' => 'BELUM',
               'status_pesanan' => 'PROSES'
            ]);
            // $notif->kirim('Pembayaran','kode Pesanan ( '.$pesanan->kode_pesanan.' ) Berhasil diverifikasi oleh Admin',$token);
            return redirect()->back()->with('success-modal', ["title" => 'Berhasil Membatalkan Verifikasi Pembayaran']);
         }
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }


   public function updateStatusPesanan(Request $request,  ServicesNotif $notif)
   {
      
      try {
         DB::beginTransaction();
      
         $pesanan = Pesanan::find($request->pesanan_id);
         $pesanan->update([
            'status_pesanan' => $request->status_pesanan,
            'pesan_tolak' => $request->pesan_tolak,
         ]);

         if($request->status_pesanan == "DITOLAK"){
            $token = TokenFCM::where('user_id', $pesanan->user_id)->get()->pluck('token')->toArray();
            $notif->kirim('Pesanan Ditolak','kode Pesanan ( '.$pesanan->kode_pesanan.' ) Ditolak oleh Admin',$token);
            KursiPesanan::where('pesanan_id', $request->pesanan_id)->delete();
         }
         DB::commit();
         return redirect()->back()->with('success-modal', ["title" => 'Berhasil Merubah Status Pesanan']);
      } catch (\Throwable $th) {
         DB::rollback();
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
