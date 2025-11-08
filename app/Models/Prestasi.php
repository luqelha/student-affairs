<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mahasiswa',
        'email',
        'nim',
        'jenis_prestasi',
        'tingkat',
        'penyelenggara',
        'tahun',
        'jurusan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}