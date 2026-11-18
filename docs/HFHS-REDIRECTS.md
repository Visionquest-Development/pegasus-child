# HFHS — 301 redirects for launch (.htaccess)

Old hfhsgeorgia.com (Divi) URLs mapped to the new Pegasus site. Paste the block into
the site's root `.htaccess` **above** the `# BEGIN WordPress` block (WordPress rewrites
everything between `# BEGIN WordPress` / `# END WordPress`, so don't put it inside).

Each rule matches the path with or without the trailing slash (`/?$`), is
case-insensitive (`[NC]`), and keeps any query string (e.g. `?utm_source=…`).

## Required (from Josh's list)

```apache
# BEGIN HFHS redirects
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule ^about-us/?$                        /about/                    [R=301,L,NC]
RewriteRule ^contact-us/?$                      /contact/                  [R=301,L,NC]
RewriteRule ^decking-services/?$                /services/decking/         [R=301,L,NC]
# GUESS: sauna has no page of its own; it's a Custom Projects build
RewriteRule ^outdoor-dry-sauna/?$               /services/custom-projects/ [R=301,L,NC]
RewriteRule ^gutters-landing-page/?$            /services/gutters/         [R=301,L,NC]
# GUESS: no property-managers page on the new site, so send to the homepage
RewriteRule ^property-managers-landing-page/?$  /                          [R=301,L,NC]
# GUESS: on the live site this URL is the contact form's "Thank You" page, not a privacy page.
# Create the /thank-you/ page (Thank You Template) first, or point this at /privacy-policy/.
RewriteRule ^privacy-policy-duplicate/?$        /thank-you/                [R=301,L,NC]
</IfModule>
# END HFHS redirects
```

| Old URL | New URL | Note |
|---|---|---|
| /about-us/ | /about/ | |
| /contact-us/ | /contact/ | |
| /decking-services/ | /services/decking/ | |
| /outdoor-dry-sauna/ | /services/custom-projects/ | **Guess** |
| /gutters-landing-page/ | /services/gutters/ | |
| /property-managers-landing-page/ | / | **Guess** |
| /privacy-policy-duplicate/ | /thank-you/ | **Guess**: live page title is "Thank You" |

## Optional: old top-level service URLs

The old site had services at the root (`/gutters/`); the new site nests them under
`/services/`. WordPress will often guess these on its own, but explicit 301s are
safer for SEO. Add inside the same `<IfModule>` block if wanted:

```apache
# HFHS optional: old top-level service slugs
RewriteRule ^gutters/?$           /services/gutters/          [R=301,L,NC]
RewriteRule ^fencing/?$           /services/fencing/          [R=301,L,NC]
RewriteRule ^exterior-repairs/?$  /services/exterior-repairs/ [R=301,L,NC]
RewriteRule ^roofing/?$           /services/roofing/          [R=301,L,NC]
RewriteRule ^tree-services/?$     /services/tree-services/    [R=301,L,NC]
```

Only add these if no new page uses those top-level slugs (otherwise it would redirect away from a real page).

## Check after deploying

```bash
for u in about-us contact-us decking-services outdoor-dry-sauna gutters-landing-page \
         property-managers-landing-page privacy-policy-duplicate; do
  curl -sI "https://hfhsgeorgia.com/$u" | grep -iE '^(HTTP|location)'
done
```

Each should return `301` with the new `Location`. On SiteGround, also purge the
SuperCacher/Dynamic cache after editing `.htaccess`.
