<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout – PawonLokal</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
    --crimson:#8B1A1A;--crimson-soft:#B22222;--gold:#C9923A;--gold-light:#E8B86D;
    --cream:#FDF6ED;--cream-dark:#F5E6CC;--brown:#3D1C00;
    --text-dark:#1E0A00;--text-mid:#5C3317;--text-light:#9E7650;--white:#FFFFFF;
    --shadow-warm:0 8px 40px rgba(139,26,26,0.15);--radius:16px;--transition:0.3s cubic-bezier(0.4,0,0.2,1);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Plus Jakarta Sans',sans-serif;background:linear-gradient(135deg,#fdf8ee,#f9f0d8,#f9f3e2);color:var(--text-dark);min-height:100vh;}
nav{position:fixed;top:0;left:0;right:0;z-index:1000;padding:0 40px;height:72px;display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,0.97);backdrop-filter:blur(20px);border-bottom:1px solid rgba(139,26,26,0.15);}
.nav-logo{display:flex;align-items:center;gap:12px;text-decoration:none;}
.nav-logo img{height:44px;object-fit:contain;}
.nav-logo span{font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:800;color:var(--crimson);}
.nav-cta{background:var(--crimson);color:var(--white);padding:10px 22px;border-radius:50px;font-weight:600;border:none;cursor:pointer;font-family:inherit;}

.page{padding:100px 40px 60px;max-width:1000px;margin:0 auto;}
.page-title{font-family:'Playfair Display',serif;font-size:2rem;font-weight:800;color:var(--text-dark);margin-bottom:8px;}
.page-sub{color:var(--text-light);font-size:0.92rem;margin-bottom:32px;}

.checkout-grid{display:grid;grid-template-columns:1fr 380px;gap:32px;align-items:start;}

/* FORM */
.form-card{background:var(--white);border-radius:var(--radius);padding:28px;box-shadow:var(--shadow-warm);}
.form-section-title{font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:700;color:var(--text-dark);margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid rgba(201,146,58,0.2);}
.form-group{margin-bottom:18px;}
.form-label{display:block;font-size:0.82rem;font-weight:600;color:var(--text-mid);margin-bottom:6px;letter-spacing:0.05em;text-transform:uppercase;}
.form-input{width:100%;padding:12px 16px;border:1.5px solid rgba(201,146,58,0.3);border-radius:10px;font-family:inherit;font-size:0.92rem;color:var(--text-dark);background:var(--cream);transition:border var(--transition),box-shadow var(--transition);outline:none;}
.form-input:focus{border-color:var(--crimson);box-shadow:0 0 0 3px rgba(139,26,26,0.08);}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.metode-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.metode-item{position:relative;}
.metode-item input{position:absolute;opacity:0;width:0;height:0;}
.metode-label{display:flex;align-items:center;gap:10px;padding:12px 16px;border:1.5px solid rgba(201,146,58,0.3);border-radius:10px;cursor:pointer;font-size:0.88rem;font-weight:600;color:var(--text-mid);transition:all var(--transition);background:var(--cream);}
.metode-item input:checked + .metode-label{border-color:var(--crimson);background:rgba(139,26,26,0.06);color:var(--crimson);}
.metode-label i{font-size:1.1rem;}

/* RINGKASAN */
.summary-card{background:var(--white);border-radius:var(--radius);padding:24px;box-shadow:var(--shadow-warm);position:sticky;top:90px;}
.summary-title{font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:700;color:var(--text-dark);margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid rgba(201,146,58,0.2);}
.summary-item{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid rgba(201,146,58,0.1);font-size:0.88rem;}
.summary-item-name{color:var(--text-mid);flex:1;}
.summary-item-qty{color:var(--text-light);font-size:0.8rem;margin:0 8px;}
.summary-item-price{font-weight:600;color:var(--text-dark);}
.summary-total-row{display:flex;justify-content:space-between;align-items:center;padding:16px 0 0;}
.summary-total-label{font-weight:700;color:var(--text-dark);}
.summary-total-price{font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:800;color:var(--crimson);}
.btn-checkout{width:100%;display:flex;align-items:center;justify-content:center;gap:9px;background:linear-gradient(135deg,var(--crimson),var(--crimson-soft));color:var(--white);padding:15px;border-radius:50px;font-family:inherit;font-size:0.95rem;font-weight:600;border:none;cursor:pointer;box-shadow:0 6px 24px rgba(139,26,26,0.3);margin-top:16px;transition:transform var(--transition);}
.btn-checkout:hover{transform:translateY(-2px);}
.btn-kembali{display:flex;align-items:center;justify-content:center;gap:8px;background:transparent;color:var(--crimson);padding:12px;border-radius:50px;font-family:inherit;font-size:0.88rem;font-weight:600;border:2px solid var(--crimson);text-decoration:none;margin-top:10px;transition:background var(--transition),color var(--transition);}
.btn-kembali:hover{background:var(--crimson);color:var(--white);}

