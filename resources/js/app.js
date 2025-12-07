import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Register service worker to enable offline caching of built assets
if ('serviceWorker' in navigator) {
	window.addEventListener('load', () => {
		navigator.serviceWorker.register('/sw.js').then(reg => {
			console.log('ServiceWorker registered:', reg.scope);
		}).catch(err => {
			console.warn('ServiceWorker registration failed:', err);
		});
	});
}
