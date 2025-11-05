<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'User Dashboard') - Kemahasiswaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: auto !important;
            min-height: 100vh !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            color: #2d3748;
            -ms-overflow-style: none;
            scrollbar-width: none;
            
        }

        body::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            color: #2d3748;
            -ms-overflow-style: none;
            scrollbar-width: none;
            
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: white;
            border-right: 1px solid #e2e8f0;
            padding: 24px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 0 24px 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 700;
            color: #348439;
        }

        .logo img {
            width: 25px;
            flex-shrink: 0;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .sidebar-menu {
            padding: 24px 0;
        }

        .menu-title {
            padding: 0 27px 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: #a0aec0;
            letter-spacing: 0.5px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 14px;
            font-weight: 500;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: #f7fafc;
            color: #78BA7C;
        }

        .menu-item.active {
            background: #edf2f7;
            color: #348439;
            border-left-color: #348439;
        }

        .menu-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 13.7px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            min-height: 72px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: #4a5568;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #2d3748;
            line-height: 1.2;
            margin: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            border-radius: 8px;
            height: 48px;
        }

        .user-avatar {
            width: 32px !important;
            height: 32px !important;
            border-radius: 50%;
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            line-height: 1.2;
        }

        .user-role {
            font-size: 12px;
            color: #718096;
            line-height: 1.2;
            margin-top: 2px;
        }

        .logout-btn {
            padding: 10px 18px !important;
            background: #E53935 !important;
            color: white !important;
            border: none !important;
            border-radius: 10px !important;
            cursor: pointer !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            transition: background 0.2s !important;
            height: 35px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .logout-btn:hover {
            background: #C62828 !important;
        }

        .content-wrapper {
            padding: 32px;
            flex: 1;
            min-height: 0;
            display: flex;
            flex-direction: column;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            html, body {
                height: auto !important;
                overflow-y: auto !important;
            }

            .main-content,
            .page-wrapper,
            .content-wrapper {
                height: auto !important;
                min-height: 100vh !important;
                overflow-y: visible !important;
            }

            .dashboard-container {
                display: block !important;
                height: auto !important;
            }

            .sidebar {
                height: 100vh !important;
                overflow-y: auto !important;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: flex;
            }

            .topbar {
                padding: 12px 16px;
                min-height: 64px;
            }

            .page-title {
                font-size: 18px;
            }

            .content-wrapper {
                padding: 16px;
            }

            .user-info {
                display: none;
            }

            .user-profile {
                padding: 8px;
            }

            .logout-btn {
                padding: 8px 12px;
                font-size: 13px;
                height: 36px;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar Overlay (Mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo UIN">
                    <span>KEMAHASISWAAN</span>
                </div>
            </div>

            <nav class="sidebar-menu">
                <div class="menu-title">MENU</div>
                <a href="{{ route('user.dashboard') }}" class="menu-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </span>
                    Dashboard
                </a>
                <a href="{{ route('user.beasiswa.index') }}" class="menu-item {{ request()->routeIs('user.beasiswa.*') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                    </span>
                    Beasiswa
                </a>
                <a href="{{ route('user.prestasi.index') }}" class="menu-item {{ request()->routeIs('user.prestasi.*') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                            <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                            <path d="M4 22h16"></path>
                            <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                            <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                            <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                        </svg>
                    </span>
                    Prestasi
                </a>
                <a href="{{ route('user.ukm.index') }}" class="menu-item {{ request()->routeIs('user.ukm.*') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </span>
                    UKM
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Topbar -->
            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menuToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>
                    <h1 class="page-title">@yield('page-title', 'Dashboard Mahasiswa')</h1>
                </div>
                <div class="topbar-right">
                    @php
                        $user = auth()->user();
                    @endphp

                    <div class="user-profile">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ $user->name ?? 'User' }}</div>
                            <div class="user-role">{{ ucfirst($user->role ?? 'User') }}</div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        });
    </script>
    @stack('scripts')
</body>
</html>