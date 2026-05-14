document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const ratingInputs = document.querySelectorAll('input[name="rating"]');
    const starLabels = document.querySelectorAll('.star-rating label');
    const komentarInput = document.querySelector('textarea[name="komentar"]');
    const userSelect = document.querySelector('select[name="id_user"]');
    const produkSelect = document.querySelector('select[name="id_produk"]');

    // ===== STAR RATING VISUAL FEEDBACK =====
    function updateStarVisuals(selectedValue) {
        starLabels.forEach(label => {
            const value = parseInt(label.getAttribute('for').replace('star', ''));
            if (value <= selectedValue) {
                label.style.color = 'var(--gold)';
            } else {
                label.style.color = '#ddd';
            }
        });
    }

    // Initial state: update stars based on pre-selected value (from old() or database)
    const preSelected = document.querySelector('input[name="rating"]:checked');
    if (preSelected) {
        updateStarVisuals(parseInt(preSelected.value));
    }

    // Event listener for star selection
    ratingInputs.forEach(input => {
        input.addEventListener('change', function () {
            updateStarVisuals(parseInt(this.value));
        });
    });

    // Hover effect for stars
    starLabels.forEach(label => {
        label.addEventListener('mouseenter', function () {
            const value = parseInt(this.getAttribute('for').replace('star', ''));
            starLabels.forEach(lbl => {
                const lblValue = parseInt(lbl.getAttribute('for').replace('star', ''));
                lbl.style.color = lblValue <= value ? 'var(--gold)' : '#ddd';
            });
        });

        label.addEventListener('mouseleave', function () {
            const selected = document.querySelector('input[name="rating"]:checked');
            if (selected) {
                updateStarVisuals(parseInt(selected.value));
            } else {
                starLabels.forEach(lbl => lbl.style.color = '#ddd');
            }
        });
    });

    // ===== CHARACTER COUNTER FOR KOMENTAR =====
    if (komentarInput) {
        const maxChars = 500;
        const counter = document.createElement('div');
        counter.className = 'rating-hint';
        counter.style.textAlign = 'right';
        counter.textContent = `${komentarInput.value.length}/${maxChars} karakter`;
        komentarInput.parentNode.appendChild(counter);

        komentarInput.addEventListener('input', function () {
            const len = this.value.length;
            counter.textContent = `${len}/${maxChars} karakter`;
            
            // Warning if approaching limit
            if (len > maxChars * 0.9) {
                counter.style.color = 'var(--crimson)';
            } else {
                counter.style.color = 'var(--text-light)';
            }

            // Prevent overflow
            if (len > maxChars) {
                this.value = this.value.substring(0, maxChars);
                counter.textContent = `${maxChars}/${maxChars} karakter`;
            }
        });
    }

    // ===== FORM VALIDATION =====
    if (form) {
        form.addEventListener('submit', function (e) {
            let isValid = true;
            let errorMsg = [];

            // Validasi user
            if (userSelect && !userSelect.value) {
                isValid = false;
                errorMsg.push('Pilih user/pelanggan terlebih dahulu.');
            }

            // Validasi produk
            if (produkSelect && !produkSelect.value) {
                isValid = false;
                errorMsg.push('Pilih produk yang direview.');
            }

            // Validasi rating
            const selectedRating = document.querySelector('input[name="rating"]:checked');
            if (!selectedRating) {
                isValid = false;
                errorMsg.push('Pilih rating (1-5 bintang).');
            }

            // Validasi komentar
            if (komentarInput && komentarInput.value.trim().length < 10) {
                isValid = false;
                errorMsg.push('Komentar minimal 10 karakter.');
            }

            if (!isValid) {
                e.preventDefault();
                alert('⚠️ Mohon perbaiki error berikut:\n\n• ' + errorMsg.join('\n• '));
                
                // Focus ke field pertama yang error
                if (!userSelect?.value) userSelect?.focus();
                else if (!produkSelect?.value) produkSelect?.focus();
                else if (!selectedRating) document.querySelector('.star-rating')?.scrollIntoView({ behavior: 'smooth' });
                else if (komentarInput?.value.trim().length < 10) komentarInput?.focus();
                
                return false;
            }
        });
    }

    // ===== UX: Highlight field yang sudah ada data =====
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        if (input.value && input.value.trim() !== '') {
            input.style.borderColor = 'var(--gold)';
            input.title = 'Data sudah terisi';
        }
    });

    // ===== UX: Auto-focus ke field pertama jika kosong =====
    if (userSelect && !userSelect.value) {
        userSelect.focus();
    }

    console.log('✅ Edit Review form loaded with star rating UX');
});