<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\KursiMobil;
use App\Models\KursiPesanan;
use App\Models\Pesanan;
use App\Models\Rekening;
use App\Models\User;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class PesananController extends Controller
{

   use ApiResponse;

   public function kirimReview(Request $request)
   {
      try {
         $pesanan = Pesanan::where('id', $request->id_pesanan)->update([
            'rating_nilai' => $request->rating_nilai,
            'rating_komen' => $request->rating_komen,
         ]);
         return $this->success("Update Data Review Pesanan Berhasil");
      } catch (Exception $e) {
         return $this->error("Gagal Update Data " + $e->getMessage(), 400);
      }
   }

   public function listReviewByMobil($id_mobil)
   {
      $pesanan = Pesanan::with('user')->where('mobil_id', $id_mobil)->get();
      return $this->success("Review Pesanan Berdasarkan Mobil", $pesanan);
   }

   
   public function listPesananByUser()
   {
      $pesanan = Pesanan::with('user','jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan')->where('user_id', auth()->user()->id)->get();
      return $this->success("List Pesanan User", $pesanan);
   }



   public function buatPesanan(Request $request)
   {
      DB::beginTransaction();
      // upload bukti pembayaran dan generate kode pesanan otomatis, id jadwal, user, kursi pesan
      try {


         $image_path = $request->file('img_bukti')->store('images', 'public');

         $jadwal = Jadwal::find($request->jadwal_id);


         $pesanan = Pesanan::create([
            'kode_pesanan'      => Str::random(5),
            'jadwal_id'         => $request->jadwal_id,
            'user_id'           => auth()->user()->id,
            'mobil_id'          => $jadwal->mobil_id,
            'tgl_pembayaran'    => Carbon::now(),
            'tgl_keberangkatan' => $jadwal->tanggal,
            'tgl_pesan'         => Carbon::now(),
            'nama'              => auth()->user()->nama_lengkap,
            'kontak'            => auth()->user()->kontak,
            'bukti_pembayaran'  => $image_path,
         ]);

         $array = explode(',', $request->id_kursi_pesanan);

        

         foreach ($array as  $item) {
            KursiPesanan::create([
               'pesanan_id' =>  $pesanan->id,
               'kursi_mobil_id' => $item,
            ]);
         }

         DB::commit();
         return $this->success("Berhasil Membuat Data Pesanan");
      } catch (Throwable $e) {
         DB::rollback();
         Log::info($e);
         return $this->error("Gagal Membuat Data Pesanan" . $e->getMessage(), 400);
      }
   }



   public function detailUpload(Request $request)
   {

      $x['title'] = 'Pesanan Detail';
      $x['kursi'] = $request->input('id_kursi_pesanan');
      $x['user'] =  User::find($request->input('id_user'));
      $x['jadwal'] = Jadwal::with('mobil', 'supir', 'lokasi_tujuan_r', 'lokasi_keberangkatan_r')->where('id', $request->input('id_jadwal'))->first();

      $array = explode(',', $request->input('id_kursi_pesanan'));

      $x['kursi'] = KursiMobil::whereIn('id',   $array)->get()->pluck('nama')->toArray();

      $x['rekening'] = Rekening::get();

      return view('app.api.pesanan-upload-pembayaran', $x);
   }


   public function detailVerifikasi(Request $request)
   {

    

      $x['title'] = 'Pesanan Detail';
      $x['kursi'] = $request->input('id_kursi_pesanan');
      $x['user'] =  User::find($request->input('id_user'));
      $x['jadwal'] = Jadwal::with('mobil', 'supir', 'lokasi_tujuan_r', 'lokasi_keberangkatan_r')->where('id', $request->input('id_jadwal'))->first();

      $array = explode(',', $request->input('id_kursi_pesanan'));

      $x['kursi'] = KursiMobil::whereIn('id',   $array)->get()->pluck('nama')->toArray();

      $x['rekening'] = Rekening::get();

      $x['pesanan'] = Pesanan::where('jadwal_id',  $x['jadwal']->id)->where('user_id', $x['user']->id)->first();

      return view('app.api.pesanan-verifikasi', $x);
   }
}
