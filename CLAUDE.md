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

---

# Addendum: Toast menu cache button & manual deploys

> This repo auto-deploys via GitHub Actions on branch push (see above).
> The `sync/deploy.sh` commands below are the **manual** on-demand pull path
> (SSH + `git pull`) used for one-off plugin/theme updates such as the
> shared `vqdev-toast` plugin. Both paths ultimately `git pull` on SiteGround.

Guidance for working in this theme and deploying the Toast menu + shared plugins.

## Toast "Refresh menu cache" admin-bar button

The JSON-powered food menu (Toast POS) is cached in WordPress transients. The
manual cache-clear button in the admin bar is built in **two layers**:

1. **Plugin `vqdev-toast`** owns the admin-bar button
   (`includes/class-toast-admin-bar.php`, class `Toast_Admin_Bar`). On click it
   verifies a nonce, fires `do_action( 'vqdev_toast_flush_cache' )`, redirects
   clean, and shows a dismissible confirmation toast. It is a **shared repo**
   used by every restaurant site (see below), so the button code is identical
   everywhere and is updated by `git pull`, not by editing per site.

2. **This theme** (`functions.php`) hooks that action and deletes *its own*
   menu transients — the theme is what caches the menu, so it must clear it:

   ```php
   add_action( 'vqdev_toast_flush_cache', function () {
       delete_transient( 'vqdev_toast_menu_data' );
       delete_transient( 'vqdev_toast_metadata_checked' );   // theloft: vqdev_toast_menu_meta_check
       delete_transient( 'vqdev_toast_oos_guids' );
   } );
   ```

   Transient keys differ per site — verify against the theme's own
   `set_transient(...)` / `$cache_key` calls before copying the hook.
   The Loft uses `vqdev_toast_menu_meta_check` instead of
   `vqdev_toast_metadata_checked`.

To add the button to a new restaurant site: `git pull` the `vqdev-toast` plugin
(the button + flush action come with it) and add the theme hook above with that
site's transient keys.

## Deploying to production (SiteGround)

Themes and plugins are deployed by SSHing into SiteGround and running `git pull`.
The tooling lives in **`/home/jim/Projects/vagrant-local/sync/`**:

- `deploy.sh` — the deploy script (reads **`sites.json`**, which holds SSH creds
  + per-site theme branches + plugin lists). `repos.json` is a parallel, leaner
  copy without SSH info; **`sites.json` is what `deploy.sh` actually uses.**
- `.env` — `SSH_KEY_PATH` (`~/.ssh/ulg_siteground`), `SSH_PASSPHRASE`, `SSH_PORT`.
  Not committed.

### One-time prerequisite each session: load the SSH key into the agent

The deploy key is passphrase-protected. `deploy.sh` runs `ssh -i` with no
askpass, so in a fresh shell the `git pull` step fails with
`Permission denied (publickey)` / `ssh_askpass ... No such file`. Fix by adding
the key to the running ssh-agent once (interactive terminal):

```bash
ssh-add ~/.ssh/ulg_siteground     # paste passphrase from sync/.env when prompted
ssh-add -l                        # confirm SHA256:Z+Kr83Dt... is listed
```

After that, all `deploy.sh` pulls run non-interactively for the rest of the session.

### Common deploy commands

Run from `sync/`:

```bash
./deploy.sh list                              # all configured sites
./deploy.sh pull <site> plugin vqdev-toast    # one plugin, one site
./deploy.sh pull <site> plugins               # all that site's plugins
./deploy.sh pull <site> child                 # pegasus-child theme
./deploy.sh pull <site> all                   # all themes + all plugins
```

### Pull one plugin across every site that has it (fleet-wide)

`deploy.sh` has no "all sites" mode — loop over the JSON with `jq`:

```bash
cd /home/jim/Projects/vagrant-local/sync
PLUGIN=vqdev-toast
for site in $(jq -r --arg p "$PLUGIN" \
    '.sites | to_entries[] | select(.value.plugins | index($p)) | .key' sites.json); do
  echo "=== $site ==="
  ./deploy.sh pull "$site" plugin "$PLUGIN"
done
```

### Pull ALL maintained plugins on ALL sites

```bash
cd /home/jim/Projects/vagrant-local/sync
for site in $(jq -r '.sites | keys[]' sites.json); do
  echo "=== $site ==="
  ./deploy.sh pull "$site" plugins
done
```

### Notes / gotchas

- A pull only works if the plugin/theme folder on the server is a **git clone**.
  If not, `deploy.sh` reports "not a git repository" and skips it — clone it on
  the server first. (As of last deploy, **sugarpeddler** is listed with
  `vqdev-toast` in the JSON but the plugin is **not installed** on its live
  server, so it is skipped.)
- Sites with `vqdev-toast`: saltcellar, theloft, mabellas, mixmarket, tommygs
  (+ sugarpeddler in JSON only). `ulg` and `ulg-events` do **not** have a Toast
  JSON menu — skip them for Toast work.
- Failures are logged with timestamps to `sync/deploy.log`.
