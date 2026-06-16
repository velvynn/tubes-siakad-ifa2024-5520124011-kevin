<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('jadwal_id')->constrained('jadwals')->onDelete('cascade');
            $table->enum('status', ['Aktif', 'Batal', 'Selesai'])->default('Aktif');
            $table->float('nilai')->nullable();
            $table->string('tahun_akademik', 20);
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->timestamps();
            
            $table->unique(['mahasiswa_id', 'jadwal_id', 'tahun_akademik', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};