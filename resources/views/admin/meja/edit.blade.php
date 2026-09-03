@extends('layouts.admin')

@section('title', 'Edit Meja')

@section('page-title', 'Edit Meja')

@section('page-description', 'Perbarui data meja rumah makan.')

@section('content')

<div class="card">

    <form action="{{ route('admin.meja.update', $meja->id) }}" method="POST">

        @csrf
        @method('PUT')


        {{-- NOMOR MEJA --}}
        <div style="margin-bottom:18px;">

            <label>Nomor Meja</label>

            <input
                type="text"
                name="nomor_meja"
                value="{{ old('nomor_meja', $meja->nomor_meja) }}"
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
                value="{{ old('kapasitas', $meja->kapasitas) }}"
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

                <option value="Indoor"
                    {{ old('lokasi', $meja->lokasi) == 'Indoor' ? 'selected' : '' }}>
                    Indoor
                </option>

                <option value="Outdoor"
                    {{ old('lokasi', $meja->lokasi) == 'Outdoor' ? 'selected' : '' }}>
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

                <option value="Reguler"
                    {{ old('tipe', $meja->tipe) == 'Reguler' ? 'selected' : '' }}>
                    Reguler
                </option>

                <option value="VIP"
                    {{ old('tipe', $meja->tipe) == 'VIP' ? 'selected' : '' }}>
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

                <option value="tersedia"
                    {{ old('status', $meja->status) == 'tersedia' ? 'selected' : '' }}>
                    Tersedia
                </option>

                <option value="terisi"
                    {{ old('status', $meja->status) == 'terisi' ? 'selected' : '' }}>
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
            💾 Simpan Perubahan
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