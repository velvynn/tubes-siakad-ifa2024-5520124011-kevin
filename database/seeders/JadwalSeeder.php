<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        Jadwal::create([
            'dosen_id' => 1,
            'mata_kuliah_id' => 1,
            'hari' => 'Senin',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:30:00',
            'kelas' => 'A',
            'ruangan' => 'R. 201',
            'tahun_akademik' => '2024/2025',
            'semester' => 'Ganjil',
            'kuota' => 40
        ]);
        
        Jadwal::create([
            'dosen_id' => 3,
            'mata_kuliah_id' => 2,
            'hari' => 'Selasa',
            'jam_mulai' => '10:30:00',
            'jam_selesai' => '13:00:00',
            'kelas' => 'B',
            'ruangan' => 'R. 202',
            'tahun_akademik' => '2024/2025',
            'semester' => 'Ganjil',
            'kuota' => 35
        ]);
        
        Jadwal::create([
            'dosen_id' => 2,
            'mata_kuliah_id' => 3,
            'hari' => 'Rabu',
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '15:30:00',
            'kelas' => 'A',
            'ruangan' => 'Lab. Komputer',
            'tahun_akademik' => '2024/2025',
            'semester' => 'Ganjil',
            'kuota' => 30
        ]);
        
        Jadwal::create([
            'dosen_id' => 1,
            'mata_kuliah_id' => 5,
            'hari' => 'Kamis',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:30:00',
            'kelas' => 'A',
            'ruangan' => 'R. 203',
            'tahun_akademik' => '2024/2025',
            'semester' => 'Ganjil',
            'kuota' => 40
        ]);
    }
}