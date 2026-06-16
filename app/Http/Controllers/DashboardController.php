<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Jadwal;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user && $user->role === 'admin') {
            $stats = [
                'total_mahasiswa' => Mahasiswa::count(),
                'total_dosen' => Dosen::count(),
                'total_matkul' => MataKuliah::count(),
                'total_jadwal' => Jadwal::count(),
                'total_krs_aktif' => Krs::where('status', 'Aktif')->count(),
            ];
            return view('dashboard.admin', compact('stats'));
        } else {
            $mahasiswa = Auth::user()->mahasiswa;
            $krs = Krs::where('mahasiswa_id', $mahasiswa->id)
                      ->where('status', 'Aktif')
                      ->with('jadwal.mataKuliah')
                      ->get();
            $totalSks = $krs->sum(function($k) {
                return $k->jadwal->mataKuliah->sks;
            });
            return view('dashboard.mahasiswa', compact('mahasiswa', 'krs', 'totalSks'));
        }
    }
}