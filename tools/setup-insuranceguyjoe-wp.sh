#!/bin/bash
# Insurance Guy Joe: one-time WordPress setup for the insuranceguyjoe_theme child theme.
# Idempotent: safe to re-run. Usage (inside the VVV VM):
#   bash /srv/www/insuranceguyjoe/setup-insuranceguyjoe-wp.sh
# Env: WP_PATH (default /srv/www/insuranceguyjoe/public_html), WP (default "wp").
set -euo pipefail
WP_PATH="${WP_PATH:-/srv/www/insuranceguyjoe/public_html}"
WP="${WP:-wp}"
cd "$WP_PATH"
w() { $WP "$@"; }

THEME_DIR="$(w eval 'echo get_theme_root() . "/pegasus-child";')"
w theme activate pegasus-child
w plugin activate pegasus-carousel pegasus-slider pegasus-wow wp-bootstrap-hooks
w option update blogname "Insurance Guy Joe"
w option update blogdescription "Affordable health coverage, explained by a real person"
w option update timezone_string America/New_York
w rewrite structure '/learn/%postname%/'

# mk TITLE SLUG TEMPLATE PARENT_ID [CONTENT_FILE]  -> prints page ID
mk() {
  local title="$1" slug="$2" tpl="$3" parent="${4:-0}" file="${5:-}" id
  # Look up by slug + parent across all statuses (WP_Query's "name" misses drafts such as WP's default Privacy Policy).
  id=$(w post list --post_type=page --post_status=publish,draft,pending,private --fields=ID,post_name,post_parent --format=csv --posts_per_page=-1 | awk -F, -v s="$slug" -v p="$parent" '$2==s && $3==p {print $1; exit}')
  if [ -z "$id" ]; then
    id=$(w post create --post_type=page --post_status=publish --post_title="$title" --post_name="$slug" --post_parent="$parent" --porcelain)
  else
    w post update "$id" --post_status=publish --post_title="$title" --post_name="$slug" --post_parent="$parent" >/dev/null
  fi
  if [ -n "$file" ] && [ -f "$file" ]; then
    w post update "$id" "$file" >/dev/null
  fi
  if [ -n "$tpl" ]; then w post meta update "$id" _wp_page_template "$tpl" >/dev/null; fi
  echo "$id"
}

HOME_ID=$(mk "Home" home tpl_igj_home.php)
SERV_ID=$(mk "Services" services tpl_igj_services.php)
declare -A SVC
for row in \
  "individual-family-health-insurance|Individual & Family Health Insurance" \
  "self-employed-health-insurance|Self-Employed Health Insurance" \
  "small-business-health-insurance|Small Business Health Insurance" \
  "travel-nurse-health-insurance|Travel Nurse Health Insurance" \
  "realtor-health-insurance|Realtor Health Insurance" \
  "early-retiree-health-insurance|Early Retiree Health Insurance" \
  "turning-26-health-insurance|Turning 26 Health Insurance" \
  "private-health-insurance|Private Health Insurance" \
  "aca-marketplace-health-insurance|ACA Marketplace Health Insurance" \
  "cobra-alternatives|COBRA Alternatives" \
  "health-insurance-for-1099|Health Insurance for 1099 Workers" \
  "supplemental-insurance|Supplemental Insurance"; do
  slug="${row%%|*}"; title="${row#*|}"
  SVC[$slug]=$(mk "$title" "$slug" tpl_igj_service.php "$SERV_ID")
done
SVC[dental-vision-insurance]=$(mk "Dental & Vision Insurance" dental-vision-insurance tpl_igj_service.php "${SVC[supplemental-insurance]}")
LEARN_ID=$(mk "Learn" learn "" 0)
w post meta delete "$LEARN_ID" _wp_page_template >/dev/null 2>&1 || true
FAQ_ID=$(mk "FAQs" faq tpl_igj_faq.php)
ABOUT_ID=$(mk "About" about tpl_igj_about.php)
CONTACT_ID=$(mk "Contact" contact tpl_igj_contact.php)
PRIV_ID=$(mk "Privacy Policy" privacy-policy tpl_igj_legal.php 0 "$THEME_DIR/content/legal/privacy-policy.html")
DISC_ID=$(mk "Disclaimers" disclaimers tpl_igj_legal.php 0 "$THEME_DIR/content/legal/disclaimers.html")
w option update wp_page_for_privacy_policy "$PRIV_ID"

w option update show_on_front page
w option update page_on_front "$HOME_ID"
w option update page_for_posts "$LEARN_ID"

