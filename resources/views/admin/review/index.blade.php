<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Review – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
    --crimson: #8B1A1A; --crimson-soft: #B22222; --gold: #C9923A;
    --cream: #FDF6ED; --cream-dark: #F5E6CC; --sidebar-bg: #1C0A0A;
    --sidebar-w: 256px; --text-dark: #1E0A00; --text-mid: #5C3317;
    --text-light: #9E7650; --white: #FFFFFF;
    --shadow: 0 4px 24px rgba(139,26,26,0.12); --radius: 16px;
    --tr: 0.3s cubic-bezier(0.4,0,0.2,1);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--cream); color: var(--text-dark); }
.wrapper { display: flex; min-height: 100vh; }

/* SIDEBAR */
.sidebar { width: var(--sidebar-w); background: var(--sidebar-bg); position: fixed; top: 0; left: 0; bottom: 0; z-index: 300; display: flex; flex-direction: column; overflow-y: auto; }
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
.sidebar-foot { margin-top: auto; padding: 12px 8px 16px; border-top: 1px solid rgba(255,255,255,0.06); }
.sidebar-foot-link { display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 10px; text-decoration: none; color: rgba(255,255,255,0.4); font-size: 0.85rem; font-weight: 500; transition: background var(--tr), color var(--tr); background: none; border: none; cursor: pointer; width: 100%; font-family: inherit; }
.sidebar-foot-link:hover { background: rgba(231,76,60,0.15); color: #f87171; }
.sidebar-foot-link i { width: 18px; text-align: center; }

/* MAIN */
.main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }

/* TOPBAR */
.topbar { background: rgba(253,246,237,0.95); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(201,146,58,0.15); padding: 0 32px; height: 68px; display: flex; align-items: center; position: sticky; top: 0; z-index: 200; }
.topbar-title { font-weight: 700; font-size: 1rem; color: var(--text-dark); }
.topbar-breadcrumb { font-size: 0.75rem; color: var(--text-light); display: flex; align-items: center; gap: 5px; margin-top: 1px; }
.topbar-breadcrumb span { color: var(--crimson); font-weight: 600; }

/* CONTENT */
.content { padding: 28px 32px; flex: 1; }

/* PAGE HEADER */
.page-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 24px; gap: 16px; }
.page-header h1 { font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 800; color: var(--text-dark); }
.page-header p { font-size: 0.82rem; color: var(--text-light); margin-top: 2px; }
.btn-tambah { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--crimson), var(--crimson-soft)); color: var(--white); padding: 10px 20px; border-radius: 10px; text-decoration: none; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 16px rgba(139,26,26,0.3); transition: transform var(--tr), box-shadow var(--tr); white-space: nowrap; flex-shrink: 0; }
.btn-tambah:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(139,26,26,0.38); }

