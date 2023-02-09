<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
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

   
}
