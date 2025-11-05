<?php

namespace App\Exports;

use App\Models\Beasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BeasiswaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Beasiswa::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Mahasiswa',
            'Email',
            'NIM',
            'Jenis Beasiswa',
            'Jurusan',
            'Tahun Ajaran',
            'Tanggal Dibuat',
        ];
    }

    public function map($beasiswa): array
    {
        return [
            $beasiswa->id,
            $beasiswa->nama_mahasiswa,
            $beasiswa->email,
            $beasiswa->nim,
            $beasiswa->jenis_beasiswa,
            $beasiswa->jurusan,
            $beasiswa->tahun_ajaran,
            $beasiswa->created_at->format('Y-m-d'),
        ];
    }
}