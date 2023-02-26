<?php

namespace App\Console\Commands;

use App\Models\Pesanan;
use App\Models\TokenFCM;
use App\Services\Notif;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpiredPembayaran extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'expired:pembayaran';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Untuk Cek invoice Pembayaran yang belum dibayar ketika melewati waktu expired';

   /**
    * Execute the console command.
    *
    * @return int
    */
   public function handle()
   {


      $notif = new Notif();
      $pesanan = Pesanan::where('status_pembayaran', '!=', 'EXPIRED')->where('status_pembayaran', '!=', 'LUNAS')->get();

      foreach ($pesanan as $key => $value) {
         $waktu_sekarang = Carbon::now();
         $selisih = $waktu_sekarang->diffInMinutes($value->tgl_pesan);
         if ($selisih > 60) {
            $token = TokenFCM::where('user_id', $value->user_id)->get()->pluck('token')->toArray();
            Pesanan::where('id', $value->id)->update([
               'status_pembayaran' => 'EXPIRED',
            ]);
            $kirim = $notif->kirim('Batas Waktu Pembayaran telah habis', 'Masa Aktif pembayaran invoice dengan kode : ( ' . $value->kode_pesanan . ' ) telah habis', $token);
            $this->info("waktu pembayaran sudah habis");
            $this->info($kirim);
         } else {
            $this->info("waktu pembayaran aktif");
         }
         // $this->info($value);
      }
   }
}
