<?php
/*
	Template Name: Documentation Template
*/

/**
 * Pegasus Documentation page template.
 *
 * Renders the theme documentation from inc/docs-content.json in the synthwave
 * Bootstrap 5 style shared with the Demo/Home pages. The sidebar "primary" nav
 * is auto-swapped to the section anchors (inc/section-nav.php) and a scrollspy
 * dot-nav mirrors it — same pattern as the Home page. Header/footer are handled
 * by the parent theme / theme options.
 *
 * @package Pegasus_Child
 */
?>
	<?php get_header(); ?>

	<div id="page-wrap">
		<?php
			// Full-container page/global option (same logic as the other templates).
			$post_full_container_choice   = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
			$global_full_container_option = pegasus_get_option( 'full_container_chk' );
			$pegasus_post_container_choice   = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
			$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container';
			$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

			if ( ! function_exists( 'pegasus_docs_sections' ) ) {
				require_once get_stylesheet_directory() . '/inc/docs-data.php';
			}

			/**
			 * Accent modifier class, cycled per section.
			 */
			if ( ! function_exists( 'pegasus_docs_accent' ) ) {
				function pegasus_docs_accent( $index ) {
					$accents = array( 'green', 'lime', 'teal', 'blue' );
					return 'pd-accent-' . $accents[ $index % count( $accents ) ];
				}
			}

			/**
			 * Render a documentation screenshot (optionally lightboxed).
			 */
			if ( ! function_exists( 'pegasus_docs_image' ) ) {
				function pegasus_docs_image( $image ) {
					if ( empty( $image['src'] ) ) {
						return;
					}
					$alt = isset( $image['alt'] ) ? $image['alt'] : '';
					?>
					<div class="pd-preview pd-doc-shot">
						<div class="pd-preview-inner">
							<?php if ( ! empty( $image['lightbox'] ) ) : ?>
								<a href="<?php echo esc_url( $image['src'] ); ?>" data-lightbox="<?php echo esc_attr( isset( $image['lightbox_group'] ) ? $image['lightbox_group'] : 'docs' ); ?>" data-title="<?php echo esc_attr( isset( $image['lightbox_title'] ) ? $image['lightbox_title'] : $alt ); ?>">
									<img src="<?php echo esc_url( $image['src'] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" class="img-fluid" />
								</a>
							<?php else : ?>
								<img src="<?php echo esc_url( $image['src'] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" class="img-fluid" />
							<?php endif; ?>
						</div>
					</div>
					<?php
				}
			}

			$pegasus_docs_sections = pegasus_docs_sections();
		?>

		<div class="pegasus-demo pegasus-docs">
			<?php
			$docs_index = 0;
			foreach ( $pegasus_docs_sections as $section ) :
				if ( empty( $section['id'] ) ) {
					continue;
				}
				$bg_class     = ( 0 === $docs_index % 2 ) ? 'pd-section--dark' : 'pd-section--mid';
				$accent_class = pegasus_docs_accent( $docs_index );
				?>
				<section id="<?php echo esc_attr( $section['id'] ); ?>" class="pd-section <?php echo esc_attr( $bg_class . ' ' . $accent_class ); ?>">
					<div class="<?php echo esc_attr( $final_container_class ); ?>">
						<div class="row justify-content-center">
							<div class="col-lg-10">
								<div class="pd-eyebrow-row">
									<span class="pd-num"><?php echo esc_html( str_pad( (string) ( $docs_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
									<span class="pd-slug"><?php echo esc_html( $section['id'] ); ?></span>
								</div>

								<?php if ( ! empty( $section['title'] ) ) : ?>
									<h2 class="pd-title"><?php echo esc_html( $section['title'] ); ?></h2>
								<?php endif; ?>
								<?php if ( ! empty( $section['intro'] ) ) : ?>
									<p class="pd-lead"><?php echo esc_html( $section['intro'] ); ?></p>
								<?php endif; ?>

								<?php if ( ! empty( $section['image'] ) ) { pegasus_docs_image( $section['image'] ); } ?>

								<?php if ( ! empty( $section['items'] ) ) : ?>
									<div class="row g-3 pd-options">
										<?php foreach ( (array) $section['items'] as $item ) : ?>
											<div class="col-md-6">
												<div class="pd-option">
													<h3 class="pd-option-name"><?php echo esc_html( $item['name'] ?? '' ); ?></h3>
													<?php if ( ! empty( $item['desc'] ) ) : ?>
														<p class="pd-option-desc"><?php echo esc_html( $item['desc'] ); ?></p>
													<?php endif; ?>
													<?php if ( ! empty( $item['code'] ) ) : ?>
														<pre class="pd-doc-code"><code><?php echo esc_html( $item['code'] ); ?></code></pre>
													<?php endif; ?>
													<?php if ( ! empty( $item['image']['src'] ) ) { pegasus_docs_image( $item['image'] ); } ?>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</section>
				<?php
				$docs_index++;
			endforeach;
			?>
		</div><!-- .pegasus-docs -->

		<?php /* Right-hand dot navigation with scrollspy (same sections as the sidebar). */ ?>
		<nav id="dotnav" class="navbar nav pg-dotnav">
			<ul class="dotnav dotnav-vertical dotnav-right">
				<?php foreach ( $pegasus_docs_sections as $section ) : ?>
					<?php if ( empty( $section['id'] ) ) { continue; } ?>
					<li class="nav-tooltip nav-item" title="<?php echo esc_attr( isset( $section['title'] ) ? $section['title'] : $section['id'] ); ?>" data-bs-toggle="tooltip" data-placement="left">
						<a class="nav-link" href="#<?php echo esc_attr( $section['id'] ); ?>"></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

	</div><!-- end page wrap -->

	<?php get_footer(); ?>
