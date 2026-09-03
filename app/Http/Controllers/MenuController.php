<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // =========================
    // TAMPILKAN DATA MENU
    // =========================
    public function index()
    {
        $menus = Menu::with('kategori')->get();

        return view('admin.menu.index', compact('menus'));
    }


    // =========================
    // FORM TAMBAH MENU
    // =========================
    public function create()
    {
        $kategoris = Kategori::all();

        return view('admin.menu.create', compact('kategoris'));
    }


    // =========================
    // SIMPAN MENU BARU
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required',
        ]);

        $data = $request->only([
            'kategori_id',
            'nama_menu',
            'deskripsi',
            'harga',
            'status',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('menu', 'public');
        }

        Menu::create($data);

        return redirect()
            ->route('admin.menu')
            ->with('success', 'Menu berhasil ditambahkan.');
    }


    // =========================
    // FORM EDIT MENU
    // =========================
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $kategoris = Kategori::all();

        return view('admin.menu.edit', compact('menu', 'kategoris'));
    }


    // =========================
    // UPDATE MENU
    // =========================
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'kategori_id' => 'required',
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required',
        ]);

        $data = $request->only([
            'kategori_id',
            'nama_menu',
            'deskripsi',
            'harga',
            'status',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('menu', 'public');
        }

        $menu->update($data);

        return redirect()
            ->route('admin.menu')
            ->with('success', 'Menu berhasil diperbarui.');
    }


    // =========================
// HAPUS MENU
// =========================
public function destroy($id)
{
    $menu = Menu::findOrFail($id);

    if ($menu->detailPesanan()->exists()) {

        return redirect()
            ->route('admin.menu')
            ->with(
                'error',
                'Menu tidak bisa dihapus karena sudah digunakan dalam pesanan.'
            );
    }

    $menu->delete();

    return redirect()
        ->route('admin.menu')
        ->with(
            'success',
            'Menu berhasil dihapus.'
        );
}
}