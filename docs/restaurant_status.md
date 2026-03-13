# Toast API — Restaurant Status

Last verified: 2026-03-13

## API Credentials

- **Client ID:** `E9m21eTJQF49o3hmS5N9FxXMdahs03Tu`
- **Hostname:** `https://ws-api.toasttab.com`

## Connected Restaurants

| Restaurant | GUID | Menus V2 | Menus V3 | Orders | Stock |
|---|---|---|---|---|---|
| Mabellas | `2e40ad16-2a18-4285-a2b5-4f20dbad029e` | OK | OK (rate limited during batch test) | OK | OK |
| Tommy G's | `ac0db789-cf8a-4dd8-9eb7-39b290c23cd5` | OK | OK (rate limited during batch test) | OK | OK |
| The Mix | `b88fa695-016d-47f8-bd9a-0d57feeecd47` | OK | OK (rate limited during batch test) | OK | OK |
| Saltcellar | `78ca0aed-6d3e-4335-938c-776609689f54` | OK | 403 Forbidden | OK | OK |
| The Loft | `ba52c07a-225d-406c-be37-215c844188f7` | OK | OK (rate limited during batch test) | OK | OK |

### Notes

- **Menus V3** returned 429 (rate limited) on 4 of 5 restaurants when tested back-to-back. This indicates access is granted but the rate limit was hit. Saltcellar returned 403, suggesting V3 is not yet enabled there.
- **Menus V2** is used in all current theme integrations (V3 requires Partners API access level and may have stricter rate limits).
- **Orders API** returned data for all 5 restaurants. Example: Mabellas had 72 orders on 2026-03-12.

## Theme Integration Status

Each integration includes: Toast menu functions in `functions.php`, updated `menu-tabs.php` and `menu-mobile.php` templates (image/lightbox/OOS support), Lightbox2 CSS/JS, `tpl_test_toast_menu.php` page template, and a `[toast_menu]` shortcode.

| Restaurant | VVV Site Directory | Plugin Installed | Theme Integration | Test Page |
|---|---|---|---|---|
| Mabellas | `www/mabellas` | Yes (active) | Yes | Yes (tpl_test_toast_menu.php) |
| Tommy G's | `www/tommygs` | Yes (active) | Yes | Yes (tpl_test_toast_menu.php) |
| The Mix | `www/mixmarket` | Yes (active) | Yes | Yes (tpl_test_toast_menu.php) |
| Saltcellar | `www/saltcellar` | No | No | No |
| The Loft | `www/theloftnew` | Yes (not integrated) | No | No |

### Integration Includes

- **functions.php**: `vqdev_toast_get_oos_guids()`, `vqdev_toast_menu_has_changed()`, `vqdev_toast_get_menu_data()`, `vqdev_toast_transform_group()`, `vqdev_toast_transform_item()`, `vqdev_toast_menu_shortcode()`, Lightbox2 enqueue
- **templates/menu-tabs.php**: Image with lightbox, OOS badge + dimming, "Options" label for SIZE_PRICE items
- **templates/menu-mobile.php**: Same as above for mobile layout
- **style.css**: `.vqmenu-card__img`, `.vqmenu-mobile-card__img`, `[data-lightbox]` hover, `.vqmenu-card--oos` / `.vqmenu-mobile-card--oos` dimming + grayscale, `.vqmenu-oos-badge`
- **css/lightbox.min.css**: Self-contained Lightbox2 v2.11.4 (inline SVG icons, no external images)
- **js/lightbox.min.js**: Lightbox2 v2.11.4
- **Smart caching**: Metadata V2 endpoint polled every 10 min for change detection; full menu cached 24hr as safety net; stock cached 5 min
