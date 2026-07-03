@extends('layouts.app')

@section('title', 'Government Employees | BIJROL Village')

@push('styles')
<style>
.employees-page {
    --ge-ink: #102033;
    --ge-muted: #647386;
    --ge-green: #0f6b47;
    --ge-green-dark: #073923;
    --ge-blue: #2459b8;
    --ge-saffron: #d98516;
    --ge-bg: #f4f8f5;
    --ge-panel: rgba(255, 255, 255, .92);
    --ge-line: rgba(16, 32, 51, .12);
    --ge-shadow: 0 22px 62px rgba(16, 32, 51, .12);
    background:
        radial-gradient(circle at 14% 10%, rgba(15, 107, 71, .18), transparent 28%),
        radial-gradient(circle at 88% 16%, rgba(36, 89, 184, .12), transparent 28%),
        linear-gradient(180deg, #f8fbf6 0%, var(--ge-bg) 48%, #fffdf8 100%);
    color: var(--ge-ink);
}

.employees-hero {
    position: relative;
    min-height: calc(100vh - 92px);
    display: grid;
    align-items: center;
    padding: 68px 0 44px;
    overflow: hidden;
    isolation: isolate;
}

.employees-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -2;
    background: url('{{ asset('image/h4.jpeg') }}') center/cover no-repeat;
    opacity: .25;
}

.employees-hero::after {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -1;
    background:
        linear-gradient(90deg, rgba(244, 248, 245, .98) 0%, rgba(244, 248, 245, .88) 48%, rgba(244, 248, 245, .64) 100%),
        linear-gradient(180deg, rgba(255,255,255,.08) 0%, var(--ge-bg) 100%);
}

.employees-hero-grid {
    display: grid;
    grid-template-columns: minmax(0, .86fr) minmax(390px, .74fr);
    gap: 34px;
    align-items: center;
}

.employees-copy {
    max-width: 780px;
}

.employees-kicker {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
    color: var(--ge-green);
    font-size: .78rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: .08em;
}

.employees-kicker::before {
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: currentColor;
    box-shadow: 0 0 0 7px rgba(15, 107, 71, .12);
}

.employees-copy h1 {
    max-width: 820px;
    margin: 0;
    color: var(--ge-green-dark);
    font-size: clamp(2.45rem, 6vw, 5.55rem);
    line-height: .97;
    font-weight: 950;
    letter-spacing: 0;
}

.employees-copy p {
    max-width: 660px;
    margin: 18px 0 0;
    color: var(--ge-muted);
    font-size: 1.08rem;
    line-height: 1.85;
    font-weight: 600;
}

.employees-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 28px;
}

.employees-chip {
    min-height: 40px;
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 8px;
    background: rgba(255, 255, 255, .76);
    border: 1px solid var(--ge-line);
    color: var(--ge-green-dark);
    font-size: .84rem;
    font-weight: 850;
    box-shadow: 0 12px 28px rgba(16, 32, 51, .07);
    backdrop-filter: blur(14px);
}

.employees-stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
    max-width: 680px;
    margin-top: 32px;
}

.employees-stat,
.employees-panel,
.employee-card,
.employees-directory {
    border-radius: 8px;
    background: var(--ge-panel);
    border: 1px solid var(--ge-line);
    box-shadow: var(--ge-shadow);
    backdrop-filter: blur(18px);
}

.employees-stat {
    min-height: 106px;
    padding: 18px;
}

.employees-stat strong {
    display: block;
    color: var(--ge-green-dark);
    font-size: 1.85rem;
    line-height: 1;
    font-weight: 950;
}

.employees-stat span {
    display: block;
    margin-top: 9px;
    color: var(--ge-muted);
    font-size: .82rem;
    font-weight: 800;
}

.employees-panel {
    padding: 26px;
}

.employees-panel-head {
    display: flex;
    justify-content: space-between;
    gap: 18px;
    align-items: flex-start;
    margin-bottom: 20px;
}

