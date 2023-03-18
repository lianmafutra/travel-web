<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TokenFCM;
use App\Models\User;
use App\Utils\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

   use ApiResponse;
   public function login(Request $request)
   {

      $credentials = $request->only('username', 'password');
      if (filter_var($credentials['username'], FILTER_VALIDATE_EMAIL)) {
         $credentials['email'] = $credentials['username'];
         unset($credentials['username']);
     }
 

      if (Auth::attempt($credentials)) {
         $user   = auth()->user();
         // if($user->active != 1){
         //    return $this->error('User Telah di Nonaktifkan, Silahkan hubungi operator ', 200, "");
         // }
         $success['token'] = $user->createToken('travel_app')->accessToken;
         $success['user']  = $user;
         return $this->success('User Berhasil Login', $success);
      } else {
         return $this->error('Username atau password salah', 200);
      }
   }

   public function logout(Request $request)
   {
      try {
         $auth = Auth::user()->token()->revoke();
         TokenFCM::where('token', $request->token)->delete();
         return $this->success("Token auth dihapus, User Berhasil Logout");
      } catch (\Throwable $th) {
         return $this->error($th, 400);
      }
   }

   public function register(Request $request)
   {
      try {
         $input = $request->all();
       
         $image_path = $request->file('foto')->store('images', 'public');
       
         $input['password'] = bcrypt($request->password);
         $input['username'] = $request->email;
         $input['hak_akses'] = 'pelanggan';
        
         $input['foto'] = $image_path;
       
         $user = User::create($input);
         return $this->success("Pendaftaran akun berhasil");
        
      } catch (QueryException $th) {
         $errorCode = $th->errorInfo[1];
         if ($errorCode == 1062) {
            return $this->error("Gagal, Maaf User Sudah pernah terdaftar",  400);
         }
         return $this->error("Pendaftaran User Gagal , ".$th->getMessage(), 400);
      } catch (\Exception $th) {
         return $this->error("Pendaftaran User Gagal , ".$th->getMessage(), 400);
      }
   }

   public function updatePassword(Request $request)
   {
      DB::beginTransaction();
      try {
         $id_user = Auth::User()->id;
         $current = trim($request->password_lama);
         $pass1 = trim($request->password_baru);

         $user = User::find($id_user);
         $user->password = Hash::make($pass1);
            $user->save();
            DB::commit();
            return $this->success("Berhasil update Password");
      } catch (Exception $e) {
         DB::rollback();
         return $this->error("Error " + $e, 400);
      }
   }

   public function lupaPassword(Request $request)
   {
      DB::beginTransaction();
      try {
         $user = User::where([
            ['no_hp', trim($request->nik)],
            ['email', trim($request->email)]
         ])->firstOrFail();
         $user->password = Hash::make(trim($request->password_baru));
         $user->save();
         DB::commit();
         return $this->success("Password Berhasil Diubah", "");
      } catch (ModelNotFoundException $e) {
         DB::rollback();
         return $this->error("Data User Tidak Ditemukan", 200);
      } catch (Exception $e) {
         DB::rollback();
         return $this->error($e . "Password Gagal Diubah", 400);
      }
   }
}
