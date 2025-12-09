/* Simple service worker to precache Vite build assets and critical routes.
   - On install, fetch /build/manifest.json to get asset list and cache them.
   - Cache the root and commonly used user pages.
   - On fetch, respond from cache first for assets, network-first for navigation.

   Note: For full offline appearance also download fonts into /public/fonts and images into /public/images.
*/

const CACHE_NAME = "hotel-bookie-v1";
const FALLBACK_HTML = "/";
const ROUTES_TO_CACHE = ["/", "/user/pending", "/user/book", "/user/history"];

self.addEventListener("install", (event) => {
    self.skipWaiting();
    event.waitUntil(
        (async () => {
            const cache = await caches.open(CACHE_NAME);
            await cache.addAll(ROUTES_TO_CACHE).catch(() => {});

            try {
                const res = await fetch("/build/manifest.json", {
                    cache: "no-store",
                });
                if (res.ok) {
                    const manifest = await res.json();
                    const urls = [];
                    Object.values(manifest).forEach((entry) => {
                        if (entry && entry.file)
                            urls.push("/build/" + entry.file);
                        if (entry && entry.css)
                            entry.css.forEach((c) => urls.push("/build/" + c));
                        if (entry && entry.assets)
                            entry.assets.forEach((a) =>
                                urls.push("/build/" + a),
                            );
                    });

                    urls.forEach((u) => {
                        cache.add(u).catch(() => {});
                    });
                }
            } catch (err) {
                console.warn("SW: could not fetch manifest.json", err);
            }
        })(),
    );
});

self.addEventListener("activate", (event) => {
    event.waitUntil(self.clients.claim());
});

self.addEventListener("fetch", (event) => {
    const req = event.request;

    // Only handle GET
    if (req.method !== "GET") return;

    const url = new URL(req.url);

    if (req.mode === "navigate") {
        event.respondWith(
            fetch(req)
                .then((res) => {
                    // Update the cache with the latest HTML for offline reuse
                    const copy = res.clone();
                    caches
                        .open(CACHE_NAME)
                        .then((cache) => cache.put(req, copy));
                    return res;
                })
                .catch(() =>
                    caches
                        .match(req)
                        .then((r) => r || caches.match(FALLBACK_HTML)),
                ),
        );
        return;
    }

    // For other requests (assets), use cache-first
    event.respondWith(
        caches.match(req).then(
            (cached) =>
                cached ||
                fetch(req)
                    .then((res) => {
                        // Optionally cache fetched asset
                        if (
                            res &&
                            res.status === 200 &&
                            req.url.startsWith(self.location.origin)
                        ) {
                            const copy = res.clone();
                            caches
                                .open(CACHE_NAME)
                                .then((cache) => cache.put(req, copy));
                        }
                        return res;
                    })
                    .catch(() => cached),
        ),
    );
});
