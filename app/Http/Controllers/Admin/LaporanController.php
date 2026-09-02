<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penggajian;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penggajian::with('pegawai');

        if ($request->bulan) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        $penggajian = $query->get();

        return view('admin.laporan.index', compact('penggajian'));
    }

   public function pdf(Request $request)
{
    $query = Penggajian::with('pegawai.jabatan');

    if ($request->filled('bulan')) {
        $query->where('bulan', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $query->where('tahun', $request->tahun);
    }

    $penggajian = $query->get();

    $pdf = Pdf::loadView('admin.laporan.pdf', compact('penggajian'));

    return $pdf->download('laporan-penggajian.pdf');
    }
}
