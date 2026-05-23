document.addEventListener('DOMContentLoaded', function() {
    initKeranjang();
});

function initKeranjang() {
    // === Image Fallback Handling ===
    const cartImages = document.querySelectorAll('.cart-image');
    
    cartImages.forEach(img => {
        img.addEventListener('error', function() {
            this.outerHTML = `
                <div class="cart-image-placeholder">
                    <i class="fa-solid fa-cookie"></i>
                </div>
            `;
        });
    });

    // === Delete Button Confirmation ===
    const deleteForms = document.querySelectorAll('form[method="POST"][action*="keranjang.hapus"]');
    
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const itemName = form.closest('.cart-item')?.querySelector('.cart-name')?.textContent || 'produk ini';
            
            if (!confirm(`Yakin ingin menghapus ${itemName} dari keranjang?`)) {
                e.preventDefault();
            }
        });
    });

    // === Alert Auto-Dismiss ===
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // === Quantity Display Enhancement (optional) ===
    // Jika nanti ada fitur update quantity, bisa ditambahkan di sini
}

// Export utility functions
window.KeranjangUtils = {
    init: initKeranjang
};