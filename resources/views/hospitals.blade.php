@extends('layouts.app')

@section('title', 'Healthcare | BIJROL Village')

@php
    $hospitals = [
        [
            'name' => 'Primary Health Centre (PHC)',
            'type' => 'Government',
            'specialty' => 'Primary Healthcare',
            'address' => 'Bijrol Village, Baraut, Baghpat, Uttar Pradesh 250620',
            'phone' => 'Contact Gram Panchayat',
            'services' => ['General Medicine', 'Vaccination', 'Maternity Care', 'Family Welfare', 'Outdoor Patient Care'],
            'image' => asset('image/h1.jpg'),
            'timing' => '9:00 AM - 5:00 PM',
            'established' => 'Available in Village',
        ],
        [
            'name' => 'Animal Husbandry Clinic Bijrol',
            'type' => 'Government',
            'specialty' => 'Veterinary / Animal Healthcare',
            'address' => 'Bijrol Village, Baraut, Baghpat, Uttar Pradesh 250620',
            'phone' => 'Contact Gram Panchayat',
            'services' => ['Animal Treatment', 'Vaccination', 'Health Checkup', 'First Aid', 'Livestock Care'],
            'image' => asset('image/h4.jpeg'),
            'timing' => '9:00 AM - 5:00 PM',
            'established' => 'Government Facility',
        ],
    ];
@endphp

