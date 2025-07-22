<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run()
    {
        // ===== KONFIGURASI UTAMA =====
        $jabatan_default = 'Staf'; // Jabatan default jika tidak diisi
        $prodi_default = 'Ilmu Hukum'; // Prodi default jika tidak diisi
        
        // ===== DATA DOSEN =====
        $data = [
            // Format: ['nama', 'nidn', 'jabatan (opsional)', 'prodi (opsional)']
            ['Prof. Dr. Ani Wijaya', '1234567890', 'Guru Besar', 'Ilmu Hukum'],
            ['Dr. Budi Santoso', '2345678901', 'Lektor Kepala', 'Hukum Bisnis'],
            ['Maya Citra, S.H., M.H.', '3456789012', null, 'Hukum Internasional'], // Jabatan akan diisi default
            ['Rudi Hermawan, M.H.', '4567890123'], // Jabatan dan prodi akan diisi default
            // Tambahkan data di bawah ini:
            // Format: ['Nama Lengkap', 'NIDN', 'Jabatan (opsional)', 'Prodi (opsional)'],
            
            
            
        ];

        // ===== PROSES INPUT =====
        foreach ($data as $dosen) {
            Dosen::create([
                'nama' => $dosen[0],
                'nidn' => $dosen[1],
                'jabatan' => $dosen[2] ?? $jabatan_default,
                'prodi' => $dosen[3] ?? $prodi_default
            ]);
        }

        // // ===== OPTIONAL: INPUT DATA MASSAL =====
        // // Jika ingin menambahkan data massal dari array
        // $dataMassal = [
        //     // ['Nama', 'NIDN', 'Jabatan', 'Prodi'],
        //     // ['Dosen 1', '1111111111', 'Asisten Ahli', 'Ilmu Hukum'],
        //     // ['Dosen 2', '2222222222', null, 'Hukum Bisnis'], // Jabatan akan jadi 'Staf'
        // ];

        // foreach ($dataMassal as $dosen) {
        //     Dosen::create([
        //         'nama' => $dosen[0],
        //         'nidn' => $dosen[1],
        //         'jabatan' => $dosen[2] ?? $jabatan_default,
        //         'prodi' => $dosen[3] ?? $prodi_default
        //     ]);
        // }

        // // ===== OPTIONAL: GENERATE DATA RANDOM =====
        // // Jika ingin generate data dummy dalam jumlah besar
        // $jumlahDummy = 0; // Ubah angka ini untuk menambah data dummy
        // $prodiList = ['Ilmu Hukum', 'Hukum Bisnis', 'Hukum Internasional'];
        // $jabatanList = ['Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar', null]; // null akan jadi 'Staf'

        // for ($i = 1; $i <= $jumlahDummy; $i++) {
        //     Dosen::create([
        //         'nama' => 'Dosen ' . $i,
        //         'nidn' => str_pad(rand(1000000000, 9999999999), 10, '0'),
        //         'jabatan' => $jabatanList[array_rand($jabatanList)] ?? $jabatan_default,
        //         'prodi' => $prodiList[array_rand($prodiList)]
        //     ]);
        // }
    }
}