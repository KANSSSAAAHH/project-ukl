<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Pesanan – PawonLokal</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{--crimson:#8B1A1A;--crimson-soft:#B22222;--gold:#C9923A;--gold-light:#E8B86D;--cream:#FDF6ED;--cream-dark:#F5E6CC;--brown:#3D1C00;--text-dark:#1E0A00;--text-mid:#5C3317;--text-light:#9E7650;--white:#FFFFFF;--shadow-warm:0 8px 40px rgba(139,26,26,0.15);--radius:16px;--transition:0.3s cubic-bezier(0.4,0,0.2,1);}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Plus Jakarta Sans',sans-serif;background:linear-gradient(135deg,#fdf8ee,#f9f0d8,#f9f3e2);color:var(--text-dark);min-height:100vh;}
nav{position:fixed;top:0;left:0;right:0;z-index:1000;padding:0 40px;height:72px;display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,0.97);backdrop-filter:blur(20px);border-bottom:1px solid rgba(139,26,26,0.15);}
.nav-logo{display:flex;align-items:center;gap:12px;text-decoration:none;}
.nav-logo img{height:44px;object-fit:contain;}
.nav-logo span{font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:800;color:var(--crimson);}
.nav-links{display:flex;align-items:center;gap:8px;list-style:none;}
.nav-links a{text-decoration:none;color:var(--text-mid);font-weight:500;font-size:0.92rem;padding:8px 16px;border-radius:50px;transition:color var(--transition),background var(--transition);}
.nav-links a:hover,.nav-links a.active{color:var(--crimson);background:rgba(139,26,26,0.08);}
.nav-cta{background:var(--crimson);color:var(--white);padding:10px 22px;border-radius:50px;font-weight:600;border:none;cursor:pointer;font-family:inherit;}

.page{padding:100px 40px 60px;max-width:800px;margin:0 auto;}
.page-title{font-family:'Playfair Display',serif;font-size:2rem;font-weight:800;color:var(--text-dark);margin-bottom:4px;}
.page-sub{color:var(--text-light);font-size:0.92rem;margin-bottom:32px;}

