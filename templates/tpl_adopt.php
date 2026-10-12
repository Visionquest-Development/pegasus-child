<?php
/*
	Template Name: Adopt Template
*/
?>

<?php get_header(); ?>

<div id="page-wrap">
	<?php
		// Option on the page options
		$pegasus_container_choice = get_post_meta(get_the_ID(), 'pegasus-page-container-checkbox', true);

		// Option from the theme options for global fullwidth
		//$full_container_chk_choice = pegasus_theme_get_option('full_container_chk');
	?>

	<div class="<?php
		if ($full_container_chk_choice === 'on' || $pegasus_container_choice === 'on') {
			echo 'container-fluid';
		} else {
			echo 'container';
		}
	?> pets-panel opp-bkg p-3 mb-5">
		<!-- Example row of columns -->
		<div class="row">
			<div class="col-md-12">
				<div class="inner-content ">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php
							//$page_header_choice = pegasus_theme_get_option('page_header_chk');
							if ($page_header_choice != 'on') :
						?>
							<div class="page-header">
								<h1><?php the_title(); ?></h1>
							</div>
						<?php endif; ?>

						<?php the_content(); ?>

						<div class="row">
							<?php
								$query = new WP_Query(array(
									'post_type' => array('pets'),
									'posts_per_page' => -1,
									'order' => 'ASC',
									'orderby' => 'title'
								));

								while ($query->have_posts()) : $query->the_post();
									$thumb_url = has_post_thumbnail()
										? wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false, '')
										: array(get_template_directory_uri() . "/images/banner.png", "1");
							?>

								<div class="content-item-container col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 <?php echo strtolower($tax); ?>">
									<article class="article-<?php the_ID(); ?> block-inner">
										<a href="<?php the_permalink(); ?>" class="content-item-image" style="background-image: url('<?php echo pegasus_image_display('full', '', false); ?>');"></a>
										<div class="content-item-wrapper">
											<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
												<h3 class="content-item-title"><?php the_title(); ?></h3>
											</a>
											<a class="opp-button" href="<?php the_permalink(); ?>">Learn More</a>
										</div>
										<?php
											if (function_exists('wp_bootstrap_edit_post_link')) {
												wp_bootstrap_edit_post_link(
													sprintf(
														__('Edit<span class="screen-reader-text"> "%s"</span>', 'textdomain'),
														get_the_title()
													),
													'<span class="edit-link">',
													'</span>'
												);
											}
										?>
									</article>
								</div>
							<?php endwhile; wp_reset_query(); ?>
						</div>

						<?php comments_template(); ?>
					<?php endwhile; else: ?>
						<div class="page-header">
							<h1>Oh no!</h1>
						</div>
						<p>No content is appearing for this page!</p>
					<?php endif; ?>
				</div><!-- end inner content -->
			</div>
		</div>
	</div>
</div><!-- end page wrap -->

<?php get_footer(); ?>
