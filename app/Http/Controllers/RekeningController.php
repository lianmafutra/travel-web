<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
   use ApiResponse;
   public function index()
   {
   
      $x['title']    = 'Kelola Rekening';
      $data = Rekening::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.rekening.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.rekening.index', $x, compact(['data']));
   }

   public function store(Request $request)
   {
      try {

         if ($request->id) {
            $jadwal = Rekening::find($request->id);
            $input = $request->all();
            $jadwal->fill($input)->save();
         } else {
            $input = $request->all();
            (new Rekening())->fill($input)->save();
         }

         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function edit(Rekening $rekening)
   {
      return $this->success('Data rekening', $rekening);
   }

   public function destroy(Rekening  $rekening)
   {
      try {
         $rekening->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
