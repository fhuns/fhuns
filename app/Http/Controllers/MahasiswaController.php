<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::query();
        
        // Filter by angkatan if provided
        if ($request->has('angkatan') && $request->angkatan != '') {
            $query->where('angkatan', $request->angkatan);
        }
        
        // Filter by prodi if provided
        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('prodi', $request->prodi);
        }
        
        // Search by name or NIM
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%'.$search.'%')
                ->orWhere('nim', 'like', '%'.$search.'%');
            });
        }
        
        $mahasiswas = $query->paginate(10);
        
        // Get distinct values for filters
        $angkatanList = Mahasiswa::select('angkatan')->distinct()->orderBy('angkatan', 'desc')->pluck('angkatan');
        $prodiList = Mahasiswa::select('prodi')->distinct()->orderBy('prodi')->pluck('prodi');
        
        // Chart data (unchanged)
        $chartData = Mahasiswa::select('tahun', DB::raw('COUNT(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();
        
        return view('mahasiswa.index', compact('mahasiswas', 'chartData', 'angkatanList', 'prodiList'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim'
        ]);
        
        Mahasiswa::create($request->all());
        
        // Redirect ke halaman lain setelah sukses
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim,'.$mahasiswa->id,
            'angkatan' => 'required|numeric',
            'prodi' => 'required',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil dihapus');
    }
}