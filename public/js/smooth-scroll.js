/**
 * Smooth Scroll Implementation
 * Provides a slow, visible scroll animation for anchor links
 */

document.addEventListener('DOMContentLoaded', function () {
    // Get all navigation links that point to sections
    const navLinks = document.querySelectorAll('a[href^="#"]');

    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');

            // Skip if it's just "#"
            if (targetId === '#') return;

            const targetSection = document.querySelector(targetId);

            if (targetSection) {
                smoothScrollTo(targetSection);
            }
        });
    });
});

/**
 * Smooth scroll to target element with custom easing
 * @param {HTMLElement} target - The element to scroll to
 * @param {number} duration - Duration of scroll in milliseconds (default: 1500ms)
 */
function smoothScrollTo(target, duration = 1500) {
    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    let startTime = null;

    // Easing function for smooth deceleration
    function easeInOutCubic(t) {
        return t < 0.5
            ? 4 * t * t * t
            : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }

    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;

        const timeElapsed = currentTime - startTime;
        const progress = Math.min(timeElapsed / duration, 1);
        const ease = easeInOutCubic(progress);

        window.scrollTo(0, startPosition + (distance * ease));

        if (timeElapsed < duration) {
            requestAnimationFrame(animation);
        }
    }

    requestAnimationFrame(animation);
}
