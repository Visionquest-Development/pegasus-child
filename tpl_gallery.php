<?php

/*
Template Name: Gallery Template
*/

get_header();

$header_choice = pegasus_get_option( 'header_select' );

// var_dump( $header_choice );
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div id="page-wrap">
	<?php
	// Full container page options.
	$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );

	// Full container theme option.
	$global_full_container_option = pegasus_get_option( 'full_container_chk' );

	// Assign post class.
	$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';

	// Assign global class.
	$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container';

	// Check global first then post.
	$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

	// Left align right sidebar?
	$left_align_sidebar_chk = pegasus_get_option( 'sidebar_left_chk' ) ? pegasus_get_option( 'sidebar_left_chk' ) : 'off';

	// Enable both sidebars?
	$pegasus_left_sidebar_option = ( 'on' === pegasus_get_option( 'both_sidebar_chk' ) ) ? pegasus_get_option( 'both_sidebar_chk' ) : 'off';

	// Change content class if both sidebars.
	$page_body_content_class = ( 'on' === $pegasus_left_sidebar_option ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xg-6' : 'col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9';

	// Page header page options.
	$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';

	// Page header theme option.
	$global_disable_page_header_option = pegasus_get_option( 'page_header_chk' ) ? pegasus_get_option( 'page_header_chk' ) : 'off';

	// Check theme option for page header before page option.
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
	<div class="<?php echo $final_container_class; ?>">
		<!-- Example row of columns -->
		<div class="">
			<div class="inner-content">
				<div class="content-no-sidebar">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php if ( 'off' === $final_page_header_option ) { ?>
							<div class="page-header">
								<?php
								if ( '' === $page_title ) {
									echo '';
								} elseif ( $page_title ) {
									echo '<h1>';
									echo the_title();
									echo '</h1>';
								}
								?>
							</div>
						<?php } else { ?>
							<div class="page-header-spacer"></div>
						<?php } ?>

						<?php the_content(); ?>
					<?php endwhile; else : ?>
						<?php /* kinda a 404 of sorts when not working */ ?>
						<div class="page-header">
							<h1>Oh no!</h1>
						</div>
						<p>No content is appearing for this page!</p>
					<?php endif; ?>

					<?php
					if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
						// Edit post link.
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
		</div><!--end row -->
	</div><!-- end container -->



	<section class="container py-5 gallery-cta-grid">
		<div class="row g-4">
			<div class="col-lg-4 col-md-6">
				<a class="gallery-cta-card" href="/services/interior-repairs/" style="background-image: url('https://34oakcontracting.com/wp-content/uploads/2024/07/images.jpeg');">
					<span class="gallery-cta-overlay"></span>
					<span class="gallery-cta-title">Interior</span>
				</a>
			</div>
			<div class="col-lg-4 col-md-6">
				<a class="gallery-cta-card" href="/services/exterior-repairs/" style="background-image: url('https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-1.png');">
					<span class="gallery-cta-overlay"></span>
					<span class="gallery-cta-title">Exterior</span>
				</a>
			</div>
			<div class="col-lg-4 col-md-6">
				<a class="gallery-cta-card" href="/services/make-ready-repairs/" style="background-image: url('https://34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-2048x742.png');">
					<span class="gallery-cta-overlay"></span>
					<span class="gallery-cta-title">Make Ready</span>
				</a>
			</div>
		</div>
	</section>

</div><!-- end page wrap -->

<?php get_footer(); ?>
