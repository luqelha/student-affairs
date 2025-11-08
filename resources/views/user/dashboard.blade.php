@extends('layouts.user')

@section('page-title', 'Dashboard User')

@push('styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        border-radius: 12px;
        padding: 32px;
        color: white;
        margin-bottom: 32px;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .welcome-card h2 {
        font-size: 26px;
        font-weight: 550;
        margin-bottom: 8px;
    }

    .welcome-card p {
        font-size: 16px;
        opacity: 0.9;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .stat-icon.green {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    }

    .stat-icon.blue {
        background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    }

    .stat-icon.orange {
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
    }

    .stat-icon.yellow {
        background: linear-gradient(135deg, #ecc94b 0%, #d69e2e 100%);
    }

    .stat-value {
        font-size: 32px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 14px;
        color: #718096;
        font-weight: 500;
    }

    .quick-actions {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 32px;
    }

    .quick-actions h3 {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 20px;
    }

    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        background: #f7fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        text-decoration: none;
        color: #2d3748;
        transition: all 0.2s;
    }

    .action-btn:hover {
        border-color: #48bb78;
        background: #edf2f7;
        transform: translateY(-2px);
    }

    .action-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
    }

    .action-text h4 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .action-text p {
        font-size: 12px;
        color: #718096;
    }

    .info-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        padding-bottom: 32px;
    }

    .info-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .info-card h3 {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 16px;
    }

    .info-card ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-card li {
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .info-card li:last-child {
        border-bottom: none;
    }

    .info-card a {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
    }

    .info-card a:hover {
        text-decoration: underline;
    }

    .badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-warning {
        background: #fef5e7;
        color: #744210;
    }

    .badge-success {
        background: #f0fdf4;
        color: #14532d;
    }

    @media (max-width: 768px) {
        .welcome-card {
            padding: 24px;
        }

        .welcome-card h2 {
            font-size: 24px;
        }

        .stat-value {
            font-size: 24px;
        }

        .info-cards {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')

<!-- Welcome Card -->
<div class="welcome-card">
    <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
    <p>Dashboard Sistem Kemahasiswaan UIN Malang</p>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon yellow">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                </svg>
            </div>
        </div>
        <div class="stat-value">{{ $totalBeasiswa ?? 0 }}</div>
        <div class="stat-label">Total Beasiswa</div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon orange">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                    <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                    <path d="M4 22h16"></path>
                    <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                    <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                    <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                </svg>
            </div>
        </div>
        <div class="stat-value">{{ $totalPrestasi ?? 0 }}</div>
        <div class="stat-label">Total Prestasi</div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon blue">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
        </div>
        <div class="stat-value">{{ $totalUkm ?? 0 }}</div>
        <div class="stat-label">Anggota UKM</div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h3>Aksi Cepat</h3>
    <div class="action-grid">
        <!-- Beasiswa -->
        <a href="{{ route('user.beasiswa.index') }}" class="action-btn">
            <div class="action-icon" style="background: linear-gradient(135deg, #ecc94b 0%, #d69e2e 100%);">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                </svg>
            </div>
            <div class="action-text">
                <h4>Lihat Data Beasiswa</h4>
                <p>Lihat daftar beasiswa tersedia</p>
            </div>
        </a>

        <!-- Prestasi -->
        <a href="{{ route('user.prestasi.index') }}" class="action-btn">
            <div class="action-icon" style="background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                    <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                    <path d="M4 22h16"></path>
                    <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                    <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                    <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                </svg>
            </div>
            <div class="action-text">
                <h4>Lihat Data Prestasi</h4>
                <p>Lihat daftar prestasi mahasiswa</p>
            </div>
        </a>

        <a href="{{ route('user.ukm.index') }}" class="action-btn">
            <div class="action-icon" style="background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div class="action-text">
                <h4>Lihat Data UKM</h4>
                <p>Lihat daftar UKM yang aktif</p>
            </div>
        </a>
    </div>
</div>

<!-- Info Cards -->
<div class="info-cards">
    <div class="info-card">
        <h3>Ringkasan Sistem</h3>
        <ul>
            <li>
                <span>Total data beasiswa</span>
                <span class="badge badge-success">{{ $totalBeasiswa ?? 0 }}</span>
            </li>
            <li>
                <span>Total data prestasi</span>
                <span class="badge badge-success">{{ $totalPrestasi ?? 0 }}</span>
            </li>
            <li>
                <span>Total data UKM</span>
                <span class="badge badge-success">{{ $totalUkm ?? 0 }}</span>
            </li>
        </ul>
    </div>

    <div class="info-card">
        <h3>Informasi User</h3>
        <ul>
            <li>
                <span>Nama</span>
                <span>{{ auth()->user()->name }}</span>
            </li>
            <li>
                <span>Email</span>
                <span>{{ auth()->user()->email }}</span>
            </li>
            <li>
                <span>Role</span>
                <span class="badge badge-success">User</span>
            </li>
            <li>
                <span>Login terakhir</span>
                <span>{{ now()->format('d M Y H:i') }}</span>
            </li>
        </ul>
    </div>
</div>

@endsection