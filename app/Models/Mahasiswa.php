<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';
    protected $fillable = [
        'npm', 'nama_lengkap', 'email', 'no_telepon', 
        'program_studi', 'semester', 'tahun_masuk', 'alamat'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function jadwals()
    {
        return $this->belongsToMany(Jadwal::class, 'krs', 'mahasiswa_id', 'jadwal_id')
                    ->withPivot('status', 'nilai', 'tahun_akademik', 'semester')
                    ->withTimestamps();
    }
}