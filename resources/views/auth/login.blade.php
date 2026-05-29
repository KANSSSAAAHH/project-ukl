<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login – PawonLokal</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
    --crimson: #8B1A1A;
    --crimson-deep: #5C0D0D;
    --crimson-soft: #B22222;
    --gold: #C9923A;
    --gold-light: #E8B86D;
    --cream: #FDF6ED;
    --cream-dark: #F5E6CC;
    --text-dark: #1E0A00;
    --text-mid: #5C3317;
    --text-light: #9E7650;
    --white: #FFFFFF;
}

*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html, body {
    height: 100%;
    font-family: 'Plus Jakarta Sans', sans-serif;
    overflow: hidden;
}

/* =====================
   SPLIT LAYOUT
===================== */
.login-wrapper {
    display: flex;
    height: 100vh;
    width: 100vw;
}

/* =====================
   KIRI — VIDEO
===================== */
.login-left {
    flex: 1;
    position: relative;
    overflow: hidden;
}

/* Video mengisi penuh area kiri */
.login-left video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}

/* Overlay gelap di atas video supaya teks terbaca */
.login-left-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to right,
        rgba(92, 13, 13, 0.45) 0%,
        rgba(92, 13, 13, 0.2) 60%,
        transparent 100%
    );
    pointer-events: none;
}

/* Teks di pojok kiri bawah */
.login-left-text {
    position: absolute;
    bottom: 40px;
    left: 36px;
    z-index: 2;
}

.login-left-text h2 {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 800;
    color: var(--white);
    text-shadow: 0 2px 16px rgba(0, 0, 0, 0.5);
    line-height: 1.2;
    margin-bottom: 8px;
}

.login-left-text p {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.85);
    text-shadow: 0 1px 8px rgba(0, 0, 0, 0.4);
}

/* =====================
   KANAN — FORM LOGIN
===================== */
.login-right {
    width: 420px;
    flex-shrink: 0;
    background: var(--white);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 36px;
    overflow-y: auto;
    position: relative;
}

/* =====================
   LOGO & JUDUL
===================== */
.login-logo {
    text-align: center;
    margin-bottom: 24px;
    width: 100%;
}

.login-logo img {
    width: 72px;
    height: 72px;
    object-fit: contain;
    margin-bottom: 10px;
    filter: drop-shadow(0 4px 12px rgba(139, 26, 26, 0.2));
}

.login-logo-title {
    font-size: 1.3rem;
    font-weight: 800;
    color: var(--text-dark);
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

.login-logo-sub {
    font-size: 0.78rem;
    color: var(--text-light);
    margin-top: 4px;
}

/* =====================
   ALERT / NOTIFIKASI
===================== */
.alert-error {
    background: #fee2e2;
    border: 1px solid #fecaca;
    color: #b91c1c;
    padding: 10px 14px;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
}

.alert-status {
    background: #dcfce7;
    border: 1px solid #bbf7d0;
    color: #15803d;
    padding: 10px 14px;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 16px;
    width: 100%;
}

/* =====================
   FORM
===================== */
.login-form {
    width: 100%;
}

.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 6px;
}

.input-wrap {
    position: relative;
}

.input-wrap i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #b58b67;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 14px 16px 14px 44px;
    border: 1.5px solid #d9b9b9;
    border-radius: 16px;
    font-size: 0.92rem;
    font-family: inherit;
    color: var(--text-dark);
    background: #ffffff;
    transition: all 0.25s ease;
    outline: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}

.form-control:focus {
    border-color: var(--crimson);
    background: #fff;
    box-shadow: 0 0 0 4px rgba(139, 26, 26, 0.08);
}
.form-control::placeholder {
    color: #b0956e;
}
.error-msg {
    font-size: 0.75rem;
    color: var(--crimson);
    margin-top: 4px;
    font-weight: 600;
}

/* =====================
   REMEMBER ME
===================== */
.remember-row {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.remember-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.82rem;
    color: var(--text-mid);
    cursor: pointer;
}

.remember-label input {
    accent-color: var(--crimson);
    width: 15px;
    height: 15px;
}

/* =====================
   TOMBOL LOGIN
===================== */
.btn-login {
    width: 100%;
    padding: 13px;
    background: linear-gradient(135deg, var(--crimson), var(--crimson-soft));
    color: var(--white);
    border: none;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 700;
    font-family: inherit;
    cursor: pointer;
    letter-spacing: 0.02em;
    box-shadow: 0 6px 20px rgba(139, 26, 26, 0.35);
    transition: transform 0.2s, box-shadow 0.2s;
    margin-bottom: 18px;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(139, 26, 26, 0.45);
}

.btn-login:active {
    transform: translateY(0);
}

/* =====================
   LINK REGISTRASI
===================== */
.register-link {
    text-align: center;
    font-size: 0.82rem;
    color: var(--text-mid);
    font-weight: 600;
}

.register-link a {
    color: var(--crimson);
    font-weight: 700;
    text-decoration: none;
}

.register-link a:hover {
    text-decoration: underline;
}

/* =====================
   RESPONSIVE (HP)
===================== */
@media (max-width: 768px) {
    .login-left,
    .login-divider {
        display: none;
    }

    .login-right {
        width: 100%;
    }
}
</style>
</head>
<body>

<div class="login-wrapper">

    {{-- ================================
         KIRI: VIDEO
         Letakkan file video di:
         public/videos/kue2.mp4
    ================================ --}}
    <div class="login-left">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('videos/donat.mp4') }}" type="video/mp4">
            <source src="{{ asset('videos/donat.webm') }}" type="video/webm">
        </video>
        <div class="login-left-overlay"></div>
        <div class="login-left-text">
            <h2>Kue Tradisional<br>Terbaik untuk Anda</h2>
            <p>Dibuat dengan cinta, disajikan dengan kehangatan</p>
        </div>
    </div>

    {{-- ================================
         KANAN: FORM LOGIN
    ================================ --}}
    <div class="login-right">

        {{-- Logo & Judul --}}
        <div class="login-logo">
            <img src="{{ asset('images/LogoPL2.png') }}" alt="PawonLokal Logo"
                 onerror="this.style.display='none'">
            <div class="login-logo-title">LOGIN</div>
            <div class="login-logo-sub">Masuk ke akun PawonLokal kamu</div>
        </div>

        {{-- Notifikasi sukses (misal setelah reset password) --}}
        @if(session('status'))
            <div class="alert-status">{{ session('status') }}</div>
        @endif

        {{-- Notifikasi error login --}}
        @if($errors->any())
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                Email atau password salah!
            </div>
        @endif

        {{-- Form Login --}}
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            {{-- Input Email --}}
            <div class="form-group">
                <div class="input-wrap">
                    <i class="fa-regular fa-circle-user"></i>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Masukan Email"
                        required
                        autofocus>
                </div>
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Password --}}
            <div class="form-group">
                <div class="input-wrap">
                    <i class="fa-solid fa-lock"></i>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukan Password"
                        required>
                </div>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Ingat Saya --}}
            <div class="remember-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>
            </div>

            {{-- Link ke halaman registrasi --}}
            <div class="register-link" style="margin-bottom:16px;">
                Belum Punya Akun? <a href="{{ route('register') }}">Registrasi</a>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="btn-login">
                Login
            </button>

        </form>
    </div>

</div>

</body>
</html>