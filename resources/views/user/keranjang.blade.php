<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Keranjang – PawonLokal</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
    --crimson: #8B1A1A; --crimson-soft: #B22222;
    --gold: #C9923A; --gold-light: #E8B86D;
    --cream: #FDF6ED; --cream-dark: #F5E6CC;
    --brown: #3D1C00; --text-dark: #1E0A00;
    --text-mid: #5C3317; --text-light: #9E7650; --white: #FFFFFF;
    --shadow-warm: 0 8px 40px rgba(139,26,26,0.15);
    --radius: 16px; --transition: 0.3s cubic-bezier(0.4,0,0.2,1);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Plus Jakarta Sans', sans-serif; background: linear-gradient(135deg, #fdf8ee, #f9f0d8, #f9f3e2); color: var(--text-dark); min-height: 100vh; }

nav { position: fixed; top: 0; left: 0; right: 0; z-index: 1000; padding: 0 40px; height: 72px; display: flex; align-items: center; justify-content: space-between; background: rgba(255,255,255,0.97); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(139,26,26,0.15); }
.nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
.nav-logo img { height: 44px; object-fit: contain; }
.nav-logo span { font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 800; color: var(--crimson); }
.nav-links { display: flex; align-items: center; gap: 8px; list-style: none; }
.nav-links a { text-decoration: none; color: var(--text-mid); font-weight: 500; font-size: 0.92rem; padding: 8px 16px; border-radius: 50px; transition: color var(--transition), background var(--transition); }
.nav-links a:hover { color: var(--crimson); background: rgba(139,26,26,0.08); }
.nav-cta { background: var(--crimson) !important; color: var(--white) !important; padding: 10px 22px !important; border-radius: 50px !important; font-weight: 600 !important; border: none; cursor: pointer; font-family: inherit; }

.page { padding: 100px 40px 60px; max-width: 900px; margin: 0 auto; }
.page-title { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 800; color: var(--text-dark); margin-bottom: 8px; }
.page-sub { color: var(--text-light); font-size: 0.92rem; margin-bottom: 32px; }

