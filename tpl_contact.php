<?php
/*
	Template Name: Contact
*/
get_header();

$biz    = sp_contact_meta( '_sp_contact_biz_name' );
$street = sp_contact_meta( '_sp_contact_street' );
$loc    = sp_contact_meta( '_sp_contact_locality' );
$region = sp_contact_meta( '_sp_contact_region' );
$postal = sp_contact_meta( '_sp_contact_postal' );
$phone  = sp_contact_meta( '_sp_contact_phone' );
$email  = sp_contact_meta( '_sp_contact_email' );
$email_label = sp_contact_meta( '_sp_contact_email_label' );
$email_text  = ( '' !== trim( (string) $email_label ) ) ? $email_label : $email;
$image  = sp_contact_meta( '_sp_contact_image' );
$map    = sp_contact_meta( '_sp_contact_map_url' );
$embed  = sp_contact_meta( '_sp_contact_map_embed' );
$sched  = sp_contact_meta( '_sp_contact_opening_hours_schema' );
$hours  = sp_contact_group( '_sp_contact_hours', sp_contact_hours_default() );

// Build an E.164-ish tel: value from the display phone (assume US if 10 digits).
$digits   = preg_replace( '/[^0-9]/', '', $phone );
$tel      = ( 10 === strlen( $digits ) ) ? '+1' . $digits : '+' . $digits;

// Directions: use the explicit map URL, else a maps search for the address.
$maps_q   = trim( "$street $loc $region $postal" );
$map_href = $map ? $map : 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $maps_q );
?>

