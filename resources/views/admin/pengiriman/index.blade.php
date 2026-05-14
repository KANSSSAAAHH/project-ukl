<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Pengiriman – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-pengiriman/index.css') }}">
</head>
<body>
<div class="wrapper">

{{-- OVERLAY --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- ━━━ SIDEBAR ━━━ --}}
<aside class="sidebar" id="sidebar">
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
        <a href="{{ url('/admin/pesanan') }}">
            <i class="fa-solid fa-clipboard-list"></i> Pesanan
            @if(isset($pesananMenunggu) && $pesananMenunggu > 0)
                <span class="nav-badge">{{ $pesananMenunggu }}</span>
            @endif
        </a>
        <a href="{{ url('/admin/detail-pesanan') }}"><i class="fa-solid fa-list-check"></i> Detail Pesanan</a>
        <a href="{{ url('/admin/pembayaran') }}"><i class="fa-solid fa-credit-card"></i> Pembayaran</a>
        <a href="{{ url('/admin/pengiriman') }}" class="active"><i class="fa-solid fa-truck"></i> Pengiriman</a>
        <a href="{{ url('/admin/keranjang') }}"><i class="fa-solid fa-basket-shopping"></i> Keranjang</a>
        <a href="{{ url('/admin/review') }}"><i class="fa-solid fa-star"></i> Review</a>
        <a href="{{ url('/admin/users') }}"><i class="fa-solid fa-users"></i> Users</a>
    </nav>

    <div class="sidebar-foot">
        <a href="{{ url('/') }}" target="_blank" class="sidebar-foot-link">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Website
        </a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="sidebar-foot-link">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>
</aside>

{{-- ━━━ MAIN ━━━ --}}
<div class="main">

    {{-- TOPBAR --}}
    <div class="topbar">
        <div class="topbar-left">
            <button class="topbar-hamburger" id="hamburgerBtn">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div>
                <div class="topbar-title">Pengiriman</div>
                <div class="topbar-breadcrumb">
                    Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                    <span>Pengiriman</span>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <div>
                <h1>Daftar Pengiriman</h1>
                <p>Kelola semua data pengiriman PawonLokal</p>
            </div>
            <a href="{{ route('admin.pengiriman.create') }}" class="btn-tambah">
                <i class="fa-solid fa-plus"></i> Tambah Pengiriman
            </a>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
        <div class="alert-success" id="alertSuccess">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif

        {{-- TOOLBAR --}}
        <div class="toolbar">
            <div class="toolbar-left">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama penerima, kota, atau ID...">
                </div>
                <select id="filterKota" class="filter-sel">
                    <option value="">Semua Kota</option>
                    @foreach($pengiriman->pluck('kota')->unique()->sort() as $kota)
                        <option value="{{ strtolower($kota) }}">{{ $kota }}</option>
                    @endforeach
                </select>
            </div>
            <span class="result-count" id="resultCount"></span>
        </div>

        {{-- TABLE --}}
        <div class="card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pesanan</th>
                            <th>Nama Penerima</th>
                            <th>No HP</th>
                            <th>Kota</th>
                            <th>Kecamatan</th>
                            <th>Kode Pos</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($pengiriman as $i => $pg)
                        <tr data-name="{{ strtolower($pg->nama_penerima) }}"
                            data-id="{{ strtolower($pg->id_pesanan) }}"
                            data-kota="{{ strtolower($pg->kota) }}">
                            <td>{{ $i + 1 }}</td>
                            <td class="order-id">{{ $pg->id_pesanan }}</td>
                            <td style="font-weight:600;">{{ $pg->nama_penerima }}</td>
                            <td>{{ $pg->no_hp }}</td>
                            <td><span class="kota-badge"><i class="fa-solid fa-location-dot"></i>{{ $pg->kota }}</span></td>
                            <td>{{ $pg->kecamatan }}</td>
                            <td>{{ $pg->kode_pos }}</td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.pengiriman.edit', $pg->id_pengiriman) }}" class="btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.pengiriman.destroy', $pg->id_pengiriman) }}" method="POST"
                                          onsubmit="return confirm('Hapus data pengiriman ini?')">
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
                            <td colspan="8">
                                <i class="fa-solid fa-truck"></i>
                                <p>Belum ada data pengiriman</p>
                            </td>
                        </tr>
                        @endforelse

                        <tr class="empty-row" id="noResult" style="display:none;">
                            <td colspan="8">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <p>Data pengiriman tidak ditemukan</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>{{-- /content --}}
</div>{{-- /main --}}
</div>{{-- /wrapper --}}

<script src="{{ asset('js/admin-pengiriman/index.js') }}"></script>
</body>
</html>