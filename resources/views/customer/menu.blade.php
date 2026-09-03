@extends('layouts.customer')

@section('title', 'Menu - Rumah Makan')

@section('content')

<div style="padding:60px 8%;">

    {{-- =====================================================
         JUDUL
    ====================================================== --}}

    <div style="
        text-align:center;
        margin-bottom:30px;
    ">

        <div style="
            color:#b00000;
            font-weight:bold;
            letter-spacing:2px;
            margin-bottom:10px;
        ">
            MENU KAMI
        </div>

        <h1 style="
            font-size:36px;
            margin-bottom:10px;
        ">
            Pilihan Menu Rumah Makan
        </h1>

        <p style="
            color:#777;
            margin:0;
        ">
            Nikmati berbagai makanan dan minuman favorit kami.
        </p>

    </div>


    {{-- =====================================================
         FILTER KATEGORI
    ====================================================== --}}

    <div style="
        display:flex;
        justify-content:center;
        gap:12px;
        margin-bottom:40px;
        flex-wrap:wrap;
    ">

        <button
            type="button"
            onclick="filterMenu('semua')"
            class="filter-btn active"
            data-filter="semua"
        >
             Semua
        </button>

        <button
            type="button"
            onclick="filterMenu('makanan')"
            class="filter-btn"
            data-filter="makanan"
        >
             Makanan
        </button>

        <button
            type="button"
            onclick="filterMenu('minuman')"
            class="filter-btn"
            data-filter="minuman"
        >
             Minuman
        </button>

        <button
            type="button"
            onclick="filterMenu('dessert')"
            class="filter-btn"
            data-filter="dessert"
        >
            Dessert
        </button>

    </div>


    {{-- =====================================================
         DAFTAR MENU
    ====================================================== --}}

    <div class="menu-grid">

        @forelse($menus as $menu)

            <div
                class="menu-card"
                data-category="{{ strtolower($menu->kategori->nama_kategori ?? '') }}"
            >

                {{-- FOTO MENU --}}

                <div class="menu-image">

                    @if($menu->foto)

                        <img
                            src="{{ asset('storage/' . $menu->foto) }}"
                            alt="{{ $menu->nama_menu }}"
                        >

                    @else

                        <span class="menu-placeholder">
                            🍽️
                        </span>

                    @endif

                </div>


                {{-- INFORMASI MENU --}}

                <div class="menu-info">

                    <span class="menu-category">

                        {{ $menu->kategori->nama_kategori ?? 'Menu' }}

                    </span>


                    <h3>
                        {{ $menu->nama_menu }}
                    </h3>


                    <p class="menu-description">

                        {{ $menu->deskripsi ?? 'Menu pilihan rumah makan.' }}

                    </p>


                    <div class="menu-bottom">

                        {{-- HARGA --}}

                        <strong class="menu-price">

                            Rp{{ number_format($menu->harga, 0, ',', '.') }}

                        </strong>


                        {{-- TOMBOL PESAN --}}

                <div class="menu-actions">

                    @if($menu->status === 'tersedia')

                        <button
                            type="button"
                            onclick="tambahKeKeranjang(
                                {{ $menu->id }},
                                @js($menu->nama_menu),
                                {{ $menu->harga }}
                            )"
                            class="btn-pesan"
                        >
                            + Pesan
                        </button>

                        <button
                            type="button"
                            onclick="tambahKeKeranjang(
                                {{ $menu->id }},
                                @js($menu->nama_menu),
                                {{ $menu->harga }}
                            )"
                            class="btn-cart"
                            title="Tambah ke keranjang"
                        >
                            🛒
                        </button>

                                @else

                                    <span class="menu-habis">
                                        🔴 Habis
                                    </span>

                                @endif

                            </div>
                    </div>

                </div>

            </div>

        @empty

            <div style="
                grid-column:1 / -1;
                text-align:center;
                padding:50px 20px;
                color:#777;
            ">

                <div style="
                    font-size:50px;
                    margin-bottom:15px;
                ">
                    🍽️
                </div>

                <h3 style="
                    color:#333;
                    margin-bottom:8px;
                ">
                    Belum Ada Menu
                </h3>

                <p>
                    Menu rumah makan belum tersedia.
                </p>

            </div>

        @endforelse

    </div>

