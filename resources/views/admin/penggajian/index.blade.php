@extends('layouts.admin')

@section('title', 'Data Penggajian')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Data Penggajian</h1>
    <a href="{{ route('admin.penggajian.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
        + Input Gaji
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="p-3">No</th>
                <th class="p-3">Pegawai</th>
                <th class="p-3">Periode</th>
                <th class="p-3">Gaji Pokok</th>
                <th class="p-3">Tunjangan</th>
                <th class="p-3">Potongan</th>
                <th class="p-3">Total Gaji</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penggajian as $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $loop->iteration }}</td>
                <td class="p-3">
                    <div class="font-bold">{{ $item->pegawai->nama ?? '-' }}</div>
                    <div class="text-xs text-gray-500">NIP: {{ $item->pegawai->nip ?? '-' }}</div>
                </td>
                <td class="p-3">{{ $item->bulan }} {{ $item->tahun }}</td>
                <td class="p-3">Rp {{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                <td class="p-3 text-green-600">+ Rp {{ number_format($item->tunjangan, 0, ',', '.') }}</td>
                <td class="p-3 text-red-600">- Rp {{ number_format($item->potongan, 0, ',', '.') }}</td>
                <td class="p-3 font-bold text-blue-700">Rp {{ number_format($item->total_gaji, 0, ',', '.') }}</td>
                <td class="p-3 text-center">
                    <div class="flex flex-col items-center gap-2">
                        <a href="{{ route('admin.penggajian.show', $item->id) }}"
                             class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded w-full text-center">
                                Slip Gaji
                        </a>

                        <form action="{{ route('admin.penggajian.destroy', $item->id) }}" method="POST" class="w-full"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penggajian ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded w-full">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center p-5 text-gray-500">
                    Belum ada data penggajian.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection