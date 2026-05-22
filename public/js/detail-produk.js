let jumlah = 1;

function tambah() { jumlah++; update(); }
function kurang() { if (jumlah > 1) { jumlah--; update(); } }
function update() {
    document.getElementById('jumlahVal').textContent = jumlah;
    document.getElementById('jumlahInput').value = jumlah;
}

window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 30);
});

const hamburger = document.getElementById('hamburgerBtn');
const mobileMenu = document.getElementById('mobileMenu');
hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    mobileMenu.classList.toggle('open');
});