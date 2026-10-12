# Compatibility and dependencies

## Runtime support range

No WordPress or PHP support range is asserted yet. The checkout has no runtime requirements metadata, no PHP binary, no WordPress installation and no tested version matrix. The old bundled OptionTree readme says its own package requires WordPress 3.8 and was tested through 4.4; that is stale third-party metadata and **not** a support statement for TaranehYar.

The protected theme core in `functions.php` is ionCube-encoded. Its visible fallback exits with status 199 if the Loader is absent, so ionCube is a dependency of this theme's protected code—not a general requirement of PHP 8.1. The supplied `debug.log` shows WordPress reaching the OptionTree `init` hook and the TaranehYar home template; because WordPress includes the active theme's `functions.php` before those paths, this is strong evidence that ionCube Loader is active for the site's web PHP SAPI. The log does not directly record `phpinfo()` or `extension_loaded()` output, so treat this as an execution-based inference. The exact Loader build/version compatibility and supported PHP range cannot be determined from the protected payload.

## Dependencies visible in templates

### Required or effectively required

- WordPress classic theme APIs and the `singer` taxonomy.
- Advanced Custom Fields (ACF) for many song/album/video fields (`get_field`, `have_rows`, `the_sub_field`) and artist term metadata. Most single/home templates assume these APIs exist. ACF version is not declared.
- Bundled OptionTree library for theme settings (`ot_get_option`).
- ionCube Loader to run the protected theme `functions.php` payload according to its visible fallback.

### Optional integrations observed

- SearchWP Live Ajax Search via `data-swplive` and a template override under `searchwp-live-ajax-search/`.
- Yoast SEO (`yoast_breadcrumb`) or Rank Math (`rank_math_the_breadcrumbs`).
- A post-views plugin providing `the_views()`.
- KK Star Ratings (`kk_star_ratings()`).
- A custom menu walker, if registered by protected theme code; mobile template now falls back to WordPress's default walker if the class is unavailable.
- jQuery, Owl Carousel assets, HTML5 audio/video support and local icon/font assets. The protected enqueue logic is unavailable, so exact enqueue/version ownership cannot be confirmed.

No WooCommerce or Page Builder integration was found in readable files; protected code may contain additional integrations. Absence from readable code is not proof of absence.

## Locale, direction and browser behavior

- Source is primarily Persian/RTL (`fa-IR`, `dir="rtl"`). LTR compatibility has not been established; stylesheet rules explicitly use RTL layout.
- No theme translation catalogs were supplied. The new text domain is `taranehyar`; legacy hard-coded Persian UI strings remain and full localization is not complete.
- Responsive breakpoints and mobile-specific header/search exist in CSS/PHP, but no browser, device, RTL/LTR, console or network test was possible.
- Single-post audio/video and album repeaters exist in templates, but playback, codec/CDN/CORS behavior, download links and simultaneous-player behavior were not tested.

## Upgrade and data safety

No migration was performed. The directory/theme slug changes from `javanseda` to `taranehyar`; WordPress theme modifications can be keyed by stylesheet slug, while OptionTree and widgets may use different identifiers. Saved options, menus, widgets, and field metadata were not available in a real database. Back up first, test on staging, compare every theme setting/widget/menu, and do not remove the prior theme until validated. No destructive SQL or schema change was made.
