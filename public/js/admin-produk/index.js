/**
 * Index Produk - Full Feature Script
 * Fitur: Sidebar toggle, Search & Filter, Alert auto-dismiss, Logout confirm
 */

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

    /* ── 3. SEARCH & FILTER FUNCTIONALITY ── */
    const searchInput    = document.getElementById('searchInput');
    const filterKategori = document.getElementById('filterKategori');
    const filterStatus   = document.getElementById('filterStatus');
    const resultCount    = document.getElementById('resultCount');
    const noResult       = document.getElementById('noResult');
    const tbody          = document.getElementById('tableBody');

    function getDataRows() {
        return tbody ? Array.from(tbody.querySelectorAll('tr[data-name]')) : [];
    }

    function runFilter() {
        const query  = (searchInput?.value || '').toLowerCase().trim();
        const kategori = filterKategori?.value.toLowerCase() || '';
        const status = filterStatus?.value.toLowerCase() || '';
        const rows   = getDataRows();
        let visibleCount = 0;

        rows.forEach(row => {
            const rowName     = row.dataset.name || '';
            const rowKategori = row.dataset.kategori || '';
            const rowStatus   = row.dataset.status || '';

            // Match conditions
            const matchQuery  = !query  || rowName.includes(query);
            const matchKategori = !kategori || rowKategori === kategori;
            const matchStatus = !status || rowStatus === status;
            const shouldShow = matchQuery && matchKategori && matchStatus;

            // Toggle visibility
            row.classList.toggle('row-hidden', !shouldShow);
            if (shouldShow) visibleCount++;
        });

        // Update result counter
        if (resultCount) {
            resultCount.innerHTML = rows.length
                ? `Menampilkan <strong>${visibleCount}</strong> dari <strong>${rows.length}</strong> produk`
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
    if (filterKategori) {
        filterKategori.addEventListener('change', runFilter);
    }
    if (filterStatus) {
        filterStatus.addEventListener('change', runFilter);
    }

    // Initial filter run
    runFilter();

    /* ── 4. AUTO-DISMISS SUCCESS ALERT ── */
    const alertEl = document.getElementById('alertSuccess');
    if (alertEl) {
        setTimeout(() => {
            alertEl.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alertEl.style.opacity = '0';
            alertEl.style.transform = 'translateY(-8px)';
            setTimeout(() => alertEl.remove(), 500);
        }, 3500);
    }

    /* ── 5. LOGOUT CONFIRMATION ── */
    document.querySelectorAll('.logout-form').forEach(form => {
        form.addEventListener('submit', (e) => {
            if (!confirm('Yakin ingin logout?')) {
                e.preventDefault();
            }
        });
    });

    /* ── 6. CONSOLE LOG (Debug only) ── */
    console.log('✅ Index Produk loaded with filter functionality');

})();