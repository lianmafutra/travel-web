<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

   use ApiResponse;

   public function listReviewByMobil($id_mobil)
   {
      $pesanan = Pesanan::with('user')->where('mobil_id', $id_mobil)->latest('id')->get();
      return $this->success("Review Pesanan Berdasarkan Mobil", $pesanan);
   }

   public function kirimReview(Request $request)
   {
      try {
         $pesanan = Pesanan::where('kode_pesanan', $request->kode_pesanan)->update([
            'rating_nilai' => $request->rating_nilai,
            'rating_komen' => $request->rating_komen,
            'rating_created_at' => Carbon::now(),
         ]);
         return $this->success("Update Data Review Pesanan Berhasil");
      } catch (Exception $e) {
         return $this->error("Gagal Update Data " + $e->getMessage(), 400);
      }
   }

}
