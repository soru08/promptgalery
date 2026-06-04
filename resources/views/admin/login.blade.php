<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — PromptGallery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Poppins',-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;
            background:linear-gradient(135deg, #FFFBDE 0%, #E6F9FF 100%);
            color:#0F172A;
            min-height:100vh; display:flex; align-items:center; justify-content:center; padding:2rem;
        }
        .login-card {
            width:100%; max-width:420px;
            background:#FFFFFF; border:2px solid #FFD200;
            border-radius:24px; padding:2.5rem;
            box-shadow: rgba(255,210,0,0.15) 0px 20px 40px -5px, rgba(0,0,0,0.08) 0px 10px 20px -5px;
        }
        .logo {
            display:flex; align-items:center; gap:10px;
            justify-content:center; margin-bottom:2rem;
        }
        .logo-icon {
            width:44px; height:44px; border-radius:12px;
            background:linear-gradient(135deg,#FFD200,#00AACC);
            display:flex; align-items:center; justify-content:center;
            font-size:1.2rem; color:#0F172A;
            box-shadow:rgba(255,210,0,0.35) 0px 4px 15px;
        }
        .logo-text { font-size:1.25rem; font-weight:700; color:#0F172A; }
        h1 { font-size:1.4rem; font-weight:800; color:#0F172A; margin-bottom:.4rem; text-align:center; }
        .subtitle { font-size:.875rem; color:#64748B; text-align:center; margin-bottom:2rem; font-weight:400; }
        .form-group { margin-bottom:1.25rem; }
        label { display:block; font-size:.85rem; font-weight:600; color:#334155; margin-bottom:7px; }
        input[type=email], input[type=password] {
            width:100%; padding:12px 16px; background:#FFFFFF;
            border:1px solid #E2E8F0; border-radius:12px;
            color:#0F172A; font-family:'Poppins',sans-serif; font-size:.9rem;
            outline:none; transition:all .2s; min-height:44px;
        }
        input[type=email]:focus, input[type=password]:focus {
            border-color:#FFD200; box-shadow:0 0 0 3px rgba(255,210,0,0.2);
        }
        input::placeholder { color:#94A3B8; }
        .error-msg { font-size:.8rem; color:#EF4444; margin-top:5px; font-weight:500; }
        .alert {
            padding:12px 14px; border-radius:12px; margin-bottom:1.25rem;
            font-size:.85rem; display:flex; align-items:center; gap:8px; font-weight:500;
        }
        .alert-error { background:rgba(239,68,68,.06); border:1px solid rgba(239,68,68,.2); color:#991b1b; }
        .alert-success { background:rgba(16,185,129,.06); border:1px solid rgba(16,185,129,.2); color:#065f46; }
        .remember {
            display:flex; align-items:center; gap:8px;
            font-size:.875rem; color:#475569; margin-bottom:1.5rem; font-weight:500;
        }
        .remember input[type=checkbox] { width:auto; accent-color:#FFD200; width:18px; height:18px; }
        .btn-login {
            width:100%; padding:12px; border-radius:12px; height:44px;
            background:#FFD200; color:#0F172A;
            font-family:Arial,sans-serif; font-size:14px; font-weight:700;
            border:2px solid #E6BD00; cursor:pointer; transition:all .2s;
            box-shadow:rgba(255,210,0,0.35) 0px 4px 15px;
        }
        .btn-login:hover {
            background:#E6BD00;
            box-shadow:rgba(255,210,0,0.55) 0px 6px 20px;
        }
        .btn-login:active { transform:scale(0.98); }
        .back-link { text-align:center; margin-top:1.5rem; }
        .back-link a {
            font-size:.875rem; color:#00AACC; text-decoration:none; font-weight:600;
            transition:.2s;
        }
        .back-link a:hover { color:#0090AA; text-decoration:underline; }
        .divider { border:none; border-top:1px solid #E2E8F0; margin:1.5rem 0; }
        .hint {
            padding:14px 16px; border-radius:12px;
            background:rgba(0,170,204,0.06); border:1px solid rgba(0,170,204,0.2);
            font-size:.78rem; color:#475569; text-align:center; font-weight:400;
            line-height:1.6;
        }
        .hint strong { color:#00AACC; font-weight:700; }
    </style>
</head>
<body>
<div class="login-card">
    <div class="logo">
        <div class="logo-icon">✦</div>
        <div class="logo-text">PromptGallery</div>
    </div>
    <h1>Selamat Datang</h1>
    <p class="subtitle">Masuk ke panel admin untuk mengelola konten</p>

    @if(session('error'))
    <div class="alert alert-error">✗ {{ session('error') }}</div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                   placeholder="admin@promptgallery.com" required autofocus>
            @error('email') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   placeholder="Masukkan password" required>
            @error('password') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
        <div class="remember">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember" style="margin:0;cursor:pointer;font-weight:500">Ingat saya</label>
        </div>
        <button type="submit" class="btn-login">🔐 Masuk sebagai Admin</button>
    </form>

    <div class="back-link">
        <a href="{{ route('home') }}">← Kembali ke Gallery</a>
    </div>

    <hr class="divider">

    <div class="hint">
        <strong>Default Admin:</strong><br>
        admin@promptgallery.com / admin123
    </div>
</div>
</body>
</html>
