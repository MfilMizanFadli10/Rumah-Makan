<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    // =========================
    // TAMPILKAN DATA FASILITAS
    // =========================
    public function index()
    {
        $fasilitas = Fasilitas::latest()->get();

        return view('admin.fasilitas.index', compact('fasilitas'));
    }


    // =========================
    // FORM TAMBAH FASILITAS
    // =========================
    public function create()
    {
        return view('admin.fasilitas.create');
    }


    // =========================
    // SIMPAN FASILITAS
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = [
            'nama_fasilitas' => $request->nama_fasilitas,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request
                ->file('foto')
                ->store('fasilitas', 'public');
        }

        Fasilitas::create($data);

        return redirect()
            ->route('admin.fasilitas')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }


    // =========================
    // FORM EDIT FASILITAS
    // =========================
    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        return view('admin.fasilitas.edit', compact('fasilitas'));
    }


    // =========================
    // UPDATE FASILITAS
    // =========================
    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = [
            'nama_fasilitas' => $request->nama_fasilitas,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request
                ->file('foto')
                ->store('fasilitas', 'public');
        }

        $fasilitas->update($data);

        return redirect()
            ->route('admin.fasilitas')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }


    // =========================
    // HAPUS FASILITAS
    // =========================
    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $fasilitas->delete();

        return redirect()
            ->route('admin.fasilitas')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}