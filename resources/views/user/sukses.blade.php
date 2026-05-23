<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil – PawonLokal</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/user/sukses.css') }}">
</head>
<body>
    <main class="success-card">
        <div class="success-icon"><i class="fa-solid fa-circle-check"></i></div>
        <h1 class="success-title">Pesanan Berhasil!</h1>
        <p class="success-subtitle">Terima kasih! Pesananmu sedang kami proses.<br>Admin akan mengkonfirmasi setelah pembayaran terverifikasi.</p>
        <div class="button-group">
            <a href="{{ url('/') }}" class="btn-home"><i class="fa-solid fa-house"></i> Kembali ke Beranda</a>
        </div>
    </main>
    <script src="{{ asset('js/user/sukses.js') }}"></script>
</body>
</html>