<?php
/*
	Template Name: Furniture Template
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

		<div class="rcd-home rcd-furniture">

		<!-- ===================== INTRO ===================== -->
		<section class="rcd-band-cream rcd-section rcd-svc-intro">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-12 col-lg-9">
						<div class="rcd-eyebrow rcd-eyebrow--center">
							<span class="rcd-rule"></span>
							<span class="rcd-eyebrow-txt"><?php echo wp_kses_post( rcd_fur_field( 'intro_eyebrow' ) ); ?></span>
							<span class="rcd-rule"></span>
						</div>
						<h1 class="rcd-h1"><?php echo wp_kses_post( rcd_fur_field( 'intro_heading' ) ); ?></h1>
						<p class="rcd-lead rcd-lead--center"><?php echo esc_html( rcd_fur_field( 'intro_text' ) ); ?></p>
						<div class="rcd-fur-pickup">
							<span class="rcd-fur-dot" aria-hidden="true"></span>
							<?php echo esc_html( rcd_fur_field( 'pickup_badge' ) ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ===================== FILTER ROW + GRID ===================== -->
		<?php
			$rcd_pieces  = rcd_get_furniture_pieces();
			$rcd_filters = rcd_get_furniture_filters();
			$rcd_count   = count( $rcd_pieces );
		?>
		<section class="rcd-section rcd-fur-collection">
			<div class="container">

				<div class="rcd-fur-filters">
					<div class="rcd-fur-pills">
						<?php foreach ( $rcd_filters as $rcd_i => $rcd_filter ) : ?>
							<button type="button" class="rcd-fur-pill<?php echo 0 === $rcd_i ? ' rcd-fur-pill--active' : ''; ?>" data-filter="<?php echo 0 === $rcd_i ? '*' : esc_attr( '.' . rcd_fur_class( $rcd_filter ) ); ?>"><?php echo wp_kses_post( $rcd_filter ); ?></button>
						<?php endforeach; ?>
					</div>
					<span class="rcd-fur-count">
						<?php
						/* translators: %s: number of furniture pieces */
						printf( esc_html( _n( '%s piece available', '%s pieces available', $rcd_count, 'pegasus-child' ) ), esc_html( number_format_i18n( $rcd_count ) ) );
						?>
					</span>
				</div>

				<div class="rcd-fur-grid">
					<div class="rcd-fur-sizer" aria-hidden="true"></div>
					<?php
					foreach ( $rcd_pieces as $piece ) :
						$status_meta = rcd_furniture_status_meta( rcd_home_row( $piece, 'status', 'available' ) );
						$piece_name  = rcd_home_row( $piece, 'name' );
						$inquire     = rcd_home_row( $piece, 'inquire' );
						if ( '' === $inquire ) {
							$inquire = 'mailto:hello@renecatherinedesigns.com?subject=' . rawurlencode( 'Inquiry: ' . html_entity_decode( wp_strip_all_tags( $piece_name ), ENT_QUOTES ) );
						}
						// Category slug classes drive the Isotope filtering.
						$piece_cats = isset( $piece['cats'] ) && is_array( $piece['cats'] ) ? $piece['cats'] : array();
						$cat_classes = array();
						foreach ( $piece_cats as $cat_name ) {
							$slug = rcd_fur_class( $cat_name );
							if ( '' !== $slug ) {
								$cat_classes[] = $slug;
							}
						}
						?>
						<div class="rcd-fur-item <?php echo esc_attr( implode( ' ', $cat_classes ) ); ?>">
							<article class="rcd-fur-card <?php echo esc_attr( $status_meta['card_class'] ); ?>">
								<div class="rcd-fur-card-media">
									<?php rcd_home_media( rcd_home_row( $piece, 'image' ), 'rcd-fur-media', 'Drop furniture photo', $piece_name ); ?>
									<span class="rcd-fur-badge <?php echo esc_attr( $status_meta['badge_class'] ); ?>"><?php echo esc_html( $status_meta['label'] ); ?></span>
								</div>
								<div class="rcd-fur-card-body">
									<h3 class="rcd-fur-name"><?php echo wp_kses_post( $piece_name ); ?></h3>
									<?php if ( rcd_home_row( $piece, 'meta' ) ) : ?>
										<div class="rcd-fur-meta"><?php echo wp_kses_post( rcd_home_row( $piece, 'meta' ) ); ?></div>
									<?php endif; ?>
									<div class="rcd-fur-priceRow">
										<span class="rcd-fur-price"><?php echo esc_html( rcd_home_row( $piece, 'price' ) ); ?></span>
										<a class="rcd-fur-inquire" href="<?php echo esc_url( $inquire ); ?>"><?php echo esc_html( $status_meta['cta'] ); ?> &rsaquo;</a>
									</div>
								</div>
							</article>
						</div>
					<?php endforeach; ?>
				</div>
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

		<!-- ===================== HOW IT WORKS ===================== -->
		<section id="inquire" class="rcd-band-dark rcd-section">
			<div class="container">
				<div class="text-center rcd-section-head-center">
					<div class="rcd-eyebrow rcd-eyebrow--center">
						<span class="rcd-rule"></span>
						<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_fur_field( 'how_eyebrow' ) ); ?></span>
						<span class="rcd-rule"></span>
					</div>
					<h2 class="rcd-h2"><?php echo wp_kses_post( rcd_fur_field( 'how_heading' ) ); ?></h2>
				</div>

				<div class="row g-4 justify-content-center">
					<?php foreach ( rcd_fur_rows( 'steps' ) as $step ) : ?>
						<div class="col-12 col-md-4 text-center rcd-fur-step">
							<div class="rcd-fur-step-num"><?php echo esc_html( rcd_home_row( $step, 'num' ) ); ?></div>
							<h3 class="rcd-fur-step-title"><?php echo esc_html( rcd_home_row( $step, 'title' ) ); ?></h3>
							<p class="rcd-fur-step-desc"><?php echo esc_html( rcd_home_row( $step, 'desc' ) ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="text-center rcd-fur-cta">
					<a class="rcd-btn rcd-btn-light" href="<?php echo esc_url( rcd_fur_field( 'inquire_btn_link' ) ); ?>"><?php echo esc_html( rcd_fur_field( 'inquire_btn_text' ) ); ?></a>
					<p class="rcd-fur-note"><?php echo wp_kses_post( rcd_fur_field( 'coming_soon' ) ); ?></p>
				</div>
			</div>
		</section>

		</div><!-- end .rcd-home -->

	</div><!-- end page wrap -->
    <?php get_footer(); ?>
