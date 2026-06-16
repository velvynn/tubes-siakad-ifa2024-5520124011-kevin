@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4"><i class="bi bi-card-list"></i> Manajemen KRS</h2>
    
    <!-- Filter Form -->
    <div class="card mb-3">
        <div class="card-body">
            <p class="text-muted mb-3">Gunakan fitur export untuk mengunduh daftar KRS. Export akan mengekspor data yang sedang difilter.</p>
            <form method="GET" action="{{ route('admin.krs.index') }}" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Filter Mahasiswa</label>
                    <select name="mahasiswa_id" class="form-control" onchange="this.form.submit()">
                        <option value="">Semua Mahasiswa</option>
                        @foreach($mahasiswas as $mhs)
                            <option value="{{ $mhs->id }}" {{ request('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>
                                {{ $mhs->npm }} - {{ $mhs->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-end justify-content-end gap-2">
                    <a href="{{ route('admin.krs.index') }}" class="btn btn-secondary">Reset Filter</a>
                    <a href="{{ route('admin.krs.export.pdf', request()->only('mahasiswa_id')) }}" class="btn btn-danger" onclick="return confirm('Unduh daftar KRS dalam format PDF?')">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                    </a>
                    <a href="{{ route('admin.krs.export.csv', request()->only('mahasiswa_id')) }}" class="btn btn-success" onclick="return confirm('Unduh daftar KRS dalam format CSV?')">
                        <i class="bi bi-file-earmark-spreadsheet"></i> Export CSV
                    </a>
                    <a href="{{ route('admin.krs.export.excel', request()->only('mahasiswa_id')) }}" class="btn btn-secondary" onclick="return confirm('Unduh daftar KRS dalam format Excel?')">
                        <i class="bi bi-file-earmark-excel"></i> Export Excel
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>NPM</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Dosen</th>
                            <th>Status</th>
                            <th>Nilai</th>
                            <th>Tahun Akademik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($krsList as $index => $krs)
                        <tr>
                            <td>{{ $krsList->firstItem() + $index }}</td>
                            <td>{{ $krs->mahasiswa->nama_lengkap }}</td>
                            <td>{{ $krs->mahasiswa->npm }}</td>
                            <td>{{ $krs->jadwal->mataKuliah->nama_mk }} <br><small>({{ $krs->jadwal->mataKuliah->kode_mk }})</small></td>
                            <td>{{ $krs->jadwal->mataKuliah->sks }}</td>
                            <td>{{ $krs->jadwal->dosen->nama_lengkap }}</td>
                            <td>
                                <span class="badge bg-{{ $krs->status == 'Aktif' ? 'success' : ($krs->status == 'Batal' ? 'danger' : 'secondary') }}">
                                    {{ $krs->status }}
                                </span>
                            </td>
                            <td>{{ $krs->nilai ?? '-' }}</td>
                            <td>{{ $krs->tahun_akademik }} ({{ $krs->semester }})</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data KRS</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $krsList->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection