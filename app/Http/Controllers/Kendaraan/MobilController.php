<?php

namespace App\Http\Controllers\Kendaraan;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Supir;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class MobilController extends Controller
{
   use ApiResponse;
   public function index()
   {
      $x['title']    = 'Kelola Mobil';
      $x['supir']    = Supir::get();

      $data = Mobil::with('supir','kursi_mobil');
     
      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.mobil.action', compact('data'));
            })
            ->editColumn('foto', function ($data) {
               return '<img src="' . $data->getFotoUrl() . '" height="100px" width="100px">';
            })
            ->rawColumns(['action', 'foto'])
            ->make(true);
      }
      return view('app.mobil.index', $x);
   }

   public function store(Request $request)
   {


      try {
         $old = Mobil::find($request->id)?->foto;
         if ('images/' . $request->file('foto')->getClientOriginalName() != $old) {
            $image_path = $request->file('foto')->store('images', 'public');
         } else {
            $image_path = $old;
         }

         Mobil::updateOrCreate(
            ['id'               => $request->id],
            [
               'nama'     => $request->nama,
               'plat'     => $request->plat,
               'supir_id' => $request->supir_id,
               'foto'     =>  $image_path,
            ]
         );


         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function edit(Mobil $mobil)
   {
      return $this->success('Data Mobil', $mobil);
   }

   public function destroy(Mobil  $mobil)
   {
      try {
         $mobil->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
