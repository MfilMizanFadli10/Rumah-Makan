<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    public function index()
    {
        $mejas = Meja::where('status', 'tersedia')
            ->orderBy('nomor_meja')
            ->get();

        return view('customer.reservasi', compact('mejas'));
    }

    public function adminIndex()
{
    $reservasis = Reservasi::with('meja')
        ->latest()
        ->get();

    return view('admin.reservasi.index', compact('reservasis'));
}

   public function store(Request $request)
{
    $request->validate([
        'nama_pelanggan' => 'required',
        'no_hp' => 'required',
        'meja_id' => 'required|exists:meja,id',
        'tanggal_pesanan' => 'required|date',
        'jam_pesanan' => 'required',
        'jumlah_orang' => 'required|integer',
        'catatan' => 'nullable',
    ]);

    // Cari meja yang dipilih
    $meja = Meja::findOrFail($request->meja_id);

    // Pastikan meja masih tersedia
    if ($meja->status !== 'tersedia') {
        return back()
            ->withErrors([
                'meja_id' => 'Maaf, meja tersebut sudah digunakan.'
            ])
            ->withInput();
    }

    // Simpan reservasi
    Reservasi::create([
        'nama_pelanggan' => $request->nama_pelanggan,
        'no_hp' => $request->no_hp,
        'meja_id' => $request->meja_id,
        'tanggal_pesanan' => $request->tanggal_pesanan,
        'jam_pesanan' => $request->jam_pesanan,
        'jumlah_orang' => $request->jumlah_orang,
        'catatan' => $request->catatan,
    ]);

    // Otomatis ubah meja menjadi terpakai
    $meja->update([
        'status' => 'terpakai'
    ]);

   // Simpan ID reservasi ke session untuk riwayat
$reservasi = Reservasi::latest('id')->first();

$reservasiIds = session('reservasi_ids', []);

$reservasiIds[] = $reservasi->id;

session([
    'reservasi_ids' => array_unique($reservasiIds)
]);

// Simpan ID reservasi ke session untuk riwayat
$reservasi = Reservasi::latest('id')->first();

$reservasiIds = session('reservasi_ids', []);

$reservasiIds[] = $reservasi->id;

session([
    'reservasi_ids' => array_unique($reservasiIds)
]);

return redirect()
    ->route('customer.reservasi')
    ->with('success', 'Reservasi berhasil dibuat! Meja sudah ditandai sebagai terpakai.');

    }

}