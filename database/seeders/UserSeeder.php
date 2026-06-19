<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@siakad.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'mahasiswa_id' => null,
        ]);
        
        // Mahasiswa Users
        $mahasiswas = \App\Models\Mahasiswa::all();
        foreach ($mahasiswas as $mahasiswa) {
            User::create([
                'name' => $mahasiswa->nama_lengkap,
                'email' => $mahasiswa->email, 
                'password' => Hash::make('mahasiswa123'),
                'role' => 'mahasiswa',
                'mahasiswa_id' => $mahasiswa->id,
            ]);
        }
    }
}