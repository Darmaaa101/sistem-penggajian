@extends('layouts.admin')

@section('title', 'Tambah Pegawai')

@section('content')

<form action="{{ route('admin.pegawai.store') }}" method="POST">

    @csrf

    <div class="mb-4">
        <label>NIP</label>
        <input type="text" name="nip" class="border w-full p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Nama Pegawai</label>
        <input type="text" name="nama" class="border w-full p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Jabatan</label>

        <select name="jabatan_id" class="border w-full p-2 rounded">

            @foreach($jabatan as $item)

                <option value="{{ $item->id }}">
                    {{ $item->nama_jabatan }}
                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-4">
        <label>Jenis Kelamin</label>

        <select name="jenis_kelamin" class="border w-full p-2 rounded">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

    </div>

    <div class="mb-4">
        <label>Alamat</label>

        <textarea name="alamat"
            class="border w-full p-2 rounded"></textarea>

    </div>

    <div class="mb-4">
        <label>No HP</label>

        <input type="text"
            name="no_hp"
            class="border w-full p-2 rounded">

    </div>

    <div class="mb-4">
        <label>Tanggal Masuk</label>

        <input type="date"
            name="tanggal_masuk"
            class="border w-full p-2 rounded">

    </div>

    <div class="mb-4">
        <label>Status</label>

        <select name="status"
            class="border w-full p-2 rounded">

            <option value="Tetap">Tetap</option>
            <option value="Kontrak">Kontrak</option>

        </select>

    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Simpan
    </button>

</form>

@endsection