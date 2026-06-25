@extends('layouts.app')

@section('title', 'Puja Tomar | UFC History Maker | BIJROL')

@php
    $stats = [
        ['value' => 'UFC', 'label' => 'Global MMA stage'],
        ['value' => '2024', 'label' => 'Historic debut win'],
        ['value' => 'MFN', 'label' => 'Strawweight champion'],
    ];

    $timeline = [
        ['year' => 'Early Years', 'title' => 'Martial Arts Foundation', 'text' => 'Puja built her fighting base through discipline, conditioning, and years of combat-sports training.'],
        ['year' => 'MFN', 'title' => 'Domestic MMA Success', 'text' => 'She became a major name in Indian MMA and won the Matrix Fight Night women\'s strawweight title.'],
        ['year' => '2023', 'title' => 'UFC Signing', 'text' => 'Puja signed with the Ultimate Fighting Championship, opening a historic path for Indian women in global MMA.'],
        ['year' => '2024', 'title' => 'First Indian UFC Bout Win', 'text' => 'She won her UFC debut by split decision, becoming the first Indian fighter to win a UFC bout.'],
    ];

    $highlights = [
        'First Indian fighter to win a UFC bout',
        'Matrix Fight Night women\'s strawweight champion',
        'Symbol of courage for young athletes',
        'A proud name connected with Bijrol village',
    ];
@endphp

@push('styles')
<style>
    .person-page {
        --ink: #10251c;
        --muted: #66756e;
        --line: rgba(16, 37, 28, .12);
        --green: #1f7a4d;
        --deep: #123d2b;
        --gold: #c7922c;
        --blue: #315d8f;
        background: #fbfaf6;
        color: var(--ink);
        font-family: "Poppins", sans-serif;
        overflow: hidden;
    }

    .person-wrap {
        width: min(1160px, calc(100% - 32px));
        margin: 0 auto;
    }

    .person-hero {
        position: relative;
        min-height: 600px;
        display: flex;
        align-items: center;
        color: #fff;
        background:
            linear-gradient(115deg, rgba(12, 24, 20, .9), rgba(31, 122, 77, .52), rgba(12, 24, 20, .18)),
            url('{{ asset('image/vil.jpg.png') }}') center/cover no-repeat;
        isolation: isolate;
    }

    .person-hero::after {
        content: "";
        position: absolute;
        inset: auto 0 0;
        height: 40%;
        z-index: -1;
        background: linear-gradient(0deg, #fbfaf6, transparent);
    }

    .person-hero-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(290px, 390px);
        gap: 30px;
        align-items: end;
        padding: 94px 0 92px;
    }

    .person-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f8d98b;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .person-kicker::before {
        content: "";
        width: 34px;
        height: 2px;
        border-radius: 99px;
        background: currentColor;
    }

    .person-hero h1 {
        margin: 18px 0 16px;
        font-size: clamp(46px, 8vw, 92px);
        line-height: .92;
        font-weight: 900;
        letter-spacing: 0;
        text-shadow: 0 26px 60px rgba(0, 0, 0, .28);
    }

    .person-hero p {
        max-width: 720px;
        color: rgba(255, 255, 255, .88);
        font-size: 17px;
        line-height: 1.78;
        margin: 0;
    }

    .person-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 28px;
    }

    .person-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 48px;
        border-radius: 999px;
        padding: 12px 18px;
        font-weight: 900;
        text-decoration: none;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .person-btn.primary {
        color: #2d1b00;
        background: var(--gold);
        box-shadow: 0 16px 34px rgba(199, 146, 44, .24);
    }

    .person-btn.secondary {
        color: #fff;
        border: 1px solid rgba(255, 255, 255, .32);
        background: rgba(255, 255, 255, .12);
        backdrop-filter: blur(10px);
    }

    .person-btn:hover {
        transform: translateY(-2px);
    }

    .person-id {
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 8px;
        padding: 24px;
        background: rgba(255, 255, 255, .13);
        backdrop-filter: blur(16px);
        box-shadow: 0 26px 70px rgba(0, 0, 0, .2);
    }

    .person-avatar {
        width: 104px;
        height: 104px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        color: #fff;
        background: linear-gradient(135deg, var(--green), var(--deep));
        border: 4px solid rgba(199, 146, 44, .35);
        font-size: 32px;
        font-weight: 900;
        margin-bottom: 18px;
    }

    .person-id h2 {
        margin: 0 0 6px;
        font-size: 28px;
        font-weight: 900;
    }

    .person-id span {
        display: block;
        color: rgba(255, 255, 255, .78);
        line-height: 1.6;
    }

    .person-stats {
        position: relative;
        z-index: 3;
        margin-top: -52px;
    }

    .person-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .person-stat,
    .person-card,
    .person-side,
    .person-cta {
        border: 1px solid var(--line);
        border-radius: 8px;
        background: rgba(255, 255, 255, .88);
        box-shadow: 0 18px 46px rgba(27, 42, 33, .08);
    }

    .person-stat {
        padding: 22px;
    }

    .person-stat strong {
        display: block;
        color: var(--green);
        font-size: 32px;
        line-height: 1;
        margin-bottom: 8px;
        font-weight: 900;
    }

    .person-stat span {
        color: var(--muted);
        font-size: 13px;
        font-weight: 700;
    }

    .person-section {
        padding: 86px 0;
    }

    .person-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(280px, 360px);
        gap: 22px;
        align-items: start;
    }

    .person-stack {
        display: grid;
        gap: 18px;
    }

    .person-card,
    .person-side,
    .person-cta {
        padding: 28px;
    }

    .person-card h2,
    .person-side h2,
    .person-cta h2 {
        margin: 0 0 12px;
        font-size: clamp(24px, 3vw, 36px);
        line-height: 1.14;
        font-weight: 900;
    }

    .person-card p,
    .person-side p,
    .person-cta p {
        color: var(--muted);
        line-height: 1.78;
        margin: 0;
    }

    .person-timeline {
        display: grid;
        gap: 14px;
        margin-top: 18px;
    }

    .person-step {
        display: grid;
        grid-template-columns: 108px 1fr;
        gap: 16px;
        padding: 16px;
        border: 1px solid rgba(16, 37, 28, .09);
        border-radius: 8px;
        background: #fff;
    }

    .person-step-year {
        display: grid;
        place-items: center;
        min-height: 70px;
        border-radius: 8px;
        color: #2d1b00;
        background: var(--gold);
        font-weight: 900;
        text-align: center;
        font-size: 13px;
        padding: 8px;
    }

    .person-step h3 {
        margin: 0 0 6px;
        font-size: 17px;
        font-weight: 900;
    }

    .person-step p {
        font-size: 14px;
    }

    .person-list {
        display: grid;
        gap: 10px;
        margin-top: 16px;
    }

    .person-list div {
        border: 1px solid rgba(16, 37, 28, .09);
        border-radius: 8px;
        padding: 13px;
        background: #fff;
        color: #274034;
        font-weight: 700;
    }

    .person-side {
        position: sticky;
        top: 96px;
        background:
            linear-gradient(145deg, rgba(18, 61, 43, .96), rgba(31, 122, 77, .9)),
            url('{{ asset('image/bijrol.jpg.png') }}') center/cover;
        color: #fff;
    }

    .person-side p {
        color: rgba(255, 255, 255, .78);
    }

    .person-side .person-list div {
        border-color: rgba(255, 255, 255, .14);
        color: #fff;
        background: rgba(255, 255, 255, .12);
    }

    .person-cta {
        margin-top: 22px;
        text-align: center;
        background: linear-gradient(135deg, var(--deep), var(--green));
        color: #fff;
    }

    .person-cta p {
        color: rgba(255, 255, 255, .82);
        max-width: 720px;
        margin: 0 auto 22px;
    }

    @media (max-width: 960px) {
        .person-hero-grid,
        .person-layout {
            grid-template-columns: 1fr;
        }

        .person-side {
            position: static;
        }
    }

    @media (max-width: 680px) {
        .person-wrap {
            width: min(100% - 20px, 1160px);
        }

        .person-hero {
            min-height: auto;
        }

        .person-hero-grid {
            padding: 72px 0 74px;
        }

        .person-stats {
            margin-top: 0;
            padding-top: 16px;
        }

        .person-stats-grid,
        .person-step {
            grid-template-columns: 1fr;
        }

        .person-section {
            padding: 62px 0;
        }

        .person-card,
        .person-side,
        .person-cta,
        .person-id {
            padding: 22px;
        }
    }
