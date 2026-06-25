@extends('layouts.app')

@section('title', 'Information | BIJROL Village')

@php
    $localImage = fn ($file) => asset('image/' . $file);

    $stats = [
        ['value' => '11,742', 'label' => 'Population', 'tone' => 'gold'],
        ['value' => '1,809', 'label' => 'Households', 'tone' => 'green'],
        ['value' => '63.75%', 'label' => 'Literacy Rate', 'tone' => 'blue'],
        ['value' => '250620', 'label' => 'PIN Code', 'tone' => 'rose'],
    ];

    $quickFacts = [
        ['label' => 'Gram Panchayat', 'value' => 'Bijrol'],
        ['label' => 'Block', 'value' => 'Baraut'],
        ['label' => 'Tehsil', 'value' => 'Baraut'],
        ['label' => 'District', 'value' => 'Baghpat'],
        ['label' => 'State', 'value' => 'Uttar Pradesh'],
        ['label' => 'Census Code 2011', 'value' => '119306'],
        ['label' => 'Assembly', 'value' => 'Baraut'],
        ['label' => 'Parliament', 'value' => 'Baghpat'],
    ];

    $informationBlocks = [
        [
            'eyebrow' => 'Identity',
            'title' => 'A Gram Panchayat in the Baraut region.',
            'text' => 'Bijrol is listed as a Gram Panchayat in Baraut Block and Baraut Tehsil of Baghpat district, Uttar Pradesh. The village is part of the Baraut Assembly Constituency and Baghpat Parliamentary Constituency.',
        ],
        [
            'eyebrow' => 'Landscape',
            'title' => 'Fields, homes, public places, and rural movement.',
            'text' => 'The village sits in western Uttar Pradesh near Baraut, with local roads, nearby villages, schools, and panchayat facilities supporting daily life. Agriculture remains a central part of the local economy and village rhythm.',
        ],
        [
            'eyebrow' => 'Legacy',
            'title' => 'Bijrol carries the memory of Raja Shahmal Tomar.',
            'text' => 'Bijrol is strongly associated with Sah Mal, also remembered as Raja Shahmal Singh Tomar, a local leader connected with the 1857 resistance in the Baghpat-Baraut region.',
        ],
    ];

    $governance = [
        ['role' => 'Sarpanch', 'name' => 'Harender Singh', 'phone' => '9412631970', 'email' => 'HARENDERTOMAR3@GMAIL.COM'],
        ['role' => 'Secretary', 'name' => 'Pawan Singh Rana', 'phone' => '9997235137', 'email' => 'PAWANRANAG@GMAIL.COM'],
    ];

    $facilities = [
        ['title' => 'Panchayat Bhawan', 'text' => 'Available for village-level civic and administrative work.'],
        ['title' => 'Panchayat Library', 'text' => 'Listed as available for learning and community reference.'],
        ['title' => 'Computer Lab', 'text' => 'Digital access facility listed for the Gram Panchayat.'],
        ['title' => 'Nearest Bus Stop', 'text' => 'Bijrol is listed as the nearest bus stop for local movement.'],
    ];

    $roadLinks = [
        [
            'name' => 'NH-709B / Delhi-Saharanpur-Dehradun Corridor',
            'type' => 'National Highway / Expressway Corridor',
            'text' => 'The most important regional corridor near Baraut-Baghpat. It links Delhi, Baghpat, Baraut, Shamli, Saharanpur, and Dehradun.',
            'meta' => 'Useful for Delhi, Baraut, Shamli, Saharanpur, Dehradun',
            'map' => 'https://www.google.com/maps/search/?api=1&query=NH%20709B%20Baraut%20Baghpat',
            'image' => $localImage('road-corridor-nh709b.png'),
        ],
        [
            'name' => 'Delhi-Dehradun Expressway',
            'type' => 'Access-Controlled Expressway',
            'text' => 'A major Delhi to Dehradun high-speed corridor passing through the Baghpat-Baraut belt, designed to improve long-distance travel toward Delhi and Uttarakhand.',
            'meta' => 'Regional access via Baghpat/Baraut side',
            'map' => 'https://www.google.com/maps/search/?api=1&query=Delhi%20Dehradun%20Expressway%20Baraut%20Baghpat',
            'image' => $localImage('road-expressway-delhi-dehradun.png'),
        ],
        [
            'name' => 'Eastern Peripheral Expressway',
            'type' => 'National Expressway 2',
            'text' => 'The Kundli-Ghaziabad-Palwal expressway passes through Baghpat district and gives onward NCR connectivity toward Ghaziabad, Noida, Faridabad, and Palwal.',
            'meta' => 'Useful for NCR ring-road movement',
            'map' => 'https://www.google.com/maps/search/?api=1&query=Eastern%20Peripheral%20Expressway%20Baghpat',
            'image' => $localImage('road-epe.png'),
        ],
        [
            'name' => 'State Highway 57',
            'type' => 'Uttar Pradesh State Highway',
            'text' => 'A Delhi-Saharanpur state highway route serving the western Uttar Pradesh belt including Baghpat and Muzaffarnagar region connectivity.',
            'meta' => 'Useful for district and regional road travel',
            'map' => 'https://www.google.com/maps/search/?api=1&query=State%20Highway%2057%20Baghpat%20Baraut',
            'image' => $localImage('road-sh57.png'),
        ],
    ];

    $routeHighlights = [
        ['label' => 'Nearest town access', 'value' => 'Baraut side'],
        ['label' => 'Major NCR link', 'value' => 'Eastern Peripheral Expressway'],
        ['label' => 'Delhi-Dehradun route', 'value' => 'NH-709B corridor'],
        ['label' => 'Regional state route', 'value' => 'SH-57'],
    ];

    $nearbyVillages = [
        ['name' => 'Baraut', 'distance' => '6.0 km', 'direction' => 'South-East', 'x' => 60, 'y' => 94, 'map' => 'https://www.google.com/maps/search/?api=1&query=Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Jalalpur', 'distance' => '1.5 km', 'direction' => 'West', 'x' => 13, 'y' => 52, 'map' => 'https://www.google.com/maps/search/?api=1&query=Jalalpur%20Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Asafpur Kharkhari', 'distance' => '2.1 km', 'direction' => 'West', 'x' => 8, 'y' => 48, 'map' => 'https://www.google.com/maps/search/?api=1&query=Asafpur%20Kharkhari%20Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Vazidpur', 'distance' => '2.9 km', 'direction' => 'South', 'x' => 39, 'y' => 86, 'map' => 'https://www.google.com/maps/search/?api=1&query=Vazidpur%20Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Angadpur', 'distance' => '2.9 km', 'direction' => 'South-East', 'x' => 73, 'y' => 79, 'map' => 'https://www.google.com/maps/search/?api=1&query=Angadpur%20Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Lohadda', 'distance' => '3.0 km', 'direction' => 'South-West', 'x' => 25, 'y' => 78, 'map' => 'https://www.google.com/maps/search/?api=1&query=Lohadda%20Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Johri', 'distance' => '3.3 km', 'direction' => 'South-East', 'x' => 80, 'y' => 76, 'map' => 'https://www.google.com/maps/search/?api=1&query=Johri%20Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Sirsali', 'distance' => '3.3 km', 'direction' => 'East', 'x' => 90, 'y' => 54, 'map' => 'https://www.google.com/maps/search/?api=1&query=Sirsali%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Goonga Kheri', 'distance' => '3.4 km', 'direction' => 'North-West', 'x' => 24, 'y' => 20, 'map' => 'https://www.google.com/maps/search/?api=1&query=Goonga%20Kheri%20Baraut%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Bamnauli', 'distance' => '3.9 km', 'direction' => 'North-East', 'x' => 70, 'y' => 14, 'map' => 'https://www.google.com/maps/search/?api=1&query=Bamnauli%20Baghpat%20Uttar%20Pradesh'],
        ['name' => 'Mukarrabpur Kandera', 'distance' => '4.0 km', 'direction' => 'North', 'x' => 56, 'y' => 7, 'map' => 'https://www.google.com/maps/search/?api=1&query=Mukarrabpur%20Kandera%20Baraut%20Baghpat%20Uttar%20Pradesh'],
    ];

    $sourceCards = [
        ['label' => 'VillageGram', 'text' => 'Population, PIN, panchayat, schools, facilities, nearby villages.'],
        ['label' => 'Census 2011', 'text' => 'Population-style figures and census village code reference.'],
        ['label' => 'Public district/wiki records', 'text' => 'Baghpat, Baraut, location, region, and heritage context.'],
    ];
