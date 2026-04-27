<?php
/*
    Template Name: Contact Template
*/
?>
<?php get_header(); ?>

<div id="vq-contact-page">

  <!-- ===================== PAGE HERO ===================== -->
  <section class="vq-page-hero">
    <div class="vq-page-hero-aurora"></div>
    <div class="vq-page-hero-inner">
      <div class="vq-kicker wow fadeInUp"><span style="color:var(--vq-quinary)">&#9656;</span> [04] &mdash; Get in Touch</div>
      <h1 class="vq-page-hero-title wow fadeInUp" data-wow-delay="0.1s">
        <span class="vq-page-hero-brand">CONTACT</span>
        <span class="vq-grad-2">Let&rsquo;s talk about your project.</span>
      </h1>
      <p class="vq-sub wow fadeInUp" data-wow-delay="0.2s" style="margin-top:20px;max-width:600px">Questions, quotes, or just a quick hello &mdash; we respond within 1&ndash;2 business days.</p>
      <span class="vq-hud-corner vq-hud-tl">&#9484;</span>
      <span class="vq-hud-corner vq-hud-tr">&#9488;</span>
    </div>
    <div class="vq-page-hero-fade"></div>
  </section>

  <!-- ===================== CONTACT BODY ===================== -->
  <section class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-contact-grid">

        <!-- ── Left: Info ── -->
        <div class="vq-contact-info wow fadeInLeft">

          <div class="vq-contact-block">
            <div class="vq-contact-block-label">&#9656; Email</div>
            <a href="mailto:jim.obrien3@gmail.com" class="vq-contact-block-value">jim.obrien3@gmail.com</a>
          </div>

          <div class="vq-contact-block">
            <div class="vq-contact-block-label">&#9656; Phone</div>
            <a href="tel:4049177530" class="vq-contact-block-value">(404) 917-7530</a>
          </div>

          <div class="vq-contact-block">
            <div class="vq-contact-block-label">&#9656; Location</div>
            <span class="vq-contact-block-value">Atlanta, GA</span>
          </div>

          <div class="vq-contact-block">
            <div class="vq-contact-block-label">&#9656; Availability</div>
            <span class="vq-contact-block-value">Mon &ndash; Fri &nbsp;&#183;&nbsp; 9am &ndash; 6pm ET</span>
          </div>

          <div class="vq-contact-block" style="margin-top:36px">
            <div class="vq-contact-block-label" style="margin-bottom:14px">&#9656; Shortcuts</div>
            <div style="display:flex;flex-direction:column;gap:10px">
              <a href="/get-started" class="vq-btn vq-btn--primary" style="text-align:center">&#9658; Start a Project</a>
              <a href="/portfolio" class="vq-btn" style="text-align:center">View Portfolio</a>
              <a href="/website-pricing" class="vq-btn" style="text-align:center">See Pricing</a>
            </div>
          </div>

          <div class="vq-contact-block" style="margin-top:36px">
            <div class="vq-contact-block-label" style="margin-bottom:12px">&#9656; Social</div>
            <div class="vq-contact-social">
              <a href="https://www.linkedin.com/in/jamesobrien3/" target="_blank" rel="noopener" class="vq-contact-social-link" title="LinkedIn">
                <i class="fa fa-linkedin"></i>
              </a>
              <a href="https://github.com/jimob3" target="_blank" rel="noopener" class="vq-contact-social-link" title="GitHub">
                <i class="fa fa-github"></i>
              </a>
            </div>
          </div>

        </div>

        <!-- ── Right: Form ── -->
        <div class="vq-contact-form-wrap wow fadeInRight" data-wow-delay="0.1s">
          <div class="vq-contact-form-head">
            <div class="vq-kicker" style="margin-bottom:12px"><span style="color:var(--vq-quinary)">&#9656;</span> Send a Message</div>
            <p class="vq-sub" style="font-size:15px">Fill out the form and we&rsquo;ll be in touch shortly.</p>
          </div>
          <?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
        </div>

      </div>
    </div>
  </section>

  <!-- ===================== CTA ===================== -->
  <section class="vq-cta-wrap">
    <div class="vq-cta-inner wow fadeInUp">
      <div class="vq-font-pixel" style="font-size:12px;color:var(--vq-quinary);letter-spacing:.1em;margin-bottom:24px">&#9658; READY TO BUILD?</div>
      <h2 class="vq-cta-title">
        Know what you need?<br>
        <span class="vq-grad-3">Skip the form &mdash; get started.</span>
      </h2>
      <p style="font-size:17px;color:var(--vq-ink-dim);max-width:520px;margin:0 auto 36px;line-height:1.6">
        The Get Started page walks through pricing, process, and lets you submit a full project brief.
      </p>
      <a href="/get-started" class="vq-btn vq-btn--primary">&#9658; Get Started &rarr;</a>
    </div>
  </section>

</div><!-- #vq-contact-page -->

<?php get_footer(); ?>
