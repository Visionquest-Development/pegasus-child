<?php
/**
 * Child theme WooCommerce wrapper.
 * Overrides the parent Pegasus woocommerce.php so the shop/product pages
 * can drive their own layout via the templates in woocommerce/.
 */
get_header();
?>

<div class="sp sp-page">
	<div class="container">
		<?php woocommerce_content(); ?>
	</div>
</div>
<?php get_footer(); ?>
