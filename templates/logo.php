<?php
/**
 * Rene Catherine Design — logo.
 *
 * Inline SVG wrapper around the brand mark. The source artwork has been trimmed
 * to its content bounds ( assets/logo.png, 1010 x 674 ) so the logo sits flush
 * against the top and bottom edges of the canvas — no empty space above/below.
 *
 * Sizing is handled in style.css ( #logo svg { width:100%; } ), so this scales
 * to whatever the header wrapper sets ( currently #logo { width:100px } ).
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<svg class="rc-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1010 674" role="img" aria-labelledby="rc-logo-title" preserveAspectRatio="xMidYMid meet">
	<title id="rc-logo-title">Rene Catherine Design</title>
	<image href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/logo.png' ); ?>" xlink:href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/logo.png' ); ?>" x="0" y="0" width="1010" height="674"/>
</svg>
