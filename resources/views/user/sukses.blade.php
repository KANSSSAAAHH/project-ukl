<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil – PawonLokal</title>
    
    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    {{-- Styles --}}
    @vite('resources/css/user/sukses.css')
</head>
<body>
    <main class="success-card">
        {{-- Success Icon --}}
        <div class="success-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        
        {{-- Title --}}
        <h1 class="success-title">Pesanan Berhasil!</h1>
        
        {{-- Subtitle --}}
        <p class="success-subtitle">
            Terima kasih! Pesananmu sedang kami proses.<br>
            Admin akan mengkonfirmasi setelah pembayaran terverifikasi.
        </p>

        {{-- Action Buttons --}}
        <div class="button-group">
            <a href="{{ url('/') }}" class="btn-home">
                <i class="fa-solid fa-house"></i> Kembali ke Beranda
            </a>
            
            {{-- Optional: Tambahkan tombol lihat detail pesanan jika perlu --}}
            {{-- 
            <a href="{{ route('pesanan.detail', $pesanan->id_pesanan ?? '') }}" class="btn-outline">
                <i class="fa-solid fa-receipt"></i> Lihat Detail Pesanan
            </a> 
            --}}
        </div>
    </main>

    {{-- Scripts --}}
    @vite('resources/js/user/sukses.js')
</body>
</html>