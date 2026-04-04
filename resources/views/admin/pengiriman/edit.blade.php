<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Pengiriman – PawonLokal</title>
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
.page-header { margin-bottom: 24px; }
.page-header h1 { font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 800; color: var(--text-dark); }
.page-header p { font-size: 0.82rem; color: var(--text-light); margin-top: 2px; }
.form-card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); padding: 32px; max-width: 700px; }
.form-group { margin-bottom: 20px; }
.form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: var(--text-dark); margin-bottom: 6px; }
.form-group label span { color: var(--crimson); }
.form-control { width: 100%; padding: 10px 14px; border: 1.5px solid #e8d8c4; border-radius: 10px; font-size: 0.88rem; font-family: inherit; color: var(--text-dark); background: var(--cream); transition: border-color var(--tr); outline: none; }
.form-control:focus { border-color: var(--crimson); background: var(--white); }
select.form-control { cursor: pointer; }
textarea.form-control { resize: vertical; min-height: 80px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.error-msg { font-size: 0.75rem; color: var(--crimson); margin-top: 4px; }
.btn-group { display: flex; gap: 12px; margin-top: 28px; }
.btn-simpan { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--crimson), var(--crimson-soft)); color: var(--white); padding: 11px 24px; border-radius: 10px; font-size: 0.88rem; font-weight: 600; border: none; cursor: pointer; font-family: inherit; box-shadow: 0 4px 16px rgba(139,26,26,0.3); transition: transform var(--tr); }
.btn-simpan:hover { transform: translateY(-2px); }
.btn-batal { display: inline-flex; align-items: center; gap: 8px; background: #f5ece0; color: var(--text-mid); padding: 11px 24px; border-radius: 10px; font-size: 0.88rem; font-weight: 600; text-decoration: none; }
.btn-batal:hover { background: var(--cream-dark); }
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
</body>
</html>