.employees-panel h2,
.employees-directory h2 {
    margin: 0;
    color: var(--ge-green-dark);
    font-size: clamp(1.55rem, 2.5vw, 2.25rem);
    line-height: 1.12;
    font-weight: 950;
}

.employees-panel p,
.employees-directory p,
.employee-card p {
    color: var(--ge-muted);
    line-height: 1.72;
}

.employees-panel-tag {
    flex: 0 0 auto;
    min-height: 32px;
    padding: 7px 10px;
    border-radius: 8px;
    color: #8a4b08;
    background: #fff7ed;
    border: 1px solid #fed7aa;
    font-size: .72rem;
    font-weight: 950;
    text-transform: uppercase;
}

.employees-alert {
    margin-bottom: 16px;
    padding: 13px 14px;
    border-radius: 8px;
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #bbf7d0;
    font-weight: 850;
}

.employees-form {
    display: grid;
    gap: 14px;
}

.employees-field label,
.employees-form .form-label {
    display: block;
    margin-bottom: 7px;
    color: var(--ge-ink);
    font-size: .88rem;
    font-weight: 850;
}

.employees-field .form-control {
    width: 100%;
    min-height: 48px;
    padding: 12px 13px;
    border: 1px solid rgba(16, 32, 51, .16);
    border-radius: 8px;
    background: rgba(255, 255, 255, .84);
    color: var(--ge-ink);
    outline: none;
    font-weight: 650;
    transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
}

.employees-field .form-control:focus {
    background: #fff;
    border-color: rgba(15, 107, 71, .68);
    box-shadow: 0 0 0 4px rgba(15, 107, 71, .12);
}

.employees-btn {
    min-height: 52px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 0;
    border-radius: 8px;
    padding: 13px 20px;
    color: #fff;
    background: linear-gradient(135deg, var(--ge-green-dark), var(--ge-green));
    font-weight: 950;
    box-shadow: 0 18px 38px rgba(15, 107, 71, .24);
    transition: transform .2s ease, box-shadow .2s ease;
}

.employees-btn:hover {
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 22px 46px rgba(15, 107, 71, .32);
}

.employees-preview {
    display: none;
    margin-top: 12px;
}

.employees-preview img {
    width: 116px;
    height: 116px;
    object-fit: cover;
    border-radius: 8px;
    border: 3px solid rgba(15, 107, 71, .18);
    box-shadow: 0 14px 32px rgba(16, 32, 51, .12);
}

.employees-board {
    padding: 58px 0 86px;
}

.employees-directory {
    padding: 26px;
}

.employees-directory-head {
    display: flex;
    justify-content: space-between;
    gap: 18px;
    align-items: flex-end;
    margin-bottom: 22px;
}

.employees-directory-head p {
    max-width: 650px;
    margin: 9px 0 0;
    font-weight: 600;
}

.employees-directory-badge {
    min-height: 32px;
    padding: 7px 10px;
    border-radius: 8px;
    color: #1e4f96;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    font-size: .72rem;
    font-weight: 950;
    text-transform: uppercase;
    white-space: nowrap;
}

.employees-tools {
    display: flex;
    justify-content: space-between;
    gap: 14px;
    align-items: center;
    margin-bottom: 18px;
}

.employees-search {
    position: relative;
    width: min(430px, 100%);
}

.employees-search label {
    display: block;
    margin-bottom: 7px;
    color: var(--ge-ink);
    font-size: .82rem;
    font-weight: 900;
}

.employees-search input {
    width: 100%;
    min-height: 48px;
    border: 1px solid rgba(16, 32, 51, .14);
    border-radius: 8px;
    padding: 12px 14px 12px 42px;
    color: var(--ge-ink);
    background: rgba(255,255,255,.84);
    box-shadow: inset 0 1px 0 rgba(255,255,255,.72);
    font-weight: 700;
    outline: none;
    transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
}

