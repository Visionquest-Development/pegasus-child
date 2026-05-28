<?php
/*
	Template Name: Gen2 - Experience
*/

/**
 * Experience / projects page. Three-level outline:
 *   • Top level   — page sections (hero, projects, platforms, codesys, PM)
 *   • Mid level   — cards within each section
 *   • Inner level — lists of brands / software / tools as styled chips
 *
 * All copy is CMB2-driven (show_on tpl_experience.php). See
 * inc/cmb2-metaboxes.php for the field definitions.
 */

require_once get_stylesheet_directory() . '/inc/gen2-design.php';

get_header();

// Mirror tpl_services.php behaviour: include the additional / sticky header
// when the parent theme is using header-three.
$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div class="gen2 gen2-experience">

	<?php
	/* ───── 1 — HERO ────────────────────────────────────────────────── */
	$exp_hero_subtitle = gen2_meta( 'gen2_exp_hero_subtitle',     '&sect; 01 &middot; EXPERIENCE' );
	$exp_hero_before   = gen2_meta( 'gen2_exp_hero_title_before', 'PROJECTS,' );
	$exp_hero_accent   = gen2_meta( 'gen2_exp_hero_title_accent', 'PLATFORMS &amp; PROOF.' );
	$exp_hero_intro    = gen2_meta( 'gen2_exp_hero_intro',        'A working catalogue of the manufacturers, controllers, and software stacks we ship with — alongside the projects where they\'ve gone into production.' );
	?>
	<section class="gen2-exp-hero">
		<div class="gen2-exp-hero__doc mono">
			<span><?php echo wp_kses_post( $exp_hero_subtitle ); ?></span>
			<span>SHEET 01 / 05</span>
		</div>
		<div class="gen2-exp-hero__main">
			<h1 class="gen2-exp-hero__title anton">
				<?php gen2_render_lines( $exp_hero_before ); ?>
				<?php if ( $exp_hero_accent ) : ?>
					<br><span class="gen2-exp-hero__title-accent"><?php echo wp_kses_post( $exp_hero_accent ); ?></span>
				<?php endif; ?>
			</h1>
			<?php if ( $exp_hero_intro ) : ?>
				<div class="gen2-exp-hero__intro sans">
					<?php gen2_render_wysiwyg( $exp_hero_intro ); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php
	/* ───── 2 — PROJECTS & SHOWCASES ─────────────────────────────────── */
	$proj_subtitle = gen2_meta( 'gen2_exp_projects_subtitle',     '&sect; 02 &middot; PROJECTS &amp; SHOWCASES' );
	$proj_before   = gen2_meta( 'gen2_exp_projects_title_before', 'WHAT WE\'VE' );
	$proj_accent   = gen2_meta( 'gen2_exp_projects_title_accent', 'SHIPPED.' );
	$proj_intro    = gen2_meta( 'gen2_exp_projects_intro',        '' );
	$proj_items    = gen2_meta_group( 'gen2_exp_projects_items', array() );
	$proj_items    = array_values( array_filter( $proj_items, function( $p ) {
		$t = isset( $p['project_title'] ) ? trim( (string) $p['project_title'] ) : '';
		$d = isset( $p['project_description'] ) ? trim( (string) $p['project_description'] ) : '';
		return ( '' !== $t || '' !== $d );
	} ) );
	?>
	<section class="gen2-exp-projects">
		<div class="gen2-exp-projects__doc mono">
			<span><?php echo wp_kses_post( $proj_subtitle ); ?></span>
			<span>SHEET 02 / 05</span>
		</div>
		<div class="gen2-exp-projects__head">
			<h2 class="gen2-exp-projects__title anton">
				<?php gen2_render_lines( $proj_before ); ?>
				<?php if ( $proj_accent ) : ?>
					<br><span class="gen2-exp-projects__title-accent"><?php echo wp_kses_post( $proj_accent ); ?></span>
				<?php endif; ?>
			</h2>
			<?php if ( $proj_intro ) : ?>
				<div class="gen2-exp-projects__intro sans">
					<?php gen2_render_wysiwyg( $proj_intro ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( ! empty( $proj_items ) ) : ?>
			<div class="gen2-exp-projects__grid">
				<?php foreach ( $proj_items as $i => $p ) :
					$img    = isset( $p['project_image'] )       ? $p['project_image']       : '';
					$title  = isset( $p['project_title'] )       ? $p['project_title']       : '';
					$client = isset( $p['project_client'] )      ? $p['project_client']      : '';
					$desc   = isset( $p['project_description'] ) ? $p['project_description'] : '';
					$url    = isset( $p['project_link_url'] )    ? $p['project_link_url']    : '';
					$label  = isset( $p['project_link_label'] )  ? $p['project_link_label']  : '';
					$num    = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT );
					?>
					<article class="gen2-exp-project">
						<div class="gen2-exp-project__media">
							<?php if ( $img ) : ?>
								<img class="gen2-exp-project__img" src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
							<?php else : ?>
								<?php gen2_ph( 'PROJECT · ' . strtoupper( $title ?: ( 'No.' . $num ) ), false, 'gen2-ph--project' ); ?>
							<?php endif; ?>
						</div>
						<div class="gen2-exp-project__body">
							<div class="gen2-exp-project__num mono"><?php echo esc_html( $num ); ?></div>
							<?php if ( $client ) : ?>
								<div class="gen2-exp-project__client mono"><?php echo wp_kses_post( $client ); ?></div>
							<?php endif; ?>
							<?php if ( $title ) : ?>
								<h3 class="gen2-exp-project__title anton"><?php echo wp_kses_post( $title ); ?></h3>
							<?php endif; ?>
							<?php if ( $desc ) : ?>
								<p class="gen2-exp-project__desc sans"><?php echo wp_kses_post( $desc ); ?></p>
							<?php endif; ?>
							<?php if ( $url ) : ?>
								<a class="gen2-exp-project__link mono" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ?: 'View Project &rarr;' ); ?></a>
							<?php endif; ?>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</section>

	<?php
	/* ───── 3 — PLATFORMS ───────────────────────────────────────────── */
	$plat_subtitle = gen2_meta( 'gen2_exp_platforms_subtitle',     '&sect; 03 &middot; PLATFORMS WE HAVE EXPERIENCE ON' );
	$plat_before   = gen2_meta( 'gen2_exp_platforms_title_before', 'WE SPEAK' );
	$plat_accent   = gen2_meta( 'gen2_exp_platforms_title_accent', 'EVERY STACK.' );
	$plat_intro    = gen2_meta( 'gen2_exp_platforms_intro',        '' );

	$plat_fallback = array(
		array(
			'category_title'    => 'Controllers',
			'category_subtitle' => '',
			'category_items'    => "Codesys\nBeckhoff\nRockwell\nABB\nBosch\nSTW\nWeintek",
		),
		array(
			'category_title'    => 'Robotic Arms',
			'category_subtitle' => '',
			'category_items'    => "Fanuc\nABB\nUR (Universal Robots)\nEpson\nMotoman / Yaskawa\nKawasaki",
		),
		array(
			'category_title'    => 'HMI / SCADA',
			'category_subtitle' => '',
			'category_items'    => "Codesys Visualization\nIgnition\nFactory Talk Studio",
		),
	);
	$plat_categories = gen2_meta_group( 'gen2_exp_platforms_categories', $plat_fallback );
	$plat_categories = array_values( array_filter( $plat_categories, function( $c ) {
		$t = isset( $c['category_title'] ) ? trim( (string) $c['category_title'] ) : '';
		$i = isset( $c['category_items'] ) ? trim( (string) $c['category_items'] ) : '';
		return ( '' !== $t || '' !== $i );
	} ) );
	?>
	<section class="gen2-exp-platforms">
		<div class="gen2-exp-platforms__doc mono">
			<span><?php echo wp_kses_post( $plat_subtitle ); ?></span>
			<span>SHEET 03 / 05</span>
		</div>
		<div class="gen2-exp-platforms__head">
			<h2 class="gen2-exp-platforms__title anton">
				<?php gen2_render_lines( $plat_before ); ?>
				<?php if ( $plat_accent ) : ?>
					<br><span class="gen2-exp-platforms__title-accent"><?php echo wp_kses_post( $plat_accent ); ?></span>
				<?php endif; ?>
			</h2>
			<?php if ( $plat_intro ) : ?>
				<div class="gen2-exp-platforms__intro sans">
					<?php gen2_render_wysiwyg( $plat_intro ); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="gen2-exp-platforms__grid">
			<?php foreach ( $plat_categories as $i => $cat ) :
				$ct  = isset( $cat['category_title'] )    ? $cat['category_title']    : '';
				$cs  = isset( $cat['category_subtitle'] ) ? $cat['category_subtitle'] : '';
				$raw = isset( $cat['category_items'] )    ? (string) $cat['category_items'] : '';
				$items = array_values( array_filter( array_map( 'trim', preg_split( '/\r?\n/', $raw ) ) ) );
				$num = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT );
				?>
				<div class="gen2-exp-platform">
					<div class="gen2-exp-platform__head mono">
						<span class="gen2-exp-platform__num"><?php echo esc_html( $num ); ?></span>
						<span class="gen2-exp-platform__count"><?php echo count( $items ); ?> ITEMS</span>
					</div>
					<h3 class="gen2-exp-platform__title anton"><?php echo wp_kses_post( $ct ); ?></h3>
					<?php if ( $cs ) : ?>
						<div class="gen2-exp-platform__subtitle mono"><?php echo wp_kses_post( $cs ); ?></div>
					<?php endif; ?>
					<?php if ( ! empty( $items ) ) : ?>
						<ul class="gen2-exp-platform__chips">
							<?php foreach ( $items as $item ) : ?>
								<li class="gen2-exp-platform__chip"><?php echo esc_html( $item ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<?php
	/* ───── 4 — CODESYS CALLOUT ─────────────────────────────────────── */
	$exp_cod_subtitle = gen2_meta( 'gen2_exp_codesys_subtitle',     '&sect; 04 &middot; CODESYS' );
	$exp_cod_before   = gen2_meta( 'gen2_exp_codesys_title_before', 'CODESYS,' );
	$exp_cod_accent   = gen2_meta( 'gen2_exp_codesys_title_accent', 'DAILY.' );
	$exp_cod_body     = gen2_meta( 'gen2_exp_codesys_body',         'Authorized CODESYS Application Partner since 2014. We ship CODESYS in production every week — and we teach the curriculum we use to do it.' );
	?>
	<section class="gen2-exp-codesys">
		<div class="gen2-exp-codesys__doc mono">
			<span><?php echo wp_kses_post( $exp_cod_subtitle ); ?></span>
			<span>SHEET 04 / 05</span>
		</div>
		<div class="gen2-exp-codesys__main">
			<div>
				<img class="gen2-exp-codesys__logo"
					src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/CODESYS-logo-standard.svg' ); ?>"
					alt="CODESYS" />
				<h2 class="gen2-exp-codesys__title anton">
					<?php gen2_render_lines( $exp_cod_before ); ?>
					<?php if ( $exp_cod_accent ) : ?>
						<br><span class="gen2-exp-codesys__title-accent"><?php echo wp_kses_post( $exp_cod_accent ); ?></span>
					<?php endif; ?>
				</h2>
			</div>
			<div class="gen2-exp-codesys__body sans">
				<?php gen2_render_wysiwyg( $exp_cod_body ); ?>
			</div>
		</div>
	</section>

	<?php
	/* ───── 5 — PROJECT MANAGEMENT ──────────────────────────────────── */
	$pm_subtitle = gen2_meta( 'gen2_exp_pm_subtitle',     '&sect; 05 &middot; PROJECT MANAGEMENT' );
	$pm_before   = gen2_meta( 'gen2_exp_pm_title_before', 'HOW WE' );
	$pm_accent   = gen2_meta( 'gen2_exp_pm_title_accent', 'RUN THE JOB.' );
	$pm_body     = gen2_meta( 'gen2_exp_pm_body',         '<p>Every project ships with a named lead, weekly status, and a single point of contact from concept through commissioning.</p>' );
	?>
	<section class="gen2-exp-pm">
		<div class="gen2-exp-pm__doc mono">
			<span><?php echo wp_kses_post( $pm_subtitle ); ?></span>
			<span>SHEET 05 / 05</span>
		</div>
		<div class="gen2-exp-pm__main">
			<h2 class="gen2-exp-pm__title anton">
				<?php gen2_render_lines( $pm_before ); ?>
				<?php if ( $pm_accent ) : ?>
					<br><span class="gen2-exp-pm__title-accent"><?php echo wp_kses_post( $pm_accent ); ?></span>
				<?php endif; ?>
			</h2>
			<div class="gen2-exp-pm__body sans">
				<?php gen2_render_wysiwyg( $pm_body ); ?>
			</div>
		</div>
	</section>

</div>

<?php get_footer(); ?>
