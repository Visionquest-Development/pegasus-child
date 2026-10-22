<?php
/*
	Template Name: IGJ Service Page
*/
get_header();
$slug = igj_current_service_slug();
$svc  = $slug ? igj_service( $slug ) : array();
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-service">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'title'   => $svc['title'] ?? get_the_title(),
		'lead'    => $svc['lead'] ?? '',
		'eyebrow' => __( 'Health insurance services', 'pegasus' ),
	) );
	?>

	<div class="igj-section">
		<div class="container">
			<div class="row g-4 g-lg-5">
				<article class="col-lg-8 igj-prose">
					<?php if ( ! $svc ) : ?>
						<?php echo igj_todo( 'This page has no entry in data/services.json; add one keyed by the page slug.' ); // phpcs:ignore ?>
					<?php endif; ?>
					<?php foreach ( (array) ( $svc['sections'] ?? array() ) as $sec ) : ?>
						<section class="igj-block wow fadeInUp">
							<h2><?php echo esc_html( $sec['h'] ); ?></h2>
							<?php foreach ( (array) ( $sec['p'] ?? array() ) as $p ) : ?>
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
							<h2><?php esc_html_e( 'Supplemental coverage options', 'pegasus' ); ?></h2>
							<?php get_template_part( 'templates/igj-service-cards', null, array( 'slugs' => $children, 'heading_level' => 'h3' ) ); ?>
						</section>
					<?php endif; ?>

					<?php if ( ! empty( $svc['faq'] ) ) : ?>
						<section class="igj-block" aria-labelledby="faq-title">
							<h2 id="faq-title"><?php echo esc_html( sprintf( __( '%s: frequently asked questions', 'pegasus' ), $svc['title'] ) ); ?></h2>
							<?php get_template_part( 'templates/igj-faq-list', null, array( 'items' => $svc['faq'], 'id' => 'faq' ) ); ?>
							<p><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'More health insurance FAQs', 'pegasus' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
						</section>
					<?php endif; ?>
				</article>

				<aside class="col-lg-4" aria-label="<?php esc_attr_e( 'Get help and related pages', 'pegasus' ); ?>">
					<div class="igj-sidecard igj-sidecard--quote">
						<h2 class="igj-sidecard__title"><?php esc_html_e( 'Talk to Joe', 'pegasus' ); ?></h2>
						<p><?php esc_html_e( 'Get a free, no-obligation quote and straight answers about your options.', 'pegasus' ); ?></p>
						<a class="btn igj-btn igj-btn--cta w-100 mb-2" href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php esc_html_e( 'Get a Free Quote', 'pegasus' ); ?></a>
						<a class="btn igj-btn igj-btn--outline w-100" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'phone_display' ) ); ?></a>
					</div>
					<?php if ( ! empty( $svc['related'] ) ) : ?>
						<nav class="igj-sidecard" aria-labelledby="rel-title">
							<h2 id="rel-title" class="igj-sidecard__title"><?php esc_html_e( 'Related coverage', 'pegasus' ); ?></h2>
							<ul class="igj-linklist">
								<?php foreach ( $svc['related'] as $r ) : ?>
									<li><a href="<?php echo esc_url( igj_service_url( $r ) ); ?>"><?php echo esc_html( igj_service( $r )['title'] ?? $r ); ?></a></li>
								<?php endforeach; ?>
								<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'All services', 'pegasus' ); ?></a></li>
							</ul>
						</nav>
					<?php endif; ?>
					<?php if ( ! empty( $svc['learn'] ) ) : ?>
						<nav class="igj-sidecard" aria-labelledby="learn-title">
							<h2 id="learn-title" class="igj-sidecard__title"><?php esc_html_e( 'Helpful guides', 'pegasus' ); ?></h2>
							<ul class="igj-linklist">
								<?php foreach ( $svc['learn'] as $l ) : ?>
									<li><a href="<?php echo esc_url( igj_learn_url( $l ) ); ?>"><?php echo esc_html( igj_learn_title( $l ) ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</nav>
					<?php endif; ?>
				</aside>
			</div>
		</div>
	</div>

	<?php get_template_part( 'templates/igj-cta-band', null, array( 'title' => sprintf( __( 'Questions about %s?', 'pegasus' ), $svc['title'] ?? get_the_title() ) ) ); ?>
</main>
</div>
<?php get_footer(); ?>
