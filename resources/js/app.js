import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('page-is-ready');

    document.querySelectorAll('a[href]').forEach((link) => {
        link.addEventListener('click', (event) => {
            const href = link.getAttribute('href');

            if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:') || link.target === '_blank') {
                return;
            }

            const destination = new URL(href, window.location.origin);

            if (destination.origin !== window.location.origin || destination.pathname === window.location.pathname) {
                return;
            }

            event.preventDefault();
            document.body.classList.add('page-is-leaving');

            window.setTimeout(() => {
                window.location.href = destination.toString();
            }, 180);
        });
    });
});
