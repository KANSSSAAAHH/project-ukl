(function () {
    'use strict';

    /* ── SIDEBAR TOGGLE ── */
    const sidebar   = document.getElementById('sidebar');
    const hamburger = document.getElementById('hamburgerBtn');
    const overlay   = document.getElementById('sidebarOverlay');

    hamburger && hamburger.addEventListener('click', () => {
        const open = sidebar.classList.toggle('open');
        overlay.classList.toggle('show', open);
        document.body.style.overflow = open ? 'hidden' : '';
    });
    overlay && overlay.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    });

    /* ── TOPBAR SCROLL SHADOW ── */
    const topbar = document.querySelector('.topbar');
    window.addEventListener('scroll', () => {
        topbar.style.boxShadow = window.scrollY > 4
            ? '0 2px 20px rgba(139,26,26,0.10)'
            : 'none';
    }, { passive: true });

    /* ── SEARCH & FILTER ── */
    const searchInput = document.getElementById('searchInput');
    const filterRole  = document.getElementById('filterRole');
    const resultCount = document.getElementById('resultCount');
    const noResult    = document.getElementById('noResult');
    const tbody       = document.getElementById('tableBody');

    function getDataRows() {
        return tbody ? Array.from(tbody.querySelectorAll('tr[data-name]')) : [];
    }

    function runFilter() {
        const q    = (searchInput.value || '').toLowerCase().trim();
        const role = filterRole.value.toLowerCase();
        const rows = getDataRows();
        let vis = 0;

        rows.forEach(row => {
            const matchQ    = !q    || row.dataset.name.includes(q) || row.dataset.email.includes(q);
            const matchRole = !role || row.dataset.role === role;
            const show      = matchQ && matchRole;

            row.classList.toggle('row-hidden', !show);
            if (show) vis++;
        });

        if (resultCount) {
            resultCount.innerHTML = rows.length
                ? `Menampilkan <strong>${vis}</strong> dari <strong>${rows.length}</strong> user`
                : '';
        }
        if (noResult) noResult.style.display = (rows.length && vis === 0) ? '' : 'none';
    }

    let debounceTimer;
    searchInput && searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(runFilter, 180);
    });
    filterRole && filterRole.addEventListener('change', runFilter);

    runFilter();

    /* ── AUTO DISMISS ALERT ── */
    const alert = document.getElementById('alertSuccess');
    if (alert) {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            setTimeout(() => alert.remove(), 500);
        }, 3500);
    }

    /* ── LOGOUT CONFIRM ── */
    document.querySelectorAll('.logout-form').forEach(f =>
        f.addEventListener('submit', e => { if (!confirm('Yakin ingin logout?')) e.preventDefault(); })
    );

})();