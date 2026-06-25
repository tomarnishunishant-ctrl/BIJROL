<div class="gov-topbar">
    <div class="container gov-topbar__inner">
        <div class="gov-topbar__left">
            <a href="#main-content">Skip to main content</a>
            <span>Premium Digital Village Portal</span>
        </div>
        <div class="gov-topbar__right">
            <span>Bijrol, Baghpat, Uttar Pradesh</span>
            <a href="/contact">Contact</a>
            <a href="/admin/login">Admin Login</a>
        </div>
    </div>
</div>

<nav class="navbar-modern" id="mainNavbar">
    <div class="container">
        <a class="brand-wrapper" href="/">
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
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
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
                    <li><a class="dropdown-item-modern" href="/about#information"><span class="dropdown-icon">IN</span> Information</a></li>
                    <li><a class="dropdown-item-modern" href="/whos-who"><span class="dropdown-icon">WW</span> Who's Who</a></li>
                    <li><a class="dropdown-item-modern" href="/schools"><span class="dropdown-icon">SC</span> Schools</a></li>
                    <li><a class="dropdown-item-modern" href="/temples"><span class="dropdown-icon">TM</span> Temples</a></li>
                    <li><a class="dropdown-item-modern" href="/sport-ground"><span class="dropdown-icon">SP</span> Sport Ground</a></li>
                    <li><a class="dropdown-item-modern" href="/hospitals"><span class="dropdown-icon">HP</span> Hospitals</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('gallery') ? 'active' : '' }}" href="/gallery">
                    <span class="nav-icon">GL</span>
                    <span class="nav-text">Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('government-employees') ? 'active' : '' }}" href="/government-employees">
                    <span class="nav-icon">GE</span>
                    <span class="nav-text">Govt Employees</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="/contact">
                    <span class="nav-icon">CT</span>
                    <span class="nav-text">Contact</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('village-voice') ? 'active' : '' }}" href="/village-voice">
                    <span class="nav-icon">VV</span>
                    <span class="nav-text">Village Voice</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('panchayat-dashboard') ? 'active' : '' }}" href="/panchayat-dashboard">
                    <span class="nav-icon">PD</span>
                    <span class="nav-text">Panchayat Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link-admin" href="/admin/login">
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
