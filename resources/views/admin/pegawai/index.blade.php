@extends('layouts.admin')

@section('title', 'Signature Visual')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">
        Data Pegawai
    </h1>

    <a href="{{ route('admin.pegawai.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
        + Tambah Pegawai
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<table class="w-full bg-white shadow rounded-lg overflow-hidden">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="p-3 text-left">No</th>
            <th class="p-3 text-left">NIP</th>
            <th class="p-3 text-left">Nama</th>
            <th class="p-3 text-left">Jabatan</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($pegawai as $item)
        <tr class="border-b hover:bg-gray-50">
            <td class="p-3">{{ $loop->iteration }}</td>
            <td class="p-3">{{ $item->nip }}</td>
            <td class="p-3">{{ $item->nama }}</td>
            <td class="p-3">{{ $item->jabatan->nama_jabatan ?? '-' }}</td>
            <td class="p-3">{{ $item->status }}</td>

            <td class="p-3 text-center">
                <!-- Tombol Detail -->
                <button type="button" 
                    onclick="openModal('modal-{{ $item->id }}')"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white px-3 py-1 rounded inline-block mr-1">
                    Detail
                </button>

                <!-- Tombol Edit -->
                <a href="{{ route('admin.pegawai.edit', $item->id) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded inline-block mr-1">
                    Edit
                </a>

                <!-- Tombol Hapus -->
                <form action="{{ route('admin.pegawai.destroy', $item->id) }}" 
                    method="POST" 
                    class="inline"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pegawai ini?')">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                        Hapus
                    </button>
                </form>

                <!-- POP-UP MODAL DETAIL PEGAWAI -->
                <div id="modal-{{ $item->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 p-4">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden text-left">
                        <!-- Modal Header -->
                        <div class="bg-blue-600 text-white px-4 py-3 flex justify-between items-center">
                            <h3 class="text-lg font-bold">Detail Pegawai</h3>
                            <button type="button" onclick="closeModal('modal-{{ $item->id }}')" class="text-white hover:text-gray-200 font-bold text-xl">&times;</button>
                        </div>

                        <!-- Modal Body -->
                        <div class="p-4 text-gray-700 space-y-2">
                            <div class="grid grid-cols-3 border-b pb-2">
                                <span class="font-semibold">NIP</span>
                                <span class="col-span-2">: {{ $item->nip }}</span>
                            </div>
                            <div class="grid grid-cols-3 border-b pb-2">
                                <span class="font-semibold">Nama</span>
                                <span class="col-span-2">: {{ $item->nama }}</span>
                            </div>
                            <div class="grid grid-cols-3 border-b pb-2">
                                <span class="font-semibold">Jabatan</span>
                                <span class="col-span-2">: {{ $item->jabatan->nama_jabatan ?? '-' }}</span>
                            </div>
                            <div class="grid grid-cols-3 border-b pb-2">
                                <span class="font-semibold">Status</span>
                                <span class="col-span-2">: {{ $item->status }}</span>
                            </div>
                            <div class="grid grid-cols-3 border-b pb-2">
                                <span class="font-semibold">No. HP</span>
                                <span class="col-span-2">: {{ $item->no_hp ?? '-' }}</span>
                            </div>
                            <div class="grid grid-cols-3 border-b pb-2">
                                <span class="font-semibold">Tgl Masuk</span>
                                <span class="col-span-2">: {{ $item->tanggal_masuk ? \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') : '-' }}</span>
                            </div>
                            <div class="grid grid-cols-3 pb-2">
                                <span class="font-semibold">Alamat</span>
                                <span class="col-span-2">: {{ $item->alamat ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-gray-100 px-4 py-3 text-right">
                            <button type="button" onclick="closeModal('modal-{{ $item->id }}')" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
                <!-- END MODAL -->

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center p-5 text-gray-500">
                Belum ada data pegawai.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@push('scripts')
<script>
    // Fungsi untuk membuka modal
    function openModal(id) {
        const modal = document.getElementById(id);
        if(modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    // Fungsi untuk menutup modal
    function closeModal(id) {
        const modal = document.getElementById(id);
        if(modal) {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    }
</script>
@endpush

@endsection