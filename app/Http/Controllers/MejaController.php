<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MejaController extends Controller
{
    // =========================
    // TAMPILKAN DATA MEJA
    // =========================
    public function index()
    {
        $mejas = Meja::latest()->get();

        return view('admin.meja.index', compact('mejas'));
    }


    // =========================
    // FORM TAMBAH MEJA
    // =========================
    public function create()
    {
        return view('admin.meja.create');
    }


    // =========================
    // SIMPAN MEJA
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => [
                'required',
                'string',
                'max:50',
                'unique:meja,nomor_meja',
            ],

            'kapasitas' => [
                'required',
                'integer',
                'min:1',
            ],

            'lokasi' => [
                'required',
                'in:Indoor,Outdoor',
            ],

            'tipe' => [
                'required',
                'in:Reguler,VIP',
            ],

            'status' => [
                'required',
                'in:tersedia,terisi',
            ],
        ], [
            'nomor_meja.unique' =>
                'Nomor meja :input sudah digunakan. Silakan gunakan nomor meja lain.',

            'nomor_meja.required' =>
                'Nomor meja wajib diisi.',

            'kapasitas.required' =>
                'Kapasitas meja wajib diisi.',

            'kapasitas.integer' =>
                'Kapasitas harus berupa angka.',

            'kapasitas.min' =>
                'Kapasitas minimal 1 orang.',

            'lokasi.required' =>
                'Lokasi meja wajib dipilih.',

            'lokasi.in' =>
                'Lokasi meja tidak valid.',

            'tipe.required' =>
                'Tipe meja wajib dipilih.',

            'tipe.in' =>
                'Tipe meja tidak valid.',

            'status.required' =>
                'Status meja wajib dipilih.',

            'status.in' =>
                'Status meja tidak valid.',
        ]);


        Meja::create([
            'nomor_meja' => $request->nomor_meja,
            'kapasitas' => $request->kapasitas,
            'lokasi' => $request->lokasi,
            'tipe' => $request->tipe,
            'status' => $request->status,
        ]);


        return redirect()
            ->route('admin.meja')
            ->with('success', 'Meja berhasil ditambahkan.');
    }


    // =========================
    // FORM EDIT MEJA
    // =========================
    public function edit($id)
    {
        $meja = Meja::findOrFail($id);

        return view('admin.meja.edit', compact('meja'));
    }


    // =========================
    // UPDATE MEJA
    // =========================
    public function update(Request $request, $id)
    {
        $meja = Meja::findOrFail($id);


        $request->validate([
            'nomor_meja' => [
                'required',
                'string',
                'max:50',

                // Nomor meja tidak boleh sama dengan meja lain
                Rule::unique('meja', 'nomor_meja')
                    ->ignore($meja->id),
            ],

            'kapasitas' => [
                'required',
                'integer',
                'min:1',
            ],

            'lokasi' => [
                'required',
                'in:Indoor,Outdoor',
            ],

            'tipe' => [
                'required',
                'in:Reguler,VIP',
            ],

            'status' => [
                'required',
                'in:tersedia,terisi',
            ],
        ], [
            'nomor_meja.unique' =>
                'Nomor meja :input sudah digunakan oleh meja lain.',

            'nomor_meja.required' =>
                'Nomor meja wajib diisi.',

            'kapasitas.required' =>
                'Kapasitas meja wajib diisi.',

            'kapasitas.integer' =>
                'Kapasitas harus berupa angka.',

            'kapasitas.min' =>
                'Kapasitas minimal 1 orang.',

            'lokasi.required' =>
                'Lokasi meja wajib dipilih.',

            'lokasi.in' =>
                'Lokasi meja tidak valid.',

            'tipe.required' =>
                'Tipe meja wajib dipilih.',

            'tipe.in' =>
                'Tipe meja tidak valid.',

            'status.required' =>
                'Status meja wajib dipilih.',

            'status.in' =>
                'Status meja tidak valid.',
        ]);


        $meja->update([
            'nomor_meja' => $request->nomor_meja,
            'kapasitas' => $request->kapasitas,
            'lokasi' => $request->lokasi,
            'tipe' => $request->tipe,
            'status' => $request->status,
        ]);


        return redirect()
            ->route('admin.meja')
            ->with('success', 'Meja berhasil diperbarui.');
    }


    // =========================
    // HAPUS MEJA
    // =========================
    public function destroy($id)
    {
        $meja = Meja::findOrFail($id);


        // Jangan hapus meja yang sudah pernah digunakan
        // dalam pesanan.
        if ($meja->pesanan()->exists()) {

            return redirect()
                ->route('admin.meja')
                ->with(
                    'error',
                    'Meja tidak bisa dihapus karena sudah digunakan dalam pesanan.'
                );
        }


        $meja->delete();


        return redirect()
            ->route('admin.meja')
            ->with(
                'success',
                'Meja berhasil dihapus.'
            );
    }
}