@extends('layouts.customer')

@section('title', 'Testimoni - Rumah Makan')

@section('content')

<div style="padding:60px 8%;">

    <div style="
        max-width:650px;
        margin:auto;
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.08);
    ">

        {{-- HEADER --}}
        <div style="text-align:center; margin-bottom:30px;">

            <div style="
                color:#b00000;
                font-weight:bold;
                letter-spacing:2px;
                margin-bottom:10px;
            ">
                TESTIMONI
            </div>

            <h1 style="margin-bottom:10px;">
                Bagikan Pengalaman Anda
            </h1>

            <p style="color:#777;">
                Berikan penilaian untuk makanan yang Anda pesan.
            </p>

        </div>


        {{-- SUCCESS --}}
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


        {{-- ERROR --}}
        @if($errors->any())

            <div style="
                background:#fff0f0;
                color:#8b0000;
                padding:12px 15px;
                border-radius:8px;
                margin-bottom:20px;
            ">

                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif


        <form action="{{ route('customer.testimoni.store') }}" method="POST">

            @csrf


            {{-- NAMA --}}

            <div style="margin-bottom:20px;">

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
                    value="{{ old('nama_pelanggan') }}"
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


            {{-- KODE PESANAN --}}

            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Kode Pesanan
                </label>

                <select
                    id="kode_pesanan"
                    name="kode_pesanan"
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

                    <option value="">
                        -- Pilih Kode Pesanan --
                    </option>

                    @foreach($pesanans as $pesanan)

                        @if($pesanan->status === 'selesai')

                            <option
                                value="{{ $pesanan->kode_pesanan }}"
                                {{ old('kode_pesanan') == $pesanan->kode_pesanan ? 'selected' : '' }}
                            >
                                {{ $pesanan->kode_pesanan }}
                                - {{ $pesanan->nama_pelanggan }}
                            </option>

                        @endif

                    @endforeach

                </select>

            </div>


            {{-- PILIH MENU --}}

            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Pilih Menu
                </label>

                <select
                    id="menu_id"
                    name="menu_id"
                    required
                    disabled
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                        background:#f7f7f7;
                    "
                >

                    <option value="">
                        -- Pilih kode pesanan terlebih dahulu --
                    </option>

                </select>

            </div>


            {{-- RATING --}}

            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Rating
                </label>

                <select
                    name="rating"
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

                    <option value="">
                        -- Pilih Rating --
                    </option>

                    <option value="5">⭐⭐⭐⭐⭐ — Sangat Baik</option>
                    <option value="4">⭐⭐⭐⭐ — Baik</option>
                    <option value="3">⭐⭐⭐ — Cukup</option>
                    <option value="2">⭐⭐ — Kurang</option>
                    <option value="1">⭐ — Sangat Kurang</option>

                </select>

            </div>


            {{-- TESTIMONI --}}

            <div style="margin-bottom:25px;">

                <label style="
                    display:block;
                    font-weight:bold;
                    margin-bottom:8px;
                ">
                    Testimoni
                </label>

                <textarea
                    name="isi_testimoni"
                    rows="5"
                    placeholder="Ceritakan pengalaman Anda terhadap makanan ini..."
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        resize:vertical;
                        box-sizing:border-box;
                    "
                >{{ old('isi_testimoni') }}</textarea>

            </div>


            {{-- TOMBOL --}}

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
                ⭐ Kirim Testimoni
            </button>

        </form>

    </div>

</div>


{{-- JAVASCRIPT PILIH MENU --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const kodePesanan = document.getElementById('kode_pesanan');
    const menuSelect = document.getElementById('menu_id');

    // Data menu berdasarkan kode pesanan
    const daftarMenu = {

        @foreach($pesanans as $pesanan)

            @if($pesanan->status === 'selesai')

                @json($pesanan->kode_pesanan): [

                    @foreach($pesanan->detailPesanan as $detail)

                        @if($detail->menu)

                            {
                                id: {{ $detail->menu->id }},
                                nama: @json($detail->menu->nama_menu)
                            },

                        @endif

                    @endforeach

                ],

            @endif

        @endforeach

    };


    // Ketika kode pesanan dipilih
    kodePesanan.addEventListener('change', function () {

        const kode = this.value;

        // Kosongkan menu
        menuSelect.innerHTML = '';


        // Jika belum memilih kode
        if (!kode) {

            menuSelect.disabled = true;
            menuSelect.style.background = '#f7f7f7';

            const option = document.createElement('option');

            option.value = '';
            option.textContent = '-- Pilih kode pesanan terlebih dahulu --';

            menuSelect.appendChild(option);

            return;
        }


        // Aktifkan dropdown menu
        menuSelect.disabled = false;
        menuSelect.style.background = 'white';


        // Pilihan awal
        const defaultOption = document.createElement('option');

        defaultOption.value = '';
        defaultOption.textContent = '-- Pilih Menu --';

        menuSelect.appendChild(defaultOption);


        // Ambil menu berdasarkan kode pesanan
        const menuPesanan = daftarMenu[kode] || [];


        // Masukkan menu
        menuPesanan.forEach(function (menu) {

            const option = document.createElement('option');

            option.value = menu.id;
            option.textContent = menu.nama;

            menuSelect.appendChild(option);

        });


        // Jika tidak ada menu
        if (menuPesanan.length === 0) {

            menuSelect.innerHTML = '';

            const option = document.createElement('option');

            option.value = '';
            option.textContent = '-- Tidak ada menu pada pesanan ini --';

            menuSelect.appendChild(option);

            menuSelect.disabled = true;
            menuSelect.style.background = '#f7f7f7';
        }

    });


    // Jika sebelumnya sudah memilih kode pesanan
    // (misalnya setelah validasi gagal)
    if (kodePesanan.value) {

        kodePesanan.dispatchEvent(new Event('change'));

    }

});

</script>

@endsection