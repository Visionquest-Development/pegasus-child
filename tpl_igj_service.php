<?php
/*
	Template Name: IGJ Service Page
*/
get_header();
$slug = igj_current_service_slug();
$svc  = $slug ? igj_service( $slug ) : array();
/* Content: Pages → (service page) → boxes "01 — Page Hero" … "06 — Bottom Call-to-Action". Defaults: data/services.json. */
$hero    = igj_section( 'service', 'hero' );
$content = igj_section( 'service', 'content' );
$faq     = igj_section( 'service', 'faq' );
$side    = igj_section( 'service', 'sidebar' );
$title   = $hero['title'] ? $hero['title'] : get_the_title();
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-service">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'title'   => $title,
		'lead'    => $hero['lead'],
		'eyebrow' => $hero['eyebrow'],
	) );
	?>

	<div class="igj-section">
		<div class="container">
			<div class="row g-4 g-lg-5">
				<article class="col-lg-8 igj-prose">
					<?php if ( ! $svc ) : ?>
						<?php echo igj_todo( 'This page has no entry in data/services.json; add one keyed by the page slug.' ); // phpcs:ignore ?>
					<?php endif; ?>
					<?php foreach ( (array) $content['sections'] as $sec ) : ?>
						<section class="igj-block wow fadeInUp">
							<?php if ( $sec['heading'] ) : ?><h2><?php echo esc_html( $sec['heading'] ); ?></h2><?php endif; ?>
							<?php foreach ( (array) $sec['body'] as $p ) : ?>
								<p><?php echo wp_kses_post( igj_render( $p ) ); ?></p>
							<?php endforeach; ?>
							<?php if ( ! empty( $sec['list'] ) ) : ?>
								<ul class="igj-checklist">
									<?php foreach ( $sec['list'] as $li ) : ?>
										<li><?php echo wp_kses_post( igj_render( $li ) ); ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</section>
					<?php endforeach; ?>

					<?php
					/* Editor content (optional) is added below the built-in copy. */
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>

					<?php
					/* Supplemental hub: list its child pages. */
					$children = array_keys( array_filter( igj_services(), function ( $s ) use ( $slug ) { return ( $s['parent'] ?? null ) === $slug; } ) );
					if ( $children ) :
						?>
						<section class="igj-block">
							<h2><?php echo esc_html( $content['children_title'] ); ?></h2>
							<?php get_template_part( 'templates/igj-service-cards', null, array( 'slugs' => $children, 'heading_level' => 'h3' ) ); ?>
						</section>
					<?php endif; ?>

					<?php if ( ! empty( $faq['items'] ) ) : ?>
						<section class="igj-block" aria-labelledby="faq-title">
							<h2 id="faq-title"><?php echo esc_html( igj_cms_tokens( $faq['title'], array( 'title' => $title ) ) ); ?></h2>
							<?php get_template_part( 'templates/igj-faq-list', null, array( 'items' => $faq['items'], 'id' => 'faq' ) ); ?>
							<?php if ( $faq['more_label'] ) : ?>
							<p><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php echo esc_html( $faq['more_label'] ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
							<?php endif; ?>
						</section>
					<?php endif; ?>
				</article>

				<aside class="col-lg-4" aria-label="<?php esc_attr_e( 'Get help and related pages', 'pegasus' ); ?>">
					<div class="igj-sidecard igj-sidecard--quote">
						<h2 class="igj-sidecard__title"><?php echo esc_html( $side['talk_title'] ); ?></h2>
						<?php if ( $side['talk_text'] ) : ?><p><?php echo wp_kses_post( igj_render( $side['talk_text'] ) ); ?></p><?php endif; ?>
						<a class="btn igj-btn igj-btn--cta w-100 mb-2" href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php echo esc_html( $side['talk_button'] ); ?></a>
						<a class="btn igj-btn igj-btn--outline w-100" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'phone_display' ) ); ?></a>
					</div>
					<?php $related = array_values( array_filter( wp_list_pluck( (array) $side['related'], 'service' ) ) ); ?>
					<?php if ( $related ) : ?>
						<nav class="igj-sidecard" aria-labelledby="rel-title">
							<h2 id="rel-title" class="igj-sidecard__title"><?php echo esc_html( $side['related_title'] ); ?></h2>
							<ul class="igj-linklist">
								<?php foreach ( $related as $r ) : ?>
									<li><a href="<?php echo esc_url( igj_service_url( $r ) ); ?>"><?php echo esc_html( igj_service_card( $r )['title'] ?? $r ); ?></a></li>
								<?php endforeach; ?>
								<?php if ( $side['all_label'] ) : ?>
								<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php echo esc_html( $side['all_label'] ); ?></a></li>
								<?php endif; ?>
							</ul>
						</nav>
					<?php endif; ?>
					<?php $guides = array_values( array_filter( wp_list_pluck( (array) $side['guides'], 'guide' ) ) ); ?>
					<?php if ( $guides ) : ?>
						<nav class="igj-sidecard" aria-labelledby="learn-title">
							<h2 id="learn-title" class="igj-sidecard__title"><?php echo esc_html( $side['guides_title'] ); ?></h2>
							<ul class="igj-linklist">
								<?php foreach ( $guides as $l ) : ?>
									<li><a href="<?php echo esc_url( igj_learn_url( $l ) ); ?>"><?php echo esc_html( igj_learn_title( $l ) ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</nav>
					<?php endif; ?>
				</aside>
			</div>
		</div>
	</div>

	<?php
	$cta          = igj_section( 'service', 'cta' );
	$cta['title'] = igj_cms_tokens( $cta['title'], array( 'title' => $title ) );
	get_template_part( 'templates/igj-cta-band', null, array( 'c' => $cta ) );
	?>
</main>
</div>
<?php get_footer(); ?>
