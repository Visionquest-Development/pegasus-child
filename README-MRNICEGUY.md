# Mr Nice Guy Authentic Soul Food & BBQ: Pegasus child theme (`mrniceguy_theme` branch)

A new site for Chef Darrell's **Mr Nice Guy Authentic Soul Food & BBQ** (current site: https://www.mrniceguyasf.com/, WordPress + Elementor + WooCommerce), rebuilt on the Pegasus parent theme.

Every fact on the site (name, address, phone, email, open days, menu and prices, story copy, events, photos) comes from these sources, checked 2026-10-27:
- mrniceguyasf.com (home, /menu/, /about-us/, /best-food-deal/, /contact-us/, Media Library)
- Facebook: https://www.facebook.com/p/Mr-Nice-Guy-Authentic-Soul-Food-BBQ-61579611354036/
- Instagram: @mrniceguyasf (current) and @mrniceguyauthenticsoulfood (2022–23)
- https://linktr.ee/mrniceguyasf (2026 events)

Anything that couldn't be confirmed is a **TODO** in `data/*.json` and in the list at the bottom. Don't replace a TODO with a guess.

> This branch is **not** in the SiteGround deploy registry or the deploy workflow's branch list, so pushing it deploys nothing.

## Required theme and plugins
| Slug | Source |
|---|---|
| `pegasus` (parent theme) | https://github.com/Visionquest-Development/pegasus |
| `pegasus-child` on branch **`mrniceguy_theme`** | https://github.com/Visionquest-Development/pegasus-child/tree/mrniceguy_theme |
| `pegasus-carousel` (slick: gallery strips) | Visionquest-Development/pegasus-carousel |
| `pegasus-slider` | Visionquest-Development/pegasus-slider (activated for parity; the hero is a static photo stack) |
| `pegasus-wow` (animate.css + WOW.js: `wow fadeInUp` etc.) | Visionquest-Development/pegasus-wow |
| `wp-bootstrap-hooks` | https://github.com/jimboobrien/wp-bootstrap-hooks (fork) |

Carousel and WOW are optional at runtime: without pegasus-carousel the gallery strip is a CSS scroll-snap row, and without pegasus-wow content renders without animation. `prefers-reduced-motion` turns off the ticker, embers, autoplay and entrance animations.

## Local setup (VVV on ursa-minor)
`config/config.yml` has a `mrniceguy` site (host `mrniceguy.test`, custom-site-template), and `sync/sites.json` + `sync/repos.json` have a `mrniceguy` entry with empty SSH fields (local only, no deploy).

Don't create `www/mrniceguy/` before provisioning: VVV refuses to clone the site template into a non-empty folder.

```bash
cd ~/Projects/vagrant-local
vagrant reload --provision                       # creates www/mrniceguy, installs WP, updates /etc/hosts
./sync/pegasus.sh setup site mrniceguy           # clones pegasus, pegasus-child@mrniceguy_theme and the 4 plugins (SSH remotes)
cp www/mrniceguy/public_html/wp-content/themes/pegasus-child/tools/setup-mrniceguy-wp.sh www/mrniceguy/
vagrant ssh -c "bash /srv/www/mrniceguy/setup-mrniceguy-wp.sh"
```
Then open https://mrniceguy.test. The setup script is idempotent and also clones any missing repo over HTTPS (origin is reset to SSH) if step 2 was skipped.

What `tools/setup-mrniceguy-wp.sh` does (wp-cli):
- activates Pegasus Child + the 4 plugins
- title "Mr Nice Guy Authentic Soul Food", tagline, timezone America/New_York, permalinks `/%postname%/`
- creates the pages below with their templates; Home is the static front page; trashes Sample Page / Hello World
- builds the **Main** menu (Home, Menu, Catering, Events, About, Gallery, Contact) on **Primary**
- imports the theme photos + logo into the Media Library (with alt text), once
- merges Pegasus Options (`pegasus_options`, CMB2): logo (+`logo_id`), favicon, header one, `navbar-expand-lg`, no additional header, no breadcrumbs, back-to-top, 0 footer widget areas, footer copyright

## Pages and templates
| Page | Slug | Template file | What it renders |
|---|---|---|---|
| Home | `home` (front) | `tpl_mng_home.php` | Ember hero with the single H1, photo stack, slogan ticker, open days/address/phone strip, weekly menu (one card per day), 4 menu highlights with prices, order band, Chef Darrell story, catering teaser, next 3 events, gallery strip, testimonials (off until confirmed), days + map |
| Menu | `menu` | `tpl_mng_menu.php` | Sticky day chips, then Wednesday / Thursday / Friday / Saturday sections from `data/menu.json` with prices. `/menu/#saturday` jumps to a day |
| About | `about` | `tpl_mng_about.php` | Chef Darrell story, mission / vision / values, Facebook intro |
| Catering | `catering` | `tpl_mng_catering.php` | Intro, 3 service cards, occasions, recent jobs, call/email quote CTA (mailto pre-fills date, guests, location), photo strip |
| Events | `events` | `tpl_mng_events.php` | Upcoming events (past ones drop off automatically by date) + "where we've been" list |
| Gallery | `gallery` | `tpl_mng_gallery.php` | Masonry grid with a native `<dialog>` lightbox |
| Contact | `contact` | `tpl_mng_contact.php` | Call / email / visit cards, days list, socials, map |

Any editor content on a page shows in that page's intro area.

Shared parts in `templates/`: `header_one.php` (override: logo, menu, Call to Order), `mng-page-hero.php` (inner-page H1), `mng-order-cta.php`, `mng-hours.php`, `mng-events.php`, `mng-footer.php` (contact, days, socials, **mobile sticky Call / Menu / Directions bar**). `footer.php` is the parent footer plus `mng-footer`.

Shortcodes: `[mng_hours]`, `[mng_address]`, `[mng_phone]`, `[mng_order_buttons]`, `[mng_events]`.

## Data files: the single source of truth
- `data/site.json`: name, address, phone, email, open days / hours, order links, socials, about copy, weekly day themes, highlights, catering copy, **events**, testimonials (hidden), gallery order, schema extras, per-page SEO titles + descriptions. **Edit contact info here only.**
- `data/menu.json`: the four day menus, items, prices, notes.
- `data/images.json`: alt text, size and source of every theme image.

## SEO
- One H1 per template (hero title); the header logo is an `<img>`, never an H1. A default logo is set through the `option_pegasus_options` filter so the parent header never prints the site name as an extra H1.
- Unique `<title>` + meta description per template from `site.json → seo`; Open Graph / Twitter tags with `images/og-share.jpg` (1200×630).
- `Restaurant` JSON-LD (name, alternate names, slogan, address, phone, email, cuisine, `$$`, menu URL, founder, sameAs) on Home, Menu, About, Catering, Events and Contact. `openingHoursSpecification` is added automatically once open/close times are filled in.
- `Menu` JSON-LD (sections, items, USD prices) on the Menu page.
- If Yoast or Rank Math is installed, titles/meta/OG are left to the plugin; the schema still prints.
- Old URLs to 301 at launch: `/about-us/` → `/about/`, `/contact-us/` → `/contact/`, `/best-food-deal/` → `/menu/`. WooCommerce `/shop/`, `/cart/`, `/checkout/`, `/my-account/` → `/menu/` unless online ordering is kept.

## Design
- Palette: smoker black `#121010`, charcoal `#1c1a19`, fire gradient (yellow `#ffc727` → orange `#f26b1d` → red `#d62d20`), cream `#fff6e9`. From the logo and the "MR NICE GUY" event posters.
- Type: Anton (heavy condensed caps), Kaushan Script (brush script accents), Inter (body).
- Hero title uses the poster look: orange-red fire gradient fill with a yellow outline.
- Images: WebP with JPEG/PNG fallback via `<picture>`, explicit width/height, lazy below the fold.

## TODO: needs real info from Chef Darrell
1. **Hours**: open/close times for Wed–Sat (site only says "open Wednesday through Saturday"). `site.json → hours[].open/close`.
2. **Address**: confirm 5060 Canton Rd, Marietta, GA 30066 is still the pickup spot (older posts call it the County Line pawn shop lot; Facebook says "Woodstock area").
3. **Prices**: confirm every price in `data/menu.json` (from mrniceguyasf.com; 2022–23 Instagram prices differ).
4. **Ordering**: any online ordering / delivery links. None exist today.
5. **Catering**: packages, per-person pricing, minimums, lead time, travel radius; and whether to add a quote form plugin.
6. **Testimonials**: the 3 quotes on mrniceguyasf.com have no names or source. Confirm before turning `testimonials.show` on.
7. **Events**: venue/city per event (needed for Event schema) and the 2027 dates.
8. **Logo**: high-res / vector of the newer orange "MR NICE GUY" chef-hat logo. The theme uses the older black badge from the current site (353×218).
9. **Photos**: the originals are 240–640 px web copies; send full-size photos (and a portrait of Chef Darrell at the pit).
10. **Name**: how Chef Darrell wants his full name shown.
11. **Domain/hosting**: confirm the live site stays at mrniceguyasf.com and where it's hosted before adding a deploy entry.
12. **Geo**: lat/lng from Google Business Profile for the schema.
