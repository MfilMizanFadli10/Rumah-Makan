<!DOCTYPE html>
<html lang="id">

@php
    $pengaturan = \App\Models\Pengaturan::first();
@endphp

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <title>
        @yield('title', 'Rumah Makan')
    </title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {
            font-family: Arial, sans-serif;
            background: #fafafa;
            color: #222;
        }


        /* =====================================================
           NAVBAR DESKTOP
        ====================================================== */

        .navbar {

            height: 72px;

            background: white;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 7%;

            box-shadow:
                0 2px 10px rgba(0,0,0,0.08);

            position: sticky;

            top: 0;

            z-index: 1000;

        }


        /* =====================================================
           BRAND
        ====================================================== */

        .brand {

            display: flex;

            align-items: center;

            gap: 10px;

            font-size: 20px;

            font-weight: bold;

            color: #8b0000;

            white-space: nowrap;

        }


        .brand-logo {

            width: 42px;

            height: 42px;

            border-radius: 50%;

            border: 3px solid #d9a441;

            display: flex;

            align-items: center;

            justify-content: center;

            overflow: hidden;

            background: white;

            flex-shrink: 0;

        }


        .brand-logo img {

            width: 100%;

            height: 100%;

            object-fit: cover;

            border-radius: 50%;

        }


        /* =====================================================
           TOMBOL MENU MOBILE
        ====================================================== */

        .menu-toggle {

            display: none;

            border: none;

            background: transparent;

            color: #8b0000;

            font-size: 29px;

            cursor: pointer;

            padding: 5px;

            line-height: 1;

        }


        /* =====================================================
           NAV MENU
        ====================================================== */

        .nav-menu {

            display: flex;

            align-items: center;

            gap: 28px;

        }


        .nav-menu a {

            position: relative;

            text-decoration: none;

            color: #444;

            font-size: 14px;

            font-weight: 500;

            padding: 25px 0;

            transition: 0.2s;

        }


        .nav-menu a:hover {

            color: #8b0000;

        }


        /* =====================================================
           MENU AKTIF
        ====================================================== */

        .nav-menu a.active {

            color: #8b0000;

            font-weight: 700;

        }


        .nav-menu a.active::after {

            content: "";

            position: absolute;

            left: 0;

            right: 0;

            bottom: 17px;

            height: 3px;

            background: #8b0000;

            border-radius: 10px;

        }


        /* =====================================================
           TOMBOL PESAN SEKARANG
        ====================================================== */

        .nav-menu .btn-pesan {

            background: #8b0000 !important;

            color: white !important;

            padding: 11px 18px !important;

            border-radius: 8px;

            font-weight: 600 !important;

            box-shadow:
                0 3px 8px rgba(139,0,0,0.15);

            transition: 0.2s;

        }


        .nav-menu .btn-pesan:hover {

            background: #650000 !important;

            color: white !important;

            transform: translateY(-1px);

        }


        .nav-menu .btn-pesan::after {

            display: none !important;

        }


        /* =====================================================
           CONTENT
        ====================================================== */

        .customer-content {

            min-height: calc(100vh - 72px);

        }


        /* =====================================================
           FOOTER
        ====================================================== */

        .footer {

            background: #8b0000;

            color: white;

            text-align: center;

            padding: 25px;

            margin-top: 50px;

        }


        /* =====================================================
           TABLET
        ====================================================== */

        @media (max-width: 1050px) {

            .navbar {

                padding: 0 4%;

            }


            .nav-menu {

                gap: 18px;

            }


            .nav-menu a {

                font-size: 13px;

            }

        }


        /* =====================================================
           MOBILE
        ====================================================== */

        @media (max-width: 750px) {

            .navbar {

                height: 68px;

                min-height: 68px;

                flex-direction: row;

                padding: 0 18px;

                gap: 0;

            }


            /* BRAND */

            .brand {

                font-size: 17px;

                gap: 8px;

            }


            .brand-logo {

                width: 38px;

                height: 38px;

                border-width: 2px;

            }


            /* TOMBOL ☰ */

            .menu-toggle {

                display: block;

            }


            /* =================================================
               MENU MOBILE
            ================================================== */

            .nav-menu {

                display: none;

                position: absolute;

                top: 68px;

                left: 12px;

                right: 12px;

                width: auto;

                background: white;

                padding: 10px;

                flex-direction: column;

                align-items: stretch;

                gap: 3px;

                border-radius: 0 0 14px 14px;

                box-shadow:
                    0 8px 25px rgba(0,0,0,0.15);

                border-top: 1px solid #eee;

            }


            /* SAAT DIBUKA */

            .nav-menu.show {

                display: flex;

            }


            /* LINK */

            .nav-menu a {

                display: block;

                width: 100%;

                padding: 12px 14px;

                font-size: 14px;

                border-radius: 8px;

            }


            /* LINK AKTIF */

            .nav-menu a.active {

                background: #fff1f1;

                color: #8b0000;

            }


            /* HILANGKAN GARIS BAWAH */

            .nav-menu a.active::after {

                display: none;

            }


            /* PESAN SEKARANG */

            .nav-menu .btn-pesan {

                text-align: center;

                margin-top: 7px;

                padding: 11px 14px !important;

                border-radius: 8px;

            }


            /* CONTENT */

            .customer-content {

                min-height: calc(100vh - 68px);

            }

        }


        /* =====================================================
           HP KECIL
        ====================================================== */

        @media (max-width: 400px) {

            .navbar {

                padding: 0 14px;

            }


            .brand {

                font-size: 16px;

            }


            .brand-logo {

                width: 36px;

                height: 36px;

            }


            .menu-toggle {

                font-size: 27px;

            }

        }

    </style>

