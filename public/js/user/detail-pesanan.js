document.addEventListener('DOMContentLoaded', function() {
    initDetailPesanan();
});

function initDetailPesanan() {
    // === Image Error Handling (fallback placeholder) ===
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

    // === Proof Image Error Handling ===
    const proofImage = document.querySelector('.proof-image');
    if (proofImage) {
        proofImage.addEventListener('error', function() {
            this.outerHTML = `
                <div class="product-image-placeholder" style="width:100%;max-height:250px;">
                    <i class="fa-solid fa-image" style="font-size:2rem;"></i>
                    <span style="display:block;font-size:0.8rem;margin-top:8px;color:var(--text-light)">
                        Gambar tidak tersedia
                    </span>
                </div>
            `;
        });
    }

    // === Smooth Scroll for Back Link (optional enhancement) ===
    const backLink = document.querySelector('.back-link');
    if (backLink) {
        backLink.addEventListener('click', function(e) {
            // Biarkan browser handle navigation, 
            // tapi bisa ditambah analytics tracking di sini jika perlu
            console.log('Navigasi ke riwayat pesanan');
        });
    }
}

// Export utility jika diperlukan module lain
window.DetailPesananUtils = {
    init: initDetailPesanan
};