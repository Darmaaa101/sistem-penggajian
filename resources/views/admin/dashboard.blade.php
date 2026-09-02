@extends('layouts.admin')

@section('title', 'Signature Visual')

@section('content')

<!-- Header Selamat Datang -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600 mt-1">Selamat datang di Sistem Penggajian Signature Visual.</p>
</div>

<!-- Grid Kartu Ringkasan (Statistik) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Card 1: Total Pegawai -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-600 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pegawai</p>
            <h3 class="text-2xl font-extrabold text-gray-800 mt-1">{{ $totalPegawai }}</h3>
        </div>
        <div class="p-3 bg-blue-100 text-blue-600 rounded-full text-xl">
            👥
        </div>
    </div>

    <!-- Card 2: Total Jabatan -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Jabatan</p>
            <h3 class="text-2xl font-extrabold text-gray-800 mt-1">{{ $totalJabatan }}</h3>
        </div>
        <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full text-xl">
            💼
        </div>
    </div>

    <!-- Card 3: Total Transaksi Gaji -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-indigo-600 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Transaksi Gaji</p>
            <h3 class="text-2xl font-extrabold text-gray-800 mt-1">{{ $totalPenggajian }}</h3>
        </div>
        <div class="p-3 bg-indigo-100 text-indigo-600 rounded-full text-xl">
            📄
        </div>
    </div>

    <!-- Card 4: Total Gaji Dibayarkan -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-600 flex justify-between items-center">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Gaji Dibayarkan</p>
            <h3 class="text-lg font-extrabold text-gray-800 mt-1">Rp {{ number_format($totalPengeluaranGaji, 0, ',', '.') }}</h3>
        </div>
        <div class="p-3 bg-green-100 text-green-600 rounded-full text-xl">
            💰
        </div>
    </div>

</div>

<!-- Konten Utama: Tabel Transaksi Terbaru & Tombol Aksi Cepat -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Tabel 5 Transaksi Penggajian Terbaru -->
    <div class="lg:col-span-2 bg-white shadow rounded-xl p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-800">Penggajian Terbaru</h2>
            <a href="{{ route('admin.penggajian.index') }}" class="text-blue-600 hover:underline text-sm font-semibold">
                Lihat Semua →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b text-gray-500 text-xs uppercase">
                        <th class="pb-3">Pegawai</th>
                        <th class="pb-3">Periode</th>
                        <th class="pb-3 text-right">Total Gaji</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($penggajianTerbaru as $item)
                    <tr>
                        <td class="py-3 font-semibold text-gray-800">
                            {{ $item->pegawai->nama ?? '-' }}
                        </td>
                        <td class="py-3 text-gray-600">
                            {{ $item->bulan }} {{ $item->tahun }}
                        </td>
                        <td class="py-3 font-bold text-blue-600 text-right">
                            Rp {{ number_format($item->total_gaji, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-gray-500">
                            Belum ada riwayat penggajian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Panel Aksi Cepat (Quick Actions) -->
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h2>
        <div class="space-y-3">
            <a href="{{ route('admin.pegawai.create') }}" 
               class="block w-full bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold text-center py-3 rounded-lg border border-blue-200 transition">
                + Tambah Pegawai Baru
            </a>
            
            <a href="{{ route('admin.penggajian.create') }}" 
               class="block w-full bg-green-50 hover:bg-green-100 text-green-700 font-semibold text-center py-3 rounded-lg border border-green-200 transition">
                + Input Gaji Pegawai
            </a>
        </div>
    </div>

</div>

@endsection