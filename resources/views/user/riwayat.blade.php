<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan – PawonLokal</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/user/riwayat.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="{{ url('/user/home') }}" class="nav-logo"><img src="{{ asset('images/LogoPL2.PNG') }}" alt="PawonLokal"><span>PawonLokal</span></a>
        <ul class="nav-links">
            <li><a href="{{ url('/user/home') }}">Home</a></li>
            <li><a href="{{ url('/produk') }}">Produk</a></li>
            <li><a href="{{ url('/keranjang') }}">Keranjang</a></li>
            <li><a href="{{ route('pesanan.riwayat') }}" class="active">Pesanan Saya</a></li>
            <li><form action="{{ route('logout') }}" method="POST" style="display:inline">@csrf<button type="submit" class="nav-cta">Logout</button></form></li>
        </ul>
    </nav>

    <main class="page">
        <h1 class="page-title">Pesanan Saya</h1>
        <p class="page-subtitle">Riwayat semua pesananmu di PawonLokal</p>

        @if($pesanan->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-bag-shopping"></i>
                <h3>Belum ada pesanan</h3>
                <p>Yuk, mulai belanja kue tradisional favoritmu!</p>
                <a href="{{ url('/produk') }}" class="btn-shop"><i class="fa-solid fa-store"></i> Mulai Belanja</a>
            </div>
        @else
            <div class="order-list">
                @foreach($pesanan as $p)
                <article class="order-card">
                    <header class="order-header">
                        <div><div class="order-id">Pesanan <span>#{{ $p->id_pesanan }}</span></div><div class="order-date">{{ \Carbon\Carbon::parse($p->tanggal_pesanan)->translatedFormat('d F Y') }}</div></div>
                        <div class="order-status-group">
                            <span class="status-badge {{ $p->status_pesanan }}">
                                @if($p->status_pesanan === 'menunggu')<i class="fa-solid fa-clock"></i>@elseif($p->status_pesanan === 'diproses')<i class="fa-solid fa-box"></i>@else<i class="fa-solid fa-circle-check"></i>@endif {{ ucfirst($p->status_pesanan) }}
                            </span>
                            @if($p->pembayaran)<span class="status-badge payment-{{ $p->pembayaran->status }}"><i class="fa-solid fa-wallet"></i> {{ ucfirst($p->pembayaran->status) }}</span>@endif
                        </div>
                    </header>
                    <div class="order-body">
                        @foreach($p->detailPesanan as $item)
                        <div class="product-item">
                            <div class="product-detail-wrapper">
                                @if($item->produk->foto)<img class="product-image" src="{{ asset('storage/' . $item->produk->foto) }}" alt="{{ $item->produk->nama_produk }}">@else<div class="product-image-placeholder"><i class="fa-solid fa-cookie"></i></div>@endif
                                <div class="product-info">
                                    <div class="product-name text-truncate">{{ $item->produk->nama_produk }}</div>
                                    <div class="product-qty">{{ $item->jumlah_produk }} pcs × Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                                    @if($p->status_pesanan === 'selesai')
                                        @if(isset($sudahDirating) && in_array($item->id_produk, $sudahDirating))
                                            <span class="btn-rated"><i class="fa-solid fa-circle-check"></i> Sudah Memberikan Rating</span>
                                        @else
                                            <a href="{{ url('/rating?id_produk=' . $item->id_produk) }}" class="btn-rating"><i class="fa-solid fa-star"></i> Beri Rating</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="product-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                        </div>
                        @endforeach
                    </div>
                    <footer class="order-footer">
                        <div><div class="order-total-label">Total Pembayaran</div><div class="order-total">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</div></div>
                        <div class="footer-actions"><a href="{{ route('pesanan.detail', $p->id_pesanan) }}" class="btn-view"><i class="fa-solid fa-eye"></i> Lihat Detail</a></div>
                    </footer>
                </article>
                @endforeach
            </div>
        @endif
    </main>
    <script src="{{ asset('js/user/riwayat.js') }}"></script>
</body>
</html>