document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.querySelector('input[name="foto"]');
    const previewImg = document.getElementById('previewImg');
    const currentImg = document.querySelector('.foto-current');
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
        
        // Tampilkan preview gambar baru
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

    // ===== UX: Tambahkan tooltip pada gambar saat ini =====
    if (currentImg) {
        currentImg.title = 'Klik untuk memperbesar';
        currentImg.style.cursor = 'pointer';
        currentImg.addEventListener('click', function () {
            const newWindow = window.open(this.src, '_blank');
            if (newWindow) newWindow.focus();
        });
    }

    // ===== UX: Auto-focus ke field pertama jika kosong =====
    if (namaInput && !namaInput.value) {
        namaInput.focus();
    }

    console.log('✅ Edit Produk form loaded with validations');
});