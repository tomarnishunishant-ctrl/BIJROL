@extends('layouts.app')

@section('title', 'Village Voice | BIJROL Village')

@php
    $categories = [
        'Roads & Drainage',
        'Water Supply',
        'Electricity',
        'Cleanliness',
        'Education',
        'Healthcare',
        'Agriculture',
        'Sports & Youth',
        'Temple / Community Place',
        'Government Services',
        'Other',
    ];

    $categoryHighlights = [
        'Roads',
        'Water',
        'Power',
        'Cleanliness',
        'Education',
        'Health',
        'Farming',
        'Youth',
    ];
@endphp

@push('styles')
<style>
.voice-page {
    --vv-ink: #122018;
    --vv-muted: #627168;
    --vv-green: #0e6a46;
    --vv-green-dark: #063923;
    --vv-lime: #a7c957;
    --vv-saffron: #d98516;
    --vv-blue: #2563eb;
    --vv-bg: #f4f8f2;
    --vv-panel: rgba(255, 255, 255, .92);
    --vv-line: rgba(18, 32, 24, .12);
    --vv-shadow: 0 22px 60px rgba(18, 32, 24, .12);
    background:
        radial-gradient(circle at 14% 10%, rgba(167, 201, 87, .22), transparent 28%),
        radial-gradient(circle at 88% 16%, rgba(37, 99, 235, .11), transparent 26%),
        linear-gradient(180deg, #f8fbf5 0%, var(--vv-bg) 48%, #fffdf7 100%);
    color: var(--vv-ink);
}

.voice-stage {
    position: relative;
    min-height: calc(100vh - 88px);
    display: grid;
    align-items: center;
    padding: 64px 0 42px;
    overflow: hidden;
    isolation: isolate;
}

.voice-stage::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -2;
    background: url('{{ asset('image/bijrol.jpg.png') }}') center/cover no-repeat;
    opacity: .28;
}

.voice-stage::after {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -1;
    background:
        linear-gradient(90deg, rgba(244, 248, 242, .98) 0%, rgba(244, 248, 242, .88) 46%, rgba(244, 248, 242, .72) 100%),
        linear-gradient(180deg, rgba(255,255,255,.1) 0%, var(--vv-bg) 100%);
}

.voice-stage-grid {
    display: grid;
    grid-template-columns: minmax(0, .9fr) minmax(390px, .72fr);
    gap: 34px;
    align-items: center;
}

.voice-copy {
    max-width: 760px;
}

.voice-kicker {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
    color: var(--vv-green);
    font-size: .78rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: .08em;
}

.voice-kicker::before {
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: currentColor;
    box-shadow: 0 0 0 7px rgba(14, 106, 70, .12);
}

.voice-copy h1 {
    max-width: 760px;
    margin: 0;
    color: var(--vv-green-dark);
    font-size: clamp(2.5rem, 6.2vw, 5.65rem);
    line-height: .96;
    font-weight: 950;
    letter-spacing: 0;
}

.voice-copy p {
    max-width: 660px;
    margin: 18px 0 0;
    color: var(--vv-muted);
    font-size: 1.08rem;
    line-height: 1.85;
    font-weight: 600;
}

.voice-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 28px;
}

.voice-chip {
    display: inline-flex;
    align-items: center;
    min-height: 38px;
    padding: 8px 12px;
    border-radius: 8px;
    background: rgba(255, 255, 255, .72);
    border: 1px solid var(--vv-line);
    color: var(--vv-green-dark);
    font-size: .84rem;
    font-weight: 850;
    box-shadow: 0 12px 28px rgba(18, 32, 24, .07);
    backdrop-filter: blur(14px);
}

.voice-stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
    max-width: 660px;
    margin-top: 32px;
}

.voice-stat {
    min-height: 108px;
    padding: 18px;
    border-radius: 8px;
    background: rgba(255, 255, 255, .76);
    border: 1px solid var(--vv-line);
    box-shadow: 0 16px 38px rgba(18, 32, 24, .08);
    backdrop-filter: blur(14px);
}

.voice-stat strong {
    display: block;
    color: var(--vv-green-dark);
    font-size: 2rem;
    line-height: 1;
    font-weight: 950;
}

.voice-stat span {
    display: block;
    margin-top: 8px;
    color: var(--vv-muted);
    font-size: .84rem;
    font-weight: 800;
}

.voice-panel,
.voice-feed-card,
.voice-empty {
    border-radius: 8px;
    background: var(--vv-panel);
    border: 1px solid var(--vv-line);
    box-shadow: var(--vv-shadow);
    backdrop-filter: blur(18px);
}

.voice-panel {
    padding: 26px;
}

.voice-panel-head {
    display: flex;
    justify-content: space-between;
    gap: 18px;
    align-items: flex-start;
    margin-bottom: 20px;
}

.voice-panel-head h2,
.voice-feed-head h2 {
    margin: 0;
    color: var(--vv-green-dark);
    font-size: clamp(1.55rem, 2.5vw, 2.25rem);
    line-height: 1.1;
    font-weight: 950;
    letter-spacing: 0;
}

