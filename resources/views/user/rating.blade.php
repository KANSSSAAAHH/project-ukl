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

<div class="card">

    {{-- FORM RATING --}}
    <div id="formSection">
        <div class="card-header">
            <div class="card-icon">
                <i class="fa-solid fa-star"></i>
            </div>
            <h1 class="card-title">Beri Kami Rating</h1>
            <p class="card-sub">
                Pengalamanmu sangat berarti untuk kami.<br>
                Ceritakan pendapatmu tentang produk yang sudah kamu beli.
            </p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> Periksa kembali isian kamu!
            </div>
        @endif

        <form method="POST" action="{{ route('rating.store') }}" id="ratingForm">
            @csrf

            {{-- ID Produk (ditangkap otomatis dari Controller) --}}
            <input type="hidden" name="id_produk" value="{{ $id_produk ?? old('id_produk') }}">

            {{-- Rating Bintang --}}
            <div class="form-group">
                <label class="form-label">Rating Kamu</label>
                <div class="star-container" id="starContainer">
                    <input type="radio" name="rating" id="s1" value="1" {{ old('rating') == 1 ? 'checked' : '' }}>
                    <label for="s1" data-value="1">★</label>

                    <input type="radio" name="rating" id="s2" value="2" {{ old('rating') == 2 ? 'checked' : '' }}>
                    <label for="s2" data-value="2">★</label>

                    <input type="radio" name="rating" id="s3" value="3" {{ old('rating') == 3 ? 'checked' : '' }}>
                    <label for="s3" data-value="3">★</label>

                    <input type="radio" name="rating" id="s4" value="4" {{ old('rating') == 4 ? 'checked' : '' }}>
                    <label for="s4" data-value="4">★</label>

                    <input type="radio" name="rating" id="s5" value="5" {{ old('rating') == 5 ? 'checked' : '' }}>
                    <label for="s5" data-value="5">★</label>
                </div>
                <div class="star-hint" id="starHint">Ketuk bintang untuk menilai</div>

                @error('rating')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Komentar --}}
            <div class="form-group left-align">
                <label class="form-label">Komentar</label>
                <textarea name="komentar" class="form-textarea"
                    placeholder="Ceritakan pengalamanmu... apakah rasanya lezat? Apakah kamu menyukainya?"
                    required>{{ old('komentar') }}</textarea>

                @error('komentar')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-paper-plane"></i> Kirim Rating
            </button>
        </form>

        {{-- Tombol kembali ke riwayat untuk user yang tidak ingin memberi rating --}}
        <a href="{{ url()->previous() }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Riwayat
        </a>
    </div>

    {{-- TERIMA KASIH OVERLAY --}}
    <div class="thankyou-overlay" id="thankyouSection">
        <div class="thankyou-icon">
            <i class="fa-solid fa-heart"></i>
        </div>
        <h2 class="thankyou-title">Terima Kasih! 🎉</h2>
        <p class="thankyou-sub">
            Rating kamu sudah kami terima dengan senang hati.<br>
            Masukan kamu membantu kami terus berkembang dan menghadirkan<br>
            kue tradisional terbaik untuk kamu!
        </p>
        <a href="{{ url('/') }}" class="btn-beranda">
            <i class="fa-solid fa-house"></i> Kembali ke Beranda
        </a>
    </div>

</div>

<script src="{{ asset('js/user/rating.js') }}"></script>

{{-- Handler tampilan sukses dari Laravel session --}}
@if(session('success'))
<script>
    document.getElementById('formSection').style.display = 'none';
    document.getElementById('thankyouSection').classList.add('show');
</script>
@endif

</body>
</html>