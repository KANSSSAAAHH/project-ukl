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

    <style>
        :root {
            --crimson:     #8B1A1A;
            --crimson-deep:#5C0D0D;
            --crimson-soft:#B22222;
            --gold:        #C9923A;
            --gold-light:  #E8B86D;
            --cream:       #FDF6ED;
            --cream-dark:  #F5E6CC;
            --brown:       #3D1C00;
            --text-dark:   #1E0A00;
            --text-mid:    #5C3317;
            --text-light:  #9E7650;
            --white:       #FFFFFF;
            --shadow-warm: 0 8px 40px rgba(139,26,26,0.18);
            --radius:      16px;
            --transition:  0.35s cubic-bezier(0.4,0,0.2,1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; font-size: 16px; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* ============================================================
           NAVBAR (sama persis dengan referensi)
        ============================================================ */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 0 40px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(253,246,237,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(201,146,58,0.2);
            transition: box-shadow var(--transition), background var(--transition);
        }
        nav.scrolled {
            background: rgba(253,246,237,0.97);
            box-shadow: 0 4px 30px rgba(139,26,26,0.12);
        }
        .nav-logo {
            display: flex; align-items: center; gap: 12px; text-decoration: none;
        }
        .nav-logo img { height: 44px; width: auto; object-fit: contain; }
        .nav-logo span {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem; font-weight: 800;
            color: var(--crimson); letter-spacing: -0.02em;
        }
        .nav-links {
            display: flex; align-items: center; gap: 8px; list-style: none;
        }
        .nav-links a {
            text-decoration: none; color: var(--text-mid); font-weight: 500;
            font-size: 0.92rem; padding: 8px 16px; border-radius: 50px;
            position: relative; transition: color var(--transition), background var(--transition);
        }
        .nav-links a::after {
            content: ''; position: absolute; bottom: 4px; left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 20px; height: 2px; background: var(--gold);
            border-radius: 2px; transition: transform var(--transition);
        }
        .nav-links a:hover { color: var(--crimson); background: rgba(139,26,26,0.06); }
        .nav-links a:hover::after { transform: translateX(-50%) scaleX(1); }
        .nav-links a.active { color: var(--crimson); background: rgba(139,26,26,0.08); }
        .nav-cta {
            background: var(--crimson) !important; color: var(--white) !important;
            padding: 10px 22px !important; border-radius: 50px !important;
            font-weight: 600 !important;
            transition: background var(--transition), transform var(--transition), box-shadow var(--transition) !important;
        }
        .nav-cta:hover {
            background: var(--crimson-deep) !important; transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139,26,26,0.35) !important;
        }
        .nav-cta::after { display: none !important; }
        .hamburger {
            display: none; flex-direction: column; gap: 5px;
            cursor: pointer; background: none; border: none; padding: 8px;
        }
        .hamburger span {
            display: block; width: 24px; height: 2px;
            background: var(--crimson); border-radius: 2px;
            transition: transform var(--transition), opacity var(--transition);
        }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        .mobile-menu {
            display: none; position: fixed; top: 72px; left: 0; right: 0;
            background: rgba(253,246,237,0.98); backdrop-filter: blur(20px);
            z-index: 999; padding: 20px 24px;
            border-bottom: 1px solid rgba(201,146,58,0.2);
            transform: translateY(-20px); opacity: 0;
            transition: transform var(--transition), opacity var(--transition);
        }
        .mobile-menu.open { display: block; transform: translateY(0); opacity: 1; }
        .mobile-menu a {
            display: block; text-decoration: none; color: var(--text-mid);
            font-weight: 500; padding: 14px 0;
            border-bottom: 1px solid rgba(201,146,58,0.15);
            transition: color var(--transition);
        }
        .mobile-menu a:hover { color: var(--crimson); }

        /* ============================================================
           HERO ABOUT — banner dengan foto founder overlap
        ============================================================ */
        .about-hero {
            min-height: 520px;
            padding-top: 72px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: flex-end;
        }

        /* Latar merah gelap gradient */
        .about-hero-bg {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--crimson-deep) 0%, var(--crimson) 55%, #9B2020 100%);
            z-index: 0;
        }

        /* Pola garis dekoratif */
        .about-hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: repeating-linear-gradient(
                45deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 1px,
                transparent 1px, transparent 60px
            );
        }

        /* Blob cahaya emas */
        .hero-blob-gold {
            position: absolute;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(201,146,58,0.25) 0%, transparent 70%);
            top: -100px; right: -80px;
            border-radius: 50%;
            filter: blur(60px);
            animation: blobGold 9s ease-in-out infinite;
            z-index: 1;
        }
        @keyframes blobGold {
            0%,100% { transform: translate(0,0) scale(1); }
            50% { transform: translate(-40px,30px) scale(1.1); }
        }

        .about-hero-inner {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 80px 40px 0;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 60px;
            align-items: flex-end;
            position: relative;
            z-index: 2;
        }

        .about-hero-text { padding-bottom: 70px; }

        .hero-breadcrumb {
            display: flex; align-items: center; gap: 8px;
            font-size: 0.78rem; font-weight: 600; letter-spacing: 0.1em;
            text-transform: uppercase; color: rgba(255,255,255,0.6);
            margin-bottom: 20px;
        }
        .hero-breadcrumb a { color: rgba(255,255,255,0.6); text-decoration: none; transition: color 0.2s; }
        .hero-breadcrumb a:hover { color: var(--gold-light); }
        .hero-breadcrumb span { color: var(--gold-light); }

        .about-hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(201,146,58,0.2); border: 1px solid rgba(201,146,58,0.5);
            color: var(--gold-light); font-size: 0.78rem; font-weight: 600;
            letter-spacing: 0.08em; text-transform: uppercase;
            padding: 6px 14px; border-radius: 50px; margin-bottom: 22px;
        }

        .about-hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.6rem);
            font-weight: 800; line-height: 1.15;
            color: var(--white); margin-bottom: 20px;
        }
        .about-hero-title em { font-style: italic; color: var(--gold-light); }

        .about-hero-desc {
            color: rgba(255,255,255,0.8);
            font-size: 1.05rem; line-height: 1.8;
            max-width: 500px;
        }

        /* Foto founder — melayang ke atas, overlap ke section berikut */
        .about-hero-photo {
            position: relative;
            align-self: flex-end;
        }

        .photo-frame {
            position: relative;
            display: inline-block;
        }

        .photo-frame img {
            width: 360px;
            height: 440px;
            object-fit: cover;
            object-position: top center;
            border-radius: 24px 24px 0 0;
            display: block;
            filter: drop-shadow(0 20px 60px rgba(0,0,0,0.35));
        }

        /* Dekorasi bingkai emas */
        .photo-frame::before {
            content: '';
            position: absolute;
            top: -12px; left: -12px;
            width: 100%; height: 100%;
            border: 3px solid rgba(201,146,58,0.5);
            border-radius: 28px 28px 0 0;
            pointer-events: none;
        }

        /* Badge nama di pojok foto */
        .photo-name-badge {
            position: absolute;
            bottom: 20px; left: -20px;
            background: var(--white);
            border-radius: 14px;
            padding: 14px 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            min-width: 180px;
        }
        .photo-name-badge .badge-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem; font-weight: 800;
            color: var(--text-dark); margin-bottom: 3px;
        }
        .photo-name-badge .badge-role {
            font-size: 0.75rem; font-weight: 600;
            color: var(--crimson); text-transform: uppercase; letter-spacing: 0.08em;
        }

        /* ============================================================
           SECTION — utilitas bersama
        ============================================================ */
        section { padding: 100px 40px; }
        .max-w { max-width: 1200px; margin: 0 auto; }
        .section-label {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 0.14em;
            text-transform: uppercase; color: var(--gold); margin-bottom: 12px;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.9rem, 4vw, 2.8rem); font-weight: 800;
            line-height: 1.2; color: var(--text-dark); margin-bottom: 16px;
        }
        .section-title em { font-style: italic; color: var(--crimson); }
        .ornament { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
        .ornament.centered { justify-content: center; }
        .ornament-line { flex: 1; height: 1px; background: linear-gradient(90deg,transparent,var(--gold-light),transparent); max-width: 80px; }
        .ornament-dot { width: 8px; height: 8px; background: var(--gold); border-radius: 50%; }

        /* ============================================================
           SECTION — STORY (kisah pendiri)
        ============================================================ */
        .story-section { background: var(--white); padding: 120px 40px 100px; }

        .story-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        /* Kartu kutipan */
        .story-quote-card {
            background: linear-gradient(135deg, var(--crimson-deep), var(--crimson));
            border-radius: 24px;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        .story-quote-card::before {
            content: '"';
            position: absolute; top: -20px; right: 20px;
            font-family: 'Playfair Display', serif;
            font-size: 180px; color: rgba(255,255,255,0.08);
            line-height: 1; pointer-events: none;
        }
        .story-quote-card p {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem; font-style: italic;
            color: rgba(255,255,255,0.95); line-height: 1.75;
            margin-bottom: 24px; position: relative; z-index: 1;
        }
        .story-quote-author {
            display: flex; align-items: center; gap: 14px;
            position: relative; z-index: 1;
        }
        .story-quote-author img {
            width: 52px; height: 52px; border-radius: 50%;
            object-fit: cover; object-position: top;
            border: 3px solid rgba(201,146,58,0.6);
        }
        .story-quote-author-name {
            font-weight: 700; color: var(--white); font-size: 0.92rem;
        }
        .story-quote-author-role {
            font-size: 0.75rem; color: var(--gold-light); margin-top: 2px;
        }

        /* Teks cerita */
        .story-text .section-label { color: var(--gold); }

        .story-text p {
            color: var(--text-mid); font-size: 0.97rem; line-height: 1.85;
            margin-bottom: 18px;
        }

        /* Timeline mini */
        .timeline { margin-top: 32px; }
        .timeline-item {
            display: flex; gap: 20px; margin-bottom: 24px;
            align-items: flex-start;
        }
        .timeline-year {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem; font-weight: 800;
            color: var(--crimson); min-width: 64px; line-height: 1.2;
        }
        .timeline-divider {
            display: flex; flex-direction: column; align-items: center; padding-top: 6px;
        }
        .timeline-dot {
            width: 12px; height: 12px; background: var(--gold);
            border-radius: 50%; flex-shrink: 0;
            border: 3px solid var(--cream);
            box-shadow: 0 0 0 3px rgba(201,146,58,0.3);
        }
        .timeline-line { width: 2px; flex: 1; background: rgba(201,146,58,0.2); margin-top: 4px; }
        .timeline-content h4 {
            font-weight: 700; font-size: 0.95rem; color: var(--text-dark); margin-bottom: 4px;
        }
        .timeline-content p {
            font-size: 0.85rem; color: var(--text-light); line-height: 1.6; margin: 0;
        }

        /* ============================================================
           NILAI DAN KOMITMEN
        ============================================================ */
        .nilai-section {
            background: linear-gradient(135deg, var(--crimson-deep) 0%, var(--crimson) 60%, #A02020 100%);
            position: relative; overflow: hidden;
        }
        .nilai-section::before {
            content: '';
            position: absolute; inset: 0;
            background-image: repeating-linear-gradient(
                45deg, rgba(255,255,255,0.02) 0, rgba(255,255,255,0.02) 1px,
                transparent 1px, transparent 50px
            );
            pointer-events: none;
        }

        .nilai-header { text-align: center; margin-bottom: 60px; }
        .nilai-header .section-label { color: var(--gold-light); justify-content: center; }
        .nilai-header .section-title { color: var(--white); text-align: center; }
        .nilai-header .ornament { justify-content: center; }
        .nilai-header .ornament-line {
            background: linear-gradient(90deg,transparent,rgba(232,184,109,0.4),transparent);
        }
        .nilai-header .ornament-dot { background: var(--gold-light); }

        .nilai-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
        }

        .nilai-card {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 36px 32px;
            transition: background var(--transition), transform var(--transition);
        }
        .nilai-card:hover {
            background: rgba(255,255,255,0.14);
            transform: translateY(-6px);
        }

        .nilai-card-icon {
            width: 56px; height: 56px;
            background: rgba(201,146,58,0.2);
            border: 1px solid rgba(201,146,58,0.4);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            color: var(--gold-light); font-size: 1.3rem;
            margin-bottom: 20px;
            transition: background var(--transition);
        }
        .nilai-card:hover .nilai-card-icon {
            background: rgba(201,146,58,0.35);
        }

        .nilai-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem; font-weight: 700;
            color: var(--white); margin-bottom: 14px;
        }

        .nilai-card ul {
            list-style: none; padding: 0;
        }
        .nilai-card ul li {
            font-size: 0.88rem; color: rgba(255,255,255,0.8);
            line-height: 1.7; padding: 5px 0;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex; align-items: flex-start; gap: 10px;
        }
        .nilai-card ul li:last-child { border-bottom: none; }
        .nilai-card ul li::before {
            content: '✦';
            color: var(--gold-light); font-size: 0.65rem;
            margin-top: 5px; flex-shrink: 0;
        }

        /* ============================================================
           VISI MISI
        ============================================================ */
        .visimisi-section { background: var(--cream); }

        .visimisi-header { text-align: center; margin-bottom: 60px; }
        .visimisi-header .section-label { justify-content: center; }
        .visimisi-header .ornament { justify-content: center; }

        .visimisi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 36px;
        }

        .visimisi-card {
            background: var(--white);
            border-radius: 24px;
            padding: 44px 36px;
            box-shadow: 0 4px 24px rgba(139,26,26,0.08);
            border-top: 5px solid var(--crimson);
            position: relative;
            overflow: hidden;
            transition: transform var(--transition), box-shadow var(--transition);
        }
        .visimisi-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-warm);
        }
        .visimisi-card::after {
            content: '';
            position: absolute; bottom: -40px; right: -40px;
            width: 120px; height: 120px; border-radius: 50%;
            background: radial-gradient(circle, rgba(139,26,26,0.06) 0%, transparent 70%);
        }

        .visimisi-card-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--crimson), var(--crimson-soft));
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            color: var(--white); font-size: 1.5rem;
            margin-bottom: 24px;
            box-shadow: 0 8px 24px rgba(139,26,26,0.3);
        }

        .visimisi-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem; font-weight: 800;
            color: var(--crimson); margin-bottom: 16px;
        }

        .visimisi-card p {
            color: var(--text-mid); font-size: 0.95rem; line-height: 1.8;
            margin-bottom: 20px;
        }

        .visimisi-card ul {
            list-style: none; padding: 0;
        }
        .visimisi-card ul li {
            display: flex; align-items: flex-start; gap: 12px;
            font-size: 0.88rem; color: var(--text-mid);
            padding: 8px 0;
            border-bottom: 1px solid rgba(201,146,58,0.12);
        }
        .visimisi-card ul li:last-child { border-bottom: none; }
        .visimisi-card ul li i {
            color: var(--crimson); margin-top: 3px; flex-shrink: 0; font-size: 0.75rem;
        }

        /* ============================================================
           STATS BAR — angka menarik
        ============================================================ */
        .stats-bar {
            background: var(--brown);
            padding: 60px 40px;
        }

        .stats-inner {
            max-width: 1100px; margin: 0 auto;
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 20px; text-align: center;
        }

        .stat-box {
            padding: 28px 20px;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        .stat-box:last-child { border-right: none; }

        .stat-box-num {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem; font-weight: 800;
            color: var(--gold-light); line-height: 1;
            margin-bottom: 8px;
        }

        .stat-box-label {
            font-size: 0.82rem; font-weight: 600;
            color: rgba(255,255,255,0.6); text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* ============================================================
           FOOTER (sama persis dengan referensi)
        ============================================================ */
        footer { background: var(--brown); color: rgba(255,255,255,0.7); padding: 60px 40px 32px; }
        .footer-grid {
            max-width: 1200px; margin: 0 auto;
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px; margin-bottom: 48px;
        }
        .footer-brand img { height: 40px; margin-bottom: 16px; object-fit: contain; }
        .footer-brand-name { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--white); margin-bottom: 12px; }
        .footer-brand p { font-size: 0.88rem; line-height: 1.7; }
        .footer-socials { display: flex; gap: 10px; margin-top: 20px; }
        .social-btn {
            width: 38px; height: 38px; border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem;
            transition: background var(--transition), color var(--transition), transform var(--transition);
        }
        .social-btn:hover { background: var(--gold); color: var(--brown); transform: translateY(-3px); }
        .footer-col h4 { font-size: 0.8rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold-light); margin-bottom: 20px; }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 10px; }
        .footer-col ul a {
            text-decoration: none; color: rgba(255,255,255,0.65); font-size: 0.88rem;
            transition: color var(--transition), padding-left var(--transition);
            display: inline-flex; align-items: center; gap: 6px;
        }
        .footer-col ul a:hover { color: var(--white); padding-left: 4px; }
        .footer-contact-item { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 12px; font-size: 0.88rem; }
        .footer-contact-item i { color: var(--gold-light); margin-top: 2px; flex-shrink: 0; }
        .footer-bottom {
            max-width: 1200px; margin: 0 auto; padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: space-between; font-size: 0.82rem;
        }
        .footer-bottom a { color: var(--gold-light); text-decoration: none; }

        /* ============================================================
           REVEAL ANIMATIONS
        ============================================================ */
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.15s; }
        .reveal-delay-2 { transition-delay: 0.3s; }
        .reveal-delay-3 { transition-delay: 0.45s; }
        .reveal-left { opacity: 0; transform: translateX(-40px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(40px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 992px) {
            .about-hero-inner { grid-template-columns: 1fr; }
            .about-hero-photo { display: flex; justify-content: center; padding-bottom: 0; }
            .photo-frame img { width: 280px; height: 340px; }
            .story-grid { grid-template-columns: 1fr; gap: 40px; }
            .nilai-grid { grid-template-columns: 1fr; }
            .visimisi-grid { grid-template-columns: 1fr; }
            .stats-inner { grid-template-columns: 1fr 1fr; }
            .stat-box:nth-child(2) { border-right: none; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            section { padding: 70px 24px; }
            nav { padding: 0 24px; }
            .nav-links { display: none; }
            .hamburger { display: flex; }
            .about-hero-inner { padding: 60px 24px 0; }
            .stats-inner { grid-template-columns: 1fr 1fr; }
            .footer-grid { grid-template-columns: 1fr; gap: 32px; }
            .stat-box { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.1); }
            .stat-box:last-child { border-bottom: none; }
        }
    </style>
</head>
<body>

{{-- ===================================================
     NAVBAR
=================================================== --}}
<nav id="navbar">
    <a href="{{ url('/') }}" class="nav-logo">
        <img src="{{ asset('images/logo.png') }}" alt="PawonLokal Logo">
        <span>PawonLokal</span>
    </a>

    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/about') }}" class="active">Tentang Kami</a></li>
        <li><a href="{{ url('/produk') }}">Produk</a></li>
        <li><a href="{{ url('/kontak') }}">Kontak</a></li>
        @auth
            <li><a href="{{ url('/keranjang') }}"><i class="fa-solid fa-basket-shopping"></i> Keranjang</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="nav-cta" style="cursor:pointer;font-family:inherit;border:none;">
                        Keluar
                    </button>
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
    <a href="{{ url('/produk') }}">Produk</a>
    <a href="{{ url('/kontak') }}">Kontak</a>
    @auth
        <a href="{{ url('/keranjang') }}">Keranjang</a>
    @else
        <a href="{{ url('/login') }}" style="color:var(--crimson);font-weight:700;">Login →</a>
    @endauth
</div>


{{-- ===================================================
     HERO ABOUT
=================================================== --}}
<div class="about-hero">
    <div class="about-hero-bg"></div>
    <div class="hero-blob-gold"></div>

    <div class="about-hero-inner">
        {{-- Teks kiri --}}
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

        {{-- Foto founder --}}
        <div class="about-hero-photo">
            <div class="photo-frame">
                {{-- Simpan di: public/images/denanik.jpeg --}}
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


{{-- ===================================================
     STATS BAR
=================================================== --}}
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


{{-- ===================================================
     STORY — kisah pendiri
=================================================== --}}
<section class="story-section">
    <div class="max-w">
        <div class="story-grid">

            {{-- Kartu kutipan + foto --}}
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

                {{-- Timeline perjalanan --}}
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
                            <p>Membuka outlet pertama di Surabaya dengan 20+ jenis kue tersedia.</p>
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

            {{-- Teks cerita --}}
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

                {{-- Feature highlights --}}
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


{{-- ===================================================
     NILAI DAN KOMITMEN
=================================================== --}}
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
            {{-- Nilai --}}
            <div class="nilai-card reveal">
                <div class="nilai-card-icon">
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <h3>Nilai Kami</h3>
                <ul>
                    <li>Rasa yang Terjaga — Mengutamakan cita rasa autentik yang konsisten dan berkualitas.</li>
                    <li>Kualitas & Konsistensi — Menggunakan bahan terbaik dan proses pembuatan yang terstandar.</li>
                    <li>Tanggung Jawab dalam Pelayanan — Memberikan pengalaman belanja yang ramah, cepat, dan responsif.</li>
                    <li>Tradisi yang Terus Hidup — Menjaga resep leluhur agar tetap relevan bagi generasi mendatang.</li>
                </ul>
            </div>

            {{-- Komitmen --}}
            <div class="nilai-card reveal reveal-delay-1">
                <div class="nilai-card-icon">
                    <i class="fa-solid fa-handshake"></i>
                </div>
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


{{-- ===================================================
     VISI & MISI
=================================================== --}}
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
            {{-- Visi --}}
            <div class="visimisi-card reveal">
                <div class="visimisi-card-icon">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <h3>Visi</h3>
                <p>
                    Menjadi merek kue kering dan kue basah nusantara yang terpercaya,
                    dengan rasa autentik dan kualitas terbaik buatan Bu Nanik.
                </p>
            </div>

            {{-- Misi --}}
            <div class="visimisi-card reveal reveal-delay-1">
                <div class="visimisi-card-icon">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h3>Misi</h3>
                <p>Mendukung dan melestarikan kue tradisional Indonesia agar terus dikenal dan dicintai semua generasi.</p>
                <ul>
                    <li><i class="fa-solid fa-check"></i> Menggunakan bahan lokal berkualitas tinggi</li>
                    <li><i class="fa-solid fa-check"></i> Menjaga resep warisan tanpa kompromi</li>
                    <li><i class="fa-solid fa-check"></i> Memberikan pelayanan terbaik dengan hati</li>
                    <li><i class="fa-solid fa-check"></i> Memberdayakan pelaku UMKM kuliner lokal</li>
                    <li><i class="fa-solid fa-check"></i> Mengedukasi masyarakat tentang kekayaan kuliner Nusantara</li>
                </ul>
            </div>
        </div>
    </div>
</section>


{{-- ===================================================
     FOOTER
=================================================== --}}
<footer>
    <div class="footer-grid">
        <div class="footer-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo PawonLokal">
            <div class="footer-brand-name">PawonLokal</div>
            <p>Menghadirkan kue tradisional Nusantara yang autentik, dibuat dengan bahan alami dan resep warisan leluhur.</p>
            <div class="footer-socials">
                <a href="#" class="social-btn"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="social-btn"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="social-btn"><i class="fa-brands fa-tiktok"></i></a>
                <a href="#" class="social-btn"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
        <div class="footer-col">
            <h4>Navigasi</h4>
            <ul>
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i>Home</a></li>
                <li><a href="{{ url('/about') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i>Tentang Kami</a></li>
                <li><a href="{{ url('/produk') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i>Produk</a></li>
                <li><a href="{{ url('/kontak') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i>Kontak</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Akun</h4>
            <ul>
                @auth
                    <li><a href="{{ url('/keranjang') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i>Keranjang</a></li>
                @else
                    <li><a href="{{ url('/login') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i>Login</a></li>
                    <li><a href="{{ url('/register') }}"><i class="fa-solid fa-chevron-right" style="font-size:0.7rem;"></i>Daftar</a></li>
                @endauth
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
                <span>+62 812-3456-7890</span>
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
        <p>© {{ date('Y') }} <a href="{{ url('/') }}">PawonLokal</a>. Hak cipta dilindungi.</p>
        <p>Dibuat dengan <i class="fa-solid fa-heart" style="color:var(--crimson);"></i> untuk Nusantara</p>
    </div>
</footer>


<script>
    // Navbar scroll
    const navbar    = document.getElementById('navbar');
    const hamburger = document.getElementById('hamburgerBtn');
    const mobileMenu= document.getElementById('mobileMenu');

    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 30);
    });

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        mobileMenu.classList.toggle('open');
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            hamburger.classList.remove('open');
            mobileMenu.classList.remove('open');
        });
    });

    // Reveal on scroll
    const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });
    revealEls.forEach(el => io.observe(el));

    // Counter animation
    const counters = document.querySelectorAll('[data-count]');
    const counterIO = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el  = entry.target;
                const end = parseInt(el.dataset.count, 10);
                const suffix = el.textContent.includes('+') ? '+' : '';
                let start = 0;
                const step = Math.ceil(end / 50);
                const timer = setInterval(() => {
                    start += step;
                    if (start >= end) { start = end; clearInterval(timer); }
                    el.textContent = start + suffix;
                }, 30);
                counterIO.unobserve(el);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(c => counterIO.observe(c));
</script>
</body>
</html>