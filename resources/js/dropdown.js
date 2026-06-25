document.addEventListener('DOMContentLoaded', function() {
    const aboutDropdown = document.getElementById('aboutDropdown');
    const aboutDropdownContainer = document.getElementById('aboutDropdownContainer');
    const aboutDropdownMenu = aboutDropdownContainer.querySelector('.dropdown-menu');
    const navbarCollapse = document.querySelector('.navbar-collapse');

    function setupDropdownHover() {
        // Only enable hover on desktop
        if (window.innerWidth >= 992) {
            // Show dropdown on hover
            aboutDropdown.addEventListener('mouseenter', () => {
                aboutDropdownMenu.classList.add('show');
            });

            // Hide dropdown when mouse leaves container
            aboutDropdownContainer.addEventListener('mouseleave', () => {
                aboutDropdownMenu.classList.remove('show');
            });

            // Keep dropdown open when hovering over menu
            aboutDropdownMenu.addEventListener('mouseenter', () => {
                aboutDropdownMenu.classList.add('show');
            });

            aboutDropdownMenu.addEventListener('mouseleave', () => {
                aboutDropdownMenu.classList.remove('show');
            });
        }
    }

    // Initialize on load
    setupDropdownHover();

    // Re-initialize on window resize
    window.addEventListener('resize', setupDropdownHover);
});
