<?php
/*
	Template Name: Home Template
*/
?>
	<?php get_header(); ?>

	<?php
		$header_choice = pegasus_get_option( 'header_select' );
		//var_dump($header_choice);
		if ( 'header-three' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}
	?>

	<div id="page-wrap">

		<?php
			//full container page options
			$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
			//full container theme option
			$global_full_container_option = pegasus_get_option('full_container_chk' );

			//assign post class
			$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
			//assign global class
			$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container' ;
			//check global first then post
			$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

			//left align right sidebar?
			$left_align_sidebar_chk =  pegasus_get_option( 'sidebar_left_chk' ) ? pegasus_get_option( 'sidebar_left_chk' ) : 'off';
			//enable both sidebars?
			$pegasus_left_sidebar_option = ( 'on' === pegasus_get_option( 'both_sidebar_chk' ) ) ? pegasus_get_option( 'both_sidebar_chk' ) : 'off';
			//change content class if both sidebars
			$page_body_content_class = ( 'on' === $pegasus_left_sidebar_option  ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xg-6' : 'col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9';

			//page header page options
			$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
			//page header theme option
			$global_disable_page_header_option =  pegasus_get_option('page_header_chk' ) ? pegasus_get_option('page_header_chk' ) : 'off';
			//check theme option for page header before page option
			$page_title = $post->post_title;
			$is_this_home = is_home();
			if ( 'on' === $global_disable_page_header_option ) {
				$final_page_header_option = 'on';
			} elseif ( 'on' === $post_disable_page_header_choice ) {
				$final_page_header_option = 'on';
			} else {
				$final_page_header_option = 'off';
			}

			if ( true === $is_this_home ) {
				$final_page_header_option = 'off';
			}
		?>

		<div class="rcd-home">

		<?php
			/* ------------------------------------------------------------------
			 * Pull all content ( CMB2 values, or Claude Design defaults ).
			 * Helpers live in inc/cmb2-home-fields.php.
			 * ---------------------------------------------------------------- */
			$hero_layout = rcd_home_field( 'hero_layout' );
		?>

		<!-- ===================== HERO ===================== -->
		<section class="rcd-hero rcd-hero--<?php echo esc_attr( $hero_layout ); ?>">

			<?php if ( 'on' === rcd_home_field( 'hero_watermark' ) ) : ?>
				<div class="rcd-hero-watermark" aria-hidden="true"><span>RC</span></div>
			<?php endif; ?>

			<?php if ( 'centered' === $hero_layout ) : ?>

				<div class="container rcd-z1 text-center rcd-hero-centered">
					<div class="row justify-content-center">
						<div class="col-12 col-lg-10">
							<div class="rcd-eyebrow rcd-eyebrow--center">
								<span class="rcd-rule"></span>
								<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_home_field( 'hero_eyebrow' ) ); ?></span>
								<span class="rcd-rule"></span>
							</div>
							<h1 class="rcd-h1"><?php echo wp_kses_post( rcd_home_field( 'hero_heading' ) ); ?></h1>
							<p class="rcd-lead rcd-lead--center"><?php echo esc_html( rcd_home_field( 'hero_text' ) ); ?></p>
							<div class="rcd-btns rcd-btns--center">
								<a class="rcd-btn rcd-btn-dark" href="<?php echo esc_url( rcd_home_field( 'hero_btn1_link' ) ); ?>"><?php echo esc_html( rcd_home_field( 'hero_btn1_text' ) ); ?></a>
								<a class="rcd-btn rcd-btn-outline" href="<?php echo esc_url( rcd_home_field( 'hero_btn2_link' ) ); ?>"><?php echo esc_html( rcd_home_field( 'hero_btn2_text' ) ); ?></a>
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-12">
							<div class="rcd-hero-frame">
								<?php rcd_home_media( rcd_home_field( 'hero_image' ), 'rcd-hero-media', 'Drop hero interior image', esc_attr( rcd_home_field( 'hero_eyebrow' ) ) ); ?>
							</div>
						</div>
					</div>
				</div>

			<?php elseif ( 'fullbleed' === $hero_layout ) : ?>

				<div class="rcd-hero-full rcd-z1">
					<?php rcd_home_media( rcd_home_field( 'hero_image' ), 'rcd-hero-full-media', 'Drop full-bleed hero image', esc_attr( rcd_home_field( 'hero_eyebrow' ) ) ); ?>
					<div class="rcd-hero-full-scrim"></div>
					<div class="container rcd-hero-full-inner text-center">
						<div class="row justify-content-center">
							<div class="col-12 col-lg-9">
								<div class="rcd-eyebrow rcd-eyebrow--center rcd-eyebrow--light">
									<span class="rcd-rule"></span>
									<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_home_field( 'hero_eyebrow' ) ); ?></span>
									<span class="rcd-rule"></span>
								</div>
								<h1 class="rcd-h1 rcd-h1--light"><?php echo wp_kses_post( rcd_home_field( 'hero_heading' ) ); ?></h1>
								<p class="rcd-lead rcd-lead--center rcd-lead--light"><?php echo esc_html( rcd_home_field( 'hero_text' ) ); ?></p>
								<div class="rcd-btns rcd-btns--center">
									<a class="rcd-btn rcd-btn-light" href="<?php echo esc_url( rcd_home_field( 'hero_btn1_link' ) ); ?>"><?php echo esc_html( rcd_home_field( 'hero_btn1_text' ) ); ?></a>
									<a class="rcd-btn rcd-btn-outline-light" href="<?php echo esc_url( rcd_home_field( 'hero_btn2_link' ) ); ?>"><?php echo esc_html( rcd_home_field( 'hero_btn2_text' ) ); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php else : /* split ( default ) */ ?>

				<div class="container rcd-z1">
					<div class="row align-items-center rcd-hero-row">
						<div class="col-12 col-lg-6 rcd-hero-copy">
							<div class="rcd-eyebrow">
								<span class="rcd-rule"></span>
								<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_home_field( 'hero_eyebrow' ) ); ?></span>
							</div>
							<h1 class="rcd-h1"><?php echo wp_kses_post( rcd_home_field( 'hero_heading' ) ); ?></h1>
							<p class="rcd-lead"><?php echo esc_html( rcd_home_field( 'hero_text' ) ); ?></p>
							<div class="rcd-btns">
								<a class="rcd-btn rcd-btn-dark" href="<?php echo esc_url( rcd_home_field( 'hero_btn1_link' ) ); ?>"><?php echo esc_html( rcd_home_field( 'hero_btn1_text' ) ); ?></a>
								<a class="rcd-btn rcd-btn-outline" href="<?php echo esc_url( rcd_home_field( 'hero_btn2_link' ) ); ?>"><?php echo esc_html( rcd_home_field( 'hero_btn2_text' ) ); ?></a>
							</div>
						</div>
						<div class="col-12 col-lg-6 rcd-hero-media-col">
							<div class="rcd-hero-frame">
								<?php rcd_home_media( rcd_home_field( 'hero_image' ), 'rcd-hero-media', 'Drop hero interior image', esc_attr( rcd_home_field( 'hero_eyebrow' ) ) ); ?>
							</div>
							<div class="rcd-hero-stat">
								<div class="rcd-hero-stat-num"><?php echo esc_html( rcd_home_field( 'hero_stat_number' ) ); ?></div>
								<div class="rcd-hero-stat-txt"><?php echo wp_kses_post( rcd_home_field( 'hero_stat_text' ) ); ?></div>
							</div>
						</div>
					</div>
				</div>

			<?php endif; ?>
		</section>

		<!-- ===================== BRAND STATEMENT ===================== -->
		<section class="rcd-band-cream rcd-section">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-12 col-lg-10">
						<span class="rcd-band-dash">&mdash;</span>
						<p class="rcd-statement"><?php echo esc_html( rcd_home_field( 'brand_statement' ) ); ?></p>
					</div>
				</div>
			</div>
		</section>

		<!-- ===================== SERVICES ===================== -->
		<section id="services" class="rcd-section">
			<div class="container">
				<div class="row align-items-end rcd-section-head">
					<div class="col-12 col-md-8">
						<div class="rcd-eyebrow">
							<span class="rcd-rule"></span>
							<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_home_field( 'services_eyebrow' ) ); ?></span>
						</div>
						<h2 class="rcd-h2"><?php echo wp_kses_post( rcd_home_field( 'services_heading' ) ); ?></h2>
					</div>
					<div class="col-12 col-md-4 text-md-end rcd-section-head-link">
						<a class="rcd-link-underline" href="<?php echo esc_url( rcd_home_field( 'services_link_url' ) ); ?>"><?php echo esc_html( rcd_home_field( 'services_link_text' ) ); ?> &rsaquo;</a>
					</div>
				</div>

				<div class="row g-4">
					<?php
					// Service items come from the shared repeatable field on the Services page.
					$rcd_services_url = function_exists( 'rcd_services_page_url' ) ? rcd_services_page_url() : '';
					foreach ( rcd_get_services() as $service ) :
						$rcd_anchor    = rcd_home_row( $service, 'anchor' );
						$rcd_card_link = rcd_home_row( $service, 'link' );
						if ( '' === $rcd_card_link ) {
							$rcd_card_link = ( $rcd_services_url ? $rcd_services_url : '' ) . ( $rcd_anchor ? '#' . $rcd_anchor : '' );
							if ( '' === $rcd_card_link ) {
								$rcd_card_link = '#';
							}
						}
						?>
						<div class="col-12 col-md-6 col-lg-4">
							<article class="rcd-card">
								<div class="rcd-card-media">
									<?php rcd_home_media( rcd_home_row( $service, 'image' ), '', 'Drop image', rcd_home_row( $service, 'title' ) ); ?>
									<?php if ( rcd_home_row( $service, 'tag' ) ) : ?>
										<span class="rcd-card-tag"><?php echo wp_kses_post( rcd_home_row( $service, 'tag' ) ); ?></span>
									<?php endif; ?>
								</div>
								<div class="rcd-card-body">
									<?php if ( rcd_home_row( $service, 'number' ) ) : ?>
										<div class="rcd-card-n"><?php echo esc_html( rcd_home_row( $service, 'number' ) ); ?></div>
									<?php endif; ?>
									<h3 class="rcd-card-title"><?php echo esc_html( rcd_home_row( $service, 'title' ) ); ?></h3>
									<p class="rcd-card-desc"><?php echo esc_html( rcd_home_row( $service, 'excerpt' ) ); ?></p>
									<a class="rcd-link-underline" href="<?php echo esc_url( $rcd_card_link ); ?>">Learn more</a>
								</div>
							</article>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ===================== APPROACH ===================== -->
		<section id="about" class="rcd-band-dark rcd-section">
			<div class="container">
				<div class="row align-items-center rcd-approach-row">
					<div class="col-12 col-lg-5">
						<div class="rcd-eyebrow">
							<span class="rcd-rule"></span>
							<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_home_field( 'approach_eyebrow' ) ); ?></span>
						</div>
						<h2 class="rcd-h2"><?php echo wp_kses_post( rcd_home_field( 'approach_heading' ) ); ?></h2>
						<p class="rcd-lead"><?php echo esc_html( rcd_home_field( 'approach_text' ) ); ?></p>
					</div>
					<div class="col-12 col-lg-7">
						<?php foreach ( rcd_home_rows( 'values' ) as $value ) : ?>
							<div class="rcd-value">
								<span class="rcd-value-num"><?php echo esc_html( rcd_home_row( $value, 'num' ) ); ?></span>
								<div>
									<h3 class="rcd-value-title"><?php echo esc_html( rcd_home_row( $value, 'title' ) ); ?></h3>
									<p class="rcd-value-desc"><?php echo esc_html( rcd_home_row( $value, 'desc' ) ); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>

		<!-- ===================== FEATURED GALLERY ===================== -->
		<section class="rcd-section">
			<div class="container">
				<div class="text-center rcd-section-head-center">
					<div class="rcd-eyebrow rcd-eyebrow--center">
						<span class="rcd-rule"></span>
						<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_home_field( 'gallery_eyebrow' ) ); ?></span>
						<span class="rcd-rule"></span>
					</div>
					<h2 class="rcd-h2"><?php echo wp_kses_post( rcd_home_field( 'gallery_heading' ) ); ?></h2>
				</div>

				<div class="row g-3">
					<?php
					$gallery_rows = rcd_home_rows( 'gallery' );
					foreach ( $gallery_rows as $index => $item ) :
						// Mirror the design: first tile is wide/tall, the rest are half/standard.
						$col_class    = ( 0 === $index ) ? 'col-12 col-lg-8' : 'col-6 col-lg-4';
						$height_class = ( $index < 2 ) ? 'rcd-media-tall' : 'rcd-media-mid';
						?>
						<div class="<?php echo esc_attr( $col_class ); ?>">
							<div class="rcd-gallery-item">
								<?php rcd_home_media( rcd_home_row( $item, 'image' ), $height_class, 'Drop project image', rcd_home_row( $item, 'caption' ) ); ?>
								<?php if ( rcd_home_row( $item, 'caption' ) ) : ?>
									<span class="rcd-gallery-cap"><?php echo esc_html( rcd_home_row( $item, 'caption' ) ); ?></span>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ===================== FURNITURE BAND ===================== -->
		<section id="furniture" class="rcd-band-sand">
			<div class="container">
				<div class="row align-items-stretch rcd-furn-row">
					<div class="col-12 col-lg-6 rcd-furn-copy">
						<div class="rcd-eyebrow">
							<span class="rcd-rule"></span>
							<span class="rcd-eyebrow-txt"><?php echo wp_kses_post( rcd_home_field( 'furn_eyebrow' ) ); ?></span>
						</div>
						<h2 class="rcd-h2"><?php echo wp_kses_post( rcd_home_field( 'furn_heading' ) ); ?></h2>
						<p class="rcd-furn-text"><?php echo esc_html( rcd_home_field( 'furn_text' ) ); ?></p>
						<p class="rcd-furn-note"><?php echo esc_html( rcd_home_field( 'furn_note' ) ); ?></p>
						<a class="rcd-btn rcd-btn-dark rcd-btn--self" href="<?php echo esc_url( rcd_home_field( 'furn_btn_link' ) ); ?>"><?php echo esc_html( rcd_home_field( 'furn_btn_text' ) ); ?> &rsaquo;</a>
					</div>
					<div class="col-12 col-lg-6 rcd-furn-media">
						<div class="row g-3 align-items-center">
							<?php
							$furn_rows = rcd_home_rows( 'furn_images' );
							foreach ( $furn_rows as $index => $furn_item ) :
								$furn_height = ( 0 === $index ) ? 'rcd-furn-a' : 'rcd-furn-b';
								?>
								<div class="col-6">
									<?php rcd_home_media( rcd_home_row( $furn_item, 'image' ), $furn_height, 'Drop furniture image' ); ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ===================== TESTIMONIAL ===================== -->
		<section class="rcd-section">
			<div class="container">
				<?php foreach ( rcd_home_rows( 'testimonials' ) as $testimonial ) : ?>
					<div class="row justify-content-center text-center rcd-testimonial">
						<div class="col-12 col-lg-8">
							<span class="rcd-quote-mark">&ldquo;</span>
							<p class="rcd-quote"><?php echo esc_html( rcd_home_row( $testimonial, 'quote' ) ); ?></p>
							<?php if ( rcd_home_row( $testimonial, 'attribution' ) ) : ?>
								<div class="rcd-eyebrow rcd-eyebrow--center rcd-eyebrow--muted">
									<span class="rcd-rule"></span>
									<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_home_row( $testimonial, 'attribution' ) ); ?></span>
									<span class="rcd-rule"></span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</section>

		<!-- ===================== SEO / PAGE CONTENT ===================== -->
		<section class="rcd-section rcd-seo-content">
			<div class="<?php echo esc_attr( $final_container_class ); ?>">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10">
						<div class="inner-content">
							<div class="content-no-sidebar">
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
									<?php if( 'off' === $final_page_header_option ) { ?>
										<div class="page-header">
											<?php
											if( '' === $page_title ) {
												echo '';
											} elseif ( $page_title ) {
												echo '<h1>';
												echo the_title();
												echo '</h1>';
											}
											?>
										</div>
									<?php }else{ ?>
										<div class="page-header-spacer"></div>
									<?php } ?>

									<?php the_content(); ?>

								<?php endwhile; else: ?>
									<?php /* kinda a 404 of sorts when not working */ ?>
									<div class="page-header">
										<h1>Oh no!</h1>
									</div>
									<p>No content is appearing for this page!</p>
								<?php endif; ?>
								<?php
									if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
										// Edit post link
										wp_bootstrap_edit_post_link(
											sprintf(
												/* translators: %s: Name of current post */
												__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus' ),
												get_the_title()
											),
											'<span class="edit-link">',
											'</span>'
										);
									}
									if ( function_exists( 'wp_bootstrap_posts_pagination' ) ) {
										wp_bootstrap_posts_pagination( array(
											'prev_text'          => __( 'Previous page', 'pegasus' ),
											'next_text'          => __( 'Next page', 'pegasus' ),
											'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pegasus' ) . ' </span>'
										) );
									}
								?>
							</div>
						</div><!--end inner content-->
					</div>
				</div>
			</div>
		</section>

		<!-- ===================== CTA ===================== -->
		<section id="contact" class="rcd-band-dark rcd-section">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-12 col-lg-8">
						<div class="rcd-eyebrow rcd-eyebrow--center">
							<span class="rcd-rule"></span>
							<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_home_field( 'cta_eyebrow' ) ); ?></span>
							<span class="rcd-rule"></span>
						</div>
						<h2 class="rcd-h2"><?php echo wp_kses_post( rcd_home_field( 'cta_heading' ) ); ?></h2>
						<p class="rcd-lead rcd-lead--center"><?php echo esc_html( rcd_home_field( 'cta_text' ) ); ?></p>
						<div class="rcd-btns rcd-btns--center">
							<a class="rcd-btn rcd-btn-light" href="<?php echo esc_url( rcd_home_field( 'cta_btn_link' ) ); ?>"><?php echo esc_html( rcd_home_field( 'cta_btn_text' ) ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</section>

		</div><!-- end .rcd-home -->

	</div><!-- end page wrap -->
    <?php get_footer(); ?>
