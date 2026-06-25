@extends('layouts.app')

@section('title', 'Temples | BIJROL Village')

@php
    $localImage = fn ($file) => asset('image/' . $file);

    $temples = [
        ['name' => 'Bhagwaan Valmiki Mandir', 'type' => 'Valmiki Temple', 'deity' => 'Lord Valmiki', 'area' => 'Bijrol, Baghpat', 'address' => 'Bijrol, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Bhagwaan%20Valmiki%20Mandir%20Bijrol%20Baghpat%20Uttar%20Pradesh', 'featured' => true],
        ['name' => 'Radha Krishna Temple', 'type' => 'Radha Krishna Temple', 'deity' => 'Radha Krishna', 'area' => 'Bdaa Kuwaan, Bijrol Lohadda, Baraut', 'address' => 'Bdaa Kuwaan, Bijrol Lohadda, Baraut', 'map' => 'https://www.google.com/maps/search/?api=1&query=Radha%20Krishna%20Temple%20Bdaa%20Kuwaan%20Bijrol%20Lohadda%20Baraut', 'images' => [$localImage('t1.jpeg'), $localImage('t2.jpeg')]],
        ['name' => 'Sant Ravidas Mandir', 'type' => 'Ravidas Temple', 'deity' => 'Sant Ravidas', 'area' => 'MDR 135W, Bijrol Lohadda, Baraut', 'address' => 'MDR 135W, Bijrol Lohadda, Baraut', 'map' => 'https://www.google.com/maps/search/?api=1&query=Sant%20Ravidas%20Mandir%20MDR%20135W%20Bijrol%20Lohadda%20Baraut'],
        ['name' => 'Akhara Temple', 'type' => 'Local Temple', 'deity' => 'Local Deity', 'area' => 'Bijrol Lohadda, Baraut', 'address' => 'Bijrol Lohadda, Baraut', 'map' => 'https://www.google.com/maps/search/?api=1&query=Akhara%20Temple%20Bijrol%20Lohadda%20Baraut%20Baghpat'],
        ['name' => 'Thakur Duwara Mandir', 'type' => 'Thakurdwara Temple', 'deity' => 'Lord Krishna', 'area' => 'Bijrol, Baraut area', 'address' => 'Bijrol, Baraut, Baghpat', 'map' => 'https://www.google.com/maps/search/?api=1&query=Thakur%20Duwara%20Mandir%20Bijrol%20Baraut%20Baghpat'],
        ['name' => 'Bada Shiv Mandir', 'type' => 'Shiv Temple', 'deity' => 'Lord Shiva', 'area' => 'Bijrol, Baraut area', 'address' => 'Bijrol, Baraut, Baghpat', 'map' => 'https://www.google.com/maps/search/?api=1&query=Bada%20Shiv%20Mandir%20Bijrol%20Baraut%20Baghpat', 'featured' => true],
        ['name' => 'Holi Wala Shiv Mandir', 'type' => 'Shiv Temple', 'deity' => 'Lord Shiva', 'area' => 'Bijrol, Baraut area', 'address' => 'Bijrol, Baraut, Baghpat', 'map' => 'https://www.google.com/maps/search/?api=1&query=Holi%20Wala%20Shiv%20Mandir%20Bijrol%20Baraut%20Baghpat'],
        ['name' => 'Bhumiya Ka Mandir', 'type' => 'Village Deity Temple', 'deity' => 'Gram Devta', 'area' => 'Bijrol, Baraut area', 'address' => 'Bijrol, Baraut, Baghpat', 'map' => 'https://www.google.com/maps/search/?api=1&query=Bhumiya%20Ka%20Mandir%20Bijrol%20Baraut%20Baghpat'],
        ['name' => 'Shree Maa Durga Mandir', 'type' => 'Durga Temple', 'deity' => 'Goddess Durga', 'area' => 'Bijrol, Baraut area', 'address' => 'Bijrol, Baraut, Baghpat', 'map' => 'https://www.google.com/maps/search/?api=1&query=Shree%20Maa%20Durga%20Mandir%20Bijrol%20Baraut%20Baghpat'],
    ];
@endphp

