(function () {
    'use strict';

    /* ── SIDEBAR TOGGLE ── */
    const sidebar    = document.getElementById('sidebar');
    const hamburger  = document.getElementById('hamburgerBtn');
    const overlay    = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay && overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay && overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    hamburger && hamburger.addEventListener('click', () => {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });
    overlay && overlay.addEventListener('click', closeSidebar);

    /* ── ACTIVE NAV ── */
    const navLinks = document.querySelectorAll('.nav-item');
    navLinks.forEach(link => {
        if (link.href && window.location.pathname.startsWith(new URL(link.href).pathname)) {
            navLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        }
        link.addEventListener('click', () => {
            navLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        });
    });

    /* ── GREETING ── */
    const greetEl = document.getElementById('greetText');
    if (greetEl) {
        const h = new Date().getHours();
        greetEl.textContent =
            h < 11 ? 'Selamat Pagi ☀️'
          : h < 15 ? 'Selamat Siang 🌤️'
          : h < 18 ? 'Selamat Sore 🌅'
          :           'Selamat Malam 🌙';
    }

    /* ── DATE ── */
    const dateEl = document.getElementById('todayDate');
    if (dateEl) {
        const DAYS   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const MONTHS = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        const d      = new Date();
        dateEl.textContent = `${DAYS[d.getDay()]}, ${d.getDate()} ${MONTHS[d.getMonth()]} ${d.getFullYear()}`;
    }

    /* ── COUNTER ANIMATION ── */
    function animateCounter(el) {
        const rawText = el.dataset.count || '0';
        const isFloat = rawText.includes('.');
        const target  = parseFloat(rawText);
        const prefix  = el.dataset.prefix  || '';
        const suffix  = el.dataset.suffix  || '';
        const dur     = 900;
        const start   = performance.now();

        function step(now) {
            const p   = Math.min((now - start) / dur, 1);
            const val = easeOut(p) * target;
            el.textContent = prefix + (isFloat ? val.toFixed(1) : Math.round(val)) + suffix;
            if (p < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    function easeOut(t) { return 1 - Math.pow(1 - t, 3); }

    const counterObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                animateCounter(e.target);
                counterObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('[data-count]').forEach(el => counterObs.observe(el));

    /* ── SEARCH (debounce filter on table) ── */
    const searchInput = document.getElementById('globalSearch');
    if (searchInput) {
        let debounceTimer;
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const q = searchInput.value.toLowerCase().trim();
                document.querySelectorAll('[data-searchable] tbody tr').forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = (!q || text.includes(q)) ? '' : 'none';
                });
            }, 200);
        });
    }

    /* ── TOPBAR SCROLL SHADOW ── */
    const topbar = document.querySelector('.topbar');
    if (topbar) {
        window.addEventListener('scroll', () => {
            topbar.style.boxShadow = window.scrollY > 4
                ? '0 2px 16px rgba(28,32,49,0.10)'
                : '0 1px 4px rgba(28,32,49,0.06)';
        }, { passive: true });
    }

    /* ── REVEAL ON SCROLL ── */
    const revealObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.opacity = '1';
                e.target.style.transform = 'translateY(0)';
                revealObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.card, .stat-card').forEach(el => {
        if (!el.style.opacity) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(12px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        }
        revealObs.observe(el);
    });

    /* ── LOGOUT CONFIRM ── */
    const logoutForms = document.querySelectorAll('.logout-form');
    logoutForms.forEach(form => {
        form.addEventListener('submit', (e) => {
            if (!confirm('Yakin ingin logout?')) e.preventDefault();
        });
    });

})();