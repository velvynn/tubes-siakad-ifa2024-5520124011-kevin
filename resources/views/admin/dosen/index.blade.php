@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-person-badge"></i> Data Dosen</h2>
        <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Dosen
        </a>
    </div>

    <!-- Search Form -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.dosen.index') }}" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan NIDN, nama, atau email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
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
                            <th>NIDN</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Pendidikan</th>
                            <th>Bidang Keahlian</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dosens as $index => $dosen)
                        <tr>
                            <td>{{ $dosens->firstItem() + $index }}</td>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->nama_lengkap }}</td>
                            <td>{{ $dosen->email }}</td>
                            <td>{{ $dosen->no_telepon ?? '-' }}</td>
                            <td>{{ $dosen->pendidikan_terakhir }}</td>
                            <td>{{ $dosen->bidang_keahlian }}</td>
                            <td>
                                <a href="{{ route('admin.dosen.show', $dosen->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data dosen</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $dosens->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
