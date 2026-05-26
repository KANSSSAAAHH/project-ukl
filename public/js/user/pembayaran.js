const fileInput = document.getElementById('fileInput');

if (fileInput) {
    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (ev) {
                const preview = document.getElementById('preview');
                preview.src = ev.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
}

function copyNomor(nomor) {
    navigator.clipboard.writeText(nomor).then(() => {
        alert('Nomor berhasil disalin!');
    });
}