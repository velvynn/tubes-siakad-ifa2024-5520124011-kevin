@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Mahasiswa</h2>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-title">Nama</h6>
                    <h4 class="mb-0">{{ $mahasiswa->nama_lengkap }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-title">NPM</h6>
                    <h4 class="mb-0">{{ $mahasiswa->npm }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-title">Program Studi</h6>
                    <h4 class="mb-0">{{ $mahasiswa->program_studi }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h6 class="card-title">Total SKS</h6>
                    <h2 class="mb-0">{{ $totalSks }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h6 class="card-title">KRS Aktif</h6>
                    <h2 class="mb-0">{{ $krs->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-list-check"></i> Aksi Mahasiswa</h5>
            <div>
                <a href="{{ route('mahasiswa.krs.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-card-list"></i> Lihat KRS
                </a>
                <a href="{{ route('mahasiswa.jadwal.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-calendar-week"></i> Lihat Jadwal
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($krs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Dosen</th>
                                <th>Hari</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($krs as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->jadwal->mataKuliah->kode_mk }}</td>
                                <td>{{ $item->jadwal->mataKuliah->nama_mk }}</td>
                                <td>{{ $item->jadwal->mataKuliah->sks }}</td>
                                <td>{{ $item->jadwal->dosen->nama_lengkap }}</td>
                                <td>{{ $item->jadwal->hari }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jadwal->jam_selesai)->format('H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle fs-1 d-block"></i>
                    <p class="mt-2">Belum ada KRS aktif. Silakan ambil mata kuliah.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
