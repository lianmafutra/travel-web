<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class LokasiController extends Controller
{

   use ApiResponse;

    public function getLokasi(){
      $lokasi = Lokasi::get();
      return $this->success("Berhasil update Password", $lokasi);
    }
}
