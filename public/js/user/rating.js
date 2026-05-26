const hints = {
    1: 'Mengecewakan 😞',
    2: 'Kurang memuaskan 😕',
    3: 'Lumayan 😊',
    4: 'Bagus! 😄',
    5: 'Luar biasa! 🤩'
};

const labels   = document.querySelectorAll('.star-container label');
const hintText = document.getElementById('starHint');
let selectedValue = 0;

// Cek jika ada nilai 'old' dari Laravel setelah validasi gagal
const checkedInput = document.querySelector('.star-container input[type="radio"]:checked');
if (checkedInput) {
    selectedValue = parseInt(checkedInput.value);
    updateStars(selectedValue);
    hintText.textContent = hints[selectedValue];
}

labels.forEach(label => {
    const val = parseInt(label.getAttribute('data-value'));

    // Efek hover masuk
    label.addEventListener('mouseenter', () => {
        updateStars(val);
        hintText.textContent = hints[val];
    });

    // Efek hover keluar — kembali ke nilai yang dipilih
    label.addEventListener('mouseleave', () => {
        updateStars(selectedValue);
        hintText.textContent = selectedValue ? hints[selectedValue] : 'Ketuk bintang untuk menilai';
    });

    // Klik untuk memilih nilai
    label.addEventListener('click', () => {
        selectedValue = val;
        document.getElementById(`s${val}`).checked = true;
    });
});

function updateStars(rating) {
    labels.forEach(label => {
        const labelVal = parseInt(label.getAttribute('data-value'));
        label.classList.toggle('active', labelVal <= rating);
    });
}