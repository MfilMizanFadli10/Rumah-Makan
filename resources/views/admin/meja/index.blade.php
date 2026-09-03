@extends('layouts.admin')

@section('title', 'Data Meja')

@section('page-title', 'Data Meja')

@section('page-description', 'Kelola meja dan tempat duduk yang tersedia di rumah makan.')

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    ">

        <div>
            <h2 style="margin-bottom:5px;">
                Daftar Meja
            </h2>

            <p style="color:#888; font-size:14px;">
                Kelola nomor meja, kapasitas, tipe, lokasi, dan status meja.
            </p>
        </div>

        <a href="{{ route('admin.meja.create') }}" style="
            display:inline-block;
            background:#8b0000;
            color:white;
            padding:11px 18px;
            border-radius:9px;
            text-decoration:none;
            font-weight:bold;
        ">
            + Tambah Meja
        </a>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div style="
            background:#e7f7ed;
            color:#198754;
            padding:12px 15px;
            border-radius:8px;
            margin-bottom:20px;
        ">
            {{ session('success') }}
        </div>

    @endif


    {{-- ERROR --}}
    @if(session('error'))

        <div style="
            background:#fde8e8;
            color:#b00000;
            padding:12px 15px;
            border-radius:8px;
            margin-bottom:20px;
        ">
            {{ session('error') }}
        </div>

    @endif


    {{-- TABEL --}}
    <div style="overflow-x:auto;">

        <table style="
            width:100%;
            border-collapse:collapse;
        ">

            <thead>

                <tr style="
                    background:#f7f7f7;
                    text-align:left;
                ">

                    <th style="padding:14px;">No</th>

                    <th style="padding:14px;">Nomor Meja</th>

                    <th style="padding:14px;">Kapasitas</th>

                    <th style="padding:14px;">Tipe</th>

                    <th style="padding:14px;">Lokasi</th>

                    <th style="padding:14px;">Status</th>

                    <th style="padding:14px;">Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse($mejas as $meja)

                    <tr style="border-bottom:1px solid #eee;">

                        {{-- NO --}}
                        <td style="padding:14px;">
                            {{ $loop->iteration }}
                        </td>


                        {{-- NOMOR MEJA --}}
                        <td style="padding:14px;">
                            <strong>
                                {{ $meja->nomor_meja }}
                            </strong>
                        </td>


                        {{-- KAPASITAS --}}
                        <td style="padding:14px;">
                            {{ $meja->kapasitas }} Orang
                        </td>


                        {{-- TIPE --}}
                        <td style="padding:14px;">

                            @if($meja->tipe == 'VIP')

                                <span style="
                                    background:#fff4d6;
                                    color:#8a6500;
                                    padding:6px 10px;
                                    border-radius:20px;
                                    font-size:12px;
                                    font-weight:600;
                                ">
                                    VIP
                                </span>

                            @else

                                <span style="
                                    background:#f1f1f1;
                                    color:#555;
                                    padding:6px 10px;
                                    border-radius:20px;
                                    font-size:12px;
                                    font-weight:600;
                                ">
                                    Reguler
                                </span>

                            @endif

                        </td>


                        {{-- LOKASI --}}
                        <td style="padding:14px;">

                            {{ $meja->lokasi }}

                        </td>


                        {{-- STATUS --}}
                        <td style="padding:14px;">

                            @if($meja->status == 'tersedia')

                                <span style="
                                    background:#e7f7ed;
                                    color:#198754;
                                    padding:6px 10px;
                                    border-radius:20px;
                                    font-size:12px;
                                ">
                                    Tersedia
                                </span>

                            @else

                                <span style="
                                    background:#fff3cd;
                                    color:#856404;
                                    padding:6px 10px;
                                    border-radius:20px;
                                    font-size:12px;
                                ">
                                    Terisi
                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td style="padding:14px;">

                            {{-- EDIT --}}
                            <a
                                href="{{ route('admin.meja.edit', $meja->id) }}"
                                style="
                                    display:inline-block;
                                    background:#eee;
                                    color:#333;
                                    padding:7px 10px;
                                    border-radius:7px;
                                    text-decoration:none;
                                    margin-right:5px;
                                "
                            >
                                Edit
                            </a>


                            {{-- HAPUS --}}
                            <form
                                action="{{ route('admin.meja.destroy', $meja->id) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Yakin ingin menghapus meja ini?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    style="
                                        border:none;
                                        background:#ffe5e5;
                                        color:#b00000;
                                        padding:7px 10px;
                                        border-radius:7px;
                                        cursor:pointer;
                                    "
                                >
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            style="
                                padding:40px;
                                text-align:center;
                                color:#888;
                            "
                        >
                            Belum ada data meja.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection