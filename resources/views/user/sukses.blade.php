<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pesanan Berhasil – PawonLokal</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{--crimson:#8B1A1A;--crimson-soft:#B22222;--gold:#C9923A;--cream:#FDF6ED;--brown:#3D1C00;--text-dark:#1E0A00;--text-mid:#5C3317;--text-light:#9E7650;--white:#FFFFFF;--radius:16px;--transition:0.3s cubic-bezier(0.4,0,0.2,1);}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Plus Jakarta Sans',sans-serif;background:linear-gradient(135deg,#fdf8ee,#f9f0d8);color:var(--text-dark);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;}
.card{background:var(--white);border-radius:24px;padding:48px 40px;text-align:center;max-width:480px;width:100%;box-shadow:0 20px 60px rgba(139,26,26,0.15);}
.icon-wrap{width:80px;height:80px;background:linear-gradient(135deg,#dcfce7,#bbf7d0);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;font-size:2rem;color:#15803d;}
.title{font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:800;color:var(--text-dark);margin-bottom:12px;}
.sub{color:var(--text-light);font-size:0.92rem;line-height:1.7;margin-bottom:32px;}
.pesanan-id{background:var(--cream);border-radius:10px;padding:12px 20px;font-weight:700;color:var(--crimson);font-size:1rem;margin-bottom:32px;display:inline-block;}
.btn-home{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,var(--crimson),var(--crimson-soft));color:var(--white);padding:14px 32px;border-radius:50px;font-family:inherit;font-size:0.95rem;font-weight:600;text-decoration:none;box-shadow:0 6px 24px rgba(139,26,26,0.3);transition:transform var(--transition);}
.btn-home:hover{transform:translateY(-2px);}
</style>
</head>
<body>
<div class="card">
    <div class="icon-wrap">
        <i class="fa-solid fa-circle-check"></i>
    </div>
    <h1 class="title">Pesanan Berhasil!</h1>
    <p class="sub">
        Terima kasih! Pesananmu sedang kami proses.<br>
        Admin akan mengkonfirmasi setelah pembayaran terverifikasi.
    </p>
    <div class="pesanan-id">Pesanan #{{ $id }}</div>
    <br><br>
    <a href="{{ url('/user/home') }}" class="btn-home">
        <i class="fa-solid fa-house"></i> Kembali ke Beranda
    </a>
</div>
</body>
</html>