# Insurance Guy Joe — `insuranceguyjoe_theme` (pegasus-child)

Child theme for **https://insuranceguyjoe.com/** (Joe Avena, health insurance agent) on the
[Pegasus](https://github.com/Visionquest-Development/pegasus) parent theme. Built SEO-first:
one H1 per page, per-page titles/descriptions/canonicals/OG, JSON-LD, breadcrumbs, internal
linking, WebP images with fallbacks, and a conversion layout (Call / Get a Free Quote / Contact on
every page plus a sticky mobile Call/Quote bar).

> This branch is **not** in the deploy registry/workflow (`.github/` is untouched from `master`).

## Requirements

| Piece | Repo / branch |
|---|---|
| Parent theme | `Visionquest-Development/pegasus` @ `master` |
| Child theme | `Visionquest-Development/pegasus-child` @ `insuranceguyjoe_theme` |
| Plugins (active) | `pegasus-wow` (scroll reveals), `pegasus-carousel` (slick; only loaded on the home page when there are 2+ testimonials), `pegasus-slider` (installed for parity; intentionally **not** used — a rotating hero hurts LCP and conversions), `jimboobrien/wp-bootstrap-hooks` (Bootstrap nav walker / dropdowns) |
| Optional | Yoast SEO or Rank Math. If either is active the theme's own title/meta/canonical/OG output switches off automatically (`igj_seo_plugin_active()`); JSON-LD stays on — disable one side if you see duplicates. |

## Setup

### Local (VVV)
1. Site `insuranceguyjoe` in `vagrant-local/config/config.yml` → `https://insuranceguyjoe.test`, `vagrant reload --provision`.
2. Repos via `sync/lib/setup_repos.sh` (reads `sync/repos.json`).
3. Inside the VM: `bash /srv/www/insuranceguyjoe/setup-insuranceguyjoe-wp.sh`
   (a copy of `tools/setup-insuranceguyjoe-wp.sh`).

### Any WordPress install
```bash
WP_PATH=/path/to/public_html bash tools/setup-insuranceguyjoe-wp.sh   # WP="wp --allow-root" to override the wp-cli command
```
The script is idempotent. It activates the theme and plugins, sets the site name, timezone and
permalinks (`/learn/%postname%/`), creates every page with its template and parent (reusing
WP's draft Privacy Policy page), sets **Home** as the front page and **Learn** as the posts page,
creates the 3 Learn articles, builds the `Main` menu (Services dropdown) on `primary` and the
`Footer Legal` menu on `footer-legal`, trashes the sample page/post, and flushes rewrites.

## Sitemap → templates

| URL | WP object | Template |
|---|---|---|
| `/` | Page "Home" (front page) | `tpl_igj_home.php` |
| `/services/` | Page | `tpl_igj_services.php` (hub, 4 groups) |
| `/services/<slug>/` ×12 | Child pages of Services | `tpl_igj_service.php` (data-driven by slug from `data/services.json`) |
| `/services/supplemental-insurance/dental-vision-insurance/` | Child of Supplemental | `tpl_igj_service.php` |
| `/learn/` | Page "Learn" = posts page | `home.php` |
| `/learn/<postname>/` | Posts | `single.php` |
| `/learn/category/<slug>/` | Categories | `category.php` → `archive.php` |
| `/faq/` | Page | `tpl_igj_faq.php` |
| `/about/` | Page | `tpl_igj_about.php` |
| `/contact/` | Page | `tpl_igj_contact.php` (quote form `#quote-form`) |
| `/privacy-policy/`, `/disclaimers/` | Pages | `tpl_igj_legal.php` (DRAFT banner; falls back to `content/legal/<slug>.html`) |
| search, 404 | — | `search.php`, `404.php` (both `noindex`) |

Service slugs: individual-family-health-insurance, self-employed-health-insurance,
small-business-health-insurance, travel-nurse-health-insurance, realtor-health-insurance,
early-retiree-health-insurance, turning-26-health-insurance, private-health-insurance,
aca-marketplace-health-insurance, cobra-alternatives, health-insurance-for-1099,
supplemental-insurance (+ dental-vision-insurance under it).

### Learn URL approach (why posts, not a CPT)
Learn articles are **native WordPress posts** with the permalink structure `/learn/%postname%/`,
and the "Learn" page is the posts page (`page_for_posts`). This gives the exact sitemap URLs while
keeping native RSS (`/learn/feed/`), categories, the block editor, Yoast/Rank Math article
support and core sitemaps with zero custom code. A custom post type would have left ordinary
posts orphaned at a second URL pattern. Side effects handled: category archives live at
`/learn/category/<slug>/`, and `inc/igj-setup.php` adds a rewrite rule so `/learn/page/2/`
paginates the hub instead of being read as a post named "page". Pages are unaffected
(`/services/…`, `/faq/`, etc. use page rewrites). **New articles: just publish a post.**

## Where things live

| File | Purpose |
|---|---|
| `data/site.json` | **Single source of truth for business facts** (name, phone, quote URL, agent, address, licenses, affiliation, hours, socials, SEO titles/descriptions per page, `show_carrier_logos`). Empty values are skipped in the page and in schema. Keys ending `_todo` explain what is missing. |
| `data/services.json` | All 13 service pages: nav label, icon, Service type, H1/lead, sections, FAQs (→ FAQPage schema), related services, related guides, SEO title/description, parent. |
| `data/faq.json` | `/faq/` groups and Q&As. |
| `data/images.json` | Image keys → files, sizes, alt text. |
| `content/learn/*.html`, `content/learn.json` | Seed articles (imported by the setup script). |
| `content/legal/*.html` | Draft Privacy Policy and Disclaimers. |
| `inc/igj-data.php` | Data loaders, `{{phone}}` / `{{todo:…}}` tokens, `igj_picture()` (WebP + JPG/PNG fallback, lazy unless eager), breadcrumbs, quote-form handler (nonce + honeypot → `wp_mail` to `site.json` email or the admin email), shortcodes `[igj_phone]`, `[igj_quote_button]`. |
| `inc/igj-seo.php` | Title, meta description, canonical, OG/Twitter; JSON-LD `@graph`: InsuranceAgency, Person (`/about/#joe`), WebSite (home), BreadcrumbList, Service + FAQPage (service pages), FAQPage (`/faq/`, TODO answers excluded), Article (Learn posts). |
| `inc/igj-setup.php` | `footer-legal` menu location, Learn pagination rule, Pegasus option defaults (logo, header style, parent breadcrumbs off), site icons, head cleanup. |
| `templates/` | Header override, page hero (the single H1 + breadcrumbs + CTAs), CTA band, FAQ list, service/learn cards, footer. |

### TODO placeholders
Facts not on the current site are rendered as visible yellow **TODO** badges (e.g. license
numbers, states, email). **Before launch:** fill them in `data/site.json` / `data/services.json` /
`content/`, then hide any leftovers with
`add_filter( 'igj_show_todos', '__return_false' );` (e.g. in a mu-plugin). FAQ answers containing
a TODO are left out of FAQPage schema automatically.

## SEO checklist (built in)
- One `<h1>` per template (verified on all 24 sitemap URLs + category, search, 404).
- Unique titles/descriptions (`data/site.json → seo`, `data/services.json → seo_title/seo_desc`).
- Self-referencing canonicals with trailing slashes; OG image `images/og-share.jpg` (1200×630).
- Visible breadcrumbs matching BreadcrumbList schema; related services + guides on every service page.
- Hero image eager (LCP), all others `loading="lazy"`; WebP with fallback in `<picture>`.
- No price or savings claims; government-affiliation disclaimer in footer and `/disclaimers/`.
- Accessibility: skip link, landmarks, `details/summary` FAQs, focus styles, `prefers-reduced-motion`,
  a reveal safety net for WOW.js so content is never left hidden.

## 301 redirect map (old site → new)
Add at the server (SiteGround → Site Tools → Domain → Redirects, or `.htaccess`) or with the
Redirection plugin. The old site is an Avada "Accountant" demo with one real page.

| Old URL | → New | Note |
|---|---|---|
| `http://insuranceguyjoe.com/*` | `https://insuranceguyjoe.com/$1` | Force HTTPS (http currently returns 200 with no redirect; `https://www.` already 301s to non-www) |
| `/test/` | `/contact/` | Public test page in the old sitemap |
| `/how-to-do-payroll-and-avoid-mistakes/`, `/excel-accounting-and-bookkeeping-template/`, `/small-business-accounting-101-a-guide-for-new-entrepreneurs/`, `/how-to-defer-your-2020-tax-payments/`, `/what-to-prepare-if-youre-selling-your-business/`, `/introducing-principles-to-financial-accounting/` | `/learn/` | Avada demo posts with lorem ipsum (410 Gone is also acceptable) |
| `/author/joeavena1/` | `/about/` | |
| `/category/accounting/`, `/category/resources/`, `/category/taxes/`, `/category/tools/`, `/category/trends/`, `/category/uncategorized/` | `/learn/` | Demo categories |
| `/services/accounting/`, `/services/bookkepping/`, `/services/financial/`, `/services/outsourcing/`, `/services/payroll/`, `/services/tax-services/` | `/services/` | Demo service links (currently 404) |
| `/?page_id=1099`, `/?page_id=1101`, `/?page_id=1103`, `/?page_id=2333` | `/` | Old Avada page IDs |
| `/fusion_tb_category-sitemap.xml`, `/element_category-sitemap.xml`, `/author-sitemap.xml` | (remove) | Avada/Yoast sitemaps — gone once Avada is removed; resubmit `/sitemap_index.xml` or `/wp-sitemap.xml` in Search Console |
| `/#quote-request` (old CTA anchors) | `/contact/#quote-form` | Only matters for external links |

Apache example:
```apache
RewriteEngine On
RewriteCond %{HTTPS} off [OR]
RewriteCond %{HTTP_HOST} ^www\. [NC]
RewriteRule ^ https://insuranceguyjoe.com%{REQUEST_URI} [L,R=301]
RewriteRule ^test/?$ /contact/ [L,R=301]
RewriteRule ^author/joeavena1/?$ /about/ [L,R=301]
RewriteRule ^(how-to-do-payroll-and-avoid-mistakes|excel-accounting-and-bookkeeping-template|small-business-accounting-101-a-guide-for-new-entrepreneurs|how-to-defer-your-2020-tax-payments|what-to-prepare-if-youre-selling-your-business|introducing-principles-to-financial-accounting)/?$ /learn/ [L,R=301]
RewriteRule ^category/(accounting|resources|taxes|tools|trends|uncategorized)/?$ /learn/ [L,R=301]
RewriteRule ^services/(accounting|bookkepping|financial|outsourcing|payroll|tax-services)/?$ /services/ [L,R=301]
RewriteCond %{QUERY_STRING} (^|&)page_id=(1099|1101|1103|2333)(&|$)
RewriteRule ^$ /? [L,R=301]
```

## Open Enrollment banner (home page)
Big banner above the home hero, managed in **Appearance → Customize → Open Enrollment Banner** (no code):
- **Show the banner** (on/off), **Repeat every year** (reuses the month/day of the dates), **Start date**, **End date**,
  **January 1 coverage deadline**, eyebrow, headline, dates line, body, "days left" countdown, button label/link
  (empty = Picktime), call button, text link.
- Text tokens: `{start}`, `{end}`, `{deadline}`, `{coverage_year}`, `{days_left}`.
- Defaults (`inc/igj-oe-banner.php`): Nov 1 – Jan 15, deadline Dec 15 (2027 plan year dates verified Nov 12, 2026 on
  HealthCare.gov, GeorgiaAccess.gov and GetCoveredIllinois.gov). With "Repeat every year" on, it reappears every Nov 1.
  Re-check the official dates each fall and adjust the dates in the Customizer if they change.

## Answers from Joe (email Nov 10, 2026) now on the site
- Legal entity **IGJ Solutions LLC**, brand Insurance Guy Joe / Insurance Guy Joe Solutions (DBA wording to confirm).
- Husband-and-wife team: **Joe Avena** (Licensed Health Insurance Agent, NPN 7126000, joe.avena@insuranceguyjoe.com,
  (404) 644-8072) and **Dianna Avena** (Independent Licensed Health Insurance Broker, NPN 19608869,
  dianna.avena@igjsolutions.com). Both receive contact-form leads (`lead_recipients`).
- Roswell, GA; phone & online only; no street address published.
- Licensed states from the license screenshots (`agents[].states`, `service_area`), shown with "and growing!";
  no license numbers published (Joe's preference).
- FFM-certified for 2027 + Georgia Access + Get Covered Illinois. Marketplace carriers and private programs listed as
  text (no logos; Cigna omitted until verified).
- Four-step process (Discover, Obtain, Gather, Educate), "Our Services Are Always Free to You!" + Joe's compensation wording.
- Primary CTA: "Schedule Your Free Health Insurance Consultation" (Picktime). Contact form also asks who needs coverage
  and desired effective date.
- Real photos replace the unverified old-site stock photos (hero-family / consultation / page-hero are no longer used).
- Howard Flint testimonial removed until permission is verified.

## Still open for Joe
1. Verify the final list of currently licensed states; any license numbers a state requires on the site.
2. Exact registered DBA wording; any required affiliation disclosure; compliance review of compensation + TCPA wording.
3. Years licensed and Joe & Dianna's story in their own words (how they got into insurance, family, community, languages).
4. Hours (optional); Dianna's phone number if it should be public.
5. Which carrier logos are authorized; Cigna appointment/product category.
6. Client reviews with permission, Google Business Profile and social links.
7. Privacy Policy: analytics/ads/chat tools, CRM/lead vendors, how data is stored/protected, approval date.
8. Higher-resolution / vector logo.
9. Picktime: add intake questions (ZIP, who needs coverage, desired effective date, what they're looking for).
10. At launch: remove Avada + demo content, add the redirects above, set `igj_show_todos` false, Search Console,
    Analytics, XML sitemap and appointment conversion tracking.
