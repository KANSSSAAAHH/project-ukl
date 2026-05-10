<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pembayaran – PawonLokal</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{--crimson:#8B1A1A;--crimson-soft:#B22222;--gold:#C9923A;--cream:#FDF6ED;--cream-dark:#F5E6CC;--brown:#3D1C00;--text-dark:#1E0A00;--text-mid:#5C3317;--text-light:#9E7650;--white:#FFFFFF;--shadow-warm:0 8px 40px rgba(139,26,26,0.15);--radius:16px;--transition:0.3s cubic-bezier(0.4,0,0.2,1);}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Plus Jakarta Sans',sans-serif;background:linear-gradient(135deg,#fdf8ee,#f9f0d8,#f9f3e2);color:var(--text-dark);min-height:100vh;}

nav{position:fixed;top:0;left:0;right:0;z-index:1000;padding:0 40px;height:72px;display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,0.97);backdrop-filter:blur(20px);border-bottom:1px solid rgba(139,26,26,0.15);}
.nav-logo{display:flex;align-items:center;gap:12px;text-decoration:none;}
.nav-logo img{height:44px;object-fit:contain;}
.nav-logo span{font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:800;color:var(--crimson);}
.nav-cta{background:var(--crimson);color:var(--white);padding:10px 22px;border-radius:50px;font-weight:600;border:none;cursor:pointer;font-family:inherit;}

.page{padding:100px 24px 60px;max-width:560px;margin:0 auto;}
.card{background:var(--white);border-radius:var(--radius);padding:28px;box-shadow:var(--shadow-warm);margin-bottom:20px;}
.card-title{font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:800;color:var(--text-dark);margin-bottom:4px;}
.card-sub{color:var(--text-light);font-size:0.85rem;margin-bottom:20px;}

.info-box{background:var(--cream-dark);border-radius:10px;padding:14px;margin-bottom:20px;}
.info-row{display:flex;justify-content:space-between;font-size:0.87rem;padding:5px 0;}
.info-label{color:var(--text-light);}
.info-value{font-weight:600;color:var(--text-dark);}
.info-total{font-family:'Playfair Display',serif;font-size:1.05rem;font-weight:800;color:var(--crimson);}

