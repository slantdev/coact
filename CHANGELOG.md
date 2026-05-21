# Changelog

All notable changes to the CoAct WordPress theme will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.2.20] - 2026-05-21

### Added
- Added "Show Logo" and "CTA" link options to Page Settings for landing pages.
- Added conditional standalone header rendering in `site-header.php` to display logo and CTA for landing pages when configured.
- Added "Section - One Column" ACF field group configuration.

### Changed
- Updated "Layout - Text Center" ACF settings to include color pickers for headlines and descriptions, as well as alignment and max-width column settings.
- Re-routed "One Column" layout clone settings in "Section Builder" to the new "Section - One Column" field group.
- Mapped the `2xl` column max-width option to Tailwind's custom `max-w-screen-xxl` (1380px) class in custom box, one column, and two column templates.
- Added null-coalescing fallback for `remove_site_footer` to prevent undefined index PHP warnings.

## [0.2.19] - 2026-05-20

### Added
- Implemented accordion component styling and functionality.
- Implemented Tailwind CSS compilation config for Advanced Custom Fields (`tailwind-acf.config.js`) to handle admin and layout styles.

### Changed
- Removed `min-h-300px` class from custom box component classes for flexible vertical sizing.
- Added "none" padding option and renamed default to "normal" in custom box settings.

### Fixed
- Prevented WPCode shortcodes from rendering inside ACF Extended admin previews to avoid layout breakage.


## [0.2.18] - 2026-05-18

### Added
- Added custom inline style support to the `coact_acf_icon` helper function for dynamic SVG customization.
- Applied dynamic inline styles for text, icons, and separators in the `icons_list` component based on ACF color picker settings.

### Changed
- Updated `site-header.php` to use the null-coalescing operator (`?? false`) for the `remove_site_header` setting to prevent undefined array key warnings.
- Cleaned up CSS transitions in `components.css` for better readability and removed unused `.content-cards-grid` pagination styles.
- Added standard `line-clamp: 2` rule to `.line-clamp-2` utility for broader compatibility alongside `-webkit-line-clamp`.

## [0.2.17] - 2026-05-16

### Added
- Added `form.php` component for rendering Formidable Forms with background, padding, shadow, and border settings.
- Added Heroicons Solid tab to the ACF Icon Picker with `coact_acf_icon()` helper function to render SVGs dynamically.
- Migrated the single WYSIWYG editor into a `content_editor` group with a fallback migration script in `inc/acf.php` to preserve existing database content.

### Changed
- Updated `custom_box.php` with new class prefixes (`coact-` instead of `civ-`), dynamic top/bottom separators, and inline custom link attributes.
- Updated `icons_list.php` and `icon.php` to use the new `coact_acf_icon` function instead of `civ_icon`.
- Updated admin styles for ACF fields and Formidable Forms in `admin-style.css`.
- Replaced `my-8` class with `component-wrapper` in `components.php`.
- Aligned items to the center in the testimonial swiper wrapper.

## [0.2.16] - 2026-04-16

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
