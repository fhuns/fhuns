<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        // ===== KONFIGURASI UTAMA (CUKUP EDIT DI SINI) =====
        $config = [
            'prodi' => 'Ilmu Hukum',
            'angkatan' => 2018,
            'tahun' => 2018,
            'prefix_nim' => 'FH18' // FH + tahun angkatan 2 digit
        ];

        // ===== DATA MAHASISWA =====
        $data = [
            // Format: ['nama', 'nim_akhir']
            ['Budii Santoso', '0004'],
            ['Anii Wijaya', '0005'],
            ['Citraa Dewi', '0006'],
            // Tambahkan data di bawah ini:
            // ['Nama Mahasiswa', 'Nomor Akhir NIM'],
            
            
            
        ];

        // ===== PROSES INPUT =====
        foreach ($data as $mhs) {
            Mahasiswa::create([
                'nama' => $mhs[0],
                'nim' => $config['prefix_nim'] . $mhs[1],
                'angkatan' => $config['angkatan'],
                'prodi' => $config['prodi'],
                'tahun' => $config['tahun']
            ]);
        }
    }
}