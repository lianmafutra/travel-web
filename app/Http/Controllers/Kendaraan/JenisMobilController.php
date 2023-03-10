<?php

namespace App\Http\Controllers\Kendaraan;

use App\Http\Controllers\Controller;
use App\Models\JenisMobil;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class JenisMobilController extends Controller
{
   use ApiResponse;
   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola jenis_mobil';
      $data = JenisMobil::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.jenis_mobil.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.jenis_mobil.index', $x, compact(['data']));
   }

   public function store(Request $request)
   {
      try {

         JenisMobil::updateOrCreate(
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

   public function edit(JenisMobil $jenis_mobil)
   {
      return $this->success('Data jenis_mobil', $jenis_mobil);
   }

   public function destroy(JenisMobil  $jenis_mobil)
   {
      try {
         $jenis_mobil->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
