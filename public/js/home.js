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

(function initCarousel() {
    const track    = document.getElementById('reviewTrack');
    const prevBtn  = document.getElementById('prevBtn');
    const nextBtn  = document.getElementById('nextBtn');
    const dotsWrap = document.getElementById('carouselDots');
    if (!track) return;

    const cards = track.querySelectorAll('.review-card');
    const total = cards.length;
    let current = 0, autoTimer = null, cardPerView = 3;

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
        dotsWrap.querySelectorAll('.carousel-dot').forEach((d, i) => d.classList.toggle('active', i === idx));
    };
    
    const goTo = (index) => {
        const max = total - cardPerView;
        current = Math.max(0, Math.min(index, max));
        if (cards[0]) track.style.transform = `translateX(-${current * (cards[0].offsetWidth + 28)}px)`;
        updateDots();
    };
    
    const next = () => { const max = total - cardPerView; goTo(current >= max ? 0 : current + 1); };
    const prev = () => { const max = total - cardPerView; goTo(current <= 0 ? max : current - 1); };
    const startAuto = () => { stopAuto(); autoTimer = setInterval(next, 4000); };
    const stopAuto  = () => { if (autoTimer) clearInterval(autoTimer); };

    prevBtn.addEventListener('click', () => { prev(); startAuto(); });
    nextBtn.addEventListener('click', () => { next(); startAuto(); });
    
    const vp = track.closest('.carousel-viewport');
    if (vp) { 
        vp.addEventListener('mouseenter', stopAuto); 
        vp.addEventListener('mouseleave', startAuto); 
    }

    let tX = 0;
    track.addEventListener('touchstart', e => { tX = e.touches[0].clientX; }, {passive:true});
    track.addEventListener('touchend', e => {
        const d = tX - e.changedTouches[0].clientX;
        if (Math.abs(d) > 50) d > 0 ? next() : prev();
        startAuto();
    }, {passive:true});

    updateCardPerView(); 
    buildDots(); 
    startAuto();
    
    let rt;
    window.addEventListener('resize', () => { 
        clearTimeout(rt); 
        rt = setTimeout(() => { updateCardPerView(); buildDots(); goTo(0); }, 200); 
    });
})();

const revealEls = document.querySelectorAll('.reveal');
new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); } });
}, { threshold: 0.12 }).observe && document.querySelectorAll('.reveal').forEach(el => {
    new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); } });
    }, { threshold: 0.12 }).observe(el);
});

document.querySelectorAll('[data-count]').forEach(el => {
    new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                const end = parseInt(el.dataset.count, 10);
                let start = 0;
                const step = Math.ceil(end / 50);
                const timer = setInterval(() => {
                    start += step;
                    if (start >= end) { start = end; clearInterval(timer); }
                    el.textContent = start + '+';
                }, 30);
            }
        });
    }, { threshold: 0.5 }).observe(el);
});