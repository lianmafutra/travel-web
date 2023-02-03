<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;


class JadwalController extends Controller
{
   
    public function index()
    {
    
      $x['title']    = 'Kelola Jadwal Travel';
      $data = Jadwal::with('mobil', 'supir', 'lokasi_tujuan', 'lokasi_keberangkatan');

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.jadwal.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.jadwal.index', $x, compact(['data']));
    }

 
   
    public function store(Request $request)
    {
      try {

         Jadwal::updateOrCreate(
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
