<?php
/**
 * Site logo — Sugar Peddler bread-cart wordmark (transparent PNG).
 *
 * Rendered inside the header's .navbar-brand link. The background of the
 * source artwork has been removed, so only the cart illustration and the
 * "Sugar Peddler / Bistro & Bakery" wording show.
 *
 * @package pegasus-child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$sp_logo_path = get_stylesheet_directory() . '/images/sugarpeddler-logo.png';
$sp_logo_uri  = get_stylesheet_directory_uri() . '/images/sugarpeddler-logo.png';

// filemtime cache-buster so logo swaps show immediately.
if ( is_readable( $sp_logo_path ) ) {
	$sp_logo_uri = add_query_arg( 'v', filemtime( $sp_logo_path ), $sp_logo_uri );
}
?>
<img id="logo" class="sp-site-logo"
	src="<?php echo esc_url( $sp_logo_uri ); ?>"
	width="700" height="406"
	alt="Sugar Peddler &mdash; Bistro &amp; Bakery"
	decoding="async" />
