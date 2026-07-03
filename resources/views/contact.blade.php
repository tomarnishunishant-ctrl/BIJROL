@extends('layouts.app')

@section('title', 'Contact | BIJROL Village')

@push('styles')
<style>
.contact-page {
    --ct-ink: #112033;
    --ct-muted: #647386;
    --ct-green: #0f6b47;
    --ct-green-dark: #073923;
    --ct-blue: #1f5fbf;
    --ct-saffron: #d98516;
    --ct-bg: #f4f8f5;
    --ct-panel: rgba(255, 255, 255, .92);
    --ct-line: rgba(17, 32, 51, .12);
    --ct-shadow: 0 22px 62px rgba(17, 32, 51, .12);
    background:
        radial-gradient(circle at 14% 10%, rgba(15, 107, 71, .17), transparent 28%),
        radial-gradient(circle at 88% 18%, rgba(217, 133, 22, .15), transparent 28%),
        linear-gradient(180deg, #f8fbf6 0%, var(--ct-bg) 50%, #fffdf8 100%);
    color: var(--ct-ink);
}

.contact-hero {
    position: relative;
    min-height: calc(100vh - 92px);
    display: grid;
    align-items: center;
    padding: 68px 0 44px;
    overflow: hidden;
    isolation: isolate;
}

.contact-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -2;
    background: url('{{ asset('image/main.jpg.jpg') }}') center/cover no-repeat;
    opacity: .27;
}

.contact-hero::after {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -1;
    background:
        linear-gradient(90deg, rgba(244, 248, 245, .98) 0%, rgba(244, 248, 245, .86) 48%, rgba(244, 248, 245, .62) 100%),
        linear-gradient(180deg, rgba(255,255,255,.06) 0%, var(--ct-bg) 100%);
}

.contact-grid {
    display: grid;
    grid-template-columns: minmax(0, .86fr) minmax(390px, .74fr);
    gap: 34px;
    align-items: center;
}

.contact-copy {
    max-width: 780px;
}

.contact-kicker {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
    color: var(--ct-green);
    font-size: .78rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: .08em;
}

.contact-kicker::before {
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: currentColor;
    box-shadow: 0 0 0 7px rgba(15, 107, 71, .12);
}

.contact-copy h1 {
    max-width: 780px;
    margin: 0;
    color: var(--ct-green-dark);
    font-size: clamp(2.45rem, 6vw, 5.55rem);
    line-height: .97;
    font-weight: 950;
    letter-spacing: 0;
}

.contact-copy p {
    max-width: 650px;
    margin: 18px 0 0;
    color: var(--ct-muted);
    font-size: 1.08rem;
    line-height: 1.85;
    font-weight: 600;
}

.contact-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 28px;
}

.contact-action {
    min-height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 9px 14px;
    border-radius: 8px;
    background: rgba(255, 255, 255, .76);
    border: 1px solid var(--ct-line);
    color: var(--ct-green-dark);
    text-decoration: none;
    font-size: .86rem;
    font-weight: 850;
    box-shadow: 0 12px 28px rgba(17, 32, 51, .07);
    backdrop-filter: blur(14px);
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
}

.contact-action:hover {
    color: var(--ct-green-dark);
    transform: translateY(-2px);
    border-color: rgba(15, 107, 71, .28);
    box-shadow: 0 16px 34px rgba(17, 32, 51, .11);
}

.contact-summary {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
    max-width: 680px;
    margin-top: 32px;
}

.contact-stat,
.contact-panel,
.contact-card,
.contact-map {
    border-radius: 8px;
    background: var(--ct-panel);
    border: 1px solid var(--ct-line);
    box-shadow: var(--ct-shadow);
    backdrop-filter: blur(18px);
}

.contact-stat {
    min-height: 106px;
    padding: 18px;
}

.contact-stat strong {
    display: block;
    color: var(--ct-green-dark);
    font-size: 1.65rem;
    line-height: 1;
    font-weight: 950;
}

.contact-stat span {
    display: block;
    margin-top: 9px;
    color: var(--ct-muted);
    font-size: .82rem;
    font-weight: 800;
}

.contact-panel {
    padding: 26px;
}

.contact-panel-head {
    display: flex;
    justify-content: space-between;
    gap: 18px;
    align-items: flex-start;
    margin-bottom: 18px;
}

.contact-panel h2,
.contact-map h2 {
    margin: 0;
    color: var(--ct-green-dark);
    font-size: clamp(1.55rem, 2.5vw, 2.25rem);
    line-height: 1.12;
    font-weight: 950;
}

.contact-panel p,
.contact-map p,
.contact-card p {
    color: var(--ct-muted);
    line-height: 1.72;
}

