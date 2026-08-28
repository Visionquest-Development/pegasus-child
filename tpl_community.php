<?php
/*
	Template Name: Community Template
*/

/**
 * Community page template for Hart Family of Home Services.
 *
 * Header/footer handled by the parent theme via get_header()/get_footer().
 *
 * Fully CMB2-driven: every string/image ships with a default and is replaced by
 * its field on the Community edit screen ("Community Page Content" metabox in
 * functions.php). Repeatable groups power the Partners cards and the Get-Involved
 * cards. See hfhs_comm_field() / hfhs_comm_group(). No inline CSS (per-record
 * images are data, not styling).
 */
?>
<?php get_header(); ?>

<?php
	$hero_bg = hfhs_comm_field( 'hero_image', get_stylesheet_directory_uri() . '/images/hero.jpg' );

	$mission_body_default =
		'<p>From sponsoring local scout troops to partnering with Family Promise of DeKalb, we give our time, resources, and hands to the organizations that make our neighborhoods better places to live. When one of our neighbors needs help, our crew shows up &mdash; not for a paycheck, but because that&rsquo;s what family does.</p>' .
		'<p>We believe the best way to build a trusted local business is to actually be part of the community we serve. That means showing up on weekends, donating labor and materials where it matters, and treating every volunteer hour with the same care we bring to every paid job.</p>';

	$partners = hfhs_comm_group( 'partners', array(
		array( 'title' => 'Boy Scouts of America', 'subtitle' => 'Local Troop Support', 'text' => 'We sponsor and support local scout troops through material donations, project help, and time in the field. Josh grew up in scouting and it still shapes how we run this company.' ),
		array( 'title' => 'Family Promise of DeKalb', 'subtitle' => 'Homeless Family Support', 'text' => 'Family Promise helps local families experiencing homelessness get back on their feet. We donate home repair work to partner families and volunteer alongside the team whenever they need hands.' ),
		array( 'title' => 'Local Youth Sports', 'subtitle' => 'Little League Sponsor', 'text' => 'Our crew sponsors local youth baseball and soccer teams across metro Atlanta &mdash; uniforms, equipment, and occasional field repair help at the season start.' ),
		array( 'title' => 'Habitat Partners', 'subtitle' => 'Home Repair Volunteers', 'text' => 'We volunteer with regional Habitat for Humanity and Rebuilding Together chapters on weekend builds and emergency repair projects. Skilled labor where it&rsquo;s needed most.' ),
	) );

	$field_body_default =
		'<p>In August 2025, Josh and Jacob spent a Saturday on a roof in DeKalb County &mdash; repairing shingles and flashing for a Family Promise of North Fulton/DeKalb partner family at no charge. Small job, big difference.</p>' .
		'<p>Family Promise shared the day on their Facebook page. We&rsquo;re grateful for the thanks &mdash; and even more grateful for the work they do year-round.</p>';
	$field_image = hfhs_comm_field( 'field_image', '' );

	$involve = hfhs_comm_group( 'involve', array(
		array( 'title' => 'Nominate an Organization', 'text' => 'Know a local cause that could use a hand? Tell us about it. We read every nomination and reach out directly to organizations that align with our mission.', 'link_label' => 'Send a Nomination &rarr;', 'link_url' => '#' ),
		array( 'title' => 'Volunteer With Us', 'text' => 'We organize volunteer days alongside our partner orgs a few times a year. Swing a hammer with our crew &mdash; no experience required, just a willingness to show up.', 'link_label' => 'Sign Me Up &rarr;', 'link_url' => '#' ),
		array( 'title' => 'Refer a Family in Need', 'text' => 'Know a homeowner, senior, or veteran who needs repair help they can&rsquo;t afford? We complete pro bono projects every year for families referred by their neighbors.', 'link_label' => 'Refer a Family &rarr;', 'link_url' => '#' ),
	) );
?>

