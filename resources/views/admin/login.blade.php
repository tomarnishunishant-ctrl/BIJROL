<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | BIJROL Village</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        :root {
            --login-ink: #111827;
            --login-muted: #667085;
            --login-line: rgba(17, 24, 39, .12);
            --login-green: #0f6b45;
            --login-green-dark: #053324;
            --login-blue: #1d4ed8;
            --login-gold: #f5b83d;
            --login-panel: rgba(255, 255, 255, .88);
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 28px;
            font-family: 'Poppins', sans-serif;
            background:
                linear-gradient(135deg, rgba(5, 26, 24, .9), rgba(12, 57, 66, .68)),
                url('{{ asset('image/bijrol.jpg.png') }}') center/cover no-repeat fixed;
            color: var(--login-ink);
        }

        .login-shell {
            width: min(100%, 1080px);
            display: grid;
            grid-template-columns: minmax(0, 1.08fr) 430px;
            min-height: 640px;
            overflow: hidden;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, .24);
            background: var(--login-panel);
            box-shadow: 0 30px 100px rgba(0, 0, 0, .34);
            backdrop-filter: blur(18px);
        }

        .login-intro {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 44px;
            background:
                linear-gradient(145deg, rgba(5, 51, 36, .96), rgba(15, 107, 69, .88)),
                url('{{ asset('image/vil.jpg.png') }}') center/cover no-repeat;
            color: #fff;
        }

        .login-intro::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(3, 16, 14, .42) 100%);
            pointer-events: none;
        }

        .login-intro > * {
            position: relative;
            z-index: 1;
        }

        .login-kicker {
            display: inline-flex;
            align-items: center;
            width: max-content;
            min-height: 34px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .14);
            color: #ffe7a6;
            font-size: .78rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0;
        }

        .login-intro h1 {
            max-width: 540px;
            margin: 22px 0 14px;
            font-size: clamp(2.4rem, 5vw, 4.35rem);
            line-height: 1.02;
            font-weight: 950;
            letter-spacing: 0;
        }

        .login-intro p {
            max-width: 500px;
            margin: 0;
            color: rgba(255, 255, 255, .82);
            line-height: 1.75;
        }

        .login-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 34px;
        }

        .login-metric {
            min-height: 86px;
            padding: 14px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, .16);
            background: rgba(255, 255, 255, .1);
        }

        .login-metric strong {
            display: block;
            font-size: 1.35rem;
            font-weight: 950;
        }

        .login-metric span {
            color: rgba(255, 255, 255, .72);
            font-size: .78rem;
            font-weight: 700;
        }

        .login-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 42px;
            background: rgba(255, 255, 255, .95);
        }

        .login-card h2 {
            margin: 0 0 8px;
            color: var(--login-ink);
            font-size: 1.72rem;
            font-weight: 950;
        }

        .login-card p {
            margin: 0 0 26px;
            color: var(--login-muted);
            line-height: 1.65;
        }

        .form-label {
            color: var(--login-ink);
            font-size: .9rem;
            font-weight: 850;
        }

        .form-control {
            min-height: 50px;
            border-radius: 8px;
            border: 1px solid var(--login-line);
            padding: 12px 13px;
            background: #f8fafc;
            font-weight: 600;
        }

        .form-control:focus {
            border-color: var(--login-green);
            background: #fff;
            box-shadow: 0 0 0 .22rem rgba(15, 107, 69, .14);
        }

        .login-options {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin: -8px 0 22px;
        }

        .forgot-link,
        .back-link {
            color: var(--login-green);
            font-weight: 850;
            text-decoration: none;
        }

        .forgot-link:hover,
        .back-link:hover {
            color: var(--login-blue);
        }

        .btn-admin-login {
            min-height: 52px;
            border: 0;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--login-green), var(--login-blue));
            color: #fff;
            font-weight: 950;
            box-shadow: 0 14px 28px rgba(15, 107, 69, .23);
        }

        .btn-admin-login:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 18px 34px rgba(29, 78, 216, .24);
        }

        .login-footer {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: center;
            margin-top: 22px;
            padding-top: 20px;
            border-top: 1px solid var(--login-line);
            color: var(--login-muted);
            font-size: .84rem;
            font-weight: 700;
        }

        .alert {
            border-radius: 8px;
            font-weight: 750;
        }

        @media (max-width: 880px) {
            body { padding: 16px; }

            .login-shell {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .login-intro,
            .login-card {
                padding: 28px;
            }

            .login-metrics {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 520px) {
            .login-footer {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <section class="login-intro">
            <div>
                <span class="login-kicker">BIJROL Admin</span>
                <h1>Premium Control Center</h1>
                <p>Manage news, events, village suggestions, clinics, profiles, and public records from a sharper secure workspace.</p>
            </div>

            <div class="login-metrics" aria-label="Admin capabilities">
                <div class="login-metric">
                    <strong>24/7</strong>
                    <span>Portal access</span>
                </div>
                <div class="login-metric">
                    <strong>Live</strong>
                    <span>Content control</span>
                </div>
                <div class="login-metric">
                    <strong>Safe</strong>
                    <span>Admin session</span>
                </div>
            </div>
        </section>

        <section class="login-card">
            <h2>Admin Login</h2>
            <p>Sign in to update BIJROL village website content and review public submissions.</p>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ url('/admin/login') }}">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Enter username">
                    @error('username')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" placeholder="Enter password">
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="login-options">
                    <a class="forgot-link" href="{{ route('admin.password.request') }}">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-admin-login w-100">Login Securely</button>
            </form>

            <div class="login-footer">
                <span>Protected admin area</span>
                <a class="back-link" href="{{ url('/') }}">Back to Website</a>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
