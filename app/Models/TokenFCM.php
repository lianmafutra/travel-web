<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenFCM extends Model
{
    use HasFactory;
    protected $table = 'token_fcm';
    protected $guarded = [];
}
