@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-week"></i> Jadwal Kuliah</h2>
        <a href="{{ route('mahasiswa.krs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ambil Mata Kuliah
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($krsList->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Dosen</th>
                                <th>Ruangan</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($krsList->sortBy(function($krs) {
                                $hariOrder = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6];
                                return $hariOrder[$krs->jadwal->hari] . $krs->jadwal->jam_mulai;
                            }) as $krs)
                            <tr>
                                <td>{{ $krs->jadwal->hari }}</td>
                                <td>{{ \Carbon\Carbon::parse($krs->jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($krs->jadwal->jam_selesai)->format('H:i') }}</td>
                                <td>{{ $krs->jadwal->mataKuliah->kode_mk }}</td>
                                <td>{{ $krs->jadwal->mataKuliah->nama_mk }}</td>
                                <td>{{ $krs->jadwal->mataKuliah->sks }}</td>
                                <td>{{ $krs->jadwal->dosen->nama_lengkap }}</td>
                                <td>{{ $krs->jadwal->ruangan }}</td>
                                <td>Kelas {{ $krs->jadwal->kelas }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle fs-1 d-block"></i>
                    <p class="mt-2">Belum ada jadwal. Silakan ambil mata kuliah terlebih dahulu.</p>
                    <a href="{{ route('mahasiswa.krs.create') }}" class="btn btn-primary mt-2">
                        <i class="bi bi-plus-circle"></i> Ambil Mata Kuliah
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
