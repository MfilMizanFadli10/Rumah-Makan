@extends('layouts.customer')

@section('title', 'Riwayat - Rumah Makan')

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
            RIWAYAT
        </div>

        <h1 style="
            font-size:36px;
            margin-bottom:10px;
        ">
            Riwayat Anda
        </h1>

        <p style="color:#777;">
            Lihat kembali pesanan dan reservasi yang telah Anda lakukan.
        </p>

    </div>


    {{-- ================================================= --}}
    {{-- RIWAYAT PESANAN --}}
    {{-- ================================================= --}}

    <div style="
        max-width:900px;
        margin:0 auto 30px;
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.08);
    ">

        <h2 style="
            color:#650000;
            margin-bottom:20px;
        ">
             Riwayat Pesanan
        </h2>


        @forelse($pesanans as $pesanan)

            <div style="
                padding:20px 0;
                border-bottom:1px solid #eee;
            ">

                <div style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    gap:15px;
                    flex-wrap:wrap;
                ">

                    <div>

                        <strong style="
                            color:#8b0000;
                            font-size:18px;
                        ">
                            {{ $pesanan->kode_pesanan }}
                        </strong>

                        <p style="
                            margin-top:6px;
                            color:#777;
                            font-size:14px;
                        ">
                            {{ $pesanan->tanggal_pesanan }}
                            •
                            {{ $pesanan->jam_pesanan }}
                        </p>

                    </div>


                    <div style="
                        font-weight:bold;
                        color:#8b0000;
                    ">
                        Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}
                    </div>

                </div>


                <div style="
                    margin-top:12px;
                    color:#555;
                    font-size:14px;
                ">

                    <p>
                        <strong>Nama:</strong>
                        {{ $pesanan->nama_pelanggan }}
                    </p>

                    <p style="margin-top:5px;">
                        <strong>Meja:</strong>
                        Meja {{ $pesanan->meja->nomor_meja ?? '-' }}
                    </p>

                    <p style="margin-top:5px;">
                        <strong>Status:</strong>
                        {{ ucfirst($pesanan->status) }}
                    </p>

                </div>

            </div>

        @empty

            <div style="
                text-align:center;
                padding:25px;
                color:#777;
            ">
                 Belum ada riwayat pesanan.
            </div>

        @endforelse

    </div>


    {{-- ================================================= --}}
    {{-- RIWAYAT RESERVASI --}}
    {{-- ================================================= --}}

    <div style="
        max-width:900px;
        margin:0 auto;
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.08);
    ">

        <h2 style="
            color:#650000;
            margin-bottom:20px;
        ">
             Riwayat Reservasi
        </h2>


        @forelse($reservasis as $reservasi)

            <div style="
                padding:20px 0;
                border-bottom:1px solid #eee;
            ">

                <div style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    gap:15px;
                    flex-wrap:wrap;
                ">

                    <div>

                        <strong style="
                            color:#8b0000;
                            font-size:18px;
                        ">
                            Meja {{ $reservasi->meja->nomor_meja ?? '-' }}
                        </strong>

                        <p style="
                            margin-top:6px;
                            color:#777;
                            font-size:14px;
                        ">
                            {{ $reservasi->tanggal_pesanan }}
                            •
                            {{ $reservasi->jam_pesanan }}
                        </p>

                    </div>


                    <div style="
                        padding:7px 13px;
                        background:#fff3cd;
                        color:#856404;
                        border-radius:20px;
                        font-size:13px;
                        font-weight:bold;
                    ">
                        Reservasi
                    </div>

                </div>


                <div style="
                    margin-top:12px;
                    color:#555;
                    font-size:14px;
                ">

                    <p>
                        <strong>Nama:</strong>
                        {{ $reservasi->nama_pelanggan }}
                    </p>

                    <p style="margin-top:5px;">
                        <strong>No. HP:</strong>
                        {{ $reservasi->no_hp }}
                    </p>

                    <p style="margin-top:5px;">
                        <strong>Jumlah Orang:</strong>
                        {{ $reservasi->jumlah_orang }} orang
                    </p>

                    @if($reservasi->catatan)

                        <p style="margin-top:5px;">
                            <strong>Catatan:</strong>
                            {{ $reservasi->catatan }}
                        </p>

                    @endif

                </div>

            </div>

        @empty

            <div style="
                text-align:center;
                padding:25px;
                color:#777;
            ">
                 Belum ada riwayat reservasi.
            </div>

        @endforelse

    </div>

</div>

@endsection