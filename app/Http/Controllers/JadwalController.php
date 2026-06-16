<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(['dosen', 'mataKuliah']);
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('mataKuliah', function($q) use ($search) {
                $q->where('nama_mk', 'like', "%{$search}%");
            })->orWhereHas('dosen', function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%");
            });
        }
        
        $jadwals = $query->latest()->paginate(10);
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        $mataKuliahs = MataKuliah::all();
        return view('admin.jadwal.create', compact('dosens', 'mataKuliahs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kelas' => 'required|max:10',
            'ruangan' => 'required|max:50',
            'tahun_akademik' => 'required|max:20',
            'semester' => 'required|in:Ganjil,Genap',
            'kuota' => 'required|integer|min:1|max:100',
        ]);

        Jadwal::create($validated);
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function show(Jadwal $jadwal)
    {
        $jadwal->load(['dosen', 'mataKuliah', 'mahasiswas']);
        return view('admin.jadwal.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        $dosens = Dosen::all();
        $mataKuliahs = MataKuliah::all();
        return view('admin.jadwal.edit', compact('jadwal', 'dosens', 'mataKuliahs'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kelas' => 'required|max:10',
            'ruangan' => 'required|max:50',
            'tahun_akademik' => 'required|max:20',
            'semester' => 'required|in:Ganjil,Genap',
            'kuota' => 'required|integer|min:1|max:100',
        ]);

        $jadwal->update($validated);
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}