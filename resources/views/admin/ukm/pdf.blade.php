<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Anggota UKM</title>
    <style>
        @page {
            margin: 20px;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #4299e1;
            padding-bottom: 10px;
        }
        
        .header h2 {
            margin: 5px 0;
            color: #4299e1;
            font-size: 16px;
        }
        
        .header h3 {
            margin: 5px 0;
            font-size: 14px;
        }
        
        .header p {
            margin: 3px 0;
            font-size: 10px;
            color: #666;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        th {
            background-color: #4299e1;
            color: white;
            padding: 8px 5px;
            text-align: left;
            font-size: 10px;
            font-weight: 600;
        }
        
        td {
            border: 1px solid #ddd;
            padding: 6px 5px;
            font-size: 10px;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 600;
        }
        
        .badge-ketua {
            background-color: #fef5e7;
            color: #744210;
        }
        
        .badge-wakil {
            background-color: #e3f2fd;
            color: #1565c0;
        }
        
        .badge-sekretaris {
            background-color: #f3e5f5;
            color: #4a148c;
        }
        
        .badge-bendahara {
            background-color: #fff3e0;
            color: #e65100;
        }
        
        .badge-anggota {
            background-color: #f0fdf4;
            color: #14532d;
        }
        
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 9px;
            color: #666;
        }
        
        .no-data {
            text-align: center;
            padding: 30px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>SISTEM INFORMASI KEMAHASISWAAN</h2>
        <h3>UIN MAULANA MALIK IBRAHIM MALANG</h3>
        <p>Data Anggota Unit Kegiatan Mahasiswa (UKM)</p>
        <p>Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
    </div>

    @if($ukms->count() > 0)
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="20%">Nama Mahasiswa</th>
                <th width="13%">NIM</th>
                <th width="18%">Nama UKM</th>
                <th width="12%">Posisi</th>
                <th width="10%">Tahun</th>
                <th width="18%">Jurusan</th>
                <th width="15%">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ukms as $index => $ukm)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $ukm->nama_mahasiswa }}</td>
                <td>{{ $ukm->nim ?? '-' }}</td>
                <td>{{ $ukm->nama_ukm }}</td>
                <td>
                    <span class="badge badge-{{ strtolower(str_replace(' ', '', $ukm->posisi ?? 'anggota')) }}">
                        {{ ucfirst($ukm->posisi ?? 'Anggota') }}
                    </span>
                </td>
                <td style="text-align: center;">{{ $ukm->tahun_bergabung ?? '-' }}</td>
                <td>{{ $ukm->jurusan ?? '-' }}</td>
                <td>{{ $ukm->email ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total: {{ $ukms->count() }} anggota UKM</p>
        <p>© {{ date('Y') }} UIN Maulana Malik Ibrahim Malang</p>
    </div>
    @else
    <div class="no-data">
        <p>Belum ada data UKM yang tersedia</p>
    </div>
    @endif
</body>
</html>