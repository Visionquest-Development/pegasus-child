<?php
/*
	Template Name: Service Detail Template
*/
?>
	<?php get_header(); ?>

	<?php
		$header_choice = pegasus_get_option( 'header_select' );
		if ( 'header-three' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}
	?>

	<div id="page-wrap">

		<?php
		// Which shared service does this page detail?
		$rcd_anchor  = get_post_meta( get_the_ID(), 'rcd_detail_anchor', true );
		$rcd_service = rcd_get_service_by_anchor( $rcd_anchor );

		// Fall back to the first shared service if the anchor is missing/unmatched.
		if ( ! $rcd_service ) {
			$rcd_services_all = rcd_get_services();
			$rcd_service      = ! empty( $rcd_services_all ) ? $rcd_services_all[0] : array();
		}

		$rcd_title    = rcd_home_row( $rcd_service, 'title', get_the_title() );
		$rcd_tag      = rcd_home_row( $rcd_service, 'tag' );
		$rcd_number   = rcd_home_row( $rcd_service, 'number' );
		$rcd_image    = rcd_home_row( $rcd_service, 'image' );
		$rcd_excerpt  = rcd_home_row( $rcd_service, 'excerpt' );
		$rcd_body     = rcd_home_row( $rcd_service, 'body' );
		$rcd_body2    = rcd_home_row( $rcd_service, 'body2' );

		// Optional per-page intro override.
		$rcd_intro    = get_post_meta( get_the_ID(), 'rcd_detail_intro', true );

		// Project galleries.
		// Gallery sections ( images grouped by their Section name ).
		$rcd_galleries = function_exists( 'rcd_detail_grouped_galleries' ) ? rcd_detail_grouped_galleries( get_the_ID() ) : array();

		// Services landing page ( for the breadcrumb + CTA content ).
		$rcd_svc_page = function_exists( 'rcd_get_services_page_id' ) ? rcd_get_services_page_id() : 0;
		$rcd_svc_url  = $rcd_svc_page ? get_permalink( $rcd_svc_page ) : '';
		?>

		<div class="rcd-home rcd-service-detail">

		<!-- ===================== HERO ===================== -->
		<section class="rcd-sd-hero">
			<?php if ( $rcd_image ) : ?>
				<img class="rcd-sd-hero-img" src="<?php echo esc_url( $rcd_image ); ?>" alt="<?php echo esc_attr( $rcd_title ); ?>">
			<?php endif; ?>
			<span class="rcd-sd-hero-veil"></span>
			<div class="container">
				<div class="row">
					<div class="col-12 col-lg-9">
						<nav class="rcd-sd-crumbs">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
							<span>&rsaquo;</span>
							<?php if ( $rcd_svc_url ) : ?>
								<a href="<?php echo esc_url( $rcd_svc_url ); ?>">Services</a>
								<span>&rsaquo;</span>
							<?php endif; ?>
							<span class="rcd-sd-crumbs-current"><?php echo esc_html( $rcd_title ); ?></span>
						</nav>
						<div class="rcd-eyebrow rcd-eyebrow--light">
							<span class="rcd-rule"></span>
							<span class="rcd-eyebrow-txt"><?php echo $rcd_number ? esc_html( $rcd_number ) . ' &mdash; ' : ''; ?><?php echo wp_kses_post( $rcd_tag ); ?></span>
						</div>
						<h1 class="rcd-h1 rcd-h1--light"><?php echo wp_kses_post( $rcd_title ); ?></h1>
						<?php if ( $rcd_excerpt ) : ?>
							<p class="rcd-lead rcd-lead--light"><?php echo esc_html( $rcd_excerpt ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<!-- ===================== INTRO ===================== -->
		<section class="rcd-band-cream rcd-section rcd-sd-intro">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-9">
						<?php if ( $rcd_intro ) : ?>
							<?php echo wpautop( wp_kses_post( $rcd_intro ) ); ?>
						<?php else : ?>
							<?php if ( $rcd_body ) : ?>
								<p class="rcd-sd-body"><?php echo esc_html( $rcd_body ); ?></p>
							<?php endif; ?>
							<?php if ( $rcd_body2 ) : ?>
								<p class="rcd-sd-body"><?php echo esc_html( $rcd_body2 ); ?></p>
							<?php endif; ?>
						<?php endif; ?>

						<?php // Page editor content ( optional SEO copy ). ?>
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php
								$rcd_content = trim( get_the_content() );
								if ( '' !== $rcd_content ) {
									echo '<div class="rcd-sd-seo">';
									the_content();
									echo '</div>';
								}
							?>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</div>
		</section>

		<!-- ===================== PROJECT GALLERIES ===================== -->
		<?php if ( ! empty( $rcd_galleries ) ) : ?>
			<?php
			$rcd_gi = 0;
			foreach ( $rcd_galleries as $gallery ) :
				$images = isset( $gallery['images'] ) ? $gallery['images'] : array();
				if ( empty( $images ) ) {
					continue;
				}
				$g_name   = isset( $gallery['name'] ) ? $gallery['name'] : '';
				$g_desc   = isset( $gallery['desc'] ) ? $gallery['desc'] : '';
				$g_anchor = ! empty( $gallery['anchor'] ) ? $gallery['anchor'] : 'gallery-' . $rcd_gi;
				$band     = ( 1 === ( $rcd_gi % 2 ) ) ? ' rcd-band-sand' : '';
				?>
				<section id="<?php echo esc_attr( $g_anchor ); ?>" class="rcd-section rcd-sd-gallery<?php echo esc_attr( $band ); ?>">
					<div class="container">
						<?php if ( $g_name || $g_desc ) : ?>
							<div class="row justify-content-center text-center rcd-sd-gallery-head">
								<div class="col-12 col-lg-8">
									<?php if ( $g_name ) : ?>
										<h2 class="rcd-h2"><?php echo wp_kses_post( $g_name ); ?></h2>
									<?php endif; ?>
									<?php if ( $g_desc ) : ?>
										<p class="rcd-lead rcd-lead--center"><?php echo esc_html( $g_desc ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
						<?php rcd_render_service_gallery( $images, $g_anchor ); ?>
					</div>
				</section>
				<?php
				$rcd_gi++;
			endforeach;
			?>
		<?php endif; ?>

		<!-- ===================== CTA ===================== -->
		<section id="contact" class="rcd-band-dark rcd-section">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-12 col-lg-8">
						<div class="rcd-eyebrow rcd-eyebrow--center">
							<span class="rcd-rule"></span>
							<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_svc_field( 'cta_eyebrow', $rcd_svc_page ) ); ?></span>
							<span class="rcd-rule"></span>
						</div>
						<h2 class="rcd-h2"><?php echo wp_kses_post( rcd_svc_field( 'cta_heading', $rcd_svc_page ) ); ?></h2>
						<p class="rcd-lead rcd-lead--center"><?php echo esc_html( rcd_svc_field( 'cta_text', $rcd_svc_page ) ); ?></p>
						<div class="rcd-btns rcd-btns--center">
							<a class="rcd-btn rcd-btn-light" href="<?php echo esc_url( rcd_svc_field( 'cta_btn_link', $rcd_svc_page ) ); ?>"><?php echo esc_html( rcd_svc_field( 'cta_btn_text', $rcd_svc_page ) ); ?></a>
							<?php if ( $rcd_svc_url ) : ?>
								<a class="rcd-btn rcd-btn-outline-light" href="<?php echo esc_url( $rcd_svc_url ); ?>">All Services</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		</div><!-- end .rcd-home -->

	</div><!-- end page wrap -->
	<?php get_footer(); ?>
