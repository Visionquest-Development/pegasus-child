<?php
/**
 * Insurance Guy Joe — Open Enrollment banner (home page).
 *
 * Managed without code in wp-admin: Appearance → Customize → Open Enrollment Banner.
 *  - "Show the banner" turns it on/off.
 *  - Optional start/end dates: when set, the banner only shows between them (site timezone).
 *  - "Repeat every year": the start/end/deadline month+day are reused each year, so the
 *    banner can be left ON and it will appear automatically every Open Enrollment season.
 *  - Text fields accept tokens: {start}, {end}, {deadline}, {coverage_year}, {days_left}.
 *
 * Defaults = official 2027 plan-year dates (verified Nov 12, 2026 on HealthCare.gov,
 * GeorgiaAccess.gov and GetCoveredIllinois.gov): Nov 1, 2026 – Jan 15, 2027;
 * enroll by Dec 15, 2026 for coverage starting Jan 1, 2027.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default settings (theme_mod keys without the igj_oe_ prefix).
 */
function igj_oe_defaults() {
	return array(
		'enabled'      => true,
		'repeat'       => true,
		'start'        => '2026-11-01',
		'end'          => '2027-01-15',
		'deadline'     => '2026-12-15',
		'eyebrow'      => __( 'Happening now', 'pegasus' ),
		'headline'     => __( 'Open Enrollment for {coverage_year} Health Coverage Is Open!', 'pegasus' ),
		'dates'        => __( '{start} – {end}', 'pegasus' ),
		'body'         => __( 'Enroll by {deadline} for coverage that starts January 1, {coverage_year}. After {end}, you can only enroll or change plans with a qualifying life event. Our help is always free. Applies to HealthCare.gov, Georgia Access and Get Covered Illinois.', 'pegasus' ),
		'countdown'    => true,
		'cta_label'    => __( 'Schedule Your Free Consultation', 'pegasus' ),
		'cta_url'      => '',
		'show_phone'   => true,
		'link_label'   => __( 'Open Enrollment guide', 'pegasus' ),
		'link_url'     => '/learn/open-enrollment-guide/',
	);
}

function igj_oe_get( $key ) {
	$d = igj_oe_defaults();
	return get_theme_mod( 'igj_oe_' . $key, $d[ $key ] ?? '' );
}

/* ---------- Customizer ---------- */

function igj_oe_sanitize_checkbox( $v ) {
	return ( true === $v || '1' === $v || 1 === $v || 'on' === $v ) ? true : false;
}

function igj_oe_sanitize_date( $v ) {
	$v = trim( (string) $v );
	return preg_match( '/^\d{4}-\d{2}-\d{2}$/', $v ) ? $v : '';
}

function igj_oe_sanitize_url_or_path( $v ) {
	$v = trim( (string) $v );
	if ( '' === $v ) {
		return '';
	}
	if ( 0 === strpos( $v, '/' ) && 0 !== strpos( $v, '//' ) ) {
		return '/' . ltrim( preg_replace( '#[^A-Za-z0-9/_\-.\#?=&%]#', '', $v ), '/' );
	}
	return esc_url_raw( $v, array( 'http', 'https', 'tel', 'mailto' ) );
}

