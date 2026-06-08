<?php
/**
 * The Template for displaying all single products.
 * Sugarpeddler — breadcrumb + gallery/info + tabs + related.
 *
 * @see https://woo.com/document/template-structure/
 */

defined( 'ABSPATH' ) || exit;
?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<?php
	while ( have_posts() ) :
		the_post();
		wc_get_template_part( 'content', 'single-product' );
	endwhile;
?>

<?php do_action( 'woocommerce_after_main_content' ); ?>
