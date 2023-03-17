<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
   use ApiResponse;

   public function index()
   {
      // 
      $x['title']     = 'User';
      $data     = User::whereIn('hak_akses', ['admin', 'owner']);
      $x['role']      = Role::get();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.user.action', compact('data'));
            })
            ->editColumn('foto', function ($data) {
               return '<img src="' . $data->getFotoUrl() . '" height="100px" width="100px">';
            })
            ->rawColumns(['action', 'foto'])
            ->make(true);
      }
      return view('app.user.index', $x);
   }

 

   public function edit(User $user)
   {
      return $this->success('Data User', $user);
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
               'nama_lengkap' => $request->nama_lengkap,
               'username'     => $request->username,
               'hak_akses'    => $request->hak_akses,
               'kontak'       => $request->kontak,
               'foto'         => $image_path,
               'password'     => bcrypt($request->password),
            ]
         );
         if ($request->id) 
          return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

  

  

   public function destroy($id)
   {

      try {
         $user = User::find($id);
         $user->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data User', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data User', 400);
      }
   }
}
