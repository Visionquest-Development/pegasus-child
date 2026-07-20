<?php
/**
 * Landing-page section navigation.
 *
 * On the landing-page templates (Pegasus Home now, Documentation later) the
 * theme's existing "primary" menu — wherever it renders, including the sidebar
 * nav — has its links replaced with on-page section anchors. The theme's own
 * markup, styling and scrollspy are reused; only the <li> links are swapped.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Section anchor links for the current landing-page template.
 *
 * Return an empty array for any template that should keep its normal menu.
 *
 * @return array[] List of array( 'id' => section id, 'label' => link text ).
 */
function pegasus_landing_section_links() {
	if ( is_page_template( 'tpl_home_pegasus.php' ) ) {
		return array(
			array( 'id' => 'home',     'label' => __( 'Home', 'pegasus-child' ) ),
			array( 'id' => 'overview', 'label' => __( 'Overview', 'pegasus-child' ) ),
			array( 'id' => 'install',  'label' => __( 'Install', 'pegasus-child' ) ),
			array( 'id' => 'plugins',  'label' => __( 'Plugins', 'pegasus-child' ) ),
			array( 'id' => 'docs',     'label' => __( 'Docs', 'pegasus-child' ) ),
		);
	}

	// Documentation template: section anchors come from the docs JSON so the
	// sidebar/primary nav always matches the page content.
	if ( is_page_template( 'tpl_docs.php' ) && function_exists( 'pegasus_docs_sections' ) ) {
		$links = array();
		foreach ( pegasus_docs_sections() as $section ) {
			if ( empty( $section['id'] ) ) {
				continue;
			}
			$links[] = array(
				'id'    => $section['id'],
				'label' => isset( $section['title'] ) ? $section['title'] : $section['id'],
			);
		}
		return $links;
	}

	/**
	 * Allow other code to supply section links for a template.
	 *
	 * @param array $links Existing links (empty by default off the landing pages).
	 */
	return apply_filters( 'pegasus_landing_section_links', array() );
}

/**
 * Build the <li> markup for the section links.
 *
 * @return string
 */
function pegasus_landing_section_items_markup() {
	$links = pegasus_landing_section_links();
	if ( empty( $links ) ) {
		return '';
	}

	$out = '';
	foreach ( $links as $link ) {
		if ( empty( $link['id'] ) ) {
			continue;
		}
		$out .= sprintf(
			'<li class="menu-item nav-item"><a class="nav-link" href="#%1$s">%2$s</a></li>',
			esc_attr( $link['id'] ),
			esc_html( isset( $link['label'] ) ? $link['label'] : '' )
		);
	}
	return $out;
}

/**
 * Swap the primary menu's items for the section anchors.
 *
 * Fires when a menu is assigned to the "primary" location, so the theme's own
 * <ul> id/classes (and therefore its scrollspy + styling) are preserved.
 *
 * @param string   $items Concatenated menu item HTML.
 * @param stdClass $args  wp_nav_menu args.
 * @return string
 */
function pegasus_filter_primary_nav_items( $items, $args ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $items;
	}
	$section_items = pegasus_landing_section_items_markup();
	return $section_items ? $section_items : $items;
}
add_filter( 'wp_nav_menu_items', 'pegasus_filter_primary_nav_items', 10, 2 );

/**
 * Fallback for when no menu is assigned to "primary": build the whole menu so
 * the section anchors still appear. When a menu IS assigned we bail and let
 * pegasus_filter_primary_nav_items() handle it (preserving the theme markup).
 *
 * @param string|null $output Short-circuit output (null to proceed normally).
 * @param stdClass    $args   wp_nav_menu args.
 * @return string|null
 */
function pegasus_prefilter_primary_nav( $output, $args ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $output;
	}
	if ( has_nav_menu( 'primary' ) ) {
		return $output; // Let the items filter handle it, preserving theme markup.
	}
	$section_items = pegasus_landing_section_items_markup();
	if ( ! $section_items ) {
		return $output;
	}

	$menu_class = isset( $args->menu_class ) ? trim( (string) $args->menu_class ) : '';
	$ul         = sprintf( '<ul class="%1$s pegasus-section-menu">%2$s</ul>', esc_attr( trim( $menu_class . ' menu' ) ), $section_items );

	if ( ! empty( $args->container ) ) {
		$container_class = ! empty( $args->container_class ) ? ' class="' . esc_attr( $args->container_class ) . '"' : '';
		$ul              = sprintf( '<%1$s%2$s>%3$s</%1$s>', tag_escape( $args->container ), $container_class, $ul );
	}

	return $ul;
}
add_filter( 'pre_wp_nav_menu', 'pegasus_prefilter_primary_nav', 10, 2 );


/**
 * Output the sidebar CTA (Home / Demo buttons + Documentation link) into a
 * <template>. pegasus-custom.js clones it into the sidebar's .nav-sidebar-widget
 * (only present in the header_five sidebar layout), so it sits at the bottom of
 * the sidebar nav without forking the parent header template.
 */
function pegasus_sidebar_cta_template() {
	$home = home_url( '/' );
	$demo = function_exists( 'pegasus_demo_page_url' ) ? pegasus_demo_page_url() : '';
	$docs = function_exists( 'pegasus_docs_page_url' ) ? pegasus_docs_page_url() : '';
	?>
	<template id="pg-sidebar-cta-tpl">
		<div class="pg-sidebar-cta">
			<div class="pg-sidebar-cta-row">
				<a class="pg-cta-btn" href="<?php echo esc_url( $home ); ?>">
					<i class="fa fa-home" aria-hidden="true"></i><span><?php esc_html_e( 'Home', 'pegasus-child' ); ?></span>
				</a>
				<a class="pg-cta-btn" href="<?php echo esc_url( $demo ? $demo : '#' ); ?>">
					<i class="fa fa-th-large" aria-hidden="true"></i><span><?php esc_html_e( 'Demo', 'pegasus-child' ); ?></span>
				</a>
			</div>
			<a class="pg-cta-docs" href="<?php echo esc_url( $docs ? $docs : '#' ); ?>">
				<i class="fa fa-book" aria-hidden="true"></i><span><?php esc_html_e( 'Documentation', 'pegasus-child' ); ?></span>
			</a>
			<a class="pg-cta-docs" href="https://github.com/Visionquest-Development" target="_blank" rel="noopener">
				<i class="fa fa-github" aria-hidden="true"></i><span><?php esc_html_e( 'GitHub', 'pegasus-child' ); ?></span>
			</a>
		</div>
	</template>
	<?php
}
add_action( 'wp_footer', 'pegasus_sidebar_cta_template' );
