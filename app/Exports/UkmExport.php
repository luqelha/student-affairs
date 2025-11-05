<?php

namespace App\Exports;

use App\Models\Ukm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UkmExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Ukm::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Mahasiswa',
            'Email',
            'NIM',
            'Nama UKM',
            'Posisi',
            'Tahun Bergabung',
            'Jurusan',
        ];
    }

    public function map($ukm): array
    {
        return [
            $ukm->id,
            $ukm->nama_mahasiswa,
            $ukm->email,
            $ukm->nim,
            $ukm->nama_ukm,
            $ukm->posisi,
            $ukm->tahun_bergabung,
            $ukm->jurusan,
        ];
    }
}