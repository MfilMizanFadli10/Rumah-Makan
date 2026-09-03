@extends('layouts.customer')

@section('title', 'Reservasi Meja - Rumah Makan')

@section('content')

<div style="padding:60px 8%;">

    {{-- PESAN SUKSES --}}
    @if(session('success'))
        <div style="
            max-width:700px;
            margin:0 auto 25px;
            padding:15px 20px;
            background:#e8f7ee;
            color:#176b3a;
            border:1px solid #b7e4c7;
            border-radius:10px;
        ">
            {{ session('success') }}
        </div>
    @endif

    {{-- PESAN ERROR --}}
    @if($errors->any())
        <div style="
            max-width:700px;
            margin:0 auto 25px;
            padding:15px 20px;
            background:#fff0f0;
            color:#8b0000;
            border:1px solid #f0b5b5;
            border-radius:10px;
        ">
            <strong>Reservasi gagal:</strong>

            <ul style="margin:10px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


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
            RESERVASI
        </div>

        <h1 style="
            font-size:36px;
            margin-bottom:10px;
        ">
            Reservasi Meja
        </h1>

        <p style="color:#777;">
            Pilih meja yang tersedia dan tentukan waktu kedatangan Anda.
        </p>

    </div>


    {{-- FORM RESERVASI --}}
    <div style="
        max-width:700px;
        margin:auto;
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.08);
    ">

        <form
            action="{{ route('customer.reservasi.store') }}"
            method="POST"
        >

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


            {{-- NO HP --}}
            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Nomor HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp') }}"
                    placeholder="Contoh: 081234567890"
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


            {{-- PILIH MEJA --}}
            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Pilih Meja
                </label>

                <select
                    name="meja_id"
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
                        -- Pilih Meja --
                    </option>

                    @forelse($mejas as $meja)
                        <option 
                            value="{{ $meja->id }}" 
                            {{ old('meja_id') == $meja->id ? 'selected' : '' }}
                        >
                            Meja {{ $meja->nomor_meja }}
                            -
                            {{ $meja->tipe }}
                            -
                            {{ $meja->kapasitas }} Orang

                            @if($meja->lokasi)
                                - {{ $meja->lokasi }}
                            @endif
                        </option>
                    @empty

                        <option value="" disabled>
                            Tidak ada meja tersedia
                        </option>

                    @endforelse

                </select>

            </div>


            {{-- TANGGAL --}}
            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Tanggal Reservasi
                </label>

                <input
                    type="date"
                    name="tanggal_pesanan"
                    value="{{ old('tanggal_pesanan') }}"
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


            {{-- JAM --}}
            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Jam Kedatangan
                </label>

                <input
                    type="time"
                    name="jam_pesanan"
                    value="{{ old('jam_pesanan') }}"
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


            {{-- JUMLAH ORANG --}}
            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Jumlah Orang
                </label>

                <input
                    type="number"
                    name="jumlah_orang"
                    value="{{ old('jumlah_orang') }}"
                    min="1"
                    placeholder="Contoh: 4"
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


            {{-- CATATAN --}}
            <div style="margin-bottom:25px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Catatan
                </label>

                <textarea
                    name="catatan"
                    rows="4"
                    placeholder="Contoh: Minta meja dekat jendela"
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        resize:vertical;
                        box-sizing:border-box;
                    "
                >{{ old('catatan') }}</textarea>

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
                 Reservasi Sekarang
            </button>

        </form>

    </div>

</div>

@endsection