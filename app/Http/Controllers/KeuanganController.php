<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Keuangan::query();
    
        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('keterangan', 'like', '%'.$request->search.'%');
        }
        
        // Filter berdasarkan tahun (jika tidak kosong)
        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('tanggal', $request->tahun);
        }
        
        // Filter berdasarkan jenis (jika tidak kosong)
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis', $request->jenis);
        }
        
        // Data untuk tabel
        $keuangans = $query->orderBy('tanggal', 'desc')->paginate(10);
            
        // Data untuk chart
        $chartData = Keuangan::selectRaw('YEAR(tanggal) as tahun, 
            SUM(CASE WHEN jenis = "pemasukan" THEN jumlah ELSE 0 END) as pemasukan,
            SUM(CASE WHEN jenis = "pengeluaran" THEN jumlah ELSE 0 END) as pengeluaran')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();
        
        // Total pemasukan dan pengeluaran
        $totalPemasukan = Keuangan::where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Keuangan::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;
        
        // Daftar tahun unik untuk dropdown filter
        $tahunList = Keuangan::selectRaw('YEAR(tanggal) as tahun')
            ->groupBy('tahun')
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('keuangan.index', compact(
            'keuangans', 
            'totalPemasukan', 
            'totalPengeluaran', 
            'saldo', 
            'chartData',
            'tahunList'
        ));
    }

    public function create()
    {
        return view('keuangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        Keuangan::create($request->all());

        return redirect()->route('keuangan.index')
            ->with('success', 'Data keuangan berhasil ditambahkan');
    }

    public function edit(Keuangan $keuangan)
    {
        return view('keuangan.edit', compact('keuangan'));
    }

    public function update(Request $request, Keuangan $keuangan)
    {
        $request->validate([
            'keterangan' => 'required',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $keuangan->update($request->all());

        return redirect()->route('keuangan.index')
            ->with('success', 'Data keuangan berhasil diperbarui');
    }

    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();

        return redirect()->route('keuangan.index')
            ->with('success', 'Data keuangan berhasil dihapus');
    }
}