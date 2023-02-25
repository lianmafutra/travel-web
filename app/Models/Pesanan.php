<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
   use HasFactory;
   protected $table = 'pesanan';
   protected $guarded = [];
 
   protected $casts = [
      'created_at' => 'date:d-m-Y H:m:s',
      'updated_at' => 'date:d-m-Y H:m:s',
      'tgl_pembayaran' => 'date:d-m-Y H:m',
      'tgl_keberangkatan' => 'date:d-m-Y H:m',
      'tgl_pesan' => 'date:d-m-Y H:m',
   ];

 


   public function getBuktiPembayaranUrl()
   {
      return asset('storage/' . $this->bukti_pembayaran);
   }
   public function jadwal()
   {
      return $this->hasOne(Jadwal::class, 'id', 'jadwal_id');
   }


   public function user()
   {
      return $this->hasOne(User::class, 'id', 'user_id');
   }

   public function kursi_pesanan()
   {
      return $this->hasMany(KursiPesanan::class);
   }



   public function getJumlahKursiPesanan()
   {
      return $this->kursi_pesanan->count();
   }
}
