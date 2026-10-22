<?php
/**
 * Learn article (single post) at /learn/%postname%/.
 */
get_header();
the_post();
$slug    = get_post_field( 'post_name' );
$related = array_keys( array_filter( igj_services(), function ( $s ) use ( $slug ) { return in_array( $slug, (array) ( $s['learn'] ?? array() ), true ); } ) );
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-article">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'title'   => get_the_title(),
		'eyebrow' => get_the_category() ? get_the_category()[0]->name : __( 'Learn', 'pegasus' ),
		'cta'     => false,
	) );
	?>
	<div class="igj-section">
		<div class="container">
			<div class="row g-4 g-lg-5">
				<article class="col-lg-8 igj-prose" id="post-<?php the_ID(); ?>">
					<p class="igj-byline">
						<?php printf( esc_html__( 'By %s', 'pegasus' ), '<a href="' . esc_url( home_url( '/about/' ) ) . '">' . esc_html( igj_site( 'agent.name' ) ) . '</a>' ); // phpcs:ignore ?>
						· <?php esc_html_e( 'Updated', 'pegasus' ); ?> <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date() ); ?></time>
					</p>
					<?php the_content(); ?>
					<div class="igj-authorbox">
						<?php echo igj_picture( 'joe-avena', array( 'class' => 'igj-authorbox__img', 'alt' => '' ) ); // phpcs:ignore ?>
						<div>
							<p class="igj-authorbox__name"><?php echo esc_html( igj_site( 'agent.full_name' ) ); ?></p>
							<p class="mb-1"><?php echo esc_html( igj_site( 'agent.job_title' ) ); ?>, <?php echo esc_html( igj_site( 'name' ) ); ?></p>
							<p class="mb-0 small"><?php esc_html_e( 'General information only, not legal or tax advice. Rules change; confirm current details for your situation.', 'pegasus' ); ?> <a href="<?php echo esc_url( home_url( '/disclaimers/' ) ); ?>"><?php esc_html_e( 'Disclaimers', 'pegasus' ); ?></a></p>
						</div>
					</div>
				</article>
				<aside class="col-lg-4" aria-label="<?php esc_attr_e( 'Related coverage and guides', 'pegasus' ); ?>">
					<div class="igj-sidecard igj-sidecard--quote">
						<h2 class="igj-sidecard__title"><?php esc_html_e( 'Want a second opinion?', 'pegasus' ); ?></h2>
						<p><?php esc_html_e( 'Joe can review your options with you, free.', 'pegasus' ); ?></p>
						<a class="btn igj-btn igj-btn--cta w-100 mb-2" href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php esc_html_e( 'Get a Free Quote', 'pegasus' ); ?></a>
						<a class="btn igj-btn igj-btn--outline w-100" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'phone_display' ) ); ?></a>
					</div>
					<?php if ( $related ) : ?>
						<nav class="igj-sidecard" aria-labelledby="art-svc">
							<h2 id="art-svc" class="igj-sidecard__title"><?php esc_html_e( 'Related coverage', 'pegasus' ); ?></h2>
							<ul class="igj-linklist">
								<?php foreach ( array_slice( $related, 0, 6 ) as $r ) : ?>
									<li><a href="<?php echo esc_url( igj_service_url( $r ) ); ?>"><?php echo esc_html( igj_service( $r )['title'] ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</nav>
					<?php endif; ?>
					<nav class="igj-sidecard" aria-labelledby="art-more">
						<h2 id="art-more" class="igj-sidecard__title"><?php esc_html_e( 'More guides', 'pegasus' ); ?></h2>
						<ul class="igj-linklist">
							<?php
							$more = get_posts( array( 'post__not_in' => array( get_the_ID() ), 'posts_per_page' => 4 ) );
							foreach ( $more as $m ) :
								?>
								<li><a href="<?php echo esc_url( get_permalink( $m ) ); ?>"><?php echo esc_html( get_the_title( $m ) ); ?></a></li>
							<?php endforeach; ?>
							<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'Health insurance FAQs', 'pegasus' ); ?></a></li>
						</ul>
					</nav>
				</aside>
			</div>
		</div>
	</div>
	<?php get_template_part( 'templates/igj-cta-band' ); ?>
</main>
</div>
<?php get_footer(); ?>
