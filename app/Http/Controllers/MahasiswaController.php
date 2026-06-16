<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::query();
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
        }
        
        $mahasiswas = $query->latest()->paginate(10);
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm' => 'required|unique:mahasiswas|max:15',
            'nama_lengkap' => 'required|max:100',
            'email' => 'required|email|unique:mahasiswas',
            'no_telepon' => 'nullable|max:15',
            'program_studi' => 'required|max:50',
            'semester' => 'required|integer|min:1|max:14',
            'tahun_masuk' => 'required|integer|min:2000|max:' . date('Y'),
            'alamat' => 'nullable',
        ]);

        Mahasiswa::create($validated);
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $krs = $mahasiswa->krs()->with('jadwal.mataKuliah')->get();
        return view('admin.mahasiswa.show', compact('mahasiswa', 'krs'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'npm' => ['required', 'max:15', Rule::unique('mahasiswas')->ignore($mahasiswa->id)],
            'nama_lengkap' => 'required|max:100',
            'email' => ['required', 'email', Rule::unique('mahasiswas')->ignore($mahasiswa->id)],
            'no_telepon' => 'nullable|max:15',
            'program_studi' => 'required|max:50',
            'semester' => 'required|integer|min:1|max:14',
            'tahun_masuk' => 'required|integer|min:2000|max:' . date('Y'),
            'alamat' => 'nullable',
        ]);

        $mahasiswa->update($validated);
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}