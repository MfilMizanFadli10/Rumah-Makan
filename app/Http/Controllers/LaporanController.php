<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPesanan = Pesanan::count();

        $totalPendapatan = Pesanan::sum('total_harga');

        $pesananHariIni = Pesanan::whereDate(
            'tanggal_pesanan',
            today()
        )->count();

        $pesanans = Pesanan::with('meja')
            ->latest('tanggal_pesanan')
            ->get();

        return view('admin.laporan.index', compact(
            'totalPesanan',
            'totalPendapatan',
            'pesananHariIni',
            'pesanans'
        ));
    }
}