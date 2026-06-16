<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = MataKuliah::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('nama_mk', 'like', "%{$search}%")
                  ->orWhere('kode_mk', 'like', "%{$search}%");
        }

        $mataKuliahs = $query->latest()->paginate(10);
        return view('admin.matakuliah.index', compact('mataKuliahs'));
    }

    public function create()
    {
        return view('admin.matakuliah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mk' => 'required|unique:mata_kuliahs|max:10',
            'nama_mk' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'deskripsi' => 'nullable',
        ]);

        MataKuliah::create($validated);
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan');
    }

    public function show(MataKuliah $matakuliah)
    {
        return view('admin.matakuliah.show', compact('matakuliah'));
    }

    public function edit(MataKuliah $matakuliah)
    {
        return view('admin.matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, MataKuliah $matakuliah)
    {
        $validated = $request->validate([
            'kode_mk' => ['required', 'max:10', Rule::unique('mata_kuliahs')->ignore($matakuliah->id)],
            'nama_mk' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'deskripsi' => 'nullable',
        ]);

        $matakuliah->update($validated);
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil diupdate');
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus');
    }
}