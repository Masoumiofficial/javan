# Test and QA report

**Date:** 2026-10-12
**Scope:** extracted source and public technical-test package checks at repository-owner request. This is not a WordPress runtime certification or rights clearance.

## Pass

- Baseline archive: `unzip -t javanseda.zip` reported no compressed-data errors.
- ZIP tree safety: archive has one `javanseda/` root, no absolute paths and no `..` path segments.
- Provenance check: checked-out ZIP Git object equals `HEAD:javanseda.zip`; `origin/main` pointed to the baseline commit during discovery.
- Source preservation: all 96 files from the original ZIP remain in `taranehyar/`; no inherited file was removed. The original ZIP remains byte-for-byte unchanged. Modified/new files are present in the working tree.
- Public test package: `artifacts/taranehyar-1.0.0-test-build.zip` contains 104 files under one `taranehyar/` root; ZIP CRC and required WordPress theme entries passed. The package was not installed on WordPress and its public availability does not establish redistribution rights. Size: 1,593,571 bytes. SHA-256: `d1e555e3b5ff6e1a8380f7fc0a2a6efeab6eccd7e42378733fb5f5830dbcd2fa`. The `cover-post/` drop-in set is packaged separately as `artifacts/cover-post-replacements.zip` (4 files, no directory prefix, 31,778 bytes, SHA-256: `306bba147acc16b2160f30b093ca419b8b372444bf1ebf5173f078fbbbb682cb`). `cover-post/taxonomy-singer.php` is shipped as the fourth drop-in file (singer-archive rewrite). `cover-post/preview/index.html` is a static HTML preview of the cover styling and effects; it was served locally and checked for HTTP 200, but it is not a browser interaction/visual-regression test.
- JavaScript syntax: baseline and post-edit `node --check` on all eight bundled JavaScript files passed (syntax only).
- PHP parser (Node `php-parser` 3.7.0): all 43 readable PHP files parsed successfully after edits. The two ionCube-protected PHP files were deliberately excluded; this is not equivalent to `php -l` or execution.
- SVG assets: `logo.svg` and `favicon.svg` parse as XML.
- Generated touch icon: PNG signature and dimensions checked; it is a newly generated 256×256 PNG.
- Static settings audit: no duplicate `id` values remain in readable `inc/theme-options.php` settings.
- Coarse source search: no direct `eval`, shell execution, deserialization calls, or raw `$_GET`/`$_POST`/`$_REQUEST`/`$_COOKIE` reads were found in readable theme-owned PHP. This is a narrow grep check, not a security audit; vendor and protected code remain outside scope.

## Blocked / not tested

- Whole-tree `git diff --check` reports legacy trailing-space/CRLF lines retained from the supplied theme archive, including bundled/vendor files; no broad whitespace-only rewrite was applied. This does not replace review of newly added source.

- **PHP lint / PHP runtime:** PHP is not installed. `php -l`, PHP version compatibility, execution and warnings/notices are blocked.
- **Protected source:** `functions.php` and `RTL_License_41d6c5f704e3a746.php` cannot be audited or linted as readable PHP without the vendor's original source/authorization. No decoding was attempted.
- **WordPress install/activation:** no WordPress, WP-CLI, database, or plugin test environment is available.
- **Functional regression:** home/archive/single/search/artist pagination, menu/widget settings, ACF field rendering, comments, post upgrades, and switching back to the prior theme are not tested on a site.
- **Media/browser:** audio/video playback, downloads, responsive breakpoints, dark-mode/menu interactions, console, requests, asset caching, keyboard/screen-reader and RTL/LTR tests were not run.
- **Security/static standards:** no PHPCS/WordPress Coding Standards, PHPStan/Psalm, dependency scanner or live security tests were available. Escaping changes in readable files do not prove the entire theme is secure.
- **Performance:** no page/query profiling or real content dataset was available; no performance claim is made.
- **Compatibility matrix:** no WordPress/PHP/plugin versions were executed; no minimum support range is declared.
- **Formal/commercial release:** the ZIP validates structure/CRC only and was not installed on WordPress. It is present on the public test branch at the repository owner's request; this is not legal clearance or evidence of commercial redistribution rights.

## Remaining QA blockers

1. Obtain non-encrypted source/authorized review path for the core and license file.
2. Establish written theme/asset redistribution rights and complete third-party license manifest.
3. Run PHP lint on declared PHP versions and a WordPress matrix with ACF/OptionTree and optional integrations.
4. Run activation, fresh-install, upgrade, settings/widget, content/query, media, security and browser regression tests on staging with representative legacy data.
5. Re-measure unbounded singer archive queries before claiming performance readiness.
