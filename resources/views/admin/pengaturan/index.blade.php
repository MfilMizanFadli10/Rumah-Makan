@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('page-title', 'Pengaturan')

@section('page-description', 'Kelola informasi rumah makan.')

@section('content')

<div class="card">

    @if(session('success'))

        <div style="
            background:#e8f7ed;
            color:#198754;
            padding:12px 15px;
            border-radius:9px;
            margin-bottom:20px;
            font-size:13px;
        ">
            {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div style="
            background:#fde8e8;
            color:#a52a2a;
            padding:12px 15px;
            border-radius:9px;
            margin-bottom:20px;
            font-size:13px;
        ">

            <strong>Ada kesalahan:</strong>

            <ul style="margin:8px 0 0 20px;">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <div style="margin-bottom:25px;">

        <h2>
             Pengaturan Rumah Makan
        </h2>

        <p style="
            color:#888;
            font-size:13px;
            margin-top:5px;
        ">
            Atur informasi yang akan digunakan pada sistem.
        </p>

    </div>


    <form
        action="{{ route('admin.pengaturan.update') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <!-- INFORMASI UTAMA -->

        <h3 style="
            margin-bottom:18px;
            color:#650000;
        ">
            Informasi Rumah Makan
        </h3>


        <div style="
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:18px;
        ">

            <div>

                <label>Nama Rumah Makan</label>

                <input
                    type="text"
                    name="nama_rumah_makan"
                    value="{{ old('nama_rumah_makan', $pengaturan->nama_rumah_makan ?? '') }}"
                    required
                    style="width:100%; padding:11px; margin-top:6px; border:1px solid #ddd; border-radius:8px;"
                >

            </div>


            <div>

                <label>Tagline</label>

                <input
                    type="text"
                    name="tagline"
                    value="{{ old('tagline', $pengaturan->tagline ?? '') }}"
                    style="width:100%; padding:11px; margin-top:6px; border:1px solid #ddd; border-radius:8px;"
                >

            </div>

            <div>

                <label>Nama Layanan Mahidang</label>

                <input
                    type="text"
                    name="nama_mahidang"
                    value="{{ old('nama_mahidang', $pengaturan->nama_mahidang ?? 'Mahidang') }}"
                    placeholder="Contoh: Mahidang"
                    required
                    style="
                        width:100%;
                        padding:11px;
                        margin-top:6px;
                        border:1px solid #ddd;
                        border-radius:8px;
                    "
                >

                <small style="
                    display:block;
                    margin-top:6px;
                    color:#888;
                    font-size:12px;
                ">
                    Nama ini hanya digunakan untuk tampilan layanan Mahidang kepada pelanggan.
                </small>

            </div>


            <div>

                <label>No. HP</label>

                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp', $pengaturan->no_hp ?? '') }}"
                    style="width:100%; padding:11px; margin-top:6px; border:1px solid #ddd; border-radius:8px;"
                >

            </div>


            <div>

                <label>WhatsApp</label>

                <input
                    type="text"
                    name="whatsapp"
                    value="{{ old('whatsapp', $pengaturan->whatsapp ?? '') }}"
                    style="width:100%; padding:11px; margin-top:6px; border:1px solid #ddd; border-radius:8px;"
                >

            </div>


            <div>

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $pengaturan->email ?? '') }}"
                    style="width:100%; padding:11px; margin-top:6px; border:1px solid #ddd; border-radius:8px;"
                >

            </div>


            <div>

                <label>Jam Operasional</label>

                <input
                    type="text"
                    name="jam_operasional"
                    value="{{ old('jam_operasional', $pengaturan->jam_operasional ?? '') }}"
                    placeholder="Contoh: 08.00 - 22.00"
                    style="width:100%; padding:11px; margin-top:6px; border:1px solid #ddd; border-radius:8px;"
                >

            </div>


            <div style="grid-column:1 / -1;">

                <label>Alamat</label>

                <textarea
                    name="alamat"
                    rows="3"
                    style="width:100%; padding:11px; margin-top:6px; border:1px solid #ddd; border-radius:8px; resize:vertical;"
                >{{ old('alamat', $pengaturan->alamat ?? '') }}</textarea>

            </div>


            <div style="grid-column:1 / -1;">

    <label style="
        font-weight:600;
        color:#333;
    ">
         Lokasi Google Maps
    </label>

    <textarea
        name="maps"
        rows="3"
        placeholder="Contoh: https://maps.google.com/..."
        style="
            width:100%;
            padding:11px;
            margin-top:6px;
            border:1px solid #ddd;
            border-radius:8px;
            resize:vertical;
        "
    >{{ old('maps', $pengaturan->maps ?? '') }}</textarea>


    <div style="
        margin-top:8px;
        padding:12px 15px;
        background:#fff8e8;
        border-left:4px solid #d9a441;
        border-radius:7px;
        color:#666;
        font-size:13px;
        line-height:1.6;
    ">

        <strong style="color:#650000;">
             Cara mengisi:
        </strong>

        <br>

        Buka Google Maps → cari lokasi rumah makan →
        pilih <b>Bagikan</b> → <b>Salin link</b> →
        tempel link tersebut di sini.

    </div>


    @if(!empty($pengaturan?->maps))

        <div style="
            margin-top:12px;
        ">

            <a
               href="https://www.google.com/maps/search/?api=1&query={{ urlencode($pengaturan->maps) }}"
                target="_blank"
                rel="noopener noreferrer"
                style="
                    display:inline-block;
                    background:#8b0000;
                    color:white;
                    padding:9px 14px;
                    border-radius:7px;
                    text-decoration:none;
                    font-size:13px;
                    font-weight:600;
                "
            >
                 Tes Buka Lokasi
            </a>

        </div>

    @endif

