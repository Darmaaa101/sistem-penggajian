<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penggajian;
use App\Models\Pegawai;
use App\Models\penggajian as ModelsPenggajian;

class PenggajianController extends Controller
{
    public function index()
    {
        $penggajian = Penggajian::with('pegawai.jabatan')->latest()->get();
        return view('admin.penggajian.index', compact('penggajian'));
    }

    public function create()
    {
        $pegawai = Pegawai::all();
        $pegawai = Pegawai::with('jabatan')->get();
        return view('admin.penggajian.create', compact('pegawai'));
    }

    public function getGaji(Pegawai $pegawai)
    {
        return response()->json([
            'gaji_pokok' => $pegawai->jabatan->gaji_pokok,
            'tunjangan' => $pegawai->jabatan->tunjangan,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'bulan'      => 'required',
            'tahun'      => 'required|numeric',
            'gaji_pokok' => 'required',
            'tunjangan'  => 'nullable',
            'potongan'   => 'nullable',
        ]);

        $pegawai = Pegawai::with('jabatan')->findOrFail($request->pegawai_id);

        $gajiPokok = $pegawai->jabatan->gaji_pokok;
        $tunjangan = $pegawai->jabatan->tunjangan;
        $potongan = $request->potongan ?? 0; 
        
        // Perhitungan Total Gaji
        $totalGaji = $gajiPokok + $tunjangan - $potongan;

        Penggajian::create([
            'pegawai_id' => $request->pegawai_id,
            'bulan'      => $request->bulan,
            'tahun'      => $request->tahun,
            'gaji_pokok' => $gajiPokok,
            'tunjangan'  => $tunjangan,
            'potongan'   => $potongan,
            'total_gaji' => $totalGaji,
        ]);

        return redirect()->route('admin.penggajian.index')
                         ->with('success', 'Data penggajian berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $penggajian = Penggajian::with('pegawai.jabatan')->findOrFail($id);

        return view('admin.penggajian.show', compact('penggajian'));
    }

    public function destroy(string $id)
    {
        $penggajian = Penggajian::findOrFail($id);
        $penggajian->delete();

        return redirect()->route('admin.penggajian.index')
                         ->with('success', 'Data penggajian berhasil dihapus!');
    }

}
