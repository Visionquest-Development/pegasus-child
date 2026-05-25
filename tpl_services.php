<?php
/*
	Template Name: Gen2 - Services Inner Page
*/

/**
 * Port of the React "Services" inner page from the Claude Design handoff
 * (variants/inner-pages.jsx → ServicesPage). All styling lives in
 * style.css; this template only emits semantic markup.
 */

require_once get_stylesheet_directory() . '/inc/gen2-design.php';

get_header();

// Parent theme's header.php only auto-loads additional_header when the
// header choice is NOT header-three / header-four. Page templates that use
// header-three (the one we're shipping the Gen2 SVG logo through) must
// include it explicitly — mirrors what tpl_page-full-width.php in the
// parent does.
$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div class="gen2 gen2-services-page">

	<?php /*
	────────── NAV ──────────
	Bespoke services-page nav. Disabled — the site-wide nav comes from
	get_header() (parent theme's templates/header_three.php in the child).
	<div class="gen2-svc-nav">
		<?php gen2_mark( 'light', 1.05 ); ?>
		<nav class="gen2-svc-nav__menu sans">
			<?php foreach ( array( 'Services', 'Capabilities', 'Work', 'About', 'Contact' ) as $label ) : ?>
				<a class="gen2-svc-nav__link" href="#"><?php echo esc_html( $label ); ?></a>
			<?php endforeach; ?>
		</nav>
		<a class="gen2-svc-nav__cta sans" href="#">Request Quote</a>
	</div>
	*/ ?>

	<?php
	$svc_page_title = gen2_meta( 'gen2_svc_page_title', "We design it.<br>We build it.<br><em>We make it run.</em>" );
	$svc_page_intro = gen2_meta( 'gen2_svc_page_intro', "Four practice areas. One team that doesn't subcontract. The same engineer who designs your control system signs off on the panel and stands on your plant floor at run-off." );

	// Pull the services list from the homepage's CMB2 repeater so the client
	// edits services in one place. Falls back to a small static set if no
	// homepage has been configured yet (e.g. fresh install).
	$svc_source_id = gen2_get_homepage_id();
	$svc_cards     = $svc_source_id ? get_post_meta( $svc_source_id, 'gen2_services_cards', true ) : array();
	if ( ! is_array( $svc_cards ) || empty( $svc_cards ) ) {
		$svc_cards = array(
			array( 'card_code' => 'S-AUT', 'card_title' => 'Automation Consulting', 'card_description' => 'Concept systems, ROI modeling, throughput audits.', 'card_bullets' => "<ul><li>Concept Systems</li><li>Level-2 Type Systems</li><li>Feasibility Studies</li><li>Plant-Floor Audits</li></ul>" ),
			array( 'card_code' => 'S-CTL', 'card_title' => 'Process Control',       'card_description' => 'CODESYS-native control systems in OOP/ST.',         'card_bullets' => "<ul><li>CODESYS · OOP/ST</li><li>PLC Architecture</li><li>Motion Control</li><li>HMI / SCADA</li></ul>" ),
			array( 'card_code' => 'S-PNL', 'card_title' => 'Panel Fabrication',     'card_description' => 'UL-508A panels designed and built in Tigard.',      'card_bullets' => "<ul><li>UL-508A Listed</li><li>MCC / Distribution</li><li>VFD Integration</li><li>Wire &amp; Test</li></ul>" ),
		);
	}
	$svc_cards = array_values( array_filter( $svc_cards, function( $c ) {
		$t = isset( $c['card_title'] ) ? trim( (string) $c['card_title'] ) : '';
		$c2 = isset( $c['card_code'] )  ? trim( (string) $c['card_code'] )  : '';
		return ( '' !== $t || '' !== $c2 );
	} ) );
	?>

	<!-- ────────── HERO ────────── -->
	<section class="gen2-svc-hero">
		<div class="gen2-svc-hero__eyebrow mono">
			&#9656; SERVICES &middot; GEN2 AUTOMATION
		</div>
		<div class="gen2-svc-hero__main">
			<h1 class="gen2-svc-hero__title news">
				<?php echo wp_kses_post( $svc_page_title ); ?>
			</h1>
			<div class="gen2-svc-hero__intro sans">
				<?php gen2_render_wysiwyg( $svc_page_intro ); ?>
			</div>
		</div>
	</section>

	<!-- ────────── ANCHOR MENU ────────── -->
	<section class="gen2-svc-anchor">
		<div class="gen2-svc-anchor__row">
			<?php foreach ( $svc_cards as $i => $c ) :
				$num   = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT );
				$title = isset( $c['card_title'] ) ? $c['card_title'] : '';
				?>
				<a class="gen2-svc-anchor__link" href="#svc-<?php echo esc_attr( $num ); ?>">
					<span class="gen2-svc-anchor__num mono"><?php echo esc_html( $num ); ?></span>
					<span class="gen2-svc-anchor__label sans"><?php echo esc_html( $title ); ?></span>
					<span class="gen2-svc-anchor__arrow">&darr;</span>
				</a>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- ────────── SERVICE BLOCKS ────────── -->
	<?php foreach ( $svc_cards as $idx => $c ) :
		$num       = str_pad( (string) ( $idx + 1 ), 2, '0', STR_PAD_LEFT );
		$code      = isset( $c['card_code'] )        ? $c['card_code']        : '';
		$title     = isset( $c['card_title'] )       ? $c['card_title']       : '';
		$lead      = isset( $c['card_description'] ) ? $c['card_description'] : '';
		$bullets   = isset( $c['card_bullets'] )     ? $c['card_bullets']     : '';
		$block_mod = ( 0 === $idx % 2 ) ? 'gen2-svc-block--even' : 'gen2-svc-block--odd';
		// Cycle through the four schematic illustrations regardless of count.
		$media_idx = $idx % 4;
		?>
		<section id="svc-<?php echo esc_attr( $num ); ?>" class="gen2-svc-block <?php echo esc_attr( $block_mod ); ?>">
			<div class="gen2-svc-block__head">
				<div>
					<div class="gen2-svc-block__doc mono">
						&sect;&nbsp;<?php echo esc_html( $num ); ?><?php if ( $code ) : ?>&nbsp;&middot;&nbsp;<?php echo esc_html( $code ); ?><?php endif; ?>
					</div>
					<h2 class="gen2-svc-block__title news"><?php echo esc_html( $title ); ?></h2>
				</div>
				<?php if ( $lead ) : ?>
					<div>
						<p class="gen2-svc-block__lead news"><?php echo esc_html( $lead ); ?></p>
					</div>
				<?php endif; ?>
			</div>
			<div class="gen2-svc-block__body">
				<div class="gen2-svc-block__bullets gen2-svc-block__bullets--list">
					<?php gen2_render_wysiwyg( $bullets ); ?>
				</div>
				<div class="gen2-svc-block__media <?php echo ( 3 === $media_idx ) ? 'gen2-svc-block__media--codesys' : ''; ?>">
					<?php
					if ( 0 === $media_idx ) {
						gen2_schematic_flow( 'gen2-svg--on-dark-300' );
					} elseif ( 1 === $media_idx ) {
						gen2_schematic_arm( 'gen2-svg--on-dark-300' );
					} elseif ( 2 === $media_idx ) {
						gen2_schematic_panel( 'gen2-svg--on-dark-300' );
					} else {
						gen2_codesys_mark( 'light', 1.3 );
						?>
						<div class="gen2-svc-block__media-caption mono">AUTHORIZED APPLICATION PARTNER &middot; SINCE 2014</div>
					<?php } ?>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

	<!-- ────────── CTA ────────── -->
	<section class="gen2-svc-cta">
		<div class="gen2-svc-cta__main">
			<h2 class="gen2-svc-cta__title news">
				Not sure which service <em>fits your project</em>?
			</h2>
			<div>
				<p class="gen2-svc-cta__lead sans">
					Most engagements start with a phone call and a short scoping session. We'll tell you honestly if we're not the right fit.
				</p>
				<a class="gen2-svc-cta__btn sans" href="#">
					Schedule a Call &rarr;
				</a>
			</div>
		</div>
	</section>

	<?php /*
	────────── FOOTER ──────────
	Bespoke services-page footer. Disabled — the site-wide footer comes
	from get_footer() (parent theme's footer.php).
	<footer class="gen2-svc-footer">
		<div class="gen2-svc-footer__cols">
			<div>
				<?php gen2_mark( 'dark', 1.2 ); ?>
				<p class="gen2-svc-footer__about sans">
					Gen2 Automation LLC &middot; Industrial automation, control systems, and panel fabrication.
				</p>
			</div>
			<?php
			$cols = array(
				array( 'Services', array( 'Automation Consulting', 'Process Control', 'Panel Fabrication', 'CODESYS Training' ) ),
				array( 'Company',  array( 'About', 'Work', 'Careers', 'Contact' ) ),
				array( 'Office',   array( '7124 SW Hampton St', 'Tigard, OR 97223', '(503) 555-0142', 'hello@gen2automation.com' ) ),
			);
			foreach ( $cols as $col ) : ?>
				<div>
					<div class="gen2-svc-footer__col-title mono"><?php echo esc_html( $col[0] ); ?></div>
					<?php foreach ( $col[1] as $line ) : ?>
						<div class="gen2-svc-footer__col-item sans"><?php echo esc_html( $line ); ?></div>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="gen2-svc-footer__legal mono">
			<span>&copy; <?php echo date( 'Y' ); ?> GEN2 AUTOMATION LLC</span>
			<span>UL-508A &middot; CODESYS APPLICATION PARTNER &middot; OREGON</span>
			<span>GEN2AUTOMATION.COM</span>
		</div>
	</footer>
	*/ ?>

</div>

<?php get_footer(); ?>
