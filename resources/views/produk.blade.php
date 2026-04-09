<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produk – PawonLokal</title>
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
    --text-mid: #5C3317; --text-light: #9E7650;
    --white: #FFFFFF;
    --shadow-warm: 0 8px 40px rgba(139,26,26,0.15);
    --radius: 16px; --transition: 0.3s cubic-bezier(0.4,0,0.2,1);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--cream); color: var(--text-dark); overflow-x: hidden; }

/* NAVBAR */
nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
    padding: 0 40px; height: 72px;
    display: flex; align-items: center; justify-content: space-between;
    background: rgba(253,246,237,0.92); backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(201,146,58,0.2);
    transition: box-shadow var(--transition);
}
nav.scrolled { box-shadow: 0 4px 30px rgba(139,26,26,0.12); }
.nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
.nav-logo img { height: 44px; object-fit: contain; }
.nav-logo span { font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 800; color: var(--crimson); }
.nav-links { display: flex; align-items: center; gap: 8px; list-style: none; }
.nav-links a { text-decoration: none; color: var(--text-mid); font-weight: 500; font-size: 0.92rem; padding: 8px 16px; border-radius: 50px; transition: color var(--transition), background var(--transition); }
.nav-links a:hover, .nav-links a.active { color: var(--crimson); background: rgba(139,26,26,0.08); }
.nav-cta { background: var(--crimson) !important; color: var(--white) !important; padding: 10px 22px !important; border-radius: 50px !important; font-weight: 600 !important; }
.nav-cta:hover { background: var(--crimson-deep) !important; }
.cart-btn {
    position: relative;
    width: 40px; height: 40px; border-radius: 50%;
    background: rgba(139,26,26,0.08); color: var(--crimson);
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; transition: background var(--transition);
    text-decoration: none;
}
.cart-btn:hover { background: rgba(139,26,26,0.15); }
.cart-badge {
    position: absolute; top: -4px; right: -4px;
    background: var(--crimson); color: var(--white);
    font-size: 0.6rem; font-weight: 700;
    width: 18px; height: 18px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
}
.hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; background: none; border: none; padding: 8px; }
.hamburger span { display: block; width: 24px; height: 2px; background: var(--crimson); border-radius: 2px; transition: transform var(--transition), opacity var(--transition); }
.hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.hamburger.open span:nth-child(2) { opacity: 0; }
.hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
.mobile-menu { display: none; position: fixed; top: 72px; left: 0; right: 0; background: rgba(253,246,237,0.98); backdrop-filter: blur(20px); z-index: 999; padding: 20px 24px; border-bottom: 1px solid rgba(201,146,58,0.2); }
.mobile-menu.open { display: block; }
.mobile-menu a { display: block; text-decoration: none; color: var(--text-mid); font-weight: 500; padding: 14px 0; border-bottom: 1px solid rgba(201,146,58,0.15); }

/* HERO PRODUK */
.produk-hero {
    padding-top: 72px;
    background: linear-gradient(135deg, var(--crimson-deep) 0%, var(--crimson) 60%, #9B2020 100%);
    padding-bottom: 80px; position: relative; overflow: hidden;
}
.produk-hero::before {
    content: ''; position: absolute; inset: 0;
    background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 1px, transparent 1px, transparent 50px);
}
.hero-blob {
    position: absolute; border-radius: 50%; filter: blur(60px); pointer-events: none;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(201,146,58,0.25) 0%, transparent 70%);
    top: -80px; right: -60px;
}
.produk-hero-inner {
    max-width: 1200px; margin: 0 auto; padding: 60px 40px 0;
    position: relative; z-index: 1; text-align: center;
}
.produk-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(201,146,58,0.2); border: 1px solid rgba(201,146,58,0.4);
    color: var(--gold-light); font-size: 0.78rem; font-weight: 600;
    letter-spacing: 0.08em; text-transform: uppercase;
    padding: 6px 14px; border-radius: 50px; margin-bottom: 20px;
}
.produk-hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 5vw, 3.2rem); font-weight: 800;
    color: var(--white); line-height: 1.2; margin-bottom: 14px;
}
.produk-hero h1 em { font-style: italic; color: var(--gold-light); }
.produk-hero p { color: rgba(255,255,255,0.75); font-size: 1rem; margin-bottom: 36px; }

