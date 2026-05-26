<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang – PawonLokal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/user/keranjang.css') }}">
</head>
<body>

<nav>
    <a href="{{ url('/user/home') }}" class="nav-logo">
        <img src="{{ asset('images/LogoPL.PNG') }}" alt="PawonLokal">
        <span>PawonLokal</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ url('/user/home') }}">Home</a></li>
        <li><a href="{{ url('/produk') }}">Produk</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="nav-cta">Logout</button>
            </form>
        </li>
    </ul>
</nav>

<div class="page">
    <h1 class="page-title">Keranjang Belanja</h1>
    <p class="page-sub">{{ $keranjang->count() }} produk dalam keranjangmu</p>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    @if($keranjang->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-basket-shopping"></i>
            <h3>Keranjangmu masih kosong</h3>
            <p style="margin-bottom:24px;">Yuk, pilih kue tradisional favoritmu!</p>
            <a href="{{ url('/produk') }}" class="btn-checkout">
                <i class="fa-solid fa-store"></i> Lihat Produk
            </a>
        </div>
    @else
        <div class="keranjang-list">
            @foreach($keranjang as $item)
            <div class="keranjang-item">

                {{-- Foto Produk --}}
                @if($item->produk->foto)
                    <img class="keranjang-img"
                         src="{{ asset('storage/' . $item->produk->foto) }}"
                         alt="{{ $item->produk->nama_produk }}"
                         onerror="this.outerHTML='<div class=keranjang-img-placeholder><i class=fa-solid fa-cookie></i></div>'">
                @else
                    <div class="keranjang-img-placeholder">
                        <i class="fa-solid fa-cookie"></i>
                    </div>
                @endif

                <div class="keranjang-info">
                    <div class="keranjang-nama">{{ $item->produk->nama_produk }}</div>
                    <div class="keranjang-harga">Rp {{ number_format($item->produk->harga, 0, ',', '.') }} / pcs</div>
                    <div class="keranjang-jumlah">Jumlah: {{ $item->jumlah_produk }} pcs</div>
                </div>

                <div class="keranjang-subtotal">
                    Rp {{ number_format($item->produk->harga * $item->jumlah_produk, 0, ',', '.') }}
                </div>

                <form action="{{ route('keranjang.hapus', $item->id_keranjang) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-hapus" title="Hapus">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>

            </div>
            @endforeach
        </div>

        <div class="keranjang-summary">
            <div class="summary-row">
                <span>Subtotal ({{ $keranjang->count() }} produk)</span>
                <span class="summary-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="summary-actions">
                <a href="{{ url('/produk') }}" class="btn-lanjut">
                    <i class="fa-solid fa-arrow-left"></i> Lanjut Belanja
                </a>
                <a href="{{ route('checkout.index') }}" class="btn-checkout">
                    <i class="fa-solid fa-bag-shopping"></i> Checkout
                </a>
            </div>
        </div>
    @endif
</div>

</body>
</html>