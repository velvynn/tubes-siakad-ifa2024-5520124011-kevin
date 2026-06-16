@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-week"></i> Data Jadwal Perkuliahan</h2>
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal
        </a>
    </div>
    
    <!-- Search Form -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.jadwal.index') }}" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan mata kuliah atau dosen..." value="{{ request('search') }}">
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
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Kelas</th>
                            <th>Ruangan</th>
                            <th>Kuota</th>
                            <th>Terisi</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $index => $jadwal)
                        <tr>
                            <td>{{ $jadwals->firstItem() + $index }}</td>
                            <td>{{ $jadwal->mataKuliah->nama_mk }}<br><small class="text-muted">({{ $jadwal->mataKuliah->kode_mk }})</small></td>
                            <td>{{ $jadwal->dosen->nama_lengkap }}</td>
                            <td>{{ $jadwal->hari }}</td>
                            <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                            <td>{{ $jadwal->kelas }}</td>
                            <td>{{ $jadwal->ruangan }}</td>
                            <td>{{ $jadwal->kuota }}</td>
                            <td>
                                @php $terisi = $jadwal->krs()->where('status', 'Aktif')->count(); @endphp
                                <span class="badge bg-{{ $terisi >= $jadwal->kuota ? 'danger' : 'success' }}">
                                    {{ $terisi }}/{{ $jadwal->kuota }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.jadwal.show', $jadwal->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline delete-form">
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
                            <td colspan="10" class="text-center">Tidak ada data jadwal</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $jadwals->appends(request()->query())->links() }}
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            if(!confirm('Yakin ingin menghapus jadwal ini? Semua KRS yang terkait akan terhapus!')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
@endsection