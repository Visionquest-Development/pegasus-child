<?php
/*
	Template Name: IGJ Services Hub
*/
get_header();
/* Content: Pages → Services → boxes "01 — Page Hero" … "07 — Bottom Call-to-Action". */
$hero   = igj_section( 'services', 'hero' );
$groups = igj_section( 'services', 'groups' );
$help   = igj_section( 'services', 'howhelp' );
$fit    = igj_section( 'services', 'fit' );
$basics = igj_section( 'services', 'basics' );
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-services">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'eyebrow' => $hero['eyebrow'],
		'title'   => $hero['title'],
		'lead'    => $hero['lead'],
	) );
	?>
	<?php
	foreach ( (array) $groups['groups'] as $grp ) :
		$label = (string) $grp['label'];
		$slugs = array_values( (array) $grp['services'] );
		if ( ! $slugs ) {
			continue;
		}
		?>
		<section class="igj-section igj-section--compact" aria-labelledby="g-<?php echo esc_attr( sanitize_title( $label ) ); ?>">
			<div class="container">
				<h2 id="g-<?php echo esc_attr( sanitize_title( $label ) ); ?>" class="igj-section-title"><?php echo esc_html( $label ); ?></h2>
				<?php get_template_part( 'templates/igj-service-cards', null, array( 'slugs' => $slugs, 'heading_level' => 'h3' ) ); ?>
			</div>
		</section>
	<?php endforeach; ?>

	<section class="igj-section" aria-labelledby="igj-howhelp">
		<div class="container">
			<div class="row g-4 g-lg-5 align-items-center">
				<div class="col-lg-5 wow fadeInLeft"><?php echo igj_picture( $help['image'], array( 'class' => 'igj-rounded igj-shadow', 'sizes' => '(min-width: 992px) 40vw, 100vw', 'id' => $help['image_id'] ) ); // phpcs:ignore ?></div>
				<div class="col-lg-7 igj-prose wow fadeInRight">
					<?php if ( $help['eyebrow'] ) : ?><p class="igj-eyebrow"><?php echo esc_html( $help['eyebrow'] ); ?></p><?php endif; ?>
					<h2 id="igj-howhelp" class="igj-section-title"><?php echo esc_html( $help['title'] ); ?></h2>
					<?php echo igj_cms_paras( $help['body'] ); // phpcs:ignore -- kses-filtered ?>
					<?php echo igj_schedule_button( 'igj-btn--cta' ); // phpcs:ignore ?>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'templates/igj-carriers', null, array( 'c' => igj_section( 'services', 'carriers' ) ) ); ?>

	<section class="igj-section igj-section--tint">
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-6 igj-prose">
					<h2 class="igj-section-title"><?php echo esc_html( $fit['title'] ); ?></h2>
					<?php if ( $fit['text'] ) : ?><p><?php echo wp_kses_post( igj_render( $fit['text'] ) ); ?></p><?php endif; ?>
					<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>
				</div>
				<div class="col-lg-6">
					<h2 class="igj-section-title"><?php echo esc_html( $basics['title'] ); ?></h2>
					<ul class="igj-linklist">
						<?php foreach ( (array) $basics['links'] as $l ) : ?>
						<li><a href="<?php echo esc_url( igj_cms_url( $l['url'] ) ); ?>"><?php echo esc_html( $l['label'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'templates/igj-cta-band', null, array( 'c' => igj_section( 'services', 'cta' ) ) ); ?>
</main>
</div>
<?php get_footer(); ?>
