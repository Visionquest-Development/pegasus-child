<?php

/*
Template Name: Interior Template
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
	<?php get_template_part( 'templates/interior/kitchen-gallery' ); ?>
	<?php get_template_part( 'templates/interior/kitchen-before-after' ); ?>
	<?php get_template_part( 'templates/interior/bathroom-gallery' ); ?>
	<?php get_template_part( 'templates/interior/bathroom-before-after' ); ?>
	<?php get_template_part( 'templates/interior/general-gallery' ); ?>

	<?php
	$oak_projects    = get_post_meta( get_the_ID(), 'oak_projects_group', true );
	$oak_ba_pairs    = get_post_meta( get_the_ID(), 'oak_ba_group', true );
	$has_cmb2_data   = ! empty( $oak_projects ) || ! empty( $oak_ba_pairs );

	if ( $has_cmb2_data ) :
	?>

	<?php // ---- Project Gallery Sections ---- ?>
	<?php if ( ! empty( $oak_projects ) ) : ?>
	<?php foreach ( $oak_projects as $project ) :
		if ( empty( $project['project_name'] ) ) continue;
		$anchor  = oak_project_anchor( $project['project_name'] );
		$gallery = ! empty( $project['gallery_images'] ) ? $project['gallery_images'] : array();
	?>
	<section id="<?php echo esc_attr( $anchor ); ?>" class="interior-gallery-section py-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2 class="gallery-section-title"><?php echo esc_html( $project['project_name'] ); ?></h2>
				</div>
			</div>
			<?php if ( ! empty( $gallery ) ) : ?>
			<div class="row">
				<div class="col-12">
					<?php oak_render_masonry_gallery( $gallery, $anchor . '-gallery', $project['project_name'] ); ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endforeach; ?>
	<?php endif; ?>

	<?php // ---- Before & After Comparison Sliders ---- ?>
	<?php if ( ! empty( $oak_ba_pairs ) ) :
		// Group pairs by section name.
		$ba_sections = array();
		foreach ( $oak_ba_pairs as $pair ) {
			if ( empty( $pair['section_name'] ) || empty( $pair['before_image'] ) || empty( $pair['after_image'] ) ) continue;
			$ba_sections[ $pair['section_name'] ][] = $pair;
		}

		$alt_bg = false;
		$ba_counter = 0;
		foreach ( $ba_sections as $section_name => $pairs ) :
			$anchor        = oak_project_anchor( $section_name );
			$section_class = $alt_bg ? ' section-alt-bg' : '';
			$alt_bg = ! $alt_bg;
	?>
	<section id="<?php echo esc_attr( $anchor ); ?>" class="interior-section py-5<?php echo $section_class; ?>">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2><?php echo esc_html( $section_name ); ?></h2>
				</div>
			</div>
			<?php
			$chunks = array_chunk( $pairs, 2 );
			foreach ( $chunks as $row_pairs ) :
			?>
			<div class="row g-4 mb-4">
				<?php foreach ( $row_pairs as $pair ) :
					$ba_counter++;
				?>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="<?php echo esc_attr( $anchor . '-' . $ba_counter ); ?>">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo esc_url( $pair['before_image'] ); ?>" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo esc_url( $pair['after_image'] ); ?>" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endforeach; ?>
		</div>
	</section>
	<?php endforeach; ?>
	<?php endif; ?>

	<?php endif; ?>

</div><!-- end page wrap -->

<?php get_footer(); ?>
