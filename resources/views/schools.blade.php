@extends('layouts.app')

@section('title', 'Schools | BIJROL Village')

@php
    $schools = [
        ['name' => 'P.S. Bijraul-1', 'type' => 'Government Primary School', 'badge' => 'Government', 'classes' => 'Primary (1-5)', 'udise' => '09080201601', 'medium' => 'Hindi', 'address' => 'Bijraul, Baraut, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=P.S.%20Bijraul-1%20Bijraul%20Baraut%20Baghpat%20Uttar%20Pradesh', 'featured' => true],
        ['name' => 'P.S. Bijraul-2', 'type' => 'Government Primary School', 'badge' => 'Government', 'classes' => 'Primary (1-5)', 'udise' => '09080201602', 'medium' => 'Hindi', 'address' => 'Bijraul, Baraut, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=P.S.%20Bijraul-2%20Bijraul%20Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'P.S. Bijraul-3', 'type' => 'Government Primary School', 'badge' => 'Government', 'classes' => 'Primary (1-5)', 'udise' => '09080201603', 'medium' => 'Hindi', 'address' => 'Bijraul, Baraut, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=P.S.%20Bijraul-3%20Bijraul%20Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Sahamal Inter College Bijraul', 'type' => 'Government Inter College', 'badge' => 'Government', 'classes' => 'Upper Primary to Senior Secondary (6-12)', 'udise' => '09080201604', 'medium' => 'Hindi', 'address' => 'Bijraul, Baraut, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Sahamal%20Inter%20College%20Bijraul%20Baraut%20Baghpat%20Uttar%20Pradesh', 'featured' => true],
        ['name' => 'Guru Kirpa Public School', 'type' => 'Private Unaided School', 'badge' => 'Private', 'classes' => 'Primary with Upper Primary (1-8)', 'udise' => '09080201605', 'medium' => 'Hindi / English', 'address' => 'Bijraul, Baraut, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Guru%20Kirpa%20Public%20School%20Bijraul%20Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Sarasvati Santi JHS', 'type' => 'Private Junior High School', 'badge' => 'Private', 'classes' => 'Primary with Upper Primary (1-8)', 'udise' => '09080201606', 'medium' => 'Hindi', 'address' => 'Bijraul, Baraut, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Sarasvati%20Santi%20JHS%20Bijraul%20Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Rejonense Public School Bijrol', 'type' => 'Co-Educational Private School', 'badge' => 'Private', 'classes' => 'Primary with Upper Primary (1-8)', 'udise' => '09080201607', 'medium' => 'Hindi / English', 'address' => 'Bijraul, Baraut, Baghpat, Uttar Pradesh 250617', 'map' => 'https://www.google.com/maps/search/?api=1&query=Rejonense%20Public%20School%20Bijrol%20Baghpat%20Barout%20Barka%20Bijraul%20Uttar%20Pradesh'],
    ];

    $libraries = [
        ['name' => 'Bijrol Public Library', 'type' => 'Public Library / Reading Room', 'badge' => 'Library', 'classes' => 'All Ages', 'medium' => 'Hindi', 'address' => 'Bijrol, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Bijrol%20Public%20Library%20Baghpat%20Uttar%20Pradesh', 'featured' => true, 'image' => 'l1.jpeg'],
        ['name' => 'Bijrol Public Library2', 'type' => 'Community Library / Digital Centre', 'badge' => 'Library', 'classes' => 'All Ages', 'medium' => 'Hindi / English', 'address' => 'Bijrol, Baghpat, Uttar Pradesh', 'map' => 'https://www.google.com/maps/search/?api=1&query=Bijrol%20Public%20Library2%20Baghpat%20Uttar%20Pradesh', 'image' => 'l2.jpeg'],
    ];
@endphp

@push('styles')
<style>
.edu-premium { --green:#064e30; --green2:#0f766e; --gold:#f59e0b; --gold2:#fde68a; --ink:#0f172a; --muted:#64748b; --line:rgba(15,23,42,.08); background:linear-gradient(180deg,#fff3d7 0%,#eef9ef 46%,#eaf2fb 100%); color:var(--ink); }
.edu-hero { position:relative; padding:110px 0 92px; color:#fff; background:linear-gradient(135deg,rgba(6,78,48,.5),rgba(15,118,110,.4)),url('{{ asset('image/main.jpg.jpg') }}') center/cover no-repeat; overflow:hidden; }
.edu-hero:after { content:""; position:absolute; inset:0; background:linear-gradient(90deg,rgba(3,31,20,.4),rgba(3,31,20,.15)),radial-gradient(circle at 78% 18%,rgba(245,158,11,.28),transparent 32%); }
.edu-hero .container { position:relative; z-index:2; }
.edu-kicker { display:inline-flex; align-items:center; gap:10px; color:var(--gold2); font-size:.78rem; font-weight:900; letter-spacing:.14em; text-transform:uppercase; margin-bottom:16px; }
.edu-kicker:before { content:""; width:34px; height:2px; background:currentColor; }
.edu-hero h1 { font-size:clamp(3rem,7vw,5.8rem); line-height:.95; font-weight:950; letter-spacing:0; margin:0 0 18px; text-shadow:0 24px 55px rgba(0,0,0,.32); }
.edu-hero p { max-width:760px; color:rgba(255,255,255,.9); line-height:1.85; font-size:1.12rem; margin:0; }
.edu-stats { margin-top:-42px; position:relative; z-index:4; }
.edu-stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:18px; }
.edu-stat,.edu-card { border-radius:8px; background:#fff; border:1px solid var(--line); box-shadow:0 18px 48px rgba(15,23,42,.08); }
.edu-stat { padding:24px 18px; text-align:center; }
.edu-stat strong { display:block; color:var(--green); font-size:2rem; line-height:1; margin-bottom:8px; }
.edu-stat span { color:var(--muted); font-weight:800; }
.edu-section { padding:86px 0; }
.edu-heading { max-width:780px; margin:0 auto 46px; text-align:center; }
.edu-heading span { color:var(--green2); font-size:.78rem; font-weight:900; letter-spacing:.14em; text-transform:uppercase; }
.edu-heading h2 { font-size:clamp(2rem,4vw,3.3rem); line-height:1.12; font-weight:950; letter-spacing:0; margin:10px 0 14px; }
.edu-heading p { color:var(--muted); line-height:1.8; margin:0; }
.edu-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:22px; }
.edu-card { padding:0; overflow:hidden; transition:.28s ease; }
.edu-card:hover { transform:translateY(-8px); box-shadow:0 28px 68px rgba(15,23,42,.14); border-color:rgba(245,158,11,.34); }
.edu-card-top { height:6px; background:linear-gradient(90deg,var(--green),var(--gold)); }
.edu-card-cover { height:180px; overflow:hidden; background:#e2e8f0; }
.edu-card-cover img { width:100%; height:100%; object-fit:cover; display:block; }
.edu-card-body { padding:28px; }
.edu-card-head { display:flex; justify-content:space-between; gap:16px; align-items:flex-start; margin-bottom:18px; }
.edu-card h3 { font-size:1.28rem; font-weight:950; letter-spacing:0; margin:0 0 8px; }
.edu-type { color:var(--green); font-weight:800; }
.edu-badge { display:inline-flex; padding:7px 12px; border-radius:8px; background:rgba(15,118,110,.1); color:var(--green2); font-size:.75rem; font-weight:900; text-transform:uppercase; }
.edu-card.featured .edu-badge { background:rgba(245,158,11,.14); color:#92400e; }
.edu-card--library .edu-card-top { background: linear-gradient(90deg, #7c3aed, #a855f7); }
.edu-card--library.featured .edu-badge { background:rgba(124,58,237,.12); color:#4c1d95; }
.edu-details { display:grid; grid-template-columns:repeat(2,1fr); gap:12px; margin:20px 0; }
.edu-detail { padding:14px; border-radius:8px; background:#f8fafc; border:1px solid var(--line); }
.edu-detail span { display:block; color:var(--muted); font-size:.72rem; font-weight:900; letter-spacing:.08em; text-transform:uppercase; margin-bottom:5px; }
.edu-detail strong { color:var(--ink); font-size:.92rem; }
.edu-actions { display:flex; flex-wrap:wrap; gap:10px; }
.edu-btn { flex:1; min-width:150px; display:inline-flex; align-items:center; justify-content:center; min-height:46px; padding:12px 16px; border-radius:8px; font-weight:900; text-decoration:none; transition:.25s ease; }
.edu-btn:hover { transform:translateY(-3px); }
.edu-btn-primary { background:var(--green); color:#fff; }
.edu-btn-light { background:#fff7ed; color:#92400e; border:1px solid rgba(245,158,11,.22); }

@media(max-width:992px){.edu-grid{grid-template-columns:1fr}.edu-stats-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:768px){.edu-hero{padding:82px 0 66px}.edu-section{padding:62px 0}.edu-stats{margin-top:0;padding-top:18px}.edu-stats-grid,.edu-details{grid-template-columns:1fr}.edu-card-body{padding:24px}.edu-map iframe{height:320px}}
</style>
@endpush

@section('content')
<div class="edu-premium">
    <section class="edu-hero">
        <div class="container">
            <span class="edu-kicker">Official Education Directory</span>
            <h1>Schools in Bijrol</h1>
            <p>A polished directory of educational institutions with class levels, UDISE codes, medium, address, and map access for students and families.</p>
        </div>
    </section>

    <section class="edu-stats">
        <div class="container edu-stats-grid">
            <div class="edu-stat"><strong>{{ count($schools) }}</strong><span>Total Schools</span></div>
            <div class="edu-stat"><strong>{{ count($libraries) }}</strong><span>Libraries</span></div>
            <div class="edu-stat"><strong>{{ collect($schools)->where('badge','Government')->count() }}</strong><span>Government</span></div>
            <div class="edu-stat"><strong>{{ collect($schools)->where('badge','Private')->count() }}</strong><span>Private</span></div>
        </div>
    </section>

    <main class="edu-section">
        <div class="container">
            <div class="edu-heading">
                <span>Education Access</span>
                <h2>Institutions supporting Bijrol's next generation.</h2>
                <p>Every card includes quick details and direct map links while preserving the original school directory data.</p>
            </div>

            <div class="edu-grid">
                @foreach ($schools as $school)
                    <article class="edu-card {{ isset($school['featured']) ? 'featured' : '' }}">
                        @if(isset($school['image']))
                            <div class="edu-card-cover">
                                <img src="{{ asset('image/' . $school['image']) }}" alt="{{ $school['name'] }}">
                            </div>
                        @else
                            <div class="edu-card-top"></div>
                        @endif
                        <div class="edu-card-body">
                            <div class="edu-card-head">
                                <div>
                                    <h3>{{ $school['name'] }}</h3>
                                    <div class="edu-type">{{ $school['type'] }}</div>
                                </div>
                                <span class="edu-badge">{{ isset($school['featured']) ? 'Featured' : $school['badge'] }}</span>
                            </div>
                            <div class="edu-details">
                                <div class="edu-detail"><span>Classes</span><strong>{{ $school['classes'] }}</strong></div>
                                <div class="edu-detail"><span>UDISE</span><strong>{{ $school['udise'] }}</strong></div>
                                <div class="edu-detail"><span>Medium</span><strong>{{ $school['medium'] }}</strong></div>
                                <div class="edu-detail"><span>Address</span><strong>{{ $school['address'] }}</strong></div>
                            </div>
                            <div class="edu-actions">
                                @if(!isset($school['pending']))
                                    <a class="edu-btn edu-btn-primary" href="{{ $school['map'] }}" target="_blank" rel="noopener">View Location</a>
                                    <a class="edu-btn edu-btn-light" href="https://www.udiseplus.gov.in/" target="_blank" rel="noopener">UDISE Verify</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="edu-heading" style="margin-top:60px">
                <span>Libraries &amp; Reading</span>
                <h2>Reading spaces and knowledge centres in Bijrol.</h2>
                <p>Curated places for study, reflection, and community learning across the village.</p>
            </div>

            <div class="edu-grid">
                @foreach ($libraries as $lib)
                    <article class="edu-card edu-card--library {{ isset($lib['featured']) ? 'featured' : '' }}">
                        <div class="edu-card-cover">
                            <img src="{{ asset('image/' . $lib['image']) }}" alt="{{ $lib['name'] }}">
                        </div>
                        <div class="edu-card-body">
                            <div class="edu-card-head">
                                <div>
                                    <h3>{{ $lib['name'] }}</h3>
                                    <div class="edu-type">{{ $lib['type'] }}</div>
                                </div>
                                <span class="edu-badge">{{ $lib['badge'] }}</span>
                            </div>
                            <div class="edu-details">
                                <div class="edu-detail"><span>Classes</span><strong>{{ $lib['classes'] }}</strong></div>
                                <div class="edu-detail"><span>Medium</span><strong>{{ $lib['medium'] }}</strong></div>
                                <div class="edu-detail"><span>Address</span><strong>{{ $lib['address'] }}</strong></div>
                            </div>
                            <div class="edu-actions">
                                <a class="edu-btn edu-btn-primary" href="{{ $lib['map'] }}" target="_blank" rel="noopener">View Location</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </main>
</div>
@endsection
