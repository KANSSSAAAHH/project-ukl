document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       NAVBAR SCROLL
    ============================================================ */
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 30);
    });

    /* ============================================================
       HAMBURGER MOBILE MENU
    ============================================================ */
    const hamburger = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');
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

    /* ============================================================
       SMOOTH SCROLL — navbar anchor links
       Klik "Tentang Kami" → scroll ke #about
       Klik "Produk"       → scroll ke #produk
    ============================================================ */
    document.querySelectorAll('a[data-scroll]').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.dataset.scroll);
            if (target) {
                const offset = 72; // tinggi navbar
                const top = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });
    });

    /* ============================================================
       ACTIVE NAV LINK saat scroll
    ============================================================ */
    const sections = ['hero', 'about', 'produk'];
    const navLinks = document.querySelectorAll('.nav-links a[data-scroll]');

    window.addEventListener('scroll', () => {
        let current = 'hero';
        sections.forEach(id => {
            const el = document.getElementById(id);
            if (el && window.scrollY >= el.offsetTop - 100) current = id;
        });
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.dataset.scroll === '#' + current) link.classList.add('active');
        });
    });

    /* ============================================================
       COUNTER ANIMATION
    ============================================================ */
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

    /* ============================================================
       REVEAL ON SCROLL
    ============================================================ */
    const revealEls = document.querySelectorAll('.reveal');
    const revealIO = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                revealIO.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    revealEls.forEach(el => revealIO.observe(el));

});