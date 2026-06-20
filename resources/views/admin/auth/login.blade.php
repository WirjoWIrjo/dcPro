<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - DataCenterPro</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            font-family: 'Inter', sans-serif;
        }
        .login-card {
            background: #fff; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden; max-width: 420px; width: 100%;
        }
        .login-header {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            padding: 2rem; text-align: center; color: #fff;
        }
        .login-header i { font-size: 3rem; margin-bottom: 0.5rem; }
        .login-body { padding: 2rem; }
        .login-body .form-control { border-radius: 8px; padding: 0.75rem 1rem; }
        .login-body .btn-primary { border-radius: 8px; padding: 0.75rem; font-weight: 600; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <i class="bi bi-shield-lock"></i>
            <h4 class="mb-0 fw-bold">Admin Panel</h4>
            <small class="opacity-75">DataCenterPro</small>
        </div>
        <div class="login-body">
            @if (session('error'))
                <div class="alert alert-danger py-2">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success py-2">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required autofocus placeholder="admin@example.com">
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required placeholder="Masukkan password">
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
