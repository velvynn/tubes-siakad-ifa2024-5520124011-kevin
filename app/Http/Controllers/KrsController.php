<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
    // Mahasiswa: Lihat KRS sendiri
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $krsList = Krs::where('mahasiswa_id', $mahasiswa->id)
                      ->with('jadwal.mataKuliah', 'jadwal.dosen')
                      ->latest()
                      ->get();
        
        $totalSks = $krsList->sum(function($k) {
            return $k->jadwal->mataKuliah->sks;
        });
        
        return view('mahasiswa.krs.index', compact('krsList', 'mahasiswa', 'totalSks'));
    }
    
    // Mahasiswa: Form ambil KRS
    public function create()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        
        // Get available schedules not already taken by student
        $existingJadwalIds = Krs::where('mahasiswa_id', $mahasiswa->id)
                                ->where('status', 'Aktif')
                                ->pluck('jadwal_id')
                                ->toArray();
        
        $jadwals = Jadwal::with(['mataKuliah', 'dosen'])
                         ->whereNotIn('id', $existingJadwalIds)
                         ->where('tahun_akademik', '2024/2025')
                         ->where('semester', 'Ganjil')
                         ->get();
        
        return view('mahasiswa.krs.create', compact('jadwals', 'mahasiswa'));
    }
    
    // Mahasiswa: Simpan KRS
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
        ]);
        
        $mahasiswa = Auth::user()->mahasiswa;
        $jadwal = Jadwal::find($validated['jadwal_id']);
        
        // Check if already taken
        $exists = Krs::where('mahasiswa_id', $mahasiswa->id)
                     ->where('jadwal_id', $validated['jadwal_id'])
                     ->exists();
        
        if ($exists) {
            return back()->with('error', 'Mata kuliah sudah diambil!');
        }
        
        // Check quota
        $quotaTersisa = $jadwal->kuota - $jadwal->krs()->where('status', 'Aktif')->count();
        if ($quotaTersisa <= 0) {
            return back()->with('error', 'Kuota kelas sudah penuh!');
        }
        
        Krs::create([
            'mahasiswa_id' => $mahasiswa->id,
            'jadwal_id' => $validated['jadwal_id'],
            'status' => 'Aktif',
            'tahun_akademik' => $jadwal->tahun_akademik,
            'semester' => $jadwal->semester,
        ]);
        
        return redirect()->route('mahasiswa.krs.index')->with('success', 'Mata kuliah berhasil ditambahkan ke KRS');
    }
    
    // Mahasiswa: Hapus KRS (drop mata kuliah)
    public function destroy(Krs $krs)
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403);
        }
        
        if ($user->role === 'admin') {
            $krs->delete();
            return redirect()->route('admin.krs.index')->with('success', 'Mata kuliah berhasil dihapus dari KRS');
        }
        
        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa || $krs->mahasiswa_id != $mahasiswa->id) {
            abort(403);
        }
        
        $krs->delete();
        return redirect()->route('mahasiswa.krs.index')->with('success', 'Mata kuliah berhasil dihapus dari KRS');
    }
    
    // Mahasiswa: Export KRS ke PDF
    public function exportPdf()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $krsList = Krs::where('mahasiswa_id', $mahasiswa->id)
                      ->with('jadwal.mataKuliah', 'jadwal.dosen')
                      ->get();
        
        $totalSks = $krsList->sum(function($k) {
            return $k->jadwal->mataKuliah->sks;
        });
        
        $pdf = Pdf::loadView('mahasiswa.krs.pdf', compact('krsList', 'mahasiswa', 'totalSks'));
        return $pdf->download('KRS_' . $mahasiswa->npm . '.pdf');
    }

    public function exportCsv(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $krsList = Krs::where('mahasiswa_id', $mahasiswa->id)
                      ->with('jadwal.mataKuliah', 'jadwal.dosen')
                      ->get();

        $filename = 'KRS_' . $mahasiswa->npm . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $columns = ['NPM', 'Nama Mahasiswa', 'Mata Kuliah', 'SKS', 'Dosen', 'Status', 'Tahun Akademik', 'Semester'];

        $callback = function () use ($krsList, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($krsList as $krs) {
                fputcsv($file, [
                    $krs->mahasiswa->npm,
                    $krs->mahasiswa->nama_lengkap,
                    $krs->jadwal->mataKuliah->nama_mk,
                    $krs->jadwal->mataKuliah->sks,
                    $krs->jadwal->dosen->nama_lengkap,
                    $krs->status,
                    $krs->tahun_akademik,
                    $krs->semester,
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

    // Mahasiswa: Export KRS ke Excel
    public function exportExcel(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $krsList = Krs::where('mahasiswa_id', $mahasiswa->id)
                      ->with('jadwal.mataKuliah', 'jadwal.dosen')
                      ->get();

        $filename = 'KRS_' . $mahasiswa->npm . '.xls';

        $headers = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $columns = ['NPM', 'Nama Mahasiswa', 'Mata Kuliah', 'SKS', 'Dosen', 'Status', 'Tahun Akademik', 'Semester'];

        $callback = function () use ($krsList, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns, "\t");

            foreach ($krsList as $krs) {
                fputcsv($file, [
                    $krs->mahasiswa->npm,
                    $krs->mahasiswa->nama_lengkap,
                    $krs->jadwal->mataKuliah->nama_mk,
                    $krs->jadwal->mataKuliah->sks,
                    $krs->jadwal->dosen->nama_lengkap,
                    $krs->status,
                    $krs->tahun_akademik,
                    $krs->semester,
                ], "\t");
            }

            fclose($file);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

    // Admin: Export KRS ke CSV
    public function adminExportCsv(Request $request)
    {
        $query = Krs::with(['mahasiswa', 'jadwal.mataKuliah', 'jadwal.dosen']);

        if ($request->has('mahasiswa_id') && $request->mahasiswa_id) {
            $query->where('mahasiswa_id', $request->mahasiswa_id);
        }

        $krsList = $query->get();

        $filename = 'KRS_Admin_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $columns = ['NPM', 'Nama Mahasiswa', 'Mata Kuliah', 'SKS', 'Dosen', 'Status', 'Tahun Akademik', 'Semester'];

        $callback = function () use ($krsList, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($krsList as $krs) {
                fputcsv($file, [
                    $krs->mahasiswa->npm,
                    $krs->mahasiswa->nama_lengkap,
                    $krs->jadwal->mataKuliah->nama_mk,
                    $krs->jadwal->mataKuliah->sks,
                    $krs->jadwal->dosen->nama_lengkap,
                    $krs->status,
                    $krs->tahun_akademik,
                    $krs->semester,
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

    // Admin: Export KRS ke Excel
    public function adminExportExcel(Request $request)
    {
        $query = Krs::with(['mahasiswa', 'jadwal.mataKuliah', 'jadwal.dosen']);

        if ($request->has('mahasiswa_id') && $request->mahasiswa_id) {
            $query->where('mahasiswa_id', $request->mahasiswa_id);
        }

        $krsList = $query->get();

        $filename = 'KRS_Admin_' . now()->format('Ymd_His') . '.xls';

        $headers = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $columns = ['NPM', 'Nama Mahasiswa', 'Mata Kuliah', 'SKS', 'Dosen', 'Status', 'Tahun Akademik', 'Semester'];

        $callback = function () use ($krsList, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns, "\t");

            foreach ($krsList as $krs) {
                fputcsv($file, [
                    $krs->mahasiswa->npm,
                    $krs->mahasiswa->nama_lengkap,
                    $krs->jadwal->mataKuliah->nama_mk,
                    $krs->jadwal->mataKuliah->sks,
                    $krs->jadwal->dosen->nama_lengkap,
                    $krs->status,
                    $krs->tahun_akademik,
                    $krs->semester,
                ], "\t");
            }

            fclose($file);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

    // Admin: Export KRS ke PDF
    public function adminExportPdf(Request $request)
    {
        $query = Krs::with(['mahasiswa', 'jadwal.mataKuliah', 'jadwal.dosen']);

        $selectedMahasiswa = null;
        if ($request->has('mahasiswa_id') && $request->mahasiswa_id) {
            $query->where('mahasiswa_id', $request->mahasiswa_id);
            $selectedMahasiswa = Mahasiswa::find($request->mahasiswa_id);
        }

        $krsList = $query->get();
        $filename = 'KRS_Admin_' . now()->format('Ymd_His') . '.pdf';

        $pdf = Pdf::loadView('admin.krs.pdf', compact('krsList', 'selectedMahasiswa'));
        return $pdf->download($filename);
    }

    // Mahasiswa: Lihat jadwal
    public function jadwalSaya()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $krsList = Krs::where('mahasiswa_id', $mahasiswa->id)
                      ->where('status', 'Aktif')
                      ->with('jadwal.mataKuliah', 'jadwal.dosen')
                      ->get();
        
        return view('mahasiswa.jadwal.index', compact('krsList'));
    }
    
    // Admin: Lihat semua KRS
    public function adminIndex(Request $request)
    {
        $query = Krs::with(['mahasiswa', 'jadwal.mataKuliah', 'jadwal.dosen']);
        
        if ($request->has('mahasiswa_id') && $request->mahasiswa_id) {
            $query->where('mahasiswa_id', $request->mahasiswa_id);
        }
        
        $krsList = $query->latest()->paginate(15);
        $mahasiswas = Mahasiswa::all();
        
        return view('admin.krs.index', compact('krsList', 'mahasiswas'));
    }
}