/* PANDUAN */
.panduan-box{border-radius:12px;padding:20px;margin-bottom:0;text-align:center;}
.panduan-box.gopay{background:linear-gradient(135deg,#e8f5e9,#f1f8e9);border:1px solid #a5d6a7;}
.panduan-box.dana{background:linear-gradient(135deg,#e3f2fd,#e8f5ff);border:1px solid #90caf9;}
.panduan-box.ovo{background:linear-gradient(135deg,#f3e5f5,#fce4ec);border:1px solid #ce93d8;}
.panduan-title{font-weight:700;font-size:0.92rem;margin-bottom:14px;color:var(--text-dark);}

/* QR */
.qr-wrap{background:#fff;border-radius:16px;padding:16px;display:inline-block;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:14px;}
.qr-img{width:180px;height:180px;object-fit:contain;display:block;}

.nomor-bayar{font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:800;color:var(--crimson);letter-spacing:0.05em;margin:8px 0;}
.panduan-note{font-size:0.79rem;color:var(--text-light);line-height:1.7;}
.copy-btn{display:inline-flex;align-items:center;gap:6px;background:var(--crimson);color:var(--white);border:none;padding:8px 18px;border-radius:50px;font-family:inherit;font-size:0.82rem;font-weight:600;cursor:pointer;margin-top:10px;transition:opacity var(--transition);}
.copy-btn:hover{opacity:0.85;}

/* UPLOAD */
.upload-area{border:2px dashed rgba(201,146,58,0.4);border-radius:12px;padding:28px;text-align:center;cursor:pointer;transition:border var(--transition),background var(--transition);margin-bottom:16px;position:relative;}
.upload-area:hover{border-color:var(--crimson);background:rgba(139,26,26,0.03);}
.upload-area i{font-size:2rem;color:var(--gold);margin-bottom:10px;display:block;}
.upload-area p{color:var(--text-mid);font-size:0.87rem;}
.upload-area input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
#preview{width:100%;border-radius:10px;object-fit:contain;max-height:260px;display:none;margin-bottom:16px;border:1px solid rgba(201,146,58,0.2);}
.btn-upload{width:100%;display:flex;align-items:center;justify-content:center;gap:9px;background:linear-gradient(135deg,var(--crimson),var(--crimson-soft));color:var(--white);padding:15px;border-radius:50px;font-family:inherit;font-size:0.95rem;font-weight:600;border:none;cursor:pointer;box-shadow:0 6px 24px rgba(139,26,26,0.3);transition:transform var(--transition);}
.btn-upload:hover{transform:translateY(-2px);}

/* SUDAH UPLOAD */
.sudah-upload{text-align:center;padding:8px 0;}
.bukti-preview{width:100%;max-height:280px;object-fit:contain;border-radius:12px;border:1px solid rgba(201,146,58,0.2);margin-bottom:16px;}
.status-badge{display:inline-flex;align-items:center;gap:8px;background:#dcfce7;color:#15803d;padding:10px 20px;border-radius:50px;font-weight:600;font-size:0.88rem;margin-bottom:16px;}
.btn-home{display:flex;align-items:center;justify-content:center;gap:8px;background:linear-gradient(135deg,var(--crimson),var(--crimson-soft));color:var(--white);padding:14px;border-radius:50px;font-family:inherit;font-size:0.92rem;font-weight:600;text-decoration:none;box-shadow:0 6px 24px rgba(139,26,26,0.3);transition:transform var(--transition);}
.btn-home:hover{transform:translateY(-2px);}

.alert{padding:12px 18px;border-radius:10px;font-size:0.88rem;font-weight:600;margin-bottom:20px;display:flex;align-items:center;gap:8px;}
.alert-success{background:#dcfce7;color:#15803d;border:1px solid #bbf7d0;}

@media(max-width:480px){
    nav{padding:0 16px;}
    .page{padding:88px 16px 48px;}
    .card{padding:20px;}
    .qr-img{width:160px;height:160px;}
}
</style>
</head>
<body>
<nav>
    <a href="{{ url('/user/home') }}" class="nav-logo">
        <img src="{{ asset('images/Logo.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul style="display:flex;align-items:center;gap:8px;list-style:none;">
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="nav-cta">Logout</button>
            </form>
        </li>
    </ul>
</nav>

<div class="page">
    @if(session('success'))
    <div class="alert alert-success">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    {{-- INFO PESANAN --}}
    <div class="card">
        <div class="card-title">Selesaikan Pembayaran</div>
        <div class="card-sub">Pesanan #{{ $pesanan->id_pesanan }}</div>

        <div class="info-box">
            <div class="info-row">
                <span class="info-label">Metode</span>
                <span class="info-value">{{ $pembayaran->metode }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status</span>
                <span class="info-value">{{ ucfirst($pembayaran->status) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Total Tagihan</span>
                <span class="info-value info-total">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- PANDUAN SESUAI METODE --}}
        @if($pembayaran->metode === 'GoPay')
        <div class="panduan-box gopay">
            <div class="panduan-title"><i class="fa-solid fa-qrcode"></i> Scan QR Code GoPay</div>
            <div class="qr-wrap">
                <img src="{{ asset('images/gopay.png') }}" alt="QR GoPay" class="qr-img">
            </div>
            <p class="panduan-note">
                Buka <strong>GoPay / Gojek</strong> → Bayar → Scan QR di atas<br>
                Nominal: <strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong>
            </p>
        </div>

        @elseif($pembayaran->metode === 'Dana')
        <div class="panduan-box dana">
            <div class="panduan-title"><i class="fa-solid fa-mobile-screen"></i> Transfer via Dana</div>
            <div class="nomor-bayar">+62 852-3241-1498</div>
            <button class="copy-btn" onclick="copyNomor('+628523241498')">
                <i class="fa-solid fa-copy"></i> Salin Nomor
            </button>
            <p class="panduan-note" style="margin-top:12px;">
                Buka <strong>Dana</strong> → Kirim → masukkan nomor di atas<br>
                Nominal: <strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong><br>
                Atas nama: <strong>OCA</strong>
            </p>
        </div>

        @elseif($pembayaran->metode === 'OVO')
        <div class="panduan-box ovo">
            <div class="panduan-title"><i class="fa-solid fa-mobile-screen"></i> Transfer via OVO</div>
            <div class="nomor-bayar">+62 852-3241-1498</div>
            <button class="copy-btn" onclick="copyNomor('+628523241498')">
                <i class="fa-solid fa-copy"></i> Salin Nomor
            </button>
            <p class="panduan-note" style="margin-top:12px;">
                Buka <strong>OVO</strong> → Transfer → masukkan nomor di atas<br>
                Nominal: <strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong><br>
                Atas nama: <strong>OCA</strong>
            </p>
        </div>
        @endif
    </div>

    {{-- UPLOAD BUKTI --}}
    <div class="card">
        @if($pembayaran->bukti_bayar)
            {{-- SUDAH UPLOAD — jangan tampilkan form lagi --}}
            <div class="card-title" style="font-size:1.1rem;">Bukti Pembayaran</div>
            <div class="card-sub">Bukti kamu sudah diterima, menunggu konfirmasi admin</div>
            <div class="sudah-upload">
                <img src="{{ asset('storage/' . $pembayaran->bukti_bayar) }}"
                     alt="Bukti Bayar" class="bukti-preview">
                <div class="status-badge">
                    <i class="fa-solid fa-circle-check"></i> Bukti sudah diupload
                </div>
                <a href="{{ url('/user/home') }}" class="btn-home">
                    <i class="fa-solid fa-house"></i> Kembali ke Beranda
                </a>
            </div>
        @else
            {{-- BELUM UPLOAD --}}
            <div class="card-title" style="font-size:1.1rem;">Upload Bukti Pembayaran</div>
            <div class="card-sub">Screenshot bukti transfer/pembayaran kamu</div>
            <form action="{{ route('pembayaran.upload', $pesanan->id_pesanan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <img id="preview" src="" alt="Preview">
                <div class="upload-area">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p><strong>Klik untuk upload</strong> atau drag & drop</p>
                    <p style="font-size:0.78rem;color:var(--text-light);margin-top:4px;">JPG, PNG maks 2MB</p>
                    <input type="file" name="bukti_bayar" id="fileInput" accept="image/*" required>
                </div>
                <button type="submit" class="btn-upload">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Bukti Pembayaran
                </button>
            </form>
        @endif
    </div>
</div>

<script>
const fileInput = document.getElementById('fileInput');
if (fileInput) {
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
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
</script>
</body>
</html>