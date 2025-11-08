@extends('layouts.user')

@section('page-title', 'Dashboard UKM')

@include('partials.table-styles')

@section('content')

<div class="data-table-container">
    <div class="table-header">
        <h2 class="table-title">Daftar Anggota UKM</h2>
        <div class="table-actions">
            <div class="search-box">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" id="searchInput" placeholder="Cari anggota UKM...">
            </div>
            <div class="action-buttons">
                <a href="{{ route('user.ukm.download-pdf') }}" class="btn btn-success">
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
                    <th>Nama UKM</th>
                    <th>Posisi</th>
                    <th>Tahun Bergabung</th>
                    <th>Jurusan</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($ukms ?? [] as $ukm)
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-info-text">
                                <p>{{ $ukm->nama_mahasiswa }}</p>
                            </div>
                        </div>
                    </td>
                    <td data-label="Email">{{ $ukm->email ?? '-' }}</td>
                    <td data-label="NIM">{{ $ukm->nim ?? '-' }}</td>
                    <td data-label="Nama UKM">{{ $ukm->nama_ukm }}</td>
                    <td data-label="Posisi">
                        <span class="badge-posisi badge-{{ strtolower(str_replace(' ', '', $ukm->posisi ?? 'anggota')) }}">
                            {{ ucfirst($ukm->posisi ?? 'Anggota') }}
                        </span>
                    </td>
                    <td data-label="Tahun Bergabung">{{ $ukm->tahun_bergabung ?? '-' }}</td>
                    <td data-label="Jurusan">{{ $ukm->jurusan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <p>Belum ada data UKM</p>
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
