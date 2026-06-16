@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-book"></i> Detail Mata Kuliah</h5>
            <div>
                <a href="{{ route('admin.matakuliah.edit', $matakuliah->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.matakuliah.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Kode MK</strong></td>
                            <td>: {{ $matakuliah->kode_mk }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nama Mata Kuliah</strong></td>
                            <td>: {{ $matakuliah->nama_mk }}</td>
                        </tr>
                        <tr>
                            <td><strong>SKS</strong></td>
                            <td>: {{ $matakuliah->sks }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Semester</strong></td>
                            <td>: {{ $matakuliah->semester }}</td>
                        </tr>
                        <tr>
                            <td><strong>Deskripsi</strong></td>
                            <td>: {{ $matakuliah->deskripsi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jumlah Jadwal</strong></td>
                            <td>: {{ $matakuliah->jadwals->count() }} jadwal</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            @if($matakuliah->jadwals->count() > 0)
                <hr>
                <h6><i class="bi bi-calendar-week"></i> Jadwal Kuliah</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Ruangan</th>
                                <th>Tahun Akademik</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($matakuliah->jadwals as $jadwal)
                            <tr>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                                <td>{{ $jadwal->dosen->nama_lengkap }}</td>
                                <td>{{ $jadwal->kelas }}</td>
                                <td>{{ $jadwal->ruangan }}</td>
                                <td>{{ $jadwal->tahun_akademik }} ({{ $jadwal->semester }})</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection