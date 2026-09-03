@extends('layouts.admin')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('title', 'Tambah Pesanan')

@section('page-title', 'Tambah Pesanan')

@section('page-description', 'Tambahkan pesanan pelanggan baru.')

@section('content')

<div class="card">

    <div style="margin-bottom:25px;">
        <h2 style="margin-bottom:5px;">
            Tambah Pesanan
        </h2>

        <p style="color:#888; font-size:14px;">
            Isi data pelanggan dan pilih menu yang dipesan.
        </p>
    </div>


    {{-- PESAN ERROR --}}

    @if ($errors->any())

        <div style="
            background:#fde8e8;
            color:#a52a2a;
            padding:15px;
            border-radius:9px;
            margin-bottom:20px;
        ">

            <strong>Terjadi kesalahan:</strong>

            <ul style="margin:8px 0 0 20px;">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('admin.pesanan.store') }}" method="POST">

        @csrf


        {{-- DATA PELANGGAN --}}

        <h3 style="
            margin-bottom:15px;
            color:#8b0000;
        ">
            Data Pelanggan
        </h3>


        <div style="
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:18px;
            margin-bottom:25px;
        ">


            <div>

                <label style="
                    display:block;
                    margin-bottom:7px;
                    font-size:13px;
                    font-weight:600;
                ">
                    Nama Pelanggan
                </label>

                <input
                    type="text"
                    name="nama_pelanggan"
                    value="{{ old('nama_pelanggan') }}"
                    placeholder="Masukkan nama pelanggan"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:9px;
                        outline:none;
                    "
                >

            </div>


            <div>

                <label style="
                    display:block;
                    margin-bottom:7px;
                    font-size:13px;
                    font-weight:600;
                ">
                    Nomor HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp') }}"
                    placeholder="Contoh: 081234567890"
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:9px;
                        outline:none;
                    "
                >

            </div>


            <div>

                <label style="
                    display:block;
                    margin-bottom:7px;
                    font-size:13px;
                    font-weight:600;
                ">
                    Pilih Meja
                </label>

                <select
                    name="meja_id"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:9px;
                        background:white;
                        outline:none;
                    "
                >

                    <option value="">
                        -- Pilih Meja --
                    </option>

                    @foreach ($mejas as $meja)

                        <option
                            value="{{ $meja->id }}"
                            {{ old('meja_id') == $meja->id ? 'selected' : '' }}
                        >
                            Meja {{ $meja->nomor_meja }}
                            - {{ $meja->kapasitas }} Orang
                        </option>

                    @endforeach

                </select>

            </div>


            <div>

                <label style="
                    display:block;
                    margin-bottom:7px;
                    font-size:13px;
                    font-weight:600;
                ">
                    Jumlah Orang
                </label>

                <input
                    type="number"
                    name="jumlah_orang"
                    value="{{ old('jumlah_orang', 1) }}"
                    min="1"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:9px;
                        outline:none;
                    "
                >

            </div>


        </div>


        {{-- MENU --}}

        <h3 style="
            margin-bottom:15px;
            color:#8b0000;
        ">
            Menu Pesanan
        </h3>


        <div id="menu-container">

            <div class="menu-item" style="
                display:grid;
                grid-template-columns:1fr 130px;
                gap:15px;
                margin-bottom:15px;
                padding:15px;
                background:#fafafa;
                border:1px solid #eee;
                border-radius:10px;
            ">


                <div>

                    <label style="
                        display:block;
                        margin-bottom:7px;
                        font-size:13px;
                        font-weight:600;
                    ">
                        Menu
                    </label>

                    <select
                        name="menu_id[]"
                        required
                        style="
                            width:100%;
                            padding:12px;
                            border:1px solid #ddd;
                            border-radius:9px;
                            background:white;
                        "
                    >

                        <option value="">
                            -- Pilih Menu --
                        </option>

                        @foreach ($menus as $menu)

                            <option value="{{ $menu->id }}">

                                {{ $menu->nama_menu }}
                                - Rp {{ number_format($menu->harga, 0, ',', '.') }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div>

                    <label style="
                        display:block;
                        margin-bottom:7px;
                        font-size:13px;
                        font-weight:600;
                    ">
                        Jumlah
                    </label>

                    <input
                        type="number"
                        name="jumlah[]"
                        value="1"
                        min="1"
                        required
                        style="
                            width:100%;
                            padding:12px;
                            border:1px solid #ddd;
                            border-radius:9px;
                        "
                    >

                </div>


            </div>

        </div>


        {{-- TAMBAH MENU --}}

        <button
            type="button"
            onclick="tambahMenu()"
            style="
                background:#fff4df;
                color:#946b14;
                border:none;
                padding:10px 15px;
                border-radius:8px;
                cursor:pointer;
                font-weight:600;
            "
        >
            ＋ Tambah Menu
        </button>


        {{-- PEMBAYARAN --}}

<div style="
    margin-top:30px;
    margin-bottom:25px;
">

    <h3 style="
        margin-bottom:15px;
        color:#8b0000;
    ">
        Pembayaran
    </h3>

    <label style="
        display:block;
        margin-bottom:7px;
        font-size:13px;
        font-weight:600;
    ">
        Metode Pembayaran
    </label>

    <select
        id="metode-pembayaran"
        name="metode_pembayaran"
        required
        style="
            width:100%;
            padding:12px;
            border:1px solid #ddd;
            border-radius:9px;
            background:white;
        "
    >

        <option value="">
            -- Pilih Metode Pembayaran --
        </option>

        <option value="tunai">
            Tunai
        </option>

        <option value="transfer">
            Transfer
        </option>

        <option value="qris">
            QRIS
        </option>

    </select>


    {{-- INFORMASI PEMBAYARAN --}}
    <div
        id="info-pembayaran"
        style="
            display:none;
            margin-top:20px;
            padding:20px;
            background:#fff8f5;
            border-radius:12px;
            border:1px solid #f0dddd;
        "
    >

        {{-- TRANSFER --}}
        <div id="info-transfer" style="display:none;">

            <h3 style="
                margin-bottom:15px;
                color:#8b0000;
            ">
                💳 Informasi Transfer
            </h3>

            <p style="margin-bottom:8px;">
                <strong>Bank:</strong>
                {{ $pengaturan?->nama_bank ?? '-' }}
            </p>

            <p style="margin-bottom:8px;">
                <strong>Nomor Rekening:</strong>
                {{ $pengaturan?->nomor_rekening ?? '-' }}
            </p>

            <p>
                <strong>Atas Nama:</strong>
                {{ $pengaturan?->atas_nama ?? '-' }}
            </p>

        </div>


        {{-- QRIS --}}
        <div id="info-qris" style="display:none;">

            <h3 style="
                margin-bottom:15px;
                color:#8b0000;
            ">
                📱 Pembayaran QRIS
            </h3>

            @if($pengaturan?->qris)

                <img
                    src="{{ Storage::url($pengaturan->qris) }}"
                    alt="QRIS"
                    style="
                        display:block;
                        width:250px;
                        max-width:100%;
                        margin:10px auto;
                        border-radius:10px;
                        border:1px solid #ddd;
                    "
                >

                <p style="
                    text-align:center;
                    color:#777;
                    margin-top:10px;
                ">
                    Silakan scan QRIS untuk melakukan pembayaran.
                </p>

            @else

                <p style="color:#777;">
                    QRIS belum tersedia.
                </p>

            @endif

        </div>


        {{-- TUNAI --}}
        <div id="info-tunai" style="display:none;">

            <h3 style="
                margin-bottom:10px;
                color:#8b0000;
            ">
                💵 Pembayaran Tunai
            </h3>

            <p style="color:#777;">
                Silakan lakukan pembayaran langsung di rumah makan.
            </p>

        </div>

    </div>

</div>

        {{-- CATATAN --}}

        <div style="margin-bottom:25px;">

            <label style="
                display:block;
                margin-bottom:7px;
                font-size:13px;
                font-weight:600;
            ">
                Catatan
            </label>

            <textarea
                name="catatan"
                rows="3"
                placeholder="Catatan tambahan untuk pesanan..."
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    border-radius:9px;
                    resize:vertical;
                "
            >{{ old('catatan') }}</textarea>

        </div>


        {{-- TOMBOL --}}

        <div style="
            display:flex;
            justify-content:flex-end;
            gap:10px;
            margin-top:25px;
        ">

            <a
                href="{{ route('admin.pesanan') }}"
                style="
                    background:#eee;
                    color:#555;
                    padding:11px 18px;
                    border-radius:9px;
                    text-decoration:none;
                    font-weight:600;
                "
            >
                Batal
            </a>


            <button
                type="submit"
                style="
                    background:#8b0000;
                    color:white;
                    border:none;
                    padding:11px 20px;
                    border-radius:9px;
                    cursor:pointer;
                    font-weight:600;
                "
            >
                💾 Simpan Pesanan
            </button>

        </div>


    </form>

</div>


<script>

function tambahMenu() {

    const container = document.getElementById('menu-container');

    const item = document.createElement('div');

    item.className = 'menu-item';

    item.style = `
        display:grid;
        grid-template-columns:1fr 130px auto;
        gap:15px;
        margin-bottom:15px;
        padding:15px;
        background:#fafafa;
        border:1px solid #eee;
        border-radius:10px;
        align-items:end;
    `;

    item.innerHTML = `

        <div>

            <label style="
                display:block;
                margin-bottom:7px;
                font-size:13px;
                font-weight:600;
            ">
                Menu
            </label>

            <select
                name="menu_id[]"
                required
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    border-radius:9px;
                    background:white;
                "
            >

                <option value="">
                    -- Pilih Menu --
                </option>

                @foreach ($menus as $menu)

                    <option value="{{ $menu->id }}">
                        {{ $menu->nama_menu }}
                        - Rp {{ number_format($menu->harga, 0, ',', '.') }}
                    </option>

                @endforeach

            </select>

        </div>


        <div>

            <label style="
                display:block;
                margin-bottom:7px;
                font-size:13px;
                font-weight:600;
            ">
                Jumlah
            </label>

            <input
                type="number"
                name="jumlah[]"
                value="1"
                min="1"
                required
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    border-radius:9px;
                "
            >

        </div>


        <button
            type="button"
            onclick="this.parentElement.remove()"
            style="
                background:#fde8e8;
                color:#a52a2a;
                border:none;
                padding:10px 12px;
                border-radius:8px;
                cursor:pointer;
            "
        >
            🗑️
        </button>

    `;

    container.appendChild(item);
}

</script>

<script>

document.getElementById('metode-pembayaran').addEventListener('change', function () {

    const metode = this.value;

    const infoPembayaran = document.getElementById('info-pembayaran');
    const infoTransfer = document.getElementById('info-transfer');
    const infoQris = document.getElementById('info-qris');
    const infoTunai = document.getElementById('info-tunai');

    // Sembunyikan semuanya dulu
    infoPembayaran.style.display = 'none';
    infoTransfer.style.display = 'none';
    infoQris.style.display = 'none';
    infoTunai.style.display = 'none';

    // Kalau belum pilih
    if (!metode) {
        return;
    }

    // Tampilkan bagian pembayaran
    infoPembayaran.style.display = 'block';

    if (metode === 'transfer') {

        infoTransfer.style.display = 'block';

    } else if (metode === 'qris') {

        infoQris.style.display = 'block';

    } else if (metode === 'tunai') {

        infoTunai.style.display = 'block';

    }

});

</script>

@endsection