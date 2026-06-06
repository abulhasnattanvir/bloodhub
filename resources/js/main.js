document.addEventListener("DOMContentLoaded", function () {

    // Swiper
    new Swiper(".heroSlider", {
        loop: true,
        speed: 1200,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        effect: "slide",
    });

});

document.addEventListener('DOMContentLoaded', function () {

    // Language Switcher
    const languageItems = document.querySelectorAll('.dropdown-item[data-lang]');
    languageItems.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const lang = this.getAttribute('data-lang');
            document.cookie = "locale=" + lang + ";path=/;max-age=31536000";
            window.location.reload();
        });
    });

    // Mobile Menu Toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navbarNav = document.getElementById('navbarNav');

    if (mobileMenuBtn && navbarNav) {
        mobileMenuBtn.addEventListener('click', function () {
            navbarNav.classList.toggle('show');
        });
    }

    // Theme Switcher
    const themeToggle = document.getElementById('themeToggle');

    if (themeToggle) {
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            document.body.classList.add('dark-mode');
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        } else {
            document.body.classList.remove('dark-mode');
            themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
        }

        themeToggle.addEventListener('click', function (e) {
            e.preventDefault();
            document.body.classList.toggle('dark-mode');

            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                this.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                localStorage.setItem('theme', 'light');
                this.innerHTML = '<i class="fas fa-moon"></i>';
            }
        });
    }
});

// FAQ
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.faq-btn').forEach(button => {
        button.addEventListener('click', function () {
            const content = this.nextElementSibling;
            const icon = this.querySelector('.icon');

            // Close all others
            document.querySelectorAll('.faq-content').forEach(item => {
                if (item !== content) {
                    item.classList.add('max-h-0');
                    const otherIcon = item.previousElementSibling.querySelector('.icon');
                    if (otherIcon) otherIcon.textContent = '+';
                }
            });

            // Toggle current
            if (content.classList.contains('max-h-0')) {
                content.classList.remove('max-h-0');
                icon.textContent = '−';
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('max-h-0');
                icon.textContent = '+';
                icon.style.transform = 'rotate(0deg)';
            }
        });
    });
});