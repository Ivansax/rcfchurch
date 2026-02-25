const CACHE_NAME = 'rcf-church-v1';
const urlsToCache = [
  '/',
  'index.php',
  'style.css',
  'JAVASCRIPT.php',
  'rcf log.png',
  'pastor ROBERT.jpeg'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});