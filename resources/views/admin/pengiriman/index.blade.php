<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Pengiriman – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root { --crimson: #8B1A1A; --crimson-soft: #B22222; --gold: #C9923A; --cream: #FDF6ED; --cream-dark: #F5E6CC; --sidebar-bg: #1C0A0A; --sidebar-w: 256px; --text-dark: #1E0A00; --text-mid: #5C3317; --text-light: #9E7650; --white: #FFFFFF; --shadow: 0 4px 24px rgba(139,26,26,0.12); --radius: 16px; --tr: 0.3s cubic-bezier(0.4,0,0.2,1); }
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--cream); color: var(--text-dark); }
.wrapper { display: flex; min-height: 100vh; }
.sidebar { width: var(--sidebar-w); background: var(--sidebar-bg); position: fixed; top: 0; left: 0; bottom: 0; z-index: 300; display: flex; flex-direction: column; overflow-y: auto; }
.sidebar-logo { padding: 24px 20px 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid rgba(255,255,255,0.06); }
.sidebar-logo-name { font-family: 'Playfair Display', serif; font-size: 1.05rem; font-weight: 800; color: var(--white); }
.sidebar-logo-sub { font-size: 0.65rem; color: rgba(255,255,255,0.35); text-transform: uppercase; letter-spacing: 0.1em; }
.nav-section { padding: 16px 20px 6px; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.28); }
.sidebar nav { padding: 0 8px; }
.sidebar nav a { display: flex; align-items: center; gap: 11px; padding: 11px 14px; border-radius: 10px; margin-bottom: 2px; text-decoration: none; color: rgba(255,255,255,0.55); font-size: 0.87rem; font-weight: 500; transition: background var(--tr), color var(--tr); }
.sidebar nav a i { width: 18px; text-align: center; }
.sidebar nav a:hover { background: rgba(255,255,255,0.07); color: var(--white); }
.sidebar nav a.active { background: linear-gradient(135deg, var(--crimson), var(--crimson-soft)); color: var(--white); }
.sidebar-foot { margin-top: auto; padding: 12px 8px 16px; border-top: 1px solid rgba(255,255,255,0.06); }
.sidebar-foot a { display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 10px; text-decoration: none; color: rgba(255,255,255,0.4); font-size: 0.85rem; }
.main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }
.topbar { background: rgba(253,246,237,0.92); border-bottom: 1px solid rgba(201,146,58,0.15); padding: 0 32px; height: 68px; display: flex; align-items: center; position: sticky; top: 0; z-index: 200; }
.topbar-title { font-weight: 700; font-size: 1rem; color: var(--text-dark); }
.topbar-breadcrumb { font-size: 0.75rem; color: var(--text-light); display: flex; align-items: center; gap: 5px; margin-top: 1px; }
.topbar-breadcrumb span { color: var(--crimson); font-weight: 600; }
.content { padding: 28px 32px; flex: 1; }
.page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
.page-header h1 { font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 800; color: var(--text-dark); }
.page-header p { font-size: 0.82rem; color: var(--text-light); margin-top: 2px; }
.btn-tambah { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--crimson), var(--crimson-soft)); color: var(--white); padding: 10px 20px; border-radius: 10px; text-decoration: none; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 16px rgba(139,26,26,0.3); transition: transform var(--tr); }
.btn-tambah:hover { transform: translateY(-2px); }
.alert-success { background: #dcfce7; border: 1px solid #bbf7d0; color: #15803d; padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 8px; }
.card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; }
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; }
thead th { background: #faf5ef; padding: 12px 16px; text-align: left; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase; color: var(--text-mid); border-bottom: 1px solid #f0e8de; white-space: nowrap; }
tbody tr:hover { background: #fdf8f4; }
tbody td { padding: 13px 16px; font-size: 0.83rem; border-bottom: 1px solid #f7f1eb; vertical-align: middle; color: var(--text-dark); }
tbody tr:last-child td { border-bottom: none; }
.btn-edit { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 8px; background: #dbeafe; color: #1e40af; font-size: 0.75rem; font-weight: 600; text-decoration: none; }
.btn-edit:hover { background: #bfdbfe; }
.btn-delete { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 8px; background: #fee2e2; color: #b91c1c; font-size: 0.75rem; font-weight: 600; border: none; cursor: pointer; font-family: inherit; }
.btn-delete:hover { background: #fecaca; }
.action-group { display: flex; gap: 6px; }
.empty { text-align: center; padding: 40px; color: var(--text-light); }
.empty i { font-size: 2rem; opacity: .3; display: block; margin-bottom: 8px; }
</style>
</head>
<body>
<div class="wrapper">
<aside class="sidebar">
    <div class="sidebar-logo">
        <div><div class="sidebar-logo-name">PawonLokal</div><div class="sidebar-logo-sub">Admin Panel</div></div>
    </div>
    <div class="nav-section">Menu Utama</div>
    <nav>
        <a href="{{ url('/admin/dashboard') }}"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
        <a href="{{ url('/admin/produk') }}"><i class="fa-solid fa-box"></i> Produk</a>
        <a href="{{ url('/admin/pesanan') }}"><i class="fa-solid fa-clipboard-list"></i> Pesanan</a>
        <a href="{{ url('/admin/detail-pesanan') }}"><i class="fa-solid fa-list-check"></i> Detail Pesanan</a>
        <a href="{{ url('/admin/pembayaran') }}"><i class="fa-solid fa-credit-card"></i> Pembayaran</a>
        <a href="{{ url('/admin/pengiriman') }}" class="active"><i class="fa-solid fa-truck"></i> Pengiriman</a>
        <a href="{{ url('/admin/keranjang') }}"><i class="fa-solid fa-basket-shopping"></i> Keranjang</a>
        <a href="{{ url('/admin/review') }}"><i class="fa-solid fa-star"></i> Review</a>
        <a href="{{ url('/admin/users') }}"><i class="fa-solid fa-users"></i> Users</a>
    </nav>
    <div class="sidebar-foot">
        <a href="{{ url('/') }}" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Website</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="width:100%;background:none;border:none;cursor:pointer;display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;color:rgba(255,255,255,0.4);font-size:0.85rem;font-weight:500;font-family:inherit;">
                <i class="fa-solid fa-right-from-bracket" style="width:18px;text-align:center"></i> Logout
            </button>
        </form>
    </div>
</aside>
<div class="main">
    <div class="topbar">
        <div>
            <div class="topbar-title">Pengiriman</div>
            <div class="topbar-breadcrumb">Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i> <span>Pengiriman</span></div>
        </div>
    </div>
    <div class="content">
        <div class="page-header">
            <div>
                <h1>Daftar Pengiriman</h1>
                <p>Kelola semua data pengiriman PawonLokal</p>
            </div>
            <a href="{{ route('admin.pengiriman.create') }}" class="btn-tambah">
                <i class="fa-solid fa-plus"></i> Tambah Pengiriman
            </a>
        </div>

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

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
                    <tbody>
                        @forelse($pengiriman as $i => $pg)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td style="font-weight:600;">{{ $pg->id_pesanan }}</td>
                            <td>{{ $pg->nama_penerima }}</td>
                            <td>{{ $pg->no_hp }}</td>
                            <td>{{ $pg->kota }}</td>
                            <td>{{ $pg->kecamatan }}</td>
                            <td>{{ $pg->kode_pos }}</td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.pengiriman.edit', $pg->id_pengiriman) }}" class="btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.pengiriman.destroy', $pg->id_pengiriman) }}" method="POST" onsubmit="return confirm('Hapus data pengiriman ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8"><div class="empty"><i class="fa-solid fa-truck"></i><p>Belum ada data pengiriman</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>