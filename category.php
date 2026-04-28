<?php get_header(); ?>

<?php
  $cat          = get_queried_object();
  $cat_name     = $cat ? $cat->name : 'Category';
  $cat_desc     = $cat ? $cat->description : '';
  $accent_colors = [ 'var(--vq-secondary)', 'var(--vq-quarternary)', 'var(--vq-tertiary)', 'var(--vq-quinary)' ];
?>

<div id="vq-blog-page">

  <!-- ===================== PAGE HERO ===================== -->
  <section class="vq-page-hero">
    <div class="vq-page-hero-aurora"></div>
    <div class="vq-page-hero-inner">
      <div class="vq-kicker wow fadeInUp">
        <span style="color:var(--vq-quinary)">&#9656;</span>
        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" style="color:inherit;text-decoration:none">BLOG</a>
        &nbsp;&mdash;&nbsp; Category
      </div>
      <h1 class="vq-page-hero-title wow fadeInUp" data-wow-delay="0.1s">
        <span class="vq-page-hero-brand"><?php echo esc_html( strtoupper( $cat_name ) ); ?></span>
        <?php if ( $cat_desc ) : ?>
          <span class="vq-grad-1"><?php echo esc_html( $cat_desc ); ?></span>
        <?php endif; ?>
      </h1>
      <p class="vq-sub wow fadeInUp" data-wow-delay="0.2s" style="margin-top:20px;max-width:600px">
        Posts filed under <strong><?php echo esc_html( $cat_name ); ?></strong>.
      </p>
      <span class="vq-hud-corner vq-hud-tl">&#9484;</span>
      <span class="vq-hud-corner vq-hud-tr">&#9488;</span>
    </div>
    <div class="vq-page-hero-fade"></div>
  </section>

  <!-- ===================== POSTS GRID ===================== -->
  <section class="vq-section">
    <div class="vq-section-inner">

      <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">

        <div class="cbp-vm-options wow fadeInUp">
          <span class="vq-blog-view-label">View</span>
          <a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid" title="Grid View"></a>
          <a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list" title="List View"></a>
        </div>

        <ul id="octane-blog-list">
          <?php
          $bi = 0;
          if ( have_posts() ) : while ( have_posts() ) : the_post();
            $bi++;
            $accent   = $accent_colors[ ( $bi - 1 ) % 4 ];
            $ex       = get_the_excerpt();
            $ex_short = $ex ? substr( strip_tags( $ex ), 0, 130 ) . '...' : '';
          ?>
          <li class="blog-item-container">
            <article class="article-<?php the_ID(); ?> block-inner">

              <a class="cbp-vm-image" href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ) :
                  the_post_thumbnail( 'medium_large', [ 'alt' => esc_attr( get_the_title() ) ] );
                else : ?>
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/not-blog.png" alt="<?php echo esc_attr( get_the_title() ); ?>">
                <?php endif; ?>
                <div class="vq-blog-img-overlay"></div>
                <div class="vq-blog-num" style="color:<?php echo $accent; ?>">&#9679; <?php echo str_pad( $bi, 2, '0', STR_PAD_LEFT ); ?></div>
              </a>

              <a href="<?php the_permalink(); ?>">
                <h3 class="cbp-vm-title"><?php the_title(); ?></h3>
              </a>

              <div class="cbp-vm-price"><?php the_category( ' &middot; ' ); ?></div>

              <div class="octane-blog-content cbp-vm-details">
                <?php if ( $ex_short ) echo '<p>' . esc_html( $ex_short ) . '</p>'; ?>
              </div>

              <a class="cbp-vm-add" href="<?php the_permalink(); ?>">Read More &rarr;</a>

              <div class="clearfix"></div>
            </article>
          </li>
          <?php endwhile; endif; ?>
        </ul>

      </div><!-- #cbp-vm -->

      <!-- Pagination -->
      <?php
      $big = 999999999;
      echo paginate_links( [
        'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'  => '?paged=%#%',
        'current' => max( 1, get_query_var( 'paged' ) ),
        'total'   => $wp_query->max_num_pages,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
      ] );
      ?>

    </div><!-- .vq-section-inner -->
  </section>

</div><!-- #vq-blog-page -->

<?php get_footer(); ?>
