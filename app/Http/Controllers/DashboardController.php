<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Keuangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // app/Http/Controllers/DashboardController.php
public function index()
{
    $totalMahasiswa = Mahasiswa::count();
    $totalDosen = Dosen::count();
    $totalKeuangan = Keuangan::sum('jumlah');      
    $totalPemasukan = Keuangan::where('jenis', 'pemasukan')->sum('jumlah');
    $totalPengeluaran = Keuangan::where('jenis', 'pengeluaran')->sum('jumlah');
    $saldo = $totalPemasukan - $totalPengeluaran;
    $pieData = [
        'labels' => ['Mahasiswa', 'Dosen'],
        'data' => [$totalMahasiswa, $totalDosen],
        'colors' => ['#EF4444', '#3B82F6']
    ];
    
    return view('dashboard', compact('totalMahasiswa', 'totalDosen', 'totalKeuangan', 'pieData', 'saldo'));
}
}