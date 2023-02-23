<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   use ApiResponse;

   public function getUserDetail()
   {
      $user = User::findOrFail(auth()->user()->id);
      return $this->success("User Detail", $user);
   }

   public function updateProfil(Request $request)
   {
      try {
         $user = User::where('id', Auth::user()->id);
         $user->update($request->all());
         return $this->success("Berhasil update Profil");
      } catch (Exception $e) {
         return $this->error("Gagal update Profil" .$e, 400);
      }
   }

   public function updateFoto(Request $request)
   {
      try {
         $image_path = $request->file('img_foto')->store('images', 'public');
         User::where('id', auth()->user()->id)->update([
            'foto' =>  $image_path
         ]);
         return $this->success("Berhasil update Foto Profil");
      } catch (Exception $e) {
         return $this->error("Gagal update Foto Profil" .$e, 400);
      }
   }
}
