# Ru San's Kennesaw: Pegasus child theme (`rusans_theme` branch)

A redesign of https://www.rusanskennesaw.com/ (currently Brizy + Yoast on SiteGround), rebuilt on the Pegasus parent theme.
All copy, prices, hours, links and photos come from the current site and its July 2024 PDF menu. Anything that couldn't be confirmed is marked **TODO** in `data/*.json` and in the list below.

> This branch is **not** in the SiteGround deploy registry (`.github/sites.json`), so pushing it deploys nothing.

## Required theme and plugins
| Slug | Source |
|---|---|
| `pegasus` (parent theme) | https://github.com/Visionquest-Development/pegasus |
| `pegasus-child` on branch **`rusans_theme`** | https://github.com/Visionquest-Development/pegasus-child/tree/rusans_theme |
| `pegasus-slider` (slippry: hero) | Visionquest-Development/pegasus-slider |
| `pegasus-carousel` (slick: home and gallery strip) | Visionquest-Development/pegasus-carousel |
| `pegasus-wow` (animate.css + WOW.js: `wow fadeInUp` etc.) | Visionquest-Development/pegasus-wow |
| `wp-bootstrap-hooks` | https://github.com/jimboobrien/wp-bootstrap-hooks (fork) |

Slider, carousel and WOW are optional at runtime:
- If pegasus-slider isn't active, the hero uses a built-in CSS cross-fade.
- If pegasus-carousel isn't active, the gallery strip becomes a CSS scroll-snap row.
- If pegasus-wow isn't active, content renders without animation.
- `prefers-reduced-motion` turns autoplay and animations off.

## Setup (VVV / local)
1. Add a site to VVV `config/config.yml`, e.g. `rusans` → `rusans.test`. Run `vagrant reload --provision`.
2. Clone the code into `wp-content`:
   ```bash
   cd www/rusans/public_html/wp-content
   git clone https://github.com/Visionquest-Development/pegasus.git themes/pegasus
   git clone -b rusans_theme https://github.com/Visionquest-Development/pegasus-child.git themes/pegasus-child
   git clone https://github.com/Visionquest-Development/pegasus-slider.git plugins/pegasus-slider
   git clone https://github.com/Visionquest-Development/pegasus-carousel.git plugins/pegasus-carousel
   git clone https://github.com/Visionquest-Development/pegasus-wow.git plugins/pegasus-wow
   git clone https://github.com/jimboobrien/wp-bootstrap-hooks.git plugins/wp-bootstrap-hooks
   ```
3. Activate the **Pegasus Child** theme and the 4 plugins.
4. **Settings → Permalinks → Post name.** The home page links assume pretty permalinks and the slugs below.
5. **Settings → General → Timezone → New York.** The "Open now / Closed" badge uses the site timezone.
6. Create these pages and pick each one's template under Page Attributes → Template:

   | Page title | Slug | Template |
   |---|---|---|
   | Home | `home` | Home Template |
   | Menu | `menu` | Menu Template |
   | About | `about` | About Template |
   | Hours & Location | `location` | Location & Hours Template |
   | Catering | `catering` | Catering Template |
   | Gallery | `gallery` | Gallery Template |
   | Specials | `specials` | Specials Template |

7. **Settings → Reading:** set "A static page" with Home as the front page.
8. **Appearance → Menus:** create "Main" with Home, Menu, About, Catering, Gallery, Specials and Hours & Location, and assign it to **Primary Menu**.
9. **Pegasus Options:**
   - Pick a header. It was tested with the default header (header one).
   - Logo: upload `images/rusans-logo.png` or a better one. Until a logo is set, the theme defaults to `images/rusans-logo.png`. Otherwise the parent header would print the site name as a second `<h1>`.
   - Site title: `Ru San's Kennesaw`.
10. Optional page content:
    - Whatever you type in the editor shows up in the intro area (home), below the map (location), or as the specials text (specials). If the Specials page is empty, it shows the current site's specials copy.
    - Gallery, catering and menu are fully data-driven.

When moving to `visionquestdev.com/rusans`, nothing is hard-coded to the domain or the root path. All theme URLs go through `get_stylesheet_directory_uri()` and `home_url()`.

