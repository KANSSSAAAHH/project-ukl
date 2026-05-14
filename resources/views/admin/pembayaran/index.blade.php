<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Pembayaran – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-pembayaran/index.css') }}">
</head>
<body>
<div class="wrapper">

{{-- OVERLAY --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- LIGHTBOX --}}
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
    <img id="lightboxImg" src="" alt="Bukti Bayar">
</div>

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
        <a href="{{ url('/admin/pembayaran') }}" class="active"><i class="fa-solid fa-credit-card"></i> Pembayaran</a>
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
                <div class="topbar-title">Pembayaran</div>
                <div class="topbar-breadcrumb">
                    Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                    <span>Pembayaran</span>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <div>
                <h1>Daftar Pembayaran</h1>
                <p>Kelola semua data pembayaran PawonLokal</p>
            </div>
            <a href="{{ route('admin.pembayaran.create') }}" class="btn-tambah">
                <i class="fa-solid fa-plus"></i> Tambah Pembayaran
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
                    <input type="text" id="searchInput" placeholder="Cari ID pesanan atau metode...">
                </div>
                <select id="filterStatus" class="filter-sel">
                    <option value="">Semua Status</option>
                    <option value="lunas">Lunas</option>
                    <option value="pending">Pending</option>
                    <option value="belum">Belum Bayar</option>
                </select>
                <select id="filterMetode" class="filter-sel">
                    <option value="">Semua Metode</option>
                    @foreach($pembayaran->pluck('metode')->unique()->sort() as $metode)
                        <option value="{{ strtolower($metode) }}">{{ $metode }}</option>
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
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Bukti Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($pembayaran as $i => $p)
                        <tr data-id="{{ strtolower($p->id_pesanan) }}"
                            data-metode="{{ strtolower($p->metode) }}"
                            data-status="{{ strtolower($p->status) }}">
                            <td>{{ $i + 1 }}</td>
                            <td class="order-id">{{ $p->id_pesanan }}</td>
                            <td>
                                <span class="metode-badge">
                                    <i class="fa-solid fa-wallet"></i> {{ $p->metode }}
                                </span>
                            </td>
                            <td><span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                            <td>
                                @if($p->bukti_bayar)
                                    <img class="bukti-img"
                                         src="{{ asset('storage/'.$p->bukti_bayar) }}"
                                         alt="Bukti"
                                         onclick="openLightbox(this.src)"
                                         onerror="this.outerHTML='<span class=no-bukti>Tidak ada</span>'">
                                @else
                                    <span class="no-bukti">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.pembayaran.edit', $p->id_pembayaran) }}" class="btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.pembayaran.destroy', $p->id_pembayaran) }}" method="POST"
                                          onsubmit="return confirm('Hapus pembayaran ini?')">
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
                                <i class="fa-solid fa-credit-card"></i>
                                <p>Belum ada pembayaran</p>
                            </td>
                        </tr>
                        @endforelse

                        <tr class="empty-row" id="noResult" style="display:none;">
                            <td colspan="6">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <p>Pembayaran tidak ditemukan</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>{{-- /content --}}
</div>{{-- /main --}}
</div>{{-- /wrapper --}}

<script src="{{ asset('js/admin-pembayaran/index.js') }}"></script>
</body>
</html>