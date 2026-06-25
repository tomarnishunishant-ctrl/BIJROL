<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | BIJROL Village</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --login-green: #073f2a;
            --login-green-2: #116241;
            --login-gold: #facc15;
            --login-ink: #132016;
            --login-muted: #607067;
            --login-line: rgba(19, 32, 22, .12);
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 24px;
            font-family: 'Poppins', sans-serif;
            background:
                linear-gradient(90deg, rgba(3, 31, 20, .92), rgba(3, 31, 20, .62)),
                url('{{ asset('image/bijrol.jpg.png') }}') center/cover no-repeat;
            color: var(--login-ink);
        }

        .login-shell {
            width: min(100%, 980px);
            display: grid;
            grid-template-columns: minmax(0, 1fr) 430px;
            overflow: hidden;
            border-radius: 8px;
            background: #fff;
            border: 1px solid rgba(255, 255, 255, .2);
            box-shadow: 0 28px 90px rgba(0, 0, 0, .32);
        }

        .login-intro {
            padding: 42px;
            background: linear-gradient(180deg, var(--login-green), #0b2f22);
            color: #fff;
        }

        .login-intro span {
            display: inline-flex;
            margin-bottom: 18px;
            color: var(--login-gold);
            font-weight: 900;
            text-transform: uppercase;
        }

        .login-intro h1 {
            margin: 0 0 12px;
            font-size: clamp(2.1rem, 5vw, 3.8rem);
            line-height: 1.02;
            font-weight: 950;
        }

        .login-intro p {
            max-width: 430px;
            margin: 0;
            color: rgba(255, 255, 255, .78);
            line-height: 1.75;
        }

        .login-card {
            padding: 42px;
            background: #fff;
        }

        .login-card h2 {
            margin: 0 0 8px;
            color: var(--login-ink);
            font-size: 1.65rem;
            font-weight: 950;
        }

        .login-card p {
            margin: 0 0 24px;
            color: var(--login-muted);
        }

        .form-label {
            color: var(--login-ink);
            font-weight: 850;
        }

        .form-control {
            min-height: 48px;
            border-radius: 8px;
            border: 1px solid var(--login-line);
            padding: 12px 13px;
        }

        .form-control:focus {
            border-color: var(--login-green-2);
            box-shadow: 0 0 0 .2rem rgba(17, 98, 65, .13);
        }

        .btn-admin-login {
            min-height: 50px;
            border: 0;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--login-green), var(--login-green-2));
            color: #fff;
            font-weight: 950;
        }

        .btn-admin-login:hover {
            color: #fff;
            background: linear-gradient(135deg, #052d1f, #0f5539);
        }

        .back-link {
            display: inline-flex;
            margin-top: 18px;
            color: var(--login-green-2);
            font-weight: 800;
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--login-green);
        }

        @media (max-width: 820px) {
            .login-shell {
                grid-template-columns: 1fr;
            }

            .login-intro,
            .login-card {
                padding: 28px;
            }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <section class="login-intro">
            <span>BIJROL Admin</span>
            <h1>Website Control Center</h1>
            <p>Login to manage Village Voice submissions, public records, section shortcuts, and important website information.</p>
        </section>

        <section class="login-card">
            <h2>Admin Login</h2>
            <p>Enter your admin credentials to continue.</p>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="/admin/login">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required autocomplete="username" placeholder="Enter username">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" placeholder="Enter password">
                </div>
                <button type="submit" class="btn btn-admin-login w-100">Login</button>
            </form>

            <a class="back-link" href="/">Back to Website</a>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
