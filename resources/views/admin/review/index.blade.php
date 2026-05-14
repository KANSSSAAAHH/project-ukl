<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Review – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-review/index.css') }}">
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
        <a href="{{ url('/admin/keranjang') }}"><i class="fa-solid fa-basket-shopping"></i> Keranjang</a>
        <a href="{{ url('/admin/review') }}" class="active"><i class="fa-solid fa-star"></i> Review</a>
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
            <div class="topbar-title">Review</div>
            <div class="topbar-breadcrumb">
                Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <span>Review</span>
            </div>
        </div>
    </div>

    <div class="content">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <div>
                <h1>Daftar Review</h1>
                <p>Kelola semua ulasan pelanggan PawonLokal</p>
            </div>
            <a href="{{ route('admin.review.create') }}" class="btn-tambah">
                <i class="fa-solid fa-plus"></i> Tambah Review
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

                <select id="filterRating" class="filter-sel">
                    <option value="">Semua Rating</option>
                    <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                    <option value="4">⭐⭐⭐⭐ (4)</option>
                    <option value="3">⭐⭐⭐ (3)</option>
                    <option value="2">⭐⭐ (2)</option>
                    <option value="1">⭐ (1)</option>
                </select>

                <select id="filterProduk" class="filter-sel">
                    <option value="">Semua Produk</option>
                    @foreach($reviews->pluck('produk')->filter()->unique('id_produk') as $p)
                        <option value="{{ strtolower($p->nama_produk) }}">{{ $p->nama_produk }}</option>
                    @endforeach
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
                            <th>User</th>
                            <th>Produk</th>
                            <th>Rating</th>
                            <th>Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($reviews as $i => $r)
                        <tr data-user="{{ strtolower($r->user->nama ?? '') }}"
                            data-produk="{{ strtolower($r->produk->nama_produk ?? '') }}"
                            data-rating="{{ $r->rating }}">
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar">{{ strtoupper(substr($r->user->nama ?? 'U', 0, 1)) }}</div>
                                    <div>
                                        <div style="font-weight:600">{{ $r->user->nama ?? '-' }}</div>
                                        <div style="font-size:0.72rem;color:var(--text-light)">{{ $r->user->email ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-weight:600">{{ $r->produk->nama_produk ?? '-' }}</td>
                            <td>
                                <div class="stars">
                                    @for($s = 1; $s <= 5; $s++)
                                        <i class="fa-{{ $s <= $r->rating ? 'solid' : 'regular' }} fa-star"></i>
                                    @endfor
                                </div>
                                <div class="rating-num">{{ $r->rating }}/5</div>
                            </td>
                            <td><div class="komentar-text" title="{{ $r->komentar }}">"{{ $r->komentar }}"</div></td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.review.edit', $r->id_review) }}" class="btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.review.destroy', $r->id_review) }}" method="POST" onsubmit="return confirm('Hapus review ini?')">
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
                                <i class="fa-solid fa-star"></i>
                                <p>Belum ada review</p>
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

<script src="{{ asset('js/admin-review/index.js') }}"></script>
</body>
</html>