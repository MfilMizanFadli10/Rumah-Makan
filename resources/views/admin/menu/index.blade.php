@extends('layouts.admin')

@section('title', 'Data Menu')

@section('page-title', 'Data Menu')

@section('page-description')
    Kelola makanan dan minuman yang tersedia di rumah makan.
@endsection

@section('content')

<style>
    .menu-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .menu-header h2 {
        font-size: 24px;
        color: #2c2c2c;
        margin-bottom: 5px;
    }

    .menu-header p {
        color: #888;
        font-size: 13px;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #8b0000;
        color: white;
        padding: 11px 17px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-add:hover {
        background: #650000;
    }

    .menu-filter {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
    }

    .search-box {
        flex: 1;
    }

    .search-box input,
    .category-filter {
        width: 100%;
        height: 44px;
        border: 1px solid #ddd;
        border-radius: 9px;
        padding: 0 14px;
        font-size: 13px;
        outline: none;
        background: white;
    }

    .search-box input:focus,
    .category-filter:focus {
        border-color: #8b0000;
    }

    .category-filter {
        width: 190px;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .menu-table {
        width: 100%;
        border-collapse: collapse;
    }

    .menu-table th {
        text-align: left;
        padding: 13px 12px;
        background: #fafafa;
        color: #777;
        font-size: 12px;
        font-weight: 600;
        border-bottom: 1px solid #eee;
    }

    .menu-table td {
        padding: 15px 12px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 13px;
        color: #444;
    }

    .menu-table tr:hover {
        background: #fffafa;
    }

    .menu-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .menu-photo {
        width: 48px;
        height: 48px;
        border-radius: 9px;
        background: #f5f3f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .menu-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 3px;
    }

    .menu-description {
        color: #999;
        font-size: 11px;
    }

    .category {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 6px;
        background: #f5f3f0;
        color: #666;
        font-size: 11px;
    }

    .price {
        font-weight: 600;
        color: #8b0000 !important;
    }

    .available {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 6px;
        background: #eaf7ee;
        color: #27834b;
        font-size: 11px;
        font-weight: 600;
    }

    .unavailable {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 6px;
        background: #fceaea;
        color: #a33;
        font-size: 11px;
        font-weight: 600;
    }

    .actions {
        display: flex;
        gap: 7px;
    }

    .btn-edit,
    .btn-delete {
    border: none;
    padding: 7px 10px;
    border-radius: 6px;
    background: #fceaea;
    color: #a00000;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
}

    .btn-edit {
        background: #f3f3f3;
        color: #555;
    }

    .btn-delete {
        background: #fceaea;
        color: #a00000;
    }

    .empty-menu {
        text-align: center;
        padding: 45px 20px !important;
        color: #999 !important;
    }

    @media (max-width: 700px) {

        .menu-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .menu-filter {
            flex-direction: column;
        }

        .category-filter {
            width: 100%;
        }
    }
</style>


<div class="menu-card">

    {{-- HEADER --}}
    <div class="menu-header">

        <div>
            <h2>Daftar Menu</h2>
            <p>Kelola makanan dan minuman rumah makan.</p>
        </div>

        <a href="{{ route('admin.menu.create') }}" class="btn-add">
            ＋ Tambah Menu
        </a>

    </div>


    {{-- FILTER --}}
    <div class="menu-filter">

        <div class="search-box">
           <input
                type="text"
                id="searchMenu"
                placeholder=" Cari nama menu..."
            >
        </div>

        <select class="category-filter" id="filterKategori">

            <option value="">
                Semua Kategori
            </option>

            @foreach($menus->pluck('kategori')->unique('id') as $kategori)

                @if($kategori)

                    <option value="{{ $kategori->id }}">
                        {{ $kategori->nama_kategori }}
                    </option>

                @endif

            @endforeach

        </select>

    </div>


    {{-- TABLE --}}
    <div class="table-wrapper">

        <table class="menu-table">

            <thead>

                <tr>
                    <th>Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

        @forelse($menus as $menu)

    <tr
        class="menu-row"
        data-nama="{{ strtolower($menu->nama_menu) }}"
        data-kategori="{{ $menu->kategori_id }}"
    >
     <td>

    <div class="menu-info">

    <div class="menu-photo">

    @if($menu->foto)
        <img
            src="{{ asset('storage/' . $menu->foto) }}"
            alt="{{ $menu->nama_menu }}"
            style="
                width:48px;
                height:48px;
                object-fit:cover;
                border-radius:9px;
            "
                >
                @else
                    🍽️
                @endif
                        </div>

                                <div>

                                    <div class="menu-name">
                                        {{ $menu->nama_menu }}
                                    </div>

                                    <div class="menu-description">
                                        {{ $menu->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </div>

                                </div>

                            </div>

                        </td>

                        <td>

                            <span class="category">
                                {{ $menu->kategori->nama_kategori ?? '-' }}
                            </span>

                        </td>

                        <td class="price">

                            Rp {{ number_format($menu->harga, 0, ',', '.') }}

                        </td>

                        <td>

                            @if($menu->status == 'tersedia')

                                <span class="available">
                                    Tersedia
                                </span>

                            @else

                                <span class="unavailable">
                                    Tidak Tersedia
                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="actions">

    {{-- EDIT --}}
    <a href="{{ route('admin.menu.edit', $menu->id) }}"
       class="btn-edit">
         Edit
    </a>


    {{-- HAPUS --}}
    <form action="{{ route('admin.menu.destroy', $menu->id) }}"
          method="POST"
          style="display:inline;"
          onsubmit="return confirm('Yakin ingin menghapus menu ini?')">

        @csrf
        @method('DELETE')

        <button type="submit" class="btn-delete">
             Hapus
        </button>

    </form>

</div>  

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="empty-menu">
                            Belum ada menu.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchMenu');
    const categoryFilter = document.getElementById('filterKategori');
    const rows = document.querySelectorAll('.menu-row');

    function filterMenu() {

        const keyword = searchInput.value.toLowerCase().trim();
        const kategori = categoryFilter.value;

        rows.forEach(function (row) {

            const nama = row.dataset.nama;
            const kategoriId = row.dataset.kategori;

            const cocokNama = nama.includes(keyword);

            const cocokKategori =
                kategori === '' || kategoriId === kategori;

            if (cocokNama && cocokKategori) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });
    }

    searchInput.addEventListener('input', filterMenu);

    categoryFilter.addEventListener('change', filterMenu);

});
</script>

@endsection