add_action( 'customize_register', function ( $wp_customize ) {
	$d = igj_oe_defaults();
	$wp_customize->add_section( 'igj_oe_banner', array(
		'title'       => __( 'Open Enrollment Banner', 'pegasus' ),
		'priority'    => 25,
		'description' => __( 'The large banner at the top of the home page. Leave it ON with “Repeat every year” checked and it appears automatically between the start and end dates every year. Uncheck “Show the banner” to hide it right away. Tokens you can use in the text: {start}, {end}, {deadline}, {coverage_year}, {days_left}.', 'pegasus' ),
	) );

	$fields = array(
		'enabled'    => array( 'checkbox', __( 'Show the banner', 'pegasus' ), '' ),
		'repeat'     => array( 'checkbox', __( 'Repeat every year (uses the month & day of the dates below)', 'pegasus' ), '' ),
		'start'      => array( 'date', __( 'Start date', 'pegasus' ), __( 'Banner shows from this day. Leave empty to show whenever it is ON.', 'pegasus' ) ),
		'end'        => array( 'date', __( 'End date', 'pegasus' ), __( 'Last day the banner shows (last day of Open Enrollment).', 'pegasus' ) ),
		'deadline'   => array( 'date', __( 'January 1 coverage deadline', 'pegasus' ), __( 'Used by the {deadline} token.', 'pegasus' ) ),
		'eyebrow'    => array( 'text', __( 'Small label above the headline', 'pegasus' ), '' ),
		'headline'   => array( 'text', __( 'Headline', 'pegasus' ), '' ),
		'dates'      => array( 'text', __( 'Dates line', 'pegasus' ), '' ),
		'body'       => array( 'textarea', __( 'Body text', 'pegasus' ), '' ),
		'countdown'  => array( 'checkbox', __( 'Show “X days left to enroll” (uses the end date)', 'pegasus' ), '' ),
		'cta_label'  => array( 'text', __( 'Button label', 'pegasus' ), '' ),
		'cta_url'    => array( 'text', __( 'Button link', 'pegasus' ), __( 'Leave empty to use the Picktime scheduling link. A page path like /contact/ or a full URL also works.', 'pegasus' ) ),
		'show_phone' => array( 'checkbox', __( 'Show the call button', 'pegasus' ), '' ),
		'link_label' => array( 'text', __( 'Text link label', 'pegasus' ), '' ),
		'link_url'   => array( 'text', __( 'Text link URL', 'pegasus' ), '' ),
	);
	foreach ( $fields as $key => $f ) {
		list( $type, $label, $desc ) = $f;
		$sanitize = 'sanitize_text_field';
		if ( 'checkbox' === $type ) {
			$sanitize = 'igj_oe_sanitize_checkbox';
		} elseif ( 'date' === $type ) {
			$sanitize = 'igj_oe_sanitize_date';
		} elseif ( 'textarea' === $type ) {
			$sanitize = 'sanitize_textarea_field';
		} elseif ( in_array( $key, array( 'cta_url', 'link_url' ), true ) ) {
			$sanitize = 'igj_oe_sanitize_url_or_path';
		}
		$wp_customize->add_setting( 'igj_oe_' . $key, array(
			'default'           => $d[ $key ],
			'sanitize_callback' => $sanitize,
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( 'igj_oe_' . $key, array(
			'section'     => 'igj_oe_banner',
			'label'       => $label,
			'description' => $desc,
			'type'        => $type,
		) );
	}
} );

/* ---------- Date window ---------- */

/**
 * The active window for "today" as array( start, end, deadline ) of DateTimeImmutable, or null.
 * With "repeat", month/day of the saved dates are applied to the current season.
 */
function igj_oe_window( $today = null ) {
	$tz    = wp_timezone();
	$today = $today ? $today : new DateTimeImmutable( 'today', $tz );
	$start = igj_oe_get( 'start' );
	$end   = igj_oe_get( 'end' );
	$dl    = igj_oe_get( 'deadline' );
	$mk    = function ( $ymd ) use ( $tz ) {
		return $ymd ? DateTimeImmutable::createFromFormat( '!Y-m-d', $ymd, $tz ) : null;
	};
	$s = $mk( $start );
	$e = $mk( $end );
	$x = $mk( $dl );

	if ( igj_oe_get( 'repeat' ) && $s && $e ) {
		$y      = (int) $today->format( 'Y' );
		$crosses = $e->format( 'md' ) < $s->format( 'md' );
		$md     = $today->format( 'md' );
		if ( $crosses ) {
			$sy = ( $md >= $s->format( 'md' ) ) ? $y : $y - 1;
			$ey = $sy + 1;
		} else {
			$sy = $y;
			$ey = $y;
		}
		$s = $s->setDate( $sy, (int) $s->format( 'm' ), (int) $s->format( 'd' ) );
		$e = $e->setDate( $ey, (int) $e->format( 'm' ), (int) $e->format( 'd' ) );
		if ( $x ) {
			$xy = ( $x->format( 'md' ) >= $s->format( 'md' ) ) ? $sy : $ey;
			$x  = $x->setDate( $xy, (int) $x->format( 'm' ), (int) $x->format( 'd' ) );
		}
	}
	if ( $s && $today < $s ) {
		return null;
	}
	if ( $e && $today > $e ) {
		return null;
	}
	return array( $s, $e, $x );
}

/**
 * Should the banner render right now?
 */
function igj_oe_is_active() {
	if ( ! igj_oe_get( 'enabled' ) ) {
		return false;
	}
	return (bool) apply_filters( 'igj_oe_is_active', null !== igj_oe_window() );
}

/**
 * Replace {tokens} in banner text.
 */
function igj_oe_tokens( $text, $win ) {
	list( $s, $e, $x ) = $win;
	$fmt  = function ( $d ) {
		return $d ? wp_date( 'F j, Y', $d->getTimestamp() ) : '';
	};
	$days = '';
	if ( $e ) {
		$today = new DateTimeImmutable( 'today', wp_timezone() );
		$days  = (string) max( 0, (int) $today->diff( $e )->format( '%a' ) );
	}
	$cov = $e ? ( $s && $s->format( 'Y' ) !== $e->format( 'Y' ) ? $e->format( 'Y' ) : ( $s && (int) $s->format( 'n' ) >= 10 ? (string) ( (int) $s->format( 'Y' ) + 1 ) : $e->format( 'Y' ) ) ) : '';
	return strtr( (string) $text, array(
		'{start}'         => $fmt( $s ),
		'{end}'           => $fmt( $e ),
		'{deadline}'      => $fmt( $x ),
		'{coverage_year}' => $cov,
		'{days_left}'     => $days,
	) );
}

/**
 * Print the banner (called from the home template). Returns '' when inactive.
 */
function igj_oe_banner() {
	if ( ! igj_oe_is_active() ) {
		return '';
	}
	$win  = igj_oe_window();
	$t    = function ( $k ) use ( $win ) {
		return igj_oe_tokens( igj_oe_get( $k ), $win );
	};
	$cta_url = igj_oe_get( 'cta_url' );
	$cta_url = $cta_url ? ( 0 === strpos( $cta_url, '/' ) ? home_url( $cta_url ) : $cta_url ) : igj_site( 'quote_url' );
	$ext     = 0 !== strpos( $cta_url, home_url() ) && 0 === strpos( $cta_url, 'http' );
	$link    = igj_oe_get( 'link_url' );
	$link    = $link ? ( 0 === strpos( $link, '/' ) ? home_url( $link ) : $link ) : '';
	$days    = '';
	if ( igj_oe_get( 'countdown' ) && $win[1] ) {
		$n    = (int) igj_oe_tokens( '{days_left}', $win );
		$days = 0 === $n ? __( 'Last day to enroll!', 'pegasus' ) : sprintf( _n( '%s day left to enroll', '%s days left to enroll', $n, 'pegasus' ), number_format_i18n( $n ) );
	}
	ob_start();
	?>
	<section class="igj-oe" aria-labelledby="igj-oe-title">
		<div class="container">
			<div class="igj-oe__grid">
				<div class="igj-oe__main">
					<p class="igj-oe__eyebrow"><span class="igj-oe__pulse" aria-hidden="true"></span><?php echo esc_html( $t( 'eyebrow' ) ); ?></p>
					<h2 id="igj-oe-title" class="igj-oe__title"><?php echo esc_html( $t( 'headline' ) ); ?></h2>
					<p class="igj-oe__dates"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo esc_html( $t( 'dates' ) ); ?></p>
					<?php if ( $t( 'body' ) ) : ?>
						<p class="igj-oe__body"><?php echo esc_html( $t( 'body' ) ); ?></p>
					<?php endif; ?>
				</div>
				<div class="igj-oe__side">
					<?php if ( $days ) : ?>
						<p class="igj-oe__count"><?php echo esc_html( $days ); ?></p>
					<?php endif; ?>
					<a class="btn igj-btn igj-btn--cta igj-btn--lg igj-oe__cta" href="<?php echo esc_url( $cta_url ); ?>"<?php echo $ext ? ' target="_blank" rel="noopener"' : ''; ?>><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?php echo esc_html( $t( 'cta_label' ) ); ?><?php if ( $ext ) : ?><span class="visually-hidden"> <?php esc_html_e( '(opens in a new tab)', 'pegasus' ); ?></span><?php endif; ?></a>
					<?php if ( igj_oe_get( 'show_phone' ) ) : ?>
						<a class="btn igj-btn igj-btn--outline-light igj-btn--lg igj-oe__call" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php printf( esc_html__( 'Call %s', 'pegasus' ), esc_html( igj_site( 'phone_display' ) ) ); ?></a>
					<?php endif; ?>
					<?php if ( $link && igj_oe_get( 'link_label' ) ) : ?>
						<a class="igj-oe__link" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $t( 'link_label' ) ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
