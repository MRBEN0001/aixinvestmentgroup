# Homepage Asset Folder

This folder contains the local files used by the cloned `index.html` homepage.

Structure:
- `wp-content/` keeps the copied WordPress theme, plugin, and upload files in their original relative structure.
- `wp-includes/` keeps the copied WordPress core CSS/JS files referenced by the page.
- `vendor/` contains CDN files downloaded locally, including Bootstrap, jQuery, Swiper, Google Fonts CSS/font files, and the TradingView embed script.

Laravel integration:
- Put this whole `asset` folder inside Laravel's `public` directory.
- If `index.html` is moved into a Blade view, convert paths like `asset/wp-content/...` to `{{ asset('asset/wp-content/...') }}`.
- If the page is served directly from `public/index.html`, the current `asset/...` paths can stay as they are.

The original downloaded mirror folders were left untouched. The homepage now points to this organized `asset` folder for its design files.
