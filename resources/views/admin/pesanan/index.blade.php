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


    {{-- TAB PESANAN --}}
    <div style="
        display:flex;
        gap:10px;
        margin-bottom:25px;
        border-bottom:1px solid #eee;
        padding-bottom:12px;
    ">

        <a href="{{ route('admin.pesanan') }}" style="
            background:#8b0000;
            color:white;
            padding:10px 18px;
            border-radius:8px;
            text-decoration:none;
            font-size:13px;
            font-weight:600;
        ">
            🛒 Pesanan Biasa
        </a>

        <a href="{{ route('admin.mahidang') }}" style="
            background:#f5f5f5;
            color:#555;
            padding:10px 18px;
            border-radius:8px;
            text-decoration:none;
            font-size:13px;
            font-weight:600;
        ">
            🍽️ Mahidang
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
            min-width:1200px;
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
                        min-width:170px;
                    ">

                        {{-- METODE PEMBAYARAN --}}
                        <div style="
                            font-weight:600;
                            text-transform:capitalize;
                            margin-bottom:9px;
                        ">
                            {{ $pesanan->metode_pembayaran ?? '-' }}
                        </div>


                        {{-- STATUS PEMBAYARAN --}}

                        @if($pesanan->metode_pembayaran === 'tunai')

                            <span style="
                                display:inline-block;
                                background:#f5f5f5;
                                color:#666;
                                padding:7px 11px;
                                border-radius:20px;
                                font-size:11px;
                                font-weight:600;
                            ">
                                Bayar di Kasir
                            </span>

                        @elseif($pesanan->status_pembayaran === 'dibayar')

                            <span style="
                                display:inline-block;
                                background:#e8f7ed;
                                color:#218838;
                                padding:7px 11px;
                                border-radius:20px;
                                font-size:11px;
                                font-weight:600;
                            ">
                                ✓ Sudah Dibayar
                            </span>

                        @elseif($pesanan->status_pembayaran === 'ditolak')

                            <span style="
                                display:inline-block;
                                background:#fde8e8;
                                color:#a52a2a;
                                padding:7px 11px;
                                border-radius:20px;
                                font-size:11px;
                                font-weight:600;
                            ">
                                 Ditolak
                            </span>

                        @else

                            <span style="
                                display:inline-block;
                                background:#fff4d6;
                                color:#916c00;
                                padding:7px 11px;
                                border-radius:20px;
                                font-size:11px;
                                font-weight:600;
                            ">
                                 Menunggu Verifikasi
                            </span>

                        @endif


                        {{-- LIHAT BUKTI --}}

                        @if(
                            in_array($pesanan->metode_pembayaran, ['transfer', 'qris'])
                            && $pesanan->bukti_pembayaran
                        )

                            <div style="margin-top:11px;">

                                <button
                                    type="button"
                                    onclick="bukaBukti('{{ asset('storage/' . $pesanan->bukti_pembayaran) }}', '{{ $pesanan->kode_pesanan }}')"
                                    style="
                                        display:inline-flex;
                                        align-items:center;
                                        gap:7px;
                                        background:#8b0000;
                                        color:white;
                                        padding:9px 13px;
                                        border:none;
                                        border-radius:8px;
                                        cursor:pointer;
                                        font-size:11px;
                                        font-weight:600;
                                        box-shadow:0 2px 5px rgba(0,0,0,0.08);
                                    "
                                >
                                    Lihat Bukti
                                </button>

                            </div>

                        @elseif(
                            in_array($pesanan->metode_pembayaran, ['transfer', 'qris'])
                        )

                            <div style="
                                margin-top:8px;
                                color:#999;
                                font-size:10px;
                            ">
                                Belum ada bukti
                            </div>

                        @endif

                    </td>


                    {{-- STATUS PESANAN --}}

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

                            <a
                                href="{{ route('admin.pesanan.show', $pesanan->id) }}"
                                style="
                                    background:#fff4d6;
                                    color:#916c00;
                                    padding:7px 10px;
                                    border-radius:7px;
                                    text-decoration:none;
                                    font-size:11px;
                                "
                            >
                                 Detail
                            </a>


                            {{-- HAPUS --}}

                            <form
                                action="{{ route('admin.pesanan.destroy', $pesanan->id) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    style="
                                        background:#fde8e8;
                                        color:#a52a2a;
                                        padding:7px 10px;
                                        border-radius:7px;
                                        border:none;
                                        cursor:pointer;
                                        font-size:11px;
                                    "
                                >
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


{{-- ===================================================== --}}
{{-- MODAL BUKTI PEMBAYARAN --}}
{{-- ===================================================== --}}

<div
    id="modal-bukti"
    onclick="tutupBukti(event)"
    style="
        display:none;
        position:fixed;
        z-index:9999;
        inset:0;
        background:rgba(0,0,0,0.70);
        align-items:center;
        justify-content:center;
        padding:25px;
        box-sizing:border-box;
    "
>

    <div
        onclick="event.stopPropagation()"
        style="
            position:relative;
            width:min(600px, 95vw);
            max-height:90vh;
            background:white;
            border-radius:16px;
            padding:20px;
            box-sizing:border-box;
            box-shadow:0 10px 40px rgba(0,0,0,0.25);
        "
    >

        {{-- HEADER MODAL --}}
        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:15px;
        ">

            <div>

                <h3 style="
                    margin:0;
                    color:#333;
                    font-size:18px;
                ">
                     Bukti Pembayaran
                </h3>

                <div
                    id="kode-bukti"
                    style="
                        color:#999;
                        font-size:12px;
                        margin-top:4px;
                    "
                >
                </div>

            </div>


            {{-- TOMBOL TUTUP --}}

            <button
                type="button"
                onclick="tutupBukti()"
                style="
                    width:34px;
                    height:34px;
                    border:none;
                    border-radius:50%;
                    background:#f5f5f5;
                    color:#555;
                    font-size:20px;
                    cursor:pointer;
                    line-height:34px;
                "
            >
                ×
            </button>

        </div>


        {{-- GAMBAR BUKTI --}}

        <div style="
            background:#f7f7f7;
            border-radius:12px;
            padding:10px;
            text-align:center;
            max-height:72vh;
            overflow:auto;
        ">

            <img
                id="gambar-bukti"
                src=""
                alt="Bukti Pembayaran"
                style="
                    display:block;
                    max-width:100%;
                    max-height:68vh;
                    width:auto;
                    height:auto;
                    margin:0 auto;
                    border-radius:8px;
                    object-fit:contain;
                "
            >

        </div>



    </div>

</div>


{{-- ===================================================== --}}
{{-- JAVASCRIPT MODAL --}}
{{-- ===================================================== --}}

<script>

function bukaBukti(gambar, kode)
{
    const modal = document.getElementById('modal-bukti');
    const image = document.getElementById('gambar-bukti');
    const kodeBukti = document.getElementById('kode-bukti');

    image.src = gambar;
    kodeBukti.textContent = 'Pesanan ' + kode;

    modal.style.display = 'flex';

    document.body.style.overflow = 'hidden';
}


function tutupBukti(event)
{
    if (event && event.target !== event.currentTarget) {
        return;
    }

    const modal = document.getElementById('modal-bukti');
    const image = document.getElementById('gambar-bukti');

    modal.style.display = 'none';

    image.src = '';

    document.body.style.overflow = '';
}


// TUTUP DENGAN TOMBOL ESC
document.addEventListener('keydown', function(event) {

    if (event.key === 'Escape') {
        tutupBukti();
    }

});

</script>

@endsection