.alert{padding:12px 18px;border-radius:10px;font-size:0.88rem;font-weight:600;margin-bottom:20px;display:flex;align-items:center;gap:8px;}
.alert-error{background:#fee2e2;color:#b91c1c;border:1px solid #fecaca;}

@media(max-width:768px){
    nav{padding:0 20px;}
    .page{padding:90px 20px 40px;}
    .checkout-grid{grid-template-columns:1fr;}
    .form-row{grid-template-columns:1fr;}
}
</style>
</head>
<body>
<nav>
    <a href="{{ url('/user/home') }}" class="nav-logo">
        <img src="{{ asset('images/Logo.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul style="display:flex;align-items:center;gap:8px;list-style:none;">
        <li><a href="{{ url('/user/home') }}" style="text-decoration:none;color:var(--text-mid);font-weight:500;padding:8px 16px;border-radius:50px;">Home</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="nav-cta">Logout</button>
            </form>
        </li>
    </ul>
</nav>

<div class="page">
    <h1 class="page-title">Checkout</h1>
    <p class="page-sub">Lengkapi data pengiriman dan pilih metode pembayaran</p>

    @if($errors->any())
    <div class="alert alert-error">
        <i class="fa-solid fa-circle-exclamation"></i>
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('checkout.proses') }}" method="POST">
        @csrf
        <div class="checkout-grid">

            {{-- FORM KIRI --}}
            <div style="display:flex;flex-direction:column;gap:20px;">

                {{-- Alamat --}}
                <div class="form-card">
                    <div class="form-section-title">
                        <i class="fa-solid fa-location-dot" style="color:var(--crimson);margin-right:8px;"></i>
                        Data Pengiriman
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Penerima</label>
                        <input type="text" name="nama_penerima" class="form-input"
                               placeholder="Nama lengkap penerima"
                               value="{{ old('nama_penerima', auth()->user()->nama) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" class="form-input"
                               placeholder="08xxxxxxxxxx"
                               value="{{ old('no_hp', auth()->user()->no_hp) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-input" rows="3"
                                  placeholder="Nama jalan, nomor rumah, RT/RW" required>{{ old('alamat_lengkap') }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Kota</label>
                            <input type="text" name="kota" class="form-input"
                                   placeholder="Surabaya" value="{{ old('kota') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-input"
                                   placeholder="Kecamatan" value="{{ old('kecamatan') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kode Pos</label>
                        <input type="text" name="kode_pos" class="form-input"
                               placeholder="60xxx" value="{{ old('kode_pos') }}" required>
                    </div>
                </div>

                {{-- Metode Bayar --}}
                <div class="form-card">
                    <div class="form-section-title">
                        <i class="fa-solid fa-wallet" style="color:var(--crimson);margin-right:8px;"></i>
                        Metode Pembayaran
                    </div>
<div class="metode-grid">
    <div class="metode-item">
        <input type="radio" name="metode" id="gopay" value="GoPay" checked>
        <label class="metode-label" for="gopay">
            <i class="fa-solid fa-g"></i> GoPay
        </label>
    </div>
    <div class="metode-item">
        <input type="radio" name="metode" id="dana" value="Dana">
        <label class="metode-label" for="dana">
            <i class="fa-solid fa-d"></i> Dana
        </label>
    </div>
    <div class="metode-item">
        <input type="radio" name="metode" id="ovo" value="OVO">
        <label class="metode-label" for="ovo">
            <i class="fa-solid fa-o"></i> OVO
        </label>
    </div>
</div>
                </div>
            </div>

            {{-- RINGKASAN KANAN --}}
            <div class="summary-card">
                <div class="summary-title">
                    <i class="fa-solid fa-receipt" style="color:var(--crimson);margin-right:8px;"></i>
                    Ringkasan Pesanan
                </div>

                @foreach($keranjang as $item)
                <div class="summary-item">
                    <span class="summary-item-name">{{ $item->produk->nama_produk }}</span>
                    <span class="summary-item-qty">x{{ $item->jumlah_produk }}</span>
                    <span class="summary-item-price">Rp {{ number_format($item->produk->harga * $item->jumlah_produk, 0, ',', '.') }}</span>
                </div>
                @endforeach

                <div class="summary-total-row">
                    <span class="summary-total-label">Total</span>
                    <span class="summary-total-price">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <button type="submit" class="btn-checkout">
                    <i class="fa-solid fa-bag-shopping"></i> Buat Pesanan
                </button>
                <a href="{{ route('keranjang.index') }}" class="btn-kembali">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Keranjang
                </a>
            </div>

        </div>
    </form>
</div>
</body>
</html>