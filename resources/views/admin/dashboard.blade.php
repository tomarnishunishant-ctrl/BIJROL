<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | BIJROL</title>
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

        .admin-hero,
        .admin-card,
        .admin-table-card {
            border: 1px solid var(--admin-line);
            border-radius: 8px;
            background: #fff;
            box-shadow: var(--admin-shadow);
        }

        .admin-hero {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
            padding: 26px;
            margin-bottom: 22px;
            background:
                linear-gradient(135deg, rgba(17, 98, 65, .96), rgba(37, 99, 235, .84)),
                url('{{ asset('image/vil.jpg.png') }}') center/cover no-repeat;
            color: #fff;
        }

        .admin-hero h1 {
            margin: 0 0 8px;
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 950;
            letter-spacing: 0;
        }

        .admin-hero p {
            max-width: 720px;
            margin: 0;
            color: rgba(255, 255, 255, .88);
            line-height: 1.7;
        }

        .admin-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-end;
        }

        .admin-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 9px 14px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, .28);
            color: #fff;
            text-decoration: none;
            font-weight: 850;
            background: rgba(255, 255, 255, .14);
        }

        .admin-btn:hover {
            color: #fff;
            background: rgba(255, 255, 255, .22);
        }

        .admin-alert {
            border-radius: 8px;
            border: 1px solid #bbf7d0;
            background: #ecfdf5;
            color: #065f46;
            padding: 14px 16px;
            margin-bottom: 20px;
            font-weight: 800;
        }

        .admin-stats {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 22px;
        }

        .admin-card {
            padding: 20px;
        }

        .admin-card small {
            display: block;
            margin-bottom: 8px;
            color: var(--admin-muted);
            font-weight: 850;
            text-transform: uppercase;
        }

        .admin-card strong {
            display: block;
            color: var(--admin-green-dark);
            font-size: 2rem;
            line-height: 1;
            font-weight: 950;
        }

        .admin-section-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 22px;
        }

        .section-link {
            min-height: 96px;
            padding: 16px;
            border: 1px solid var(--admin-line);
            border-radius: 8px;
            background: #fff;
            color: var(--admin-ink);
            text-decoration: none;
            box-shadow: 0 10px 24px rgba(19, 32, 22, .06);
        }

        .section-link:hover {
            border-color: rgba(17, 98, 65, .34);
            color: var(--admin-green-dark);
        }

        .section-link strong {
            display: block;
            margin-bottom: 6px;
            font-weight: 900;
        }

        .section-link span {
            color: var(--admin-muted);
            font-size: .86rem;
            line-height: 1.55;
        }

        .admin-table-card {
            margin-bottom: 24px;
            overflow: hidden;
        }

        .admin-table-head {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: center;
            padding: 22px;
            border-bottom: 1px solid var(--admin-line);
            background: #fbfefc;
        }

        .admin-table-head h2 {
            margin: 0 0 6px;
            font-size: 1.35rem;
            font-weight: 950;
        }

        .admin-table-head p {
            margin: 0;
            color: var(--admin-muted);
            line-height: 1.65;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border: 0;
            background: var(--admin-green-dark);
            color: #fff;
            font-size: .84rem;
            white-space: nowrap;
        }

        .table td,
        .table th {
            vertical-align: middle;
            padding: 13px;
        }

        .table td {
            color: var(--admin-ink);
        }

        .message-preview {
            max-width: 420px;
            color: var(--admin-muted);
            font-size: .86rem;
            line-height: 1.55;
        }

        .status-form {
            display: grid;
            gap: 9px;
            min-width: 190px;
        }

        .status-form select {
            border-radius: 8px;
            border: 1px solid #d6e1da;
            padding: 8px 10px;
            font-size: .9rem;
        }

        .public-check {
            display: flex;
            gap: 7px;
            align-items: center;
            color: var(--admin-muted);
            font-size: .84rem;
            font-weight: 750;
        }

        .public-check input {
            accent-color: var(--admin-green);
        }

        .employee-photo {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #d6e1da;
            background: #f1f5f9;
        }

        .employee-initial {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eef8f2;
            color: var(--admin-green-dark);
            font-weight: 950;
            border: 2px solid #d6e1da;
        }

        .empty-state {
            padding: 24px;
            color: var(--admin-muted);
            font-weight: 750;
        }

        @media (max-width: 1400px) {
            .admin-stats {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 1180px) {
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

            .admin-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .admin-stats + div,
            .admin-section-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            .admin-stats + div {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .admin-main,
            .admin-sidebar {
                padding: 18px;
            }

            .admin-hero,
            .admin-table-head {
                align-items: flex-start;
                flex-direction: column;
            }

            .admin-actions {
                justify-content: flex-start;
            }

            .admin-nav,
            .admin-stats,
            .admin-section-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @php
        $sections = [
            ['title' => 'Home', 'text' => 'Main landing page preview.', 'href' => '/'],
            ['title' => 'About BIJROL', 'text' => 'History, heritage, and village profile.', 'href' => '/about'],
            ['title' => 'Gallery', 'text' => 'Village photos and public visuals.', 'href' => '/gallery'],
            ['title' => 'Government Employees', 'text' => 'Add or review public employee data.', 'href' => '/government-employees'],
            ['title' => 'Village Voice', 'text' => 'Public suggestions and issues.', 'href' => '/village-voice'],
            ['title' => 'Schools', 'text' => 'Education facilities page.', 'href' => '/schools'],
            ['title' => 'Temples', 'text' => 'Religious and cultural places.', 'href' => '/temples'],
            ['title' => 'Healthcare', 'text' => 'Hospitals and care facilities.', 'href' => '/hospitals'],
            ['title' => 'Clinic Management', 'text' => 'Add or update village clinics.', 'href' => route('admin.clinics.index')],
        ];

        $statuses = [
            'pending' => 'Pending',
            'reviewed' => 'Reviewed',
            'in_progress' => 'In Progress',
            'resolved' => 'Resolved',
        ];

        $statusColors = [
            'pending' => ['bg' => '#fef3c7', 'color' => '#92400e'],
            'reviewed' => ['bg' => '#e0f2fe', 'color' => '#075985'],
            'in_progress' => ['bg' => '#f3e8ff', 'color' => '#6b21a8'],
            'resolved' => ['bg' => '#dcfce7', 'color' => '#166534'],
        ];
    @endphp

    <div class="admin-shell">
        <aside class="admin-sidebar">
            <a class="admin-brand" href="{{ route('admin.dashboard') }}">
                <strong>BIJROL Admin</strong>
                <span>Website Control Center</span>
            </a>

            <nav class="admin-nav" aria-label="Admin navigation">
                <a href="#overview">Overview <span>Stats</span></a>
                <a href="{{ route('admin.news.index') }}">News <span>Articles</span></a>
                <a href="{{ route('admin.events.index') }}">Events <span>Programs</span></a>
                <a href="{{ route('admin.achievers.index') }}">Who's Who <span>Profiles</span></a>
                <a href="{{ route('admin.clinics.index') }}">Clinics <span>Manage</span></a>
                <a href="#sections">Sections <span>Open</span></a>
                <a href="#voice">Village Voice <span>Control</span></a>
                <a href="#employees">Employees <span>Manage</span></a>
                <a href="{{ url('/') }}">Public Website <span>View</span></a>
                <a href="{{ url('/contact') }}">Contact Page <span>View</span></a>
            </nav>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="admin-logout">Logout <span>Exit</span></button>
            </form>
        </aside>

        <main class="admin-main">
            <section class="admin-hero">
                <div>
                    <h1>Admin Dashboard</h1>
                    <p>Manage important BIJROL website areas from one place: suggestions, visibility, statuses, employee entries, and public section access.</p>
                </div>
                <div class="admin-actions">
                    <a class="admin-btn" href="{{ route('admin.news.create') }}">+ New Article</a>
                    <a class="admin-btn" href="{{ route('admin.events.create') }}">+ New Event</a>
                    <a class="admin-btn" href="{{ route('admin.achievers.create') }}">+ New Profile</a>
                    <a class="admin-btn" href="{{ route('admin.clinics.create') }}">+ New Clinic</a>
                    <a class="admin-btn" href="{{ url('/village-voice') }}">Open Village Voice</a>
                    <a class="admin-btn" href="{{ url('/government-employees') }}">Add Employee</a>
                </div>
            </section>

            @if(session('success'))
                <div class="admin-alert">{{ session('success') }}</div>
            @endif

            <section class="admin-stats" id="overview" aria-label="Website overview">
                <div class="admin-card">
                    <small>Total Suggestions</small>
                    <strong>{{ $stats['suggestions'] }}</strong>
                </div>
                <div class="admin-card">
                    <small>Pending Suggestions</small>
                    <strong>{{ $stats['pendingSuggestions'] }}</strong>
                </div>
                <div class="admin-card">
                    <small>Public Voices</small>
                    <strong>{{ $stats['publicSuggestions'] }}</strong>
                </div>
                <div class="admin-card">
                    <small>Employees</small>
                    <strong>{{ $stats['employees'] }}</strong>
                </div>
                <div class="admin-card">
                    <small>News Articles</small>
                    <strong>{{ $stats['news'] }}</strong>
                    <span style="font-size:.8rem; color: var(--admin-muted);">{{ $stats['publishedNews'] }} published</span>
                </div>
                <div class="admin-card">
                    <small>Upcoming Events</small>
                    <strong>{{ $stats['upcomingEvents'] }}</strong>
                    <span style="font-size:.8rem; color: var(--admin-muted);">{{ $stats['events'] }} total</span>
                </div>
                <div class="admin-card">
                    <small>Who's Who Profiles</small>
                    <strong>{{ $stats['achievers'] }}</strong>
                    <span style="font-size:.8rem; color: var(--admin-muted);">{{ $stats['publishedAchievers'] }} published</span>
                </div>
                <div class="admin-card">
                    <small>Clinics</small>
                    <strong>{{ $stats['clinics'] }}</strong>
                    <span style="font-size:.8rem; color: var(--admin-muted);">{{ $stats['publishedClinics'] }} live</span>
                </div>
            </section>

            <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 22px; margin-bottom: 22px;">
                <section class="admin-table-card" aria-label="Latest news">
                    <div class="admin-table-head">
                        <div>
                            <h2>Latest News</h2>
                            <p>Recently published articles.</p>
                        </div>
                        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-success btn-sm">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestNews as $item)
                                    <tr>
                                        <td><strong>{{ $item->title }}</strong></td>
                                        <td>
                                            @if($item->is_published)
                                                <span class="badge-status" style="background:#dcfce7;color:#166534;">Published</span>
                                            @else
                                                <span class="badge-status" style="background:#fef3c7;color:#92400e;">Draft</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->published_at ? $item->published_at->format('M d, Y') : $item->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="admin-table-card" aria-label="Upcoming events">
                    <div class="admin-table-head">
                        <div>
                            <h2>Upcoming Events</h2>
                            <p>Scheduled events and programs.</p>
                        </div>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-success btn-sm">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestEvents as $event)
                                    <tr>
                                        <td><strong>{{ $event->title }}</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</td>
                                        <td>
                                            @if($event->is_published)
                                                <span class="badge-status" style="background:#dcfce7;color:#166534;">Live</span>
                                            @else
                                                <span class="badge-status" style="background:#fef3c7;color:#92400e;">Draft</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <section id="sections" class="admin-section-grid" aria-label="Website section shortcuts">
                @foreach($sections as $section)
                    <a class="section-link" href="{{ $section['href'] }}">
                        <strong>{{ $section['title'] }}</strong>
                        <span>{{ $section['text'] }}</span>
                    </a>
                @endforeach
            </section>

            <section class="admin-table-card" id="voice">
                <div class="admin-table-head">
                    <div>
                        <h2>Village Voice Control</h2>
                        <p>Review submissions, change status, hide/show public visibility, or delete entries.</p>
                    </div>
                    <a href="{{ url('/village-voice') }}" class="btn btn-outline-success btn-sm">Public Page</a>
                </div>

                @if($villageSuggestions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Submission</th>
                                    <th>Category</th>
                                    <th>Area</th>
                                    <th>Person</th>
                                    <th>Contact</th>
                                    <th>Status / Public</th>
                                    <th style="width: 110px;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($villageSuggestions as $suggestion)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $suggestion->title }}</strong>
                                            <div class="message-preview mt-1">{{ \Illuminate\Support\Str::limit($suggestion->message, 150) }}</div>
                                            <div class="text-muted small mt-2">{{ $suggestion->created_at->format('M d, Y h:i A') }}</div>
                                        </td>
                                        <td>{{ $suggestion->category }}</td>
                                        <td>{{ $suggestion->area ?: '-' }}</td>
                                        <td>{{ $suggestion->name ?: 'Anonymous' }}</td>
                                        <td>{{ $suggestion->phone ?: '-' }}</td>
                                        <td>
                                            <form class="status-form" method="POST" action="{{ route('admin.village-suggestions.update', $suggestion) }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" aria-label="Suggestion status">
                                                    @foreach($statuses as $value => $label)
                                                        <option value="{{ $value }}" @selected($suggestion->status === $value)>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                <label class="public-check">
                                                    <input type="checkbox" name="is_public" value="1" @checked($suggestion->is_public)>
                                                    Show publicly
                                                </label>
                                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.village-suggestions.destroy', $suggestion) }}" onsubmit="return confirm('Delete this suggestion?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">No Village Voice submissions yet.</div>
                @endif
            </section>

            <section class="admin-table-card" id="employees">
                <div class="admin-table-head">
                    <div>
                        <h2>Government Employees</h2>
                        <p>Review uploaded employee information and remove outdated records.</p>
                    </div>
                    <a href="{{ url('/government-employees') }}" class="btn btn-outline-primary btn-sm">Add Employee</a>
                </div>

                @if($governmentEmployees->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th style="width: 82px;">Photo</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Currently Posting</th>
                                    <th>Added</th>
                                    <th style="width: 110px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($governmentEmployees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($employee->photo)
                                                <img class="employee-photo" src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}">
                                            @else
                                                <span class="employee-initial">{{ strtoupper(substr($employee->name, 0, 1)) }}</span>
                                            @endif
                                        </td>
                                        <td><strong>{{ $employee->name }}</strong></td>
                                        <td>{{ $employee->department ?: '-' }}</td>
                                        <td>{{ $employee->designation }}</td>
                                        <td>{{ $employee->currently_posting ?: '-' }}</td>
                                        <td>{{ $employee->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.government-employees.destroy', $employee) }}" onsubmit="return confirm('Delete this employee?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">No government employee information added yet.</div>
                @endif
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
