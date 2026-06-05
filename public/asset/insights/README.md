# Insights Page Assets

This folder contains the local files required by `insights.blade.php`, copied from `https://wearethefuture-aix.com/insights/`.

Laravel placement:
- Put this folder at `public/asset/insights`.
- Put `insights.blade.php` at `resources/views/insights.blade.php`.
- The Blade page uses helpers like `{{ asset('asset/insights/...') }}`.

Files were organized under:
- `wp-content/` for page images, fonts, Elementor/plugin CSS, videos, and optimized assets.
- `wp-includes/` for WordPress core JS used by the page.
- `vendor/` for third-party font CSS/font files downloaded locally.
