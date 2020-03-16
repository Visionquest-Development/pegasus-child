<?php
/**
 * Silence is golden; exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
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
		if ( 'on' === $global_disable_page_header_option ) {
			$final_page_header_option = 'on';
		} elseif ( 'on' === $post_disable_page_header_choice ) {
			$final_page_header_option = 'on';
		} else {
			$final_page_header_option = 'off';
		}
		?>

		<div class="<?php echo $final_container_class; ?>">
			<!-- Example row of columns -->
			<div class="row">
				<?php
				if( 'on' === $pegasus_left_sidebar_option && 'on' === $left_align_sidebar_chk ) {
					get_sidebar( 'left' );
				} else if( 'on' === $left_align_sidebar_chk ) {
					get_sidebar( 'right' );
				}
				?>

				<div class="<?php echo $page_body_content_class; ?>">
					<div class="inner-content">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php
							if( 'off' === $final_page_header_option ) {
								?>
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
									<p><em>
											By <?php the_author(); ?>
											on <?php echo the_time('l, F, jS, Y');?>
											in <?php the_category( ',' ); ?>.
											<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
										</em></p>
								</div>
							<?php }else{ ?>
								<div class="page-header-spacer"></div>
								<div class="">
									<p><em>
											By <?php the_author(); ?>
											on <?php echo the_time('l, F, jS, Y');?>
											in <?php the_category( ',' ); ?>.
											<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
										</em></p>
								</div>
							<?php } ?>
							<?php
							$custom = @get_post_custom($post->ID);
							$large_image_url = wp_get_attachment_image_src( @get_post_thumbnail_id(), 'large');
							$small_image_url = wp_get_attachment_image_src( @get_post_thumbnail_id(), 'blog');
							$small_p_image_url = wp_get_attachment_image_src( @get_post_thumbnail_id(), 'portfolio-three');
							$cat = get_the_category($post->ID);
							?>
							<?php $img1 = @get_post_meta($post->ID, 'image', true); ?>
							<?php $img2 = @get_post_meta($post->ID, 'image2', true); ?>
							<?php $img3 = @get_post_meta($post->ID, 'image3', true); ?>

							<section >
								<div class="row">
									<div class="span8">
										<div class="slider_area">
											<?php if (!((@get_post_meta($post->ID, 'image', true)) || (@get_post_meta($post->ID, 'image2', true)) || (@get_post_meta($post->ID, 'image3', true)) || (@get_post_meta($post->ID, 'video', true)))) { ?>
												<div class="row">
													<div class="span8 portfolio_item nolink" >
														<div class="view view-first">
															<img src="<?php echo $large_image_url[0]; ?>" alt="" />
															<div class="mask">
																<a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto" title="<?php the_title(); ?>" class="info"></a>
															</div>
														</div>
														<div class="clearfix"></div>
													</div>
												</div>
											<?php } ?>
											<?php if (@get_post_meta($post->ID, 'video', true));{ ?><?php echo @get_post_meta($post->ID, 'video', true); ?><?php }?>
											<?php if ((@get_post_meta($post->ID, 'image', true)) || (@get_post_meta($post->ID, 'image2', true)) || (@get_post_meta($post->ID, 'image3', true))){ ?>
												<div class="theme-default">
													<div id="slider" class="nivoSlider">
														<?php if (@get_post_meta($post->ID, 'image', true)) { ?>
															<img src="<?php echo @get_post_meta($post->ID, 'image', true); ?>" alt="" />
														<?php } ?>
														<?php if (@get_post_meta($post->ID, 'image2', true)) { ?>
															<img src="<?php echo @get_post_meta($post->ID, 'image2', true); ?>" alt="" />
														<?php } ?>
														<?php if (@get_post_meta($post->ID, 'image3', true)) { ?>
															<img src="<?php echo @get_post_meta($post->ID, 'image3', true); ?>" alt="" />
														<?php } ?>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="span4 portfolio-description">
										<div class="portfolio_post_item_description">

												<div class="meta">
													<span><?php previous_post_link('<strong>< %link</strong>'); ?></span>
													<span class="last_item"><?php  next_post_link('<strong>%link ></strong>'); ?></span>
												</div>

											<?php the_content(''); ?>
										</div>
									</div>
								</div>
							</section>
							<?php //the_content(); ?>

							<?php comments_template(); ?>

						<?php endwhile; else: ?>
							<?php /* kinda a 404 of sorts when not working */ ?>
							<div class="page-header">
								<h1>Oh no!</h1>
							</div>
							<p>No content is appearing for this page!</p>
						<?php endif; ?>
						<?php
						// Edit post link
						wp_bootstrap_edit_post_link(
							sprintf(
							/* translators: %s: Name of current post */
								__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'textdomain' ),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
					</div><!--end inner content-->
				</div>
				<?php
				if( 'on' === $pegasus_left_sidebar_option ) {
					get_sidebar( 'right' );
				}
				if( 'on' !== $left_align_sidebar_chk ) {
					get_sidebar( 'right' );
				}
				?>

			</div><!--end row -->
		</div><!-- end container -->
	</div><!-- end page wrap -->
<?php get_footer(); ?>
