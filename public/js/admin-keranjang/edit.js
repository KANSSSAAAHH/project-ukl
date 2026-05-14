document.addEventListener('DOMContentLoaded', function () {
    const jumlahInput = document.querySelector('input[name="jumlah_produk"]');
    const form = document.querySelector('form');

    // Validasi: Pastikan jumlah minimal 1
    if (jumlahInput) {
        // Saat input berubah
        jumlahInput.addEventListener('input', function () {
            if (this.value < 1) this.value = 1;
        });

        // Saat kehilangan fokus (blur)
        jumlahInput.addEventListener('blur', function () {
            if (!this.value || this.value < 1) {
                this.value = 1;
            }
        });
    }

    // Konfirmasi sebelum submit
    if (form) {
        form.addEventListener('submit', function (e) {
            const jumlah = parseInt(jumlahInput?.value) || 0;
            
            if (jumlah < 1) {
                e.preventDefault();
                alert('Jumlah produk minimal harus 1.');
                jumlahInput?.focus();
                return false;
            }

            // Optional: Konfirmasi update
            // if (!confirm('Apakah Anda yakin ingin mengupdate item keranjang ini?')) {
            //     e.preventDefault();
            //     return false;
            // }
        });
    }

    // Tambahkan visual cue pada readonly fields
    const readonlyInputs = document.querySelectorAll('input:disabled');
    readonlyInputs.forEach(input => {
        input.title = 'Field ini tidak dapat diubah';
    });

    console.log('✅ Edit Keranjang form loaded');
});