<?php

namespace App\Models;

use App\Utils\AutoUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
   use HasFactory;
   // use AutoUUID;

   protected $table = 'mobil';
   protected $guarded = [];

   protected $appends = ['jenis'];

   protected $casts = [
      'created_at'  => 'date:d-m-Y H:m:s',
      'updated_at'  => 'date:d-m-Y H:m:s',
   ];

   public function getFotoUrl(){
      return asset('storage/'.$this->foto);
   }

   public function supir(){
      return $this->hasOne(Supir::class, 'id', 'supir_id');
   }

   public function jenis(){
      return $this->hasOne(MobilJenis::class, 'id', 'mobil_jenis_id');
   }
 
  
   public function kursi_mobil(){
      return $this->hasMany(KursiMobil::class);
   }

   public function getJenisAttribute(){
      return $this->jenis()->first()->nama;
   }
}
