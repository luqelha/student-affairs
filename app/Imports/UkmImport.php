<?php

namespace App\Imports;

use App\Models\Ukm;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UkmImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Ukm([
            'nama_mahasiswa' => $row['nama_mahasiswa'] ?? $row['nama'] ?? null,
            'email' => $row['email'] ?? null,
            'nim' => $row['nim'] ?? null,
            'nama_ukm' => $row['nama_ukm'] ?? $row['ukm'] ?? null,
            'posisi' => $row['posisi'] ?? 'Anggota',
            'tahun_bergabung' => $row['tahun_bergabung'] ?? $row['tahun'] ?? date('Y'),
            'jurusan' => $row['jurusan'] ?? $row['fakultas'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nama_mahasiswa' => 'required|string',
            '*.email' => 'nullable|email',
            '*.nama_ukm' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_mahasiswa.required' => 'Kolom nama mahasiswa wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'nama_ukm.required' => 'Nama UKM wajib diisi.',
        ];
    }
}