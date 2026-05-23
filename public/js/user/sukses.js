document.addEventListener('DOMContentLoaded', function() {
    initSukses();
});

/**
 * Initialize success page functionality
 */
function initSukses() {
    // === Confetti Animation (Optional Celebration) ===
    // Bisa diaktifkan jika ingin efek perayaan
    // triggerConfetti();
    
    // === Auto Redirect (Optional) ===
    // Jika ingin auto-redirect ke home setelah X detik:
    // autoRedirect(10000); // 10 detik
    
    // === Button Click Analytics (Optional) ===
    const homeBtn = document.querySelector('.btn-home');
    if (homeBtn) {
        homeBtn.addEventListener('click', function() {
            // Track click event (bisa integrasi dengan GA/analytics)
            console.log('User navigasi ke beranda dari halaman sukses');
        });
    }
}

/**
 * Trigger confetti celebration effect (optional)
 * Requires canvas-confetti library or custom implementation
 */
function triggerConfetti() {
    // Jika menggunakan canvas-confetti:
    // import confetti from 'canvas-confetti';
    // confetti({
    //     particleCount: 100,
    //     spread: 70,
    //     origin: { y: 0.6 }
    // });
    
    // Fallback: console log saja
    console.log('🎉 Pesanan berhasil! Selamat!');
}

/**
 * Auto redirect to home page after delay
 * @param {number} ms - Delay in milliseconds
 */
function autoRedirect(ms) {
    setTimeout(() => {
        window.location.href = '/';
    }, ms);
}

// Export utilities for external use
window.SuksesUtils = {
    init: initSukses,
    triggerConfetti,
    autoRedirect
};