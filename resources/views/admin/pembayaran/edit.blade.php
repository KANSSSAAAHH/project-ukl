<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Pembayaran – PawonLokal</title>
<link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin-pembayaran/edit.css') }}">
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
        <a href="{{ url('/admin/pembayaran') }}" class="active"><i class="fa-solid fa-credit-card"></i> Pembayaran</a>
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
            <div class="topbar-title">Edit Pembayaran</div>
            <div class="topbar-breadcrumb">
                Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <a href="{{ url('/admin/pembayaran') }}" style="color:var(--text-light);text-decoration:none;">Pembayaran</a>
                <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                <span>Edit</span>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="page-header">
            <h1>Edit Pembayaran</h1>
            <p>Ubah data pembayaran #{{ $pembayaran->id_pembayaran }}</p>
        </div>
        <div class="form-card">
            <form action="{{ route('admin.pembayaran.update', $pembayaran->id_pembayaran) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Pesanan <span>*</span></label>
                    <select name="id_pesanan" class="form-control" required>
                        <option value="">-- Pilih Pesanan --</option>
                        @foreach($pesanan as $p)
                            <option value="{{ $p->id_pesanan }}" {{ old('id_pesanan', $pembayaran->id_pesanan) == $p->id_pesanan ? 'selected' : '' }}>
                                #{{ $p->id_pesanan }} - {{ $p->user->nama ?? '-' }} (Rp {{ number_format($p->total_harga,0,',','.') }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_pesanan') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Metode Pembayaran <span>*</span></label>
                    <select name="metode" class="form-control" required>
                        <option value="Transfer Bank" {{ old('metode', $pembayaran->metode) == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="GoPay" {{ old('metode', $pembayaran->metode) == 'GoPay' ? 'selected' : '' }}>GoPay</option>
                        <option value="OVO" {{ old('metode', $pembayaran->metode) == 'OVO' ? 'selected' : '' }}>OVO</option>
                        <option value="Dana" {{ old('metode', $pembayaran->metode) == 'Dana' ? 'selected' : '' }}>Dana</option>
                        <option value="COD" {{ old('metode', $pembayaran->metode) == 'COD' ? 'selected' : '' }}>COD</option>
                    </select>
                    @error('metode') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Status <span>*</span></label>
                    <select name="status" class="form-control" required>
                        <option value="lunas"   {{ old('status', $pembayaran->status) == 'lunas'   ? 'selected' : '' }}>Lunas</option>
                        <option value="belum"   {{ old('status', $pembayaran->status) == 'belum'   ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="pending" {{ old('status', $pembayaran->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                    @error('status') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Bukti Bayar</label>
                    @if($pembayaran->bukti_bayar)
                        <p style="font-size:0.75rem;color:var(--text-light);margin-bottom:6px;">Bukti saat ini:</p>
                        <img class="foto-current" src="{{ asset('storage/'.$pembayaran->bukti_bayar) }}" alt="Bukti" onerror="this.style.display='none'">
                    @endif
                    <input type="file" name="bukti_bayar" class="form-control" accept="image/*" id="buktiBayarInput">
                    <img id="previewImg" class="preview-foto" src="#" alt="Preview baru">
                    @error('bukti_bayar') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-simpan">
                        <i class="fa-solid fa-floppy-disk"></i> Update Pembayaran
                    </button>
                    <a href="{{ route('admin.pembayaran.index') }}" class="btn-batal">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('js/admin-pembayaran/edit.js') }}"></script>
</body>
</html>