<div class="sp sp-page" data-screen-label="Contact">

	<?php /* ── HERO ─────────────────────────────────────────────────── */ ?>
	<section class="sp-menu-hero position-relative">
		<div class="container sp-menu-hero__inner position-relative text-center wow sp-anim-up">
			<span class="sp-script sp-menu-hero__kicker"><?php echo esc_html( sp_contact_meta( '_sp_contact_hero_kicker' ) ); ?></span>
			<h1 class="sp-menu-hero__title fw-normal mt-1"><?php echo wp_kses_post( sp_contact_meta( '_sp_contact_hero_title' ) ); ?></h1>
			<p class="sp-menu-hero__body mt-4 mx-auto"><?php echo esc_html( sp_contact_meta( '_sp_contact_hero_body' ) ); ?></p>
		</div>
	</section>

	<?php /* ── CONTACT CARD ─────────────────────────────────────────── */ ?>
	<section class="sp-contact">
		<div class="container">
			<div class="sp-contact-card row g-0 overflow-hidden rounded wow sp-anim-up" itemscope itemtype="https://schema.org/Restaurant">
				<meta itemprop="name" content="<?php echo esc_attr( $biz ); ?>" />
				<meta itemprop="url" content="<?php echo esc_url( home_url( '/' ) ); ?>" />
				<?php if ( $sched ) : ?>
					<meta itemprop="openingHours" content="<?php echo esc_attr( $sched ); ?>" />
				<?php endif; ?>

				<div class="col-12 col-lg-6 sp-contact-card__info">

					<div class="sp-contact-block">
						<div class="sp-eyebrow mb-2">Visit</div>
						<address class="sp-contact-address" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
							<span class="sp-contact-address__name"><?php echo esc_html( $biz ); ?></span>
							<span itemprop="streetAddress"><?php echo esc_html( $street ); ?></span>
							<span>
								<span itemprop="addressLocality"><?php echo esc_html( $loc ); ?></span>,
								<span itemprop="addressRegion"><?php echo esc_html( $region ); ?></span>
								<span itemprop="postalCode"><?php echo esc_html( $postal ); ?></span>
							</span>
						</address>
						<a class="sp-contact-link" href="<?php echo esc_url( $map_href ); ?>" target="_blank" rel="noopener">Get directions &rarr;</a>
					</div>

					<div class="sp-contact-grid">
						<div class="sp-contact-block">
							<div class="sp-eyebrow mb-2">Call</div>
							<a class="sp-contact-value" itemprop="telephone" content="<?php echo esc_attr( $tel ); ?>" href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $phone ); ?></a>
						</div>
						<div class="sp-contact-block">
							<div class="sp-eyebrow mb-2">Email</div>
							<a class="sp-contact-value sp-contact-value--email" itemprop="email" href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email_text ); ?></a>
						</div>
					</div>

					<div class="sp-contact-block">
						<div class="sp-eyebrow mb-2">Hours</div>
						<dl class="sp-contact-hours mb-0">
							<?php foreach ( $hours as $row ) :
								$lbl = (string) ( $row['label'] ?? '' );
								$val = (string) ( $row['value'] ?? '' );
								if ( '' === $lbl && '' === $val ) {
									continue;
								}
							?>
								<dt><?php echo wp_kses_post( $lbl ); ?></dt><dd><?php echo wp_kses_post( $val ); ?></dd>
							<?php endforeach; ?>
						</dl>
					</div>

				</div>

				<div class="col-12 col-lg-6 sp-contact-card__media">
					<?php if ( $image ) : ?>
						<figure class="sp-contact-photo sp-photo m-0">
							<img class="sp-contact-photo__img" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $biz ); ?>" loading="lazy" decoding="async" />
						</figure>
					<?php elseif ( $embed ) : ?>
						<div class="sp-contact-map">
							<?php
							echo wp_kses(
								$embed,
								array(
									'iframe' => array(
										'src'             => array(),
										'width'           => array(),
										'height'          => array(),
										'style'           => array(),
										'title'           => array(),
										'loading'         => array(),
										'allowfullscreen' => array(),
										'referrerpolicy'  => array(),
									),
								)
							);
							?>
						</div>
					<?php else : ?>
						<a class="sp-contact-mapholder sp-photo sp-photo--brown" href="<?php echo esc_url( $map_href ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Open map and directions', 'pegasus-child' ); ?>">
							<span class="sp-photo__label"><?php echo esc_html( "$street · $loc, $region" ); ?></span>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php /* ── MESSAGE FORM (Gravity Forms) ───────────────────────────── */ ?>
	<section class="sp-contact-form">
		<div class="container">
			<div class="sp-contact-form__head text-center wow sp-anim-up">
				<span class="sp-script"><?php echo esc_html( sp_contact_meta( '_sp_contact_form_kicker' ) ); ?></span>
				<h2 class="sp-contact-form__title mt-1"><?php echo wp_kses_post( sp_contact_meta( '_sp_contact_form_title' ) ); ?></h2>
				<p class="sp-contact-form__intro mt-3"><?php echo esc_html( sp_contact_meta( '_sp_contact_form_intro' ) ); ?></p>
			</div>

			<div class="sp-contact-form__body wow sp-anim-up" data-wow-delay="0.1s">
				<?php
				$gform_id = (int) sp_contact_meta( '_sp_contact_gform_id' );

				if ( $gform_id && class_exists( 'GFForms' ) ) {
					// Gravity Forms is active and a form is selected — render it (AJAX on).
					echo do_shortcode(
						sprintf( '[gravityform id="%d" title="false" description="false" ajax="true"]', $gform_id )
					);
				} else {
					// Graceful fallback until the plugin/form is wired up.
					?>
					<div class="sp-contact-form__placeholder">
						<p class="mb-2">Our contact form is on the way.</p>
						<p class="mb-0">
							In the meantime, email us at
							<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email_text ); ?></a>
							or call <a href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $phone ); ?></a>.
						</p>
						<?php if ( current_user_can( 'edit_pages' ) ) : ?>
							<p class="sp-contact-form__admin-note mt-3 mb-0">
								<?php
								if ( ! class_exists( 'GFForms' ) ) {
									esc_html_e( 'Admin: install &amp; activate Gravity Forms, then set the form ID under “Contact — Message Form”.', 'pegasus-child' );
								} else {
									esc_html_e( 'Admin: set a Gravity Forms form ID under “Contact — Message Form” to embed the form here.', 'pegasus-child' );
								}
								?>
							</p>
						<?php endif; ?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</section>

</div><?php /* .sp.sp-page */ ?>

<?php get_footer(); ?>
