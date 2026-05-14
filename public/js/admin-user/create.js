document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const namaInput = document.querySelector('input[name="nama"]');
    const noHpInput = document.querySelector('input[name="no_hp"]');
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmInput = document.querySelector('input[name="password_confirmation"]');
    const roleSelect = document.querySelector('select[name="role"]');

    // ===== FORMAT NO HP =====
    if (noHpInput) {
        // Auto-format: hanya angka, maksimal 15 digit
        noHpInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 15) {
                this.value = this.value.slice(0, 15);
            }
        });

        // Validasi saat blur: pastikan minimal 10 digit
        noHpInput.addEventListener('blur', function () {
            if (this.value && this.value.length < 10) {
                alert('Nomor HP minimal 10 digit.');
                this.focus();
            }
        });
    }

    // ===== PASSWORD MATCH VALIDATION =====
    if (passwordInput && confirmInput) {
        function checkPasswordMatch() {
            if (confirmInput.value && passwordInput.value !== confirmInput.value) {
                confirmInput.style.borderColor = 'var(--crimson)';
                return false;
            } else {
                confirmInput.style.borderColor = '';
                return true;
            }
        }

        passwordInput.addEventListener('input', checkPasswordMatch);
        confirmInput.addEventListener('input', checkPasswordMatch);
        confirmInput.addEventListener('blur', checkPasswordMatch);
    }

    // ===== EMAIL FORMAT VALIDATION =====
    if (emailInput) {
        emailInput.addEventListener('blur', function () {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailRegex.test(this.value)) {
                this.style.borderColor = 'var(--crimson)';
                alert('Format email tidak valid.');
            } else {
                this.style.borderColor = '';
            }
        });
    }

    // ===== FORM SUBMISSION VALIDATION =====
    if (form) {
        form.addEventListener('submit', function (e) {
            let isValid = true;
            let errorMsg = [];

            // Validasi nama (minimal 3 karakter)
            if (namaInput && namaInput.value.trim().length < 3) {
                isValid = false;
                errorMsg.push('Nama minimal 3 karakter.');
            }

            // Validasi no HP
            if (noHpInput && (!noHpInput.value || noHpInput.value.length < 10)) {
                isValid = false;
                errorMsg.push('Nomor HP harus minimal 10 digit.');
            }

            // Validasi email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailInput && !emailRegex.test(emailInput.value)) {
                isValid = false;
                errorMsg.push('Format email tidak valid.');
            }

            // Validasi password match
            if (passwordInput && confirmInput && passwordInput.value !== confirmInput.value) {
                isValid = false;
                errorMsg.push('Konfirmasi password tidak cocok.');
            }

            // Validasi password length
            if (passwordInput && passwordInput.value.length < 6) {
                isValid = false;
                errorMsg.push('Password minimal 6 karakter.');
            }

            if (!isValid) {
                e.preventDefault();
                alert('⚠️ Mohon perbaiki error berikut:\n\n• ' + errorMsg.join('\n• '));
                
                // Focus ke field pertama yang error
                if (namaInput?.value.trim().length < 3) namaInput?.focus();
                else if (noHpInput?.value.length < 10) noHpInput?.focus();
                else if (!emailRegex.test(emailInput?.value)) emailInput?.focus();
                else if (passwordInput?.value !== confirmInput?.value) confirmInput?.focus();
                else if (passwordInput?.value.length < 6) passwordInput?.focus();
                
                return false;
            }
        });
    }

    // ===== UX: Auto-focus ke field pertama =====
    if (namaInput && !namaInput.value) {
        namaInput.focus();
    }

    console.log('✅ Create User form loaded with validations');
});