<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mahasiswa');
            $table->string('email')->nullable();
            $table->string('nim')->nullable();
            $table->string('jenis_prestasi')->nullable();
            $table->string('tingkat')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->year('tahun')->nullable();
            $table->string('jurusan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
