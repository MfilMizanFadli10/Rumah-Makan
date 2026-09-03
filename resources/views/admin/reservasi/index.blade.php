@extends('layouts.admin')

@section('title', 'Data Reservasi')

@section('page-title', 'Data Reservasi')

@section('page-description', 'Kelola reservasi meja pelanggan.')

@section('content')

<div class="card">


{{-- HEADER --}}
<div style="
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
">

    <div>
        <h2 style="margin:0;">
            Daftar Reservasi
        </h2>

        <p style="
            margin:6px 0 0;
            color:#777;
        ">
            Data reservasi meja dari pelanggan.
        </p>
    </div>

</div>


{{-- PESAN BERHASIL --}}
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


{{-- PESAN ERROR --}}
@if(session('error'))

    <div style="
        background:#fff1f1;
        color:#a00000;
        padding:12px 15px;
        border-radius:8px;
        margin-bottom:20px;
    ">
        {{ session('error') }}
    </div>

@endif


{{-- TABEL --}}
<div style="
    overflow-x:auto;
    border-radius:10px;
    border:1px solid #eee;
">

    <table style="
        width:100%;
        border-collapse:collapse;
        min-width:950px;
    ">

        <thead>

            <tr style="
                background:#650000;
                color:white;
            ">

                <th style="padding:14px 12px;">
                    NO
                </th>

                <th style="padding:14px 12px;">
                    Nama Pelanggan
                </th>

                <th style="padding:14px 12px;">
                    No. HP
                </th>

                <th style="padding:14px 12px;">
                    Meja
                </th>

                <th style="padding:14px 12px;">
                    Tanggal
                </th>

                <th style="padding:14px 12px;">
                    Jam
                </th>

                <th style="padding:14px 12px;">
                    Jumlah Orang
                </th>

                <th style="padding:14px 12px;">
                    Catatan
                </th>

                <th style="padding:14px 12px;">
                    Aksi
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse($reservasis as $index => $reservasi)

                <tr style="
                    border-bottom:1px solid #eee;
                    background:white;
                ">

                    {{-- NOMOR --}}
                    <td style="
                        padding:14px 12px;
                        text-align:center;
                    ">
                        {{ $index + 1 }}
                    </td>


                    {{-- NAMA --}}
                    <td style="
                        padding:14px 12px;
                    ">
                        <strong>
                            {{ $reservasi->nama_pelanggan }}
                        </strong>
                    </td>


                    {{-- NO HP --}}
                    <td style="
                        padding:14px 12px;
                    ">
                        {{ $reservasi->no_hp }}
                    </td>


                    {{-- MEJA --}}
                    <td style="
                        padding:14px 12px;
                    ">

                        @if($reservasi->meja)

                            <span style="
                                display:inline-block;
                                background:#f7eeee;
                                color:#8b0000;
                                padding:5px 9px;
                                border-radius:6px;
                                font-size:12px;
                                font-weight:600;
                            ">
                                Meja {{ $reservasi->meja->nomor_meja }}
                            </span>

                        @else

                            <span style="color:#999;">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- TANGGAL --}}
                    <td style="
                        padding:14px 12px;
                    ">
                        {{ $reservasi->tanggal_pesanan }}
                    </td>


                    {{-- JAM --}}
                    <td style="
                        padding:14px 12px;
                    ">
                        {{ $reservasi->jam_pesanan }}
                    </td>


                    {{-- JUMLAH ORANG --}}
                    <td style="
                        padding:14px 12px;
                        text-align:center;
                    ">
                        {{ $reservasi->jumlah_orang }} orang
                    </td>


                    {{-- CATATAN --}}
                    <td style="
                        padding:14px 12px;
                        max-width:220px;
                    ">
                        {{ $reservasi->catatan ?: '-' }}
                    </td>


                    {{-- AKSI --}}
                    <td style="
                        padding:14px 12px;
                        text-align:center;
                        white-space:nowrap;
                    ">

                        <form
                            action="{{ route('admin.reservasi.destroy', $reservasi->id) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                style="
                                    padding:8px 12px;
                                    background:#ffe5e5;
                                    color:#a00000;
                                    border:1px solid #f3cccc;
                                    border-radius:7px;
                                    font-size:12px;
                                    cursor:pointer;
                                    transition:0.2s;
                                "
                            >
                                🗑️ Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="9"
                        style="
                            padding:40px;
                            text-align:center;
                            color:#777;
                        "
                    >
                         Belum ada data reservasi.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>


</div>

@endsection
