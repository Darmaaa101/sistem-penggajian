<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jabatan;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $jabatan = Jabatan::all();

        return view('admin.jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // 1. Bersihkan dulu format Rupiah (buang huruf Rp, titik, spasi)
    $gajiPokok = preg_replace('/[^0-9]/', '', $request->gaji_pokok);
    $tunjangan = preg_replace('/[^0-9]/', '', $request->tunjangan);

    // 2. Timpa (merge) data request dengan angka murni agar lolos validasi
    $request->merge([
        'gaji_pokok' => $gajiPokok,
        'tunjangan'  => $tunjangan,
    ]);

    // 3. Jalankan Validasi
    $request->validate([
        'nama_jabatan' => 'required|string|max:255',
        'gaji_pokok'   => 'required|numeric',
        'tunjangan'    => 'required|numeric',
    ]);

    // 4. Simpan ke Database
    Jabatan::create([
        'nama_jabatan' => $request->nama_jabatan,
        'gaji_pokok'   => $gajiPokok,
        'tunjangan'    => $tunjangan,
    ]);

    // 5. Redirect kembali ke halaman Index Jabatan
    return redirect()->route('admin.jabatan.index')->with('success', 'Data jabatan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        return view('admin.jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric'
        ]);

        $jabatan->update($request->all());

        return redirect()->route('admin.jabatan.index')->with('success', 'Data jabatan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();

        return redirect()->route('admin.jabatan.index')
        ->with('success', 'Data jabatan berhasil diubah.');
    }
}