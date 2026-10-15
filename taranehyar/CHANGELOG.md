# Changelog

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
