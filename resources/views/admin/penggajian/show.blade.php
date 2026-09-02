@extends('layouts.admin')

@section('title', 'Slip Gaji')

@section('content')

<div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-8 print:shadow-none print:rounded-none">

    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">SLIP GAJI</h1>
            <p class="text-gray-500">Signature Visual</p>
            <p class="text-gray-500">{{ $penggajian->bulan }} {{ $penggajian->tahun }}</p>
        </div>

        <div class="text-right no-print">
            <a href="{{ route('admin.penggajian.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg mr-2">
                Kembali
            </a>

            <button onclick="window.print()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Print
            </button>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6 mb-8">
        <div class="border rounded-lg p-4">
            <h2 class="font-semibold mb-3">Data Pegawai</h2>
            <p><span class="font-medium">Nama:</span> {{ $penggajian->pegawai->nama }}</p>
            <p><span class="font-medium">NIP:</span> {{ $penggajian->pegawai->nip }}</p>
            <p><span class="font-medium">Jabatan:</span> {{ $penggajian->pegawai->jabatan->nama_jabatan }}</p>
            <p><span class="font-medium">Status:</span> {{ $penggajian->pegawai->status }}</p>
        </div>

        <div class="border rounded-lg p-4">
            <h2 class="font-semibold mb-3">Periode Gaji</h2>
            <p><span class="font-medium">Bulan:</span> {{ $penggajian->bulan }}</p>
            <p><span class="font-medium">Tahun:</span> {{ $penggajian->tahun }}</p>
        </div>
    </div>

    <div class="overflow-hidden border rounded-lg">
        <table class="w-full text-left">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-3">Keterangan</th>
                    <th class="p-3 text-right">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="p-3">Gaji Pokok</td>
                    <td class="p-3 text-right">Rp {{ number_format($penggajian->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b">
                    <td class="p-3">Tunjangan</td>
                    <td class="p-3 text-right">Rp {{ number_format($penggajian->tunjangan, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b">
                    <td class="p-3">Potongan</td>
                    <td class="p-3 text-right text-red-600">- Rp {{ number_format($penggajian->potongan, 0, ',', '.') }}</td>
                </tr>
                <tr class="bg-gray-100 font-bold">
                    <td class="p-3">Total Gaji</td>
                    <td class="p-3 text-right text-blue-700">Rp {{ number_format($penggajian->total_gaji, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-10 flex justify-end">
        <div class="text-center">
            <p>Jakarta Timur, {{ date('d F Y') }}</p>
            <p class="mt-16 font-semibold">Owner</p>
        </div>
    </div>

</div>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    body {
        background: white !important;
    }
}
</style>

@endsection