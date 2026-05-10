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

{{-- CSS External --}}
<link rel="stylesheet" href="{{ asset('css/produk.css') }}">
</head>
<body>

{{-- NAVBAR - WHITE BACKGROUND --}}
<nav id="navbar">
    <a href="{{ url('/') }}" class="nav-logo">
        <img src="{{ asset('images/logoPL.png') }}" alt="PawonLokal Logo">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
        <li><a href="{{ url('/produk') }}" class="active">Produk</a></li>
        @auth
            @if(auth()->user()->role === 'customer')
                <li>
                    <a href="{{ url('/keranjang') }}" class="cart-btn">
                        <i class="fa-solid fa-basket-shopping"></i>
                        @php $jumlahKeranjang = \App\Models\Keranjang::where('id_user', auth()->id())->count(); @endphp
                        @if($jumlahKeranjang > 0)
                            <span class="cart-badge">{{ $jumlahKeranjang }}</span>
                        @endif
                    </a>
                </li>
            @endif
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="nav-cta">Logout</button>
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
        @if(auth()->user()->role === 'customer')
            <a href="{{ url('/keranjang') }}">Keranjang</a>
        @endif
        <a href="#" onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();" style="color:var(--crimson);font-weight:700">Logout →</a>
        <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
    @else
        <a href="{{ url('/login') }}" style="color:var(--crimson);font-weight:700">Login →</a>
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
        <p>Dari kue basah yang lembut hingga kue kering yang renyah semuanya ada di sini!</p>
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

{{-- FOOTER - WHITE TEXT --}}
<footer>
    <div class="footer-grid">
        <div class="footer-brand">
            <div class="footer-brand-logo">
                <img src="{{ asset('images/logoPL.png') }}" alt="PawonLokal">
                <span>PawonLokal</span>
            </div>
            <p class="footer-brand-desc">Menghadirkan kue tradisional Nusantara yang autentik, dibuat dengan bahan alami dan resep warisan leluhur.</p>
            <div class="footer-socials">
                <a href="#" class="social-btn"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="social-btn"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="social-btn"><i class="fa-brands fa-tiktok"></i></a>
                <a href="https://wa.me/6285232411498" target="_blank" class="social-btn"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
        <div class="footer-col">
            <h4>Navigasi</h4>
            <ul>
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i> Home</a></li>
                <li><a href="{{ url('/about') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i> Tentang Kami</a></li>
                <li><a href="{{ url('/produk') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i> Produk</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Akun</h4>
            <ul>
                @auth
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('footer-logout-form').submit();">
                            <i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i> Logout
                        </a>
                    </li>
                    <form id="footer-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                @else
                    <li><a href="{{ url('/login') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i> Login</a></li>
                    <li><a href="{{ url('/register') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem"></i> Daftar</a></li>
                @endauth
            </ul>
        </div>
        <div class="footer-col">
            <h4>Kontak</h4>
            <div class="footer-contact-item"><i class="fa-solid fa-map-pin"></i><span>Jl. Tradisi No. 7, Surabaya</span></div>
            <div class="footer-contact-item"><i class="fa-solid fa-phone"></i><span>+62 852-3241-1498</span></div>
            <div class="footer-contact-item"><i class="fa-solid fa-envelope"></i><span>halo@pawonlokal.id</span></div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} <a href="{{ url('/') }}">PawonLokal</a>. Hak cipta dilindungi.</p>
        <p>Dibuat dengan <i class="fa-solid fa-heart" style="color:var(--white)"></i> untuk Nusantara</p>
    </div>
</footer>

{{-- JavaScript External --}}
<script src="{{ asset('js/produk.js') }}"></script>
</body>
</html>