# Remove WP's starter content (trash, not delete) so it doesn't show up at /learn/hello-world/ or /sample-page/.
for sp in $(w post list --post_type=page --name=sample-page --field=ID --post_status=any); do w post delete "$sp" >/dev/null; done
for hw in $(w post list --post_type=post --name=hello-world --field=ID --post_status=any); do w post delete "$hw" >/dev/null; done

# Learn articles (posts) from the theme's content/learn/*.html seeds.
cat_id() { local n="$1" id; id=$(w term list category --name="$n" --field=term_id | head -1); [ -z "$id" ] && id=$(w term create category "$n" --porcelain); echo "$id"; }
mkpost() { # slug title excerpt category date
  local id file="$THEME_DIR/content/learn/$1.html" cid
  cid=$(cat_id "$4")
  id=$(w post list --post_type=post --post_status=publish,draft,pending,private --fields=ID,post_name --format=csv --posts_per_page=-1 | awk -F, -v s="$1" '$2==s {print $1; exit}')
  if [ -z "$id" ]; then
    id=$(w post create "$file" --post_type=post --post_status=publish --post_title="$2" --post_name="$1" --post_excerpt="$3" --post_date="$5" --post_category="$cid" --porcelain)
  else
    w post update "$id" "$file" --post_title="$2" --post_excerpt="$3" --post_category="$cid" >/dev/null
  fi
  echo "$id"
}
w eval '
$d = json_decode( file_get_contents( get_stylesheet_directory() . "/content/learn.json" ), true );
foreach ( $d["posts"] as $p ) { echo implode( "\t", array( $p["slug"], $p["title"], $p["excerpt"], $p["category"], $p["date"] ) ) . "\n"; }
' > /tmp/igj-learn.tsv
while IFS=$'\t' read -r slug title excerpt cat date; do
  [ -n "$slug" ] && mkpost "$slug" "$title" "$excerpt" "$cat" "$date" >/dev/null
done < /tmp/igj-learn.tsv
# Remove "Uncategorized" from the Learn posts if it was added by default.
UNC=$(w term list category --slug=uncategorized --field=term_id | head -1)
for pid in $(w post list --post_type=post --field=ID); do w post term remove "$pid" category uncategorized >/dev/null 2>&1 || true; done

# Main menu with a Services dropdown on Primary.
w menu list --fields=name --format=json | grep -q "\"name\":\"Main\"" || w menu create Main >/dev/null
# Rebuild items every run so the menu always matches the sitemap (idempotent).
for i in $(w menu item list Main --fields=db_id --format=csv | tail -n +2); do w menu item delete "$i" >/dev/null; done
if true; then
  w menu item add-post Main "$HOME_ID" --title="Home" >/dev/null
  SITEM=$(w menu item add-post Main "$SERV_ID" --title="Services" --porcelain)
  for slug in individual-family-health-insurance self-employed-health-insurance health-insurance-for-1099 small-business-health-insurance realtor-health-insurance travel-nurse-health-insurance early-retiree-health-insurance turning-26-health-insurance aca-marketplace-health-insurance private-health-insurance cobra-alternatives supplemental-insurance dental-vision-insurance; do
    w menu item add-post Main "${SVC[$slug]}" --parent-id="$SITEM" >/dev/null
  done
  w menu item add-post Main "$LEARN_ID" --title="Learn" >/dev/null
  w menu item add-post Main "$FAQ_ID" --title="FAQs" >/dev/null
  w menu item add-post Main "$ABOUT_ID" --title="About" >/dev/null
  w menu item add-post Main "$CONTACT_ID" --title="Contact" >/dev/null
fi
w menu location assign Main primary

# Footer legal menu (theme registers the footer-legal location).
w menu list --fields=name --format=json | grep -q "\"name\":\"Footer Legal\"" || w menu create "Footer Legal" >/dev/null
for i in $(w menu item list "Footer Legal" --fields=db_id --format=csv | tail -n +2); do w menu item delete "$i" >/dev/null; done
if true; then
  w menu item add-post "Footer Legal" "$PRIV_ID" >/dev/null
  w menu item add-post "Footer Legal" "$DISC_ID" >/dev/null
fi
w menu location assign "Footer Legal" footer-legal

w rewrite flush --hard 2>/dev/null || w rewrite flush

echo "--- verify"
w theme list --status=active --fields=name,version
w plugin list --status=active --fields=name
w option get blogname; w option get timezone_string; w option get permalink_structure
echo "front=$(w option get page_on_front) posts=$(w option get page_for_posts)"
w post list --post_type=page --fields=ID,post_name,post_parent,page_template --orderby=menu_order
w post list --post_type=post --fields=ID,post_name,post_status
w menu list --fields=name,locations,count