</head>


<body>


{{-- =========================================================
     NAVBAR
========================================================= --}}

<nav class="navbar">


    {{-- BRAND --}}

    <div class="brand">

        <div class="brand-logo">

            @if($pengaturan && $pengaturan->logo)

                <img
                    src="{{ asset('storage/' . $pengaturan->logo) }}"
                    alt="Logo"
                >

            @else

                🍽️

            @endif

        </div>


        <span>

            {{ $pengaturan->nama_rumah_makan ?? 'Rumah Makan' }}

        </span>

    </div>


    {{-- =====================================================
         TOMBOL ☰ MOBILE
    ====================================================== --}}

    <button
        type="button"
        class="menu-toggle"
        onclick="toggleMenu()"
        aria-label="Buka menu"
    >
        ☰
    </button>


    {{-- =====================================================
         NAVIGASI
    ====================================================== --}}

    <div class="nav-menu" id="navMenu">


        {{-- BERANDA --}}

        <a
            href="{{ route('customer.home') }}"
            class="{{ request()->routeIs('customer.home') ? 'active' : '' }}"
        >
            Beranda
        </a>


        {{-- MENU --}}

        <a
            href="{{ route('customer.menu') }}"
            class="{{ request()->routeIs('customer.menu') ? 'active' : '' }}"
        >
            Menu
        </a>


        {{-- RESERVASI --}}

        <a
            href="{{ route('customer.reservasi') }}"
            class="{{ request()->routeIs('customer.reservasi') ? 'active' : '' }}"
        >
            Reservasi
        </a>


        {{-- STATUS PESANAN --}}

        <a
            href="{{ route('customer.status-pesanan') }}"
            class="{{ request()->routeIs('customer.status-pesanan') ? 'active' : '' }}"
        >
            Status Pesanan
        </a>


        {{-- RIWAYAT --}}

        <a
            href="{{ route('customer.riwayat') }}"
            class="{{ request()->routeIs('customer.riwayat') ? 'active' : '' }}"
        >
            Riwayat
        </a>


        {{-- TESTIMONI --}}

        <a
            href="{{ route('customer.testimoni') }}"
            class="{{ request()->routeIs('customer.testimoni') ? 'active' : '' }}"
        >
            Testimoni
        </a>


        {{-- PESAN SEKARANG --}}

        <a
            href="{{ route('customer.menu') }}"
            class="btn-pesan"
        >
            Pesan Sekarang
        </a>


    </div>

</nav>


{{-- =========================================================
     ISI HALAMAN
========================================================= --}}

<main class="customer-content">

    @yield('content')

</main>


{{-- =========================================================
     FOOTER
========================================================= --}}

<footer class="footer">

    <p>

        © {{ date('Y') }}

        {{ $pengaturan->nama_rumah_makan ?? 'Rumah Makan' }}

    </p>


    <p style="
        margin-top:7px;
        font-size:13px;
    ">

        {{ $pengaturan->tagline ?? 'Sistem Reservasi & Pemesanan Rumah Makan' }}

    </p>

</footer>


{{-- =========================================================
     JAVASCRIPT MENU MOBILE
========================================================= --}}

<script>

function toggleMenu() {

    const menu = document.getElementById('navMenu');

    if (!menu) {
        return;
    }

    menu.classList.toggle('show');

}


/* =========================================================
   TUTUP MENU SAAT LINK DIKLIK
========================================================= */

document.querySelectorAll('#navMenu a').forEach(function(link) {

    link.addEventListener('click', function() {

        const menu = document.getElementById('navMenu');

        if (menu) {

            menu.classList.remove('show');

        }

    });

});


/* =========================================================
   TUTUP MENU KALAU KLIK DI LUAR
========================================================= */

document.addEventListener('click', function(event) {

    const menu = document.getElementById('navMenu');

    const toggle = document.querySelector('.menu-toggle');

    if (!menu || !toggle) {
        return;
    }


    if (
        !menu.contains(event.target) &&
        !toggle.contains(event.target)
    ) {

        menu.classList.remove('show');

    }

});

// Paksa browser menghitung ulang tampilan responsive saat halaman pertama dibuka
window.addEventListener('load', function () {
    window.dispatchEvent(new Event('resize'));
});

</script>


</body>

</html>