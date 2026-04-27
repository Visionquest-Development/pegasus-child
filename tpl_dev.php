<?php
/*
    Template Name: Development Template
*/
?>
<?php get_header(); ?>

<div id="vq-dev-page">

  <!-- ===================== PAGE HERO ===================== -->
  <section class="vq-page-hero">
    <div class="vq-page-hero-aurora"></div>
    <div class="vq-page-hero-inner">
      <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [SERVICES] &mdash; Development</div>
      <h1 class="vq-page-hero-title">
        <span class="vq-page-hero-brand">DEVELOPMENT</span>
        <span class="vq-grad-2">Metro Atlanta web &amp; app development.</span>
      </h1>
      <p class="vq-sub" style="margin-top:20px;max-width:640px">From concept to launch &mdash; websites, web apps, e-commerce, and custom software built for your business goals.</p>
      <div class="vq-hero-ctas" style="margin-top:36px">
        <a href="/get-started" class="vq-btn vq-btn--primary">&#9658; Get Started</a>
        <a href="/website-pricing" class="vq-btn">View Pricing</a>
      </div>
      <span class="vq-hud-corner vq-hud-tl">&#9484;</span>
      <span class="vq-hud-corner vq-hud-tr">&#9488;</span>
    </div>
    <div class="vq-page-hero-fade"></div>
  </section>

  <!-- ===================== HOW VISIONQUEST CAN HELP ===================== -->
  <section class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-design-intro">
        <div class="vq-design-intro-text wow fadeInLeft">
          <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [01] &mdash; Our Approach</div>
          <h2 class="vq-h2" style="font-size:38px">How VisionQuest Can Help</h2>
          <p style="font-size:16px;line-height:1.75;color:var(--vq-ink-dim);margin-top:20px">
            Many customers think they can design their own websites, and in some respects that's true. However, having someone with experience in design, content creation, and implementation makes a significant difference in the outcome.
          </p>
          <p style="font-size:16px;line-height:1.75;color:var(--vq-ink-dim);margin-top:16px">
            I pride myself on not just being a web coder &mdash; I take the time to understand your business needs and help you make decisions that enable your website to fulfill the requirements you need to grow. From concept to content, graphics, e-commerce, social media, and SEO, VisionQuest is your metro Atlanta development specialist.
          </p>
        </div>
        <div class="vq-design-intro-img wow fadeInRight">
          <img src="https://visionquestdevelopment.com/wp-content/uploads/2024/09/Hero.png" alt="VisionQuest Development">
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== CAPABILITIES ===================== -->
  <section class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-section-head wow fadeInUp">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [02] &mdash; What We Do</div>
        <h2 class="vq-h2">Full-cycle development capability.</h2>
        <p class="vq-sub">From marketing strategy to deployment &mdash; every layer of the stack covered.</p>
      </div>
      <div class="vq-services-grid">

        <div class="vq-svc wow fadeInUp" data-wow-delay="0.1s" style="--svc-color:var(--vq-quarternary)">
          <div class="vq-svc-inner">
            <?php foreach ( [ 'tl', 'tr', 'bl', 'br' ] as $pos ) : ?>
              <div class="vq-svc-corner vq-svc-corner--<?php echo $pos; ?>" style="background:var(--vq-quarternary)"></div>
            <?php endforeach; ?>
            <div class="vq-svc-top"><span class="vq-font-pixel" style="font-size:10px;color:var(--vq-quarternary);letter-spacing:.1em">01</span></div>
            <h3 class="vq-svc-name">Marketing &amp; Goals</h3>
            <p class="vq-svc-desc">We help expand your reach through SEO, Google Ads, and content strategy. We track site metrics &mdash; visitors, sources, session duration &mdash; so every decision is grounded in data. You keep the source files and receive training to manage it yourself.</p>
            <div class="vq-svc-tags">
              <span class="vq-tag">SEO</span>
              <span class="vq-tag">Google Ads</span>
              <span class="vq-tag">Analytics</span>
            </div>
          </div>
        </div>

        <div class="vq-svc wow fadeInUp" data-wow-delay="0.2s" style="--svc-color:var(--vq-tertiary)">
          <div class="vq-svc-inner">
            <?php foreach ( [ 'tl', 'tr', 'bl', 'br' ] as $pos ) : ?>
              <div class="vq-svc-corner vq-svc-corner--<?php echo $pos; ?>" style="background:var(--vq-tertiary)"></div>
            <?php endforeach; ?>
            <div class="vq-svc-top"><span class="vq-font-pixel" style="font-size:10px;color:var(--vq-tertiary);letter-spacing:.1em">02</span></div>
            <h3 class="vq-svc-name">Content &amp; Creative</h3>
            <p class="vq-svc-desc">Content is the lifeblood of a website. We help source or create articles, photos, and video. We have relationships with photographers and can set up, retouch, and post for your gallery. Tell us your vision &mdash; blog, forum, photo gallery &mdash; and we'll build it.</p>
            <div class="vq-svc-tags">
              <span class="vq-tag">Copywriting</span>
              <span class="vq-tag">Photography</span>
              <span class="vq-tag">Video</span>
            </div>
          </div>
        </div>

        <div class="vq-svc wow fadeInUp" data-wow-delay="0.3s" style="--svc-color:var(--vq-secondary)">
          <div class="vq-svc-inner">
            <?php foreach ( [ 'tl', 'tr', 'bl', 'br' ] as $pos ) : ?>
              <div class="vq-svc-corner vq-svc-corner--<?php echo $pos; ?>" style="background:var(--vq-secondary)"></div>
            <?php endforeach; ?>
            <div class="vq-svc-top"><span class="vq-font-pixel" style="font-size:10px;color:var(--vq-secondary);letter-spacing:.1em">03</span></div>
            <h3 class="vq-svc-name">Implementation &amp; Code</h3>
            <p class="vq-svc-desc">Domain, hosting, WordPress setup, theme installation, and custom code. We work inside the WordPress dashboard when possible and write custom HTML, PHP, and JavaScript when it's not. We also develop iOS and Android apps to push content directly to your customers.</p>
            <div class="vq-svc-tags">
              <span class="vq-tag">WordPress</span>
              <span class="vq-tag">PHP</span>
              <span class="vq-tag">Mobile Apps</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ===================== WEBSITE PRICING ===================== -->
  <section class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-section-head wow fadeInUp">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [03] &mdash; Website Pricing</div>
        <h2 class="vq-h2">Transparent pricing. Five tiers.</h2>
        <p class="vq-sub">Hourly rate $100/hr. Every website comes with training and all source files.</p>
      </div>
      <div class="vq-pricing-grid">
        <?php
        $tiers = [
            [ 'I',   '$500',   'Economy',  'Up to 5 WP Pages',  'Up to 5 hrs',  [ 'Blog', 'Gallery' ],                                              'var(--vq-ink-faint)'  ],
            [ 'II',  '$700',   'Small',    'Up to 10 WP Pages', 'Up to 10 hrs', [ 'SEO', 'Blog', 'Gallery' ],                                       'var(--vq-secondary)'  ],
            [ 'III', '$1,250', 'Medium',   'Up to 15 WP Pages', 'Up to 20 hrs', [ 'Social Media', 'SEO', 'Mobile', 'Blog', 'Gallery', 'Forum' ],    'var(--vq-tertiary)'   ],
            [ 'IV',  '$2,500', 'Large',    'Up to 20 WP Pages', 'Up to 40 hrs', [ 'Social Media', 'SEO', 'Mobile', 'Blog', 'Gallery', 'Forum' ],    'var(--vq-quarternary)'],
            [ 'V',   '$3,500', 'Ultimate', 'Up to 30 WP Pages', 'Up to 60 hrs', [ 'Social Media', 'SEO', 'Mobile', 'Blog', 'Gallery', 'Forum', 'Shopping' ], 'var(--vq-quinary)' ],
        ];
        $ti = 0;
        foreach ( $tiers as [ $level, $price, $label, $pages, $hours, $addons, $color ] ) :
            $tdelay = number_format( $ti * 0.1, 1 ) . 's';
        ?>
        <div class="vq-pricing-card wow fadeInUp" data-wow-delay="<?php echo $tdelay; ?>" style="--tier-color:<?php echo $color; ?>">
          <div class="vq-pricing-card-top">
            <span class="vq-font-pixel" style="font-size:9px;color:<?php echo $color; ?>;letter-spacing:.1em">LEVEL <?php echo $level; ?></span>
            <div class="vq-pricing-price"><?php echo $price; ?></div>
            <div class="vq-pricing-label"><?php echo $label; ?> Website</div>
          </div>
          <div class="vq-pricing-card-body">
            <div class="vq-pricing-stat">
              <span class="vq-font-mono" style="font-size:11px;color:var(--vq-ink-faint);text-transform:uppercase;letter-spacing:.1em">Pages</span>
              <span style="font-size:14px;color:var(--vq-ink)"><?php echo $pages; ?></span>
            </div>
            <div class="vq-pricing-stat">
              <span class="vq-font-mono" style="font-size:11px;color:var(--vq-ink-faint);text-transform:uppercase;letter-spacing:.1em">Hours</span>
              <span style="font-size:14px;color:var(--vq-ink)"><?php echo $hours; ?></span>
            </div>
            <div class="vq-pricing-addons">
              <?php foreach ( $addons as $addon ) echo '<span class="vq-tag">' . esc_html( $addon ) . '</span>'; ?>
            </div>
          </div>
          <a href="/get-started" class="vq-pricing-cta" style="border-top-color:<?php echo $color; ?>">Get Started &#8594;</a>
        </div>
        <?php $ti++; endforeach; ?>
      </div>
      <p class="vq-outsource-note" style="margin-top:32px">
        * All websites include training and all source files delivered via zip or cloud storage.
      </p>
    </div>
  </section>

  <!-- ===================== RETAINER AGREEMENTS ===================== -->
  <section class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-section-head wow fadeInUp">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [04] &mdash; Retainer Agreements</div>
        <h2 class="vq-h2">Maintenance &amp; ongoing support.</h2>
        <p class="vq-sub">Monthly plans that keep your site secure, updated, and running. Cancel any time.</p>
      </div>
      <div class="vq-retainer-grid">
        <?php
        $plans = [
            [
                'Level 1', '$200', '/mo',
                'var(--vq-tertiary)', false,
                [
                    [ true,  '1 Domain managed' ],
                    [ true,  'Plugin &amp; Theme updates' ],
                    [ true,  '10 pages included' ],
                    [ true,  'Semantic HTML for SEO' ],
                    [ false, 'Custom theme updates' ],
                    [ false, 'Security hardening' ],
                    [ false, 'Additional backups' ],
                ],
            ],
            [
                'Level 2', '$400', '/mo',
                'var(--vq-quarternary)', true,
                [
                    [ true,  'Up to 3 Domains managed' ],
                    [ true,  'Plugin &amp; Theme updates' ],
                    [ true,  '20 pages included' ],
                    [ true,  'Semantic HTML for SEO' ],
                    [ true,  'Custom theme updates' ],
                    [ false, 'Security hardening' ],
                    [ false, 'Additional backups' ],
                ],
            ],
            [
                'Level 3', '$800', '/mo',
                'var(--vq-quinary)', false,
                [
                    [ true, 'Up to 10 Domains managed' ],
                    [ true, 'Plugin &amp; Theme updates' ],
                    [ true, '30 pages included' ],
                    [ true, 'Semantic HTML for SEO' ],
                    [ true, 'Custom theme updates' ],
                    [ true, 'Security hardening' ],
                    [ true, 'Additional backups' ],
                ],
            ],
        ];
        $ri = 0;
        foreach ( $plans as [ $name, $price, $period, $color, $featured, $features ] ) :
            $feat_class = $featured ? ' vq-retainer-card--featured' : '';
            $rdelay     = number_format( $ri * 0.15, 2 ) . 's';
        ?>
        <div class="vq-retainer-card<?php echo $feat_class; ?> wow fadeInUp" data-wow-delay="<?php echo $rdelay; ?>" style="--plan-color:<?php echo $color; ?>">
          <?php if ( $featured ) : ?>
            <div class="vq-retainer-badge">&#9733; Most Popular</div>
          <?php endif; ?>
          <div class="vq-retainer-top">
            <div class="vq-font-pixel" style="font-size:9px;color:<?php echo $color; ?>;letter-spacing:.12em;margin-bottom:16px"><?php echo $name; ?></div>
            <div class="vq-retainer-price">
              <span class="vq-retainer-amount"><?php echo $price; ?></span>
              <span class="vq-retainer-period"><?php echo $period; ?></span>
            </div>
          </div>
          <ul class="vq-retainer-list">
            <?php foreach ( $features as [ $included, $text ] ) : ?>
            <li class="vq-retainer-item<?php echo $included ? '' : ' vq-retainer-item--off'; ?>">
              <span class="vq-retainer-check" style="color:<?php echo $included ? $color : 'var(--vq-ink-faint)'; ?>"><?php echo $included ? '&#10003;' : '&#10007;'; ?></span>
              <?php echo $text; ?>
            </li>
            <?php endforeach; ?>
          </ul>
          <a href="/contact" class="vq-btn<?php echo $featured ? ' vq-btn--primary' : ''; ?>" style="width:100%;text-align:center;display:block;font-size:9px">Sign Up &#9658;</a>
        </div>
        <?php $ri++; endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ===================== CTA ===================== -->
  <section class="vq-cta-wrap">
    <div class="vq-cta-inner wow fadeInUp">
      <div class="vq-font-pixel" style="font-size:12px;color:var(--vq-quinary);letter-spacing:.1em;margin-bottom:24px">&#9658; PRESS START</div>
      <h2 class="vq-cta-title">
        Ready to build<br>
        <span class="vq-grad-3">something great?</span>
      </h2>
      <p style="font-size:17px;color:var(--vq-ink-dim);max-width:560px;margin:0 auto 36px;line-height:1.6">
        Book a 30-minute discovery call. We'll scope your project, give you an honest quote, and you decide where to go from there.
      </p>
      <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
        <a href="/get-started" class="vq-btn vq-btn--primary">&#9658; Get started</a>
        <a href="/contact" class="vq-btn">Contact us</a>
      </div>
    </div>
  </section>

</div><!-- #vq-dev-page -->

<?php get_footer(); ?>
