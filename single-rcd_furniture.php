<?php
/**
 * Single Furniture Piece — product-page style layout for the rcd_furniture CPT.
 *
 * Main photo = Featured Image ( + optional gallery ), product info column with
 * status, meta, price, specs, and a Call / Contact CTA ( not a buy button ).
 *
 * @package Pegasus_Child
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
		<div class="rcd-home rcd-fur-single">

		<?php
		while ( have_posts() ) :
			the_post();

			$piece_id   = get_the_ID();
			$piece_name = get_the_title();
			$status     = get_post_meta( $piece_id, 'rcd_fur_status', true );
			$status     = $status ? $status : 'available';
			$status_meta = rcd_furniture_status_meta( $status );

			$meta_line  = (string) get_post_meta( $piece_id, 'rcd_fur_meta_line', true );
			$price      = (string) get_post_meta( $piece_id, 'rcd_fur_price', true );
			$dimensions = (string) get_post_meta( $piece_id, 'rcd_fur_dimensions', true );
			$materials  = (string) get_post_meta( $piece_id, 'rcd_fur_materials', true );
			$condition  = (string) get_post_meta( $piece_id, 'rcd_fur_condition', true );

			$cats       = wp_get_post_terms( $piece_id, 'furniture_cat', array( 'fields' => 'names' ) );
			$cat_label  = ( is_array( $cats ) && ! is_wp_error( $cats ) && ! empty( $cats ) ) ? implode( ' · ', $cats ) : rcd_fur_field( 'intro_eyebrow', rcd_get_furniture_page_id() );

			// Contact / CTA settings ( shared, read from the Furniture page ).
			$c_phone = rcd_fur_contact( 'contact_phone' );
			$c_email = rcd_fur_contact( 'contact_email' );
			$c_page  = rcd_fur_contact( 'contact_page' );

			// Inquire link: per-piece override, else an auto mailto with the piece name.
			$inquire = (string) get_post_meta( $piece_id, 'rcd_fur_inquire_link', true );
			if ( '' === $inquire ) {
				$mail_to = $c_email ? $c_email : 'hello@renecatherinedesigns.com';
				$inquire = 'mailto:' . $mail_to . '?subject=' . rawurlencode( 'Inquiry: ' . html_entity_decode( wp_strip_all_tags( $piece_name ), ENT_QUOTES ) );
			}

			// Furniture page ( breadcrumb + "view all" ).
			$fur_page_id = rcd_get_furniture_page_id();
			$fur_url     = $fur_page_id ? get_permalink( $fur_page_id ) : '';

			// Build the gallery: Featured Image first, then the repeatable gallery
			// rows ( each row carries its own alt + caption ). Each item is
			// array( url, full, alt, caption ).
			$gallery = array();
			$seen    = array();

			$feat_id = get_post_thumbnail_id( $piece_id );
			if ( $feat_id ) {
				$feat_alt      = get_post_meta( $feat_id, '_wp_attachment_image_alt', true );
				$gallery[]     = array(
					'url'     => wp_get_attachment_image_url( $feat_id, 'large' ),
					'full'    => wp_get_attachment_image_url( $feat_id, 'full' ),
					'alt'     => $feat_alt ? $feat_alt : $piece_name,
					'caption' => '',
				);
				$seen[ $feat_id ] = true;
			}

			$extra = get_post_meta( $piece_id, 'rcd_fur_gallery', true );
			if ( is_array( $extra ) ) {
				foreach ( $extra as $row ) {
					$url = rcd_home_row( $row, 'image' );
					if ( '' === $url ) {
						continue;
					}
					$gid = isset( $row['image_id'] ) ? (int) $row['image_id'] : 0;
					if ( $gid && isset( $seen[ $gid ] ) ) {
						continue; // Skip if it's the same as the Featured Image.
					}
					$alt = rcd_home_row( $row, 'alt' );
					if ( '' === $alt && $gid ) {
						$alt = get_post_meta( $gid, '_wp_attachment_image_alt', true );
					}
					$gallery[] = array(
						'url'     => $gid && wp_get_attachment_image_url( $gid, 'large' ) ? wp_get_attachment_image_url( $gid, 'large' ) : $url,
						'full'    => $gid && wp_get_attachment_image_url( $gid, 'full' ) ? wp_get_attachment_image_url( $gid, 'full' ) : $url,
						'alt'     => $alt ? $alt : $piece_name,
						'caption' => rcd_home_row( $row, 'caption' ),
					);
					if ( $gid ) {
						$seen[ $gid ] = true;
					}
				}
			}

			$main      = ! empty( $gallery ) ? $gallery[0] : null;
			$has_specs = ( $dimensions || $materials || $condition );
			?>

			<!-- ===================== PRODUCT ===================== -->
			<section class="rcd-section rcd-fur-single-main">
				<div class="container">

					<nav class="rcd-sd-crumbs rcd-sd-crumbs--dark">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
						<span>&rsaquo;</span>
						<?php if ( $fur_url ) : ?>
							<a href="<?php echo esc_url( $fur_url ); ?>">Furniture</a>
							<span>&rsaquo;</span>
						<?php endif; ?>
						<span class="rcd-sd-crumbs-current"><?php echo esc_html( $piece_name ); ?></span>
					</nav>

					<div class="row g-5">

						<!-- Media -->
						<div class="col-12 col-lg-7">
							<?php $lb_group = 'furniture-' . $piece_id; ?>
							<div class="rcd-fur-pd-media">
								<div class="rcd-fur-pd-main rcd-hero-frame">
									<?php if ( $main ) : ?>
										<a class="rcd-glry-item" href="<?php echo esc_url( $main['full'] ); ?>" data-lightbox="<?php echo esc_attr( $lb_group ); ?>" data-title="<?php echo esc_attr( $main['caption'] ? $main['caption'] : $main['alt'] ); ?>">
											<img src="<?php echo esc_url( $main['url'] ); ?>" alt="<?php echo esc_attr( $main['alt'] ); ?>">
											<span class="rcd-glry-zoom" aria-hidden="true">+</span>
										</a>
									<?php else : ?>
										<div class="rcd-slot rcd-fur-pd-slot"><span>No photo yet</span></div>
									<?php endif; ?>
								</div>

								<?php if ( count( $gallery ) > 1 ) : ?>
									<div class="rcd-fur-pd-thumbs">
										<?php
										foreach ( $gallery as $gi => $item ) {
											if ( 0 === $gi ) { continue; } // The main image.
											$cap = $item['caption'] ? $item['caption'] : $item['alt'];
											printf(
												'<a class="rcd-glry-item rcd-fur-pd-thumb" href="%1$s" data-lightbox="%2$s" data-title="%3$s"><img src="%4$s" alt="%5$s" loading="lazy"></a>',
												esc_url( $item['full'] ),
												esc_attr( $lb_group ),
												esc_attr( $cap ),
												esc_url( $item['url'] ),
												esc_attr( $item['alt'] )
											);
										}
										?>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<!-- Info -->
						<div class="col-12 col-lg-5">
							<div class="rcd-fur-pd-info">
								<span class="rcd-fur-badge rcd-fur-pd-badge <?php echo esc_attr( $status_meta['badge_class'] ); ?>"><?php echo esc_html( $status_meta['label'] ); ?></span>

								<div class="rcd-eyebrow">
									<span class="rcd-rule"></span>
									<span class="rcd-eyebrow-txt"><?php echo wp_kses_post( $cat_label ); ?></span>
								</div>

								<h1 class="rcd-h1 rcd-fur-pd-title"><?php echo wp_kses_post( $piece_name ); ?></h1>

								<?php if ( $meta_line ) : ?>
									<p class="rcd-fur-pd-metaline"><?php echo wp_kses_post( $meta_line ); ?></p>
								<?php endif; ?>

								<?php if ( $price ) : ?>
									<div class="rcd-fur-pd-price"><?php echo esc_html( $price ); ?></div>
								<?php endif; ?>

								<?php
								$desc = trim( get_the_content() );
								if ( '' === $desc ) {
									$desc = trim( get_the_excerpt() );
								}
								if ( '' !== $desc ) :
									?>
									<div class="rcd-fur-pd-desc"><?php the_content(); ?></div>
								<?php endif; ?>

								<?php if ( $has_specs ) : ?>
									<ul class="rcd-fur-pd-specs">
										<?php if ( $dimensions ) : ?>
											<li><span class="rcd-fur-pd-spec-k">Dimensions</span><span class="rcd-fur-pd-spec-v"><?php echo esc_html( $dimensions ); ?></span></li>
										<?php endif; ?>
										<?php if ( $materials ) : ?>
											<li><span class="rcd-fur-pd-spec-k">Materials</span><span class="rcd-fur-pd-spec-v"><?php echo esc_html( $materials ); ?></span></li>
										<?php endif; ?>
										<?php if ( $condition ) : ?>
											<li><span class="rcd-fur-pd-spec-k">Condition</span><span class="rcd-fur-pd-spec-v"><?php echo esc_html( $condition ); ?></span></li>
										<?php endif; ?>
									</ul>
								<?php endif; ?>

								<div class="rcd-fur-pd-actions">
									<a class="rcd-btn rcd-btn-dark" href="<?php echo esc_url( $inquire ); ?>">Inquire About This Piece</a>
									<?php if ( $c_phone ) : ?>
										<a class="rcd-btn rcd-btn-outline" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $c_phone ) ); ?>">Call <?php echo esc_html( $c_phone ); ?></a>
									<?php endif; ?>
									<?php if ( $c_page ) : ?>
										<a class="rcd-link-underline rcd-fur-pd-contact" href="<?php echo esc_url( $c_page ); ?>">Contact us &rsaquo;</a>
									<?php endif; ?>
								</div>

								<p class="rcd-fur-pd-pickup"><span class="rcd-fur-dot" aria-hidden="true"></span><?php echo esc_html( rcd_fur_field( 'pickup_badge', $fur_page_id ) ); ?></p>
							</div>
						</div>

					</div>
				</div>
			</section>

			<!-- ===================== RELATED ===================== -->
			<?php
			$related = new WP_Query( array(
				'post_type'      => 'rcd_furniture',
				'post_status'    => 'publish',
				'posts_per_page' => 3,
				'post__not_in'   => array( $piece_id ),
				'orderby'        => 'rand',
				'no_found_rows'  => true,
			) );
			if ( $related->have_posts() ) :
				?>
				<section class="rcd-band-cream rcd-section rcd-fur-related">
					<div class="container">
						<div class="text-center rcd-section-head-center">
							<div class="rcd-eyebrow rcd-eyebrow--center">
								<span class="rcd-rule"></span>
								<span class="rcd-eyebrow-txt">More from the collection</span>
								<span class="rcd-rule"></span>
							</div>
						</div>
						<div class="row g-4">
							<?php
							while ( $related->have_posts() ) :
								$related->the_post();
								$rid     = get_the_ID();
								$rstatus = get_post_meta( $rid, 'rcd_fur_status', true );
								$rmeta   = rcd_furniture_status_meta( $rstatus ? $rstatus : 'available' );
								?>
								<div class="col-12 col-md-4">
									<a class="rcd-fur-related-card" href="<?php the_permalink(); ?>">
										<div class="rcd-fur-card-media">
											<?php rcd_home_media( (string) get_the_post_thumbnail_url( $rid, 'large' ), 'rcd-fur-media', 'No photo yet', get_the_title() ); ?>
											<span class="rcd-fur-badge <?php echo esc_attr( $rmeta['badge_class'] ); ?>"><?php echo esc_html( $rmeta['label'] ); ?></span>
										</div>
										<div class="rcd-fur-related-body">
											<h3 class="rcd-fur-name"><?php the_title(); ?></h3>
											<span class="rcd-fur-price"><?php echo esc_html( (string) get_post_meta( $rid, 'rcd_fur_price', true ) ); ?></span>
										</div>
									</a>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</div>
						<?php if ( $fur_url ) : ?>
							<div class="text-center rcd-fur-related-all">
								<a class="rcd-link-underline" href="<?php echo esc_url( $fur_url ); ?>">View the full collection &rsaquo;</a>
							</div>
						<?php endif; ?>
					</div>
				</section>
			<?php endif; ?>

			<!-- ===================== CTA ===================== -->
			<section id="inquire" class="rcd-band-dark rcd-section">
				<div class="container">
					<div class="row justify-content-center text-center">
						<div class="col-12 col-lg-8">
							<div class="rcd-eyebrow rcd-eyebrow--center">
								<span class="rcd-rule"></span>
								<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_fur_field( 'how_eyebrow', $fur_page_id ) ); ?></span>
								<span class="rcd-rule"></span>
							</div>
							<h2 class="rcd-h2"><?php echo wp_kses_post( rcd_fur_contact( 'single_cta_heading' ) ); ?></h2>
							<p class="rcd-lead rcd-lead--center"><?php echo esc_html( rcd_fur_contact( 'single_cta_text' ) ); ?></p>
							<div class="rcd-btns rcd-btns--center">
								<a class="rcd-btn rcd-btn-light" href="<?php echo esc_url( $inquire ); ?>">Inquire About This Piece</a>
								<?php if ( $c_phone ) : ?>
									<a class="rcd-btn rcd-btn-outline-light" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $c_phone ) ); ?>">Call <?php echo esc_html( $c_phone ); ?></a>
								<?php elseif ( $c_page ) : ?>
									<a class="rcd-btn rcd-btn-outline-light" href="<?php echo esc_url( $c_page ); ?>">Contact Us</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php endwhile; ?>

		</div><!-- end .rcd-home -->
	</div><!-- end page wrap -->
	<?php get_footer(); ?>
