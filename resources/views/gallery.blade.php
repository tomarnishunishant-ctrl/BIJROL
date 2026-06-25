@extends('layouts.app')

@section('title', 'Gallery | BIJROL Village')

@php
    $localImage = fn ($file) => asset('image/' . $file);

    $galleryItems = [
        ['title' => 'Radha Krishna Darshan', 'category' => 'heritage', 'badge' => 'Temple', 'image' => $localImage('t1.jpeg'), 'text' => 'Radha Krishna temple darshan with decorated idols and devotional setting.'],
        ['title' => 'Radha Krishna Temple Lights', 'category' => 'heritage', 'badge' => 'Temple', 'image' => $localImage('t2.jpeg'), 'text' => 'Temple view decorated with lights during an evening devotional moment.'],
        ['title' => 'Fields and Village Road', 'category' => 'nature', 'badge' => 'Nature', 'image' => $localImage('home-hero-generated.png'), 'text' => 'A warm editorial view of fields, village road, and the calm rural character of Bijrol.'],
        ['title' => 'Bijrol Identity', 'category' => 'heritage', 'badge' => 'Heritage', 'image' => $localImage('bijrol.jpg.png'), 'text' => 'A strong visual memory connected with Bijrol village identity and local pride.'],
        ['title' => 'Community Life', 'category' => 'community', 'badge' => 'Community', 'image' => $localImage('main.jpg.jpg'), 'text' => 'Everyday rural life, homes, paths, and the familiar rhythm of the village.'],
        ['title' => 'Public Facilities', 'category' => 'services', 'badge' => 'Services', 'image' => $localImage('h2.jpg'), 'text' => 'Village facilities and public spaces that support families and residents.'],
        ['title' => 'Healthcare Access', 'category' => 'services', 'badge' => 'Services', 'image' => $localImage('h1.jpg'), 'text' => 'Healthcare and welfare touchpoints that matter for the village community.'],
        ['title' => 'Development and Progress', 'category' => 'community', 'badge' => 'Community', 'image' => $localImage('h3.jpg'), 'text' => 'A glimpse of progress, infrastructure, and public development around Bijrol.'],
        ['title' => 'Government Facilities', 'category' => 'services', 'badge' => 'Services', 'image' => $localImage('h4.jpeg'), 'text' => 'Administrative and public-service spaces serving the village.'],
        ['title' => 'Heritage Mood', 'category' => 'heritage', 'badge' => 'Heritage', 'image' => $localImage('h5.jpeg'), 'text' => 'A visual moment reflecting culture, memory, and village heritage.'],
        ['title' => 'Village Landscape', 'category' => 'nature', 'badge' => 'Nature', 'image' => $localImage('vil.jpg.png'), 'text' => 'Fields and open surroundings that shape Bijrol’s agricultural identity.'],
        ['title' => 'Sports Spirit', 'category' => 'community', 'badge' => 'Community', 'image' => $localImage('F.jpeg'), 'text' => 'Youth energy, sports culture, and the community spirit of Bijrol.'],
    ];

    $filters = [
        'all' => 'All',
        'nature' => 'Nature',
        'heritage' => 'Heritage',
        'services' => 'Services',
        'community' => 'Community',
    ];
@endphp

@push('styles')
<style>
.gallery-page {
    --gg-ink: #102033;
    --gg-muted: #647386;
    --gg-green: #0f6b47;
    --gg-green-dark: #073923;
    --gg-saffron: #d98516;
    --gg-bg: #f4f8f5;
    --gg-panel: rgba(255,255,255,.92);
    --gg-line: rgba(16,32,51,.12);
    --gg-shadow: 0 22px 62px rgba(16,32,51,.12);
    background:
        radial-gradient(circle at 14% 10%, rgba(15,107,71,.24), transparent 28%),
        radial-gradient(circle at 88% 16%, rgba(217,133,22,.22), transparent 28%),
        radial-gradient(circle at 22% 88%, rgba(49,93,143,.13), transparent 26%),
        linear-gradient(180deg, #fff2d8 0%, #eef9ef 48%, #fff6e7 100%);
    color: var(--gg-ink);
}

.gallery-hero {
    position: relative;
    min-height: calc(100vh - 92px);
    display: grid;
    align-items: center;
    padding: 68px 0 44px;
    overflow: hidden;
    isolation: isolate;
}

.gallery-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -2;
    background: url('{{ $localImage('home-hero-generated.png') }}') center/cover no-repeat;
}

