<?php
/*
	Template Name: Demo Template
*/

/**
 * Pegasus Demo page template.
 *
 * Renders the plugin showcase from inc/demo-content.json in the synthwave
 * Bootstrap 5 style of the Pegasus Home page. Header and footer are handled by
 * the parent theme / theme options — this template only renders the page body.
 *
 * Section types in the JSON: intro, child-themes, plugin.
 * Block types (plugin sections): subheading, text, image, code.
 *
 * @package Pegasus_Child
 */
?>
	<?php get_header(); ?>

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

			/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				Load the demo content JSON. Everything below is driven by it.
			~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
			if ( ! function_exists( 'pegasus_demo_visible_sections' ) ) {
				require_once get_stylesheet_directory() . '/inc/demo-data.php';
			}

			/**
			 * Accent modifier class, cycled per plugin section.
			 */
			if ( ! function_exists( 'pegasus_demo_accent' ) ) {
				function pegasus_demo_accent( $index ) {
					$accents = array( 'green', 'lime', 'teal', 'blue' );
					return 'pd-accent-' . $accents[ $index % count( $accents ) ];
				}
			}

			/**
			 * Render a single button from a JSON button array.
			 */
			if ( ! function_exists( 'pegasus_demo_button' ) ) {
				function pegasus_demo_button( $btn ) {
					if ( empty( $btn['text'] ) ) {
						return;
					}
					$style   = ( isset( $btn['style'] ) && 'secondary' === $btn['style'] ) ? 'pd-btn-ghost' : 'pd-btn-primary';
					$target  = ( isset( $btn['target'] ) && '_blank' === $btn['target'] ) ? ' target="_blank" rel="noopener"' : '';
					$url     = ! empty( $btn['url'] ) ? $btn['url'] : '#';
					printf(
						'<a class="pd-btn %1$s" href="%2$s"%3$s>%4$s</a>',
						esc_attr( $style ),
						esc_url( $url ),
						$target, // safe literal string
						esc_html( $btn['text'] )
					);
				}
			}

			/**
			 * Render a shortcode "terminal" card. $content is stored decoded in
			 * the JSON, so esc_html() makes tags/shortcodes display literally.
			 */
			if ( ! function_exists( 'pegasus_demo_terminal' ) ) {
				function pegasus_demo_terminal( $content, $language = 'javascript', $label = 'SHORTCODE' ) {
					$language = preg_replace( '/[^a-z0-9\-]/i', '', $language );
					?>
					<div class="pd-terminal">
						<div class="pd-terminal-bar">
							<span class="pd-dot pd-dot--blue"></span>
							<span class="pd-dot pd-dot--lime"></span>
							<span class="pd-dot pd-dot--green"></span>
							<span class="pd-terminal-label"><?php echo esc_html( $label ); ?></span>
						</div>
						<div class="pd-terminal-body"><pre class="mb-0"><code class="language-<?php echo esc_attr( $language ); ?>"><?php echo esc_html( $content ); ?></code></pre></div>
					</div>
					<?php
				}
			}

			/**
			 * Render an install block (intro text + HTTPS/SSH command terminals).
			 */
			if ( ! function_exists( 'pegasus_demo_install' ) ) {
				function pegasus_demo_install( $install ) {
					if ( empty( $install ) ) {
						return;
					}
					?>
					<div class="pd-install">
						<?php if ( ! empty( $install['intro'] ) ) : ?>
							<p class="pd-install-intro"><?php echo esc_html( $install['intro'] ); ?></p>
						<?php endif; ?>
						<div class="row g-4 justify-content-center">
							<?php foreach ( (array) $install['commands'] as $cmd ) : ?>
								<div class="col-lg-6">
									<?php if ( ! empty( $cmd['label'] ) ) : ?>
										<span class="pd-install-label"><?php echo esc_html( $cmd['label'] ); ?></span>
									<?php endif; ?>
									<?php
									pegasus_demo_terminal(
										isset( $cmd['content'] ) ? $cmd['content'] : '',
										isset( $cmd['language'] ) ? $cmd['language'] : 'bash',
										isset( $cmd['label'] ) ? $cmd['label'] . ' · CLONE' : 'CLONE'
									);
									?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php
				}
			}

			/**
			 * Render an image block, optionally wrapped in a lightbox anchor.
			 */
			if ( ! function_exists( 'pegasus_demo_image' ) ) {
				function pegasus_demo_image( $block ) {
					if ( empty( $block['src'] ) ) {
						return;
					}
					$alt = isset( $block['alt'] ) ? $block['alt'] : '';
					?>
					<div class="pd-preview">
						<span class="pd-preview-tag">&#9654; PREVIEW</span>
						<div class="pd-preview-inner">
							<?php if ( ! empty( $block['lightbox'] ) ) : ?>
								<a href="<?php echo esc_url( $block['src'] ); ?>" data-lightbox="<?php echo esc_attr( isset( $block['lightbox_group'] ) ? $block['lightbox_group'] : 'demo' ); ?>" data-title="<?php echo esc_attr( isset( $block['lightbox_title'] ) ? $block['lightbox_title'] : '' ); ?>">
									<img src="<?php echo esc_url( $block['src'] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" class="img-fluid" />
								</a>
							<?php else : ?>
								<img src="<?php echo esc_url( $block['src'] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" class="img-fluid" />
							<?php endif; ?>
						</div>
					</div>
					<?php
				}
			}

			// Sections shown on the demo page: enabled and not hidden.
			$pegasus_demo_sections = pegasus_demo_visible_sections();
		?>

		<?php /* Scroll progress bar (fixed top) — copied from the VisionQuest resume page. */ ?>
		<div id="pd-scroll-progress"><div id="pd-scroll-bar"></div></div>

		<?php /* Sticky notice: this is the showcase index, not the live plugin demo.
		         Kept OUTSIDE .pegasus-demo (which has overflow-x:hidden) so position:sticky
		         tracks the viewport instead of becoming a scroll container. */ ?>
		<div class="pd-notice" role="note">
			<div class="container pd-notice-inner">
				<span class="pd-notice-badge">DEMO</span>
				<p class="pd-notice-text">
					This page showcases all the Pegasus plugin previews in one place. For a live demo of an individual plugin &mdash; and its shortcode usage &mdash; visit that plugin's own example page.
				</p>
			</div>
		</div>

		<div class="pegasus-demo">
			<?php
			$plugin_index = 0; // Counts all sections (drives background rhythm).
			$plugin_num   = 0; // Counts plugin sections only (drives number + accent).
			foreach ( $pegasus_demo_sections as $section ) :
				$type        = isset( $section['type'] ) ? $section['type'] : 'plugin';
				$section_id  = isset( $section['id'] ) ? $section['id'] : '';
				// Alternate section backgrounds for rhythm.
				$bg_class    = ( 0 === $plugin_index % 2 ) ? 'pd-section--dark' : 'pd-section--mid';
				?>

				<?php if ( 'intro' === $type ) : ?>
					<?php $plugin_index++; ?>
					<section id="<?php echo esc_attr( $section_id ); ?>" class="pd-section pd-intro">
						<div class="<?php echo esc_attr( $final_container_class ); ?>">
							<div class="row g-5">
								<?php foreach ( (array) $section['columns'] as $col ) : ?>
									<div class="col-md-6 pd-intro-col">
										<?php if ( ! empty( $col['heading'] ) ) : ?>
											<h3><?php echo esc_html( $col['heading'] ); ?></h3>
										<?php endif; ?>
										<?php if ( ! empty( $col['image']['src'] ) ) : ?>
											<img class="pd-intro-img img-fluid" src="<?php echo esc_url( $col['image']['src'] ); ?>" alt="<?php echo esc_attr( isset( $col['image']['alt'] ) ? $col['image']['alt'] : '' ); ?>" />
										<?php endif; ?>
										<?php if ( ! empty( $col['lead'] ) ) : ?>
											<p class="pd-intro-lead"><?php echo esc_html( $col['lead'] ); ?></p>
										<?php endif; ?>
										<?php if ( ! empty( $col['body'] ) ) : ?>
											<p class="pd-intro-body">
												<?php echo esc_html( $col['body'] ); ?>
												<?php if ( ! empty( $col['body_link']['url'] ) ) : ?>
													<a href="<?php echo esc_url( $col['body_link']['url'] ); ?>"<?php echo ( isset( $col['body_link']['target'] ) && '_blank' === $col['body_link']['target'] ) ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo esc_html( $col['body_link']['text'] ); ?></a><?php echo esc_html( isset( $col['body_link']['suffix'] ) ? $col['body_link']['suffix'] : '' ); ?>
												<?php endif; ?>
											</p>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>

							<?php if ( ! empty( $section['install'] ) ) { pegasus_demo_install( $section['install'] ); } ?>

							<?php if ( ! empty( $section['buttons'] ) ) : ?>
								<div class="pd-btns justify-content-center">
									<?php foreach ( (array) $section['buttons'] as $btn ) { pegasus_demo_button( $btn ); } ?>
								</div>
							<?php endif; ?>
						</div>
					</section>

				<?php elseif ( 'child-themes' === $type ) : ?>
					<?php $plugin_index++; ?>
					<section id="<?php echo esc_attr( $section_id ); ?>" class="pd-section <?php echo esc_attr( $bg_class ); ?>">
						<div class="<?php echo esc_attr( $final_container_class ); ?>">
							<div class="row g-4">
								<?php foreach ( (array) $section['columns'] as $col ) : ?>
									<div class="col-md-6">
										<div class="pd-childcard">
											<?php if ( ! empty( $col['heading'] ) ) : ?>
												<h3><?php echo esc_html( $col['heading'] ); ?></h3>
											<?php endif; ?>
											<?php if ( ! empty( $col['body'] ) ) : ?>
												<p><?php echo esc_html( $col['body'] ); ?></p>
											<?php endif; ?>
											<?php if ( ! empty( $col['button'] ) ) : ?>
												<div class="pd-btns justify-content-center">
													<?php pegasus_demo_button( $col['button'] ); ?>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>

							<?php if ( ! empty( $section['install'] ) ) { pegasus_demo_install( $section['install'] ); } ?>
						</div>
					</section>

				<?php else : // plugin ?>
					<?php $accent_class = pegasus_demo_accent( $plugin_num ); ?>
					<section id="<?php echo esc_attr( $section_id ); ?>" class="pd-section <?php echo esc_attr( $bg_class . ' ' . $accent_class ); ?>">
						<div class="<?php echo esc_attr( $final_container_class ); ?>">
							<div class="row justify-content-center">
								<div class="col-lg-10">
									<div class="pd-eyebrow-row">
										<span class="pd-num"><?php echo esc_html( str_pad( (string) ( $plugin_num + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
										<?php if ( $section_id ) : ?>
											<span class="pd-slug"><?php echo esc_html( $section_id ); ?></span>
										<?php endif; ?>
									</div>

									<?php if ( ! empty( $section['title'] ) ) : ?>
										<h2 class="pd-title"><?php echo esc_html( $section['title'] ); ?></h2>
									<?php endif; ?>

									<?php
									foreach ( (array) $section['blocks'] as $block ) :
										$btype = isset( $block['type'] ) ? $block['type'] : '';
										switch ( $btype ) {
											case 'subheading':
												echo '<h5 class="pd-subhead">' . esc_html( $block['text'] ) . '</h5>';
												break;
											case 'text':
												echo '<p class="pd-lead">' . esc_html( $block['content'] ) . '</p>';
												break;
											case 'image':
												pegasus_demo_image( $block );
												break;
											case 'code':
												pegasus_demo_terminal(
													isset( $block['content'] ) ? $block['content'] : '',
													isset( $block['language'] ) ? $block['language'] : 'javascript'
												);
												break;
										}
									endforeach;
									?>

									<?php if ( ! empty( $section['buttons'] ) ) : ?>
										<div class="pd-btns">
											<?php foreach ( (array) $section['buttons'] as $btn ) { pegasus_demo_button( $btn ); } ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</section>
					<?php $plugin_index++; ?>
					<?php $plugin_num++; ?>
				<?php endif; ?>

			<?php endforeach; ?>
		</div><!-- .pegasus-demo -->

		<?php /* Right-hand dot navigation, generated from the visible sections. */ ?>
		<nav id="dotnav" class="navbar nav pg-dotnav">
			<ul class="dotnav dotnav-vertical dotnav-right">
				<?php foreach ( $pegasus_demo_sections as $section ) : ?>
					<?php
					$dot_id    = isset( $section['id'] ) ? $section['id'] : '';
					$dot_label = isset( $section['title'] ) ? $section['title'] : ucwords( str_replace( array( 'pegasus-', '-' ), array( '', ' ' ), $dot_id ) );
					if ( ! $dot_id ) {
						continue;
					}
					?>
					<li class="nav-tooltip nav-item" title="<?php echo esc_attr( $dot_label ); ?>" data-bs-toggle="tooltip" data-placement="left">
						<a class="nav-link" href="#<?php echo esc_attr( $dot_id ); ?>"></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

	</div><!-- end page wrap -->

	<?php get_footer(); ?>
