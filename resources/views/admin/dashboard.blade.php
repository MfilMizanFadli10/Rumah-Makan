@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard')

@section('page-description', 'Pantau aktivitas Rumah Makan secara keseluruhan.')

@section('content')

{{-- =========================
     WELCOME
========================= --}}

<div style="
    background:linear-gradient(135deg, #650000, #8b0000);
    color:white;
    padding:30px;
    border-radius:15px;
    margin-bottom:25px;
">

    <div style="
        font-size:13px;
        opacity:.8;
        margin-bottom:8px;
        letter-spacing:1px;
    ">
        PANEL ADMINISTRASI
    </div>

    <h2 style="
        margin:0 0 8px 0;
        font-size:25px;
    ">
        Selamat Datang, Admin
    </h2>

    <p style="
        margin:0;
        opacity:.85;
        font-size:14px;
    ">
        Pantau menu, meja, dan pesanan Rumah Makan
        dari satu halaman.
    </p>

</div>


{{-- =========================
     RINGKASAN UTAMA
========================= --}}

<div style="
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:18px;
    margin-bottom:25px;
">


    {{-- TOTAL MENU --}}

    <div class="dashboard-card">

        <p class="dashboard-label">
            Total Menu
        </p>

        <h2>
            {{ $totalMenu }}
        </h2>

        <small>
            {{ $menuTersedia }} menu tersedia
        </small>

    </div>


    {{-- TOTAL MEJA --}}

    <div class="dashboard-card">

        <p class="dashboard-label">
            Total Meja
        </p>

        <h2>
            {{ $totalMeja }}
        </h2>

        <small>
            {{ $mejaTerisi }} meja sedang terisi
        </small>

    </div>


    {{-- MEJA TERSEDIA --}}

    <div class="dashboard-card">

        <p class="dashboard-label">
            Meja Tersedia
        </p>

        <h2>
            {{ $mejaTersedia }}
        </h2>

        <small>
            Siap digunakan pelanggan
        </small>

    </div>


    {{-- TOTAL PESANAN --}}

    <div class="dashboard-card">

        <p class="dashboard-label">
            Total Pesanan
        </p>

        <h2>
            {{ $totalPesanan }}
        </h2>

        <small>
            Semua pesanan
        </small>

    </div>

</div>


{{-- =========================
     STATUS PESANAN
========================= --}}

<div class="card" style="margin-bottom:25px;">

    <div style="margin-bottom:20px;">

        <h2 style="margin-bottom:5px;">
            Status Pesanan
        </h2>

        <p style="
            color:#888;
            font-size:13px;
            margin:0;
        ">
            Kondisi pesanan pelanggan saat ini.
        </p>

    </div>


    <div style="
        display:grid;
        grid-template-columns:repeat(4, 1fr);
        gap:15px;
    ">


        {{-- MENUNGGU --}}

        <div style="
            padding:20px;
            border-radius:12px;
            background:#fff8e6;
            border:1px solid #f5e2a8;
        ">

            <div style="
                font-size:13px;
                color:#947000;
                margin-bottom:8px;
            ">
                Menunggu
            </div>

            <strong style="
                font-size:28px;
                color:#806000;
            ">
                {{ $pesananMenunggu }}
            </strong>

        </div>


        {{-- DIPROSES --}}

        <div style="
            padding:20px;
            border-radius:12px;
            background:#eef5ff;
            border:1px solid #d7e5ff;
        ">

            <div style="
                font-size:13px;
                color:#3565a8;
                margin-bottom:8px;
            ">
                Diproses
            </div>

            <strong style="
                font-size:28px;
                color:#315d9b;
            ">
                {{ $pesananDiproses }}
            </strong>

        </div>


        {{-- SELESAI --}}

        <div style="
            padding:20px;
            border-radius:12px;
            background:#edf9f0;
            border:1px solid #d4edd9;
        ">

            <div style="
                font-size:13px;
                color:#39804a;
                margin-bottom:8px;
            ">
                Selesai
            </div>

            <strong style="
                font-size:28px;
                color:#327341;
            ">
                {{ $pesananSelesai }}
            </strong>

        </div>


        {{-- DIBATALKAN --}}

        <div style="
            padding:20px;
            border-radius:12px;
            background:#fff0f0;
            border:1px solid #f2d1d1;
        ">

            <div style="
                font-size:13px;
                color:#a33b3b;
                margin-bottom:8px;
            ">
                Dibatalkan
            </div>

            <strong style="
                font-size:28px;
                color:#9b3030;
            ">
                {{ $pesananDibatalkan }}
            </strong>

        </div>

    </div>

</div>


{{-- =========================
     PESANAN TERBARU
========================= --}}

<div style="
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:20px;
">


    <div class="card">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        ">

            <div>

                <h2 style="margin-bottom:5px;">
                    Pesanan Terbaru
                </h2>

                <p style="
                    color:#888;
                    font-size:13px;
                    margin:0;
                ">
                    Lima pesanan terakhir yang masuk.
                </p>

            </div>


            <a
                href="{{ route('admin.pesanan') }}"
                style="
                    color:#8b0000;
                    text-decoration:none;
                    font-size:13px;
                    font-weight:bold;
                "
            >
                Lihat Semua
            </a>

        </div>


        @forelse($pesananTerbaru as $pesanan)

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                gap:15px;
                padding:15px 0;
                border-bottom:1px solid #eee;
            ">


                <div>

                    <strong style="color:#8b0000;">
                        {{ $pesanan->kode_pesanan }}
                    </strong>

                    <div style="
                        font-size:13px;
                        margin-top:5px;
                    ">
                        {{ $pesanan->nama_pelanggan }}
                    </div>

                    <small style="color:#999;">
                        Meja {{ $pesanan->meja->nomor_meja ?? '-' }}
                    </small>

                </div>


                <div style="text-align:right;">

                    <strong style="
                        color:#8b0000;
                        font-size:14px;
                    ">
                        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                    </strong>

                    <div style="
                        margin-top:5px;
                        font-size:11px;
                        color:#888;
                    ">
                        {{ ucfirst($pesanan->status) }}
                    </div>

                </div>

            </div>

        @empty

            <div style="
                text-align:center;
                padding:35px 10px;
                color:#999;
            ">
                Belum ada pesanan.
            </div>

        @endforelse

    </div>


    {{-- =========================
         AKSI CEPAT
    ========================= --}}

    <div class="card">

        <h2 style="margin-bottom:5px;">
            Aksi Cepat
        </h2>

        <p style="
            color:#888;
            font-size:13px;
            margin-bottom:20px;
        ">
            Akses fitur yang sering digunakan.
        </p>


        <a
            href="{{ route('admin.menu.create') }}"
            class="quick-action"
        >
            Tambah Menu
        </a>


        <a
            href="{{ route('admin.meja.create') }}"
            class="quick-action"
        >
            Tambah Meja
        </a>


        <a
            href="{{ route('admin.pesanan') }}"
            class="quick-action"
        >
            Lihat Pesanan
        </a>


        <a
            href="{{ route('admin.laporan') }}"
            class="quick-action"
        >
            Lihat Laporan
        </a>

    </div>

</div>


{{-- =========================
     STYLE
========================= --}}

<style>

    .dashboard-card {
        background:white;
        padding:20px;
        border-radius:14px;
        box-shadow:0 4px 15px rgba(0,0,0,0.05);
    }


    .dashboard-label {
        margin:0 0 8px 0;
        color:#888;
        font-size:13px;
    }


    .dashboard-card h2 {
        margin:0 0 5px 0;
        color:#8b0000;
        font-size:30px;
    }


    .dashboard-card small {
        color:#aaa;
        font-size:11px;
    }


    .quick-action {
        display:block;
        padding:13px;
        margin-bottom:10px;
        border-radius:9px;
        background:#fafafa;
        color:#333;
        text-decoration:none;
        font-size:13px;
        font-weight:600;
        transition:.2s;
    }


    .quick-action:hover {
        background:#fff4f4;
        color:#8b0000;
    }


    @media(max-width:900px) {

        .dashboard-card {
            padding:15px;
        }

    }


    @media(max-width:700px) {

        .dashboard-card {
            grid-column:span 2;
        }

    }


    @media(max-width:600px) {

        .dashboard-card {
            grid-column:span 4;
        }

    }

</style>

@endsection