<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;

class AdminReservasiController extends Controller
{
    public function index()
    {
        $reservasis = Reservasi::with('meja')
            ->latest()
            ->get();

        return view('admin.reservasi.index', compact('reservasis'));
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::with('meja')->findOrFail($id);

        // Ambil meja yang digunakan reservasi
        $meja = $reservasi->meja;

        // Hapus reservasi
        $reservasi->delete();

        // Kembalikan status meja menjadi tersedia
        if ($meja) {
            $meja->update([
                'status' => 'tersedia'
            ]);
        }

        return redirect()
            ->route('admin.reservasi')
            ->with('success', 'Reservasi berhasil dihapus dan meja kembali tersedia.');
    }
}