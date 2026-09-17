@extends('layouts.customer')

@php
    $pengaturan = \App\Models\Pengaturan::first();
@endphp

@section('title', 'Mahidang - Rumah Makan')

@section('content')

<div style="padding:60px 8%;">

    <div style="
        max-width:800px;
        margin:0 auto;
        background:white;
        padding:35px;
        border-radius:18px;
        box-shadow:0 5px 20px rgba(0,0,0,0.08);
    ">

    <a href="{{ route('customer.home') }}"
   style="
       display:inline-block;
       background:#f1f1f1;
       color:#555;
       padding:9px 16px;
       border-radius:8px;
       text-decoration:none;
       font-size:13px;
       font-weight:600;
       margin-bottom:20px;
   ">
    ← Kembali
</a>

        <div style="text-align:center;margin-bottom:30px;">
            <div style="
                width:70px;
                height:70px;
                margin:0 auto 15px;
                background:#8b0000;
                color:white;
                border-radius:50%;
                display:flex;
                align-items:center;
                justify-content:center;
                font-size:30px;
            ">
                <i class="fas fa-utensils"></i>
            </div>

            <h1 style="margin:0 0 10px;color:#333;">
                 {{ $pengaturan->nama_mahidang ?? 'Mahidang' }}
            </h1>

        <p style="margin:0;color:#777;line-height:1.6;">
            Nikmati hidangan {{ $pengaturan->nama_mahidang ?? 'Mahidang' }} bersama keluarga dan teman.
            Silakan pilih meja dan isi data untuk mengambil layanan {{ $pengaturan->nama_mahidang ?? 'Mahidang' }}.
        </p>

        </div>

        @if(session('success'))
            <div style="
                background:#e8f7e8;
                color:#287a28;
                padding:12px 15px;
                border-radius:8px;
                margin-bottom:20px;
            ">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="
                background:#ffe8e8;
                color:#8b0000;
                padding:12px 15px;
                border-radius:8px;
                margin-bottom:20px;
            ">
                <ul style="margin:0;padding-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.mahidang.store') }}" method="POST">

            @csrf

            {{-- NAMA --}}
            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:600;">
                    Nama Pelanggan
                </label>

                <input
                    type="text"
                    name="nama_pelanggan"
                    value="{{ old('nama_pelanggan') }}"
                    placeholder="Masukkan nama"
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
                <label style="display:block;margin-bottom:8px;font-weight:600;">
                    Nomor HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp') }}"
                    placeholder="08xxxxxxxxxx"
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

            {{-- MEJA --}}
            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:600;">
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
                        background:white;
                    "
                >
                    <option value="">-- Pilih Meja --</option>

                    @forelse($mejas as $meja)
                        <option
                            value="{{ $meja->id }}"
                            {{ old('meja_id') == $meja->id ? 'selected' : '' }}
                        >
                            Meja {{ $meja->nomor_meja }}
                            - {{ $meja->kapasitas }} Orang
                            - {{ $meja->lokasi }}
                        </option>
                    @empty
                        <option value="" disabled>
                            Tidak ada meja tersedia
                        </option>
                    @endforelse
                </select>
            </div>

            {{-- CATATAN --}}
            <div style="margin-bottom:25px;">
                <label style="display:block;margin-bottom:8px;font-weight:600;">
                    Catatan
                    <span style="font-weight:400;color:#999;">
                        (opsional)
                    </span>
                </label>

                <textarea
                    name="catatan"
                    rows="4"
                    placeholder="Contoh: meja dekat jendela"
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                        resize:vertical;
                    "
                >{{ old('catatan') }}</textarea>
            </div>

            {{-- INFO --}}
            <div style="
                background:#fff8f0;
                border-left:4px solid #8b0000;
                padding:15px;
                border-radius:8px;
                margin-bottom:25px;
                color:#666;
                line-height:1.6;
                font-size:14px;
            ">
               <strong>Informasi {{ $pengaturan->nama_mahidang ?? 'Mahidang' }}</strong><br>
               Pembayaran tidak dilakukan saat mengambil {{ $pengaturan->nama_mahidang ?? 'Mahidang' }}.
                Perhitungan hidangan dan pesanan tambahan akan dilakukan
                oleh pelayan setelah selesai makan, kemudian pelanggan
                menerima nota akhir untuk pembayaran di kasir.
            </div>

            {{-- BUTTON --}}
            <button
                type="submit"
                style="
                    width:100%;
                    padding:14px;
                    border:none;
                    border-radius:9px;
                    background:#8b0000;
                    color:white;
                    font-size:16px;
                    font-weight:600;
                    cursor:pointer;
                "
            >
                <i class="fas fa-chair"></i>
               Ambil Meja {{ $pengaturan->nama_mahidang ?? 'Mahidang' }}
            </button>

        </form>

    </div>

</div>

@endsection