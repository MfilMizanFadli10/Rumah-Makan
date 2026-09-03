@extends('layouts.customer')

@section('title', 'Testimoni - Rumah Makan')

@section('content')

<div style="padding:60px 8%;">

    <div style="
        max-width:650px;
        margin:auto;
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.08);
    ">

        <div style="text-align:center; margin-bottom:30px;">

            <div style="
                color:#b00000;
                font-weight:bold;
                letter-spacing:2px;
                margin-bottom:10px;
            ">
                TESTIMONI
            </div>

            <h1 style="margin-bottom:10px;">
                Bagikan Pengalaman Anda
            </h1>

            <p style="color:#777;">
                Berikan penilaian dan pengalaman Anda setelah melakukan pemesanan.
            </p>

        </div>


        @if(session('success'))

            <div style="
                background:#e8f7ee;
                color:#176b3a;
                padding:12px 15px;
                border-radius:8px;
                margin-bottom:20px;
            ">
                {{ session('success') }}
            </div>

        @endif


        @if($errors->any())

            <div style="
                background:#fff0f0;
                color:#8b0000;
                padding:12px 15px;
                border-radius:8px;
                margin-bottom:20px;
            ">

                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif


        <form action="{{ route('customer.testimoni.store') }}" method="POST">

            @csrf


            {{-- NAMA --}}

            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Nama Pelanggan
                </label>

                <input
                    type="text"
                    name="nama_pelanggan"
                    value="{{ old('nama_pelanggan') }}"
                    placeholder="Masukkan nama Anda"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                    "
                >

            </div>


            {{-- KODE PESANAN --}}

            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Kode Pesanan
                </label>

                <input
                    type="text"
                    name="kode_pesanan"
                    value="{{ old('kode_pesanan') }}"
                    placeholder="Contoh: ORD-001"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                    "
                >

            </div>


            {{-- RATING --}}

            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Rating
                </label>

                <select
                    name="rating"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                    "
                >

                    <option value="">
                        -- Pilih Rating --
                    </option>

                    <option value="5">⭐⭐⭐⭐⭐ — Sangat Baik</option>
                    <option value="4">⭐⭐⭐⭐ — Baik</option>
                    <option value="3">⭐⭐⭐ — Cukup</option>
                    <option value="2">⭐⭐ — Kurang</option>
                    <option value="1">⭐ — Sangat Kurang</option>

                </select>

            </div>


            {{-- TESTIMONI --}}

            <div style="margin-bottom:25px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Testimoni
                </label>

                <textarea
                    name="isi_testimoni"
                    rows="5"
                    placeholder="Ceritakan pengalaman Anda..."
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        resize:vertical;
                        box-sizing:border-box;
                    "
                >{{ old('isi_testimoni') }}</textarea>

            </div>


            {{-- TOMBOL --}}

            <button
                type="submit"
                style="
                    width:100%;
                    background:#8b0000;
                    color:white;
                    border:none;
                    padding:14px;
                    border-radius:8px;
                    font-weight:bold;
                    cursor:pointer;
                    font-size:15px;
                "
            >
                ⭐ Kirim Testimoni
            </button>

        </form>

    </div>

</div>

@endsection