.voice-panel-head p,
.voice-feed-head p,
.voice-feed-card p,
.voice-empty {
    color: var(--vv-muted);
    line-height: 1.72;
}

.voice-panel-tag {
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

.voice-alert {
    margin-bottom: 16px;
    padding: 13px 14px;
    border-radius: 8px;
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #bbf7d0;
    font-weight: 850;
}

.voice-form {
    display: grid;
    gap: 14px;
}

.voice-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
}

.voice-field label {
    display: block;
    margin-bottom: 7px;
    color: var(--vv-ink);
    font-size: .88rem;
    font-weight: 850;
}

.voice-field input,
.voice-field select,
.voice-field textarea {
    width: 100%;
    min-height: 48px;
    padding: 12px 13px;
    border: 1px solid rgba(18, 32, 24, .16);
    border-radius: 8px;
    background: rgba(255, 255, 255, .84);
    color: var(--vv-ink);
    outline: none;
    font-weight: 650;
    transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
}

.voice-field textarea {
    min-height: 132px;
    resize: vertical;
}

.voice-field input:focus,
.voice-field select:focus,
.voice-field textarea:focus {
    background: #fff;
    border-color: rgba(14, 106, 70, .68);
    box-shadow: 0 0 0 4px rgba(14, 106, 70, .12);
}

.voice-check {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    color: var(--vv-muted);
    font-size: .92rem;
    font-weight: 750;
    line-height: 1.6;
}

.voice-check input {
    width: 18px;
    height: 18px;
    margin-top: 4px;
    accent-color: var(--vv-green);
}

.voice-btn {
    min-height: 52px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 0;
    border-radius: 8px;
    padding: 13px 20px;
    color: #fff;
    background: linear-gradient(135deg, var(--vv-green-dark), var(--vv-green));
    font-weight: 950;
    box-shadow: 0 18px 38px rgba(14, 106, 70, .24);
    transition: transform .2s ease, box-shadow .2s ease;
}

.voice-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 22px 46px rgba(14, 106, 70, .32);
}

.voice-error {
    margin-top: 6px;
    color: #b91c1c;
    font-size: .84rem;
    font-weight: 850;
}

.voice-board {
    padding: 60px 0 86px;
}

.voice-feed-head {
    display: flex;
    justify-content: space-between;
    gap: 24px;
    align-items: flex-end;
    margin-bottom: 22px;
}

.voice-feed-head p {
    max-width: 620px;
    margin: 9px 0 0;
    font-weight: 600;
}

.voice-category-strip {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    gap: 8px;
    max-width: 390px;
}

.voice-category-strip span {
    min-height: 34px;
    display: inline-flex;
    align-items: center;
    padding: 7px 10px;
    border-radius: 8px;
    color: var(--vv-green-dark);
    background: #eef8ed;
    border: 1px solid rgba(14, 106, 70, .14);
    font-size: .78rem;
    font-weight: 850;
}

.voice-feed {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
}

.voice-feed-card {
    min-height: 248px;
    padding: 22px;
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
}

.voice-feed-card:hover {
    transform: translateY(-4px);
    border-color: rgba(217, 133, 22, .42);
    box-shadow: 0 26px 64px rgba(18, 32, 24, .15);
}

.voice-feed-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 14px;
    margin-bottom: 16px;
}

.voice-badge {
    min-height: 31px;
    display: inline-flex;
    align-items: center;
    padding: 7px 10px;
    border-radius: 8px;
    color: #8a4b08;
    background: #fff7ed;
    border: 1px solid #fed7aa;
    font-size: .72rem;
    font-weight: 950;
    text-transform: uppercase;
}

.voice-date {
    color: var(--vv-muted);
    font-size: .82rem;
    font-weight: 800;
    white-space: nowrap;
}

.voice-feed-card h3 {
    margin: 0 0 9px;
    color: var(--vv-green-dark);
    font-size: 1.16rem;
    line-height: 1.3;
    font-weight: 950;
}

.voice-feed-card p {
    margin: 0;
    font-size: .95rem;
}

.voice-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 17px;
}

.voice-meta span {
    min-height: 30px;
    display: inline-flex;
    align-items: center;
    padding: 6px 9px;
    border-radius: 8px;
    background: #f8fafc;
    border: 1px solid var(--vv-line);
    color: var(--vv-muted);
    font-size: .8rem;
    font-weight: 800;
}

