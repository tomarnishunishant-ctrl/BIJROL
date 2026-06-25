@extends('layouts.app')

@section('title', 'Sport Ground | BIJROL Village')

@php
    $sportGrounds = [
        ['name' => 'Village Cricket Ground', 'type' => 'Cricket', 'size' => 'Standard Size', 'area' => 'Near Community Center', 'address' => 'Bijrol, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Cricket%20Ground%20Bijrol%20Baghpat%20Uttar%20Pradesh', 'featured' => true, 'image' => 'vil.jpg.png', 'facilities' => ['Pitch', 'Practice Nets', 'Scoreboard', 'Changing Rooms'], 'rating' => '4.8'],
        ['name' => 'Football Field', 'type' => 'Football', 'size' => 'Full Size', 'area' => 'Sports Complex', 'address' => 'Bijrol, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Football%20Field%20Bijrol%20Baghpat%20Uttar%20Pradesh', 'image' => 'main.jpg.jpg', 'facilities' => ['Goal Posts', 'Flood Lights', 'Boundary Fencing'], 'rating' => '4.6'],
        ['name' => 'Volleyball Court', 'type' => 'Volleyball', 'size' => 'Standard Court', 'area' => 'Near Primary School', 'address' => 'Bijrol, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Volleyball%20Court%20Bijrol%20Baghpat%20Uttar%20Pradesh', 'image' => 'h2.jpg', 'facilities' => ['Sand Court', 'Net', 'Seating'], 'rating' => '4.5'],
        ['name' => 'Kabaddi Ground', 'type' => 'Kabaddi', 'size' => 'Standard Size', 'area' => 'Village Center', 'address' => 'Bijrol, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Kabaddi%20Ground%20Bijrol%20Baghpat%20Uttar%20Pradesh', 'featured' => true, 'image' => 'bijrol.jpg.png', 'facilities' => ['Mat Surface', 'Boundary Lines', 'Scoreboard'], 'rating' => '4.7'],
        ['name' => 'Running Track', 'type' => 'Athletics', 'size' => '400m Track', 'area' => 'Stadium Area', 'address' => 'Bijrol, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Running%20Track%20Bijrol%20Baghpat%20Uttar%20Pradesh', 'image' => 'h3.jpg', 'facilities' => ['8 Lanes', 'Jump Pits', 'Timing System'], 'rating' => '4.9'],
        ['name' => 'Badminton Court', 'type' => 'Badminton', 'size' => 'Standard Court', 'area' => 'Indoor Sports Hall', 'address' => 'Bijrol, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Badminton%20Court%20Bijrol%20Baghpat%20Uttar%20Pradesh', 'image' => 'h5.jpeg', 'facilities' => ['Wooden Floor', 'Lighting', 'Ventilation'], 'rating' => '4.4'],
    ];

    $facilities = [
        ['icon' => 'FL', 'name' => 'Flood Lights', 'desc' => 'Night practice and matches'],
        ['icon' => 'SA', 'name' => 'Seating Area', 'desc' => 'Comfortable spectator seating'],
        ['icon' => 'CR', 'name' => 'Changing Rooms', 'desc' => 'Clean and secure facilities'],
        ['icon' => 'DW', 'name' => 'Drinking Water', 'desc' => 'Pure water supply'],
        ['icon' => 'PK', 'name' => 'Parking', 'desc' => 'Vehicle parking area'],
        ['icon' => 'EQ', 'name' => 'Equipment', 'desc' => 'Sports gear availability'],
    ];
@endphp

