@extends('layouts.app')

@section('title', 'Who\'s Who | Pride of BIJROL')

@php
    $profiles = $profiles ?? collect();
    $stats = [
        ['value' => str_pad((string) $profiles->count(), 2, '0', STR_PAD_LEFT), 'label' => 'Featured achievers'],
        ['value' => '1857', 'label' => 'Legacy of courage'],
        ['value' => '01', 'label' => 'Village identity'],
    ];
@endphp

@push('styles')
<style>
    .ww-page {
        --ink: #10251c;
        --muted: #66756e;
        --line: rgba(16, 37, 28, .12);
        --green: #1f7a4d;
        --deep: #113d2b;
        --gold: #c7922c;
        --cream: #f6f2e9;
        background:
            radial-gradient(circle at 8% 0%, rgba(31, 122, 77, .13), transparent 32rem),
            radial-gradient(circle at 92% 12%, rgba(199, 146, 44, .16), transparent 30rem),
            #fbfaf6;
        color: var(--ink);
        font-family: "Poppins", sans-serif;
        overflow: hidden;
    }

    .ww-wrap {
        width: min(1160px, calc(100% - 32px));
        margin: 0 auto;
    }

    .ww-hero {
        position: relative;
        min-height: 560px;
        display: flex;
        align-items: center;
        color: #fff;
        background:
            linear-gradient(115deg, rgba(10, 34, 24, .88), rgba(12, 64, 44, .54), rgba(18, 61, 43, .16)),
            url('{{ asset('image/main.jpg.jpg') }}') center/cover no-repeat;
        isolation: isolate;
    }

    .ww-hero::after {
        content: "";
        position: absolute;
        inset: auto 0 0;
        height: 42%;
        z-index: -1;
        background: linear-gradient(0deg, rgba(251, 250, 246, 1), transparent);
    }

    .ww-hero-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(280px, 420px);
        gap: 34px;
        align-items: end;
        padding: 96px 0 86px;
    }

    .ww-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f8d98b;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .ww-kicker::before {
        content: "";
        width: 34px;
        height: 2px;
        border-radius: 99px;
        background: currentColor;
    }

    .ww-hero h1 {
        margin: 18px 0 18px;
        max-width: 760px;
        font-size: clamp(44px, 8vw, 88px);
        line-height: .94;
        font-weight: 900;
        letter-spacing: 0;
        text-shadow: 0 26px 60px rgba(0, 0, 0, .28);
    }

    .ww-hero p {
        max-width: 690px;
        margin: 0;
        color: rgba(255, 255, 255, .88);
        font-size: 17px;
        line-height: 1.8;
    }

    .ww-hero-panel {
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 8px;
        padding: 24px;
        background: rgba(255, 255, 255, .13);
        backdrop-filter: blur(16px);
        box-shadow: 0 26px 70px rgba(0, 0, 0, .22);
    }

    .ww-hero-panel strong {
        display: block;
        font-size: 34px;
        line-height: 1;
        margin-bottom: 10px;
    }

    .ww-hero-panel span {
        color: rgba(255, 255, 255, .82);
        line-height: 1.7;
    }

    .ww-stats {
        position: relative;
        z-index: 3;
        margin-top: -52px;
    }

    .ww-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .ww-stat,
    .ww-profile,
    .ww-panel,
    .ww-nominate {
        border: 1px solid var(--line);
        border-radius: 8px;
        background: rgba(255, 255, 255, .86);
        box-shadow: 0 18px 46px rgba(27, 42, 33, .08);
    }

    .ww-stat {
        padding: 22px;
    }

    .ww-stat strong {
        display: block;
        color: var(--green);
        font-size: 32px;
        line-height: 1;
        margin-bottom: 8px;
        font-weight: 900;
    }

    .ww-stat span {
        color: var(--muted);
        font-size: 13px;
        font-weight: 700;
    }

    .ww-section {
        padding: 86px 0;
    }

    .ww-heading {
        max-width: 780px;
        margin: 0 auto 42px;
        text-align: center;
    }

    .ww-heading span {
        color: var(--green);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .ww-heading h2 {
        margin: 10px 0 12px;
        font-size: clamp(30px, 5vw, 52px);
        line-height: 1.08;
        font-weight: 900;
    }

    .ww-heading p {
        margin: 0;
        color: var(--muted);
        line-height: 1.75;
    }

    .ww-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .ww-profile {
        position: relative;
        min-height: 430px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 28px;
        color: inherit;
        text-decoration: none;
        overflow: hidden;
        transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease;
    }

    .ww-profile::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(145deg, rgba(31, 122, 77, .1), transparent 48%, rgba(199, 146, 44, .14));
        opacity: .75;
    }

    .ww-profile::after {
        content: attr(data-initials);
        position: absolute;
        right: -16px;
        bottom: -28px;
        color: rgba(31, 122, 77, .08);
        font-size: 128px;
        line-height: 1;
        font-weight: 900;
    }

    .ww-profile:hover {
        transform: translateY(-8px);
        border-color: rgba(199, 146, 44, .36);
        box-shadow: 0 30px 72px rgba(27, 42, 33, .14);
    }

    .ww-profile > * {
        position: relative;
        z-index: 1;
    }

    .ww-avatar {
        width: 106px;
        height: 106px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        color: #fff;
        background: linear-gradient(135deg, var(--green), var(--deep));
        border: 4px solid rgba(199, 146, 44, .28);
        box-shadow: 0 20px 42px rgba(31, 122, 77, .22);
        font-size: 30px;
        font-weight: 900;
        margin-bottom: 22px;
        overflow: hidden;
    }

    .ww-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .ww-profile[data-tone="service"] .ww-avatar {
        background: linear-gradient(135deg, #315d8f, #17345a);
        box-shadow: 0 20px 42px rgba(49, 93, 143, .2);
    }

    .ww-badge {
        display: inline-flex;
        align-self: flex-start;
        border-radius: 999px;
        padding: 8px 12px;
        color: #18452f;
        background: rgba(31, 122, 77, .12);
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .07em;
        margin-bottom: 16px;
    }

    .ww-profile h3 {
        margin: 0 0 8px;
        font-size: clamp(24px, 3vw, 34px);
        line-height: 1.15;
        font-weight: 900;
    }

    .ww-role {
        color: var(--green);
        font-weight: 800;
        margin-bottom: 14px;
    }

    .ww-profile p {
        color: var(--muted);
        line-height: 1.75;
        margin: 0;
    }

    .ww-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 22px;
    }

    .ww-tags span {
        border: 1px solid rgba(16, 37, 28, .1);
        border-radius: 999px;
        padding: 7px 10px;
        background: #fff;
        color: #496158;
        font-size: 12px;
        font-weight: 700;
    }

    .ww-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 26px;
        color: var(--deep);
        font-weight: 900;
    }

    .ww-link::after {
        content: ">";
        width: 26px;
        height: 26px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: var(--gold);
        color: #2d1b00;
        transition: transform .2s ease;
    }

    .ww-profile:hover .ww-link::after {
        transform: translateX(4px);
    }

    .ww-lower {
        display: grid;
        grid-template-columns: minmax(0, .9fr) minmax(0, 1.1fr);
        gap: 20px;
        margin-top: 22px;
    }

    .ww-panel,
    .ww-nominate {
        padding: 28px;
    }

    .ww-panel {
        background: linear-gradient(135deg, var(--deep), var(--green));
        color: #fff;
    }

    .ww-panel h2,
    .ww-nominate h2 {
        margin: 0 0 10px;
        font-size: clamp(24px, 3vw, 36px);
        line-height: 1.15;
        font-weight: 900;
    }

    .ww-panel p {
        color: rgba(255, 255, 255, .82);
        line-height: 1.75;
        margin: 0;
    }

    .ww-nominate p {
        color: var(--muted);
        line-height: 1.75;
        margin: 0 0 22px;
    }

    .ww-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 48px;
        border-radius: 999px;
        padding: 12px 18px;
        color: #2d1b00;
        background: var(--gold);
        font-weight: 900;
        text-decoration: none;
        box-shadow: 0 16px 34px rgba(199, 146, 44, .24);
        transition: transform .2s ease;
    }

    .ww-button:hover {
        transform: translateY(-2px);
        color: #2d1b00;
    }

    @media (max-width: 980px) {
        .ww-hero-grid,
        .ww-grid,
        .ww-lower {
            grid-template-columns: 1fr;
        }

        .ww-hero {
            min-height: auto;
        }
    }

    @media (max-width: 680px) {
        .ww-wrap {
            width: min(100% - 20px, 1160px);
        }

        .ww-hero-grid {
            padding: 72px 0 74px;
        }

        .ww-stats {
            margin-top: 0;
            padding-top: 16px;
        }

        .ww-stats-grid {
            grid-template-columns: 1fr;
        }

        .ww-section {
            padding: 62px 0;
        }

        .ww-profile,
        .ww-panel,
        .ww-nominate,
        .ww-hero-panel {
            padding: 22px;
        }
    }
