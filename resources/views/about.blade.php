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
        [
            'eyebrow' => 'Culture',
            'title' => 'A village known for unity, farming, learning, and talent.',
            'text' => 'Bijrol is a historically and culturally important village in Uttar Pradesh. It is known for its rich agriculture, social unity, education, sports talent, and rural culture. Over the years, people from Bijrol have made notable contributions in education, the armed forces, agriculture, government services, and social work.',
        ],
        [
            'eyebrow' => 'Community',
            'title' => 'A living blend of tradition, history, and modern development.',
            'text' => 'Bijrol is not just a village, but a beautiful meeting point of tradition, history, and modern development. Along with modern facilities, Indian rural culture can still be seen here in a living and vibrant form. The village identity is shaped by agriculture, hardworking farmers, social harmony, religious faith, and community cooperation.',
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

    $heritageHighlights = [
        ['label' => '1857', 'text' => 'A defining year in the awakening against foreign rule.'],
        ['label' => 'People-Led', 'text' => 'Farmers, villagers, rural youth, and local society became part of a wider resistance.'],
        ['label' => 'Leadership', 'text' => 'Baba Shahmal Singh Tomar is remembered for courage, organization, and public trust.'],
        ['label' => 'Legacy', 'text' => 'His sacrifice remains a source of pride and inspiration for Bijrol and Baghpat.'],
    ];

    $heritageParagraphs = [
        'The year 1857 is remembered in Indian history as the beginning of an era that gave a new direction to the national consciousness against foreign rule. Although the first spark of this struggle rose from the military cantonment of Meerut, it soon moved beyond the limits of a military rebellion and became a broad people-led movement of farmers, villagers, landholders, and ordinary citizens. In western Uttar Pradesh, one of the most influential leaders of this mass movement was Baba Shahmal Singh Tomar. He understood that British rule could not be challenged by soldiers alone; the farmers and common people living in every village also needed to be organized.',
        'At that time, the policies of the British East India Company had deeply affected rural life. Heavy revenue demands on farmers, administrative harshness, and economic exploitation were increasing public anger. Shahmal Singh tried to transform this dissatisfaction not into random violence, but into the strength of organized resistance. He reached out to people from many nearby villages and gave them the confidence that if society stood united against injustice, foreign rule could be challenged.',
        'After the uprising in Meerut, British administrative control began to weaken in many areas of western Uttar Pradesh. In this situation, Baba Shahmal Singh organized rural communities and took charge of local resistance. Under his leadership, farmers and rural youth played an active role against British rule. This was not only a struggle of weapons, but also a struggle for self-respect, freedom, and the protection of local society.',
        'According to historical accounts, many rural areas challenged the influence of British administration under Shahmal Singh leadership. The purpose of his movement was to create confidence among the people that foreign rule was not invincible. The wide support of rural society became the greatest strength of his leadership. People saw him not only as a warrior, but as a people leader who protected their rights and dignity.',
        'A major quality of Baba Shahmal Singh was his ability to organize people. He united people from different villages around a shared purpose. At a time when modern communication and transport facilities were not available, he still built a local network of public contact that seriously challenged the British administration. His leadership shows that public trust is the greatest strength of any struggle.',
        'Although the British authorities used harsh military action to suppress the uprising, the struggle of Shahmal Singh and his companions holds an enduring place in the history of the Indian freedom movement. Ultimately, he made the supreme sacrifice for the country and society. His martyrdom strengthened the spirit of freedom that later gave new inspiration to the Indian national movement.',
        'Today, Baba Shahmal Singh is remembered not only as a revolutionary of 1857, but also as a symbol of farmer unity, public leadership, courage, and patriotism. For the people of Bijrol village and the Baghpat region, he remains a source of pride, respect, and inspiration. His legacy teaches that freedom does not live only on the battlefield; it also lives in social unity, justice, and the defense of self-respect.',
        'In independent India, the contribution of Baba Shahmal Singh continues to be a subject of new research. Historians, researchers, and local society are working to carry his life and struggle to the next generation. Programs, memorials, and historical studies held in his honor show that his sacrifice is becoming even more meaningful with time. The soil of Bijrol still preserves the memories of the great revolutionary who inspired the people of his region to unite for freedom and dignity.',
    ];

    $originHighlights = [
        ['label' => 'Doab Soil', 'text' => 'Fertile Ganga-Yamuna plains shaped Bijrol agriculture and rural life.'],
        ['label' => 'Community Life', 'text' => 'Chaupals, panchayat discussions, festivals, and harvests strengthened social unity.'],
        ['label' => 'Early Leadership', 'text' => 'Baba Shahmal Singh grew within a culture of courage, justice, and public trust.'],
        ['label' => '1857 Context', 'text' => 'Existing rural discontent and unity prepared the region for organized resistance.'],
    ];

    $originParagraphs = [
        'Bijrol village, located in the fertile Ganga-Yamuna Doab of western Uttar Pradesh, is not merely an ordinary rural settlement. It is a living heritage of history, tradition, and self-respect. This village of Baghpat district has carried forward a rich tradition of agriculture, social organization, and national consciousness for generations. It was on this sacred soil that Baba Shahmal Singh was born, a freedom fighter whose name remains immortal in Indian history.',
        'The fertile soil of the Ganga-Yamuna Doab supported prosperous agriculture from ancient times. Wheat, barley, millet, sugarcane, and other crops became part of the identity of this region. Agriculture was not only a means of livelihood; it was also the foundation of social life. Almost every family in the village was connected in some way with farming, animal husbandry, or related work. Fields, ponds, wells, bullock carts, chaupals, and the panchayat formed the soul of rural life.',
        'Community life in Bijrol was deeply rooted and powerful. People shared one another joys and hardships. Weddings, festivals, religious gatherings, harvest work, and social decisions were carried out through collective cooperation. The chaupal was not only a meeting place; it was where important village decisions were made and social concerns were discussed. This way of life strengthened mutual trust and unity among the people.',
        'During the eighteenth and nineteenth centuries, this region witnessed many political changes. With the decline of Mughal authority and the expanding influence of the British East India Company, rural society began to face new challenges. Revenue pressure on farmers increased, administrative control became harsher, and outside interference began to affect traditional systems. These conditions created a feeling of dissatisfaction across villages.',
        'It was in this historical environment that the personality of Baba Shahmal Singh developed. Although detailed contemporary records of his childhood are limited, it is clear that his life grew among rural surroundings, agricultural culture, and community values. He saw the hardships of farmers, land-related problems, and the growing influence of foreign rule from close quarters. These experiences later became the foundation of his leadership.',
        'In rural society, respect was earned not merely through position or wealth, but through character, courage, and a sense of justice. Available historical accounts show that Baba Shahmal Singh was recognized as an influential local leader in his region. People trusted his words and accepted his leadership in difficult times. This public trust later became his greatest strength during the struggle of 1857.',
        'Bijrol geographical position was also important from a strategic point of view. Being close to Meerut, Baghpat, and important routes, the area was quickly affected by news and events. When the uprising began in Meerut on 10 May 1857, its echo soon reached nearby villages. Bijrol was not untouched by this historic moment. Existing discontent and rural unity created a favorable atmosphere for resistance.',
        'The greatest strength of Baba Shahmal Singh was his ability to organize people. He inspired people to rise above caste, economic status, and village boundaries for a shared purpose. This was extremely difficult at a time when modern communication facilities did not exist. Even then, his leadership played a major role in bringing many rural communities together.',
        'Today, Bijrol is respected not only for its geographical identity, but also for its historical legacy. The life of Baba Shahmal Singh is an inseparable part of the village identity. His memory teaches future generations that the real strength of any society lies in unity, self-respect, and commitment to justice.',
        'The dust of Bijrol carries the echo of history, its fields reflect a tradition of hard work, and its chaupals preserve the spirit of collective consciousness. This was the environment that gave birth to a great people leader like Baba Shahmal Singh. His life proves that even a person rising from an ordinary rural background can earn an unforgettable place in the history of the nation.',
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

    .info-page::before {
        content: "";
        position: fixed;
        inset: 0;
        pointer-events: none;
        background:
            linear-gradient(90deg, rgba(13, 51, 37, .035) 1px, transparent 1px),
            linear-gradient(0deg, rgba(13, 51, 37, .03) 1px, transparent 1px);
        background-size: 52px 52px;
        mask-image: linear-gradient(180deg, rgba(0,0,0,.8), transparent 72%);
        z-index: 0;
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

    .info-hero-copy {
        position: relative;
        z-index: 1;
    }

    .info-hero-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 24px;
    }

    .info-hero-badges span {
        display: inline-flex;
        align-items: center;
        min-height: 34px;
        padding: 7px 12px;
        border-radius: 999px;
        border: 1px solid rgba(255,255,255,.2);
        background: rgba(255,255,255,.12);
        color: rgba(255,255,255,.9);
        font-size: 12px;
        font-weight: 850;
        backdrop-filter: blur(12px);
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

    .info-card.featured {
        background:
            linear-gradient(135deg, rgba(255,255,255,.94), rgba(248,251,246,.98)),
            radial-gradient(circle at top right, rgba(200, 144, 47, .16), transparent 34%);
        border-color: rgba(23, 98, 63, .16);
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

    .info-heritage {
        position: relative;
        background:
            linear-gradient(180deg, rgba(13, 51, 37, .98), rgba(8, 27, 20, .96)),
            url('{{ $localImage('bijrol.jpg.png') }}') center/cover no-repeat;
        color: #fff;
        overflow: hidden;
    }

    .info-heritage::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 12% 12%, rgba(248,216,141,.22), transparent 28%),
            radial-gradient(circle at 88% 32%, rgba(49,93,143,.2), transparent 32%),
            linear-gradient(90deg, rgba(8,27,20,.92), rgba(8,27,20,.68));
        pointer-events: none;
    }

    .info-heritage .info-shell {
        position: relative;
        z-index: 1;
    }

    .info-heritage .info-kicker,
    .info-heritage h2 {
        color: #fff;
    }

    .info-heritage .info-heading p {
        color: rgba(255,255,255,.78);
    }

    .info-heritage-grid {
        display: grid;
        grid-template-columns: minmax(0, .68fr) minmax(300px, .32fr);
        gap: 20px;
        align-items: start;
    }

    .info-heritage-story,
    .info-heritage-panel {
        border: 1px solid rgba(255,255,255,.16);
        border-radius: 8px;
        background: rgba(255,255,255,.08);
        box-shadow: 0 24px 70px rgba(0,0,0,.22);
        backdrop-filter: blur(18px);
    }

    .info-heritage-story {
        padding: 30px;
        display: grid;
        gap: 18px;
    }

    .info-heritage-story p {
        margin: 0;
        color: rgba(255,255,255,.84);
        font-size: 15px;
        line-height: 1.9;
    }

    .info-heritage-story p:first-child {
        color: #fff;
        font-size: 17px;
        font-weight: 650;
    }

    .info-heritage-panel {
        position: sticky;
        top: 96px;
        padding: 22px;
    }

    .info-heritage-panel h3 {
        margin: 0 0 14px;
        color: #fff;
        font-size: 22px;
        font-weight: 950;
    }

    .info-heritage-list {
        display: grid;
        gap: 12px;
    }

    .info-heritage-item {
        padding: 14px;
        border-radius: 8px;
        border: 1px solid rgba(255,255,255,.13);
        background: rgba(255,255,255,.09);
    }

    .info-heritage-item strong {
        display: block;
        color: #f8d88d;
        font-size: 14px;
        font-weight: 950;
        margin-bottom: 5px;
    }

    .info-heritage-item span {
        display: block;
        color: rgba(255,255,255,.76);
        font-size: 13px;
        line-height: 1.55;
        font-weight: 650;
    }

    .info-heritage-quote {
        margin-top: 16px;
        padding: 16px;
        border-left: 3px solid #f8d88d;
        background: rgba(248,216,141,.1);
        color: rgba(255,255,255,.86);
        font-size: 14px;
        line-height: 1.7;
        font-weight: 750;
    }

    .info-origin {
        position: relative;
        padding: 74px 0 34px;
        background:
            linear-gradient(180deg, #fffef9 0%, #f5f8ef 100%);
        overflow: hidden;
    }

    .info-origin::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 8% 12%, rgba(18, 97, 63, .11), transparent 30%),
            radial-gradient(circle at 92% 20%, rgba(189, 138, 45, .12), transparent 28%);
        pointer-events: none;
    }

    .info-origin-grid {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: minmax(300px, .34fr) minmax(0, .66fr);
        gap: 22px;
        align-items: start;
    }

    .info-origin-panel,
    .info-origin-story {
        border: 1px solid rgba(18, 97, 63, .12);
        border-radius: 8px;
        background: rgba(255, 255, 255, .9);
        box-shadow: 0 18px 46px rgba(22, 40, 32, .09);
        backdrop-filter: blur(14px);
    }

    .info-origin-panel {
        position: sticky;
        top: 92px;
        padding: 24px;
        animation: infoRise .75s ease both;
    }

    .info-origin-panel h2 {
        margin: 10px 0 12px;
        color: var(--deep);
        font-size: clamp(30px, 4vw, 48px);
        line-height: 1.02;
        font-weight: 950;
        letter-spacing: 0;
    }

    .info-origin-panel p {
        margin: 0;
        color: var(--muted);
        line-height: 1.75;
        font-size: 14px;
    }

    .info-origin-portrait {
        position: relative;
        margin: 20px 0 18px;
        overflow: hidden;
        border: 1px solid rgba(18, 97, 63, .14);
        border-radius: 8px;
        background: #f7f5ea;
        box-shadow: 0 16px 36px rgba(22, 40, 32, .1);
    }

    .info-origin-portrait img {
        display: block;
        width: 100%;
        aspect-ratio: 1.02;
        object-fit: cover;
    }

    .info-origin-portrait figcaption {
        position: absolute;
        left: 12px;
        right: 12px;
        bottom: 12px;
        padding: 10px 12px;
        border-radius: 8px;
        background: rgba(8, 47, 36, .88);
        color: #fff;
        font-size: 12px;
        font-weight: 850;
        backdrop-filter: blur(10px);
    }

    .info-origin-tags {
        display: grid;
        gap: 10px;
        margin-top: 20px;
    }

    .info-origin-tag {
        padding: 13px;
        border: 1px solid rgba(18, 97, 63, .1);
        border-radius: 8px;
        background: #fbfdf8;
        animation: infoRise .75s ease both;
        animation-delay: var(--delay, 0s);
    }

    .info-origin-tag strong {
        display: block;
        color: var(--green);
        font-size: 13px;
        font-weight: 950;
        margin-bottom: 5px;
    }

    .info-origin-tag span {
        display: block;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.55;
        font-weight: 650;
    }

    .info-origin-story {
        position: relative;
        padding: 28px;
        column-count: 2;
        column-gap: 28px;
        animation: infoRise .85s ease both .08s;
    }

    .info-origin-story.is-collapsed {
        max-height: 560px;
        overflow: hidden;
    }

    .info-origin-story.is-collapsed::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 170px;
        background: linear-gradient(180deg, rgba(255,255,255,0), #fff 78%);
        pointer-events: none;
    }

    .info-origin-story p {
        margin: 0 0 16px;
        break-inside: avoid;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.86;
    }

    .info-origin-story p:first-child {
        color: var(--ink);
        font-size: 17px;
        font-weight: 700;
    }

    .info-see-more {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        width: 100%;
        margin-top: 16px;
        border: 1px solid rgba(18, 97, 63, .18);
        border-radius: 8px;
        background: linear-gradient(135deg, var(--deep), var(--green));
        color: #fff;
        font-weight: 900;
        cursor: pointer;
    }

    .info-see-more:hover {
        filter: brightness(1.05);
        transform: translateY(-1px);
    }

    @keyframes infoRise {
        from {
            opacity: 0;
            transform: translateY(22px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
        .info-nearby-grid,
        .info-heritage-grid,
        .info-origin-grid {
            grid-template-columns: 1fr;
        }

        .info-heritage-panel,
        .info-origin-panel {
            position: static;
        }

        .info-origin-story {
            column-count: 1;
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

        .info-heritage-story,
        .info-heritage-panel,
        .info-origin-story,
        .info-origin-panel {
            padding: 20px;
        }
    }

    /* Redesigned premium information page */
    .info-page {
        --ink: #17201c;
        --muted: #69766f;
        --paper: #fffef9;
        --line: rgba(23, 32, 28, .1);
        --green: #12613f;
        --deep: #082f24;
        --gold: #bd8a2d;
        --blue: #255f8f;
        --shadow: 0 18px 46px rgba(22, 40, 32, .09);
        background:
            linear-gradient(180deg, #f7f8f3 0%, #fffef9 44%, #f6faf4 100%);
    }

    .info-page::before {
        opacity: .55;
    }

    .info-shell {
        width: min(1240px, calc(100% - 36px));
    }

    .info-hero {
        min-height: auto;
        padding: 112px 0 54px;
        color: var(--ink);
        background:
            linear-gradient(180deg, #f5f7ef 0%, #fffef9 100%);
        overflow: hidden;
    }

    .info-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 18% 22%, rgba(18, 97, 63, .12), transparent 30%),
            radial-gradient(circle at 86% 16%, rgba(189, 138, 45, .12), transparent 28%);
        pointer-events: none;
    }

    .info-hero::after {
        display: none;
    }

    .info-hero-grid {
        position: relative;
        grid-template-columns: minmax(0, 1fr) minmax(340px, 440px);
        gap: 44px;
        align-items: center;
    }

    .info-kicker {
        color: var(--green);
        letter-spacing: 0;
    }

    .info-hero h1 {
        max-width: 820px;
        margin: 16px 0 8px;
        color: var(--deep);
        font-size: clamp(54px, 8vw, 108px);
        line-height: .92;
        letter-spacing: 0;
    }

    .info-hero-place {
        margin: 0 0 16px !important;
        color: var(--gold) !important;
        font-size: clamp(20px, 3vw, 34px) !important;
        line-height: 1.2 !important;
        font-weight: 900;
    }

    .info-hero p {
        max-width: 760px;
        color: var(--muted);
        font-size: 17px;
        line-height: 1.85;
    }

    .info-hero-badges span {
        border-color: rgba(18, 97, 63, .14);
        background: #fff;
        color: var(--deep);
        box-shadow: 0 10px 24px rgba(22, 40, 32, .06);
    }

    .info-location-card {
        padding: 14px;
        background: #fff;
        border-color: rgba(18, 97, 63, .14);
        box-shadow: 0 24px 64px rgba(22, 40, 32, .14);
    }

    .info-location-card img {
        aspect-ratio: 1.16;
        border-radius: 8px;
    }

    .info-location-card strong {
        padding: 0 6px;
        font-size: 24px;
    }

    .info-location-card span {
        padding: 0 6px 6px;
        font-size: 14px;
    }

    .info-stats {
        margin-top: 0;
        padding: 8px 0 28px;
        background: #fffef9;
    }

    .info-stats-grid {
        gap: 12px;
    }

    .info-stat {
        min-height: 128px;
        padding: 22px;
        background: #fff;
        border-color: rgba(18, 97, 63, .12);
        box-shadow: 0 14px 34px rgba(22, 40, 32, .07);
    }

    .info-stat strong {
        color: var(--deep);
    }

    .info-page-nav {
        position: sticky;
        top: 0;
        z-index: 10;
        padding: 12px 0;
        background: rgba(255, 254, 249, .88);
        border-top: 1px solid var(--line);
        border-bottom: 1px solid var(--line);
        backdrop-filter: blur(16px);
    }

    .info-page-nav .info-shell {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .info-page-nav .info-shell::-webkit-scrollbar {
        display: none;
    }

    .info-page-nav a {
        display: inline-flex;
        align-items: center;
        min-height: 38px;
        padding: 8px 14px;
        border-radius: 999px;
        border: 1px solid rgba(18, 97, 63, .14);
        background: #fff;
        color: var(--deep);
        font-size: 13px;
        font-weight: 850;
        text-decoration: none;
        white-space: nowrap;
    }

    .info-page-nav a:hover {
        background: var(--deep);
        color: #fff;
    }

    .info-section {
        padding: 78px 0;
    }

    .info-section.tight {
        padding-top: 64px;
    }

    .info-heading h2 {
        color: var(--deep);
        font-size: clamp(34px, 4.8vw, 64px);
        line-height: 1;
    }

    .info-card,
    .info-source,
    .info-facility,
    .info-route-chip,
    .info-map-card,
    .info-nearby-row {
        background: #fff;
        border-color: rgba(18, 97, 63, .12);
        box-shadow: var(--shadow);
    }

    .info-card.featured {
        background:
            linear-gradient(135deg, #fff 0%, #fbfbf3 100%);
    }

    .info-block {
        background: #fbfdf8;
        border-color: rgba(18, 97, 63, .1);
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    }

    .info-block:hover {
        transform: translateY(-2px);
        border-color: rgba(18, 97, 63, .24);
        box-shadow: 0 14px 34px rgba(22, 40, 32, .08);
    }

    .info-contact {
        background:
            linear-gradient(135deg, rgba(8, 47, 36, .98), rgba(18, 97, 63, .94));
    }

    .info-heritage {
        background:
            linear-gradient(180deg, #fffef9 0%, #f4f8ef 100%);
        color: var(--ink);
    }

    .info-heritage::before {
        background:
            radial-gradient(circle at 12% 18%, rgba(18,97,63,.12), transparent 30%),
            radial-gradient(circle at 86% 24%, rgba(189,138,45,.14), transparent 30%);
    }

    .info-heritage .info-kicker,
    .info-heritage h2 {
        color: var(--deep);
    }

    .info-heritage .info-heading p {
        color: var(--muted);
    }

    .info-heritage-story,
    .info-heritage-panel {
        background: #fff;
        border-color: rgba(18, 97, 63, .12);
        box-shadow: var(--shadow);
        backdrop-filter: none;
    }

    .info-heritage-story p,
    .info-heritage-story p:first-child {
        color: var(--muted);
    }

    .info-heritage-story p:first-child {
        color: var(--ink);
    }

    .info-heritage-panel h3 {
        color: var(--deep);
    }

    .info-heritage-item {
        background: #fbfdf8;
        border-color: rgba(18, 97, 63, .1);
    }

    .info-heritage-item strong {
        color: var(--green);
    }

    .info-heritage-item span {
        color: var(--muted);
    }

    .info-heritage-quote {
        background: #fff8e7;
        border-left-color: var(--gold);
        color: var(--deep);
    }

    .info-road-card {
        box-shadow: 0 18px 42px rgba(22, 40, 32, .12);
    }

    @media (max-width: 992px) {
        .info-hero-grid {
            grid-template-columns: 1fr;
        }

        .info-location-card {
            display: block;
        }

        .info-location-card img {
            aspect-ratio: 1.8;
        }
    }

    @media (max-width: 700px) {
        .info-shell {
            width: min(100% - 24px, 1240px);
        }

        .info-hero {
            padding: 84px 0 36px;
        }

        .info-hero h1 {
            font-size: clamp(46px, 18vw, 72px);
        }

        .info-page-nav {
            top: 0;
        }

        .info-location-card img {
            aspect-ratio: 1.25;
        }
    }

    /* Compact premium template refresh */
    .info-page {
        background:
            radial-gradient(circle at 12% 2%, rgba(18, 97, 63, .1), transparent 26%),
            radial-gradient(circle at 88% 0%, rgba(189, 138, 45, .11), transparent 28%),
            linear-gradient(180deg, #f7f5ee 0%, #fffef9 34%, #f5faf3 100%);
    }

    .info-shell {
        width: min(1160px, calc(100% - 34px));
    }

    .info-hero {
        padding: 82px 0 30px;
        background:
            linear-gradient(135deg, rgba(255, 254, 249, .96), rgba(242, 247, 235, .96));
    }

    .info-hero-grid {
        grid-template-columns: minmax(0, 1.04fr) minmax(300px, 380px);
        gap: 26px;
    }

    .info-hero-copy {
        padding: 22px 0;
        animation: infoPremiumRise .8s cubic-bezier(.2, .8, .2, 1) both;
    }

    .info-hero h1 {
        margin: 10px 0 4px;
        font-size: clamp(48px, 7vw, 86px);
    }

    .info-hero-place {
        margin-bottom: 12px !important;
        font-size: clamp(18px, 2.4vw, 27px) !important;
    }

    .info-hero p {
        max-width: 700px;
        font-size: 15.5px;
        line-height: 1.72;
    }

    .info-hero-badges {
        margin-top: 16px;
        gap: 8px;
    }

    .info-hero-badges span {
        min-height: 31px;
        padding: 6px 11px;
        transition: transform .22s ease, box-shadow .22s ease, background .22s ease;
    }

    .info-hero-badges span:hover {
        transform: translateY(-2px);
        background: #f8fbf5;
        box-shadow: 0 14px 28px rgba(18, 97, 63, .1);
    }

    .info-location-card {
        position: relative;
        overflow: hidden;
        padding: 12px;
        animation: infoFloatIn .9s cubic-bezier(.2, .8, .2, 1) both .08s;
    }

    .info-location-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(115deg, transparent 0 38%, rgba(255,255,255,.55) 50%, transparent 62% 100%);
        transform: translateX(-120%);
        animation: infoSheen 5.5s ease-in-out infinite;
        pointer-events: none;
        z-index: 2;
    }

    .info-location-card img {
        aspect-ratio: 1.42;
    }

    .info-location-card strong {
        font-size: 20px;
    }

    .info-origin {
        padding: 36px 0 28px;
    }

    .info-origin-grid {
        grid-template-columns: minmax(280px, .38fr) minmax(0, .62fr);
        gap: 18px;
    }

    .info-origin-panel,
    .info-origin-story {
        box-shadow: 0 14px 36px rgba(22, 40, 32, .08);
    }

    .info-origin-panel {
        top: 76px;
        padding: 20px;
    }

    .info-origin-panel h2 {
        margin: 8px 0 9px;
        font-size: clamp(25px, 3.2vw, 38px);
    }

    .info-origin-panel p {
        font-size: 13.5px;
        line-height: 1.64;
    }

    .info-origin-portrait {
        margin: 14px 0;
    }

    .info-origin-portrait img {
        aspect-ratio: 1.28;
    }

    .info-origin-portrait figcaption {
        left: 9px;
        right: 9px;
        bottom: 9px;
        padding: 8px 10px;
        font-size: 11.5px;
    }

    .info-origin-tags {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
        margin-top: 14px;
    }

    .info-origin-tag {
        padding: 10px;
    }

    .info-origin-tag strong {
        font-size: 12px;
    }

    .info-origin-tag span {
        font-size: 11.3px;
    }

    .info-origin-story {
        padding: 22px;
        column-gap: 22px;
    }

    .info-origin-story.is-collapsed {
        max-height: 430px;
    }

    .info-origin-story p {
        margin-bottom: 13px;
        font-size: 14.2px;
        line-height: 1.72;
    }

    .info-origin-story p:first-child {
        font-size: 15.4px;
    }

    .info-see-more {
        min-height: 40px;
        margin-top: 10px;
        box-shadow: 0 14px 26px rgba(8, 47, 36, .18);
        transition: transform .2s ease, filter .2s ease, box-shadow .2s ease;
    }

    .info-stats {
        padding: 18px 0;
    }

    .info-stat {
        min-height: 96px;
        padding: 16px;
        transition: transform .22s ease, box-shadow .22s ease;
    }

    .info-stat:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 38px rgba(22, 40, 32, .12);
    }

    .info-stat strong {
        font-size: clamp(25px, 3.2vw, 34px);
    }

    .info-stat span {
        margin-top: 7px;
    }

    .info-page-nav {
        padding: 8px 0;
    }

    .info-page-nav a {
        min-height: 34px;
        padding: 7px 12px;
        box-shadow: 0 8px 18px rgba(22, 40, 32, .04);
    }

    .info-section {
        padding: 50px 0;
    }

    .info-section.tight {
        padding-top: 42px;
    }

    .info-heading {
        gap: 18px;
        margin-bottom: 18px;
    }

    .info-heading h2 {
        margin-top: 6px;
        font-size: clamp(30px, 4vw, 48px);
    }

    .info-heading p {
        font-size: 14.2px;
        line-height: 1.68;
    }

    .info-card {
        padding: 20px;
    }

    .info-profile-grid,
    .info-nearby-grid,
    .info-heritage-grid {
        gap: 14px;
    }

    .info-block {
        grid-template-columns: 92px minmax(0, 1fr);
        gap: 12px;
        padding: 14px;
    }

    .info-block h3 {
        font-size: 18px;
    }

    .info-block p,
    .info-card p {
        font-size: 13.8px;
        line-height: 1.64;
    }

    .info-fact,
    .info-facility,
    .info-source,
    .info-route-chip,
    .info-nearby-row {
        padding: 13px;
    }

    .info-contact {
        padding: 17px;
    }

    .info-road-grid,
    .info-facility-grid,
    .info-source-grid {
        gap: 12px;
    }

    .info-road-card {
        min-height: 180px;
        padding: 19px;
        transition: transform .22s ease, box-shadow .22s ease;
    }

    .info-road-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 22px 44px rgba(22, 40, 32, .18);
    }

    .info-heritage {
        padding-top: 48px;
        padding-bottom: 48px;
    }

    .info-heritage-story,
    .info-heritage-panel {
        box-shadow: 0 14px 36px rgba(22, 40, 32, .08);
    }

    .info-heritage-story {
        padding: 22px;
        gap: 13px;
    }

    .info-heritage-story p {
        font-size: 14px;
        line-height: 1.72;
    }

    .info-heritage-panel {
        top: 76px;
        padding: 18px;
    }

    .info-heritage-list {
        gap: 9px;
    }

    .info-heritage-item {
        padding: 12px;
    }

    .info-radar {
        max-height: 460px;
    }

    @keyframes infoPremiumRise {
        from {
            opacity: 0;
            transform: translateY(18px) scale(.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes infoFloatIn {
        from {
            opacity: 0;
            transform: translateY(20px) rotate(.8deg);
        }
        to {
            opacity: 1;
            transform: translateY(0) rotate(0);
        }
    }

    @keyframes infoSheen {
        0%, 44% { transform: translateX(-120%); }
        58%, 100% { transform: translateX(120%); }
    }

    @media (max-width: 992px) {
        .info-hero {
            padding: 76px 0 24px;
        }

        .info-origin-grid {
            gap: 14px;
        }

        .info-origin-tags {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .info-shell {
            width: min(100% - 22px, 1160px);
        }

        .info-hero {
            padding: 66px 0 22px;
        }

        .info-hero h1 {
            font-size: clamp(40px, 16vw, 64px);
        }

        .info-origin {
            padding: 24px 0 22px;
        }

        .info-origin-tags {
            grid-template-columns: 1fr;
        }

        .info-origin-story.is-collapsed {
            max-height: 470px;
        }

        .info-section,
        .info-heritage {
            padding: 38px 0;
        }

        .info-block {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<main class="info-page">
    <section class="info-hero" id="information">
        <div class="info-shell info-hero-grid">
            <div class="info-hero-copy">
                <span class="info-kicker">Information Profile</span>
                <h1>Bijrol Village</h1>
                <p class="info-hero-place">Baraut, Baghpat, Uttar Pradesh</p>
                <p>A premium village profile covering Bijrol's identity, agriculture, culture, governance, public facilities, nearby villages, and the proud 1857 legacy of Baba Shahmal Singh Tomar.</p>
                <div class="info-hero-badges" aria-label="Village identity highlights">
                    <span>Agriculture</span>
                    <span>Heritage</span>
                    <span>Education</span>
                    <span>Community</span>
                    <span>1857 Legacy</span>
                </div>
            </div>
            <aside class="info-location-card">
                <img src="{{ $localImage('vil.jpg.png') }}" alt="Bijrol village view">
                <strong>Gram Panchayat Bijrol</strong>
                <span>Baraut Block and Tehsil, Baghpat district, Uttar Pradesh. Census village code 119306, PIN code 250620.</span>
            </aside>
        </div>
    </section>

    <section class="info-origin" id="origin-story">
        <div class="info-shell info-origin-grid">
            <aside class="info-origin-panel">
                <span class="info-kicker">History And Early Life</span>
                <h2>Bijrol, its culture, and the early world of Baba Shahmal Singh.</h2>
                <p>A premium English narrative on Bijrol's Ganga-Yamuna Doab setting, rural society, agriculture, community values, and the environment that shaped Baba Shahmal Singh Tomar before the great struggle of 1857.</p>

                <figure class="info-origin-portrait">
                    <img src="{{ $localImage('shahmal.jpeg') }}" alt="Baba Shahmal Singh Tomar portrait">
                    <figcaption>Baba Shahmal Singh Tomar, remembered as a symbol of farmer unity, courage, and public leadership.</figcaption>
                </figure>

                <div class="info-origin-tags">
                    @foreach($originHighlights as $index => $highlight)
                        <div class="info-origin-tag" style="--delay: {{ $index * .06 }}s;">
                            <strong>{{ $highlight['label'] }}</strong>
                            <span>{{ $highlight['text'] }}</span>
                        </div>
                    @endforeach
                </div>
            </aside>

            <div>
                <article class="info-origin-story is-collapsed" id="origin-story-content" data-expandable-story>
                    @foreach($originParagraphs as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </article>
                <button class="info-see-more" type="button" data-story-toggle aria-expanded="false" aria-controls="origin-story-content">See more</button>
            </div>
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

    <nav class="info-page-nav" aria-label="Information page sections">
        <div class="info-shell">
            <a href="#information">Profile</a>
            <a href="#heritage-1857">1857 Heritage</a>
            <a href="#governance">Governance</a>
            <a href="#roads">Connectivity</a>
            <a href="#nearby-villages">Nearby Villages</a>
        </div>
    </nav>

    <section class="info-section tight">
        <div class="info-shell info-profile-grid">
            <div class="info-card featured">
                <div class="info-heading" style="grid-template-columns:1fr; margin-bottom:18px;">
                    <div>
                        <span class="info-kicker" style="color:var(--green)">About Bijrol</span>
                        <h2>Complete village information in one place.</h2>
                    </div>
                    <p>Bijrol is a historic and agriculture-led village in western Uttar Pradesh, known for social unity, education, sports talent, rural culture, religious faith, community cooperation, and the legacy of Raja Shahmal Tomar. It brings together tradition, history, and modern development while maintaining strong links with the Baraut-Baghpat region.</p>
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

    <section class="info-section info-heritage" id="heritage-1857">
        <div class="info-shell">
            <div class="info-heading">
                <div>
                    <span class="info-kicker">Heritage of 1857</span>
                    <h2>Baba Shahmal Singh Tomar and the spirit of organized rural resistance.</h2>
                </div>
                <p>A premium historical note on the 1857 uprising, farmer unity, public leadership, sacrifice, and the living memory that continues to inspire Bijrol and the Baghpat region.</p>
            </div>

            <div class="info-heritage-grid">
                <article class="info-heritage-story">
                    @foreach($heritageParagraphs as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </article>

                <aside class="info-heritage-panel">
                    <h3>Legacy Highlights</h3>
                    <div class="info-heritage-list">
                        @foreach($heritageHighlights as $highlight)
                            <div class="info-heritage-item">
                                <strong>{{ $highlight['label'] }}</strong>
                                <span>{{ $highlight['text'] }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="info-heritage-quote">
                        His story reminds us that freedom is protected not only by courage on the battlefield, but also by unity, justice, and self-respect within society.
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="info-section" id="governance" style="background:rgba(255,255,255,.52);">
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

    <section class="info-section" id="roads" style="background:linear-gradient(180deg,#f7faf5,#fffdf7);">
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

    <section class="info-section" id="nearby-villages" style="background:linear-gradient(180deg,#fffdf7,#f7faf5);">
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('[data-story-toggle]');
    const story = document.querySelector('[data-expandable-story]');

    if (!toggle || !story) {
        return;
    }

    toggle.addEventListener('click', function () {
        const isExpanded = toggle.getAttribute('aria-expanded') === 'true';

        story.classList.toggle('is-collapsed', isExpanded);
        toggle.setAttribute('aria-expanded', String(!isExpanded));
        toggle.textContent = isExpanded ? 'See more' : 'Show less';
    });
});
</script>
@endpush
