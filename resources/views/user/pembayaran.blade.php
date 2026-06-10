<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran – PawonLokal</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/user/pembayaran.css') }}">
</head>
<body>

<nav>
    <a href="{{ url('/user/home') }}" class="nav-logo">
        <img src="{{ asset('images/LogoPL3.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
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
                <span class="info-value info-total">
                    Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- PANDUAN SESUAI METODE --}}
        @if($pembayaran->metode === 'Dana')
        <div class="panduan-box dana">
            <div class="panduan-title"><i class="fa-solid fa-mobile-screen"></i> Transfer via Dana</div>
            <div class="qr-wrap">
                <img src="{{ asset('images/Dana.jpeg') }}" alt="Dana" class="qr-img">
            </div>
            <p class="panduan-note">
                Buka <strong>Dana</strong> → Kirim → scan atau masukkan nomor di atas<br>
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
            <p class="panduan-note">
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
            {{-- SUDAH UPLOAD --}}
            <div class="card-title">Bukti Pembayaran</div>
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
            <div class="card-title">Upload Bukti Pembayaran</div>
            <div class="card-sub">Screenshot bukti transfer/pembayaran kamu</div>
            <form action="{{ route('pembayaran.upload', $pesanan->id_pesanan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <img id="preview" src="" alt="Preview">
                <div class="upload-area">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p><strong>Klik untuk upload</strong> atau drag & drop</p>
                    <p class="upload-hint">JPG, PNG maks 2MB</p>
                    <input type="file" name="bukti_bayar" id="fileInput" accept="image/*" required>
                </div>
                <button type="submit" class="btn-upload">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Bukti Pembayaran
                </button>
            </form>
        @endif
    </div>

</div>

<script src="{{ asset('js/user/pembayaran.js') }}"></script>
</body>
</html>