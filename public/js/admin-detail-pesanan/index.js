(function () {
    // Select elements
    const searchInput    = document.getElementById('searchInput');
    const filterPesanan  = document.getElementById('filterPesanan');
    const filterSubtotal = document.getElementById('filterSubtotal');
    const resultCount    = document.getElementById('resultCount');
    const noResult       = document.getElementById('noResult');
    const tbody          = document.getElementById('tableBody');

    // Get all data rows (exclude empty state rows)
    function getDataRows() {
        return tbody ? Array.from(tbody.querySelectorAll('tr[data-produk]')) : [];
    }

    // Main filter function
    function runFilter() {
        const query      = (searchInput.value || '').toLowerCase().trim();
        const pesananVal = filterPesanan.value;
        const subtotalVal = filterSubtotal.value;
        const rows       = getDataRows();
        let visibleCount = 0;

        rows.forEach(row => {
            const rProduk   = row.dataset.produk;
            const rPesanan  = row.dataset.pesanan;
            const rSubtotal = parseInt(row.dataset.subtotal) || 0;

            // Match search query (produk name or pesanan ID)
            const matchQuery = !query || rProduk.includes(query) || rPesanan.includes(query);
            
            // Match pesanan filter
            const matchPesanan = !pesananVal || rPesanan === pesananVal;
            
            // Match subtotal range filter
            let matchSubtotal = true;
            if (subtotalVal === '0-50000') {
                matchSubtotal = rSubtotal < 50000;
            } else if (subtotalVal === '50000-200000') {
                matchSubtotal = rSubtotal >= 50000 && rSubtotal <= 200000;
            } else if (subtotalVal === '200000+') {
                matchSubtotal = rSubtotal > 200000;
            }

            // Show/hide row based on all conditions
            const shouldShow = matchQuery && matchPesanan && matchSubtotal;
            row.classList.toggle('row-hidden', !shouldShow);
            if (shouldShow) visibleCount++;
        });

        // Update result counter
        if (resultCount) {
            resultCount.innerHTML = rows.length
                ? `Menampilkan <strong>${visibleCount}</strong> dari <strong>${rows.length}</strong> detail`
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
    if (filterPesanan) {
        filterPesanan.addEventListener('change', runFilter);
    }
    if (filterSubtotal) {
        filterSubtotal.addEventListener('change', runFilter);
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
})();