const navbar     = document.getElementById('navbar');
const hamburger  = document.getElementById('hamburgerBtn');
const mobileMenu = document.getElementById('mobileMenu');

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

// ─── Reveal animations ────────────────────────────────────────────────────────
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

// ─── Counter animasi — BISA BERULANG saat scroll balik ke atas ───────────────
const counters = document.querySelectorAll('[data-count]');

function animateCounter(el) {
    const end    = parseInt(el.dataset.count, 10);
    const suffix = el.dataset.suffix || (el.textContent.includes('+') ? '+' : '');
    let current  = 0;
    const step   = Math.ceil(end / 60);
    const duration = 1500; // ms
    const interval = Math.floor(duration / (end / step));

    // Simpan timer sebelumnya agar tidak dobel
    if (el._counterTimer) clearInterval(el._counterTimer);
    el.textContent = '0' + suffix;

    el._counterTimer = setInterval(() => {
        current += step;
        if (current >= end) {
            current = end;
            clearInterval(el._counterTimer);
        }
        el.textContent = current + suffix;
    }, interval);
}

// Tandai suffix dari konten awal sebelum di-reset
counters.forEach(el => {
    el.dataset.suffix = el.textContent.includes('+') ? '+' : '';
});

// Observer tanpa unobserve → animasi bisa jalan lagi setiap kali masuk viewport
const counterIO = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounter(entry.target);
        } else {
            // Reset ke 0 saat keluar viewport agar siap animasi lagi
            const el = entry.target;
            if (el._counterTimer) clearInterval(el._counterTimer);
            el.textContent = '0' + (el.dataset.suffix || '');
        }
    });
}, {
    threshold: 0.5
});

counters.forEach(c => counterIO.observe(c));