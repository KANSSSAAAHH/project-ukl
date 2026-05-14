<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Pengiriman – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-pengiriman/edit.css') }}">
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
            <div class="topbar-title">Edit Pengiriman</div>
            <div class="topbar-breadcrumb">
                Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <a href="{{ url('/admin/pengiriman') }}" style="color:var(--text-light);text-decoration:none;">Pengiriman</a>
                <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <span>Edit</span>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="page-header">
            <h1>Edit Pengiriman</h1>
            <p>Ubah data pengiriman #{{ $pengiriman->id_pengiriman }}</p>
        </div>
        <div class="form-card">
            <form action="{{ route('admin.pengiriman.update', $pengiriman->id_pengiriman) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Pesanan <span>*</span></label>
                    <select name="id_pesanan" class="form-control" required>
                        <option value="">-- Pilih Pesanan --</option>
                        @foreach($pesanan as $p)
                            <option value="{{ $p->id_pesanan }}" {{ old('id_pesanan', $pengiriman->id_pesanan) == $p->id_pesanan ? 'selected' : '' }}>
                                #{{ $p->id_pesanan }} - {{ $p->user->nama ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pesanan') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Penerima <span>*</span></label>
                        <input type="text" name="nama_penerima" class="form-control" value="{{ old('nama_penerima', $pengiriman->nama_penerima) }}" required>
                        @error('nama_penerima') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>No HP <span>*</span></label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pengiriman->no_hp) }}" required>
                        @error('no_hp') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap <span>*</span></label>
                    <textarea name="alamat_lengkap" class="form-control" required>{{ old('alamat_lengkap', $pengiriman->alamat_lengkap) }}</textarea>
                    @error('alamat_lengkap') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kota <span>*</span></label>
                        <input type="text" name="kota" class="form-control" value="{{ old('kota', $pengiriman->kota) }}" required>
                        @error('kota') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Kecamatan <span>*</span></label>
                        <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $pengiriman->kecamatan) }}" required>
                        @error('kecamatan') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Kode Pos <span>*</span></label>
                    <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos', $pengiriman->kode_pos) }}" required style="max-width:200px;">
                    @error('kode_pos') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-simpan">
                        <i class="fa-solid fa-floppy-disk"></i> Update Pengiriman
                    </button>
                    <a href="{{ route('admin.pengiriman.index') }}" class="btn-batal">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('js/admin-pengiriman/edit.js') }}"></script>
</body>
</html>