<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Pesanan – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-detail-pesanan/index.css') }}">
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
        <a href="{{ url('/admin/detail-pesanan') }}" class="active"><i class="fa-solid fa-list-check"></i> Detail Pesanan</a>
        <a href="{{ url('/admin/pembayaran') }}"><i class="fa-solid fa-credit-card"></i> Pembayaran</a>
        <a href="{{ url('/admin/pengiriman') }}"><i class="fa-solid fa-truck"></i> Pengiriman</a>
        <a href="{{ url('/admin/keranjang') }}"><i class="fa-solid fa-basket-shopping"></i> Keranjang</a>
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
            <div class="topbar-title">Detail Pesanan</div>
            <div class="topbar-breadcrumb">
                Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <span>Detail Pesanan</span>
            </div>
        </div>
    </div>

    <div class="content">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <div>
                <h1>Detail Pesanan</h1>
                <p>Kelola semua detail item pesanan</p>
            </div>
            <a href="{{ route('admin.detail-pesanan.create') }}" class="btn-tambah">
                <i class="fa-solid fa-plus"></i> Tambah Detail
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
                    <input type="text" id="searchInput" placeholder="Cari nama produk atau ID pesanan...">
                </div>

                <select id="filterPesanan" class="filter-sel">
                    <option value="">Semua Pesanan</option>
                    @foreach($detail->pluck('id_pesanan')->unique()->sort() as $idPesanan)
                        <option value="{{ $idPesanan }}">Pesanan #{{ $idPesanan }}</option>
                    @endforeach
                </select>

                <select id="filterSubtotal" class="filter-sel">
                    <option value="">Semua Subtotal</option>
                    <option value="0-50000">&lt; Rp 50.000</option>
                    <option value="50000-200000">Rp 50.000 – 200.000</option>
                    <option value="200000+">Rp 200.000+</option>
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
                            <th>ID Pesanan</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($detail as $i => $d)
                        <tr data-produk="{{ strtolower($d->produk->nama_produk ?? '') }}"
                            data-pesanan="{{ $d->id_pesanan }}"
                            data-subtotal="{{ $d->subtotal }}">
                            <td>{{ $i + 1 }}</td>
                            <td><span class="id-badge">{{ $d->id_pesanan }}</span></td>
                            <td>{{ $d->produk->nama_produk ?? '-' }}</td>
                            <td>{{ $d->jumlah_produk }}</td>
                            <td class="harga">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                            <td class="harga">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.detail-pesanan.edit', $d->id_detail) }}" class="btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.detail-pesanan.destroy', $d->id_detail) }}" method="POST" onsubmit="return confirm('Hapus detail ini?')">
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
                            <td colspan="7">
                                <i class="fa-solid fa-list-check"></i>
                                <p>Belum ada detail pesanan</p>
                            </td>
                        </tr>
                        @endforelse

                        <tr class="empty-row" id="noResult" style="display:none;">
                            <td colspan="7">
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

<script src="{{ asset('js/admin-detail-pesanan/index.js') }}"></script>
</body>
</html>