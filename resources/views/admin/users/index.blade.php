<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Users – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-user/index.css') }}">
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
        <a href="{{ url('/admin/pengiriman') }}"><i class="fa-solid fa-truck"></i> Pengiriman</a>
        <a href="{{ url('/admin/keranjang') }}"><i class="fa-solid fa-basket-shopping"></i> Keranjang</a>
        <a href="{{ url('/admin/review') }}"><i class="fa-solid fa-star"></i> Review</a>
        <a href="{{ url('/admin/users') }}" class="active"><i class="fa-solid fa-users"></i> Users</a>
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
                <div class="topbar-title">Users</div>
                <div class="topbar-breadcrumb">
                    Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                    <span>Users</span>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <div>
                <h1>Daftar Users</h1>
                <p>Semua pengguna yang terdaftar di PawonLokal</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn-tambah">
                <i class="fa-solid fa-plus"></i> Tambah User
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
                    <input type="text" id="searchInput" placeholder="Cari nama atau email...">
                </div>
                <select id="filterRole" class="filter-sel">
                    <option value="">Semua Role</option>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
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
                            <th>Avatar</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($users as $i => $u)
                        <tr data-name="{{ strtolower($u->nama) }}"
                            data-email="{{ strtolower($u->email) }}"
                            data-role="{{ $u->role }}">
                            <td>{{ $i + 1 }}</td>
                            <td><div class="avatar">{{ strtoupper(substr($u->nama, 0, 1)) }}</div></td>
                            <td style="font-weight:600;">{{ $u->nama }}</td>
                            <td style="color:var(--text-mid);">{{ $u->email }}</td>
                            <td>{{ $u->no_hp ?? '-' }}</td>
                            <td><span class="badge badge-{{ $u->role }}">{{ ucfirst($u->role) }}</span></td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.users.edit', $u->id_user) }}" class="btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $u->id_user) }}" method="POST"
                                          onsubmit="return confirm('Hapus user ini?')">
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
                                <i class="fa-solid fa-users"></i>
                                <p>Belum ada user</p>
                            </td>
                        </tr>
                        @endforelse

                        <tr class="empty-row" id="noResult" style="display:none;">
                            <td colspan="7">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <p>User tidak ditemukan</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>{{-- /content --}}
</div>{{-- /main --}}
</div>{{-- /wrapper --}}

<script src="{{ asset('js/admin-user/index.js') }}"></script>
</body>
</html>