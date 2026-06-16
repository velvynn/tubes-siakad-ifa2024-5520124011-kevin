<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $matkuls = [
            ['kode_mk' => 'IF101', 'nama_mk' => 'Pemrograman Web', 'sks' => 3, 'semester' => 5, 'deskripsi' => 'Mata kuliah pemrograman web dengan Laravel'],
            ['kode_mk' => 'IF102', 'nama_mk' => 'Basis Data', 'sks' => 3, 'semester' => 3, 'deskripsi' => 'Perancangan dan implementasi basis data'],
            ['kode_mk' => 'IF103', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 5, 'deskripsi' => 'Konsep dan implementasi jaringan komputer'],
            ['kode_mk' => 'IF104', 'nama_mk' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 7, 'deskripsi' => 'Pengenalan kecerdasan buatan'],
            ['kode_mk' => 'IF105', 'nama_mk' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 5, 'deskripsi' => 'Metodologi pengembangan perangkat lunak'],
            ['kode_mk' => 'IF106', 'nama_mk' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3, 'deskripsi' => 'Konsep sistem operasi komputer'],
            ['kode_mk' => 'IF107', 'nama_mk' => 'Pemrograman Mobile', 'sks' => 3, 'semester' => 7, 'deskripsi' => 'Pengembangan aplikasi mobile'],
        ];
        
        foreach ($matkuls as $matkul) {
            MataKuliah::create($matkul);
        }
    }
}