@extends('layouts.customer')

@section('title', 'Pesanan - Rumah Makan')

@section('content')

<div style="padding:60px 8%;">

    {{-- JUDUL --}}
    <div style="text-align:center; margin-bottom:40px;">

        <div style="
            color:#b00000;
            font-weight:bold;
            letter-spacing:2px;
            margin-bottom:10px;
        ">
            PESANAN
        </div>

        <h1 style="font-size:36px; margin-bottom:10px;">
            Pesanan Anda
        </h1>

        <p style="color:#777;">
            Periksa menu dan jumlah pesanan Anda sebelum melanjutkan.
        </p>

    </div>


    {{-- CARD --}}
    <div style="
        max-width:900px;
        margin:auto;
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.08);
    ">

        <h2 style="margin-bottom:25px;">
            🛒 Daftar Pesanan
        </h2>


        {{-- ================================= --}}
        {{-- KERANJANG --}}
        {{-- ================================= --}}

        <div id="keranjang"></div>


        {{-- ================================= --}}
        {{-- TOTAL --}}
        {{-- ================================= --}}

        <div
            id="bagian-total"
            style="
                display:none;
                justify-content:space-between;
                align-items:center;
                margin-top:25px;
                padding-top:20px;
                border-top:2px solid #eee;
            "
        >

            <strong style="font-size:18px;">
                Total
            </strong>

            <strong
                id="total"
                style="
                    color:#8b0000;
                    font-size:22px;
                "
            >
                Rp0
            </strong>

        </div>


        {{-- ================================= --}}
        {{-- FORM PESANAN --}}
        {{-- ================================= --}}

        <form
            id="form-pelanggan"
            action="{{ route('customer.pesanan.store') }}"
            method="POST"
            style="display:none;"
        >

            @csrf

         @if($pesananLama)

    <input
        type="hidden"
        name="kode_pesanan_lama"
        value="{{ $pesananLama->kode_pesanan }}"
    >

    @endif   


            {{-- DATA PELANGGAN --}}
            <div style="
                margin-top:35px;
                padding-top:25px;
                border-top:1px solid #eee;
            ">

                <h2 style="margin-bottom:20px;">
                    Data Pelanggan
                </h2>


                {{-- NAMA --}}
                <div style="margin-bottom:18px;">

                    <label style="
                        display:block;
                        font-weight:bold;
                        margin-bottom:8px;
                    ">
                        Nama Pelanggan
                    </label>

                    <input
                        type="text"
                        name="nama_pelanggan"
                        placeholder="Masukkan nama Anda"
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
                <div style="margin-bottom:18px;">

                    <label style="
                        display:block;
                        font-weight:bold;
                        margin-bottom:8px;
                    ">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        placeholder="Contoh: 081234567890"
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
                <div style="margin-bottom:18px;">

                    <label style="
                        display:block;
                        font-weight:bold;
                        margin-bottom:8px;
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
                            border-radius:8px;
                        "
                    >

                        <option value="">
                            -- Pilih Meja --
                        </option>

                        @foreach($mejas as $meja)

                            <option value="{{ $meja->id }}">
                                Meja {{ $meja->nomor_meja }}
                                -
                                {{ $meja->tipe }}
                                -
                                {{ $meja->kapasitas }} Orang
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- JUMLAH ORANG --}}
                <div style="margin-bottom:18px;">

                    <label style="
                        display:block;
                        font-weight:bold;
                        margin-bottom:8px;
                    ">
                        Jumlah Orang
                    </label>

                    <input
                        type="number"
                        name="jumlah_orang"
                        min="1"
                        placeholder="Contoh: 5"
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

{{-- PEMBAYARAN --}}
<div style="margin-bottom:18px;">

    <label style="
        display:block;
        font-weight:bold;
        margin-bottom:8px;
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
            border-radius:8px;
        "
    >

        <option value="">
            -- Pilih Pembayaran --
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

</div>


