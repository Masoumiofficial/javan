# Changelog

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
