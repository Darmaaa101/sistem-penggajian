<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 30; $i++) {
            $nama = $faker->name();

        // 1. Buat data User dulu dan ambil ID-nya
        $userId = DB::table('users')->insertGetId([
            'name'       => $nama,
            'email'      => $faker->unique()->safeEmail(),
            'password'   => Hash::make('password123'), // Password default login
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Masukkan $userId ke tabel Pegawai
        DB::table('pegawai')->insert([
            'user_id'       => $userId, // <-- INI YANG BIKIN ERROR TADI, SEKARANG SUDAH ADA
            'jabatan_id'    => $faker->numberBetween(1, 10),
            'nip'           => $faker->unique()->numerify('PG0##'),
            'nama'          => $nama,
            'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
            'alamat'        => $faker->city(),
            'no_hp'         => $faker->numerify('0812########'),
            'status'        => $faker->randomElement(['Tetap', 'Kontrak']),
            'tanggal_masuk' => $faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
         }
    }
}