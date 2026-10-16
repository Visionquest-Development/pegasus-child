<?php

/*
Template Name: MakeReady Template
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

	<?php // Legacy hardcoded template parts ?>
	<?php get_template_part( 'templates/make-ready/silverchase' ); ?>
	<?php get_template_part( 'templates/make-ready/greg-michell' ); ?>
	<?php get_template_part( 'templates/make-ready/woodstock' ); ?>

	<?php
	$oak_projects = get_post_meta( get_the_ID(), 'oak_projects_group', true );

	if ( ! empty( $oak_projects ) ) :
	?>
	<!-- Make Ready Project Navigation -->
	<section class="service-feature-section py-5 oak-section-light">
		<div class="container">
			<div class="row mb-3">
				<div class="col-12">
					<div class="section-title">
						<h3>Our Make Ready Projects <span></span></h3>
					</div>
				</div>
			</div>
			<div class="gallery-cta-grid">
				<div class="row g-4">
					<?php foreach ( $oak_projects as $project ) :
						if ( empty( $project['project_name'] ) ) continue;
						$anchor = oak_project_anchor( $project['project_name'] );
						$cover  = ! empty( $project['cover_image'] ) ? $project['cover_image'] : '';
					?>
					<div class="col-lg-4 col-md-6">
						<a class="gallery-cta-card gallery-cta-card--sm" href="#<?php echo esc_attr( $anchor ); ?>" <?php if ( $cover ) : ?>style="background-image: url('<?php echo esc_url( $cover ); ?>');"<?php endif; ?>>
							<span class="gallery-cta-overlay"></span>
							<span class="gallery-cta-title"><?php echo esc_html( $project['project_name'] ); ?></span>
						</a>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- Make Ready Project Sections -->
	<?php
	$alt_bg = false;
	foreach ( $oak_projects as $project ) :
		if ( empty( $project['project_name'] ) ) continue;
		$anchor        = oak_project_anchor( $project['project_name'] );
		$gallery       = ! empty( $project['gallery_images'] ) ? $project['gallery_images'] : array();
		$before_images = ! empty( $project['before_images'] ) ? $project['before_images'] : array();
		$after_images  = ! empty( $project['after_images'] ) ? $project['after_images'] : array();
		$section_class = $alt_bg ? ' section-alt-bg' : '';
		$alt_bg = ! $alt_bg;
	?>
	<section id="<?php echo esc_attr( $anchor ); ?>" class="interior-section py-5<?php echo $section_class; ?>">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2><?php echo esc_html( $project['project_name'] ); ?></h2>
				</div>
			</div>

			<?php if ( ! empty( $gallery ) ) : ?>
			<div class="row mb-4">
				<div class="col-12">
					<h3>Progress Photos</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php oak_render_masonry_gallery( $gallery, $anchor . '-gallery', $project['project_name'] . ' - Progress' ); ?>
				</div>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $before_images ) ) : ?>
			<div class="row mt-5 mb-4">
				<div class="col-12">
					<h3>Before Photos</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php oak_render_masonry_gallery( $before_images, $anchor . '-before', $project['project_name'] . ' - Before' ); ?>
				</div>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $after_images ) ) : ?>
			<div class="row mt-5 mb-4">
				<div class="col-12">
					<h3>After Photos</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php oak_render_masonry_gallery( $after_images, $anchor . '-after', $project['project_name'] . ' - After' ); ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endforeach; ?>

	<?php endif; ?>


</div><!-- end page wrap -->

<?php get_footer(); ?>
