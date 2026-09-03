@extends('layouts.admin')

@section('title', 'Data Pesanan')

@section('page-title', 'Data Pesanan')

@section('page-description', 'Kelola pesanan pelanggan yang masuk ke rumah makan.')

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:22px;
    ">

        <div>
            <h2 style="margin-bottom:5px;">
                Daftar Pesanan
            </h2>

            <p style="color:#888; font-size:14px;">
                Kelola pesanan pelanggan dan status pesanan.
            </p>
        </div>

        <a href="{{ route('admin.pesanan.create') }}" style="
            background:#8b0000;
            color:white;
            padding:11px 17px;
            border-radius:9px;
            text-decoration:none;
            font-size:13px;
            font-weight:600;
        ">
            ＋ Tambah Pesanan
        </a>

    </div>


    {{-- FILTER --}}
    <div style="
        display:flex;
        gap:12px;
        margin-bottom:22px;
    ">

        <input
            type="text"
            placeholder="  Cari kode atau nama pelanggan..."
            style="
                flex:1;
                padding:12px 15px;
                border:1px solid #ddd;
                border-radius:9px;
                outline:none;
                font-size:13px;
            "
        >

        <select style="
            width:190px;
            padding:12px;
            border:1px solid #ddd;
            border-radius:9px;
            outline:none;
            background:white;
            font-size:13px;
            color:#555;
        ">

            <option>Semua Status</option>
            <option>Menunggu</option>
            <option>Diproses</option>
            <option>Selesai</option>
            <option>Dibatalkan</option>

        </select>

    </div>


    {{-- TABLE --}}
    <div style="overflow-x:auto;">

        <table style="
            width:100%;
            border-collapse:collapse;
            min-width:1100px;
        ">

            <thead>

                <tr style="
                    background:#fafafa;
                    text-align:left;
                ">

                    <th style="padding:13px 10px; color:#999; font-size:11px;">
                        Kode Pesanan
                    </th>

                    <th style="padding:13px 10px; color:#999; font-size:11px;">
                        Pelanggan
                    </th>

                    <th style="padding:13px 10px; color:#999; font-size:11px;">
                        Meja
                    </th>

                    <th style="padding:13px 10px; color:#999; font-size:11px;">
                        Menu Dipesan
                    </th>

                    <th style="padding:13px 10px; color:#999; font-size:11px;">
                        Jumlah Orang
                    </th>

                    <th style="padding:13px 10px; color:#999; font-size:11px;">
                        Total
                    </th>

                    <th style="padding:13px 10px; color:#999; font-size:11px;">
                        Pembayaran
                    </th>

                    <th style="padding:13px 10px; color:#999; font-size:11px;">
                        Status
                    </th>

                    <th style="padding:13px 10px; color:#999; font-size:11px;">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

            @forelse($pesanans as $pesanan)

                <tr style="
                    border-bottom:1px solid #f0f0f0;
                    vertical-align:top;
                ">


                    {{-- KODE PESANAN --}}

                    <td style="padding:15px 10px;">

                        <strong style="color:#8b0000;">
                            {{ $pesanan->kode_pesanan }}
                        </strong>

                        <div style="
                            color:#999;
                            font-size:11px;
                            margin-top:4px;
                        ">
                            {{ $pesanan->tanggal_pesanan }}
                        </div>

                        <div style="
                            color:#999;
                            font-size:11px;
                        ">
                            {{ $pesanan->jam_pesanan }}
                        </div>

                    </td>


                    {{-- PELANGGAN --}}

                    <td style="padding:15px 10px;">

                        <strong>
                            {{ $pesanan->nama_pelanggan }}
                        </strong>

                        <div style="
                            color:#999;
                            font-size:11px;
                            margin-top:4px;
                        ">
                            {{ $pesanan->no_hp ?? '-' }}
                        </div>

                    </td>


                    {{-- MEJA --}}

                    <td style="padding:15px 10px;">

                        <span style="
                            background:#fff4df;
                            color:#946b14;
                            padding:5px 9px;
                            border-radius:20px;
                            font-size:10px;
                            font-weight:600;
                        ">
                            Meja {{ $pesanan->meja->nomor_meja ?? '-' }}
                        </span>

                    </td>


                    {{-- MENU YANG DIPESAN --}}

                    <td style="
                        padding:15px 10px;
                        min-width:220px;
                    ">

                        @forelse($pesanan->detailPesanan as $detail)

                            <div style="
                                display:flex;
                                justify-content:space-between;
                                gap:15px;
                                padding:7px 0;
                                border-bottom:1px dashed #eee;
                            ">

                                <div>

                                    <strong style="
                                        font-size:13px;
                                    ">
                                        {{ $detail->menu->nama_menu ?? 'Menu dihapus' }}
                                    </strong>

                                    <div style="
                                        color:#999;
                                        font-size:11px;
                                        margin-top:3px;
                                    ">
                                        Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                    </div>

                                </div>

                                <strong style="
                                    color:#8b0000;
                                    font-size:13px;
                                ">
                                    {{ $detail->jumlah }}x
                                </strong>

                            </div>

                        @empty

                            <span style="
                                color:#999;
                                font-size:12px;
                            ">
                                Tidak ada detail menu.
                            </span>

                        @endforelse

                    </td>


                    {{-- JUMLAH ORANG --}}

                    <td style="padding:15px 10px;">

                        {{ $pesanan->jumlah_orang }} Orang

                    </td>


                    {{-- TOTAL --}}

                    <td style="
                        padding:15px 10px;
                        font-weight:700;
                        color:#8b0000;
                        white-space:nowrap;
                    ">

                        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}

                    </td>


                    {{-- PEMBAYARAN --}}

                    <td style="
                        padding:15px 10px;
                        text-transform:capitalize;
                    ">

                        {{ $pesanan->metode_pembayaran ?? '-' }}

                    </td>


                   {{-- STATUS --}}

