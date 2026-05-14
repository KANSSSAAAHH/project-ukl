/**
 * Edit Pesanan - Form Enhancements & Validation
 * Fitur: Format total harga, validasi tanggal, visual feedback, UX improvements
 */

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const totalHargaInput = document.querySelector('input[name="total_harga"]');
    const tanggalInput = document.querySelector('input[name="tanggal_pesanan"]');
    const userSelect = document.querySelector('select[name="id_user"]');
    const statusSelect = document.querySelector('select[name="status_pesanan"]');

    // ===== FORMAT TOTAL HARGA =====
    if (totalHargaInput) {
        // Hanya angka, limit 15 digit
        totalHargaInput.addEventListener('input', function () {
            let value = this.value.replace(/[^0-9]/g, '');
            if (value.length > 15) {
                value = value.slice(0, 15);
            }
            this.value = value;
        });

        // Validasi saat blur
        totalHargaInput.addEventListener('blur', function () {
            const val = parseInt(this.value) || 0;
            if (val < 0) {
                alert('Total harga tidak boleh negatif.');
                this.value = '0';
                this.focus();
            }
        });
    }

    // ===== VALIDASI TANGGAL =====
    if (tanggalInput) {
        // Set max date ke hari ini
        const today = new Date().toISOString().split('T')[0];
        tanggalInput.max = today;

        // Validasi saat blur
        tanggalInput.addEventListener('blur', function () {
            if (!this.value) {
                alert('Tanggal pesanan wajib diisi.');
                this.focus();
            }
        });
    }

    // ===== FORM SUBMISSION VALIDATION =====
    if (form) {
        form.addEventListener('submit', function (e) {
            let isValid = true;
            let errorMsg = [];

            // Validasi user
            if (userSelect && !userSelect.value) {
                isValid = false;
                errorMsg.push('Pilih user/pelanggan terlebih dahulu.');
            }

            // Validasi total harga
            if (totalHargaInput) {
                const total = parseInt(totalHargaInput.value) || 0;
                if (total <= 0) {
                    isValid = false;
                    errorMsg.push('Total harga harus lebih dari 0.');
                }
            }

            // Validasi status
            if (statusSelect && !statusSelect.value) {
                isValid = false;
                errorMsg.push('Pilih status pesanan.');
            }

            if (!isValid) {
                e.preventDefault();
                alert('⚠️ Mohon perbaiki error berikut:\n\n• ' + errorMsg.join('\n• '));
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

    // ===== UX: Visual feedback saat status berubah =====
    if (statusSelect) {
        statusSelect.addEventListener('change', function () {
            this.style.borderColor = 'var(--gold)';
            setTimeout(() => {
                this.style.borderColor = '';
            }, 1000);
        });
    }

    // ===== UX: Auto-focus ke field pertama jika kosong =====
    if (userSelect && !userSelect.value) {
        userSelect.focus();
    }

    console.log('✅ Edit Pesanan form loaded with validations');
});