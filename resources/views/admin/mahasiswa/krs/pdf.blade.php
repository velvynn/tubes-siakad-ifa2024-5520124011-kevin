<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KRS - {{ $mahasiswa->nama_lengkap }}</title>
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
        .total {
            font-weight: bold;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>KARTU RENCANA STUDI (KRS)</h1>
        <p>Semester Ganjil Tahun Akademik 2024/2025</p>
    </div>
    
    <div class="info">
        <table>
            <tr>
                <td width="30%"><strong>Nama Mahasiswa</strong></td>
                <td>: {{ $mahasiswa->nama_lengkap }}</td>
            </tr>
            <tr>
                <td><strong>NPM</strong></td>
                <td>: {{ $mahasiswa->npm }}</td>
            </tr>
            <tr>
                <td><strong>Program Studi</strong></td>
                <td>: {{ $mahasiswa->program_studi }}</td>
            </tr>
            <tr>
                <td><strong>Semester</strong></td>
                <td>: {{ $mahasiswa->semester }}</td>
            </tr>
        </table>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Dosen</th>
                <th>Jadwal</th>
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
                <td>{{ $krs->jadwal->hari }}, {{ \Carbon\Carbon::parse($krs->jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($krs->jadwal->jam_selesai)->format('H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total">
                <th colspan="3">Total SKS:</th>
                <th colspan="3">{{ $totalSks }} SKS</th>
            </tr>
        </tfoot>
    </table>
    
    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        <p>Sistem Informasi Akademik - Tugas Besar Web II</p>
    </div>
</body>
</html>
