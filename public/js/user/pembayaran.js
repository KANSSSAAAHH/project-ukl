document.addEventListener('DOMContentLoaded', function() {
    initPembayaran();
});

function initPembayaran() {
    // === Image Preview for File Upload ===
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('preview');
    
    if (fileInput && preview) {
        fileInput.addEventListener('change', handleFileSelect);
        
        // Drag & Drop support
        const uploadZone = fileInput.closest('.upload-zone');
        if (uploadZone) {
            setupDragAndDrop(uploadZone, fileInput, preview);
        }
    }
    
    // === Copy to Clipboard Functionality ===
    const copyButtons = document.querySelectorAll('.copy-btn');
    copyButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const nomor = this.dataset.nomor || '+628523241498';
            copyToClipboard(nomor, this);
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
    
    // === Form Submission Loading State ===
    const paymentForm = document.querySelector('form[action*="pembayaran.upload"]');
    if (paymentForm) {
        paymentForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('.btn-submit');
            if (submitBtn) {
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            }
        });
    }
}

/**
 * Handle file selection and show preview
 * @param {Event} e - Change event
 */
function handleFileSelect(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');
    
    if (!file || !preview) return;
    
    // Validate file type
    if (!file.type.match('image.*')) {
        alert('Harap upload file gambar (JPG/PNG)');
        e.target.value = '';
        return;
    }
    
    // Validate file size (max 2MB)
    if (file.size > 2 * 1024 * 1024) {
        alert('Ukuran file maksimal 2MB');
        e.target.value = '';
        return;
    }
    
    // Show preview
    const reader = new FileReader();
    reader.onload = function(ev) {
        preview.src = ev.target.result;
        preview.classList.add('visible');
        
        // Scroll to preview smoothly
        preview.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    };
    reader.readAsDataURL(file);
}

/**
 * Setup drag and drop for upload zone
 * @param {HTMLElement} zone - Drop zone element
 * @param {HTMLInputElement} input - File input
 * @param {HTMLElement} preview - Preview image element
 */
function setupDragAndDrop(zone, input, preview) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        zone.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        zone.addEventListener(eventName, () => zone.classList.add('dragover'), false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        zone.addEventListener(eventName, () => zone.classList.remove('dragover'), false);
    });
    
    zone.addEventListener('drop', function(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files[0]) {
            input.files = files;
            // Trigger change event manually
            const event = new Event('change', { bubbles: true });
            input.dispatchEvent(event);
        }
    }, false);
}

/**
 * Copy text to clipboard with feedback
 * @param {string} text - Text to copy
 * @param {HTMLElement} btn - Button element for feedback
 */
function copyToClipboard(text, btn) {
    // Remove formatting from number for copying
    const cleanText = text.replace(/[^0-9+]/g, '');
    
    navigator.clipboard.writeText(cleanText).then(() => {
        // Visual feedback
        const originalText = btn.innerHTML;
        btn.classList.add('copied');
        btn.innerHTML = '<i class="fa-solid fa-check"></i> Tersalin!';
        
        setTimeout(() => {
            btn.classList.remove('copied');
            btn.innerHTML = originalText;
        }, 2000);
    }).catch(err => {
        console.error('Gagal menyalin:', err);
        // Fallback for older browsers
        fallbackCopy(cleanText, btn);
    });
}

/**
 * Fallback copy method for older browsers
 * @param {string} text - Text to copy
 * @param {HTMLElement} btn - Button element
 */
function fallbackCopy(text, btn) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.left = '-9999px';
    document.body.appendChild(textarea);
    textarea.select();
    
    try {
        document.execCommand('copy');
        btn.classList.add('copied');
        btn.innerHTML = '<i class="fa-solid fa-check"></i> Tersalin!';
        setTimeout(() => {
            btn.classList.remove('copied');
            btn.innerHTML = btn.innerHTML.replace('Tersalin!', 'Salin Nomor');
        }, 2000);
    } catch (err) {
        alert('Gagal menyalin. Silakan salin manual.');
    }
    
    document.body.removeChild(textarea);
}

// Expose functions globally for inline onclick (backward compatibility)
window.copyNomor = function(nomor) {
    const btn = document.querySelector(`[onclick="copyNomor('${nomor}')"]`);
    copyToClipboard(nomor, btn);
};

// Export utilities for module usage
window.PembayaranUtils = {
    init: initPembayaran,
    copyToClipboard,
    handleFileSelect
};