.employees-search input:focus {
    background: #fff;
    border-color: rgba(15, 107, 71, .68);
    box-shadow: 0 0 0 4px rgba(15, 107, 71, .12);
}

.employees-search::after {
    content: "SR";
    position: absolute;
    left: 13px;
    bottom: 13px;
    width: 24px;
    height: 24px;
    display: grid;
    place-items: center;
    border-radius: 50%;
    color: #fff;
    background: linear-gradient(135deg, var(--ge-green-dark), var(--ge-green));
    font-size: .58rem;
    font-weight: 950;
}

.employees-result-count {
    color: var(--ge-muted);
    font-size: .86rem;
    font-weight: 850;
}

.employees-table-wrap {
    overflow-x: auto;
    border: 1px solid var(--ge-line);
    border-radius: 8px;
    background: rgba(255,255,255,.72);
}

.employees-table {
    width: 100%;
    min-width: 860px;
    border-collapse: separate;
    border-spacing: 0;
}

.employees-table th,
.employees-table td {
    padding: 14px 16px;
    border-bottom: 1px solid rgba(16, 32, 51, .09);
    vertical-align: middle;
}

.employees-table th {
    color: var(--ge-green-dark);
    background: rgba(239, 246, 255, .72);
    font-size: .76rem;
    font-weight: 950;
    letter-spacing: .06em;
    text-transform: uppercase;
    white-space: nowrap;
}

.employees-table tbody tr {
    transition: background .2s ease, transform .2s ease;
}

.employees-table tbody tr:hover {
    background: rgba(236, 253, 245, .72);
}

.employees-table tbody tr:last-child td {
    border-bottom: 0;
}

.employees-table-person {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 220px;
}

.employees-table-person strong {
    display: block;
    color: var(--ge-green-dark);
    font-weight: 950;
}

.employees-table-person span {
    display: block;
    margin-top: 3px;
    color: var(--ge-muted);
    font-size: .78rem;
    font-weight: 800;
}

.employees-table .employee-photo,
.employees-table .employee-photo-placeholder {
    width: 52px;
    height: 52px;
}

.employees-pill {
    display: inline-flex;
    align-items: center;
    min-height: 30px;
    border-radius: 8px;
    padding: 6px 9px;
    color: var(--ge-muted);
    background: #f8fafc;
    border: 1px solid rgba(16, 32, 51, .1);
    font-size: .8rem;
    font-weight: 850;
}

.employees-list {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
}

.employee-card {
    min-height: 210px;
    padding: 20px;
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
}

.employee-card:hover {
    transform: translateY(-4px);
    border-color: rgba(217, 133, 22, .42);
    box-shadow: 0 26px 64px rgba(16, 32, 51, .15);
}

.employee-card-top {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 16px;
}

.employee-photo,
.employee-photo-placeholder {
    width: 76px;
    height: 76px;
    flex: 0 0 auto;
    border-radius: 8px;
    border: 2px solid rgba(15, 107, 71, .18);
    box-shadow: 0 12px 28px rgba(16, 32, 51, .1);
}

.employee-photo {
    object-fit: cover;
    background: #eef2f7;
}

.employee-photo-placeholder {
    display: grid;
    place-items: center;
    color: var(--ge-green-dark);
    background: linear-gradient(135deg, #eef8ed, #dbeafe);
    font-size: 1.4rem;
    font-weight: 950;
}

.employee-card h3 {
    margin: 0;
    color: var(--ge-green-dark);
    font-size: 1.15rem;
    font-weight: 950;
}

.employee-card p {
    margin: 4px 0 0;
    font-weight: 700;
}

.employee-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.employee-meta span {
    min-height: 30px;
    display: inline-flex;
    align-items: center;
    padding: 6px 9px;
    border-radius: 8px;
    background: #f8fafc;
    border: 1px solid var(--ge-line);
    color: var(--ge-muted);
    font-size: .8rem;
    font-weight: 800;
}

.employees-empty {
    padding: 42px 24px;
    text-align: center;
    border: 1px dashed var(--ge-line);
    border-radius: 8px;
    color: var(--ge-muted);
    font-weight: 800;
}

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: .001ms !important;
        transition-duration: .001ms !important;
        scroll-behavior: auto !important;
    }
}