{{-- INFORMASI PEMBAYARAN --}}
<div
    id="info-pembayaran"
    style="
        display:none;
        margin-bottom:25px;
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
             Informasi Transfer
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
             Pembayaran QRIS
        </h3>

        @if($pengaturan?->qris)

            <img
                src="{{ asset('storage/' . $pengaturan->qris) }}"
                alt="QRIS {{ $pengaturan?->nama_rumah_makan ?? 'Rumah Makan' }}"
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
             Pembayaran Tunai
        </h3>

        <p style="color:#777;">
            Silakan lakukan pembayaran langsung di rumah makan.
        </p>

    </div>

</div>

                {{-- CATATAN --}}
                <div style="margin-bottom:25px;">

                    <label style="
                        display:block;
                        font-weight:bold;
                        margin-bottom:8px;
                    ">
                        Catatan
                    </label>

                    <textarea
                        name="catatan"
                        rows="4"
                        placeholder="Contoh: Tidak pedas"
                        style="
                            width:100%;
                            padding:12px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            resize:vertical;
                            box-sizing:border-box;
                        "
                    ></textarea>

                </div>


                {{-- DATA MENU AKAN DIBUAT JAVASCRIPT --}}
                <div id="data-menu"></div>


                {{-- TOMBOL KIRIM --}}
                <button
                    type="submit"
                    style="
                        width:100%;
                        background:#8b0000;
                        color:white;
                        border:none;
                        padding:14px;
                        border-radius:8px;
                        font-weight:bold;
                        cursor:pointer;
                        font-size:15px;
                    "
                >
                    🛒 Kirim Pesanan
                </button>

            </div>

        </form>

    </div>

</div>


{{-- ================================= --}}
{{-- JAVASCRIPT --}}
{{-- ================================= --}}

<script>

// ===============================
// INFORMASI PEMBAYARAN
// ===============================

const metodePembayaran =
    document.getElementById('metode-pembayaran');

const infoPembayaran =
    document.getElementById('info-pembayaran');

const infoTransfer =
    document.getElementById('info-transfer');

const infoQris =
    document.getElementById('info-qris');

const infoTunai =
    document.getElementById('info-tunai');


