<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class PesananController extends Controller
{
   use ApiResponse;
   public function index()
   {
   
      $x['title']    = 'Kelola Data Pesanan';
      $data = Pesanan::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pesanan.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pesanan.index', $x, compact(['data']));
   }

   public function store(Request $request)
   {
      try {

         if ($request->id) {
            $jadwal = Pesanan::find($request->id);
            $input = $request->all();
            $jadwal->fill($input)->save();
         } else {
            $input = $request->all();
            (new Pesanan())->fill($input)->save();
         }

         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function edit(Pesanan $pesanan)
   {
      return $this->success('Data Pesanan', $pesanan);
   }

   public function destroy(Pesanan  $pesanan)
   {
      try {
         $pesanan->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}

