# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the **pegasus-child** WordPress child theme for the Uptown Life Group (ULG) family of restaurant/venue websites in Columbus, GA. It extends the **pegasus** parent theme (Bootstrap-based, registered via `Template: pegasus` in `style.css`).

One codebase serves multiple sites — each site gets its own git branch. The current branch (`ulg_events_theme`) is for the ULG Events site. Pushing to a deploy branch triggers a GitHub Actions workflow that SSHs into SiteGround and runs `git pull`.

## Architecture

### Multi-Site Branch Strategy

Each site has a dedicated branch that auto-deploys to its SiteGround host:

| Branch | Site |
|---|---|
| `ulg_theme` | uptownlifegroup.com |
| `ulg_events_theme` | events.uptownlifegroup.com |
| `theloft2025_theme` | theloft.com |
| `mabellas_theme` | mabellas.com |
| `saltcellar_theme` | saltcellar.com |
| `mixmarket_theme` | themixmarket.com |
| `tommygs_theme` | tommygs.com |

Deploy workflow: `.github/workflows/deploy-siteground.yml`. Required secrets: `SITEGROUND_SSH_KEY`, `SITEGROUND_SSH_PASSPHRASE`, `SITEGROUND_SSH_PORT`.

### Parent Theme Relationship

The parent theme **pegasus** provides:
- Theme options via `pegasus_get_option()` (header layout, footer widgets, container widths, etc.)
- Bootstrap 5 framework (grid, navbar, utilities)
- Template system in `templates/` directory — copy a parent template into the child's `templates/` to override
- Slick carousel, match-height, and pegasus-carousel plugin assets (enqueued by handle in child)
- CMB2 metabox framework

### Key Files

- **`functions.php`** — Enqueues parent/child styles and JS, requires `uptown-restaurant-map.php` and `cpt_locations.php`, registers CMB2 homepage sections metabox (repeatable group with background image, title, subtitle, paragraph, button)
- **`tpl_home.php`** — Home page template. Renders CMB2 repeatable sections in alternating text-left/image-right layout, includes the `[uptown_restaurant_map]` shortcode
- **`cpt_locations.php`** — Registers `locations` CPT with `location_tags` (non-hierarchical) and `location_categories` (hierarchical) taxonomies, plus CMB2 metaboxes for address, phone, maps URL, reservation URL, card display fields, gallery group, hours, and social links
- **`uptown-restaurant-map.php`** — Registers `[uptown_restaurant_map]` shortcode rendering a Mapbox GL JS interactive map with restaurant cards. Mapbox token is passed via `wp_localize_script`
- **`footer.php`** — Overrides parent footer. Includes `templates/logo_slider` partial and widget-driven footer areas
- **`templates/header_two.php`** — Overrides parent header-two. Includes `templates/ulg_top_bar` for the ULG brand bar
- **`templates/ulg_top_bar.php`** — Cross-site navigation bar linking all ULG properties, auto-hides link to current site
- **`templates/logo_slider.php`** — Slick slider of restaurant brand logos/images

### CSS/JS

- **`style.css`** — All child theme custom CSS (ULG gradient headings, brand bar, home section double-border cards, button styles, logo slider, responsive rules). Brand color: `#92712A` (gold)
- **`css/uptown-map.css`** — Mapbox restaurant map styles
- **`js/pegasus-custom.js`** — Initializes Slick slider on `.ulg-logo-slider`
- **`js/uptown-map.js`** — Mapbox map initialization and restaurant marker/panel logic

### CMB2 Metabox Prefixes

- Homepage sections: `homepage_sections_` (on front page and page ID 77)
- Location details: `ulg_location_` (on `locations` CPT)
- Location gallery: `location_` (on `locations` CPT)

## Development Environment

This theme lives inside a VVV (Varying Vagrant Vagrants) local setup:
```
vagrant-local/www/ulgevents/public_html/wp-content/themes/pegasus-child/
```

The parent theme is at `../pegasus/`. No build tools, linters, or test runners are configured — changes are plain PHP/CSS/JS edits.

### Useful Helper

`ulg_get_cmb2_image_url($value)` — Normalizes CMB2 file field values (attachment ID, array with `id`/`url`, or plain URL string) into a URL. Defined in `functions.php`.
