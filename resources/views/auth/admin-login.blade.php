<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login — The Love Project</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0f0f14;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #1a1a24;
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-logo img { height: 44px; margin-bottom: 8px; }
        .login-badge {
            display: inline-block;
            background: linear-gradient(135deg,#ec4899,#a855f7);
            color: white; font-size: 10px; font-weight: 700;
            padding: 3px 12px; border-radius: 20px;
            text-transform: uppercase; letter-spacing: 1px;
        }
        h2 { color: #e5e7eb; font-size: 22px; font-weight: 700; text-align: center; margin-bottom: 6px; }
        .subtitle { color: #6b7280; font-size: 13px; text-align: center; margin-bottom: 28px; }
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; color: #9ca3af; font-size: 12px; font-weight: 600; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-input {
            width: 100%; padding: 11px 14px;
            background: #0f0f14;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: #e5e7eb; font-size: 14px;
            transition: border-color .2s;
        }
        .form-input:focus { outline: none; border-color: #a855f7; }
        .btn-login {
            width: 100%; padding: 12px;
            background: linear-gradient(135deg,#ec4899,#a855f7);
            color: white; border: none; border-radius: 10px;
            font-size: 14px; font-weight: 600; cursor: pointer;
            transition: opacity .2s;
        }
        .btn-login:hover { opacity: .9; }
        .error-msg {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 10px; padding: 10px 14px;
            color: #f87171; font-size: 13px; margin-bottom: 18px;
        }
        .back-link {
            text-align: center; margin-top: 20px;
        }
        .back-link a { color: #6b7280; font-size: 13px; text-decoration: none; }
        .back-link a:hover { color: #9ca3af; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <img src="{{ asset('assets/images/love_logo.png') }}" alt="Love Project">
            <div class="login-badge"><i class="fas fa-shield-halved me-1"></i>Admin Access</div>
        </div>

        <h2>Admin Portal</h2>
        <p class="subtitle">Sign in to access the admin dashboard.</p>

        @if($errors->any())
        <div class="error-msg">
            <i class="fas fa-exclamation-circle me-1"></i>
            {{ $errors->first() }}
        </div>
        @endif

        @if(session('status'))
        <div style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.2);border-radius:10px;padding:10px 14px;color:#4ade80;font-size:13px;margin-bottom:18px;">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus autocomplete="username">
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required autocomplete="current-password">
            </div>

            <div style="display:flex;align-items:center;gap:8px;margin-bottom:22px;">
                <input type="checkbox" name="remember" id="remember" style="accent-color:#a855f7;">
                <label for="remember" style="color:#9ca3af;font-size:13px;">Remember me</label>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-right-to-bracket me-1"></i> Sign In
            </button>
        </form>

        <div class="back-link">
            <a href="{{ route('login') }}"><i class="fas fa-arrow-left me-1"></i> Back to User Login</a>
        </div>
    </div>
</body>
</html>
