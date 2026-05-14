document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const noHpInput = document.querySelector('input[name="no_hp"]');
    const kodePosInput = document.querySelector('input[name="kode_pos"]');
    const alamatInput = document.querySelector('textarea[name="alamat_lengkap"]');
    const penerimaInput = document.querySelector('input[name="nama_penerima"]');

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

    // ===== VALIDASI KODE POS =====
    if (kodePosInput) {
        // Hanya angka, maksimal 5 digit
        kodePosInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 5) {
                this.value = this.value.slice(0, 5);
            }
        });

        // Validasi saat blur: pastikan 5 digit
        kodePosInput.addEventListener('blur', function () {
            if (this.value && this.value.length !== 5) {
                alert('Kode pos harus 5 digit angka.');
                this.focus();
            }
        });
    }

    // ===== AUTO-RESIZE TEXTAREA =====
    if (alamatInput) {
        function autoResize() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        }
        alamatInput.addEventListener('input', autoResize);
        // Initial resize on load
        autoResize.call(alamatInput);
    }

    // ===== FORM SUBMISSION VALIDATION =====
    if (form) {
        form.addEventListener('submit', function (e) {
            let isValid = true;
            let errorMsg = [];

            // Validasi nama penerima (minimal 3 karakter)
            if (penerimaInput && penerimaInput.value.trim().length < 3) {
                isValid = false;
                errorMsg.push('Nama penerima minimal 3 karakter.');
            }

            // Validasi no HP
            if (noHpInput && (!noHpInput.value || noHpInput.value.length < 10)) {
                isValid = false;
                errorMsg.push('Nomor HP harus minimal 10 digit.');
            }

            // Validasi kode pos
            if (kodePosInput && kodePosInput.value.length !== 5) {
                isValid = false;
                errorMsg.push('Kode pos harus 5 digit angka.');
            }

            // Validasi alamat
            if (alamatInput && alamatInput.value.trim().length < 10) {
                isValid = false;
                errorMsg.push('Alamat terlalu pendek.');
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

    // ===== UX: Auto-focus ke field pertama jika kosong =====
    const firstSelect = document.querySelector('select[name="id_pesanan"]');
    if (firstSelect && !firstSelect.value) {
        firstSelect.focus();
    }

    console.log('✅ Edit Pengiriman form loaded with validations');
});