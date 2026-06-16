<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::create([
            'npm' => '2023101001',
            'nama_lengkap' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@student.ac.id',
            'no_telepon' => '082134567890',
            'program_studi' => 'Informatika',
            'semester' => 5,
            'tahun_masuk' => 2023,
            'alamat' => 'Jl. Merdeka No. 123, Jakarta'
        ]);
        
        Mahasiswa::create([
            'npm' => '2023101002',
            'nama_lengkap' => 'Budi Pratama',
            'email' => 'budi.pratama@student.ac.id',
            'no_telepon' => '082134567891',
            'program_studi' => 'Sistem Informasi',
            'semester' => 3,
            'tahun_masuk' => 2023,
            'alamat' => 'Jl. Sudirman No. 45, Bandung'
        ]);
        
        Mahasiswa::create([
            'npm' => '2023101003',
            'nama_lengkap' => 'Citra Dewi',
            'email' => 'citra.dewi@student.ac.id',
            'no_telepon' => '082134567892',
            'program_studi' => 'Informatika',
            'semester' => 5,
            'tahun_masuk' => 2023,
            'alamat' => 'Jl. Diponegoro No. 78, Surabaya'
        ]);
    }
}