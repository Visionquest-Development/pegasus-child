#!/bin/bash
# Mr Nice Guy Authentic Soul Food: one-time WordPress setup for the mrniceguy_theme child theme.
# Idempotent: safe to re-run. Usage (inside the VVV VM, after `vagrant reload --provision`):
#   bash /srv/www/mrniceguy/setup-mrniceguy-wp.sh
# Env: WP_PATH (default /srv/www/mrniceguy/public_html), WP (default "wp"), SKIP_CLONE=1 to skip the repo check.
set -euo pipefail
WP_PATH="${WP_PATH:-/srv/www/mrniceguy/public_html}"
WP="${WP:-wp}"
cd "$WP_PATH"
w() { $WP "$@"; }

# 0) Theme + plugin repos. Normally cloned on the host with `./sync/pegasus.sh setup site mrniceguy`
#    (SSH remotes). If any are missing, clone the public repo over HTTPS and point origin at SSH so
#    pushes from the host still work.
if [ -z "${SKIP_CLONE:-}" ]; then
  clone() { # url-path dir [branch]
    local repo="$1" dir="$2" branch="${3:-}"
    if [ -d "$dir/.git" ]; then echo "ok: $dir"; return; fi
    [ -e "$dir" ] && { echo "!! $dir exists but is not a git repo; leaving it alone"; return; }
    echo "cloning $repo -> $dir ${branch:+($branch)}"
    git clone -q ${branch:+-b "$branch"} "https://github.com/$repo.git" "$dir"
    git -C "$dir" remote set-url origin "git@github.com:$repo.git"
  }
  WC="$WP_PATH/wp-content"
  clone Visionquest-Development/pegasus          "$WC/themes/pegasus"
  clone Visionquest-Development/pegasus-child    "$WC/themes/pegasus-child" mrniceguy_theme
  clone Visionquest-Development/pegasus-carousel "$WC/plugins/pegasus-carousel"
  clone Visionquest-Development/pegasus-slider   "$WC/plugins/pegasus-slider"
  clone Visionquest-Development/pegasus-wow      "$WC/plugins/pegasus-wow"
  clone jimboobrien/wp-bootstrap-hooks           "$WC/plugins/wp-bootstrap-hooks"
fi

# 1) Theme, plugins, basics.
w theme activate pegasus-child
w plugin activate pegasus-carousel pegasus-slider pegasus-wow wp-bootstrap-hooks
THEME_DIR="$(w eval 'echo get_stylesheet_directory();')"
THEME_URI="$(w eval 'echo get_stylesheet_directory_uri();')"
w option update blogname "Mr Nice Guy Authentic Soul Food"
w option update blogdescription "Authentic Soul Food & BBQ. We feed EVERYBODY!"
w option update timezone_string America/New_York
w option update date_format "F j, Y"
w option update time_format "g:i a"
w rewrite structure '/%postname%/'

# 2) Pages (slug + template). mk TITLE SLUG TEMPLATE -> prints page ID
mk() {
  local title="$1" slug="$2" tpl="$3" id
  id=$(w post list --post_type=page --post_status=publish,draft,pending,private --fields=ID,post_name,post_parent --format=csv --posts_per_page=-1 | awk -F, -v s="$slug" '$2==s && $3==0 {print $1; exit}')
  if [ -z "$id" ]; then
    id=$(w post create --post_type=page --post_status=publish --post_title="$title" --post_name="$slug" --porcelain)
  else
    w post update "$id" --post_status=publish --post_title="$title" --post_name="$slug" >/dev/null
  fi
  w post meta update "$id" _wp_page_template "$tpl" >/dev/null
  echo "$id"
}
HOME_ID=$(mk "Home" home tpl_mng_home.php)
MENU_ID=$(mk "Menu" menu tpl_mng_menu.php)
ABOUT_ID=$(mk "About" about tpl_mng_about.php)
CATER_ID=$(mk "Catering" catering tpl_mng_catering.php)
EVENTS_ID=$(mk "Events" events tpl_mng_events.php)
GALLERY_ID=$(mk "Gallery" gallery tpl_mng_gallery.php)
CONTACT_ID=$(mk "Contact" contact tpl_mng_contact.php)

w option update show_on_front page
w option update page_on_front "$HOME_ID"

