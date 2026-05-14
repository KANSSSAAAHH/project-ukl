<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Produk – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-produk/create.css') }}">
</head>
<body>
<div class="wrapper">

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
        <a href="{{ url('/admin/produk') }}" class="active"><i class="fa-solid fa-box"></i> Produk</a>
        <a href="{{ url('/admin/pesanan') }}"><i class="fa-solid fa-clipboard-list"></i> Pesanan</a>
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
            <div class="topbar-title">Tambah Produk</div>
            <div class="topbar-breadcrumb">
                Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <a href="{{ url('/admin/produk') }}" style="color:var(--text-light);text-decoration:none;">Produk</a>
                <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <span>Tambah</span>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="page-header">
            <h1>Tambah Produk</h1>
            <p>Isi form berikut untuk menambah produk baru</p>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Produk --}}
                <div class="form-group">
                    <label>Nama Produk <span>*</span></label>
                    <input type="text" name="nama_produk" class="form-control"
                           value="{{ old('nama_produk') }}"
                           placeholder="Contoh: Kue Nastar" required>
                    @error('nama_produk') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    {{-- Kategori --}}
                    <div class="form-group">
                        <label>Kategori <span>*</span></label>
                        <select name="kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="kering" {{ old('kategori') == 'kering' ? 'selected' : '' }}>Kue Kering</option>
                            <option value="basah"  {{ old('kategori') == 'basah'  ? 'selected' : '' }}>Kue Basah</option>
                        </select>
                        @error('kategori') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="form-group">
                        <label>Harga <span>*</span></label>
                        <input type="number" name="harga" class="form-control"
                               value="{{ old('harga') }}"
                               placeholder="Contoh: 15000" min="0" required>
                        @error('harga') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label>Deskripsi <span>*</span></label>
                    <textarea name="deskripsi" class="form-control"
                              placeholder="Deskripsi produk..." required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    {{-- Status --}}
                    <div class="form-group">
                        <label>Status <span>*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif"    {{ old('status') == 'aktif'    ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    {{-- Foto --}}
                    <div class="form-group">
                        <label>Foto Produk <span>*</span></label>
                        <input type="file" name="foto" class="form-control" id="fotoInput"
                               accept="image/jpg,image/jpeg,image/png,image/gif"
                               required>
                        <img id="previewImg" class="preview-foto" src="#" alt="Preview">
                        @error('foto') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-simpan">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Produk
                    </button>
                    <a href="{{ route('admin.produk.index') }}" class="btn-batal">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

</div>
<script src="{{ asset('js/admin-produk/create.js') }}"></script>
</body>
</html>