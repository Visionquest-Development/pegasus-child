<?php
/*
	Template Name: Homepage
*/

/**
 * Port of the React "B · Technical Schematic" homepage from the Claude
 * Design handoff (variants/v2-schematic.jsx). All styling lives in
 * style.css; this template only emits semantic markup.
 */

require_once get_stylesheet_directory() . '/inc/gen2-design.php';

get_header(); ?>

<div class="gen2 gen2-schematic">
	<?php /*
	────────── NAV ──────────
	<div class="gen2-schem-nav">
		<div class="gen2-schem-nav__brand">
			<?php gen2_mark( 'dark', 0.95, true ); ?>
		</div>
		<nav class="gen2-schem-nav__menu">
			<?php
			$nav_items = array( 'Services', 'Capabilities', 'Work', 'About', 'Contact' );
			foreach ( $nav_items as $i => $label ) : ?>
				<a class="gen2-schem-nav__link mono" href="#">
					<span class="gen2-schem-nav__link-num">/0<?php echo $i + 1; ?></span><?php echo esc_html( $label ); ?>
				</a>
			<?php endforeach; ?>
		</nav>
		<div class="gen2-schem-nav__cta-wrap">
			<a class="gen2-schem-nav__cta mono" href="#">+ Request Quote</a>
		</div>
	</div>
	*/ ?>

	<!-- ────────── HERO ────────── -->
	<section class="gen2-schem-hero">
		<div class="gen2-schem-hero__grid gen2-grid-bg gen2-grid-bg--dark"></div>
		<div class="gen2-schem-hero__corner gen2-schem-hero__corner--tl"></div>
		<div class="gen2-schem-hero__corner gen2-schem-hero__corner--tr"></div>
		<div class="gen2-schem-hero__corner gen2-schem-hero__corner--bl"></div>
		<div class="gen2-schem-hero__corner gen2-schem-hero__corner--br"></div>

		<?php
		$hero_subtitle     = gen2_meta( 'gen2_hero_subtitle',     '&#9656; AUTOMATION &middot; CONTROL SYSTEMS &middot; PANEL FAB' );
		$hero_title        = gen2_meta( 'gen2_hero_title',        "ENGINEERED\nFROM" );
		$hero_title_accent = gen2_meta( 'gen2_hero_title_accent', 'FIRST PRINCIPLES.' );
		$hero_intro        = gen2_meta( 'gen2_hero_intro',        'Gen2 Automation builds the robots, the panels, and the code that runs modern manufacturing. CODESYS Application Partner since 2014. UL-508A shop in Tigard, Oregon.' );
		$hero_btn1_text    = gen2_meta( 'gen2_hero_btn_primary_text',   '+ Start a Project' );
		$hero_btn1_url     = gen2_meta( 'gen2_hero_btn_primary_url',    '#' );
		$hero_btn2_text    = gen2_meta( 'gen2_hero_btn_secondary_text', '&#8600; Capabilities Deck' );
		$hero_btn2_url     = gen2_meta( 'gen2_hero_btn_secondary_url',  '#' );
		?>
		<div class="gen2-schem-hero__inner">
			<div class="gen2-schem-hero__doc mono">
				<span>DOC-A &middot; GEN2-HOMEPAGE-2026.04</span>
				<span>SCALE 1:1</span>
				<span>SHEET 01 / 06</span>
				<span>REV C &middot; 2026.04.18</span>
				<span>TIGARD, OR &middot; ESTABLISHED 2008</span>
			</div>
			<div class="gen2-schem-hero__main">
				<div>
					<div class="gen2-schem-hero__eyebrow mono">
						<?php echo wp_kses_post( $hero_subtitle ); ?>
					</div>
					<h1 class="gen2-schem-hero__title anton">
						<?php gen2_render_lines( $hero_title ); ?>
						<?php if ( $hero_title_accent ) : ?>
							<br><span class="gen2-schem-hero__title-accent"><?php echo esc_html( $hero_title_accent ); ?></span>
						<?php endif; ?>
					</h1>
				</div>
				<div>
					<div class="gen2-schem-hero__intro sans">
						<?php gen2_render_wysiwyg( $hero_intro ); ?>
					</div>
					<div class="gen2-schem-hero__cta-row">
						<?php if ( $hero_btn1_text ) : ?>
							<a class="gen2-btn-primary mono" href="<?php echo esc_url( $hero_btn1_url ); ?>"><?php echo wp_kses_post( $hero_btn1_text ); ?></a>
						<?php endif; ?>
						<?php if ( $hero_btn2_text ) : ?>
							<a class="gen2-btn-ghost mono" href="<?php echo esc_url( $hero_btn2_url ); ?>"><?php echo wp_kses_post( $hero_btn2_text ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php /*
		<div class="gen2-schem-hero__split">
			<div class="gen2-schem-hero__schem">
				<div class="gen2-schem-hero__schem-label mono">FIG. 01 &middot; 6-AXIS PICK &amp; PLACE &middot; KINEMATICS</div>
				<?php gen2_schematic_arm( 'gen2-svg--on-dark' ); ?>
			</div>
			<div class="gen2-schem-hero__photo-wrap">
				<?php gen2_ph( 'HERO PHOTO · ASSEMBLY CELL · 4:5', true, 'gen2-ph--fill' ); ?>
			</div>
		</div>
		*/ ?>
		<?php
		$stats_fallback = array(
			array( 'stat_number' => '18 yrs',   'stat_label' => 'in field' ),
			array( 'stat_number' => '240+',     'stat_label' => 'panels built' ),
			array( 'stat_number' => '1.4M',     'stat_label' => 'lines of ST' ),
			array( 'stat_number' => '99.4%',    'stat_label' => 'avg uptime' ),
			array( 'stat_number' => '18 cells', 'stat_label' => 'amazon · 2024' ),
		);
		$stats = gen2_meta_group( 'gen2_hero_stats', $stats_fallback );
		?>
		<div class="gen2-schem-hero__stats">
			<?php foreach ( $stats as $s ) :
				$num   = isset( $s['stat_number'] ) ? $s['stat_number'] : '';
				$label = isset( $s['stat_label'] )  ? $s['stat_label']  : '';
				if ( '' === $num && '' === $label ) { continue; }
				?>
				<div class="gen2-schem-hero__stat">
					<span class="gen2-schem-hero__stat-num anton"><?php echo esc_html( $num ); ?></span>
					<span class="gen2-schem-hero__stat-label mono"><?php echo esc_html( $label ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- ────────── SERVICES ────────── -->
	<?php
	$svc_subtitle     = gen2_meta( 'gen2_services_subtitle',     '&sect; 02 &middot; WHAT WE DO' );
	$svc_title        = gen2_meta( 'gen2_services_title',        'THREE DISCIPLINES.' );
	$svc_title_accent = gen2_meta( 'gen2_services_title_accent', 'ONE TEAM.' );
	$svc_intro        = gen2_meta( 'gen2_services_intro',        "We don't subcontract. The same engineers who design your control system wire the panel and stand on your plant floor at run-off." );

	$cards_fallback = array(
		array(
			'card_code'        => 'S-AUT',
			'card_title'       => 'Automation Consulting',
			'card_description' => 'Concept systems, ROI modeling, throughput audits. We start by listening.',
			'card_bullets'     => "<ul><li>Concept Systems</li><li>Level-2 Type Systems</li><li>Feasibility Studies</li><li>Plant-Floor Audits</li></ul>",
		),
		array(
			'card_code'        => 'S-CTL',
			'card_title'       => 'Process Control',
			'card_description' => 'CODESYS-native control systems written in object-oriented structured text.',
			'card_bullets'     => "<ul><li>CODESYS · OOP/ST</li><li>PLC Architecture</li><li>Motion Control</li><li>HMI / SCADA</li></ul>",
		),
		array(
			'card_code'        => 'S-PNL',
			'card_title'       => 'Panel Fabrication',
			'card_description' => 'UL-508A panels designed, built, and tested in our Tigard, Oregon shop.',
			'card_bullets'     => "<ul><li>UL-508A Listed</li><li>MCC / Distribution</li><li>VFD Integration</li><li>Wire &amp; Test</li></ul>",
		),
	);
	$cards = gen2_meta_group( 'gen2_services_cards', $cards_fallback );
	?>
	<section class="gen2-schem-services">
		<div class="gen2-schem-services__doc mono">
			<span><?php echo wp_kses_post( $svc_subtitle ); ?></span>
			<span>SHEET 02 / 06</span>
		</div>
		<div class="gen2-schem-services__head row align-items-lg-end g-4">
			<div class="col-12 col-lg-6 order-2 order-lg-1">
				<h2 class="gen2-schem-services__title anton">
					<?php gen2_render_lines( $svc_title ); ?>
					<?php if ( $svc_title_accent ) : ?>
						<br><span class="gen2-schem-services__title-accent"><?php echo esc_html( $svc_title_accent ); ?></span>
					<?php endif; ?>
				</h2>
			</div>
			<div class="col-12 col-lg-6 order-1 order-lg-2">
				<img class="gen2-schem-services__logo"
					src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/gen2-automation-logo.svg' ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
				<div class="gen2-schem-services__intro sans">
					<?php gen2_render_wysiwyg( $svc_intro ); ?>
				</div>
			</div>
		</div>
		<div class="gen2-schem-services__grid">
			<?php foreach ( $cards as $i => $card ) :
				$code    = isset( $card['card_code'] )        ? $card['card_code']        : '';
				$title   = isset( $card['card_title'] )       ? $card['card_title']       : '';
				$desc    = isset( $card['card_description'] ) ? $card['card_description'] : '';
				$bullets = isset( $card['card_bullets'] )     ? $card['card_bullets']     : '';
				if ( '' === $code && '' === $title && '' === $bullets ) { continue; }
				$number  = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT );
				?>
				<div class="gen2-schem-services__card">
					<div class="gen2-schem-services__card-head mono">
						<span><?php echo esc_html( $number ); ?></span>
						<span><?php echo esc_html( $code ); ?></span>
					</div>
					<h3 class="gen2-schem-services__card-title anton"><?php echo esc_html( strtoupper( $title ) ); ?></h3>
					<?php if ( $desc ) : ?>
						<p class="gen2-schem-services__card-desc sans"><?php echo esc_html( $desc ); ?></p>
					<?php endif; ?>
					<div class="gen2-schem-services__bullets">
						<?php gen2_render_wysiwyg( $bullets ); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- ────────── CODESYS ────────── -->
	<?php
	$cod_subtitle     = gen2_meta( 'gen2_codesys_subtitle',      '&sect; 03 &middot; STRATEGIC PARTNERSHIP' );
	$cod_partner      = gen2_meta( 'gen2_codesys_partner_label', 'CODESYS &middot; GMBH &middot; KEMPTEN, DE' );
	$cod_title_before = gen2_meta( 'gen2_codesys_title_before',  'AUTHORIZED' );
	$cod_title_accent = gen2_meta( 'gen2_codesys_title_accent',  'APPLICATION' );
	$cod_title_after  = gen2_meta( 'gen2_codesys_title_after',   'PARTNER.' );
	$cod_intro        = gen2_meta( 'gen2_codesys_intro',         'CODESYS is the industrial automation IDE used on more than 1,000 device families. Gen2 Automation is one of a handful of US partners certified to deliver, train on, and consult around it.' );
	$cod_pills        = gen2_meta( 'gen2_codesys_pills',         '&#9656; AUTHORIZED SOLUTIONS &nbsp;&middot;&nbsp; &#9656; CONSULTING &nbsp;&middot;&nbsp; &#9656; TRAINING &nbsp;&middot;&nbsp; &#9656; INTEGRATION' );
	$cod_schem_label  = gen2_meta( 'gen2_codesys_schem_label',   'FIG. 02 &middot; PNL-A &middot; CODESYS RUNTIME ON CPU-1518F' );

	$cod_has_before = '' !== trim( wp_strip_all_tags( $cod_title_before ) );
	$cod_has_accent = '' !== trim( $cod_title_accent );
	$cod_has_after  = '' !== trim( wp_strip_all_tags( $cod_title_after ) );

	$cod_cells_fallback = array(
		array( 'cell_title' => 'AUTHORIZED SOLUTIONS',  'cell_description' => "Production-grade CODESYS templates and runtime configs we've shipped to spec since 2014." ),
		array( 'cell_title' => 'OOP / STRUCTURED TEXT', 'cell_description' => 'Inheritance, interfaces, unit-tested function blocks — code your team can maintain.' ),
		array( 'cell_title' => 'MOTION CONTROL',        'cell_description' => 'Coordinated multi-axis motion in CODESYS SoftMotion. Pick-and-place, gantries, kinematics.' ),
		array( 'cell_title' => 'LEVEL-2 SYSTEMS',       'cell_description' => 'Recipe management, batch tracking, OEE roll-up across cells, lines, and entire plants.' ),
		array( 'cell_title' => 'CONTROL SYSTEMS',       'cell_description' => 'Architecture reviews, code audits, and rescue work for in-flight CODESYS projects.' ),
		array( 'cell_title' => 'TRAINING',              'cell_description' => 'Hands-on courses for your maintenance and controls teams. Beginner through OOP-advanced.' ),
		array( 'cell_title' => 'CONSULTING',            'cell_description' => 'Spec, vendor selection, integration plans — for plants without in-house controls staff.' ),
		array( 'cell_title' => 'CONCEPT SYSTEMS',       'cell_description' => 'Greenfield concept development, ROI modeling, and full feasibility studies.' ),
	);
	$cod_cells = gen2_meta_group( 'gen2_codesys_cells', $cod_cells_fallback );

	// Drop blank repeater rows and derive a denominator so the "01 / NN"
	// counter on each cell scales with however many cells the client enters.
	$cod_cells = array_values( array_filter( $cod_cells, function( $c ) {
		$t = isset( $c['cell_title'] )       ? trim( (string) $c['cell_title'] )       : '';
		$d = isset( $c['cell_description'] ) ? trim( (string) $c['cell_description'] ) : '';
		return ( '' !== $t || '' !== $d );
	} ) );
	$cod_cells_total = str_pad( (string) max( 1, count( $cod_cells ) ), 2, '0', STR_PAD_LEFT );
	?>
	<section class="gen2-schem-codesys">
		<div class="gen2-schem-codesys__grid gen2-grid-bg gen2-grid-bg--dark"></div>
		<div class="gen2-schem-codesys__inner">
			<div class="gen2-schem-codesys__doc mono">
				<span><?php echo wp_kses_post( $cod_subtitle ); ?></span>
				<span><?php echo wp_kses_post( $cod_partner ); ?></span>
				<span>SHEET 03 / 06</span>
			</div>
			<div class="gen2-schem-codesys__main">
				<div>
					<img class="gen2-schem-codesys__logo"
						src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/CODESYS-logo-standard.svg' ); ?>"
						alt="CODESYS" />
					<h2 class="gen2-schem-codesys__title anton">
						<?php if ( $cod_has_before ) { gen2_render_lines( $cod_title_before ); } ?>
						<?php if ( $cod_has_accent ) : ?>
							<?php if ( $cod_has_before ) { echo '<br>'; } ?>
							<span class="gen2-schem-codesys__title-accent"><?php echo esc_html( $cod_title_accent ); ?></span>
						<?php endif; ?>
						<?php if ( $cod_has_after ) : ?>
							<?php if ( $cod_has_before || $cod_has_accent ) { echo '<br>'; } ?>
							<?php gen2_render_lines( $cod_title_after ); ?>
						<?php endif; ?>
					</h2>
					<div class="gen2-schem-codesys__intro sans">
						<?php gen2_render_wysiwyg( $cod_intro ); ?>
					</div>
					<?php if ( $cod_pills ) : ?>
						<div class="gen2-schem-codesys__pills mono">
							<?php echo wp_kses_post( $cod_pills ); ?>
						</div>
					<?php endif; ?>
				</div>
				<div>
					<?php gen2_schematic_panel( 'gen2-svg--codesys' ); ?>
					<div class="gen2-schem-codesys__schem-label mono">
						<span><?php echo wp_kses_post( $cod_schem_label ); ?></span>
						<span>SCALE 1:1</span>
					</div>
				</div>
			</div>
		</div>
		<div class="gen2-schem-codesys__cells">
			<?php foreach ( $cod_cells as $i => $cell ) :
				$cell_title = isset( $cell['cell_title'] )       ? $cell['cell_title']       : '';
				$cell_desc  = isset( $cell['cell_description'] ) ? $cell['cell_description'] : '';
				$cell_num   = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT );
				?>
				<div class="gen2-schem-codesys__cell">
					<div class="gen2-schem-codesys__cell-num mono"><?php echo esc_html( $cell_num ); ?> / <?php echo esc_html( $cod_cells_total ); ?></div>
					<h4 class="gen2-schem-codesys__cell-title anton"><?php echo esc_html( $cell_title ); ?></h4>
					<?php if ( $cell_desc ) : ?>
						<p class="gen2-schem-codesys__cell-desc sans"><?php echo esc_html( $cell_desc ); ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- ────────── AMAZON CASE STUDY ────────── -->
	<?php
	$case_subtitle       = gen2_meta( 'gen2_case_subtitle',      '&sect; 04 &middot; CASE STUDY' );
	$case_client_label   = gen2_meta( 'gen2_case_client_label',  'CLIENT: AMAZON ROBOTICS &middot; 2024' );
	$case_eyebrow        = gen2_meta( 'gen2_case_eyebrow',       '&#9656; FEATURED PROJECT &middot; BFI4 / SACRAMENTO' );
	$case_title_template = gen2_meta( 'gen2_case_title_template', "18 ASSEMBLY ROBOTS\nBUILDING {{accent}}\nNEXT-GEN SORTERS." );
	$case_title_accent   = gen2_meta( 'gen2_case_title_accent',  "AMAZON'S" );
	$case_intro          = gen2_meta( 'gen2_case_intro',         "Amazon Robotics needed a partner who could move from concept to FAT in six months — without compromising on the CODESYS architecture they'd standardized on. Gen2 delivered eighteen identical assembly cells, panel-fabricated and programmed in Tigard, commissioned on-site with zero post-FAT redlines." );
	$case_hero_image     = gen2_meta( 'gen2_case_hero_image',    '' );
	$case_hero_video     = gen2_meta( 'gen2_case_hero_video_url', '' );
	$case_hero_ph_label  = gen2_meta( 'gen2_case_hero_placeholder_label', 'CASE STUDY HERO · ASSEMBLY CELL OPERATING · 16:9' );

	// Detect direct-file video URLs vs YouTube/Vimeo embed URLs so we can
	// render the right element below (HTML5 <video> vs. oEmbed iframe).
	$case_video_ext = $case_hero_video ? strtolower( (string) pathinfo( (string) parse_url( $case_hero_video, PHP_URL_PATH ), PATHINFO_EXTENSION ) ) : '';
	$case_video_is_direct = in_array( $case_video_ext, array( 'mp4', 'webm', 'ogv', 'ogg', 'mov', 'm4v' ), true );
	$case_video_mime = ( 'mov' === $case_video_ext ) ? 'mp4' : $case_video_ext;

	// Title: {{accent}} placeholder gets replaced with the styled span, then
	// newlines become <br>. Lets the client position the copper word inline.
	$case_accent_html = ( '' !== trim( (string) $case_title_accent ) )
		? '<span class="gen2-schem-case__title-accent">' . esc_html( $case_title_accent ) . '</span>'
		: '';
	$case_title_html = nl2br( esc_html( trim( (string) $case_title_template ) ) );
	$case_title_html = str_replace( '{{accent}}', $case_accent_html, $case_title_html );

	$case_stats_fallback = array(
		array( 'stat_label' => 'DELIVERED',         'stat_value' => '18 cells' ),
		array( 'stat_label' => 'TIMELINE',          'stat_value' => '6 months · concept → FAT' ),
		array( 'stat_label' => 'THROUGHPUT',        'stat_value' => '2,200 units · hr⁻¹' ),
		array( 'stat_label' => 'POST-FAT REDLINES', 'stat_value' => '0' ),
		array( 'stat_label' => 'PANEL ARCH',        'stat_value' => 'UL-508A · CODESYS' ),
		array( 'stat_label' => 'MOTION',            'stat_value' => '6-axis SoftMotion' ),
		array( 'stat_label' => 'DEPLOYED',          'stat_value' => 'BFI4 + SAC1 + 4 more' ),
	);
	$case_stats = gen2_meta_group( 'gen2_case_stats', $case_stats_fallback );
	$case_stats = array_values( array_filter( $case_stats, function( $s ) {
		$l = isset( $s['stat_label'] ) ? trim( (string) $s['stat_label'] ) : '';
		$v = isset( $s['stat_value'] ) ? trim( (string) $s['stat_value'] ) : '';
		return ( '' !== $l || '' !== $v );
	} ) );
	?>
	<section class="gen2-schem-case">
		<div class="gen2-schem-case__doc mono">
			<span><?php echo wp_kses_post( $case_subtitle ); ?></span>
			<span><?php echo wp_kses_post( $case_client_label ); ?></span>
			<span>SHEET 04 / 06</span>
		</div>
		<div class="gen2-schem-case__main">
			<div>
				<?php if ( $case_eyebrow ) : ?>
					<div class="gen2-schem-case__eyebrow mono"><?php echo wp_kses_post( $case_eyebrow ); ?></div>
				<?php endif; ?>
				<h2 class="gen2-schem-case__title anton">
					<?php echo $case_title_html; ?>
				</h2>
				<div class="gen2-schem-case__intro sans">
					<?php gen2_render_wysiwyg( $case_intro ); ?>
				</div>
				<?php if ( $case_hero_video && $case_video_is_direct ) : ?>
					<video class="gen2-schem-case__hero-video" autoplay muted loop playsinline preload="metadata">
						<source src="<?php echo esc_url( $case_hero_video ); ?>" type="video/<?php echo esc_attr( $case_video_mime ); ?>" />
					</video>
				<?php elseif ( $case_hero_video ) : ?>
					<div class="gen2-schem-case__hero-embed">
						<?php
						$case_embed_html = wp_oembed_get( $case_hero_video );
						echo $case_embed_html ? $case_embed_html : '<a href="' . esc_url( $case_hero_video ) . '" target="_blank" rel="noopener">' . esc_html( $case_hero_video ) . '</a>';
						?>
					</div>
				<?php elseif ( $case_hero_image ) : ?>
					<img class="gen2-schem-case__hero-img" src="<?php echo esc_url( $case_hero_image ); ?>" alt="" />
				<?php else : ?>
					<?php gen2_ph( $case_hero_ph_label, false, 'gen2-ph--hero-case' ); ?>
				<?php endif; ?>
			</div>
			<div class="gen2-schem-case__stats">
				<?php foreach ( $case_stats as $i => $stat ) :
					$stat_label = isset( $stat['stat_label'] ) ? $stat['stat_label'] : '';
					$stat_value = isset( $stat['stat_value'] ) ? $stat['stat_value'] : '';
					$stat_num   = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT );
					?>
					<div class="gen2-schem-case__stat">
						<div class="gen2-schem-case__stat-label mono"><?php echo esc_html( $stat_num . ' · ' . $stat_label ); ?></div>
						<div class="gen2-schem-case__stat-value anton"><?php echo esc_html( $stat_value ); ?></div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ────────── PROCESS ────────── -->
	<?php
	$proc_subtitle     = gen2_meta( 'gen2_process_subtitle',     '&sect; 05 &middot; PROCESS &middot; CONCEPT &rarr; COMMISSION' );
	$proc_title_before = gen2_meta( 'gen2_process_title_before', 'A REPEATABLE' );
	$proc_title_accent = gen2_meta( 'gen2_process_title_accent', 'SIX-STEP DELIVERY.' );

	$proc_steps_fallback = array(
		array( 'step_name' => 'DISCOVERY', 'step_description' => 'Plant-floor audits, throughput targets, and team interviews.' ),
		array( 'step_name' => 'DESIGN',    'step_description' => 'P&amp;IDs, panel layouts, cell envelopes, controls architecture.' ),
		array( 'step_name' => 'FABRICATE', 'step_description' => 'UL-508A panels built, wired, and bench-tested in Tigard.' ),
		array( 'step_name' => 'PROGRAM',   'step_description' => 'CODESYS structured text. Object-oriented from day one.' ),
		array( 'step_name' => 'INTEGRATE', 'step_description' => 'FAT, SAT, and on-site run-off alongside your team.' ),
		array( 'step_name' => 'SUPPORT',   'step_description' => 'Remote diagnostics, training, optimization, and uptime.' ),
	);
	$proc_steps = gen2_meta_group( 'gen2_process_steps', $proc_steps_fallback );
	$proc_steps = array_values( array_filter( $proc_steps, function( $s ) {
		$n = isset( $s['step_name'] )        ? trim( (string) $s['step_name'] )        : '';
		$d = isset( $s['step_description'] ) ? trim( (string) $s['step_description'] ) : '';
		return ( '' !== $n || '' !== $d );
	} ) );
	// Pull step names so the schematic flow SVG matches the cards beneath it.
	$proc_step_labels = array_map( function( $s ) {
		return isset( $s['step_name'] ) ? $s['step_name'] : '';
	}, $proc_steps );
	?>
	<section class="gen2-schem-process">
		<div class="gen2-schem-process__doc mono">
			<span><?php echo wp_kses_post( $proc_subtitle ); ?></span>
			<span>SHEET 05 / 06</span>
		</div>
		<h2 class="gen2-schem-process__title anton">
			<?php gen2_render_lines( $proc_title_before ); ?>
			<?php if ( $proc_title_accent ) : ?>
				<br><span class="gen2-schem-process__title-accent"><?php echo esc_html( $proc_title_accent ); ?></span>
			<?php endif; ?>
		</h2>
		<div class="gen2-schem-process__flow">
			<?php gen2_schematic_flow( 'gen2-svg--on-dark-300', $proc_step_labels ); ?>
		</div>
		<div class="gen2-schem-process__grid">
			<?php foreach ( $proc_steps as $i => $st ) :
				$step_name = isset( $st['step_name'] )        ? $st['step_name']        : '';
				$step_desc = isset( $st['step_description'] ) ? $st['step_description'] : '';
				$step_num  = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT );
				?>
				<div class="gen2-schem-process__step">
					<div class="gen2-schem-process__step-num mono"><?php echo esc_html( $step_num ); ?> &middot; <?php echo esc_html( $step_name ); ?></div>
					<?php if ( $step_desc ) : ?>
						<p class="gen2-schem-process__step-desc sans"><?php echo wp_kses_post( $step_desc ); ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- ────────── CLIENT LOGOS / MANUFACTURERS ────────── -->
	<?php
	$mfg_label = gen2_meta( 'gen2_manufacturers_label', '&#9656; TRUSTED BY MANUFACTURERS ACROSS NORTH AMERICA' );
	$mfg_logos = gen2_meta_group( 'gen2_manufacturers_logos', array() );
	$mfg_logos = array_values( array_filter( $mfg_logos, function( $l ) {
		$img  = isset( $l['logo_image'] ) ? trim( (string) $l['logo_image'] ) : '';
		$name = isset( $l['logo_name'] )  ? trim( (string) $l['logo_name'] )  : '';
		return ( '' !== $img || '' !== $name );
	} ) );
	?>
	<section class="gen2-schem-logos">
		<?php if ( $mfg_label ) : ?>
			<div class="gen2-schem-logos__label mono"><?php echo wp_kses_post( $mfg_label ); ?></div>
		<?php endif; ?>
		<?php if ( ! empty( $mfg_logos ) ) : ?>
			<div class="gen2-clients gen2-clients--dark gen2-clients--cmb">
				<?php foreach ( $mfg_logos as $logo ) :
					$img  = isset( $logo['logo_image'] ) ? $logo['logo_image'] : '';
					$name = isset( $logo['logo_name'] )  ? $logo['logo_name']  : '';
					$url  = isset( $logo['logo_url'] )   ? $logo['logo_url']   : '';
					?>
					<div class="gen2-clients__item">
						<?php if ( $url ) : ?><a href="<?php echo esc_url( $url ); ?>" class="gen2-clients__link" rel="noopener"><?php endif; ?>
							<?php if ( $img ) : ?>
								<img class="gen2-clients__img" src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
							<?php else : ?>
								<span class="gen2-clients__wordmark"><?php echo esc_html( $name ); ?></span>
							<?php endif; ?>
						<?php if ( $url ) : ?></a><?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<?php gen2_client_logos( 'dark' ); ?>
		<?php endif; ?>
	</section>

	<!-- ────────── TEAM / LEADERSHIP ────────── -->
	<?php
	$team_subtitle     = gen2_meta( 'gen2_team_subtitle',     '&sect; 06 &middot; LEADERSHIP' );
	$team_title_before = gen2_meta( 'gen2_team_title_before', 'ENGINEERS' );
	$team_title_accent = gen2_meta( 'gen2_team_title_accent', 'ON THE FLOOR.' );
	$team_intro        = gen2_meta( 'gen2_team_intro',        "Every Gen2 project is led by someone who's spent the day in safety glasses, rope-tagged a panel, or argued with a kinematic transform at 2 AM." );

	$team_fallback = array(
		array( 'member_name' => 'MARCUS CHEN',   'member_role' => 'Founder · Principal Controls', 'member_credentials' => 'M.Sc EECS · 22 yrs',     'member_photo' => '' ),
		array( 'member_name' => 'PRIYA ANAND',   'member_role' => 'VP Engineering',                'member_credentials' => 'PMP · 15 yrs',           'member_photo' => '' ),
		array( 'member_name' => 'DALE WHITFORD', 'member_role' => 'Director, Panel Shop',          'member_credentials' => 'UL-508A · 24 yrs',       'member_photo' => '' ),
		array( 'member_name' => 'SARA LEHMANN',  'member_role' => 'Lead CODESYS Architect',        'member_credentials' => 'CODESYS Cert. · 11 yrs', 'member_photo' => '' ),
	);
	$team_members = gen2_meta_group( 'gen2_team_members', $team_fallback );
	$team_members = array_values( array_filter( $team_members, function( $m ) {
		$n = isset( $m['member_name'] ) ? trim( (string) $m['member_name'] ) : '';
		$r = isset( $m['member_role'] ) ? trim( (string) $m['member_role'] ) : '';
		$p = isset( $m['member_photo'] ) ? trim( (string) $m['member_photo'] ) : '';
		return ( '' !== $n || '' !== $r || '' !== $p );
	} ) );
	?>
	<section class="gen2-schem-team">
		<div class="gen2-schem-team__doc mono">
			<span><?php echo wp_kses_post( $team_subtitle ); ?></span>
			<span>SHEET 06 / 06</span>
		</div>
		<div class="gen2-schem-team__head">
			<h2 class="gen2-schem-team__title anton">
				<?php gen2_render_lines( $team_title_before ); ?>
				<?php if ( $team_title_accent ) : ?>
					<br><span class="gen2-schem-team__title-accent"><?php echo esc_html( $team_title_accent ); ?></span>
				<?php endif; ?>
			</h2>
			<div class="gen2-schem-team__intro sans">
				<?php gen2_render_wysiwyg( $team_intro ); ?>
			</div>
		</div>
		<div class="gen2-schem-team__grid">
			<?php foreach ( $team_members as $m ) :
				$name  = isset( $m['member_name'] )        ? $m['member_name']        : '';
				$role  = isset( $m['member_role'] )        ? $m['member_role']        : '';
				$creds = isset( $m['member_credentials'] ) ? $m['member_credentials'] : '';
				$photo = isset( $m['member_photo'] )       ? $m['member_photo']       : '';
				$first = $name ? strtoupper( explode( ' ', $name )[0] ) : 'PORTRAIT';
				?>
				<div class="gen2-schem-team__member">
					<?php if ( $photo ) : ?>
						<img class="gen2-schem-team__member-photo" src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
					<?php else : ?>
						<?php gen2_ph( 'PORTRAIT · ' . $first, false, 'gen2-ph--portrait' ); ?>
					<?php endif; ?>
					<div class="gen2-schem-team__member-body">
						<?php if ( $name )  : ?><div class="gen2-schem-team__member-name anton"><?php echo esc_html( $name ); ?></div><?php endif; ?>
						<?php if ( $role )  : ?><div class="gen2-schem-team__member-role mono"><?php echo esc_html( $role ); ?></div><?php endif; ?>
						<?php if ( $creds ) : ?><div class="gen2-schem-team__member-creds mono"><?php echo esc_html( $creds ); ?></div><?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- ────────── CTA ────────── -->
	<?php
	$cta_title_before    = gen2_meta( 'gen2_cta_title_before',    "LET'S BUILD\nSOMETHING" );
	$cta_title_underline = gen2_meta( 'gen2_cta_title_underline', 'HEAVY.' );
	$cta_lead            = gen2_meta( 'gen2_cta_lead',            'Half-day plant visit. Free feasibility memo. No NDAs to start.' );
	$cta_btn_text        = gen2_meta( 'gen2_cta_btn_text',        '+ Start a Project &rarr;' );
	$cta_btn_url         = gen2_meta( 'gen2_cta_btn_url',         '#' );
	$cta_contact         = gen2_meta( 'gen2_cta_contact',         '(503) 555-0142 &nbsp;&middot;&nbsp; HELLO@GEN2AUTOMATION.COM' );
	?>
	<section class="gen2-schem-cta">
		<div class="gen2-schem-cta__grid gen2-grid-bg"></div>
		<div class="gen2-schem-cta__main">
			<h2 class="gen2-schem-cta__title anton">
				<?php gen2_render_lines( $cta_title_before ); ?>
				<?php if ( $cta_title_underline ) : ?>
					<br><span class="gen2-schem-cta__title-underline"><?php echo esc_html( $cta_title_underline ); ?></span>
				<?php endif; ?>
			</h2>
			<div>
				<?php if ( $cta_lead ) : ?>
					<div class="gen2-schem-cta__lead sans">
						<?php gen2_render_wysiwyg( $cta_lead ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $cta_btn_text ) : ?>
					<a class="gen2-schem-cta__btn mono" href="<?php echo esc_url( $cta_btn_url ?: '#' ); ?>"><?php echo wp_kses_post( $cta_btn_text ); ?></a>
				<?php endif; ?>
				<?php if ( $cta_contact ) : ?>
					<div class="gen2-schem-cta__phone mono"><?php echo wp_kses_post( $cta_contact ); ?></div>
				<?php endif; ?>
			</div>
		</div>
	</section>
    <?php /*
	<!-- ────────── FOOTER ────────── -->
	<footer class="gen2-schem-footer">
		<div class="gen2-schem-footer__cols">
			<div>
				<?php gen2_mark( 'dark', 1.3 ); ?>
				<p class="gen2-schem-footer__about sans">
					Industrial automation, control systems, and panel fabrication for modern manufacturing.
				</p>
				<div class="gen2-schem-footer__codesys"><?php gen2_codesys_mark( 'light', 0.6 ); ?></div>
			</div>
			<?php
			$cols = array(
				array( 'SERVICES', array( 'Automation Consulting', 'Process Control', 'Panel Fabrication', 'CODESYS Training' ) ),
				array( 'COMPANY',  array( 'About', 'Work', 'Careers', 'Contact' ) ),
				array( 'OFFICE',   array( '7124 SW Hampton St', 'Tigard, OR 97223', '(503) 555-0142', 'hello@gen2automation.com' ) ),
			);
			foreach ( $cols as $col ) : ?>
				<div>
					<div class="gen2-schem-footer__col-title mono"><?php echo esc_html( $col[0] ); ?></div>
					<?php foreach ( $col[1] as $line ) : ?>
						<div class="gen2-schem-footer__col-item sans"><?php echo esc_html( $line ); ?></div>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="gen2-schem-footer__legal mono">
			<span>&copy; <?php echo date( 'Y' ); ?> GEN2 AUTOMATION LLC &middot; ALL RIGHTS RESERVED</span>
			<span>UL-508A &middot; CODESYS APPLICATION PARTNER &middot; OREGON</span>
			<span>GEN2AUTOMATION.COM</span>
		</div>
	</footer>
	*/ ?>
</div>

<?php get_footer(); ?>
