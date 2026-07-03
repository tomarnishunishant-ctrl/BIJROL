<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BIJROL Village')</title>
    <meta name="description" content="@yield('meta_description', 'Official digital village portal for BIJROL with news, events, public services, village information, and community updates.')">
    <meta name="theme-color" content="#116241">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="BIJROL Village">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'BIJROL Village')))">
    <meta property="og:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', 'Official digital village portal for BIJROL.')))">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('image/bijrol.jpg.png'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', trim($__env->yieldContent('title', 'BIJROL Village')))">
    <meta name="twitter:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', 'Official digital village portal for BIJROL.')))">
    <meta name="twitter:image" content="@yield('og_image', asset('image/bijrol.jpg.png'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Navbar Styles -->
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    
    <!-- Shared Styles -->
    <link href="{{ asset('css/shared-styles.css') }}" rel="stylesheet">
    
    <!-- Styles / Scripts via Vite when available -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Global Responsive CSS -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

    @stack('styles')

    <!-- Premium portal design system -->
    <link href="{{ asset('css/premium-portal.css') }}" rel="stylesheet">
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>

    @include('layouts.partials.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <!-- Bootstrap JS via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('img:not([loading])').forEach(function (image, index) {
                image.loading = index < 2 ? 'eager' : 'lazy';
                image.decoding = 'async';
            });
        });
    </script>
    <script src="{{ asset('js/premium-portal.js') }}"></script>

    @stack('scripts')
</body>
</html>
