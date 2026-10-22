<?php
/*
	Template Name: IGJ FAQ
*/
get_header();
$faq = igj_data( 'faq' );
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-faqpage">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'title' => __( 'Health Insurance FAQs', 'pegasus' ),
		'lead'  => __( 'Straight answers to the questions Joe hears most. Don’t see yours? Just ask.', 'pegasus' ),
	) );
	?>
	<div class="igj-section">
		<div class="container">
			<div class="row g-4 g-lg-5">
				<div class="col-lg-8" id="faq">
					<?php foreach ( (array) ( $faq['groups'] ?? array() ) as $g ) : ?>
						<section class="igj-block">
							<?php get_template_part( 'templates/igj-faq-list', null, array( 'items' => $g['items'], 'title' => $g['group'] ) ); ?>
						</section>
					<?php endforeach; ?>
					<div class="igj-prose">
						<?php
						while ( have_posts() ) :
							the_post();
							the_content();
						endwhile;
						?>
					</div>
				</div>
				<aside class="col-lg-4" aria-label="<?php esc_attr_e( 'Services and guides', 'pegasus' ); ?>">
					<div class="igj-sidecard igj-sidecard--quote">
						<h2 class="igj-sidecard__title"><?php esc_html_e( 'Still have questions?', 'pegasus' ); ?></h2>
						<p><?php esc_html_e( 'Joe is happy to walk you through it.', 'pegasus' ); ?></p>
						<a class="btn igj-btn igj-btn--cta w-100 mb-2" href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php esc_html_e( 'Get a Free Quote', 'pegasus' ); ?></a>
						<a class="btn igj-btn igj-btn--outline w-100" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'phone_display' ) ); ?></a>
					</div>
					<nav class="igj-sidecard" aria-labelledby="faq-svc">
						<h2 id="faq-svc" class="igj-sidecard__title"><?php esc_html_e( 'Coverage by situation', 'pegasus' ); ?></h2>
						<ul class="igj-linklist">
							<?php foreach ( igj_services() as $slug => $s ) : ?>
								<li><a href="<?php echo esc_url( igj_service_url( $slug ) ); ?>"><?php echo esc_html( $s['title'] ); ?></a></li>
							<?php endforeach; ?>
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
