<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Utils\ApiResponse;
use Illuminate\Database\Eloquent\Builder;
use Validator;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
   use ApiResponse;

   public function getJadwalByLokasi(Request $request){

      $validator = Validator::make($request->all(), [
         'lokasi_tujuan' => 'required',
         'lokasi_keberangkatan' => 'required',
     ]);
         
     if ($validator->fails()) {
      return $this->error($validator->errors(), 400);
     }

     $jadwal = Jadwal::with(['lokasi_tujuan_r', 'lokasi_keberangkatan_r', 'mobil'])
     ->whereHas('lokasi_tujuan_r',
     function (Builder $query) use($request) {
       $query->where('nama', $request->lokasi_tujuan);
      })
      ->whereHas('lokasi_keberangkatan_r',
      function (Builder $query) use($request) {
        $query->where('nama', $request->lokasi_keberangkatan);
       })->get();
   
     return $this->success("Data Jadwal Berdasarkan Lokasi", $jadwal);
   }

   public function getJadwalDetail(Request $request){

   //    $validator = Validator::make($request->all(), [
   //       'lokasi_tujuan' => 'required',
   //       'lokasi_keberangkatan' => 'required',
   //   ]);
         
   //   if ($validator->fails()) {
   //    return $this->error($validator->errors(), 400);
   //   }
     $jadwal = Jadwal::findOrFail($request->id);
     return $this->success("Data Jadwal Detail", $jadwal);
   }
}
