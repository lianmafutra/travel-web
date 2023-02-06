<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursiPesanan extends Model
{
    use HasFactory;
    protected $table = 'kursi_pesanan';
    protected $guarded = [];

    protected $casts = [
      'created_at'  => 'date:d-m-Y H:m:s',
      'updated_at'  => 'date:d-m-Y H:m:s',
   ];

 
   public function kursi_mobil()
   {
       return $this->hasOne(KursiMobil::class, 'id', 'kursi_mobil_id');
   }
}
