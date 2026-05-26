<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout – PawonLokal</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/user/checkout.css') }}">
</head>
<body>

<nav>
    <a href="{{ url('/user/home') }}" class="nav-logo">
        <img src="{{ asset('images/LogoPL.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ url('/user/home') }}">Home</a></li>
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
            <div class="form-left">

                {{-- Data Pengiriman --}}
                <div class="form-card">
                    <div class="form-section-title">
                        <i class="fa-solid fa-location-dot"></i> Data Pengiriman
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

                {{-- Metode Pembayaran --}}
                <div class="form-card">
                    <div class="form-section-title">
                        <i class="fa-solid fa-wallet"></i> Metode Pembayaran
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
                    <i class="fa-solid fa-receipt"></i> Ringkasan Pesanan
                </div>

                @foreach($keranjang as $item)
                <div class="summary-item">
                    <span class="summary-item-name">{{ $item->produk->nama_produk }}</span>
                    <span class="summary-item-qty">x{{ $item->jumlah_produk }}</span>
                    <span class="summary-item-price">
                        Rp {{ number_format($item->produk->harga * $item->jumlah_produk, 0, ',', '.') }}
                    </span>
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