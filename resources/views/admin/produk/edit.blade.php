<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Produk – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-produk/edit.css') }}">
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
            <div class="topbar-title">Edit Produk</div>
            <div class="topbar-breadcrumb">
                Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <a href="{{ url('/admin/produk') }}" style="color:var(--text-light);text-decoration:none;">Produk</a>
                <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <span>Edit</span>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="page-header">
            <h1>Edit Produk</h1>
            <p>Ubah data produk yang sudah ada</p>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Nama Produk <span>*</span></label>
                    <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                    @error('nama_produk') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori <span>*</span></label>
                        <select name="kategori" class="form-control" required>
                            <option value="kering" {{ old('kategori', $produk->kategori) == 'kering' ? 'selected' : '' }}>Kue Kering</option>
                            <option value="basah"  {{ old('kategori', $produk->kategori) == 'basah'  ? 'selected' : '' }}>Kue Basah</option>
                        </select>
                        @error('kategori') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Harga <span>*</span></label>
                        <input type="number" name="harga" class="form-control" value="{{ old('harga', $produk->harga) }}" min="0" required>
                        @error('harga') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi <span>*</span></label>
                    <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    @error('deskripsi') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Status <span>*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="aktif"    {{ old('status', $produk->status) == 'aktif'    ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $produk->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Foto Produk</label>
                        @if($produk->foto)
                            <p class="foto-label">Foto saat ini:</p>
                            <img class="foto-current" src="{{ asset('storage/'.$produk->foto) }}" alt="Foto produk" onerror="this.style.display='none'">
                        @endif
                        <input type="file" name="foto" class="form-control" id="fotoInput" accept="image/*">
                        <img id="previewImg" class="preview-foto" src="#" alt="Preview baru">
                        @error('foto') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-simpan">
                        <i class="fa-solid fa-floppy-disk"></i> Update Produk
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
<script src="{{ asset('js/admin-produk/edit.js') }}"></script>
</body>
</html>