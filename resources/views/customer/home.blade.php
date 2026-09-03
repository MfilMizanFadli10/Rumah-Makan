@extends('layouts.customer')

@php
    $pengaturan = \App\Models\Pengaturan::first();
@endphp

@section('title', 'Beranda - Rumah Makan')

@section('content')

{{-- =====================================================
     STYLE RESPONSIF
===================================================== --}}
<style>

    /* =========================
       DESKTOP
    ========================= */

    .hero-container {
        min-height: 520px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 70px 8%;
        background: linear-gradient(135deg, #fff8f5, #ffffff);
        gap: 40px;
        box-sizing: border-box;
        overflow: hidden;
    }

    .hero-left {
        flex: 1;
        max-width: 55%;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .hero-right {
        flex: 1;
        max-width: 45%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hero-title {
        font-size: 48px;
        line-height: 1.2;
        margin-bottom: 20px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .hero-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .hero-btn {
        display: inline-block;
        text-align: center;
        text-decoration: none;
        padding: 13px 22px;
        border-radius: 8px;
        font-weight: bold;
        box-sizing: border-box;
    }

    .grid-3-col {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }

    .cta-section {
        margin: 0 8% 60px;
        padding: 45px 20px;
        border-radius: 18px;
        background: #8b0000;
        color: white;
        text-align: center;
    }

    /* =========================
       GOOGLE MAPS
    ========================= */

    .full-maps-wrapper {
        margin-top: 35px;
        width: 100%;
        background: white;
        border-radius: 18px;
        padding: 24px;
        box-sizing: border-box;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .full-maps-iframe-container {
        width: 100%;
        height: 500px;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #eee;
    }

    .full-maps-iframe-container iframe {
        width: 100% !important;
        height: 100% !important;
        border: 0;
    }

    /* =========================
       SECTION
    ========================= */

    .section-padding {
        padding: 60px 8%;
    }


    /* =========================
       TABLET
    ========================= */

    @media (max-width: 992px) {

        .hero-container {
            flex-direction: column-reverse;
            text-align: center;
            padding: 50px 5%;
            min-height: auto;
        }

        .hero-left,
        .hero-right {
            max-width: 100%;
            width: 100%;
        }

        .hero-title {
            font-size: 36px;
        }

        .hero-buttons {
            justify-content: center;
        }

        .grid-3-col {
            grid-template-columns: repeat(2, 1fr);
        }

        .section-padding {
            padding: 50px 5%;
        }

        .full-maps-iframe-container {
            height: 380px;
        }
    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 576px) {

        .hero-container {
            padding: 30px 16px;
            min-height: auto;
            gap: 24px;
        }

        .hero-title {
            font-size: 24px;
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .hero-left p {
            font-size: 14px !important;
            margin-bottom: 20px !important;
        }

        .hero-buttons {
            flex-direction: column;
            width: 100%;
            gap: 10px;
        }

        .hero-btn {
            width: 100%;
            padding: 12px 16px;
        }

        .grid-3-col {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .cta-section {
            margin: 0 16px 40px;
            padding: 30px 16px;
        }

        .cta-section h2 {
            font-size: 22px !important;
        }

        .section-padding {
            padding: 40px 16px;
        }

        .full-maps-wrapper {
            padding: 12px;
            margin-top: 20px;
        }

        .full-maps-iframe-container {
            height: 300px;
        }
    }

</style>


{{-- =====================================================
     HERO
===================================================== --}}

<section class="hero-container">

    {{-- BAGIAN KIRI --}}
    <div class="hero-left">

        <div style="
            color:#b00000;
            font-weight:bold;
            letter-spacing:2px;
            margin-bottom:10px;
            font-size:13px;
        ">
            SELAMAT DATANG
        </div>

        <h1 class="hero-title">

            Nikmati Hidangan Lezat

            <br>

            di

            <span style="color:#8b0000;">
                {{ $pengaturan?->nama_rumah_makan ?? 'Rumah Makan' }}
            </span>

        </h1>

        <p style="
            color:#777;
            font-size:16px;
            line-height:1.6;
            margin-bottom:30px;
            word-wrap: break-word;
        ">
            {{ $pengaturan?->tagline
                ?? 'Pesan makanan favoritmu sebelum datang dan reservasi meja dengan mudah.' }}
        </p>


        {{-- TOMBOL --}}
        <div class="hero-buttons">

            <a
                href="{{ route('customer.menu') }}"
                class="hero-btn"
                style="
                    background:#8b0000;
                    color:white;
                "
            >
                Lihat Menu
            </a>


            <a
                href="{{ route('customer.reservasi') }}"
                class="hero-btn"
                style="
                    background:white;
                    color:#8b0000;
                    border:1px solid #8b0000;
                "
            >
                Reservasi Meja
            </a>

        </div>

    </div>


    {{-- BAGIAN KANAN / BANNER --}}
    <div class="hero-right">

        @if($pengaturan?->banner)

            <img
                src="{{ asset('storage/' . $pengaturan->banner) }}"
                alt="{{ $pengaturan?->nama_rumah_makan ?? 'Banner Rumah Makan' }}"
                style="
                    width:100%;
                    max-width:520px;
                    height:auto;
                    max-height:350px;
                    object-fit:cover;
                    border-radius:16px;
                    display:block;
                    box-shadow:0 10px 25px rgba(139,0,0,0.15);
                "
            >

        @else

            <div style="
                width:100%;
                max-width:420px;
                height:200px;
                border-radius:16px;
                background:#8b0000;
                display:flex;
                align-items:center;
                justify-content:center;
                font-size:60px;
                color:white;
                box-shadow:0 10px 25px rgba(139,0,0,0.15);
            ">
                <i class="fas fa-utensils"></i>
            </div>

        @endif

    </div>

</section>



{{-- =====================================================
     FITUR
===================================================== --}}

<section
    class="section-padding"
    style="background:white;"
>

    <div style="
        text-align:center;
        margin-bottom:30px;
    ">

        <h2 style="
            font-size:26px;
            margin-bottom:8px;
        ">
            Kenapa Memilih Kami?
        </h2>

        <p style="
            color:#777;
            font-size:14px;
        ">
            Nikmati kemudahan layanan Rumah Makan kami.
        </p>

    </div>


    <div class="grid-3-col">


        {{-- =================================================
             MENU LEZAT
        ================================================= --}}

        <div style="
            padding:24px 20px;
            border-radius:15px;
            background:#fff8f5;
            text-align:center;
        ">

            <div style="
                font-size:36px;
                color:#555;
            ">
                <i class="fas fa-bowl-food"></i>
            </div>

            <h3 style="
                margin:12px 0 8px;
                font-size:18px;
            ">
                Menu Lezat
            </h3>

            <p style="
                color:#777;
                line-height:1.5;
                font-size:14px;
            ">
                Berbagai pilihan makanan dan minuman
                favorit untuk menemani waktu makanmu.
            </p>

        </div>



        {{-- =================================================
             RESERVASI
        ================================================= --}}

        <div style="
            padding:24px 20px;
            border-radius:15px;
            background:#fff8f5;
            text-align:center;
        ">

            <div style="
                font-size:36px;
                color:#555;
            ">
                <i class="fas fa-chair"></i>
            </div>

            <h3 style="
                margin:12px 0 8px;
                font-size:18px;
            ">
                Reservasi Meja
            </h3>

            <p style="
                color:#777;
                line-height:1.5;
                font-size:14px;
            ">
                Pesan meja terlebih dahulu agar
                tempat makanmu sudah siap.
            </p>

        </div>



        {{-- =================================================
             PRAKTIS
        ================================================= --}}

        <div style="
            padding:24px 20px;
            border-radius:15px;
            background:#fff8f5;
            text-align:center;
        ">

            <div style="
                font-size:36px;
                color:#555;
            ">
                <i class="fas fa-bolt"></i>
            </div>

            <h3 style="
                margin:12px 0 8px;
                font-size:18px;
            ">
                Praktis & Mudah
            </h3>

            <p style="
                color:#777;
                line-height:1.5;
                font-size:14px;
            ">
                Pesan makanan dan reservasi tanpa
                harus menunggu lama.
            </p>

        </div>

    </div>

</section>



{{-- =====================================================
     INFORMASI RUMAH MAKAN
===================================================== --}}

<section
    class="section-padding"
    style="background:#fff8f5;"
>

    <div style="
        text-align:center;
        margin-bottom:30px;
    ">

        <h2 style="
            font-size:26px;
            margin-bottom:8px;
        ">
            Informasi Rumah Makan
        </h2>

        <p style="
            color:#777;
            font-size:14px;
        ">
            Temukan informasi lengkap tentang
            {{ $pengaturan?->nama_rumah_makan ?? 'rumah makan kami' }}.
        </p>

    </div>



    {{-- =================================================
         3 CARD INFORMASI
    ================================================= --}}

    <div class="grid-3-col">


        {{-- =================================================
             LOKASI
        ================================================= --}}

        <div style="
            background:white;
            padding:24px 20px;
            border-radius:15px;
            text-align:center;
        ">

            <div style="
                font-size:32px;
                margin-bottom:5px;
                color:#555;
            ">
                <i class="fas fa-location-dot"></i>
            </div>

            <h3 style="
                margin:10px 0;
                font-size:18px;
            ">
                Lokasi Kami
            </h3>

            <p style="
                color:#777;
                line-height:1.5;
                font-size:14px;
                word-wrap:break-word;
            ">
                {{ $pengaturan?->alamat ?? 'Alamat belum tersedia' }}
            </p>

        </div>



        {{-- =================================================
             JAM OPERASIONAL
        ================================================= --}}

        <div style="
            background:white;
            padding:24px 20px;
            border-radius:15px;
            text-align:center;
        ">

            <div style="
                font-size:32px;
                margin-bottom:5px;
                color:#555;
            ">
                <i class="fas fa-clock"></i>
            </div>

            <h3 style="
                margin:10px 0;
                font-size:18px;
            ">
                Jam Operasional
            </h3>

            <p style="
                color:#777;
                line-height:1.5;
                font-size:14px;
                word-wrap:break-word;
            ">
                {{ $pengaturan?->jam_operasional
                    ?? 'Jam operasional belum tersedia' }}
            </p>

        </div>



        {{-- =================================================
             KONTAK
        ================================================= --}}

        <div style="
            background:white;
            padding:24px 20px;
            border-radius:15px;
            text-align:center;
        ">

            <div style="
                font-size:32px;
                margin-bottom:5px;
                color:#555;
            ">
                <i class="fas fa-phone"></i>
            </div>

            <h3 style="
                margin:10px 0;
                font-size:18px;
            ">
                Hubungi Kami
            </h3>

            <p style="
                color:#777;
                line-height:1.5;
                font-size:14px;
                word-wrap:break-word;
            ">
                {{ $pengaturan?->no_hp
                    ?? 'Nomor telepon belum tersedia' }}
            </p>


            @if($pengaturan?->email)

                <p style="
                    color:#777;
                    font-size:13px;
                    margin-top:5px;
                    word-wrap:break-word;
                ">
                    {{ $pengaturan->email }}
                </p>

            @endif

        </div>

    </div>

        {{-- =================================================
         FASILITAS RUMAH MAKAN
    ================================================= --}}

    @if(isset($fasilitas) && $fasilitas->count())

        <div style="
            margin-top:35px;
        ">

            <div style="
                text-align:center;
                margin-bottom:25px;
            ">

                <h2 style="
                    font-size:24px;
                    margin-bottom:8px;
                ">
                    Fasilitas Rumah Makan
                </h2>

                <p style="
                    color:#777;
                    font-size:14px;
                ">
                    Fasilitas yang tersedia untuk kenyamanan pelanggan.
                </p>

            </div>


            <div class="grid-3-col">

                @foreach($fasilitas as $item)

                    <div style="
                        background:white;
                        border-radius:15px;
                        overflow:hidden;
                        text-align:center;
                        box-shadow:0 4px 15px rgba(0,0,0,0.05);
                    ">

                        {{-- FOTO --}}
                        @if($item->foto)

                            <img
                                src="{{ asset('storage/' . $item->foto) }}"
                                alt="{{ $item->nama_fasilitas }}"
                                style="
                                    width:100%;
                                    height:200px;
                                    object-fit:cover;
                                    display:block;
                                "
                            >

                        @else

                            <div style="
                                width:100%;
                                height:200px;
                                background:#f5f5f5;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                color:#999;
                                font-size:40px;
                            ">
                                <i class="fas fa-house"></i>
                            </div>

                        @endif


                        {{-- INFORMASI FASILITAS --}}
                        <div style="
                            padding:20px;
                        ">

                            <h3 style="
                                margin:0 0 8px;
                                font-size:18px;
                                color:#333;
                            ">
                                {{ $item->nama_fasilitas }}
                            </h3>

                            <p style="
                                margin:0;
                                color:#777;
                                font-size:14px;
                                line-height:1.6;
                            ">
                                {{ $item->deskripsi ?: 'Fasilitas untuk kenyamanan pelanggan.' }}
                            </p>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @endif


    {{-- =================================================
         GOOGLE MAPS
    ================================================= --}}

    <div class="full-maps-wrapper">

        <div class="full-maps-iframe-container">

            @if($pengaturan?->maps)

                <iframe
                    src="{{ $pengaturan->maps }}"
                    width="600"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin"
                ></iframe>

            @else

                <iframe
                    src="https://www.google.com/maps/embed?pb=!3m2!1sid!2sid!4v1788335559986!5m2!1sid!2sid!6m8!1m7!1sAIsjaJLpygCYLNX0MP_oEg!2m2!1d-0.9088508376912241!2d100.3534347102158!3f137.76248!4f0!5f0.7820865974627469"
                    width="600"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin"
                ></iframe>

            @endif

        </div>


        <div style="
            margin-top:20px;
            text-align:center;
        ">

                 <a
                    href="https://www.google.com/maps/search/{{ urlencode($pengaturan?->alamat ?? 'restaurant') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    style="
                        display:inline-block;
                        background:#8b0000;
                        color:white;
                        text-decoration:none;
                        padding:12px 32px;
                        border-radius:8px;
                        font-weight:bold;
                        font-size:14px;
                        box-sizing:border-box;
                    "
                >
                    <i class="fas fa-map"></i>
                    &nbsp;
                    Buka Lengkap di Google Maps
                </a>

        </div>

    </div>

</section>



{{-- =====================================================
     CTA
===================================================== --}}

<section class="cta-section">

    <h2 style="
        font-size:28px;
        margin-bottom:10px;
    ">
        Siap Memesan?
    </h2>

    <p style="
        margin-bottom:20px;
        opacity:.9;
        font-size:14px;
    ">
        Pilih menu favoritmu dan lakukan reservasi sekarang.
    </p>

    <a
        href="{{ route('customer.menu') }}"
        class="hero-btn"
        style="
            background:white;
            color:#8b0000;
        "
    >
        Pesan Sekarang →
    </a>

</section>

@endsection