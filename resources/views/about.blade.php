<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami – PawonLokal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- CSS External --}}
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>
<body>

{{-- NAVBAR - WHITE BACKGROUND --}}
<nav id="navbar">
    <a href="{{ url('/') }}" class="nav-logo">
        <img src="{{ asset('images/logoPL3.png') }}" alt="PawonLokal Logo">
        <span>PawonLokal</span>
    </a>

    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/about') }}" class="active">Tentang Kami</a></li>
        <li><a href="{{ url('/produk') }}">Produk</a></li>
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

    <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>

{{-- Mobile Menu --}}
<div class="mobile-menu" id="mobileMenu">
    <a href="{{ url('/') }}">Home</a>
    <a href="{{ url('/about') }}" style="color:var(--crimson);font-weight:700;">Tentang Kami</a>
    @auth
        <a href="#" onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();" style="color:var(--crimson);font-weight:700;">Logout →</a>
        <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
    @else
        <a href="{{ url('/login') }}" style="color:var(--crimson);font-weight:700;">Login →</a>
    @endauth
</div>

{{-- HERO ABOUT - RED BACKGROUND --}}
<div class="about-hero">
    <div class="hero-blob-red"></div>

    <div class="about-hero-inner">
        <div class="about-hero-text">
            <div class="hero-breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <i class="fa-solid fa-chevron-right" style="font-size:0.65rem;"></i>
                <span>Tentang Kami</span>
            </div>
            <div class="about-hero-badge">
                <i class="fa-solid fa-award"></i>
                Dapur Tradisional Sejak 2010
            </div>
            <h1 class="about-hero-title">
                Cerita di Balik<br>
                Setiap <em>Kue Kami</em>
            </h1>
            <p class="about-hero-desc">
                PawonLokal lahir dari kecintaan Bu Nanik terhadap kue tradisional Indonesia.
                Berdiri tahun 2010, kami terus menjaga keaslian resep warisan agar cita rasa
                lokal tetap hidup dari generasi ke generasi.
            </p>
        </div>

        <div class="about-hero-photo">
            <div class="photo-frame">
                <img
                    src="{{ asset('images/denanik.jpeg') }}"
                    alt="Bu Nanik – Pendiri PawonLokal"
                    onerror="this.style.background='#c8a96e';this.style.minHeight='440px';"
                >
                <div class="photo-name-badge">
                    <div class="badge-name">Bu Nanik</div>
                    <div class="badge-role">Founder & Head Chef</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- STATS BAR - WHITE BACKGROUND --}}
<div class="stats-bar">
    <div class="stats-inner">
        <div class="stat-box reveal">
            <div class="stat-box-num" data-count="14">0</div>
            <div class="stat-box-label">Tahun Pengalaman</div>
        </div>
        <div class="stat-box reveal reveal-delay-1">
            <div class="stat-box-num" data-count="200">0+</div>
            <div class="stat-box-label">Pelanggan Puas</div>
        </div>
        <div class="stat-box reveal reveal-delay-2">
            <div class="stat-box-num" data-count="30">0+</div>
            <div class="stat-box-label">Jenis Kue</div>
        </div>
        <div class="stat-box reveal reveal-delay-3">
            <div class="stat-box-num">4.9<i class="fa-solid fa-star" style="font-size:1.8rem;color:var(--gold);margin-left:4px;"></i></div>
            <div class="stat-box-label">Rating Rata-rata</div>
        </div>
    </div>
</div>

