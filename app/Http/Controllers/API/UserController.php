<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ApiResponse;

class UserController extends Controller
{
   use ApiResponse;

   public function getUserDetail($id_user){
     $user = User::findOrFail($id_user);
     return $this->success("User Detail", $user);
   }
}
