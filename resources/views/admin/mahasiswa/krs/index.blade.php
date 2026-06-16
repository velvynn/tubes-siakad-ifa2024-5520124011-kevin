@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-card-list"></i> Kartu Rencana Studi (KRS)</h2>
        <div>
            <a href="{{ route('mahasiswa.krs.export.pdf') }}" class="btn btn-danger">
                <i class="bi bi-file-pdf"></i> Export PDF
            </a>
            <a href="{{ route('mahasiswa.krs.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Ambil Mata Kuliah
            </a>
        </div>
    </div>
    
    <div class="card mb-3">
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
        <div class="card-header bg-white">
            <h5 class="mb-0">Daftar Mata Kuliah yang Diambil</h5>
        </div>
        <div class="card-body">
            @if($krsList->count() > 0)
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
                            @foreach($krsList as $index => $krs)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $krs->jadwal->mataKuliah->kode_mk }}</td>
                                <td>{{ $krs->jadwal->mataKuliah->nama_mk }}</td>
                                <td>{{ $krs->jadwal->mataKuliah->sks }}</td>
                                <td>{{ $krs->jadwal->dosen->nama_lengkap }}</td>
                                <td>{{ $krs->jadwal->hari }}</td>
                                <td>{{ \Carbon\Carbon::parse($krs->jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($krs->jadwal->jam_selesai)->format('H:i') }}</td>
                                <td>{{ $krs->jadwal->ruangan }} (Kelas {{ $krs->jadwal->kelas }})</td>
                                <td>
                                    <form action="{{ route('mahasiswa.krs.destroy', $krs->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan mata kuliah ini?')">
                                            <i class="bi bi-trash"></i> Batal
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-secondary">
                            <tr>
                                <th colspan="3" class="text-end">Total SKS:</th>
                                <th colspan="6">{{ $totalSks }} SKS</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle fs-1 d-block"></i>
                    <p class="mt-2">Belum ada KRS. Silakan ambil mata kuliah terlebih dahulu.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection