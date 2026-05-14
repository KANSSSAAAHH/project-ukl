(function () {
    // Select DOM elements
    const searchInput  = document.getElementById('searchInput');
    const filterUser   = document.getElementById('filterUser');
    const filterJumlah = document.getElementById('filterJumlah');
    const resultCount  = document.getElementById('resultCount');
    const noResult     = document.getElementById('noResult');
    const tbody        = document.getElementById('tableBody');

    // Get all data rows (exclude empty state rows)
    function getDataRows() {
        return tbody ? Array.from(tbody.querySelectorAll('tr[data-user]')) : [];
    }

    // Main filter function
    function runFilter() {
        const query    = (searchInput.value || '').toLowerCase().trim();
        const userVal  = filterUser.value.toLowerCase();
        const jumlahVal = filterJumlah.value;
        const rows     = getDataRows();
        let visibleCount = 0;

        rows.forEach(row => {
            const rUser   = row.dataset.user;
            const rProduk = row.dataset.produk;
            const rJumlah = parseInt(row.dataset.jumlah) || 0;

            // Match search query (user name or produk name)
            const matchQuery = !query || rUser.includes(query) || rProduk.includes(query);
            
            // Match user filter
            const matchUser = !userVal || rUser === userVal;
            
            // Match jumlah range filter
            let matchJumlah = true;
            if (jumlahVal === '1') {
                matchJumlah = rJumlah === 1;
            } else if (jumlahVal === '2-5') {
                matchJumlah = rJumlah >= 2 && rJumlah <= 5;
            } else if (jumlahVal === '6+') {
                matchJumlah = rJumlah >= 6;
            }

            // Show/hide row based on all conditions
            const shouldShow = matchQuery && matchUser && matchJumlah;
            row.classList.toggle('row-hidden', !shouldShow);
            if (shouldShow) visibleCount++;
        });

        // Update result counter
        if (resultCount) {
            resultCount.innerHTML = rows.length
                ? `Menampilkan <strong>${visibleCount}</strong> dari <strong>${rows.length}</strong> item`
                : '';
        }

        // Show/hide "no result" empty state
        if (noResult) {
            noResult.style.display = (rows.length && visibleCount === 0) ? '' : 'none';
        }
    }

    // Event listeners with debounce for search input
    let debounceTimer;
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(runFilter, 180);
        });
    }
    if (filterUser) {
        filterUser.addEventListener('change', runFilter);
    }
    if (filterJumlah) {
        filterJumlah.addEventListener('change', runFilter);
    }

    // Initial filter run on page load
    runFilter();

    // Auto-dismiss success alert after 3.5 seconds
    const alertEl = document.getElementById('alertSuccess');
    if (alertEl) {
        setTimeout(() => {
            alertEl.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alertEl.style.opacity = '0';
            alertEl.style.transform = 'translateY(-8px)';
            setTimeout(() => alertEl.remove(), 500);
        }, 3500);
    }

    // Console log for debugging (remove in production)
    console.log('✅ Index Keranjang loaded with filter functionality');
})();