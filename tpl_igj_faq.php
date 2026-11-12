<?php
/*
	Template Name: IGJ FAQ
*/
get_header();
/* Content: Pages → FAQ → boxes "01 — Page Hero" … "04 — Bottom Call-to-Action". */
$hero   = igj_section( 'faq', 'hero' );
$side   = igj_section( 'faq', 'sidebar' );
$groups = igj_faq_page_groups();
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-faqpage">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'title' => $hero['title'],
		'lead'  => $hero['lead'],
	) );
	?>
	<div class="igj-section">
		<div class="container">
			<div class="row g-4 g-lg-5">
				<div class="col-lg-8" id="faq">
					<?php foreach ( $groups as $g ) : ?>
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
						<h2 class="igj-sidecard__title"><?php echo esc_html( $side['title'] ); ?></h2>
						<?php if ( $side['text'] ) : ?><p><?php echo esc_html( $side['text'] ); ?></p><?php endif; ?>
						<a class="btn igj-btn igj-btn--cta w-100 mb-2" href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php echo esc_html( $side['button'] ); ?></a>
						<a class="btn igj-btn igj-btn--outline w-100" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'phone_display' ) ); ?></a>
					</div>
					<nav class="igj-sidecard" aria-labelledby="faq-svc">
						<h2 id="faq-svc" class="igj-sidecard__title"><?php echo esc_html( $side['nav_title'] ); ?></h2>
						<ul class="igj-linklist">
							<?php foreach ( array_keys( igj_services() ) as $slug ) : ?>
								<li><a href="<?php echo esc_url( igj_service_url( $slug ) ); ?>"><?php echo esc_html( igj_service_card( $slug )['title'] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</nav>
				</aside>
			</div>
		</div>
	</div>
	<?php get_template_part( 'templates/igj-cta-band', null, array( 'c' => igj_section( 'faq', 'cta' ) ) ); ?>
</main>
</div>
<?php get_footer(); ?>
