@props([
    'kicker' => null,
    'title' => null,
    'text' => null,
    'align' => 'center',
])

<header {{ $attributes->merge(['class' => 'pp-section-title pp-section-title--'.$align]) }}>
    @if($kicker)
        <span class="pp-section-title__kicker">{{ $kicker }}</span>
    @endif

    @if($title)
        <h2>{{ $title }}</h2>
    @endif

    @if($text)
        <p>{{ $text }}</p>
    @endif

    {{ $slot }}
</header>