@push('styles')
<style>
.health-premium { --green:#064e30; --green2:#0f766e; --teal:#14b8a6; --gold:#f59e0b; --gold2:#fde68a; --ink:#0f172a; --muted:#64748b; --line:rgba(15,23,42,.08); background:linear-gradient(180deg,#e6fbf7 0%,#eef9ef 48%,#fff3d7 100%); color:var(--ink); }
.hp-hero { position:relative; padding:110px 0 92px; color:#fff; background:linear-gradient(135deg,rgba(6,78,48,.5),rgba(13,148,136,.4)),url('{{ asset('image/h1.jpg') }}') center/cover no-repeat; overflow:hidden; }
.hp-hero:after { content:""; position:absolute; inset:0; background:linear-gradient(90deg,rgba(3,31,20,.4),rgba(3,31,20,.15)),radial-gradient(circle at 78% 18%,rgba(253,230,138,.28),transparent 34%); }
.hp-hero .container { position:relative; z-index:2; }
.hp-kicker { display:inline-flex; align-items:center; gap:10px; color:var(--gold2); font-size:.78rem; font-weight:900; letter-spacing:.14em; text-transform:uppercase; margin-bottom:16px; }
.hp-kicker:before { content:""; width:34px; height:2px; background:currentColor; }
.hp-hero h1 { font-size:clamp(3rem,7vw,5.8rem); line-height:.95; font-weight:950; letter-spacing:0; margin:0 0 18px; text-shadow:0 4px 20px rgba(0,0,0,.5), 0 8px 40px rgba(0,0,0,.3); }
.hp-hero p { max-width:760px; color:rgba(255,255,255,.9); line-height:1.85; font-size:1.12rem; margin:0; }
.hp-stats { margin-top:-42px; position:relative; z-index:4; }
.hp-stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:18px; }
.hp-stat,.hp-card,.hp-banner,.hp-map { border-radius:8px; background:#fff; border:1px solid var(--line); box-shadow:0 18px 48px rgba(15,23,42,.08); }
.hp-stat { padding:24px 18px; text-align:center; }
.hp-stat strong { display:block; color:var(--green); font-size:2rem; line-height:1; margin-bottom:8px; }
.hp-stat span { color:var(--muted); font-weight:800; }
.hp-section { padding:86px 0; }
.hp-heading { max-width:780px; margin:0 auto 46px; text-align:center; }
.hp-heading span { color:var(--green2); font-size:.78rem; font-weight:900; letter-spacing:.14em; text-transform:uppercase; }
.hp-heading h2 { font-size:clamp(2rem,4vw,3.3rem); line-height:1.12; font-weight:950; letter-spacing:0; margin:10px 0 14px; }
.hp-heading p { color:var(--muted); line-height:1.8; margin:0; }
.hp-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:26px; }
.hp-card { overflow:hidden; transition:.28s ease; }
.hp-card:hover { transform:translateY(-8px); box-shadow:0 28px 68px rgba(15,23,42,.14); border-color:rgba(20,184,166,.34); }
.hp-card-img { height:250px; position:relative; overflow:hidden; }
.hp-card-img img { width:100%; height:100%; object-fit:cover; display:block; transition:.45s ease; }
.hp-card:hover .hp-card-img img { transform:scale(1.06); }
.hp-card-img span { position:absolute; left:18px; top:18px; padding:8px 13px; border-radius:8px; background:var(--green); color:#fff; font-size:.75rem; font-weight:900; text-transform:uppercase; }
.hp-card-body { padding:28px; }
.hp-card h3 { font-size:1.35rem; font-weight:950; letter-spacing:0; margin:0 0 8px; }
.hp-specialty { color:var(--green2); font-weight:900; margin-bottom:18px; }
.hp-info { display:grid; grid-template-columns:repeat(2,1fr); gap:12px; margin-bottom:20px; }
.hp-info div { padding:13px; border-radius:8px; background:#f8fafc; border:1px solid var(--line); }
.hp-info span { display:block; color:var(--muted); font-size:.7rem; font-weight:900; letter-spacing:.08em; text-transform:uppercase; margin-bottom:4px; }
.hp-info strong { color:var(--ink); font-size:.9rem; }
.hp-tags { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:22px; }
.hp-tags span { padding:7px 11px; border-radius:8px; background:#f0fdfa; color:var(--green2); border:1px solid #ccfbf1; font-size:.76rem; font-weight:800; }
.hp-actions { display:flex; gap:10px; }
.hp-btn { flex:1; display:inline-flex; align-items:center; justify-content:center; min-height:46px; padding:12px 16px; border-radius:8px; font-weight:900; text-decoration:none; transition:.25s ease; }
.hp-btn:hover { transform:translateY(-3px); }
.hp-btn-primary { background:var(--green); color:#fff; }
.hp-btn-light { background:#fff7ed; color:#92400e; border:1px solid rgba(245,158,11,.22); }
.hp-banner { margin-top:60px; padding:36px; display:grid; grid-template-columns:1fr auto; gap:24px; align-items:center; background:linear-gradient(135deg,var(--green),var(--green2)); color:#fff; }
.hp-banner h2 { font-size:clamp(1.8rem,3vw,2.7rem); font-weight:950; letter-spacing:0; margin:0 0 12px; }
.hp-banner p { color:rgba(255,255,255,.86); line-height:1.8; margin:0; max-width:760px; }
.hp-banner-stats { display:grid; grid-template-columns:repeat(3,110px); gap:12px; }
.hp-banner-stats div { padding:16px; border-radius:8px; background:rgba(255,255,255,.12); text-align:center; }
.hp-banner-stats strong { display:block; color:var(--gold2); font-size:1.4rem; }
.hp-banner-stats span { color:rgba(255,255,255,.78); font-size:.72rem; font-weight:900; text-transform:uppercase; }
.hp-map { margin-top:60px; overflow:hidden; }
.hp-map-head { padding:24px 28px; display:flex; justify-content:space-between; gap:16px; align-items:center; border-bottom:1px solid var(--line); }
.hp-map-head h3 { font-weight:950; margin:0 0 4px; }
.hp-map-head p { color:var(--muted); margin:0; }
.hp-map iframe { width:100%; height:410px; border:0; display:block; }
@media(max-width:1000px){.hp-grid,.hp-banner{grid-template-columns:1fr}.hp-stats-grid{grid-template-columns:repeat(2,1fr)}.hp-banner-stats{grid-template-columns:repeat(3,1fr)}.hp-map-head{flex-direction:column;align-items:flex-start}}
@media(max-width:700px){.hp-hero{padding:82px 0 66px}.hp-section{padding:62px 0}.hp-stats{margin-top:0;padding-top:18px}.hp-stats-grid,.hp-info,.hp-banner-stats{grid-template-columns:1fr}.hp-actions{flex-direction:column}.hp-map iframe{height:320px}}
</style>
@endpush

@section('content')
<div class="health-premium">
    <section class="hp-hero">
        <div class="container">
            <span class="hp-kicker">Healthcare Directory</span>
            <h1>Healthcare in Bijrol</h1>
            <p>Government healthcare facilities for residents and livestock, presented with clear services, timings, contacts, and map access.</p>
        </div>
    </section>

    <section class="hp-stats">
        <div class="container hp-stats-grid">
            <div class="hp-stat"><strong>2</strong><span>Centers</span></div>
            <div class="hp-stat"><strong>PHC</strong><span>Human Care</span></div>
            <div class="hp-stat"><strong>Vet</strong><span>Animal Care</span></div>
            <div class="hp-stat"><strong>Govt</strong><span>Managed</span></div>
        </div>
    </section>

    <main class="hp-section">
        <div class="container">
            <div class="hp-heading">
                <span>Health Access</span>
                <h2>Facilities serving people and livestock.</h2>
                <p>Two government facilities support everyday health needs, vaccination, first aid, family welfare, and animal care.</p>
            </div>

            <div class="hp-grid">
                @foreach ($hospitals as $hospital)
                    <article class="hp-card">
                        <div class="hp-card-img">
                            <img src="{{ $hospital['image'] }}" alt="{{ $hospital['name'] }}">
                            <span>{{ $hospital['type'] }}</span>
                        </div>
                        <div class="hp-card-body">
                            <h3>{{ $hospital['name'] }}</h3>
                            <div class="hp-specialty">{{ $hospital['specialty'] }}</div>
                            <div class="hp-info">
                                <div><span>Timing</span><strong>{{ $hospital['timing'] }}</strong></div>
                                <div><span>Contact</span><strong>{{ $hospital['phone'] }}</strong></div>
                                <div><span>Status</span><strong>{{ $hospital['established'] }}</strong></div>
                                <div><span>Address</span><strong>{{ $hospital['address'] }}</strong></div>
                            </div>
                            <div class="hp-tags">
                                @foreach ($hospital['services'] as $service)
                                    <span>{{ $service }}</span>
                                @endforeach
                            </div>
                            <div class="hp-actions">
                                <a class="hp-btn hp-btn-primary" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($hospital['name'] . ' ' . $hospital['address']) }}" target="_blank" rel="noopener">Location</a>
                                <a class="hp-btn hp-btn-light" href="https://www.google.com/search?q={{ urlencode($hospital['name'] . ' ' . $hospital['address']) }}" target="_blank" rel="noopener">Details</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="hp-banner">
                <div>
                    <h2>Government health support for the village.</h2>
                    <p>Bijrol has a Primary Health Centre for human care and an Animal Husbandry Clinic for livestock health, helping families and farmers access essential services close to home.</p>
                </div>
                <div class="hp-banner-stats">
                    <div><strong>2</strong><span>Centers</span></div>
                    <div><strong>PHC</strong><span>Human</span></div>
                    <div><strong>AH</strong><span>Veterinary</span></div>
                </div>
            </div>

            <div class="hp-map">
                <div class="hp-map-head">
                    <div>
                        <h3>Nearby Healthcare Map</h3>
                        <p>Explore healthcare facilities near Bijrol on the map.</p>
                    </div>
                    <a class="hp-btn hp-btn-primary" style="flex:0 0 auto" href="https://www.google.com/maps/search/?api=1&query=hospitals+near+Bijrol+Baghpat+Uttar+Pradesh" target="_blank" rel="noopener">Open Maps</a>
                </div>
                <iframe src="https://www.google.com/maps?q=hospitals+near+Bijrol+Baghpat+Uttar+Pradesh&output=embed" loading="lazy"></iframe>
            </div>
        </div>
    </main>
</div>
@endsection
