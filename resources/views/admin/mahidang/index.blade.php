@extends('layouts.admin')

@section('title', 'Data Mahidang')

@section('page-title', 'Data Mahidang')

@section('page-description', 'Kelola pengambilan Mahidang pelanggan.')

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
            <h2 style="
                margin:0;
                font-size:24px;
                color:#222;
            ">
                Daftar Mahidang
            </h2>

            <p style="
                margin:6px 0 0;
                color:#888;
                font-size:14px;
            ">
                Kelola pelanggan yang mengambil Mahidang.
            </p>
        </div>

        <a href="{{ route('admin.pesanan') }}"
           style="
                background:#f1f1f1;
                color:#555;
                padding:10px 18px;
                border-radius:8px;
                text-decoration:none;
                font-size:13px;
                font-weight:600;
           ">
            ← Kembali
        </a>

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div style="
            background:#e8f7ed;
            color:#237a3b;
            padding:12px 16px;
            border-radius:8px;
            margin-bottom:20px;
            font-size:14px;
        ">
            {{ session('success') }}
        </div>
    @endif


    {{-- SEARCH --}}
    <div style="
        display:flex;
        gap:12px;
        margin-bottom:20px;
    ">

        <input
            type="text"
            id="searchMahidang"
            placeholder="Cari kode, nama pelanggan, atau nomor HP..."
            style="
                flex:1;
                padding:13px 15px;
                border:1px solid #ddd;
                border-radius:9px;
                outline:none;
                font-size:13px;
            "
        >

        <select
            id="filterStatus"
            style="
                width:190px;
                padding:13px 15px;
                border:1px solid #ddd;
                border-radius:9px;
                background:white;
                font-size:13px;
                color:#555;
            "
        >
            <option value="">Semua Status</option>
            <option value="menunggu">Menunggu</option>
            <option value="sudah_duduk">Sudah Duduk</option>
            <option value="sedang_makan">Sedang Makan</option>
            <option value="selesai_makan">Selesai Makan</option>
            <option value="dihitung">Dihitung</option>
            <option value="menunggu_pembayaran">Menunggu Pembayaran</option>
            <option value="lunas">Lunas</option>
        </select>

    </div>


    {{-- TABLE --}}
    <div style="overflow-x:auto;">

        <table style="
            width:100%;
            border-collapse:collapse;
            font-size:13px;
        ">

            <thead>
                <tr style="
                    background:#f7f7f7;
                    text-align:left;
                ">

                    <th style="padding:14px 12px;">No</th>

                    <th style="padding:14px 12px;">
                        Kode Mahidang
                    </th>

                    <th style="padding:14px 12px;">
                        Pelanggan
                    </th>

                    <th style="padding:14px 12px;">
                        No. HP
                    </th>

                    <th style="padding:14px 12px;">
                        Meja
                    </th>

                    <th style="padding:14px 12px;">
                        Status
                    </th>

                    <th style="padding:14px 12px;">
                        Catatan
                    </th>

                    <th style="padding:14px 12px;">
                        Aksi
                    </th>

                </tr>
            </thead>

            <tbody id="tableMahidang">

                @forelse($mahidangs as $mahidang)

                    @php

                        $statusLabel = [
                            'menunggu' => 'Menunggu',
                            'sudah_duduk' => 'Sudah Duduk',
                            'sedang_makan' => 'Sedang Makan',
                            'selesai_makan' => 'Selesai Makan',
                            'dihitung' => 'Dihitung',
                            'menunggu_pembayaran' => 'Menunggu Pembayaran',
                            'lunas' => 'Lunas',
                        ];

                        $statusClass = [
                            'menunggu' => 'background:#fff3cd;color:#856404;',
                            'sudah_duduk' => 'background:#dbeafe;color:#1d4ed8;',
                            'sedang_makan' => 'background:#fef3c7;color:#92400e;',
                            'selesai_makan' => 'background:#e0e7ff;color:#4338ca;',
                            'dihitung' => 'background:#ede9fe;color:#6d28d9;',
                            'menunggu_pembayaran' => 'background:#fee2e2;color:#b91c1c;',
                            'lunas' => 'background:#dcfce7;color:#166534;',
                        ];

                    @endphp

                    <tr
                        class="rowMahidang"
                        data-status="{{ $mahidang->status }}"
                        style="border-bottom:1px solid #eee;"
                    >

                        {{-- NO --}}
                        <td style="
                            padding:15px 12px;
                            color:#555;
                        ">
                            {{ $loop->iteration }}
                        </td>


                        {{-- KODE --}}
                        <td style="
                            padding:15px 12px;
                            font-weight:700;
                            color:#a00000;
                            white-space:nowrap;
                        ">
                            {{ $mahidang->kode_mahidang }}
                        </td>


                        {{-- PELANGGAN --}}
                        <td style="padding:15px 12px;">

                            <strong style="
                                display:block;
                                color:#333;
                            ">
                                {{ $mahidang->nama_pelanggan }}
                            </strong>

                        </td>


                        {{-- NO HP --}}
                        <td style="
                            padding:15px 12px;
                            color:#555;
                            white-space:nowrap;
                        ">
                            {{ $mahidang->no_hp }}
                        </td>


                        {{-- MEJA --}}
                        <td style="padding:15px 12px;">

                            <span style="
                                background:#fff3d6;
                                color:#9a6700;
                                padding:6px 10px;
                                border-radius:20px;
                                font-size:12px;
                                white-space:nowrap;
                            ">
                                {{ $mahidang->meja->meja_nomor_meja ?? 'Tidak ada' }}
                            </span>

                        </td>


                        {{-- STATUS --}}
            <td style="padding:15px 12px;">

                <form
                    action="{{ route('admin.mahidang.update', $mahidang->id) }}"
                    method="POST"
                >

                    @csrf
                    @method('PUT')

                    {{-- Data yang tidak boleh berubah --}}
                    <input
                        type="hidden"
                        name="nama_pelanggan"
                        value="{{ $mahidang->nama_pelanggan }}"
                    >

                    <input
                        type="hidden"
                        name="no_hp"
                        value="{{ $mahidang->no_hp }}"
                    >

                    <input
                        type="hidden"
                        name="meja_id"
                        value="{{ $mahidang->meja_id }}"
                    >

                    <input
                        type="hidden"
                        name="catatan"
                        value="{{ $mahidang->catatan }}"
                    >

                    <select
                        name="status"
                        onchange="this.form.submit()"
                        style="
                            padding:7px 10px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            background:white;
                            font-size:12px;
                            cursor:pointer;
                        "
                    >

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

                </form>

            </td>

                        {{-- CATATAN --}}
                        <td style="
                            padding:15px 12px;
                            color:#666;
                            max-width:180px;
                        ">
                            {{ $mahidang->catatan ?: '-' }}
                        </td>


                        {{-- AKSI --}}
                        <td style="
                            padding:15px 12px;
                            white-space:nowrap;
                        ">

                            <a
                                href="{{ route('admin.mahidang.edit', $mahidang->id) }}"
                                style="
                                    display:inline-block;
                                    background:#fff1c7;
                                    color:#8a6500;
                                    padding:7px 11px;
                                    border-radius:7px;
                                    text-decoration:none;
                                    font-size:12px;
                                    margin-right:5px;
                                "
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.mahidang.destroy', $mahidang->id) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Yakin ingin menghapus data Mahidang ini?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    style="
                                        background:#fde0e0;
                                        color:#b42323;
                                        border:none;
                                        padding:7px 11px;
                                        border-radius:7px;
                                        font-size:12px;
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
                            colspan="8"
                            style="
                                padding:40px;
                                text-align:center;
                                color:#999;
                            "
                        >
                            Belum ada data Mahidang.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- SEARCH & FILTER --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchMahidang');
    const filterStatus = document.getElementById('filterStatus');
    const rows = document.querySelectorAll('.rowMahidang');

    function filterMahidang() {

        const search = searchInput.value.toLowerCase();
        const status = filterStatus.value;

        rows.forEach(function(row) {

            const text = row.innerText.toLowerCase();
            const rowStatus = row.dataset.status;

            const cocokSearch = text.includes(search);
            const cocokStatus =
                status === '' || rowStatus === status;

            if (cocokSearch && cocokStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    }

    searchInput.addEventListener('input', filterMahidang);
    filterStatus.addEventListener('change', filterMahidang);

});

</script>

@endsection