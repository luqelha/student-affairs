@extends('layouts.user')

@section('page-title', 'Daftar Beasiswa')

@include('partials.table-styles')

@section('content')

<div class="data-table-container">
    <div class="table-header">
        <h2 class="table-title">Daftar Beasiswa</h2>
        <div class="table-actions">
            <div class="search-box">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" id="searchInput" placeholder="Cari beasiswa...">
            </div>
            <div class="action-buttons">
                <a href="{{ route('user.beasiswa.download-pdf') }}" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Download PDF
                </a>
            </div>
        </div>
    </div>

    <div class="table-wrapper" id="tableWrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Email</th>
                    <th>NIM</th>
                    <th>Jenis Beasiswa</th>
                    <th>Jurusan</th>
                    <th>Tahun Ajaran</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($beasiswas ?? [] as $beasiswa)
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-info-text">
                                <p>{{ $beasiswa->nama_mahasiswa }}</p>
                            </div>
                        </div>
                    </td>
                    <td data-label="Email">{{ $beasiswa->email ?? '-' }}</td>
                    <td data-label="NIM">{{ $beasiswa->nim ?? '-' }}</td>
                    <td data-label="Jenis Beasiswa">{{ $beasiswa->jenis_beasiswa }}</td>
                    <td data-label="Jurusan">{{ $beasiswa->jurusan ?? '-' }}</td>
                    <td data-label="Tahun Ajaran">{{ $beasiswa->tahun_ajaran }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                            </svg>
                            <p>Belum ada data beasiswa</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('partials.table-scripts')

@endsection