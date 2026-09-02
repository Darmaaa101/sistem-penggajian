@extends('layouts.admin')

@section('title', 'Edit Data Pegawai')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Edit Data Pegawai</h1>
    <a href="{{ route('admin.pegawai.index') }}" 
       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
        Kembali
    </a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl">
    <form action="{{ route('admin.pegawai.update', $pegawai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Input NIP -->
        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">NIP</label>
            <input type="text" name="nip" 
                   value="{{ old('nip', $pegawai->nip) }}" 
                   class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500" 
                   required>
            @error('nip')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Nama -->
        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Nama Pegawai</label>
            <input type="text" name="nama" 
                   value="{{ old('nama', $pegawai->nama) }}" 
                   class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500" 
                   required>
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Dropdown Jabatan -->
        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Jabatan</label>
            <select name="jabatan_id" 
                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500" 
                    required>
                <option value="">-- Pilih Jabatan --</option>
                @foreach($jabatan as $j)
                    <option value="{{ $j->id }}" 
                        {{ old('jabatan_id', $pegawai->jabatan_id) == $j->id ? 'selected' : '' }}>
                        {{ $j->nama_jabatan }}
                    </option>
                @endforeach
            </select>
            @error('jabatan_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input / Dropdown Status -->
       <!-- Dropdown Status -->
        <div class="mb-6">
            <label class="block font-semibold text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="Tetap" {{ old('status', $pegawai->status) == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                <option value="Kontrak" {{ old('status', $pegawai->status) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
            </select>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.pegawai.index') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
                Batal
            </a>
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Update Pegawai
            </button>
        </div>
    </form>
</div>

@endsection