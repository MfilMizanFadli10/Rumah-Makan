@extends('layouts.admin')

@section('title', 'Edit Mahidang')

@section('page-title', 'Edit Mahidang')

@section('page-description', 'Perbarui data pengambilan Mahidang pelanggan.')

@section('content')

<div class="card">

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    ">

        <div>
            <h2 style="margin:0 0 5px;">
                Edit Mahidang
            </h2>

            <p style="
                margin:0;
                color:#888;
                font-size:14px;
            ">
                Perbarui informasi Mahidang pelanggan.
            </p>
        </div>

        <a href="{{ route('admin.mahidang') }}"
           style="
                background:#eee;
                color:#555;
                text-decoration:none;
                padding:10px 18px;
                border-radius:8px;
                font-size:13px;
                font-weight:600;
           ">
            ← Kembali
        </a>

    </div>


    <form action="{{ route('admin.mahidang.update', $mahidang->id) }}"
          method="POST">

        @csrf
        @method('PUT')


        {{-- KODE MAHIDANG --}}
        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
                font-size:14px;
            ">
                Kode Mahidang
            </label>

            <input type="text"
                   value="{{ $mahidang->kode_mahidang }}"
                   readonly
                   style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        background:#f5f5f5;
                        box-sizing:border-box;
                   ">

        </div>


        {{-- NAMA --}}
        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
                font-size:14px;
            ">
                Nama Pelanggan
            </label>

            <input type="text"
                   name="nama_pelanggan"
                   value="{{ old('nama_pelanggan', $mahidang->nama_pelanggan) }}"
                   required
                   style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                   ">

        </div>


        {{-- NO HP --}}
        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
                font-size:14px;
            ">
                Nomor HP
            </label>

            <input type="text"
                   name="no_hp"
                   value="{{ old('no_hp', $mahidang->no_hp) }}"
                   required
                   style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                   ">

        </div>


        {{-- MEJA --}}
        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
                font-size:14px;
            ">
                Meja
            </label>

            <select name="meja_id"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                        background:white;
                    ">

                @foreach($mejas as $meja)

                    <option value="{{ $meja->id }}"
                        {{ $mahidang->meja_id == $meja->id ? 'selected' : '' }}>

                        Meja {{ $meja->nomor_meja }}

                    </option>

                @endforeach

            </select>

        </div>


        {{-- STATUS --}}
        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
                font-size:14px;
            ">
                Status
            </label>

            <select name="status"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                        background:white;
                    ">

                <option value="menunggu"
                    {{ $mahidang->status == 'menunggu' ? 'selected' : '' }}>
                    Menunggu
                </option>

                <option value="sudah_duduk"
                    {{ $mahidang->status == 'sudah_duduk' ? 'selected' : '' }}>
                    Sudah Duduk
                </option>

                <option value="sedang_makan"
                    {{ $mahidang->status == 'sedang_makan' ? 'selected' : '' }}>
                    Sedang Makan
                </option>

                <option value="selesai_makan"
                    {{ $mahidang->status == 'selesai_makan' ? 'selected' : '' }}>
                    Selesai Makan
                </option>

                <option value="dihitung"
                    {{ $mahidang->status == 'dihitung' ? 'selected' : '' }}>
                    Dihitung
                </option>

                <option value="menunggu_pembayaran"
                    {{ $mahidang->status == 'menunggu_pembayaran' ? 'selected' : '' }}>
                    Menunggu Pembayaran
                </option>

                <option value="lunas"
                    {{ $mahidang->status == 'lunas' ? 'selected' : '' }}>
                    Lunas
                </option>

            </select>

        </div>


        {{-- CATATAN --}}
        <div style="margin-bottom:25px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
                font-size:14px;
            ">
                Catatan
            </label>

            <textarea name="catatan"
                      rows="4"
                      style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                        resize:vertical;
                      ">{{ old('catatan', $mahidang->catatan) }}</textarea>

        </div>


        {{-- TOMBOL --}}
        <div style="
            display:flex;
            gap:10px;
            justify-content:flex-end;
        ">

            <a href="{{ route('admin.mahidang') }}"
               style="
                    background:#eee;
                    color:#555;
                    text-decoration:none;
                    padding:11px 20px;
                    border-radius:8px;
                    font-size:13px;
                    font-weight:600;
               ">
                Batal
            </a>

            <button type="submit"
                    style="
                        border:none;
                        background:#8b0000;
                        color:white;
                        padding:11px 20px;
                        border-radius:8px;
                        font-size:13px;
                        font-weight:600;
                        cursor:pointer;
                    ">
                💾 Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection