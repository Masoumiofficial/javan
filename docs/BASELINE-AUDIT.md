# TaranehYar / legacy Javan Sada — baseline audit

**Audit date:** 2026-10-12
**Repository:** `Masoumiofficial/javan`
**Working branch:** `arena/877ae4b2-javan`
**Baseline commit:** `855da30d5055bbcf2cf2bf7f48c76cbaaef7a0ff`

## Executive baseline

The checkout is not a normal theme source tree: the only tracked project file is `javanseda.zip` (1,569,499 bytes). The archive contains a single `javanseda/` theme directory, 96 files in total (3,322,453 uncompressed bytes). Its ZIP CRC test passes. The Git object for the checked-out ZIP matches the ZIP blob at `HEAD`; `origin/main` points to the same commit as this baseline. There is no separate theme source tree, test suite, root README, root license, or release process in the baseline.

This is a reverse-engineering audit of the readable archive contents, not a complete code audit. The two largest product-specific PHP files—`functions.php` (94,279 bytes) and `RTL_License_41d6c5f704e3a746.php` (63,792 bytes)—are ionCube-protected. Their payloads were not decoded or bypassed. The visible loader fallback in `functions.php` prints an ionCube Loader requirement and exits with status 199 when that extension is not loaded. The protected source prevents inspection of most setup, hook, registration, enqueue, data-schema, and licensing behavior.

## Repository and package facts

- Baseline commit: `855da30d5055bbcf2cf2bf7f48c76cbaaef7a0ff` (`Add files via upload`); the available history is a single grafted commit.
- Branch: `arena/877ae4b2-javan`, clean before audit-document creation.
- Tracked paths at baseline: only `javanseda.zip`.
- SHA-256 of checked-out `javanseda.zip`: `d868660f0bc96ce6fcd375ee19d45e36fa150bde9db2511792de0ab958a30d73`.
- The archive has one expected top-level directory and no absolute or `..` paths.
- File types: 45 PHP, 8 JavaScript, 4 CSS, 13 PNG, 5 JPEG, 1 WebP, 1 GIF, 7 WOFF, 2 EOT, 2 TTF, 2 PO, 1 MO, 1 JSON, and 2 TXT files (directory entries excluded).
- Main structure: theme templates at the archive root; `inc/` theme partials, widgets, theme options, and a bundled OptionTree copy; `images/`, `fonts/`, `css/`, and `js/`; `searchwp-live-ajax-search/` template override.
- No Composer/npm project manifest exists for the theme. The embedded OptionTree copy has its own `composer.json`, GPLv3 license and upstream readme.

## Architecture observed in readable files

- Classic PHP theme using `style.css` theme metadata, `functions.php`, `header.php`, `footer.php`, templates, and `get_template_part()` partials.
- RTL/Persian front end, with responsive CSS breakpoints, local Vazir fonts and IcoFont assets, jQuery, Owl Carousel 2.3.4, HTML5 Shiv, and a custom `scripts.js` audio-player script.
- Theme settings are built with bundled OptionTree in `inc/theme-options.php`; settings include logo/favicon, dark mode, homepage modules, artist cards, social links, advertisements, footer copy, related-content controls and counts.
- Homepage sections observed: featured/VIP carousel, a multi-track homepage audio player, recent posts, monthly popular posts, configurable category sections, and a manually configured artist carousel.
- Content is built primarily from standard WordPress posts plus Advanced Custom Fields (ACF) fields such as `artist`, `song`, `music128`, `music320`, `album`, `music_text`, `video480/720/1080`, and `musics_type`.
- Artist views include a page template listing `singer` terms, a `taxonomy-singer.php` archive, artist/tag archives, artist metadata/social links, and related songs. Registration of the `singer` taxonomy and its field groups is not visible because the relevant core file is protected.
- Single-post templates include audio and video playback/download links, album repeater tracks, comments, optional view counts/star ratings, ads, social sharing/tags, and related-post sidebars.
- Three classic widgets are present: newest, popular-by-views, and random posts. Three sidebars are registered in readable `myfunctions.php`.
- Optional integrations visible in templates: ACF (used as a hard dependency by several templates), SearchWP Live Ajax Search markup, Yoast/Rank Math breadcrumbs, a views plugin (`the_views()`), and KK Star Ratings. Exact required/optional status and enqueue/activation logic cannot be confirmed without `functions.php`.
- No readable shortcode registration or custom post type registration was found. This is not proof that none exist; protected code may register them.

## Defects and risks observed before changes

### Confirmed in readable code

