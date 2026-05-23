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
    @include('user.partials.nav') {{-- atau paste nav manual jika tidak pakai include --}}

    <main class="page">
        <h1 class="page-title">Checkout</h1>
        <p class="page-subtitle">Lengkapi data pengiriman dan pilih metode pembayaran</p>

        @if($errors->any())
            <div class="alert alert-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}</div>
        @endif

        <form action="{{ route('checkout.proses') }}" method="POST">
            @csrf
            <div class="checkout-grid">
                <section>
                    <div class="form-card">
                        <h2 class="form-section-title"><i class="fa-solid fa-location-dot"></i> Data Pengiriman</h2>
                        <div class="form-group"><label class="form-label" for="nama_penerima">Nama Penerima</label><input type="text" id="nama_penerima" name="nama_penerima" class="form-input" value="{{ old('nama_penerima', auth()->user()->nama) }}" required></div>
                        <div class="form-group"><label class="form-label" for="no_hp">Nomor HP</label><input type="tel" id="no_hp" name="no_hp" class="form-input" value="{{ old('no_hp', auth()->user()->no_hp) }}" required></div>
                        <div class="form-group"><label class="form-label" for="alamat_lengkap">Alamat Lengkap</label><textarea id="alamat_lengkap" name="alamat_lengkap" class="form-textarea" rows="3" required>{{ old('alamat_lengkap') }}</textarea></div>
                        <div class="form-row">
                            <div class="form-group"><label class="form-label" for="kota">Kota</label><input type="text" id="kota" name="kota" class="form-input" value="{{ old('kota') }}" required></div>
                            <div class="form-group"><label class="form-label" for="kecamatan">Kecamatan</label><input type="text" id="kecamatan" name="kecamatan" class="form-input" value="{{ old('kecamatan') }}" required></div>
                        </div>
                        <div class="form-group"><label class="form-label" for="kode_pos">Kode Pos</label><input type="text" id="kode_pos" name="kode_pos" class="form-input" value="{{ old('kode_pos') }}" required></div>
                    </div>
                    <div class="form-card">
                        <h2 class="form-section-title"><i class="fa-solid fa-wallet"></i> Metode Pembayaran</h2>
                        <div class="payment-grid">
                            <div class="payment-option"><input type="radio" name="metode" id="gopay" value="GoPay" checked><label class="payment-label" for="gopay"><i class="fa-solid fa-g"></i> GoPay</label></div>
                            <div class="payment-option"><input type="radio" name="metode" id="dana" value="Dana"><label class="payment-label" for="dana"><i class="fa-solid fa-d"></i> Dana</label></div>
                            <div class="payment-option"><input type="radio" name="metode" id="ovo" value="OVO"><label class="payment-label" for="ovo"><i class="fa-solid fa-o"></i> OVO</label></div>
                        </div>
                    </div>
                </section>
                <aside class="summary-card">
                    <h2 class="summary-title"><i class="fa-solid fa-receipt"></i> Ringkasan Pesanan</h2>
                    @foreach($keranjang as $item)
                    <div class="summary-item"><span class="summary-item-name">{{ $item->produk->nama_produk }}</span><span class="summary-item-qty">x{{ $item->jumlah_produk }}</span><span class="summary-item-price">Rp {{ number_format($item->produk->harga * $item->jumlah_produk, 0, ',', '.') }}</span></div>
                    @endforeach
                    <div class="summary-total"><span class="summary-total-label">Total</span><span class="summary-total-price">Rp {{ number_format($total, 0, ',', '.') }}</span></div>
                    <button type="submit" class="btn-checkout"><span><i class="fa-solid fa-bag-shopping"></i> Buat Pesanan</span></button>
                    <a href="{{ route('keranjang.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali ke Keranjang</a>
                </aside>
            </div>
        </form>
    </main>
    <script src="{{ asset('js/user/checkout.js') }}"></script>
</body>
</html>