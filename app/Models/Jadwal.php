<?php

namespace App\Models;

use App\Utils\Rupiah;
use Carbon\Carbon;
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


   public function lokasi_tujuan_r()
   {
      return $this->hasOne(Lokasi::class, 'id', 'lokasi_tujuan');
   }

   public function lokasi_keberangkatan_r()
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

   public function setTanggalAttribute($value)
   {
      $this->attributes['tanggal'] =  Carbon::parse($value)->translatedFormat('Y-m-d');
   }

   public function setJamAttribute($value)
   {
      $this->attributes['jam'] =  Carbon::parse($value)->translatedFormat('H:i:s');
   }
   public function setHargaAttribute($value)
   {
      $this->attributes['harga'] = Rupiah::clean($value);
   }
}
