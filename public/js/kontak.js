document.getElementById('sendWhatsappBtn').addEventListener('click', function(){
    const name = document.getElementById('contactName').value.trim();
    const phone = document.getElementById('contactPhone').value.trim();
    const product = document.getElementById('contactProduct').value.trim();
    const message = document.getElementById('contactMessage').value.trim();

    if(!name || !phone || !product || !message){
        alert('Semua field wajib diisi.');
        return;
    }

    const owner = '6285232411498';
    const text = `Halo  Admin Pawon Lokal,\n\nNama: ${name}\nNo WhatsApp: ${phone}\nProduk: ${product}\n\nPesan:\n${message}`;
    window.open('https://wa.me/' + owner + '?text=' + encodeURIComponent(text), '_blank');
});