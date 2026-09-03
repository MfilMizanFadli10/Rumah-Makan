<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Login Admin -
        {{ $pengaturan->nama_rumah_makan ?? 'Rumah Makan' }}
    </title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {

            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 25px;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    #fff4df,
                    transparent 30%
                ),
                #f3efea;

        }


        /* =========================================
           LOGIN WRAPPER
        ========================================= */

        .login-wrapper {

            width: 1100px;
            max-width: 100%;

            min-height: 650px;

            display: grid;

            grid-template-columns: 52% 48%;

            background: white;

            border-radius: 28px;

            overflow: hidden;

            box-shadow:
                0 25px 70px rgba(70, 0, 0, 0.20);

            position: relative;

        }


        /* =========================================
           LEFT PANEL
        ========================================= */

        .left-panel {

            position: relative;

            padding: 48px;

            color: white;

            overflow: hidden;

            background:
                linear-gradient(
                    145deg,
                    #700000 0%,
                    #990d12 50%,
                    #650000 100%
                );

        }


        /* Ornamen lingkaran */

        .left-panel::before {

            content: "";

            position: absolute;

            width: 380px;
            height: 380px;

            border: 2px solid
                rgba(217,164,65,0.20);

            border-radius: 50%;

            top: -190px;
            right: -130px;

        }


        .left-panel::after {

            content: "";

            position: absolute;

            width: 300px;
            height: 300px;

            border: 2px solid
                rgba(217,164,65,0.15);

            border-radius: 50%;

            bottom: -180px;
            left: -150px;

        }


        .left-content {

            position: relative;

            z-index: 2;

            height: 100%;

            display: flex;

            flex-direction: column;

        }


        /* =========================================
           BANNER
        ========================================= */

        .banner-wrapper {

            width: 100%;

            height: 220px;

            border-radius: 18px;

            padding: 5px;

            background:
                linear-gradient(
                    135deg,
                    #d9a441,
                    #f0c766,
                    #b88627
                );

            box-shadow:
                0 12px 30px rgba(0,0,0,0.25);

            margin-bottom: 30px;

        }


        .banner-wrapper img {

            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            border-radius: 14px;

        }


        .banner-empty {

            width: 100%;
            height: 100%;

            border-radius: 14px;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                rgba(255,255,255,0.08);

            font-size: 50px;

        }


        /* =========================================
           BRAND
        ========================================= */

        .brand-area {

            margin-bottom: 25px;

        }


        .brand-title {

            display: flex;

            align-items: center;

            gap: 15px;

        }


        .brand-icon {

            width: 48px;
            height: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: #d9a441;

            color: white;

            font-size: 25px;

            box-shadow:
                0 6px 15px rgba(0,0,0,0.18);

        }


        .brand-title h1 {

            font-size: 32px;

            font-weight: 800;

            letter-spacing: 0.3px;

        }


        .gold-line {

            width: 65px;
            height: 4px;

            border-radius: 20px;

            background: #d9a441;

            margin-top: 12px;

        }


        .tagline {

            margin-top: 18px;

            max-width: 470px;

            color:
                rgba(255,255,255,0.86);

            font-size: 14px;

            line-height: 1.7;

        }


        /* =========================================
           FEATURE
        ========================================= */

        .features {

            display: flex;

            gap: 10px;

            margin-top: auto;

            margin-bottom: 20px;

            flex-wrap: wrap;

        }


        .feature {

            display: flex;

            align-items: center;

            gap: 7px;

            padding: 8px 12px;

            border-radius: 20px;

            background:
                rgba(255,255,255,0.08);

            border:
                1px solid rgba(255,255,255,0.10);

            font-size: 11px;

            color:
                rgba(255,255,255,0.80);

        }


        .feature span {

            color: #d9a441;

            font-size: 13px;

        }


        /* =========================================
           MARAWA
        ========================================= */

        .marawa-area {

            display: flex;

            align-items: center;

            gap: 12px;

        }


        .marawa {

            display: flex;

            align-items: flex-end;

            gap: 3px;

            height: 43px;

        }


        .marawa span {

            display: block;

            width: 17px;

            height: 43px;

            border-radius: 3px;

            transform: skewX(-10deg);

        }


        .marawa .m1 {
            background: #b5161f;
        }


        .marawa .m2 {
            background: #d9a441;
        }


        .marawa .m3 {
            background: #171717;
        }


        .marawa-text {

            font-size: 10px;

            letter-spacing: 1px;

            color:
                rgba(255,255,255,0.65);

            line-height: 1.4;

        }


        /* =========================================
           RIGHT PANEL
        ========================================= */

        .right-panel {

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 55px;

            background: #fff;

        }


        .login-box {

            width: 100%;

            max-width: 400px;

        }


        /* =========================================
           WELCOME
        ========================================= */

        .welcome {

            display: flex;

            align-items: center;

            gap: 10px;

            color: #8b0000;

            font-size: 12px;

            font-weight: 800;

            letter-spacing: 1.8px;

            text-transform: uppercase;

            margin-bottom: 12px;

        }


        .welcome::before {

            content: "";

            width: 28px;

            height: 3px;

            border-radius: 10px;

            background: #d9a441;

        }


        .login-box h2 {

            font-size: 36px;

            color: #202020;

            margin-bottom: 8px;

            font-weight: 800;

        }


        .subtitle {

            color: #888;

            font-size: 13px;

            line-height: 1.6;

            margin-bottom: 32px;

        }


        /* =========================================
           ERROR
        ========================================= */

        .error-box {

            padding: 12px 14px;

            margin-bottom: 20px;

            border-radius: 10px;

            background: #fff1f1;

            border-left: 4px solid #8b0000;

            color: #9b0000;

            font-size: 13px;

        }


        /* =========================================
           FORM
        ========================================= */

        .form-group {

            margin-bottom: 21px;

        }


        .form-group label {

            display: block;

            margin-bottom: 8px;

            color: #292929;

            font-size: 13px;

            font-weight: 700;

        }


        .input-wrapper {

            position: relative;

        }


        .input-icon {

            position: absolute;

            left: 16px;

            top: 50%;

            transform: translateY(-50%);

            color: #8b0000;

            font-size: 16px;

            pointer-events: none;

        }


        .form-group input {

            width: 100%;

            height: 52px;

            padding:
                0 48px;

            border:
                1px solid #dedede;

            border-radius: 12px;

            outline: none;

            background: #fcfcfc;

            color: #333;

            font-size: 13px;

            transition: 0.25s;

        }


        .form-group input:hover {

            border-color: #d9a441;

        }


        .form-group input:focus {

            border-color: #8b0000;

            background: white;

            box-shadow:
                0 0 0 4px
                rgba(139,0,0,0.07);

        }


        .toggle-password {

            position: absolute;

            right: 15px;

            top: 50%;

            transform: translateY(-50%);

            border: none;

            background: transparent;

            cursor: pointer;

            color: #777;

            font-size: 16px;

        }


        .toggle-password:hover {

            color: #8b0000;

        }


        /* =========================================
           BUTTON
        ========================================= */

        .btn-login {

            width: 100%;

            height: 54px;

            border: none;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #8b0000,
                    #b00000
                );

            color: white;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 10px 25px
                rgba(139,0,0,0.25);

            transition: 0.25s;

        }


        .btn-login:hover {

            transform: translateY(-2px);

            box-shadow:
                0 14px 30px
                rgba(139,0,0,0.32);

        }


        /* =========================================
           FOOTER
        ========================================= */

        .login-footer {

            margin-top: 28px;

            padding-top: 20px;

            border-top: 1px solid #eee;

            text-align: center;

            color: #aaa;

            font-size: 11px;

        }


        .login-footer strong {

            color: #8b0000;

        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 850px) {

            body {

                padding: 15px;

            }


            .login-wrapper {

                grid-template-columns: 1fr;

            }


            .left-panel {

                min-height: auto;

                padding: 35px;

            }


            .banner-wrapper {

                height: 190px;

            }


            .features {

                margin-top: 25px;

            }


            .right-panel {

                padding: 40px 30px;

            }

        }


        @media (max-width: 500px) {

            .left-panel {

                padding: 25px;

            }


            .banner-wrapper {

                height: 150px;

            }


            .brand-title h1 {

                font-size: 25px;

            }


            .login-box h2 {

                font-size: 29px;

            }


            .right-panel {

                padding: 35px 22px;

            }

        }

    </style>

