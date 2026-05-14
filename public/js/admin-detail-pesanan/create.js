// Auto isi harga dan subtotal
const produkSelect = document.getElementById('produkSelect');
const jumlahInput  = document.getElementById('jumlah');
const hargaInput   = document.getElementById('harga');
const subtotalInput= document.getElementById('subtotal');

function hitungSubtotal() {
    const harga   = parseInt(hargaInput.value) || 0;
    const jumlah  = parseInt(jumlahInput.value) || 0;
    subtotalInput.value = harga * jumlah;
}

produkSelect.addEventListener('change', function() {
    const opt = this.options[this.selectedIndex];
    hargaInput.value = opt.dataset.harga || 0;
    hitungSubtotal();
});

jumlahInput.addEventListener('input', hitungSubtotal);
hargaInput.addEventListener('input', hitungSubtotal);