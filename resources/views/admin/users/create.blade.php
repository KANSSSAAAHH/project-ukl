<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah User – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-user/create.css') }}">
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
        <a href="{{ url('/admin/keranjang') }}"><i class="fa-solid fa-basket-shopping"></i> Keranjang</a>
        <a href="{{ url('/admin/review') }}"><i class="fa-solid fa-star"></i> Review</a>
        <a href="{{ url('/admin/users') }}" class="active"><i class="fa-solid fa-users"></i> Users</a>
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
            <div class="topbar-title">Tambah User</div>
            <div class="topbar-breadcrumb">
                Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <a href="{{ url('/admin/users') }}" style="color:var(--text-light);text-decoration:none;">Users</a>
                <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <span>Tambah</span>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="page-header">
            <h1>Tambah User</h1>
            <p>Isi form berikut untuk menambah user baru</p>
        </div>
        <div class="form-card">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama <span>*</span></label>
                        <input type="text" name="nama" class="form-control"
                               value="{{ old('nama') }}" placeholder="Nama lengkap" required>
                        @error('nama') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>No HP <span>*</span></label>
                        <input type="text" name="no_hp" class="form-control" id="noHpInput"
                               value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required>
                        @error('no_hp') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Email <span>*</span></label>
                    <input type="email" name="email" class="form-control" id="emailInput"
                           value="{{ old('email') }}" placeholder="contoh@email.com" required>
                    @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Role <span>*</span></label>
                    <select name="role" class="form-control" required>
                        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                        <option value="admin"    {{ old('role') == 'admin'    ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Password <span>*</span></label>
                        <input type="password" name="password" class="form-control" id="passwordInput"
                               placeholder="Min. 6 karakter" required>
                        @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password <span>*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" id="confirmInput"
                               placeholder="Ulangi password" required>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-simpan">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn-batal">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('js/admin-user/create.js') }}"></script>
</body>
</html>