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
           NAVBAR
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
           HERO
        ============================================================ */
        .hero {
            min-height: 100vh; display: flex; align-items: center;
            position: relative; overflow: hidden; padding-top: 72px;
        }
        .hero-blob { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
        .hero-blob-1 {
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(139,26,26,0.15) 0%, transparent 70%);
            top: -100px; right: -150px;
            animation: blobFloat1 8s ease-in-out infinite;
        }
        .hero-blob-2 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(201,146,58,0.18) 0%, transparent 70%);
            bottom: 50px; left: -80px;
            animation: blobFloat2 10s ease-in-out infinite;
        }
        @keyframes blobFloat1 {
            0%,100% { transform: translate(0,0) scale(1); }
            50% { transform: translate(-30px,40px) scale(1.08); }
        }
        @keyframes blobFloat2 {
            0%,100% { transform: translate(0,0) scale(1); }
            50% { transform: translate(20px,-30px) scale(1.06); }
        }

        .hero-inner {
            max-width: 1200px; margin: 0 auto; padding: 80px 40px;
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 60px; align-items: center; position: relative; z-index: 1;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(201,146,58,0.15); border: 1px solid rgba(201,146,58,0.4);
            color: var(--gold); font-size: 0.78rem; font-weight: 600;
            letter-spacing: 0.08em; text-transform: uppercase;
            padding: 6px 14px; border-radius: 50px; margin-bottom: 24px;
            animation: fadeInDown 0.7s ease both;
        }
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.4rem, 5vw, 3.8rem); font-weight: 800;
            line-height: 1.15; color: var(--text-dark); margin-bottom: 20px;
            animation: fadeInDown 0.8s 0.1s ease both;
        }
        .hero-title em { font-style: italic; color: var(--crimson); }
        .hero-title .gold-word { position: relative; display: inline-block; }
        .hero-title .gold-word::after {
            content: ''; position: absolute; left: 0; right: 0; bottom: -4px;
            height: 4px; background: var(--gold); border-radius: 4px;
            transform: scaleX(0); transform-origin: left;
            animation: lineReveal 0.6s 1s ease forwards;
        }
        @keyframes lineReveal { to { transform: scaleX(1); } }

        .hero-desc {
            color: var(--text-mid); font-size: 1.05rem; line-height: 1.75;
            margin-bottom: 36px; animation: fadeInDown 0.8s 0.2s ease both;
        }
        .hero-buttons {
            display: flex; gap: 14px; flex-wrap: wrap;
            animation: fadeInDown 0.8s 0.3s ease both;
        }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--crimson); color: var(--white);
            padding: 14px 28px; border-radius: 50px; font-weight: 600;
            font-size: 0.95rem; text-decoration: none;
            transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
            box-shadow: 0 6px 24px rgba(139,26,26,0.3);
        }
        .btn-primary:hover {
            background: var(--crimson-deep); transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(139,26,26,0.4);
        }
        .btn-outline {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent; color: var(--crimson);
            padding: 14px 28px; border-radius: 50px; font-weight: 600;
            font-size: 0.95rem; text-decoration: none;
            border: 2px solid var(--crimson);
            transition: background var(--transition), color var(--transition), transform var(--transition);
        }
        .btn-outline:hover { background: var(--crimson); color: var(--white); transform: translateY(-3px); }

        .hero-stats {
            display: flex; gap: 32px; margin-top: 40px;
            animation: fadeInDown 0.8s 0.4s ease both;
        }
        .stat-item { text-align: left; }
        .stat-num {
            font-family: 'Playfair Display', serif; font-size: 2rem;
            font-weight: 800; color: var(--crimson);
        }
        .stat-label { font-size: 0.78rem; color: var(--text-light); font-weight: 500; margin-top: 2px; }

        .hero-visual { position: relative; animation: fadeInRight 1s 0.3s ease both; }
        .hero-img-main {
            width: 100%; border-radius: 24px; box-shadow: var(--shadow-warm);
            object-fit: cover; height: 440px;
        }
        .hero-float-card {
            position: absolute; background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px); border-radius: 14px; padding: 12px 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12); border: 1px solid rgba(255,255,255,0.8);
        }
        .hero-float-card-1 { bottom: 32px; left: -24px; animation: floatCard 6s ease-in-out infinite; }
        .hero-float-card-2 { top: 32px; right: -24px; animation: floatCard 6s 1s ease-in-out infinite; }
        @keyframes floatCard {
            0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); }
        }
        .float-card-title { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.07em; color: var(--text-light); font-weight: 600; margin-bottom: 2px; }
        .float-card-value { font-family: 'Playfair Display', serif; font-size: 1.1rem; color: var(--text-dark); font-weight: 700; }
        .float-stars { color: var(--gold); font-size: 0.85rem; margin-top: 2px; }

        /* ============================================================
           SHARED
        ============================================================ */
        section { padding: 100px 40px; }
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
        .section-sub { color: var(--text-mid); font-size: 1rem; line-height: 1.75; max-width: 560px; }
        .section-header { margin-bottom: 60px; }
        .section-header.centered { text-align: center; }
        .section-header.centered .section-sub { margin: 0 auto; }
        .max-w { max-width: 1200px; margin: 0 auto; }

        .ornament { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
        .ornament.centered { justify-content: center; }
        .ornament-line { flex: 1; height: 1px; background: linear-gradient(90deg,transparent,var(--gold-light),transparent); max-width: 80px; }
        .ornament-dot { width: 8px; height: 8px; background: var(--gold); border-radius: 50%; }

        /* ============================================================
           ABOUT
        ============================================================ */
        .about { background: var(--cream); }
        .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; }
        .about-images { position: relative; height: 480px; }
        .about-img-a {
            position: absolute; width: 65%; height: 380px; object-fit: cover;
            border-radius: 20px; top: 0; left: 0; box-shadow: var(--shadow-warm);
            transition: transform 0.6s ease;
        }
        .about-img-b {
            position: absolute; width: 55%; height: 280px; object-fit: cover;
            border-radius: 20px; bottom: 0; right: 0;
            box-shadow: 0 12px 40px rgba(0,0,0,0.15); transition: transform 0.6s ease;
            border: 5px solid var(--cream);
        }
        .about-images:hover .about-img-a { transform: translateY(-8px) rotate(-1deg); }
        .about-images:hover .about-img-b { transform: translateY(-4px) rotate(1deg); }
        .about-badge {
            position: absolute; top: 50%; left: 55%; transform: translate(-50%,-50%);
            background: var(--crimson); color: var(--white);
            width: 100px; height: 100px; border-radius: 50%;
            display: flex; flex-direction: column; align-items: center;
            justify-content: center; text-align: center; z-index: 5;
            box-shadow: 0 8px 24px rgba(139,26,26,0.4);
            animation: spin-slow 15s linear infinite;
        }
        @keyframes spin-slow {
            0% { transform: translate(-50%,-50%) rotate(0deg); }
            100% { transform: translate(-50%,-50%) rotate(360deg); }
        }
        .about-badge span { font-size: 0.65rem; letter-spacing: 0.12em; font-weight: 700; }
        .about-badge strong { font-family: 'Playfair Display', serif; font-size: 1.3rem; }
        .about-feature { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 28px; }
        .about-feature-icon {
            width: 48px; height: 48px; background: rgba(139,26,26,0.1);
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; color: var(--crimson); font-size: 1.1rem;
            transition: background var(--transition), transform var(--transition);
        }
        .about-feature:hover .about-feature-icon { background: var(--crimson); color: var(--white); transform: scale(1.1); }
        .about-feature-text h4 { font-weight: 700; font-size: 0.95rem; color: var(--text-dark); margin-bottom: 4px; }
        .about-feature-text p { font-size: 0.88rem; color: var(--text-light); line-height: 1.6; }

        /* ============================================================
           PRODUK – 2 KARTU SAJA (kue kering & kue basah)
        ============================================================ */
        .products-section {
            background: linear-gradient(135deg, var(--crimson-deep) 0%, var(--crimson) 60%, #A02020 100%);
            position: relative; overflow: hidden; padding: 100px 40px;
        }
        .products-bg-ornament {
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background-image: repeating-linear-gradient(
                45deg, rgba(255,255,255,0.02) 0, rgba(255,255,255,0.02) 1px,
                transparent 1px, transparent 50px
            );
            pointer-events: none;
        }
        .products-header { margin-bottom: 60px; }
        .products-header .section-label { color: var(--gold-light); }
        .products-header .section-title { color: var(--white); }
        .products-header .section-sub { color: rgba(255,255,255,0.75); }

        .products-two-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            max-width: 800px;
            margin: 0 auto 48px;
        }

        /* Kartu produk PUTIH dengan shadow */
        .product-card-white {
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 12px 48px rgba(0,0,0,0.18), 0 2px 8px rgba(0,0,0,0.08);
            transition: transform var(--transition), box-shadow var(--transition);
            cursor: pointer;
            position: relative;
        }
        .product-card-white:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 24px 64px rgba(0,0,0,0.28), 0 4px 16px rgba(139,26,26,0.15);
        }
        .product-card-white img {
            width: 100%; height: 220px; object-fit: cover; display: block;
            transition: transform 0.5s ease;
        }
        .product-card-white:hover img { transform: scale(1.06); }
        .product-card-white-body { padding: 24px; }
        .product-card-white-tag {
            display: inline-block; font-size: 0.68rem; letter-spacing: 0.1em;
            font-weight: 700; text-transform: uppercase; color: var(--crimson);
            background: rgba(139,26,26,0.08); padding: 4px 10px; border-radius: 50px;
            margin-bottom: 10px;
        }
        .product-card-white-name {
            font-family: 'Playfair Display', serif; font-size: 1.3rem;
            color: var(--text-dark); font-weight: 800; margin-bottom: 8px;
        }
        .product-card-white-desc {
            font-size: 0.85rem; color: var(--text-light); line-height: 1.6; margin-bottom: 16px;
        }
        .product-card-white-footer {
            display: flex; align-items: center; justify-content: space-between;
        }
        .product-card-white-price {
            font-family: 'Playfair Display', serif; font-size: 1.1rem;
            color: var(--crimson); font-weight: 700;
        }
        .product-card-arrow {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--crimson); color: var(--white);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem; transition: background var(--transition), transform var(--transition);
        }
        .product-card-white:hover .product-card-arrow {
            background: var(--crimson-deep); transform: rotate(45deg);
        }

        /* See All link */
        .see-all-wrap { text-align: center; margin-top: 8px; }
        .see-all-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: rgba(255,255,255,0.75); font-size: 0.82rem; font-weight: 500;
            text-decoration: none; letter-spacing: 0.04em;
            border-bottom: 1px solid rgba(255,255,255,0.3);
            padding-bottom: 2px;
            transition: color var(--transition), border-color var(--transition);
        }
        .see-all-link:hover { color: var(--white); border-color: var(--white); }
        .see-all-link i { font-size: 0.75rem; transition: transform var(--transition); }
        .see-all-link:hover i { transform: translateX(4px); }

        /* ============================================================
           REVIEWS
        ============================================================ */
        .reviews { background: var(--cream-dark); position: relative; overflow: hidden; }
        .reviews::before {
            content: '"'; position: absolute; top: -40px; right: 60px;
            font-family: 'Playfair Display', serif; font-size: 280px;
            color: rgba(139,26,26,0.05); pointer-events: none; line-height: 1;
        }

        .carousel-viewport { overflow: hidden; position: relative; }
        .carousel-track {
            display: flex; gap: 28px;
            transition: transform 0.7s cubic-bezier(0.4,0,0.2,1);
        }
        .review-card {
            flex-shrink: 0; width: calc(33.333% - 19px);
            background: var(--white); border-radius: 20px; padding: 32px;
            box-shadow: 0 4px 20px rgba(139,26,26,0.08);
            border: 1px solid rgba(201,146,58,0.12); position: relative;
            transition: transform var(--transition), box-shadow var(--transition);
        }
        .review-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-warm); }
        .review-card::before {
            content: '"'; position: absolute; top: 16px; right: 24px;
            font-family: 'Playfair Display', serif; font-size: 56px;
            color: rgba(139,26,26,0.12); line-height: 1;
        }
        .review-stars { display: flex; gap: 3px; margin-bottom: 16px; }
        .review-stars i { color: var(--gold); font-size: 0.9rem; }
        .review-text { font-size: 0.95rem; line-height: 1.75; color: var(--text-mid); margin-bottom: 24px; font-style: italic; }
        .reviewer { display: flex; align-items: center; gap: 12px; }
        .reviewer-avatar {
            width: 44px; height: 44px; border-radius: 50%;
            background: linear-gradient(135deg, var(--crimson), var(--gold));
            display: flex; align-items: center; justify-content: center;
            color: var(--white); font-family: 'Playfair Display', serif;
            font-weight: 700; font-size: 1.1rem; flex-shrink: 0;
        }
        .reviewer-name { font-weight: 700; font-size: 0.95rem; color: var(--text-dark); }
        .reviewer-label { font-size: 0.78rem; color: var(--text-light); margin-top: 2px; }

        .carousel-controls {
            display: flex; align-items: center; justify-content: center;
            gap: 16px; margin-top: 40px;
        }
        .carousel-btn {
            width: 48px; height: 48px; border-radius: 50%;
            border: 2px solid rgba(139,26,26,0.2); background: var(--white);
            color: var(--crimson); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem; transition: all var(--transition);
        }
        .carousel-btn:hover { background: var(--crimson); color: var(--white); border-color: var(--crimson); transform: scale(1.1); }
        .carousel-dots { display: flex; gap: 8px; }
        .carousel-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: rgba(139,26,26,0.2); border: none; cursor: pointer;
            transition: all var(--transition);
        }
        .carousel-dot.active { background: var(--crimson); width: 24px; border-radius: 4px; }

        /* ============================================================
           CTA BAND
        ============================================================ */
        .cta-band {
            background: linear-gradient(135deg, var(--crimson-deep), var(--crimson));
            padding: 80px 40px; text-align: center; position: relative; overflow: hidden;
        }
        .cta-band::before {
            content: ''; position: absolute; top: -80px; right: -80px;
            width: 300px; height: 300px; border-radius: 50%;
            border: 80px solid rgba(255,255,255,0.05);
        }
        .cta-band::after {
            content: ''; position: absolute; bottom: -60px; left: -60px;
            width: 200px; height: 200px; border-radius: 50%;
            border: 60px solid rgba(255,255,255,0.05);
        }
        .cta-band h2 {
            font-family: 'Playfair Display', serif; font-size: clamp(1.8rem,4vw,2.8rem);
            color: var(--white); margin-bottom: 12px; position: relative; z-index: 1;
        }
        .cta-band p { color: rgba(255,255,255,0.8); font-size: 1rem; margin-bottom: 32px; position: relative; z-index: 1; }
        .cta-buttons { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; position: relative; z-index: 1; }
        .btn-white {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--white); color: var(--crimson);
            padding: 14px 28px; border-radius: 50px; font-weight: 700;
            font-size: 0.95rem; text-decoration: none;
            transition: transform var(--transition), box-shadow var(--transition);
            box-shadow: 0 6px 24px rgba(0,0,0,0.2);
        }
        .btn-white:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(0,0,0,0.3); }
        .btn-outline-white {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent; color: var(--white); padding: 14px 28px;
            border-radius: 50px; font-weight: 600; font-size: 0.95rem;
            text-decoration: none; border: 2px solid rgba(255,255,255,0.6);
            transition: background var(--transition), border-color var(--transition), transform var(--transition);
        }
        .btn-outline-white:hover { background: rgba(255,255,255,0.1); border-color: var(--white); transform: translateY(-3px); }

        /* ============================================================
           FOOTER
        ============================================================ */
        footer { background: var(--brown); color: rgba(255,255,255,0.7); padding: 60px 40px 32px; }
        .footer-grid {
            max-width: 1200px; margin: 0 auto;
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px; margin-bottom: 48px;
        }
        .footer-brand img { height: 40px; margin-bottom: 16px; }
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
           ANIMATIONS & REVEAL
        ============================================================ */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.15s; }
        .reveal-delay-2 { transition-delay: 0.3s; }
        .reveal-delay-3 { transition-delay: 0.45s; }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 992px) {
            .hero-inner { grid-template-columns: 1fr; gap: 40px; }
            .hero-visual { display: none; }
            .about-grid { grid-template-columns: 1fr; }
            .about-images { height: 300px; margin-bottom: 20px; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .products-two-grid { grid-template-columns: 1fr 1fr; }
            .review-card { width: calc(50% - 14px); }
        }
        @media (max-width: 768px) {
            section { padding: 70px 24px; }
            nav { padding: 0 24px; }
            .nav-links { display: none; }
            .hamburger { display: flex; }
            .hero-inner { padding: 60px 24px; }
            .footer-grid { grid-template-columns: 1fr; gap: 32px; }
            .products-two-grid { grid-template-columns: 1fr; max-width: 400px; }
            .review-card { width: 85vw; }
        }
    </style>
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav id="navbar">
        <a href="{{ url('/') }}" class="nav-logo">
            <img src="{{ asset('images/Logo.PNG') }}" alt="PawonLokal Logo">
            <span>PawonLokal</span>
        </a>

        <ul class="nav-links">
            <li><a href="{{ url('/') }}" class="active">Home</a></li>
            <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
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
        <a href="{{ url('/about') }}">Tentang Kami</a>
        <a href="{{ url('/produk') }}">Produk</a>
        <a href="{{ url('/kontak') }}">Kontak</a>
        @auth
            <a href="{{ url('/keranjang') }}">Keranjang</a>
        @else
            <a href="{{ url('/login') }}" style="color:var(--crimson);font-weight:700;">Login →</a>
        @endauth
    </div>

    {{-- ===== HERO ===== --}}
    <section class="hero">
        <div class="hero-blob hero-blob-1"></div>
        <div class="hero-blob hero-blob-2"></div>

        <div class="hero-inner">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fa-solid fa-star"></i>
                    Kue Tradisional Nusantara Terbaik
                </div>
                <h1 class="hero-title">
                    Cita Rasa <em>Autentik</em><br>
                    dari <span class="gold-word">Dapur Lokal</span>
                </h1>
                <p class="hero-desc">
                    PawonLokal menghadirkan kelezatan kue tradisional Indonesia yang dibuat dengan
                    resep warisan, bahan pilihan, dan cinta dalam setiap pembuatannya.
                </p>
                <div class="hero-buttons">
                    <a href="{{ url('/produk') }}" class="btn-primary">
                        <i class="fa-solid fa-shop"></i> Lihat Produk
                    </a>
                    <a href="{{ url('/kontak') }}" class="btn-outline">
                        <i class="fa-solid fa-phone"></i> Hubungi Kami
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
                        <div class="stat-num">4.9<i class="fa-solid fa-star" style="font-size:1.2rem;color:var(--gold);margin-left:2px;"></i></div>
                        <div class="stat-label">Rating Rata-rata</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <img class="hero-img-main" src="{{ asset('images/5.png') }}" alt="Kue Tradisional PawonLokal">
                <div class="hero-float-card hero-float-card-1">
                    <div class="float-card-title">Bestseller</div>
                    <div class="float-card-value">Klepon Pandan</div>
                    <div class="float-stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="hero-float-card hero-float-card-2">
                    <div class="float-card-title">Pengiriman</div>
                    <div class="float-card-value">Hari Ini</div>
                    <div style="margin-top:4px;font-size:0.75rem;color:var(--text-light);">Pesan sebelum pkl 12.00</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== ABOUT ===== --}}
    <section class="about">
        <div class="max-w">
            <div class="about-grid">
                <div class="about-images reveal">
                    <img class="about-img-a" src="{{ asset('images/2.png') }}" alt="Proses Pembuatan Kue">
                    <img class="about-img-b" src="{{ asset('images/daunkering.png') }}" alt="Kue Tradisional">
                    <div class="about-badge">
                        <span>SEJAK</span><strong>2010</strong><span>LOKAL</span>
                    </div>
                </div>
                <div class="reveal reveal-delay-1">
                    <div class="section-label"><i class="fa-solid fa-bowl-food"></i> Tentang PawonLokal</div>
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

    {{-- ===== PRODUK – hanya 2 kartu: Kue Basah & Kue Kering ===== --}}
    <section class="products-section">
        <div class="products-bg-ornament"></div>
        <div class="max-w">
            <div class="products-header reveal">
                <div class="section-label"><i class="fa-solid fa-cubes-stacked"></i> Produk Kami</div>
                <div class="ornament">
                    <div class="ornament-line" style="background:linear-gradient(90deg,transparent,rgba(232,184,109,0.4),transparent);"></div>
                    <div class="ornament-dot" style="background:var(--gold-light);"></div>
                    <div class="ornament-line" style="background:linear-gradient(90deg,transparent,rgba(232,184,109,0.4),transparent);"></div>
                </div>
                <h2 class="section-title">Pilihan <em style="color:var(--gold-light);">Kategori</em> Kue</h2>
                <p class="section-sub" style="color:rgba(255,255,255,0.75);">
                    Dari kue basah yang lembut hingga kue kering yang renyah — semua tersedia untuk kamu.
                </p>
            </div>

            {{-- 2 Kartu Putih --}}
            <div class="products-two-grid reveal reveal-delay-1">
                {{-- Kue Basah --}}
                <a href="{{ url('/produk') }}?kategori=basah" class="product-card-white" style="text-decoration:none;">
                    <img src="{{ asset('images/klepon.png') }}" alt="Kue Basah">
                    <div class="product-card-white-body">
                        <div class="product-card-white-tag">Kue Basah</div>
                        <div class="product-card-white-name">Kue Basah Tradisional</div>
                        <div class="product-card-white-desc">
                            Klepon, onde-onde, kue lumpur, dan beragam kue basah lezat pilihan.
                            Dibuat fresh setiap hari tanpa pengawet.
                        </div>
                        <div class="product-card-white-footer">
                            <div class="product-card-white-price">Mulai Rp 15.000</div>
                            <div class="product-card-arrow"><i class="fa-solid fa-arrow-right"></i></div>
                        </div>
                    </div>
                </a>

                {{-- Kue Kering --}}
                <a href="{{ url('/produk') }}?kategori=kering" class="product-card-white" style="text-decoration:none;">
                    <img src="{{ asset('images/nastarkeranjang.png') }}" alt="Kue Kering">
                    <div class="product-card-white-body">
                        <div class="product-card-white-tag">Kue Kering</div>
                        <div class="product-card-white-name">Kue Kering Premium</div>
                        <div class="product-card-white-desc">
                            Nastar, kastengel, putri salju, dan aneka kue kering renyah
                            untuk hampers dan oleh-oleh spesial.
                        </div>
                        <div class="product-card-white-footer">
                            <div class="product-card-white-price">Mulai Rp 50.000</div>
                            <div class="product-card-arrow"><i class="fa-solid fa-arrow-right"></i></div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- See All --}}
            <div class="see-all-wrap reveal reveal-delay-2">
                <a href="{{ url('/produk') }}" class="see-all-link">
                    see all products <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ===== REVIEWS ===== --}}
    <section class="reviews">
        <div class="max-w">
            <div class="section-header centered reveal">
                <div class="section-label" style="justify-content:center;">
                    <i class="fa-solid fa-quote-left"></i> Kata Pelanggan
                </div>
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
                        {{-- Fallback statis jika $reviews belum ada --}}
                        <div class="review-card">
                            <div class="review-stars">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="review-text">"Klepon-nya enak banget, lembut dan gurih! Pasti pesan lagi minggu depan."</p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">S</div>
                                <div>
                                    <div class="reviewer-name">Sari Dewi</div>
                                    <div class="reviewer-label">Pelanggan Setia ✓</div>
                                </div>
                            </div>
                        </div>
                        <div class="review-card">
                            <div class="review-stars">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="review-text">"Nastar-nya juara! Harum, lumer di mulut. Cocok banget buat hampers lebaran."</p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">B</div>
                                <div>
                                    <div class="reviewer-name">Budi Santoso</div>
                                    <div class="reviewer-label">Pelanggan Setia ✓</div>
                                </div>
                            </div>
                        </div>
                        <div class="review-card">
                            <div class="review-stars">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="review-text">"Sudah langganan bertahun-tahun! Kualitasnya tidak pernah mengecewakan."</p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">R</div>
                                <div>
                                    <div class="reviewer-name">Rina Kusuma</div>
                                    <div class="reviewer-label">Pelanggan Setia ✓</div>
                                </div>
                            </div>
                        </div>
                        <div class="review-card">
                            <div class="review-stars">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star" style="color:rgba(201,146,58,0.3)"></i>
                            </div>
                            <p class="review-text">"Pengiriman cepat, packaging rapi dan kuenya masih fresh. Recommended banget!"</p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">A</div>
                                <div>
                                    <div class="reviewer-name">Agus Prasetyo</div>
                                    <div class="reviewer-label">Pelanggan Setia ✓</div>
                                </div>
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

    {{-- ===== CTA BAND ===== --}}
    <section class="cta-band">
        <h2>Siap Memesan Kue <em style="font-style:italic;">Impianmu?</em></h2>
        <p>Pesan sekarang dan nikmati cita rasa tradisional yang autentik diantar ke pintu rumahmu.</p>
        <div class="cta-buttons">
            <a href="{{ url('/produk') }}" class="btn-white">
                <i class="fa-solid fa-shop"></i> Pesan Sekarang
            </a>
            <a href="https://wa.me/62812345678" target="_blank" class="btn-outline-white">
                <i class="fa-brands fa-whatsapp"></i> Chat via WhatsApp
            </a>
        </div>
    </section>

    {{-- ===== FOOTER ===== --}}
    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <img src="{{ asset('images/Logo.PNG') }}" alt="Logo PawonLokal">
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

        // Review Carousel
        (function initCarousel() {
            const track    = document.getElementById('reviewTrack');
            const prevBtn  = document.getElementById('prevBtn');
            const nextBtn  = document.getElementById('nextBtn');
            const dotsWrap = document.getElementById('carouselDots');
            if (!track) return;

            const cards  = track.querySelectorAll('.review-card');
            const total  = cards.length;
            let current  = 0;
            let autoTimer= null;
            let cardPerView = 3;

            const updateCardPerView = () => {
                if (window.innerWidth < 600) cardPerView = 1;
                else if (window.innerWidth < 992) cardPerView = 2;
                else cardPerView = 3;
            };

            const buildDots = () => {
                dotsWrap.innerHTML = '';
                const numDots = Math.ceil(total / cardPerView);
                for (let i = 0; i < numDots; i++) {
                    const dot = document.createElement('button');
                    dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
                    dot.addEventListener('click', () => goTo(i * cardPerView));
                    dotsWrap.appendChild(dot);
                }
            };

            const updateDots = () => {
                const idx = Math.floor(current / cardPerView);
                dotsWrap.querySelectorAll('.carousel-dot').forEach((d, i) => {
                    d.classList.toggle('active', i === idx);
                });
            };

            const goTo = (index) => {
                const max = total - cardPerView;
                current = Math.max(0, Math.min(index, max));
                const cardWidth = cards[0].offsetWidth + 28;
                track.style.transform = `translateX(-${current * cardWidth}px)`;
                updateDots();
            };

            const next = () => { const max = total - cardPerView; goTo(current >= max ? 0 : current + 1); };
            const prev = () => { const max = total - cardPerView; goTo(current <= 0 ? max : current - 1); };
            const startAuto = () => { stopAuto(); autoTimer = setInterval(next, 4000); };
            const stopAuto  = () => { if (autoTimer) clearInterval(autoTimer); };

            prevBtn.addEventListener('click', () => { prev(); startAuto(); });
            nextBtn.addEventListener('click', () => { next(); startAuto(); });

            track.closest('.carousel-viewport').addEventListener('mouseenter', stopAuto);
            track.closest('.carousel-viewport').addEventListener('mouseleave', startAuto);

            let touchStartX = 0;
            track.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, {passive:true});
            track.addEventListener('touchend', e => {
                const diff = touchStartX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 50) diff > 0 ? next() : prev();
                startAuto();
            }, {passive:true});

            updateCardPerView(); buildDots(); startAuto();
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => { updateCardPerView(); buildDots(); goTo(0); }, 200);
            });
        })();

        // Reveal on scroll
        const revealEls = document.querySelectorAll('.reveal');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) { entry.target.classList.add('visible'); io.unobserve(entry.target); }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(el => io.observe(el));

        // Counter animation
        const counters = document.querySelectorAll('[data-count]');
        const counterIO = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const end = parseInt(el.dataset.count, 10);
                    let start = 0;
                    const step = Math.ceil(end / 50);
                    const timer = setInterval(() => {
                        start += step;
                        if (start >= end) { start = end; clearInterval(timer); }
                        el.textContent = start + '+';
                    }, 30);
                    counterIO.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(c => counterIO.observe(c));
    </script>
</body>
</html>