@extends('layouts.admin')

@section('title', 'Tambah Menu')

@section('page-title', 'Tambah Menu')

@section('page-description', 'Tambahkan makanan atau minuman baru.')

@section('content')

<div class="card">

    {{-- PESAN ERROR --}}
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

            <ul style="margin:8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('admin.menu.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf


        {{-- NAMA MENU --}}
        <div style="margin-bottom:18px;">

            <label>Nama Menu</label>

            <input
                type="text"
                name="nama_menu"
                value="{{ old('nama_menu') }}"
                placeholder="Contoh: Ayam Bakar"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin-top:7px;
                    border:1px solid #ddd;
                    border-radius:8px;
                "
            >

            @error('nama_menu')
                <small style="color:red;">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- KATEGORI --}}
        <div style="margin-bottom:18px;">

            <label>Kategori</label>

            <select
                name="kategori_id"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin-top:7px;
                    border:1px solid #ddd;
                    border-radius:8px;
                "
            >

                <option value="">-- Pilih Kategori --</option>

                @foreach($kategoris as $kategori)

                    <option
                        value="{{ $kategori->id }}"
                        {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}
                    >
                        {{ $kategori->nama_kategori }}
                    </option>

                @endforeach

            </select>

            @error('kategori_id')
                <small style="color:red;">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- DESKRIPSI --}}
        <div style="margin-bottom:18px;">

            <label>Deskripsi</label>

            <textarea
                name="deskripsi"
                rows="4"
                placeholder="Contoh: Ayam bakar dengan bumbu khas rumah makan."
                style="
                    width:100%;
                    padding:12px;
                    margin-top:7px;
                    border:1px solid #ddd;
                    border-radius:8px;
                    resize:vertical;
                "
            >{{ old('deskripsi') }}</textarea>

            @error('deskripsi')
                <small style="color:red;">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- HARGA --}}
        <div style="margin-bottom:18px;">

            <label>Harga</label>

            <input
                type="number"
                name="harga"
                value="{{ old('harga') }}"
                placeholder="25000"
                min="0"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin-top:7px;
                    border:1px solid #ddd;
                    border-radius:8px;
                "
            >

            @error('harga')
                <small style="color:red;">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- FOTO --}}
        <div style="margin-bottom:18px;">

            <label>Foto Menu</label>

            <input
                type="file"
                name="foto"
                accept="image/jpeg,image/png,image/webp"
                style="
                    display:block;
                    margin-top:8px;
                "
            >

            <small style="
                display:block;
                margin-top:6px;
                color:#999;
            ">
                Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
            </small>

            @error('foto')
                <small style="color:red;">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- STATUS --}}
        <div style="margin-bottom:25px;">

            <label>Status</label>

            <select
                name="status"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin-top:7px;
                    border:1px solid #ddd;
                    border-radius:8px;
                "
            >

                <option
                    value="tersedia"
                    {{ old('status', 'tersedia') == 'tersedia' ? 'selected' : '' }}
                >
                    Tersedia
                </option>

                <option
                    value="tidak tersedia"
                    {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}
                >
                    Tidak Tersedia
                </option>

            </select>

            @error('status')
                <small style="color:red;">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- TOMBOL --}}
        <button
            type="submit"
            style="
                background:#8b0000;
                color:white;
                border:none;
                padding:12px 22px;
                border-radius:8px;
                font-weight:bold;
                cursor:pointer;
            "
        >
            Simpan Menu
        </button>


        <a
            href="{{ route('admin.menu') }}"
            style="
                margin-left:10px;
                padding:12px 22px;
                border-radius:8px;
                background:#eee;
                color:#333;
                text-decoration:none;
            "
        >
            Kembali
        </a>

    </form>

</div>

@endsection