<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $produk->nama_produk }} – PawonLokal</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
    --crimson: #8B1A1A; --crimson-deep: #5C0D0D; --crimson-soft: #B22222;
    --gold: #C9923A; --gold-light: #E8B86D;
    --cream: #FDF6ED; --cream-dark: #F5E6CC;
    --brown: #3D1C00; --text-dark: #1E0A00;
    --text-mid: #5C3317; --text-light: #9E7650; --white: #FFFFFF;
    --shadow-warm: 0 8px 40px rgba(139,26,26,0.15);
    --radius: 16px; --transition: 0.3s cubic-bezier(0.4,0,0.2,1);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--cream); color: var(--text-dark); }

/* NAVBAR */
nav { position: fixed; top: 0; left: 0; right: 0; z-index: 1000; padding: 0 40px; height: 72px; display: flex; align-items: center; justify-content: space-between; background: rgba(253,246,237,0.92); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(201,146,58,0.2); transition: box-shadow var(--transition); }
nav.scrolled { box-shadow: 0 4px 30px rgba(139,26,26,0.12); }
.nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
.nav-logo img { height: 44px; object-fit: contain; }
.nav-logo span { font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 800; color: var(--crimson); }
.nav-links { display: flex; align-items: center; gap: 8px; list-style: none; }
.nav-links a { text-decoration: none; color: var(--text-mid); font-weight: 500; font-size: 0.92rem; padding: 8px 16px; border-radius: 50px; transition: color var(--transition), background var(--transition); }
.nav-links a:hover, .nav-links a.active { color: var(--crimson); background: rgba(139,26,26,0.08); }
.nav-cta { background: var(--crimson) !important; color: var(--white) !important; padding: 10px 22px !important; border-radius: 50px !important; font-weight: 600 !important; }
.cart-btn { position: relative; background: rgba(139,26,26,0.08); color: var(--crimson); border: none; cursor: pointer; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; text-decoration: none; transition: background var(--transition); }
.cart-badge { position: absolute; top: -4px; right: -4px; background: var(--crimson); color: var(--white); font-size: 0.6rem; font-weight: 700; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
.hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; background: none; border: none; padding: 8px; }
.hamburger span { display: block; width: 24px; height: 2px; background: var(--crimson); border-radius: 2px; }
.mobile-menu { display: none; position: fixed; top: 72px; left: 0; right: 0; background: rgba(253,246,237,0.98); z-index: 999; padding: 20px 24px; border-bottom: 1px solid rgba(201,146,58,0.2); }
.mobile-menu.open { display: block; }
.mobile-menu a { display: block; text-decoration: none; color: var(--text-mid); font-weight: 500; padding: 14px 0; border-bottom: 1px solid rgba(201,146,58,0.15); }

/* CONTENT */
.page-content { padding-top: 72px; min-height: 100vh; }

/* BREADCRUMB */
.breadcrumb-bar { background: var(--white); border-bottom: 1px solid rgba(201,146,58,0.15); padding: 14px 40px; }
.breadcrumb-inner { max-width: 1100px; margin: 0 auto; display: flex; align-items: center; gap: 8px; font-size: 0.82rem; color: var(--text-light); }
.breadcrumb-inner a { color: var(--text-light); text-decoration: none; transition: color var(--transition); }
.breadcrumb-inner a:hover { color: var(--crimson); }
.breadcrumb-inner span { color: var(--crimson); font-weight: 600; }

/* DETAIL PRODUK */
.detail-section { max-width: 1100px; margin: 0 auto; padding: 48px 40px; }
.detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start; }

