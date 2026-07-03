<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | BIJROL Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        :root { --ink:#111827; --muted:#667085; --line:rgba(17,24,39,.12); --green:#0f6b45; --blue:#1d4ed8; }
        * { box-sizing: border-box; }
        body { min-height:100vh; margin:0; display:grid; place-items:center; padding:24px; font-family:'Poppins',sans-serif; background:linear-gradient(135deg,rgba(5,26,24,.88),rgba(29,78,216,.56)),url('{{ asset('image/vil.jpg.png') }}') center/cover no-repeat fixed; color:var(--ink); }
        .reset-card { width:min(100%,520px); padding:36px; border-radius:8px; border:1px solid rgba(255,255,255,.34); background:rgba(255,255,255,.94); box-shadow:0 28px 80px rgba(0,0,0,.28); backdrop-filter:blur(16px); }
        .reset-kicker { display:inline-flex; min-height:32px; align-items:center; padding:7px 12px; border-radius:999px; background:#ecfdf5; color:var(--green); font-size:.78rem; font-weight:900; text-transform:uppercase; }
        h1 { margin:18px 0 10px; font-size:clamp(1.9rem,5vw,2.7rem); font-weight:950; letter-spacing:0; }
        p { margin:0 0 24px; color:var(--muted); line-height:1.7; }
        .form-label { color:var(--ink); font-weight:850; }
        .form-control { min-height:50px; border-radius:8px; border:1px solid var(--line); background:#f8fafc; font-weight:600; }
        .form-control:focus { border-color:var(--green); background:#fff; box-shadow:0 0 0 .22rem rgba(15,107,69,.14); }
        .btn-reset { min-height:52px; border:0; border-radius:8px; background:linear-gradient(135deg,var(--green),var(--blue)); color:#fff; font-weight:950; }
        .btn-reset:hover { color:#fff; transform:translateY(-1px); }
        .back-link { display:inline-flex; margin-top:18px; color:var(--green); font-weight:850; text-decoration:none; }
        .back-link:hover { color:var(--blue); }
        .alert { border-radius:8px; font-weight:750; }
    </style>
</head>
<body>
    <main class="reset-card">
        <span class="reset-kicker">Secure Reset</span>
        <h1>Set New Password</h1>
        <p>Create a stronger admin password with at least 8 characters.</p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label for="email" class="form-label">Admin Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $email) }}" required autocomplete="email">
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-reset w-100">Reset Password</button>
        </form>

        <a class="back-link" href="{{ route('admin.login') }}">Back to Login</a>
    </main>
</body>
</html>
