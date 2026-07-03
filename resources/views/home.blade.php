@extends('layouts.app')

@section('title', 'Home | BIJROL Village')

@php
    $localImage = fn ($file) => asset('image/' . $file);

    $stats = [
        ['value' => 11742, 'suffix' => '+', 'label' => 'Residents', 'text' => 'people shaping a living rural community'],
        ['value' => 1809, 'suffix' => '', 'label' => 'Households', 'text' => 'families connected by fields and heritage'],
        ['value' => 63.75, 'suffix' => '%', 'label' => 'Literacy Rate', 'text' => 'education growing across generations'],
        ['value' => 1857, 'suffix' => '', 'label' => 'Freedom Legacy', 'text' => 'the year tied to Shahmal Tomar courage'],
    ];

    $panchayatContacts = [
        [
            'name' => 'Harender Singh',
            'role' => 'Sarpanch',
            'phone' => '9412631970',
            'email' => 'HARENDERTOMAR3@GMAIL.COM',
            'initials' => 'HS',
        ],
        [
            'name' => 'Pawan Singh Rana',
            'role' => 'Secretary',
            'phone' => '9997235137',
            'email' => 'PAWANRANAG@GMAIL.COM',
            'initials' => 'PR',
        ],
    ];

    $timeline = [
        [
            'year' => '1797',
            'title' => 'Born In Bijrol',
            'text' => 'Raja Shahmal Singh Tomar, also remembered as Sah Mal, was born in Bijrol and grew into a respected local leader.',
        ],
        [
            'year' => '1857',
            'title' => 'Baraut Region Leadership',
            'text' => 'During the 1857 uprising, he inspired people around Baraut and Baghpat to stand against East India Company rule.',
        ],
        [
            'year' => '18 Jul 1857',
            'title' => 'Martyrdom And Memory',
            'text' => 'He fought with courage near Baraut and attained martyrdom, leaving a legacy that remains central to Bijrol pride.',
        ],
        [
            'year' => 'Today',
            'title' => 'Digital Heritage',
            'text' => 'Bijrol now carries this history through a modern digital identity for residents, visitors, and the next generation.',
        ],
    ];

    $gallery = [
        ['image' => $localImage('shahmal.jpeg'), 'title' => 'Baba Shahmal Singh Tomar', 'tag' => '1857 Legacy'],
        ['image' => $localImage('t1.jpeg'), 'title' => 'Radha Krishna Darshan', 'tag' => 'Temple'],
        ['image' => $localImage('t2.jpeg'), 'title' => 'Temple Lights', 'tag' => 'Devotion'],
        ['image' => $localImage('home-hero-generated.png'), 'title' => 'Village Road And Fields', 'tag' => 'Landscape'],
        ['image' => $localImage('bijrol.jpg.png'), 'title' => 'Bijrol Identity', 'tag' => 'Heritage'],
        ['image' => $localImage('main.jpg.jpg'), 'title' => 'Community Life', 'tag' => 'People'],
        ['image' => $localImage('vil.jpg.png'), 'title' => 'Rural Setting', 'tag' => 'Village'],
        ['image' => $localImage('h2.jpg'), 'title' => 'Public Facilities', 'tag' => 'Services'],
    ];

    $tourStops = [
        ['title' => 'Heritage Lane', 'text' => 'A guided visual stop for history, village identity, and Shahmal Tomar memory.'],
        ['title' => 'Fields And Pathways', 'text' => 'The agricultural landscape that defines the everyday rhythm of Bijrol.'],
        ['title' => 'Public Facilities', 'text' => 'Schools, healthcare, government service points, and civic information.'],
    ];

    $testimonials = [
        ['name' => 'Village Resident', 'role' => 'Bijrol Community', 'text' => 'The website now feels like a complete digital identity for our village, not just a set of pages.'],
        ['name' => 'Student Voice', 'role' => 'Young Generation', 'text' => 'Reading about Shahmal Tomar on the homepage makes the village history feel close and important.'],
        ['name' => 'Visitor', 'role' => 'Heritage Explorer', 'text' => 'The gallery, map, and timeline make Bijrol easier to understand before visiting.'],
    ];

    $atAGlance = [
        ['label' => 'PIN Code', 'value' => '250620'],
        ['label' => 'Block', 'value' => 'Baraut'],
        ['label' => 'District', 'value' => 'Baghpat'],
        ['label' => 'State', 'value' => 'Uttar Pradesh'],
        ['label' => 'Nearest Town', 'value' => 'Baraut'],
        ['label' => 'Population', 'value' => '11,742+'],
    ];

    $topHeritageCards = [
        ['title' => 'Historic Identity', 'text' => 'Bijrol is remembered as a living heritage of western Uttar Pradesh, culture, and the freedom struggle.'],
        ['title' => '1857 Legacy', 'text' => 'Baba Shahmal Singh Tomar led organized resistance against foreign rule from this region.'],
        ['title' => 'Cultural Memory', 'text' => 'Old routes, ponds, religious places, memorials, stories, and people together shape village identity.'],
    ];

@endphp