</style>
@endpush

@section('content')
<main class="ww-page">
    <section class="ww-hero">
        <div class="ww-wrap ww-hero-grid">
            <div>
                <span class="ww-kicker">Pride of Bijrol</span>
                <h1>Who's Who</h1>
                <p>Meet the people connected with Bijrol whose courage, discipline, talent, and public service make the village proud.</p>
            </div>
            <aside class="ww-hero-panel">
                <strong>Bijrol Achievers</strong>
                <span>Profiles that give young people a clear signal: village roots and big ambitions can grow together.</span>
            </aside>
        </div>
    </section>

    <section class="ww-stats">
        <div class="ww-wrap ww-stats-grid">
            @foreach ($stats as $stat)
                <article class="ww-stat">
                    <strong>{{ $stat['value'] }}</strong>
                    <span>{{ $stat['label'] }}</span>
                </article>
            @endforeach
        </div>
    </section>

    <section class="ww-section">
        <div class="ww-wrap">
            <div class="ww-heading">
                <span>Village Achievers</span>
                <h2>Stories that motivate the next generation.</h2>
                <p>These profiles highlight people connected with Bijrol who have made the village proud through excellence, discipline, and dedication.</p>
            </div>

            <div class="ww-grid">
                @forelse ($profiles as $profile)
                    <a class="ww-profile" href="{{ route('achievers.show', ['achiever' => $profile->slug]) }}" data-initials="{{ $profile->initials }}" data-tone="{{ $profile->tone }}">
                        <div>
                            <div class="ww-avatar">
                                @if($profile->photo)
                                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}">
                                @else
                                    {{ $profile->initials }}
                                @endif
                            </div>
                            <span class="ww-badge">{{ $profile->badge ?: 'Bijrol Achiever' }}</span>
                            <h3>{{ $profile->name }}</h3>
                            <div class="ww-role">{{ $profile->role }}</div>
                            <p>{{ $profile->short_description }}</p>
                            <div class="ww-tags">
                                @foreach (array_slice($profile->highlights ?? [], 0, 3) as $tag)
                                    <span>{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                        <span class="ww-link">View profile</span>
                    </a>
                @empty
                    <article class="ww-profile">
                        <div>
                            <div class="ww-avatar">BW</div>
                            <span class="ww-badge">Coming Soon</span>
                            <h3>No published profiles yet</h3>
                            <div class="ww-role">Admin can add profiles</div>
                            <p>Login to admin and add Who's Who profiles to show them here.</p>
                        </div>
                    </article>
                @endforelse
            </div>

            <div class="ww-lower">
                <article class="ww-panel">
                    <h2>People who carry Bijrol forward.</h2>
                    <p>Every achievement adds to the village identity, from sports and service to education, leadership, culture, and public life.</p>
                </article>
                <article class="ww-nominate">
                    <h2>Know another achiever?</h2>
                    <p>Share details of people from Bijrol who should be added to this page with verified information and photographs.</p>
                    <a class="ww-button" href="{{ url('/contact') }}">Share an achievement</a>
                </article>
            </div>
        </div>
    </section>
</main>
@endsection
