<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan – PawonLokal</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user/riwayat.css') }}">
</head>
<body>

<nav>
    <a href="{{ url('/user/home') }}" class="nav-logo">
        <img src="{{ asset('images/LogoPL3.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ url('/user/home') }}">Home</a></li>
        <li><a href="{{ url('/produk') }}">Produk</a></li>
        <li><a href="{{ url('/keranjang') }}">Keranjang</a></li>
        <li><a href="{{ route('pesanan.riwayat') }}" class="active">Pesanan Saya</a></li>
    </ul>
    <form action="{{ route('logout') }}" method="POST" style="display:inline">
        @csrf
        <button type="submit" class="nav-cta">Logout</button>
    </form>
</nav>

<div class="page">
    <h1 class="page-title">Pesanan Saya</h1>
    <p class="page-sub">Riwayat semua pesananmu di PawonLokal</p>

    @if($pesanan->isEmpty())
        <div class="empty-state">
            <h3>Belum ada pesanan</h3>
            <p>Mulai belanja kue tradisional favoritmu.</p>
            <a href="{{ url('/produk') }}" class="btn-belanja">Mulai Belanja</a>
        </div>
    @else
        <div class="pesanan-list">
            @foreach($pesanan as $p)
            <div class="pesanan-card">

                <div class="pesanan-header">
                    <div>
                        <div class="pesanan-id">Pesanan</div>
                        <div class="pesanan-tgl">
                            {{ \Carbon\Carbon::parse($p->tanggal_pesanan)->translatedFormat('d F Y') }}
                        </div>
                    </div>
                    <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                        <span class="badge badge-{{ $p->status_pesanan }}">
                            {{ ucfirst($p->status_pesanan) }}
                        </span>
                        @if($p->pembayaran)
                            <span class="badge badge-{{ $p->pembayaran->status }}">
                                {{ ucfirst($p->pembayaran->status) }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="pesanan-body">
                    @foreach($p->detailPesanan as $item)
                    <div class="produk-item">
                        <div class="produk-detail-wrapper">
                            @if($item->produk->foto)
                                <img class="produk-img"
                                     src="{{ asset('storage/' . $item->produk->foto) }}"
                                     alt="{{ $item->produk->nama_produk }}"
                                     onerror="this.style.display='none'">
                            @else
                                <div class="produk-img-placeholder"></div>
                            @endif

                            <div class="produk-info">
                                <div class="produk-nama">{{ $item->produk->nama_produk }}</div>
                                <div class="produk-qty">
                                    {{ $item->jumlah_produk }} pcs × Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </div>
                                @if($p->status_pesanan === 'selesai')
                                    @if(isset($sudahDirating) && in_array($item->id_produk, $sudahDirating))
                                        <span class="btn-rating-success">Sudah Memberikan Rating</span>
                                    @else
                                        <a href="{{ url('/rating?id_produk=' . $item->id_produk) }}" class="btn-rating">
                                            Beri Rating
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="produk-subtotal">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="pesanan-footer">
                    <div>
                        <div class="pesanan-total-label">Total Pembayaran</div>
                        <div class="pesanan-total">
                            Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="footer-actions">
                        <a href="{{ route('pesanan.detail', $p->id_pesanan) }}" class="btn-detail">
                            Lihat Detail
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>