@media (max-width: 1180px) {
    .employees-hero-grid {
        grid-template-columns: 1fr;
    }

    .employees-copy {
        max-width: 900px;
    }

    .employees-panel {
        max-width: 780px;
    }

    .employees-list {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 760px) {
    .employees-hero {
        min-height: auto;
        padding: 44px 0 34px;
    }

    .employees-stats,
    .employees-list {
        grid-template-columns: 1fr;
    }

    .employees-panel,
    .employees-directory {
        padding: 20px;
    }

    .employees-panel-head,
    .employees-directory-head,
    .employees-tools {
        align-items: flex-start;
        flex-direction: column;
    }

    .employees-search {
        width: 100%;
    }
}
</style>
@endpush

@section('content')
<div class="employees-page">
    <div class="employees-service-scene" aria-hidden="true">
        <span class="service-orbit orbit-one"></span>
        <span class="service-orbit orbit-two"></span>
        <span class="service-badge badge-police">Police</span>
        <span class="service-badge badge-doctor">Doctor</span>
        <span class="service-badge badge-engineer">Engineer</span>
        <span class="service-person service-police">
            <span class="service-head"></span>
            <span class="service-cap"></span>
            <span class="service-body"></span>
            <span class="service-symbol">PS</span>
        </span>
        <span class="service-person service-doctor">
            <span class="service-head"></span>
            <span class="service-body"></span>
            <span class="service-symbol">+</span>
        </span>
        <span class="service-person service-engineer">
            <span class="service-head"></span>
            <span class="service-helmet"></span>
            <span class="service-body"></span>
            <span class="service-symbol">EN</span>
        </span>
    </div>

    <section class="employees-hero">
        <div class="container">
            <div class="employees-hero-grid">
                <div class="employees-copy">
                    <span class="employees-kicker">Government Services</span>
                    <h1>Bijrol public service directory.</h1>

                    <div class="employees-actions" aria-label="Government employee highlights">
                        <span class="employees-chip">Public directory</span>
                        <span class="employees-chip">Photo records</span>
                        <span class="employees-chip">Village services</span>
                        <span class="employees-chip">Admin ready</span>
                    </div>

                    <div class="employees-stats" aria-label="Employee directory summary">
                        <div class="employees-stat">
                            <strong>{{ $employees->count() }}</strong>
                            <span>Total records</span>
                        </div>
                        <div class="employees-stat">
                            <strong>{{ $employees->whereNotNull('photo')->count() }}</strong>
                            <span>Photo profiles</span>
                        </div>
                        <div class="employees-stat">
                            <strong>Live</strong>
                            <span>Directory status</span>
                        </div>
                    </div>
                </div>

                <aside class="employees-panel">
                    @if (session('success'))
                        <div class="employees-alert" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="employees-panel-head">
                        <div>
                            <span class="employees-kicker">Add Record</span>
                            <h2>Add employee information.</h2>
                            <p>Naam, department, designation, current posting, aur optional photo upload karke directory update karein.</p>
                        </div>
                        <span class="employees-panel-tag">Service desk</span>
                    </div>

                    <form class="employees-form" action="{{ route('government-employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="employees-field">
                            <label for="name" class="form-label">Employee Name</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter employee name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="employees-field">
                            <label for="department" class="form-label">Department</label>
                            <input
                                type="text"
                                class="form-control @error('department') is-invalid @enderror"
                                id="department"
                                name="department"
                                value="{{ old('department') }}"
                                placeholder="Enter department">
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="employees-field">
                            <label for="designation" class="form-label">Designation</label>
                            <input
                                type="text"
                                class="form-control @error('designation') is-invalid @enderror"
                                id="designation"
                                name="designation"
                                value="{{ old('designation') }}"
                                placeholder="Enter designation">
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="employees-field">
                            <label for="currently_posting" class="form-label">Currently Posting</label>
                            <input
                                type="text"
                                class="form-control @error('currently_posting') is-invalid @enderror"
                                id="currently_posting"
                                name="currently_posting"
                                value="{{ old('currently_posting') }}"
                                placeholder="Enter current posting">
                            @error('currently_posting')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="employees-field">
                            <label for="photo" class="form-label">Photo</label>
                            <input
                                type="file"
                                class="form-control @error('photo') is-invalid @enderror"
                                id="photo"
                                name="photo"
                                accept="image/*"
                                onchange="previewPhoto(event)">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="photoPreviewWrapper" class="employees-preview">
                                <img id="photoPreview" src="" alt="Preview">
                            </div>
                        </div>

                        <button type="submit" class="employees-btn">Add Information</button>
                    </form>
                </aside>
            </div>
        </div>
    </section>

    <section class="employees-board">
        <div class="container">
            <div class="employees-directory">
                <div class="employees-directory-head">
                    <div>
                        <span class="employees-kicker">Employee Information</span>
                        <h2>Public employee records.</h2>
                    </div>
                    <span class="employees-directory-badge">{{ $employees->count() }} Records</span>
                </div>

                @if ($employees->count() > 0)
                    <div class="employees-tools">
                        <div class="employees-search">
                            <label for="employeeSearch">Search Employee</label>
                            <input type="search" id="employeeSearch" placeholder="Search by name, department, designation, posting">
                        </div>
                        <div class="employees-result-count">
                            Showing <span id="employeeVisibleCount">{{ $employees->count() }}</span> of {{ $employees->count() }} records
                        </div>
                    </div>

                    <div class="employees-table-wrap">
                        <table class="employees-table">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Currently Posting</th>
                                    <th>Added</th>
                                </tr>
                            </thead>
                            <tbody id="employeeTableBody">
                                @foreach ($employees as $employee)
                                    <tr data-employee-row data-search="{{ strtolower(trim($employee->name . ' ' . ($employee->department ?? '') . ' ' . $employee->designation . ' ' . ($employee->currently_posting ?? ''))) }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="employees-table-person">
                                                @if ($employee->photo)
                                                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="employee-photo">
                                                @else
                                                    <span class="employee-photo-placeholder">{{ strtoupper(substr($employee->name, 0, 1)) }}</span>
                                                @endif
                                                <div>
                                                    <strong>{{ $employee->name }}</strong>
                                                    <span>Public service record</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="employees-pill">{{ $employee->department ?: '-' }}</span></td>
                                        <td>{{ $employee->designation }}</td>
                                        <td>{{ $employee->currently_posting ?: '-' }}</td>
                                        <td>{{ $employee->created_at?->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                                <tr id="employeeNoResults" style="display:none;">
                                    <td colspan="6">
                                        <div class="employees-empty">No matching employee records found.</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="employees-empty">
                        No employee information added yet.
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>

<script>
    function previewPhoto(event) {
        const file = event.target.files[0];
        const previewWrapper = document.getElementById('photoPreviewWrapper');
        const previewImg = document.getElementById('photoPreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewWrapper.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewWrapper.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('employeeSearch');
        const rows = Array.from(document.querySelectorAll('[data-employee-row]'));
        const visibleCount = document.getElementById('employeeVisibleCount');
        const noResults = document.getElementById('employeeNoResults');

        if (!searchInput || rows.length === 0) return;

        searchInput.addEventListener('input', function () {
            const term = searchInput.value.trim().toLowerCase();
            let count = 0;

            rows.forEach(function (row) {
                const matches = row.dataset.search.includes(term);
                row.style.display = matches ? '' : 'none';
                if (matches) count += 1;
            });

            if (visibleCount) visibleCount.textContent = count;
            if (noResults) noResults.style.display = count === 0 ? '' : 'none';
        });
    });
</script>
@endsection
