# CoAct WordPress Theme

Custom WordPress theme for CoAct, built by Slant Agency.

## Overview
This theme is built on top of [TailPress](https://tailpress.io/) and uses a component-based approach with Tailwind CSS and ACF Flexible Content.

## Documentation
- Detailed project context and technical details can be found in [GEMINI.md](./GEMINI.md).
- Development history and changes are tracked in [CHANGELOG.md](./CHANGELOG.md).

## Getting Started

### Installation
1. Clone the repository into your `wp-content/themes` directory.
2. Run `npm install` to install dependencies.

### Development
- `npm run dev`: Build assets for development.
- `npm run watch`: Watch for changes and rebuild assets.
- `npm run browser-sync`: Start browser-sync for local development.

### Production
- `npm run production`: Build minified assets for production.

## Architecture
The theme uses ACF Flexible Content to build pages. Each layout is defined in `acf-json/` and rendered via `template-parts/page-builder.php`, which loads the corresponding section from `template-parts/sections/`.

---
© 2026 Slant Agency
