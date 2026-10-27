<?php
/*
	Template Name: MNG Menu
*/
get_header();
$menu = mng_data( 'menu' );
?>
<div id="page-wrap">
<main id="primary" class="site-main mng mng-menu-page">
	<?php get_template_part( 'templates/mng-page-hero', null, array( 'image' => 'ribs-on-grill', 'eyebrow' => __( 'Wednesday through Saturday', 'pegasus' ), 'title' => get_the_title(), 'lead' => __( 'A different menu every day we\'re open. Every meal comes with a drink.', 'pegasus' ) ) ); ?>

	<nav class="mng-menu-nav" aria-label="<?php esc_attr_e( 'Menu days', 'pegasus' ); ?>">
		<div class="container">
			<ul>
				<?php foreach ( (array) ( $menu['sections'] ?? array() ) as $sec ) : ?>
					<li><a href="#<?php echo esc_attr( $sec['id'] ); ?>"><span><?php echo esc_html( $sec['day'] ); ?></span> <?php echo esc_html( preg_replace( '/\s*' . preg_quote( $sec['day'], '/' ) . '\s*/', ' ', $sec['title'] ) ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</nav>

	<?php
	while ( have_posts() ) :
		the_post();
		if ( trim( get_the_content() ) ) {
			echo '<section class="mng-intro"><div class="container mng-intro__content">';
			the_content();
			echo '</div></section>';
		}
	endwhile;
	?>

	<?php foreach ( (array) ( $menu['sections'] ?? array() ) as $n => $sec ) : ?>
		<section class="mng-menu-section<?php echo $n % 2 ? ' is-alt' : ''; ?>" id="<?php echo esc_attr( $sec['id'] ); ?>" aria-labelledby="menu-<?php echo esc_attr( $sec['id'] ); ?>">
			<div class="container">
				<div class="row g-4 g-lg-5">
					<div class="col-lg-4">
						<div class="mng-menu-section__aside wow fadeInLeft">
							<p class="mng-script"><?php echo esc_html( $sec['day'] ); ?></p>
							<h2 id="menu-<?php echo esc_attr( $sec['id'] ); ?>" class="mng-section-title"><?php echo esc_html( $sec['title'] ); ?></h2>
							<p class="mng-menu-section__note"><?php echo esc_html( $sec['note'] ?? '' ); ?></p>
							<?php echo mng_picture( $sec['image'], array( 'class' => 'mng-rounded', 'sizes' => '(min-width: 992px) 30vw, 100vw' ) ); // phpcs:ignore ?>
						</div>
					</div>
					<div class="col-lg-8">
						<?php if ( ! empty( $sec['lists'] ) ) : ?>
							<div class="mng-menu-lists">
								<?php foreach ( $sec['lists'] as $list ) : ?>
									<div class="mng-menu-list wow fadeInUp">
										<h3><?php echo esc_html( $list['title'] ); ?></h3>
										<ul>
											<?php foreach ( $list['items'] as $li ) : ?>
												<li><?php echo esc_html( $li ); ?></li>
											<?php endforeach; ?>
										</ul>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<ul class="mng-menu-items">
							<?php foreach ( (array) ( $sec['items'] ?? array() ) as $it ) : ?>
								<li class="mng-menu-item wow fadeInUp">
									<div class="mng-menu-item__head">
										<h3 class="mng-menu-item__name"><?php echo esc_html( $it['name'] ); ?></h3>
										<span class="mng-menu-item__dots" aria-hidden="true"></span>
										<span class="mng-menu-item__price"><?php echo esc_html( $it['price'] ); ?></span>
									</div>
									<?php if ( ! empty( $it['desc'] ) ) : ?>
										<p class="mng-menu-item__desc"><?php echo esc_html( $it['desc'] ); ?></p>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

	<section class="mng-menu-fine">
		<div class="container text-center">
			<p><?php esc_html_e( 'Menu and prices can change. Call to check today\'s specials and special requests.', 'pegasus' ); ?></p>
			<?php get_template_part( 'templates/mng-order-cta', null, array( 'compact' => true ) ); ?>
		</div>
	</section>
</main>
</div>
<?php get_footer(); ?>
