@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-person-badge"></i> Detail Dosen</h5>
            <div>
                <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>NIDN</strong></td>
                            <td>: {{ $dosen->nidn }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nama Lengkap</strong></td>
                            <td>: {{ $dosen->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>: {{ $dosen->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>No Telepon</strong></td>
                            <td>: {{ $dosen->no_telepon ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Pendidikan Terakhir</strong></td>
                            <td>: {{ $dosen->pendidikan_terakhir }}</td>
                        </tr>
                        <tr>
                            <td><strong>Bidang Keahlian</strong></td>
                            <td>: {{ $dosen->bidang_keahlian }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Dibuat</strong></td>
                            <td>: {{ $dosen->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Terakhir Update</strong></td>
                            <td>: {{ $dosen->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <hr>
            <h6><i class="bi bi-calendar-week"></i> Jadwal Mengajar</h6>
            @if($dosen->jadwals->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Kelas</th>
                                <th>Ruangan</th>
                                <th>Tahun Akademik</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dosen->jadwals as $jadwal)
                            <tr>
                                <td>{{ $jadwal->mataKuliah->nama_mk }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                                <td>{{ $jadwal->kelas }}</td>
                                <td>{{ $jadwal->ruangan }}</td>
                                <td>{{ $jadwal->tahun_akademik }} ({{ $jadwal->semester }})</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Belum ada jadwal mengajar</p>
            @endif
        </div>
    </div>
</div>
@endsection