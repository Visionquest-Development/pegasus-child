<?php
/**
 * Shared design parts for the Gen2 Automation templates
 * (Technical Schematic homepage + Services inner page).
 *
 * All styling lives in style.css; the helpers here only emit semantic
 * markup with class names that the stylesheet targets.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'gen2_size_modifier' ) ) {
/**
 * Map a numeric size hint from the original React design into one of the
 * discrete `--xs / --sm / --md / --lg / --xl` modifier classes defined in
 * style.css. Keeps the call sites readable while letting style.css own all
 * sizing decisions.
 */
function gen2_size_modifier( $size ) {
	if ( $size <= 0.7 )  return 'xs';
	if ( $size < 1.0 )   return 'sm';
	if ( $size <= 1.1 )  return 'md';
	if ( $size < 1.35 )  return 'lg';
	return 'xl';
}
}

if ( ! function_exists( 'gen2_ph' ) ) {
function gen2_ph( $label = 'image', $dark = false, $modifier = '' ) {
	$classes = array( 'gen2-ph' );
	if ( $dark )     { $classes[] = 'gen2-ph--dark'; }
	if ( $modifier ) { $classes[] = $modifier; }
	echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
	echo '<span class="gen2-ph__tag">&#9635; ' . esc_html( $label ) . '</span>';
	echo '</div>';
}
}

if ( ! function_exists( 'gen2_mark' ) ) {
/** Gen2 hexagon + wordmark. */
function gen2_mark( $tone = 'dark', $size = 1, $show_tagline = false ) {
	$mod      = gen2_size_modifier( $size );
	$src_file = ( 'dark' === $tone ) ? 'gen2-mark-white.png' : 'gen2-mark-color.png';
	$src      = esc_url( get_stylesheet_directory_uri() . '/assets/' . $src_file );
	$classes  = 'gen2-mark gen2-mark--' . esc_attr( $tone ) . ' gen2-mark--' . esc_attr( $mod );
	?>
	<span class="<?php echo $classes; ?>">
		<img class="gen2-mark__img" src="<?php echo $src; ?>" alt="Gen2 Automation" />
		<span class="gen2-mark__text">
			<span class="gen2-mark__name">Gen2&nbsp;Automation</span>
			<?php if ( $show_tagline ) : ?>
				<span class="gen2-mark__tag">Next Generation Industrial Control</span>
			<?php endif; ?>
		</span>
	</span>
	<?php
}
}

if ( ! function_exists( 'gen2_codesys_mark' ) ) {
/** Faux CODESYS authorized partner badge (no real branding). */
function gen2_codesys_mark( $tone = 'light', $size = 1 ) {
	$mod     = gen2_size_modifier( $size );
	$classes = 'gen2-codesys-mark gen2-codesys-mark--' . esc_attr( $tone ) . ' gen2-codesys-mark--' . esc_attr( $mod );
	?>
	<span class="<?php echo $classes; ?>">
		<span class="gen2-codesys-mark__icon">
			<span class="gen2-codesys-mark__brace">{ }</span>
			<span class="gen2-codesys-mark__corner gen2-codesys-mark__corner--tl"></span>
			<span class="gen2-codesys-mark__corner gen2-codesys-mark__corner--br"></span>
		</span>
		<span class="gen2-codesys-mark__text">
			<span class="gen2-codesys-mark__caption">AUTHORIZED</span>
			<span class="gen2-codesys-mark__word">CODESYS<span class="gen2-codesys-mark__reg">&reg;</span></span>
			<span class="gen2-codesys-mark__caption">APPLICATION&nbsp;PARTNER</span>
		</span>
	</span>
	<?php
}
}

