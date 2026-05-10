<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawonLokal – Selamat Datang, {{ auth()->user()->name }}!</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- CSS terpisah --}}
    <link rel="stylesheet" href="{{ asset('css/user-home.css') }}">
</head>
<body>

{{-- ===== NAVBAR ===== --}}
<nav id="navbar">
    <a href="{{ url('/user/home') }}" class="nav-logo">
        <img src="{{ asset('images/Logo.PNG') }}" alt="PawonLokal Logo">
        <span>PawonLokal</span>
    </a>

    <ul class="nav-links">
        <li><a data-scroll="#hero" class="active">Home</a></li>
        <li><a data-scroll="#about">Tentang Kami</a></li>
        <li><a data-scroll="#produk">Produk</a></li>
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
            <form action="{{ route('logout') }}" method="POST" style="display:inline" id="nav-logout-form">
                @csrf
                <button type="submit" class="nav-cta">Logout</button>
            </form>
        </li>
    </ul>

    <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>

{{-- Mobile Menu --}}
<div class="mobile-menu" id="mobileMenu">
    <a data-scroll="#hero">Home</a>
    <a data-scroll="#about">Tentang Kami</a>
    <a data-scroll="#produk">Produk</a>
    <a href="{{ url('/keranjang') }}">Keranjang</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();"
       style="color:var(--crimson);font-weight:700;">Logout →</a>
    <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
</div>


{{-- ===== SECTION 1: HERO ===== --}}
<section id="hero">
    <div class="hero-video-bg">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('videos/opening.mp4') }}" type="video/mp4">
        </video>
    </div>

    <div class="hero-inner">
        <div class="hero-badge">
            Kue Tradisional Nusantara Terbaik
        </div>

        <h1 class="hero-title">
            Halo, <em>{{ auth()->user()->name }}!</em><br>
            Selamat Datang di PawonLokal
        </h1>

        <p class="hero-desc">
            Jelajahi kue tradisional Nusantara dengan kualitas terbaik dan cita rasa
            asli Indonesia, dibuat dengan resep warisan dan bahan pilihan.
        </p>

        <div class="hero-buttons">
            <button class="btn-primary" data-scroll="#produk">
                <i class="fa-solid fa-store"></i> Lihat Produk
            </button>
            <a href="https://wa.me/6285232411498" target="_blank" class="btn-outline">
                <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
            </a>
        </div>

        <div class="hero-stats">
            <div class="stat-item">
                <div class="stat-num" data-count="200">0+</div>
                <div class="stat-label">Pelanggan Puas</div>
            </div>
            <div class="stat-item">
                <div class="stat-num" data-count="30">0+</div>
                <div class="stat-label">Jenis Kue</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">4.9★</div>
                <div class="stat-label">Rating Rata-rata</div>
            </div>
        </div>
    </div>
</section>


{{-- ===== SECTION 2: TENTANG KAMI ===== --}}
<section id="about">
    <div class="max-w">
        <div class="about-grid">

            <div class="about-images reveal">
                <img class="about-img-a" src="{{ asset('images/2.png') }}" alt="Proses Pembuatan Kue">
                <img class="about-img-b" src="{{ asset('images/daunkering.png') }}" alt="Kue Tradisional">
                <div class="about-badge">
                    <span>SEJAK</span>
                    <strong>2010</strong>
                    <span>LOKAL</span>
                </div>
            </div>

            <div class="reveal reveal-delay-1">
                <div class="section-label">
                    <i class="fa-solid fa-award"></i> Tentang PawonLokal
                </div>
                <div class="ornament">
                    <div class="ornament-line"></div>
                    <div class="ornament-dot"></div>
                    <div class="ornament-line"></div>
                </div>
                <h2 class="section-title">
                    Menjaga <em>Warisan Rasa</em><br>Nusantara
                </h2>
                <p style="color:var(--text-mid);line-height:1.8;margin-bottom:32px;font-size:0.97rem;">
                    Kami hadir dengan misi sederhana: melestarikan kekayaan kuliner tradisional Indonesia.
                    Setiap kue dibuat menggunakan resep turun-temurun dengan bahan-bahan alami pilihan,
                    tanpa pengawet, dan penuh kasih sayang.
                </p>

                <div class="about-feature">
                    <div class="about-feature-icon"><i class="fa-solid fa-leaf"></i></div>
                    <div class="about-feature-text">
                        <h4>Bahan Alami & Segar</h4>
                        <p>Dipilih setiap pagi dari pasar lokal, bebas pengawet dan pewarna buatan.</p>
                    </div>
                </div>
                <div class="about-feature">
                    <div class="about-feature-icon"><i class="fa-solid fa-clock"></i></div>
                    <div class="about-feature-text">
                        <h4>Dibuat Fresh Setiap Hari</h4>
                        <p>Tidak ada stok lama. Setiap pesanan dibuat segar di hari pengiriman.</p>
                    </div>
                </div>
                <div class="about-feature">
                    <div class="about-feature-icon"><i class="fa-solid fa-heart"></i></div>
                    <div class="about-feature-text">
                        <h4>Resep Warisan Keluarga</h4>
                        <p>Dipelajari dari leluhur dan terus dijaga keasliannya hingga generasi kini.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ===== SECTION 3: PRODUK ===== --}}