.voice-empty {
    grid-column: 1 / -1;
    padding: 42px 24px;
    text-align: center;
    border-style: dashed;
    box-shadow: none;
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
    .voice-stage-grid {
        grid-template-columns: 1fr;
    }

    .voice-copy {
        max-width: 900px;
    }

    .voice-panel {
        max-width: 780px;
    }

    .voice-feed {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 760px) {
    .voice-stage {
        min-height: auto;
        padding: 42px 0 34px;
    }

    .voice-stats,
    .voice-row,
    .voice-feed {
        grid-template-columns: 1fr;
    }

    .voice-panel-head,
    .voice-feed-head,
    .voice-feed-card-top {
        align-items: flex-start;
        flex-direction: column;
    }

    .voice-category-strip {
        justify-content: flex-start;
        max-width: none;
    }

    .voice-panel,
    .voice-feed-card {
        padding: 20px;
    }

    .voice-date {
        white-space: normal;
    }
}
</style>
@endpush

@section('content')
<div class="voice-page">
    <section class="voice-stage">
        <div class="container">
            <div class="voice-stage-grid">
                <div class="voice-copy">
                    <span class="voice-kicker">Village Voice</span>
                    <h1>Bijrol ki awaaz, seedha record par.</h1>
                    <p>Gaon ke roads, water supply, cleanliness, school, health, kheti, sports ya government services se related sujhav aur problems yahan submit karein.</p>

                    <div class="voice-actions" aria-label="Village Voice highlights">
                        <span class="voice-chip">Public suggestions</span>
                        <span class="voice-chip">Issue tracking</span>
                        <span class="voice-chip">Development ideas</span>
                        <span class="voice-chip">Optional contact</span>
                    </div>

                    <div class="voice-stats" aria-label="Village Voice summary">
                        <div class="voice-stat">
                            <strong>{{ $totalSuggestions }}</strong>
                            <span>Total submissions</span>
                        </div>
                        <div class="voice-stat">
                            <strong>{{ $publicSuggestions->count() }}</strong>
                            <span>Public voices</span>
                        </div>
                        <div class="voice-stat">
                            <strong>{{ count($categories) }}</strong>
                            <span>Issue categories</span>
                        </div>
                    </div>
                </div>

                <aside class="voice-panel">
                    @if(session('success'))
                        <div class="voice-alert">{{ session('success') }}</div>
                    @endif

                    <div class="voice-panel-head">
                        <div>
                            <span class="voice-kicker">Submit Voice</span>
                            <h2>Apni baat bhejiye.</h2>
                            <p>Naam aur mobile optional hain. Phone number public list me show nahi hoga.</p>
                        </div>
                        <span class="voice-panel-tag">Public desk</span>
                    </div>

                    <form class="voice-form" method="POST" action="{{ route('village-voice.store') }}">
                        @csrf

                        <div class="voice-row">
                            <div class="voice-field">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" value="{{ old('name') }}" maxlength="100" placeholder="Optional">
                                @error('name')<div class="voice-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="voice-field">
                                <label for="phone">Mobile</label>
                                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" maxlength="20" placeholder="Optional">
                                @error('phone')<div class="voice-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="voice-field">
                            <label for="category">Category</label>
                            <select id="category" name="category" required>
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                                @endforeach
                            </select>
                            @error('category')<div class="voice-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="voice-field">
                            <label for="area">Area / Location</label>
                            <input id="area" name="area" type="text" value="{{ old('area') }}" maxlength="120" placeholder="Jaise: main road, school ke paas">
                            @error('area')<div class="voice-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="voice-field">
                            <label for="title">Short Title</label>
                            <input id="title" name="title" type="text" value="{{ old('title') }}" maxlength="160" required placeholder="Sujhav ya problem ka title">
                            @error('title')<div class="voice-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="voice-field">
                            <label for="message">Details</label>
                            <textarea id="message" name="message" required placeholder="Apni baat detail mein likhein">{{ old('message') }}</textarea>
                            @error('message')<div class="voice-error">{{ $message }}</div>@enderror
                        </div>

                        <label class="voice-check">
                            <input type="checkbox" name="is_public" value="1" @checked(old('is_public', '1') === '1')>
                            <span>Is submission ko public list mein dikhaya ja sakta hai.</span>
                        </label>

                        <button class="voice-btn" type="submit">Submit Sujhav</button>
                    </form>
                </aside>
            </div>
        </div>
    </section>

    <main class="voice-board">
        <div class="container">
            <div class="voice-feed-head">
                <div>
                    <span class="voice-kicker">Public Voices</span>
                    <h2>Recent village submissions.</h2>
                    <p>Sirf wahi submissions yahan dikhengi jinko public list ke liye allow kiya gaya hai.</p>
                </div>
                <div class="voice-category-strip" aria-label="Popular categories">
                    @foreach($categoryHighlights as $highlight)
                        <span>{{ $highlight }}</span>
                    @endforeach
                </div>
            </div>

            <div class="voice-feed">
                @forelse($publicSuggestions as $suggestion)
                    <article class="voice-feed-card">
                        <div class="voice-feed-card-top">
                            <span class="voice-badge">{{ $suggestion->category }}</span>
                            <span class="voice-date">{{ $suggestion->created_at->format('M d, Y') }}</span>
                        </div>
                        <h3>{{ $suggestion->title }}</h3>
                        <p>{{ $suggestion->message }}</p>
                        <div class="voice-meta">
                            <span>By: {{ $suggestion->name ?: 'Anonymous Villager' }}</span>
                            @if($suggestion->area)
                                <span>Area: {{ $suggestion->area }}</span>
                            @endif
                            <span>Status: {{ ucfirst($suggestion->status) }}</span>
                        </div>
                    </article>
                @empty
                    <div class="voice-empty">Abhi koi public sujhav submit nahi hua hai. Pehla sujhav aap bhej sakte hain.</div>
                @endforelse
            </div>
        </div>
    </main>
</div>
@endsection