</div>



{{-- =====================================================
     NOTIFIKASI KERANJANG
===================================================== --}}

<div id="cartNotification">

    <span class="notification-icon">
        ✓
    </span>

    <span id="notificationText">
        Menu ditambahkan ke keranjang
    </span>

</div>



{{-- =====================================================
     KERANJANG MELAYANG
===================================================== --}}

<div
    id="floatingCart"
    onclick="bukaKeranjang()"
>

    <span>
        🛒
    </span>

    <span id="cartCount">
        0
    </span>

</div>



{{-- =====================================================
     PANEL KERANJANG
===================================================== --}}

<div
    id="cartPanel"
>

    {{-- HEADER --}}

    <div class="cart-header">

        <strong>
            🛒 Keranjang Anda
        </strong>

        <button
            type="button"
            onclick="tutupKeranjang(event)"
            class="cart-close"
        >
            ×
        </button>

    </div>


    {{-- ISI KERANJANG --}}

    <div id="cartItems">

    </div>


    {{-- TOTAL --}}

    <div class="cart-footer">

        <div class="cart-total">

            <span>
                Total
            </span>

            <span id="cartTotal">
                Rp0
            </span>

        </div>


        <a
            href="{{ route('customer.pesanan') }}"
            class="btn-lihat-pesanan"
        >
            Lihat Pesanan
        </a>

    </div>

</div>



{{-- =====================================================
     STYLE
===================================================== --}}

