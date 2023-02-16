<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\KursiMobil;
use App\Models\Pesanan;
use App\Models\Rekening;
use App\Models\User;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class PesananController extends Controller
{
   
   use ApiResponse;

   public function kirimReview(Request $request){
      try {
         $pesanan = Pesanan::where('id', $request->id_pesanan)->update([
            'rating_nilai' => $request->rating_nilai,
            'rating_komen' => $request->rating_komen,
        ]);
        return $this->success("Update Data Review Pesanan Berhasil");
      } catch (Exception $e) {
         return $this->error("Gagal Update Data " + $e->getMessage(), 400);
      }
    
   }

   public function listReviewByMobil($id_mobil){
      $pesanan = Pesanan::with('user')->where('mobil_id', $id_mobil)->get();
      return $this->success("Review Pesanan Berdasarkan Mobil", $pesanan);
    }

    public function detailPesanan(Request $request){

      $x['title'] = 'Pesanan Detail';
      $x['kursi'] = $request->input('id_kursi_pesanan');
      $x['user'] =  User::find($request->input('id_user')); 
      $x['jadwal'] = Jadwal::with('mobil', 'supir', 'lokasi_tujuan_r', 'lokasi_keberangkatan_r')->where('id', $request->input('id_jadwal'))->first();

     $array = explode(',',$request->input('id_kursi_pesanan'));

      // takes first three elements
    
      
 


      $x['kursi'] = KursiMobil::whereIn('id',   $array)->get()->pluck('nama')->toArray() ;
     
       $x['rekening'] = Rekening::get();

      return view('app.api.pesanan-detail', $x); 
    }

   
}
