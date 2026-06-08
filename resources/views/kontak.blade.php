<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak – PawonLokal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
</head>
<body>

<nav id="navbar">
    <a href="{{ url('/') }}" class="nav-logo">
        <img src="{{ asset('images/logoPL.png') }}" alt="PawonLokal Logo">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
        <li><a href="{{ url('/produk') }}">Produk</a></li>
        <li><a href="{{ url('/kontak') }}" class="active">Kontak</a></li>
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

<section class="contact-section">
    <div class="contact-inner">
        <div class="contact-header">
            <span class="section-label">Hubungi Kami</span>
            <h2 class="section-title">Konsultasi cepat untuk <em>membantu</em><br>Anda memilih kue terbaik</h2>
            <p class="section-sub">Hubungi tim PawonLokal untuk konsultasi produk, ketersediaan, atau bantuan pemesanan dengan layanan personal.</p>
        </div>

        <div class="contact-grid">
            <div class="contact-card">
                <div class="contact-card-head">
                    <h3>Informasi Kontak</h3>
                    <p>Tim kami siap membantu setiap hari kerja. Hubungi kami langsung melalui WhatsApp untuk jawaban cepat.</p>
                </div>
                <div class="contact-list">
                    <div class="contact-item">
                        <i class="fa-solid fa-phone"></i>
                        <div>
                            <span>WhatsApp</span>
                            <a href="https://wa.me/6285232411498" target="_blank">+62 852-3241-1498</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <div>
                            <span>Alamat</span>
                            <p>Dsn. Kalitengah Ds. Bangun RT.01 RW.01 Kec. Pungging Kab. Mojokerto</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fa-solid fa-clock"></i>
                        <div>
                            <span>Jam Operasional</span>
                            <p>Senin–Sabtu, 07.00–17.00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-card-head">
                    <h3>Form Konsultasi</h3>
                    <p>Isi data singkat dan kirim langsung ke WhatsApp kami untuk respons cepat.</p>
                </div>
                <form id="contactForm" onsubmit="return false;">
                    <div class="form-row">
                        <label>Nama Lengkap</label>
                        <input type="text" id="contactName" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="form-row">
                        <label>Nomor WhatsApp</label>
                        <input type="tel" id="contactPhone" placeholder="62812xxxxxxx" required>
                    </div>
                    <div class="form-row">
                        <label>Produk yang diminati</label>
                        <input type="text" id="contactProduct" placeholder="Contoh: Klepon, Nastar" required>
                    </div>
                    <div class="form-row">
                        <label>Pesan</label>
                        <textarea id="contactMessage" rows="4" placeholder="Tuliskan pesan atau pertanyaan Anda" required></textarea>
                    </div>
                    <button type="button" id="sendWhatsappBtn" class="btn-contact">Kirim ke WhatsApp</button>
                </form>
            </div>
        </div>

        <div class="contact-map">
            <iframe src="https://www.google.com/maps?q=Dsn.%20Kalitengah%20Ds.%20Bangun%20RT.01%20RW.01%20Kec.%20Pungging%20Kab.%20Mojokerto&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<footer>
    <div class="footer-grid">
        <div>
            <div class="footer-brand-logo">
                <img src="{{ asset('images/logoPL.png') }}" alt="PawonLokal">
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
<script src="{{ asset('js/kontak.js') }}"></script>
</body>
</html>