@extends('layouts.customer')

@section('title', 'Status Pesanan - Rumah Makan')

@section('content')

<div style="padding:60px 8%;">

    {{-- JUDUL --}}
    <div style="
        text-align:center;
        margin-bottom:40px;
    ">

        <div style="
            color:#b00000;
            font-weight:bold;
            letter-spacing:2px;
            margin-bottom:10px;
        ">
            STATUS PESANAN
        </div>

        <h1 style="
            font-size:36px;
            margin-bottom:10px;
        ">
            Pesanan Anda
        </h1>

        <p style="color:#777;">
            Pantau perkembangan pesanan Anda di sini.
        </p>

    </div>


    {{-- PESAN BERHASIL --}}
    @if(session('success'))

        <div style="
            max-width:800px;
            margin:0 auto 20px;
            padding:15px 20px;
            background:#e8f7ee;
            color:#176b3a;
            border:1px solid #b8e5c8;
            border-radius:10px;
        ">
            ✓ {{ session('success') }}
        </div>

    @endif


    @if($pesanan)

        <div style="
            max-width:800px;
            margin:auto;
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,0.08);
        ">


            {{-- ================================= --}}
            {{-- HEADER PESANAN --}}
            {{-- ================================= --}}

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                gap:20px;
                padding-bottom:20px;
                border-bottom:1px solid #eee;
                flex-wrap:wrap;
            ">

                <div>

                    <p style="
                        color:#777;
                        margin-bottom:5px;
                        font-size:14px;
                    ">
                        Kode Pesanan
                    </p>

                    <h2 style="
                        color:#8b0000;
                        margin:0;
                        letter-spacing:1px;
                    ">
                        {{ $pesanan->kode_pesanan }}
                    </h2>

                </div>


                {{-- STATUS --}}
                @php

                    /*
                     * Status database menggunakan huruf kecil:
                     * menunggu, diproses, selesai, dibatalkan
                     *
                     * strtolower() membuat halaman tetap aman
                     * walaupun ada data lama dengan huruf kapital.
                     */
                    $status = strtolower($pesanan->status);

                    $statusBackground = '#fff3cd';
                    $statusColor = '#856404';
                    $statusIcon = '🟡';
                    $statusText = 'Menunggu';

                    if ($status === 'diproses') {

                        $statusBackground = '#dbeafe';
                        $statusColor = '#1d4ed8';
                        $statusIcon = '🔵';
                        $statusText = 'Diproses';

                    } elseif ($status === 'selesai') {

                        $statusBackground = '#dcfce7';
                        $statusColor = '#166534';
                        $statusIcon = '🟢';
                        $statusText = 'Selesai';

                    } elseif ($status === 'dibatalkan') {

                        $statusBackground = '#fee2e2';
                        $statusColor = '#991b1b';
                        $statusIcon = '🔴';
                        $statusText = 'Dibatalkan';

                    }

                @endphp


                <div style="
                    padding:10px 18px;
                    border-radius:20px;
                    background:{{ $statusBackground }};
                    color:{{ $statusColor }};
                    font-weight:bold;
                ">

                    {{ $statusIcon }}
                    {{ $statusText }}

                </div>

            </div>


            {{-- ================================= --}}
            {{-- PROGRESS STATUS --}}
            {{-- ================================= --}}

            @if($status !== 'dibatalkan')

                <div style="
                    margin-top:30px;
                    padding:20px;
                    background:#fafafa;
                    border-radius:12px;
                ">

                    <h3 style="
                        margin-bottom:20px;
                    ">
                        Perkembangan Pesanan
                    </h3>


                    <div style="
                        display:flex;
                        justify-content:space-between;
                        align-items:flex-start;
                        gap:10px;
                    ">


                        {{-- ================================= --}}
                        {{-- MENUNGGU --}}
                        {{-- ================================= --}}

                        <div style="
                            flex:1;
                            text-align:center;
                        ">

                            <div style="
                                width:40px;
                                height:40px;
                                margin:auto;
                                border-radius:50%;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                background:{{ in_array($status, ['menunggu', 'diproses', 'selesai']) ? '#8b0000' : '#ddd' }};
                                color:{{ in_array($status, ['menunggu', 'diproses', 'selesai']) ? 'white' : '#777' }};
                                font-weight:bold;
                            ">

                                @if(in_array($status, ['menunggu', 'diproses', 'selesai']))
                                    ✓
                                @else
                                    1
                                @endif

                            </div>

                            <p style="
                                margin-top:8px;
                                font-size:13px;
                                font-weight:bold;
                            ">
                                Menunggu
                            </p>

                        </div>


                        {{-- ================================= --}}
                        {{-- GARIS 1 --}}
                        {{-- ================================= --}}

                        <div style="
                            flex:1;
                            height:2px;
                            margin-top:20px;
                            background:{{ in_array($status, ['diproses', 'selesai']) ? '#8b0000' : '#ddd' }};
                        "></div>


                        {{-- ================================= --}}
                        {{-- DIPROSES --}}
                        {{-- ================================= --}}

                        <div style="
                            flex:1;
                            text-align:center;
                        ">

                            <div style="
                                width:40px;
                                height:40px;
                                margin:auto;
                                border-radius:50%;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                background:{{ in_array($status, ['diproses', 'selesai']) ? '#8b0000' : '#ddd' }};
                                color:{{ in_array($status, ['diproses', 'selesai']) ? 'white' : '#777' }};
                                font-weight:bold;
                            ">

                                @if(in_array($status, ['diproses', 'selesai']))
                                    ✓
                                @else
                                    2
                                @endif

                            </div>

                            <p style="
                                margin-top:8px;
                                font-size:13px;
                                font-weight:bold;
                            ">
                                Diproses
                            </p>

                        </div>


                        {{-- ================================= --}}
                        {{-- GARIS 2 --}}
                        {{-- ================================= --}}

                        <div style="
                            flex:1;
                            height:2px;
                            margin-top:20px;
                            background:{{ $status === 'selesai' ? '#8b0000' : '#ddd' }};
                        "></div>


                        {{-- ================================= --}}
                        {{-- SELESAI --}}
                        {{-- ================================= --}}

                        <div style="
                            flex:1;
                            text-align:center;
                        ">

                            <div style="
                                width:40px;
                                height:40px;
                                margin:auto;
                                border-radius:50%;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                background:{{ $status === 'selesai' ? '#8b0000' : '#ddd' }};
                                color:{{ $status === 'selesai' ? 'white' : '#777' }};
                                font-weight:bold;
                            ">

                                @if($status === 'selesai')
                                    ✓
                                @else
                                    3
                                @endif

                            </div>

                            <p style="
                                margin-top:8px;
                                font-size:13px;
                                font-weight:bold;
                            ">
                                Selesai
                            </p>

                        </div>

                    </div>

                </div>

            @else

                {{-- PESANAN DIBATALKAN --}}

                <div style="
                    margin-top:25px;
                    padding:20px;
                    background:#fff1f1;
                    border:1px solid #f3c2c2;
                    border-radius:12px;
                    color:#991b1b;
                ">

                    <strong>
                        🔴 Pesanan Dibatalkan
                    </strong>

                    <p style="
                        margin-top:7px;
                        font-size:14px;
                    ">
                        Pesanan ini telah dibatalkan oleh pihak rumah makan.
                    </p>

                </div>

            @endif


            {{-- ================================= --}}
            {{-- TOMBOL REFRESH --}}
            {{-- ================================= --}}

            <div style="
                margin-top:20px;
                text-align:right;
            ">

                {{-- REFRESH --}}
                <button
                    onclick="location.reload()"
                    type="button"
                    style="
                        background:#f5f5f5;
                        color:#555;
                        border:1px solid #ddd;
                        padding:10px 16px;
                        border-radius:8px;
                        cursor:pointer;
                        font-weight:600;
                    "
                >
                    🔄 Refresh Status
                </button>

            </div>


            {{-- ================================= --}}
            {{-- DATA PESANAN --}}
            {{-- ================================= --}}

            <div style="
                margin-top:30px;
                padding-top:25px;
                border-top:1px solid #eee;
            ">

                <h2 style="
                    margin-bottom:20px;
                ">
                    Data Pesanan
                </h2>


                <p style="margin-bottom:10px;">
                    <strong>Nama:</strong>
                    {{ $pesanan->nama_pelanggan }}
                </p>


                <p style="margin-bottom:10px;">
                    <strong>Meja:</strong>
                    Meja {{ $pesanan->meja->nomor_meja ?? '-' }}
                </p>


                <p style="margin-bottom:10px;">
                    <strong>Jumlah Orang:</strong>
                    {{ $pesanan->jumlah_orang }} orang
                </p>


                <p style="margin-bottom:10px;">
                    <strong>Metode Pembayaran:</strong>
                    {{ ucfirst($pesanan->metode_pembayaran) }}
                </p>


                <p style="margin-bottom:10px;">
                    <strong>Tanggal:</strong>
                    {{ $pesanan->tanggal_pesanan }}
                </p>


                <p>
                    <strong>Jam:</strong>
                    {{ $pesanan->jam_pesanan }}
                </p>

            </div>


            {{-- ================================= --}}
            {{-- DETAIL MENU --}}
            {{-- ================================= --}}

            <div style="
                margin-top:30px;
                padding-top:25px;
                border-top:1px solid #eee;
            ">

                <h2 style="
                    margin-bottom:20px;
                ">
                    Detail Menu
                </h2>


                @foreach($pesanan->detailPesanan as $detail)

                    <div style="
                        display:flex;
                        justify-content:space-between;
                        align-items:center;
                        gap:15px;
                        padding:12px 0;
                        border-bottom:1px solid #eee;
                    ">

                        <div>

                            <strong>
                                {{ $detail->menu->nama_menu ?? '-' }}
                            </strong>

                            <div style="
                                color:#777;
                                font-size:14px;
                                margin-top:4px;
                            ">
                                {{ $detail->jumlah }} ×
                                Rp{{ number_format($detail->harga, 0, ',', '.') }}
                            </div>

                        </div>


                        <strong style="
                            color:#8b0000;
                        ">
                            Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                        </strong>

                    </div>

                @endforeach

            </div>


            {{-- ================================= --}}
            {{-- TOTAL --}}
            {{-- ================================= --}}

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-top:25px;
                padding-top:20px;
                border-top:2px solid #eee;
            ">

                <strong style="
                    font-size:18px;
                ">
                    Total Pesanan
                </strong>

                <strong style="
                    color:#8b0000;
                    font-size:22px;
                ">
                    Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}
                </strong>

            </div>

        </div>

    @else

        {{-- ================================= --}}
        {{-- BELUM ADA PESANAN --}}
        {{-- ================================= --}}

        <div style="
            max-width:600px;
            margin:auto;
            background:white;
            padding:40px;
            border-radius:15px;
            text-align:center;
            box-shadow:0 5px 20px rgba(0,0,0,0.08);
        ">

            <div style="
                font-size:55px;
                margin-bottom:15px;
            ">
                🛒
            </div>

            <h2>
                Belum Ada Pesanan
            </h2>

            <p style="
                color:#777;
                margin:15px 0 25px;
            ">
                Anda belum memiliki pesanan yang sedang dipantau.
            </p>

            <a
                href="{{ route('customer.menu') }}"
                style="
                    display:inline-block;
                    background:#8b0000;
                    color:white;
                    padding:12px 22px;
                    border-radius:8px;
                    text-decoration:none;
                "
            >
                Lihat Menu
            </a>

        </div>

    @endif

</div>

@endsection