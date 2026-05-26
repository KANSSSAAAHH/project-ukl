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

<div class="card">
    <div class="icon-wrap">
        <i class="fa-solid fa-circle-check"></i>
    </div>
    <h1 class="title">Pesanan Berhasil!</h1>
    <p class="sub">
        Terima kasih! Pesananmu sedang kami proses.<br>
        Admin akan mengkonfirmasi setelah pembayaran terverifikasi.
    </p>
    <div class="btn-group">
        <a href="{{ url('/') }}" class="btn-home">
            <i class="fa-solid fa-house"></i> Kembali ke Beranda
        </a>
    </div>
</div>

</body>
</html>