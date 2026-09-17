<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    // =========================
    // TESTIMONI ADMIN
    // =========================

    public function index()
    {
        $testimonis = Testimoni::with(['pesanan', 'menu'])
            ->latest()
            ->get();

        return view(
            'admin.testimoni.index',
            compact('testimonis')
        );
    }


    // =========================
    // HALAMAN TESTIMONI PELANGGAN
    // =========================

    public function create()
    {
        $pesanans = Pesanan::with('detailPesanan.menu')
            ->latest()
            ->get();

        return view(
            'customer.testimoni',
            compact('pesanans')
        );
    }


    // =========================
    // SIMPAN TESTIMONI PELANGGAN
    // =========================

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'kode_pesanan' => 'required|string',
            'menu_id' => 'required|exists:menu,id',
            'rating' => 'required|integer|min:1|max:5',
            'isi_testimoni' => 'required|string|max:1000',
        ]);

        $pesanan = Pesanan::where(
            'kode_pesanan',
            $request->kode_pesanan
        )->first();

        if (!$pesanan) {
            return back()
                ->withErrors([
                    'kode_pesanan' => 'Kode pesanan tidak ditemukan.'
                ])
                ->withInput();
        }

        Testimoni::create([
            'pesanan_id' => $pesanan->id,
            'menu_id' => $request->menu_id,
            'rating' => $request->rating,
            'isi_testimoni' => $request->isi_testimoni,
        ]);

        return redirect()
            ->route('customer.testimoni')
            ->with(
                'success',
                'Terima kasih! Testimoni berhasil dikirim.'
            );
    }
}