</style>
@endpush

@section('content')
<main class="person-page">
    <section class="person-hero">
        <div class="person-wrap person-hero-grid">
            <div>
                <span class="person-kicker">Bijrol Pride | MMA</span>
                <h1>Puja Tomar</h1>
                <p>A history-making mixed martial artist whose UFC debut win became a landmark moment for Indian combat sports and a source of pride for Bijrol.</p>
                <div class="person-actions">
                    <a class="person-btn primary" href="/whos-who">Back to Who's Who</a>
                    <a class="person-btn secondary" href="/contact">Share verified details</a>
                </div>
            </div>
            <aside class="person-id">
                <div class="person-avatar">PT</div>
                <h2>The Cyclone</h2>
                <span>Mixed martial artist, MFN champion, and first Indian fighter to win a UFC bout.</span>
            </aside>
        </div>
    </section>

    <section class="person-stats">
        <div class="person-wrap person-stats-grid">
            @foreach ($stats as $stat)
                <article class="person-stat"><strong>{{ $stat['value'] }}</strong><span>{{ $stat['label'] }}</span></article>
            @endforeach
        </div>
    </section>

    <section class="person-section">
        <div class="person-wrap person-layout">
            <div class="person-stack">
                <article class="person-card">
                    <h2>Profile</h2>
                    <p>Puja Tomar represents discipline, confidence, and the rise of Indian athletes on global combat-sports platforms. Her story is especially powerful for young girls who want to pursue sport with seriousness and courage.</p>
                </article>

                <article class="person-card">
                    <h2>Journey & Milestones</h2>
                    <div class="person-timeline">
                        @foreach ($timeline as $item)
                            <div class="person-step">
                                <div class="person-step-year">{{ $item['year'] }}</div>
                                <div>
                                    <h3>{{ $item['title'] }}</h3>
                                    <p>{{ $item['text'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </article>

                <article class="person-card">
                    <h2>Why Bijrol Is Proud</h2>
                    <p>Her achievements show that people connected with small-town and village roots can reach the most competitive global stages through training, focus, and resilience.</p>
                </article>
            </div>

            <aside class="person-side">
                <h2>Highlights</h2>
                <p>Key points that make this profile important for the village record.</p>
                <div class="person-list">
                    @foreach ($highlights as $highlight)
                        <div>{{ $highlight }}</div>
                    @endforeach
                </div>
            </aside>
        </div>

        <div class="person-wrap">
            <div class="person-cta">
                <h2>More Achievers From Bijrol</h2>
                <p>Explore other profiles and help keep this section updated with verified achievements, photos, and public records.</p>
                <a class="person-btn primary" href="/whos-who">View all profiles</a>
            </div>
        </div>
    </section>
</main>
@endsection
