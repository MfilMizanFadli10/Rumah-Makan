<?php

namespace App\Http\Controllers;

use App\Models\Mahidang;
use App\Models\Meja;
use Illuminate\Http\Request;

class MahidangController extends Controller
{
    /**
     * Menampilkan form Mahidang untuk pelanggan
     */
    public function create()
    {
        $mejas = Meja::where('status', 'tersedia')->get();

        return view('customer.mahidang', compact('mejas'));
    }

    /**
     * Menyimpan pengambilan Mahidang
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'meja_id' => 'required|exists:meja,id',
            'catatan' => 'nullable|string',
        ]);

        // Kode Mahidang otomatis: MHD-001, MHD-002, dst.
        $kode = 'MHD-' . str_pad(
            Mahidang::max('id') + 1,
            3,
            '0',
            STR_PAD_LEFT
        );
            $mahidang = Mahidang::create([
                'kode_mahidang' => $kode,
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_hp' => $request->no_hp,
                'meja_id' => $request->meja_id,
                'catatan' => $request->catatan,
                'status' => 'menunggu',
            ]);

            // Simpan ID Mahidang ke session
            $mahidangIds = session('mahidang_ids', []);

            $mahidangIds[] = $mahidang->id;

            session([
                'mahidang_ids' => $mahidangIds
            ]);

            
        return redirect()
            ->route('customer.mahidang')
            ->with(
                'success',
                'Pengambilan Mahidang berhasil dicatat. Silakan datang ke rumah makan sesuai meja yang dipilih.'
            );
    }

    /**
     * Menampilkan data Mahidang untuk admin
     */
    public function adminIndex()
    {
        $mahidangs = Mahidang::with('meja')
            ->latest()
            ->get();

        return view('admin.mahidang.index', compact('mahidangs'));
    }

    /**
     * Menampilkan form edit Mahidang
     */
    public function edit($id)
    {
        $mahidang = Mahidang::findOrFail($id);

        // Semua meja ditampilkan agar meja yang sedang dipakai
        // tetap bisa dipilih ketika melakukan edit.
        $mejas = Meja::all();

        return view(
            'admin.mahidang.edit',
            compact('mahidang', 'mejas')
        );
    }

    /**
     * Memperbarui data Mahidang
     */
    public function update(Request $request, $id)
    {
        $mahidang = Mahidang::findOrFail($id);

        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'meja_id' => 'required|exists:meja,id',
            'catatan' => 'nullable|string',
            'status' => 'required|in:menunggu,sudah_duduk,sedang_makan,selesai_makan,dihitung,menunggu_pembayaran,lunas',
        ]);

        $mahidang->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'meja_id' => $request->meja_id,
            'catatan' => $request->catatan,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.mahidang')
            ->with(
                'success',
                'Data Mahidang berhasil diperbarui.'
            );
    }

    /**
     * Menghapus data Mahidang
     */
    public function destroy($id)
    {
        $mahidang = Mahidang::findOrFail($id);

        $mahidang->delete();

        return redirect()
            ->route('admin.mahidang')
            ->with(
                'success',
                'Data Mahidang berhasil dihapus.'
            );
    }
}