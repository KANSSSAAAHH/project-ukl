document.addEventListener('DOMContentLoaded', function() {
    initCheckout();
});

function initCheckout() {
    const form = document.querySelector('form');
    const checkoutBtn = document.querySelector('.btn-checkout');
    const paymentInputs = document.querySelectorAll('input[name="metode"]');
    const formInputs = document.querySelectorAll('.form-input, .form-textarea');

    // === Payment Method Selection ===
    paymentInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Visual feedback for selected payment
            document.querySelectorAll('.payment-label').forEach(label => {
                label.parentElement.classList.remove('selected');
            });
            if (this.checked) {
                this.closest('.payment-option').classList.add('selected');
            }
        });
    });

    // === Form Input Validation ===
    formInputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateInput(this);
        });
        
        input.addEventListener('input', function() {
            // Clear error state on typing
            if (this.classList.contains('error')) {
                this.classList.remove('error');
                clearError(this);
            }
        });
    });

    // === Phone Number Formatting ===
    const phoneInput = document.querySelector('input[name="no_hp"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            // Only allow numbers and limit length
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);
        });
    }

    // === Postal Code Formatting ===
    const postalInput = document.querySelector('input[name="kode_pos"]');
    if (postalInput) {
        postalInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 5);
        });
    }

    // === Form Submission ===
    if (form) {
        form.addEventListener('submit', function(e) {
            // Validate all required fields
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!validateInput(field)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
                scrollToFirstError();
                return;
            }

            // Show loading state
            setLoadingState(checkoutBtn, true);
        });
    }

    // === Handle Backend Errors ===
    const errorAlert = document.querySelector('.alert-error');
    if (errorAlert) {
        // Auto-hide after 5 seconds
        setTimeout(() => {
            errorAlert.style.transition = 'opacity 0.3s ease';
            errorAlert.style.opacity = '0';
            setTimeout(() => errorAlert.remove(), 300);
        }, 5000);
    }
}

/**
 * Validate individual input field
 * @param {HTMLElement} input - The input element to validate
 * @returns {boolean} - Whether the input is valid
 */
function validateInput(input) {
    if (!input.hasAttribute('required')) return true;
    
    const value = input.value.trim();
    const name = input.name;
    
    // Clear previous error
    clearError(input);
    
    // Validation rules
    if (!value) {
        showError(input, 'Field ini wajib diisi');
        return false;
    }
    
    // Phone validation
    if (name === 'no_hp' && !/^08[0-9]{8,}$/.test(value)) {
        showError(input, 'Nomor HP tidak valid');
        return false;
    }
    
    // Postal code validation
    if (name === 'kode_pos' && !/^[0-9]{5}$/.test(value)) {
        showError(input, 'Kode pos harus 5 angka');
        return false;
    }
    
    return true;
}

/**
 * Show error message for input
 * @param {HTMLElement} input - The input element
 * @param {string} message - Error message to display
 */
function showError(input, message) {
    input.classList.add('error');
    
    // Create or update error message element
    let errorEl = input.parentElement.querySelector('.input-error');
    if (!errorEl) {
        errorEl = document.createElement('small');
        errorEl.className = 'input-error';
        errorEl.style.cssText = 'color: #b91c1c; font-size: 0.75rem; margin-top: 4px; display: block;';
        input.parentElement.appendChild(errorEl);
    }
    errorEl.textContent = message;
}

/**
 * Clear error message for input
 * @param {HTMLElement} input - The input element
 */
function clearError(input) {
    input.classList.remove('error');
    const errorEl = input.parentElement.querySelector('.input-error');
    if (errorEl) errorEl.remove();
}

/**
 * Scroll to first error field
 */
function scrollToFirstError() {
    const firstError = document.querySelector('.form-input.error, .form-textarea.error');
    if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        firstError.focus();
    }
}

/**
 * Toggle loading state on button
 * @param {HTMLElement} btn - The button element
 * @param {boolean} loading - Whether to show loading state
 */
function setLoadingState(btn, loading) {
    if (!btn) return;
    
    if (loading) {
        btn.classList.add('loading');
        btn.disabled = true;
        // Store original text
        btn.dataset.originalText = btn.innerHTML;
    } else {
        btn.classList.remove('loading');
        btn.disabled = false;
        // Restore original text
        if (btn.dataset.originalText) {
            btn.innerHTML = btn.dataset.originalText;
        }
    }
}

/**
 * Utility: Format currency display (optional enhancement)
 * @param {number} amount - Amount in rupiah
 * @returns {string} Formatted currency string
 */
function formatRupiah(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

// Export functions for potential external use
window.CheckoutUtils = {
    validateInput,
    formatRupiah,
    setLoadingState
};