## Pages and templates
| File | What it renders |
|---|---|
| `tpl_home.php` | Hero slider (4 slides) with the single H1, hours/address/phone strip, about intro, 3 feature cards (appetizers, rolls, entrées → `/menu/#…`), Order band, catering teaser, gallery carousel, hours + map |
| `tpl_menu.php` | Full HTML menu from `data/menu.json`: 7 tabs (Appetizers, Sushi Rolls, Nigiri & Sashimi, Entrées, Soup & Noodles, Lunch, Kids & Desserts), 313 items, Raw/Fried badges, PDF download. Uses the shared `vqmenu` component (`templates/menu-tabs.php`, `templates/menu-mobile.php`, `assets/restaurant-menu/restaurant-menu.js`) from theloft2025/mabellas. `/menu/#rolls` opens that tab |
| `tpl_about.php` | Story, photos, highlights, link to the Sushi Knowledge blog |
| `tpl_location.php` | NAP, click-to-call, directions, email, hours with open/closed status, map embed, storefront photo |
| `tpl_catering.php` | Sushi platters and party platters from `data/catering.json`, call/email CTA |
| `tpl_gallery.php` | Masonry gallery with a `<dialog>` lightbox |
| `tpl_specials.php` | Specials text and Give Back Nights |
| `footer.php` | Parent footer plus `templates/rusans-footer.php` (NAP, hours, order buttons, socials, mobile sticky Call/Order/Directions bar) |

Template parts are in `templates/rusans-*.php`.

Shortcodes for use in page content: `[rusans_hours]`, `[rusans_address]`, `[rusans_phone]`, `[rusans_order_buttons]`.

## Data files: the single source of truth
- `data/site.json`: name, address, phone, emails, hours, order/delivery links, socials, about copy, specials text, per-page SEO titles and descriptions, schema extras. **Edit NAP here only.**
- `data/menu.json`: the menu, transcribed from `assets/menus/rusans-menu-2024-07.pdf` (July 2024).
- `data/catering.json`: platters and prices.
- `data/images.json`: alt text, dimensions and available widths for every image slug.

## Images
- `images/<slug>.webp|jpg` (large) and `images/<slug>-<width>.webp|jpg` (small).
- Hero images are 1600 and 800 wide (16:9). Others are 1000 and 560 wide, or native size if smaller.
- Output by `rusans_picture( $slug )`: `<picture>` with WebP plus JPEG fallback, `srcset`, `width`/`height`, and lazy loading except the first hero slide.
- Only images that are actually used are committed: 29 slugs, about 6.7 MB for all sizes.
- The full set of originals, with a manifest, was downloaded separately and isn't in the repo.

## SEO built in
- One H1 per template.
- `<title>`, meta description, Open Graph and Twitter tags per template, from `site.json → seo`. **Skipped automatically if Yoast or RankMath is active**, so a later Yoast install won't produce duplicates.
- One `Restaurant` JSON-LD block (address, geo TODO, opening hours, menu, cuisine, price range, reservations, sameAs, order actions) on home, menu, about, location and catering. Never on 404s.
- Click-to-call uses `tel:+16787660598`.

## TODO / content gaps (confirm with the owner)
- **Hours:** the visible site says Mon–Sat 11:30 AM–10 PM, Sun closed, and lunch 11:30–3. The old schema said Fri–Sat until 11 PM. The theme uses 10 PM.
- **Menu prices:** taken from the July 2024 PDF. Confirm they're current.
- **Large Sushi Platter:** no price on the current site.
- **Photos:** the Small Sushi Platter and Pork Gyoza Platter show placeholders; they need photos. The logo is only 150×191 px; get a high-resolution or vector logo.
- **Delivery partners:** DoorDash and Grubhub links verified 200. Uber Eats and Postmates couldn't be verified (bot check). Confirm all four are active.
- **Reservations:** phone only. No online reservation or first-party online ordering link exists.
- **Specials:** the current site has no active specials, only generic text.
- **Schema `geo`:** add lat/lng in `site.json → schema.geo`.
- **Business name:** confirm the exact Google Business Profile name.
- **Blog:** the 11 "Sushi Knowledge" posts (2017) aren't imported; the About page links to `/category/sushi-knowledge/`. Import them with WP export/import if you want them kept.
- **Contact form:** the location page has no form. Add one (e.g. WPForms or CF7) to the page content if wanted.
- **Hero slider:** check the slippry styling in a real browser at a few widths.
- **Redirects at launch:** `/rusansmenu/` → `/menu/`, `/contact-us/` → `/location/`, `/sushi-buffet/` → `/menu/`, `/menu/<old-item>/` → `/menu/#rolls`, `/online-ordering/` → `/#order`. Then noindex or delete `/sample-page/`, `/success/`, `/cart/`, `/checkout/`, `/checkout-retry/`, `/customer/`, `/history/` and `/terms/`.
