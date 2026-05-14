document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.querySelector('input[name="bukti_bayar"]');
    const previewImg = document.getElementById('previewImg');
    const form = document.querySelector('form');

    // ===== IMAGE PREVIEW FUNCTION =====
    function previewFoto(input) {
        if (!input.files || !input.files[0]) return;
        
        const file = input.files[0];
        
        // Validasi: hanya terima gambar
        if (!file.type.startsWith('image/')) {
            alert('Harap pilih file gambar (JPG, PNG, GIF, WebP).');
            input.value = '';
            if (previewImg) previewImg.style.display = 'none';
            return;
        }
        
        // Validasi: maksimal 5MB
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file maksimal 5MB.');
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
            const statusSelect = document.querySelector('select[name="status"]');
            const metodeSelect = document.querySelector('select[name="metode"]');
            
            // Validasi: Jika status "lunas", bukti bayar sebaiknya diisi
            if (statusSelect?.value === 'lunas' && !fileInput?.value) {
                if (!confirm('Status "Lunas" dipilih tetapi belum ada bukti bayar. Lanjutkan?')) {
                    e.preventDefault();
                    fileInput?.focus();
                    return false;
                }
            }
            
            // Validasi: Metode COD tidak memerlukan bukti bayar
            if (metodeSelect?.value === 'COD' && fileInput?.value) {
                if (!confirm('Metode COD biasanya tidak memerlukan bukti bayar. Lanjutkan?')) {
                    e.preventDefault();
                    return false;
                }
            }
        });
    }

    // ===== UX: Auto-focus ke field pertama =====
    const firstSelect = document.querySelector('select[name="id_pesanan"]');
    if (firstSelect && !firstSelect.value) {
        firstSelect.focus();
    }

    console.log('✅ Create Pembayaran form loaded');
});