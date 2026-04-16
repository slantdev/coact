# Changelog

All notable changes to the CoAct WordPress theme will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Fixed
- Fixed `TypeError` in `buttons.php` when `button_link` returns as a string instead of an array.
- Fixed variable variable typo (`$$link_style`) causing PHP warnings in `image_text.php`.
- Fixed PHP warnings in `coact_tv.php` by filtering out non-object values before sorting taxonomy terms.
- Refactored FAQ Accordion in `faq.php` and `ajax.php` to use custom semantic HTML and jQuery slide down animations, removing deprecated DaisyUI dependencies and resolving a conflicting toggle listener in `app.js`.

## [0.2.12] - 2026-02-25

### Fixed
- Added `aria-label` attributes to testimonial slider navigation buttons in `single-service-partner.php`.
- Added a `label` to the `coact_icon` function call for the "Previous post" and "Next post" links in `single-post.php` to improve accessibility.
- Added `type="button"` to decorative buttons in `get_started_card.php`.
- Added visually hidden text to the "Play/Pause" button in `hero_slider.php`.

## [0.2.11] - 2026-02-24

### Added
- Comprehensive accessibility improvements (WCAG 2.1 AA compliant).
- Initialized CHANGELOG.md for project tracking.
- Created GEMINI.md for context and documentation.
- "Skip to Main Content" link for keyboard navigation.
- ARIA landmarks and labels for header, footer, and navigation.
- Focus trapping and Escape key support for mobile menu and search.
- Play/Pause control for Hero Slider autoplay.
- Accessible button-based structure for FAQ Accordions (replacing radio/checkbox inputs).
- Optimized link structure and semantic tags (`<article>`, `<nav>`) for Posts Grid cards.
- Label associations and ARIA required attributes for newsletter and search forms.
- Fallback `alt` attributes for all theme-rendered images.

### Fixed
- Corrected mismatched `nav`/`div` and `footer` tags causing broken page layouts.

## [0.1.25] - 2026-02-24

### Added
- Comprehensive accessibility improvements (WCAG 2.1 AA compliant).
- "Skip to Main Content" link for keyboard navigation.
- ARIA landmarks and labels for header, footer, and navigation.
- Focus trapping and Escape key support for mobile menu and search.
- Play/Pause control for Hero Slider autoplay.
- Accessible button-based structure for FAQ Accordions (replacing radio/checkbox inputs).
- Optimized link structure and semantic tags (`<article>`, `<nav>`) for Posts Grid cards.
- Label associations and ARIA required attributes for newsletter and search forms.
- Fallback `alt` attributes for all theme-rendered images.

## [0.1.24] - 2026-02-24

### Added
- Current state of the theme including ACF layouts and Tailwind integration.
- Custom page builder logic in `template-parts/page-builder.php`.
- Support for various components: `hero_slider`, `posts_grid`, `faq`, `coact_tv`, etc.
