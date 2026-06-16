<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        Dosen::create([
            'nidn' => '0012018001',
            'nama_lengkap' => 'Dr. Ahmad Sulaiman, M.Kom',
            'email' => 'ahmad.sulaiman@univ.ac.id',
            'no_telepon' => '081234567890',
            'pendidikan_terakhir' => 'S3 Ilmu Komputer',
            'bidang_keahlian' => 'Artificial Intelligence'
        ]);
        
        Dosen::create([
            'nidn' => '0012018002',
            'nama_lengkap' => 'Dr. Siti Rohmah, M.T',
            'email' => 'siti.rohmah@univ.ac.id',
            'no_telepon' => '081234567891',
            'pendidikan_terakhir' => 'S3 Teknik Elektro',
            'bidang_keahlian' => 'Jaringan Komputer'
        ]);
        
        Dosen::create([
            'nidn' => '0012018003',
            'nama_lengkap' => 'Budi Santoso, M.Kom',
            'email' => 'budi.santoso@univ.ac.id',
            'no_telepon' => '081234567892',
            'pendidikan_terakhir' => 'S2 Ilmu Komputer',
            'bidang_keahlian' => 'Basis Data'
        ]);
    }
}