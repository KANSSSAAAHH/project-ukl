<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin – PawonLokal</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;0,800;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

{{-- CSS --}}
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

<div class="wrapper">

{{-- SIDEBAR OVERLAY (mobile) --}}
<div id="sidebarOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:290;transition:opacity 0.2s;"
     class="sidebar-overlay"
     onclick="document.getElementById('sidebar').classList.remove('open');this.classList.remove('show');document.body.style.overflow=''">
</div>
<style>
    .sidebar-overlay { display:block!important; opacity:0; pointer-events:none; transition:opacity .2s; }
    .sidebar-overlay.show { opacity:1; pointer-events:auto; }
</style>

{{-- ━━━ SIDEBAR ━━━ --}}
<aside class="sidebar" id="sidebar">

    <div class="sidebar-brand">
        <img src="{{ asset('images/logoPL.png') }}" alt="Logo"
             style="width:34px;height:34px;object-fit:contain;border-radius:9px;flex-shrink:0;">
        <div>
            <div class="sidebar-brand-name">PawonLokal</div>
            <div class="sidebar-brand-sub">Admin Panel</div>
        </div>
    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-section">Menu Utama</div>
    <nav>
        <a href="{{ url('/admin/dashboard') }}" class="nav-item active">
            <i class="fa-solid fa-gauge-high"></i> Dashboard
        </a>
        <a href="{{ url('/admin/produk') }}" class="nav-item">
            <i class="fa-solid fa-box"></i> Produk
        </a>
        <a href="{{ url('/admin/pesanan') }}" class="nav-item">
            <i class="fa-solid fa-clipboard-list"></i> Pesanan
        <a href="{{ url('/admin/detail-pesanan') }}" class="nav-item">
            <i class="fa-solid fa-list-check"></i> Detail Pesanan
        </a>
        <a href="{{ url('/admin/pembayaran') }}" class="nav-item">
            <i class="fa-solid fa-credit-card"></i> Pembayaran
        </a>
        <a href="{{ url('/admin/pengiriman') }}" class="nav-item">
            <i class="fa-solid fa-truck"></i> Pengiriman
        </a>
        <a href="{{ url('/admin/keranjang') }}" class="nav-item">
            <i class="fa-solid fa-basket-shopping"></i> Keranjang
        </a>
    </nav>

    <nav>
        <a href="{{ url('/admin/review') }}" class="nav-item">
            <i class="fa-solid fa-star"></i> Review
        </a>
        <a href="{{ url('/admin/users') }}" class="nav-item">
            <i class="fa-solid fa-users"></i> Users
        </a>
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
    <header class="topbar">
        <div class="topbar-left">
            <button class="topbar-hamburger" id="hamburgerBtn" aria-label="Toggle sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div>
                <div class="topbar-title">Dashboard</div>
                <div class="breadcrumb">
                    <span>PawonLokal</span>
                    <span class="breadcrumb-sep">/</span>
                    <span class="active-crumb">Dashboard</span>
                </div>
            </div>
        </div>

        <div class="topbar-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="globalSearch" placeholder="Cari produk, pesanan...">
        </div>

        <div class="topbar-right">
        </div>
    </header>

    {{-- CONTENT --}}
    <div class="content">

        {{-- GREETING BANNER --}}
        <div class="greeting-banner">
            <div class="greeting-left">
                <div class="greeting-eyebrow">
                    <i class="fa-solid fa-sparkles"></i>
                    <span id="greetText">Selamat Datang</span>
                </div>
                <h1 class="greeting-title">
                    Hai, <em>Bu Nanik!</em> 👋
                </h1>
                <p class="greeting-desc">
                    Selamat mengelola toko PawonLokal hari ini.
                    Pantau produk, pesanan, dan pelanggan dari sini.
                </p>
            </div>
            <div class="greeting-right">
                <div class="greeting-date-pill">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span id="todayDate">—</span>
                </div>
                <img class="greeting-photo"
                     src="{{ asset('images/denanik.jpeg') }}"
                     alt="Bu Nanik"
                     onerror="this.style.display='none'">
            </div>
        </div>

        {{-- STAT CARDS --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-box"></i></div>
                <div class="stat-body">
                    <div class="stat-num" data-count="{{ $totalProduk }}">0</div>
                    <div class="stat-label">Total Produk</div>
                    <div class="stat-meta neu">
                        <i class="fa-solid fa-circle-dot"></i> {{ $produkAktif }} aktif
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                <div class="stat-body">
                    <div class="stat-num" data-count="{{ $totalPesanan }}">0</div>
                    <div class="stat-label">Total Pesanan</div>
                    <div class="stat-meta warn">
                        <i class="fa-solid fa-clock"></i> {{ $pesananMenunggu }} menunggu
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                <div class="stat-body">
                    <div class="stat-num" data-count="{{ $totalUser }}">0</div>
                    <div class="stat-label">Total Pengguna</div>
                    <div class="stat-meta up">
                        <i class="fa-solid fa-arrow-up"></i> Pelanggan aktif
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-star"></i></div>
                <div class="stat-body">
                    <div class="stat-num" data-count="{{ $totalReview }}">0</div>
                    <div class="stat-label">Total Review</div>
                    <div class="stat-meta up">
                        <i class="fa-solid fa-arrow-up"></i> Ulasan masuk
                    </div>
                </div>
            </div>
        </div>

        {{-- ROW: TABLE PRODUK + SIDEBAR KANAN --}}
        <div class="grid-2-1">

            {{-- Tabel Produk --}}
            <div class="card">
                <div class="card-head">
                    <div>
                        <div class="card-title">Daftar Produk</div>
                        <div class="card-sub">{{ $totalProduk }} produk tersedia</div>
                    </div>
                    <a href="{{ url('/admin/produk') }}" class="card-link">
                        Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="table-wrap" data-searchable>
                    <table>
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkTerbaru as $p)
                            <tr>
                                <td>
                                    @if($p->foto)
                                        <img class="prod-thumb"
                                             src="{{ asset('storage/'.$p->foto) }}"
                                             alt="{{ $p->nama_produk }}"
                                             onerror="this.outerHTML='<div class=prod-thumb-placeholder><i class=fa-solid\ fa-cookie></i></div>'">
                                    @else
                                        <div class="prod-thumb-placeholder"><i class="fa-solid fa-cookie"></i></div>
                                    @endif
                                </td>
                                <td><div class="prod-name">{{ $p->nama_produk }}</div></td>
                                <td><span class="badge badge-{{ $p->kategori }}">{{ $p->kategori }}</span></td>
                                <td class="price-text">Rp {{ number_format($p->harga,0,',','.') }}</td>
                                <td><span class="badge badge-{{ $p->status }}">{{ $p->status }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-box-open"></i>
                                        <p>Belum ada produk</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Kolom kanan: Quick Actions + Ringkasan --}}
            <div style="display:flex;flex-direction:column;gap:18px;">

                <div class="card">
                    <div class="card-head">
                        <div>
                            <div class="card-title">Aksi Cepat</div>
                            <div class="card-sub">Pintasan menu</div>
                        </div>
                        <div class="card-icon"><i class="fa-solid fa-bolt"></i></div>
                    </div>
                    <div class="quick-actions">
                        <a href="{{ route('admin.produk.create') }}" class="qa-btn qa-red">
                            <i class="fa-solid fa-plus"></i> Tambah Produk
                        </a>
                        <a href="{{ url('/admin/pesanan') }}" class="qa-btn qa-amber">
                            <i class="fa-solid fa-clipboard-list"></i> Pesanan
                        </a>
                        <a href="{{ url('/admin/pembayaran') }}" class="qa-btn qa-green">
                            <i class="fa-solid fa-credit-card"></i> Pembayaran
                        </a>
                        <a href="{{ url('/admin/users') }}" class="qa-btn qa-blue">
                            <i class="fa-solid fa-users"></i> Users
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <div>
                            <div class="card-title">Ringkasan Produk</div>
                            <div class="card-sub">Per kategori & status</div>
                        </div>
                        <div class="card-icon"><i class="fa-solid fa-chart-pie"></i></div>
                    </div>
                    <div class="mini-stats">
                        <div class="mini-row">
                            <div class="mini-left">
                                <div class="mini-icon" style="background:#FEF3C7;color:#B45309;">
                                    <i class="fa-solid fa-cookie-bite"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Kue Kering</div>
                                    <div class="mini-desc">Kategori kering</div>
                                </div>
                            </div>
                            <div class="mini-val">{{ $produkKering }}</div>
                        </div>
                        <div class="mini-row">
                            <div class="mini-left">
                                <div class="mini-icon" style="background:#DBEAFE;color:#1E40AF;">
                                    <i class="fa-solid fa-droplet"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Kue Basah</div>
                                    <div class="mini-desc">Kategori basah</div>
                                </div>
                            </div>
                            <div class="mini-val">{{ $produkBasah }}</div>
                        </div>
                        <div class="mini-row">
                            <div class="mini-left">
                                <div class="mini-icon" style="background:#D1FAE5;color:#065F46;">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Produk Aktif</div>
                                    <div class="mini-desc">Status aktif</div>
                                </div>
                            </div>
                            <div class="mini-val">{{ $produkAktif }}</div>
                        </div>
                        <div class="mini-row">
                            <div class="mini-left">
                                <div class="mini-icon" style="background:#FEE2E2;color:#991B1B;">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Nonaktif</div>
                                    <div class="mini-desc">Status nonaktif</div>
                                </div>
                            </div>
                            <div class="mini-val">{{ $totalProduk - $produkAktif }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ROW: PESANAN + REVIEW --}}
        <div class="grid-1-1">

            <div class="card">
                <div class="card-head">
                    <div>
                        <div class="card-title">Pesanan Terbaru</div>
                        <div class="card-sub">{{ $totalPesanan }} total pesanan</div>
                    </div>
                    <a href="{{ url('/admin/pesanan') }}" class="card-link">
                        Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesananTerbaru as $ps)
                            <tr>
                                <td class="order-id">#{{ $ps->id_pesanan }}</td>
                                <td>{{ \Carbon\Carbon::parse($ps->tanggal_pesanan)->format('d M Y') }}</td>
                                <td class="price-text">Rp {{ number_format($ps->total_harga,0,',','.') }}</td>
                                <td><span class="badge badge-{{ $ps->status_pesanan }}">{{ $ps->status_pesanan }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-clipboard-list"></i>
                                        <p>Belum ada pesanan</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-head">
                    <div>
                        <div class="card-title">Review Terbaru</div>
                        <div class="card-sub">{{ $totalReview }} ulasan masuk</div>
                    </div>
                    <a href="{{ url('/admin/review') }}" class="card-link">
                        Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="review-list">
                    @forelse($reviewTerbaru as $rv)
                    <div class="review-row">
                        <div class="review-ava">
                            {{ strtoupper(substr($rv->user->nama ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <div class="review-name">{{ $rv->user->nama ?? 'User' }}</div>
                            <div class="review-stars">
                                @for($s = 1; $s <= 5; $s++)
                                    <i class="fa-{{ $s <= $rv->rating ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            </div>
                            <div class="review-text">"{{ Str::limit($rv->komentar, 85) }}"</div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="fa-solid fa-star"></i>
                        <p>Belum ada review</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>{{-- /content --}}
</div>{{-- /main --}}
</div>{{-- /wrapper --}}

{{-- JS --}}
<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>