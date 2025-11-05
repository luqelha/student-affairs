<?php

namespace App\Imports;

use App\Models\Prestasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PrestasiImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Prestasi([
            'nama_mahasiswa' => $row['nama_mahasiswa'] ?? $row['nama'] ?? null,
            'email' => $row['email'] ?? null,
            'nim' => $row['nim'] ?? null,
            'jenis_prestasi' => $row['jenis_prestasi'] ?? $row['prestasi'] ?? null,
            'tingkat' => $row['tingkat'] ?? 'Lokal',
            'penyelenggara' => $row['penyelenggara'] ?? null,
            'tahun' => $row['tahun'] ?? date('Y'),
            'jurusan' => $row['jurusan'] ?? $row['fakultas'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nama_mahasiswa' => 'required|string',
            '*.email' => 'nullable|email',
            '*.jenis_prestasi' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_mahasiswa.required' => 'Kolom nama mahasiswa wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'jenis_prestasi.required' => 'Jenis prestasi wajib diisi.',
        ];
    }
}