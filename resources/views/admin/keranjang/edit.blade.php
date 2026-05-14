<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Keranjang – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-keranjang/edit.css') }}">
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
        <a href="{{ url('/admin/pengiriman') }}"><i class="fa-solid fa-truck"></i> Pengiriman</a>
        <a href="{{ url('/admin/keranjang') }}" class="active"><i class="fa-solid fa-basket-shopping"></i> Keranjang</a>
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
            <div class="topbar-title">Edit Keranjang</div>
            <div class="topbar-breadcrumb">
                Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <a href="{{ url('/admin/keranjang') }}" style="color:var(--text-light);text-decoration:none;">Keranjang</a>
                <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <span>Edit</span>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="page-header">
            <h1>Edit Item Keranjang</h1>
            <p>Ubah jumlah produk pada keranjang ini</p>
        </div>
        <div class="form-card">
            <form action="{{ route('admin.keranjang.update', $keranjang->id_keranjang) }}" method="POST">
                @csrf @method('PUT')

                {{-- User — readonly, tidak bisa diubah --}}
                <div class="form-group">
                    <label>User</label>
                    <input type="text" class="form-control" value="{{ $keranjang->user->nama ?? '-' }} ({{ $keranjang->user->email ?? '' }})" disabled>
                    <div class="hint">User tidak dapat diubah</div>
                </div>

                {{-- Produk — readonly, tidak bisa diubah --}}
                <div class="form-group">
                    <label>Produk</label>
                    <input type="text" class="form-control" value="{{ $keranjang->produk->nama_produk ?? '-' }} – Rp {{ number_format($keranjang->produk->harga ?? 0, 0, ',', '.') }}" disabled>
                    <div class="hint">Produk tidak dapat diubah</div>
                </div>

                {{-- Jumlah — bisa diubah --}}
                <div class="form-group">
                    <label>Jumlah <span>*</span></label>
                    <input type="number" name="jumlah_produk" class="form-control"
                           value="{{ old('jumlah_produk', $keranjang->jumlah_produk) }}" min="1" required>
                    @error('jumlah_produk') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-simpan">
                        <i class="fa-solid fa-floppy-disk"></i> Update
                    </button>
                    <a href="{{ route('admin.keranjang.index') }}" class="btn-batal">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('js/admin-keranjang/edit.js') }}"></script>
</body>
</html>