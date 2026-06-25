<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events | BIJROL Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-ink: #132016;
            --admin-muted: #607067;
            --admin-green: #116241;
            --admin-green-dark: #073f2a;
            --admin-blue: #2563eb;
            --admin-gold: #d97706;
            --admin-bg: #f5fbf7;
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
            padding: 24px;
            margin-bottom: 22px;
        }
        .admin-card h1 {
            margin: 0 0 18px;
            font-size: 1.6rem;
            font-weight: 950;
        }
        .badge-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 99px;
            font-size: .78rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .badge-featured {
            background: #fef3c7;
            color: #92400e;
        }
        .badge-normal {
            background: #e0f2fe;
            color: #075985;
        }
        .table-img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--admin-line);
        }
        .empty-state {
            padding: 32px;
            text-align: center;
            color: var(--admin-muted);
            font-weight: 750;
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
                <a href="#voice">Village Voice <span>Control</span></a>
                <a href="#employees">Employees <span>Manage</span></a>
                <a href="/">Public Website <span>View</span></a>
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
                <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                    <h1>Events</h1>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-success">+ Add New Event</a>
                </div>
                <p style="color: var(--admin-muted); margin-top: 6px;">Manage village events, programs, and gatherings.</p>
            </div>

            <div class="admin-card" style="padding: 0; overflow: hidden;">
                @if($events->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th style="width: 180px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ ($events->currentPage() - 1) * $events->perPage() + $loop->iteration }}</td>
                                        <td>
                                            @if($event->image)
                                                <img class="table-img" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                                            @else
                                                <span style="display:inline-flex; width:48px; height:48px; align-items:center; justify-content:center; background:#f1f5f9; color:#64748b; border-radius:6px; font-weight:800; font-size:.8rem;">N/A</span>
                                            @endif
                                        </td>
                                        <td><strong>{{ $event->title }}</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</td>
                                        <td>{{ $event->location ?: '-' }}</td>
                                        <td>
                                            @if($event->is_published)
                                                <span class="badge-status" style="background:#dcfce7;color:#166534;">Live</span>
                                            @else
                                                <span class="badge-status" style="background:#fef3c7;color:#92400e;">Draft</span>
                                            @endif
                                            @if($event->is_featured)
                                                <span class="badge-status badge-featured" style="margin-left:4px;">Featured</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Delete this event?');" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="padding: 14px;">
                        {{ $events->links() }}
                    </div>
                @else
                    <div class="empty-state">No events yet. Click "Add New Event" to create one.</div>
                @endif
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