/* STATUS BADGE */
.badge{display:inline-flex;align-items:center;gap:5px;padding:4px 12px;border-radius:50px;font-size:0.75rem;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;}
.badge-menunggu{background:#fef9c3;color:#854d0e;}
.badge-diproses{background:#dbeafe;color:#1d4ed8;}
.badge-selesai{background:#dcfce7;color:#15803d;}
.badge-pending{background:#fef3c7;color:#92400e;}
.badge-lunas{background:#dcfce7;color:#15803d;}

/* CARD PESANAN */
.pesanan-list{display:flex;flex-direction:column;gap:20px;}
.pesanan-card{background:var(--white);border-radius:var(--radius);box-shadow:0 4px 20px rgba(139,26,26,0.08);overflow:hidden;transition:box-shadow var(--transition);}
.pesanan-card:hover{box-shadow:var(--shadow-warm);}
.pesanan-header{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid rgba(201,146,58,0.15);flex-wrap:wrap;gap:8px;}
.pesanan-id{font-weight:700;color:var(--text-dark);font-size:0.92rem;}
.pesanan-id span{color:var(--crimson);}
.pesanan-tgl{color:var(--text-light);font-size:0.8rem;}
.pesanan-body{padding:16px 20px;}

/* PRODUK ITEM */
.produk-item{display:flex;align-items:center;justify-content:space-between;padding:14px 0;border-bottom:1px solid rgba(201,146,58,0.08);}
.produk-item:last-child{border-bottom:none;}
.produk-detail-wrapper{display:flex;align-items:center;gap:14px;flex:1;}
.produk-img{width:60px;height:60px;border-radius:10px;object-fit:cover;background:var(--cream-dark);flex-shrink:0;}
.produk-img-placeholder{width:60px;height:60px;border-radius:10px;background:var(--cream-dark);display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:1.3rem;flex-shrink:0;}
.produk-info{flex:1;}
.produk-nama{font-weight:600;font-size:0.95rem;color:var(--text-dark);}
.produk-qty{color:var(--text-light);font-size:0.8rem;margin-top:2px;}
.produk-subtotal{font-weight:700;color:var(--crimson);font-size:0.9rem;}

.pesanan-footer{display:flex;align-items:center;justify-content:space-between;padding:14px 20px;background:var(--cream);flex-wrap:wrap;gap:10px;}
.pesanan-total-label{font-size:0.82rem;color:var(--text-light);}
.pesanan-total{font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:800;color:var(--crimson);}

/* TOMBOL AKSI */
.footer-actions { display: flex; gap: 8px; align-items: center; }
.btn-detail{display:inline-flex;align-items:center;gap:7px;background:transparent;color:var(--crimson);border:1.5px solid var(--crimson);padding:8px 18px;border-radius:50px;font-size:0.82rem;font-weight:600;text-decoration:none;transition:var(--transition);}
.btn-detail:hover{background:var(--crimson);color:var(--white);}

/* TOMBOL RATING EMAS */
.btn-rating{display:inline-flex;align-items:center;gap:5px;background:linear-gradient(135deg, var(--gold), #B37D2B);color:var(--white);padding:4px 14px;border-radius:50px;font-size:0.78rem;font-weight:700;text-decoration:none;margin-top:6px;box-shadow:0 4px 10px rgba(201,146,58,0.15);transition:var(--transition);}
.btn-rating:hover{transform:translateY(-1px);box-shadow:0 6px 14px rgba(201,146,58,0.3);opacity:0.95;}

/* BADGE STATUS GREEN RATING (SUDAH DINILAI) */
.btn-rating-success{display:inline-flex;align-items:center;gap:5px;background:#dcfce7;color:#15803d;border:1px solid #bbf7d0;padding:4px 14px;border-radius:50px;font-size:0.78rem;font-weight:700;margin-top:6px;user-select:none;}

/* EMPTY */
.empty-state{text-align:center;padding:80px 20px;color:var(--text-light);}
.empty-state i{font-size:4rem;margin-bottom:16px;display:block;color:var(--gold-light);}
.empty-state h3{font-family:'Playfair Display',serif;font-size:1.4rem;color:var(--text-dark);margin-bottom:8px;}
.btn-belanja{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--crimson),var(--crimson-soft));color:var(--white);padding:12px 28px;border-radius:50px;font-weight:600;text-decoration:none;margin-top:16px;box-shadow:0 6px 24px rgba(139,26,26,0.25);}

@media(max-width:768px){nav{padding:0 20px;}.page{padding:88px 16px 48px;}.pesanan-header{flex-direction:column;align-items:flex-start;}.produk-item{flex-direction:column;align-items:stretch;gap:10px;}.produk-subtotal{text-align:right;}.pesanan-footer{flex-direction:column;align-items:stretch;text-align:center;}.footer-actions{flex-direction:column;width:100%;}.btn-detail{width:100%;justify-content:center;}}
</style>
</head>
<body>
<nav>
    <a href="{{ url('/user/home') }}" class="nav-logo">
        <img src="{{ asset('images/LogoPL2.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ url('/user/home') }}">Home</a></li>
        <li><a href="{{ url('/produk') }}">Produk</a></li>
        <li><a href="{{ url('/keranjang') }}">Keranjang</a></li>
        <li><a href="{{ route('pesanan.riwayat') }}" class="active">Pesanan Saya</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="nav-cta">Logout</button>
            </form>
        </li>
    </ul>
</nav>

<div class="page">
    <h1 class="page-title">Pesanan Saya</h1>
    <p class="page-sub">Riwayat semua pesananmu di PawonLokal</p>

    @if($pesanan->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-bag-shopping"></i>
            <h3>Belum ada pesanan</h3>
            <p>Yuk, mulai belanja kue tradisional favoritmu!</p>
            <a href="{{ url('/produk') }}" class="btn-belanja">
                <i class="fa-solid fa-store"></i> Mulai Belanja
            </a>
        </div>
    @else
        <div class="pesanan-list">
            @foreach($pesanan as $p)
            <div class="pesanan-card">
                <div class="pesanan-header">
                    <div>
                        <div class="pesanan-id">Pesanan</div>
                        <div class="pesanan-tgl">{{ \Carbon\Carbon::parse($p->tanggal_pesanan)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                        {{-- Status Pesanan --}}
                        <span class="badge badge-{{ $p->status_pesanan }}">
                            @if($p->status_pesanan === 'menunggu') <i class="fa-solid fa-clock"></i>
                            @elseif($p->status_pesanan === 'diproses') <i class="fa-solid fa-box"></i>
                            @else <i class="fa-solid fa-circle-check"></i>
                            @endif
                            {{ ucfirst($p->status_pesanan) }}
                        </span>
                        {{-- Status Bayar --}}
                        @if($p->pembayaran)
                        <span class="badge badge-{{ $p->pembayaran->status }}">
                            <i class="fa-solid fa-wallet"></i>
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
                                     onerror="this.outerHTML='<div class=produk-img-placeholder><i class=fa-solid fa-cookie></i></div>'">
                            @else
                                <div class="produk-img-placeholder"><i class="fa-solid fa-cookie"></i></div>
                            @endif
                            <div class="produk-info">
                                <div class="produk-nama">{{ $item->produk->nama_produk }}</div>
                                <div class="produk-qty">{{ $item->jumlah_produk }} pcs × Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                                
                                {{-- KONDISI PERUBAHAN TOMBOL BERDASARKAN RATING USER --}}
                                @if($p->status_pesanan === 'selesai')
                                    @if(isset($sudahDirating) && in_array($item->id_produk, $sudahDirating))
                                        {{-- JIKA SUDAH DI-RATING: Berubah jadi warna hijau sukses --}}
                                        <span class="btn-rating-success">
                                            <i class="fa-solid fa-circle-check"></i> Sudah Memberikan Rating
                                        </span>
                                    @else
                                        {{-- JIKA BELUM DI-RATING: Tetap tombol emas bawaan asli --}}
                                        <a href="{{ url('/rating?id_produk=' . $item->id_produk) }}" class="btn-rating">
                                            <i class="fa-solid fa-star"></i> Beri Rating
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="produk-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                </div>

                <div class="pesanan-footer">
                    <div>
                        <div class="pesanan-total-label">Total Pembayaran</div>
                        <div class="pesanan-total">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</div>
                    </div>
                    
                    <div class="footer-actions">
                        <a href="{{ route('pesanan.detail', $p->id_pesanan) }}" class="btn-detail">
                            <i class="fa-solid fa-eye"></i> Lihat Detail
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