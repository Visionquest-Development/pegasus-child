<?php
/*
	Template Name: Gen2 - About
*/

/**
 * About page. Three sections — Hero, Mission Statement, Team. The team
 * grid pulls from the Staff page so the leadership roster is edited in
 * one place and stays in sync across the site.
 */

require_once get_stylesheet_directory() . '/inc/gen2-design.php';

get_header();

$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div class="gen2 gen2-about-page">

	<?php
	/* ───── 1 — HERO ───────────────────────────────────────────────── */
	$about_subtitle = gen2_meta( 'gen2_about_subtitle',     '&sect; 01 &middot; ABOUT' );
	$about_before   = gen2_meta( 'gen2_about_title_before', 'OUR' );
	$about_accent   = gen2_meta( 'gen2_about_title_accent', 'PRINCIPALS.' );
	$about_intro    = gen2_meta( 'gen2_about_intro',        'Gen2 Automation is engineering-led. We were founded by panel builders and PLC programmers, and the people who run the company today are still the people who specify, code, build, and commission the work.' );
	?>
	<section class="gen2-about-hero">
		<div class="gen2-about-hero__doc mono">
			<span><?php echo wp_kses_post( $about_subtitle ); ?></span>
			<span>SHEET 01 / 03</span>
		</div>
		<div class="gen2-about-hero__main">
			<h1 class="gen2-about-hero__title anton">
				<?php gen2_render_lines( $about_before ); ?>
				<?php if ( $about_accent ) : ?>
					<br><span class="gen2-about-hero__title-accent"><?php echo wp_kses_post( $about_accent ); ?></span>
				<?php endif; ?>
			</h1>
			<?php if ( $about_intro ) : ?>
				<div class="gen2-about-hero__intro sans">
					<?php gen2_render_wysiwyg( $about_intro ); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php
	/* ───── 2 — MISSION STATEMENT ──────────────────────────────────── */
	$mission_subtitle = gen2_meta( 'gen2_about_mission_subtitle',     '&sect; 02 &middot; MISSION' );
	$mission_before   = gen2_meta( 'gen2_about_mission_title_before', 'WHAT WE\'RE' );
	$mission_accent   = gen2_meta( 'gen2_about_mission_title_accent', 'HERE TO BUILD.' );
	$mission_body     = gen2_meta( 'gen2_about_mission_body',         '<p>To build the most reliable industrial control and automation systems in the Pacific Northwest — engineered first, fabricated in-house, and supported by the same engineers who shipped them.</p><p>We measure success in years of uptime, not in launch announcements.</p>' );
	?>
	<section class="gen2-about-mission">
		<div class="gen2-about-mission__doc mono">
			<span><?php echo wp_kses_post( $mission_subtitle ); ?></span>
			<span>SHEET 02 / 03</span>
		</div>
		<div class="gen2-about-mission__main">
			<h2 class="gen2-about-mission__title anton">
				<?php gen2_render_lines( $mission_before ); ?>
				<?php if ( $mission_accent ) : ?>
					<br><span class="gen2-about-mission__title-accent"><?php echo wp_kses_post( $mission_accent ); ?></span>
				<?php endif; ?>
			</h2>
			<div class="gen2-about-mission__body news">
				<?php gen2_render_wysiwyg( $mission_body ); ?>
			</div>
		</div>
	</section>

	<?php
	/* ───── 3 — TEAM / OUR PRINCIPALS ──────────────────────────────── */
	$team_subtitle = gen2_meta( 'gen2_about_team_subtitle',     '&sect; 03 &middot; OUR PRINCIPALS' );
	$team_before   = gen2_meta( 'gen2_about_team_title_before', 'THE PEOPLE' );
	$team_accent   = gen2_meta( 'gen2_about_team_title_accent', 'BEHIND THE WORK.' );
	$team_intro    = gen2_meta( 'gen2_about_team_intro',        'Every Gen2 project is led by a senior engineer with personal ownership of the outcome.' );

	$team_fallback = array(
		array( 'member_name' => 'MARCUS CHEN',   'member_role' => 'Founder · Principal Controls', 'member_credentials' => 'M.Sc EECS · 22 yrs',     'member_photo' => '' ),
		array( 'member_name' => 'PRIYA ANAND',   'member_role' => 'VP Engineering',                'member_credentials' => 'PMP · 15 yrs',           'member_photo' => '' ),
		array( 'member_name' => 'DALE WHITFORD', 'member_role' => 'Director, Panel Shop',          'member_credentials' => 'UL-508A · 24 yrs',       'member_photo' => '' ),
		array( 'member_name' => 'SARA LEHMANN',  'member_role' => 'Lead CODESYS Architect',        'member_credentials' => 'CODESYS Cert. · 11 yrs', 'member_photo' => '' ),
	);
	// Team members now live on this page (About — 4 metabox). The Homepage
	// section 8 reads from here via gen2_get_about_page_id().
	$team_members   = gen2_meta_group( 'gen2_team_members', $team_fallback );
	$team_members   = array_values( array_filter( $team_members, function( $m ) {
		$n = isset( $m['member_name'] ) ? trim( (string) $m['member_name'] ) : '';
		$r = isset( $m['member_role'] ) ? trim( (string) $m['member_role'] ) : '';
		$p = isset( $m['member_photo'] ) ? trim( (string) $m['member_photo'] ) : '';
		return ( '' !== $n || '' !== $r || '' !== $p );
	} ) );
	?>
	<section class="gen2-schem-team gen2-about-team">
		<div class="gen2-schem-team__doc mono">
			<span><?php echo wp_kses_post( $team_subtitle ); ?></span>
			<span>SHEET 03 / 03</span>
		</div>
		<div class="gen2-schem-team__head">
			<h2 class="gen2-schem-team__title anton">
				<?php gen2_render_lines( $team_before ); ?>
				<?php if ( $team_accent ) : ?>
					<br><span class="gen2-schem-team__title-accent"><?php echo wp_kses_post( $team_accent ); ?></span>
				<?php endif; ?>
			</h2>
			<?php if ( $team_intro ) : ?>
				<div class="gen2-schem-team__intro sans">
					<?php gen2_render_wysiwyg( $team_intro ); ?>
				</div>
			<?php endif; ?>
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

</div>

<?php get_footer(); ?>
