<?php
/*
    Template Name: Portfolio Template
*/
?>
<?php get_header(); ?>

<div id="vq-portfolio-page">

  <!-- ===================== PAGE HERO ===================== -->
  <section class="vq-page-hero">
    <div class="vq-page-hero-aurora"></div>
    <div class="vq-page-hero-inner">
      <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [03] &mdash; Recent Work</div>
      <h1 class="vq-page-hero-title">
        <span class="vq-page-hero-brand">PORTFOLIO</span>
        <span class="vq-grad-1">Work we've shipped.</span>
      </h1>
      <p class="vq-sub" style="margin-top:20px;max-width:640px">A slice of what we've built for clients across Atlanta and beyond &mdash; use the controls drawer to filter by category or technology.</p>
      <span class="vq-hud-corner vq-hud-tl">&#9484;</span>
      <span class="vq-hud-corner vq-hud-tr">&#9488;</span>
    </div>
    <div class="vq-page-hero-fade"></div>
  </section>

  <!-- ===================== PORTFOLIO GRID ===================== -->
  <section class="vq-port-section">
    <div id="top">

      <div id="Container" class="mix-container">
        <div class="fail-message"><span>No items matched the selected filters.</span></div>

        <div class="vq-port-grid">
          <?php
          $loop = new WP_Query( [
              'post_type'      => 'portfolio',
              'posts_per_page' => -1,
              'orderby'        => 'date',
              'order'          => 'DESC',
          ] );

          $count = 1;

          if ( $loop->have_posts() ) :
              while ( $loop->have_posts() ) : $loop->the_post();

                  $terms  = get_the_terms( $post->ID, 'portcats' );
                  $terms2 = get_the_terms( $post->ID, 'feattag' );

                  $slug_cats = [];
                  if ( is_array( $terms ) ) {
                      foreach ( $terms as $t ) $slug_cats[] = $t->slug;
                  }
                  $slug_techs = [];
                  if ( is_array( $terms2 ) ) {
                      foreach ( $terms2 as $t ) $slug_techs[] = $t->slug;
                  }

                  $filter_classes = implode( ' ', array_merge( $slug_cats, $slug_techs ) );
                  $the_alt_img    = get_post_meta( get_the_ID(), 'alternate_image', true );
                  $the_url        = get_post_meta( get_the_ID(), '_url', true );
                  $alt_url        = get_post_meta( get_the_ID(), 'url', true );
                  $live_url       = $the_url ?: $alt_url;

                  $excerpt = get_the_excerpt();
                  $excerpt_short = $excerpt ? substr( strip_tags( $excerpt ), 0, 120 ) . '...' : '';

                  $accent_colors = [ 'var(--vq-secondary)', 'var(--vq-quarternary)', 'var(--vq-tertiary)', 'var(--vq-quinary)' ];
                  $accent = $accent_colors[ ( $count - 1 ) % 4 ];
          ?>
          <div class="mix vq-port-item all <?php echo esc_attr( $filter_classes ); ?>" data-custom-order="<?php echo $count; ?>">
            <article class="vq-port-card">

              <!-- Image -->
              <a href="<?php the_permalink(); ?>" class="vq-port-img-wrap">
                <?php if ( $the_alt_img ) : ?>
                  <img src="<?php echo esc_url( $the_alt_img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                <?php elseif ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail( 'medium_large', [ 'alt' => get_the_title() ] ); ?>
                <?php else : ?>
                  <div class="vq-port-placeholder ph">
                    <span><?php echo esc_html( strtoupper( str_replace( ' ', '_', get_the_title() ) ) ); ?>.png</span>
                  </div>
                <?php endif; ?>
                <div class="vq-port-overlay">
                  <span class="vq-port-view">View Project &#8594;</span>
                </div>
                <div class="vq-port-num" style="color:<?php echo $accent; ?>">&#9679; <?php echo str_pad( $count, 2, '0', STR_PAD_LEFT ); ?></div>
              </a>

              <!-- Body -->
              <div class="vq-port-body">
                <div class="vq-port-header">
                  <h3 class="vq-port-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h3>
                  <?php if ( $live_url ) : ?>
                    <a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener" class="vq-port-ext" title="Live Preview">
                      <i class="fa fa-arrow-up-right-from-square"></i>
                    </a>
                  <?php endif; ?>
                </div>

                <?php if ( is_array( $terms ) && count( $terms ) ) : ?>
                <div class="vq-port-cat" style="color:<?php echo $accent; ?>">
                  <?php echo esc_html( implode( ' · ', array_map( fn($t) => $t->name, $terms ) ) ); ?>
                </div>
                <?php endif; ?>

                <?php if ( $excerpt_short ) : ?>
                  <p class="vq-port-excerpt"><?php echo esc_html( $excerpt_short ); ?></p>
                <?php endif; ?>

                <?php if ( is_array( $terms2 ) && count( $terms2 ) ) : ?>
                <div class="vq-port-tags">
                  <?php foreach ( $terms2 as $t2 ) echo '<span class="vq-tag">' . esc_html( $t2->name ) . '</span>'; ?>
                </div>
                <?php endif; ?>

                <div class="vq-port-actions">
                  <a href="<?php the_permalink(); ?>" class="vq-port-link">Read More &#8594;</a>
                  <?php if ( $live_url ) : ?>
                    <a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener" class="vq-port-link vq-port-link--ext">&#8599; Live Preview</a>
                  <?php endif; ?>
                </div>
              </div>

            </article>
          </div>
          <?php
              $count++;
              endwhile;
          else :
              echo '<p class="vq-port-empty">No portfolio entries found.</p>';
          endif;
          wp_reset_postdata();
          ?>
        </div><!-- .vq-port-grid -->
      </div><!-- #Container -->

      <!-- Tool Drawer -->
      <div class="avia_styleswitcher display_switch">
        <div class="ie6fix openclose openclosedisplay_switch">
          <span></span>
        </div>
        <div class="avia_styleswitch_form">

          <h4 class="mt-3">Sort</h4>
          <button class="sort" data-sort="custom-order:asc">ASC</button>
          <button class="sort" data-sort="custom-order:desc">DESC</button>
          <button class="sort" data-sort="random">
            <div class="pinwheel-container">
              <div class="pinwheel">
                <div class="pin color-1"></div>
                <div class="pin color-2"></div>
                <div class="pin color-3"></div>
                <div class="pin color-4"></div>
                <div class="pin color-5"></div>
                <div class="pin color-6"></div>
                <span></span>
              </div>
            </div>
          </button>

          <h4>Filter</h4>
          <form class="controls" id="Filters">
            <fieldset>
              <h4>Categories</h4>
              <?php
              $tax_terms = get_terms( 'portcats' );
              if ( $tax_terms ) {
                  echo '<div class="checkbox"><input type="checkbox" value=".all"><label>All</label></div>';
                  foreach ( $tax_terms as $term ) {
                      $slug = strtolower( str_replace( ' ', '-', $term->name ) );
                      echo '<div class="checkbox"><input type="checkbox" value=".' . esc_attr( $slug ) . '"><label>' . esc_html( $term->name ) . '</label></div>';
                  }
              }
              ?>
            </fieldset>
            <fieldset>
              <h4>Technology</h4>
              <?php
              $tax_terms2 = get_terms( 'feattag' );
              if ( $tax_terms2 ) {
                  echo '<div class="checkbox"><input type="checkbox" value=".all"><label>All</label></div>';
                  foreach ( $tax_terms2 as $term ) {
                      $slug = strtolower( str_replace( ' ', '-', $term->name ) );
                      echo '<div class="checkbox"><input type="checkbox" value=".' . esc_attr( $slug ) . '"><label>' . esc_html( $term->name ) . '</label></div>';
                  }
              }
              ?>
            </fieldset>
          </form>

          <button class="multimix-button" id="Reset">Clear Filters</button>

        </div><!-- .avia_styleswitch_form -->
        <div id="drawer-text"><span>Controls</span></div>
      </div><!-- .avia_styleswitcher -->

    </div><!-- #top -->
  </section>

</div><!-- #vq-portfolio-page -->

<?php get_footer(); ?>
