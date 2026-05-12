<?php
/*
        Template Name: Iconic Home Page
*/
?>
<?php get_header(); ?>

<?php
    $header_choice = pegasus_get_option( 'header_select' );
    if ( 'header-three' === $header_choice ) {
        get_template_part( 'templates/additional_header' );
    }
?>

<div id="page-wrap" class="home-template">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
</div><!-- end page wrap -->

<?php get_footer(); ?>

