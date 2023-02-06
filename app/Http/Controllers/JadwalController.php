<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lokasi;
use App\Models\Mobil;
use App\Models\Supir;
use Illuminate\Http\Request;


class JadwalController extends Controller
{

   public function index()
   {

      $x['title']    = 'Kelola Jadwal Travel';
      $x['lokasi']    = Lokasi::get();
      $x['mobil']    = Mobil::get();
   

      if (request()->ajax()) {
         $data = Jadwal::with('mobil', 'supir', 'lokasi_tujuan_r', 'lokasi_keberangkatan_r');
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.jadwal.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.jadwal.index', $x);
   }



   public function store(Request $request)
   {
      try {

         if ($request->id) {
            $jadwal = Jadwal::find($request->id);
            $input['supir_id'] =  Mobil::find($request->mobil_id)->supir_id;
            $input = $request->all();
            $jadwal->fill($input)->save();
         } else {
            $input = $request->all();
            $input['supir_id'] =  Mobil::find($request->mobil_id)->supir_id;
            (new Jadwal())->fill($input)->save();
         }
         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }


   public function edit(Jadwal $jadwal)
   {
      return $this->success('Data Jadwal', $jadwal);
   }

   public function destroy(Jadwal $jadwal)
   {
      try {
         $jadwal->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