/* SEARCH BOX */
.search-box {
    max-width: 560px; margin: 0 auto;
    background: var(--white); border-radius: 50px;
    display: flex; align-items: center; gap: 12px;
    padding: 8px 8px 8px 20px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
}
.search-box i { color: var(--text-light); font-size: 0.9rem; flex-shrink: 0; }
.search-box input {
    flex: 1; border: none; outline: none;
    font-family: inherit; font-size: 0.92rem;
    color: var(--text-dark); background: transparent;
}
.search-box input::placeholder { color: var(--text-light); }
.search-btn {
    background: var(--crimson); color: var(--white);
    border: none; border-radius: 50px; padding: 10px 22px;
    font-family: inherit; font-size: 0.85rem; font-weight: 600;
    cursor: pointer; transition: background var(--transition); flex-shrink: 0;
}
.search-btn:hover { background: var(--crimson-deep); }

/* FILTER TABS */
.filter-section {
    background: var(--white);
    border-bottom: 1px solid rgba(201,146,58,0.15);
    padding: 0 40px;
    position: sticky; top: 72px; z-index: 100;
}
.filter-inner {
    max-width: 1200px; margin: 0 auto;
    display: flex; align-items: center; justify-content: center;
    gap: 12px; padding: 16px 0;
}
.filter-btn {
    display: inline-flex; align-items: center;
    padding: 9px 28px; border-radius: 50px;
    border: 1.5px solid #e8d8c4; background: transparent;
    color: var(--text-mid); font-family: inherit;
    font-size: 0.88rem; font-weight: 500; cursor: pointer;
    transition: all var(--transition); white-space: nowrap;
    text-decoration: none;
}
.filter-btn:hover { border-color: var(--crimson); color: var(--crimson); background: rgba(139,26,26,0.05); }
.filter-btn.active { background: var(--crimson); color: var(--white); border-color: var(--crimson); }

/* HASIL */
.hasil-section { max-width: 1200px; margin: 0 auto; padding: 40px; }
.hasil-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; flex-wrap: wrap; gap: 12px; }
.hasil-info { font-size: 0.88rem; color: var(--text-light); }
.hasil-info strong { color: var(--text-dark); font-weight: 600; }

/* PRODUK GRID */
.produk-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 24px;
}

/* PRODUK CARD */
.produk-card {
    background: var(--white); border-radius: 20px;
    overflow: hidden; box-shadow: 0 4px 20px rgba(139,26,26,0.08);
    border: 1px solid rgba(201,146,58,0.1);
    transition: transform var(--transition), box-shadow var(--transition);
    text-decoration: none; display: block;
    animation: fadeUp 0.5s ease both;
}
.produk-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-warm); }
@keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }

