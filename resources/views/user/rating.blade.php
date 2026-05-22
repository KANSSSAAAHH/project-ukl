<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Beri Rating – PawonLokal</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
    --crimson: #8B1A1A;
    --crimson-soft: #B22222;
    --gold: #C9923A;
    --gold-light: #E8B86D;
    --cream: #FDF6ED;
    --cream-dark: #F5E6CC;
    --brown: #3D1C00;
    --text-dark: #1E0A00;
    --text-mid: #5C3317;
    --text-light: #9E7650;
    --white: #FFFFFF;
    --transition: 0.3s cubic-bezier(0.4,0,0.2,1);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: linear-gradient(135deg, #fdf8ee 0%, #f9f0d8 50%, #f9f3e2 100%);
    color: var(--text-dark);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

/* =====================
    CARD
===================== */
.card {
    background: var(--white);
    border-radius: 32px;
    padding: 56px 48px;
    max-width: 480px; /* Sedikit diperkecil agar lebih compact tanpa dropdown */
    width: 100%;
    box-shadow: 0 24px 64px rgba(139,26,26,0.12);
    animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
}
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* HEADER */
.card-header { text-align: center; margin-bottom: 40px; }
.card-icon {
    width: 76px; height: 76px;
    background: linear-gradient(135deg, #fff5e0, #fde8b0);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 22px;
    font-size: 2rem; color: var(--gold);
    box-shadow: 0 8px 20px rgba(201,146,58,0.15);
}
.card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.95rem; font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 10px;
}
.card-sub {
    font-size: 0.9rem;
    color: var(--text-light);
    line-height: 1.6;
}

/* FORM GROUP */
.form-group { margin-bottom: 28px; text-align: center; } /* Penyelarasan ketengah untuk rating bintang */
.form-group.left-align { text-align: left; } /* Penyelarasan kiri khusus teks komentar */

.form-label {
    display: block;
    font-size: 0.85rem; font-weight: 700;
    color: var(--text-dark);
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-bottom: 12px;
}

/* BINTANG INTERAKTIF BARU */
.star-container {
    display: inline-flex;
    justify-content: center;
    gap: 8px;
    margin-bottom: 10px;
}
.star-container input[type="radio"] { display: none; }
.star-container label {
    font-size: 2.6rem; /* Ukuran bintang diperbesar agar lebih ramah sentuhan */
    color: #e2d4c0;
    cursor: pointer;
    transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275), color 0.15s;
    line-height: 1;
}
.star-container label:hover { transform: scale(1.25); }
.star-container label.active { color: var(--gold); }

.star-hint {
    font-size: 0.85rem; 
    color: var(--text-light);
    font-weight: 600;
    min-height: 20px;
    transition: color 0.2s;
}

/* TEXTAREA */
.form-textarea {
    width: 100%;
    padding: 16px;
    border: 1.5px solid #e8d8c4;
    border-radius: 16px;
    font-size: 0.95rem;
    font-family: inherit;
    color: var(--text-dark);
    background: var(--cream);
    outline: none;
    resize: none;
    min-height: 120px;
    transition: border-color var(--transition), background var(--transition), box-shadow var(--transition);
}
.form-textarea:focus { 
    border-color: var(--crimson); 
    background-color: var(--white);
    box-shadow: 0 0 0 4px rgba(139,26,26,0.06);
}
.form-textarea::placeholder { color: #b0956e; opacity: 0.7; }

/* TOMBOL SUBMIT */
.btn-submit {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, var(--crimson), var(--crimson-soft));
    color: var(--white);
    border: none;
    border-radius: 50px;
    font-family: inherit;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 6px 24px rgba(139,26,26,0.3);
    transition: transform var(--transition), box-shadow var(--transition);
    display: flex; align-items: center; justify-content: center; gap: 10px;
    margin-top: 12px;
}
.btn-submit:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(139,26,26,0.45); }
.btn-submit:active { transform: translateY(-1px); }

/* ALERT */
.alert {
    padding: 14px 18px;
    border-radius: 14px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 24px;
    display: flex; align-items: center; gap: 10px;
}
.alert-success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
.alert-error   { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

/* TERIMAKASIH OVERLAY */
.thankyou-overlay {
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px 0;
}
.thankyou-overlay.show { display: flex; }
.thankyou-icon {
    width: 96px; height: 96px;
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 2.6rem; color: #15803d;
    margin: 0 auto 26px;
    box-shadow: 0 8px 24px rgba(21,128,61,0.15);
}
.thankyou-title {
    font-family: 'Playfair Display', serif;
    font-size: 2rem; font-weight: 800;
    color: var(--text-dark); margin-bottom: 12px;
}
.thankyou-sub {
    font-size: 0.95rem; color: var(--text-light);
    line-height: 1.7; margin-bottom: 36px;
}
.btn-beranda {
    display: inline-flex; align-items: center; gap: 10px;
    background: linear-gradient(135deg, var(--crimson), var(--crimson-soft));
    color: var(--white);
    padding: 14px 36px; border-radius: 50px;
    font-family: inherit; font-size: 1rem; font-weight: 700;
    text-decoration: none;
    box-shadow: 0 6px 24px rgba(139,26,26,0.3);
    transition: transform var(--transition), box-shadow var(--transition);
}
.btn-beranda:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(139,26,26,0.45); }

