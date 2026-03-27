<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login – Pawon Lokal</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --merah: #C8281E;
            --merah-hover: #a02017;
            --abu: #d6d6d6;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ================= LEFT ================= */
        .kolom-foto {
            flex: 1;
            position: relative;
            overflow: hidden;

            /* MIRING FULL (ANTI PATAH) */
            clip-path: polygon(0 0, 100% 0, 88% 100%, 0% 100%);
        }

        .kolom-foto img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* GARIS HITAM MIRING */
        .kolom-foto::after {
            content: '';
            position: absolute;
            top: 0;
            right: -30px;
            width: 60px;
            height: 100%;
            background: #111;
            transform: skewX(-12deg);
        }

        /* ================= RIGHT ================= */
        .kolom-form {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-box {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo {
            width: 110px;
            margin-bottom: 10px;
        }

        h1 {
            color: var(--merah);
            margin-bottom: 30px;
            letter-spacing: 3px;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 15px 20px 15px 45px;
            border-radius: 50px;
            border: none;
            background: var(--abu);
        }

        .icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .btn-login {
            width: 60%;
            padding: 14px;
            border-radius: 50px;
            border: none;
            background: var(--merah);
            color: white;
            font-weight: bold;
            margin-top: 10px;
            cursor: pointer;
        }

        .btn-login:hover {
            background: var(--merah-hover);
        }

        .teks-daftar {
            margin: 10px 0;
        }

        .teks-daftar a {
            color: var(--merah);
            font-weight: bold;
            text-decoration: none;
        }

        /* ================= RESPONSIVE ================= */
        @media(max-width:768px){
            .wrapper{
                flex-direction: column;
            }

            .kolom-foto{
                height: 250px;
                clip-path: none;
            }

            .kolom-foto::after{
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- FOTO -->
    <div class="kolom-foto">
        <img src="{{ asset('images/bolu.png') }}">
    </div>

    <!-- FORM -->
    <div class="kolom-form">
        <div class="form-box">

            <img src="{{ asset('images/Logo.png') }}" class="logo">

            <h1>LOGIN</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <span class="icon">👤</span>
                    <input type="email" name="email" placeholder="Masukan Email">
                </div>

                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" name="password" placeholder="Masukan Password">
                </div>

                <p class="teks-daftar">
                    Belum punya akun? <a href="{{ route('register') }}">Registrasi</a>
                </p>

                <button class="btn-login">Login</button>
            </form>

        </div>
    </div>

</div>

</body>
</html>