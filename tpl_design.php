<?php
/*
    Template Name: Design Template
*/
?>
<?php get_header(); ?>

<div id="vq-design-page">

  <!-- ===================== PAGE HERO ===================== -->
  <section class="vq-page-hero">
    <div class="vq-page-hero-aurora"></div>
    <div class="vq-page-hero-inner">
      <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [SERVICES] &mdash; Design</div>
      <h1 class="vq-page-hero-title">
        <span class="vq-page-hero-brand">DESIGN</span>
        <span class="vq-grad-1">Elevating your brand.</span>
      </h1>
      <p class="vq-sub" style="margin-top:20px;max-width:640px">UI &amp; UX design, prototyping, and brand strategy &mdash; built for your customers, not just your stakeholders.</p>
      <div class="vq-hero-ctas" style="margin-top:36px">
        <a href="/get-started" class="vq-btn vq-btn--primary">&#9658; Get Started</a>
        <a href="/contact" class="vq-btn">Contact Us</a>
      </div>
      <span class="vq-hud-corner vq-hud-tl">&#9484;</span>
      <span class="vq-hud-corner vq-hud-tr">&#9488;</span>
    </div>
    <div class="vq-page-hero-fade"></div>
  </section>

  <!-- ===================== UI / UX INTRO ===================== -->
  <section class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-design-intro">
        <div class="vq-design-intro-img">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Design1.png" alt="UI/UX Design">
        </div>
        <div class="vq-design-intro-text">
          <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [01] &mdash; UI &amp; UX</div>
          <h2 class="vq-h2" style="font-size:38px">How VisionQuest Elevates Your Design Experience</h2>
          <p style="font-size:16px;line-height:1.75;color:var(--vq-ink-dim);margin-top:20px">
            At VisionQuest, we understand the critical role that both UI (User Interface) and UX (User Experience) play in the success of your website.
            We focus on creating designs that not only look great but are intuitive and user-friendly, ensuring your visitors have a seamless experience.
          </p>
          <p style="font-size:16px;line-height:1.75;color:var(--vq-ink-dim);margin-top:16px">
            Since your website is built for your customers, every aspect &mdash; from navigation to content presentation &mdash; is tailored to their needs.
            We provide expert guidance on optimizing usability, like suggesting accordion-style functionality for FAQ pages on mobile to boost engagement.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== SCOPE: OUTSOURCE VS BUILD ===================== -->
  <section class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-section-head">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [02] &mdash; Our Scope</div>
        <h2 class="vq-h2">What we handle vs. outsource</h2>
        <p class="vq-sub">We're developers first. Here's how we split design work and who owns what.</p>
      </div>
      <div class="vq-outsource-grid">
        <div class="vq-outsource-card">
          <div class="vq-outsource-label" style="color:var(--vq-tertiary)">
            <span class="vq-font-pixel" style="font-size:9px">&#9671;</span> We Outsource
          </div>
          <ul class="vq-outsource-list">
            <li>Typography &amp; type selection</li>
            <li>Color scheme creation</li>
            <li>Logo design &amp; brand identity</li>
            <li>Marketing &amp; print collateral</li>
            <li>Style guides &amp; brand books</li>
          </ul>
        </div>
        <div class="vq-outsource-card vq-outsource-card--highlight">
          <div class="vq-outsource-label" style="color:var(--vq-quinary)">
            <span class="vq-font-pixel" style="font-size:9px">&#9671;</span> We Build
          </div>
          <ul class="vq-outsource-list">
            <li>Technical implementation</li>
            <li>Theme customization to match your brand</li>
            <li>E-commerce &amp; payment integration</li>
            <li>Complex back-end functionality</li>
            <li>Responsive, accessible code</li>
          </ul>
        </div>
      </div>
      <p class="vq-outsource-note">
        In design, it takes effort and creativity to create flow and feel. VisionQuest has the resources to find great designers and the relationships to outsource
        effectively &mdash; so you get an aesthetically pleasing result without managing multiple vendors.
      </p>
    </div>
  </section>

  <!-- ===================== THREE METHODS ===================== -->
  <section class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-section-head">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [03] &mdash; Design Methods</div>
        <h2 class="vq-h2">Three ways to get it done.</h2>
        <p class="vq-sub">Every budget. Every complexity level. Pick the track that fits your project.</p>
      </div>
      <div class="vq-services-grid">
        <?php
        $methods = [
            [
                '01', 'Tight Budget Quick Fix',
                'If you\'re looking for a simple, informational website, basing the design on a theme or template reduces costs significantly — a custom designer may not be necessary, allowing us to negotiate a more budget-friendly price.',
                [ 'Theme-based', 'Template', 'Fast turnaround' ],
                'var(--vq-quarternary)',
            ],
            [
                '02', 'Outsource to Your Designer',
                'If you decide to work with your own designer to create a mockup, we handle the development once the design is finalized. VisionQuest is available for consultation to estimate outsourcing costs and refer trusted design contacts.',
                [ 'PSD to WP', 'Figma', 'Your designer' ],
                'var(--vq-tertiary)',
            ],
            [
                '03', 'Custom Build',
                'For eCommerce and custom WordPress websites with advanced functionality, a designer mock-up phase is essential. We recommend at least two rounds of revisions to ensure you\'re fully satisfied before the build begins.',
                [ 'E-commerce', 'Custom WP', 'Mock-up phase' ],
                'var(--vq-secondary)',
            ],
        ];
        foreach ( $methods as [ $id, $name, $desc, $tags, $color ] ) :
        ?>
        <div class="vq-svc" style="--svc-color:<?php echo $color; ?>">
          <div class="vq-svc-inner">
            <?php foreach ( [ 'tl', 'tr', 'bl', 'br' ] as $pos ) : ?>
              <div class="vq-svc-corner vq-svc-corner--<?php echo $pos; ?>" style="background:<?php echo $color; ?>"></div>
            <?php endforeach; ?>
            <div class="vq-svc-top">
              <span class="vq-font-pixel" style="font-size:10px;color:<?php echo $color; ?>;letter-spacing:.1em"><?php echo $id; ?></span>
            </div>
            <h3 class="vq-svc-name"><?php echo esc_html( $name ); ?></h3>
            <p class="vq-svc-desc"><?php echo esc_html( $desc ); ?></p>
            <div class="vq-svc-tags">
              <?php foreach ( $tags as $tag ) echo '<span class="vq-tag">' . esc_html( $tag ) . '</span>'; ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ===================== DESIGN PROCESS ===================== -->
  <section class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-section-head">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [04] &mdash; Design Process</div>
        <h2 class="vq-h2">Four stages. No surprises.</h2>
        <p class="vq-sub">From napkin sketch to launch &mdash; a clear process you can follow every step of the way.</p>
      </div>

      <?php
      $process = [
          [
              '01', 'Sitemap', 25, 'var(--vq-quinary)',
              'https://visionquestdevelopment.com/wp-content/uploads/2016/03/2016-03-13_17-42-29.png',
              'A list of all pages, navigation links, and hierarchy &mdash; parent pages, child pages, footer links. This helps estimate cost (roughly $100 per page), determines full scope, and identifies custom functionality needs like staff pages, portfolios, or sortable listings.',
          ],
          [
              '02', 'Wireframe', 50, 'var(--vq-quarternary)',
              'https://visionquestdevelopment.com/wp-content/uploads/2016/03/20140709_1049391.jpg',
              'A rough sketch of the site layout &mdash; no imagery, color, or movement, just structure. This is the best time to involve the developer so they can flag what\'s feasible within your timeline and budget before any design polish happens.',
          ],
          [
              '03', 'Mockup', 75, 'var(--vq-tertiary)',
              'https://visionquestdevelopment.com/wp-content/uploads/2016/03/final-liberty-2.jpg',
              'A high-fidelity prototype view of your website &mdash; sometimes interactive, sometimes a pixel-perfect image. It includes typography, color, logo, imagery, and full layout. You see and approve this before a single line of code is written.',
          ],
          [
              '04', 'Build', 100, 'var(--vq-secondary)',
              'https://visionquestdevelopment.com/wp-content/uploads/2014/03/Untitled-11.png',
              'This is where VisionQuest excels. Over 5+ years of building websites for companies across Atlanta and beyond. Weekly demos, staging access from day one, and a clean handoff with documentation when the project ships.',
          ],
      ];

      foreach ( $process as $i => [ $n, $t, $pct, $color, $img, $d ] ) :
          $flip = ( $i % 2 === 1 ) ? ' vq-design-step--flip' : '';
      ?>
      <div class="vq-design-step<?php echo $flip; ?>">
        <div class="vq-design-step-meta">
          <div class="vq-process-num" style="color:<?php echo $color; ?>"><?php echo $n; ?></div>
          <div class="vq-process-bar"><div class="vq-process-fill" style="width:<?php echo $pct; ?>%;background:<?php echo $color; ?>"></div></div>
          <h3 class="vq-process-title"><?php echo esc_html( $t ); ?></h3>
          <p class="vq-process-desc"><?php echo esc_html( $d ); ?></p>
        </div>
        <div class="vq-design-step-img">
          <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $t ); ?>">
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </section>

  <!-- ===================== CTA ===================== -->
  <section class="vq-cta-wrap">
    <div class="vq-cta-inner">
      <div class="vq-font-pixel" style="font-size:12px;color:var(--vq-quinary);letter-spacing:.1em;margin-bottom:24px">&#9658; PRESS START</div>
      <h2 class="vq-cta-title">
        Ready to start<br>
        <span class="vq-grad-3">your project?</span>
      </h2>
      <p style="font-size:17px;color:var(--vq-ink-dim);max-width:560px;margin:0 auto 36px;line-height:1.6">
        Book a 30-minute discovery call. We'll walk through your vision, give you a realistic scope, and you decide where to go from there.
      </p>
      <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
        <a href="/get-started" class="vq-btn vq-btn--primary">&#9658; Get started</a>
        <a href="/contact" class="vq-btn">Contact us</a>
      </div>
    </div>
  </section>

</div><!-- #vq-design-page -->

<?php get_footer(); ?>