@push('styles')
<style>
    .home-showcase {
        --ink: #101c18;
        --muted: #65746d;
        --line: rgba(16, 28, 24, .12);
        --green: #1f7a4d;
        --deep: #102e24;
        --gold: #c7922c;
        --blue: #315d8f;
        --paper: #fbf1df;
        --glass: rgba(255, 255, 255, .78);
        --shadow: 0 24px 70px rgba(16, 28, 24, .12);
        background:
            radial-gradient(circle at 8% 6%, rgba(31, 122, 77, .18), transparent 28rem),
            radial-gradient(circle at 92% 10%, rgba(199, 146, 44, .22), transparent 26rem),
            radial-gradient(circle at 18% 88%, rgba(49, 93, 143, .12), transparent 28rem),
            var(--paper);
        color: var(--ink);
        font-family: "Poppins", sans-serif;
        overflow: hidden;
    }

    .hs-wrap {
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
    }

    .hs-glass {
        border: 1px solid var(--line);
        border-radius: 8px;
        background: var(--glass);
        box-shadow: var(--shadow);
        backdrop-filter: blur(18px);
    }

    .hs-hero {
        position: relative;
        min-height: calc(100vh - 82px);
        display: grid;
        align-items: center;
        isolation: isolate;
        color: var(--ink);
        background:
            linear-gradient(115deg, rgba(255, 239, 203, .95) 0%, rgba(224, 247, 229, .92) 45%, rgba(255, 226, 205, .94) 100%);
        overflow: hidden;
    }

    .hs-hero-bg {
        position: absolute;
        inset: 0;
        z-index: -2;
        background:
            linear-gradient(90deg, rgba(31, 122, 77, .08) 1px, transparent 1px),
            linear-gradient(0deg, rgba(199, 146, 44, .08) 1px, transparent 1px);
        background-size: 88px 88px;
        opacity: .5;
        transform: translateY(calc(var(--scroll, 0) * .04px));
        will-change: transform;
    }

    .hs-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        z-index: -1;
        background:
            radial-gradient(circle at 85% 18%, rgba(199, 146, 44, .3), transparent 26%),
            radial-gradient(circle at 8% 22%, rgba(31, 122, 77, .22), transparent 28%),
            radial-gradient(circle at 52% 86%, rgba(49, 93, 143, .14), transparent 28%),
            linear-gradient(180deg, transparent 0%, rgba(251, 241, 223, 1) 100%);
    }

    .hs-portal-hero {
        min-height: calc(100vh - 82px);
        display: grid;
        grid-template-columns: minmax(0, .92fr) minmax(420px, 1.08fr);
        gap: 46px;
        align-items: center;
        padding: 76px 0 62px;
    }

    .hs-portal-copy {
        max-width: 650px;
    }

    .hs-location-chip {
        display: inline-flex;
        align-items: center;
        min-height: 38px;
        border-radius: 999px;
        padding: 8px 13px;
        color: var(--deep);
        background: linear-gradient(135deg, #fff, #fff5da);
        border: 1px solid rgba(16, 28, 24, .1);
        box-shadow: 0 12px 30px rgba(16, 28, 24, .08);
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .hs-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f8d98b;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .hs-kicker::before {
        content: "";
        width: 34px;
        height: 2px;
        background: currentColor;
        border-radius: 99px;
    }

    .hs-portal-copy h1 {
        margin: 18px 0 16px;
        color: var(--deep);
        font-size: clamp(44px, 7vw, 86px);
        line-height: .94;
        font-weight: 900;
        letter-spacing: 0;
        text-wrap: balance;
    }

    .hs-portal-copy p {
        max-width: 610px;
        margin: 0;
        color: var(--muted);
        font-size: 17px;
        line-height: 1.82;
    }

    .hs-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 28px;
    }

    .hs-btn {
        min-height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        padding: 12px 18px;
        border: 1px solid rgba(16, 28, 24, .12);
        color: var(--deep);
        background: rgba(255, 255, 255, .76);
        text-decoration: none;
        font-weight: 900;
        transition: transform .2s ease, background .2s ease;
        backdrop-filter: blur(14px);
    }

    .hs-btn:hover {
        color: var(--deep);
        transform: translateY(-2px);
        background: #fff;
    }

    .hs-btn.primary {
        color: #2d1b00;
        border-color: transparent;
        background: linear-gradient(135deg, #f4c867, #c7922c);
        box-shadow: 0 18px 40px rgba(199, 146, 44, .32);
    }

    .hs-btn.primary:hover {
        color: #2d1b00;
        background: #dca244;
    }

    .hs-mini-facts {
        display: flex;
        flex-wrap: wrap;
        gap: 9px;
        margin-top: 24px;
    }

    .hs-mini-facts span {
        display: inline-flex;
        align-items: center;
        min-height: 34px;
        border-radius: 999px;
        padding: 7px 11px;
        color: var(--deep);
        background: linear-gradient(135deg, rgba(255,255,255,.88), rgba(244,250,238,.84));
        border: 1px solid rgba(16, 28, 24, .1);
        font-size: 12px;
        font-weight: 850;
        backdrop-filter: blur(12px);
    }

    .hs-portal-visual {
        display: grid;
        grid-template-columns: 1fr .72fr;
        grid-template-rows: 260px 210px;
        gap: 14px;
        align-items: stretch;
    }

    .hs-portal-photo {
        position: relative;
        margin: 0;
        overflow: hidden;
        border-radius: 8px;
        background: var(--deep);
        box-shadow: 0 24px 60px rgba(16, 28, 24, .16);
        border: 1px solid rgba(255, 255, 255, .72);
    }

    .hs-portal-photo:first-child {
        grid-row: span 2;
    }

    .hs-portal-photo img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .hs-portal-photo::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 38%, rgba(8, 33, 24, .74));
    }

    .hs-portal-photo span {
        position: absolute;
        left: 16px;
        right: 16px;
        bottom: 15px;
        z-index: 2;
        color: #fff;
        font-size: 13px;
        font-weight: 900;
        line-height: 1.35;
    }

    .hs-portal-note {
        display: grid;
        grid-template-columns: 54px 1fr;
        gap: 12px;
        align-items: center;
        margin-top: 18px;
        padding: 14px;
        background:
            linear-gradient(135deg, rgba(255,255,255,.95), rgba(255,246,225,.9));
        border: 1px solid var(--line);
        border-radius: 8px;
        box-shadow: 0 16px 42px rgba(16, 28, 24, .08);
    }

    .hs-portal-note strong {
        width: 54px;
        height: 54px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        color: #fff;
        background: linear-gradient(135deg, var(--deep), var(--green), #c7922c);
        font-weight: 900;
    }

    .hs-portal-note span {
        display: block;
        color: var(--deep);
        font-weight: 900;
    }

    .hs-portal-note small {
        display: block;
        margin-top: 3px;
        color: var(--muted);
        line-height: 1.45;
    }

    .hs-section {
        position: relative;
        padding: 92px 0;
    }

    .hs-section.alt {
        background:
            radial-gradient(circle at 12% 20%, rgba(31, 122, 77, .1), transparent 24rem),
            radial-gradient(circle at 88% 10%, rgba(199, 146, 44, .13), transparent 22rem),
            linear-gradient(180deg, rgba(255,250,237,.72), rgba(230, 246, 234, .78));
    }

    .hs-top-heritage {
        position: relative;
        padding: 44px 0 30px;
        background:
            radial-gradient(circle at 10% 10%, rgba(31, 122, 77, .16), transparent 30%),
            radial-gradient(circle at 90% 16%, rgba(199, 146, 44, .18), transparent 32%),
            linear-gradient(180deg, #fbf1df 0%, #fffaf0 100%);
        overflow: hidden;
    }

    .hs-top-heritage::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(31, 122, 77, .045) 1px, transparent 1px),
            linear-gradient(0deg, rgba(199, 146, 44, .045) 1px, transparent 1px);
        background-size: 72px 72px;
        pointer-events: none;
    }

    .hs-top-heritage-grid {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: minmax(0, .62fr) minmax(320px, .38fr);
        gap: 18px;
        align-items: stretch;
    }

    .hs-top-heritage-main,
    .hs-top-heritage-side {
        border: 1px solid rgba(16, 28, 24, .12);
        border-radius: 8px;
        background: rgba(255, 255, 255, .78);
        box-shadow: 0 20px 54px rgba(16, 28, 24, .1);
        backdrop-filter: blur(18px);
    }

    .hs-top-heritage-main {
        padding: 26px;
        animation: hsHeritageRise .78s cubic-bezier(.2, .8, .2, 1) both;
    }

    .hs-top-heritage-main h2 {
        margin: 10px 0 12px;
        color: var(--deep);
        font-size: clamp(32px, 4.8vw, 58px);
        line-height: 1.02;
        font-weight: 950;
        letter-spacing: 0;
    }

    .hs-top-heritage-main p {
        margin: 0;
        color: var(--muted);
        font-size: 15.5px;
        line-height: 1.78;
    }

    .hs-top-heritage-main p + p {
        margin-top: 12px;
    }

    .hs-top-heritage-side {
        display: grid;
        gap: 10px;
        padding: 16px;
        animation: hsHeritageRise .78s cubic-bezier(.2, .8, .2, 1) both .08s;
    }

    .hs-top-heritage-card {
        position: relative;
        min-height: 112px;
        padding: 16px;
        overflow: hidden;
        border: 1px solid rgba(16, 28, 24, .1);
        border-radius: 8px;
        background: linear-gradient(135deg, rgba(255,255,255,.88), rgba(244,250,238,.9));
        transition: transform .22s ease, box-shadow .22s ease;
    }

    .hs-top-heritage-card::before {
        content: "";
        position: absolute;
        inset: 0 auto 0 0;
        width: 4px;
        background: linear-gradient(180deg, var(--green), #c7922c);
    }

    .hs-top-heritage-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 32px rgba(16, 28, 24, .11);
    }

    .hs-top-heritage-card strong {
        display: block;
        color: var(--deep);
        font-size: 16px;
        font-weight: 950;
        margin-bottom: 6px;
    }

    .hs-top-heritage-card span {
        display: block;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.55;
        font-weight: 650;
    }

    @keyframes hsHeritageRise {
        from {
            opacity: 0;
            transform: translateY(18px) scale(.985);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .hs-quick {
        padding: 36px 0 0;
    }

    .hs-quick-grid {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        gap: 10px;
    }

    .hs-quick-card {
        min-height: 112px;
        padding: 15px;
        color: inherit;
        text-decoration: none;
        transition: transform .2s ease, border-color .2s ease, background .2s ease;
    }

    .hs-quick-card:nth-child(4n+1) { background: linear-gradient(135deg, rgba(255,255,255,.82), rgba(232,247,235,.9)); }
    .hs-quick-card:nth-child(4n+2) { background: linear-gradient(135deg, rgba(255,255,255,.82), rgba(255,242,212,.92)); }
    .hs-quick-card:nth-child(4n+3) { background: linear-gradient(135deg, rgba(255,255,255,.82), rgba(229,239,250,.9)); }
    .hs-quick-card:nth-child(4n+4) { background: linear-gradient(135deg, rgba(255,255,255,.82), rgba(255,230,221,.88)); }

    .hs-quick-card:hover {
        color: inherit;
        transform: translateY(-3px);
        border-color: rgba(199, 146, 44, .42);
        background: rgba(255, 255, 255, .88);
    }

    .hs-quick-card strong {
        display: block;
        color: var(--deep);
        font-weight: 900;
    }

    .hs-quick-card span {
        display: block;
        margin-top: 8px;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.45;
    }

    .hs-glance {
        display: grid;
        grid-template-columns: minmax(0, .82fr) minmax(0, 1.18fr);
        gap: 20px;
        align-items: stretch;
    }

    .hs-glance-panel,
    .hs-local-panel {
        padding: 26px;
    }

    .hs-glance-panel h2,
    .hs-local-panel h2 {
        margin: 10px 0 12px;
        color: var(--deep);
        font-size: clamp(28px, 4vw, 48px);
        line-height: 1.08;
        font-weight: 900;
    }

    .hs-glance-panel p,
    .hs-local-panel p {
        color: var(--muted);
        line-height: 1.72;
        margin: 0;
    }

    .hs-glance-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
        margin-top: 20px;
    }

    .hs-glance-item {
        padding: 14px;
        border-radius: 8px;
        border: 1px solid var(--line);
        background: rgba(255, 255, 255, .78);
    }

    .hs-glance-item:nth-child(3n+1) { background: linear-gradient(135deg, #fff, #eef9ef); }
    .hs-glance-item:nth-child(3n+2) { background: linear-gradient(135deg, #fff, #fff3d7); }
    .hs-glance-item:nth-child(3n+3) { background: linear-gradient(135deg, #fff, #eaf2fb); }

    .hs-glance-item span {
        display: block;
        color: var(--muted);
        font-size: 12px;
        font-weight: 850;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .hs-glance-item strong {
        display: block;
        margin-top: 5px;
        color: var(--deep);
        font-size: 18px;
        font-weight: 900;
    }

    .hs-local-panel {
        color: #fff;
        background:
            linear-gradient(90deg, rgba(8, 33, 24, .96), rgba(8, 33, 24, .56)),
            url('{{ $localImage('t1.jpeg') }}') center/cover no-repeat;
    }

    .hs-local-panel h2 {
        color: #fff;
    }

    .hs-local-panel p {
        color: rgba(255, 255, 255, .86);
        max-width: 620px;
    }

    .hs-local-thumbs {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
        margin-top: 22px;
    }

    .hs-local-thumbs img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, .3);
    }

    .hs-heading {
        max-width: 820px;
        margin: 0 auto 44px;
        text-align: center;
    }

    .hs-heading h2 {
        margin: 12px 0 12px;
        color: var(--deep);
        font-size: clamp(34px, 5vw, 64px);
        line-height: 1.05;
        font-weight: 900;
        letter-spacing: 0;
        text-wrap: balance;
    }

    .hs-heading p {
        margin: 0;
        color: var(--muted);
        line-height: 1.8;
    }

    .hs-stats {
        margin-top: -42px;
        position: relative;
        z-index: 3;
    }

    .hs-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .hs-stat {
        padding: 22px;
        min-height: 150px;
    }

    .hs-stat:nth-child(4n+1) { background: linear-gradient(135deg, rgba(255,255,255,.86), rgba(231,247,236,.94)); }
    .hs-stat:nth-child(4n+2) { background: linear-gradient(135deg, rgba(255,255,255,.86), rgba(255,242,212,.94)); }
    .hs-stat:nth-child(4n+3) { background: linear-gradient(135deg, rgba(255,255,255,.86), rgba(230,239,250,.94)); }
    .hs-stat:nth-child(4n+4) { background: linear-gradient(135deg, rgba(255,255,255,.86), rgba(255,232,222,.94)); }

    .hs-stat strong {
        display: block;
        color: var(--deep);
        font-size: clamp(30px, 4vw, 46px);
        line-height: 1;
        font-weight: 900;
    }

    .hs-stat span {
        display: block;
        margin-top: 8px;
        color: var(--green);
        font-weight: 900;
    }

    .hs-stat p {
        margin: 8px 0 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .hs-panchayat-strip {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        align-items: center;
        margin-top: 14px;
        padding: 12px;
    }

    .hs-contact-person {
        display: grid;
        grid-template-columns: 54px 1fr;
        gap: 12px;
        align-items: center;
        min-height: 92px;
        padding: 14px;
        border-radius: 8px;
        background: rgba(255, 255, 255, .78);
        border: 1px solid var(--line);
    }

    .hs-person-avatar {
        width: 54px;
        height: 54px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        color: #fff;
        background: linear-gradient(135deg, var(--deep), var(--green));
        border: 2px solid rgba(199, 146, 44, .34);
        font-size: 16px;
        font-weight: 900;
    }

    .hs-contact-person h3 {
        margin: 0 0 4px;
        color: var(--deep);
        font-size: 18px;
        line-height: 1.2;
        font-weight: 900;
    }

    .hs-contact-person p {
        margin: 0;
        color: var(--green);
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .hs-contact-links {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 8px;
    }

    .hs-contact-links a {
        display: inline-flex;
        align-items: center;
        min-height: 30px;
        border-radius: 999px;
        padding: 6px 10px;
        color: var(--deep);
        border: 1px solid rgba(16, 28, 24, .1);
        background: #fff;
        text-decoration: none;
        font-size: 12px;
        font-weight: 850;
    }

    .hs-timeline {
        display: grid;
        grid-template-columns: minmax(260px, .45fr) minmax(0, .55fr);
        gap: 20px;
        align-items: stretch;
    }

    .hs-timeline-nav {
        display: grid;
        gap: 10px;
    }

    .hs-time-btn {
        display: grid;
        grid-template-columns: 92px 1fr;
        gap: 14px;
        align-items: center;
        width: 100%;
        border: 1px solid var(--line);
        border-radius: 8px;
        padding: 14px;
        color: var(--ink);
        background: rgba(255, 255, 255, .72);
        text-align: left;
        cursor: pointer;
        transition: transform .2s ease, border-color .2s ease, background .2s ease;
    }

    .hs-time-btn:hover,
    .hs-time-btn.is-active {
        transform: translateY(-2px);
        border-color: rgba(199, 146, 44, .44);
        background: #fff;
    }

    .hs-time-btn strong {
        display: grid;
        place-items: center;
        min-height: 58px;
        border-radius: 8px;
        color: #2d1b00;
        background: var(--gold);
        font-size: 13px;
        font-weight: 900;
    }

    .hs-time-btn span {
        font-weight: 900;
    }

    .hs-timeline-stage {
        position: relative;
        min-height: 520px;
        overflow: hidden;
        color: #fff;
        padding: 34px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        background:
            linear-gradient(180deg, rgba(16, 46, 36, .08), rgba(16, 46, 36, .92)),
            url('{{ $localImage('bijrol.jpg.png') }}') center/cover no-repeat;
    }

    .hs-timeline-stage::before {
        content: attr(data-year);
        position: absolute;
        top: 18px;
        right: 24px;
        color: rgba(255, 255, 255, .18);
        font-size: clamp(64px, 12vw, 150px);
        line-height: 1;
        font-weight: 900;
    }

    .hs-timeline-stage h3 {
        position: relative;
        margin: 0 0 12px;
        font-size: clamp(32px, 5vw, 58px);
        line-height: 1.04;
        font-weight: 900;
    }

    .hs-timeline-stage p {
        position: relative;
        max-width: 650px;
        margin: 0;
        color: rgba(255, 255, 255, .86);
        line-height: 1.82;
    }

    .hs-gallery {
        display: grid;
        grid-template-columns: 1.15fr .85fr;
        gap: 16px;
    }

    .hs-gallery-main,
    .hs-gallery-side {
        display: grid;
        gap: 16px;
    }

    .hs-gallery-main {
        grid-template-columns: 1fr;
    }

    .hs-gallery-side {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .hs-photo {
        position: relative;
        min-height: 260px;
        overflow: hidden;
        color: #fff;
        text-decoration: none;
    }

    .hs-photo.large {
        min-height: 536px;
    }

    .hs-photo img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: transform .55s ease;
    }

    .hs-photo:hover img {
        transform: scale(1.05);
    }

    .hs-photo::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 38%, rgba(8, 33, 24, .86));
    }

    .hs-photo-info {
        position: absolute;
        left: 18px;
        right: 18px;
        bottom: 18px;
        z-index: 2;
    }

    .hs-photo-info span {
        display: inline-flex;
        margin-bottom: 8px;
        border-radius: 999px;
        padding: 6px 9px;
        color: #2d1b00;
        background: var(--gold);
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
    }

    .hs-photo-info strong {
        display: block;
        font-size: 20px;
        line-height: 1.2;
        font-weight: 900;
    }

    .hs-tour {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(280px, 380px);
        gap: 20px;
        align-items: stretch;
    }

    .hs-panorama {
        position: relative;
        min-height: 480px;
        overflow: hidden;
        background: #102e24;
    }

    .hs-panorama-track {
        position: absolute;
        inset: 0;
        width: 180%;
        background:
            linear-gradient(180deg, rgba(16, 46, 36, .04), rgba(16, 46, 36, .52)),
            url('{{ $localImage('home-hero-generated.png') }}') center/cover repeat-x;
        transform: translateX(calc(var(--tour-x, 0) * -1%));
        transition: transform .6s ease;
    }

    .hs-panorama::after {
        content: "360 Virtual Village Tour";
        position: absolute;
        left: 22px;
        bottom: 22px;
        z-index: 2;
        color: #fff;
        font-size: clamp(28px, 4vw, 52px);
        line-height: 1;
        font-weight: 900;
        max-width: 520px;
    }

    .hs-tour-panel {
        padding: 24px;
    }

    .hs-tour-panel h3 {
        margin: 0 0 10px;
        color: var(--deep);
        font-size: 30px;
        font-weight: 900;
    }

    .hs-tour-panel p {
        color: var(--muted);
        line-height: 1.7;
        margin: 0;
    }

    .hs-tour-stops {
        display: grid;
        gap: 10px;
        margin-top: 20px;
    }

    .hs-tour-stop {
        border: 1px solid var(--line);
        border-radius: 8px;
        padding: 13px;
        background: #fff;
        cursor: pointer;
        transition: transform .2s ease, border-color .2s ease;
    }

    .hs-tour-stop:hover,
    .hs-tour-stop.is-active {
        transform: translateX(4px);
        border-color: rgba(199, 146, 44, .48);
    }

    .hs-tour-stop strong {
        display: block;
        color: var(--deep);
        font-weight: 900;
    }

    .hs-tour-stop span {
        display: block;
        margin-top: 4px;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.55;
    }

    .hs-testimonial {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 160px;
        gap: 22px;
        align-items: center;
        padding: clamp(24px, 4vw, 44px);
    }

    .hs-quote {
        display: none;
    }

    .hs-quote.is-active {
        display: block;
        animation: fadeIn .35s ease both;
    }

    .hs-quote p {
        margin: 0 0 18px;
        color: var(--deep);
        font-size: clamp(24px, 4vw, 44px);
        line-height: 1.18;
        font-weight: 900;
        text-wrap: balance;
    }

    .hs-quote strong {
        display: block;
        color: var(--green);
        font-weight: 900;
    }

    .hs-quote span {
        color: var(--muted);
        font-size: 14px;
    }

    .hs-carousel-controls {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .hs-icon-btn {
        width: 52px;
        height: 52px;
        display: grid;
        place-items: center;
        border: 1px solid var(--line);
        border-radius: 50%;
        color: var(--deep);
        background: #fff;
        font-weight: 900;
        cursor: pointer;
        transition: transform .2s ease;
    }

    .hs-icon-btn:hover {
        transform: translateY(-2px);
    }

    .hs-map-grid {
        display: grid;
        grid-template-columns: minmax(0, .85fr) minmax(0, 1.15fr);
        gap: 20px;
        align-items: stretch;
    }

    .hs-map-panel {
        padding: 28px;
    }

    .hs-map-panel h3 {
        margin: 0 0 12px;
        color: var(--deep);
        font-size: 34px;
        line-height: 1.1;
        font-weight: 900;
    }

    .hs-map-panel p {
        margin: 0 0 20px;
        color: var(--muted);
        line-height: 1.75;
    }

    .hs-links {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .hs-link-card {
        padding: 14px;
        color: inherit;
        text-decoration: none;
        transition: transform .2s ease;
    }

    .hs-link-card:nth-child(odd) {
        background: linear-gradient(135deg, rgba(255,255,255,.86), rgba(236,248,239,.9));
    }

    .hs-link-card:nth-child(even) {
        background: linear-gradient(135deg, rgba(255,255,255,.86), rgba(255,243,218,.9));
    }

    .hs-link-card:hover {
        color: inherit;
        transform: translateY(-2px);
    }

    .hs-link-card strong {
        display: block;
        color: var(--deep);
        font-weight: 900;
    }

    .hs-link-card span {
        display: block;
        margin-top: 5px;
        color: var(--muted);
        font-size: 13px;
    }

    .hs-map {
        min-height: 430px;
        overflow: hidden;
    }

    .hs-map iframe {
        width: 100%;
        height: 100%;
        min-height: 430px;
        border: 0;
        display: block;
        filter: saturate(.9) contrast(1.05);
    }

    .hs-news-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .hs-news-card {
        padding: 28px;
    }

    .hs-news-card:nth-child(odd) {
        background: linear-gradient(135deg, rgba(255,255,255,.88), rgba(238,249,242,.92));
    }

    .hs-news-card:nth-child(even) {
        background: linear-gradient(135deg, rgba(255,255,255,.88), rgba(255,242,214,.92));
    }

    .hs-news-card h3 {
        margin: 10px 0 18px;
        color: var(--deep);
        font-size: 34px;
        font-weight: 900;
    }

    .hs-list {
        display: grid;
        gap: 12px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .hs-list li,
    .hs-event {
        display: block;
        border: 1px solid var(--line);
        border-radius: 8px;
        padding: 16px;
        color: inherit;
        background: rgba(255, 255, 255, .76);
        text-decoration: none;
    }

    .hs-list strong,
    .hs-event strong {
        display: block;
        color: var(--deep);
        font-weight: 900;
    }

    .hs-list span,
    .hs-event span {
        display: block;
        margin-top: 5px;
        color: var(--muted);
        line-height: 1.62;
        font-size: 14px;
    }

    .hs-empty {
        min-height: 160px;
        display: grid;
        align-content: center;
        gap: 8px;
        border: 1px dashed rgba(16, 28, 24, .2);
        border-radius: 8px;
        padding: 18px;
        background:
            linear-gradient(135deg, rgba(255, 255, 255, .82), rgba(247, 244, 236, .72)),
            url('{{ $localImage('vil.jpg.png') }}') center/cover no-repeat;
        background-blend-mode: screen;
    }

    .hs-empty strong {
        color: var(--deep);
        font-size: 18px;
        font-weight: 900;
    }

    .hs-empty span {
        color: var(--muted);
        line-height: 1.65;
        font-size: 14px;
    }

    .hs-cta {
        padding: clamp(28px, 5vw, 58px);
        color: #fff;
        text-align: center;
        background:
            linear-gradient(135deg, rgba(16, 46, 36, .96), rgba(31, 122, 77, .88)),
            url('{{ $localImage('bijrol.jpg.png') }}') center/cover no-repeat;
    }

    .hs-cta h2 {
        max-width: 860px;
        margin: 12px auto;
        font-size: clamp(34px, 6vw, 72px);
        line-height: 1.02;
        font-weight: 900;
    }

    .hs-cta p {
        max-width: 760px;
        margin: 0 auto;
        color: rgba(255, 255, 255, .84);
        line-height: 1.78;
    }

    .hs-cta .hs-btn {
        color: #fff;
        border-color: rgba(255, 255, 255, .26);
        background: rgba(255, 255, 255, .12);
    }

    .hs-cta .hs-btn:hover {
        color: #fff;
        background: rgba(255, 255, 255, .18);
    }

    .hs-cta .hs-btn.primary,
    .hs-cta .hs-btn.primary:hover {
        color: #2d1b00;
        background: var(--gold);
    }

    .hs-reveal {
        opacity: 0;
        transform: translateY(22px);
        transition: opacity .7s ease, transform .7s ease;
        transition-delay: var(--delay, 0s);
    }

    .hs-reveal.is-visible {
        opacity: 1;
        transform: none;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 1080px) {
        .hs-portal-hero,
        .hs-timeline,
        .hs-glance,
        .hs-gallery,
        .hs-tour,
        .hs-map-grid,
        .hs-news-grid,
        .hs-top-heritage-grid {
            grid-template-columns: 1fr;
        }

        .hs-quick-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .hs-stats-grid,
        .hs-gallery-side {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .hs-panchayat-strip {
            grid-template-columns: 1fr;
        }

        .hs-portal-hero {
            min-height: auto;
            padding-top: 58px;
        }

        .hs-top-heritage {
            padding: 34px 0 24px;
        }
    }

    @media (max-width: 700px) {
        .hs-wrap {
            width: min(100% - 20px, 1180px);
        }

        .hs-hero {
            min-height: auto;
        }

        .hs-portal-hero {
            padding: 44px 0 46px;
        }

        .hs-portal-copy h1 {
            font-size: clamp(38px, 12vw, 64px);
        }

        .hs-portal-copy p {
            font-size: 15px;
            line-height: 1.68;
        }

        .hs-top-heritage-main {
            padding: 20px;
        }

        .hs-top-heritage-main h2 {
            font-size: clamp(30px, 10vw, 44px);
        }

        .hs-actions,
        .hs-mini-facts {
            gap: 8px;
        }

        .hs-btn {
            width: 100%;
            min-height: 46px;
            border-radius: 8px;
        }

        .hs-portal-visual {
            grid-template-columns: 1fr;
            grid-template-rows: auto;
        }

        .hs-portal-photo,
        .hs-portal-photo:first-child {
            grid-row: auto;
            min-height: 260px;
        }

        .hs-section {
            padding: 64px 0;
        }

        .hs-quick {
            padding-top: 20px;
        }

        .hs-quick-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .hs-quick-card {
            min-height: 96px;
        }

        .hs-stats {
            margin-top: 0;
            padding-top: 14px;
        }

        .hs-stats-grid,
        .hs-panchayat-strip,
        .hs-glance-list,
        .hs-local-thumbs,
        .hs-gallery-side,
        .hs-time-btn,
        .hs-testimonial,
        .hs-links,
        .hs-contact-person {
            grid-template-columns: 1fr;
        }

        .hs-timeline-stage,
        .hs-panorama,
        .hs-photo.large {
            min-height: 390px;
        }

        .hs-carousel-controls {
            justify-content: flex-start;
        }
    }

    /* Premium colorful motion layer */
    .home-showcase {
        --ink: #081816;
        --muted: #53665f;
        --green: #00a66a;
        --deep: #05251f;
        --gold: #ffb703;
        --blue: #2563eb;
        --rose: #e11d48;
        --cyan: #06b6d4;
        --violet: #7c3aed;
        --paper: #fff7e7;
        --glass: rgba(255, 255, 255, .7);
        --line: rgba(8, 24, 22, .13);
        --shadow: 0 28px 80px rgba(8, 24, 22, .15);
        background:
            linear-gradient(115deg, rgba(255, 247, 231, .95), rgba(234, 255, 243, .9), rgba(238, 246, 255, .92));
    }

    .hs-hero {
        background:
            linear-gradient(135deg, rgba(255, 248, 224, .95), rgba(221, 255, 238, .9) 42%, rgba(225, 239, 255, .92) 100%);
    }

    .hs-premium-mesh {
        position: absolute;
        inset: -22%;
        z-index: -3;
        background:
            conic-gradient(from 120deg at 28% 32%, rgba(255, 183, 3, .48), rgba(0, 166, 106, .32), rgba(37, 99, 235, .3), rgba(225, 29, 72, .24), rgba(255, 183, 3, .48));
        filter: blur(34px) saturate(1.22);
        opacity: .82;
        animation: hsMeshDrift 18s ease-in-out infinite alternate;
    }

    .hs-motion-lines {
        position: absolute;
        inset: 0;
        z-index: -1;
        background:
            linear-gradient(115deg, transparent 0 22%, rgba(255, 255, 255, .45) 22.2% 22.8%, transparent 23% 44%, rgba(255, 183, 3, .18) 44.2% 44.7%, transparent 45% 100%),
            linear-gradient(90deg, rgba(8, 24, 22, .055) 1px, transparent 1px),
            linear-gradient(0deg, rgba(8, 24, 22, .04) 1px, transparent 1px);
        background-size: auto, 78px 78px, 78px 78px;
        mask-image: linear-gradient(180deg, rgba(0,0,0,.72), transparent 88%);
        animation: hsLineGlide 16s linear infinite;
    }

    .hs-hero-bg {
        background:
            linear-gradient(90deg, rgba(0, 166, 106, .11) 1px, transparent 1px),
            linear-gradient(0deg, rgba(37, 99, 235, .08) 1px, transparent 1px);
        background-size: 84px 84px;
        opacity: .7;
    }

    .hs-hero::after {
        background:
            linear-gradient(180deg, rgba(255,255,255,.15), rgba(255,247,231,.96) 98%),
            radial-gradient(ellipse at 74% 18%, rgba(255, 255, 255, .45), transparent 36%),
            radial-gradient(ellipse at 10% 68%, rgba(0, 166, 106, .18), transparent 34%);
    }

    .hs-location-chip,
    .hs-mini-facts span,
    .hs-glass {
        border-color: rgba(255, 255, 255, .72);
        background: linear-gradient(135deg, rgba(255,255,255,.72), rgba(255,255,255,.38));
        box-shadow: var(--shadow), inset 0 1px 0 rgba(255,255,255,.72);
    }

    .hs-kicker {
        color: #0f766e;
    }

    .hs-portal-copy h1 {
        background: linear-gradient(100deg, #05251f 0%, #00a66a 34%, #2563eb 68%, #e11d48 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: none;
    }

    .hs-portal-copy p {
        color: rgba(8, 24, 22, .74);
        font-weight: 600;
    }

    .hs-btn {
        position: relative;
        overflow: hidden;
        border-color: rgba(255,255,255,.72);
        background: rgba(255,255,255,.68);
        box-shadow: 0 18px 42px rgba(8, 24, 22, .1), inset 0 1px 0 rgba(255,255,255,.82);
    }

    .hs-btn::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(110deg, transparent 0 34%, rgba(255,255,255,.6) 48%, transparent 62% 100%);
        transform: translateX(-130%);
        transition: transform .7s ease;
    }

    .hs-btn:hover::after {
        transform: translateX(130%);
    }

    .hs-btn.primary {
        color: #fff;
        background: linear-gradient(135deg, #ff8a00, #e11d48 48%, #7c3aed);
        box-shadow: 0 22px 52px rgba(225, 29, 72, .28);
    }

    .hs-btn.primary:hover {
        color: #fff;
        background: linear-gradient(135deg, #ff9f1c, #f43f5e 48%, #8b5cf6);
    }

    .hs-floating-social {
        position: absolute;
        left: max(18px, calc((100vw - 1180px) / 2 - 70px));
        top: 50%;
        z-index: 4;
        display: grid;
        gap: 10px;
        transform: translateY(-50%);
    }

    .hs-floating-social a {
        width: 42px;
        height: 42px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        color: #05251f;
        background: rgba(255, 255, 255, .58);
        border: 1px solid rgba(255, 255, 255, .72);
        box-shadow: 0 16px 38px rgba(8, 24, 22, .12), inset 0 1px 0 rgba(255,255,255,.82);
        backdrop-filter: blur(16px);
        text-decoration: none;
        font-size: 11px;
        font-weight: 950;
        transition: transform .28s ease, background .28s ease, color .28s ease, box-shadow .28s ease;
    }

    .hs-floating-social a:hover {
        color: #fff;
        background: linear-gradient(135deg, #05251f, #00a66a, #2563eb);
        transform: translateY(-4px) scale(1.06);
        box-shadow: 0 22px 50px rgba(37, 99, 235, .22);
    }

    .hs-scroll-indicator {
        position: absolute;
        left: 50%;
        bottom: 28px;
        z-index: 4;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: rgba(5, 37, 31, .72);
        text-decoration: none;
        font-size: 11px;
        font-weight: 950;
        letter-spacing: .12em;
        text-transform: uppercase;
        transform: translateX(-50%);
    }

    .hs-scroll-indicator::before {
        content: "";
        width: 30px;
        height: 48px;
        border-radius: 999px;
        border: 1px solid rgba(5, 37, 31, .26);
        background: rgba(255,255,255,.36);
        box-shadow: inset 0 1px 0 rgba(255,255,255,.7);
    }

    .hs-scroll-indicator::after {
        content: "";
        position: absolute;
        left: 13px;
        top: 10px;
        width: 4px;
        height: 9px;
        border-radius: 999px;
        background: linear-gradient(180deg, #ffb703, #00a66a);
        animation: hsScrollDot 1.7s ease-in-out infinite;
    }

    .hs-portal-visual {
        perspective: 1100px;
    }

    .hs-portal-photo {
        border: 1px solid rgba(255,255,255,.78);
        transform: translateZ(0) rotateX(var(--tilt-x, 0deg)) rotateY(var(--tilt-y, 0deg));
        transition: transform .45s cubic-bezier(.2,.8,.2,1), box-shadow .45s ease, filter .45s ease;
        box-shadow: 0 28px 76px rgba(8, 24, 22, .2);
    }

    .hs-portal-photo::before,
    .hs-photo::before,
    .hs-stat::before,
    .hs-quick-card::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        border-radius: inherit;
        padding: 1px;
        background: linear-gradient(135deg, rgba(255,183,3,.8), rgba(0,166,106,.65), rgba(37,99,235,.62), rgba(225,29,72,.55));
        -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: .55;
    }

    .hs-portal-photo:hover {
        transform: translateY(-8px) rotateX(var(--tilt-x, 2deg)) rotateY(var(--tilt-y, -2deg));
        box-shadow: 0 34px 92px rgba(8, 24, 22, .27);
        filter: saturate(1.08);
    }

    .hs-portal-photo img,
    .hs-photo img,
    .hs-local-thumbs img {
        filter: saturate(1.08) contrast(1.03);
        transition: transform .75s ease, filter .75s ease;
    }

    .hs-portal-photo:hover img,
    .hs-photo:hover img {
        transform: scale(1.06);
        filter: saturate(1.18) contrast(1.06);
    }

    .hs-portal-note {
        border-color: rgba(255,255,255,.72);
        background: linear-gradient(135deg, rgba(255,255,255,.82), rgba(255,239,198,.72), rgba(228,255,240,.76));
        animation: hsFloatSoft 5s ease-in-out infinite;
    }

    .hs-quick-card,
    .hs-stat,
    .hs-glance-item,
    .hs-news-card,
    .hs-event,
    .hs-tour-stop,
    .hs-link-card {
        position: relative;
        overflow: hidden;
        transition: transform .35s cubic-bezier(.2,.8,.2,1), box-shadow .35s ease, border-color .35s ease;
    }

    .hs-quick-card:hover,
    .hs-stat:hover,
    .hs-news-card:hover,
    .hs-link-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 28px 74px rgba(8, 24, 22, .18);
        border-color: rgba(255,255,255,.92);
    }

    .hs-stat:nth-child(4n+1),
    .hs-quick-card:nth-child(4n+1) { background: linear-gradient(135deg, rgba(255,255,255,.82), rgba(207,250,231,.9)); }
    .hs-stat:nth-child(4n+2),
    .hs-quick-card:nth-child(4n+2) { background: linear-gradient(135deg, rgba(255,255,255,.82), rgba(255,237,173,.9)); }
    .hs-stat:nth-child(4n+3),
    .hs-quick-card:nth-child(4n+3) { background: linear-gradient(135deg, rgba(255,255,255,.82), rgba(219,234,254,.9)); }
    .hs-stat:nth-child(4n+4),
    .hs-quick-card:nth-child(4n+4) { background: linear-gradient(135deg, rgba(255,255,255,.82), rgba(255,214,225,.88)); }

    .hs-heading h2,
    .hs-glance-panel h2,
    .hs-local-panel h2,
    .hs-map-panel h3,
    .hs-tour-panel h3,
    .hs-news-card h3 {
        color: #05251f;
    }

    .hs-section.alt {
        background:
            linear-gradient(135deg, rgba(255,255,255,.52), rgba(221,255,238,.54)),
            conic-gradient(from 180deg at 50% 50%, rgba(255,183,3,.13), rgba(6,182,212,.12), rgba(124,58,237,.1), rgba(0,166,106,.13), rgba(255,183,3,.13));
    }

    .hs-photo,
    .hs-panorama,
    .hs-testimonial,
    .hs-cta {
        border-color: rgba(255,255,255,.72);
        box-shadow: 0 28px 80px rgba(8, 24, 22, .17), inset 0 1px 0 rgba(255,255,255,.68);
    }

    .hs-panorama-track {
        animation: hsPanSlow 28s linear infinite alternate;
        filter: saturate(1.1) contrast(1.04);
    }

    .hs-timeline-stage {
        background:
            linear-gradient(135deg, rgba(255,255,255,.78), rgba(232,255,242,.7)),
            conic-gradient(from 90deg, rgba(255,183,3,.18), rgba(6,182,212,.14), rgba(124,58,237,.12), rgba(255,183,3,.18));
    }

    .hs-time-btn.is-active,
    .hs-tour-stop.is-active {
        background: linear-gradient(135deg, #05251f, #0f766e);
        color: #fff;
        box-shadow: 0 18px 42px rgba(15,118,110,.24);
    }

    .hs-time-btn.is-active strong,
    .hs-time-btn.is-active span,
    .hs-tour-stop.is-active strong,
    .hs-tour-stop.is-active span {
        color: #fff;
    }

    .hs-cta {
        background:
            linear-gradient(135deg, rgba(5,37,31,.96), rgba(15,118,110,.9), rgba(37,99,235,.82)),
            url('{{ $localImage('bijrol.jpg.png') }}') center/cover no-repeat;
    }

    .hs-reveal {
        transform: translateY(36px) scale(.985);
        filter: blur(8px);
        transition: opacity .8s ease, transform .8s cubic-bezier(.2,.8,.2,1), filter .8s ease;
    }

    .hs-reveal.is-visible {
        transform: none;
        filter: blur(0);
    }

    @keyframes hsMeshDrift {
        0% { transform: translate3d(-2%, -1%, 0) rotate(0deg) scale(1); }
        50% { transform: translate3d(2%, 1%, 0) rotate(8deg) scale(1.04); }
        100% { transform: translate3d(-1%, 2%, 0) rotate(-6deg) scale(1.02); }
    }

    @keyframes hsLineGlide {
        from { background-position: 0 0, 0 0, 0 0; }
        to { background-position: 180px 0, 78px 78px, 78px 78px; }
    }

    @keyframes hsFloatSoft {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    @keyframes hsPanSlow {
        from { transform: translateX(calc(var(--tour-x, 0) * -1%)); }
        to { transform: translateX(calc((var(--tour-x, 0) * -1%) - 12%)); }
    }

    @keyframes hsScrollDot {
        0%, 100% { transform: translateY(0); opacity: .45; }
        50% { transform: translateY(16px); opacity: 1; }
    }

    @media (max-width: 700px) {
        .hs-floating-social,
        .hs-scroll-indicator {
            display: none;
        }

        .hs-premium-mesh {
            inset: -12%;
            filter: blur(24px);
        }

        .hs-portal-note {
            animation: none;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .home-showcase *,
        .home-showcase *::before,
        .home-showcase *::after {
            animation: none !important;
            transition: none !important;
        }

        .hs-reveal {
            opacity: 1;
            transform: none;
        }
    }
</style>
@endpush

@section('content')
<main class="home-showcase">
    <section class="hs-hero" id="top">
        <div class="hs-hero-bg" aria-hidden="true"></div>
        <div class="hs-premium-mesh" aria-hidden="true"></div>
        <div class="hs-motion-lines" aria-hidden="true"></div>
        <div class="hs-floating-social" aria-label="Social links">
            <a href="#" aria-label="Facebook">FB</a>
            <a href="#" aria-label="Instagram">IG</a>
            <a href="#" aria-label="YouTube">YT</a>
        </div>
        <div class="hs-wrap hs-portal-hero">
            <div class="hs-portal-copy hs-reveal">
                <span class="hs-location-chip">Bijrol Village | Baraut, Baghpat</span>
                <h1>A useful digital home for Bijrol.</h1>
                <p>Find village information, panchayat development records, temples, schools, hospitals, gallery, announcements, and public suggestions from one clean homepage.</p>
                <div class="hs-actions">
                    <a class="hs-btn primary" href="{{ url('/panchayat-dashboard') }}">Panchayat Dashboard</a>
                    <a class="hs-btn" href="{{ url('/village-voice') }}">Village Voice</a>
                    <a class="hs-btn" href="{{ url('/gallery') }}">Open Gallery</a>
                </div>
                <div class="hs-mini-facts" aria-label="Bijrol quick facts">
                    <span>PIN 250620</span>
                    <span>Block Baraut</span>
                    <span>District Baghpat</span>
                    <span>Population 11,742+</span>
                </div>
            </div>

            <div class="hs-reveal" style="--delay:.08s;">
                <div class="hs-portal-visual hs-portal-slider" aria-label="Bijrol village photo highlights">
                    <figure class="hs-portal-slide is-active" data-hero-slide>
                        <img src="{{ $localImage('t1.jpeg') }}" alt="Radha Krishna darshan">
                        <figcaption>Radha Krishna Temple Darshan</figcaption>
                    </figure>
                    <figure class="hs-portal-slide" data-hero-slide>
                        <img src="{{ $localImage('t2.jpeg') }}" alt="Temple lights in Bijrol">
                        <figcaption>Temple Lights</figcaption>
                    </figure>
                    <figure class="hs-portal-slide" data-hero-slide>
                        <img src="{{ $localImage('shahmal.jpeg') }}" alt="Baba Shahmal Singh Tomar portrait">
                        <figcaption>Baba Shahmal Singh Tomar Legacy</figcaption>
                    </figure>
                    <div class="hs-portal-dots" aria-hidden="true">
                        <span class="is-active" data-hero-dot></span>
                        <span data-hero-dot></span>
                        <span data-hero-dot></span>
                    </div>
                </div>
                <div class="hs-portal-note">
                    <strong>1857</strong>
                    <div>
                        <span>Raja Shahmal Tomar Legacy</span>
                        <small>Bijrol's history, local services, and public updates are brought together for residents and visitors.</small>
                    </div>
                </div>
            </div>
        </div>
        <a class="hs-scroll-indicator" href="#at-a-glance">Scroll</a>
    </section>

    <section class="hs-top-heritage" aria-label="Bijrol heritage introduction">
        <div class="hs-heritage-orb hs-heritage-orb-one" aria-hidden="true"></div>
        <div class="hs-heritage-orb hs-heritage-orb-two" aria-hidden="true"></div>
        <div class="hs-wrap hs-top-heritage-grid">
            <article class="hs-top-heritage-main">
                <div class="hs-heritage-label">
                    <span class="hs-kicker" style="color:var(--green)">Bijrol Heritage</span>
                    <span class="hs-heritage-year">1857</span>
                </div>
                <h2>A village of history, culture, and freedom memory.</h2>
                <div class="hs-heritage-story">
                    <p>Bijrol, located in Baghpat district of Uttar Pradesh, is not just an ordinary rural settlement. It is an important heritage village of western Uttar Pradesh, known for its history, culture, and connection with the freedom struggle.</p>
                    <p>This is the soil where Baba Shahmal Singh Tomar, one of the great leaders of the 1857 uprising, led organized resistance against foreign rule. Because of this legacy, the name of Bijrol is remembered not only in local history, but also with respect in the wider history of the Indian freedom movement.</p>
                    <p>The true identity of a village is not created only by its population, fields, or houses. It is shaped by its historical heritage, cultural traditions, religious places, old routes, ponds, memorials, oral stories, and the people who gave honor to that land. In this sense, Bijrol is a deeply rich village.</p>
                    <p>Although many old structures have disappeared with time, many historic places have merged into modern construction, and several oral traditions have slowly faded, the soil of Bijrol still carries many signs of its proud past. What is needed now is to recognize them, preserve them, and carry them to future generations.</p>
                </div>
            </article>

            <aside class="hs-top-heritage-side">
                <figure class="hs-heritage-portrait">
                    <img src="{{ $localImage('shahmal.jpeg') }}" alt="Baba Shahmal Singh Tomar portrait">
                    <figcaption>
                        <strong>Baba Shahmal Singh Tomar</strong>
                        <span>Freedom memory of Bijrol</span>
                    </figcaption>
                </figure>
                @foreach($topHeritageCards as $card)
                    <div class="hs-top-heritage-card" style="--delay:{{ $loop->index * .12 }}s;">
                        <strong>{{ $card['title'] }}</strong>
                        <span>{{ $card['text'] }}</span>
                    </div>
                @endforeach
            </aside>
        </div>
    </section>

    <section class="hs-stats">
        <div class="hs-wrap">
            <div class="hs-stats-grid">
                @foreach($stats as $index => $stat)
                    <article class="hs-stat hs-glass hs-reveal" style="--delay:{{ $index * .05 }}s;">
                        <strong><span data-count="{{ $stat['value'] }}">0</span>{{ $stat['suffix'] }}</strong>
                        <span>{{ $stat['label'] }}</span>
                        <p>{{ $stat['text'] }}</p>
                    </article>
                @endforeach
            </div>

            <div class="hs-panchayat-strip hs-glass hs-reveal" style="--delay:.12s;">
                @foreach($panchayatContacts as $contact)
                    <article class="hs-contact-person">
                        <div class="hs-person-avatar">{{ $contact['initials'] }}</div>
                        <div>
                            <p>{{ $contact['role'] }}</p>
                            <h3>{{ $contact['name'] }}</h3>
                            <div class="hs-contact-links">
                                <a href="tel:+91{{ $contact['phone'] }}">+91 {{ $contact['phone'] }}</a>
                                <a href="mailto:{{ strtolower($contact['email']) }}">{{ strtolower($contact['email']) }}</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="hs-section" id="at-a-glance">
        <div class="hs-wrap">
            <div class="hs-glance">
                <article class="hs-glance-panel hs-glass hs-reveal">
                    <span class="hs-kicker">Bijrol At A Glance</span>
                    <h2>Useful village details without digging around.</h2>
                    <p>Quick administrative and local context for residents, visitors, students, and anyone checking basic village information.</p>
                    <div class="hs-glance-list">
                        @foreach($atAGlance as $fact)
                            <div class="hs-glance-item">
                                <span>{{ $fact['label'] }}</span>
                                <strong>{{ $fact['value'] }}</strong>
                            </div>
                        @endforeach
                    </div>
                </article>

                <article class="hs-local-panel hs-glass hs-reveal" style="--delay:.08s;">
                    <span class="hs-kicker">Local Highlights</span>
                    <h2>Temple darshan, village identity, and everyday life now sit closer to the top.</h2>
                    <p>The homepage now leads with stronger local visuals so it feels less generic and more like Bijrol from the first scroll.</p>
                    <div class="hs-local-thumbs">
                        <img src="{{ $localImage('t1.jpeg') }}" alt="Radha Krishna darshan">
                        <img src="{{ $localImage('t2.jpeg') }}" alt="Radha Krishna temple lights">
                        <img src="{{ $localImage('vil.jpg.png') }}" alt="Bijrol village landscape">
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="hs-section" id="timeline">
        <div class="hs-wrap">
            <div class="hs-heading hs-reveal">
                <span class="hs-kicker">Raja Shahmal Tomar</span>
                <h2>An interactive timeline of courage.</h2>
                <p>Bijrol's identity carries the memory of Shahmal Tomar, local leadership, and the 1857 freedom struggle across the Baraut and Baghpat region.</p>
            </div>

            <div class="hs-timeline">
                <div class="hs-timeline-nav hs-reveal">
                    @foreach($timeline as $index => $item)
                        <button class="hs-time-btn {{ $index === 0 ? 'is-active' : '' }}" type="button" data-timeline-index="{{ $index }}">
                            <strong>{{ $item['year'] }}</strong>
                            <span>{{ $item['title'] }}</span>
                        </button>
                    @endforeach
                </div>

                <article class="hs-timeline-stage hs-glass hs-reveal" data-year="{{ $timeline[0]['year'] }}" style="--delay:.08s;">
                    <h3 data-timeline-title>{{ $timeline[0]['title'] }}</h3>
                    <p data-timeline-text>{{ $timeline[0]['text'] }}</p>
                </article>
            </div>
        </div>
    </section>

    <section class="hs-section" id="tour">
        <div class="hs-wrap">
            <div class="hs-heading hs-reveal">
                <span class="hs-kicker">360 Virtual Tour</span>
                <h2>Move through Bijrol before you visit.</h2>
                <p>A lightweight interactive tour experience using village visuals, designed to feel cinematic while staying fast on mobile.</p>
            </div>

            <div class="hs-tour">
                <div class="hs-panorama hs-glass hs-reveal">
                    <div class="hs-panorama-track" data-panorama-track></div>
                </div>
                <aside class="hs-tour-panel hs-glass hs-reveal" style="--delay:.08s;">
                    <h3 data-tour-title>{{ $tourStops[0]['title'] }}</h3>
                    <p data-tour-text>{{ $tourStops[0]['text'] }}</p>
                    <div class="hs-tour-stops">
                        @foreach($tourStops as $index => $stop)
                            <button class="hs-tour-stop {{ $index === 0 ? 'is-active' : '' }}" type="button" data-tour-index="{{ $index }}">
                                <strong>{{ $stop['title'] }}</strong>
                                <span>{{ $stop['text'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="hs-section alt" id="testimonials">
        <div class="hs-wrap">
            <div class="hs-testimonial hs-glass hs-reveal">
                <div>
                    @foreach($testimonials as $index => $item)
                        <article class="hs-quote {{ $index === 0 ? 'is-active' : '' }}" data-quote-index="{{ $index }}">
                            <p>"{{ $item['text'] }}"</p>
                            <strong>{{ $item['name'] }}</strong>
                            <span>{{ $item['role'] }}</span>
                        </article>
                    @endforeach
                </div>
                <div class="hs-carousel-controls">
                    <button class="hs-icon-btn" type="button" data-quote-prev aria-label="Previous testimonial">PR</button>
                    <button class="hs-icon-btn" type="button" data-quote-next aria-label="Next testimonial">NX</button>
                </div>
            </div>
        </div>
    </section>

    <section class="hs-section" id="map">
        <div class="hs-wrap">
            <div class="hs-map-grid">
                <aside class="hs-map-panel hs-glass hs-reveal">
                    <span class="hs-kicker">Interactive Map</span>
                    <h3>Find Bijrol in Baghpat, Uttar Pradesh.</h3>
                    <p>Use the map to orient yourself around the village and understand Bijrol's location in the Baraut-Baghpat region.</p>
                </aside>
                <div class="hs-map hs-glass hs-reveal" style="--delay:.08s;">
                    <iframe
                        title="Bijrol map"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps?q=Bijrol%20Baghpat%20Uttar%20Pradesh&output=embed">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="hs-section alt" id="updates">
        <div class="hs-wrap">
            <div class="hs-heading hs-reveal">
                <span class="hs-kicker">News And Events</span>
                <h2>The village pulse, updated.</h2>
                <p>Published announcements and upcoming programs from the admin dashboard appear here automatically.</p>
            </div>

            <div class="hs-news-grid">
                <article class="hs-news-card hs-glass hs-reveal">
                    <span class="hs-kicker">Latest News</span>
                    <h3>Announcements</h3>
                    @if($latestAnnouncements->count() > 0)
                        <ul class="hs-list">
                            @foreach($latestAnnouncements as $item)
                                <li>
                                    <strong>{{ $item->title }}</strong>
                                    <span>{{ $item->excerpt }}</span>
                                    <span>{{ $item->published_at ? $item->published_at->format('M d, Y') : $item->created_at->format('M d, Y') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="hs-empty">
                            <strong>No announcements published yet.</strong>
                            <span>New public notices from the admin dashboard will appear here automatically.</span>
                        </div>
                    @endif
                </article>

                <article class="hs-news-card hs-glass hs-reveal" style="--delay:.08s;">
                    <span class="hs-kicker">Village Calendar</span>
                    <h3>Upcoming Events</h3>
                    @if($upcomingEvents->count() > 0)
                        <div class="hs-list">
                            @foreach($upcomingEvents as $event)
                                <a class="hs-event" href="javascript:void(0)">
                                    <strong>{{ $event->title }}</strong>
                                    <span>{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}@if($event->location) &middot; {{ $event->location }} @endif</span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="hs-empty">
                            <strong>No events scheduled right now.</strong>
                            <span>Upcoming village programs and dates will show here when added.</span>
                        </div>
                    @endif
                </article>
            </div>
        </div>
    </section>

    <section class="hs-section">
        <div class="hs-wrap">
            <div class="hs-cta hs-glass hs-reveal">
                <span class="hs-kicker">Bijrol Digital Portal</span>
                <h2>Explore heritage, services, people, and village updates in one place.</h2>
                <p>Open the full Bijrol experience with history, Baba Shahmal Singh Tomar legacy, schools, temples, healthcare, gallery, contact details, and public suggestions.</p>
                <div class="hs-actions" style="justify-content:center;">
                    <a class="hs-btn primary" href="{{ url('/about') }}">Read About Bijrol</a>
                    <a class="hs-btn" href="{{ url('/gallery') }}">Open Gallery</a>
                    <a class="hs-btn" href="{{ url('/village-voice') }}">Share Your Voice</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const root = document.querySelector('.home-showcase');
    if (!root) return;

    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const revealItems = root.querySelectorAll('.hs-reveal');

    if (reduced || !('IntersectionObserver' in window)) {
        revealItems.forEach(item => item.classList.add('is-visible'));
    } else {
        const revealObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: .08, rootMargin: '0px 0px -30px 0px' });

        revealItems.forEach(item => revealObserver.observe(item));
    }

    const countEls = root.querySelectorAll('[data-count]');
    const animateNumber = (el) => {
        const target = parseFloat(el.dataset.count || '0');
        const isDecimal = String(el.dataset.count).includes('.');
        const duration = 1300;
        const started = performance.now();

        const tick = (now) => {
            const progress = Math.min((now - started) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const value = target * eased;
            el.textContent = isDecimal ? value.toFixed(2) : Math.round(value).toLocaleString('en-IN');
            if (progress < 1) requestAnimationFrame(tick);
        };

        requestAnimationFrame(tick);
    };

    if (reduced || !('IntersectionObserver' in window)) {
        countEls.forEach(animateNumber);
    } else {
        const countObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateNumber(entry.target);
                    countObserver.unobserve(entry.target);
                }
            });
        }, { threshold: .45 });
        countEls.forEach(el => countObserver.observe(el));
    }

    const timeline = @json($timeline);
    const timeButtons = root.querySelectorAll('[data-timeline-index]');
    const timeStage = root.querySelector('.hs-timeline-stage');
    const timeTitle = root.querySelector('[data-timeline-title]');
    const timeText = root.querySelector('[data-timeline-text]');

    timeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const index = Number(button.dataset.timelineIndex);
            const item = timeline[index];
            if (!item) return;
            timeButtons.forEach(btn => btn.classList.remove('is-active'));
            button.classList.add('is-active');
            timeStage.dataset.year = item.year;
            timeTitle.textContent = item.title;
            timeText.textContent = item.text;
        });
    });

    const tourStops = @json($tourStops);
    const tourButtons = root.querySelectorAll('[data-tour-index]');
    const tourTitle = root.querySelector('[data-tour-title]');
    const tourText = root.querySelector('[data-tour-text]');
    const panorama = root.querySelector('.hs-panorama');

    tourButtons.forEach(button => {
        button.addEventListener('click', () => {
            const index = Number(button.dataset.tourIndex);
            const item = tourStops[index];
            if (!item) return;
            tourButtons.forEach(btn => btn.classList.remove('is-active'));
            button.classList.add('is-active');
            tourTitle.textContent = item.title;
            tourText.textContent = item.text;
            panorama.style.setProperty('--tour-x', String(index * 18));
        });
    });

    const quotes = root.querySelectorAll('[data-quote-index]');
    const showQuote = (next) => {
        quotes.forEach(q => q.classList.remove('is-active'));
        quotes[next].classList.add('is-active');
    };
    let quoteIndex = 0;
    root.querySelector('[data-quote-next]')?.addEventListener('click', () => {
        quoteIndex = (quoteIndex + 1) % quotes.length;
        showQuote(quoteIndex);
    });
    root.querySelector('[data-quote-prev]')?.addEventListener('click', () => {
        quoteIndex = (quoteIndex - 1 + quotes.length) % quotes.length;
        showQuote(quoteIndex);
    });

    const heroSlides = Array.from(root.querySelectorAll('[data-hero-slide]'));
    const heroDots = Array.from(root.querySelectorAll('[data-hero-dot]'));
    let heroSlideIndex = 0;
    const showHeroSlide = (next) => {
        heroSlides.forEach((slide, index) => slide.classList.toggle('is-active', index === next));
        heroDots.forEach((dot, index) => dot.classList.toggle('is-active', index === next));
    };

    if (!reduced && heroSlides.length > 1) {
        window.setInterval(() => {
            heroSlideIndex = (heroSlideIndex + 1) % heroSlides.length;
            showHeroSlide(heroSlideIndex);
        }, 1000);
    }

    if (!reduced) {
        window.addEventListener('scroll', () => {
            root.style.setProperty('--scroll', String(window.scrollY));
        }, { passive: true });

        const parallaxItems = root.querySelectorAll('.hs-portal-slider, .hs-portal-note');
        root.querySelector('.hs-hero')?.addEventListener('pointermove', (event) => {
            const x = (event.clientX / window.innerWidth - .5) * 2;
            const y = (event.clientY / window.innerHeight - .5) * 2;
            root.style.setProperty('--mouse-x', x.toFixed(3));
            root.style.setProperty('--mouse-y', y.toFixed(3));
            parallaxItems.forEach((item, index) => {
                const depth = index === 0 ? 14 : 8;
                item.style.setProperty('--tilt-x', (y * -depth).toFixed(2) + 'deg');
                item.style.setProperty('--tilt-y', (x * depth).toFixed(2) + 'deg');
            });
        });
    }
});
</script>
@endpush
