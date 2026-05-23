document.addEventListener('DOMContentLoaded', function() {
    initRating();
});

/**
 * Initialize rating page functionality
 */
function initRating() {
    const starContainer = document.getElementById('starContainer');
    const starHint = document.getElementById('starHint');
    const ratingForm = document.getElementById('ratingForm');
    const formSection = document.getElementById('formSection');
    const thankyouSection = document.getElementById('thankyouSection');
    
    // Star rating hints
    const hints = {
        1: 'Mengecewakan 😞',
        2: 'Kurang memuaskan 😕',
        3: 'Lumayan 😊',
        4: 'Bagus! 😄',
        5: 'Luar biasa! 🤩'
    };
    
    // Initialize star rating
    if (starContainer) {
        initStarRating(starContainer, starHint, hints);
    }
    
    // Handle form submission
    if (ratingForm) {
        ratingForm.addEventListener('submit', handleFormSubmit);
    }
    
    // Show thank you overlay if success session exists
    if (window.ratingSuccess) {
        showThankYou(formSection, thankyouSection);
    }
    
    // Auto-dismiss alerts
    dismissAlerts();
}

/**
 * Initialize interactive star rating
 * @param {HTMLElement} container - Star container element
 * @param {HTMLElement} hintEl - Hint text element
 * @param {Object} hints - Rating hint messages
 */
function initStarRating(container, hintEl, hints) {
    const labels = container.querySelectorAll('label');
    const radios = container.querySelectorAll('input[type="radio"]');
    let selectedValue = 0;
    
    // Check for pre-selected value (from Laravel old input)
    const checkedRadio = container.querySelector('input[type="radio"]:checked');
    if (checkedRadio) {
        selectedValue = parseInt(checkedRadio.value);
        updateStars(labels, selectedValue);
        if (hintEl) hintEl.textContent = hints[selectedValue];
    }
    
    // Add event listeners to labels
    labels.forEach(label => {
        const value = parseInt(label.dataset.value);
        
        // Hover in: preview selection
        label.addEventListener('mouseenter', () => {
            updateStars(labels, value);
            if (hintEl) hintEl.textContent = hints[value];
        });
        
        // Hover out: revert to actual selection
        label.addEventListener('mouseleave', () => {
            updateStars(labels, selectedValue);
            if (hintEl) {
                hintEl.textContent = selectedValue 
                    ? hints[selectedValue] 
                    : 'Ketuk bintang untuk menilai';
            }
        });
        
        // Click: select value
        label.addEventListener('click', () => {
            selectedValue = value;
            const radio = document.getElementById(`s${value}`);
            if (radio) radio.checked = true;
            updateStars(labels, value);
            if (hintEl) hintEl.textContent = hints[value];
        });
    });
    
    // Update visual state of stars
    function updateStars(labelList, rating) {
        labelList.forEach(label => {
            const labelValue = parseInt(label.dataset.value);
            if (labelValue <= rating) {
                label.classList.add('active', 'selected');
            } else {
                label.classList.remove('active', 'selected');
            }
        });
    }
}

/**
 * Handle form submission with loading state
 * @param {Event} e - Submit event
 */
function handleFormSubmit(e) {
    const submitBtn = e.target.querySelector('.btn-submit');
    
    // Basic validation: check if rating is selected
    const ratingSelected = e.target.querySelector('input[name="rating"]:checked');
    if (!ratingSelected) {
        e.preventDefault();
        showRatingError();
        return;
    }
    
    // Show loading state
    if (submitBtn) {
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    }
}

/**
 * Show error message if no rating selected
 */
function showRatingError() {
    const hintEl = document.getElementById('starHint');
    if (hintEl) {
        hintEl.textContent = '⚠️ Pilih rating terlebih dahulu';
        hintEl.style.color = 'var(--crimson)';
        setTimeout(() => {
            hintEl.textContent = 'Ketuk bintang untuk menilai';
            hintEl.style.color = '';
        }, 3000);
    }
    
    // Shake animation on star container
    const container = document.getElementById('starContainer');
    if (container) {
        container.style.animation = 'shake 0.5s ease';
        setTimeout(() => container.style.animation = '', 500);
    }
}

/**
 * Show thank you overlay after successful submission
 * @param {HTMLElement} formSection - Form section element
 * @param {HTMLElement} thankYouSection - Thank you section element
 */
function showThankYou(formSection, thankYouSection) {
    if (formSection) formSection.style.display = 'none';
    if (thankYouSection) thankYouSection.classList.add('show');
}

/**
 * Auto-dismiss alert messages after 5 seconds
 */
function dismissAlerts() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
}

// Add shake animation keyframes dynamically
const style = document.createElement('style');
style.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-8px); }
        75% { transform: translateX(8px); }
    }
`;
document.head.appendChild(style);

// Expose global variable for Blade to trigger thank you state
window.ratingSuccess = false;

// Export utilities for external use
window.RatingUtils = {
    init: initRating,
    initStarRating,
    showThankYou
};