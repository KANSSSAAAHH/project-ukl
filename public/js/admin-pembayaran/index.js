(function () {
    'use strict';

    /* ── 1. SIDEBAR TOGGLE (Mobile) ── */
    const sidebar   = document.getElementById('sidebar');
    const hamburger = document.getElementById('hamburgerBtn');
    const overlay   = document.getElementById('sidebarOverlay');

    function toggleSidebar(open) {
        if (!sidebar || !overlay) return;
        sidebar.classList.toggle('open', open);
        overlay.classList.toggle('show', open);
        document.body.style.overflow = open ? 'hidden' : '';
    }

    if (hamburger) {
        hamburger.addEventListener('click', () => {
            const isOpen = sidebar.classList.contains('open');
            toggleSidebar(!isOpen);
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => toggleSidebar(false));
    }

    /* ── 2. TOPBAR SCROLL SHADOW ── */
    const topbar = document.querySelector('.topbar');
    if (topbar) {
        window.addEventListener('scroll', () => {
            topbar.style.boxShadow = window.scrollY > 4
                ? '0 2px 20px rgba(139,26,26,0.10)'
                : 'none';
        }, { passive: true });
    }

    /* ── 3. LIGHTBOX FOR BUKTI BAYAR ── */
    const lightbox    = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');

    window.openLightbox = function(src) {
        if (!lightbox || !lightboxImg) return;
        lightboxImg.src = src;
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden';
    };

    window.closeLightbox = function() {
        if (!lightbox) return;
        lightbox.classList.remove('show');
        document.body.style.overflow = '';
        // Reset src setelah animasi close
        setTimeout(() => { if (lightboxImg) lightboxImg.src = ''; }, 200);
    };

    // Close lightbox with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && lightbox?.classList.contains('show')) {
            closeLightbox();
        }
    });

    // Close lightbox when clicking outside image
    if (lightbox) {
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) closeLightbox();
        });
    }

    /* ── 4. SEARCH & FILTER FUNCTIONALITY ── */
    const searchInput  = document.getElementById('searchInput');
    const filterStatus = document.getElementById('filterStatus');
    const filterMetode = document.getElementById('filterMetode');
    const resultCount  = document.getElementById('resultCount');
    const noResult     = document.getElementById('noResult');
    const tbody        = document.getElementById('tableBody');

    function getDataRows() {
        return tbody ? Array.from(tbody.querySelectorAll('tr[data-id]')) : [];
    }

    function runFilter() {
        const query    = (searchInput?.value || '').toLowerCase().trim();
        const status   = filterStatus?.value.toLowerCase() || '';
        const metode   = filterMetode?.value.toLowerCase() || '';
        const rows     = getDataRows();
        let visibleCount = 0;

        rows.forEach(row => {
            const rowId     = row.dataset.id || '';
            const rowMetode = row.dataset.metode || '';
            const rowStatus = row.dataset.status || '';

            // Match conditions
            const matchQuery    = !query    || rowId.includes(query) || rowMetode.includes(query);
            const matchStatus   = !status   || rowStatus === status;
            const matchMetode   = !metode   || rowMetode === metode;
            const shouldShow    = matchQuery && matchStatus && matchMetode;

            // Toggle visibility
            row.classList.toggle('row-hidden', !shouldShow);
            if (shouldShow) visibleCount++;
        });

        // Update result counter
        if (resultCount) {
            resultCount.innerHTML = rows.length
                ? `Menampilkan <strong>${visibleCount}</strong> dari <strong>${rows.length}</strong> pembayaran`
                : '';
        }

        // Show/hide "no result" empty state
        if (noResult) {
            noResult.style.display = (rows.length && visibleCount === 0) ? '' : 'none';
        }
    }

    // Event listeners with debounce for search
    let debounceTimer;
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(runFilter, 180);
        });
    }
    if (filterStatus) {
        filterStatus.addEventListener('change', runFilter);
    }
    if (filterMetode) {
        filterMetode.addEventListener('change', runFilter);
    }

    // Initial filter run
    runFilter();

    /* ── 5. AUTO-DISMISS SUCCESS ALERT ── */
    const alertEl = document.getElementById('alertSuccess');
    if (alertEl) {
        setTimeout(() => {
            alertEl.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alertEl.style.opacity = '0';
            alertEl.style.transform = 'translateY(-8px)';
            setTimeout(() => alertEl.remove(), 500);
        }, 3500);
    }

    /* ── 6. LOGOUT CONFIRMATION ── */
    document.querySelectorAll('.logout-form').forEach(form => {
        form.addEventListener('submit', (e) => {
            if (!confirm('Yakin ingin logout?')) {
                e.preventDefault();
            }
        });
    });

    /* ── 7. CONSOLE LOG (Debug only) ── */
    console.log('✅ Index Pembayaran loaded with full features');

})();