document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.querySelector('input[name="bukti_bayar"]');
    const previewImg = document.getElementById('previewImg');
    const currentImg = document.querySelector('.foto-current');
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

    // ===== FORM VALIDATION & SMART WARNINGS =====
    if (form) {
        form.addEventListener('submit', function (e) {
            const statusSelect = document.querySelector('select[name="status"]');
            const metodeSelect = document.querySelector('select[name="metode"]');
            const hasNewFile = fileInput?.files?.length > 0;
            const hasCurrentFile = currentImg?.style.display !== 'none';
            
            // Validasi 1: Status "lunas" tapi tidak ada bukti (lama maupun baru)
            if (statusSelect?.value === 'lunas' && !hasNewFile && !hasCurrentFile) {
                if (!confirm('Status "Lunas" dipilih tetapi tidak ada bukti bayar. Lanjutkan?')) {
                    e.preventDefault();
                    fileInput?.focus();
                    return false;
                }
            }
            
            // Validasi 2: Metode COD biasanya tidak butuh bukti
            if (metodeSelect?.value === 'COD' && hasNewFile) {
                if (!confirm('Metode COD biasanya tidak memerlukan bukti bayar. Lanjutkan?')) {
                    e.preventDefault();
                    return false;
                }
            }
            
            // Validasi 3: Ganti metode ke COD tapi ada bukti lama
            if (metodeSelect?.value === 'COD' && hasCurrentFile && !hasNewFile) {
                if (!confirm('Metode diubah ke COD. Bukti bayar lama akan diabaikan. Lanjutkan?')) {
                    e.preventDefault();
                    return false;
                }
            }
        });
    }

    // ===== UX: Tambahkan tooltip pada gambar saat ini =====
    if (currentImg) {
        currentImg.title = 'Klik untuk memperbesar';
        currentImg.style.cursor = 'pointer';
        currentImg.addEventListener('click', function () {
            // Optional: buka modal/lightbox jika ingin fitur zoom
            const newWindow = window.open(this.src, '_blank');
            if (newWindow) newWindow.focus();
        });
    }

    // ===== UX: Auto-focus ke field pertama jika belum terisi =====
    const firstSelect = document.querySelector('select[name="id_pesanan"]');
    if (firstSelect && !firstSelect.value) {
        firstSelect.focus();
    }

    console.log('✅ Edit Pembayaran form loaded');
});