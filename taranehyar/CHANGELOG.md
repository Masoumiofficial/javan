# Changelog

## Unreleased ８ — 2026-10-15 — Artist page, version 2 (`taxonomy-singer.php`)

- **Sort bar with real URLs**: `?sort=new` (default) / `?sort=old` / `?sort=title` (Persian-aware alphabetical ordering by the `song` field, falling back to the post title); sort variants are `noindex`.
- **Richer profile header**: "n items on this page" plus "last updated: …" (`get_the_date`) alongside the existing image, social links and per-bucket counts.
- **Directory links** under the profile: "all artists (A–Z directory)" and "artists starting with «X»" (deep link to that letter inside `/singers/`; the directory URL is discovered from the `artist-template.php` page template).
- **"Similar artists"** block based on shared posts, up to 8 (configurable), rendered as linked chips with item counts.
- **Per-bucket count badge** next to each section heading.
- **Structured data**: `MusicGroup` (name, image, description from the term description) plus an `ItemList` of items (up to 100) encoded with `JSON_UNESCAPED_UNICODE`.
- **Admin diagnostic** `?ab_artist_diag=1` prints the template file in use, the term and its link, whether `aimg2` exists, whether the term description is filled, and the `musics_type` / `song` values of the first 25 posts.
- Filter `javanseda_artist_page_config` controls sorting / similar artists / meta / directory links / schema size.
- Static preview at `cover-post/preview/artist.html` using the real theme stylesheet.
- **Performance**: one `update_postmeta_cache` primes all post meta before bucketing and sorting (previously per post).
- All legacy CSS classes, the three-way bucketing and the previous filters are untouched; no taxonomy registration, rewrite change or global hook was added.

## Unreleased ７ — 2026-10-15 — Alphabetical artist directory (`/singers/`)