{{-- STORY — kisah pendiri --}}
<section class="story-section">
    <div class="max-w">
        <div class="story-grid">
            <div class="reveal-left">
                <div class="story-quote-card">
                    <p>
                        "Setiap kue yang kami buat bukan sekadar makanan — ia adalah jembatan
                        antara kenangan masa lalu dan kebahagiaan hari ini. Kami memasak dengan
                        hati, untuk hati."
                    </p>
                    <div class="story-quote-author">
                        <img
                            src="{{ asset('images/denanik.jpeg') }}"
                            alt="Bu Nanik"
                            onerror="this.style.background='#c8a96e';"
                        >
                        <div>
                            <div class="story-quote-author-name">Bu Nanik</div>
                            <div class="story-quote-author-role">Founder PawonLokal</div>
                        </div>
                    </div>
                </div>

                <div class="timeline" style="margin-top:40px;">
                    <div class="timeline-item">
                        <div class="timeline-year">2010</div>
                        <div class="timeline-divider">
                            <div class="timeline-dot"></div>
                            <div class="timeline-line"></div>
                        </div>
                        <div class="timeline-content">
                            <h4>Dapur Rumahan Pertama</h4>
                            <p>Mulai berjualan kue tradisional dari dapur rumah dengan 5 jenis produk.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2015</div>
                        <div class="timeline-divider">
                            <div class="timeline-dot"></div>
                            <div class="timeline-line"></div>
                        </div>
                        <div class="timeline-content">
                            <h4>Toko Fisik Pertama</h4>
                            <p>Membuka outlet pertama di Mojokerto dengan 20+ jenis kue tersedia.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2020</div>
                        <div class="timeline-divider">
                            <div class="timeline-dot"></div>
                            <div class="timeline-line"></div>
                        </div>
                        <div class="timeline-content">
                            <h4>Go Digital & E-Commerce</h4>
                            <p>Meluncurkan toko online PawonLokal untuk melayani seluruh Indonesia.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2024</div>
                        <div class="timeline-divider">
                            <div class="timeline-dot"></div>
                        </div>
                        <div class="timeline-content">
                            <h4>200+ Pelanggan Setia</h4>
                            <p>Dipercaya ratusan keluarga Indonesia dengan rating 4.9 bintang.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="story-text reveal-right">
                <div class="section-label"><i class="fa-solid fa-book-open"></i> Kisah Kami</div>
                <div class="ornament">
                    <div class="ornament-line"></div>
                    <div class="ornament-dot"></div>
                    <div class="ornament-line"></div>
                </div>
                <h2 class="section-title">
                    Dari Dapur Kecil<br>Menuju <em>Meja Makan</em> Anda
                </h2>
                <p>
                    Bu Nanik adalah sosok di balik dapur PawonLokal. Lahir tahun 1980, beliau mulai
                    belajar membuat kue sejak 2012. Bersama ibu dan neneknya, Bu Nanik menyerap
                    kekayaan resep turun-temurun yang hampir terlupakan oleh generasi modern.
                </p>
                <p>
                    Berawal dari keresahan melihat kue-kue tradisional yang semakin tergeser oleh
                    produk pabrikan, Bu Nanik bertekad untuk melestarikan cita rasa asli Indonesia.
                    Setiap resep dicatat, diuji, dan disempurnakan agar tetap autentik namun bisa
                    dinikmati oleh semua kalangan.
                </p>
                <p>
                    Kini, PawonLokal hadir tidak hanya sebagai toko kue, tetapi sebagai penjaga
                    warisan kuliner Nusantara. Kami bangga menjadi bagian dari momen bahagia
                    keluarga Indonesia — dari meja lebaran, ulang tahun, hingga pernikahan.
                </p>

                <div style="margin-top:32px; display:flex; flex-direction:column; gap:18px;">
                    <div style="display:flex;align-items:center;gap:16px;padding:16px 20px;background:rgba(139,26,26,0.05);border-radius:14px;border-left:4px solid var(--crimson);">
                        <i class="fa-solid fa-leaf" style="color:var(--crimson);font-size:1.2rem;flex-shrink:0;"></i>
                        <div>
                            <strong style="color:var(--text-dark);font-size:0.92rem;">Bahan 100% Alami</strong>
                            <p style="font-size:0.82rem;color:var(--text-light);margin:2px 0 0;line-height:1.5;">Dipilih segar setiap pagi dari pasar lokal, bebas pengawet dan pewarna buatan.</p>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:16px;padding:16px 20px;background:rgba(139,26,26,0.05);border-radius:14px;border-left:4px solid var(--gold);">
                        <i class="fa-solid fa-fire-flame-curved" style="color:var(--gold);font-size:1.2rem;flex-shrink:0;"></i>
                        <div>
                            <strong style="color:var(--text-dark);font-size:0.92rem;">Fresh Every Day</strong>
                            <p style="font-size:0.82rem;color:var(--text-light);margin:2px 0 0;line-height:1.5;">Tidak ada stok lama. Setiap pesanan dipanggang fresh di hari yang sama.</p>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:16px;padding:16px 20px;background:rgba(139,26,26,0.05);border-radius:14px;border-left:4px solid var(--crimson);">
                        <i class="fa-solid fa-shield-halved" style="color:var(--crimson);font-size:1.2rem;flex-shrink:0;"></i>
                        <div>
                            <strong style="color:var(--text-dark);font-size:0.92rem;">Halal & Higienis</strong>
                            <p style="font-size:0.82rem;color:var(--text-light);margin:2px 0 0;line-height:1.5;">Semua produk dibuat di dapur bersertifikat higienis dengan bahan halal terjamin.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- NILAI DAN KOMITMEN --}}
