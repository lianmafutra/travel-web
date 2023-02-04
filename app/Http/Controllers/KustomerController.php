<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\ApiResponse;
use App\Models\Mobil;
use App\Models\Supir;
use Illuminate\Http\Request;

class KustomerController extends Controller
{
   
   use ApiResponse;
   public function index()
   {
      $x['title']    = 'Kelola Data Kustomer';

      $data = User::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.kustomer.action', compact('data'));
            })
            ->editColumn('foto', function ($data) {
               return '<img src="' . $data->getFotoUrl() . '" height="100px" width="100px">';
            })
            ->rawColumns(['action', 'foto'])
            ->make(true);
      }
      return view('app.kustomer.index', $x);
   }

   public function store(Request $request)
   {


      try {
         $old = User::find($request->id)?->foto;
         if ('images/' . $request->file('foto')->getClientOriginalName() != $old) {
            $image_path = $request->file('foto')->store('images', 'public');
         } else {
            $image_path = $old;
         }

         User::updateOrCreate(
            ['id'               => $request->id],
            [
               'username' => $request->username,
               'name'     => $request->name,
               'kontak'   => $request->kontak,
               'foto'     => $image_path,
            ]
         );


         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function edit(User $kustomer)
   {
      return $this->success('Data Kustomer', $kustomer);
   }

   public function destroy(User  $kustomer)
   {
      try {
         $kustomer->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
