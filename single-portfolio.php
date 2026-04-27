<?php get_header(); ?>

<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();

    $post_id     = get_the_ID();
    $terms       = get_the_terms( $post_id, 'portcats' );
    $terms2      = get_the_terms( $post_id, 'feattag' );
    $the_alt_img = get_post_meta( $post_id, 'alternate_image', true );
    $the_url     = get_post_meta( $post_id, '_url', true );
    $alt_url     = get_post_meta( $post_id, 'url', true );
    $live_url    = $the_url ?: $alt_url;
    $thumb_url   = $the_alt_img ?: get_the_post_thumbnail_url( $post_id, 'full' );
    $excerpt     = get_the_excerpt();
    $cat_name    = ( is_array( $terms ) && count( $terms ) ) ? $terms[0]->name : 'Project';
?>

<div id="vq-single-port">

  <!-- ===================== PAGE HERO ===================== -->
  <section class="vq-page-hero">
    <div class="vq-page-hero-aurora"></div>
    <div class="vq-page-hero-inner">
      <div class="vq-kicker">
        <span style="color:var(--vq-quinary)">&#9656;</span>
        <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" style="color:inherit;text-decoration:none">PORTFOLIO</a>
        &nbsp;&mdash;&nbsp;<?php echo esc_html( $cat_name ); ?>
      </div>
      <h1 class="vq-page-hero-title">
        <span class="vq-page-hero-brand"><?php the_title(); ?></span>
      </h1>
      <?php if ( $excerpt ) : ?>
        <p class="vq-sub" style="margin-top:20px;max-width:640px"><?php echo esc_html( substr( strip_tags( $excerpt ), 0, 160 ) ); ?></p>
      <?php endif; ?>
      <div class="vq-hero-ctas" style="margin-top:36px">
        <?php if ( $live_url ) : ?>
          <a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener" class="vq-btn vq-btn--primary">&#8599; View Live Site</a>
        <?php endif; ?>
        <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="vq-btn">&#8592; Back to Portfolio</a>
      </div>
      <span class="vq-hud-corner vq-hud-tl">&#9484;</span>
      <span class="vq-hud-corner vq-hud-tr">&#9488;</span>
    </div>
    <div class="vq-page-hero-fade"></div>
  </section>

  <!-- ===================== PROJECT DETAILS ===================== -->
  <section class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-single-port-grid">

        <!-- Image -->
        <div class="vq-single-port-img wow fadeInLeft">
          <?php if ( $thumb_url ) : ?>
            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
          <?php else : ?>
            <div class="vq-port-placeholder ph">
              <span><?php echo esc_html( strtoupper( str_replace( ' ', '_', get_the_title() ) ) ); ?>.png</span>
            </div>
          <?php endif; ?>
        </div>

        <!-- Meta sidebar -->
        <div class="vq-single-port-meta wow fadeInRight">

          <div class="vq-kicker" style="margin-bottom:24px">
            <span style="color:var(--vq-quinary)">&#9656;</span> Project Details
          </div>

          <h2 class="vq-single-port-title"><?php the_title(); ?></h2>

          <?php if ( is_array( $terms ) && count( $terms ) ) : ?>
          <div class="vq-single-port-section">
            <div class="vq-single-port-label">Category</div>
            <div class="vq-single-port-value">
              <?php foreach ( $terms as $t ) echo '<span class="vq-tag" style="color:var(--vq-quarternary);border-color:var(--vq-quarternary)">' . esc_html( $t->name ) . '</span> '; ?>
            </div>
          </div>
          <?php endif; ?>

          <?php if ( is_array( $terms2 ) && count( $terms2 ) ) : ?>
          <div class="vq-single-port-section">
            <div class="vq-single-port-label">Technology</div>
            <div class="vq-port-tags" style="margin-top:4px">
              <?php foreach ( $terms2 as $t2 ) echo '<span class="vq-tag">' . esc_html( $t2->name ) . '</span>'; ?>
            </div>
          </div>
          <?php endif; ?>

          <?php if ( $live_url ) : ?>
          <div class="vq-single-port-section">
            <div class="vq-single-port-label">Live URL</div>
            <div class="vq-single-port-value">
              <a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener" class="vq-single-port-link">
                <?php echo esc_html( preg_replace( '#^https?://#', '', rtrim( $live_url, '/' ) ) ); ?> &#8599;
              </a>
            </div>
          </div>
          <?php endif; ?>

          <div class="vq-single-port-actions">
            <?php if ( $live_url ) : ?>
              <a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener" class="vq-btn vq-btn--primary" style="font-size:9px">&#8599; View Live Site</a>
            <?php endif; ?>
            <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="vq-btn" style="font-size:9px">&#8592; All Work</a>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- ===================== FULL CONTENT ===================== -->
  <?php if ( get_the_content() ) : ?>
  <section class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-single-port-content wow fadeInUp">
        <?php the_content(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===================== PREV / NEXT ===================== -->
  <?php
  $prev_post = get_previous_post();
  $next_post = get_next_post();
  if ( $prev_post || $next_post ) :
  ?>
  <section class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-port-nav wow fadeInUp">

        <?php if ( $prev_post ) :
          $prev_thumb = get_the_post_thumbnail_url( $prev_post->ID, 'thumbnail' );
        ?>
        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="vq-port-nav-item vq-port-nav-item--prev">
          <span class="vq-port-nav-arrow">&#8592;</span>
          <div class="vq-port-nav-info">
            <span class="vq-port-nav-label">Previous</span>
            <span class="vq-port-nav-title"><?php echo esc_html( $prev_post->post_title ); ?></span>
          </div>
          <?php if ( $prev_thumb ) : ?>
            <img src="<?php echo esc_url( $prev_thumb ); ?>" alt="<?php echo esc_attr( $prev_post->post_title ); ?>" class="vq-port-nav-thumb">
          <?php endif; ?>
        </a>
        <?php else : ?>
          <div></div>
        <?php endif; ?>

        <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="vq-port-nav-all">
          <span class="vq-font-pixel" style="font-size:10px">&#9635;</span>
          <span>All Work</span>
        </a>

        <?php if ( $next_post ) :
          $next_thumb = get_the_post_thumbnail_url( $next_post->ID, 'thumbnail' );
        ?>
        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="vq-port-nav-item vq-port-nav-item--next">
          <?php if ( $next_thumb ) : ?>
            <img src="<?php echo esc_url( $next_thumb ); ?>" alt="<?php echo esc_attr( $next_post->post_title ); ?>" class="vq-port-nav-thumb">
          <?php endif; ?>
          <div class="vq-port-nav-info vq-port-nav-info--right">
            <span class="vq-port-nav-label">Next</span>
            <span class="vq-port-nav-title"><?php echo esc_html( $next_post->post_title ); ?></span>
          </div>
          <span class="vq-port-nav-arrow">&#8594;</span>
        </a>
        <?php else : ?>
          <div></div>
        <?php endif; ?>

      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===================== CTA ===================== -->
  <section class="vq-cta-wrap">
    <div class="vq-cta-inner wow fadeInUp">
      <div class="vq-font-pixel" style="font-size:12px;color:var(--vq-quinary);letter-spacing:.1em;margin-bottom:24px">&#9658; START YOUR PROJECT</div>
      <h2 class="vq-cta-title">
        Like what you see?<br>
        <span class="vq-grad-3">Let&rsquo;s build yours.</span>
      </h2>
      <p style="font-size:17px;color:var(--vq-ink-dim);max-width:560px;margin:0 auto 36px;line-height:1.6">
        Book a 30-minute discovery call. We&rsquo;ll scope your project, give you an honest quote, and you decide where to go from there.
      </p>
      <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
        <a href="/get-started" class="vq-btn vq-btn--primary">&#9658; Get started</a>
        <a href="/contact" class="vq-btn">Contact us</a>
      </div>
    </div>
  </section>

</div><!-- #vq-single-port -->

<?php
    endwhile;
endif;
?>

<?php get_footer(); ?>
