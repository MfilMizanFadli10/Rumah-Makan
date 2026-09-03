@extends('layouts.admin')

@section('title', 'Testimoni')

@section('page-title', 'Testimoni')

@section('page-description', 'Lihat tanggapan dan pengalaman pelanggan.')

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    ">

        <div>

            <h2 style="
                margin:0;
                font-size:20px;
            ">
                ⭐ Testimoni Pelanggan
            </h2>

            <p style="
                margin-top:6px;
                color:#888;
                font-size:13px;
            ">
                Daftar tanggapan dan pengalaman pelanggan.
            </p>

        </div>


        <div style="
            background:#fff8e6;
            color:#8b0000;
            padding:8px 14px;
            border-radius:20px;
            font-size:13px;
            font-weight:600;
        ">

            {{ $testimonis->count() }} Testimoni

        </div>

    </div>


    {{-- DAFTAR TESTIMONI --}}
    @forelse($testimonis as $testimoni)

        <div style="
            border:1px solid #eee;
            border-radius:12px;
            padding:20px;
            margin-bottom:15px;
            background:#fff;
        ">

            {{-- BAGIAN ATAS --}}
            <div style="
                display:flex;
                justify-content:space-between;
                align-items:flex-start;
                gap:15px;
                margin-bottom:12px;
            ">

                <div>

                    <div style="
                        font-weight:700;
                        font-size:15px;
                        color:#333;
                    ">
                        👤 {{ $testimoni->pesanan->nama_pelanggan ?? 'Pelanggan' }}
                    </div>

                    <div style="
                        margin-top:5px;
                        font-size:12px;
                        color:#999;
                    ">
                        Pesanan:
                        {{ $testimoni->pesanan->kode_pesanan ?? '-' }}
                    </div>

                </div>


                {{-- RATING --}}
                <div style="
                    color:#d9a441;
                    font-size:17px;
                    white-space:nowrap;
                ">

                    @for($i = 1; $i <= 5; $i++)

                        @if($i <= $testimoni->rating)

                            ⭐

                        @else

                            ☆

                        @endif

                    @endfor

                </div>

            </div>


            {{-- ISI TESTIMONI --}}
            <div style="
                background:#fafafa;
                border-radius:10px;
                padding:15px;
                color:#555;
                font-size:14px;
                line-height:1.7;
            ">

                "{{ $testimoni->isi_testimoni }}"

            </div>


            {{-- TANGGAL --}}
            <div style="
                margin-top:12px;
                font-size:11px;
                color:#aaa;
            ">

                📅
                {{ $testimoni->created_at
                    ? $testimoni->created_at->format('d/m/Y H:i')
                    : '-' }}

            </div>

        </div>

    @empty

        {{-- BELUM ADA DATA --}}
        <div style="
            text-align:center;
            padding:60px 20px;
            color:#999;
        ">

            <div style="
                font-size:45px;
                margin-bottom:15px;
            ">
                ⭐
            </div>

            <h3 style="
                margin-bottom:8px;
                color:#777;
            ">
                Belum ada testimoni
            </h3>

            <p style="font-size:13px;">
                Testimoni pelanggan akan muncul di sini.
            </p>

        </div>

    @endforelse

</div>


{{-- RESPONSIVE --}}
<style>

@media (max-width: 600px) {

    .card > div:first-child {
        flex-direction:column;
        align-items:flex-start !important;
    }

}

</style>

@endsection