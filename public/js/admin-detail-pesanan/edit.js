// Hitung subtotal otomatis: harga × jumlah
const jumlahInput   = document.getElementById('jumlah');
const hargaInput    = document.getElementById('harga');
const subtotalInput = document.getElementById('subtotal');

function hitungSubtotal() {
    const harga  = parseInt(hargaInput.value) || 0;
    const jumlah = parseInt(jumlahInput.value) || 0;
    subtotalInput.value = harga * jumlah;
}

// Event listener untuk input jumlah dan harga
jumlahInput.addEventListener('input', hitungSubtotal);
hargaInput.addEventListener('input', hitungSubtotal);

// Hitung ulang saat halaman pertama kali load (untuk memastikan subtotal sesuai)
document.addEventListener('DOMContentLoaded', hitungSubtotal);