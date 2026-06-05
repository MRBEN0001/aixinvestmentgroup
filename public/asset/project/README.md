# Project Page Assets

This folder contains the local files required by `project.html`, copied from `https://wearethefuture-aix.com/projects/`.

Laravel placement:
- Put this folder at `public/asset/project`.
- Put `project.html` wherever you want to convert/use the page, for example `resources/views/project.blade.php`.
- The generated page uses public paths like `/asset/project/wp-content/...`.
- In Blade, you can convert those paths to `{{ asset('asset/project/...') }}` if you prefer Laravel helpers.

Files were organized under:
- `wp-content/` for page images, fonts, Elementor/plugin CSS, and optimized assets.
- `wp-includes/` for WordPress core JS used by the page.
- `vendor/` for third-party font/tag-manager files downloaded locally.