<td style="padding:15px 10px;">

    <form
        action="{{ route('admin.pesanan.status', $pesanan->id) }}"
        method="POST"
    >

        @csrf
        @method('PATCH')

        <select
            name="status"
            onchange="this.form.submit()"
            style="
                background:#fff4d6;
                color:#916c00;
                padding:6px 10px;
                border:none;
                border-radius:20px;
                font-size:11px;
                font-weight:600;
                cursor:pointer;
            "
        >

            <option value="menunggu"
                {{ $pesanan->status == 'menunggu' ? 'selected' : '' }}>
                Menunggu
            </option>

            <option value="diproses"
                {{ $pesanan->status == 'diproses' ? 'selected' : '' }}>
                Diproses
            </option>

            <option value="selesai"
                {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>
                Selesai
            </option>

            <option value="dibatalkan"
                {{ $pesanan->status == 'dibatalkan' ? 'selected' : '' }}>
                Dibatalkan
            </option>

        </select>

    </form>

</td>


                    {{-- AKSI --}}

                    <td style="padding:15px 10px;">

                        <div style="
                            display:flex;
                            gap:7px;
                        ">

                            {{-- DETAIL --}}
                            <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" style="
                                background:#fff4d6;
                                color:#916c00;
                                padding:7px 10px;
                                border-radius:7px;
                                text-decoration:none;
                                font-size:11px;
                            ">
                                👁 Detail
                            </a>


                            {{-- HAPUS --}}
                            <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" style="
                                    background:#fde8e8;
                                    color:#a52a2a;
                                    padding:7px 10px;
                                    border-radius:7px;
                                    border:none;
                                    cursor:pointer;
                                    font-size:11px;
                                ">
                                    🗑️ Hapus
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" style="
                        padding:40px;
                        text-align:center;
                        color:#999;
                    ">

                        Belum ada pesanan.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection