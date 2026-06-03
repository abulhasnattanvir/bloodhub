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



document.addEventListener('DOMContentLoaded', function () {

    if (typeof Sortable === 'undefined') {
        console.error('Sortable is not loaded!');
        return;
    }

    const menuList = document.getElementById('menu-list');

    if (menuList) {
        new Sortable(menuList, {
            animation: 150,
            handle: '.fa-grip-vertical',
        });
    }

    const saveBtn = document.getElementById('saveOrder');

    if (saveBtn) {
        saveBtn.addEventListener('click', function () {

            let items = [];

            document.querySelectorAll('#menu-list .menu-item').forEach((el, index) => {
                items.push({
                    id: el.dataset.id,
                    parent_id: null,
                    sort_order: index
                });
            });

            fetch("/admin/menus/sort", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ menus: items })
            })
                .then(res => res.json())
                .then(data => alert(data.message));

        });
    }

});