<main id="page-wrap" class="hfhs-home hfhs-comm-page">

	<!-- ================= HERO ================= -->
	<section class="hfhs-hero hfhs-comm-hero hfhs-section--dark" id="top" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
		<div class="hfhs-hero__overlay" aria-hidden="true"></div>
		<div class="container hfhs-hero__inner">
			<nav class="hfhs-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<span aria-hidden="true">/</span>
				<span aria-current="page">Community</span>
			</nav>
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_comm_field( 'hero_script', 'Taking care of each other.' ) ); ?></p>
			<h1 class="hfhs-hero__title"><?php echo wp_kses_post( hfhs_comm_field( 'hero_title', 'We&rsquo;re a family &mdash; and we <em>show up</em> for our community.' ) ); ?></h1>
			<p class="hfhs-hero__lead"><?php echo esc_html( hfhs_comm_field( 'hero_text', 'A business is only as strong as the community that supports it. We don’t just operate in Atlanta — we invest in it.' ) ); ?></p>
		</div>
	</section>

	<!-- ================= OUR MISSION ================= -->
	<section class="hfhs-comm-mission hfhs-section--white">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center">
					<p class="hfhs-eyebrow hfhs-eyebrow--line"><?php echo esc_html( hfhs_comm_field( 'mission_eyebrow', 'Our Mission' ) ); ?></p>
					<h2 class="hfhs-display hfhs-comm-mission__title"><?php echo wp_kses_post( hfhs_comm_field( 'mission_title', 'A business is <em>only as strong as the community</em> that supports it.' ) ); ?></h2>
					<div class="hfhs-comm-mission__body"><?php echo wp_kses_post( wpautop( hfhs_comm_field( 'mission_body', $mission_body_default ) ) ); ?></div>
					<p class="hfhs-eyebrow-script hfhs-comm-mission__sign"><?php echo esc_html( hfhs_comm_field( 'mission_sign', 'Built on Trust, Integrity, and Honesty.' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= OUR PARTNERS ================= -->
	<section class="hfhs-partners hfhs-section--light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-partners__head">
					<p class="hfhs-eyebrow"><?php echo esc_html( hfhs_comm_field( 'partners_eyebrow', 'Our Partners' ) ); ?></p>
					<p class="hfhs-eyebrow-script"><?php echo esc_html( hfhs_comm_field( 'partners_script', 'Who we show up for.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-partners__title"><?php echo wp_kses_post( hfhs_comm_field( 'partners_title', 'The organizations <em>we&rsquo;re proud to support.</em>' ) ); ?></h2>
				</div>
			</div>

			<div class="row g-0 hfhs-partners__grid">
				<?php foreach ( $partners as $i => $partner ) : ?>
					<div class="col-12 col-sm-6 col-lg-3">
						<div class="hfhs-pcard">
							<span class="hfhs-pcard__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<h3 class="hfhs-pcard__title"><?php echo wp_kses_post( isset( $partner['title'] ) ? $partner['title'] : '' ); ?></h3>
							<?php if ( ! empty( $partner['subtitle'] ) ) : ?>
								<p class="hfhs-pcard__subtitle"><?php echo esc_html( $partner['subtitle'] ); ?></p>
							<?php endif; ?>
							<p class="hfhs-pcard__text"><?php echo wp_kses_post( isset( $partner['text'] ) ? $partner['text'] : '' ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ================= RECENTLY IN THE FIELD ================= -->
	<section class="hfhs-field hfhs-section--white">
		<div class="container">
			<div class="row g-5 align-items-center">
				<div class="col-lg-6">
					<p class="hfhs-eyebrow"><?php echo esc_html( hfhs_comm_field( 'field_eyebrow', 'Recently in the Field' ) ); ?></p>
					<p class="hfhs-eyebrow-script hfhs-field__script"><?php echo esc_html( hfhs_comm_field( 'field_script', 'From the Family Promise family.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-field__title"><?php echo wp_kses_post( hfhs_comm_field( 'field_title', 'Roof work for a <em>Family Promise</em> household.' ) ); ?></h2>
					<div class="hfhs-field__body"><?php echo wp_kses_post( wpautop( hfhs_comm_field( 'field_body', $field_body_default ) ) ); ?></div>
					<?php $field_label = hfhs_comm_field( 'field_link_label', 'Read the Facebook Post &rarr;' ); ?>
					<?php if ( $field_label ) : ?>
						<a class="hfhs-field__link hfhs-arrow-link" href="<?php echo esc_url( hfhs_comm_field( 'field_link_url', '#' ) ); ?>"><?php echo wp_kses_post( $field_label ); ?></a>
					<?php endif; ?>
				</div>
				<div class="col-lg-6">
					<div class="hfhs-field__media<?php echo $field_image ? '' : ' is-empty'; ?>"<?php if ( $field_image ) : ?> role="img" aria-label="Recent community project" style="background-image: url('<?php echo esc_url( $field_image ); ?>');"<?php endif; ?>>
						<span class="hfhs-frame hfhs-frame--tl" aria-hidden="true"></span>
						<span class="hfhs-frame hfhs-frame--br" aria-hidden="true"></span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= GET INVOLVED ================= -->
	<section class="hfhs-involve hfhs-section--dark">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-involve__head">
					<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( hfhs_comm_field( 'involve_eyebrow', 'Get Involved' ) ); ?></p>
					<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_comm_field( 'involve_script', 'Help us help more families.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-involve__title"><?php echo wp_kses_post( hfhs_comm_field( 'involve_title', 'Three ways to <em>show up with us.</em>' ) ); ?></h2>
				</div>
			</div>

			<div class="row g-0 hfhs-involve__grid">
				<?php foreach ( $involve as $i => $way ) : ?>
					<div class="col-12 col-md-4">
						<div class="hfhs-involve__card">
							<span class="hfhs-involve__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<h3 class="hfhs-involve__card-title"><?php echo wp_kses_post( isset( $way['title'] ) ? $way['title'] : '' ); ?></h3>
							<p class="hfhs-involve__text"><?php echo wp_kses_post( isset( $way['text'] ) ? $way['text'] : '' ); ?></p>
							<?php if ( ! empty( $way['link_label'] ) ) : ?>
								<a class="hfhs-involve__link hfhs-arrow-link hfhs-arrow-link--light" href="<?php echo esc_url( ! empty( $way['link_url'] ) ? $way['link_url'] : '#' ); ?>"><?php echo wp_kses_post( $way['link_label'] ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<?php $involve_note = hfhs_comm_field( 'involve_note', 'Our commitment: pro bono work every year, for families who need it most.' ); ?>
			<?php if ( $involve_note ) : ?>
				<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light hfhs-involve__note text-center"><?php echo esc_html( $involve_note ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<!-- ================= CTA ================= -->
	<section class="hfhs-cta hfhs-comm-cta hfhs-section--light">
		<div class="container text-center">
			<p class="hfhs-eyebrow-script"><?php echo esc_html( hfhs_comm_field( 'cta_script', 'From Our Family to Yours.' ) ); ?></p>
			<h2 class="hfhs-display hfhs-cta__title"><?php echo wp_kses_post( hfhs_comm_field( 'cta_title', 'This is what family looks like &mdash; <em>taking care of each other.</em>' ) ); ?></h2>
			<div class="hfhs-cta__actions">
				<a class="hfhs-btn hfhs-btn--outline-dark" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Conversation</a>
				<a class="hfhs-btn hfhs-btn--outline-dark" href="tel:+14045072579">Call 404-507-2579</a>
			</div>
		</div>
	</section>

</main><!-- end .hfhs-comm-page -->

<?php get_footer(); ?>
