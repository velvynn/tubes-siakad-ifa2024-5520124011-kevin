@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-book"></i> Data Mata Kuliah</h2>
        <a href="{{ route('admin.matakuliah.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
        </a>
    </div>
    
    <!-- Search Form -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.matakuliah.index') }}" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan kode atau nama mata kuliah..." value="{{ request('search') }}">
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
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Semester</th>
                            <th>Deskripsi</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mataKuliahs as $index => $matkul)
                        <tr>
                            <td>{{ $mataKuliahs->firstItem() + $index }}</td>
                            <td>{{ $matkul->kode_mk }}</td>
                            <td>{{ $matkul->nama_mk }}</td>
                            <td>{{ $matkul->sks }}</td>
                            <td>{{ $matkul->semester }}</td>
                            <td>{{ Str::limit($matkul->deskripsi, 50) }}</td>
                            <td>
                                <a href="{{ route('admin.matakuliah.show', $matkul->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.matakuliah.edit', $matkul->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.matakuliah.destroy', $matkul->id) }}" method="POST" class="d-inline delete-form">
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
                            <td colspan="7" class="text-center">Tidak ada data mata kuliah</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $mataKuliahs->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection