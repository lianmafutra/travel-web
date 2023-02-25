<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\KursiMobil;
use App\Models\KursiPesanan;
use App\Models\Pesanan;
use App\Models\Rekening;
use App\Models\User;
use App\Services\Notif;
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



   public function getNotifCount()
   {
      $pesanan = Pesanan::with('user', 'jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan')
         ->where('status_pembayaran', 'BELUM')
         ->where('status_pesanan', '!=', 'DIBATALKAN')
         ->where('user_id', auth()->user()->id)
         ->count();
      return $this->success("Notif count Pesanan masih dalam Proses", $pesanan);
   }


   public function listPesananByUser()
   {
      $pesanan = Pesanan::with('user', 'jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan')
         ->where('user_id', auth()->user()->id)
         ->latest()
         ->get();
      return $this->success("List Pesanan User", $pesanan);
   }

   public function buatPesanan(Request $request)
   {
      DB::beginTransaction();
      //  generate kode pesanan otomatis, id jadwal, user, kursi pesan
      try {

         $array = explode(',', $request->input('id_kursi_pesanan'));
         $array2 = KursiMobil::whereIn('id',   $array)->get()->pluck('nama')->toArray();

         $jadwal = Jadwal::find($request->jadwal_id);
         $pesanan = Pesanan::create([
            'kode_pesanan'      => strtoupper(Str::random(6)),
            'jadwal_id'         => $request->jadwal_id,
            'user_id'           => auth()->user()->id,
            'mobil_id'          => $jadwal->mobil_id,
            'tgl_pembayaran'    => Carbon::now(),
            'tgl_keberangkatan' => $jadwal->tanggal,
            'tgl_pesan'         => Carbon::now(),
            'nama'              => auth()->user()->nama_lengkap,
            'kontak'            => auth()->user()->kontak,
            'id_kursi_pesanan'  => $request->input('id_kursi_pesanan'),
            'total_biaya'       => $jadwal->harga * sizeof($array2),
         ]);
         $array = explode(',', $request->id_kursi_pesanan);
         foreach ($array as  $item) {
            KursiPesanan::create([
               'pesanan_id' =>  $pesanan->id,
               'kursi_mobil_id' => $item,
            ]);
         }
         DB::commit();
         return $this->success($pesanan->kode_pesanan);
      } catch (Throwable $e) {
         DB::rollback();
         Log::info($e);
         return $this->error("Gagal Membuat Data Pesanan" . $e->getMessage(), 400);
      }
   }


   public function batalkanPesanan(Request $request,  Notif $notif)
   {

      DB::beginTransaction();
      // upload bukti pembayaran 
      try {
         $pesanan = Pesanan::where('kode_pesanan', $request->kode_pesanan);
         // $token = TokenFCM::where('user_id', $pesanan->user_id)->get()->pluck('token')->toArray();
         // $notif->kirim('Pesanan Ditolak','kode Pesanan ( '.$pesanan->kode_pesanan.' ) Ditolak oleh Admin',$token);
         KursiPesanan::where('pesanan_id', $pesanan->first()->id)->delete();
         $pesanan->update(['status_pesanan' => 'DIBATALKAN']);
         DB::commit();
         return $this->success("Pesanan Berhasil Dibatalkan", $pesanan);
      } catch (Throwable $e) {
         DB::rollback();
         return $this->error("Pesanan gagal Dibatalkan" . $e->getMessage(), 400);
      }
   }

   public function bayar(Request $request)
   {
      $x['title'] = 'Pesanan Detail';

      $x['user'] =  User::find($request->input('id_user'));
      $x['jadwal'] = Jadwal::with('mobil', 'supir', 'lokasi_tujuan_r', 'lokasi_keberangkatan_r')->where('id', $request->input('id_jadwal'))->first();

      $x['rekening'] = Rekening::get();
      $pesanan = Pesanan::with('kursi_pesanan')->where('kode_pesanan', $request->input('kode_pesanan'));

      if ($request->input('id_kursi_pesanan') == "null") {

         $array2 = KursiMobil::whereIn('id',    $pesanan->first()->kursi_pesanan->pluck('kursi_mobil_id'))->get()->pluck('nama')->toArray();
         $x['jumlah_kursi'] =    sizeof($array2);
         $x['kursi'] = implode(', ',  $array2);
      } else {
         $array = explode(',', $request->input('id_kursi_pesanan'));
         $array2 = KursiMobil::whereIn('id',   $array)->get()->pluck('nama')->toArray();
         $x['kursi'] =  implode(', ', $array2);

         $x['jumlah_kursi'] =  sizeof($array2);
      }



      return view('app.api.pesanan-upload-pembayaran', $x, compact(['pesanan']));
   }

   public function uploadBukti(Request $request)
   {
      DB::beginTransaction();
      // upload bukti pembayaran 
      try {
         $image_path = $request->file('img_bukti')->store('images', 'public');
         Pesanan::where('kode_pesanan', $request->kode_pesanan)->update([
            'bukti_pembayaran' =>  $image_path,
         ]);

         DB::commit();
         return $this->success("Berhasil Mengupload Bukti Pembayaran");
      } catch (Throwable $e) {
         DB::rollback();
         return $this->error("Gagal Mengupload BUkti Pembayaran" . $e->getMessage(), 400);
      }
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
      $x['pesanan'] = Pesanan::where('kode_pesanan', $request->input('kode_pesanan'))->first();
      return view('app.api.pesanan-verifikasi', $x);
   }


   public function konfirmasi(Request $request)
   {
      $x['title'] = 'Pesanan Detail';
      $x['kursi'] = $request->input('id_kursi_pesanan');
      $x['user'] =  User::find($request->input('id_user'));
      $x['jadwal'] = Jadwal::with('mobil', 'supir', 'lokasi_tujuan_r', 'lokasi_keberangkatan_r')->where('id', $request->input('id_jadwal'))->first();
      $array = explode(',', $request->input('id_kursi_pesanan'));
      $x['kursi'] = KursiMobil::whereIn('id',   $array)->get()->pluck('nama')->toArray();
      return view('app.api.pesanan-konfirmasi', $x);
   }



   public function detail($kode_pesanan)
   {
      $pesanan = Pesanan::with('user', 'jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan')
         ->where('kode_pesanan', $kode_pesanan)->get();
      return $this->success("detail pesanan user", $pesanan);
   }
}
