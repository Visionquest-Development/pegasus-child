<?php get_header(); ?>

<section class="directory-single py-5">
	<div class="container">
		<?php if (have_posts()) : while (have_posts()) : the_post();
			$post_id = get_the_ID();

			// Core fields
			$name        = get_the_title();
			$content     = get_the_content();
			$image       = get_the_post_thumbnail_url($post_id, 'full');

			// CMB2 fields
			$company_name  = get_post_meta($post_id, 'vv_directory_company_name', true);
			$company_logo  = get_post_meta($post_id, 'vv_directory_company_logo', true);
			$website       = get_post_meta($post_id, 'vv_directory_company_website', true);
			$contact       = get_post_meta($post_id, 'vv_directory_contact', true);
			$email         = get_post_meta($post_id, 'vv_directory_email', true);

			// Taxonomies
			$categories = get_the_terms($post_id, 'directory_categories');
			$tags       = get_the_terms($post_id, 'directory_tags');
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="mb-4">
				<h1 class="mb-3"><?php echo esc_html($name); ?></h1>

				<?php if ($company_logo) : ?>
					<img src="<?php echo esc_url($company_logo); ?>" alt="<?php echo esc_attr($company_name ?: $name); ?>" class="img-fluid mb-3" style="max-height: 80px;">
				<?php endif; ?>

				<?php if ($company_name) : ?>
					<h2 class="h5 text-muted"><?php echo esc_html($company_name); ?></h2>
				<?php endif; ?>
			</header>

			<?php if ($image) : ?>
				<div class="mb-4">
					<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($name); ?>" class="img-fluid">
				</div>
			<?php endif; ?>

			<div class="directory-meta mb-4">
				<?php if ($website) : ?>
					<p><strong>Website:</strong> <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener"><?php echo esc_html($website); ?></a></p>
				<?php endif; ?>

				<?php if ($contact) : ?>
					<p><strong>Contact:</strong> <?php echo esc_html($contact); ?></p>
				<?php endif; ?>

				<?php if ($email) : ?>
					<p><strong>Email:</strong> <a href="mailto:<?php echo antispambot($email); ?>"><?php echo antispambot($email); ?></a></p>
				<?php endif; ?>
			</div>

			<div class="directory-content mb-4">
				<?php the_content(); ?>
			</div>

			<div class="directory-taxonomies mb-4">
				<?php if (!empty($categories)) : ?>
					<p><strong>Categories:</strong>
						<?php foreach ($categories as $cat) : ?>
							<span class="badge bg-secondary me-1"><?php echo esc_html($cat->name); ?></span>
						<?php endforeach; ?>
					</p>
				<?php endif; ?>

				<?php if (!empty($tags)) : ?>
					<p><strong>Tags:</strong>
						<?php foreach ($tags as $tag) : ?>
							<span class="badge bg-info text-dark me-1"><?php echo esc_html($tag->name); ?></span>
						<?php endforeach; ?>
					</p>
				<?php endif; ?>
			</div>
		</article>

		<?php endwhile; endif; ?>
	</div>
</section>

<?php get_footer(); ?>
