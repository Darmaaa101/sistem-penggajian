<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\jabatan;
use App\Models\pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = pegawai::with('jabatan')->get();

        return view('admin.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatan = jabatan::all();

        return view('admin.pegawai.create', compact('jabatan'));
    }   

    public function getGaji(Pegawai $pegawai)
    {
    return response()->json([
        'gaji_pokok' => $pegawai->jabatan->gaji_pokok,
        'tunjangan' => $pegawai->jabatan->tunjangan, ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip'           => 'required|unique:pegawai,nip',
            'nama'          => 'required',
            'jabatan_id'    => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required',
            'no_hp'         => 'required',
            'tanggal_masuk' => 'required',
            'status'        => 'required',
        ]);

        $user = User::create([
            'name'     => $request->nama,
            'email'    => $request->nip . '@gmail.com', // Email otomatis pakai NIP (atau tambahkan field email di form)
            'password' => Hash::make('12345678'),       // Password default pegawai
            'role'     => 'pegawai',                     // Role sebagai pegawai
        ]);

        Pegawai::create([
            'user_id'       => $user->id, // <-- Masukkan ID user yang baru dibuat
            'nip'           => $request->nip,
            'nama'          => $request->nama,
            'jabatan_id'    => $request->jabatan_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'tanggal_masuk' => $request->tanggal_masuk,
            'status'        => $request->status,
        ]);

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 1. Cari data pegawai berdasarkan ID
        $pegawai = Pegawai::findOrFail($id);

        // Jika ada data master relasi (seperti daftar Jabatan untuk dropdown):
        $jabatan = Jabatan::all(); 

        // 2. Kirim variable $pegawai ke view edit
        return view('admin.pegawai.edit', compact('pegawai', 'jabatan'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Validasi input
        $request->validate([
            'nip'        => 'required|unique:pegawai,nip,' . $id,
            'nama'       => 'required|string|max:255',
            'jabatan_id' => 'required',
            'status'     => 'required',
        ]);

        // Simpan perubahan
        $pegawai->update([
            'nip'        => $request->nip,
            'nama'       => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'status'     => $request->status,
        ]);

        return redirect()->route('admin.pegawai.index')
                         ->with('success', 'Data pegawai berhasil diperbarui!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        if ($pegawai->user_id) {
            \App\Models\User::destroy($pegawai->user_id);
        }

        $pegawai->delete();

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil dihapus!');
    }
}
