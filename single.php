<?php
/**
 * Single post — themed to match the Rice Capital templates.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();

$posts_page_id  = (int) get_option( 'page_for_posts' );
$posts_page_url = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/' );
$posts_title    = $posts_page_id ? get_the_title( $posts_page_id ) : 'News';
?>

<div id="page-wrap">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
	$cat_list  = get_the_category();
	$cat_name  = ! empty( $cat_list ) ? $cat_list[0]->name : '';
	$hero_img  = get_the_post_thumbnail_url( get_the_ID(), 'full' );
?>

	<!-- ===== ARTICLE HEADER ===== -->
	<section class="rcf-subhero rcf-subhero--article">
		<div class="container">
			<nav class="rcf-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Rice Capital Fund</a>
				<span class="sep" aria-hidden="true">/</span>
				<a href="<?php echo esc_url( $posts_page_url ); ?>"><?php echo esc_html( $posts_title ); ?></a>
				<span class="sep" aria-hidden="true">/</span>
				<span class="cur"><?php the_title(); ?></span>
			</nav>
			<div class="rcf-article__meta">
				<?php if ( $cat_name ) : ?><span class="rcf-article__cat"><?php echo esc_html( $cat_name ); ?></span><?php endif; ?>
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			</div>
			<h1 class="rcf-article__title"><?php the_title(); ?></h1>
			<div class="rcf-subhero__rule" aria-hidden="true"></div>
		</div>
	</section>

	<?php if ( $hero_img ) : ?>
	<div class="rcf-article__hero-img">
		<div class="container">
			<div class="rcf-article__hero-img-inner" style="background-image:url('<?php echo esc_url( $hero_img ); ?>')" role="img" aria-label="<?php echo esc_attr( get_the_title() ); ?>"></div>
		</div>
	</div>
	<?php endif; ?>

	<!-- ===== ARTICLE BODY ===== -->
	<section class="rcf-article">
		<div class="container">
			<div class="rcf-article__inner">
				<div class="rcf-article__body rcf-prose">
					<?php the_content(); ?>
				</div>

				<?php
				$tag_list = get_the_tag_list( '<ul class="rcf-article__tags"><li>', '</li><li>', '</li></ul>' );
				if ( $tag_list ) {
					echo wp_kses_post( $tag_list );
				}
				?>

				<div class="rcf-article__foot">
					<a class="rcf-btn rcf-btn--ghost" href="<?php echo esc_url( $posts_page_url ); ?>">&larr; Back to <?php echo esc_html( $posts_title ); ?></a>
				</div>

				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			</div>
		</div>
	</section>

<?php endwhile; endif; ?>

</div><!-- end page-wrap -->

<?php get_footer(); ?>