.produk-card-img {
    position: relative; height: 200px; overflow: hidden;
    background: linear-gradient(135deg, #f5ece0, #e8d8c0);
}
.produk-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.produk-card:hover .produk-card-img img { transform: scale(1.08); }
.produk-card-img-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #c8a06a; font-size: 3rem; }
.produk-card-tag {
    position: absolute; top: 12px; left: 12px;
    background: rgba(255,255,255,0.92); backdrop-filter: blur(8px);
    color: var(--crimson); font-size: 0.68rem; font-weight: 700;
    letter-spacing: 0.08em; text-transform: uppercase;
    padding: 4px 10px; border-radius: 50px;
}
.produk-card-status-off {
    position: absolute; inset: 0; background: rgba(0,0,0,0.45);
    display: flex; align-items: center; justify-content: center;
}
.produk-card-status-off span { background: #fee2e2; color: #b91c1c; font-size: 0.75rem; font-weight: 700; padding: 6px 14px; border-radius: 50px; }
.produk-card-body { padding: 18px 20px 20px; }
.produk-card-name {
    font-family: 'Playfair Display', serif; font-size: 1.05rem; font-weight: 700;
    color: var(--text-dark); margin-bottom: 6px;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.produk-card-desc {
    font-size: 0.78rem; color: var(--text-light); line-height: 1.5; margin-bottom: 14px;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.produk-card-footer { display: flex; align-items: center; justify-content: space-between; }
.produk-card-price { font-family: 'Playfair Display', serif; font-size: 1.15rem; font-weight: 800; color: var(--crimson); }
.produk-card-btn { width: 36px; height: 36px; border-radius: 50%; background: var(--crimson); color: var(--white); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; transition: background var(--transition), transform var(--transition); }
.produk-card:hover .produk-card-btn { background: var(--crimson-deep); transform: rotate(45deg); }
.produk-card-btn-off { width: 36px; height: 36px; border-radius: 50%; background: #f0f0f0; color: #aaa; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; }

/* EMPTY STATE */
.empty-state { text-align: center; padding: 80px 20px; grid-column: 1 / -1; }
.empty-state i { font-size: 3rem; color: rgba(139,26,26,0.2); display: block; margin-bottom: 16px; }
.empty-state h3 { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--text-mid); margin-bottom: 8px; }
.empty-state p { font-size: 0.88rem; color: var(--text-light); }

/* FOOTER */
footer { background: var(--brown); color: rgba(255,255,255,0.7); padding: 60px 40px 32px; margin-top: 60px; }
.footer-grid { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 48px; }
.footer-brand-name { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--white); margin-bottom: 12px; }
.footer-brand p { font-size: 0.88rem; line-height: 1.7; }
.footer-col h4 { font-size: 0.8rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold-light); margin-bottom: 20px; }
.footer-col ul { list-style: none; }
.footer-col ul li { margin-bottom: 10px; }
.footer-col ul a { text-decoration: none; color: rgba(255,255,255,0.65); font-size: 0.88rem; transition: color var(--transition); display: inline-flex; align-items: center; gap: 6px; }
.footer-col ul a:hover { color: var(--white); }
.footer-contact-item { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 12px; font-size: 0.88rem; }
.footer-contact-item i { color: var(--gold-light); margin-top: 2px; flex-shrink: 0; }
.footer-bottom { max-width: 1200px; margin: 0 auto; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: space-between; font-size: 0.82rem; flex-wrap: wrap; gap: 10px; }
.footer-bottom a { color: var(--gold-light); text-decoration: none; }

@media (max-width: 768px) {
    nav { padding: 0 20px; }
    .nav-links { display: none; }
    .hamburger { display: flex; }
    .produk-hero-inner { padding: 40px 20px 0; }
    .filter-section { padding: 0 20px; }
    .hasil-section { padding: 24px 20px; }
    .produk-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 16px; }
    .produk-card-img { height: 160px; }
    .footer-grid { grid-template-columns: 1fr; gap: 24px; }
}
</style>
</head>
<body>

{{-- NAVBAR --}}
<nav id="navbar">
    <a href="{{ url('/') }}" class="nav-logo">
        <img src="{{ asset('images/Logo.PNG') }}" alt="PawonLokal Logo">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
        <li><a href="{{ url('/produk') }}" class="active">Produk</a></li>
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

{{-- MOBILE MENU --}}
<div class="mobile-menu" id="mobileMenu">
    <a href="{{ url('/') }}">Home</a>
    <a href="{{ url('/about') }}">Tentang Kami</a>
    <a href="{{ url('/produk') }}" style="color:var(--crimson);font-weight:700">Produk</a>
    @auth
        <a href="{{ url('/keranjang') }}">Keranjang</a>
    @else
        <a href="{{ url('/login') }}" style="color:var(--crimson);font-weight:700">Login</a>
    @endauth
</div>

{{-- HERO --}}
<div class="produk-hero">
    <div class="hero-blob"></div>
    <div class="produk-hero-inner">
        <div class="produk-hero-badge">
            <i class="fa-solid fa-store"></i> Toko PawonLokal
        </div>
        <h1>Temukan Kue <em>Favoritmu</em></h1>
        <p>Dari kue basah yang lembut hingga kue kering yang renyah — semuanya ada di sini!</p>
        <form method="GET" action="{{ url('/produk') }}">
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Cari kue favoritmu..." value="{{ request('search') }}">
                <button type="submit" class="search-btn">Cari</button>
            </div>
        </form>
    </div>
</div>

{{-- FILTER TABS --}}
<div class="filter-section">
    <div class="filter-inner">
        <a href="{{ url('/produk') }}?search={{ request('search') }}"
           class="filter-btn {{ !request('kategori') ? 'active' : '' }}">
            Semua
        </a>
        <a href="{{ url('/produk') }}?kategori=basah&search={{ request('search') }}"
           class="filter-btn {{ request('kategori') == 'basah' ? 'active' : '' }}">
            Kue Basah
        </a>
        <a href="{{ url('/produk') }}?kategori=kering&search={{ request('search') }}"
           class="filter-btn {{ request('kategori') == 'kering' ? 'active' : '' }}">
            Kue Kering
        </a>
    </div>
</div>

{{-- HASIL PRODUK --}}
<div class="hasil-section">
    <div class="hasil-header">
        <div class="hasil-info">
            Menampilkan <strong>{{ $produk->count() }}</strong> produk
            @if(request('search'))
                untuk pencarian "<strong>{{ request('search') }}</strong>"
            @endif
            @if(request('kategori'))
                · Kategori: <strong>{{ ucfirst(request('kategori')) }}</strong>
            @endif
        </div>
        @if(request('search') || request('kategori'))
            <a href="{{ url('/produk') }}" style="font-size:0.82rem;color:var(--crimson);font-weight:600;text-decoration:none;display:flex;align-items:center;gap:5px;">
                <i class="fa-solid fa-xmark"></i> Reset Filter
            </a>
        @endif
    </div>

    <div class="produk-grid">
        @forelse($produk as $p)
        <a href="{{ route('produk.show', $p->id_produk) }}" class="produk-card" style="animation-delay: {{ $loop->index * 0.05 }}s">
            <div class="produk-card-img">
                @if($p->foto)
                    <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama_produk }}"
                         onerror="this.parentElement.innerHTML='<div class=produk-card-img-placeholder><i class=fa-solid fa-cookie></i></div>'">
                @else
                    <div class="produk-card-img-placeholder"><i class="fa-solid fa-cookie"></i></div>
                @endif
                <div class="produk-card-tag">{{ $p->kategori }}</div>
                @if($p->status === 'nonaktif')
                    <div class="produk-card-status-off"><span>Stok Habis</span></div>
                @endif
            </div>
            <div class="produk-card-body">
                <div class="produk-card-name">{{ $p->nama_produk }}</div>
                <div class="produk-card-desc">{{ $p->deskripsi }}</div>
                <div class="produk-card-footer">
                    <div class="produk-card-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                    @if($p->status === 'aktif')
                        <div class="produk-card-btn"><i class="fa-solid fa-arrow-right"></i></div>
                    @else
                        <div class="produk-card-btn-off"><i class="fa-solid fa-xmark"></i></div>
                    @endif
                </div>
            </div>
        </a>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-box-open"></i>
            <h3>Produk tidak ditemukan</h3>
            <p>Coba kata kunci lain atau reset filter pencarian</p>
        </div>
        @endforelse
    </div>
