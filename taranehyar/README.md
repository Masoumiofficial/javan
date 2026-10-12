# TaranehYar — ترانه‌یار

**Build: 3.0.1 (public technical-test build; not a formal release). Installation and activation are unverified; commercial redistribution rights remain unresolved.**

This theme is a conservative modernization of the existing `javanseda` archive, not a rewrite. Its home, music single, artist archive, widgets, menus, comments and OptionTree settings are retained where visible in the source. The repository owner requested that this test branch be public; that request does not establish ownership or grant redistribution rights. See `ATTRIBUTION.md` and `LICENSES.md` before using this directory outside an authorized test.

## Testing installation

1. Back up the complete WordPress files and database.
2. Test only on a staging site you are authorized to modify.
3. Upload the `taranehyar` directory or the test-build ZIP as a theme.
4. Review ACF field groups and data, OptionTree values, widgets, menus, and page templates before switching away from the existing theme.
5. The provided `functions.php` contains ionCube-protected code; without the required Loader it prints a Loader error and exits. Loader/PHP version compatibility is not established.

No automatic migration, deactivation/rollback test, minimum WordPress/PHP version, or supported-plugin version has been certified.

## Features observed

Persian RTL classic theme; configurable homepage modules; featured carousel; audio/player and album playlist; video and download links; artist/singer taxonomy and directory; related songs; classic widgets and sidebars; comments; social links, breadcrumbs, search markup, dark mode and OptionTree settings. Full technical inventory is in the repository's `docs/FEATURE-INVENTORY.md`.

## Dependencies and limitations

ACF is used directly by several templates; OptionTree is bundled. SearchWP Live Ajax Search, SEO breadcrumbs, view counts and KK Star Ratings are optional integrations visible in templates. The protected `functions.php` prevents confirming all dependencies, setup, hooks and enqueue rules. See `LICENSES.md` for third-party material; the theme's own redistribution permission remains unresolved. Public availability is not a commercial license or a claim of release readiness.
