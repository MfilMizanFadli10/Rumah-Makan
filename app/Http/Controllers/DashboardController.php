<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Meja;
use App\Models\Pesanan;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // DATA MENU
        // =========================

        $totalMenu = Menu::count();

        $menuTersedia = Menu::where('status', 'tersedia')->count();


        // =========================
        // DATA MEJA
        // =========================

        $totalMeja = Meja::count();

        $mejaTersedia = Meja::where('status', 'tersedia')->count();

        $mejaTerisi = Meja::where('status', 'terisi')->count();


        // =========================
        // DATA PESANAN
        // =========================

        $totalPesanan = Pesanan::count();

        $pesananMenunggu = Pesanan::where('status', 'menunggu')->count();

        $pesananDiproses = Pesanan::where('status', 'diproses')->count();

        $pesananSelesai = Pesanan::where('status', 'selesai')->count();

        $pesananDibatalkan = Pesanan::where('status', 'dibatalkan')->count();


        // =========================
        // PESANAN TERBARU
        // =========================

        $pesananTerbaru = Pesanan::with('meja')
            ->latest()
            ->take(5)
            ->get();


        // =========================
        // KIRIM KE DASHBOARD
        // =========================

        return view('admin.dashboard', compact(
            'totalMenu',
            'menuTersedia',

            'totalMeja',
            'mejaTersedia',
            'mejaTerisi',

            'totalPesanan',
            'pesananMenunggu',
            'pesananDiproses',
            'pesananSelesai',
            'pesananDibatalkan',

            'pesananTerbaru'
        ));
    }
}