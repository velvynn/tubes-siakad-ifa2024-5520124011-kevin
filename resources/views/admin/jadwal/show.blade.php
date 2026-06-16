@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Detail Jadwal Perkuliahan</h5>
            <div>
                <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Mata Kuliah</strong></td>
                            <td>: {{ $jadwal->mataKuliah->nama_mk }} ({{ $jadwal->mataKuliah->kode_mk }})</td>
                        </tr>
                        <tr>
                            <td><strong>SKS</strong></td>
                            <td>: {{ $jadwal->mataKuliah->sks }} SKS</td>
                        </tr>
                        <tr>
                            <td><strong>Dosen Pengajar</strong></td>
                            <td>: {{ $jadwal->dosen->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td><strong>Hari</strong></td>
                            <td>: {{ $jadwal->hari }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Jam</strong></td>
                            <td>: {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Kelas</strong></td>
                            <td>: {{ $jadwal->kelas }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ruangan</strong></td>
                            <td>: {{ $jadwal->ruangan }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tahun Akademik</strong></td>
                            <td>: {{ $jadwal->tahun_akademik }} ({{ $jadwal->semester }})</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-info">
                        <strong>Kuota Kelas:</strong> {{ $jadwal->kuota }} mahasiswa<br>
                        <strong>Terisi:</strong> {{ $jadwal->krs()->where('status', 'Aktif')->count() }} mahasiswa<br>
                        <strong>Sisa Kuota:</strong> {{ $jadwal->kuota_tersisa }} mahasiswa
                    </div>
                </div>
            </div>
            
            <h6><i class="bi bi-people"></i> Daftar Mahasiswa yang Mengambil</h6>
            @if($jadwal->mahasiswas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Program Studi</th>
                                <th>Status</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwal->mahasiswas as $index => $mhs)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mhs->npm }}</td>
                                <td>{{ $mhs->nama_lengkap }}</td>
                                <td>{{ $mhs->program_studi }}</td>
                                <td>
                                    <span class="badge bg-{{ $mhs->pivot->status == 'Aktif' ? 'success' : 'danger' }}">
                                        {{ $mhs->pivot->status }}
                                    </span>
                                </td>
                                <td>{{ $mhs->pivot->nilai ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Belum ada mahasiswa yang mengambil mata kuliah ini</p>
            @endif
        </div>
    </div>
</div>
@endsection