.gallery-hero::after {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -1;
    background:
        linear-gradient(90deg, rgba(244,248,245,.98) 0%, rgba(244,248,245,.86) 48%, rgba(244,248,245,.48) 100%),
        linear-gradient(180deg, rgba(255,255,255,.05) 0%, var(--gg-bg) 100%);
}

.gallery-hero-grid {
    display: grid;
    grid-template-columns: minmax(0,.86fr) minmax(360px,.62fr);
    gap: 34px;
    align-items: center;
}

.gallery-kicker {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
    color: var(--gg-green);
    font-size: .78rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: .08em;
}

.gallery-kicker::before {
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: currentColor;
    box-shadow: 0 0 0 7px rgba(15,107,71,.12);
}

.gallery-hero h1 {
    max-width: 820px;
    margin: 0;
    color: var(--gg-green-dark);
    font-size: clamp(2.8rem, 6.5vw, 6rem);
    line-height: .96;
    font-weight: 950;
    letter-spacing: 0;
}

.gallery-hero p {
    max-width: 690px;
    margin: 18px 0 0;
    color: var(--gg-muted);
    font-size: 1.08rem;
    line-height: 1.85;
    font-weight: 650;
}

.gallery-panel,
.gallery-stat,
.gallery-item,
.gallery-feature {
    border-radius: 8px;
    background: var(--gg-panel);
    border: 1px solid var(--gg-line);
    box-shadow: var(--gg-shadow);
    backdrop-filter: blur(18px);
}

.gallery-panel {
    padding: 24px;
}

.gallery-panel img {
    width: 100%;
    aspect-ratio: 4 / 3;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid var(--gg-line);
}

.gallery-panel strong {
    display: block;
    margin-top: 16px;
    color: var(--gg-green-dark);
    font-size: 1.15rem;
    font-weight: 950;
}

.gallery-panel span {
    display: block;
    margin-top: 6px;
    color: var(--gg-muted);
    line-height: 1.7;
    font-weight: 650;
}

.gallery-stats {
    position: relative;
    z-index: 2;
    margin-top: -34px;
}

.gallery-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px;
}

.gallery-stat {
    min-height: 112px;
    padding: 20px;
}

.gallery-stat strong {
    display: block;
    color: var(--gg-green-dark);
    font-size: 2rem;
    line-height: 1;
    font-weight: 950;
}

.gallery-stat span {
    display: block;
    margin-top: 9px;
    color: var(--gg-muted);
    font-weight: 850;
}

.gallery-section {
    padding: 76px 0 86px;
}

.gallery-heading {
    max-width: 780px;
    margin: 0 auto 30px;
    text-align: center;
}

.gallery-heading h2 {
    margin: 0;
    color: var(--gg-green-dark);
    font-size: clamp(2rem, 4vw, 3.35rem);
    line-height: 1.1;
    font-weight: 950;
}

.gallery-heading p {
    margin: 12px 0 0;
    color: var(--gg-muted);
    line-height: 1.8;
    font-weight: 650;
}

.gallery-actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-bottom: 34px;
}

.gallery-actions button {
    min-height: 40px;
    border: 1px solid var(--gg-line);
    border-radius: 8px;
    padding: 8px 13px;
    background: rgba(255,255,255,.86);
    color: var(--gg-green-dark);
    font-weight: 900;
    transition: transform .2s ease, background .2s ease, color .2s ease, border-color .2s ease;
}

.gallery-actions button.active,
.gallery-actions button:hover {
    color: #fff;
    background: linear-gradient(135deg, var(--gg-green-dark), var(--gg-green));
    border-color: rgba(15,107,71,.4);
    transform: translateY(-2px);
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
}

.gallery-item {
    overflow: hidden;
    cursor: pointer;
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
}

.gallery-item:hover {
    transform: translateY(-4px);
    border-color: rgba(217,133,22,.42);
    box-shadow: 0 26px 64px rgba(16,32,51,.15);
}

.gallery-item img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    display: block;
    transition: transform .45s ease;
}

.gallery-item:hover img {
    transform: scale(1.06);
}

.gallery-card {
    padding: 22px;
}

.gallery-badge {
    display: inline-flex;
    margin-bottom: 10px;
    padding: 6px 9px;
    border-radius: 8px;
    color: #8a4b08;
    background: #fff7ed;
    border: 1px solid #fed7aa;
    font-size: .72rem;
    font-weight: 950;
    text-transform: uppercase;
}

.gallery-card h3 {
    margin: 0 0 8px;
    color: var(--gg-green-dark);
    font-size: 1.16rem;
    font-weight: 950;
}