@media (max-width: 540px) {
    .card { padding: 40px 24px; }
    .card-title { font-size: 1.65rem; }
    .star-container label { font-size: 2.2rem; }
}
</style>
</head>
<body>

<div class="card">

    {{-- FORM RATING --}}
    <div id="formSection">
        <div class="card-header">
            <div class="card-icon">
                <i class="fa-solid fa-star"></i>
            </div>
            <h1 class="card-title">Beri Kami Rating</h1>
            <p class="card-sub">Pengalamanmu sangat berarti untuk kami.<br>Ceritakan pendapatmu tentang produk yang sudah kamu beli.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> Periksa kembali isian kamu!
            </div>
        @endif

        <form method="POST" action="{{ route('rating.store') }}" id="ratingForm">
            @csrf

            {{-- Input Hidden untuk ID Produk (Sistem menangkap otomatis dari Controller) --}}
            <input type="hidden" name="id_produk" value="{{ $id_produk ?? old('id_produk') }}">

            {{-- Komponen Bintang --}}
            <div class="form-group">
                <label class="form-label">Rating Kamu</label>
                <div class="star-container" id="starContainer">
                    <input type="radio" name="rating" id="s1" value="1" {{ old('rating') == 1 ? 'checked' : '' }}>
                    <label for="s1" data-value="1">★</label>
                    
                    <input type="radio" name="rating" id="s2" value="2" {{ old('rating') == 2 ? 'checked' : '' }}>
                    <label for="s2" data-value="2">★</label>
                    
                    <input type="radio" name="rating" id="s3" value="3" {{ old('rating') == 3 ? 'checked' : '' }}>
                    <label for="s3" data-value="3">★</label>
                    
                    <input type="radio" name="rating" id="s4" value="4" {{ old('rating') == 4 ? 'checked' : '' }}>
                    <label for="s4" data-value="4">★</label>
                    
                    <input type="radio" name="rating" id="s5" value="5" {{ old('rating') == 5 ? 'checked' : '' }}>
                    <label for="s5" data-value="5">★</label>
                </div>
                <div class="star-hint" id="starHint">Ketuk bintang untuk menilai</div>
                @error('rating')
                    <div style="font-size:0.75rem;color:var(--crimson);margin-top:6px;font-weight:600;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Komentar --}}
            <div class="form-group left-align">
                <label class="form-label">Komentar</label>
                <textarea name="komentar" class="form-textarea"
                    placeholder="Ceritakan pengalamanmu... apakah rasanya lezat? Apakah kamu menyukainya?"
                    required>{{ old('komentar') }}</textarea>
                @error('komentar')
                    <div style="font-size:0.75rem;color:var(--crimson);margin-top:6px;font-weight:600;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-paper-plane"></i> Kirim Rating
            </button>
        </form>
    </div>

    {{-- TERIMAKASIH OVERLAY --}}
    <div class="thankyou-overlay" id="thankyouSection">
        <div class="thankyou-icon">
            <i class="fa-solid fa-heart"></i>
        </div>
        <h2 class="thankyou-title">Terima Kasih! 🎉</h2>
        <p class="thankyou-sub">
            Rating kamu sudah kami terima dengan senang hati.<br>
            Masukan kamu membantu kami terus berkembang dan menghadirkan<br>
            kue tradisional terbaik untuk kamu!
        </p>
        <a href="{{ url('/') }}" class="btn-beranda">
            <i class="fa-solid fa-house"></i> Kembali ke Beranda
        </a>
    </div>

</div>

{{-- SCRIPT INTERAKSI BINTANG & OVERLAY SUKSES --}}
<script>
const hints = {
    1: 'Mengecewakan 😞',
    2: 'Kurang memuaskan 😕',
    3: 'Lumayan 😊',
    4: 'Bagus! 😄',
    5: 'Luar biasa! 🤩'
};

const labels = document.querySelectorAll('.star-container label');
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

    // Efek Hover Masuk
    label.addEventListener('mouseenter', () => {
        updateStars(val);
        hintText.textContent = hints[val];
    });

    // Efek Hover Keluar (Kembali ke nilai yang diklik terakhir)
    label.addEventListener('mouseleave', () => {
        updateStars(selectedValue);
        hintText.textContent = selectedValue ? hints[selectedValue] : 'Ketuk bintang untuk menilai';
    });

    // Aksi Klik Pilih Nilai
    label.addEventListener('click', () => {
        selectedValue = val;
        document.getElementById(`s${val}`).checked = true;
    });
});

function updateStars(rating) {
    labels.forEach(label => {
        const labelVal = parseInt(label.getAttribute('data-value'));
        if (labelVal <= rating) {
            label.classList.add('active');
        } else {
            label.classList.remove('active');
        }
    });
}

// Handler Tampilan Sukses Laravel Session
@if(session('success'))
    document.getElementById('formSection').style.display = 'none';
    document.getElementById('thankyouSection').classList.add('show');
@endif
</script>
</body>
</html>