/* ALERT */
.alert-success { background: #dcfce7; border: 1px solid #bbf7d0; color: #15803d; padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 8px; animation: fadeDown 0.4s ease; }
@keyframes fadeDown { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }

/* TOOLBAR */
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

/* CARD & TABLE */
.card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; animation: fadeUp 0.4s ease both; }
@keyframes fadeUp { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; }
thead th { background: #faf5ef; padding: 12px 16px; text-align: left; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase; color: var(--text-mid); border-bottom: 1px solid #f0e8de; white-space: nowrap; }
tbody tr { transition: background var(--tr); }
tbody tr:hover { background: #fdf8f4; }
tbody td { padding: 13px 16px; font-size: 0.83rem; border-bottom: 1px solid #f7f1eb; vertical-align: middle; color: var(--text-dark); }
tbody tr:last-child td { border-bottom: none; }
tr.row-hidden { display: none; }

/* USER CELL */
.user-cell { display: flex; align-items: center; gap: 10px; }
.avatar { width: 34px; height: 34px; border-radius: 50%; background: linear-gradient(135deg, var(--crimson), var(--gold)); display: flex; align-items: center; justify-content: center; color: var(--white); font-weight: 700; font-size: 0.82rem; font-family: 'Playfair Display', serif; flex-shrink: 0; }

/* STARS */
.stars { color: var(--gold); font-size: 0.82rem; display: flex; gap: 2px; }
.rating-num { font-size: 0.72rem; color: var(--text-light); margin-top: 2px; }

/* RATING BADGE */
.rating-badge { display: inline-flex; align-items: center; gap: 4px; border-radius: 7px; padding: 3px 8px; font-size: 0.75rem; font-weight: 700; }
.rating-5 { background: #dcfce7; color: #15803d; }
.rating-4 { background: #d1fae5; color: #065f46; }
.rating-3 { background: #fef3c7; color: #92400e; }
.rating-2 { background: #ffedd5; color: #9a3412; }
.rating-1 { background: #fee2e2; color: #b91c1c; }

/* KOMENTAR */
.komentar-text { max-width: 240px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: var(--text-mid); font-style: italic; font-size: 0.8rem; }

/* ACTION BUTTONS */
.action-group { display: flex; gap: 6px; align-items: center; }
.btn-edit { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 8px; background: #dbeafe; color: #1e40af; font-size: 0.75rem; font-weight: 600; text-decoration: none; transition: background var(--tr); }
.btn-edit:hover { background: #bfdbfe; }
.btn-delete { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 8px; background: #fee2e2; color: #b91c1c; font-size: 0.75rem; font-weight: 600; border: none; cursor: pointer; font-family: inherit; transition: background var(--tr); }
.btn-delete:hover { background: #fecaca; }

/* EMPTY */
.empty-row td { text-align: center; padding: 44px 16px; }
.empty-row i { font-size: 2rem; opacity: .25; display: block; margin-bottom: 8px; color: var(--text-light); }
.empty-row p { font-size: 0.82rem; color: var(--text-light); }
</style>
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

<script>
(function () {
    const searchInput  = document.getElementById('searchInput');
    const filterRating = document.getElementById('filterRating');
    const filterProduk = document.getElementById('filterProduk');
    const resultCount  = document.getElementById('resultCount');
    const noResult     = document.getElementById('noResult');
    const tbody        = document.getElementById('tableBody');

    function getDataRows() {
        return tbody ? Array.from(tbody.querySelectorAll('tr[data-user]')) : [];
    }

    function runFilter() {
        const q      = (searchInput.value || '').toLowerCase().trim();
        const rating = filterRating.value;
        const produk = filterProduk.value;
        const rows   = getDataRows();
        let vis = 0;

        rows.forEach(row => {
            const rUser   = row.dataset.user;
            const rProduk = row.dataset.produk;
            const rRating = row.dataset.rating;

            const matchQ      = !q      || rUser.includes(q) || rProduk.includes(q);
            const matchRating = !rating || rRating === rating;
            const matchProduk = !produk || rProduk === produk;

            const show = matchQ && matchRating && matchProduk;
            row.classList.toggle('row-hidden', !show);
            if (show) vis++;
        });

        if (resultCount) {
            resultCount.innerHTML = rows.length
                ? `Menampilkan <strong>${vis}</strong> dari <strong>${rows.length}</strong> review`
                : '';
        }
        if (noResult) noResult.style.display = (rows.length && vis === 0) ? '' : 'none';
    }

    let debounceTimer;
    searchInput  && searchInput.addEventListener('input',   () => { clearTimeout(debounceTimer); debounceTimer = setTimeout(runFilter, 180); });
    filterRating && filterRating.addEventListener('change', runFilter);
    filterProduk && filterProduk.addEventListener('change', runFilter);

    runFilter();

    /* auto dismiss alert */
    const alertEl = document.getElementById('alertSuccess');
    if (alertEl) {
        setTimeout(() => {
            alertEl.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alertEl.style.opacity = '0';
            alertEl.style.transform = 'translateY(-8px)';
            setTimeout(() => alertEl.remove(), 500);
        }, 3500);
    }
})();
</script>
</body>
</html>