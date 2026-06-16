@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-person-badge"></i> Detail Mahasiswa</h5>
            <div>
                <a href="{{ route('admin.krs.index') }}?mahasiswa_id={{ $mahasiswa->id }}" class="btn btn-info btn-sm">
                    <i class="bi bi-card-list"></i> Lihat KRS
                </a>
                <a href="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>NPM</strong></td>
                            <td>: {{ $mahasiswa->npm }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nama Lengkap</strong></td>
                            <td>: {{ $mahasiswa->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>: {{ $mahasiswa->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>No Telepon</strong></td>
                            <td>: {{ $mahasiswa->no_telepon ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Program Studi</strong></td>
                            <td>: {{ $mahasiswa->program_studi }}</td>
                        </tr>
                        <tr>
                            <td><strong>Semester</strong></td>
                            <td>: {{ $mahasiswa->semester }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tahun Masuk</strong></td>
                            <td>: {{ $mahasiswa->tahun_masuk }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>: {{ $mahasiswa->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <hr>
            <h6><i class="bi bi-card-list"></i> Kartu Rencana Studi (KRS)</h6>
            @if($krs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Dosen</th>
                                <th>Jadwal</th>
                                <th>Status</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($krs as $item)
                            <tr>
                                <td>{{ $item->jadwal->mataKuliah->kode_mk }}</td>
                                <td>{{ $item->jadwal->mataKuliah->nama_mk }}</td>
                                <td>{{ $item->jadwal->mataKuliah->sks }}</td>
                                <td>{{ $item->jadwal->dosen->nama_lengkap }}</td>
                                <td>{{ $item->jadwal->hari }}, {{ \Carbon\Carbon::parse($item->jadwal->jam_mulai)->format('H:i') }}</td>
                                <td>
                                    <span class="badge bg-{{ $item->status == 'Aktif' ? 'success' : ($item->status == 'Batal' ? 'danger' : 'secondary') }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>{{ $item->nilai ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-end">Total SKS:</th>
                                <th colspan="5">{{ $krs->sum(fn($k) => $k->jadwal->mataKuliah->sks) }} SKS</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <p class="text-muted">Belum ada KRS</p>
            @endif
        </div>
    </div>
</div>
@endsection