<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daftar KRS Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0;
        }
        .info {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .info table {
            width: 100%;
        }
        .info td {
            padding: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Daftar KRS Mahasiswa</h1>
        <p>Export PDF Admin</p>
    </div>

    @if($selectedMahasiswa)
        <div class="info">
            <table>
                <tr>
                    <td width="30%"><strong>Filter Mahasiswa</strong></td>
                    <td>: {{ $selectedMahasiswa->npm }} - {{ $selectedMahasiswa->nama_lengkap }}</td>
                </tr>
            </table>
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Dosen</th>
                <th>Status</th>
                <th>Tahun Akademik</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
            @foreach($krsList as $index => $krs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $krs->mahasiswa->npm }}</td>
                <td>{{ $krs->mahasiswa->nama_lengkap }}</td>
                <td>{{ $krs->jadwal->mataKuliah->kode_mk }}</td>
                <td>{{ $krs->jadwal->mataKuliah->nama_mk }}</td>
                <td>{{ $krs->jadwal->mataKuliah->sks }}</td>
                <td>{{ $krs->jadwal->dosen->nama_lengkap }}</td>
                <td>{{ $krs->status }}</td>
                <td>{{ $krs->tahun_akademik }}</td>
                <td>{{ $krs->semester }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        <p>Sistem Informasi Akademik - Tugas Besar Web II</p>
    </div>
</body>
</html>
