<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\KursiMobil;
use App\Models\Mobil;
use App\Models\Pesanan;
use App\Utils\ApiResponse;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Validator;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
   use ApiResponse;

   public function getJadwalByLokasi(Request $request)
   {

      $validator = Validator::make($request->all(), [
         'lokasi_tujuan' => 'required',
         'lokasi_keberangkatan' => 'required',
      ]);

      if ($validator->fails()) {
         return $this->error($validator->errors(), 400);
      }

      $jadwal = Jadwal::with(['lokasi_tujuan_r', 'lokasi_keberangkatan_r', 'mobil'])
         ->whereHas(
            'lokasi_tujuan_r',
            function (Builder $query) use ($request) {
               $query->where('nama', $request->lokasi_tujuan);
            }
         )
         ->whereHas(
            'lokasi_keberangkatan_r',
            function (Builder $query) use ($request) {
               $query->where('nama', $request->lokasi_keberangkatan);
            }
         )->get();

      return $this->success("Data Jadwal Berdasarkan Lokasi", $jadwal);
   }

   public function showKursi($id_jadwal)
   {



      $x['title']    = 'Detail Jadwal';

      $jadwal =  Jadwal::find($id_jadwal);
     


      $data = Pesanan::with('jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan', 'kursi_pesanan.kursi_mobil')
         ->where('jadwal_id', $id_jadwal);



      $kursi_tersedia =  KursiMobil::where('mobil_id', $jadwal->mobil_id)->with(['kursi_pesanan' => function ($query) use ($data) {
         $query->whereIn('id',  $data->pluck('id'));
      }])->whereNotIn('tipe', ['SUPIR', 'KOSONG'])->doesntHave('kursi_pesanan');



      $kursi_pesanan =  KursiMobil::with('kursi_pesanan')->where('mobil_id', $jadwal->mobil_id)
         ->whereNotIn('tipe', ['SUPIR', 'KOSONG'])->has('kursi_pesanan')->whereHas(
            'kursi_pesanan',
            function (EloquentBuilder $query) use ($data) {
               $query->whereIn('pesanan_id', $data->pluck('id'));
            }
         );


      $total_kursi =  KursiMobil::where('mobil_id', $jadwal->mobil_id)->whereNotIn('tipe', ['SUPIR', 'KOSONG']);


      $kursi_mobil =  Mobil::with('supir')->where('id', $jadwal->mobil_id)->first();

      return view('app.jadwal.kursi', $x, compact(['jadwal', 'kursi_mobil', 'total_kursi', 'kursi_pesanan', 'kursi_tersedia']));
   }

   public function getJadwalDetail(Request $request)
   {

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
