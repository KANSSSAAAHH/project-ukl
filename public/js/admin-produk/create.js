/**
 * Create Produk - File Upload Preview & Form Enhancements
 * Fitur: Preview gambar produk, validasi file, UX improvement
 */

document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.querySelector('input[name="foto"]');
    const previewImg = document.getElementById('previewImg');
    const form = document.querySelector('form');
    const namaInput = document.querySelector('input[name="nama_produk"]');
    const hargaInput = document.querySelector('input[name="harga"]');

    // ===== IMAGE PREVIEW FUNCTION =====
    function previewFoto(input) {
        if (!input.files || !input.files[0]) return;
        
        const file = input.files[0];
        
        // Validasi: hanya terima gambar
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            alert('Harap pilih file gambar (JPG, PNG, GIF).');
            input.value = '';
            if (previewImg) previewImg.style.display = 'none';
            return;
        }
        
        // Validasi: maksimal 2MB untuk foto produk
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB.');
            input.value = '';
            if (previewImg) previewImg.style.display = 'none';
            return;
        }
        
        // Tampilkan preview
        const reader = new FileReader();
        reader.onload = function (e) {
            if (previewImg) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                // Scroll ke preview agar user melihat perubahan
                previewImg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        };
        reader.readAsDataURL(file);
    }

    // Attach event listener ke file input
    if (fileInput) {
        fileInput.addEventListener('change', function () {
            previewFoto(this);
        });
    }

    // ===== FORM VALIDATION =====
    if (form) {
        form.addEventListener('submit', function (e) {
            let isValid = true;
            let errorMsg = [];

            // Validasi nama produk (minimal 3 karakter)
            if (namaInput && namaInput.value.trim().length < 3) {
                isValid = false;
                errorMsg.push('Nama produk minimal 3 karakter.');
            }

            // Validasi harga
            if (hargaInput) {
                const harga = parseInt(hargaInput.value) || 0;
                if (harga <= 0) {
                    isValid = false;
                    errorMsg.push('Harga harus lebih dari 0.');
                }
            }

            // Validasi file foto
            if (fileInput && !fileInput.value) {
                isValid = false;
                errorMsg.push('Foto produk wajib diupload.');
            }

            if (!isValid) {
                e.preventDefault();
                alert('⚠️ Mohon perbaiki error berikut:\n\n• ' + errorMsg.join('\n• '));
                return false;
            }
        });
    }

    // ===== UX: Auto-focus ke field pertama =====
    if (namaInput && !namaInput.value) {
        namaInput.focus();
    }

    // ===== UX: Format harga dengan titik (visual only) =====
    if (hargaInput) {
        hargaInput.addEventListener('input', function () {
            // Hanya angka, auto-format visual dengan titik
            let value = this.value.replace(/[^0-9]/g, '');
            if (value) {
                // Optional: tampilkan format rupiah di placeholder
                this.placeholder = 'Rp ' + parseInt(value).toLocaleString('id-ID');
            }
        });
    }

    console.log('✅ Create Produk form loaded with validations');
});