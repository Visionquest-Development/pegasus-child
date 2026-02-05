# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is **Pegasus Child**, a WordPress child theme extending the **Pegasus** parent theme. Built for 34 Oak (construction/renovation company), it adds custom galleries, before/after image comparisons, and multiple page templates.

## Development Environment

This theme runs within VVV (Varying Vagrant Vagrants). From the VVV root directory:
- `vagrant up` - Start the local environment
- `vagrant ssh` - Access the VM
- Site accessible at the hostname configured in `config/config.yml`

No build tools (npm/webpack) are used - edit PHP, CSS, and JS files directly.

## Architecture

### Parent Theme Relationship
- Parent: `pegasus` (defined in style.css `Template: pegasus`)
- Parent assets enqueued in `functions.php` via `get_template_directory_uri()`
- Override parent templates by copying them to this child theme directory

### Custom Post Types (in functions.php)

**Gallery CPT** (`gallery`)
- Stores image galleries with CMB2 metaboxes
- Shortcode: `[pegasus_gallery id="POST_ID"]`
- Renders with packery/masonry layout + lightbox

**Before & After CPT** (`before_after`)
- Before/after image comparisons
- Shortcode: `[before_and_after id="POST_ID"]`
- Interactive slider via `js/pegasus-image-diff.js`

### Page Templates (tpl_*.php)

| Template | Purpose |
|----------|---------|
| `tpl_home.php` | Homepage |
| `tpl_about.php` | About page |
| `tpl_gallery.php` | Gallery showcase |
| `tpl_exterior.php` | Exterior work |
| `tpl_interior.php` | Interior work |
| `tpl_makeready.php` | Make ready services |
| `tpl_child.php` | Test/demo template |

All templates use parent theme's header/footer and integrate with `pegasus_get_option()` for theme settings.

### CSS Variables (style.css)

```css
--oak-primary: #ff5d00;  /* Orange accent */
--oak-dark: #111111;     /* Black */
--oak-muted: #6b6f76;    /* Gray */
--oak-light: #f6f6f6;    /* Light gray */
```

### JavaScript Dependencies

- **Slick Carousel** - From parent theme
- **MatchHeight** - Equal-height elements (enqueued from parent)
- **Lightbox** - Gallery modals (`js/lightbox.min.js`)
- **Custom Scripts** - `js/pegasus-custom.js`, `js/pegasus-image-diff.js`

## Deployment

GitHub Actions (`.github/workflows/deploy-siteground.yml`) auto-deploys to SiteGround sites on branch push.

**Branch naming**: `{site}_theme` branches trigger deployment to corresponding sites (e.g., `34oak_theme`, `ulg_theme`).

**Required secrets**: `SITEGROUND_SSH_KEY`, `SITEGROUND_SSH_PORT`, `SITEGROUND_SSH_PASSPHRASE`

## Key Files

- `functions.php` - Asset enqueuing, CPT registration, CMB2 metaboxes, shortcodes
- `style.css` - Theme metadata + all custom styles
- `css/pegasus-image-diff.css` - Before/after comparison styles
- `js/pegasus-custom.js` - MatchHeight initialization and custom JS
