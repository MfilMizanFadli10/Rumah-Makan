<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Reservasi;
use App\Models\Mahidang;

class RiwayatController extends Controller
{
    public function index()
    {
        $pesanans = collect();
        $reservasis = collect();
        $mahidangs = collect();

        // ==========================================
        // RIWAYAT PESANAN DARI SESSION
        // ==========================================

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

        // ==========================================
        // RIWAYAT RESERVASI DARI SESSION
        // ==========================================

        $reservasiIds = session('reservasi_ids', []);

        if (!empty($reservasiIds)) {
            $reservasis = Reservasi::with('meja')
                ->whereIn('id', $reservasiIds)
                ->latest()
                ->get();
        }

        // ==========================================
        // RIWAYAT MAHIDANG DARI SESSION
        // ==========================================

        $mahidangIds = session('mahidang_ids', []);

        if (!empty($mahidangIds)) {
            $mahidangs = Mahidang::with('meja')
                ->whereIn('id', $mahidangIds)
                ->latest()
                ->get();
        }

        // ==========================================
        // KIRIM DATA KE HALAMAN RIWAYAT
        // ==========================================

        return view('customer.riwayat', compact(
            'pesanans',
            'reservasis',
            'mahidangs'
        ));
    }
}