<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jabatan')->insert([
            [
                'nama_jabatan' => 'Manager',
                'gaji_pokok' => 12000000,
                'tunjangan' => 3000000,
            ],
            [
                'nama_jabatan' => 'Supervisor',
                'gaji_pokok' => 8500000,
                'tunjangan' => 2000000,
            ],
            [
                'nama_jabatan' => 'HRD',
                'gaji_pokok' => 7000000,
                'tunjangan' => 1500000,
            ],
            [
                'nama_jabatan' => 'Staff IT',
                'gaji_pokok' => 6500000,
                'tunjangan' => 1200000,
            ],
            [
                'nama_jabatan' => 'Staff Keuangan',
                'gaji_pokok' => 6000000,
                'tunjangan' => 1000000,
            ],
            [
                'nama_jabatan' => 'Staff Administrasi',
                'gaji_pokok' => 5000000,
                'tunjangan' => 800000,
            ],
            [
                'nama_jabatan' => 'Staff Gudang',
                'gaji_pokok' => 4500000,
                'tunjangan' => 700000,
            ],
        ]);
    }
}