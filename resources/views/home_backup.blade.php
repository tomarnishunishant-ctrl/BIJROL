@extends('layouts.app')

@section('title', 'BIJROL Village - Discover the Heart of Heritage')

@push('styles')
    <style>
        :root {
            --accent-dark: #0a1f3b;
            --accent-blue: #3b82f6;
            --accent-cyan: #0ea5e9;
            --accent-gold: #f59e0b;
            --accent-teal: #0d9488;
            --surface: #f8fafc;
            --muted: #4b5563;
            --text: #0f1f2f;
            --shadow: rgba(10, 31, 59, 0.15);
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f4f7fb;
            color: var(--text);
        }

        #hero {
            position: relative;
            min-height: 88vh;
            overflow: hidden;
        }

        #hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(8, 18, 51, 0.38), rgba(8, 18, 51, 0.68));
            pointer-events: none;
            z-index: 1;
        }

        #hero .carousel-item img {
            height: 88vh !important;
            object-fit: cover;
            filter: brightness(0.7);
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            text-align: center;
            width: min(96%, 980px);
            padding: 0 20px;
        }

        .hero-content .tagline {
            color: rgba(255, 255, 255, 0.84);
            letter-spacing: 0.18em;
            text-transform: uppercase;
            margin-bottom: 1rem;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .hero-content h1 {
            font-size: clamp(3rem, 5vw, 4.6rem);
            font-weight: 900;
            line-height: 0.95;
            margin-bottom: 1.3rem;
            letter-spacing: -0.04em;
            background: linear-gradient(135deg, #fff, rgba(255,255,255,0.95));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-content p.lead {
            max-width: 760px;
            margin: 0 auto 2rem;
            color: rgba(255, 255, 255, 0.92);
            line-height: 1.9;
            font-size: 1.05rem;
        }

        .hero-actions {
            display: inline-flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
        }

        .hero-actions .btn {
            min-width: 170px;
            border-radius: 999px;
            padding: 16px 28px;
            font-weight: 700;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hero-actions .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-cyan));
            color: white;
            border: none;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.18);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.28);
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-top: 3rem;
        }

        .hero-stat {
            background: rgba(255, 255, 255, 0.12);
            padding: 24px 20px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(15, 37, 69, 0.12);
            backdrop-filter: blur(12px);
            color: white;
        }

        .hero-stat .value {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .hero-stat span {
            display: block;
            color: rgba(255, 255, 255, 0.82);
            font-weight: 600;
            margin-bottom: 6px;
        }

        .hero-stat p {
            margin: 0;
            color: rgba(255, 255, 255, 0.88);
        }

        .section {
            padding: 100px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: clamp(2rem, 3vw, 2.8rem);
            font-weight: 900;
            letter-spacing: -0.05em;
            margin-bottom: 18px;
            color: var(--accent-dark);
        }

        .section-title p {
            margin: 0 auto;
            max-width: 720px;
            color: var(--muted);
            line-height: 1.8;
            font-size: 1rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }

        .feature-card {
            background: white;
            border-radius: 28px;
            padding: 32px;
            box-shadow: 0 24px 60px var(--shadow);
            transition: transform 0.35s ease, box-shadow 0.35s ease;
            border: 1px solid rgba(14, 40, 75, 0.06);
            position: relative;
            overflow: hidden;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.3;
            z-index: 0;
            transition: opacity 0.35s ease, transform 0.35s ease;
        }

        .feature-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.92) 100%);
            z-index: 1;
            transition: background 0.35s ease;
        }

        .feature-card:hover::before {
            opacity: 0.5;
            transform: scale(1.05);
        }

        .feature-card:hover::after {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.88) 0%, rgba(248, 250, 252, 0.85) 100%);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 32px 75px rgba(15, 37, 69, 0.18);
        }

        .feature-card .icon {
            width: 72px;
            height: 72px;
            display: grid;
            place-items: center;
            border-radius: 22px;
            margin-bottom: 22px;
            font-size: 1.8rem;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.18), rgba(13, 148, 136, 0.12));
            color: var(--accent-blue);
            transition: transform 0.4s ease;
            position: relative;
            z-index: 2;
        }

        .feature-card:hover .icon {
            transform: scale(1.1) rotateZ(10deg);
        }

        .feature-card h3 {
            font-size: 1.3rem;
            margin-bottom: 14px;
            font-weight: 800;
            color: var(--accent-dark);
            letter-spacing: -0.02em;
            position: relative;
            z-index: 2;
        }

        .feature-card p {
            color: var(--muted);
            line-height: 1.8;
            position: relative;
            z-index: 2;
        }

        .spotlight-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 36px;
            align-items: center;
        }

        .spotlight-card,
        .spotlight-media {
            background: white;
            border-radius: 32px;
            box-shadow: 0 28px 70px rgba(15, 37, 69, 0.1);
        }

        .spotlight-card {
            padding: 38px 40px;
        }

        .spotlight-card h3 {
            font-size: 2rem;
            margin-bottom: 22px;
            color: var(--accent-dark);
        }

        .spotlight-card p {
            color: var(--muted);
            line-height: 1.85;
            font-size: 1rem;
            margin-bottom: 28px;
        }

        .highlight-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 16px;
        }

        .highlight-list li {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 16px;
            align-items: start;
            color: var(--accent-dark);
            font-weight: 600;
        }

        .highlight-list li::before {
            content: '';
            width: 12px;
            height: 12px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-gold));
            display: block;
            margin-top: 8px;
        }

        .spotlight-media img {
            width: 100%;
            height: 100%;
            min-height: 520px;
            object-fit: cover;
            border-radius: 32px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 24px;
        }

        .stats-box {
            background: white;
            border-radius: 28px;
            padding: 36px;
            box-shadow: 0 26px 68px rgba(15, 37, 69, 0.1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(14, 40, 75, 0.06);
        }

        .stats-box::after {
            content: '';
            position: absolute;
            width: 120px;
            height: 120px;
            background: rgba(59, 130, 246, 0.08);
            border-radius: 50%;
            top: -30px;
            right: -30px;
            z-index: 0;
        }

        .stats-box h3 {
            margin-bottom: 16px;
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--accent-dark);
        }

        .stats-box .value {
            font-size: 3rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-teal));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }

        .stats-box p {
            margin: 0;
            color: var(--muted);
            line-height: 1.8;
        }

        .cta-panel {
            background: white;
            border-radius: 32px;
            padding: 42px 46px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 24px;
            align-items: center;
            box-shadow: 0 28px 70px rgba(15, 37, 69, 0.1);
            border: 1px solid rgba(14, 40, 75, 0.06);
        }

        .cta-copy h3 {
            margin: 0 0 12px;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--accent-dark);
            letter-spacing: -0.03em;
        }

        .cta-copy p {
            margin: 0;
            color: var(--muted);
            line-height: 1.9;
            font-size: 1rem;
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-gold));
            color: white;
            border: none;
            padding: 16px 28px;
            border-radius: 999px;
            font-weight: 700;
            box-shadow: 0 18px 40px rgba(13, 148, 136, 0.2);
        }

        .btn-accent:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 1100px) {
            .hero-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .features-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .spotlight-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .cta-panel { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            #hero { min-height: 70vh; }
            .hero-content h1 { font-size: 2.6rem; }
            .hero-content p.lead { font-size: 1rem; }
            .hero-stats { grid-template-columns: 1fr; }
            .feature-card { padding: 28px 22px; min-height: 350px; }
            .spotlight-card { padding: 28px; }
            .spotlight-media img { min-height: 360px; }
            .stats-grid { grid-template-columns: 1fr; }
            .cta-panel { padding: 28px; }
        }

        @media (max-width: 576px) {
            .section { padding: 70px 0; }
            .hero-content h1 { font-size: 2.2rem; }
            .hero-actions { flex-direction: column; }
            .hero-actions .btn { width: 100%; }
            .feature-card { padding: 28px 22px; }
        }
    </style>
@endpush

@section('content')
    <section id="hero">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2500" data-bs-pause="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1600&q=80" class="d-block w-100" alt="Village sunrise landscape">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1490578474895-699cd4e2cf59?auto=format&fit=crop&w=1600&q=80" class="d-block w-100" alt="Village fields and farming">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=1600&q=80" class="d-block w-100" alt="Village heritage scene">
                </div>
            </div>
        </div>

        <div class="hero-content">
            <p class="tagline">Village Beyond Expectations</p>
            <h1>BIJROL Village<br>— Where Heritage Meets Progress</h1>
            <p class="lead">Step into a village story that blends historic valor, thriving agriculture, and community innovation. BIJROL welcomes you with scenic views, proud traditions, and modern aspirations.</p>
            <div class="hero-actions">
                <a href="/about" class="btn btn-primary">Explore Our Story</a>
                <a href="/gallery" class="btn btn-secondary">View the Gallery</a>
            </div>

            <div class="hero-stats mt-5">
                <div class="hero-stat">
                    <span>Residents</span>
                    <div class="value">11,742+</div>
                    <p>Thriving community rooted in culture.</p>
                </div>
                <div class="hero-stat">
                    <span>Households</span>
                    <div class="value">1,809</div>
                    <p>Strong families shaping the village.</p>
                </div>
                <div class="hero-stat">
                    <span>Literacy</span>
                    <div class="value">63.75%</div>
                    <p>Growing education and opportunity.</p>
                </div>
                <div class="hero-stat">
                    <span>Legacy</span>
                    <div class="value">1857</div>
                    <p>Home of Sah Mal’s heroic rebellion.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>What Makes BIJROL So Special</h2>
                <p>A modern village destination with deep traditions, breathtaking landscapes, and a story that inspires every visitor.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="icon">🌿</div>
                    <h3>Thriving Agriculture</h3>
                    <p>Fertile fields producing wheat, rice, sugarcane, mustard, and organic harvests for local families.</p>
                </div>
                <div class="feature-card">
                    <div class="icon">🏛️</div>
                    <h3>Historic Legacy</h3>
                    <p>Honoring Sah Mal, the Ashoka pillar, and a powerful legacy from India’s 1857 rebellion.</p>
                </div>
                <div class="feature-card">
                    <div class="icon">🎉</div>
                    <h3>Colorful Festivals</h3>
                    <p>From Holi to Diwali, Eid to Teej, BIJROL celebrates unity and joy throughout the year.</p>
                </div>
                <div class="feature-card">
                    <div class="icon">🏫</div>
                    <h3>Modern Amenities</h3>
                    <p>Government schools, health centers, clean water, roads and growing digital access.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" style="background: var(--surface);">
        <div class="container">
            <div class="section-title">
                <h2>Village Life in Motion</h2>
                <p>BIJROL is a living story—beautiful fields, spiritual spaces, community strength, and local traditions united in one place.</p>
            </div>

            <div class="spotlight-grid">
                <div class="spotlight-card">
                    <h3>Rooted in Tradition. Growing with Vision.</h3>
                    <p>BIJROL combines its deep agricultural roots with new ambitions: organic farming, local crafts, community education, and modern village development.</p>
                    <ul class="highlight-list">
                        <li>Organic farming initiatives</li>
                        <li>Local artisans, handicrafts, and specialty foods</li>
                        <li>Cultural festivals that unite every generation</li>
                    </ul>
                </div>
                <div class="spotlight-media">
                    <img src="https://images.unsplash.com/photo-1499346030926-9a72daac6c63?auto=format&fit=crop&w=1200&q=80" alt="Rural village scenic view">
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="stats-grid">
                <div class="stats-box">
                    <h3>Population</h3>
                    <div class="value">11,742+</div>
                    <p>Vibrant families living together in a close-knit community.</p>
                </div>
                <div class="stats-box">
                    <h3>Households</h3>
                    <div class="value">1,809</div>
                    <p>Stable homes and village networks that support every generation.</p>
                </div>
                <div class="stats-box">
                    <h3>Literacy Rate</h3>
                    <div class="value">63.75%</div>
                    <p>A continuing commitment to education and opportunity.</p>
                </div>
                <div class="stats-box">
                    <h3>Pincode</h3>
                    <div class="value">250611</div>
                    <p>Located in the heart of Baghpat district, Uttar Pradesh.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" style="background: #eef7ff;">
        <div class="container">
            <div class="cta-panel">
                <div class="cta-copy">
                    <h3>Ready to discover BIJROL?</h3>
                    <p>Explore our village story, meet the people, and see how heritage and growth come together in a beautifully authentic place.</p>
                </div>
                <div class="cta-actions">
                    <a href="/about" class="btn btn-accent">Discover More</a>
                </div>
            </div>
        </div>
    </section>
@endsection
