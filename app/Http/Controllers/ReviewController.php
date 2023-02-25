<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;

class ReviewController extends Controller
{
   public function index()
   {
      $x['title']    = 'Review Pengguna';

      $data =  Pesanan::with('user','mobil','supir', 'jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan');

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('rating_nilai', function ($data) {
               $rating="";
               $rating_no = 5 - $data->rating_nilai;
               
               for ($i=0; $i < $data->rating_nilai; $i++) { 
                  $rating .=  '<span class="fa fa-star checked"></span>';
               }
               for ($i=0; $i < $rating_no; $i++) { 
                  $rating .=  '<span class="fa fa-star"></span>';
               }
               return $rating;
               
            })
            ->rawColumns(['rating_nilai'])
            ->make(true);
      }
      return view('app.review.index', $x);
   }
}
