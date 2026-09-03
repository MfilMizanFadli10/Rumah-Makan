@extends('layouts.admin')

@section('title', 'Tambah Fasilitas')

@section('page-title', 'Tambah Fasilitas')

@section('page-description', 'Tambahkan fasilitas yang tersedia di rumah makan.')

@section('content')

<div class="card">

    <div style="margin-bottom:25px;">
        <h2 style="
            margin:0;
            color:#650000;
        ">
            Tambah Fasilitas
        </h2>

        <p style="
            color:#888;
            font-size:13px;
            margin-top:6px;
        ">
            Masukkan informasi fasilitas rumah makan.
        </p>
    </div>


    {{-- ERROR VALIDASI --}}
    @if($errors->any())
        <div style="
            background:#fde8e8;
            color:#a52a2a;
            padding:12px 15px;
            border-radius:8px;
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


    {{-- FORM --}}
    <form
        action="{{ route('admin.fasilitas.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- NAMA FASILITAS --}}
        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                font-weight:600;
                margin-bottom:7px;
            ">
                Nama Fasilitas
            </label>

            <input
                type="text"
                name="nama_fasilitas"
                value="{{ old('nama_fasilitas') }}"
                placeholder="Contoh: Mushola"
                required
                style="
                    width:100%;
                    padding:11px 12px;
                    border:1px solid #ddd;
                    border-radius:8px;
                    box-sizing:border-box;
                    outline:none;
                "
            >

        </div>


        {{-- DESKRIPSI --}}
        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                font-weight:600;
                margin-bottom:7px;
            ">
                Deskripsi
            </label>

            <textarea
                name="deskripsi"
                rows="5"
                placeholder="Contoh: Mushola yang bersih dan nyaman untuk pelanggan."
                style="
                    width:100%;
                    padding:11px 12px;
                    border:1px solid #ddd;
                    border-radius:8px;
                    resize:vertical;
                    box-sizing:border-box;
                    outline:none;
                "
            >{{ old('deskripsi') }}</textarea>

        </div>


        {{-- FOTO --}}
        <div style="margin-bottom:25px;">

            <label style="
                display:block;
                font-weight:600;
                margin-bottom:7px;
            ">
                Foto Fasilitas
            </label>

            <input
                type="file"
                name="foto"
                accept="image/*"
                style="
                    width:100%;
                    padding:10px;
                    border:1px solid #ddd;
                    border-radius:8px;
                    box-sizing:border-box;
                    background:#fff;
                "
            >

            <p style="
                color:#888;
                font-size:12px;
                margin-top:7px;
            ">
                Format JPG, JPEG, PNG, WEBP. Maksimal 4 MB.
            </p>

        </div>


        {{-- TOMBOL --}}
        <div style="
            display:flex;
            gap:10px;
            padding-top:20px;
            border-top:1px solid #eee;
        ">

            <button
                type="submit"
                style="
                    background:#8b0000;
                    color:white;
                    border:none;
                    padding:11px 18px;
                    border-radius:8px;
                    cursor:pointer;
                    font-weight:600;
                "
            >
                Simpan Fasilitas
            </button>

            <a
                href="{{ route('admin.fasilitas') }}"
                style="
                    background:#eee;
                    color:#555;
                    text-decoration:none;
                    padding:11px 18px;
                    border-radius:8px;
                    font-weight:600;
                "
            >
                Batal
            </a>

        </div>

    </form>

</div>

@endsection 