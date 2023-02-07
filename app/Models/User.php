<?php

namespace App\Models;

use App\Utils\ApiResponse;
use App\Utils\AutoUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\ResponseTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
   use HasApiTokens, HasFactory, Notifiable;
   
   use HasRoles;
   // use AutoUUID;
   use ApiResponse;


   protected $fillable = [
      'username',
      'password',
      'opd_id',
   ];

   protected $hidden = [
      'password',
      'remember_token',
   ];

   protected $casts = [
      'created_at'  => 'date:d-m-Y H:m:s',
      'updated_at'  => 'date:d-m-Y H:m:s',
   ];

   public function getRoleName()
   {
      return auth()->user()->getRoleNames()[0];
   }



   public function checkPassword($password)
   {
      if (Hash::check($password, auth()->user()->password)) {
         return true;
      } else {
         return false;
      }
   }

   public function getFotoUrl(){
      return asset('storage/profil/'.$this->foto);
   }

}
