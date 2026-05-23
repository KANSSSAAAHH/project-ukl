<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Rating – PawonLokal</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/user/rating.css') }}">
</head>
<body>
    <main class="rating-card">
        <section id="formSection">
            <header class="card-header">
                <div class="card-icon"><i class="fa-solid fa-star"></i></div>
                <h1 class="card-title">Beri Kami Rating</h1>
                <p class="card-subtitle">Pengalamanmu sangat berarti untuk kami.<br>Ceritakan pendapatmu tentang produk yang sudah kamu beli.</p>
            </header>

            @if(session('success'))<div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>@endif
            @if($errors->any())<div class="alert alert-error"><i class="fa-solid fa-circle-exclamation"></i> Periksa kembali isian kamu!</div>@endif

            <form method="POST" action="{{ route('rating.store') }}" id="ratingForm">
                @csrf
                <input type="hidden" name="id_produk" value="{{ $id_produk ?? old('id_produk') }}">

                <div class="form-group">
                    <label class="form-label">Rating Kamu</label>
                    <div class="star-rating" id="starContainer">
                        @for($i = 1; $i <= 5; $i++)
                            <input type="radio" name="rating" id="s{{ $i }}" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                            <label for="s{{ $i }}" data-value="{{ $i }}">★</label>
                        @endfor
                    </div>
                    <div class="star-hint" id="starHint">Ketuk bintang untuk menilai</div>
                    @error('rating')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group left-align">
                    <label class="form-label">Komentar</label>
                    <textarea name="komentar" class="form-textarea" placeholder="Ceritakan pengalamanmu... apakah rasanya lezat? Apakah kamu menyukainya?" required>{{ old('komentar') }}</textarea>
                    @error('komentar')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn-submit"><span><i class="fa-solid fa-paper-plane"></i> Kirim Rating</span></button>
            </form>
        </section>

        <section class="thankyou-overlay" id="thankyouSection">
            <div class="thankyou-icon"><i class="fa-solid fa-heart"></i></div>
            <h2 class="thankyou-title">Terima Kasih! 🎉</h2>
            <p class="thankyou-subtitle">Rating kamu sudah kami terima dengan senang hati.<br>Masukan kamu membantu kami terus berkembang dan menghadirkan<br>kue tradisional terbaik untuk kamu!</p>
            <a href="{{ url('/') }}" class="btn-home"><i class="fa-solid fa-house"></i> Kembali ke Beranda</a>
        </section>
    </main>

    @if(session('success'))<script> window.ratingSuccess = true; </script>@endif
    <script src="{{ asset('js/user/rating.js') }}"></script>
</body>
</html>