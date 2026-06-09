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
<link rel="stylesheet" href="{{ asset('css/detail-produk.css') }}">
<style>
.floating-buttons {
    position: fixed;
    bottom: 28px;
    right: 28px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    z-index: 999;
}
.floating-cart,
.floating-pesanan {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    box-shadow: 0 4px 18px rgba(0,0,0,0.2);
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
    text-decoration: none;
}
.floating-cart { background: #8B1A1A; color: #fff; }
.floating-pesanan { background: #C9923A; color: #fff; }
.floating-cart:hover,
.floating-pesanan:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.25);
}
.floating-cart-badge {
    position: absolute;
    top: -4px;
    right: -4px;
    background: #fff;
    color: #8B1A1A;
    font-size: 0.65rem;
    font-weight: 700;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1.5px solid #8B1A1A;
}
</style>
</head>
<body>

{{-- NAVBAR --}}
<nav id="navbar">
    <a href="{{ url('/') }}" class="nav-logo">
        <img src="{{ asset('images/LogoPL.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
        <li><a href="{{ url('/produk') }}" class="active">Produk</a></li>
        <li><a href="{{ url('/kontak') }}">Kontak</a></li>
        @auth
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
    <a href="{{ url('/kontak') }}">Kontak</a>
    @auth
        @if(auth()->user()->role === 'customer')
            <a href="{{ url('/keranjang') }}">Keranjang</a>
            <a href="{{ route('pesanan.riwayat') }}">Pesanan Saya</a>
        @endif
        <a href="#" onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();" style="color:var(--crimson);font-weight:700">Logout →</a>
        <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
    @else
        <a href="{{ url('/login') }}" style="color:var(--crimson);font-weight:700">Login →</a>
    @endauth
</div>

{{-- CONTENT --}}
<div class="page-content">
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
                        @if(auth()->user()->role === 'customer')
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
                            <a href="{{ url('/produk') }}" class="btn-kembali">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        @endif
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

{{-- FLOATING BUTTONS (customer only) --}}
@auth
    @if(auth()->user()->role === 'customer')
    @php $jumlahKeranjang = \App\Models\Keranjang::where('id_user', auth()->id())->count(); @endphp
    <div class="floating-buttons">
        <a href="{{ route('pesanan.riwayat') }}" class="floating-pesanan" title="Pesanan Saya">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </a>
        <a href="{{ url('/keranjang') }}" class="floating-cart" title="Keranjang">
            <i class="fa-solid fa-basket-shopping"></i>
            @if($jumlahKeranjang > 0)
                <span class="floating-cart-badge">{{ $jumlahKeranjang }}</span>
            @endif
        </a>
    </div>
    @endif
@endauth

{{-- FOOTER --}}
<footer>
    <div class="footer-inner">
        <div class="footer-grid">
            <div>
                <div class="footer-brand-logo">
                    <img src="{{ asset('images/LogoPL.PNG') }}" alt="PawonLokal">
                    <span>PawonLokal</span>
                </div>
                <p class="footer-brand-desc">Menghadirkan kue tradisional Nusantara yang autentik, dibuat dengan bahan alami dan resep warisan leluhur.</p>
                <div class="footer-socials">
                    <a href="https://wa.me/6285232411498" class="footer-social-btn"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
            <div>
                <h4 class="footer-col-title">Navigasi</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}">› Home</a></li>
                    <li><a href="{{ url('/about') }}">› Tentang Kami</a></li>
                    <li><a href="{{ url('/produk') }}">› Produk</a></li>
                    <li><a href="{{ url('/kontak') }}">› Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-col-title">Akun</h4>
                <ul class="footer-links">
                    @auth
                        @if(auth()->user()->role === 'customer')
                            <li><a href="{{ route('pesanan.riwayat') }}">› Pesanan Saya</a></li>
                        @endif
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('footer-logout-form').submit();">› Logout</a>
                        </li>
                        <form id="footer-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                    @else
                        <li><a href="{{ url('/login') }}">› Login</a></li>
                        <li><a href="{{ url('/register') }}">› Daftar</a></li>
                    @endauth
                </ul>
            </div>
            <div>
                <h4 class="footer-col-title">Kontak</h4>
                <ul class="footer-contact-list">
                    <li class="footer-contact-item"><i class="fa-solid fa-location-dot"></i><span>Dsn. Kalitengah Ds. Bangun RT.01 RW.01 Kec. Pungging Kab. Mojokerto</span></li>
                    <li class="footer-contact-item"><i class="fa-solid fa-phone"></i><span>+62 852-3241-1498</span></li>
                    <li class="footer-contact-item"><i class="fa-solid fa-envelope"></i><span>pawonlokal@gmail.com</span></li>
                    <li class="footer-contact-item"><i class="fa-solid fa-clock"></i><span>Senin-Sabtu, 07.00-17.00 WIB</span></li>
                </ul>
            </div>
        </div>
        <div class="footer-divider"></div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} <a href="{{ url('/') }}">PawonLokal</a>. Hak cipta dilindungi.</p>
            <p>Dibuat dengan <i class="fa-solid fa-heart" style="color:var(--white)"></i> untuk Nusantara</p>
        </div>
    </div>
</footer>

<script src="{{ asset('js/detail-produk.js') }}"></script>
</body>
</html>