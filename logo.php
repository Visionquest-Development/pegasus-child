<?php
/**
 * Elliot Integration wordmark, rendered as an inline SVG.
 *
 * Taken from the Claude Design header lockup: "Elliot" in Spectral, followed by
 * "Integration" in gold IBM Plex Mono. "Elliot" is filled with currentColor so
 * it inherits the surrounding header text colour (dark on a light header, light
 * on a dark one); "Integration" uses the brand gold. All type styling lives in
 * style.css ( .elliot-logo* ) — the fonts are enqueued site-wide by the child
 * theme.
 *
 * Included via get_template_part( 'logo' ).
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<svg class="elliot-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 170 30" role="img" aria-label="Elliot Integration" preserveAspectRatio="xMinYMid meet" focusable="false">
	<title>Elliot Integration</title>
	<text class="elliot-logo__name" x="0" y="23">Elliot</text>
	<text class="elliot-logo__sub" x="68" y="23">INTEGRATION</text>
</svg>
