<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Beasiswa Mahasiswa</title>
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
            border-bottom: 2px solid #2d7a3e;
            padding-bottom: 10px;
        }
        
        .header img {
            width: 50px;
            height: auto;
        }
        
        .header h2 {
            margin: 5px 0;
            color: #2d7a3e;
            font-size: 16px;
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
            background-color: #2d7a3e;
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
        <h3 style="margin: 5px 0; font-size: 14px;">UIN MAULANA MALIK IBRAHIM MALANG</h3>
        <p>Data Beasiswa Mahasiswa</p>
        <p>Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
    </div>

    @if($beasiswas->count() > 0)
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama Mahasiswa</th>
                <th width="15%">NIM</th>
                <th width="25%">Email</th>
                <th width="15%">Jenis Beasiswa</th>
                <th width="15%">Jurusan</th>
                <th width="10%">Tahun</th>
            </tr>
        </thead>
        <tbody>
            @foreach($beasiswas as $index => $beasiswa)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $beasiswa->nama_mahasiswa }}</td>
                <td>{{ $beasiswa->nim ?? '-' }}</td>
                <td>{{ $beasiswa->email ?? '-' }}</td>
                <td>{{ $beasiswa->jenis_beasiswa }}</td>
                <td>{{ $beasiswa->jurusan ?? '-' }}</td>
                <td style="text-align: center;">{{ $beasiswa->tahun_ajaran ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total: {{ $beasiswas->count() }} data beasiswa</p>
        <p>© {{ date('Y') }} UIN Maulana Malik Ibrahim Malang</p>
    </div>
    @else
    <div class="no-data">
        <p>Belum ada data beasiswa yang tersedia</p>
    </div>
    @endif
</body>
</html>