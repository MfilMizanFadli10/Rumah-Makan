@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('page-title', 'Detail Pesanan')

@section('page-description', 'Lihat informasi lengkap pesanan pelanggan.')

@section('content')

<style>

    .detail-wrapper {
        background: #ffffff;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 22px;
        margin-bottom: 25px;
        border-bottom: 1px solid #eeeeee;
    }

    .detail-header h2 {
        margin-bottom: 5px;
        color: #2c2c2c;
    }

    .detail-header p {
        color: #888;
        font-size: 14px;
        margin: 0;
    }

    .btn-back {
        background: #f5f5f5;
        color: #444;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-back:hover {
        background: #e9e9e9;
    }

    .info-title {
        font-size: 17px;
        margin-bottom: 15px;
        color: #333;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }

    .info-box {
        background: #fafafa;
        border: 1px solid #eeeeee;
        border-radius: 12px;
        padding: 17px 18px;
        transition: .2s;
    }

    .info-box:hover {
        border-color: #e2caca;
        background: #fffafa;
    }

    .info-label {
        display: block;
        color: #999;
        font-size: 11px;
        margin-bottom: 7px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .info-value {
        color: #333;
        font-size: 15px;
        font-weight: 600;
    }

    .info-value.red {
        color: #8b0000;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        background: #fff4d6;
        color: #916c00;
        font-size: 11px;
        font-weight: 700;
    }

    .menu-section {
        margin-top: 5px;
    }

    .menu-table-wrapper {
        border: 1px solid #eeeeee;
        border-radius: 12px;
        overflow: hidden;
    }

    .menu-table {
        width: 100%;
        border-collapse: collapse;
    }

    .menu-table th {
        background: #fafafa;
        padding: 13px 15px;
        text-align: left;
        color: #888;
        font-size: 11px;
        border-bottom: 1px solid #eeeeee;
    }

    .menu-table td {
        padding: 15px;
        border-bottom: 1px solid #f1f1f1;
        font-size: 13px;
        color: #444;
    }

    .menu-table tr:last-child td {
        border-bottom: none;
    }

    .menu-name {
        font-weight: 600;
        color: #333;
    }

    .menu-price {
        color: #888;
        font-size: 12px;
        margin-top: 4px;
    }

    .menu-qty {
        display: inline-block;
        background: #f7eeee;
        color: #8b0000;
        padding: 5px 9px;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 700;
    }

    .subtotal {
        color: #8b0000 !important;
        font-weight: 700 !important;
        white-space: nowrap;
    }

    .total-wrapper {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .total-box {
        min-width: 280px;
        background: #fff8f8;
        border: 1px solid #efdada;
        border-radius: 12px;
        padding: 18px 22px;
    }

    .total-label {
        color: #888;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .total-value {
        color: #8b0000;
        font-size: 25px;
        font-weight: 700;
    }

    .note-box {
        margin-top: 25px;
        background: #fffdf5;
        border: 1px solid #f1e7c7;
        border-radius: 12px;
        padding: 17px;
    }

    .note-title {
        font-size: 13px;
        font-weight: 700;
        color: #765f19;
    }

    .note-text {
        margin: 7px 0 0;
        color: #666;
        font-size: 13px;
        line-height: 1.6;
    }

    .empty-menu {
        padding: 25px;
        text-align: center;
        color: #999;
    }

    @media (max-width: 700px) {

        .detail-wrapper {
            padding: 18px;
        }

        .detail-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .menu-table-wrapper {
            overflow-x: auto;
        }

        .menu-table {
            min-width: 600px;
        }

        .total-wrapper {
            justify-content: stretch;
        }

        .total-box {
            width: 100%;
            min-width: unset;
        }

    }

</style>

<div class="detail-wrapper">

```
{{-- ========================= --}}
{{-- HEADER --}}
{{-- ========================= --}}

<div class="detail-header">

    <div>
        <h2>Detail Pesanan</h2>

        <p>
            Informasi lengkap pesanan pelanggan.
        </p>
    </div>

    <a href="{{ route('admin.pesanan') }}" class="btn-back">
        ← Kembali
    </a>

</div>


{{-- ========================= --}}
{{-- INFORMASI PESANAN --}}
{{-- ========================= --}}

<h3 class="info-title">
    Informasi Pesanan
</h3>

<div class="info-grid">

    {{-- KODE --}}
    <div class="info-box">

        <span class="info-label">
            Kode Pesanan
        </span>

        <div class="info-value red">
            {{ $pesanan->kode_pesanan }}
        </div>

    </div>


    {{-- STATUS --}}
    <div class="info-box">

        <span class="info-label">
            Status Pesanan
        </span>

        <span class="status-badge">
            {{ $pesanan->status }}
        </span>

    </div>


    {{-- PELANGGAN --}}
    <div class="info-box">

        <span class="info-label">
            Nama Pelanggan
        </span>

        <div class="info-value">
            {{ $pesanan->nama_pelanggan }}
        </div>

        <div style="
            color:#999;
            font-size:12px;
            margin-top:5px;
        ">
            {{ $pesanan->no_hp ?? 'Nomor HP tidak tersedia' }}
        </div>

    </div>


    {{-- MEJA --}}
    <div class="info-box">

        <span class="info-label">
            Meja
        </span>

        <div class="info-value">
            Meja {{ $pesanan->meja->nomor_meja ?? '-' }}
        </div>

    </div>


    {{-- JUMLAH ORANG --}}
    <div class="info-box">

        <span class="info-label">
            Jumlah Orang
        </span>

        <div class="info-value">
            {{ $pesanan->jumlah_orang }} Orang
        </div>

    </div>


    {{-- PEMBAYARAN --}}
    <div class="info-box">

        <span class="info-label">
            Metode Pembayaran
        </span>

        <div class="info-value" style="text-transform:capitalize;">
            {{ $pesanan->metode_pembayaran ?? '-' }}
        </div>

    </div>


    {{-- TANGGAL --}}
    <div class="info-box">

        <span class="info-label">
            Tanggal Pesanan
        </span>

        <div class="info-value">
            {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d-m-Y') }}
        </div>

    </div>


    {{-- JAM --}}
    <div class="info-box">

        <span class="info-label">
            Jam Pesanan
        </span>

        <div class="info-value">
            {{ $pesanan->jam_pesanan }}
        </div>

    </div>

</div>


{{-- ========================= --}}
{{-- MENU YANG DIPESAN --}}
{{-- ========================= --}}

<div class="menu-section">

    <h3 class="info-title">
        Menu yang Dipesan
    </h3>

    <div class="menu-table-wrapper">

        <table class="menu-table">

            <thead>

                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>

            </thead>

            <tbody>

            @forelse($pesanan->detailPesanan as $detail)

                <tr>

                    <td>

                        <div class="menu-name">
                            {{ $detail->menu->nama_menu ?? 'Menu dihapus' }}
                        </div>

                    </td>


                    <td>

                        <div class="menu-price">
                            Rp {{ number_format($detail->harga, 0, ',', '.') }}
                        </div>

                    </td>


                    <td>

                        <span class="menu-qty">
                            {{ $detail->jumlah }}x
                        </span>

                    </td>


                    <td class="subtotal">

                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4">

                        <div class="empty-menu">
                            Tidak ada menu dalam pesanan.
                        </div>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- ========================= --}}
{{-- TOTAL --}}
{{-- ========================= --}}

<div class="total-wrapper">

    <div class="total-box">

        <div class="total-label">
            Total Pesanan
        </div>

        <div class="total-value">
            Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
        </div>

    </div>

</div>


{{-- ========================= --}}
{{-- CATATAN --}}
{{-- ========================= --}}

@if($pesanan->catatan)

    <div class="note-box">

        <div class="note-title">
            📝 Catatan Pelanggan
        </div>

        <p class="note-text">
            {{ $pesanan->catatan }}
        </p>

    </div>

@endif


</div>

@endsection
