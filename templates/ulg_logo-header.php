<?php
$ulg_logo_markup = '';
ob_start();
get_template_part( 'templates/ulg_logo' );
$ulg_logo_markup = ob_get_clean();

if ( is_string( $ulg_logo_markup ) && '' !== $ulg_logo_markup ) {
	echo preg_replace( '/<svg\b/', '<svg id="logo"', $ulg_logo_markup, 1 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

