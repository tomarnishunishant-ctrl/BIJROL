<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event | BIJROL Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        :root {
            --admin-ink: #132016;
            --admin-muted: #607067;
            --admin-green: #116241;
            --admin-green-dark: #073f2a;
            --admin-line: rgba(19, 32, 22, .12);
            --admin-shadow: 0 18px 48px rgba(19, 32, 22, .1);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #f5fbf7 0%, #fffaf0 100%);
            color: var(--admin-ink);
        }
        .admin-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 280px minmax(0, 1fr);
        }
        .admin-sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            padding: 24px;
            background: linear-gradient(180deg, var(--admin-green-dark), #0b2f22);
            color: #fff;
        }
        .admin-brand {
            display: block;
            padding-bottom: 22px;
            margin-bottom: 22px;
            border-bottom: 1px solid rgba(255, 255, 255, .16);
            color: #fff;
            text-decoration: none;
        }
        .admin-brand strong {
            display: block;
            font-size: 1.25rem;
            font-weight: 950;
        }
        .admin-brand span {
            color: rgba(255, 255, 255, .72);
            font-size: .9rem;
            font-weight: 600;
        }
        .admin-nav {
            display: grid;
            gap: 8px;
        }
        .admin-nav a,
        .admin-logout {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            min-height: 42px;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, .12);
            background: rgba(255, 255, 255, .08);
            color: rgba(255, 255, 255, .9);
            text-decoration: none;
            font-size: .92rem;
            font-weight: 750;
        }
        .admin-nav a:hover,
        .admin-logout:hover {
            background: rgba(255, 255, 255, .16);
            color: #fff;
        }
        .admin-logout {
            margin-top: 18px;
            cursor: pointer;
        }
        .admin-main {
            padding: 28px;
        }
        .admin-card {
            border: 1px solid var(--admin-line);
            border-radius: 8px;
            background: #fff;
            box-shadow: var(--admin-shadow);
            padding: 28px;
            max-width: 900px;
        }
        .admin-card h1 {
            margin: 0 0 22px;
            font-size: 1.6rem;
            font-weight: 950;
        }
        .form-label {
            font-weight: 800;
            color: var(--admin-ink);
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #d6e1da;
            min-height: 46px;
        }
        .form-control:focus {
            border-color: var(--admin-green);
            box-shadow: 0 0 0 .2rem rgba(17, 98, 65, .13);
        }
        textarea.form-control {
            min-height: 160px;
            resize: vertical;
        }
        .btn-submit {
            min-height: 46px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--admin-green), var(--admin-green-dark));
            border: 0;
            color: #fff;
            font-weight: 950;
            padding: 10px 22px;
        }
        .btn-submit:hover {
            color: #fff;
            background: linear-gradient(135deg, #052d1f, #0a3326);
        }
        .btn-cancel {
            min-height: 46px;
            border-radius: 8px;
            border: 1px solid var(--admin-line);
            color: var(--admin-ink);
            font-weight: 800;
            padding: 10px 22px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-cancel:hover {
            background: #f5fbf7;
            color: var(--admin-ink);
        }
        @media (max-width: 900px) {
            .admin-shell {
                grid-template-columns: 1fr;
            }
            .admin-sidebar {
                position: static;
                height: auto;
            }
            .admin-nav {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        @media (max-width: 700px) {
            .admin-main,
            .admin-sidebar {
                padding: 18px;
            }
            .admin-nav {
                grid-template-columns: 1fr;
            }
            .admin-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <a class="admin-brand" href="{{ route('admin.dashboard') }}">
                <strong>BIJROL Admin</strong>
                <span>Website Control Center</span>
            </a>
            <nav class="admin-nav" aria-label="Admin navigation">
                <a href="{{ route('admin.dashboard') }}">Dashboard <span>Home</span></a>
                <a href="{{ route('admin.news.index') }}">News <span>Manage</span></a>
                <a href="{{ route('admin.events.index') }}">Events <span>Manage</span></a>
                <a href="{{ url('/village-voice') }}">Village Voice <span>Control</span></a>
                <a href="{{ url('/government-employees') }}">Employees <span>Manage</span></a>
                <a href="{{ url('/') }}">Public Website <span>View</span></a>
            </nav>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="admin-logout">Logout <span>Exit</span></button>
            </form>
        </aside>

        <main class="admin-main">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="admin-card">
                <h1>Edit Event</h1>

                <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $event->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description', $event->description) }}</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="event_date" class="form-label">Event Date</label>
                            <input type="date" class="form-control" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $event->location) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        @if($event->image)
                            <div style="margin-top: 10px;">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="Current image" style="max-height: 120px; border-radius: 6px; border: 1px solid var(--admin-line);">
                            </div>
                        @endif
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" @if(old('is_featured', $event->is_featured)) checked @endif>
                                <label class="form-check-label" for="is_featured">Featured event</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1" @if(old('is_published', $event->is_published)) checked @endif>
                                <label class="form-check-label" for="is_published">Published</label>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex; gap: 10px; flex-wrap: wrap;">
                        <button type="submit" class="btn btn-submit">Update Event</button>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
