<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $query = Dosen::query();
        
        // Filter berdasarkan prodi
        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('prodi', $request->prodi);
        }
        
        // Pencarian berdasarkan nama, nidn, atau jabatan
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%'.$search.'%')
                  ->orWhere('nidn', 'like', '%'.$search.'%')
                  ->orWhere('jabatan', 'like', '%'.$search.'%');
            });
        }
        
        $dosens = $query->paginate(10);
        
        // Data untuk chart
        $chartData = Dosen::selectRaw('YEAR(created_at) as tahun, COUNT(*) as total')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();
        
        // Data untuk filter prodi
        $prodiList = Dosen::select('prodi')->distinct()->orderBy('prodi')->pluck('prodi');
        
        return view('dosen.index', compact('dosens', 'chartData', 'prodiList'));
    }

    public function create()
    {
        $prodiList = ['Ilmu Hukum', 'Hukum Bisnis', 'Hukum Internasional'];
        return view('dosen.create', compact('prodiList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nidn' => 'required|unique:dosens|digits:10',
            'jabatan' => 'nullable',
            'prodi' => 'required'
        ]);

        Dosen::create([
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'jabatan' => $request->jabatan ?? 'Staf', // Default value
            'prodi' => $request->prodi
        ]);

        return redirect()->route('dosen.index')
            ->with('success', 'Dosen berhasil ditambahkan');
    }

    public function edit(Dosen $dosen)
    {
        $prodiList = ['Ilmu Hukum', 'Hukum Bisnis', 'Hukum Internasional'];
        return view('dosen.edit', compact('dosen', 'prodiList'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama' => 'required',
            'nidn' => 'required|digits:10|unique:dosens,nidn,'.$dosen->id,
            'jabatan' => 'nullable',
            'prodi' => 'required'
        ]);

        $dosen->update([
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'jabatan' => $request->jabatan ?? 'Staf',
            'prodi' => $request->prodi
        ]);

        return redirect()->route('dosen.index')
            ->with('success', 'Dosen berhasil diperbarui');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()->route('dosen.index')
            ->with('success', 'Dosen berhasil dihapus');
    }
}