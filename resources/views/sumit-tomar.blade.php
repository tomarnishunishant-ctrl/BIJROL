@extends('layouts.app')

@section('title', 'Sumit Tomar | Guinness World Record Holder | BIJROL')

@php
    $stats = [
        ['value' => '1,700m', 'label' => 'No-hands wheelie'],
        ['value' => '2024', 'label' => 'Record attempt'],
        ['value' => 'ASC', 'label' => 'Tornadoes inspiration'],
    ];

    $timeline = [
        ['year' => 'Bijrol', 'title' => 'Village Roots', 'text' => 'Sumit Tomar comes from Bijrol village in Baghpat district, Uttar Pradesh, carrying a legacy of courage and discipline.'],
        ['year' => 'Army', 'title' => 'Service And Training', 'text' => 'His journey is connected with the Indian Army and the high-skill motorcycle display culture of the ASC Tornadoes.'],
        ['year' => 'Dec 2024', 'title' => 'World Record Attempt', 'text' => 'He attempted the longest no-hands motorcycle wheelie on the Bengaluru-Chennai Expressway.'],
        ['year' => 'Record', 'title' => 'Guinness Recognition', 'text' => 'The feat covered around 1,700 meters, surpassing the earlier record and bringing attention to Bijrol and Baghpat.'],
    ];

    $highlights = [
        'Guinness World Record for no-hands motorcycle wheelie',
        'Around 1,700 meters covered on one rear wheel',
        'Connected with Indian Army discipline and stunt-riding training',
        'A proud name from Bijrol village, Baghpat',
    ];
@endphp

@push('styles')
<style>
    .person-page {
        --ink: #111c2b;
        --muted: #687385;
        --line: rgba(17, 28, 43, .12);
        --green: #54642f;
        --deep: #162235;
        --gold: #c7922c;
        --red: #b7352f;
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
            linear-gradient(115deg, rgba(16, 28, 43, .92), rgba(49, 93, 143, .46), rgba(84, 100, 47, .22)),
            url('{{ asset('image/bijrol.jpg.png') }}') center/cover no-repeat;
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
        background: linear-gradient(135deg, var(--deep), #315d8f);
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
        box-shadow: 0 18px 46px rgba(17, 28, 43, .08);
    }

    .person-stat {
        padding: 22px;
    }

    .person-stat strong {
        display: block;
        color: #315d8f;
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
        border: 1px solid rgba(17, 28, 43, .09);
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
        border: 1px solid rgba(17, 28, 43, .09);
        border-radius: 8px;
        padding: 13px;
        background: #fff;
        color: #253247;
        font-weight: 700;
    }

    .person-side {
        position: sticky;
        top: 96px;
        background:
            linear-gradient(145deg, rgba(22, 34, 53, .96), rgba(49, 93, 143, .9)),
            url('{{ asset('image/main.jpg.jpg') }}') center/cover;
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
        background: linear-gradient(135deg, var(--deep), #315d8f);
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
                <span class="person-kicker">Bijrol Pride | World Record</span>
                <h1>Sumit Tomar</h1>
                <p>A Guinness World Record holder from Bijrol, known for an extraordinary no-hands motorcycle wheelie and the discipline of Indian Army training.</p>
                <div class="person-actions">
                    <a class="person-btn primary" href="/whos-who">Back to Who's Who</a>
                    <a class="person-btn secondary" href="/contact">Share verified details</a>
                </div>
            </div>
            <aside class="person-id">
                <div class="person-avatar">ST</div>
                <h2>Record Rider</h2>
                <span>Guinness World Record holder for the longest no-hands motorcycle wheelie.</span>
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
                    <p>Sumit Tomar has become a proud name for Bijrol and Baghpat through a rare display of balance, courage, and technical control. His record reflects the focus and discipline required for high-risk motorcycle stunt riding.</p>
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
                    <p>His world-record achievement proves that village talent, when supported by discipline and training, can stand on an international stage and inspire the next generation to dream bigger.</p>
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