<section class="nilai-section">
    <div class="max-w">
        <div class="nilai-header reveal">
            <div class="section-label"><i class="fa-solid fa-gem"></i> Prinsip Kami</div>
            <div class="ornament centered">
                <div class="ornament-line" style="background:linear-gradient(90deg,transparent,rgba(232,184,109,0.4),transparent);"></div>
                <div class="ornament-dot" style="background:var(--gold-light);"></div>
                <div class="ornament-line" style="background:linear-gradient(90deg,transparent,rgba(232,184,109,0.4),transparent);"></div>
            </div>
            <h2 class="section-title">Nilai dan <em style="color:var(--gold-light);">Komitmen</em></h2>
        </div>

        <div class="nilai-grid">
            <div class="nilai-card reveal">
                <div class="nilai-card-icon"><i class="fa-solid fa-star-half-stroke"></i></div>
                <h3>Nilai Kami</h3>
                <ul>
                    <li>Rasa yang Terjaga — Mengutamakan cita rasa autentik yang konsisten dan berkualitas.</li>
                    <li>Kualitas & Konsistensi — Menggunakan bahan terbaik dan proses pembuatan yang terstandar.</li>
                    <li>Tanggung Jawab dalam Pelayanan — Memberikan pengalaman belanja yang ramah, cepat, dan responsif.</li>
                    <li>Tradisi yang Terus Hidup — Menjaga resep leluhur agar tetap relevan bagi generasi mendatang.</li>
                </ul>
            </div>

            <div class="nilai-card reveal reveal-delay-1">
                <div class="nilai-card-icon"><i class="fa-solid fa-handshake"></i></div>
                <h3>Komitmen Kami</h3>
                <ul>
                    <li>Menjaga kualitas rasa dengan standar tinggi dan evaluasi produk setiap hari.</li>
                    <li>Memastikan pengiriman yang tepat waktu, rapi, dan responsif kepada pelanggan.</li>
                    <li>Selalu berinovasi pada varian baru tanpa melupakan akar tradisional kami.</li>
                    <li>Terus bertumbuh agar kue tradisional semakin dikenal dan dicintai semua orang.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- VISI & MISI --}}
<section class="visimisi-section">
    <div class="max-w">
        <div class="visimisi-header reveal">
            <div class="section-label" style="justify-content:center;"><i class="fa-solid fa-compass"></i> Arah Kami</div>
            <div class="ornament centered">
                <div class="ornament-line"></div>
                <div class="ornament-dot"></div>
                <div class="ornament-line"></div>
            </div>
            <h2 class="section-title" style="text-align:center;">Visi & <em>Misi</em></h2>
        </div>

        <div class="visimisi-grid">
            <div class="visimisi-card reveal">
                <div class="visimisi-card-icon"><i class="fa-solid fa-eye"></i></div>
                <h3>Visi</h3>
                <p>
                    Menjadi pilihan utama kue tradisional Indonesia yang hangat, otentik,
                    dan mudah dinikmati di meja keluarga setiap hari.
                </p>
            </div>

            <div class="visimisi-card reveal reveal-delay-1">
                <div class="visimisi-card-icon"><i class="fa-solid fa-bullseye"></i></div>
                <h3>Misi</h3>
                <p>
                    Membawa rasa warisan Nusantara ke setiap pesanan dengan kualitas,
                    kesegaran, dan sentuhan layanan yang tulus.
                </p>
                <ul>
                    <li><i class="fa-solid fa-check"></i> Menggunakan bahan lokal terbaik setiap hari</li>
                    <li><i class="fa-solid fa-check"></i> Memelihara resep tradisional tanpa mengurangi keaslian</li>
                    <li><i class="fa-solid fa-check"></i> Melayani dengan cepat, rapi, dan ramah</li>
                    <li><i class="fa-solid fa-check"></i> Mengajak lebih banyak orang mencintai kue Nusantara</li>
                    <li><i class="fa-solid fa-check"></i> Menjaga dapur bersih, halal, dan penuh rasa tanggung jawab</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- FOOTER - WHITE TEXT --}}
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

{{-- JavaScript External --}}
<script src="{{ asset('js/about.js') }}"></script>
</body>
</html>