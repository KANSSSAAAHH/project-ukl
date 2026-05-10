window.addEventListener('scroll', () => {
    document.getElementById('navbar')?.classList.toggle('scrolled', window.scrollY > 30);
});

// ===== Mobile Menu Toggle =====
const hamburger = document.getElementById('hamburgerBtn');
const mobileMenu = document.getElementById('mobileMenu');

hamburger?.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    mobileMenu?.classList.toggle('open');
});

// ===== Close Mobile Menu on Link Click =====
mobileMenu?.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        hamburger?.classList.remove('open');
        mobileMenu?.classList.remove('open');
    });
});