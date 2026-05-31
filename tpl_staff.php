<?php
/*
	Template Name: Gen2 - Staff
*/

/**
 * Staff / leadership page. Reuses the homepage's team visual language
 * (`.gen2-schem-team*` classes + a `.gen2-staff-page` scope that widens
 * the layout for a dedicated page) and pulls the same `gen2_team_members`
 * roster the homepage section 8 uses, so editing one place updates both.
 */

require_once get_stylesheet_directory() . '/inc/gen2-design.php';

get_header();

// Match tpl_services.php / tpl_experience.php behaviour: include the
// additional / sticky header when the parent theme is using header-three.
$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}

$staff_subtitle     = gen2_meta( 'gen2_staff_subtitle',     '&sect; STAFF &middot; LEADERSHIP' );
$staff_title_before = gen2_meta( 'gen2_staff_title_before', 'THE PEOPLE' );
$staff_title_accent = gen2_meta( 'gen2_staff_title_accent', 'ON THE FLOOR.' );
$staff_intro        = gen2_meta( 'gen2_staff_intro',        "Every Gen2 project is led by an engineer who's spent the day in safety glasses, rope-tagged a panel, or argued with a kinematic transform at 2 AM. Meet the people behind the work." );

$team_fallback = array(
	array( 'member_name' => 'MARCUS CHEN',   'member_role' => 'Founder · Principal Controls', 'member_credentials' => 'M.Sc EECS · 22 yrs',     'member_photo' => '', 'member_bio' => '' ),
	array( 'member_name' => 'PRIYA ANAND',   'member_role' => 'VP Engineering',                'member_credentials' => 'PMP · 15 yrs',           'member_photo' => '', 'member_bio' => '' ),
	array( 'member_name' => 'DALE WHITFORD', 'member_role' => 'Director, Panel Shop',          'member_credentials' => 'UL-508A · 24 yrs',       'member_photo' => '', 'member_bio' => '' ),
	array( 'member_name' => 'SARA LEHMANN',  'member_role' => 'Lead CODESYS Architect',        'member_credentials' => 'CODESYS Cert. · 11 yrs', 'member_photo' => '', 'member_bio' => '' ),
);
$team_members = gen2_meta_group( 'gen2_team_members', $team_fallback );
$team_members = array_values( array_filter( $team_members, function( $m ) {
	$n = isset( $m['member_name'] ) ? trim( (string) $m['member_name'] ) : '';
	$r = isset( $m['member_role'] ) ? trim( (string) $m['member_role'] ) : '';
	$p = isset( $m['member_photo'] ) ? trim( (string) $m['member_photo'] ) : '';
	return ( '' !== $n || '' !== $r || '' !== $p );
} ) );
?>

<div class="gen2 gen2-staff-page">

	<section class="gen2-schem-team">
		<div class="gen2-schem-team__doc mono">
			<span><?php echo wp_kses_post( $staff_subtitle ); ?></span>
			<span>GEN2 AUTOMATION &middot; TIGARD, OR</span>
		</div>
		<div class="gen2-schem-team__head">
			<h1 class="gen2-schem-team__title anton">
				<?php gen2_render_lines( $staff_title_before ); ?>
				<?php if ( $staff_title_accent ) : ?>
					<br><span class="gen2-schem-team__title-accent"><?php echo esc_html( $staff_title_accent ); ?></span>
				<?php endif; ?>
			</h1>
			<div class="gen2-schem-team__intro sans">
				<?php gen2_render_wysiwyg( $staff_intro ); ?>
			</div>
		</div>
		<div class="gen2-schem-team__grid gen2-staff-grid">
			<?php foreach ( $team_members as $m ) :
				$name  = isset( $m['member_name'] )        ? $m['member_name']        : '';
				$role  = isset( $m['member_role'] )        ? $m['member_role']        : '';
				$creds = isset( $m['member_credentials'] ) ? $m['member_credentials'] : '';
				$photo = isset( $m['member_photo'] )       ? $m['member_photo']       : '';
				$bio   = isset( $m['member_bio'] )         ? $m['member_bio']         : '';
				$first = $name ? strtoupper( explode( ' ', $name )[0] ) : 'PORTRAIT';
				?>
				<div class="gen2-schem-team__member gen2-staff-member">
					<?php if ( $photo ) : ?>
						<img class="gen2-schem-team__member-photo" src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
					<?php else : ?>
						<?php gen2_ph( 'PORTRAIT · ' . $first, false, 'gen2-ph--portrait' ); ?>
					<?php endif; ?>
					<div class="gen2-schem-team__member-body">
						<?php if ( $name )  : ?><div class="gen2-schem-team__member-name anton"><?php echo esc_html( $name ); ?></div><?php endif; ?>
						<?php if ( $role )  : ?><div class="gen2-schem-team__member-role mono"><?php echo esc_html( $role ); ?></div><?php endif; ?>
						<?php if ( $creds ) : ?><div class="gen2-schem-team__member-creds mono"><?php echo esc_html( $creds ); ?></div><?php endif; ?>
						<?php if ( $bio )   : ?>
							<div class="gen2-staff-member__bio sans">
								<?php gen2_render_wysiwyg( $bio ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

</div>

<?php get_footer(); ?>
