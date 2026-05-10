<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Users – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
    --crimson: #8B1A1A; --crimson-deep: #5C0D0D; --crimson-soft: #B22222;
    --gold: #C9923A; --cream: #FDF6ED; --cream-dark: #F5E6CC;
    --sidebar-bg: #1C0A0A; --sidebar-w: 256px;
    --text-dark: #1E0A00; --text-mid: #5C3317; --text-light: #9E7650;
    --white: #FFFFFF; --shadow: 0 4px 24px rgba(139,26,26,0.12);
    --radius: 16px; --tr: 0.3s cubic-bezier(0.4,0,0.2,1);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--cream); color: var(--text-dark); }
.wrapper { display: flex; min-height: 100vh; }

/* ── SIDEBAR ── */
.sidebar { width: var(--sidebar-w); background: var(--sidebar-bg); position: fixed; top: 0; left: 0; bottom: 0; z-index: 300; display: flex; flex-direction: column; overflow-y: auto; transition: transform var(--tr); }
.sidebar::-webkit-scrollbar { width: 0; }
.sidebar-logo { padding: 24px 20px 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid rgba(255,255,255,0.06); }
.sidebar-logo-name { font-family: 'Playfair Display', serif; font-size: 1.05rem; font-weight: 800; color: var(--white); }
.sidebar-logo-sub { font-size: 0.65rem; color: rgba(255,255,255,0.35); text-transform: uppercase; letter-spacing: 0.1em; }
.nav-section { padding: 16px 20px 6px; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.28); }
.sidebar nav { padding: 0 8px; }
.sidebar nav a { display: flex; align-items: center; gap: 11px; padding: 11px 14px; border-radius: 10px; margin-bottom: 2px; text-decoration: none; color: rgba(255,255,255,0.55); font-size: 0.87rem; font-weight: 500; transition: background var(--tr), color var(--tr); }
.sidebar nav a i { width: 18px; text-align: center; font-size: 0.9rem; }
.sidebar nav a:hover { background: rgba(255,255,255,0.07); color: var(--white); }
.sidebar nav a.active { background: linear-gradient(135deg, var(--crimson), var(--crimson-soft)); color: var(--white); box-shadow: 0 4px 16px rgba(139,26,26,0.4); }
.nav-badge { margin-left: auto; background: var(--crimson-soft); color: var(--white); font-size: 0.62rem; font-weight: 700; padding: 2px 7px; border-radius: 20px; }
.sidebar-foot { margin-top: auto; padding: 12px 8px 16px; border-top: 1px solid rgba(255,255,255,0.06); }
.sidebar-foot-link { display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 10px; text-decoration: none; color: rgba(255,255,255,0.4); font-size: 0.85rem; font-weight: 500; transition: background var(--tr), color var(--tr); background: none; border: none; cursor: pointer; width: 100%; font-family: inherit; }
.sidebar-foot-link:hover { background: rgba(231,76,60,0.15); color: #f87171; }
.sidebar-foot-link i { width: 18px; text-align: center; }

/* ── MOBILE OVERLAY ── */
.sidebar-overlay { display: block; position: fixed; inset: 0; background: rgba(0,0,0,0.45); z-index: 290; opacity: 0; pointer-events: none; transition: opacity .2s; }
.sidebar-overlay.show { opacity: 1; pointer-events: auto; }

/* ── MAIN ── */
.main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }

/* ── TOPBAR ── */
.topbar { background: rgba(253,246,237,0.95); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(201,146,58,0.15); padding: 0 32px; height: 68px; display: flex; align-items: center; position: sticky; top: 0; z-index: 200; transition: box-shadow var(--tr); }
.topbar-left { display: flex; align-items: center; gap: 14px; }
.topbar-hamburger { display: none; background: none; border: none; cursor: pointer; padding: 7px; border-radius: 8px; color: var(--text-light); font-size: 1rem; transition: background var(--tr); }
.topbar-hamburger:hover { background: var(--cream-dark); }
.topbar-title { font-weight: 700; font-size: 1rem; color: var(--text-dark); }
.topbar-breadcrumb { font-size: 0.75rem; color: var(--text-light); display: flex; align-items: center; gap: 5px; margin-top: 1px; }
.topbar-breadcrumb span { color: var(--crimson); font-weight: 600; }