@push('styles')
<style>
.temple-premium { --green:#064e30; --green2:#0f766e; --gold:#f59e0b; --gold2:#fde68a; --ink:#0f172a; --muted:#64748b; --line:rgba(15,23,42,.08); background:linear-gradient(180deg,#fff0d6 0%,#fff8e6 38%,#eef9ef 100%); color:var(--ink); }
.tp-hero { position:relative; padding:110px 0 92px; color:#fff; background:linear-gradient(135deg,rgba(6,78,48,.5),rgba(146,64,14,.4)),url('{{ asset('image/h5.jpeg') }}') center/cover no-repeat; overflow:hidden; }
.tp-hero:after { content:""; position:absolute; inset:0; background:linear-gradient(90deg,rgba(3,31,20,.4),rgba(3,31,20,.15)),radial-gradient(circle at 76% 18%,rgba(253,230,138,.28),transparent 34%); }
.tp-hero .container { position:relative; z-index:2; }
.tp-kicker { display:inline-flex; gap:10px; align-items:center; color:var(--gold2); font-size:.78rem; font-weight:900; letter-spacing:.14em; text-transform:uppercase; margin-bottom:16px; }
.tp-kicker:before { content:""; width:34px; height:2px; background:currentColor; }
.tp-hero h1 { font-size:clamp(3rem,7vw,5.8rem); line-height:.95; font-weight:950; letter-spacing:0; margin:0 0 18px; text-shadow:0 24px 55px rgba(0,0,0,.32); }
.tp-hero p { max-width:760px; color:rgba(255,255,255,.9); line-height:1.85; font-size:1.12rem; margin:0; }
.tp-stats { margin-top:-42px; position:relative; z-index:4; }
.tp-stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:18px; }
.tp-stat,.tp-card,.tp-map,.tp-feature { border-radius:8px; background:#fff; border:1px solid var(--line); box-shadow:0 18px 48px rgba(15,23,42,.08); }
.tp-stat { padding:24px 18px; text-align:center; }
.tp-stat strong { display:block; color:#92400e; font-size:2rem; line-height:1; margin-bottom:8px; }
.tp-stat span { color:var(--muted); font-weight:800; }
.tp-section { padding:86px 0; }
.tp-heading { max-width:780px; margin:0 auto 46px; text-align:center; }
.tp-heading span { color:var(--green2); font-size:.78rem; font-weight:900; letter-spacing:.14em; text-transform:uppercase; }
.tp-heading h2 { font-size:clamp(2rem,4vw,3.3rem); line-height:1.12; font-weight:950; letter-spacing:0; margin:10px 0 14px; }
.tp-heading p { color:var(--muted); line-height:1.8; margin:0; }
.tp-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.tp-card { padding:26px; position:relative; overflow:hidden; transition:.28s ease; }
.tp-card:before { content:""; position:absolute; inset:0 0 auto; height:5px; background:linear-gradient(90deg,var(--green),var(--gold)); }
.tp-card:hover { transform:translateY(-8px); box-shadow:0 28px 68px rgba(15,23,42,.14); border-color:rgba(245,158,11,.34); }
.tp-card.featured { background:linear-gradient(180deg,#fff,#fffbeb); }
.tp-card.has-media { background:linear-gradient(180deg,rgba(255,255,255,.94),rgba(255,251,235,.9)),var(--temple-bg) center/cover no-repeat; }
.tp-card.has-media > * { position:relative; z-index:1; }
.tp-badge { display:inline-flex; padding:7px 12px; border-radius:8px; background:rgba(245,158,11,.14); color:#92400e; font-size:.75rem; font-weight:900; text-transform:uppercase; margin-bottom:16px; }
.tp-card h3 { font-size:1.18rem; font-weight:950; letter-spacing:0; margin:0 0 12px; }
.tp-slider { position:relative; height:220px; margin:4px 0 18px; border-radius:8px; overflow:hidden; background:#0f172a; border:1px solid rgba(245,158,11,.28); box-shadow:0 16px 34px rgba(15,23,42,.16); }
.tp-slider img { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:0; animation:templeSlide 6s infinite; }
.tp-slider img:nth-child(2) { animation-delay:3s; }
@keyframes templeSlide { 0%,45%{opacity:1; transform:scale(1)} 50%,95%{opacity:0; transform:scale(1.04)} 100%{opacity:1; transform:scale(1)} }
.tp-info { display:grid; gap:10px; margin:18px 0 22px; }
.tp-info div { padding:12px; border-radius:8px; background:#f8fafc; border:1px solid var(--line); }
.tp-card.has-media .tp-info div { background:rgba(255,255,255,.88); backdrop-filter:blur(4px); }
.tp-info span { display:block; color:var(--muted); font-size:.7rem; font-weight:900; letter-spacing:.08em; text-transform:uppercase; margin-bottom:4px; }
.tp-info strong { color:var(--ink); font-size:.9rem; }
.tp-actions { display:flex; gap:10px; }
.tp-btn { flex:1; display:inline-flex; align-items:center; justify-content:center; min-height:44px; padding:11px 14px; border-radius:8px; font-weight:900; text-decoration:none; transition:.25s ease; }
.tp-btn:hover { transform:translateY(-3px); }
.tp-btn-primary { background:var(--green); color:#fff; }
.tp-btn-light { background:#fff7ed; color:#92400e; border:1px solid rgba(245,158,11,.22); }
.tp-feature { margin-top:64px; padding:36px; display:grid; grid-template-columns:1fr .8fr; gap:26px; align-items:center; background:linear-gradient(135deg,var(--green),var(--green2)); color:#fff; }
.tp-feature h2 { font-size:clamp(1.8rem,3vw,2.7rem); font-weight:950; letter-spacing:0; margin:0 0 12px; }
.tp-feature p { color:rgba(255,255,255,.86); line-height:1.8; margin:0; }
.tp-feature img { width:100%; height:260px; object-fit:cover; border-radius:8px; }
.tp-map { margin-top:60px; overflow:hidden; }
.tp-map-head { padding:24px 28px; display:flex; justify-content:space-between; gap:16px; align-items:center; border-bottom:1px solid var(--line); }
.tp-map-head h3 { font-weight:950; margin:0 0 4px; }
.tp-map-head p { color:var(--muted); margin:0; }
.tp-map iframe { width:100%; height:410px; border:0; display:block; }
@media(max-width:1100px){.tp-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:900px){.tp-feature{grid-template-columns:1fr}.tp-stats-grid{grid-template-columns:repeat(2,1fr)}.tp-map-head{flex-direction:column;align-items:flex-start}}
@media(max-width:700px){.tp-hero{padding:82px 0 66px}.tp-section{padding:62px 0}.tp-stats{margin-top:0;padding-top:18px}.tp-stats-grid,.tp-grid{grid-template-columns:1fr}.tp-actions{flex-direction:column}.tp-map iframe{height:320px}}
</style>
@endpush

@section('content')
<div class="temple-premium">
    <section class="tp-hero">
        <div class="container">
            <span class="tp-kicker">Religious Heritage Directory</span>
            <h1>Temples in Bijrol</h1>
            <p>A premium guide to devotional places, local temples, deities, addresses, and direct Google Maps access across Bijrol village.</p>
        </div>
    </section>

    <section class="tp-stats">
        <div class="container tp-stats-grid">
            <div class="tp-stat"><strong>{{ count($temples) }}</strong><span>Total Temples</span></div>
            <div class="tp-stat"><strong>9</strong><span>Listed Sites</span></div>
            <div class="tp-stat"><strong>2</strong><span>Shiv Temples</span></div>
            <div class="tp-stat"><strong>7+</strong><span>Deities</span></div>
        </div>
    </section>

    <main class="tp-section">
        <div class="container">
            <div class="tp-heading">
                <span>Faith & Culture</span>
                <h2>Spiritual places that preserve Bijrol's identity.</h2>
                <p>Each temple card keeps location and deity details simple, readable, and ready for visitors.</p>
            </div>

            <div class="tp-grid">
                @foreach ($temples as $temple)
                    <article class="tp-card {{ isset($temple['featured']) ? 'featured' : '' }} {{ isset($temple['images']) ? 'has-media' : '' }}" @if(isset($temple['images'])) style="--temple-bg:url('{{ $temple['images'][0] }}')" @endif>
                        <span class="tp-badge">{{ isset($temple['featured']) ? 'Featured' : $temple['type'] }}</span>
                        <h3>{{ $temple['name'] }}</h3>
                        @if(isset($temple['images']))
                            <div class="tp-slider" aria-label="{{ $temple['name'] }} photos">
                                @foreach($temple['images'] as $image)
                                    <img src="{{ $image }}" alt="{{ $temple['name'] }}">
                                @endforeach
                            </div>
                        @endif
                        <div class="tp-info">
                            <div><span>Deity</span><strong>{{ $temple['deity'] }}</strong></div>
                            <div><span>Area</span><strong>{{ $temple['area'] }}</strong></div>
                            <div><span>Address</span><strong>{{ $temple['address'] }}</strong></div>
                        </div>
                        <div class="tp-actions">
                            <a class="tp-btn tp-btn-primary" href="{{ $temple['map'] }}" target="_blank" rel="noopener">View Location</a>
                            <a class="tp-btn tp-btn-light" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($temple['name']) }}" target="_blank" rel="noopener">Directions</a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="tp-feature">
                <div>
                    <span class="tp-kicker">Living Heritage</span>
                    <h2>Temples connect Bijrol to faith, memory, and community life.</h2>
                    <p>These places are more than destinations. They are shared spaces for devotion, gatherings, festivals, and cultural continuity.</p>
                </div>
                <img src="{{ asset('image/h5.jpeg') }}" alt="Bijrol heritage">
            </div>

            <div class="tp-map">
                <div class="tp-map-head">
                    <div>
                        <h3>Bijrol Temple Locations</h3>
                        <p>Geographical view of religious places in Bijrol, Baghpat district.</p>
                    </div>
                    <a class="tp-btn tp-btn-primary" style="flex:0 0 auto" href="https://www.google.com/maps/search/?api=1&query=temples%20in%20Bijrol%20Baghpat%20Uttar%20Pradesh" target="_blank" rel="noopener">Open Maps</a>
                </div>
                <iframe src="https://www.google.com/maps?q=temples%20in%20Bijrol%20Baghpat%20Uttar%20Pradesh&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
            </div>
        </div>
    </main>
</div>
@endsection
