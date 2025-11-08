@extends('layouts.user')

@section('page-title', 'Dashboard Prestasi')

@include('partials.table-styles')

@section('content')

<div class="data-table-container">
    <div class="table-header">
        <h2 class="table-title">Daftar Prestasi Mahasiswa</h2>
        <div class="table-actions">
            <div class="search-box">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" id="searchInput" placeholder="Cari prestasi...">
            </div>
            <div class="action-buttons">
                <a href="{{ route('user.prestasi.download-pdf') }}" class="btn btn-success">
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

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Email</th>
                    <th>NIM</th>
                    <th>Prestasi</th>
                    <th>Tingkat</th>
                    <th>Penyelenggara</th>
                    <th>Tahun</th>
                    <th>Jurusan</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($prestasis ?? [] as $prestasi)
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-info-text">
                                <p>{{ $prestasi->nama_mahasiswa }}</p>
                            </div>
                        </div>
                    </td>
                    <td data-label="Email">{{ $prestasi->email ?? '-' }}</td>
                    <td data-label="NIM">{{ $prestasi->nim ?? '-' }}</td>
                    <td data-label="Jenis Prestasi">{{ $prestasi->jenis_prestasi }}</td>
                    <td data-label="Tingkat">
                        <span class="badge-tingkat badge-{{ strtolower($prestasi->tingkat ?? 'lokal') }}">
                            {{ ucfirst($prestasi->tingkat ?? 'Lokal') }}
                        </span>
                    </td>
                    <td data-label="Penyelenggara">{{ $prestasi->penyelenggara ?? '-' }}</td>
                    <td data-label="Tahun">{{ $prestasi->tahun ?? '-' }}</td>
                    <td data-label="Jurusan">{{ $prestasi->jurusan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                                <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                                <path d="M4 22h16"></path>
                                <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                                <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                                <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                            </svg>
                            <p>Belum ada data prestasi</p>
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