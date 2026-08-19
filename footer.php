
				<?php
					$footer_custom_code =  pegasus_get_option( 'custom_bottom_textareacode' );
					$full_container_chk_choice =  pegasus_get_option( 'full_container_chk' );
					$full_container_footer_choice =  pegasus_get_option( 'footer_fullwidth_checkbox' );
					$final_footer_container_class = ( 'on' === $full_container_chk_choice ) ? 'container-fluid' : 'container';
					$final_footer_colophon_class = ( 'on' === $full_container_footer_choice ) ? 'container-fluid' : $final_footer_container_class;
					$back_to_top = pegasus_get_option( 'back_to_top' );
				?>

				<?php
					if( "on" === $back_to_top ) {
						?><div id="toTop" class="fa fa-chevron-up"></div><?php
					}
				?>


				<?php
					if( $footer_custom_code ):
				?>
						<!-- Footer custom code for banner, etc. -->
						<section class="pegasus-custom-footer">
							<div class="<?php echo esc_attr( $final_footer_container_class ); ?>">
								<div class="">
									<?php echo do_shortcode( $footer_custom_code ); ?>
								</div>
							</div>
						</section>
						<!-- end custom footer code -->
				<?php
					endif;
				?>
				<!-- start pegasus footer -->
				<div class="pegasus-footer">
					<footer>
						<?php
							$hr_check = pegasus_get_option( 'footer_hr_checkbox' );
							if( $hr_check === 'on' ){
								echo "<hr>";
							}
						?>

						<!-- FOOTER SOCIAL WIDGET -->
						<?php if ( is_active_sidebar( 'footer-social' ) ) : ?>
							<div class="<?php echo esc_attr( $final_footer_container_class ); ?>">
								<div class="footer-social-container">
									<?php dynamic_sidebar( 'footer-social' ); ?>
								</div>
							</div>
						<?php endif; ?>

						<!-- FOOTER WIDGET AREA -->
						<?php
							$footer_widget_areas = absint( pegasus_get_option(  'footer_widget_areas' ) );

							switch ( $footer_widget_areas ) {
								case 0:
									$footer_widget_class = '';
									break;
								case 1:
									$footer_widget_class = 'col-12 col-sm-12 col-md-12 col-lg-12';
									break;
								case 2:
									$footer_widget_class = 'col-12 col-sm-12 col-md-6 col-lg-6';
									break;
								case 3:
									$footer_widget_class = 'col-12 col-sm-12 col-md-6 col-lg-4';
									break;
								case 4:
									$footer_widget_class = 'col-12 col-sm-12 col-md-6 col-lg-3';
									break;
								default:
									$footer_widget_class = '';
							}

							if( $footer_widget_areas > 0 ) :
						?>
							<div class="<?php echo esc_attr( $final_footer_container_class ); ?>">
								<div id="footer-widgets" class="footer-widget-areas clearfix">
									<div class="row">
										<?php for( $i = 1; $i <= $footer_widget_areas; $i++ ): ?>
											<div id="footer-widget-<?php echo esc_attr( $i ); ?>" class="footer-widget-area <?php echo esc_attr( $footer_widget_class ); ?>" role="complementary" >
												<?php dynamic_sidebar( 'footer-' . $i ); ?>
											</div><!-- .widget-area -->
										<?php endfor; ?>
									</div>
								</div>
							</div><!-- /container -->
						<?php endif; ?>
						<!-- STOUT BROTHERS FOOTER (from design) -->
						<div class="sb-footer pt-5 pb-4">
							<div class="container py-lg-3">
								<div class="row g-4">

									<!-- Logo (SVG from templates/logo.php) -->
									<div class="col-lg-3">
										<?php get_template_part( 'templates/logo' ); ?>
									</div>

									<?php
										// Build the location columns from the Locations CPT.
										$sb_footer_locations = array();

										$sb_loc_query = new WP_Query( array(
											'post_type'      => 'locations',
											'post_status'    => 'publish',
											'posts_per_page' => -1,
											'orderby'        => 'menu_order title',
											'order'          => 'ASC',
											'no_found_rows'  => true,
										) );

										if ( $sb_loc_query->have_posts() ) {
											while ( $sb_loc_query->have_posts() ) :
												$sb_loc_query->the_post();
												$sb_lid = get_the_ID();
												$sb_p   = 'ulg_location_';

												$sb_name = get_post_meta( $sb_lid, $sb_p . 'display_name', true );
												if ( '' === trim( (string) $sb_name ) ) {
													$sb_name = get_the_title();
												}

												$sb_street  = get_post_meta( $sb_lid, $sb_p . 'street', true );
												$sb_street2 = get_post_meta( $sb_lid, $sb_p . 'street2', true );
												$sb_city    = get_post_meta( $sb_lid, $sb_p . 'city', true );
												$sb_state   = get_post_meta( $sb_lid, $sb_p . 'state', true );
												$sb_zip     = get_post_meta( $sb_lid, $sb_p . 'zip', true );

												$sb_csz = trim( $sb_city . ( ( $sb_city && $sb_state ) ? ', ' : ' ' ) . $sb_state . ' ' . $sb_zip );

												$sb_footer_locations[] = array(
													'name'      => $sb_name,
													'lines'     => array_values( array_filter( array( $sb_street, $sb_street2, $sb_csz ), 'strlen' ) ),
													'phone'     => get_post_meta( $sb_lid, $sb_p . 'phone_display', true ),
													'phone_tel' => get_post_meta( $sb_lid, $sb_p . 'phone_tel', true ),
													'url'       => get_permalink( $sb_lid ),
												);
											endwhile;
											wp_reset_postdata();
										}

										// Fall back to the design defaults until locations are added.
										if ( empty( $sb_footer_locations ) ) {
											$sb_footer_locations = array(
												array( 'name' => 'Smyrna',    'lines' => array( '1265 W Spring St., Suite D', 'Smyrna, GA 30080' ),  'phone' => '770.319.8200', 'phone_tel' => '+17703198200', 'url' => '' ),
												array( 'name' => 'Roswell',   'lines' => array( '1186 Canton Street', 'Roswell, GA 30075' ),          'phone' => '678.694.8793', 'phone_tel' => '+16786948793', 'url' => '' ),
												array( 'name' => 'Woodstock', 'lines' => array( '240 Chambers Street', 'Woodstock, GA 30188' ),        'phone' => '678.909.5678', 'phone_tel' => '+16789095678', 'url' => '' ),
											);
										}

										foreach ( $sb_footer_locations as $sb_loc ) :
									?>
										<div class="col-6 col-lg-3">
											<h4 class="sb-footer-heading">
												<?php if ( ! empty( $sb_loc['url'] ) ) : ?>
													<a class="sb-footer-heading-link" href="<?php echo esc_url( $sb_loc['url'] ); ?>"><?php echo esc_html( $sb_loc['name'] ); ?></a>
												<?php else : ?>
													<?php echo esc_html( $sb_loc['name'] ); ?>
												<?php endif; ?>
											</h4>
											<p class="sb-footer-addr">
												<?php
													$sb_line_count = count( $sb_loc['lines'] );
													foreach ( $sb_loc['lines'] as $sb_i => $sb_line ) {
														echo esc_html( $sb_line );
														if ( $sb_i < $sb_line_count - 1 || ! empty( $sb_loc['phone'] ) ) {
															echo '<br>';
														}
													}
													if ( ! empty( $sb_loc['phone'] ) ) {
														if ( ! empty( $sb_loc['phone_tel'] ) ) {
															printf( '<a class="sb-footer-phone" href="tel:%1$s">%2$s</a>', esc_attr( $sb_loc['phone_tel'] ), esc_html( $sb_loc['phone'] ) );
														} else {
															printf( '<span class="sb-footer-phone">%s</span>', esc_html( $sb_loc['phone'] ) );
														}
													}
												?>
											</p>
										</div>
									<?php endforeach; ?>

								</div><!-- /.row -->

								<hr class="sb-footer-hr">

								<div class="d-flex flex-column flex-md-row justify-content-between align-items-center sb-footer-bottom">
									<?php
										$custom_footer = pegasus_get_option( 'footer_copy_textareacode' );
										if ( $custom_footer ) {
											echo '<span class="sb-footer-copy">' . wp_kses_post( $custom_footer ) . '</span>';
										} else {
											echo '<span class="sb-footer-copy">&copy; ' . esc_html( date( 'Y' ) ) . ' ' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
										}
									?>
									<span class="sb-footer-tagline">Craft Beer &middot; Wine &middot; Metro Atlanta</span>
								</div>

							</div><!-- /.container -->
						</div><!-- /.sb-footer -->
					</footer>
				</div>

			</div><!--mainbar end-->

		</div><!--end-page-wrapper-->
		<?php wp_footer(); ?>

	</body>
</html>
