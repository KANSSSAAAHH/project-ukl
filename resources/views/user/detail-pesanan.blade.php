<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan – PawonLokal</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/user/detail-pesanan.css') }}">
</head>
<body>

<nav>
    <a href="{{ url('/user/home') }}" class="nav-logo">
        <img src="{{ asset('images/LogoPL3.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ route('pesanan.riwayat') }}">Pesanan Saya</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="nav-cta">Logout</button>
            </form>
        </li>
    </ul>
</nav>

<div class="page">

    <a href="{{ route('pesanan.riwayat') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Riwayat Pesanan
    </a>

    <h1 class="page-title">Detail Pesanan</h1>
    <p class="page-sub">{{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->translatedFormat('d F Y') }}</p>

    {{-- STATUS TRACKER --}}
    <div class="card">
        <div class="card-title"><i class="fa-solid fa-route"></i> Status Pesanan</div>
        <div class="tracker">
            <div class="tracker-step">
                <div class="tracker-icon done">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="tracker-label">Pesanan<br>Dibuat</div>
            </div>

            <div class="tracker-line {{ in_array($pesanan->status_pesanan, ['diproses', 'selesai']) ? 'done' : '' }}"></div>

            <div class="tracker-step">
                <div class="tracker-icon {{ in_array($pesanan->status_pesanan, ['diproses', 'selesai']) ? 'done' : 'pending' }}">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="tracker-label">Sedang<br>Diproses</div>
            </div>

            <div class="tracker-line {{ $pesanan->status_pesanan === 'selesai' ? 'done' : '' }}"></div>

            <div class="tracker-step">
                <div class="tracker-icon {{ $pesanan->status_pesanan === 'selesai' ? 'done' : 'pending' }}">
                    <i class="fa-solid fa-house"></i>
                </div>
                <div class="tracker-label">Pesanan<br>Selesai</div>
            </div>
        </div>
    </div>

    {{-- PRODUK DIPESAN --}}
    <div class="card">
        <div class="card-title"><i class="fa-solid fa-cookie"></i> Produk Dipesan</div>

        @foreach($pesanan->detailPesanan as $item)
        <div class="produk-item">
            @if($item->produk->foto)
                <img class="produk-img"
                     src="{{ asset('storage/' . $item->produk->foto) }}"
                     alt="{{ $item->produk->nama_produk }}"
                     onerror="this.outerHTML='<div class=produk-img-placeholder><i class=fa-solid fa-cookie></i></div>'">
            @else
                <div class="produk-img-placeholder">
                    <i class="fa-solid fa-cookie"></i>
                </div>
            @endif
            <div class="produk-info">
                <div class="produk-nama">{{ $item->produk->nama_produk }}</div>
                <div class="produk-qty">
                    {{ $item->jumlah_produk }} pcs × Rp {{ number_format($item->harga, 0, ',', '.') }}
                </div>
            </div>
            <div class="produk-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
        </div>
        @endforeach

        <div class="total-row">
            <span class="total-label">Total Pembayaran</span>
            <span class="total-value">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- PENGIRIMAN --}}
    @if($pesanan->pengiriman)
    <div class="card">
        <div class="card-title"><i class="fa-solid fa-location-dot"></i> Alamat Pengiriman</div>
        <div class="info-row">
            <span class="info-label">Nama Penerima</span>
            <span class="info-value">{{ $pesanan->pengiriman->nama_penerima }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">No. HP</span>
            <span class="info-value">{{ $pesanan->pengiriman->no_hp }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Alamat</span>
            <span class="info-value">{{ $pesanan->pengiriman->alamat_lengkap }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Kota</span>
            <span class="info-value">{{ $pesanan->pengiriman->kota }}, {{ $pesanan->pengiriman->kecamatan }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Kode Pos</span>
            <span class="info-value">{{ $pesanan->pengiriman->kode_pos }}</span>
        </div>
    </div>
    @endif

    {{-- PEMBAYARAN --}}
    @if($pesanan->pembayaran)
    <div class="card">
        <div class="card-title"><i class="fa-solid fa-wallet"></i> Pembayaran</div>
        <div class="info-row">
            <span class="info-label">Metode</span>
            <span class="info-value">{{ $pesanan->pembayaran->metode }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Status</span>
            <span class="info-value">
                <span class="badge badge-{{ $pesanan->pembayaran->status }}">
                    {{ ucfirst($pesanan->pembayaran->status) }}
                </span>
            </span>
        </div>

        @if($pesanan->pembayaran->bukti_bayar)
        <div class="info-row info-row-col">
            <span class="info-label">Bukti Pembayaran</span>
            <img src="{{ asset('storage/' . $pesanan->pembayaran->bukti_bayar) }}"
                 alt="Bukti Bayar" class="bukti-img">
        </div>
        @else
        <div class="info-row">
            <span class="info-label">Bukti Bayar</span>
            <a href="{{ route('pembayaran.index', encrypt($pesanan->id_pesanan)) }}" class="btn-upload-lagi">
                <i class="fa-solid fa-cloud-arrow-up"></i> Upload Sekarang
            </a>
        </div>
        @endif
    </div>
    @endif

</div>

</body>
</html>