/* ── CONTENT ── */
.content { padding: 28px 32px; flex: 1; }

/* ── PAGE HEADER ── */
.page-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 24px; gap: 16px; }
.page-header h1 { font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 800; color: var(--text-dark); }
.page-header p { font-size: 0.82rem; color: var(--text-light); margin-top: 2px; }
.btn-tambah { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--crimson), var(--crimson-soft)); color: var(--white); padding: 10px 20px; border-radius: 10px; text-decoration: none; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 16px rgba(139,26,26,0.3); transition: transform var(--tr), box-shadow var(--tr); white-space: nowrap; flex-shrink: 0; }
.btn-tambah:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(139,26,26,0.38); }

/* ── ALERT ── */
.alert-success { background: #dcfce7; border: 1px solid #bbf7d0; color: #15803d; padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 8px; animation: fadeDown 0.4s ease; }
@keyframes fadeDown { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }

/* ── TOOLBAR ── */
.toolbar { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 16px; flex-wrap: wrap; }
.toolbar-left { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; flex: 1; }

.search-box { display: flex; align-items: center; gap: 8px; background: var(--white); border: 1.5px solid #e8d8c4; border-radius: 10px; padding: 9px 14px; width: 260px; transition: border-color var(--tr), box-shadow var(--tr); }
.search-box:focus-within { border-color: var(--crimson); box-shadow: 0 0 0 3px rgba(139,26,26,0.08); }
.search-box i { color: var(--text-light); font-size: 0.82rem; flex-shrink: 0; }
.search-box input { border: none; background: none; outline: none; font-size: 0.82rem; font-family: inherit; color: var(--text-dark); width: 100%; }
.search-box input::placeholder { color: var(--text-light); }

.filter-sel { background: var(--white); border: 1.5px solid #e8d8c4; border-radius: 10px; padding: 9px 12px; font-size: 0.8rem; font-family: inherit; color: var(--text-mid); cursor: pointer; outline: none; transition: border-color var(--tr); appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239E7650' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 10px center; padding-right: 30px; }
.filter-sel:focus { border-color: var(--crimson); }

.result-count { font-size: 0.75rem; color: var(--text-light); white-space: nowrap; }
.result-count strong { color: var(--text-dark); font-weight: 700; }

/* ── CARD ── */
.card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; animation: fadeUp 0.4s ease both; }
@keyframes fadeUp { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }

/* ── TABLE ── */
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; }
thead th { background: #faf5ef; padding: 12px 16px; text-align: left; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase; color: var(--text-mid); border-bottom: 1px solid #f0e8de; white-space: nowrap; }
tbody tr { transition: background var(--tr); }
tbody tr:hover { background: #fdf8f4; }
tbody td { padding: 13px 16px; font-size: 0.83rem; border-bottom: 1px solid #f7f1eb; vertical-align: middle; color: var(--text-dark); }
tbody tr:last-child td { border-bottom: none; }
tr.row-hidden { display: none; }

/* ── AVATAR ── */
.avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--crimson), var(--gold)); display: flex; align-items: center; justify-content: center; color: var(--white); font-weight: 700; font-size: 0.85rem; flex-shrink: 0; }

/* ── BADGES ── */
.badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 50px; font-size: 0.72rem; font-weight: 600; }
.badge-admin    { background: rgba(139,26,26,0.1); color: var(--crimson); }
.badge-customer { background: #dbeafe; color: #1e40af; }

/* ── ACTION BUTTONS ── */
.action-group { display: flex; gap: 6px; align-items: center; }
.btn-edit { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 8px; background: #dbeafe; color: #1e40af; font-size: 0.75rem; font-weight: 600; text-decoration: none; transition: background var(--tr); }
.btn-edit:hover { background: #bfdbfe; }
.btn-delete { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 8px; background: #fee2e2; color: #b91c1c; font-size: 0.75rem; font-weight: 600; border: none; cursor: pointer; font-family: inherit; transition: background var(--tr); }
.btn-delete:hover { background: #fecaca; }

/* ── EMPTY ── */
.empty-row td { text-align: center; padding: 44px 16px; }
.empty-row i { font-size: 2rem; opacity: .25; display: block; margin-bottom: 8px; color: var(--text-light); }
.empty-row p { font-size: 0.82rem; color: var(--text-light); }

/* ── RESPONSIVE ── */
@media (max-width: 900px) {
    .sidebar { transform: translateX(-100%); }
    .sidebar.open { transform: translateX(0); }
    .main { margin-left: 0; }
    .topbar-hamburger { display: flex; }
    .topbar { padding: 0 20px; }
    .content { padding: 20px; }
}
@media (max-width: 600px) {
    .search-box { width: 100%; }
    .toolbar-left { flex-direction: column; align-items: stretch; }
    .page-header { flex-direction: column; align-items: flex-start; }
}
</style>
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

<script>
(function () {
    'use strict';

    /* ── SIDEBAR TOGGLE ── */
    const sidebar   = document.getElementById('sidebar');
    const hamburger = document.getElementById('hamburgerBtn');
    const overlay   = document.getElementById('sidebarOverlay');

    hamburger && hamburger.addEventListener('click', () => {
        const open = sidebar.classList.toggle('open');
        overlay.classList.toggle('show', open);
        document.body.style.overflow = open ? 'hidden' : '';
    });
    overlay && overlay.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    });

    /* ── TOPBAR SCROLL SHADOW ── */
    const topbar = document.querySelector('.topbar');
    window.addEventListener('scroll', () => {
        topbar.style.boxShadow = window.scrollY > 4
            ? '0 2px 20px rgba(139,26,26,0.10)'
            : 'none';
    }, { passive: true });

    /* ── SEARCH & FILTER ── */
    const searchInput = document.getElementById('searchInput');
    const filterRole  = document.getElementById('filterRole');
    const resultCount = document.getElementById('resultCount');
    const noResult    = document.getElementById('noResult');
    const tbody       = document.getElementById('tableBody');

    function getDataRows() {
        return tbody ? Array.from(tbody.querySelectorAll('tr[data-name]')) : [];
    }

    function runFilter() {
        const q    = (searchInput.value || '').toLowerCase().trim();
        const role = filterRole.value.toLowerCase();
        const rows = getDataRows();
        let vis = 0;

        rows.forEach(row => {
            const matchQ    = !q    || row.dataset.name.includes(q) || row.dataset.email.includes(q);
            const matchRole = !role || row.dataset.role === role;
            const show      = matchQ && matchRole;

            row.classList.toggle('row-hidden', !show);
            if (show) vis++;
        });

        if (resultCount) {
            resultCount.innerHTML = rows.length
                ? `Menampilkan <strong>${vis}</strong> dari <strong>${rows.length}</strong> user`
                : '';
        }
        if (noResult) noResult.style.display = (rows.length && vis === 0) ? '' : 'none';
    }

    let debounceTimer;
    searchInput && searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(runFilter, 180);
    });
    filterRole && filterRole.addEventListener('change', runFilter);

    runFilter();

    /* ── AUTO DISMISS ALERT ── */
    const alert = document.getElementById('alertSuccess');
    if (alert) {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            setTimeout(() => alert.remove(), 500);
        }, 3500);
    }

    /* ── LOGOUT CONFIRM ── */
    document.querySelectorAll('.logout-form').forEach(f =>
        f.addEventListener('submit', e => { if (!confirm('Yakin ingin logout?')) e.preventDefault(); })
    );

})();
</script>
</body>
</html>