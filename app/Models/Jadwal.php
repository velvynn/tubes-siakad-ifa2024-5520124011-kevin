<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';
    protected $fillable = [
        'dosen_id', 'mata_kuliah_id', 'hari', 'jam_mulai', 
        'jam_selesai', 'kelas', 'ruangan', 'tahun_akademik', 
        'semester', 'kuota'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'krs', 'jadwal_id', 'mahasiswa_id')
                    ->withPivot('status', 'nilai', 'tahun_akademik', 'semester')
                    ->withTimestamps();
    }
    
    public function getKuotaTersisaAttribute()
    {
        return $this->kuota - $this->krs()->where('status', 'Aktif')->count();
    }
}