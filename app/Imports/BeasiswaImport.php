<?php

namespace App\Imports;

use App\Models\Beasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BeasiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Beasiswa([
            'nama_mahasiswa' => $row['nama_mahasiswa'] ?? $row['nama'] ?? null,
            'email' => $row['email'] ?? null,
            'nim' => $row['nim'] ?? null,
            'jenis_beasiswa' => $row['jenis_beasiswa'] ?? $row['beasiswa'] ?? null,
            'jurusan' => $row['jurusan'] ?? $row['fakultas'] ?? null,
            'tahun_ajaran' => $row['tahun_ajaran'] ?? $row['tahun'] ?? date('Y'),
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nama_mahasiswa' => 'required|string',
            '*.email' => 'nullable|email',
            '*.jenis_beasiswa' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_mahasiswa.required' => 'Kolom nama mahasiswa wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'jenis_beasiswa.required' => 'Jenis beasiswa wajib diisi.',
        ];
    }
}