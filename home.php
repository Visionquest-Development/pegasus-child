<?php
/**
 * Blog index (posts page) — themed to match the Rice Capital templates.
 *
 * WordPress uses this file to render the page set as "Posts page" under
 * Settings → Reading (currently the "News" page). The page's own template
 * dropdown is ignored for the posts page, so all styling lives here.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();

$posts_page_id = (int) get_option( 'page_for_posts' );

/* ---- Sub-hero content (editable via CMB2 on the Posts page) ---- */
$hero_heading = $posts_page_id ? get_post_meta( $posts_page_id, 'rcf_blog_hero_heading', true ) : '';
$hero_heading = $hero_heading ?: 'News &amp; Insights';
$hero_sub     = $posts_page_id ? get_post_meta( $posts_page_id, 'rcf_blog_hero_sub', true ) : '';
$hero_sub     = $hero_sub ?: 'Commentary, firm updates, and perspective from the Rice Capital investment team.';

$posts_title  = $posts_page_id ? get_the_title( $posts_page_id ) : 'News';
$ext_icon     = '<svg width="12" height="12" viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" focusable="false" style="margin-left:6px;flex-shrink:0"><path d="M4 1H12V9"/><path d="M12 1L5 8"/><path d="M9 12H1V4"/></svg>';

/**
 * Render one post as a card. $featured = true renders the wide hero card.
 */
function rcf_render_post_card( $featured = false ) {
	$cat_list = get_the_category();
	$cat_name = ! empty( $cat_list ) ? $cat_list[0]->name : '';
	$img      = get_the_post_thumbnail_url( get_the_ID(), $featured ? 'large' : 'medium_large' );
	$excerpt  = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), $featured ? 44 : 24, '&hellip;' );
	$classes  = $featured ? 'rcf-post-card rcf-post-card--featured' : 'rcf-post-card';
	?>
	<article <?php post_class( $classes ); ?>>
		<a class="rcf-post-card__img<?php echo $img ? '' : ' is-empty'; ?>"
		   href="<?php the_permalink(); ?>"
		   <?php if ( $img ) : ?>style="background-image:url('<?php echo esc_url( $img ); ?>')"<?php endif; ?>
		   role="img" aria-label="<?php echo esc_attr( get_the_title() ); ?>"></a>
		<div class="rcf-post-card__body">
			<div class="rcf-post-card__meta">
				<?php if ( $cat_name ) : ?><span class="rcf-post-card__cat"><?php echo esc_html( $cat_name ); ?></span><?php endif; ?>
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			</div>
			<h2 class="rcf-post-card__title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<?php if ( $excerpt ) : ?><p class="rcf-post-card__excerpt"><?php echo esc_html( $excerpt ); ?></p><?php endif; ?>
			<a class="rcf-post-card__more" href="<?php the_permalink(); ?>">Read more<span class="rcf-post-card__more-icon" aria-hidden="true">&rarr;</span></a>
		</div>
	</article>
	<?php
}
?>

<div id="page-wrap">

	<!-- ===== SUB-HERO ===== -->
	<section class="rcf-subhero">
		<div class="container">
			<nav class="rcf-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Rice Capital Fund</a>
				<span class="sep" aria-hidden="true">/</span>
				<span class="cur"><?php echo esc_html( $posts_title ); ?></span>
			</nav>
			<h1><?php echo wp_kses_post( $hero_heading ); ?></h1>
			<div class="rcf-subhero__rule" aria-hidden="true"></div>
			<p class="rcf-subhero__sub"><?php echo esc_html( $hero_sub ); ?></p>
		</div>
	</section>

	<!-- ===== POSTS ===== -->
	<section class="rcf-blog">
		<div class="container">
			<?php if ( have_posts() ) : ?>

				<?php
				$is_first    = true;
				$grid_open   = false;
				$show_featured = ( ! is_paged() ); // Only feature the newest post on page 1.
				while ( have_posts() ) : the_post();
					if ( $is_first && $show_featured ) {
						rcf_render_post_card( true );
						$is_first = false;
						continue;
					}
					if ( ! $grid_open ) {
						echo '<div class="rcf-blog__grid">';
						$grid_open = true;
					}
					rcf_render_post_card( false );
				endwhile;
				if ( $grid_open ) {
					echo '</div>';
				}
				?>

				<?php
				$pagination = paginate_links( array(
					'type'      => 'list',
					'prev_text' => '&larr; Newer',
					'next_text' => 'Older &rarr;',
					'mid_size'  => 1,
				) );
				if ( $pagination ) {
					echo '<nav class="rcf-pagination" aria-label="Posts">' . wp_kses_post( $pagination ) . '</nav>';
				}
				?>

			<?php else : ?>
				<div class="rcf-blog__empty">
					<h2 class="rcf-h2">No posts yet.</h2>
					<p class="rcf-body-text">Firm news and insights will appear here as they are published.</p>
				</div>
			<?php endif; ?>
		</div>
	</section>

</div><!-- end page-wrap -->

<?php get_footer(); ?>