<style>

    /* =====================================================
       GRID MENU
    ====================================================== */

    .menu-grid {

        display:grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap:25px;

    }


    /* =====================================================
       MENU CARD
    ====================================================== */

    .menu-card {

        background:white;

        border-radius:15px;

        overflow:hidden;

        box-shadow:
            0 5px 20px rgba(0,0,0,0.08);

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease;

    }


    .menu-card:hover {

        transform:translateY(-4px);

        box-shadow:
            0 10px 30px rgba(0,0,0,0.12);

    }


    /* =====================================================
       FOTO MENU
    ====================================================== */

    .menu-image {

        height:200px;

        background:#f3f3f3;

        display:flex;

        align-items:center;

        justify-content:center;

        overflow:hidden;

    }


    .menu-image img {

        width:100%;

        height:100%;

        object-fit:cover;

    }


    .menu-placeholder {

        font-size:80px;

    }


    /* =====================================================
       INFORMASI MENU
    ====================================================== */

    .menu-info {

        padding:20px;

    }


    .menu-category {

        display:inline-block;

        font-size:12px;

        color:#8b0000;

        background:#fff1f1;

        padding:5px 9px;

        border-radius:20px;

    }


    .menu-info h3 {

        margin:
            12px 0 8px;

        font-size:20px;

        color:#222;

    }


    .menu-description {

        color:#777;

        font-size:14px;

        line-height:1.6;

        margin-bottom:15px;

        min-height:45px;

    }


    /* =====================================================
       BAGIAN BAWAH MENU
    ====================================================== */

    .menu-bottom {

        display:flex;

        justify-content:space-between;

        align-items:center;

        gap:10px;

    }


    .menu-price {

        color:#8b0000;

        font-size:18px;

        white-space:nowrap;

    }


    .menu-actions {

        display:flex;

        gap:8px;

        align-items:center;

    }


    .btn-pesan {

        background:#8b0000;

        color:white;

        padding:
            9px 14px;

        border-radius:7px;

        border:none;

        cursor:pointer;

        font-weight:bold;

        transition:0.2s;

    }


    .btn-pesan:hover {

        background:#650000;

    }


    .btn-cart {

        width:40px;

        height:38px;

        border:
            1px solid #8b0000;

        background:#8b0000;

        color:white;

        border-radius:7px;

        cursor:pointer;

        font-size:18px;

        transition:0.2s;

    }


    .btn-cart:hover {

        background:#650000;

    }


    /* =====================================================
       FILTER
    ====================================================== */

    .filter-btn {

        border:
            1px solid #ddd;

        background:white;

        color:#555;

        padding:
            10px 20px;

        border-radius:25px;

        cursor:pointer;

        font-weight:bold;

        transition:0.2s;

    }


    .filter-btn:hover {

        border-color:#8b0000;

        color:#8b0000;

    }


    .filter-btn.active {

        background:#8b0000;

        color:white;

        border-color:#8b0000;

    }


    /* =====================================================
       NOTIFIKASI
    ====================================================== */

    #cartNotification {

        position:fixed;

        top:90px;

        right:25px;

        background:#8b0000;

        color:white;

        padding:
            13px 18px;

        border-radius:10px;

        box-shadow:
            0 5px 20px rgba(0,0,0,0.2);

        z-index:10001;

        display:none;

        align-items:center;

        gap:8px;

        font-size:14px;

        font-weight:bold;

    }


    .notification-icon {

        display:inline-flex;

        align-items:center;

        justify-content:center;

        width:22px;

        height:22px;

        background:white;

        color:#8b0000;

        border-radius:50%;

        font-size:13px;

    }


    /* =====================================================
       FLOATING CART
    ====================================================== */

    #floatingCart {

        position:fixed;

        right:25px;

        bottom:25px;

        width:60px;

        height:60px;

        background:#8b0000;

        color:white;

        border-radius:50%;

        display:flex;

        align-items:center;

        justify-content:center;

        cursor:pointer;

        box-shadow:
            0 5px 20px rgba(0,0,0,0.25);

        z-index:9999;

        font-size:25px;

        transition:0.2s;

    }


    #floatingCart:hover {

        transform:scale(1.08);

        background:#650000;

    }


    #cartCount {

        position:absolute;

        top:-5px;

        right:-5px;

        width:24px;

        height:24px;

        background:#d9a441;

        color:white;

        border-radius:50%;

        display:flex;

        align-items:center;

        justify-content:center;

        font-size:12px;

        font-weight:bold;

    }


    /* =====================================================
       PANEL KERANJANG
    ====================================================== */

    #cartPanel {

        display:none;

        position:fixed;

        right:25px;

        bottom:95px;

        width:360px;

        max-width:
            calc(100vw - 40px);

        background:white;

        border-radius:15px;

        box-shadow:
            0 8px 30px rgba(0,0,0,0.2);

        z-index:9998;

        overflow:hidden;

    }


    /* =====================================================
       HEADER KERANJANG
    ====================================================== */

    .cart-header {

        background:#8b0000;

        color:white;

        padding:
            16px 18px;

        display:flex;

        justify-content:space-between;

        align-items:center;

    }


    .cart-close {

        background:none;

        border:none;

        color:white;

        font-size:22px;

        cursor:pointer;

        line-height:1;

    }


    /* =====================================================
       ISI KERANJANG
    ====================================================== */

    #cartItems {

        max-height:320px;

        overflow-y:auto;

        padding:
            15px;

    }


    /* =====================================================
       ITEM KERANJANG
    ====================================================== */

    .cart-item {

        padding:
            12px 0;

        border-bottom:
            1px solid #eee;

    }


    .cart-item:last-child {

        border-bottom:none;

    }


    .cart-item-top {

        display:flex;

        justify-content:space-between;

        align-items:flex-start;

        gap:10px;

    }


    .cart-item-name {

        flex:1;

        font-weight:bold;

        font-size:14px;

        color:#333;

    }


    .cart-item-price {

        color:#8b0000;

        font-size:13px;

        font-weight:bold;

        white-space:nowrap;

    }


    .cart-item-unit {

        color:#888;

        font-size:12px;

        margin-top:4px;

    }


    /* =====================================================
       KONTROL JUMLAH
    ====================================================== */

    .cart-item-bottom {

        display:flex;

        justify-content:space-between;

        align-items:center;

        margin-top:10px;

        gap:10px;

    }


    .quantity-control {

        display:flex;

        align-items:center;

        gap:7px;

    }


    .quantity-btn {

        width:28px;

        height:28px;

        border-radius:6px;

        cursor:pointer;

        font-weight:bold;

        font-size:15px;

    }


    .quantity-minus {

        border:
            1px solid #ddd;

        background:white;

        color:#333;

    }


    .quantity-plus {

        border:
            1px solid #8b0000;

        background:#8b0000;

        color:white;

    }


    .quantity-number {

        min-width:20px;

        text-align:center;

        font-weight:bold;

        font-size:13px;

    }


    /* =====================================================
       TOMBOL HAPUS
    ====================================================== */

    .btn-hapus {

        border:none;

        background:#fff1f1;

        color:#b00000;

        padding:
            7px 10px;

        border-radius:6px;

        cursor:pointer;

        font-size:12px;

        font-weight:bold;

        transition:0.2s;

    }


    .btn-hapus:hover {

        background:#ffe0e0;

    }


    /* =====================================================
       FOOTER KERANJANG
    ====================================================== */

    .cart-footer {

        border-top:
            1px solid #eee;

        padding:15px;

    }


    .cart-total {

        display:flex;

        justify-content:space-between;

        align-items:center;

        margin-bottom:12px;

        font-weight:bold;

    }


    #cartTotal {

        color:#8b0000;

        font-size:17px;

    }


    .btn-lihat-pesanan {

        display:block;

        text-align:center;

        background:#8b0000;

        color:white;

        padding:11px;

        border-radius:8px;

        text-decoration:none;

        font-weight:bold;

        transition:0.2s;

    }


    .btn-lihat-pesanan:hover {

        background:#650000;

    }

    /* =====================================================
        STATUS MENU HABIS
       ===================================================== */

        .menu-habis {

            display:inline-flex;

            align-items:center;

            justify-content:center;

            background:#fce8e8;

            color:#b00000;

            padding:9px 16px;

            border-radius:7px;

            font-weight:bold;

            font-size:14px;

            border:1px solid #f3caca;

        }


    /* =====================================================
       RESPONSIVE
    ====================================================== */

    @media (max-width:900px) {

        .menu-grid {

            grid-template-columns:
                repeat(2, 1fr);

        }

    }


    @media (max-width:600px) {

        .menu-grid {

            grid-template-columns:
                1fr;

        }


        #cartNotification {

            right:15px;

            left:15px;

            top:80px;

            justify-content:center;

        }


        #floatingCart {

            right:18px;

            bottom:18px;

        }


        #cartPanel {

            right:15px;

            bottom:88px;

            width:
                calc(100vw - 30px);

        }


        .menu-bottom {

            align-items:flex-end;

        }

    }

