<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ukms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mahasiswa');
            $table->string('email')->nullable();
            $table->string('nim')->nullable();
            $table->string('nama_ukm')->nullable();
            $table->string('posisi')->nullable();
            $table->year('tahun_bergabung')->nullable();
            $table->string('jurusan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ukms');
    }
};
