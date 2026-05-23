document.addEventListener('DOMContentLoaded', function() {
    initRiwayat();
});

/**
 * Initialize order history page functionality
 */
function initRiwayat() {
    // === Image Fallback Handling ===
    const productImages = document.querySelectorAll('.product-image');
    
    productImages.forEach(img => {
        img.addEventListener('error', function() {
            this.outerHTML = `
                <div class="product-image-placeholder">
                    <i class="fa-solid fa-cookie"></i>
                </div>
            `;
        });
    });

    // === Smooth Scroll for Navigation ===
    const navLinks = document.querySelectorAll('.nav-links a');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Allow default navigation but can add analytics here
            console.log('Navigasi:', this.href);
        });
    });

    // === Lazy Load Images (Optional Enhancement) ===
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    const src = img.dataset.src;
                    if (src) {
                        img.src = src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                }
            });
        });
        
        document.querySelectorAll('img.lazy').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // === Card Hover Enhancement (Mobile Touch) ===
    const orderCards = document.querySelectorAll('.order-card');
    orderCards.forEach(card => {
        // Add tap feedback on mobile
        card.addEventListener('touchstart', function() {
            this.style.transform = 'translateY(-2px)';
        }, { passive: true });
        
        card.addEventListener('touchend', function() {
            this.style.transform = '';
        }, { passive: true });
    });
}

/**
 * Format currency display (utility)
 * @param {number} amount - Amount in IDR
 * @returns {string} Formatted currency
 */
function formatRupiah(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

/**
 * Get status badge class based on status string
 * @param {string} status - Order/payment status
 * @param {string} type - 'order' or 'payment'
 * @returns {string} CSS class name
 */
function getStatusBadgeClass(status, type = 'order') {
    const prefix = type === 'payment' ? 'payment-' : '';
    const statusMap = {
        'menunggu': `${prefix}pending`,
        'diproses': `${prefix}processing`,
        'selesai': `${prefix}completed`,
        'pending': `${prefix}pending`,
        'lunas': `${prefix}paid`
    };
    return statusMap[status?.toLowerCase()] || `${prefix}pending`;
}

// Export utilities for external use
window.RiwayatUtils = {
    init: initRiwayat,
    formatRupiah,
    getStatusBadgeClass
};