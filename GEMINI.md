# CoAct WordPress Theme

## Project Overview
This is a custom WordPress theme for **CoAct**, developed by **Slant Agency**. It is based on the **TailPress** starter theme and utilizes **Tailwind CSS** for styling and **Advanced Custom Fields (ACF)** with **ACF Extended (ACFE)** for a component-based page builder.

### Main Technologies
- **WordPress**: CMS platform.
- **PHP**: Core server-side language.
- **Tailwind CSS (v3)**: Utility-first CSS framework.
- **daisyUI**: Tailwind CSS component library.
- **ACF / ACFE**: Used for building flexible page layouts and custom fields.
- **esbuild**: Used for bundling JavaScript assets.
- **PostCSS**: Used for processing CSS.

---

## Architecture & Structure

### Directory Overview
- `inc/`: Contains theme logic, setup, and initialization files (e.g., `theme-setup.php`, `acf.php`, `enqueue.php`).
- `acf-layouts/`: ACFE layout templates that typically include section templates from `template-parts/sections/`.
- `template-parts/`:
    - `sections/`: Contains the actual PHP templates for each page builder section.
    - `page-builder.php`: The main loop that iterates through ACF flexible content rows and includes the appropriate section template.
- `acf-json/`: Stores ACF field group definitions in JSON format for version control.
- `resources/`: Source CSS and JS files.
- `assets/`: Compiled and minified assets used by the theme.
- `vendor/`: Composer dependencies (if any).
- `node_modules/`: NPM dependencies for the build process.

### Key Logic
- **Page Builder**: The theme uses a "Section" flexible content field. Each row in this field corresponds to a template in `template-parts/sections/`.
- **Assets**: Assets are processed from `resources/` into `assets/` using the npm build scripts.

---

## Building and Running

### Prerequisites
- Node.js and npm installed.
- A local WordPress development environment (e.g., Local by Flywheel, Herd, or Docker).

### Key Commands
- **Install Dependencies**: `npm install`
- **Development Build**: `npm run dev` (Builds assets for development)
- **Watch Assets**: `npm run watch` (Watches for changes and rebuilds assets)
- **Production Build**: `npm run production` (Builds minified assets for production)
- **Browser-Sync**: `npm run browser-sync` (Starts browser-sync for local development, proxying `coactdev3.local`)

---

## Development Conventions

### Coding Style
- **Tailwind CSS**: Use utility classes for styling. Custom CSS should be minimal and placed in `resources/css/`.
- **ACF Sections**: When adding a new section:
    1. Define the field group in ACF (local JSON enabled).
    2. Add the layout to the `page-builder.php` loop.
    3. Create the template file in `template-parts/sections/`.
    4. (Optional) Add an ACFE layout template in `acf-layouts/` for previews.

### Dependencies
- **daisyUI**: Check `tailwind.config.js` and `package.json` for daisyUI usage.
- **Fancybox**: Used for lightboxes/modals (via `@fancyapps/ui`).
- **Animate.css**: Used for animations.
