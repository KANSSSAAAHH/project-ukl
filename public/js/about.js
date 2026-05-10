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