<section id="produk">
    <div class="produk-bg-ornament"></div>
    <div class="max-w">

        <div class="produk-header reveal">
            <div class="section-label">
                <i class="fa-solid fa-store"></i> Produk Kami
            </div>
            <div class="ornament">
                <div class="ornament-line" style="background:linear-gradient(90deg,transparent,rgba(232,184,109,0.6),transparent);"></div>
                <div class="ornament-dot" style="background:var(--gold-light);"></div>
                <div class="ornament-line" style="background:linear-gradient(90deg,transparent,rgba(232,184,109,0.6),transparent);"></div>
            </div>
            <h2 class="section-title">
                Pilihan Kue <em style="color:var(--gold-light);">Favoritmu</em>
            </h2>
            <p class="section-sub">
                Dari kue basah yang lembut hingga kue kering yang renyah — semua tersedia untuk kamu.
            </p>
        </div>

        <div class="produk-grid-user reveal reveal-delay-1">
            @forelse($produk as $p)
            <a href="{{ route('produk.show', $p->id_produk) }}" class="produk-card-user"
               style="animation-delay: {{ $loop->index * 0.05 }}s">
                <div class="produk-card-img">
                    @if($p->foto)
                        <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama_produk }}"
                             onerror="this.parentElement.innerHTML='<div class=produk-card-img-placeholder><i class=fa-solid fa-cookie></i></div>'">
                    @else
                        <div class="produk-card-img-placeholder">
                            <i class="fa-solid fa-cookie"></i>
                        </div>
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
            <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:rgba(255,255,255,0.7);">
                <i class="fa-solid fa-box-open" style="font-size:3rem;margin-bottom:16px;display:block;"></i>
                <p>Belum ada produk tersedia.</p>
            </div>
            @endforelse
        </div>

        <div class="lihat-semua-wrap reveal reveal-delay-2">
            <a href="{{ url('/produk') }}" class="lihat-semua-link">
                Lihat Semua Produk <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

    </div>
</section>


{{-- ===== CTA BAND ===== --}}
<section class="cta-band">
    <h2>Siap Memesan Kue <em style="font-style:italic;">Impianmu?</em></h2>
    <p>Pesan sekarang dan nikmati cita rasa tradisional yang autentik diantar ke pintu rumahmu.</p>
    <div class="cta-buttons">
        <button class="btn-white" data-scroll="#produk" style="cursor:pointer;border:none;font-family:inherit;">
            <i class="fa-solid fa-store"></i> Pesan Sekarang
        </button>
        <a href="https://wa.me/6285232411498" target="_blank" class="btn-outline-white">
            <i class="fa-brands fa-whatsapp"></i> Chat via WhatsApp
        </a>
    </div>
</section>


{{-- ===== FOOTER ===== --}}
<footer>
    <div class="footer-grid">
        <div>
            <div class="footer-brand-logo">
                <img src="{{ asset('images/Logo.PNG') }}" alt="PawonLokal">
                <span>PawonLokal</span>
            </div>
            <p class="footer-brand-desc">
                Menghadirkan kue tradisional Nusantara yang autentik,
                dibuat dengan bahan alami dan resep warisan leluhur.
            </p>
            <div class="footer-socials">
                <a href="#" class="social-btn"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="social-btn"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="social-btn"><i class="fa-brands fa-tiktok"></i></a>
                <a href="https://wa.me/6285232411498" target="_blank" class="social-btn">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </div>
        </div>

        <div class="footer-col">
            <h4>Navigasi</h4>
            <ul>
                <li>
                    <a data-scroll="#hero" style="cursor:pointer;">
                        <i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Home
                    </a>
                </li>
                <li>
                    <a data-scroll="#about" style="cursor:pointer;">
                        <i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Tentang Kami
                    </a>
                </li>
                <li>
                    <a data-scroll="#produk" style="cursor:pointer;">
                        <i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Produk
                    </a>
                </li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Akun</h4>
            <ul>
                <li>
                    <a href="{{ url('/keranjang') }}">
                        <i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Keranjang
                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('footer-logout-form').submit();">
                        <i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Logout
                    </a>
                </li>
                <form id="footer-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Kontak</h4>
            <div class="footer-contact-item">
                <i class="fa-solid fa-map-pin"></i>
                <span>Jl. Tradisi No. 7, Surabaya, Jawa Timur</span>
            </div>
            <div class="footer-contact-item">
                <i class="fa-solid fa-phone"></i>
                <span>+62 852-3241-1498</span>
            </div>
            <div class="footer-contact-item">
                <i class="fa-solid fa-envelope"></i>
                <span>halo@pawonlokal.id</span>
            </div>
            <div class="footer-contact-item">
                <i class="fa-solid fa-clock"></i>
                <span>Senin–Sabtu, 07.00–17.00 WIB</span>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© {{ date('Y') }} <a href="{{ url('/user/home') }}">PawonLokal</a>. Hak cipta dilindungi.</p>
        <p>Dibuat dengan <i class="fa-solid fa-heart" style="color:var(--white);"></i> untuk Nusantara</p>
    </div>
</footer>

{{-- JS terpisah --}}
<script src="{{ asset('js/user-home.js') }}"></script>

</body>
</html>