# Remove WP starter content (trash, not delete).
for sp in $(w post list --post_type=page --name=sample-page --field=ID --post_status=any); do w post delete "$sp" >/dev/null; done
for hw in $(w post list --post_type=post --name=hello-world --field=ID --post_status=any); do w post delete "$hw" >/dev/null; done

# 3) Main menu on Primary (rebuilt every run so it always matches).
w menu list --fields=name --format=json | grep -q '"name":"Main"' || w menu create Main >/dev/null
for i in $(w menu item list Main --fields=db_id --format=csv | tail -n +2); do w menu item delete "$i" >/dev/null; done
for pair in "$HOME_ID|Home" "$MENU_ID|Menu" "$CATER_ID|Catering" "$EVENTS_ID|Events" "$ABOUT_ID|About" "$GALLERY_ID|Gallery" "$CONTACT_ID|Contact"; do
  w menu item add-post Main "${pair%%|*}" --title="${pair#*|}" >/dev/null
done
w menu location assign Main primary

# 4) Import the theme's photos + logo into the Media Library (skips files already imported).
import_img() { # slug ext alt
  local slug="$1" ext="$2" alt="$3" id
  id=$(w post list --post_type=attachment --post_status=inherit --name="mng-$slug" --field=ID --posts_per_page=1 2>/dev/null | head -1)
  if [ -z "$id" ]; then
    id=$(w media import "$THEME_DIR/images/$slug.$ext" --title="mng-$slug" --alt="$alt" --porcelain)
    w post update "$id" --post_name="mng-$slug" >/dev/null
  fi
  echo "$id"
}
w eval '
$d = json_decode( file_get_contents( get_stylesheet_directory() . "/data/images.json" ), true );
foreach ( $d as $slug => $m ) { if ( "og-share" === $slug ) continue; echo $slug . "\t" . ( $m["ext"] ?? "jpg" ) . "\t" . $m["alt"] . "\n"; }
' > /tmp/mng-images.tsv
LOGO_ID=""
while IFS=$'\t' read -r slug ext alt; do
  [ -z "$slug" ] && continue
  id=$(import_img "$slug" "$ext" "$alt")
  [ "$slug" = "mng-logo" ] && LOGO_ID="$id"
done < /tmp/mng-images.tsv
LOGO_URL=""
[ -n "$LOGO_ID" ] && LOGO_URL="$(w eval "echo wp_get_attachment_url( $LOGO_ID );")"
[ -z "$LOGO_URL" ] && LOGO_URL="$THEME_URI/images/mng-logo.png"

# 5) Pegasus Options (CMB2 option "pegasus_options"): merged, so anything set in wp-admin survives.
LOGO_URL="$LOGO_URL" LOGO_ID="$LOGO_ID" THEME_URI="$THEME_URI" w eval '
$o = get_option( "pegasus_options", array() );
if ( ! is_array( $o ) ) { $o = array(); }
$set = array(
	"logo"                            => getenv( "LOGO_URL" ),
	"logo_id"                         => (int) getenv( "LOGO_ID" ),
	"favicon"                         => getenv( "THEME_URI" ) . "/images/icon-32.png",
	"header_select"                   => "header-one",
	"global_nav_viewport_break"       => "navbar-expand-lg",
	"global_additional_header_option" => "no-header",
	"header_sticky_checkbox"          => "off",
	"bread_chk"                       => "off",
	"back_to_top"                     => "on",
	"footer_widget_areas"             => "0",
	"footer_copy_textareacode"        => "<p class=\"copyright\">&copy; " . gmdate( "Y" ) . " Mr Nice Guy Authentic Soul Food &amp; BBQ &middot; Marietta, GA &middot; We feed EVERYBODY!</p>",
);
update_option( "pegasus_options", array_merge( $o, $set ) );
echo "pegasus_options updated (" . count( $set ) . " keys)\n";
'

w rewrite flush --hard 2>/dev/null || w rewrite flush

echo "--- verify"
w theme list --status=active --fields=name,version
w plugin list --status=active --fields=name
w option get blogname; w option get timezone_string; w option get permalink_structure
echo "front=$(w option get page_on_front)"
w post list --post_type=page --fields=ID,post_name,page_template
w menu list --fields=name,locations,count
echo "media: $(w post list --post_type=attachment --post_status=inherit --format=count) attachments"
w eval '$o = get_option( "pegasus_options" ); echo "logo=" . ( $o["logo"] ?? "" ) . "\nheader=" . ( $o["header_select"] ?? "" ) . "\n";'
