<!DOCTYPE html>
<html lang="id">

@php
    $pengaturan = \App\Models\Pengaturan::first();
    $admin = auth()->user();
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Rumah Makan')</title>

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background: #f5f3f0;
            color: #333;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #650000;
            color: white;
            padding: 22px 18px;
            box-shadow: 4px 0 20px rgba(0,0,0,0.12);
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        /* =====================================================
           BRAND
        ===================================================== */
        .brand {
            text-align: center;
            padding-bottom: 22px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: white;
            border: 3px solid #d9a441;
            font-size: 25px;
            overflow: hidden;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .brand h2 {
            font-size: 18px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .brand p {
            margin-top: 4px;
            font-size: 11px;
            color: rgba(255,255,255,0.65);
        }

        /* =====================================================
           MENU
        ===================================================== */
        .menu {
            margin-top: 22px;
            flex: 1;
            overflow-y: auto;
            scrollbar-width: none;
        }

        .menu::-webkit-scrollbar {
            display: none;
        }

        .menu-title {
            margin: 0 12px 8px;
            font-size: 10px;
            color: rgba(255,255,255,0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 12px;
            margin-bottom: 3px;
            border-radius: 8px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 13px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: rgba(255,255,255,0.08);
            color: white;
        }

        .menu a.active {
            background: rgba(255,255,255,0.13);
            color: white;
            border-left: 3px solid #d9a441;
            padding-left: 9px;
        }

        .menu-icon {
            width: 18px;
            min-width: 18px;
            text-align: center;
            color: rgba(255,255,255,0.7);
            font-size: 13px;
        }

        .menu a:hover .menu-icon {
            color: white;
        }

        .menu a.active .menu-icon {
            color: #d9a441;
        }

        /* =====================================================
           LOGOUT SIDEBAR
        ===================================================== */
        .logout {
            margin-top: 10px;
            padding-top: 12px;
            border-top: 1px solid rgba(255,255,255,0.15);
        }

        .logout form {
            margin: 0;
        }

        .logout button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 12px;
            border: none;
            background: transparent;
            border-radius: 8px;
            color: rgba(255,255,255,0.75);
            font-size: 13px;
            cursor: pointer;
            text-align: left;
        }

        .logout button:hover {
            background: rgba(255,255,255,0.08);
            color: white;
        }

        /* =====================================================
           MAIN
        ===================================================== */
        .main {
            margin-left: 250px;
            min-height: 100vh;
            padding: 30px;
        }

        /* =====================================================
           TOPBAR
        ===================================================== */
        .topbar {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .topbar-left {
            min-width: 0;
        }

        .topbar h1 {
            font-size: 27px;
            color: #2c2c2c;
        }

        .topbar p {
            margin-top: 5px;
            color: #888;
            font-size: 13px;
        }

        /* =====================================================
           ADMIN PROFILE
        ===================================================== */
        .admin-profile-wrapper {
            position: relative;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 8px 14px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            cursor: pointer;
            flex-shrink: 0;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #8b0000;
            color: white;
            font-size: 15px;
            flex-shrink: 0;
            overflow: hidden;
            border: 2px solid #f3f3f3;
        }

        .admin-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .admin-info strong {
            display: block;
            font-size: 13px;
            color: #222;
        }

        .admin-info small {
            display: block;
            margin-top: 2px;
            color: #999;
            font-size: 11px;
        }

        .admin-arrow {
            font-size: 11px;
            color: #999;
            transition: 0.2s;
        }

        .admin-profile.open .admin-arrow {
            transform: rotate(180deg);
        }

        /* =====================================================
           DROPDOWN ADMIN
        ===================================================== */
        .admin-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 210px;
            background: white;
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            display: none;
            z-index: 9999;
        }

        .admin-dropdown.show {
            display: block;
        }

        .admin-dropdown a,
        .admin-dropdown button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 12px;
            border: none;
            background: transparent;
            text-decoration: none;
            color: #444;
            font-size: 13px;
            border-radius: 8px;
            cursor: pointer;
            text-align: left;
        }

        .admin-dropdown a:hover,
        .admin-dropdown button:hover {
            background: #f5f5f5;
            color: #8b0000;
        }

        .admin-dropdown i {
            width: 18px;
            text-align: center;
        }

        .admin-dropdown form {
            margin: 0;
        }

        .dropdown-divider {
            height: 1px;
            background: #eee;
            margin: 6px 0;
        }

        /* =====================================================
           CARD
        ===================================================== */
        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */
        @media (max-width: 750px) {
            .sidebar {
                width: 70px;
                padding: 20px 10px;
            }

            .brand h2,
            .brand p,
            .menu-title,
            .menu a span:not(.menu-icon),
            .logout span:not(.menu-icon) {
                display: none;
            }

            .brand {
                border: none;
            }

            .logo {
                width: 45px;
                height: 45px;
                font-size: 20px;
            }

            .menu a {
                justify-content: center;
                padding: 11px 5px;
            }

            .menu a.active {
                border-left: none;
                padding-left: 5px;
            }

            .logout button {
                justify-content: center;
                padding: 11px 5px;
            }

            .main {
                margin-left: 70px;
                padding: 20px;
            }

            .topbar {
                align-items: flex-start;
            }

            .topbar h1 {
                font-size: 22px;
            }

            .admin-profile {
                padding: 7px 10px;
            }

            .admin-info {
                display: none;
            }

            .admin-dropdown {
                right: 0;
                width: 190px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="brand">
            <div class="logo">
                @if($pengaturan?->logo)
                    <img src="{{ asset('storage/' . $pengaturan->logo) }}" alt="Logo Rumah Makan">
                @else
                    🍽️
                @endif
            </div>

            <h2>{{ $pengaturan?->nama_rumah_makan ?? 'Rumah Makan' }}</h2>
            <p>Admin Panel</p>
        </div>

        <nav class="menu">
            <div class="menu-title">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-chart-line"></i></span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.menu') }}" class="{{ request()->routeIs('admin.menu*') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-utensils"></i></span>
                <span>Data Menu</span>
            </a>

            <a href="{{ route('admin.meja') }}" class="{{ request()->routeIs('admin.meja*') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-chair"></i></span>
                <span>Data Meja</span>
            </a>

            <a href="{{ route('admin.pesanan') }}" class="{{ request()->routeIs('admin.pesanan*') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-cart-shopping"></i></span>
                <span>Data Pesanan</span>
            </a>

            <a href="{{ route('admin.reservasi') }}" class="{{ request()->routeIs('admin.reservasi*') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-calendar-check"></i></span>
                <span>Data Reservasi</span>
            </a>

            <div class="menu-title" style="margin-top:22px;">Lainnya</div>

            <a href="{{ route('admin.laporan') }}" class="{{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-file-lines"></i></span>
                <span>Laporan</span>
            </a>

            <a href="{{ route('admin.testimoni') }}" class="{{ request()->routeIs('admin.testimoni*') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-star"></i></span>
                <span>Testimoni</span>
            </a>

            <a href="{{ route('admin.pengaturan') }}" class="{{ request()->routeIs('admin.pengaturan*') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-gear"></i></span>
                <span>Pengaturan</span>
            </a>
        </nav>

        <div class="logout">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <span class="menu-icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main">

        {{-- TOPBAR --}}
        <div class="topbar">
            <div class="topbar-left">
                <h1>@yield('page-title', 'Dashboard')</h1>
                <p>@yield('page-description', 'Kelola sistem rumah makan dengan mudah.')</p>
            </div>

            {{-- ADMIN PROFILE --}}
            <div class="admin-profile-wrapper">
                <div class="admin-profile" id="adminProfile" onclick="toggleAdminMenu(event)">
                    <div class="admin-avatar">
                        @if($admin?->foto)
                            <img src="{{ asset('storage/' . $admin->foto) }}" alt="{{ $admin->name }}">
                        @else
                            <i class="fa-solid fa-user"></i>
                        @endif
                    </div>
 
                    <div class="admin-info">
                        <strong>{{ $admin?->name ?? 'Admin Rumah Makan' }}</strong>
                        <small>{{ $admin?->jabatan ?? ucfirst($admin?->role ?? 'Administrator') }}</small>
                    </div>

                    <i class="fa-solid fa-chevron-down admin-arrow"></i>
                </div>

                {{-- DROPDOWN --}}
                <div class="admin-dropdown" id="adminDropdown" onclick="event.stopPropagation()">
                    <a href="{{ route('admin.profil') }}">
                        <i class="fa-solid fa-user"></i>
                        <span>Profil Admin</span>
                    </a>

                    

                    <div class="dropdown-divider"></div>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ISI HALAMAN --}}
        @yield('content')

    </main>

    @stack('scripts')

    <script>
        function toggleAdminMenu(event) {
            event.stopPropagation();
            const profile = document.getElementById('adminProfile');
            const dropdown = document.getElementById('adminDropdown');

            profile.classList.toggle('open');
            dropdown.classList.toggle('show');
        }

        document.addEventListener('click', function () {
            const profile = document.getElementById('adminProfile');
            const dropdown = document.getElementById('adminDropdown');

            if (profile && dropdown) {
                profile.classList.remove('open');
                dropdown.classList.remove('show');
            }
        });
    </script>
</body>
</html>