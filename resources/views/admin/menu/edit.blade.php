@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('page-title', 'Edit Menu')

@section('page-description', 'Perbarui informasi makanan atau minuman.')

@section('content')

<div class="card">

    <form action="{{ route('admin.menu.update', $menu->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div style="margin-bottom:18px;">

            <label>Nama Menu</label>

            <input
                type="text"
                name="nama_menu"
                value="{{ old('nama_menu', $menu->nama_menu) }}"
                required
                style="width:100%; padding:12px; margin-top:7px; border:1px solid #ddd; border-radius:8px;"
            >

            @error('nama_menu')
                <small style="color:red;">{{ $message }}</small>
            @enderror

        </div>


        <div style="margin-bottom:18px;">

            <label>Kategori</label>

            <select
                name="kategori_id"
                required
                style="width:100%; padding:12px; margin-top:7px; border:1px solid #ddd; border-radius:8px;"
            >

                <option value="">-- Pilih Kategori --</option>

                @foreach($kategoris as $kategori)

                    <option
                        value="{{ $kategori->id }}"
                        {{ old('kategori_id', $menu->kategori_id) == $kategori->id ? 'selected' : '' }}
                    >
                        {{ $kategori->nama_kategori }}
                    </option>

                @endforeach

            </select>

        </div>


        <div style="margin-bottom:18px;">

            <label>Deskripsi</label>

            <textarea
                name="deskripsi"
                rows="4"
                style="width:100%; padding:12px; margin-top:7px; border:1px solid #ddd; border-radius:8px;"
            >{{ old('deskripsi', $menu->deskripsi) }}</textarea>

        </div>


        <div style="margin-bottom:18px;">

            <label>Harga</label>

            <input
                type="number"
                name="harga"
                value="{{ old('harga', $menu->harga) }}"
                required
                style="width:100%; padding:12px; margin-top:7px; border:1px solid #ddd; border-radius:8px;"
            >

        </div>


        <div style="margin-bottom:18px;">

            <label>Foto Menu</label>

            @if($menu->foto)

                <div style="margin:10px 0;">

                    <img
                        src="{{ asset('storage/' . $menu->foto) }}"
                        style="width:100px; height:100px; object-fit:cover; border-radius:10px;"
                    >

                </div>

            @endif

            <input
                type="file"
                name="foto"
                accept="image/*"
                style="display:block; margin-top:8px;"
            >

        </div>


        <div style="margin-bottom:25px;">

            <label>Status</label>

            <select
                name="status"
                required
                style="width:100%; padding:12px; margin-top:7px; border:1px solid #ddd; border-radius:8px;"
            >

                <option
                    value="tersedia"
                    {{ old('status', $menu->status) == 'tersedia' ? 'selected' : '' }}
                >
                    Tersedia
                </option>

                <option
                    value="habis"
                    {{ old('status', $menu->status) == 'habis' ? 'selected' : '' }}
                >
                    Habis
                </option>

            </select>

        </div>


        <button
            type="submit"
            style="
                background:#8b0000;
                color:white;
                border:none;
                padding:12px 22px;
                border-radius:8px;
                font-weight:bold;
                cursor:pointer;
            "
        >
            💾 Simpan Perubahan
        </button>


        <a
            href="{{ route('admin.menu') }}"
            style="
                margin-left:10px;
                padding:12px 22px;
                border-radius:8px;
                background:#eee;
                color:#333;
                text-decoration:none;
            "
        >
            Kembali
        </a>

    </form>

</div>

@endsection