<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

   use ApiResponse;
   public function login(Request $request)
   {
      if(Auth::attempt(['username' =>$request->username, 'password' => $request->password])){ 

         $user   = Auth::user();

         // if($user->active != 1){
         //    return $this->error('User Telah di Nonaktifkan, Silahkan hubungi operator ', 200, "");
         // }
         
         $success['token'] = $user->createToken('travel_app')->accessToken;
         $success['user']  = $user;
         return $this->success('User Berhasil Login', $success);
      } 
     else{ 
         return $this->error('Username atau password salah' ,400);
     } 
   }

   public function logout()
   {
      try {
         $auth = Auth::user()->token()->revoke();
         return $this->success("Token auth dihapus, User Berhasil Logout");
      } catch (\Throwable $th) {
         return $this->error($th, 400);
      }
   }

   public function register(Request $request)
   {
     
   }

   public function userDetail()
   {
      
   }

   public function ubahPassword(Request $request)
   {
      DB::beginTransaction();
      try {
         $id_user = Auth::User()->id;
         $current = trim($request->password_lama);
         $pass1 = trim($request->password_baru);

         $user = User::find($id_user);
         if (Hash::check($current, $user->password)) {
            $user->password = Hash::make($pass1);
            $user->save();
            DB::commit();
            return $this->success("Berhasil update Password");
         } else {
            return $this->error("Password lama tidak cocok", 200);
         }
      } catch (Exception $e) {
         DB::rollback();
         return $this->error("Error "+$e, 400);
      }
   }

   public function lupaPassword(Request $request)
   {
      DB::beginTransaction();
      try{
          $user = User::where([['no_hp', trim($request->nik)],
          ['email', trim($request->email)]])->firstOrFail();
          $user->password = Hash::make(trim($request->password_baru));
          $user->save();
          DB::commit();
          return $this->success("Password Berhasil Diubah","");
      }catch (ModelNotFoundException $e){
         DB::rollback();
         return $this->error("Data User Tidak Ditemukan",200);
     }
      catch (Exception $e){
          DB::rollback();
          return $this->error($e."Password Gagal Diubah", 400);
      }
   }


}