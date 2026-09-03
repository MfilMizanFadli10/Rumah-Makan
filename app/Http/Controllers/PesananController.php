<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\DetailPesanan;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // =====================================================
    // PESANAN ADMIN
    // =====================================================

    public function index()
    {
        $pesanans = Pesanan::with([
            'meja',
            'detailPesanan.menu'
        ])
        ->latest('tanggal_pesanan')
        ->get();

        return view('admin.pesanan.index', compact('pesanans'));
    }


    // =====================================================
    // FORM TAMBAH PESANAN ADMIN
    // =====================================================

    public function create()
    {
        $mejas = Meja::where('status', 'tersedia')
            ->orderBy('nomor_meja')
            ->get();

        $menus = Menu::where('status', 'tersedia')
            ->orderBy('nama_menu')
            ->get();

        $pengaturan = Pengaturan::first();

        return view('admin.pesanan.create', compact(
            'mejas',
            'menus',
            'pengaturan'
        ));
    }


    // =====================================================
    // FORM PESANAN PELANGGAN
    // =====================================================

    public function customerPesanan(Request $request)
    {
        $pesananLama = null;

        // Jika pelanggan memilih tambah pesanan
        if ($request->filled('tambah')) {

            $pesananLama = Pesanan::with([
                'meja',
                'detailPesanan.menu'
            ])
            ->where('kode_pesanan', $request->tambah)
            ->first();
        }


        // =================================================
        // DATA MEJA
        // =================================================

        if ($pesananLama) {

            // Tampilkan meja tersedia
            // + meja yang sedang dipakai pesanan lama

            $mejas = Meja::where(function ($query) use ($pesananLama) {

                $query->where('status', 'tersedia')
                      ->orWhere('id', $pesananLama->meja_id);

            })
            ->orderBy('nomor_meja')
            ->get();

        } else {

            $mejas = Meja::where('status', 'tersedia')
                ->orderBy('nomor_meja')
                ->get();
        }


        // =================================================
        // DATA MENU
        // =================================================

        $menus = Menu::where('status', 'tersedia')
            ->orderBy('nama_menu')
            ->get();


        // =================================================
        // PENGATURAN
        // =================================================

        $pengaturan = Pengaturan::first();


        return view('customer.pesanan', compact(
            'mejas',
            'menus',
            'pengaturan',
            'pesananLama'
        ));
    }


    // =====================================================
    // DETAIL PESANAN ADMIN
    // =====================================================

    public function show($id)
    {
        $pesanan = Pesanan::with([
            'meja',
            'detailPesanan.menu'
        ])->findOrFail($id);

        return view('admin.pesanan.show', compact('pesanan'));
    }


    // =====================================================
    // SIMPAN PESANAN DARI ADMIN
    // =====================================================

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'meja_id' => 'required|exists:meja,id',
            'jumlah_orang' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|string',

            'menu_id' => 'required|array|min:1',
            'menu_id.*' => 'required|exists:menu,id',

            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',

            'catatan' => 'nullable|string',
        ]);


        DB::transaction(function () use ($request) {

            $kodePesanan = 'ORD-' . str_pad(
                (Pesanan::max('id') ?? 0) + 1,
                3,
                '0',
                STR_PAD_LEFT
            );


            $totalHarga = 0;

            foreach ($request->menu_id as $index => $menuId) {

                $menu = Menu::findOrFail($menuId);

                $jumlah = $request->jumlah[$index];

                $totalHarga += $menu->harga * $jumlah;
            }


            $pesanan = Pesanan::create([
                'kode_pesanan' => $kodePesanan,
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_hp' => $request->no_hp,
                'meja_id' => $request->meja_id,
                'tanggal_pesanan' => now()->toDateString(),
                'jam_pesanan' => now()->format('H:i:s'),
                'jumlah_orang' => $request->jumlah_orang,
                'total_harga' => $totalHarga,

                // STATUS DATABASE
                'status' => 'menunggu',

                'metode_pembayaran' => $request->metode_pembayaran,
                'catatan' => $request->catatan,
            ]);


            foreach ($request->menu_id as $index => $menuId) {

                $menu = Menu::findOrFail($menuId);

                $jumlah = $request->jumlah[$index];

                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $menu->id,
                    'jumlah' => $jumlah,
                    'harga' => $menu->harga,
                    'subtotal' => $menu->harga * $jumlah,
                ]);
            }


            // Meja menjadi dipesan
            Meja::where('id', $request->meja_id)
                ->update([
                    'status' => 'dipesan'
                ]);
        });


        return redirect()
            ->route('admin.pesanan')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }


    // =====================================================
    // SIMPAN PESANAN PELANGGAN
    // =====================================================

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'meja_id' => 'required|exists:meja,id',
            'jumlah_orang' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|string',
            'catatan' => 'nullable|string',

            'menu_id' => 'required|array|min:1',
            'menu_id.*' => 'required|exists:menu,id',

            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',

            // PERBAIKAN:
            // tabel kita adalah "pesanan", bukan "pesanans"
            'kode_pesanan_lama' => [
                'nullable',
                'string',
                'exists:pesanan,kode_pesanan'
            ],
        ]);


        $kodePesanan = null;


        DB::transaction(function () use ($request, &$kodePesanan) {

            // =================================================
            // CEK PESANAN LAMA
            // =================================================

            $pesananLama = null;

            if ($request->filled('kode_pesanan_lama')) {

                $pesananLama = Pesanan::where(
                    'kode_pesanan',
                    $request->kode_pesanan_lama
                )->first();
            }


            // =================================================
            // JIKA TAMBAH PESANAN LAMA
            // =================================================

            if ($pesananLama) {

                $kodePesanan = $pesananLama->kode_pesanan;


                foreach ($request->menu_id as $index => $menuId) {

                    $menu = Menu::findOrFail($menuId);

                    $jumlahBaru = $request->jumlah[$index];


                    $detailLama = DetailPesanan::where(
                        'pesanan_id',
                        $pesananLama->id
                    )
                    ->where('menu_id', $menu->id)
                    ->first();


                    if ($detailLama) {

                        $detailLama->jumlah += $jumlahBaru;

                        $detailLama->subtotal =
                            $detailLama->jumlah * $detailLama->harga;

                        $detailLama->save();

                    } else {

                        DetailPesanan::create([
                            'pesanan_id' => $pesananLama->id,
                            'menu_id' => $menu->id,
                            'jumlah' => $jumlahBaru,
                            'harga' => $menu->harga,
                            'subtotal' => $menu->harga * $jumlahBaru,
                        ]);
                    }
                }


                // Hitung ulang total
                $totalBaru = DetailPesanan::where(
                    'pesanan_id',
                    $pesananLama->id
                )->sum('subtotal');


                $pesananLama->update([
                    'total_harga' => $totalBaru,

                    // Pesanan kembali menunggu
                    'status' => 'menunggu',

                    'catatan' => $request->catatan
                        ?: $pesananLama->catatan,

                    'nama_pelanggan' => $request->nama_pelanggan,
                    'no_hp' => $request->no_hp,
                    'jumlah_orang' => $request->jumlah_orang,
                    'metode_pembayaran' => $request->metode_pembayaran,
                ]);


                // Meja tetap dipesan
                Meja::where('id', $pesananLama->meja_id)
                    ->update([
                        'status' => 'dipesan'
                    ]);
            }


            // =================================================
            // JIKA PESANAN BARU
            // =================================================

            else {

                $kodePesanan = 'ORD-' . str_pad(
                    (Pesanan::max('id') ?? 0) + 1,
                    3,
                    '0',
                    STR_PAD_LEFT
                );


                $totalHarga = 0;


                foreach ($request->menu_id as $index => $menuId) {

                    $menu = Menu::findOrFail($menuId);

                    $jumlah = $request->jumlah[$index];

                    $totalHarga += $menu->harga * $jumlah;
                }


                $pesanan = Pesanan::create([
                    'kode_pesanan' => $kodePesanan,
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'no_hp' => $request->no_hp,
                    'meja_id' => $request->meja_id,
                    'tanggal_pesanan' => now()->toDateString(),
                    'jam_pesanan' => now()->format('H:i:s'),
                    'jumlah_orang' => $request->jumlah_orang,
                    'total_harga' => $totalHarga,

                    // STATUS AWAL
                    'status' => 'menunggu',

                    'metode_pembayaran' => $request->metode_pembayaran,
                    'catatan' => $request->catatan,
                ]);


                foreach ($request->menu_id as $index => $menuId) {

                    $menu = Menu::findOrFail($menuId);

                    $jumlah = $request->jumlah[$index];

                    DetailPesanan::create([
                        'pesanan_id' => $pesanan->id,
                        'menu_id' => $menu->id,
                        'jumlah' => $jumlah,
                        'harga' => $menu->harga,
                        'subtotal' => $menu->harga * $jumlah,
                    ]);
                }


                // Meja menjadi dipesan
                Meja::where('id', $request->meja_id)
                    ->update([
                        'status' => 'dipesan'
                    ]);
            }
        });


        // =================================================
        // SIMPAN KODE PESANAN KE SESSION
        // =================================================

        session([
            'kode_pesanan' => $kodePesanan
        ]);


        // =================================================
        // PINDAH KE STATUS PESANAN
        // =================================================

        return redirect()
            ->route('customer.status-pesanan')
            ->with('success', 'Pesanan berhasil dikirim.');
    }


    // =====================================================
    // STATUS PESANAN PELANGGAN
    // =====================================================

    public function statusCustomer()
    {
        $kodePesanan = session('kode_pesanan');

        $pesanan = null;


        if ($kodePesanan) {

            $pesanan = Pesanan::with([
                'meja',
                'detailPesanan.menu'
            ])
            ->where('kode_pesanan', $kodePesanan)
            ->first();
        }


        return view(
            'customer.status-pesanan',
            compact(
                'pesanan',
                'kodePesanan'
            )
        );
    }


    // =====================================================
    // UPDATE STATUS PESANAN ADMIN
    // =====================================================

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,dibatalkan',
        ]);


        $pesanan = Pesanan::findOrFail($id);


        $pesanan->update([
            'status' => $request->status,
        ]);


        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }


    // =====================================================
    // HAPUS PESANAN
    // =====================================================

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $pesanan = Pesanan::findOrFail($id);


            DetailPesanan::where(
                'pesanan_id',
                $pesanan->id
            )->delete();


            // Meja kembali tersedia
            Meja::where(
                'id',
                $pesanan->meja_id
            )->update([
                'status' => 'tersedia'
            ]);


            $pesanan->delete();
        });


        return redirect()
            ->route('admin.pesanan')
            ->with(
                'success',
                'Pesanan berhasil dihapus.'
            );
    }
}