if ( ! function_exists( 'gen2_schematic_arm' ) ) {
function gen2_schematic_arm( $variant_class = 'gen2-svg--on-light' ) {
	$dots_id = 'gen2-arm-dots-' . substr( md5( $variant_class . 'arm' ), 0, 6 );
	?>
	<svg class="gen2-svg <?php echo esc_attr( $variant_class ); ?>" viewBox="0 0 600 400" aria-hidden="true">
		<defs>
			<pattern id="<?php echo esc_attr( $dots_id ); ?>" width="10" height="10" patternUnits="userSpaceOnUse">
				<circle cx="1" cy="1" r="0.6" fill="var(--svg-stroke)" opacity="0.3" />
			</pattern>
		</defs>
		<rect width="600" height="400" fill="url(#<?php echo esc_attr( $dots_id ); ?>)" />
		<rect x="240" y="320" width="120" height="40" fill="none" stroke="var(--svg-stroke)" stroke-width="1.5" />
		<line x1="240" y1="360" x2="360" y2="360" stroke="var(--svg-stroke)" stroke-width="1.5" />
		<?php foreach ( array( 250, 270, 290, 310, 330, 350 ) as $x ) : ?>
			<line x1="<?php echo $x; ?>" y1="360" x2="<?php echo $x - 10; ?>" y2="380" stroke="var(--svg-stroke)" stroke-width="1" />
		<?php endforeach; ?>
		<circle cx="300" cy="320" r="22" fill="none" stroke="var(--svg-stroke)" stroke-width="1.5" />
		<circle cx="300" cy="320" r="6" fill="var(--svg-accent)" />
		<line x1="300" y1="320" x2="200" y2="200" stroke="var(--svg-stroke)" stroke-width="2" />
		<line x1="295" y1="318" x2="195" y2="198" stroke="var(--svg-stroke)" stroke-width="0.7" opacity="0.6" />
		<circle cx="200" cy="200" r="14" fill="none" stroke="var(--svg-stroke)" stroke-width="1.5" />
		<circle cx="200" cy="200" r="4" fill="var(--svg-accent)" />
		<line x1="200" y1="200" x2="380" y2="120" stroke="var(--svg-stroke)" stroke-width="2" />
		<circle cx="380" cy="120" r="10" fill="none" stroke="var(--svg-stroke)" stroke-width="1.5" />
		<line x1="380" y1="120" x2="430" y2="100" stroke="var(--svg-stroke)" stroke-width="1.5" />
		<line x1="430" y1="100" x2="445" y2="86"  stroke="var(--svg-stroke)" stroke-width="1.5" />
		<line x1="430" y1="100" x2="450" y2="110" stroke="var(--svg-stroke)" stroke-width="1.5" />
		<line x1="40" y1="380" x2="560" y2="380" stroke="var(--svg-stroke)" stroke-width="0.5" stroke-dasharray="2 2" opacity="0.5" />
		<text x="40"  y="395" fill="var(--svg-stroke)" opacity="0.55" font-family="JetBrains Mono, monospace" font-size="9">0</text>
		<text x="540" y="395" fill="var(--svg-stroke)" opacity="0.55" font-family="JetBrains Mono, monospace" font-size="9">2400mm</text>
		<text x="380" y="80"  fill="var(--svg-stroke)" opacity="0.65" font-family="JetBrains Mono, monospace" font-size="9">EOAT-04</text>
		<text x="200" y="180" fill="var(--svg-stroke)" opacity="0.65" font-family="JetBrains Mono, monospace" font-size="9">J3</text>
		<text x="304" y="295" fill="var(--svg-stroke)" opacity="0.65" font-family="JetBrains Mono, monospace" font-size="9">J1</text>
		<g opacity="0.4" stroke="var(--svg-accent)" stroke-width="0.8">
			<line x1="80" y1="60" x2="120" y2="60" />
			<line x1="100" y1="40" x2="100" y2="80" />
		</g>
		<text x="125" y="63" fill="var(--svg-accent)" font-family="JetBrains Mono, monospace" font-size="9" opacity="0.7">XY &middot; WORLD</text>
	</svg>
	<?php
}
}

