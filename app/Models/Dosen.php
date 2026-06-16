<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens';
    protected $fillable = [
        'nidn', 'nama_lengkap', 'email', 'no_telepon', 
        'pendidikan_terakhir', 'bidang_keahlian'
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}