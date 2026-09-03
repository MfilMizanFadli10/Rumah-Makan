<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    // ======================================================
    // TAMPILKAN PENGATURAN
    // ======================================================

   public function index()
{
    $pengaturan = Pengaturan::first();

    $fasilitas = Fasilitas::latest()->get();

    return view(
        'admin.pengaturan.index',
        compact('pengaturan', 'fasilitas')
    );
}


    // ======================================================
    // SIMPAN / UPDATE PENGATURAN
    // ======================================================

    public function update(Request $request)
    {
        $request->validate([

            // INFORMASI RUMAH MAKAN
            'nama_rumah_makan' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'jam_operasional' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:30',
            'tagline' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'maps' => 'nullable|string',

            // LOGO & BANNER
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

            // PEMBAYARAN
            'nama_bank' => 'nullable|string|max:100',
            'nomor_rekening' => 'nullable|string|max:50',
            'atas_nama' => 'nullable|string|max:100',
            'qris' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

        ]);


        // ==================================================
        // AMBIL DATA PENGATURAN
        // ==================================================

        $pengaturan = Pengaturan::first();

        if (!$pengaturan) {
            $pengaturan = new Pengaturan();
        }


        // ==================================================
        // DATA TEKS
        // ==================================================

        $data = $request->only([
            'nama_rumah_makan',
            'alamat',
            'jam_operasional',
            'no_hp',
            'tagline',
            'whatsapp',
            'email',
            'maps',

            // PEMBAYARAN
            'nama_bank',
            'nomor_rekening',
            'atas_nama',
        ]);


        // ==================================================
        // UPLOAD LOGO
        // ==================================================

        if ($request->hasFile('logo')) {

            $data['logo'] = $request
                ->file('logo')
                ->store('pengaturan', 'public');
        }


        // ==================================================
        // UPLOAD BANNER
        // ==================================================

        if ($request->hasFile('banner')) {

            $data['banner'] = $request
                ->file('banner')
                ->store('pengaturan', 'public');
        }


        // ==================================================
        // UPLOAD QRIS
        // ==================================================

        if ($request->hasFile('qris')) {

            $data['qris'] = $request
                ->file('qris')
                ->store('pengaturan', 'public');
        }


        // ==================================================
        // SIMPAN PENGATURAN
        // ==================================================

        $pengaturan->fill($data);
        $pengaturan->save();


        return redirect()
            ->route('admin.pengaturan')
            ->with(
                'success',
                'Pengaturan berhasil disimpan.'
            );
    }


    // ======================================================
    // UPDATE PROFIL ADMIN
    // ======================================================

    public function updateProfil(Request $request)
    {
        // Validasi data profil
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);


        // Ambil user yang sedang login
        $user = $request->user();


        // Jika tidak ada user yang login
        if (!$user) {
            abort(403, 'Anda harus login terlebih dahulu.');
        }


        // Update nama
        $user->name = $request->name;

        // Update email
        $user->email = $request->email;


        // Simpan perubahan
        $user->save();


        // Kembali ke halaman profil
        return redirect()
            ->route('admin.profil')
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }

    // ======================================================
// UPDATE PASSWORD ADMIN
// ======================================================

public function updatePassword(Request $request)
{
    $request->validate([
        'password_lama' => 'required',
        'password_baru' => 'required|string|min:8|confirmed',
    ]);

    $user = $request->user();

    if (!$user) {
        abort(403, 'Anda harus login terlebih dahulu.');
    }

    // Cek password lama
    if (!Hash::check($request->password_lama, $user->password)) {
        return back()
            ->withErrors([
                'password_lama' => 'Password lama tidak sesuai.'
            ])
            ->withInput();
    }

    // Simpan password baru
    $user->password = Hash::make($request->password_baru);
    $user->save();

    return redirect()
        ->route('admin.profil')
        ->with('success', 'Password berhasil diperbarui.');
}

}