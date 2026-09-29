<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penggajian;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data statistik untuk kartu ringkasan
        $totalPegawai        = Pegawai::count();
        $totalJabatan        = Jabatan::count();
        $totalPenggajian     = Penggajian::count();
        $totalPengeluaranGaji = Penggajian::sum('total_gaji');

        // 2. Ambil 5 riwayat transaksi penggajian terbaru
        $penggajianTerbaru   = Penggajian::with('pegawai')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPegawai',
            'totalJabatan',
            'totalPenggajian',
            'totalPengeluaranGaji',
            'penggajianTerbaru'
        ));
    }
}
