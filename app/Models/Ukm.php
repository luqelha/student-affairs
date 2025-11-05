<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mahasiswa',
        'email',
        'nim',
        'nama_ukm',
        'posisi',
        'tahun_bergabung',
        'jurusan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
