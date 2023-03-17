<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
   public function index()
   {
      return view('app.laporan.index');
   }
   public function cetakLaporan()
   {
    
      $tgl_awal = Carbon::createFromFormat('d-m-Y', request()->get('tgl_awal'))->format('Y-m-d');
      $tgl_akhir = Carbon::createFromFormat('d-m-Y', request()->get('tgl_akhir'))->format('Y-m-d');

      $pesanan = Pesanan::with('jadwal', 'jadwal.lokasi_keberangkatan_r', 'jadwal.lokasi_tujuan_r', 'kursi_pesanan')
      ->where('status_pesanan', 'SELESAI')
      ->where('created_at', '>=', $tgl_awal)
      ->where('created_at', '<=', $tgl_akhir)->get();
      
      return view('app.laporan.preview', compact('pesanan','tgl_awal','tgl_akhir'));
   }
}
