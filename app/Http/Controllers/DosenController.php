<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $query = Dosen::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nidn', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $dosens = $query->latest()->paginate(10);
        return view('admin.dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => 'required|unique:dosens|max:20',
            'nama_lengkap' => 'required|max:100',
            'email' => 'required|email|unique:dosens',
            'no_telepon' => 'nullable|max:15',
            'pendidikan_terakhir' => 'required|max:50',
            'bidang_keahlian' => 'required|max:100',
        ]);

        Dosen::create($validated);
        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil ditambahkan');
    }

    public function show(Dosen $dosen)
    {
        return view('admin.dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nidn' => ['required', 'max:20', Rule::unique('dosens')->ignore($dosen->id)],
            'nama_lengkap' => 'required|max:100',
            'email' => ['required', 'email', Rule::unique('dosens')->ignore($dosen->id)],
            'no_telepon' => 'nullable|max:15',
            'pendidikan_terakhir' => 'required|max:50',
            'bidang_keahlian' => 'required|max:100',
        ]);

        $dosen->update($validated);
        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diupdate');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil dihapus');
    }
}