@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Admin</h2>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h6 class="card-title">Total Mahasiswa</h6>
                    <h2 class="mb-0">{{ $stats['total_mahasiswa'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h6 class="card-title">Total Dosen</h6>
                    <h2 class="mb-0">{{ $stats['total_dosen'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info h-100">
                <div class="card-body">
                    <h6 class="card-title">Total Mata Kuliah</h6>
                    <h2 class="mb-0">{{ $stats['total_matkul'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h6 class="card-title">Total Jadwal</h6>
                    <h2 class="mb-0">{{ $stats['total_jadwal'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h6 class="card-title">Total KRS Aktif</h6>
                    <h2 class="mb-0">{{ $stats['total_krs_aktif'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-list-check"></i> Menu Cepat</h5>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.mahasiswa.index') }}" class="text-decoration-none text-dark">
                        <div class="border p-4 rounded h-100">
                            <i class="bi bi-people fs-1"></i>
                            <p class="mt-2 mb-0">Data Mahasiswa</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.dosen.index') }}" class="text-decoration-none text-dark">
                        <div class="border p-4 rounded h-100">
                            <i class="bi bi-person-badge fs-1"></i>
                            <p class="mt-2 mb-0">Data Dosen</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.matakuliah.index') }}" class="text-decoration-none text-dark">
                        <div class="border p-4 rounded h-100">
                            <i class="bi bi-book fs-1"></i>
                            <p class="mt-2 mb-0">Data Mata Kuliah</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.jadwal.index') }}" class="text-decoration-none text-dark">
                        <div class="border p-4 rounded h-100">
                            <i class="bi bi-calendar-week fs-1"></i>
                            <p class="mt-2 mb-0">Data Jadwal</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
