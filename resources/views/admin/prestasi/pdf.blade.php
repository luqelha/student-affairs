<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Prestasi Mahasiswa</title>
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
            border-bottom: 2px solid #ed8936;
            padding-bottom: 10px;
        }
        
        .header h2 {
            margin: 5px 0;
            color: #ed8936;
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
            background-color: #ed8936;
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
        
        .badge-internasional {
            background-color: #e3f2fd;
            color: #1565c0;
        }
        
        .badge-nasional {
            background-color: #fef5e7;
            color: #744210;
        }
        
        .badge-lokal {
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
        <p>Data Prestasi Mahasiswa</p>
        <p>Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
    </div>

    @if($prestasis->count() > 0)
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="18%">Nama Mahasiswa</th>
                <th width="13%">NIM</th>
                <th width="20%">Jenis Prestasi</th>
                <th width="10%">Tingkat</th>
                <th width="20%">Penyelenggara</th>
                <th width="8%">Tahun</th>
                <th width="12%">Jurusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestasis as $index => $prestasi)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $prestasi->nama_mahasiswa }}</td>
                <td>{{ $prestasi->nim ?? '-' }}</td>
                <td>{{ $prestasi->jenis_prestasi }}</td>
                <td>
                    <span class="badge badge-{{ strtolower($prestasi->tingkat ?? 'lokal') }}">
                        {{ ucfirst($prestasi->tingkat ?? 'Lokal') }}
                    </span>
                </td>
                <td>{{ $prestasi->penyelenggara ?? '-' }}</td>
                <td style="text-align: center;">{{ $prestasi->tahun ?? '-' }}</td>
                <td>{{ $prestasi->jurusan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total: {{ $prestasis->count() }} data prestasi</p>
        <p>© {{ date('Y') }} UIN Maulana Malik Ibrahim Malang</p>
    </div>
    @else
    <div class="no-data">
        <p>Belum ada data prestasi yang tersedia</p>
    </div>
    @endif
</body>
</html>