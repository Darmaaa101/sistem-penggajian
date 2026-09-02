@extends('layouts.admin')

@section('title', 'Input Gaji Pegawai')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Input Gaji Pegawai</h1>
    <a href="{{ route('admin.penggajian.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
        Kembali
    </a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl">
    <form action="{{ route('admin.penggajian.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Pilih Pegawai</label>
            <select id="pegawai" id="jabatan" name="pegawai_id" class="w-full border rounded-lg p-2.5" required>
                <option value="">-- Pilih Pegawai --</option>
                @foreach($pegawai as $p)
                    <option value="{{ $p->id }}">{{ $p->nip }} - {{ $p->nama }}- ({{$p->jabatan->nama_jabatan}} )</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-semibold mb-2">Bulan</label>
                <select name="bulan" class="w-full border rounded-lg p-2.5" required>
                    @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                        <option value="{{ $bulan }}">{{ $bulan }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-2">Tahun</label>
                <input type="number" name="tahun" value="{{ date('Y') }}" class="w-full border rounded-lg p-2.5" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Gaji Pokok (Rp)</label>
            <input type="number" id="gaji_pokok" name="gaji_pokok" readonly class="w-full border rounded-lg p-2.5 bg-gray-100" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Tunjangan (Rp)</label>
            <input type="number" id="tunjangan" name="tunjangan" readonly class="w-full border rounded-lg p-2.5 bg-gray-100">
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Potongan (Rp)</label>
            <input type="number" id="potongan" name="potongan" value="0" class="w-full border rounded-lg p-2.5">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Total Gaji</label>
            <input type="number" id="total_gaji" readonly class="w-full border rounded-lg p-2.5 bg-gray-100">
        </div>

        <div class="flex justify-end gap-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Simpan Gaji
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const pegawai = document.getElementById('pegawai');
    const gaji = document.getElementById('gaji_pokok');
    const tunjangan = document.getElementById('tunjangan');
    const potongan = document.getElementById('potongan');
    const total = document.getElementById('total_gaji');

    pegawai.addEventListener('change', function () {
        if (this.value === '') {
            gaji.value = '';
            tunjangan.value = '';
            total.value = '';
            return;
        }

        fetch("{{ url('/admin/pegawai') }}/" + this.value + "/gaji")
            .then(response => response.json())
            .then(data => {
                gaji.value = data.gaji_pokok;
                tunjangan.value = data.tunjangan;
                hitungTotal();
            });
    });

    potongan.addEventListener('input', hitungTotal);

    function hitungTotal() {
        let gp = parseFloat(gaji.value) || 0;
        let tj = parseFloat(tunjangan.value) || 0;
        let pt = parseFloat(potongan.value) || 0;

        total.value = gp + tj - pt;
    }
</script>
@endpush

@endsection