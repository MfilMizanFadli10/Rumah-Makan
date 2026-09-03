@extends('layouts.admin')

@section('title', 'Tambah Meja')

@section('page-title', 'Tambah Meja')

@section('page-description', 'Tambahkan data meja rumah makan.')

@section('content')

<div class="card">

    <form action="{{ route('admin.meja.store') }}" method="POST">

        @csrf

        {{-- NOMOR MEJA --}}
        <div style="margin-bottom:18px;">

            <label>Nomor Meja</label>

            <input
                type="text"
                name="nomor_meja"
                value="{{ old('nomor_meja') }}"
                placeholder="Contoh: M01"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin-top:7px;
                    border:1px solid #ddd;
                    border-radius:8px;
                "
            >

            @error('nomor_meja')
                <small style="color:red;">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- KAPASITAS --}}
        <div style="margin-bottom:18px;">

            <label>Kapasitas</label>

            <input
                type="number"
                name="kapasitas"
                value="{{ old('kapasitas') }}"
                placeholder="Contoh: 4"
                min="1"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin-top:7px;
                    border:1px solid #ddd;
                    border-radius:8px;
                "
            >

            @error('kapasitas')
                <small style="color:red;">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- LOKASI --}}
        <div style="margin-bottom:18px;">

            <label>Lokasi</label>

            <select
                name="lokasi"
                required
                style="
                    width:100%;
                    padding:12px;
                    margin-top:7px;
                    border:1px solid #ddd;
                    border-radius:8px;
                "
            >

                <option value="">-- Pilih Lokasi --</option>

                <option value="Indoor"
                    {{ old('lokasi') == 'Indoor' ? 'selected' : '' }}>
                    Indoor
                </option>

                <option value="Outdoor"
                    {{ old('lokasi') == 'Outdoor' ? 'selected' : '' }}>
                    Outdoor
                </option>

            </select>

            @error('lokasi')
                <small style="color:red;">
                    {{ $message }}
                </small>
            @enderror

        </div>

        {{-- TIPE MEJA --}}
<div style="margin-bottom:18px;">

    <label>Tipe Meja</label>

    <select
        name="tipe"
        required
        style="
            width:100%;
            padding:12px;
            margin-top:7px;
            border:1px solid #ddd;
            border-radius:8px;
        "
    >

        <option value="">-- Pilih Tipe Meja --</option>

        <option value="Reguler"
            {{ old('tipe') == 'Reguler' ? 'selected' : '' }}>
            Reguler
        </option>

        <option value="VIP"
            {{ old('tipe') == 'VIP' ? 'selected' : '' }}>
            VIP
        </option>

    </select>

    @error('tipe')
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

                <option value="tersedia">
                    Tersedia
                </option>

                <option value="terisi">
                    Terisi
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
            💾 Simpan Meja
        </button>


        <a
            href="{{ route('admin.meja') }}"
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