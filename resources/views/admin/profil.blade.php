@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('page-title', 'Profil Admin')

@section('page-description', 'Kelola informasi akun dan keamanan profil admin.')

@section('content')

@php
    $admin = $admin ?? auth()->user();
@endphp

<style>
    .profile-page {
        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
    }

    .alert {
        padding: 13px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .alert-success {
        background: #ecfdf3;
        color: #147a43;
        border: 1px solid #b7ebca;
    }

    .alert-error {
        background: #fff1f1;
        color: #b42318;
        border: 1px solid #f5c2c0;
    }

    .profile-card,
    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0,0,0,.06);
        overflow: hidden;
    }

    .profile-card {
        margin-bottom: 20px;
    }

    .profile-cover {
        height: 120px;
        background: linear-gradient(135deg, #650000, #8d0000);
    }

    .profile-main {
        display: flex;
        align-items: center;
        gap: 25px;
        padding: 0 30px 28px;
    }

    .profile-photo-wrapper {
        margin-top: -55px;
        position: relative;
        flex-shrink: 0;
    }

    .profile-photo,
    .profile-photo-default {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 5px solid #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,.15);
        box-sizing: border-box;
    }

    .profile-photo {
        object-fit: cover;
        background: #f5f5f5;
    }

    .profile-photo-default {
        background: #650000;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 42px;
    }

    .profile-info {
        padding-top: 20px;
    }

    .profile-info h2 {
        margin: 0 0 6px;
        font-size: 22px;
        color: #292929;
    }

    .profile-info p {
        margin: 4px 0;
        color: #777;
        font-size: 13px;
    }

    .profile-info p i {
        width: 18px;
        color: #650000;
    }

    .profile-badge {
        display: inline-block;
        margin-top: 8px;
        padding: 5px 10px;
        background: #fff5d9;
        color: #8a6400;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .card-header {
        padding: 18px 22px;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-header > i {
        color: #650000;
        font-size: 15px;
    }

    .card-header h3 {
        margin: 0;
        font-size: 15px;
        color: #252525;
    }

    .card-header p {
        margin: 3px 0 0;
        font-size: 11px;
        color: #888;
    }

    .card-body {
        padding: 22px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        margin-bottom: 7px;
        font-size: 13px;
        font-weight: 600;
        color: #444;
    }

    .form-control {
        width: 100%;
        height: 42px;
        box-sizing: border-box;
        padding: 0 13px;
        border: 1px solid #dcdcdc;
        border-radius: 9px;
        font-size: 13px;
        color: #333;
        background: #fff;
        outline: none;
        transition: .2s;
    }

    .form-control:focus {
        border-color: #8d0000;
        box-shadow: 0 0 0 3px rgba(101,0,0,.08);
    }

    .file-box {
        border: 1px dashed #cfcfcf;
        border-radius: 10px;
        padding: 15px;
        background: #fafafa;
    }

    .file-box input[type="file"] {
        width: 100%;
        font-size: 12px;
    }

    .file-help {
        margin-top: 7px;
        font-size: 11px;
        color: #888;
    }

    .btn-primary,
    .btn-dark {
        border: none;
        color: #fff;
        padding: 11px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
    }

    .btn-primary {
        background: #650000;
    }

    .btn-primary:hover {
        background: #850000;
        transform: translateY(-1px);
    }

    .btn-dark {
        background: #252525;
    }

    .btn-dark:hover {
        background: #000;
    }

    .password-note {
        font-size: 11px;
        color: #888;
        margin-top: -8px;
        margin-bottom: 18px;
    }

    .current-photo {
        margin-top: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 11px;
        color: #777;
    }

    .current-photo img {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
    }

    @media (max-width: 850px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }

        .profile-main {
            padding-left: 20px;
            padding-right: 20px;
        }
    }

    @media (max-width: 600px) {
        .profile-main {
            flex-direction: column;
            align-items: flex-start;
        }

        .profile-info {
            padding-top: 0;
        }
    }
</style>

<div class="profile-page">

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR --}}
    @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- VALIDATION --}}
    @if($errors->any())
        <div class="alert alert-error">
            <strong>Periksa kembali:</strong>

            <ul style="margin:7px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- PROFILE HEADER --}}
    <div class="profile-card">

        <div class="profile-cover"></div>

        <div class="profile-main">

            <div class="profile-photo-wrapper">

                @if($admin && $admin->foto)

                    <img
                        id="profilePreview"
                        class="profile-photo"
                        src="{{ asset('storage/' . $admin->foto) }}"
                        alt="Foto Profil"
                    >

                    <div
                        id="profileDefault"
                        class="profile-photo-default"
                        style="display:none;"
                    >
                        <i class="fa-solid fa-user"></i>
                    </div>

                @else

                    <div
                        id="profileDefault"
                        class="profile-photo-default"
                    >
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <img
                        id="profilePreview"
                        class="profile-photo"
                        style="display:none;"
                        alt="Preview Foto"
                    >

                @endif

            </div>


            <div class="profile-info">

                <h2>
                    {{ $admin->name ?? 'Administrator' }}
                </h2>

                <p>
                    <i class="fa-solid fa-envelope"></i>
                    {{ $admin->email ?? '-' }}
                </p>

                <p>
                    <i class="fa-solid fa-user-tie"></i>
                    {{ $admin->jabatan ?? 'Administrator' }}
                </p>

                <span class="profile-badge">
                    <i class="fa-solid fa-shield-halved"></i>
                    Admin Rumah Makan
                </span>

            </div>

        </div>

    </div>


    {{-- FORM --}}
    @if($admin)

    <div class="profile-grid">

        {{-- EDIT PROFIL --}}
        <div class="card">

            <div class="card-header">

                <i class="fa-solid fa-user-pen"></i>

                <div>
                    <h3>Edit Profil</h3>
                    <p>Perbarui informasi akun admin.</p>
                </div>

            </div>

            <div class="card-body">

                <form
                    action="{{ route('admin.profil.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf
                    @method('PUT')


                    <div class="form-group">

                        <label class="form-label">
                            Nama Admin
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $admin->name) }}"
                            placeholder="Masukkan nama admin"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $admin->email) }}"
                            placeholder="Masukkan email"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Jabatan
                        </label>

                        <input
                            type="text"
                            name="jabatan"
                            class="form-control"
                            value="{{ old('jabatan', $admin->jabatan ?? '') }}"
                            placeholder="Contoh: Administrator"
                        >

                    </div>


                    {{-- FOTO --}}
                    <div class="form-group">

                        <label class="form-label">
                            Foto Profil
                        </label>

                        <div class="file-box">

                            <input
                                type="file"
                                name="foto"
                                id="foto"
                                accept=".jpg,.jpeg,.png,.webp"
                                onchange="previewFoto(this)"
                            >

                            <div class="file-help">
                                JPG, JPEG, PNG, atau WEBP.
                                Maksimal 2 MB.
                            </div>

                            @if($admin->foto)

                                <div class="current-photo">

                                    <img
                                        src="{{ asset('storage/' . $admin->foto) }}"
                                        alt="Foto saat ini"
                                    >

                                    <span>
                                        Foto profil saat ini
                                    </span>

                                </div>

                            @endif

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="btn-primary"
                    >
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>

                </form>

            </div>

        </div>


        {{-- PASSWORD --}}
        <div class="card">

            <div class="card-header">

                <i class="fa-solid fa-lock"></i>

                <div>
                    <h3>Ubah Password</h3>
                    <p>Pastikan password baru aman.</p>
                </div>

            </div>

            <div class="card-body">

                <form
                    action="{{ route('admin.profil.password') }}"
                    method="POST"
                >

                    @csrf
                    @method('PUT')


                    <div class="form-group">

                        <label class="form-label">
                            Password Lama
                        </label>

                        <input
                            type="password"
                            name="password_lama"
                            class="form-control"
                            placeholder="Masukkan password lama"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Password Baru
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password baru"
                            required
                        >

                    </div>


                    <div class="password-note">
                        Password minimal 8 karakter.
                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Konfirmasi Password Baru
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Ulangi password baru"
                            required
                        >

                    </div>


                    <button
                        type="submit"
                        class="btn-dark"
                    >
                        <i class="fa-solid fa-key"></i>
                        Ubah Password
                    </button>

                </form>

            </div>

        </div>

    </div>

    @endif

</div>


<script>

function previewFoto(input) {

    const preview = document.getElementById('profilePreview');
    const defaultPhoto = document.getElementById('profileDefault');

    if (!input.files || !input.files[0]) {
        return;
    }

    const file = input.files[0];

    // Batas 2 MB
    if (file.size > 2 * 1024 * 1024) {

        alert('Ukuran foto maksimal 2 MB.');

        input.value = '';

        return;
    }

    const reader = new FileReader();

    reader.onload = function(e) {

        preview.src = e.target.result;

        preview.style.display = 'block';

        if (defaultPhoto) {
            defaultPhoto.style.display = 'none';
        }

    };

    reader.readAsDataURL(file);
}

</script>

@endsection