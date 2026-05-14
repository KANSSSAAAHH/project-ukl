<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Keranjang – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-keranjang/index.css') }}">
</head>
<body>
<div class="wrapper">

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-logo">
        <div>
            <div class="sidebar-logo-name">PawonLokal</div>
            <div class="sidebar-logo-sub">Admin Panel</div>
        </div>
    </div>
    <div class="nav-section">Menu Utama</div>
    <nav>
        <a href="{{ url('/admin/dashboard') }}"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
        <a href="{{ url('/admin/produk') }}"><i class="fa-solid fa-box"></i> Produk</a>
        <a href="{{ url('/admin/pesanan') }}"><i class="fa-solid fa-clipboard-list"></i> Pesanan</a>
        <a href="{{ url('/admin/detail-pesanan') }}"><i class="fa-solid fa-list-check"></i> Detail Pesanan</a>
        <a href="{{ url('/admin/pembayaran') }}"><i class="fa-solid fa-credit-card"></i> Pembayaran</a>
        <a href="{{ url('/admin/pengiriman') }}"><i class="fa-solid fa-truck"></i> Pengiriman</a>
        <a href="{{ url('/admin/keranjang') }}" class="active"><i class="fa-solid fa-basket-shopping"></i> Keranjang</a>
        <a href="{{ url('/admin/review') }}"><i class="fa-solid fa-star"></i> Review</a>
        <a href="{{ url('/admin/users') }}"><i class="fa-solid fa-users"></i> Users</a>
    </nav>
    <div class="sidebar-foot">
        <a href="{{ url('/') }}" target="_blank" class="sidebar-foot-link">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Website
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-foot-link">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>
</aside>

<!-- MAIN -->
<div class="main">
    <div class="topbar">
        <div>
            <div class="topbar-title">Keranjang</div>
            <div class="topbar-breadcrumb">
                Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <span>Keranjang</span>
            </div>
        </div>
    </div>

    <div class="content">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <div>
                <h1>Daftar Keranjang</h1>
                <p>Semua item keranjang belanja pelanggan</p>
            </div>
            <a href="{{ route('admin.keranjang.create') }}" class="btn-tambah">
                <i class="fa-solid fa-plus"></i> Tambah Item
            </a>
        </div>

        @if(session('success'))
        <div class="alert-success" id="alertSuccess">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif

        <!-- TOOLBAR -->
        <div class="toolbar">
            <div class="toolbar-left">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama user atau produk...">
                </div>

                <select id="filterUser" class="filter-sel">
                    <option value="">Semua User</option>
                    @foreach($keranjang->pluck('user')->filter()->unique('id') as $u)
                        <option value="{{ strtolower($u->nama) }}">{{ $u->nama }}</option>
                    @endforeach
                </select>

                <select id="filterJumlah" class="filter-sel">
                    <option value="">Semua Jumlah</option>
                    <option value="1">1 item</option>
                    <option value="2-5">2 – 5 item</option>
                    <option value="6+">6+ item</option>
                </select>
            </div>
            <span class="result-count" id="resultCount"></span>
        </div>

        <!-- TABLE -->
        <div class="card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama User</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($keranjang as $i => $k)
                        <tr data-user="{{ strtolower($k->user->nama ?? '') }}"
                            data-produk="{{ strtolower($k->produk->nama_produk ?? '') }}"
                            data-jumlah="{{ $k->jumlah_produk }}">
                            <td>{{ $i + 1 }}</td>
                            <td>
                                @if($k->produk && $k->produk->foto)
                                    <img class="prod-img" src="{{ asset('storage/'.$k->produk->foto) }}" alt="foto"
                                         onerror="this.outerHTML='<div class=prod-img-placeholder><i class=fa-solid fa-cookie></i></div>'">
                                @else
                                    <div class="prod-img-placeholder"><i class="fa-solid fa-cookie"></i></div>
                                @endif
                            </td>
                            <td style="font-weight:600;">{{ $k->user->nama ?? '-' }}</td>
                            <td>{{ $k->produk->nama_produk ?? '-' }}</td>
                            <td>{{ $k->jumlah_produk }}</td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.keranjang.edit', $k->id_keranjang) }}" class="btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.keranjang.destroy', $k->id_keranjang) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="6">
                                <i class="fa-solid fa-basket-shopping"></i>
                                <p>Keranjang kosong</p>
                            </td>
                        </tr>
                        @endforelse

                        <tr class="empty-row" id="noResult" style="display:none;">
                            <td colspan="6">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <p>Data tidak ditemukan</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</div>

<script src="{{ asset('js/admin-keranjang/index.js') }}"></script>
</body>
</html>