</style>



{{-- =====================================================
     JAVASCRIPT
===================================================== --}}

<script>

    // =====================================================
    // FILTER MENU
    // =====================================================

    function filterMenu(category) {

        const cards =
            document.querySelectorAll('.menu-card');

        const buttons =
            document.querySelectorAll('.filter-btn');


        buttons.forEach(button => {

            button.classList.remove('active');


            if (
                button.dataset.filter === category
            ) {

                button.classList.add('active');

            }

        });


        cards.forEach(card => {

            const cardCategory =
                card.dataset.category;


            if (
                category === 'semua' ||
                cardCategory === category
            ) {

                card.style.display = '';

            } else {

                card.style.display = 'none';

            }

        });

    }



    // =====================================================
    // AMBIL KERANJANG
    // =====================================================

    function ambilKeranjang() {

        return JSON.parse(
            localStorage.getItem('keranjang')
        ) || [];

    }



    // =====================================================
    // SIMPAN KERANJANG
    // =====================================================

    function simpanKeranjang(keranjang) {

        localStorage.setItem(
            'keranjang',
            JSON.stringify(keranjang)
        );

    }



    // =====================================================
    // TAMBAH MENU KE KERANJANG
    // =====================================================

    function tambahKeKeranjang(id, nama, harga) {

        let keranjang =
            ambilKeranjang();


        let item =
            keranjang.find(
                item => Number(item.id) === Number(id)
            );


        if (item) {

            item.jumlah =
                Number(item.jumlah) + 1;

        } else {

            keranjang.push({

                id: Number(id),

                nama: nama,

                harga: Number(harga),

                jumlah: 1

            });

        }


        simpanKeranjang(keranjang);


        updateKeranjang();


        // Tampilkan notifikasi

        tampilkanNotifikasi(
            '✓ ' + nama + ' ditambahkan ke keranjang'
        );


        // Buka keranjang

        bukaKeranjang(true);

    }



    // =====================================================
    // HAPUS ITEM
    // =====================================================

    function hapusDariKeranjang(id) {

        let keranjang =
            ambilKeranjang();


        const item =
            keranjang.find(
                item => Number(item.id) === Number(id)
            );


        if (!item) {

            return;

        }


        keranjang =
            keranjang.filter(
                item => Number(item.id) !== Number(id)
            );


        simpanKeranjang(keranjang);


        updateKeranjang();


        tampilkanNotifikasi(
            '🗑 ' + item.nama + ' dihapus dari keranjang'
        );

    }



    // =====================================================
    // TAMBAH JUMLAH
    // =====================================================

    function tambahJumlah(id) {

        let keranjang =
            ambilKeranjang();


        let item =
            keranjang.find(
                item => Number(item.id) === Number(id)
            );


        if (item) {

            item.jumlah =
                Number(item.jumlah) + 1;

        }


        simpanKeranjang(keranjang);


        updateKeranjang();

    }



    // =====================================================
    // KURANGI JUMLAH
    // =====================================================

    function kurangiJumlah(id) {

        let keranjang =
            ambilKeranjang();


        let item =
            keranjang.find(
                item => Number(item.id) === Number(id)
            );


        if (!item) {

            return;

        }


        item.jumlah =
            Number(item.jumlah) - 1;


        // Jika jumlah 0, hapus

        if (item.jumlah <= 0) {

            const nama =
                item.nama;


            keranjang =
                keranjang.filter(
                    item =>
                        Number(item.id) !== Number(id)
                );


            tampilkanNotifikasi(
                '🗑 ' + nama + ' dihapus dari keranjang'
            );

        }


        simpanKeranjang(keranjang);


        updateKeranjang();

    }



    // =====================================================
    // UPDATE KERANJANG
    // =====================================================

    function updateKeranjang() {

        const keranjang =
            ambilKeranjang();


        // =================================================
        // HITUNG JUMLAH ITEM
        // =================================================

        const jumlahItem =
            keranjang.reduce(
                (total, item) => {

                    return total +
                        Number(item.jumlah);

                },
                0
            );


        // Update badge

        const cartCount =
            document.getElementById(
                'cartCount'
            );


        if (cartCount) {

            cartCount.innerText =
                jumlahItem;

        }


        // =================================================
        // ELEMENT KERANJANG
        // =================================================

        const cartItems =
            document.getElementById(
                'cartItems'
            );


        if (!cartItems) {

            return;

        }


        let total = 0;


        // =================================================
        // KERANJANG KOSONG
        // =================================================

        if (keranjang.length === 0) {

            cartItems.innerHTML = `

                <div style="
                    text-align:center;
                    color:#999;
                    padding:30px 10px;
                ">

                    <div style="
                        font-size:40px;
                        margin-bottom:10px;
                    ">
                        🛒
                    </div>

                    <div style="
                        font-weight:bold;
                        color:#555;
                        margin-bottom:5px;
                    ">
                        Keranjang masih kosong
                    </div>

                    <div style="
                        font-size:12px;
                    ">
                        Silakan pilih menu terlebih dahulu.
                    </div>

                </div>

            `;

        }


        // =================================================
        // ADA ITEM
        // =================================================

        else {

            cartItems.innerHTML =
                keranjang.map(item => {

                    const harga =
                        Number(item.harga);

                    const jumlah =
                        Number(item.jumlah);

                    const subtotal =
                        harga * jumlah;


                    total += subtotal;


                    return `

                        <div class="cart-item">

                            <div class="cart-item-top">

                                <div>

                                    <div class="cart-item-name">
                                        ${escapeHtml(item.nama)}
                                    </div>

                                    <div class="cart-item-unit">
                                        Rp${harga.toLocaleString('id-ID')}
                                        / item
                                    </div>

                                </div>


                                <div class="cart-item-price">
                                    Rp${subtotal.toLocaleString('id-ID')}
                                </div>

                            </div>


                            <div class="cart-item-bottom">


                                <div class="quantity-control">

                                    <button
                                        type="button"
                                        class="quantity-btn quantity-minus"
                                        onclick="kurangiJumlah(${Number(item.id)})"
                                    >
                                        −
                                    </button>


                                    <span class="quantity-number">
                                        ${jumlah}
                                    </span>


                                    <button
                                        type="button"
                                        class="quantity-btn quantity-plus"
                                        onclick="tambahJumlah(${Number(item.id)})"
                                    >
                                        +
                                    </button>

                                </div>


                                <button
                                    type="button"
                                    class="btn-hapus"
                                    onclick="hapusDariKeranjang(${Number(item.id)})"
                                >
                                    🗑 Hapus
                                </button>

                            </div>

                        </div>

                    `;

                }).join('');

        }


        // =================================================
        // UPDATE TOTAL
        // =================================================

        const cartTotal =
            document.getElementById(
                'cartTotal'
            );


        if (cartTotal) {

            cartTotal.innerText =
                'Rp' +
                total.toLocaleString('id-ID');

        }

    }



    // =====================================================
    // AMANKAN NAMA MENU
    // =====================================================

    function escapeHtml(text) {

        const div =
            document.createElement('div');

        div.textContent =
            text ?? '';

        return div.innerHTML;

    }



    // =====================================================
    // NOTIFIKASI
    // =====================================================

    let notificationTimer;


    function tampilkanNotifikasi(pesan) {

        const notification =
            document.getElementById(
                'cartNotification'
            );


        const text =
            document.getElementById(
                'notificationText'
            );


        if (!notification || !text) {

            return;

        }


        text.innerText =
            pesan;


        notification.style.display =
            'flex';


        // Reset timer

        clearTimeout(
            notificationTimer
        );


        notificationTimer =
            setTimeout(
                function () {

                    notification.style.display =
                        'none';

                },
                2200
            );

    }



    // =====================================================
    // BUKA KERANJANG
    // =====================================================

    function bukaKeranjang(forceOpen = false) {

        updateKeranjang();


        const panel =
            document.getElementById(
                'cartPanel'
            );


        if (!panel) {

            return;

        }


        if (forceOpen) {

            panel.style.display =
                'block';

            return;

        }


        if (
            panel.style.display === 'none' ||
            panel.style.display === ''
        ) {

            panel.style.display =
                'block';

        } else {

            panel.style.display =
                'none';

        }

    }



    // =====================================================
    // TUTUP KERANJANG
    // =====================================================

    function tutupKeranjang(event) {

        if (event) {

            event.stopPropagation();

        }


        const panel =
            document.getElementById(
                'cartPanel'
            );


        if (panel) {

            panel.style.display =
                'none';

        }

    }



    // =====================================================
    // SAAT HALAMAN DIBUKA
    // =====================================================

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            updateKeranjang();

        }
    );

</script>

@endsection