document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const userSelect = document.querySelector('select[name="id_user"]');
    const produkSelect = document.querySelector('select[name="id_produk"]');
    const jumlahInput = document.querySelector('input[name="jumlah_produk"]');

    // Auto-focus ke field pertama saat halaman load
    if (userSelect && !userSelect.value) {
        userSelect.focus();
    }

    // Validasi: Pastikan jumlah tidak negatif
    if (jumlahInput) {
        jumlahInput.addEventListener('input', function () {
            if (this.value < 1) this.value = 1;
        });
    }

    // Konfirmasi sebelum submit (opsional, untuk prevent accidental submit)
    if (form) {
        form.addEventListener('submit', function (e) {
            const jumlah = parseInt(jumlahInput?.value) || 0;
            if (jumlah < 1) {
                e.preventDefault();
                alert('Jumlah produk minimal 1.');
                jumlahInput?.focus();
            }
        });
    }

    // Console log untuk debugging (akan dihapus di production)
    console.log('✅ Create Keranjang form loaded');
});