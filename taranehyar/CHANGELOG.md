# Changelog

## 1.0.0 — 2026-10-12 — First TaranehYar version; public technical-test build, not a formal release

- Extracted the supplied theme archive into the `taranehyar` install folder; original `javanseda.zip` remains unchanged in the repository.
- Updated visible theme metadata and default branding to TaranehYar / ترانه‌یار, اتحاد وردپرس / EtehadWP, and the `taranehyar` text domain.
- Added new default SVG logo/favicon and a touch icon; legacy artwork is retained pending rights review.
- Fixed visible 404/no-content countdown handling, artist-directory taxonomy queries/pagination, archive descriptions, search output, duplicate OptionTree setting definition, and comment date markup.
- Escaped a set of ACF, option, URL and term outputs; encoded social-share URLs; hardened widget input handling and honored the widget new-tab option.
- Replaced OptionTree's removed `create_function()` call with a closure for PHP 8, and fixed its `end(@explode(...))` path expression to avoid the by-reference Notice.
- Guarded `get_field_object()` in song cards and the VIP slider so those templates do not fatal when the ACF API is unavailable.
- Restored the main post context after local template/widget queries and corrected related singer taxonomy field usage.
- No database schema, option IDs, widget IDs, hooks or legacy CSS/menu prefixes were migrated or removed.
- This public branch was requested for technical testing; PHP/WordPress activation and redistribution rights remain unverified. It is not a formal product release.
