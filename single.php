<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

  $post_id      = get_the_ID();
  $thumb_url    = get_the_post_thumbnail_url( $post_id, 'full' );
  $cats         = get_the_category();
  $cat_name     = ! empty( $cats ) ? $cats[0]->name : 'Blog';
  $cat_link     = ! empty( $cats ) ? get_category_link( $cats[0]->term_id ) : home_url( '/blog/' );
  $author       = get_the_author();
  $date         = get_the_date( 'M j, Y' );
  $tags         = get_the_tags();
  $word_count   = str_word_count( strip_tags( get_the_content() ) );
  $read_time    = max( 1, ceil( $word_count / 200 ) );
  $prev_post    = get_previous_post();
  $next_post    = get_next_post();

?>

<div id="vq-single-blog">

  <!-- ===================== PAGE HERO ===================== -->
  <section class="vq-page-hero <?php echo $thumb_url ? 'vq-single-blog-hero--has-img' : ''; ?>"
    <?php if ( $thumb_url ) : ?>style="--blog-hero-img:url('<?php echo esc_url( $thumb_url ); ?>')"<?php endif; ?>>
    <div class="vq-page-hero-aurora"></div>
    <?php if ( $thumb_url ) : ?>
      <div class="vq-single-blog-hero-img" style="background-image:url('<?php echo esc_url( $thumb_url ); ?>')"></div>
    <?php endif; ?>
    <div class="vq-page-hero-inner vq-single-blog-hero-inner">
      <div class="vq-kicker wow fadeInUp">
        <span style="color:var(--vq-quinary)">&#9656;</span>
        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" style="color:inherit;text-decoration:none">BLOG</a>
        &nbsp;&mdash;&nbsp;<a href="<?php echo esc_url( $cat_link ); ?>" style="color:inherit;text-decoration:none"><?php echo esc_html( $cat_name ); ?></a>
      </div>
      <h1 class="vq-page-hero-title vq-single-blog-title wow fadeInUp" data-wow-delay="0.1s">
        <?php the_title(); ?>
      </h1>
      <div class="vq-single-blog-meta-row wow fadeInUp" data-wow-delay="0.2s">
        <span class="vq-single-blog-meta-item"><i class="fa fa-user"></i> <?php echo esc_html( $author ); ?></span>
        <span class="vq-single-blog-meta-sep">&#183;</span>
        <span class="vq-single-blog-meta-item"><i class="fa fa-calendar"></i> <?php echo esc_html( $date ); ?></span>
        <span class="vq-single-blog-meta-sep">&#183;</span>
        <span class="vq-single-blog-meta-item"><i class="fa fa-clock-o"></i> <?php echo $read_time; ?> min read</span>
      </div>
      <div class="vq-hero-ctas wow fadeInUp" data-wow-delay="0.3s" style="margin-top:28px">
        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="vq-btn">&#8592; Back to Blog</a>
      </div>
      <span class="vq-hud-corner vq-hud-tl">&#9484;</span>
      <span class="vq-hud-corner vq-hud-tr">&#9488;</span>
    </div>
    <div class="vq-page-hero-fade"></div>
  </section>

  <!-- ===================== ARTICLE ===================== -->
  <section class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-single-blog-body">

        <article class="vq-single-blog-content wow fadeInUp">
          <?php the_content(); ?>
        </article>

        <!-- Tags -->
        <?php if ( $tags ) : ?>
        <div class="vq-single-blog-tags wow fadeInUp">
          <span class="vq-single-blog-tags-label">&#9656; Tags</span>
          <?php foreach ( $tags as $tag ) : ?>
            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="vq-tag"><?php echo esc_html( $tag->name ); ?></a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Categories footer -->
        <div class="vq-single-blog-cats wow fadeInUp">
          <span class="vq-single-blog-tags-label">&#9656; Filed under</span>
          <?php foreach ( $cats as $cat ) : ?>
            <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="vq-tag" style="color:var(--vq-quarternary);border-color:var(--vq-quarternary)"><?php echo esc_html( $cat->name ); ?></a>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </section>

  <!-- ===================== PREV / NEXT ===================== -->
  <?php if ( $prev_post || $next_post ) : ?>
  <section class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-blog-nav wow fadeInUp">

        <?php if ( $prev_post ) :
          $prev_thumb = get_the_post_thumbnail_url( $prev_post->ID, 'thumbnail' );
        ?>
        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="vq-blog-nav-item vq-blog-nav-item--prev">
          <span class="vq-blog-nav-arrow">&#8592;</span>
          <div class="vq-blog-nav-info">
            <span class="vq-blog-nav-label">Previous Post</span>
            <span class="vq-blog-nav-title"><?php echo esc_html( $prev_post->post_title ); ?></span>
          </div>
          <?php if ( $prev_thumb ) : ?>
            <img src="<?php echo esc_url( $prev_thumb ); ?>" alt="" class="vq-blog-nav-thumb">
          <?php endif; ?>
        </a>
        <?php else : ?>
          <div></div>
        <?php endif; ?>

        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="vq-blog-nav-all" title="All Posts">
          <span class="vq-font-pixel" style="font-size:10px">&#9635;</span>
          <span>All Posts</span>
        </a>

        <?php if ( $next_post ) :
          $next_thumb = get_the_post_thumbnail_url( $next_post->ID, 'thumbnail' );
        ?>
        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="vq-blog-nav-item vq-blog-nav-item--next">
          <?php if ( $next_thumb ) : ?>
            <img src="<?php echo esc_url( $next_thumb ); ?>" alt="" class="vq-blog-nav-thumb">
          <?php endif; ?>
          <div class="vq-blog-nav-info vq-blog-nav-info--right">
            <span class="vq-blog-nav-label">Next Post</span>
            <span class="vq-blog-nav-title"><?php echo esc_html( $next_post->post_title ); ?></span>
          </div>
          <span class="vq-blog-nav-arrow">&#8594;</span>
        </a>
        <?php else : ?>
          <div></div>
        <?php endif; ?>

      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===================== COMMENTS ===================== -->
  <?php if ( comments_open() || get_comments_number() ) : ?>
  <section class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-blog-comments">
        <?php comments_template(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===================== CTA ===================== -->
  <section class="vq-cta-wrap">
    <div class="vq-cta-inner wow fadeInUp">
      <div class="vq-font-pixel" style="font-size:12px;color:var(--vq-quinary);letter-spacing:.1em;margin-bottom:24px">&#9658; READY TO BUILD?</div>
      <h2 class="vq-cta-title">
        Need something built?<br>
        <span class="vq-grad-2">Let&rsquo;s talk.</span>
      </h2>
      <p style="font-size:17px;color:var(--vq-ink-dim);max-width:540px;margin:0 auto 36px;line-height:1.6">
        From quick fixes to full platforms &mdash; we scope it, quote it, and ship it.
      </p>
      <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
        <a href="/get-started" class="vq-btn vq-btn--primary">&#9658; Get Started</a>
        <a href="/contact" class="vq-btn">Contact Us</a>
      </div>
    </div>
  </section>

</div><!-- #vq-single-blog -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>
