<?php
/*
    Template Name: Get Started Template
*/
?>
<?php get_header(); ?>

<div id="vq-get-started-page">

  <!-- ===================== PAGE HERO ===================== -->
  <section class="vq-page-hero">
    <div class="vq-page-hero-aurora"></div>
    <div class="vq-page-hero-inner">
      <div class="vq-kicker wow fadeInUp"><span style="color:var(--vq-quinary)">&#9656;</span> [START HERE] &mdash; New Project</div>
      <h1 class="vq-page-hero-title wow fadeInUp" data-wow-delay="0.1s">
        <span class="vq-page-hero-brand">GET STARTED</span>
        <span class="vq-grad-2">Let&rsquo;s build something great.</span>
      </h1>
      <p class="vq-sub wow fadeInUp" data-wow-delay="0.2s" style="margin-top:20px;max-width:640px">Transparent pricing, clear process, no surprises. Here&rsquo;s exactly how a project with VisionQuest works from inquiry to launch.</p>
      <div class="vq-hero-ctas wow fadeInUp" data-wow-delay="0.3s" style="margin-top:36px">
        <a href="#gs-form" class="vq-btn vq-btn--primary">&#9658; Start a Project</a>
        <a href="/contact" class="vq-btn">Contact Us</a>
      </div>
      <span class="vq-hud-corner vq-hud-tl">&#9484;</span>
      <span class="vq-hud-corner vq-hud-tr">&#9488;</span>
    </div>
    <div class="vq-page-hero-fade"></div>
  </section>

  <!-- ===================== HOW IT WORKS ===================== -->
  <section id="gs-process" class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-section-head wow fadeInUp">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [01] &mdash; How It Works</div>
        <h2 class="vq-h2">From inquiry to launch &mdash; four clear steps.</h2>
        <p class="vq-sub">Every engagement follows the same rhythm &mdash; whether it&rsquo;s a $500 landing page or a $50k platform.</p>
      </div>
      <div class="vq-process-grid">
        <?php
        $gs_steps = [
          [ '01', 'Discovery',            'Book a 30-minute call. We walk through your goals, budget, and timeline &mdash; no commitment required.', 25 ],
          [ '02', 'Quote &amp; Contract', 'We scope the project, provide an estimate, and send a contract. Once signed, work begins the same week.', 50 ],
          [ '03', 'Content Gathering',    'You complete a project brief and supply copy, images, logo, and credentials. We guide you step by step.', 75 ],
          [ '04', 'Build &amp; Launch',   'Weekly demos on staging, QA, final sign-off. We ship, train you to manage it, and hand off all source files.', 100 ],
        ];
        $pi = 0;
        foreach ( $gs_steps as [ $n, $t, $d, $pct ] ) :
            $pdelay = number_format( $pi * 0.15, 2 ) . 's';
        ?>
        <div class="vq-process-step wow fadeInUp" data-wow-delay="<?php echo $pdelay; ?>">
          <div class="vq-process-num"><?php echo $n; ?></div>
          <div class="vq-process-bar"><div class="vq-process-fill" style="width:<?php echo $pct; ?>%"></div></div>
          <h3 class="vq-process-title"><?php echo $t; ?></h3>
          <p class="vq-process-desc"><?php echo $d; ?></p>
        </div>
        <?php $pi++; endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ===================== PRICING OPTIONS ===================== -->
  <section id="gs-pricing" class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-section-head wow fadeInUp">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [02] &mdash; Pricing</div>
        <h2 class="vq-h2">Flexible &amp; transparent billing.</h2>
        <p class="vq-sub">We bill at <strong style="color:var(--vq-quinary)">$100/hr</strong> using Harvest for time tracking. Here&rsquo;s how it all works in practice.</p>
      </div>
      <div class="vq-services-grid">
        <?php
        $pricing_cards = [
          [
            '01', 'Hourly Rate',
            'We bill at $100/hr. For rough estimation, budget about $100 per WordPress page. You always see exactly where the hours went.',
            [ '$100 / hr', 'Bi-monthly billing', 'Full visibility' ],
            'var(--vq-quarternary)',
          ],
          [
            '02', 'Time Tracking',
            'We use Harvest to log every hour. Invoices arrive on the 1st and 15th with detailed time entries &mdash; a description of exactly what was worked on each day.',
            [ 'Harvest', 'Detailed logs', 'No mystery charges' ],
            'var(--vq-tertiary)',
          ],
          [
            '03', 'Project Quotes',
            'For well-defined scopes, we can provide a written fixed estimate before any contract is signed. We map deliverables, estimate hours, and present it up front.',
            [ 'Fixed scope', 'Written estimate', 'Pre-contract' ],
            'var(--vq-secondary)',
          ],
        ];
        $ci = 0;
        foreach ( $pricing_cards as [ $id, $name, $desc, $tags, $color ] ) :
            $cdelay = number_format( $ci * 0.15, 2 ) . 's';
        ?>
        <div class="vq-svc wow fadeInUp" data-wow-delay="<?php echo $cdelay; ?>" style="--svc-color:<?php echo $color; ?>">
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
        <?php $ci++; endforeach; ?>
      </div>
      <p class="vq-outsource-note" style="margin-top:32px">
        See full pricing tiers on the <a href="/website-pricing" style="color:var(--vq-quinary)">Development page &rarr;</a>
      </p>
    </div>
  </section>

  <!-- ===================== CONTENT CHECKLIST ===================== -->
  <section id="gs-content" class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-section-head wow fadeInUp">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [03] &mdash; Content Prep</div>
        <h2 class="vq-h2">Gather your content before we start.</h2>
        <p class="vq-sub">The faster you get us content, the faster we build. Here&rsquo;s the three-step checklist.</p>
      </div>

      <div class="vq-process-grid" style="margin-bottom:56px">
        <?php
        $prep_steps = [
          [ '01', 'Collect Your Content',       'Copy for each page, images, videos (YouTube / Vimeo links preferred), PDFs, and a sitemap &mdash; a list of every page you need with its hierarchy.', 33 ],
          [ '02', 'Read Design &amp; Dev Pages', 'Review our <a href="/design" style="color:var(--vq-quinary)">Design</a> and <a href="/website-pricing" style="color:var(--vq-quinary)">Development</a> pages so you understand what&rsquo;s included at each tier and what the process looks like.', 66 ],
          [ '03', 'Gather Credentials',          'Domain login, hosting login, social accounts, analytics access &mdash; everything we&rsquo;ll need to deploy, integrate, or configure. Full list below.', 100 ],
        ];
        $si = 0;
        foreach ( $prep_steps as [ $n, $t, $d, $pct ] ) :
            $sdelay = number_format( $si * 0.15, 2 ) . 's';
        ?>
        <div class="vq-process-step wow fadeInUp" data-wow-delay="<?php echo $sdelay; ?>">
          <div class="vq-process-num"><?php echo $n; ?></div>
          <div class="vq-process-bar"><div class="vq-process-fill" style="width:<?php echo $pct; ?>%"></div></div>
          <h3 class="vq-process-title"><?php echo $t; ?></h3>
          <p class="vq-process-desc"><?php echo $d; ?></p>
        </div>
        <?php $si++; endforeach; ?>
      </div>

      <div style="text-align:center;margin-bottom:64px" class="wow fadeInUp">
        <a href="/submit-content" class="vq-btn vq-btn--primary">&#9658; Submit Your Content</a>
      </div>

      <!-- What is Content? -->
      <div class="vq-section-head wow fadeInUp" style="margin-bottom:28px">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> What counts as &ldquo;content&rdquo;?</div>
        <h2 class="vq-h2" style="font-size:28px">Everything we&rsquo;ll need from you.</h2>
      </div>

      <?php
      $content_types = [
        [ 'Sitemap &amp; Pages',    [ 'Products &amp; services pages', 'Staff member pages', 'Testimonials', 'Contact info', 'Privacy / Return policy (eCommerce)' ] ],
        [ 'Media &amp; Images',     [ 'Hero / banner images', 'Logo files (SVG preferred)', 'Favicon', 'Infographics &amp; charts', 'Stock photos' ] ],
        [ 'Video Content',          [ 'Promotional videos', 'Video testimonials', 'Explainer videos', 'YouTube / Vimeo embed links', 'MP4 / WebM source files' ] ],
        [ 'Document Downloads',     [ 'PDFs &amp; whitepapers', 'Pricing sheets or menus', 'Guides &amp; tutorials' ] ],
        [ 'SEO Content',            [ 'Meta titles &amp; descriptions', 'Target keywords', 'Image alt text' ] ],
        [ 'Social Media',           [ 'Profile links (FB, IG, X, LinkedIn)', 'Pre-written posts', 'Branded graphics for social' ] ],
        [ 'Fonts &amp; Style',      [ 'Preferred fonts', 'Color scheme / hex codes', 'Typography guidelines', 'Inspiration &amp; competitor sites' ] ],
        [ 'Interactive Elements',   [ 'Contact &amp; inquiry forms', 'Quizzes &amp; polls', 'Calculators &amp; tools' ] ],
        [ 'Third-Party Services',   [ 'Payment gateway info', 'External APIs (maps, CRMs, booking)', 'Email marketing service (Mailchimp, etc.)' ] ],
        [ 'Client Preferences',     [ 'Competitor websites you like', 'Design inspiration examples', 'Things you want to avoid' ] ],
      ];
      ?>
      <div class="vq-content-grid wow fadeInUp" data-wow-delay="0.1s">
        <?php foreach ( $content_types as [ $title, $items ] ) : ?>
        <div class="vq-content-card">
          <div class="vq-content-card-title"><?php echo $title; ?></div>
          <ul>
            <?php foreach ( $items as $item ) echo '<li>' . $item . '</li>'; ?>
          </ul>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <!-- ===================== CREDENTIALS ===================== -->
  <section id="gs-credentials" class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-section-head wow fadeInUp">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [04] &mdash; Credentials</div>
        <h2 class="vq-h2">Collect your login credentials.</h2>
        <p class="vq-sub">Starting fresh? You may not have any yet &mdash; that&rsquo;s fine. Otherwise, gather what applies before we kick off.</p>
      </div>
      <div class="vq-creds-grid">
        <div class="vq-creds-col wow fadeInLeft">
          <h3>Credentials we&rsquo;ll likely need</h3>
          <ul>
            <?php
            $creds = [
              'Domain registrar login',
              'Hosting account login',
              'Email hosting login',
              'Business Gmail (Google Analytics / APIs)',
              'Social media accounts (if integrating)',
              'cPanel / WHM access',
              'Mailchimp or email marketing platform',
              'Third-party services (scheduling, portal, eCommerce, banking, invoicing, etc.)',
            ];
            foreach ( $creds as $c ) echo '<li>' . esc_html( $c ) . '</li>';
            ?>
          </ul>
        </div>
        <div class="vq-creds-col wow fadeInRight">
          <h3>Common registrar &amp; hosting providers</h3>
          <ul>
            <?php
            $hosts = [ 'GoDaddy', 'SiteGround', 'HostGator', 'InMotion Hosting', 'LiquidWeb', 'WPEngine', 'AWS (Amazon)', 'Bluehost', 'DreamHost', 'DigitalOcean', 'Cloudflare', 'Namecheap' ];
            foreach ( $hosts as $h ) echo '<li>' . esc_html( $h ) . '</li>';
            ?>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== PROJECT FORM ===================== -->
  <section id="gs-form" class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-section-head wow fadeInUp">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [05] &mdash; Let&rsquo;s Go</div>
        <h2 class="vq-h2">Tell us about your project.</h2>
        <p class="vq-sub">Fill out the form below and we&rsquo;ll be in touch within 1&ndash;2 business days to schedule your discovery call.</p>
      </div>
      <div class="vq-gs-form-wrap wow fadeInUp" data-wow-delay="0.1s">
        <?php echo do_shortcode('[gravityform id="6" title="false" description="false" ajax="true"]'); ?>
      </div>
    </div>
  </section>

  <!-- ===================== CTA ===================== -->
  <section class="vq-cta-wrap">
    <div class="vq-cta-inner wow fadeInUp">
      <div class="vq-font-pixel" style="font-size:12px;color:var(--vq-quinary);letter-spacing:.1em;margin-bottom:24px">&#9658; PRESS START</div>
      <h2 class="vq-cta-title">
        Have questions first?<br>
        <span class="vq-grad-3">Just reach out.</span>
      </h2>
      <p style="font-size:17px;color:var(--vq-ink-dim);max-width:560px;margin:0 auto 36px;line-height:1.6">
        Not ready to fill out a form? Shoot us an email or give us a call. We&rsquo;re happy to answer questions before any commitment.
      </p>
      <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
        <a href="mailto:jim.obrien3@gmail.com" class="vq-btn vq-btn--primary">&#9658; Email Us</a>
        <a href="/contact" class="vq-btn">Contact Page</a>
      </div>
    </div>
  </section>

</div><!-- #vq-get-started-page -->

<?php get_footer(); ?>
