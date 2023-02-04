<?php

namespace App\Http\Controllers;

use App\Models\KursiMobil;
use App\Models\Mobil;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class KursiMobilController extends Controller
{

   use ApiResponse;

   public function index($mobil_id)
   {
      $x['title'] = 'Kelola Kursi Mobil';
      $data = Mobil::with(['kursi_mobil' => function ($query) {
         $query->orderBy('posisi', 'asc');
      }])->where('id', $mobil_id)->first();


      if (request()->ajax()) {
         return  datatables()->of($data->kursi_mobil)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
              
               return view('app.kursi_mobil.action', compact('data'));
            })

            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.kursi_mobil.index', $x);
   }

   public function edit($kursi_mobil_id)
   {
     
      return $this->success('Data Kursi Mobil', KursiMobil::find($kursi_mobil_id));  
   }

   public function store(Request $request)
   {
      try {

         if ($request->id) {
            $jadwal = KursiMobil::find($request->id);
            $input = $request->except('mobil_id');
            $jadwal->fill($input)->save();
         } else {
            
            $input = $request->all();
        
            $input['mobil_id'] =  $request->mobil_id;
            (new KursiMobil())->fill($input)->save();
         }
         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function destroy($kursi_mobil_id)
   {
      try {
         KursiMobil::find($kursi_mobil_id)->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }


}