</div>

        </div>


        <!-- LOGO & BANNER -->

        <h3 style="
            margin-top:30px;
            margin-bottom:18px;
            color:#650000;
        ">
            Logo & Banner
        </h3>


        <div style="
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:18px;
        ">

            <div>

                <label>Logo</label>

                <input
                    type="file"
                    name="logo"
                    accept="image/*"
                    style="display:block; margin-top:8px;"
                >

                @if(!empty($pengaturan?->logo))

                    <img
                        src="{{ asset('storage/' . $pengaturan->logo) }}"
                        style="
                            width:100px;
                            height:100px;
                            object-fit:cover;
                            border-radius:10px;
                            margin-top:12px;
                        "
                    >

                @endif

            </div>


            <div>

                <label>Banner</label>

                <input
                    type="file"
                    name="banner"
                    accept="image/*"
                    style="display:block; margin-top:8px;"
                >

                @if(!empty($pengaturan?->banner))

                    <img
                        src="{{ asset('storage/' . $pengaturan->banner) }}"
                        style="
                            width:200px;
                            height:100px;
                            object-fit:cover;
                            border-radius:10px;
                            margin-top:12px;
                        "
                    >

                @endif

            </div>

        </div>

        {{-- PENGATURAN PEMBAYARAN --}}

<h3 style="
    margin-top:30px;
    margin-bottom:18px;
    color:#650000;
">
    Pengaturan Pembayaran
</h3>

<div style="
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
">

    {{-- NAMA BANK --}}
    <div>

        <label>Nama Bank</label>

        <input
            type="text"
            name="nama_bank"
            value="{{ old('nama_bank', $pengaturan->nama_bank ?? '') }}"
            placeholder="Contoh: BRI"
            style="
                width:100%;
                padding:11px;
                margin-top:6px;
                border:1px solid #ddd;
                border-radius:8px;
            "
        >

    </div>


    {{-- NOMOR REKENING --}}
    <div>

        <label>Nomor Rekening</label>

        <input
            type="text"
            name="nomor_rekening"
            value="{{ old('nomor_rekening', $pengaturan->nomor_rekening ?? '') }}"
            placeholder="Contoh: 1234567890"
            style="
                width:100%;
                padding:11px;
                margin-top:6px;
                border:1px solid #ddd;
                border-radius:8px;
            "
        >

    </div>


    {{-- ATAS NAMA --}}
    <div>

        <label>Atas Nama</label>

        <input
            type="text"
            name="atas_nama"
            value="{{ old('atas_nama', $pengaturan->atas_nama ?? '') }}"
            placeholder="Contoh: Rumah Makan ABC"
            style="
                width:100%;
                padding:11px;
                margin-top:6px;
                border:1px solid #ddd;
                border-radius:8px;
            "
        >

    </div>


    {{-- QRIS --}}
    <div>

        <label>QRIS</label>

        <input
            type="file"
            name="qris"
            accept="image/*"
            style="
                display:block;
                margin-top:8px;
            "
        >

        @if(!empty($pengaturan?->qris))

            <img
                src="{{ asset('storage/' . $pengaturan->qris) }}"
                alt="QRIS"
                style="
                    width:180px;
                    height:180px;
                    object-fit:contain;
                    border:1px solid #eee;
                    border-radius:10px;
                    margin-top:12px;
                "
            >

        @endif

    </div>

</div>



{{-- KELOLA FASILITAS --}}

<div style="
    margin-top:30px;
    padding:20px;
    border:1px solid #eee;
    border-radius:10px;
    background:#fafafa;
">

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:15px;
        flex-wrap:wrap;
    ">

        <div>
            <h3 style="
                margin:0;
                color:#650000;
            ">
                Fasilitas Rumah Makan
            </h3>

            <p style="
                margin:6px 0 0;
                color:#888;
                font-size:13px;
            ">
                Kelola informasi fasilitas yang tersedia untuk pelanggan.
            </p>
        </div>

        <a
            href="{{ route('admin.fasilitas') }}"
            style="
                display:inline-block;
                background:#8b0000;
                color:white;
                text-decoration:none;
                padding:10px 16px;
                border-radius:8px;
                font-size:13px;
                font-weight:600;
            "
        >
            Kelola Fasilitas
        </a>

    </div>

</div>


        <div style="
            margin-top:30px;
            padding-top:20px;
            border-top:1px solid #eee;
        ">

            <button
                type="submit"
                style="
                    background:#8b0000;
                    color:white;
                    border:none;
                    padding:12px 20px;
                    border-radius:9px;
                    cursor:pointer;
                    font-weight:600;
                "
            >
                 Simpan Pengaturan
            </button>

        </div>

    </form>

</div>


<style>

@media (max-width: 750px) {

    form > div[style*="grid-template-columns"] {
        grid-template-columns:1fr !important;
    }

}

</style>

@endsection