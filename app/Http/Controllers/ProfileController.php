<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function index()
   {
      $user = User::where('id', auth()->user()->id)->first();
      return view('app.profile.index', compact(['user']));
   }

   public function updateFoto(Request $request)
   {
      try {
         $old = User::find($request->id)?->foto;
         if ('images/' . $request->file('foto')->getClientOriginalName() != $old) {
            $image_path = $request->file('foto')->store('images', 'public');
         } else {
            $image_path = $old;
         }
         User::where('id', auth()->user()->id)->update(
            [
               'foto'         => $image_path,
            ]
         );
         return redirect()->back()->with('success', 'Berhasil Update Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Update Data', 400);
      }
   }

   public function updateProfile(Request $request)
   {
      try {
         User::where('id', auth()->user()->id)->update(
            [
               'kontak'     => $request->kontak,
            ]
         );
         return redirect()->back()->with('success', 'Berhasil Update Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Update Data', 400);
      }
   }
}
