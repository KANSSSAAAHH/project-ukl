<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Pesanan – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-pesanan/index.css') }}">
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
        <a href="{{ url('/admin/pesanan') }}" class="active">
            <i class="fa-solid fa-clipboard-list"></i> Pesanan
            @if(isset($pesananMenunggu) && $pesananMenunggu > 0)
                <span class="nav-badge">{{ $pesananMenunggu }}</span>
            @endif
        </a>
        <a href="{{ url('/admin/detail-pesanan') }}"><i class="fa-solid fa-list-check"></i> Detail Pesanan</a>
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
                <div class="topbar-title">Pesanan</div>
                <div class="topbar-breadcrumb">
                    Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                    <span>Pesanan</span>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <div>
                <h1>Daftar Pesanan</h1>
                <p>Kelola semua pesanan pelanggan PawonLokal</p>
            </div>
            <a href="{{ route('admin.pesanan.create') }}" class="btn-tambah">
                <i class="fa-solid fa-plus"></i> Tambah Pesanan
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
                    <input type="text" id="searchInput" placeholder="Cari nama user atau ID pesanan...">
                </div>
                <select id="filterStatus" class="filter-sel">
                    <option value="">Semua Status</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="diproses">Diproses</option>
                    <option value="selesai">Selesai</option>
                    <option value="dibatalkan">Dibatalkan</option>
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
                            <th>Nama User</th>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($pesanan as $i => $p)
                        <tr data-name="{{ strtolower($p->user->nama ?? '') }}"
                            data-id="{{ strtolower($p->id_pesanan) }}"
                            data-status="{{ strtolower($p->status_pesanan) }}">
                            <td>{{ $i + 1 }}</td>
                            <td class="order-id">{{ $p->id_pesanan }}</td>
                            <td style="font-weight:600;">{{ $p->user->nama ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_pesanan)->format('d M Y') }}</td>
                            <td class="harga">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                            <td><span class="badge badge-{{ $p->status_pesanan }}">{{ ucfirst($p->status_pesanan) }}</span></td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.pesanan.edit', $p->id_pesanan) }}" class="btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.pesanan.destroy', $p->id_pesanan) }}" method="POST"
                                          onsubmit="return confirm('Hapus pesanan ini?')">
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
                                <i class="fa-solid fa-clipboard-list"></i>
                                <p>Belum ada pesanan</p>
                            </td>
                        </tr>
                        @endforelse

                        <tr class="empty-row" id="noResult" style="display:none;">
                            <td colspan="7">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <p>Pesanan tidak ditemukan</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>{{-- /content --}}
</div>{{-- /main --}}
</div>{{-- /wrapper --}}

<script src="{{ asset('js/admin-pesanan/index.js') }}"></script>
</body>
</html>