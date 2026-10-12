# Licensing, provenance and release gate

**Status: unresolved — no commercial redistribution authorization has been established by repository contents.** This is a technical provenance inventory, not legal advice and not a license grant.

## What was inspected

- The repository baseline contains only `javanseda.zip`; there is no root `LICENSE`, theme-specific license, purchase receipt, assignment, permission letter, or third-party asset manifest.
- `style.css` in the supplied archive names **Reza Kianoosh** as Author and points to an RTL-Theme author page. Readable template comments also contain author/site/contact attribution. Those provenance references are retained in source comments or this document where appropriate; the marketplace/contact promotional copy was removed from the settings description and rendered author meta, not as a claim that rights transferred.
- `RTL_License_41d6c5f704e3a746.php` is ionCube-protected. Its visible header points to RTL-Theme product `172924`; the licensee, scope, modifications, redistribution conditions, renewal status, and any rebrand rights cannot be read from this archive. The file is preserved unchanged.
- `functions.php` is also ionCube-protected; its executable source, author/license headers, setup and behavior cannot be inspected or safely edited here. It is preserved unchanged.
- Public repository visibility, repository control and possession of a ZIP do **not** prove copyright ownership or a right to modify, redistribute or sell the theme.

## Components found in the bundle

| Component | Evidence available in bundle | What remains to verify |
|---|---|---|
| OptionTree | `inc/option-tree/license.txt` contains GPLv3; `composer.json` identifies `valendesigns/option-tree`; its upstream readme says GPLv3. These notices remain in the theme. | Confirm all copied OptionTree assets and any local modifications are covered by the included notice; keep the source/license/readme with redistribution. |
| Owl Carousel | `js/owl.carousel.js` identifies v2.3.4, author(s), MIT license and upstream LICENSE URL. | Archive lacks a separate license text. Include the license text for the exact distributed version after a verifiable source is obtained. |
| HTML5 Shiv | `js/html5shiv.js` identifies version 3.7.3-pre and says MIT/GPL2 licensed. | Archive lacks a separate license text and source/version history. |
| jQuery | `js/jquery.js` is a minified jQuery bundle; no license file/banner was found next to it. | Determine exact version and include matching jQuery license. Do not infer solely from the filename. |
| IcoFont | `css/icofont.min.css` identifies IcoFont 1.0.1 and links to `https://icofont.com/license/`; icon font files are included. | Obtain/verify terms for the bundled release and the font binary. |
| Vazir fonts | `fonts/vazir-*.woff` included; no font license file found. | Verify font version, source and redistribution terms. |
| OptionTree fonts/images | Yekan and OptionTree font/image assets are bundled under `inc/option-tree/assets/`. | Verify asset-level license/attribution; GPL code file alone is not proof of every asset's terms. |
| Theme artwork | Logo/favicon, demo screenshot, error/default images, cover-art images and theme screenshot are included. | Establish ownership/permission for each; the screenshot visibly contains third-party music-cover artwork. New TaranehYar logo files were authored for this test build; this provenance note is not a substitute for formal rights review. Old source assets remain in the tree pending clearance. |
| RTL-Theme protected license payload | Encrypted PHP file and product URL visible. | Obtain the original buyer's terms/receipt or written permission from rights holder; no payload was decrypted. |

## Required evidence before a formal release or commercial redistribution

1. Written evidence that the person/entity authorizing this fork may modify and commercially redistribute the original theme code, including protected files, under the proposed new slug and author identity.
2. Clarification from the RTL-Theme licensor/author about the encrypted license file and whether its continued inclusion/use permits this renamed derivative to be resold or distributed.
3. Complete license and attribution manifest for fonts, icons, JavaScript libraries, images and any code hidden in the protected payload. Preserve all required notices and provide corresponding source where required.
4. A decision on the legal identity of the release (author/display branding is not by itself evidence of copyright ownership).

The repository owner has requested a public technical-test branch and ZIP. That publication is not itself proof of rights, a license grant, or a formal release. Until the evidence above is supplied and reviewed, do not create a formal GitHub Release, claim commercial readiness, or sell/market the theme as a cleared product.
