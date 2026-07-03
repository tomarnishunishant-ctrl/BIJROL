(function () {
    "use strict";

    var revealSelector = [
        ".hs-reveal",
        ".hs-glass",
        ".gallery-item",
        ".gallery-stat",
        ".contact-card",
        ".contact-stat",
        ".info-card",
        ".info-stat",
        ".info-block",
        ".info-origin-panel",
        ".info-origin-story",
        ".info-heritage-story",
        ".info-heritage-panel"
    ].join(",");

    function markRevealElements() {
        document.querySelectorAll(revealSelector).forEach(function (element) {
            if (!element.hasAttribute("data-premium-reveal")) {
                element.setAttribute("data-premium-reveal", "");
            }
        });
    }

    function initReveal() {
        var items = document.querySelectorAll("[data-premium-reveal]");
        if (!items.length) return;

        if (!("IntersectionObserver" in window)) {
            items.forEach(function (item) {
                item.classList.add("is-visible");
            });
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: "0px 0px -40px 0px" });

        items.forEach(function (item) {
            observer.observe(item);
        });
    }

    function initKeyboardNav() {
        document.querySelectorAll(".nav-dropdown > .dropdown-toggle").forEach(function (toggle) {
            toggle.setAttribute("aria-haspopup", "true");
            toggle.setAttribute("aria-expanded", "false");

            toggle.addEventListener("keydown", function (event) {
                if (event.key === "Enter" || event.key === " ") {
                    event.preventDefault();
                    var parent = toggle.closest(".nav-dropdown");
                    var isOpen = parent.classList.toggle("open");
                    toggle.setAttribute("aria-expanded", String(isOpen));
                }
            });
        });
    }

    function initImageFallbacks() {
        document.querySelectorAll("img").forEach(function (image) {
            image.addEventListener("error", function () {
                image.style.background = "linear-gradient(135deg, #f5f8f2, #fff7e5)";
                image.style.objectFit = "cover";
            }, { once: true });
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        markRevealElements();
        initReveal();
        initKeyboardNav();
        initImageFallbacks();
    });
})();
