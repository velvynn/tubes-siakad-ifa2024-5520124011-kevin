@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2><i class="bi bi-journal-plus"></i> Ambil Mata Kuliah</h2>
            <p class="text-muted mb-0">Pilih jadwal perkuliahan untuk ditambahkan ke KRS.</p>
        </div>
        <a href="{{ route('mahasiswa.krs.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke KRS
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <small class="text-muted">Nama Mahasiswa</small>
                    <h6>{{ $mahasiswa->nama_lengkap }}</h6>
                </div>
                <div class="col-md-3">
                    <small class="text-muted">NPM</small>
                    <h6>{{ $mahasiswa->npm }}</h6>
                </div>
                <div class="col-md-3">
                    <small class="text-muted">Program Studi</small>
                    <h6>{{ $mahasiswa->program_studi }}</h6>
                </div>
                <div class="col-md-3">
                    <small class="text-muted">Semester</small>
                    <h6>{{ $mahasiswa->semester }}</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($jadwals->count() > 0)
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
                                <th>Ruangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwals as $index => $jadwal)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $jadwal->mataKuliah->kode_mk }}</td>
                                <td>{{ $jadwal->mataKuliah->nama_mk }}</td>
                                <td>{{ $jadwal->mataKuliah->sks }}</td>
                                <td>{{ $jadwal->dosen->nama_lengkap }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                                <td>{{ $jadwal->ruangan }} (Kelas {{ $jadwal->kelas }})</td>
                                <td>
                                    <form action="{{ route('mahasiswa.krs.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="bi bi-plus-circle"></i> Ambil
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle fs-1 d-block"></i>
                    <p class="mt-2">Semua jadwal sudah diambil atau belum ada jadwal tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
