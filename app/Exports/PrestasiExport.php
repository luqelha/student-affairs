<?php

namespace App\Exports;

use App\Models\Prestasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PrestasiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Prestasi::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Mahasiswa',
            'Email',
            'NIM',
            'Jenis Prestasi',
            'Tingkat',
            'Penyelenggara',
            'Tahun',
            'Jurusan',
        ];
    }

    public function map($prestasi): array
    {
        return [
            $prestasi->id,
            $prestasi->nama_mahasiswa,
            $prestasi->email,
            $prestasi->nim,
            $prestasi->jenis_prestasi,
            $prestasi->tingkat,
            $prestasi->penyelenggara,
            $prestasi->tahun,
            $prestasi->jurusan,
        ];
    }
}