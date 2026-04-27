# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

This is the **Pegasus Child** WordPress theme for Visionquest Development (`visionquestdevelopment.com`). It is a child theme that extends the parent `pegasus` theme. Development happens locally via VVV (Varying Vagrant Vagrants) and deploys to SiteGround production servers via GitHub Actions.

## Local Development

The site runs inside the VVV Vagrant box. Start it from the VVV root (`/home/jim/Projects/vagrant-local`):

```bash
vagrant up          # start VM
vagrant halt        # stop VM
vagrant ssh         # SSH into VM for WP-CLI, DB access, etc.
```

Local URL: `http://visionquest.test`

There is no build step — PHP/CSS/JS changes are served directly. Clear browser cache after CSS/JS edits.

## Deployment

GitHub Actions deploys via SSH git pull on SiteGround. Pushing to a site-specific branch triggers its deploy. The `vqdev_theme` branch is for local development only and does **not** auto-deploy.

| Branch | Site |
|--------|------|
| `ulg_theme` | uptownlifegroup.com |
| `ulg_events_theme` | events.uptownlifegroup.com |
| `theloft2025_theme` | theloft.com |
| `mabellas_theme` | mabellas.com |
| `saltcellar_theme` | saltcellar.com |
| `mixmarket_theme` | themixmarket.com |
| `tommygs_theme` | tommygs.com |

The workflow (`.github/workflows/deploy-siteground.yml`) SSHs into the server and runs `git pull origin <branch>` in the theme directory.

## Architecture

### Parent/Child Theme Relationship
`style.css` imports the parent via `@import url("../pegasus/style.css")`. `functions.php` enqueues both parent and child stylesheets. Override any parent template by creating a file with the same name here — WordPress loads the child version first.

### Template System
- **Page templates**: `tpl_*.php` files in the theme root (e.g., `tpl_home.php`, `tpl_portfolio.php`). Selected in the WordPress admin page editor.
- **Template partials**: `templates/` directory (e.g., `templates/header_one.php`, `templates/homepage_portfolio_item.php`). Loaded via `get_template_part()`.
- **`header.php`**: Overrides the parent header. Reads Pegasus theme options (`pegasus_get_option()`) to control header layout, sticky nav, logo, breadcrumbs, etc.
- **`single-portfolio.php`**: Single view for the `portfolio` CPT.

### Custom Post Types (registered in `functions.php`)
- **`portfolio`** — hierarchical, supports thumbnail/excerpt/custom-fields. No archive (uses `page-portfolio.php` pattern instead).
  - Taxonomy: `portcats` (hierarchical categories, slug: `portfolio`)
  - Taxonomy: `feattag` (non-hierarchical tags, slug: `feattag`)

### JavaScript
Enqueued in `functions.php` via `pegasus_child_bootstrap_js()`. Key libraries (all in `js/`):
- `pegasus_custom.js` — main custom JS, loaded on every page
- `slick.js` — carousel (also requires `css/slick.css` + `css/slick-theme.css`)
- `parallax.js` — parallax effects
- `wow.min.js` + `css/animate.min.css` — scroll-triggered animations (initialized inline in footer)
- GSAP + ScrollTrigger — loaded from cdnjs CDN
- `masonry.js` / `mixitup.js` — page-specific (loaded conditionally by page ID)

### Stripe Integration
- `config.php` — bootstraps the Stripe PHP SDK (`vendor/autoload.php`) and sets the API key from the `.env` file (gitignored)
- `charge.php` — one-off charge handler (currently disabled with `die()` at top)
- `create_subscription1/2/3.php` — subscription creation flows
- `Stripe/` — legacy vendored Stripe library (pre-Composer)
- `vendor/` — Composer-managed Stripe PHP SDK v4 (`composer.json`)

`.env` holds Stripe secret/publishable keys and is gitignored — never commit it.

### Gravity Forms
`functions.php` includes a `GWPreviewConfirmation` class that hooks into Gravity Forms to replace merge tags in multi-page form previews.
