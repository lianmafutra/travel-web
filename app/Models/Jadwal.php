<?php

namespace App\Models;

use App\Utils\Rupiah;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
   use HasFactory;
   protected $table = 'jadwal';
   protected $guarded = [];
   protected $appends = ['kursi_tersedia', 'status'];
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

   public function getKursiTersediaAttribute()
   {
      $data = Pesanan::with('jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan', 'kursi_pesanan.kursi_mobil')
         ->where('jadwal_id',  $this->attributes['id']);

   

      $kursi_pesanan =  KursiMobil::with('kursi_pesanan')->where('mobil_id', $this->attributes['mobil_id'])
      ->whereNotIn('tipe', ['SUPIR','KOSONG'])->has('kursi_pesanan')->whereHas('kursi_pesanan',
       function (Builder $query) use($data) {
         $query->whereIn('pesanan_id', $data->pluck('id'));
        });
        $total_kursi =  KursiMobil::where('mobil_id',  $this->attributes['mobil_id'])->whereNotIn('tipe', ['SUPIR','KOSONG']);
        return  $kursi_pesanan->count()."/".  $total_kursi->count();
   }

   public function getStatusAttribute()
   {
      $data = Pesanan::with('jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan', 'kursi_pesanan.kursi_mobil')
         ->where('jadwal_id',  $this->attributes['id']);

      $kursi_pesanan =  KursiMobil::with('kursi_pesanan')->where('mobil_id', $this->attributes['mobil_id'])
      ->whereNotIn('tipe', ['SUPIR','KOSONG'])->has('kursi_pesanan')->whereHas('kursi_pesanan',
       function (Builder $query) use($data) {
         $query->whereIn('pesanan_id', $data->pluck('id'));
        });
        $total_kursi =  KursiMobil::where('mobil_id',  $this->attributes['mobil_id'])->whereNotIn('tipe', ['SUPIR','KOSONG']);

        if($kursi_pesanan->count() >= $total_kursi->count()){
         return  "penuh";
        }else{
         return  "tersedia";
        }

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
