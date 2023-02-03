<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Tujuan;


class LokasiController extends Controller
{
   use ApiResponse;
   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola Lokasi';
      $data = Lokasi::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.lokasi.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.lokasi.index', $x, compact(['data']));
   }

   public function store(Request $request)
   {
      try {

         Lokasi::updateOrCreate(
            ['id'               => $request->id],
            [
               'nama'             => $request->nama,
            ]
         );

         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function edit(Lokasi $lokasi)
   {
      return $this->success('Data Tujuan', $lokasi);
   }

   public function destroy(Lokasi $lokasi)
   {
      try {
         $lokasi->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
