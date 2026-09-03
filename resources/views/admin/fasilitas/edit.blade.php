@extends('layouts.admin')

@section('title', 'Edit Fasilitas')

@section('page-title', 'Edit Fasilitas')

@section('page-description', 'Perbarui informasi fasilitas rumah makan.')

@section('content')

<div class="card">

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div style="
            background:#ffe5e5;
            color:#8b0000;
            padding:12px 15px;
            border-radius:8px;
            margin-bottom:20px;
        ">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.fasilitas.update', $fasilitas->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        {{-- NAMA FASILITAS --}}
        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
            ">
                Nama Fasilitas
            </label>

            <input
                type="text"
                name="nama_fasilitas"
                value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}"
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


        {{-- DESKRIPSI --}}
        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
            ">
                Deskripsi
            </label>

            <textarea
                name="deskripsi"
                rows="5"
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    border-radius:8px;
                    box-sizing:border-box;
                    resize:vertical;
                "
            >{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>

        </div>


        {{-- FOTO LAMA --}}
        @if($fasilitas->foto)

            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    margin-bottom:8px;
                    font-weight:600;
                ">
                    Foto Saat Ini
                </label>

                <img
                    src="{{ asset('storage/' . $fasilitas->foto) }}"
                    alt="{{ $fasilitas->nama_fasilitas }}"
                    style="
                        width:220px;
                        height:150px;
                        object-fit:cover;
                        border-radius:10px;
                        border:1px solid #eee;
                    "
                >

            </div>

        @endif


        {{-- FOTO BARU --}}
        <div style="margin-bottom:25px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
            ">
                Ganti Foto
            </label>

            <input
                type="file"
                name="foto"
                accept=".jpg,.jpeg,.png,.webp"
            >

            <p style="
                margin-top:7px;
                font-size:12px;
                color:#888;
            ">
                Kosongkan jika tidak ingin mengganti foto.
            </p>

        </div>


        {{-- BUTTON --}}
        <div style="
            display:flex;
            gap:10px;
            flex-wrap:wrap;
        ">

            <button
                type="submit"
                style="
                    background:#8b0000;
                    color:white;
                    border:none;
                    padding:11px 20px;
                    border-radius:8px;
                    cursor:pointer;
                    font-weight:600;
                "
            >
                Simpan Perubahan
            </button>

            <a
                href="{{ route('admin.fasilitas') }}"
                style="
                    background:#eee;
                    color:#555;
                    text-decoration:none;
                    padding:11px 20px;
                    border-radius:8px;
                    font-weight:600;
                "
            >
                Batal
            </a>

        </div>

    </form>

</div>

@endsection