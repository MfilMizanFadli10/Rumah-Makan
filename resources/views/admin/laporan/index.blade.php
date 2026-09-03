@extends('layouts.admin')

@section('title', 'Laporan')

@section('page-title', 'Laporan')

@section('page-description', 'Lihat laporan pesanan dan pendapatan rumah makan.')

@section('content')

<div>

    <!-- =========================
         STATISTIK
    ========================== -->

    <div style="
        display:grid;
        grid-template-columns:repeat(3, 1fr);
        gap:18px;
        margin-bottom:20px;
    ">

        <!-- TOTAL PESANAN -->

        <div class="card">

            <div style="
                font-size:13px;
                color:#888;
                margin-bottom:8px;
            ">
                Total Pesanan
            </div>

            <div style="
                font-size:28px;
                font-weight:700;
                color:#8b0000;
            ">
                {{ $totalPesanan }}
            </div>

        </div>


        <!-- PENDAPATAN -->

        <div class="card">

            <div style="
                font-size:13px;
                color:#888;
                margin-bottom:8px;
            ">
                Total Pendapatan
            </div>

            <div style="
                font-size:24px;
                font-weight:700;
                color:#198754;
            ">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </div>

        </div>


        <!-- HARI INI -->

        <div class="card">

            <div style="
                font-size:13px;
                color:#888;
                margin-bottom:8px;
            ">
                Pesanan Hari Ini
            </div>

            <div style="
                font-size:28px;
                font-weight:700;
                color:#d9a441;
            ">
                {{ $pesananHariIni }}
            </div>

        </div>

    </div>


    <!-- =========================
         DAFTAR LAPORAN
    ========================== -->

    <div class="card">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        ">

            <div>

                <h2 style="margin-bottom:5px;">
                     Laporan Pesanan
                </h2>

                <p style="
                    color:#888;
                    font-size:13px;
                ">
                    Daftar pesanan yang tercatat dalam sistem.
                </p>

            </div>

        </div>


        <div style="overflow-x:auto;">

            <table style="
                width:100%;
                border-collapse:collapse;
                min-width:750px;
            ">

                <thead>

                    <tr style="
                        background:#fafafa;
                        text-align:left;
                    ">

                        <th style="padding:13px;">
                            No
                        </th>

                        <th style="padding:13px;">
                            Kode Pesanan
                        </th>

                        <th style="padding:13px;">
                            Pelanggan
                        </th>

                        <th style="padding:13px;">
                            Meja
                        </th>

                        <th style="padding:13px;">
                            Tanggal
                        </th>

                        <th style="padding:13px;">
                            Total
                        </th>

                        <th style="padding:13px;">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($pesanans as $index => $pesanan)

                        <tr style="
                            border-bottom:1px solid #eee;
                        ">

                            <td style="padding:13px;">
                                {{ $index + 1 }}
                            </td>

                            <td style="
                                padding:13px;
                                font-weight:600;
                            ">
                                {{ $pesanan->kode_pesanan }}
                            </td>

                            <td style="padding:13px;">
                                {{ $pesanan->nama_pelanggan }}
                            </td>

                            <td style="padding:13px;">
                                {{ $pesanan->meja->nomor_meja ?? '-' }}
                            </td>

                            <td style="padding:13px;">
                                {{ $pesanan->tanggal_pesanan ?? '-' }}
                            </td>

                            <td style="
                                padding:13px;
                                font-weight:700;
                                color:#8b0000;
                            ">
                                Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                            </td>

                            <td style="padding:13px;">

                                <span style="
                                    background:#f1f1f1;
                                    padding:6px 10px;
                                    border-radius:20px;
                                    font-size:11px;
                                ">
                                    {{ $pesanan->status ?? '-' }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" style="
                                text-align:center;
                                padding:50px;
                                color:#999;
                            ">

                                

                                <div style="
                                    margin-top:10px;
                                    font-weight:600;
                                ">
                                    Belum ada laporan
                                </div>

                                <div style="
                                    margin-top:5px;
                                    font-size:13px;
                                ">
                                    Data pesanan akan muncul di sini.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<style>

@media (max-width: 800px) {

    .card > div:first-child {
        grid-template-columns: 1fr !important;
    }

}

</style>

@endsection