if ( ! function_exists( 'gen2_schematic_panel' ) ) {
function gen2_schematic_panel( $variant_class = 'gen2-svg--on-light' ) { ?>
	<svg class="gen2-svg <?php echo esc_attr( $variant_class ); ?>" viewBox="0 0 600 400" aria-hidden="true">
		<rect x="40" y="40" width="520" height="320" fill="none" stroke="var(--svg-stroke)" stroke-width="2" />
		<rect x="48" y="48" width="504" height="304" fill="none" stroke="var(--svg-stroke)" stroke-width="0.4" stroke-dasharray="3 3" opacity="0.5" />
		<?php foreach ( array( 100, 180, 260 ) as $y ) : ?>
			<g>
				<line x1="60" y1="<?php echo $y; ?>" x2="540" y2="<?php echo $y; ?>" stroke="var(--svg-stroke)" stroke-width="1" />
				<line x1="60" y1="<?php echo $y + 6; ?>" x2="540" y2="<?php echo $y + 6; ?>" stroke="var(--svg-stroke)" stroke-width="0.4" />
			</g>
		<?php endforeach; ?>
		<rect x="70" y="70" width="120" height="50" fill="var(--svg-accent)" opacity="0.92" />
		<text x="80" y="92"  fill="#0C0C0C" font-family="JetBrains Mono, monospace" font-size="10" font-weight="600">PLC &middot; CODESYS</text>
		<text x="80" y="108" fill="#0C0C0C" font-family="JetBrains Mono, monospace" font-size="9" opacity="0.7">CPU-1518F</text>
		<?php for ( $i = 0; $i < 6; $i++ ) :
			$x = 210 + $i * 50;
			$num = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ); ?>
			<g>
				<rect x="<?php echo $x; ?>" y="74" width="42" height="42" fill="none" stroke="var(--svg-stroke)" stroke-width="1" />
				<text x="<?php echo $x + 4; ?>" y="90" fill="var(--svg-stroke)" font-family="JetBrains Mono, monospace" font-size="8">IO-<?php echo $num; ?></text>
				<line x1="<?php echo $x + 6; ?>"  y1="100" x2="<?php echo $x + 36; ?>" y2="100" stroke="var(--svg-stroke)" stroke-width="0.5" />
				<line x1="<?php echo $x + 6; ?>"  y1="106" x2="<?php echo $x + 36; ?>" y2="106" stroke="var(--svg-stroke)" stroke-width="0.5" />
			</g>
		<?php endfor; ?>
		<?php for ( $i = 0; $i < 14; $i++ ) : $x = 70 + $i * 32; ?>
			<g>
				<rect x="<?php echo $x; ?>" y="154" width="24" height="34" fill="none" stroke="var(--svg-stroke)" stroke-width="0.8" />
				<line x1="<?php echo $x + 12; ?>" y1="160" x2="<?php echo $x + 12; ?>" y2="180" stroke="var(--svg-accent)" stroke-width="2" />
			</g>
		<?php endfor; ?>
		<?php for ( $i = 0; $i < 4; $i++ ) : $x = 70 + $i * 90; ?>
			<g>
				<rect x="<?php echo $x; ?>" y="234" width="74" height="60" fill="none" stroke="var(--svg-stroke)" stroke-width="1" />
				<text x="<?php echo $x + 8; ?>" y="252" fill="var(--svg-stroke)" font-family="JetBrains Mono, monospace" font-size="8">VFD-<?php echo $i + 1; ?></text>
				<circle cx="<?php echo $x + 37; ?>" cy="270" r="6" fill="none" stroke="var(--svg-stroke)" stroke-width="0.7" />
				<circle cx="<?php echo $x + 37; ?>" cy="270" r="2" fill="var(--svg-accent)" />
			</g>
		<?php endfor; ?>
		<?php for ( $i = 0; $i < 30; $i++ ) : $x = 70 + $i * 16; ?>
			<circle cx="<?php echo $x; ?>" cy="320" r="2.4" fill="none" stroke="var(--svg-stroke)" stroke-width="0.7" />
		<?php endfor; ?>
		<text x="540" y="56" fill="var(--svg-stroke)" opacity="0.6" font-family="JetBrains Mono, monospace" font-size="9" text-anchor="end">PNL-A &middot; GEN2-2026-0341</text>
	</svg>
	<?php
}
}

