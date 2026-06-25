// Navbar scroll effects
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar-elegant');
    const scrollThreshold = 50;

    function handleScroll() {
        if (window.scrollY > scrollThreshold) {
            navbar.classList.add('scrolled');
            navbar.classList.add('shrink');
        } else {
            navbar.classList.remove('scrolled');
            navbar.classList.remove('shrink');
        }
    }

    // Initialize on load
    handleScroll();

    // Add scroll event listener with debounce
    let isScrolling;
    window.addEventListener('scroll', function() {
        window.clearTimeout(isScrolling);
        isScrolling = setTimeout(handleScroll, 50);
    }, false);

    // Mobile menu item click handler to close menu
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse.classList.contains('show')) {
                bootstrap.Collapse.getInstance(navbarCollapse).hide();
            }
        });
    });
});