.contact-panel-tag {
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

.contact-list {
    display: grid;
    gap: 12px;
    margin-top: 18px;
}

.contact-card {
    display: grid;
    grid-template-columns: 44px 1fr;
    gap: 14px;
    align-items: center;
    padding: 15px;
    box-shadow: 0 14px 34px rgba(17, 32, 51, .07);
}

.contact-card-icon {
    width: 44px;
    height: 44px;
    display: grid;
    place-items: center;
    border-radius: 8px;
    color: #fff;
    background: linear-gradient(135deg, var(--ct-green-dark), var(--ct-green));
    font-size: .76rem;
    font-weight: 950;
}

.contact-card h3 {
    margin: 0 0 3px;
    color: var(--ct-green-dark);
    font-size: 1rem;
    font-weight: 950;
}

.contact-card p {
    margin: 0;
    font-size: .94rem;
    font-weight: 650;
}

.contact-board {
    padding: 58px 0 86px;
}

.contact-board-grid {
    display: grid;
    grid-template-columns: minmax(0, .75fr) minmax(420px, 1fr);
    gap: 26px;
    align-items: stretch;
}

.contact-map {
    overflow: hidden;
    padding: 24px;
}

.contact-map-head {
    display: flex;
    justify-content: space-between;
    gap: 18px;
    align-items: flex-start;
    margin-bottom: 18px;
}

.contact-map-badge {
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

.map-wrapper {
    overflow: hidden;
    border-radius: 8px;
    border: 1px solid var(--ct-line);
    box-shadow: inset 0 1px 0 rgba(255,255,255,.7);
}

.map-wrapper iframe {
    width: 100%;
    min-height: 460px;
    border: 0;
    display: block;
}

.contact-note {
    margin-top: 18px;
    padding: 16px;
    border-radius: 8px;
    color: var(--ct-muted);
    background: rgba(255,255,255,.64);
    border: 1px solid var(--ct-line);
    font-weight: 750;
    line-height: 1.7;
}

.contact-note strong {
    color: var(--ct-green-dark);
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
    .contact-grid,
    .contact-board-grid {
        grid-template-columns: 1fr;
    }

    .contact-copy {
        max-width: 900px;
    }

    .contact-panel {
        max-width: 780px;
    }
}

@media (max-width: 760px) {
    .contact-hero {
        min-height: auto;
        padding: 44px 0 34px;
    }

    .contact-summary {
        grid-template-columns: 1fr;
    }

    .contact-panel-head,
    .contact-map-head {
        align-items: flex-start;
        flex-direction: column;
    }

    .contact-panel,
    .contact-map {
        padding: 20px;
    }

    .contact-card {
        grid-template-columns: 1fr;
    }

    .map-wrapper iframe {
        min-height: 340px;
    }
}
</style>
@endpush

@section('content')
<div class="contact-page">
    <div class="contact-nature-scene" aria-hidden="true">
        <span class="contact-sun"></span>
        <span class="contact-cloud cloud-one"></span>
        <span class="contact-cloud cloud-two"></span>
        <span class="contact-cloud cloud-three"></span>
        <span class="contact-bird bird-one"></span>
        <span class="contact-bird bird-two"></span>
        <span class="contact-bird bird-three"></span>
        <span class="contact-flower-field"></span>
    </div>

    <section class="contact-hero">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-copy">
                    <span class="contact-kicker">Contact Bijrol</span>
                    <h1>Gaon se judne ka seedha raasta.</h1>
                    <p>Village updates, public information, development coordination, heritage visits, ya website support ke liye Bijrol team se connect karein.</p>

                    <div class="contact-actions" aria-label="Quick contact actions">
                        <a class="contact-action" href="tel:+919876543210">Call village desk</a>
                        <a class="contact-action" href="mailto:contact@bijrolvillage.in">Email support</a>
                        <a class="contact-action" href="{{ url('/village-voice') }}">Submit public sujhav</a>
                    </div>

                    <div class="contact-summary" aria-label="Contact summary">
                        <div class="contact-stat">
                            <strong>Baraut</strong>
                            <span>Nearest tehsil</span>
                        </div>
                        <div class="contact-stat">
                            <strong>250611</strong>
                            <span>Postal code</span>
                        </div>
                        <div class="contact-stat">
                            <strong>9 AM</strong>
                            <span>Support starts</span>
                        </div>
                    </div>
                </div>

                <aside class="contact-panel">
                    <div class="contact-panel-head">
                        <div>
                            <span class="contact-kicker">Contact Information</span>
                            <h2>Important details.</h2>
                            <p>Use these details for general village information and local coordination.</p>
                        </div>
                        <span class="contact-panel-tag">Village desk</span>
                    </div>

                    <div class="contact-list">
                        <div class="contact-card">
                            <div class="contact-card-icon">AD</div>
                            <div>
                                <h3>Village Address</h3>
                                <p>BIJROL Village, Baraut Tehsil, Baghpat District, Uttar Pradesh - 250611.</p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-card-icon">PH</div>
                            <div>
                                <h3>Call Us</h3>
                                <p><a href="tel:+919876543210">+91 98765 43210</a></p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-card-icon">EM</div>
                            <div>
                                <h3>Email Support</h3>
                                <p><a href="mailto:contact@bijrolvillage.in">contact@bijrolvillage.in</a></p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-card-icon">HR</div>
                            <div>
                                <h3>Office Hours</h3>
                                <p>Monday to Saturday: 9:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="contact-board">
        <div class="container">
            <div class="contact-board-grid">
                <div class="contact-panel">
                    <div class="contact-panel-head">
                        <div>
                            <span class="contact-kicker">Fast Help</span>
                            <h2>Need a public issue recorded?</h2>
                            <p>Road, water, electricity, cleanliness, education, health, agriculture ya youth related sujhav ke liye Village Voice page use karein.</p>
                        </div>
                    </div>
                    <div class="contact-note">
                        <strong>Faster response:</strong> Public issue ya suggestion ke liye Village Voice form best hai. General information ke liye phone/email use karein.
                    </div>
                    <div class="contact-actions">
                        <a class="contact-action" href="{{ url('/village-voice') }}">Open Village Voice</a>
                        <a class="contact-action" href="{{ url('/') }}">Back to Home</a>
                    </div>
                </div>

                <div class="contact-map">
                    <div class="contact-map-head">
                        <div>
                            <span class="contact-kicker">Village Location</span>
                            <h2>Find Bijrol on map.</h2>
                            <p>Nearby roads, landmarks, and village location can be explored from here.</p>
                        </div>
                        <span class="contact-map-badge">Map access</span>
                    </div>

                    <div class="map-wrapper">
                        <iframe
                            src="https://www.google.com/maps?q=Bijrol%20Baghpat%20Uttar%20Pradesh%20250611&output=embed"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
