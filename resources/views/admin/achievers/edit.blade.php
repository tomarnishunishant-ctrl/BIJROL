<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Who's Who Profile | BIJROL Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        body { font-family:Poppins,sans-serif; background:linear-gradient(180deg,#f5fbf7,#fffaf0); color:#132016; }
        .admin-wrap { width:min(980px,calc(100% - 28px)); margin:32px auto; }
        .admin-card { border:1px solid rgba(19,32,22,.12); border-radius:8px; background:#fff; box-shadow:0 18px 48px rgba(19,32,22,.1); padding:24px; }
        label { font-weight:800; }
        .help { color:#607067; font-size:.86rem; margin-top:5px; }
    </style>
</head>
<body>
    <main class="admin-wrap">
        <div class="admin-card mb-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h1 class="fw-bold mb-1">Edit {{ $achiever->name }}</h1>
                    <p class="text-muted mb-0">Profile content ko admin se update karein.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ url('/' . $achiever->slug) }}" target="_blank" class="btn btn-outline-success">View</a>
                    <a href="{{ route('admin.achievers.index') }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger"><strong>Please fix:</strong> {{ $errors->first() }}</div>
        @endif

        <form class="admin-card" method="POST" action="{{ route('admin.achievers.update', $achiever) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.achievers.form', ['achiever' => $achiever])
        </form>
    </main>
</body>
</html>
