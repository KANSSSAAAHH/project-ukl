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
    <nav class="navbar">
        <a href="{{ url('/user/home') }}" class="nav-logo"><img src="{{ asset('images/Logo.PNG') }}" alt="PawonLokal"><span>PawonLokal</span></a>
        <ul style="display:flex;align-items:center;gap:8px;list-style:none;"><li><form action="{{ route('logout') }}" method="POST" style="display:inline">@csrf<button type="submit" class="nav-cta">Logout</button></form></li></ul>
    </nav>

    <main class="page">
        @if(session('success'))<div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>@endif

        <section class="card">
            <h1 class="card-title">Selesaikan Pembayaran</h1>
            <p class="card-subtitle">Pesanan #{{ $pesanan->id_pesanan }}</p>
            <div class="info-box">
                <div class="info-row"><span class="info-label">Metode</span><span class="info-value">{{ $pembayaran->metode }}</span></div>
                <div class="info-row"><span class="info-label">Status</span><span class="info-value">{{ ucfirst($pembayaran->status) }}</span></div>
                <div class="info-row"><span class="info-label">Total Tagihan</span><span class="info-value info-total">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span></div>
            </div>

            @if($pembayaran->metode === 'GoPay')
            <div class="payment-guide gopay">
                <div class="guide-title"><i class="fa-solid fa-qrcode"></i> Scan QR Code GoPay</div>
                <div class="qr-wrapper"><img src="{{ asset('images/gopay.png') }}" alt="QR Code GoPay" class="qr-image"></div>
                <p class="guide-note">Buka <strong>GoPay / Gojek</strong> → Bayar → Scan QR di atas<br>Nominal: <strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong></p>
            </div>
            @elseif($pembayaran->metode === 'Dana')
            <div class="payment-guide dana">
                <div class="guide-title"><i class="fa-solid fa-mobile-screen"></i> Transfer via Dana</div>
                <div class="payment-number">+62 852-3241-1498</div>
                <button class="copy-btn" data-nomor="+628523241498"><i class="fa-solid fa-copy"></i> Salin Nomor</button>
                <p class="guide-note" style="margin-top:12px;">Buka <strong>Dana</strong> → Kirim → masukkan nomor di atas<br>Nominal: <strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong><br>Atas nama: <strong>OCA</strong></p>
            </div>
            @elseif($pembayaran->metode === 'OVO')
            <div class="payment-guide ovo">
                <div class="guide-title"><i class="fa-solid fa-mobile-screen"></i> Transfer via OVO</div>
                <div class="payment-number">+62 852-3241-1498</div>
                <button class="copy-btn" data-nomor="+628523241498"><i class="fa-solid fa-copy"></i> Salin Nomor</button>
                <p class="guide-note" style="margin-top:12px;">Buka <strong>OVO</strong> → Transfer → masukkan nomor di atas<br>Nominal: <strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong><br>Atas nama: <strong>OCA</strong></p>
            </div>
            @endif
        </section>

        <section class="card">
            @if($pembayaran->bukti_bayar)
                <h2 class="card-title" style="font-size:1.1rem;">Bukti Pembayaran</h2>
                <p class="card-subtitle">Bukti kamu sudah diterima, menunggu konfirmasi admin</p>
                <div class="uploaded-state">
                    <img src="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" alt="Bukti Pembayaran" class="proof-image">
                    <div class="status-badge"><i class="fa-solid fa-circle-check"></i> Bukti sudah diupload</div>
                    <a href="{{ url('/user/home') }}" class="btn-home"><i class="fa-solid fa-house"></i> Kembali ke Beranda</a>
                </div>
            @else
                <h2 class="card-title" style="font-size:1.1rem;">Upload Bukti Pembayaran</h2>
                <p class="card-subtitle">Screenshot bukti transfer/pembayaran kamu</p>
                <form action="{{ route('pembayaran.upload', $pesanan->id_pesanan) }}" method="POST" enctype="multipart/form-data" id="paymentForm">
                    @csrf
                    <img id="preview" class="image-preview" src="" alt="Preview Bukti">
                    <div class="upload-zone">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p><strong>Klik untuk upload</strong> atau drag & drop</p>
                        <p style="font-size:0.78rem;color:var(--text-light);margin-top:4px;">JPG, PNG maks 2MB</p>
                        <input type="file" name="bukti_bayar" id="fileInput" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn-submit"><span><i class="fa-solid fa-paper-plane"></i> Kirim Bukti Pembayaran</span></button>
                </form>
            @endif
        </section>
    </main>
    <script src="{{ asset('js/user/pembayaran.js') }}"></script>
</body>
</html>