</div>

{{-- FOOTER --}}
<footer>
    <div class="footer-grid">
        <div class="footer-brand">
            <div class="footer-brand-name">PawonLokal</div>
            <p>Menghadirkan kue tradisional Nusantara yang autentik, dibuat dengan bahan alami dan resep warisan leluhur.</p>
        </div>
        <div class="footer-col">
            <h4>Navigasi</h4>
            <ul>
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i>Home</a></li>
                <li><a href="{{ url('/about') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i>Tentang Kami</a></li>
                <li><a href="{{ url('/produk') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i>Produk</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Akun</h4>
            <ul>
                @auth
                    <li><a href="{{ url('/keranjang') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i>Keranjang</a></li>
                @else
                    <li><a href="{{ url('/login') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i>Login</a></li>
                    <li><a href="{{ url('/register') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i>Daftar</a></li>
                @endauth
            </ul>
        </div>
        <div class="footer-col">
            <h4>Kontak</h4>
            <div class="footer-contact-item"><i class="fa-solid fa-map-pin"></i><span>Jl. Tradisi No. 7, Surabaya</span></div>
            <div class="footer-contact-item"><i class="fa-solid fa-phone"></i><span>+62 812-3456-7890</span></div>
            <div class="footer-contact-item"><i class="fa-solid fa-envelope"></i><span>halo@pawonlokal.id</span></div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} <a href="{{ url('/') }}">PawonLokal</a>. Hak cipta dilindungi.</p>
        <p>Dibuat dengan <i class="fa-solid fa-heart" style="color:var(--crimson)"></i> untuk Nusantara</p>
    </div>
</footer>

<script>
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