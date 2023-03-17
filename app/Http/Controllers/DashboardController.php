<?php

namespace App\Http\Controllers;

use App\Config\PengajuanAksi;
use App\Models\Mobil;
use App\Models\Pengajuan;
use App\Models\PengajuanHistori;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
   public function index(Request $request)
   {
      $x['title']         = 'Dashboard';
      $x['user']          = User::where('hak_akses', 'pelanggan')->get();
      $x['pesanan_selesai']          = Pesanan::whereIn('status_pesanan', ['SELESAI', 'DITOLAK'])->get();
      $x['pesanan_masuk']   = Pesanan::where('status_pesanan', '!=', 'SELESAI')->get();
      $x['mobil']    = Mobil::get();
    

      return view('admin.dashboard', $x);
   }
}