@endphp

@push('styles')
<style>
    .info-page {
        --ink: #101b18;
        --muted: #64736d;
        --soft: #f6f3eb;
        --paper: #fffdf7;
        --line: rgba(16, 27, 24, .1);
        --green: #17623f;
        --deep: #0d3325;
        --gold: #c8902f;
        --blue: #315d8f;
        --rose: #b24d68;
        --shadow: 0 24px 70px rgba(16, 27, 24, .11);
        background: linear-gradient(180deg, #fbfaf4 0%, #f4f8f1 42%, #fffdf7 100%);
        color: var(--ink);
        font-family: "Poppins", sans-serif;
        overflow: hidden;
    }

    .info-page * { box-sizing: border-box; }

    .info-shell {
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
    }

    .info-hero {
        position: relative;
        min-height: 520px;
        display: flex;
        align-items: flex-end;
        padding: 118px 0 46px;
        color: #fff;
        background:
            linear-gradient(90deg, rgba(5, 23, 17, .9), rgba(5, 23, 17, .58), rgba(5, 23, 17, .18)),
            linear-gradient(180deg, rgba(5, 23, 17, .16), rgba(5, 23, 17, .72)),
            url('{{ $localImage('bijrol.jpg.png') }}') center/cover no-repeat;
        isolation: isolate;
    }

    .info-hero::after {
        content: "";
        position: absolute;
        inset: auto 0 0;
        height: 130px;
        z-index: -1;
        background: linear-gradient(0deg, #fbfaf4, transparent);
    }

    .info-hero-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 28px;
        align-items: end;
    }

    .info-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f8d88d;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .info-kicker::before {
        content: "";
        width: 34px;
        height: 2px;
        border-radius: 999px;
        background: currentColor;
    }

    .info-hero h1 {
        max-width: 820px;
        margin: 12px 0 16px;
        font-size: clamp(48px, 8vw, 94px);
        line-height: .94;
        font-weight: 950;
        letter-spacing: 0;
        text-wrap: balance;
    }

    .info-hero p {
        max-width: 760px;
        margin: 0;
        color: rgba(255,255,255,.88);
        font-size: 17px;
        line-height: 1.8;
    }

    .info-location-card,
    .info-card,
    .info-stat,
    .info-contact,
    .info-source,
    .info-map-card,
    .info-map-card {
        border: 1px solid var(--line);
        border-radius: 8px;
        background: rgba(255,255,255,.82);
        box-shadow: var(--shadow);
        backdrop-filter: blur(18px);
    }

    .info-location-card {
        padding: 18px;
        color: var(--ink);
    }

    .info-location-card img {
        width: 100%;
        aspect-ratio: 1.55;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 14px;
    }

    .info-location-card strong {
        display: block;
        color: var(--deep);
        font-size: 20px;
        font-weight: 950;
    }

    .info-location-card span {
        display: block;
        margin-top: 6px;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .info-stats {
        position: relative;
        z-index: 2;
        margin-top: -32px;
    }

    .info-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .info-stat {
        min-height: 116px;
        padding: 20px;
    }

    .info-stat strong {
        display: block;
        color: var(--deep);
        font-size: clamp(28px, 4vw, 42px);
        line-height: 1;
        font-weight: 950;
    }

    .info-stat span {
        display: inline-flex;
        margin-top: 10px;
        color: var(--muted);
        font-size: 13px;
        font-weight: 850;
    }

    .info-section {
        padding: 72px 0;
    }

    .info-section.tight {
        padding-top: 34px;
    }

    .info-heading {
        display: grid;
        grid-template-columns: minmax(0, .58fr) minmax(0, .42fr);
        gap: 28px;
        align-items: end;
        margin-bottom: 26px;
    }

    .info-heading h2 {
        margin: 8px 0 0;
        color: var(--deep);
        font-size: clamp(34px, 5vw, 58px);
        line-height: 1.04;
        font-weight: 950;
        letter-spacing: 0;
        text-wrap: balance;
    }

    .info-heading p,
    .info-card p,
    .info-source p {
        color: var(--muted);
        line-height: 1.75;
        margin: 0;
    }

    .info-profile-grid {
        display: grid;
        grid-template-columns: minmax(0, .96fr) minmax(320px, .44fr);
        gap: 18px;
        align-items: start;
    }

    .info-card {
        padding: 26px;
        background: #fff;
    }

    .info-blocks {
        display: grid;
        gap: 12px;
    }

    .info-block {
        display: grid;
        grid-template-columns: 110px minmax(0, 1fr);
        gap: 16px;
        padding: 18px;
        border: 1px solid var(--line);
        border-radius: 8px;
        background: linear-gradient(135deg, #fff, #f8fbf6);
    }

    .info-block small {
        color: var(--gold);
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
    }

    .info-block h3 {
        margin: 0 0 6px;
        color: var(--deep);
        font-size: 20px;
        font-weight: 950;
    }

    .info-fact-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .info-fact {
        padding: 14px;
        border: 1px solid var(--line);
        border-radius: 8px;
        background: #fffdf8;
    }

    .info-fact span {
        display: block;
        color: var(--muted);
        font-size: 12px;
        font-weight: 800;
    }

    .info-fact strong {
        display: block;
        margin-top: 5px;
        color: var(--deep);
        font-size: 16px;
        font-weight: 950;
    }

    .info-contact-grid,
    .info-facility-grid,
    .info-road-grid,
    .info-source-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .info-contact {
        padding: 20px;
        background: linear-gradient(135deg, rgba(13, 51, 37, .96), rgba(23, 98, 63, .91));
        color: #fff;
        box-shadow: 0 20px 54px rgba(13, 51, 37, .16);
    }

    .info-contact span {
        color: #f8d88d;
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
    }

    .info-contact strong {
        display: block;
        margin-top: 8px;
        font-size: 22px;
        font-weight: 950;
    }

    .info-contact a {
        display: inline-flex;
        margin: 10px 10px 0 0;
        color: rgba(255,255,255,.9);
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
    }

    .info-facility-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    .info-facility {
        padding: 20px;
        border: 1px solid var(--line);
        border-radius: 8px;
        background: #fff;
    }

    .info-facility strong {
        display: block;
        color: var(--deep);
        font-size: 17px;
        font-weight: 950;
        margin-bottom: 6px;
    }

    .info-facility p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.65;
        margin: 0;
    }

    .info-road-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .info-road-card {
        position: relative;
        min-height: 210px;
        padding: 24px;
        overflow: hidden;
        border: 1px solid var(--line);
        border-radius: 8px;
        background:
            linear-gradient(145deg, rgba(8, 27, 20, .86), rgba(8, 27, 20, .52)),
            var(--road-image) center/cover no-repeat;
        box-shadow: 0 16px 44px rgba(16, 27, 24, .08);
        color: #fff;
        isolation: isolate;
    }

    .info-road-card::after {
        content: "";
        position: absolute;
        inset: 0;
        z-index: -1;
        background:
            radial-gradient(circle at 86% 18%, rgba(248, 216, 141, .28), transparent 34%),
            linear-gradient(0deg, rgba(8, 27, 20, .72), transparent 54%);
        transition: opacity .25s ease;
    }

    .info-road-card:hover::after {
        opacity: .84;
    }

    .info-road-card small {
        display: inline-flex;
        position: relative;
        z-index: 1;
        margin-bottom: 12px;
        color: var(--gold);
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .info-road-card h3 {
        position: relative;
        z-index: 1;
        margin: 0 0 10px;
        color: #fff;
        font-size: 22px;
        line-height: 1.2;
        font-weight: 950;
    }

    .info-road-card p {
        position: relative;
        z-index: 1;
        margin: 0;
        color: rgba(255,255,255,.82);
        font-size: 14px;
        line-height: 1.75;
    }

    .info-road-card a {
        position: relative;
        z-index: 1;
        display: inline-flex;
        margin-top: 14px;
        color: #f8d88d;
        font-size: 13px;
        font-weight: 900;
        text-decoration: none;
    }

    .info-route-strip {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .info-route-chip {
        padding: 14px;
        border: 1px solid var(--line);
        border-radius: 8px;
        background: #fff;
    }

    .info-route-chip span {
        display: block;
        color: var(--muted);
        font-size: 11px;
        font-weight: 850;
        text-transform: uppercase;
    }

    .info-route-chip strong {
        display: block;
        margin-top: 5px;
        color: var(--deep);
        font-size: 14px;
        line-height: 1.35;
        font-weight: 950;
    }

    .info-nearby-grid {
        display: grid;
        grid-template-columns: minmax(320px, .46fr) minmax(0, .54fr);
        gap: 18px;
        align-items: start;
    }

    .info-map-card {
        padding: 18px;
        background: #fff;
    }

    .info-radar {
        position: relative;
        width: 100%;
        aspect-ratio: 1;
        border-radius: 50%;
        overflow: hidden;
        background:
            radial-gradient(circle at 50% 50%, rgba(23, 98, 63, .12) 0 7%, transparent 8%),
            radial-gradient(circle at 50% 50%, transparent 0 32%, rgba(23, 98, 63, .08) 33% 34%, transparent 35%),
            radial-gradient(circle at 50% 50%, transparent 0 64%, rgba(23, 98, 63, .08) 65% 66%, transparent 67%),
            linear-gradient(90deg, transparent 49.7%, rgba(16, 27, 24, .1) 50%, transparent 50.3%),
            linear-gradient(0deg, transparent 49.7%, rgba(16, 27, 24, .1) 50%, transparent 50.3%),
            #f7faf5;
        border: 1px solid var(--line);
    }

    .info-radar-center {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: var(--green);
        box-shadow: 0 0 0 8px rgba(23, 98, 63, .14);
        z-index: 2;
    }

    .info-radar-label {
        position: absolute;
        transform: translate(-50%, -50%);
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: var(--gold);
        box-shadow: 0 0 0 3px #fff;
        text-decoration: none;
        transition: transform .2s ease, background .2s ease;
    }

    .info-radar-label:hover {
        transform: translate(-50%, -50%) scale(1.35);
        background: var(--green);
    }

    .info-radar-label span {
        position: absolute;
        left: 12px;
        top: -8px;
        width: max-content;
        max-width: 120px;
        padding: 3px 5px;
        border-radius: 6px;
        background: rgba(255,255,255,.88);
        color: var(--deep);
        font-size: 10px;
        font-weight: 850;
        line-height: 1.2;
    }

    .info-radar-nsew {
        position: absolute;
        color: #8b9892;
        font-size: 11px;
        font-weight: 900;
    }

    .info-radar-nsew.n { top: 8px; left: 50%; transform: translateX(-50%); }
    .info-radar-nsew.s { bottom: 8px; left: 50%; transform: translateX(-50%); }
    .info-radar-nsew.e { right: 10px; top: 50%; transform: translateY(-50%); }
    .info-radar-nsew.w { left: 10px; top: 50%; transform: translateY(-50%); }

    .info-nearby-list {
        display: grid;
        gap: 9px;
    }

    .info-nearby-row {
        display: grid;
        grid-template-columns: 34px minmax(0, 1fr) auto;
        gap: 12px;
        align-items: center;
        padding: 13px 14px;
        border: 1px solid var(--line);
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 12px 30px rgba(16, 27, 24, .06);
    }

    .info-nearby-row em {
        width: 34px;
        height: 34px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: #f2ead8;
        color: var(--deep);
        font-style: normal;
        font-size: 12px;
        font-weight: 950;
    }

    .info-nearby-row strong {
        display: block;
        color: var(--deep);
        font-size: 15px;
        font-weight: 950;
    }

    .info-nearby-row a {
        text-decoration: none;
    }

    .info-nearby-row a:hover strong {
        color: var(--green);
    }

    .info-nearby-row span {
        color: var(--muted);
        font-size: 12px;
        font-weight: 800;
    }

    .info-source-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .info-source {
        padding: 20px;
        background: #fff;
        box-shadow: 0 12px 34px rgba(16, 27, 24, .06);
    }

    .info-source strong {
        display: block;
        color: var(--deep);
        font-size: 18px;
        font-weight: 950;
        margin-bottom: 6px;
    }

    .info-note {
        margin-top: 18px;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.75;
        text-align: center;
    }

    .info-note a {
        color: var(--green);
        font-weight: 850;
    }

    @media (max-width: 992px) {
        .info-hero-grid,
        .info-heading,
        .info-profile-grid,
        .info-nearby-grid {
            grid-template-columns: 1fr;
        }

        .info-location-card {
            display: none;
        }

        .info-stats-grid,
        .info-facility-grid,
        .info-road-grid,
        .info-route-strip,
        .info-source-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .info-shell {
            width: min(100% - 20px, 1180px);
        }

        .info-hero {
            min-height: auto;
            padding: 88px 0 54px;
        }

        .info-section {
            padding: 54px 0;
        }

        .info-stats {
            margin-top: 0;
            padding-top: 14px;
        }

        .info-stats-grid,
        .info-fact-list,
        .info-contact-grid,
        .info-facility-grid,
        .info-road-grid,
        .info-route-strip,
        .info-source-grid {
            grid-template-columns: 1fr;
        }

        .info-block,
        .info-nearby-row {
            grid-template-columns: 1fr;
        }

        .info-radar-label span {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<main class="info-page">
    <section class="info-hero" id="information">
        <div class="info-shell info-hero-grid">
            <div>
                <span class="info-kicker">Information Profile</span>
                <h1>Bijrol Village, Baraut Baghpat.</h1>
                <p>Detailed village information covering governance, population profile, schools, facilities, heritage, public identity, and nearby villages around Bijrol.</p>
            </div>
            <aside class="info-location-card">
                <img src="{{ $localImage('vil.jpg.png') }}" alt="Bijrol village view">
                <strong>Gram Panchayat Bijrol</strong>
                <span>Baraut Block and Tehsil, Baghpat district, Uttar Pradesh. Census village code 119306, PIN code 250620.</span>
            </aside>
        </div>
    </section>

    <section class="info-stats">
        <div class="info-shell info-stats-grid">
            @foreach($stats as $stat)
                <article class="info-stat">
                    <strong>{{ $stat['value'] }}</strong>
                    <span>{{ $stat['label'] }}</span>
                </article>
            @endforeach
        </div>
    </section>

    <section class="info-section tight">
        <div class="info-shell info-profile-grid">
            <div class="info-card">
                <div class="info-heading" style="grid-template-columns:1fr; margin-bottom:18px;">
                    <div>
                        <span class="info-kicker" style="color:var(--green)">About Bijrol</span>
                        <h2>Complete village information in one place.</h2>
                    </div>
                    <p>Bijrol is a historic and agriculture-led village in western Uttar Pradesh. It is known locally for Raja Shahmal Tomar's legacy, its Gram Panchayat identity, schools, panchayat facilities, and strong links with the Baraut-Baghpat region.</p>
                </div>

                <div class="info-blocks">
                    @foreach($informationBlocks as $block)
                        <article class="info-block">
                            <small>{{ $block['eyebrow'] }}</small>
                            <div>
                                <h3>{{ $block['title'] }}</h3>
                                <p>{{ $block['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <aside class="info-card">
                <span class="info-kicker" style="color:var(--green)">Quick Facts</span>
                <div class="info-fact-list" style="margin-top:16px;">
                    @foreach($quickFacts as $fact)
                        <div class="info-fact">
                            <span>{{ $fact['label'] }}</span>
                            <strong>{{ $fact['value'] }}</strong>
                        </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>

    <section class="info-section" style="background:rgba(255,255,255,.52);">
        <div class="info-shell">
            <div class="info-heading">
                <div>
                    <span class="info-kicker" style="color:var(--green)">Governance</span>
                    <h2>Panchayat contacts and public facilities.</h2>
                </div>
                <p>These details are shown compactly for residents and visitors who need basic village-level contact and facility information.</p>
            </div>

            <div class="info-contact-grid">
                @foreach($governance as $person)
                    <article class="info-contact">
                        <span>{{ $person['role'] }}</span>
                        <strong>{{ $person['name'] }}</strong>
                        <a href="tel:+91{{ $person['phone'] }}">+91 {{ $person['phone'] }}</a>
                        <a href="mailto:{{ strtolower($person['email']) }}">{{ strtolower($person['email']) }}</a>
                    </article>
                @endforeach
            </div>

            <div class="info-facility-grid" style="margin-top:16px;">
                @foreach($facilities as $facility)
                    <article class="info-facility">
                        <strong>{{ $facility['title'] }}</strong>
                        <p>{{ $facility['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="info-section" style="background:linear-gradient(180deg,#f7faf5,#fffdf7);">
        <div class="info-shell">
            <div class="info-heading">
                <div>
                    <span class="info-kicker" style="color:var(--green)">Road Connectivity</span>
                    <h2>Highways and expressways near Bijrol.</h2>
                </div>
                <p>Bijrol benefits from Baraut-Baghpat road access and nearby regional corridors that connect the village side toward Delhi, NCR, Shamli, Saharanpur, and Dehradun.</p>
            </div>

            <div class="info-road-grid">
                @foreach($roadLinks as $road)
                    <article class="info-road-card" style="--road-image:url('{{ $road['image'] }}');">
                        <small>{{ $road['type'] }}</small>
                        <h3>{{ $road['name'] }}</h3>
                        <p>{{ $road['text'] }}</p>
                        <a href="{{ $road['map'] }}" target="_blank" rel="noopener">{{ $road['meta'] }}</a>
                    </article>
                @endforeach
            </div>

            <div class="info-route-strip">
                @foreach($routeHighlights as $item)
                    <div class="info-route-chip">
                        <span>{{ $item['label'] }}</span>
                        <strong>{{ $item['value'] }}</strong>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="info-section" style="background:linear-gradient(180deg,#fffdf7,#f7faf5);">
        <div class="info-shell">
            <div class="info-heading">
                <div>
                    <span class="info-kicker" style="color:var(--green)">Nearby Villages</span>
                    <h2>Villages around Bijrol.</h2>
                </div>
                <p>A compact nearby-village layout inspired by the reference screenshot, with direction and approximate road/air distance context from the VillageGram listing.</p>
            </div>

            <div class="info-nearby-grid">
                <aside class="info-map-card">
                    <div class="info-radar" aria-label="Nearby villages radial map">
                        <span class="info-radar-nsew n">N</span>
                        <span class="info-radar-nsew s">S</span>
                        <span class="info-radar-nsew e">E</span>
                        <span class="info-radar-nsew w">W</span>
                        <span class="info-radar-center" title="Bijrol"></span>
                        @foreach($nearbyVillages as $village)
                            <a class="info-radar-label" href="{{ $village['map'] }}" target="_blank" rel="noopener" style="left:{{ $village['x'] }}%; top:{{ $village['y'] }}%;" title="{{ $village['name'] }} - {{ $village['distance'] }} {{ $village['direction'] }}">
                                <span>{{ $village['name'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </aside>

                <div class="info-nearby-list">
                    @foreach($nearbyVillages as $index => $village)
                        <article class="info-nearby-row">
                            <em>{{ $index + 1 }}</em>
                            <div>
                                <a href="{{ $village['map'] }}" target="_blank" rel="noopener" aria-label="Open {{ $village['name'] }} on Google Maps">
                                    <strong>{{ $village['name'] }}</strong>
                                </a>
                                <span>{{ $village['direction'] }}</span>
                            </div>
                            <a href="{{ $village['map'] }}" target="_blank" rel="noopener">{{ $village['distance'] }}</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="info-section">
        <div class="info-shell">
            <div class="info-heading">
                <div>
                    <span class="info-kicker" style="color:var(--green)">Reference Notes</span>
                    <h2>Where this information comes from.</h2>
                </div>
                <p>The page uses public village profile data and existing site records. Administrative and population figures should be rechecked whenever official government/census records are updated.</p>
            </div>

            <div class="info-source-grid">
                @foreach($sourceCards as $source)
                    <article class="info-source">
                        <strong>{{ $source['label'] }}</strong>
                        <p>{{ $source['text'] }}</p>
                    </article>
                @endforeach
            </div>

        </div>
    </section>
</main>
@endsection
