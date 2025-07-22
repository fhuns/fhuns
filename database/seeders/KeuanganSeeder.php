<?php

namespace Database\Seeders;

use App\Models\Keuangan;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KeuanganSeeder extends Seeder
{
    public function run()
    {
        // ===== KONFIGURASI =====
        $tahun_aktif = 2023; // Tahun untuk data keuangan
        
        // ===== DATA KEUANGAN =====
        $data = [
            // Format: ['keterangan', 'jenis', 'jumlah', 'tanggal (opsional)']
            // Pemasukan
            ['Uang Kuliah Semester Ganjil', 'pemasukan', 250000000, '01-09-'.$tahun_aktif],
            ['Donasi Yayasan', 'pemasukan', 50000000],
            
            // Pengeluaran
            ['Gaji Dosen Bulan Januari', 'pengeluaran', 120000000, '05-01-'.$tahun_aktif],
            ['Pembangunan Ruang Kelas', 'pengeluaran', 350000000],
            // Tambahkan data di bawah ini:
            
            
            
        ];

        // ===== PROSES INPUT =====
        foreach ($data as $transaksi) {
            $tanggal = isset($transaksi[3]) 
                ? Carbon::createFromFormat('d-m-Y', $transaksi[3])
                : now()->subDays(rand(1, 365));
            
            Keuangan::create([
                'keterangan' => $transaksi[0],
                'jenis' => $transaksi[1],
                'jumlah' => $transaksi[2],
                'tanggal' => $tanggal
            ]);
        }
    }
}