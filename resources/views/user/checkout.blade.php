<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout – PawonLokal</title>
    
    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    {{-- Styles --}}
    @vite('resources/css/user/checkout.css')
    {{-- Atau jika pakai Laravel Mix: <link rel="stylesheet" href="{{ mix('css/user/checkout.css') }}"> --}}
</head>
<body>
    {{-- Navigation --}}
    <nav class="navbar">
        <a href="{{ url('/user/home') }}" class="nav-logo">
            <img src="{{ asset('images/Logo.PNG') }}" alt="PawonLokal">
            <span>PawonLokal</span>
        </a>
        
        <ul class="nav-links">
            <li>
                <a href="{{ url('/user/home') }}">Home</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="nav-cta">Logout</button>
                </form>
            </li>
        </ul>
    </nav>

    {{-- Main Content --}}
    <main class="page">
        <h1 class="page-title">Checkout</h1>
        <p class="page-subtitle">Lengkapi data pengiriman dan pilih metode pembayaran</p>

        {{-- Error Alerts --}}
        @if($errors->any())
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Success Message (optional) --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('checkout.proses') }}" method="POST" id="checkout-form">
            @csrf
            
            <div class="checkout-grid">
                
                {{-- LEFT: Form Section --}}
                <section>
                    {{-- Shipping Data --}}
                    <div class="form-card">
                        <h2 class="form-section-title">
                            <i class="fa-solid fa-location-dot"></i>
                            Data Pengiriman
                        </h2>

                        <div class="form-group">
                            <label class="form-label" for="nama_penerima">Nama Penerima</label>
                            <input type="text" 
                                   id="nama_penerima"
                                   name="nama_penerima" 
                                   class="form-input"
                                   placeholder="Nama lengkap penerima"
                                   value="{{ old('nama_penerima', auth()->user()->nama) }}" 
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="no_hp">Nomor HP</label>
                            <input type="tel" 
                                   id="no_hp"
                                   name="no_hp" 
                                   class="form-input"
                                   placeholder="08xxxxxxxxxx"
                                   value="{{ old('no_hp', auth()->user()->no_hp) }}" 
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="alamat_lengkap">Alamat Lengkap</label>
                            <textarea id="alamat_lengkap"
                                      name="alamat_lengkap" 
                                      class="form-textarea" 
                                      rows="3"
                                      placeholder="Nama jalan, nomor rumah, RT/RW" 
                                      required>{{ old('alamat_lengkap') }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="kota">Kota</label>
                                <input type="text" 
                                       id="kota"
                                       name="kota" 
                                       class="form-input"
                                       placeholder="Surabaya" 
                                       value="{{ old('kota') }}" 
                                       required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="kecamatan">Kecamatan</label>
                                <input type="text" 
                                       id="kecamatan"
                                       name="kecamatan" 
                                       class="form-input"
                                       placeholder="Kecamatan" 
                                       value="{{ old('kecamatan') }}" 
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="kode_pos">Kode Pos</label>
                            <input type="text" 
                                   id="kode_pos"
                                   name="kode_pos" 
                                   class="form-input"
                                   placeholder="60xxx" 
                                   value="{{ old('kode_pos') }}" 
                                   required>
                        </div>
                    </div>

                    {{-- Payment Method --}}
                    <div class="form-card">
                        <h2 class="form-section-title">
                            <i class="fa-solid fa-wallet"></i>
                            Metode Pembayaran
                        </h2>
                        
                        <div class="payment-grid">
                            <div class="payment-option">
                                <input type="radio" name="metode" id="gopay" value="GoPay" checked>
                                <label class="payment-label" for="gopay">
                                    <i class="fa-solid fa-g"></i> GoPay
                                </label>
                            </div>
                            <div class="payment-option">
                                <input type="radio" name="metode" id="dana" value="Dana">
                                <label class="payment-label" for="dana">
                                    <i class="fa-solid fa-d"></i> Dana
                                </label>
                            </div>
                            <div class="payment-option">
                                <input type="radio" name="metode" id="ovo" value="OVO">
                                <label class="payment-label" for="ovo">
                                    <i class="fa-solid fa-o"></i> OVO
                                </label>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- RIGHT: Order Summary --}}
                <aside class="summary-card">
                    <h2 class="summary-title">
                        <i class="fa-solid fa-receipt"></i>
                        Ringkasan Pesanan
                    </h2>

                    @forelse($keranjang as $item)
                        <div class="summary-item">
                            <span class="summary-item-name">{{ $item->produk->nama_produk }}</span>
                            <span class="summary-item-qty">x{{ $item->jumlah_produk }}</span>
                            <span class="summary-item-price">
                                Rp {{ number_format($item->produk->harga * $item->jumlah_produk, 0, ',', '.') }}
                            </span>
                        </div>
                    @empty
                        <p style="color: var(--text-light); text-align: center; padding: 20px;">
                            Keranjang kosong
                        </p>
                    @endforelse

                    <div class="summary-total">
                        <span class="summary-total-label">Total</span>
                        <span class="summary-total-price">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <button type="submit" class="btn-checkout">
                        <span><i class="fa-solid fa-bag-shopping"></i> Buat Pesanan</span>
                    </button>
                    
                    <a href="{{ route('keranjang.index') }}" class="btn-back">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Keranjang
                    </a>
                </aside>

            </div>
        </form>
    </main>

    {{-- Scripts --}}
    @vite('resources/js/user/checkout.js')
    {{-- Atau jika pakai Laravel Mix: <script src="{{ mix('js/user/checkout.js') }}"></script> --}}
</body>
</html>