metodePembayaran.addEventListener('change', function () {

    const metode = this.value;

    // Sembunyikan semuanya dulu
    infoPembayaran.style.display = 'none';
    infoTransfer.style.display = 'none';
    infoQris.style.display = 'none';
    infoTunai.style.display = 'none';


    // Kalau belum memilih
    if (metode === '') {
        return;
    }


    // Tampilkan kotak pembayaran
    infoPembayaran.style.display = 'block';


    // TRANSFER
    if (metode === 'transfer') {

        infoTransfer.style.display = 'block';

    }


    // QRIS
    else if (metode === 'qris') {

        infoQris.style.display = 'block';

    }


    // TUNAI
    else if (metode === 'tunai') {

        infoTunai.style.display = 'block';

    }

});

    let keranjang =
        JSON.parse(localStorage.getItem('keranjang')) || [];


    // ===============================
    // FORMAT RUPIAH
    // ===============================

    function formatRupiah(angka) {

        return 'Rp' +
            new Intl.NumberFormat('id-ID').format(angka);

    }


    // ===============================
    // TAMPILKAN KERANJANG
    // ===============================

    function tampilkanKeranjang() {

        const container =
            document.getElementById('keranjang');

        const bagianTotal =
            document.getElementById('bagian-total');

        const formPelanggan =
            document.getElementById('form-pelanggan');


        // ===============================
        // JIKA KERANJANG KOSONG
        // ===============================

        if (keranjang.length === 0) {

            container.innerHTML = `

                <div style="
                    text-align:center;
                    padding:40px 20px;
                    color:#777;
                ">

                    <div style="
                        font-size:60px;
                        margin-bottom:15px;
                    ">
                        🛒
                    </div>

                    <h3 style="margin-bottom:10px;">
                        Belum ada pesanan
                    </h3>

                    <p style="margin-bottom:20px;">
                        Silakan pilih menu terlebih dahulu.
                    </p>

                    <a
                        href="{{ route('customer.menu') }}"
                        style="
                            display:inline-block;
                            background:#8b0000;
                            color:white;
                            padding:11px 20px;
                            border-radius:8px;
                            text-decoration:none;
                        "
                    >
                        Lihat Menu
                    </a>

                </div>

            `;

            bagianTotal.style.display = 'none';
            formPelanggan.style.display = 'none';

            return;

        }


        // ===============================
        // HITUNG TOTAL
        // ===============================

        let total = 0;


        // ===============================
        // TAMPILKAN SETIAP MENU
        // ===============================

        container.innerHTML = keranjang.map(
            (item, index) => {

                const subtotal =
                    item.harga * item.jumlah;

                total += subtotal;


                return `

                    <div style="
                        display:flex;
                        justify-content:space-between;
                        align-items:center;
                        gap:20px;
                        padding:20px 0;
                        border-bottom:1px solid #eee;
                    ">


                        {{-- NAMA MENU --}}

                        <div style="flex:1;">

                            <h3 style="margin-bottom:8px;">
                                ${item.nama}
                            </h3>

                            <p style="
                                color:#777;
                                font-size:14px;
                            ">
                                ${formatRupiah(item.harga)}
                            </p>

                        </div>


                        
                            {{-- JUMLAH --}}
                        <div style="
                            display:flex;
                            align-items:center;
                            gap:10px;
                        ">

                            <button
                                type="button"
                                onclick="kurangiJumlah(${index})"
                                style="
                                    width:35px;
                                    height:35px;
                                    border:1px solid #ddd;
                                    background:white;
                                    border-radius:7px;
                                    cursor:pointer;
                                    font-size:18px;
                                "
                            >
                                −
                            </button>


                            <strong style="
                                min-width:25px;
                                text-align:center;
                            ">
                                ${item.jumlah}
                            </strong>


                            <button
                                type="button"
                                onclick="tambahJumlah(${index})"
                                style="
                                    width:35px;
                                    height:35px;
                                    border:none;
                                    background:#8b0000;
                                    color:white;
                                    border-radius:7px;
                                    cursor:pointer;
                                    font-size:18px;
                                "
                            >
                                +
                            </button>

                        </div>


                        {{-- SUBTOTAL --}}

                        <strong style="
                            color:#8b0000;
                            min-width:120px;
                            text-align:right;
                        ">
                            ${formatRupiah(subtotal)}
                        </strong>


                        {{-- HAPUS --}}

                        <button
                            type="button"
                            onclick="hapusMenu(${index})"
                            style="
                                border:none;
                                background:none;
                                color:#999;
                                cursor:pointer;
                                font-size:18px;
                            "
                        >
                            🗑️
                        </button>

                    </div>

                `;

            }
        ).join('');


        // ===============================
        // TAMPILKAN TOTAL
        // ===============================

        document.getElementById('total').innerText =
            formatRupiah(total);


        bagianTotal.style.display = 'flex';

        formPelanggan.style.display = 'block';


        // ===============================
        // BUAT INPUT MENU
        // ===============================

        buatInputMenu();

    }


    // ===============================
    // TAMBAH JUMLAH
    // ===============================

    function tambahJumlah(index) {

        keranjang[index].jumlah++;

        simpanKeranjang();

    }


    // ===============================
    // KURANGI JUMLAH
    // ===============================

    function kurangiJumlah(index) {

        if (keranjang[index].jumlah > 1) {

            keranjang[index].jumlah--;

        } else {

            keranjang.splice(index, 1);

        }

        simpanKeranjang();

    }


    // ===============================
    // HAPUS MENU
    // ===============================

    function hapusMenu(index) {

        keranjang.splice(index, 1);

        simpanKeranjang();

    }


    // ===============================
    // SIMPAN KERANJANG
    // ===============================

    function simpanKeranjang() {

        localStorage.setItem(
            'keranjang',
            JSON.stringify(keranjang)
        );

        tampilkanKeranjang();

    }


    // ===============================
    // BUAT INPUT MENU UNTUK LARAVEL
    // ===============================

    function buatInputMenu() {

        const container =
            document.getElementById('data-menu');

        container.innerHTML = '';


        keranjang.forEach(item => {

            container.innerHTML += `

                <input
                    type="hidden"
                    name="menu_id[]"
                    value="${item.id}"
                >

                <input
                    type="hidden"
                    name="jumlah[]"
                    value="${item.jumlah}"
                >

            `;

        });

    }


    // ===============================
    // TAMPILKAN SAAT HALAMAN DIBUKA
    // ===============================

    tampilkanKeranjang();

</script>

@endsection