# AIX Secure SPV Page Assets

This folder contains the local files required by `aix-secure-spv.blade.php`, copied from `https://aixfincon.com/promoted-product/aix-secure-spv/`.

Laravel placement:
- Put this folder at `public/asset/aix-secure-spv`.
- Put `aix-secure-spv.blade.php` at `resources/views/aix-secure-spv.blade.php`.
- The Blade page uses helpers like `{{ asset('asset/aix-secure-spv/...') }}`.

Files were organized under:
- `wp-content/` for page images, fonts, theme/plugin CSS, and optimized assets.
- `wp-includes/` for WordPress core JS used by the page.
- `vendor/` for third-party CDN files downloaded locally.
