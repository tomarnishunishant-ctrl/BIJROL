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
    .employees-directory-head {
        align-items: flex-start;
        flex-direction: column;
    }
}
</style>
@endpush

@section('content')
<div class="employees-page">
    <section class="employees-hero">
        <div class="container">
            <div class="employees-hero-grid">
                <div class="employees-copy">
                    <span class="employees-kicker">Government Services</span>
                    <h1>Bijrol public service directory.</h1>
                    <p>Local government employees, designations, and public service contacts ko ek clean directory me maintain karein.</p>

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
                            <p>Naam, designation, aur optional photo upload karke directory update karein.</p>
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
                        <p>Submitted employee information yahan card format me dikhayi degi.</p>
                    </div>
                    <span class="employees-directory-badge">{{ $employees->count() }} Records</span>
                </div>

                @if ($employees->count() > 0)
                    <div class="employees-list">
                        @foreach ($employees as $employee)
                            <article class="employee-card">
                                <div class="employee-card-top">
                                    @if ($employee->photo)
                                        <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="employee-photo">
                                    @else
                                        <span class="employee-photo-placeholder">{{ strtoupper(substr($employee->name, 0, 1)) }}</span>
                                    @endif
                                    <div>
                                        <h3>{{ $employee->name }}</h3>
                                        <p>{{ $employee->designation }}</p>
                                    </div>
                                </div>

                                <div class="employee-meta">
                                    <span>Public service</span>
                                    <span>Added {{ $employee->created_at?->format('M d, Y') }}</span>
                                </div>
                            </article>
                        @endforeach
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
</script>
@endsection
