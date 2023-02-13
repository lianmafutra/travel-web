<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ApiResponse;

class UserController extends Controller
{
   use ApiResponse;

   public function getUserDetail(){
     $user = User::findOrFail(auth()->user()->id);
     return $this->success("User Detail", $user);
   }
}
