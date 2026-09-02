<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penggajian</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px; /* Ukuran font umum sedikit diperkecil */
        }

        h2, h3, p {
            margin: 0;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th {
            background: #f2f2f2;
        }

        th, td {
            padding: 6px;
            text-align: center;
        }

        .total {
            margin-top: 15px;
            text-align: right;
            font-weight: bold;
            font-size: 12px;
        }

        /* Styling area tanda tangan di pojok kanan */
        .ttd-container {
            float: right;
            width: 200px;
            text-align: center;
            font-size: 11px;
            margin-top: 30px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>

    <h2>Signature Visual</h2>
    <h3>LAPORAN PENGGAJIAN</h3>

    <p>
        Periode :
        {{ request('bulan') ?? 'Semua Bulan' }}
        {{ request('tahun') ?? '' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penggajian as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pegawai->nama ?? $item->nama ?? 'Tanpa Nama' }}</td>
                    <td>{{ $item->pegawai->jabatan->nama_jabatan ?? $item->jabatan ?? '-' }}</td>
                    <td>{{ $item->bulan }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>Rp {{ number_format($item->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->tunjangan ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->potongan ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->total_gaji ?? ($item->gaji_pokok + $item->tunjangan - $item->potongan), 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Data penggajian tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Bagian Total Pengeluaran -->
    <div class="total">
        Total Pengeluaran : 
        Rp {{ number_format($penggajian->sum(function($item) {
            return $item->total_gaji ?? ($item->gaji_pokok + $item->tunjangan - $item->potongan);
        }), 0, ',', '.') }}
    </div>

    <!-- Bagian Tanda Tangan Pojok Kanan -->
    <div class="ttd-container">
        Jakarta, {{ date('d F Y') }}
        <br><br><br><br>
        <strong>Keuangan</strong>
    </div>

    <div class="clear"></div>

</body>

</html>