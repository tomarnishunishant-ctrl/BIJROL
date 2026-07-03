@props([
    'title' => null,
    'text' => null,
    'href' => null,
])

@php($tag = $href ? 'a' : 'article')

<{{ $tag }} @if($href) href="{{ $href }}" @endif {{ $attributes->merge(['class' => 'pp-premium-card']) }}>
    @if($title)
        <strong>{{ $title }}</strong>
    @endif

    @if($text)
        <span>{{ $text }}</span>
    @endif

    {{ $slot }}
</{{ $tag }}>