@push('styles')
<style>
.sports-page {
    --sp-ink:#102033;
    --sp-muted:#647386;
    --sp-green:#0f6b47;
    --sp-green-dark:#073923;
    --sp-saffron:#d98516;
    --sp-bg:#f4f8f5;
    --sp-panel:rgba(255,255,255,.92);
    --sp-line:rgba(16,32,51,.12);
    --sp-shadow:0 22px 62px rgba(16,32,51,.12);
    background:
        radial-gradient(circle at 12% 12%, rgba(15,107,71,.2), transparent 28%),
        radial-gradient(circle at 88% 16%, rgba(217,133,22,.18), transparent 28%),
        linear-gradient(180deg,#fff2d8 0%,#eef9ef 48%,#eaf2fb 100%);
    color:var(--sp-ink);
}
.sp-hero{position:relative;min-height:calc(100vh - 92px);display:grid;align-items:center;padding:68px 0 44px;overflow:hidden;isolation:isolate}
.sp-hero:before{content:"";position:absolute;inset:0;z-index:-2;background:url('{{ asset('image/F.jpeg') }}') center/cover no-repeat;opacity:.34}
.sp-hero:after{content:"";position:absolute;inset:0;z-index:-1;background:linear-gradient(90deg,rgba(244,248,245,.98) 0%,rgba(244,248,245,.86) 48%,rgba(244,248,245,.58) 100%),linear-gradient(180deg,rgba(255,255,255,.05),var(--sp-bg))}
.sp-grid-hero{display:grid;grid-template-columns:minmax(0,.9fr) minmax(360px,.62fr);gap:34px;align-items:center}
.sp-kicker{display:inline-flex;align-items:center;gap:10px;margin-bottom:14px;color:var(--sp-green);font-size:.78rem;font-weight:900;text-transform:uppercase;letter-spacing:.08em}
.sp-kicker:before{content:"";width:10px;height:10px;border-radius:50%;background:currentColor;box-shadow:0 0 0 7px rgba(15,107,71,.12)}
.sp-hero h1{max-width:820px;margin:0;color:var(--sp-green-dark);font-size:clamp(2.7rem,6vw,5.8rem);line-height:.96;font-weight:950;letter-spacing:0}
.sp-hero p{max-width:690px;margin:18px 0 0;color:var(--sp-muted);font-size:1.08rem;line-height:1.85;font-weight:650}
.sp-actions{display:flex;flex-wrap:wrap;gap:10px;margin-top:28px}
.sp-btn{min-height:46px;display:inline-flex;align-items:center;justify-content:center;padding:11px 16px;border-radius:8px;text-decoration:none;font-weight:900;transition:transform .2s ease,box-shadow .2s ease}
.sp-btn:hover{transform:translateY(-2px)}
.sp-btn-primary{color:#fff;background:linear-gradient(135deg,var(--sp-green-dark),var(--sp-green));box-shadow:0 18px 38px rgba(15,107,71,.24)}
.sp-btn-light{color:var(--sp-green-dark);background:rgba(255,255,255,.84);border:1px solid var(--sp-line)}
.sp-panel,.sp-stat,.sp-card,.sp-feature,.sp-facility{border-radius:8px;background:var(--sp-panel);border:1px solid var(--sp-line);box-shadow:var(--sp-shadow);backdrop-filter:blur(18px)}
.sp-panel{padding:24px}
.sp-panel img{width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:8px;border:1px solid var(--sp-line)}
.sp-panel strong{display:block;margin-top:16px;color:var(--sp-green-dark);font-size:1.14rem;font-weight:950}
.sp-panel span{display:block;margin-top:6px;color:var(--sp-muted);line-height:1.7;font-weight:650}
.sp-stats{position:relative;z-index:2;margin-top:-34px}
.sp-stats-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px}
.sp-stat{min-height:112px;padding:20px}
.sp-stat strong{display:block;color:var(--sp-green-dark);font-size:2rem;line-height:1;font-weight:950}
.sp-stat span{display:block;margin-top:9px;color:var(--sp-muted);font-weight:850}
.sp-section{padding:76px 0}
.sp-heading{max-width:780px;margin:0 auto 34px;text-align:center}
.sp-heading h2{margin:0;color:var(--sp-green-dark);font-size:clamp(2rem,4vw,3.35rem);line-height:1.1;font-weight:950}
.sp-heading p{margin:12px 0 0;color:var(--sp-muted);line-height:1.8;font-weight:650}
.sp-card-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px}
.sp-card{overflow:hidden;transition:transform .2s ease,box-shadow .2s ease,border-color .2s ease}
.sp-card:hover,.sp-facility:hover{transform:translateY(-4px);border-color:rgba(217,133,22,.42);box-shadow:0 26px 64px rgba(16,32,51,.15)}
.sp-card img{width:100%;height:220px;object-fit:cover}
.sp-card-body{padding:22px}
.sp-badge{display:inline-flex;margin-bottom:10px;padding:6px 9px;border-radius:8px;color:#8a4b08;background:#fff7ed;border:1px solid #fed7aa;font-size:.72rem;font-weight:950;text-transform:uppercase}
.sp-card h3{margin:0 0 7px;color:var(--sp-green-dark);font-size:1.16rem;font-weight:950}
.sp-card p{margin:0;color:var(--sp-muted);line-height:1.65;font-weight:650}
.sp-info{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px;margin:14px 0}
.sp-info div,.sp-tags span{border-radius:8px;background:#f8fafc;border:1px solid var(--sp-line)}
.sp-info div{padding:10px}
.sp-info span{display:block;color:var(--sp-muted);font-size:.7rem;font-weight:900;text-transform:uppercase}
.sp-info strong{font-size:.9rem}
.sp-tags{display:flex;flex-wrap:wrap;gap:8px;margin:14px 0}
.sp-tags span{padding:6px 9px;color:var(--sp-green);font-size:.78rem;font-weight:800}
.sp-feature{margin-top:34px;padding:34px;color:#fff;background:linear-gradient(135deg,var(--sp-green-dark),var(--sp-green))}
.sp-feature h2{font-size:clamp(1.8rem,3vw,2.7rem);font-weight:950;margin:0 0 12px}
.sp-feature p{max-width:820px;color:rgba(255,255,255,.86);line-height:1.8;margin:0}
.sp-facility-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px}
.sp-facility{padding:22px;text-align:center;transition:transform .2s ease,box-shadow .2s ease,border-color .2s ease}
.sp-facility-icon{width:52px;height:52px;display:grid;place-items:center;margin:0 auto 14px;border-radius:8px;color:#fff;background:linear-gradient(135deg,var(--sp-green-dark),var(--sp-green));font-size:.8rem;font-weight:950}
.sp-facility h3{margin:0 0 6px;color:var(--sp-green-dark);font-size:1rem;font-weight:950}
.sp-facility p{margin:0;color:var(--sp-muted);line-height:1.6;font-weight:650}
@media(max-width:1100px){.sp-grid-hero{grid-template-columns:1fr}.sp-card-grid,.sp-facility-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.sp-panel{max-width:680px}}
@media(max-width:760px){.sp-hero{min-height:auto;padding:44px 0 34px}.sp-stats{margin-top:0;padding-top:18px}.sp-stats-grid,.sp-card-grid,.sp-facility-grid,.sp-info{grid-template-columns:1fr}.sp-section{padding:56px 0}}
</style>
@endpush

@section('content')
<div class="sports-page">
    <section class="sp-hero">
        <div class="container sp-grid-hero">
            <div>
                <span class="sp-kicker">C-Field Bijrol</span>
                <h1>Sports infrastructure for village youth.</h1>
                <p>Grounds for cricket, football, volleyball, kabaddi, athletics, and badminton with community-focused facilities.</p>
                <div class="sp-actions">
                    <a class="sp-btn sp-btn-primary" href="#grounds">Explore Grounds</a>
                    <a class="sp-btn sp-btn-light" href="#facilities">View Facilities</a>
                </div>
            </div>
            <aside class="sp-panel">
                <img src="{{ asset('image/F.jpeg') }}" alt="Bijrol sports ground">
                <strong>Community sports access</strong>
                <span>Sports spaces are presented clearly with facilities, locations, and map access.</span>
            </aside>
        </div>
    </section>

    <section class="sp-stats">
        <div class="container sp-stats-grid">
            <div class="sp-stat"><strong>{{ count($sportGrounds) }}</strong><span>Total Grounds</span></div>
            <div class="sp-stat"><strong>6+</strong><span>Sports Types</span></div>
            <div class="sp-stat"><strong>1000+</strong><span>Active Players</span></div>
            <div class="sp-stat"><strong>Free</strong><span>Community Access</span></div>
        </div>
    </section>

    <section class="sp-section" id="grounds">
        <div class="container">
            <div class="sp-heading">
                <span class="sp-kicker">Sports Grounds</span>
                <h2>Facilities for practice, matches, and fitness.</h2>
                <p>Each ground card includes size, area, facilities, rating, and direct Google Maps access.</p>
            </div>

            <div class="sp-card-grid">
                @foreach($sportGrounds as $ground)
                    <article class="sp-card">
                        <img src="{{ asset('image/' . $ground['image']) }}" alt="{{ $ground['name'] }}">
                        <div class="sp-card-body">
                            <span class="sp-badge">{{ $ground['type'] }} | Rating {{ $ground['rating'] }}</span>
                            <h3>{{ $ground['name'] }}</h3>
                            <p>{{ $ground['area'] }} - {{ $ground['address'] }}</p>
                            <div class="sp-info">
                                <div><span>Size</span><strong>{{ $ground['size'] }}</strong></div>
                                <div><span>Facilities</span><strong>{{ count($ground['facilities']) }} Items</strong></div>
                            </div>
                            <div class="sp-tags">
                                @foreach($ground['facilities'] as $facility)
                                    <span>{{ $facility }}</span>
                                @endforeach
                            </div>
                            <div class="sp-actions">
                                <a class="sp-btn sp-btn-primary" href="{{ $ground['map'] }}" target="_blank" rel="noopener">View Location</a>
                                <a class="sp-btn sp-btn-light" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($ground['name'] . ' ' . $ground['address']) }}" target="_blank" rel="noopener">Directions</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="sp-feature">
                <h2>Building champions through community sports.</h2>
                <p>Bijrol's sports spaces support daily practice, tournaments, youth fitness, and a healthier village lifestyle.</p>
            </div>
        </div>
    </section>

    <section class="sp-section" id="facilities">
        <div class="container">
            <div class="sp-heading">
                <span class="sp-kicker">Facilities</span>
                <h2>Useful amenities for every player.</h2>
                <p>Clear facility information helps players, coaches, and families plan sports activities better.</p>
            </div>

            <div class="sp-facility-grid">
                @foreach($facilities as $facility)
                    <div class="sp-facility">
                        <div class="sp-facility-icon">{{ $facility['icon'] }}</div>
                        <h3>{{ $facility['name'] }}</h3>
                        <p>{{ $facility['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