- **`artist-template.php` rewritten** (the same "خواننده ها" page template that renders `/singers/`): true Persian alphabetical ordering (ی/ي, ک/ك, آ/أ/إ/ا, ة/ۀ/ه, diacritics, tatweel and ZWNJ normalised before sorting), per-letter grouping, an alphabet bar with per-letter counts and `#letter-…` anchors.
- **Live client-side artist search** (no server round trip, Persian-aware) and **per-letter permalinks**: `?letter=ب` (shareable and crawlable, works without JavaScript) and `?sort=songs` (most songs first, `noindex`).
- **Artist card** with an "n songs" badge, `loading="lazy"`, `decoding="async"` and `srcset` when the image comes from the media library; the image comes from the `aimg2` ACF term field, falling back to `images/def-singer.webp`.
- **SEO/AIO**: a unique `<h1>` per URL, a unique intro sentence and an `ItemList` JSON-LD block (up to 200 entries).
- **Admin diagnostic**: `/singers/?ab_artists_diag=1` prints the template file in use, the page's registered template, taxonomy/post-type existence, term counts, per-letter counts and sample `term_link`s.
- Filter `javanseda_artists_config` exposes every setting (taxonomy, `hide_empty`, caps, search, alphabet bar, schema size).
- New CSS block 15 at the end of `style.css` (cards, alphabet bar, night mode through the `--ab-*` variables, mobile) plus a static preview at `cover-post/preview/artists.html` with sample data.
- **Latin/English artist name** (idea taken from the reference site): rendered under the Persian name, resolved from the `javanseda_artists_latin_name` filter, then a list of common term meta keys (`artist_en`, `en_name`, `english_name`, `singer_en`, `latin_name`, `name_en`, `en_title`, `artist_latin`) and finally derived from an ASCII slug (`mohsen-yeganeh` → "Mohsen Yeganeh"); the same value feeds the live search and schema `alternateName`.
- **Server-side `?q=` search** through a real `GET` form (works without JavaScript, `noindex`), while the instant browser search now matches Persian **and** Latin text.
- **"پرتعدادترین خواننده‌ها" quick row**: twelve links with song counts (the reference site's "most searched" pattern) plus an "all most-frequent" link.
- **"مشاهده بیشتر …" button** with the page counter in paginated mode, and a proper no-results state with a clear-search link.

### Changed
- **Performance**: the directory template now runs one `get_terms` call with `update_termmeta_cache` instead of two queries plus per-term meta lookups; pagination (60 per page) only kicks in above the 1200-term cap, otherwise every artist renders in one alphabetically grouped page.
- This file registers no taxonomy, does not touch rewrites and adds no global hook: it only affects the page whose template is set to "خواننده ها". Rollback = restore the previous file.

## Unreleased ６ — 2026-10-15 — White page background + singer archive fix

- **Page background reverted to plain white** (`--ab-page: #FFFFFF`); the light blue (`--ab-blue-soft`) now only paints accents (lyrics-box header, chips, secondary buttons). Seven legacy blue-tinted shadows `rgba(28,76,156,.1)` were swapped for a neutral `rgba(17,17,17,.08)` so white cards read cleanly on the white canvas.
- **Fixed why the singer archive stopped rendering.** Two proven causes in readable code:
  1. `taxonomy-singer.php` ran six queries with exact `meta_query` matches on `musics_type = mp3|mp4|album`; when stored values differed (labels, uppercase, `آهنگ`, another key), every section rendered empty and the page showed only the artist header. The template now runs a single query, normalises the value, understands synonyms and shows unknown values under «سایر موارد» — nothing is silently hidden — plus a real empty state and a guard for an invalid term.
  2. The `singer` taxonomy is registered nowhere in readable code (it lives in the ionCube-protected `functions.php`). `myfunctions.php` now ships a safety net: fallback registration when missing, forcing `public`/`publicly_queryable` when hidden, and a one-time versioned rewrite flush (soft, no `.htaccess` write).
  3. **First safety-net version rolled back — the main regression suspect:** it was **on by default** and its `register_taxonomy_args` filter rewrote the flags of an already-registered taxonomy, which on a site where `singer` already worked could change the slug/rule order and 404 the archive. Now: default `false` (`JAVANSEDA_SINGER_FIX`), the filter is **removed**, and the fallback registration only runs at `init` priority 99 when neither the taxonomy nor a same-named post type exists.
  4. **Unwanted output from `myfunctions.php` fixed:** our block had been appended through the `?> … <?php` pattern, so the whitespace after `?>` was echoed on every request (breaking headers/redirects/caching). All such junctions were removed and the file now ends inside a single `<?php` region (no trailing `?>`).
- Added an admin-only diagnostic: `?ab_singer_diag=1` and `?ab_singer_diag=1&ab_singer_term=<slug|name>`, printing taxonomy existence/args, term count, `term_link` health, per-artist post counts and the `musics_type` histogram.
- Added filters `javanseda_artist_type_map`, `javanseda_artist_type_labels`, `javanseda_artist_posts_limit`.
- `docs/SINGER-ARCHIVE-DIAGNOSIS.md` documents causes, evidence, the diagnostic procedure and residual limitations. Not verified on a live WordPress.

## Unreleased ５ — 2026-10-15 — Corporate palette redesign (flat, no gradients)

- Added a colour token system at the top of `style.css`: `:root` and `.night` define `--ab-blue #185ADB` (Ahangban blue), `--ab-blue-dark #1246AD`, `--ab-blue-soft #EAF1FE` (light blue), `--ab-ink #111111`, `--ab-charcoal #222222`, `--ab-surface/--ab-white #FFFFFF`, plus `--ab-page`, `--ab-text`, `--ab-line` and `--ab-shadow`.
- All 49 legacy accent declarations (orange `#ff8c00`, red `#aa2712`, `#ffa800`) were mapped to the single brand blue; social-icon hover colours were unified to the same blue. No orange/red/green accents remain.
- Every gradient was removed in favour of flat colour (lyrics-box header, Instagram hovers, `.instagrms_ch`), and the cover shine bar is now a flat `rgba(255,255,255,.24)` bar with `filter: blur(10px)`. Gradients left in the stylesheet: zero.
- `body` background moved from grey `#f1f1f1` to the light brand blue `--ab-page` (#EAF1FE); cards stay white with `--ab-line` borders and `--ab-shadow`.
- Download buttons gained hierarchy in one colour: primary (128/320) solid blue with white text, secondary (music video) light blue with blue text; hover uses `--ab-blue-dark`.
- Night mode is now token-driven only (`--ab-page #111111`, `--ab-surface #222222`, text accents lightened to `#4C8BFF`) and the duplicated `.night` colour rules for the lyrics box, cover and download heading were deleted; night cards moved from `#111` to charcoal `#222` so they separate from the page. The "کپی شد" state inverts in night mode.
- `header.php`: `<meta name="theme-color">` changed from `#000000` to `#185ADB`.
- Contrast note: white on `#185ADB` is ≈5.4:1 versus ≈2.3:1 for white on the old orange. Not visually verified in a browser.
- `cover-post/preview/index.html` was rebuilt with the palette (plus a swatch table); zero gradients remain in it.

## Unreleased ۴ — 2026-10-15 — Download heading, guaranteed `singer` link, centred layout

- `single.php`: a shared block now resolves song / artist / artist URL once per view (the duplicated variables inside the lyrics block were removed), so the lyrics box and the new download heading read from the same source.
- New download heading `<h2 class="dl_title">دانلود {musics_type} {song} از {artist}</h2>` before `div.dl_links_box`, printed only when at least one download field is filled, switchable with `$taranehyar_download_title`. The type comes from `musics_type` (defaults to «آهنگ», so albums read «دانلود آلبوم …»).
- The "سایر آهنگ‌های …" chip now resolves through the `singer` taxonomy, producing URLs such as `/singer/mohsen-yaganeh`, with these fallbacks: optional ACF `artist_link` field → exact `singer` term name → `singer` slug → fuzzy `name__like` after normalising `ي/ك/ة` and ZWNJ → same-named tag → chip hidden (never a broken or `#` link). A `taranehyar_artist_url` filter was added for manual overrides.
- Centring/consistency pass: the lyrics header is a centred column (title above, chips below), the action row is `justify-content: center`, download wrappers are centred, download button radius went from `3px` to `10px` to match the 16px cover and 12px lyrics box, and the night header gradient is now `180deg` like the light one.
- `cover-post/preview/index.html` updated with the centred lyrics box, download heading, rounded download buttons and night mode.

## Unreleased ۳ — 2026-10-15 — Lyrics box with heading, artist link, copy button and JSON-LD

- `single.php`: `div.music_textss` was replaced by `section.music_lyrics_box` with an `<h2>` heading `متن آهنگ {song} از {artist}` (falls back to the post title), `lang="fa" dir="rtl"`, a chip linking to the artist archive (`singer` term or same-named tag), a copy-to-clipboard button with a "کپی شد" state, and three switches at the top of the block: `$taranehyar_lyrics_position` (`here`/`end`), `$taranehyar_lyrics_schema`, `$taranehyar_artist_type` (`Person`/`MusicGroup`).
- JSON-LD graph added: `MusicRecording` + `MusicComposition` (`lyrics` as `CreativeWork.text`) + `WebPage`, with unique `@id`s, `datePublished`/`dateModified`, `inLanguage: fa-IR` and `audio` from `music320`/`music128`. Encoded with `wp_json_encode` without `JSON_UNESCAPED_SLASHES` so lyrics text cannot break out of the script tag.
- `music_text` may be WYSIWYG HTML (`wp_kses_post`) or plain text (`esc_html` + `nl2br`); an empty field now prints nothing at all instead of an empty wrapper.
- `style.css`: new lyrics box block (gradient header, 12px radius, lyric typography at `line-height: 2.15`, chip buttons, `body.night` and mobile rules).
- Accessibility: the box is labelled via `aria-labelledby`, decorative icons are `aria-hidden`, and the copy button hides itself when the Clipboard API is unavailable.
- Honest limits are documented in `docs/LYRICS-BOX-SEO-AIO.md`: no lyrics rich result exists in Google and FAQ rich results were fully removed on 2026-05-07, so the structured data targets entity understanding and AI grounding, not SERP features. Rights to republish full lyrics remain unresolved.

## Unreleased ۲ — 2026-10-15 — Centered, rounded, animated cover (featured image)

- `single.php`: the automatically printed featured image is now wrapped in `div.single_featured_cover` so it is centered in the content column (the theme's text is right-aligned).
- `style.css`: the cover block was rewritten. The `figure` shrink-wraps the image (max-width 880px) with `border-radius: 16px` (12px on mobile), a two-layer shadow matching the post card, a fade/rise entrance (`taranehyar_cover_in`) and two CSS-only effects: a 4.5% hover zoom and a single diagonal shine sweep (`taranehyar_cover_shine`).
- Accessibility: every animation/transition is disabled under `prefers-reduced-motion: reduce`; a matching `body.night` shadow was added.
- Posts without a featured image still render nothing extra; the `nomusics.jpg` placeholder is intentionally not used here.
- Static preview (light + night, hover effects) added at `../cover-post/preview/index.html`.

## Unreleased — 2026-10-15 — Automatic featured image in the description area

- `single.php`: the post's featured image (when set) is now printed automatically at the top of the description/content area, before `the_content()`, inside `<figure class="single_featured_image">`. It no longer has to be inserted into the post content by hand. The rendered size is controlled by `$taranehyar_featured_size` (`large`, `full`, `thumb1`, `thumb2`).
- `style.css`: added `.single_featured_image` rules for spacing, centering and responsive scaling. The theme's global `img{max-width:100%;height:auto}` continues to apply.
- Posts without a featured image render nothing extra in this position; the `nomusics.jpg` placeholder is intentionally not used here.
- If the same image is already inside the description text, it will appear twice; remove the manual copy.
- The technical-test package `artifacts/taranehyar-1.0.0-test-build.zip` was rebuilt with this change (SHA-256/size updated in `docs/TEST-REPORT.md`).

## 1.0.0 — 2026-10-12 — First TaranehYar version; public technical-test build, not a formal release

- Extracted the supplied theme archive into the `taranehyar` install folder; original `javanseda.zip` remains unchanged in the repository.
- Updated visible theme metadata and default branding to TaranehYar / ترانه‌یار, اتحاد وردپرس / EtehadWP, and the `taranehyar` text domain.
- Added new default SVG logo/favicon and a touch icon; legacy artwork is retained pending rights review.
- Fixed visible 404/no-content countdown handling, artist-directory taxonomy queries/pagination, archive descriptions, search output, duplicate OptionTree setting definition, and comment date markup.
- Escaped a set of ACF, option, URL and term outputs; encoded social-share URLs; hardened widget input handling and honored the widget new-tab option.
- Restored the main post context after local template/widget queries and corrected related singer taxonomy field usage.
- No database schema, option IDs, widget IDs, hooks or legacy CSS/menu prefixes were migrated or removed.
- This public branch was requested for technical testing; PHP/WordPress activation and redistribution rights remain unverified. It is not a formal product release.
