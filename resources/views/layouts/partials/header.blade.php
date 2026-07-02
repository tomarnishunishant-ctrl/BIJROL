<nav class="navbar-modern" id="mainNavbar">
    <div class="nav-scroll-progress" id="navScrollProgress" aria-hidden="true"></div>
    <div class="container">
        <a class="brand-wrapper" href="{{ url('/') }}">
            <span class="brand-icon">B</span>
            <span class="brand-text">
                <span class="brand-name">BIJROL</span>
                <span class="brand-tagline">Digital Village Portal</span>
            </span>
        </a>

        <button class="navbar-toggler-modern" id="navToggler" aria-label="Toggle navigation" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="nav-links" id="navLinks">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                    <span class="nav-icon">HM</span>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li class="nav-item nav-dropdown" id="aboutDropdown">
                <a class="nav-link dropdown-toggle {{ request()->is('about') || request()->is('whos-who') || request()->is('schools') || request()->is('temples') || request()->is('sport-ground') || request()->is('hospitals') ? 'active' : '' }}" href="javascript:void(0)">
                    <span class="nav-icon">AB</span>
                    <span class="nav-text">About</span>
                </a>
                <ul class="dropdown-menu-modern">
                    <li><a class="dropdown-item-modern" href="{{ url('/about#information') }}"><span class="dropdown-icon">IN</span> Information</a></li>
                    <li><a class="dropdown-item-modern" href="{{ url('/whos-who') }}"><span class="dropdown-icon">WW</span> Who's Who</a></li>
                    <li><a class="dropdown-item-modern" href="{{ url('/schools') }}"><span class="dropdown-icon">SC</span> Schools</a></li>
                    <li><a class="dropdown-item-modern" href="{{ url('/temples') }}"><span class="dropdown-icon">TM</span> Temples</a></li>
                    <li><a class="dropdown-item-modern" href="{{ url('/sport-ground') }}"><span class="dropdown-icon">SP</span> Sport Ground</a></li>
                    <li><a class="dropdown-item-modern" href="{{ url('/hospitals') }}"><span class="dropdown-icon">HP</span> Hospitals</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('gallery') ? 'active' : '' }}" href="{{ url('/gallery') }}">
                    <span class="nav-icon">GL</span>
                    <span class="nav-text">Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('government-employees') ? 'active' : '' }}" href="{{ url('/government-employees') }}">
                    <span class="nav-icon">GE</span>
                    <span class="nav-text">Govt Employees</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">
                    <span class="nav-icon">CT</span>
                    <span class="nav-text">Contact</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('village-voice') ? 'active' : '' }}" href="{{ url('/village-voice') }}">
                    <span class="nav-icon">VV</span>
                    <span class="nav-text">Village Voice</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('panchayat-dashboard') ? 'active' : '' }}" href="{{ url('/panchayat-dashboard') }}">
                    <span class="nav-icon">PD</span>
                    <span class="nav-text">Panchayat Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link-admin" href="{{ url('/admin/login') }}">
                    <span class="nav-icon">AD</span>
                    <span class="nav-text">Admin</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    const toggler = document.getElementById('navToggler');
    const navLinks = document.getElementById('navLinks');
    const aboutDropdown = document.getElementById('aboutDropdown');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        const progress = document.getElementById('navScrollProgress');
        if (progress) {
            const height = document.documentElement.scrollHeight - window.innerHeight;
            const percent = height > 0 ? Math.min(window.scrollY / height, 1) * 100 : 0;
            progress.style.transform = 'scaleX(' + (percent / 100) + ')';
        }
    });

    toggler.addEventListener('click', function() {
        const isOpen = navLinks.classList.toggle('open');
        toggler.classList.toggle('active');
        toggler.setAttribute('aria-expanded', isOpen);
    });

    if (aboutDropdown) {
        aboutDropdown.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                const clickedLink = e.target.closest('a');
                if (clickedLink && clickedLink.classList.contains('dropdown-item-modern')) {
                    return;
                }
                e.preventDefault();
                aboutDropdown.classList.toggle('open');
            }
        });
    }

    document.addEventListener('click', function(e) {
        if (!navbar.contains(e.target)) {
            navLinks.classList.remove('open');
            toggler.classList.remove('active');
            toggler.setAttribute('aria-expanded', 'false');
            if (aboutDropdown) aboutDropdown.classList.remove('open');
        }
    });

    const allNavLinks = navLinks.querySelectorAll('.nav-link:not(.dropdown-toggle), .dropdown-item-modern');
    allNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 992) {
                navLinks.classList.remove('open');
                toggler.classList.remove('active');
                toggler.setAttribute('aria-expanded', 'false');
                if (aboutDropdown) aboutDropdown.classList.remove('open');
            }
        });
    });
});
</script>
