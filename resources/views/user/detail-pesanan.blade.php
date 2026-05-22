<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Pesanan – PawonLokal</title>
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

.page{padding:100px 40px 60px;max-width:760px;margin:0 auto;}
.back-link{display:inline-flex;align-items:center;gap:8px;color:var(--crimson);font-weight:600;font-size:0.88rem;text-decoration:none;margin-bottom:20px;}
.back-link:hover{opacity:0.75;}
.page-title{font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:800;color:var(--text-dark);margin-bottom:4px;}
.page-sub{color:var(--text-light);font-size:0.88rem;margin-bottom:28px;}

.card{background:var(--white);border-radius:var(--radius);padding:24px;box-shadow:0 4px 20px rgba(139,26,26,0.08);margin-bottom:20px;}
.card-title{font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-light);margin-bottom:16px;display:flex;align-items:center;gap:8px;}
.card-title i{color:var(--crimson);}

.badge{display:inline-flex;align-items:center;gap:5px;padding:5px 14px;border-radius:50px;font-size:0.78rem;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;}
.badge-menunggu{background:#fef9c3;color:#854d0e;}
.badge-diproses{background:#dbeafe;color:#1d4ed8;}
.badge-selesai{background:#dcfce7;color:#15803d;}
.badge-pending{background:#fef3c7;color:#92400e;}
.badge-lunas{background:#dcfce7;color:#15803d;}

.tracker{display:flex;align-items:center;justify-content:center;}
.tracker-step{display:flex;flex-direction:column;align-items:center;flex:1;}
.tracker-icon{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1rem;margin-bottom:6px;}
.tracker-icon.done{background:var(--crimson);color:var(--white);}
.tracker-icon.pending{background:var(--cream-dark);color:var(--text-light);}
.tracker-label{font-size:0.72rem;font-weight:600;color:var(--text-mid);text-align:center;}
.tracker-line{flex:1;height:2px;background:var(--cream-dark);margin-bottom:22px;}
.tracker-line.done{background:var(--crimson);}

.info-row{display:flex;justify-content:space-between;align-items:flex-start;padding:9px 0;border-bottom:1px solid rgba(201,146,58,0.1);font-size:0.88rem;}
.info-row:last-child{border-bottom:none;}
.info-label{color:var(--text-light);min-width:130px;}
.info-value{font-weight:600;color:var(--text-dark);text-align:right;}

.produk-item{display:flex;align-items:center;gap:14px;padding:10px 0;border-bottom:1px solid rgba(201,146,58,0.08);}
.produk-item:last-child{border-bottom:none;}
.produk-img{width:56px;height:56px;border-radius:10px;object-fit:cover;background:var(--cream-dark);flex-shrink:0;}
.produk-img-placeholder{width:56px;height:56px;border-radius:10px;background:var(--cream-dark);display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:1.3rem;flex-shrink:0;}
.produk-info{flex:1;}
.produk-nama{font-weight:600;font-size:0.9rem;color:var(--text-dark);}
.produk-qty{color:var(--text-light);font-size:0.8rem;margin-top:2px;}
.produk-subtotal{font-weight:700;color:var(--crimson);font-size:0.92rem;}

.total-row{display:flex;justify-content:space-between;align-items:center;padding-top:14px;margin-top:4px;border-top:2px solid rgba(201,146,58,0.2);}
.total-label{font-weight:700;color:var(--text-dark);}
.total-value{font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:800;color:var(--crimson);}

.bukti-img{width:100%;max-height:250px;object-fit:contain;border-radius:10px;border:1px solid rgba(201,146,58,0.2);}
.btn-upload-lagi{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--crimson),var(--crimson-soft));color:var(--white);padding:10px 20px;border-radius:50px;font-weight:600;font-size:0.85rem;text-decoration:none;}

@media(max-width:768px){nav{padding:0 20px;}.page{padding:88px 16px 48px;}.tracker-label{font-size:0.65rem;}.info-label{min-width:100px;}}
</style>
</head>
<body>
<nav>
    <a href="{{ url('/user/home') }}" class="nav-logo">
        <img src="{{ asset('images/LogoPL.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul style="display:flex;align-items:center;gap:8px;list-style:none;">
        <li><a href="{{ route('pesanan.riwayat') }}" style="text-decoration:none;color:var(--text-mid);font-weight:500;padding:8px 16px;border-radius:50px;">Pesanan Saya</a></li>
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
                <div class="tracker-icon done"><i class="fa-solid fa-circle-check"></i></div>
                <div class="tracker-label">Pesanan<br>Dibuat</div>
            </div>
            <div class="tracker-line {{ in_array($pesanan->status_pesanan, ['diproses','selesai']) ? 'done' : '' }}"></div>
            <div class="tracker-step">
                <div class="tracker-icon {{ in_array($pesanan->status_pesanan, ['diproses','selesai']) ? 'done' : 'pending' }}">
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
                <img class="produk-img" src="{{ asset('storage/' . $item->produk->foto) }}"
                     alt="{{ $item->produk->nama_produk }}"
                     onerror="this.outerHTML='<div class=produk-img-placeholder><i class=fa-solid fa-cookie></i></div>'">
            @else
                <div class="produk-img-placeholder"><i class="fa-solid fa-cookie"></i></div>
            @endif
            <div class="produk-info">
                <div class="produk-nama">{{ $item->produk->nama_produk }}</div>
                <div class="produk-qty">{{ $item->jumlah_produk }} pcs × Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
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
        <div class="info-row" style="flex-direction:column;align-items:flex-start;gap:10px;">
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