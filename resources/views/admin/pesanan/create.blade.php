<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Pesanan – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-pesanan/create.css') }}">
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
        <a href="{{ url('/admin/pesanan') }}" class="active"><i class="fa-solid fa-clipboard-list"></i> Pesanan</a>
        <a href="{{ url('/admin/detail-pesanan') }}"><i class="fa-solid fa-list-check"></i> Detail Pesanan</a>
        <a href="{{ url('/admin/pembayaran') }}"><i class="fa-solid fa-credit-card"></i> Pembayaran</a>
        <a href="{{ url('/admin/pengiriman') }}"><i class="fa-solid fa-truck"></i> Pengiriman</a>
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
            <div class="topbar-title">Tambah Pesanan</div>
            <div class="topbar-breadcrumb">
                Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <a href="{{ url('/admin/pesanan') }}" style="color:var(--text-light);text-decoration:none;">Pesanan</a>
                <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <span>Tambah</span>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="page-header">
            <h1>Tambah Pesanan</h1>
            <p>Isi form berikut untuk menambah pesanan baru</p>
        </div>
        <div class="form-card">
            <form action="{{ route('admin.pesanan.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>User / Pelanggan <span>*</span></label>
                    <select name="id_user" class="form-control" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id_user }}" {{ old('id_user') == $u->id_user ? 'selected' : '' }}>
                                {{ $u->nama }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_user') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Pesanan <span>*</span></label>
                        <input type="date" name="tanggal_pesanan" class="form-control"
                               value="{{ old('tanggal_pesanan', date('Y-m-d')) }}" required>
                        @error('tanggal_pesanan') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Total Harga <span>*</span></label>
                        <input type="number" name="total_harga" class="form-control"
                               value="{{ old('total_harga') }}" placeholder="Contoh: 50000" min="0" required>
                        @error('total_harga') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Status Pesanan <span>*</span></label>
                    <select name="status_pesanan" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="menunggu"  {{ old('status_pesanan') == 'menunggu'  ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses"  {{ old('status_pesanan') == 'diproses'  ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai"   {{ old('status_pesanan') == 'selesai'   ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status_pesanan') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-simpan">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Pesanan
                    </button>
                    <a href="{{ route('admin.pesanan.index') }}" class="btn-batal">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('js/admin-pesanan/create.js') }}"></script>
</body>
</html>