if ( ! function_exists( 'gen2_schematic_flow' ) ) {
/**
 * Six-step (or N-step) flow diagram.
 *
 * @param string     $variant_class CSS variant for stroke/accent colors.
 * @param array|null $custom_labels Optional array of step labels. When passed,
 *                                  spacing rescales so any count (>= 2) fits
 *                                  the 1200-wide viewBox. Numbering ("01" …)
 *                                  is auto-generated from index.
 */
function gen2_schematic_flow( $variant_class = 'gen2-svg--on-light', $custom_labels = null ) {
	if ( ! is_array( $custom_labels ) || empty( $custom_labels ) ) {
		$custom_labels = array( 'DISCOVERY', 'DESIGN', 'FABRICATE', 'PROGRAM', 'INTEGRATE', 'SUPPORT' );
	}
	$count   = count( $custom_labels );
	$pad_x   = 60;
	$avail   = 1200 - ( 2 * $pad_x );
	$spacing = ( $count > 1 ) ? ( $avail / ( $count - 1 ) ) : 0;
	?>
	<svg class="gen2-svg <?php echo esc_attr( $variant_class ); ?>" viewBox="0 0 1200 200" aria-hidden="true">
		<?php foreach ( $custom_labels as $i => $label ) :
			$x   = $pad_x + ( $i * $spacing );
			$num = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ); ?>
			<g>
				<circle cx="<?php echo $x; ?>" cy="100" r="34" fill="none" stroke="var(--svg-stroke)" stroke-width="1.2" />
				<circle cx="<?php echo $x; ?>" cy="100" r="3" fill="var(--svg-accent)" />
				<text x="<?php echo $x; ?>" y="160" text-anchor="middle" fill="var(--svg-stroke)" font-family="JetBrains Mono, monospace" font-size="11" font-weight="600"><?php echo esc_html( strtoupper( $label ) ); ?></text>
				<text x="<?php echo $x; ?>" y="178" text-anchor="middle" fill="var(--svg-stroke)" opacity="0.5" font-family="JetBrains Mono, monospace" font-size="9"><?php echo esc_html( $num ); ?></text>
				<?php if ( $i < $count - 1 ) :
					$x1 = $x + 34;
					$x2 = $x + $spacing - 34; ?>
					<g>
						<line x1="<?php echo $x1; ?>" y1="100" x2="<?php echo $x2; ?>" y2="100" stroke="var(--svg-stroke)" stroke-width="0.8" stroke-dasharray="3 3" />
						<polygon points="<?php echo $x2; ?>,100 <?php echo $x2 - 6; ?>,96 <?php echo $x2 - 6; ?>,104" fill="var(--svg-stroke)" />
					</g>
				<?php endif; ?>
			</g>
		<?php endforeach; ?>
	</svg>
	<?php
}
}

if ( ! function_exists( 'gen2_client_logos' ) ) {
function gen2_client_logos( $tone = 'dark' ) {
	$items = array(
		array( 'AMAZON',            'gen2-clients__item--archivo' ),
		array( 'NORTHFIELD',        'gen2-clients__item--news-it' ),
		array( 'VANGUARD METALS',   'gen2-clients__item--narrow' ),
		array( 'KILN+CO.',          'gen2-clients__item--archivo-med' ),
		array( 'MERIDIAN/3',        'gen2-clients__item--mono' ),
		array( 'PACIFIC FOODWORKS', 'gen2-clients__item--archivo' ),
	);
	$tone_class = ( 'dark' === $tone ) ? 'gen2-clients--dark' : 'gen2-clients--light';
	?>
	<div class="gen2-clients <?php echo esc_attr( $tone_class ); ?>">
		<?php foreach ( $items as $it ) : ?>
			<div class="gen2-clients__item <?php echo esc_attr( $it[1] ); ?>"><?php echo esc_html( $it[0] ); ?></div>
		<?php endforeach; ?>
	</div>
	<?php
}
}