1. The 404/no-results countdown calls `clearInterval()` with the counter value, writes to an undeclared `span`, and references `#count` although neither template renders it. Its redirect uses the string form of `setTimeout()` and interpolates `bloginfo('url')` into JavaScript.
2. `artist-template.php` uses the old one-argument `get_terms('singer')` signature for its count, counts the result without checking `WP_Error`, and passes an undefined `$paged` into `paginate_links()`. The second `get_terms()` call uses the deprecated taxonomy-plus-args signature.
3. `tag.php` and `taxonomy-singer.php` call the output function `the_archive_description()` from inside `empty()`. That function echoes and returns no description value, so the conditional is not a valid way to test the description and can emit it outside the intended wrapper.
4. `inc/tarlanweb_player.php` assigns `$rkian = 1` inside an `if`, rather than testing the counter. Its custom queries call `wp_reset_query()` even though they use local `WP_Query` objects.
5. Several theme-owned output paths echo option/ACF values into HTML attributes, URLs, or text without context-appropriate escaping. Advertisement fields intentionally accept markup/script and need a separate trusted-admin policy.
6. Widget callbacks assume optional instance keys (`title`, `post_numbers`, `targets`) exist; updates read unchecked checkbox keys. The “open in new tab” checkbox is saved/read as a variable but not applied to the generated links. Widget queries overwrite global `$wp_query`, and the `current_post_id` comparison can reference an undefined local.
7. Archive taxonomy templates issue unbounded (`posts_per_page = -1`) queries for each artist and may be expensive on sites with large catalogs. This behavior is preserved pending a product decision and real dataset measurement.
8. The source archive has several internal legacy prefixes and theme metadata for `javanseda`/Javan Sada and the original vendor. Prefixes also back CSS selectors, widget IDs, menu IDs, and possibly saved option/widget data; they are compatibility identifiers, not safe bulk-replacement targets.

### Not verifiable from the checkout

- PHP errors, activation, actual hooks, CPT/taxonomy and ACF field registration, shortcode APIs, asset enqueues, query behavior, option migration, plugin requirements, and install/upgrade behavior are not fully auditable because the theme core is encrypted.
- No WordPress or PHP runtime is installed in this environment. PHP lint, activation, frontend/admin behavior, DB preservation, browser console/network checks, responsive rendering, and plugin integration tests are blocked.
- JavaScript syntax can be checked with Node; that is only a parser-level check, not browser or audio playback testing.
- Runtime PHP/WordPress minimum versions cannot be established from the archive. The old bundled OptionTree readme says it was tested through WordPress 4.4 and requires at least 3.8; that is vendor metadata, not a valid support claim for this full theme.

## Legal and provenance baseline

- No root `LICENSE` file or explicit theme license is present in the repository or extracted theme root.
- `style.css` names Reza Kianoosh and links to a Tarlanweb RTL-Theme author page; readable templates also contain original developer/site/contact attribution. The archive contains an encrypted `RTL_License_...php` file whose visible header references RTL-Theme product `172924`; its terms and owner/licensee data cannot be read from this checkout.
- Repository visibility and the ability to download the ZIP do **not** establish copyright ownership, a right to make derivatives, or a right to redistribute/sell a rebranded package. No purchase receipt, written assignment/permission, or other authorization is included.
- OptionTree has a bundled GPLv3 license/readme and `composer.json` naming `valendesigns/option-tree`; these notices must remain with any permitted redistribution of that component.
- Owl Carousel's source header identifies v2.3.4 and says its license is available in the upstream repository; the archive does not include a separate copy of that license. HTML5 Shiv's source header states MIT/GPL2. jQuery and the icon/font/image assets need a complete license/source manifest; no complete theme-wide third-party inventory is included.
- Therefore commercial redistribution is blocked until the theme/license and asset rights are documented. Attribution or authorship must not be inferred from repository ownership.

## Baseline test/tool availability

- `unzip -t javanseda.zip`: PASS; no compressed-data errors.
- Git object identity against the committed ZIP: PASS.
- Remote `main` commit identity check: PASS; `origin/main` was the baseline commit.
- Available: Git, Python 3, Node.js, npm, unzip.
- Not installed: PHP/Composer/WP-CLI/PHPCS/WordPress. No database or browser automation environment is available.
- Baseline JavaScript `node --check` across all eight theme JS files: PASS (syntax only).

## Release gate at baseline

**Not ready for commercial release.** The encrypted core blocks meaningful source/security/runtime review, a normal PHP runtime cannot run it here, and the theme/assets redistribution rights are not documented. Internal, non-public audit and conservative fixes to readable files may proceed; a commercial release claim or public release must wait for evidence resolving those gates.
