<?php
/**
 * Brand Grid – Full-width hero panel inspired by Fifth Group layout.
 * Uses the same images / logos as logo_slider.php.
 */

$brands = array(
	array(
		'name' => 'Mabellas',
		'url'  => 'https://mabellas.com',
		'bg'   => '/wp-content/themes/pegasus-child/images/logo_slider/mabellas_bkg.png',
		'logo' => '/wp-content/themes/pegasus-child/images/logo_slider/mabellas_logo.png',
	),
	array(
		'name' => 'The Loft',
		'url'  => 'https://theloft.com',
		'bg'   => '/wp-content/themes/pegasus-child/images/logo_slider/theloft_bkg.png',
		'logo' => '/wp-content/themes/pegasus-child/images/logo_slider/theloft_logo.png',
	),
	array(
		'name' => 'Salt Cellar',
		'url'  => 'https://saltcellar.com',
		'bg'   => '/wp-content/themes/pegasus-child/images/logo_slider/saltcellar_bkg.png',
		'logo' => '/wp-content/themes/pegasus-child/images/logo_slider/saltcellar_logo.png',
	),
	array(
		'name' => 'The Mix Market',
		'url'  => 'https://themixmarket.com',
		'bg'   => '/wp-content/themes/pegasus-child/images/logo_slider/mix_bkg.png',
		'logo' => '/wp-content/themes/pegasus-child/images/logo_slider/mix_market_logo.png',
	),
	array(
		'name' => "Tommy G's",
		'url'  => 'https://tommygs.com',
		'bg'   => '/wp-content/themes/pegasus-child/images/logo_slider/tommygs_bkg.png',
		'logo' => '/wp-content/themes/pegasus-child/images/logo_slider/tommygs_logo.png',
	),
);
?>

<section class="ulg-brand-grid">
	<div class="ulg-brand-grid__row">
		<?php foreach ( $brands as $brand ) : ?>
			<a href="<?php echo esc_url( $brand['url'] ); ?>"
			   class="ulg-brand-grid__panel"
			   style="background-image: url('<?php echo esc_url( $brand['bg'] ); ?>');"
			   aria-label="<?php echo esc_attr( $brand['name'] ); ?>">
				<span class="ulg-brand-grid__overlay"></span>
				<img class="ulg-brand-grid__logo"
					 src="<?php echo esc_url( $brand['logo'] ); ?>"
					 alt="<?php echo esc_attr( $brand['name'] ); ?>">
			</a>
		<?php endforeach; ?>
	</div>
</section>