</head>


<body>


<div class="login-wrapper">


    {{-- =====================================================
         PANEL KIRI
    ====================================================== --}}

    <section class="left-panel">

        <div class="left-content">


            {{-- BANNER DARI PENGATURAN ADMIN --}}

            <div class="banner-wrapper">

                @if(!empty($pengaturan?->banner))

                    <img
                        src="{{ asset('storage/' . $pengaturan->banner) }}"
                        alt="Banner Rumah Makan"
                    >

                @else

                    <div class="banner-empty">
                        🍽️
                    </div>

                @endif

            </div>


            {{-- NAMA RUMAH MAKAN --}}

            <div class="brand-area">

                <div class="brand-title">

                    <div class="brand-icon">
                        🍽️
                    </div>

                    <h1>
                        {{ $pengaturan->nama_rumah_makan ?? 'Rumah Makan' }}
                    </h1>

                </div>


                <div class="gold-line"></div>


                <p class="tagline">

                    {{ $pengaturan->tagline
                        ?? 'Sistem Reservasi dan Pemesanan Rumah Makan.' }}

                </p>

            </div>


            {{-- FITUR --}}

            <div class="features">

                <div class="feature">
                    <span>🍽</span>
                    Pemesanan Menu
                </div>

                <div class="feature">
                    <span>▣</span>
                    Reservasi Meja
                </div>

                <div class="feature">
                    <span>★</span>
                    Pelayanan Terbaik
                </div>

            </div>


            {{-- MARAWA --}}

            <div class="marawa-area">

                <div class="marawa">

                    <span class="m1"></span>
                    <span class="m2"></span>
                    <span class="m3"></span>

                </div>

                <div class="marawa-text">

                    IDENTITAS BUDAYA<br>
                    MINANGKABAU

                </div>

            </div>


        </div>

    </section>



    {{-- =====================================================
         PANEL KANAN
    ====================================================== --}}

    <section class="right-panel">

        <div class="login-box">


            <div class="welcome">
                Selamat Datang
            </div>


            <h2>
                Login Admin
            </h2>


            <p class="subtitle">

                Silakan masuk untuk mengelola sistem
                rumah makan.

            </p>


            {{-- ERROR --}}

            @if ($errors->any())

                <div class="error-box">

                    ⚠️ {{ $errors->first() }}

                </div>

            @endif


            {{-- FORM --}}

            <form
                method="POST"
                action="{{ route('admin.login') }}"
            >

                @csrf


                {{-- EMAIL --}}

                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            ✉
                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email"
                            autocomplete="email"
                            required
                        >

                    </div>

                </div>


                {{-- PASSWORD --}}

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            🔒
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >


                        <button
                            type="button"
                            class="toggle-password"
                            id="togglePasswordBtn"
                            aria-label="Tampilkan password"
                        >
                            👁️
                        </button>

                    </div>

                </div>


                {{-- BUTTON --}}

                <button
                    type="submit"
                    class="btn-login"
                >

                    Masuk ke Dashboard
                    &nbsp; →

                </button>


            </form>


            {{-- FOOTER --}}

            <div class="login-footer">

                Sistem Reservasi & Pemesanan

                <strong>
                    {{ $pengaturan->nama_rumah_makan ?? 'Rumah Makan' }}
                </strong>

            </div>


        </div>

    </section>


</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePasswordBtn');

        if (!passwordInput || !toggleButton) {
            return;
        }

        toggleButton.addEventListener('click', function () {
            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';
            toggleButton.textContent = isHidden ? '🙈' : '👁️';
            toggleButton.setAttribute(
                'aria-label',
                isHidden ? 'Sembunyikan password' : 'Tampilkan password'
            );
        });
    });
</script>


</body>

</html>