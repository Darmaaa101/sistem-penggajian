@extends('layouts.admin')

@section('title', 'Signature Visual')

@section('content')

{{-- Header Section (Judul & Tombol Tambah dipisah di sini) --}}
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Data Jabatan
    </h1>

    <a href="{{ route('admin.jabatan.create') }}" 
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium shadow transition">
        + Tambah Jabatan
    </a>
</div>

{{-- Flash Message Notifikasi --}}
@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 border border-green-200">
    {{ session('success') }}
</div>
@endif

{{-- Table Section (Tabel berdiri sendiri di luar Flex Container) --}}
<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="p-3 text-center w-16">No</th>
                <th class="p-3">Jabatan</th>
                <th class="p-3 text-right">Gaji Pokok</th>
                <th class="p-3 text-right">Tunjangan</th>
                <th class="p-3 text-center w-48">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($jabatan as $item)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-3 text-center font-medium">{{ $loop->iteration }}</td>

                <td class="p-3 font-semibold text-gray-800">
                    {{ $item->nama_jabatan }}
                </td>
                
                <td class="p-3 text-right">
                    Rp {{ number_format($item->gaji_pokok, 0, '.'. '.') }}
                </td>

                <td class="p-3 text-right">
                    Rp {{ number_format($item->tunjangan, 0, '.'.'.') }}
                </td>

                <td class="p-3 text-center">
                    <a href="{{ route('admin.jabatan.edit', $item->id) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-md text-sm font-medium mr-1 inline-block transition">
                        Edit
                    </a>

                    <form action="{{ route('admin.jabatan.destroy', $item->id) }}"
                        method="POST"
                        class="inline">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md text-sm font-medium transition">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-8 text-gray-500">
                    Belum ada data jabatan.
                </td>
            </tr>

            <!-- Library SweetAlert2 via CDN -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                function confirmDelete(id) {
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data pegawai ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626', // Warna merah tombol hapus
                        cancelButtonColor: '#4b5563',  // Warna abu-abu tombol batal
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit form hapus sesuai ID jika user klik 'Ya, Hapus!'
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                }
            </script>
            @endforelse
        </tbody>
    </table>
</div>

@endsection