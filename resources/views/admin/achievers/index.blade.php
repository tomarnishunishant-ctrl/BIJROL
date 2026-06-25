<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Who's Who | BIJROL Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { margin:0; font-family:Poppins,sans-serif; background:linear-gradient(180deg,#f5fbf7,#fffaf0); color:#132016; }
        .admin-shell { min-height:100vh; display:grid; grid-template-columns:280px minmax(0,1fr); }
        .admin-sidebar { position:sticky; top:0; height:100vh; padding:24px; background:linear-gradient(180deg,#073f2a,#0b2f22); color:#fff; }
        .admin-brand { display:block; padding-bottom:22px; margin-bottom:22px; border-bottom:1px solid rgba(255,255,255,.16); color:#fff; text-decoration:none; }
        .admin-brand strong { display:block; font-size:1.25rem; font-weight:900; }
        .admin-brand span { color:rgba(255,255,255,.72); font-size:.9rem; }
        .admin-nav { display:grid; gap:8px; }
        .admin-nav a,.admin-logout { display:flex; justify-content:space-between; align-items:center; width:100%; min-height:42px; padding:10px 12px; border-radius:8px; border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.08); color:rgba(255,255,255,.9); text-decoration:none; font-size:.92rem; font-weight:750; }
        .admin-logout { margin-top:18px; cursor:pointer; }
        .admin-main { padding:28px; }
        .admin-card { border:1px solid rgba(19,32,22,.12); border-radius:8px; background:#fff; box-shadow:0 18px 48px rgba(19,32,22,.1); padding:24px; margin-bottom:22px; }
        .badge-status { display:inline-block; padding:4px 10px; border-radius:99px; font-size:.75rem; font-weight:800; text-transform:uppercase; }
        .badge-live { background:#dcfce7; color:#166534; }
        .badge-draft { background:#fef3c7; color:#92400e; }
        .person-avatar { width:48px; height:48px; border-radius:50%; display:inline-grid; place-items:center; background:#eef8f2; color:#073f2a; font-weight:900; border:1px solid rgba(19,32,22,.12); object-fit:cover; }
        @media(max-width:900px){.admin-shell{grid-template-columns:1fr}.admin-sidebar{position:static;height:auto}.admin-nav{grid-template-columns:repeat(3,1fr)}}
        @media(max-width:700px){.admin-main,.admin-sidebar{padding:18px}.admin-nav{grid-template-columns:1fr}}
    </style>
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <a class="admin-brand" href="{{ route('admin.dashboard') }}"><strong>BIJROL Admin</strong><span>Website Control Center</span></a>
            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}">Dashboard <span>Home</span></a>
                <a href="{{ route('admin.achievers.index') }}">Who's Who <span>Manage</span></a>
                <a href="{{ route('admin.news.index') }}">News <span>Manage</span></a>
                <a href="{{ route('admin.events.index') }}">Events <span>Manage</span></a>
                <a href="/whos-who">Public Page <span>View</span></a>
            </nav>
            <form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit" class="admin-logout">Logout <span>Exit</span></button></form>
        </aside>

        <main class="admin-main">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h1 class="m-0 fw-bold">Who's Who Profiles</h1>
                        <p class="text-muted mb-0 mt-2">Add, edit, publish, or delete village achievers.</p>
                    </div>
                    <a href="{{ route('admin.achievers.create') }}" class="btn btn-success">+ Add Profile</a>
                </div>
            </div>

            <div class="admin-card p-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th style="width:190px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($achievers as $achiever)
                                <tr>
                                    <td>{{ ($achievers->currentPage() - 1) * $achievers->perPage() + $loop->iteration }}</td>
                                    <td>
                                        @if($achiever->photo)
                                            <img class="person-avatar" src="{{ asset('storage/' . $achiever->photo) }}" alt="{{ $achiever->name }}">
                                        @else
                                            <span class="person-avatar">{{ $achiever->initials }}</span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $achiever->name }}</strong><br><small>{{ $achiever->badge }}</small></td>
                                    <td>{{ $achiever->role }}</td>
                                    <td><a href="/{{ $achiever->slug }}" target="_blank">/{{ $achiever->slug }}</a></td>
                                    <td><span class="badge-status {{ $achiever->is_published ? 'badge-live' : 'badge-draft' }}">{{ $achiever->is_published ? 'Published' : 'Draft' }}</span></td>
                                    <td>{{ $achiever->display_order }}</td>
                                    <td>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <a href="{{ route('admin.achievers.edit', $achiever) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <form method="POST" action="{{ route('admin.achievers.destroy', $achiever) }}" onsubmit="return confirm('Delete this profile?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="text-center text-muted p-4">No profiles yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3">{{ $achievers->links() }}</div>
            </div>
        </main>
    </div>
</body>
</html>
