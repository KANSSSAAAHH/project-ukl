<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin – PawonLokal</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root {
    --crimson:      #8B1A1A;
    --crimson-deep: #5C0D0D;
    --crimson-soft: #B22222;
    --crimson-pale: rgba(139,26,26,0.08);
    --gold:         #C9923A;
    --gold-light:   #E8B86D;
    --cream:        #FDF6ED;
    --cream-dark:   #F5E6CC;
    --brown:        #3D1C00;
    --sidebar-bg:   #1C0A0A;
    --sidebar-w:    256px;
    --text-dark:    #1E0A00;
    --text-mid:     #5C3317;
    --text-light:   #9E7650;
    --white:        #FFFFFF;
    --shadow:       0 4px 24px rgba(139,26,26,0.12);
    --shadow-lg:    0 8px 40px rgba(139,26,26,0.18);
    --radius:       16px;
    --tr:           0.3s cubic-bezier(0.4,0,0.2,1);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { font-size: 16px; }
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--cream);
    color: var(--text-dark);
    overflow-x: hidden;
}

.wrapper { display: flex; min-height: 100vh; }

/* SIDEBAR */
.sidebar {
    width: var(--sidebar-w);
    background: var(--sidebar-bg);
    position: fixed; top: 0; left: 0; bottom: 0;
    z-index: 300;
    display: flex; flex-direction: column;
    overflow-y: auto;
    transition: transform var(--tr);
}
.sidebar-logo {
    padding: 24px 20px 20px;
    display: flex; align-items: center; gap: 12px;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.sidebar-logo img { width: 40px; height: 40px; object-fit: contain; border-radius: 10px; }
.sidebar-logo-text { flex: 1; }
.sidebar-logo-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem; font-weight: 800;
    color: var(--white); letter-spacing: -0.01em;
}
.sidebar-logo-sub {
    font-size: 0.65rem; color: rgba(255,255,255,0.35);
    text-transform: uppercase; letter-spacing: 0.1em;
}
.sidebar-profile {
    margin: 16px 12px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 14px;
    display: flex; align-items: center; gap: 10px;
}
.sidebar-profile img {
    width: 42px; height: 42px; border-radius: 50%;
    object-fit: cover; object-position: top;
    border: 2px solid rgba(201,146,58,0.5);
    flex-shrink: 0;
}
.profile-name { font-weight: 700; font-size: 0.85rem; color: var(--white); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.profile-role { font-size: 0.68rem; color: var(--gold-light); text-transform: uppercase; letter-spacing: 0.08em; }
.nav-section {
    padding: 16px 20px 6px;
    font-size: 0.62rem; font-weight: 700; letter-spacing: 0.14em;
    text-transform: uppercase; color: rgba(255,255,255,0.28);
}
.sidebar nav { padding: 0 8px; }
.sidebar nav a {
    display: flex; align-items: center; gap: 11px;
    padding: 11px 14px; border-radius: 10px; margin-bottom: 2px;
    text-decoration: none; color: rgba(255,255,255,0.55);
    font-size: 0.87rem; font-weight: 500;
    transition: background var(--tr), color var(--tr);
}
.sidebar nav a i { width: 18px; text-align: center; font-size: 0.9rem; flex-shrink: 0; }
.sidebar nav a:hover { background: rgba(255,255,255,0.07); color: var(--white); }
.sidebar nav a.active {
    background: linear-gradient(135deg, var(--crimson), var(--crimson-soft));
    color: var(--white);
    box-shadow: 0 4px 16px rgba(139,26,26,0.4);
}
.sidebar-foot {
    margin-top: auto;
    padding: 12px 8px 16px;
    border-top: 1px solid rgba(255,255,255,0.06);
}
.sidebar-foot a {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 14px; border-radius: 10px;
    text-decoration: none; color: rgba(255,255,255,0.4);
    font-size: 0.85rem; font-weight: 500;
    transition: background var(--tr), color var(--tr);
}
.sidebar-foot a:hover { background: rgba(231,76,60,0.15); color: #f87171; }

/* MAIN */
.main { margin-left: var(--sidebar-w); flex: 1; min-width: 0; display: flex; flex-direction: column; }

/* TOPBAR */
.topbar {
    background: rgba(253,246,237,0.92);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(201,146,58,0.15);
    padding: 0 32px;
    height: 68px;
    display: flex; align-items: center; justify-content: space-between;
    position: sticky; top: 0; z-index: 200;
    box-shadow: 0 1px 12px rgba(139,26,26,0.06);
}
.topbar-left { display: flex; align-items: center; gap: 14px; }
.hamburger-btn {
    background: none; border: none; cursor: pointer;
    padding: 8px; border-radius: 8px; color: var(--text-mid);
    font-size: 1rem; transition: background var(--tr);
}
.hamburger-btn:hover { background: var(--crimson-pale); }
.topbar-title { font-weight: 700; font-size: 1rem; color: var(--text-dark); }
.topbar-breadcrumb {
    font-size: 0.75rem; color: var(--text-light);
    display: flex; align-items: center; gap: 5px; margin-top: 1px;
}
.topbar-breadcrumb span { color: var(--crimson); font-weight: 600; }

/* CONTENT */
.content { padding: 28px 32px; flex: 1; }

/* GREETING CARD */
.greeting-card {
    background: linear-gradient(135deg, var(--crimson-deep) 0%, var(--crimson) 55%, #9B2020 100%);
    border-radius: 20px;
    padding: 28px 32px;
    margin-bottom: 28px;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    box-shadow: 0 8px 32px rgba(139,26,26,0.3);
}
.greeting-card::before {
    content: '';
    position: absolute; inset: 0;
    background-image: repeating-linear-gradient(
        45deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 1px,
        transparent 1px, transparent 40px
    );
    pointer-events: none;
}
.greeting-card::after {
    content: '';
    position: absolute;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(201,146,58,0.2) 0%, transparent 70%);
    top: -80px; right: -60px;
    border-radius: 50%;
    filter: blur(40px);
    pointer-events: none;
}
.greeting-left { position: relative; z-index: 1; }
.greeting-time {
    font-size: 0.75rem; font-weight: 600; letter-spacing: 0.1em;
    text-transform: uppercase; color: rgba(255,255,255,0.55);
    margin-bottom: 8px;
    display: flex; align-items: center; gap: 6px;
}
.greeting-hello {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 800; color: var(--white);
    line-height: 1.2; margin-bottom: 10px;
    animation: slideUp 0.7s ease both;
}
.greeting-hello em { font-style: italic; color: var(--gold-light); }
@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
.greeting-sub {
    color: rgba(255,255,255,0.7);
    font-size: 0.88rem; line-height: 1.6;
    max-width: 420px;
    animation: slideUp 0.7s 0.1s ease both;
}
.greeting-right {
    position: relative; z-index: 1;
    display: flex; align-items: flex-end;
    flex-shrink: 0;
}
.greeting-photo {
    width: 130px; height: 155px;
    object-fit: cover; object-position: top;
    border-radius: 16px 16px 0 0;
    border: 3px solid rgba(201,146,58,0.4);
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    display: block;
}
.greeting-badge {
    position: absolute;
    bottom: 12px; left: -20px;
    background: var(--white);
    border-radius: 10px; padding: 8px 12px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    min-width: 120px;
}
.greeting-badge-name {
    font-family: 'Playfair Display', serif;
    font-size: 0.88rem; font-weight: 800; color: var(--text-dark);
}
.greeting-badge-role {
    font-size: 0.65rem; color: var(--crimson);
    text-transform: uppercase; letter-spacing: 0.08em; font-weight: 600;
}
.greeting-date {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50px; padding: 6px 14px;
    color: rgba(255,255,255,0.85); font-size: 0.8rem; font-weight: 500;
    margin-top: 14px;
    animation: slideUp 0.7s 0.2s ease both;
}

/* STATS GRID */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px; margin-bottom: 28px;
}
.stat-card {
    background: var(--white);
    border-radius: var(--radius);
    padding: 22px;
    box-shadow: var(--shadow);
    display: flex; align-items: center; gap: 16px;
    border-left: 4px solid transparent;
    transition: transform var(--tr), box-shadow var(--tr);
    animation: fadeInUp 0.6s ease both;
}
.stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
.stat-card:nth-child(1) { border-left-color: var(--crimson); animation-delay: 0.1s; }
.stat-card:nth-child(2) { border-left-color: var(--gold); animation-delay: 0.2s; }
.stat-card:nth-child(3) { border-left-color: #16a34a; animation-delay: 0.3s; }
.stat-card:nth-child(4) { border-left-color: #2563eb; animation-delay: 0.4s; }
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}
.stat-icon {
    width: 50px; height: 50px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem; flex-shrink: 0;
}
.stat-card:nth-child(1) .stat-icon { background: rgba(139,26,26,0.1); color: var(--crimson); }
.stat-card:nth-child(2) .stat-icon { background: rgba(201,146,58,0.12); color: var(--gold); }
.stat-card:nth-child(3) .stat-icon { background: #dcfce7; color: #16a34a; }
.stat-card:nth-child(4) .stat-icon { background: #dbeafe; color: #2563eb; }
.stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 1.9rem; font-weight: 800;
    color: var(--text-dark); line-height: 1; margin-bottom: 4px;
}
.stat-label { font-size: 0.78rem; color: var(--text-light); font-weight: 500; }
.stat-change { font-size: 0.72rem; font-weight: 600; margin-top: 4px; display: flex; align-items: center; gap: 3px; }
.stat-change.up { color: #16a34a; }
.stat-change.neutral { color: var(--text-light); }

/* TWO COL */
.two-col { display: grid; grid-template-columns: 1.4fr 1fr; gap: 20px; margin-bottom: 20px; }
.three-col { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px; }

/* CARD */
.card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; animation: fadeInUp 0.6s 0.3s ease both; }
.card-head {
    padding: 18px 22px 14px;
    display: flex; align-items: center; justify-content: space-between;
    border-bottom: 1px solid #f0e8de;
}
.card-head-left h3 { font-weight: 700; font-size: 0.95rem; color: var(--text-dark); margin-bottom: 2px; }
.card-head-left p  { font-size: 0.75rem; color: var(--text-light); }
.card-head-icon {
    width: 36px; height: 36px; border-radius: 10px;
    background: var(--crimson-pale); color: var(--crimson);
    display: flex; align-items: center; justify-content: center; font-size: 0.9rem;
}

/* TABLE */
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; }
thead th {
    background: #faf5ef; padding: 11px 16px;
    text-align: left; font-size: 0.72rem; font-weight: 700;
    letter-spacing: 0.07em; text-transform: uppercase; color: var(--text-mid);
    border-bottom: 1px solid #f0e8de; white-space: nowrap;
}
tbody tr { transition: background var(--tr); }
tbody tr:hover { background: #fdf8f4; }
tbody td {
    padding: 12px 16px; font-size: 0.83rem;
    border-bottom: 1px solid #f7f1eb; vertical-align: middle;
    color: var(--text-dark);
}
tbody tr:last-child td { border-bottom: none; }
.prod-img { width: 40px; height: 40px; border-radius: 8px; object-fit: cover; border: 2px solid #f0e8de; background: #f5ece0; }
.prod-img-placeholder {
    width: 40px; height: 40px; border-radius: 8px;
    background: linear-gradient(135deg, #f5ece0, #e8d8c0);
    display: flex; align-items: center; justify-content: center;
    color: #c8a06a; font-size: 1rem;
}
.prod-name { font-weight: 600; color: var(--text-dark); }

/* BADGE */
.badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 50px; font-size: 0.72rem; font-weight: 600; }
.badge-aktif     { background: #dcfce7; color: #15803d; }
.badge-nonaktif  { background: #fee2e2; color: #b91c1c; }
.badge-kering    { background: #fef3c7; color: #92400e; }
.badge-basah     { background: #dbeafe; color: #1e40af; }
.badge-menunggu  { background: #fef3c7; color: #92400e; }
.badge-diproses  { background: #dbeafe; color: #1e40af; }
.badge-selesai   { background: #dcfce7; color: #15803d; }
.badge-lunas     { background: #dcfce7; color: #15803d; }
.harga { font-weight: 600; color: var(--crimson); }

/* MINI STATS */
.mini-stats { padding: 16px 22px; display: flex; flex-direction: column; gap: 14px; }
.mini-stat-item {
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 16px; border-radius: 12px;
    background: #faf5ef; border: 1px solid #f0e8de;
    transition: background var(--tr);
}
.mini-stat-item:hover { background: var(--cream-dark); }
.mini-stat-left { display: flex; align-items: center; gap: 12px; }
.mini-stat-icon { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; }
.mini-stat-label { font-weight: 600; font-size: 0.85rem; color: var(--text-dark); }
.mini-stat-sub   { font-size: 0.72rem; color: var(--text-light); }
.mini-stat-val   { font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 800; color: var(--text-dark); }

/* QUICK ACTIONS */
.quick-actions { padding: 16px 22px; display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.qa-btn {
    display: flex; flex-direction: column; align-items: center; gap: 6px;
    padding: 16px 10px; border-radius: 12px; text-decoration: none;
    font-size: 0.78rem; font-weight: 600; text-align: center;
    transition: transform var(--tr), box-shadow var(--tr);
    border: 1.5px solid transparent;
}
.qa-btn:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
.qa-btn i { font-size: 1.3rem; }
.qa-btn.red   { background: rgba(139,26,26,0.08); color: var(--crimson); border-color: rgba(139,26,26,0.15); }
.qa-btn.gold  { background: rgba(201,146,58,0.1);  color: var(--gold);   border-color: rgba(201,146,58,0.2); }
.qa-btn.green { background: #dcfce7; color: #16a34a; border-color: #bbf7d0; }
.qa-btn.blue  { background: #dbeafe; color: #2563eb; border-color: #bfdbfe; }

/* REVIEW */
.reviews-list { padding: 8px 22px 16px; display: flex; flex-direction: column; gap: 12px; }
.review-item {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 12px; border-radius: 12px; background: #faf5ef;
    border: 1px solid #f0e8de;
}
.review-avatar {
    width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg, var(--crimson), var(--gold));
    display: flex; align-items: center; justify-content: center;
    color: var(--white); font-weight: 700; font-size: 0.85rem;
    font-family: 'Playfair Display', serif;
}
.review-name  { font-weight: 700; font-size: 0.82rem; color: var(--text-dark); }
.review-stars { color: var(--gold); font-size: 0.72rem; margin: 2px 0; }
.review-text  { font-size: 0.78rem; color: var(--text-mid); line-height: 1.5; font-style: italic; }

/* EMPTY */
.empty { text-align: center; padding: 40px 20px; color: var(--text-light); }
.empty i { font-size: 2rem; opacity: .3; display: block; margin-bottom: 8px; }
.empty p { font-size: 0.82rem; }

/* RESPONSIVE */
@media (max-width: 1200px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .two-col    { grid-template-columns: 1fr; }
    .three-col  { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 900px) {
    .sidebar { transform: translateX(-100%); }
    .sidebar.open { transform: translateX(0); }
    .main { margin-left: 0; }
    .greeting-right { display: none; }
    .three-col { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .content { padding: 16px; }
    .topbar  { padding: 0 16px; }
    .stats-grid { grid-template-columns: 1fr; }
    .quick-actions { grid-template-columns: repeat(4,1fr); }
    .qa-btn { padding: 12px 6px; font-size: 0.65rem; }
}
</style>
</head>
<body>

<div class="wrapper">

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">

    <div class="sidebar-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
        <div class="sidebar-logo-text">
            <div class="sidebar-logo-name">PawonLokal</div>
            <div class="sidebar-logo-sub">Admin Panel</div>
        </div>
    </div>

    <div class="sidebar-profile">
        <img src="{{ asset('images/denanik.jpeg') }}" alt="Admin"
             onerror="this.style.background='#8B1A1A';this.style.display='flex';">
        <div style="min-width:0">
            <div class="profile-name">Bu Nanik</div>
            <div class="profile-role">Administrator</div>
        </div>
    </div>

    <div class="nav-section">Menu Utama</div>
    <nav>
        <a href="{{ url('/admin/dashboard') }}" class="active">
            <i class="fa-solid fa-gauge-high"></i> Dashboard
        </a>
        <a href="{{ url('/admin/produk') }}">
            <i class="fa-solid fa-box"></i> Produk
        </a>
        <a href="{{ url('/admin/pesanan') }}">
            <i class="fa-solid fa-clipboard-list"></i> Pesanan
        </a>
        <a href="{{ url('/admin/detail-pesanan') }}">
            <i class="fa-solid fa-list-check"></i> Detail Pesanan
        </a>
        <a href="{{ url('/admin/pembayaran') }}">
            <i class="fa-solid fa-credit-card"></i> Pembayaran
        </a>
        <a href="{{ url('/admin/pengiriman') }}">
            <i class="fa-solid fa-truck"></i> Pengiriman
        </a>
        <a href="{{ url('/admin/keranjang') }}">
            <i class="fa-solid fa-basket-shopping"></i> Keranjang
        </a>
        <a href="{{ url('/admin/review') }}">
            <i class="fa-solid fa-star"></i> Review
        </a>
        <a href="{{ url('/admin/users') }}">
            <i class="fa-solid fa-users"></i> Users
        </a>
    </nav>

    <div class="sidebar-foot">
        <a href="{{ url('/') }}" target="_blank">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Website
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="width:100%;background:none;border:none;cursor:pointer;
                display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;
                color:rgba(255,255,255,0.4);font-size:0.85rem;font-weight:500;font-family:inherit;
                transition:background 0.3s,color 0.3s;"
                onmouseover="this.style.background='rgba(231,76,60,0.15)';this.style.color='#f87171'"
                onmouseout="this.style.background='none';this.style.color='rgba(255,255,255,0.4)'">
                <i class="fa-solid fa-right-from-bracket" style="width:18px;text-align:center"></i> Logout
            </button>
        </form>
    </div>

</aside>

{{-- MAIN --}}
<div class="main">

    {{-- TOPBAR — tombol notif, gear, avatar dihapus --}}
    <div class="topbar">
        <div class="topbar-left">
            <button class="hamburger-btn" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div>
                <div class="topbar-title">Dashboard</div>
                <div class="topbar-breadcrumb">
                    Admin <i class="fa-solid fa-chevron-right" style="font-size:.55rem"></i>
                    <span>Dashboard</span>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content">

        {{-- GREETING CARD --}}
        <div class="greeting-card">
            <div class="greeting-left">
                <div class="greeting-time">
                    <i class="fa-solid fa-sun"></i>
                    <span id="greetTime">Selamat Datang</span>
                </div>
                <div class="greeting-hello">
                    Hai, <em>Bu Nanik!</em> 👋
                </div>
                <div class="greeting-sub">
                    Selamat mengelola toko PawonLokal hari ini. Semua data produk,
                    pesanan, dan pelanggan bisa kamu pantau dari sini.
                </div>
                <div class="greeting-date">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span id="todayDate">Hari ini</span>
                </div>
            </div>
            <div class="greeting-right">
                <img class="greeting-photo"
                     src="{{ asset('images/denanik.jpeg') }}"
                     alt="Bu Nanik"
                     onerror="this.style.display='none'">
                <div class="greeting-badge">
                    <div class="greeting-badge-name">Bu Nanik</div>
                    <div class="greeting-badge-role">Head Chef & Admin</div>
                </div>
            </div>
        </div>

        {{-- STATS CARDS --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-box"></i></div>
                <div>
                    <div class="stat-num">{{ $totalProduk }}</div>
                    <div class="stat-label">Total Produk</div>
                    <div class="stat-change neutral">
                        <i class="fa-solid fa-circle-dot"></i> {{ $produkAktif }} aktif
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                <div>
                    <div class="stat-num">{{ $totalPesanan }}</div>
                    <div class="stat-label">Total Pesanan</div>
                    <div class="stat-change up">
                        <i class="fa-solid fa-arrow-up"></i> {{ $pesananMenunggu }} menunggu
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                <div>
                    <div class="stat-num">{{ $totalUser }}</div>
                    <div class="stat-label">Total User</div>
                    <div class="stat-change neutral">
                        <i class="fa-solid fa-circle-dot"></i> Pelanggan terdaftar
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-star"></i></div>
                <div>
                    <div class="stat-num">{{ $totalReview }}</div>
                    <div class="stat-label">Total Review</div>
                    <div class="stat-change up">
                        <i class="fa-solid fa-arrow-up"></i> Ulasan pelanggan
                    </div>
                </div>
            </div>
        </div>

        {{-- TABEL PRODUK + QUICK ACTION --}}
        <div class="two-col">

            <div class="card">
                <div class="card-head">
                    <div class="card-head-left">
                        <h3>Daftar Produk</h3>
                        <p>{{ $totalProduk }} produk tersedia</p>
                    </div>
                    <a href="{{ url('/admin/produk') }}"
                       style="font-size:0.78rem;color:var(--crimson);font-weight:600;text-decoration:none;display:flex;align-items:center;gap:5px;">
                        Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkTerbaru as $p)
                            <tr>
                                <td>
                                    @if($p->foto)
                                        <img class="prod-img"
                                             src="{{ asset('storage/'.$p->foto) }}"
                                             alt="{{ $p->nama_produk }}"
                                             onerror="this.outerHTML='<div class=prod-img-placeholder><i class=fa-solid fa-cookie></i></div>'">
                                    @else
                                        <div class="prod-img-placeholder"><i class="fa-solid fa-cookie"></i></div>
                                    @endif
                                </td>
                                <td><div class="prod-name">{{ $p->nama_produk }}</div></td>
                                <td><span class="badge badge-{{ $p->kategori }}">{{ $p->kategori }}</span></td>
                                <td class="harga">Rp {{ number_format($p->harga,0,',','.') }}</td>
                                <td><span class="badge badge-{{ $p->status }}">{{ $p->status }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty">
                                        <i class="fa-solid fa-box-open"></i>
                                        <p>Belum ada produk</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:20px;">

                <div class="card">
                    <div class="card-head">
                        <div class="card-head-left">
                            <h3>Aksi Cepat</h3>
                            <p>Pintasan menu admin</p>
                        </div>
                        <div class="card-head-icon"><i class="fa-solid fa-bolt"></i></div>
                    </div>
                    <div class="quick-actions">
                        <a href="{{ route('admin.produk.create') }}" class="qa-btn red">
                            <i class="fa-solid fa-plus"></i> Tambah Produk
                        </a>
                        <a href="{{ url('/admin/pesanan') }}" class="qa-btn gold">
                            <i class="fa-solid fa-clipboard-list"></i> Pesanan
                        </a>
                        <a href="{{ url('/admin/pembayaran') }}" class="qa-btn green">
                            <i class="fa-solid fa-credit-card"></i> Pembayaran
                        </a>
                        <a href="{{ url('/admin/users') }}" class="qa-btn blue">
                            <i class="fa-solid fa-users"></i> Users
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <div class="card-head-left">
                            <h3>Ringkasan Produk</h3>
                            <p>Per kategori & status</p>
                        </div>
                        <div class="card-head-icon"><i class="fa-solid fa-chart-pie"></i></div>
                    </div>
                    <div class="mini-stats">
                        <div class="mini-stat-item">
                            <div class="mini-stat-left">
                                <div class="mini-stat-icon" style="background:#fef3c7;color:#92400e;">
                                    <i class="fa-solid fa-cookie-bite"></i>
                                </div>
                                <div>
                                    <div class="mini-stat-label">Kue Kering</div>
                                    <div class="mini-stat-sub">Kategori kering</div>
                                </div>
                            </div>
                            <div class="mini-stat-val">{{ $produkKering }}</div>
                        </div>
                        <div class="mini-stat-item">
                            <div class="mini-stat-left">
                                <div class="mini-stat-icon" style="background:#dbeafe;color:#1e40af;">
                                    <i class="fa-solid fa-droplet"></i>
                                </div>
                                <div>
                                    <div class="mini-stat-label">Kue Basah</div>
                                    <div class="mini-stat-sub">Kategori basah</div>
                                </div>
                            </div>
                            <div class="mini-stat-val">{{ $produkBasah }}</div>
                        </div>
                        <div class="mini-stat-item">
                            <div class="mini-stat-left">
                                <div class="mini-stat-icon" style="background:#dcfce7;color:#15803d;">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div>
                                    <div class="mini-stat-label">Produk Aktif</div>
                                    <div class="mini-stat-sub">Status aktif</div>
                                </div>
                            </div>
                            <div class="mini-stat-val">{{ $produkAktif }}</div>
                        </div>
                        <div class="mini-stat-item">
                            <div class="mini-stat-left">
                                <div class="mini-stat-icon" style="background:#fee2e2;color:#b91c1c;">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </div>
                                <div>
                                    <div class="mini-stat-label">Nonaktif</div>
                                    <div class="mini-stat-sub">Status nonaktif</div>
                                </div>
                            </div>
                            <div class="mini-stat-val">{{ $totalProduk - $produkAktif }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- PESANAN + REVIEW --}}
        <div class="two-col">

            <div class="card">
                <div class="card-head">
                    <div class="card-head-left">
                        <h3>Pesanan Terbaru</h3>
                        <p>{{ $totalPesanan }} total pesanan</p>
                    </div>
                    <a href="{{ url('/admin/pesanan') }}"
                       style="font-size:0.78rem;color:var(--crimson);font-weight:600;text-decoration:none;display:flex;align-items:center;gap:5px;">
                        Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesananTerbaru as $ps)
                            <tr>
                                <td style="font-family:monospace;font-size:0.75rem;color:#aaa">#{{ $ps->id_pesanan }}</td>
                                <td>{{ \Carbon\Carbon::parse($ps->tanggal_pesanan)->format('d M Y') }}</td>
                                <td class="harga">Rp {{ number_format($ps->total_harga,0,',','.') }}</td>
                                <td><span class="badge badge-{{ $ps->status_pesanan }}">{{ $ps->status_pesanan }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty">
                                        <i class="fa-solid fa-clipboard-list"></i>
                                        <p>Belum ada pesanan</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-head">
                    <div class="card-head-left">
                        <h3>Review Terbaru</h3>
                        <p>{{ $totalReview }} ulasan masuk</p>
                    </div>
                    <a href="{{ url('/admin/review') }}"
                       style="font-size:0.78rem;color:var(--crimson);font-weight:600;text-decoration:none;display:flex;align-items:center;gap:5px;">
                        Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="reviews-list">
                    @forelse($reviewTerbaru as $rv)
                    <div class="review-item">
                        <div class="review-avatar">
                            {{ strtoupper(substr($rv->user->nama ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <div class="review-name">{{ $rv->user->nama ?? 'User' }}</div>
                            <div class="review-stars">
                                @for($s=1;$s<=5;$s++)
                                    <i class="fa-{{ $s <= $rv->rating ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            </div>
                            <div class="review-text">"{{ Str::limit($rv->komentar, 80) }}"</div>
                        </div>
                    </div>
                    @empty
                    <div class="empty">
                        <i class="fa-solid fa-star"></i>
                        <p>Belum ada review</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

</div>

</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}

(function() {
    const h = new Date().getHours();
    const greet = h < 11 ? 'Selamat Pagi ☀️'
                : h < 15 ? 'Selamat Siang 🌤️'
                : h < 18 ? 'Selamat Sore 🌅'
                :           'Selamat Malam 🌙';
    document.getElementById('greetTime').textContent = greet;
})();

(function() {
    const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const months = ['Januari','Februari','Maret','April','Mei','Juni',
                    'Juli','Agustus','September','Oktober','November','Desember'];
    const d = new Date();
    document.getElementById('todayDate').textContent =
        `${days[d.getDay()]}, ${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
})();
</script>

</body>
</html>