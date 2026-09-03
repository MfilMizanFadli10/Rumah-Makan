@extends('layouts.admin')

@section('title', 'Data Fasilitas')

@section('page-title', 'Data Fasilitas')

@section('page-description', 'Kelola fasilitas yang tersedia di rumah makan.')

@section('content')

<div class="card">

    {{-- =================================================
         HEADER
    ================================================= --}}
    <div class="fasilitas-header">

        <div>
            <h2>
                Fasilitas Rumah Makan
            </h2>

            <p>
                Daftar fasilitas yang tersedia untuk pelanggan.
            </p>
        </div>


        {{-- TOMBOL --}}
        <div class="fasilitas-actions">

            {{-- KEMBALI KE PENGATURAN --}}
            <a
                href="{{ route('admin.pengaturan') }}"
                class="btn-kembali"
            >
                ← Kembali
            </a>


            {{-- TAMBAH FASILITAS --}}
            <a
                href="{{ route('admin.fasilitas.create') }}"
                class="btn-tambah"
            >
                + Tambah Fasilitas
            </a>

        </div>

    </div>


    {{-- =================================================
         PESAN SUKSES
    ================================================= --}}
    @if(session('success'))

        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif


    {{-- =================================================
         DAFTAR FASILITAS
    ================================================= --}}
    @if($fasilitas->count())

        <div class="fasilitas-grid">

            @foreach($fasilitas as $item)

                <div class="fasilitas-card">

                    {{-- FOTO --}}
                    @if($item->foto)

                        <img
                            src="{{ asset('storage/' . $item->foto) }}"
                            alt="{{ $item->nama_fasilitas }}"
                            class="fasilitas-image"
                        >

                    @else

                        <div class="no-photo">

                            <div class="no-photo-icon">
                                🏠
                            </div>

                            Belum ada foto

                        </div>

                    @endif


                    {{-- INFORMASI --}}
                    <div class="fasilitas-info">

                        <h3>
                            {{ $item->nama_fasilitas }}
                        </h3>

                        <p>
                            {{ $item->deskripsi ?: 'Tidak ada deskripsi.' }}
                        </p>


                        {{-- TOMBOL --}}
                        <div class="fasilitas-buttons">

                            {{-- EDIT --}}
                            <a
                                href="{{ route('admin.fasilitas.edit', $item->id) }}"
                                class="btn-edit"
                            >
                                Edit
                            </a>


                            {{-- HAPUS --}}
                            <form
                                action="{{ route('admin.fasilitas.destroy', $item->id) }}"
                                method="POST"
                                class="form-hapus"
                                onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-hapus"
                                >
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- =================================================
             BELUM ADA DATA
        ================================================= --}}
        <div class="empty-state">

            <div class="empty-icon">
                🏠
            </div>

            <h3>
                Belum Ada Fasilitas
            </h3>

            <p>
                Silakan tambahkan fasilitas rumah makan.
            </p>

            <a
                href="{{ route('admin.fasilitas.create') }}"
                class="btn-tambah"
            >
                + Tambah Fasilitas
            </a>

        </div>

    @endif

</div>


{{-- =================================================
     STYLE
================================================= --}}
<style>

    .fasilitas-header {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
        gap:15px;
        flex-wrap:wrap;
    }

    .fasilitas-header h2 {
        margin:0;
        color:#650000;
    }

    .fasilitas-header p {
        margin:6px 0 0;
        color:#888;
        font-size:13px;
    }


    /* TOMBOL HEADER */

    .fasilitas-actions {
        display:flex;
        gap:10px;
        align-items:center;
        flex-wrap:wrap;
    }

    .btn-kembali {
        display:inline-block;
        background:#eeeeee;
        color:#555;
        text-decoration:none;
        padding:11px 16px;
        border-radius:8px;
        font-size:13px;
        font-weight:600;
        white-space:nowrap;
    }

    .btn-kembali:hover {
        background:#e2e2e2;
    }

    .btn-tambah {
        display:inline-block;
        background:#8b0000;
        color:white;
        text-decoration:none;
        padding:11px 16px;
        border-radius:8px;
        font-size:13px;
        font-weight:600;
        white-space:nowrap;
    }

    .btn-tambah:hover {
        background:#650000;
    }


    /* PESAN SUKSES */

    .success-message {
        background:#e8f5e9;
        color:#2e7d32;
        padding:12px 15px;
        border-radius:8px;
        margin-bottom:20px;
        font-size:13px;
    }


    /* GRID */

    .fasilitas-grid {
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
        gap:20px;
    }


    /* CARD */

    .fasilitas-card {
        border:1px solid #eee;
        border-radius:10px;
        overflow:hidden;
        background:white;
    }


    /* FOTO */

    .fasilitas-image {
        width:100%;
        height:170px;
        object-fit:cover;
        display:block;
    }

    .no-photo {
        width:100%;
        height:170px;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        background:#f5f5f5;
        color:#999;
        font-size:13px;
    }

    .no-photo-icon {
        font-size:35px;
        margin-bottom:5px;
    }


    /* INFORMASI */

    .fasilitas-info {
        padding:18px;
    }

    .fasilitas-info h3 {
        margin:0 0 8px;
        color:#333;
        font-size:17px;
    }

    .fasilitas-info p {
        margin:0 0 18px;
        color:#777;
        font-size:13px;
        line-height:1.6;
        min-height:42px;
    }


    /* BUTTON EDIT HAPUS */

    .fasilitas-buttons {
        display:flex;
        gap:8px;
    }

    .btn-edit {
        flex:1;
        text-align:center;
        background:#f1f1f1;
        color:#555;
        text-decoration:none;
        padding:9px;
        border-radius:7px;
        font-size:12px;
        font-weight:600;
    }

    .btn-edit:hover {
        background:#e5e5e5;
    }

    .form-hapus {
        flex:1;
    }

    .btn-hapus {
        width:100%;
        border:none;
        background:#fce8e8;
        color:#a52a2a;
        padding:9px;
        border-radius:7px;
        font-size:12px;
        font-weight:600;
        cursor:pointer;
    }

    .btn-hapus:hover {
        background:#f8d8d8;
    }


    /* EMPTY */

    .empty-state {
        padding:50px 20px;
        text-align:center;
        background:#fafafa;
        border:1px dashed #ddd;
        border-radius:10px;
    }

    .empty-icon {
        font-size:45px;
        margin-bottom:10px;
    }

    .empty-state h3 {
        margin:0 0 7px;
        color:#555;
    }

    .empty-state p {
        margin:0 0 20px;
        color:#999;
        font-size:13px;
    }


    /* RESPONSIVE */

    @media (max-width:600px) {

        .fasilitas-actions {
            width:100%;
        }

        .fasilitas-actions a {
            flex:1;
            text-align:center;
        }

        .fasilitas-grid {
            grid-template-columns:1fr;
        }

    }

</style>

@endsection