<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Review – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-review/create.css') }}">
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
        <a href="{{ url('/admin/review') }}" class="active"><i class="fa-solid fa-star"></i> Review</a>
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
            <div class="topbar-title">Tambah Review</div>
            <div class="topbar-breadcrumb">
                Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <a href="{{ url('/admin/review') }}" style="color:var(--text-light);text-decoration:none;">Review</a>
                <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <span>Tambah</span>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="page-header">
            <h1>Tambah Review</h1>
            <p>Isi form berikut untuk menambah review baru</p>
        </div>
        <div class="form-card">
            <form action="{{ route('admin.review.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label>User / Pelanggan <span>*</span></label>
                        <select name="id_user" class="form-control" required>
                            <option value="">-- Pilih User --</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id_user }}" {{ old('id_user') == $u->id_user ? 'selected' : '' }}>
                                    {{ $u->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_user') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Produk <span>*</span></label>
                        <select name="id_produk" class="form-control" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach($produk as $p)
                                <option value="{{ $p->id_produk }}" {{ old('id_produk') == $p->id_produk ? 'selected' : '' }}>
                                    {{ $p->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_produk') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Rating <span>*</span></label>
                    <div class="star-rating">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}"
                                {{ old('rating') == $i ? 'checked' : '' }}>
                            <label for="star{{ $i }}"><i class="fa-solid fa-star"></i></label>
                        @endfor
                    </div>
                    <div class="rating-hint">Pilih 1–5 bintang</div>
                    @error('rating') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Komentar <span>*</span></label>
                    <textarea name="komentar" class="form-control" id="komentarInput"
                              placeholder="Tulis komentar ulasan..." required>{{ old('komentar') }}</textarea>
                    @error('komentar') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-simpan">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Review
                    </button>
                    <a href="{{ route('admin.review.index') }}" class="btn-batal">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('js/admin-review/create.js') }}"></script>
</body>
</html>