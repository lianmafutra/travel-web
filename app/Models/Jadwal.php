<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
   use HasFactory;
   protected $table = 'jadwal';
   protected $guarded = [];

   protected $casts = [
      'created_at' => 'date:d-m-Y H:m:s',
      'updated_at' => 'date:d-m-Y H:m:s',
      'tanggal'    => 'date:d-m-Y',
      'jam'        => 'date:H:i',
   ];


   public function lokasi_tujuan()
   {
      return $this->hasOne(Lokasi::class, 'id', 'lokasi_tujuan');
   }

   public function lokasi_keberangkatan()
   {
      return $this->hasOne(Lokasi::class, 'id', 'lokasi_keberangkatan');
   }

   public function supir()
   {
      return $this->hasOne(Supir::class, 'id', 'supir_id');
   }

   public function mobil()
   {
      return $this->hasOne(Mobil::class, 'id', 'mobil_id');
   }
}