/* FOTO */
.detail-foto-wrap { position: relative; }
.detail-foto {
    width: 100%; aspect-ratio: 1; border-radius: 24px;
    object-fit: cover; box-shadow: var(--shadow-warm);
    background: linear-gradient(135deg, #f5ece0, #e8d8c0);
    display: block;
}
.detail-foto-placeholder {
    width: 100%; aspect-ratio: 1; border-radius: 24px;
    background: linear-gradient(135deg, #f5ece0, #e8d8c0);
    display: flex; align-items: center; justify-content: center;
    color: #c8a06a; font-size: 5rem;
    box-shadow: var(--shadow-warm);
}
.detail-foto-tag {
    position: absolute; top: 16px; left: 16px;
    background: rgba(255,255,255,0.92); backdrop-filter: blur(8px);
    color: var(--crimson); font-size: 0.75rem; font-weight: 700;
    letter-spacing: 0.08em; text-transform: uppercase;
    padding: 6px 14px; border-radius: 50px;
}

/* INFO */
.detail-info { }
.detail-kategori {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(201,146,58,0.12); color: var(--gold);
    font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; padding: 5px 12px; border-radius: 50px;
    margin-bottom: 16px;
}
.detail-nama {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 800;
    color: var(--text-dark); line-height: 1.2; margin-bottom: 16px;
}
.detail-harga {
    font-family: 'Playfair Display', serif;
    font-size: 2rem; font-weight: 800; color: var(--crimson);
    margin-bottom: 20px;
}
.detail-status {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 24px;
    padding: 8px 16px; border-radius: 50px;
}
.detail-status.aktif { background: #dcfce7; color: #15803d; }
.detail-status.nonaktif { background: #fee2e2; color: #b91c1c; }

.detail-divider { height: 1px; background: rgba(201,146,58,0.2); margin: 24px 0; }

.detail-deskripsi-label { font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-light); margin-bottom: 10px; }
.detail-deskripsi { color: var(--text-mid); font-size: 0.97rem; line-height: 1.8; margin-bottom: 32px; }

/* JUMLAH */
.jumlah-wrap { display: flex; align-items: center; gap: 16px; margin-bottom: 24px; }
.jumlah-label { font-size: 0.85rem; font-weight: 600; color: var(--text-dark); }
.jumlah-ctrl { display: flex; align-items: center; gap: 0; background: var(--cream-dark); border-radius: 50px; overflow: hidden; }
.jumlah-btn {
    width: 40px; height: 40px; border: none; background: transparent;
    color: var(--text-mid); font-size: 1.1rem; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: background var(--transition), color var(--transition);
}
.jumlah-btn:hover { background: var(--crimson); color: var(--white); }
.jumlah-val { min-width: 40px; text-align: center; font-weight: 700; font-size: 1rem; color: var(--text-dark); }

/* TOMBOL */
.btn-group-detail { display: flex; gap: 12px; flex-wrap: wrap; }
.btn-keranjang {
    display: inline-flex; align-items: center; gap: 9px;
    background: linear-gradient(135deg, var(--crimson), var(--crimson-soft));
    color: var(--white); padding: 14px 28px; border-radius: 50px;
    font-family: inherit; font-size: 0.95rem; font-weight: 600;
    border: none; cursor: pointer;
    box-shadow: 0 6px 24px rgba(139,26,26,0.3);
    transition: transform var(--transition), box-shadow var(--transition);
    text-decoration: none;
}
.btn-keranjang:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(139,26,26,0.4); }
.btn-keranjang:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
.btn-kembali {
    display: inline-flex; align-items: center; gap: 8px;
    background: transparent; color: var(--crimson);
    padding: 14px 28px; border-radius: 50px;
    font-family: inherit; font-size: 0.95rem; font-weight: 600;
    border: 2px solid var(--crimson); text-decoration: none;
    transition: background var(--transition), color var(--transition);
}
.btn-kembali:hover { background: var(--crimson); color: var(--white); }

/* ALERT */
.alert { padding: 12px 18px; border-radius: 10px; font-size: 0.88rem; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
.alert-success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
.alert-error { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

/* FOOTER */
footer { background: var(--brown); color: rgba(255,255,255,0.7); padding: 48px 40px 28px; margin-top: 60px; }
.footer-bottom { max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; font-size: 0.82rem; flex-wrap: wrap; gap: 8px; }
.footer-bottom a { color: var(--gold-light); text-decoration: none; }

@media (max-width: 768px) {
    nav { padding: 0 20px; }
    .nav-links { display: none; }
    .hamburger { display: flex; }
    .breadcrumb-bar { padding: 12px 20px; }
    .detail-section { padding: 28px 20px; }
    .detail-grid { grid-template-columns: 1fr; gap: 32px; }
    footer { padding: 32px 20px 20px; }
}
</style>
</head>
<body>

{{-- NAVBAR --}}
<nav id="navbar">
    <a href="{{ url('/') }}" class="nav-logo">
        <img src="{{ asset('images/Logo.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
        <li><a href="{{ url('/produk') }}" class="active">Produk</a></li>
        <li><a href="{{ url('/kontak') }}">Kontak</a></li>
        @auth
            <li>
                <a href="{{ url('/keranjang') }}" class="cart-btn">
                    <i class="fa-solid fa-basket-shopping"></i>
                    @php $jumlahKeranjang = \App\Models\Keranjang::where('id_user', auth()->id())->count(); @endphp
                    @if($jumlahKeranjang > 0)
                        <span class="cart-badge">{{ $jumlahKeranjang }}</span>
                    @endif
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="nav-cta" style="cursor:pointer;font-family:inherit;border:none;">Keluar</button>
                </form>
            </li>
        @else
            <li><a href="{{ url('/login') }}" class="nav-cta">Login</a></li>
        @endauth
    </ul>
    <button class="hamburger" id="hamburgerBtn"><span></span><span></span><span></span></button>
</nav>

<div class="mobile-menu" id="mobileMenu">
    <a href="{{ url('/') }}">Home</a>
    <a href="{{ url('/about') }}">Tentang Kami</a>
    <a href="{{ url('/produk') }}" style="color:var(--crimson);font-weight:700">Produk</a>
    <a href="{{ url('/kontak') }}">Kontak</a>
</div>

<div class="page-content">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb-bar">
        <div class="breadcrumb-inner">
            <a href="{{ url('/') }}">Home</a>
            <i class="fa-solid fa-chevron-right" style="font-size:0.6rem"></i>
            <a href="{{ url('/produk') }}">Produk</a>
            <i class="fa-solid fa-chevron-right" style="font-size:0.6rem"></i>
            <span>{{ $produk->nama_produk }}</span>
        </div>
    </div>

    {{-- DETAIL --}}
    <div class="detail-section">

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

        <div class="detail-grid">

            {{-- FOTO --}}
            <div class="detail-foto-wrap">
                @if($produk->foto)
                    <img class="detail-foto"
                         src="{{ asset('storage/' . $produk->foto) }}"
                         alt="{{ $produk->nama_produk }}"
                         onerror="this.outerHTML='<div class=detail-foto-placeholder><i class=fa-solid fa-cookie></i></div>'">
                @else
                    <div class="detail-foto-placeholder">
                        <i class="fa-solid fa-cookie"></i>
                    </div>
                @endif
                <div class="detail-foto-tag">{{ $produk->kategori }}</div>
            </div>

            {{-- INFO --}}
            <div class="detail-info">
                <div class="detail-kategori">
                    <i class="fa-solid fa-{{ $produk->kategori == 'basah' ? 'droplet' : 'cookie-bite' }}"></i>
                    Kue {{ ucfirst($produk->kategori) }}
                </div>

                <h1 class="detail-nama">{{ $produk->nama_produk }}</h1>

                <div class="detail-harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>

                <div class="detail-status {{ $produk->status }}">
                    @if($produk->status === 'aktif')
                        <i class="fa-solid fa-circle-check"></i> Stok Tersedia
                    @else
                        <i class="fa-solid fa-circle-xmark"></i> Stok Habis
                    @endif
                </div>

                <div class="detail-divider"></div>

                <div class="detail-deskripsi-label">Deskripsi Produk</div>
                <div class="detail-deskripsi">{{ $produk->deskripsi }}</div>

                @if($produk->status === 'aktif')
                    @auth
                    {{-- FORM TAMBAH KERANJANG --}}
                    <form action="{{ url('/keranjang/tambah') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

                        <div class="jumlah-wrap">
                            <span class="jumlah-label">Jumlah</span>
                            <div class="jumlah-ctrl">
                                <button type="button" class="jumlah-btn" onclick="kurang()">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <div class="jumlah-val" id="jumlahVal">1</div>
                                <input type="hidden" name="jumlah_produk" id="jumlahInput" value="1">
                                <button type="button" class="jumlah-btn" onclick="tambah()">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="btn-group-detail">
                            <button type="submit" class="btn-keranjang">
                                <i class="fa-solid fa-basket-shopping"></i> Tambah ke Keranjang
                            </button>
                            <a href="{{ url('/produk') }}" class="btn-kembali">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                    @else
                    <div class="btn-group-detail">
                        <a href="{{ url('/login') }}" class="btn-keranjang">
                            <i class="fa-solid fa-right-to-bracket"></i> Login untuk Beli
                        </a>
                        <a href="{{ url('/produk') }}" class="btn-kembali">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    @endauth
                @else
                    <div class="btn-group-detail">
                        <button class="btn-keranjang" disabled>
                            <i class="fa-solid fa-xmark"></i> Stok Habis
                        </button>
                        <a href="{{ url('/produk') }}" class="btn-kembali">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} <a href="{{ url('/') }}">PawonLokal</a>. Hak cipta dilindungi.</p>
        <p>Dibuat dengan <i class="fa-solid fa-heart" style="color:var(--crimson)"></i> untuk Nusantara</p>
    </div>
</footer>

<script>
let jumlah = 1;
function tambah() { jumlah++; update(); }
function kurang() { if (jumlah > 1) { jumlah--; update(); } }
function update() {
    document.getElementById('jumlahVal').textContent = jumlah;
    document.getElementById('jumlahInput').value = jumlah;
}
window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 30);
});
const hamburger = document.getElementById('hamburgerBtn');
const mobileMenu = document.getElementById('mobileMenu');
hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    mobileMenu.classList.toggle('open');
});
</script>
</body>
</html>