.alert { padding: 12px 18px; border-radius: 10px; font-size: 0.88rem; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
.alert-success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
.alert-error { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

.keranjang-list { display: flex; flex-direction: column; gap: 16px; margin-bottom: 32px; }
.keranjang-item { background: var(--white); border-radius: var(--radius); padding: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 20px rgba(139,26,26,0.08); }
.keranjang-img { width: 80px; height: 80px; border-radius: 12px; object-fit: cover; flex-shrink: 0; background: var(--cream-dark); }
.keranjang-img-placeholder { width: 80px; height: 80px; border-radius: 12px; background: var(--cream-dark); display: flex; align-items: center; justify-content: center; color: var(--gold); font-size: 1.8rem; flex-shrink: 0; }
.keranjang-info { flex: 1; }
.keranjang-nama { font-weight: 700; font-size: 1rem; color: var(--text-dark); margin-bottom: 4px; }
.keranjang-harga { color: var(--crimson); font-weight: 600; font-size: 0.9rem; margin-bottom: 4px; }
.keranjang-jumlah { color: var(--text-light); font-size: 0.85rem; }
.keranjang-subtotal { font-family: 'Playfair Display', serif; font-weight: 800; color: var(--crimson); font-size: 1.1rem; margin-right: 16px; }
.btn-hapus { background: #fee2e2; color: #b91c1c; border: none; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background var(--transition); flex-shrink: 0; }
.btn-hapus:hover { background: #b91c1c; color: var(--white); }

.keranjang-summary { background: var(--white); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-warm); }
.summary-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid rgba(201,146,58,0.15); font-size: 0.92rem; color: var(--text-mid); }
.summary-row:last-of-type { border-bottom: none; }
.summary-total { font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 800; color: var(--crimson); }
.summary-actions { display: flex; gap: 12px; margin-top: 20px; flex-wrap: wrap; }
.btn-checkout { display: inline-flex; align-items: center; gap: 9px; background: linear-gradient(135deg, var(--crimson), var(--crimson-soft)); color: var(--white); padding: 14px 28px; border-radius: 50px; font-family: inherit; font-size: 0.95rem; font-weight: 600; border: none; cursor: pointer; box-shadow: 0 6px 24px rgba(139,26,26,0.3); text-decoration: none; transition: transform var(--transition); }
.btn-checkout:hover { transform: translateY(-2px); }
.btn-lanjut { display: inline-flex; align-items: center; gap: 8px; background: transparent; color: var(--crimson); padding: 14px 28px; border-radius: 50px; font-family: inherit; font-size: 0.95rem; font-weight: 600; border: 2px solid var(--crimson); text-decoration: none; transition: background var(--transition), color var(--transition); }
.btn-lanjut:hover { background: var(--crimson); color: var(--white); }

.empty-state { text-align: center; padding: 80px 20px; color: var(--text-light); }
.empty-state i { font-size: 4rem; margin-bottom: 16px; display: block; color: var(--gold-light); }
.empty-state h3 { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--text-dark); margin-bottom: 8px; }

@media (max-width: 768px) {
    nav { padding: 0 20px; }
    .page { padding: 90px 20px 40px; }
    .keranjang-item { flex-wrap: wrap; }
}
</style>
</head>
<body>

<nav>
    <a href="{{ url('/user/home') }}" class="nav-logo">
        <img src="{{ asset('images/LogoPL.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ url('/user/home') }}">Home</a></li>
        <li><a href="{{ url('/produk') }}">Produk</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="nav-cta">Logout</button>
            </form>
        </li>
    </ul>
</nav>

<div class="page">
    <h1 class="page-title">Keranjang Belanja</h1>
    <p class="page-sub">{{ $keranjang->count() }} produk dalam keranjangmu</p>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    @if($keranjang->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-basket-shopping"></i>
            <h3>Keranjangmu masih kosong</h3>
            <p style="margin-bottom:24px;">Yuk, pilih kue tradisional favoritmu!</p>
            <a href="{{ url('/produk') }}" class="btn-checkout">
                <i class="fa-solid fa-store"></i> Lihat Produk
            </a>
        </div>
    @else
        <div class="keranjang-list">
            @foreach($keranjang as $item)
            <div class="keranjang-item">
                @if($item->produk->foto)
                    <img class="keranjang-img"
                         src="{{ asset('storage/' . $item->produk->foto) }}"
                         alt="{{ $item->produk->nama_produk }}"
                         onerror="this.outerHTML='<div class=keranjang-img-placeholder><i class=fa-solid fa-cookie></i></div>'">
                @else
                    <div class="keranjang-img-placeholder">
                        <i class="fa-solid fa-cookie"></i>
                    </div>
                @endif

                <div class="keranjang-info">
                    <div class="keranjang-nama">{{ $item->produk->nama_produk }}</div>
                    <div class="keranjang-harga">Rp {{ number_format($item->produk->harga, 0, ',', '.') }} / pcs</div>
                    <div class="keranjang-jumlah">Jumlah: {{ $item->jumlah_produk }} pcs</div>
                </div>

                <div class="keranjang-subtotal">
                    Rp {{ number_format($item->produk->harga * $item->jumlah_produk, 0, ',', '.') }}
                </div>

                <form action="{{ route('keranjang.hapus', $item->id_keranjang) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-hapus" title="Hapus">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
            @endforeach
        </div>

        <div class="keranjang-summary">
            <div class="summary-row">
                <span>Subtotal ({{ $keranjang->count() }} produk)</span>
                <span class="summary-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="summary-actions">
                <a href="{{ url('/produk') }}" class="btn-lanjut">
                    <i class="fa-solid fa-arrow-left"></i> Lanjut Belanja
                </a>
                {{-- Nanti bisa diarahkan ke checkout --}}
                <a href="{{ route('checkout.index') }}" class="btn-checkout">
                    <i class="fa-solid fa-bag-shopping"></i> Checkout
                </a>
            </div>
        </div>
    @endif
</div>

</body>
</html>