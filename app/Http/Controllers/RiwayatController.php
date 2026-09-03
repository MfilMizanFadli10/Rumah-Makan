<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Reservasi;

class RiwayatController extends Controller
{
    public function index()
    {
        $pesanans = collect();
        $reservasis = collect();

        // Riwayat pesanan dari session
        $kodePesanan = session('kode_pesanan');

        if ($kodePesanan) {
            $pesanans = Pesanan::with([
                'meja',
                'detailPesanan.menu'
            ])
            ->where('kode_pesanan', $kodePesanan)
            ->latest()
            ->get();
        }

        // Riwayat reservasi dari session
        $reservasiIds = session('reservasi_ids', []);

        if (!empty($reservasiIds)) {
            $reservasis = Reservasi::with('meja')
                ->whereIn('id', $reservasiIds)
                ->latest()
                ->get();
        }

        return view('customer.riwayat', compact(
            'pesanans',
            'reservasis'
        ));
    }
}