@extends('layouts.admin')

@section('title', 'Laporan Penggajian Signature Visual')

@section('content')

@php
    $bulanNama = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
@endphp

<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Laporan Penggajian</h1>
    </div>

    <!-- Form Filter Card -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <form method="GET" action="{{ route('admin.laporan.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                {{-- Filter Bulan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                    <select name="bulan" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">-- Semua Bulan --</option>
                        @foreach($bulanNama as $key => $nama)
                            <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>
                                {{ $nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Tahun --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                    <input type="number" name="tahun" value="{{ request('tahun') }}"
                        class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                        placeholder="Contoh: 2026" min="2000" max="2099">
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg text-sm transition-colors duration-200">
                        🔍 Tampilkan
                    </button>

                    <a href="{{ route('admin.laporan.pdf', request()->query()) }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">
                            Cetak PDF
                    </a>
                    
                    @if(request('bulan') || request('tahun'))
                        <a href="{{ route('admin.laporan.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium px-4 py-2.5 rounded-lg text-sm transition-colors duration-200">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs font-semibold uppercase tracking-wider text-gray-600">
                    <tr>
                        <th class="p-4 text-center w-12">No</th>
                        <th class="p-4">Pegawai</th>
                        <th class="p-4 text-center">Bulan</th>
                        <th class="p-4 text-center">Tahun</th>
                        <th class="p-4 text-right">Total Gaji</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($penggajian as $item)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="p-4 text-center font-medium text-gray-500">{{ $loop->iteration }}</td>
                            <td class="p-4">
                                <div class="font-semibold text-gray-900">{{ $item->pegawai->nama ?? '-' }}</div>
                                <div class="text-xs text-gray-500">NIP: {{ $item->pegawai->nip ?? '-' }}</div>
                            </td>
                            <td class="p-4 text-center">
                                {{ $bulanNama[(int)$item->bulan] ?? $item->bulan }}
                            </td>
                            <td class="p-4 text-center">{{ $item->tahun }}</td>
                            <td class="p-4 text-right font-bold text-blue-600">
                                Rp {{ number_format($item->total_gaji, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400">
                                📭 Tidak ada data penggajian yang sesuai dengan filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                {{-- Total Ringkasan Laporan --}}
                @if($penggajian->isNotEmpty())
                    <tfoot class="bg-gray-50 border-t border-gray-200 font-bold text-gray-800 text-sm">
                        <tr>
                            <td colspan="4" class="p-4 text-right">Total Seluruh Gaji:</td>
                            <td class="p-4 text-right text-blue-700 text-base">
                                Rp {{ number_format($penggajian->sum('total_gaji'), 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>

@endsection