.gallery-card p {
    margin: 0;
    color: var(--gg-muted);
    line-height: 1.7;
    font-weight: 650;
}

.gallery-feature {
    margin-top: 34px;
    padding: 34px;
    color: #fff;
    background:
        linear-gradient(135deg, rgba(7,57,35,.94), rgba(15,107,71,.9)),
        url('{{ $localImage('bijrol.jpg.png') }}') center/cover no-repeat;
}

.gallery-feature h2 {
    margin: 0 0 12px;
    font-size: clamp(1.8rem, 3vw, 2.7rem);
    font-weight: 950;
}

.gallery-feature p {
    max-width: 800px;
    margin: 0;
    color: rgba(255,255,255,.86);
    line-height: 1.8;
}

.modal-img {
    width: 100%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 8px;
}

.modal-header {
    background: var(--gg-green-dark);
    color: #fff;
}

@media (max-width: 1100px) {
    .gallery-hero-grid,
    .gallery-grid {
        grid-template-columns: 1fr 1fr;
    }

    .gallery-panel {
        max-width: 680px;
    }
}

@media (max-width: 760px) {
    .gallery-hero {
        min-height: auto;
        padding: 44px 0 34px;
    }

    .gallery-hero-grid,
    .gallery-stats-grid,
    .gallery-grid {
        grid-template-columns: 1fr;
    }

    .gallery-stats {
        margin-top: 0;
        padding-top: 18px;
    }

    .gallery-section {
        padding: 56px 0 68px;
    }

    .gallery-item img {
        height: 240px;
    }
}
</style>
@endpush

@section('content')
<div class="gallery-page">
    <section class="gallery-hero">
        <div class="container gallery-hero-grid">
            <div>
                <span class="gallery-kicker">Bijrol Photo Gallery</span>
                <h1>Village moments, beautifully organized.</h1>
                <p>Explore Bijrol through original local photos and a polished editorial hero visual: fields, heritage, services, sports, and community life.</p>
            </div>
            <aside class="gallery-panel">
                <img src="{{ $localImage('bijrol.jpg.png') }}" alt="Bijrol village gallery preview">
                <strong>Original village visuals</strong>
                <span>A cleaner gallery using project images instead of generic stock photos.</span>
            </aside>
        </div>
    </section>

    <section class="gallery-stats">
        <div class="container gallery-stats-grid">
            <div class="gallery-stat"><strong>{{ count($galleryItems) }}</strong><span>Total Photos</span></div>
            <div class="gallery-stat"><strong>5</strong><span>Categories</span></div>
            <div class="gallery-stat"><strong>Local</strong><span>Original Assets</span></div>
            <div class="gallery-stat"><strong>HD</strong><span>Preview Modal</span></div>
        </div>
    </section>

    <main class="gallery-section">
        <div class="container">
            <div class="gallery-heading">
                <span class="gallery-kicker">Curated Collection</span>
                <h2>Experience Bijrol’s beauty.</h2>
                <p>Filter the gallery by category and open any image for a larger preview.</p>
            </div>

            <div class="gallery-actions">
                @foreach($filters as $key => $label)
                    <button type="button" class="{{ $key === 'all' ? 'active' : '' }}" data-filter="{{ $key }}">{{ $label }}</button>
                @endforeach
            </div>

            <div class="gallery-grid">
                @foreach($galleryItems as $item)
                    <article class="gallery-item" data-category="{{ $item['category'] }}">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy">
                        <div class="gallery-card">
                            <span class="gallery-badge">{{ $item['badge'] }}</span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="gallery-feature">
                <h2>A visual archive for the village.</h2>
                <p>This gallery can grow into a proper public archive for festivals, development work, sports, schools, temples, fields, and community milestones.</p>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCaption"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="modal-img">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.gallery-item').forEach(function (item) {
        item.addEventListener('click', function () {
            const img = this.querySelector('img');
            const title = this.querySelector('.gallery-card h3').textContent;
            const description = this.querySelector('.gallery-card p').textContent;
            const modalImg = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');
            modalImg.src = img.src;
            modalImg.alt = img.alt;
            modalCaption.textContent = title + ' - ' + description;
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        });
    });

    const filterButtons = document.querySelectorAll('.gallery-actions button');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            filterButtons.forEach(function (btn) { btn.classList.remove('active'); });
            button.classList.add('active');
            const filter = button.dataset.filter;
            galleryItems.forEach(function (item) {
                item.style.display = filter === 'all' || item.dataset.category === filter ? '' : 'none';
            });
        });
    });
});
</script>
@endpush
