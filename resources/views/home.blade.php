<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawonLokal – Kue Tradisional Nusantara</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

    {{-- NAVBAR --}}
    <nav id="navbar">
        <a href="{{ url('/') }}" class="nav-logo">
            <img src="{{ asset('images/logoPL3.png') }}" alt="PawonLokal Logo">
            <span>PawonLokal</span>
        </a>

        <ul class="nav-links">
            <li><a href="{{ url('/') }}" class="active">Home</a></li>
            <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
            <li><a href="{{ url('/produk') }}">Produk</a></li>
            <li><a href="{{ url('/kontak') }}">Kontak</a></li>
            @auth
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline" id="nav-logout-form">
                        @csrf
                        <button type="submit" class="nav-cta">Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ url('/login') }}" class="nav-cta">Login</a>
                </li>
            @endauth
        </ul>

        <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </nav>

    {{-- Mobile Menu --}}
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ url('/about') }}">Tentang Kami</a>
        <a href="{{ url('/produk') }}">Produk</a>
        <a href="{{ url('/kontak') }}">Kontak</a>
        @auth
            <a href="#" onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();" style="color:var(--crimson);font-weight:700;">Logout →</a>
            <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        @else
            <a href="{{ url('/login') }}" style="color:var(--crimson);font-weight:700;">Login →</a>
        @endauth
    </div>

    {{-- HERO --}}
    <section class="hero">
        <div class="hero-video-bg">
            <video autoplay muted loop playsinline>
                <source src="{{ asset('videos/12.mp4') }}" type="video/mp4">
            </video>
        </div>

        <div class="hero-inner">
            <div class="hero-badge">
                Kue Tradisional Nusantara Terbaik
            </div>

            <h1 class="hero-title">
                Selamat Datang di<br>
                <em>PawonLokal</em>
            </h1>

            <p class="hero-desc">
                Jelajahi kue tradisional Nusantara dengan kualitas terbaik dan cita rasa
                asli Indonesia, dibuat dengan resep warisan dan bahan pilihan.
            </p>

            <div class="hero-buttons">
                <a href="{{ url('/produk') }}" class="btn-primary">Lihat Produk</a>
                <a href="{{ url('/kontak') }}" class="btn-outline">Hubungi Kami</a>
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

    {{-- PROSES KUALITAS --}}
    <section class="proses-kualitas">
        <div class="max-w">
            <div class="section-header centered reveal">
                <div class="section-label" style="justify-content:center; color: var(--white);">Proses Pembuatan</div>
                <div class="ornament centered">
                    <div class="ornament-line" style="background: linear-gradient(90deg,transparent,rgba(255,255,255,0.6),transparent);"></div>
                    <div class="ornament-dot" style="background: var(--white);"></div>
                    <div class="ornament-line" style="background: linear-gradient(90deg,transparent,rgba(255,255,255,0.6),transparent);"></div>
                </div>
                <h2 class="section-title" style="color: var(--white);">Kualitas Terbaik Dimulai dari <em style="color:var(--gold-light);">Proses</em></h2>
                <p class="section-sub" style="margin: 0 auto; color: rgba(255,255,255,0.9);">
                    Kami memastikan setiap tahapan dikerjakan dengan penuh ketelitian, standar tinggi, dan tenaga terampil.
                </p>
            </div>

            <div class="proses-grid">
                <div class="proses-card reveal reveal-delay-1">
                    <div class="proses-video-container">
                        <video class="proses-video" autoplay muted loop playsinline>
                            <source src="{{ asset('videos/13.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="proses-card-body">
                        <h3 class="proses-card-title">Proses Pembuatan</h3>
                        <p class="proses-card-desc">Ketelitian dalam setiap tahapan pembuatan kue</p>
                    </div>
                </div>
                <div class="proses-card reveal reveal-delay-2">
                    <div class="proses-video-container">
                        <video class="proses-video" autoplay muted loop playsinline>
                            <source src="{{ asset('videos/14.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="proses-card-body">
                        <h3 class="proses-card-title">Proses Pengemasan</h3>
                        <p class="proses-card-desc">Dari proses hingga produk jadi siap antar</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ABOUT --}}
    <section class="about">
        <div class="max-w">
            <div class="about-grid">
                <div class="about-images reveal">
                    <img class="about-img-a" src="{{ asset('images/kue-tradisional.png') }}" alt="Proses Pembuatan Kue">
                    <img class="about-img-b" src="{{ asset('images/daunkering.png') }}" alt="Kue Tradisional">
                    <div class="about-badge">
                        <span>SEJAK</span><strong>2010</strong>
                    </div>
                </div>
                <div class="reveal reveal-delay-1">
                    <div class="section-label">Tentang PawonLokal</div>
                    <div class="ornament">
                        <div class="ornament-line"></div>
                        <div class="ornament-dot"></div>
                        <div class="ornament-line"></div>
                    </div>
                    <h2 class="section-title">Menjaga <em>Warisan Rasa</em><br>Nusantara</h2>
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
                    <a href="{{ url('/about') }}" class="btn-primary" style="margin-top:8px;width:fit-content;">
                        Pelajari Lebih Lanjut <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- PRODUK --}}
    <section class="products-section">
        <div class="products-bg-ornament"></div>
        <div class="max-w">
            <div class="products-header reveal">
                <div class="section-label">Produk Kami</div>
                <div class="ornament">
                    <div class="ornament-line" style="background:linear-gradient(90deg,transparent,rgba(232,184,109,0.6),transparent);"></div>
                    <div class="ornament-dot" style="background:var(--gold-light);"></div>
                    <div class="ornament-line" style="background:linear-gradient(90deg,transparent,rgba(232,184,109,0.6),transparent);"></div>
                </div>
                <h2 class="section-title">Pilihan <em style="color:var(--gold-light);">Kategori</em> Kue</h2>
                <p class="section-sub" style="color:rgba(255,255,255,0.9);">
                    Dari kue basah yang lembut hingga kue kering yang renyah — semua tersedia untuk kamu.
                </p>
            </div>

            <div class="products-two-grid reveal reveal-delay-1">
                <a href="{{ url('/produk') }}?kategori=basah" class="product-card-white" style="text-decoration:none;">
                    <img src="{{ asset('images/donatvariasi.png') }}" alt="Kue Basah">
                    <div class="product-card-white-body">
                        <div class="product-card-white-tag">Kue Basah</div>
                        <div class="product-card-white-name">Kue Basah Tradisional</div>
                        <div class="product-card-white-desc">Klepon, onde-onde, kue lumpur, dan beragam kue basah lezat. Dibuat fresh setiap hari tanpa pengawet.</div>
                        <div class="product-card-white-footer">
                            <div class="product-card-white-price">Mulai Rp 3.500</div>
                            <div class="product-card-arrow"><i class="fa-solid fa-arrow-right"></i></div>
                        </div>
                    </div>
                </a>
                <a href="{{ url('/produk') }}?kategori=kering" class="product-card-white" style="text-decoration:none;">
                    <img src="{{ asset('images/bolot.png') }}" alt="Kue Kering">
                    <div class="product-card-white-body">
                        <div class="product-card-white-tag">Kue Kering</div>
                        <div class="product-card-white-name">Kue Kering Premium</div>
                        <div class="product-card-white-desc">Nastar, kastengel, putri salju, dan aneka kue kering renyah untuk hampers dan oleh-oleh spesial.</div>
                        <div class="product-card-white-footer">
                            <div class="product-card-white-price">Mulai Rp 80.000</div>
                            <div class="product-card-arrow"><i class="fa-solid fa-arrow-right"></i></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="see-all-wrap reveal reveal-delay-2">
                <a href="{{ url('/produk') }}" class="see-all-link">
                    Lihat Semua Produk <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- REVIEWS --}}
    <section class="reviews">
        <div class="max-w">
            <div class="section-header centered reveal">
                <div class="section-label" style="justify-content:center;">Kata Pelanggan</div>
                <div class="ornament centered">
                    <div class="ornament-line"></div>
                    <div class="ornament-dot"></div>
                    <div class="ornament-line"></div>
                </div>
                <h2 class="section-title">Mereka Sudah <em>Merasakannya</em></h2>
                <p class="section-sub">Kepuasan pelanggan adalah prioritas kami. Ini yang mereka katakan tentang PawonLokal.</p>
            </div>

            <div class="carousel-viewport reveal reveal-delay-1">
                <div class="carousel-track" id="reviewTrack">
                    @isset($reviews)
                        @foreach($reviews as $r)
                        <div class="review-card">
                            <div class="review-stars">
                                @for($s = 1; $s <= 5; $s++)
                                    @if($s <= $r['rating'])
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star" style="color:rgba(201,146,58,0.3)"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="review-text">"{{ $r['komentar'] }}"</p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">{{ strtoupper(substr($r['nama'], 0, 1)) }}</div>
                                <div>
                                    <div class="reviewer-name">{{ $r['nama'] }}</div>
                                    <div class="reviewer-label">Pelanggan Setia ✓</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="review-card">
                            <div class="review-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                            <p class="review-text">"Klepon-nya enak banget, lembut dan gurih! Pasti pesan lagi minggu depan."</p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">S</div>
                                <div><div class="reviewer-name">Sari Dewi</div><div class="reviewer-label">Pelanggan Setia ✓</div></div>
                            </div>
                        </div>
                        <div class="review-card">
                            <div class="review-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                            <p class="review-text">"Nastar-nya juara! Harum, lumer di mulut. Cocok banget buat hampers lebaran."</p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">B</div>
                                <div><div class="reviewer-name">Budi Santoso</div><div class="reviewer-label">Pelanggan Setia ✓</div></div>
                            </div>
                        </div>
                        <div class="review-card">
                            <div class="review-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                            <p class="review-text">"Sudah langganan bertahun-tahun! Kualitasnya tidak pernah mengecewakan."</p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">R</div>
                                <div><div class="reviewer-name">Rina Kusuma</div><div class="reviewer-label">Pelanggan Setia ✓</div></div>
                            </div>
                        </div>
                        <div class="review-card">
                            <div class="review-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star" style="color:rgba(201,146,58,0.3)"></i></div>
                            <p class="review-text">"Pengiriman cepat, packaging rapi dan kuenya masih fresh. Recommended banget!"</p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">A</div>
                                <div><div class="reviewer-name">Agus Prasetyo</div><div class="reviewer-label">Pelanggan Setia ✓</div></div>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>

            <div class="carousel-controls reveal reveal-delay-2">
                <button class="carousel-btn" id="prevBtn"><i class="fa-solid fa-chevron-left"></i></button>
                <div class="carousel-dots" id="carouselDots"></div>
                <button class="carousel-btn" id="nextBtn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </section>

    {{-- CTA BAND --}}
    <section class="cta-band">
        <h2>Siap Memesan Kue <em style="font-style:italic;">Impianmu?</em></h2>
        <p>Pesan sekarang dan nikmati cita rasa tradisional yang autentik diantar ke pintu rumahmu.</p>
        <div class="cta-buttons">
            <a href="{{ url('/produk') }}" class="btn-white">Pesan Sekarang</a>
            <a href="https://wa.me/6285232411498" target="_blank" class="btn-outline-white">
                <i class="fa-brands fa-whatsapp"></i> Chat via WhatsApp
            </a>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-grid">
            <div>
                <div class="footer-brand-logo">
                    <img src="{{ asset('images/logoPL3.png') }}" alt="PawonLokal">
                    <span>PawonLokal</span>
                </div>
                <p class="footer-brand-desc">Menghadirkan kue tradisional Nusantara yang autentik, dibuat dengan bahan alami dan resep warisan leluhur.</p>
                <div class="footer-socials">
                    <a href="https://wa.me/6285232411498" target="_blank" class="social-btn"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="{{ url('/') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Home</a></li>
                    <li><a href="{{ url('/about') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Tentang Kami</a></li>
                    <li><a href="{{ url('/produk') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Produk</a></li>
                    <li><a href="{{ url('/kontak') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Kontak</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Akun</h4>
                <ul>
                    @auth
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('footer-logout-form').submit();">
                                <i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Logout
                            </a>
                        </li>
                        <form id="footer-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                    @else
                        <li><a href="{{ url('/login') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Login</a></li>
                        <li><a href="{{ url('/register') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i> Daftar</a></li>
                    @endauth
                </ul>
            </div>
            <div class="footer-col">
                <h4>Kontak</h4>
                <ul style="list-style:none;">
                    <li class="footer-contact-item"><i class="fa-solid fa-map-pin"></i><span>Dsn. Kalitengah Ds. Bangun RT.01 RW.01 Kec. Pungging Kab. Mojokerto</span></li>
                    <li class="footer-contact-item"><i class="fa-solid fa-phone"></i><span>+62 852-3241-1498</span></li>
                    <li class="footer-contact-item"><i class="fa-solid fa-envelope"></i><span>pawonlokal@gmail.com</span></li>
                    <li class="footer-contact-item"><i class="fa-solid fa-clock"></i><span>Senin–Sabtu, 07.00–17.00 WIB</span></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} <a href="{{ url('/') }}">PawonLokal</a>. Hak cipta dilindungi.</p>
            <p>Dibuat dengan <i class="fa-solid fa-heart" style="color:var(--white);"></i> untuk Nusantara</p>
        </div>
    </footer>

    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>