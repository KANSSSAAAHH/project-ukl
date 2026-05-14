/**
 * Index Review - Full Feature Script
 * Fitur: Search & Filter, Alert auto-dismiss
 */

(function () {
    'use strict';

    /* ── 1. SEARCH & FILTER FUNCTIONALITY ── */
    const searchInput  = document.getElementById('searchInput');
    const filterRating = document.getElementById('filterRating');
    const filterProduk = document.getElementById('filterProduk');
    const resultCount  = document.getElementById('resultCount');
    const noResult     = document.getElementById('noResult');
    const tbody        = document.getElementById('tableBody');

    function getDataRows() {
        return tbody ? Array.from(tbody.querySelectorAll('tr[data-user]')) : [];
    }

    function runFilter() {
        const query  = (searchInput?.value || '').toLowerCase().trim();
        const rating = filterRating?.value || '';
        const produk = filterProduk?.value.toLowerCase() || '';
        const rows   = getDataRows();
        let visibleCount = 0;

        rows.forEach(row => {
            const rowUser   = row.dataset.user || '';
            const rowProduk = row.dataset.produk || '';
            const rowRating = row.dataset.rating || '';

            // Match conditions
            const matchQuery  = !query  || rowUser.includes(query) || rowProduk.includes(query);
            const matchRating = !rating || rowRating === rating;
            const matchProduk = !produk || rowProduk === produk;
            const shouldShow  = matchQuery && matchRating && matchProduk;

            // Toggle visibility
            row.classList.toggle('row-hidden', !shouldShow);
            if (shouldShow) visibleCount++;
        });

        // Update result counter
        if (resultCount) {
            resultCount.innerHTML = rows.length
                ? `Menampilkan <strong>${visibleCount}</strong> dari <strong>${rows.length}</strong> review`
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
    if (filterRating) {
        filterRating.addEventListener('change', runFilter);
    }
    if (filterProduk) {
        filterProduk.addEventListener('change', runFilter);
    }

    // Initial filter run
    runFilter();

    /* ── 2. AUTO-DISMISS SUCCESS ALERT ── */
    const alertEl = document.getElementById('alertSuccess');
    if (alertEl) {
        setTimeout(() => {
            alertEl.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alertEl.style.opacity = '0';
            alertEl.style.transform = 'translateY(-8px)';
            setTimeout(() => alertEl.remove(), 500);
        }, 3500);
    }

    /* ── 3. CONSOLE LOG (Debug only) ── */
    console.log('✅ Index Review loaded with filter functionality');

})();