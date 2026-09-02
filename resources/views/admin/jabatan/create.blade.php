@extends('layouts.admin')

@section('title', 'Tambah Jabatan')

@section('content')

<div class="max-w-4xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">
        Tambah Jabatan
    </h1>

    <form action="{{ route('admin.jabatan.store') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Nama Jabatan
            </label>

            <input
                type="text"
                name="nama_jabatan"
                class="w-full border rounded-lg p-2"
                placeholder="Contoh: Staff IT"
                required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Gaji Pokok
            </label>

            <!-- type diganti ke 'text' & ditambah class 'rupiah-input' -->
            <input
                type="text"
                name="gaji_pokok"
                class="w-full border rounded-lg p-2 rupiah-input"
                placeholder="Rp 0"
                required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Tunjangan
            </label>

            <!-- type diganti ke 'text' & ditambah class 'rupiah-input' -->
            <input
                type="text"
                name="tunjangan"
                class="w-full border rounded-lg p-2 rupiah-input"
                placeholder="Rp 0"
                required>
        </div>

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
            Simpan
        </button>

    </form>

</div>

<!-- Script untuk Auto Format Rupiah saat diketik -->
<script>
    document.querySelectorAll('.rupiah-input').forEach(function(input) {
        input.addEventListener('keyup', function(e) {
            let number_string = this.value.replace(/[^,\d]/g, '').toString();
            let split   = number_string.split(',');
            let sisa    = split[0].length % 3;
            let rupiah  = split[0].substr(0, sisa);
            let ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            this.value = rupiah ? 'Rp ' + rupiah : '';
        });
    });
</script>

@endsection