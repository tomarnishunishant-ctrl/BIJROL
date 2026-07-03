<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | BIJROL Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        :root {
            --ink: #111827;
            --muted: #667085;
            --line: rgba(17, 24, 39, .12);
            --green: #0f6b45;
            --blue: #1d4ed8;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 24px;
            font-family: 'Poppins', sans-serif;
            background:
                linear-gradient(135deg, rgba(5, 26, 24, .88), rgba(29, 78, 216, .56)),
                url('{{ asset('image/vil.jpg.png') }}') center/cover no-repeat fixed;
            color: var(--ink);
        }

        .recovery-card {
            width: min(100%, 520px);
            padding: 36px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, .34);
            background: rgba(255, 255, 255, .94);
            box-shadow: 0 28px 80px rgba(0, 0, 0, .28);
            backdrop-filter: blur(16px);
        }

        .recovery-kicker {
            display: inline-flex;
            min-height: 32px;
            align-items: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: #ecfdf5;
            color: var(--green);
            font-size: .78rem;
            font-weight: 900;
            text-transform: uppercase;
        }

        h1 {
            margin: 18px 0 10px;
            font-size: clamp(1.9rem, 5vw, 2.7rem);
            font-weight: 950;
            letter-spacing: 0;
        }

        p {
            margin: 0 0 24px;
            color: var(--muted);
            line-height: 1.7;
        }

        .form-label {
            color: var(--ink);
            font-weight: 850;
        }

        .form-control {
            min-height: 50px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: #f8fafc;
            font-weight: 600;
        }

        .form-control:focus {
            border-color: var(--green);
            background: #fff;
            box-shadow: 0 0 0 .22rem rgba(15, 107, 69, .14);
        }

        .btn-recovery {
            min-height: 52px;
            border: 0;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--green), var(--blue));
            color: #fff;
            font-weight: 950;
        }

        .btn-recovery:hover {
            color: #fff;
            transform: translateY(-1px);
        }

        .recovery-actions {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--line);
        }

        .recovery-actions a {
            color: var(--green);
            font-weight: 850;
            text-decoration: none;
        }

        .recovery-actions a:hover {
            color: var(--blue);
        }

        .alert {
            border-radius: 8px;
            font-weight: 750;
        }
    </style>
</head>
<body>
    <main class="recovery-card">
        <span class="recovery-kicker">Password Assistance</span>
        <h1>Recover Admin Access</h1>
        <p>Enter the registered admin email. On this local website setup, a secure reset link will appear after request generation.</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('reset_link'))
            <div class="alert alert-info">
                <strong>Reset link:</strong>
                <a href="{{ session('reset_link') }}">{{ session('reset_link') }}</a>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Admin Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="admin@bijrol.local">
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-recovery w-100">Request Password Help</button>
        </form>

        <div class="recovery-actions">
            <a href="{{ route('admin.login') }}">Back to Login</a>
            <a href="{{ url('/') }}">Public Website</a>
        </div>
    </main>
</body>
</html>
