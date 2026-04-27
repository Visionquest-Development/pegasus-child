<?php
/*
    Template Name: 2026 Home Template
*/
?>
<?php get_header(); ?>

<?php
if ( ! function_exists( 'vq_mountain_row' ) ) {
    function vq_mountain_row( $cells, $seedA, $seedB, $minH, $maxH, $scale, $bottom_px, $opacity, $gradient ) {
        $heights = [];
        $h       = (int) floor( ( $minH + $maxH ) / 2 );
        for ( $i = 0; $i < $cells; $i++ ) {
            $h += (int) round( ( sin( $i * $seedA ) + cos( $i * $seedB ) ) * 1.2 );
            $h  = max( $minH, min( $maxH, $h ) );
            $heights[] = $h;
        }
        echo '<div style="position:absolute;left:0;right:0;bottom:' . $bottom_px . 'px;height:100%;display:flex;align-items:flex-end;opacity:' . $opacity . ';pointer-events:none;">';
        foreach ( $heights as $hh ) {
            echo '<div style="flex:1;height:' . ( $hh * $scale ) . '%;background:' . esc_attr( $gradient ) . '"></div>';
        }
        echo '</div>';
    }
}
?>

<div id="vq-home">

  <!-- ===================== HERO ===================== -->
  <section class="vq-hero">

    <div class="vq-hero-aurora"></div>
    <div class="vq-hero-scanlines"></div>

    <!-- Retro Sun -->
    <div class="vq-sun-wrap">
      <div class="vq-sun-orb">
        <?php
        $sun_bands = [ 0, 76, 82, 87, 91, 94, 96.5, 98.5 ];
        for ( $i = 1; $i < count( $sun_bands ); $i++ ) {
            $b  = $sun_bands[ $i ];
            $hh = ( $b - $sun_bands[ $i - 1 ] ) * 0.22;
            echo '<div style="position:absolute;left:0;right:0;top:' . $b . '%;height:' . $hh . '%;background:var(--vq-bg);"></div>';
        }
        ?>
      </div>
      <div class="vq-sun-glow"></div>
    </div>

    <canvas id="vq-starfield" class="vq-starfield"></canvas>

    <!-- Perspective Grid Floor -->
    <div class="vq-grid-wrap">
      <div class="vq-grid-floor"></div>
      <div class="vq-grid-floor-fade"></div>
    </div>

    <!-- Pixel Mountain Silhouettes -->
    <div class="vq-horizon-wrap">
      <?php
      vq_mountain_row( 90, 0.25, 0.11, 2, 6,  5, 84, 0.55, 'linear-gradient(180deg,#1A8D85 0%,#21648B 100%)' );
      vq_mountain_row( 70, 0.33, 0.19, 3, 8,  7, 42, 0.85, 'linear-gradient(180deg,#21648B 0%,#241F60 100%)' );
      vq_mountain_row( 60, 0.45, 0.23, 3, 11, 8,  0, 1.00, 'linear-gradient(180deg,#241F60 0%,#0A0820 100%)' );
      ?>
    </div>

    <canvas id="vq-particles" class="vq-particles"></canvas>
    <div class="vq-hero-vignette"></div>

    <div class="vq-hero-inner">

      <div class="vq-hero-tag">
        <span class="vq-blink" style="color:var(--vq-quinary)">■</span>
        <span class="vq-font-mono" style="font-size:11px;letter-spacing:.15em;text-transform:uppercase;color:var(--vq-ink-dim)">Vq-OS v4.0 &nbsp;·&nbsp; Atlanta, GA</span>
      </div>

      <h1 class="vq-hero-title">
        <span class="vq-hero-brand">VISIONQUEST</span>
        <span class="vq-hero-main-text" id="vq-line1"><span class="vq-blink" id="vq-cur1" style="color:var(--vq-quinary)">▌</span></span>
      </h1>

      <p class="vq-hero-sub" id="vq-line2-wrap">
        <span id="vq-line2"></span><span class="vq-blink" id="vq-cur2" style="color:var(--vq-quarternary);display:none">▌</span>
      </p>

      <div class="vq-hero-ctas">
        <a href="/get-started" class="vq-btn vq-btn--primary">&#9658; Get Started</a>
        <a href="/contact" class="vq-btn">Contact Us</a>
      </div>

      <span class="vq-hud-corner vq-hud-tl">&#9484;</span>
      <span class="vq-hud-corner vq-hud-tr">&#9488;</span>
    </div>

    <div class="vq-hero-fade"></div>
  </section>

  <!-- ===================== CREDIBILITY STRIP ===================== -->
  <section class="vq-strip">
    <div class="vq-strip-inner">
      <span class="vq-strip-label">Shipping for</span>
      <?php
      $strip_items = [ 'STARTUPS', 'SMBs', 'ENTERPRISE', 'ENTREPRENEURS', 'ATL-LOCAL' ];
      foreach ( $strip_items as $idx => $item ) {
          echo '<span class="vq-strip-item">' . esc_html( $item ) . '</span>';
          if ( $idx < count( $strip_items ) - 1 ) echo '<span class="vq-strip-dot">&#9670;</span>';
      }
      ?>
    </div>
  </section>

  <!-- ===================== SERVICES ===================== -->
  <section id="services" class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-section-head wow fadeInUp">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [01] &mdash; What We Build</div>
        <h2 class="vq-h2">Full-stack capability. Boutique attention.</h2>
        <p class="vq-sub">Six disciplines, one team. We scope, design, build, and ship.</p>
      </div>

      <div class="vq-services-grid">

        <!-- Agentic AI — featured, spans 2 columns -->
        <div class="vq-svc vq-svc--featured wow zoomIn">
          <div class="vq-svc-inner vq-svc-inner--featured">
            <div class="vq-svc-blob-1"></div>
            <div class="vq-svc-blob-2"></div>
            <div class="vq-svc-top">
              <span class="vq-font-pixel" style="font-size:10px;color:var(--vq-quinary);letter-spacing:.1em">01</span>
              <span class="vq-svc-badge">&#9733; NEW</span>
            </div>
            <h3 class="vq-svc-name vq-svc-name--featured">Agentic AI</h3>
            <p class="vq-svc-desc vq-svc-desc--featured">Autonomous AI agents that research, decide, and take action inside your tools. We design the workflow, pick the models, ship the guardrails.</p>
            <div class="vq-svc-tags">
              <!-- <span class="vq-tag vq-tag--featured">LangGraph</span> -->
              <span class="vq-tag vq-tag--featured">Claude</span>
              <span class="vq-tag vq-tag--featured">OpenAI</span>
              <!-- <span class="vq-tag vq-tag--featured">RAG</span> -->
            </div>
          </div>
        </div>

        <?php
        $services = [
            [ '02', 'Web Development',    'Marketing sites, landing pages, and content platforms that feel fast and look sharp on every device.',                             [ 'Next.js', 'WordPress', 'Headless CMS' ], 'var(--vq-quarternary)' ],
            [ '03', 'Web Applications',   'Dashboards, portals, and SaaS products — real-time data, auth, payments, the works.',                                             [ 'React', 'Node', 'Postgres' ],            'var(--vq-tertiary)'    ],
            [ '04', 'E-Commerce',         'Stores that convert. Woocommerce, custom carts, subscriptions, and inventory that actually syncs.',                                   [ 'Woocommerce', 'Stripe', 'Custom' ],          'var(--vq-secondary)'   ],
            [ '05', 'Software Development','Custom internal tools, integrations, and APIs built to your workflow — not shoehorned into someone else\'s.',                    [ 'Typescript', 'Next.js', 'REST APIs' ],         'var(--vq-tertiary)'    ],
            [ '06', 'DevOps &amp; Cloud', 'CI/CD, infrastructure-as-code, observability. Ship on Friday without breaking a sweat.',                                         [ 'AWS', 'Docker', 'Terraform' ],           'var(--vq-primary)'     ],
        ];
        $si = 0;
        foreach ( $services as [ $id, $name, $desc, $tags, $color ] ) {
            $delay = number_format( 0.1 + $si * 0.1, 1 ) . 's';
            echo '<div class="vq-svc wow fadeInUp" data-wow-delay="' . $delay . '" style="--svc-color:' . $color . '">';
            echo '  <div class="vq-svc-inner">';
            foreach ( [ 'tl', 'tr', 'bl', 'br' ] as $pos ) {
                echo '<div class="vq-svc-corner vq-svc-corner--' . $pos . '" style="background:' . $color . '"></div>';
            }
            echo '  <div class="vq-svc-top"><span class="vq-font-pixel" style="font-size:10px;color:' . $color . ';letter-spacing:.1em">' . $id . '</span></div>';
            echo '  <h3 class="vq-svc-name">' . $name . '</h3>';
            echo '  <p class="vq-svc-desc">' . $desc . '</p>';
            echo '  <div class="vq-svc-tags">';
            foreach ( $tags as $tag ) echo '<span class="vq-tag">' . esc_html( $tag ) . '</span>';
            echo '  </div>';
            echo '  </div>';
            echo '</div>';
            $si++;
        }
        ?>

        <!-- Something else CTA -->
        <div class="vq-svc-cta">
          <div class="vq-font-pixel" style="font-size:10px;color:var(--vq-quinary);margin-bottom:16px">?</div>
          <h3 style="margin:0 0 12px;font-size:22px;font-weight:600;color:var(--vq-ink)">Something else?</h3>
          <p style="margin:0 0 20px;font-size:14px;line-height:1.6;color:var(--vq-ink-dim)">If it runs on a server or a screen, we've probably built one. Tell us what you need.</p>
          <a href="#contact" class="vq-btn" style="font-size:9px;padding:12px 18px">Ask Us &#9656;</a>
        </div>

      </div>
    </div>
  </section>

  <!-- ===================== AI EVANGELIST ===================== -->
  <section id="ai" class="vq-ai-wrap">
    <div class="vq-ai-glow-1"></div>
    <div class="vq-ai-glow-2"></div>
    <div class="vq-ai-inner">
      <div class="vq-ai-grid">

        <!-- Left: copy -->
        <div class="wow fadeInLeft">
          <div class="vq-ai-badge">
            <span class="vq-blink" style="color:var(--vq-quinary)">&#9679;</span>
            <span>AI EVANGELIST &middot; ATLANTA</span>
          </div>
          <h2 class="vq-ai-title">
            We don&#8217;t just <span class="vq-grad-1">build with AI</span>.<br>
            We help you <span class="vq-grad-2">understand and implement it.</span>
          </h2>
          <p class="vq-ai-sub">
            VisionQuest is an <strong style="color:var(--vq-quinary)">AI-implementation studio</strong>. We design, build, and champion agentic systems — autonomous workflows that plan, act, and learn inside your tools. From PoC to production, with guardrails, evals, and a human still in the loop.
          </p>
          <div class="vq-ai-pillars">
            <?php
            $pillars = [
                [ '01', 'Strategy',   'Identify where agents win. Roadmap, model selection, buy-vs-build.' ],
                [ '02', 'Build',      'Agents, tool use, evals, observability. Ship something real in weeks.' ],
                [ '03', 'Enablement', 'Training, playbooks, and internal champions. Your team owns it after.' ],
            ];
            foreach ( $pillars as [ $n, $t, $d ] ) {
                echo '<div class="vq-ai-pillar">';
                echo '  <div class="vq-font-pixel" style="font-size:10px;color:var(--vq-quinary);letter-spacing:.1em">' . $n . '</div>';
                echo '  <div style="font-size:17px;font-weight:600;margin:10px 0 6px;color:var(--vq-ink)">' . $t . '</div>';
                echo '  <div style="font-size:13px;color:var(--vq-ink-dim);line-height:1.6">' . $d . '</div>';
                echo '</div>';
            }
            ?>
          </div>
          <div style="display:flex;gap:12px;margin-top:32px;flex-wrap:wrap">
            <a href="/contact" class="vq-btn vq-btn--primary">&#9658; Book an AI Strategy Call</a>
          </div>
        </div>

        <!-- Right: live agent mesh terminal -->
        <div class="vq-ai-panel wow fadeInRight">
          <div class="vq-ai-panel-head">
            <div style="display:flex;gap:6px;align-items:center">
              <span style="width:10px;height:10px;background:#ff5f56;display:inline-block"></span>
              <span style="width:10px;height:10px;background:#ffbd2e;display:inline-block"></span>
              <span style="width:10px;height:10px;background:var(--vq-quinary);display:inline-block"></span>
            </div>
            <span class="vq-font-mono" style="font-size:12px;color:var(--vq-ink-dim);margin-left:8px">vq-agent-mesh &middot; live</span>
            <span style="flex:1"></span>
            <span class="vq-blink vq-font-mono" style="font-size:11px;color:var(--vq-quinary)">&#9679; RUNNING</span>
          </div>
          <div class="vq-ai-panel-body">
            <div style="color:var(--vq-ink-faint);margin-bottom:10px">$ vq agent run --goal="ship-the-feature"</div>
            <div style="color:var(--vq-quarternary);margin-bottom:16px">&rarr; orchestrating 4 agents...</div>
            <div id="vq-agents">
              <div class="vq-agent-row" data-color="var(--vq-quinary)">
                <span class="vq-agent-arrow">&#8226;</span>
                <span class="vq-agent-name">research_agent</span>
                <span class="vq-agent-status">scanning sources</span>
                <span class="vq-agent-state">[IDLE]</span>
              </div>
              <div class="vq-agent-row" data-color="var(--vq-quarternary)">
                <span class="vq-agent-arrow">&#8226;</span>
                <span class="vq-agent-name">planner_agent</span>
                <span class="vq-agent-status">decomposing goal</span>
                <span class="vq-agent-state">[IDLE]</span>
              </div>
              <div class="vq-agent-row" data-color="var(--vq-tertiary)">
                <span class="vq-agent-arrow">&#8226;</span>
                <span class="vq-agent-name">coder_agent</span>
                <span class="vq-agent-status">writing tests</span>
                <span class="vq-agent-state">[IDLE]</span>
              </div>
              <div class="vq-agent-row" data-color="var(--vq-secondary)">
                <span class="vq-agent-arrow">&#8226;</span>
                <span class="vq-agent-name">reviewer_agent</span>
                <span class="vq-agent-status">verifying output</span>
                <span class="vq-agent-state">[IDLE]</span>
              </div>
            </div>
            <div class="vq-ai-panel-bar">
              <div id="vq-agent-bar" class="vq-ai-panel-bar-fill"></div>
            </div>
            <div style="color:var(--vq-quinary);margin-top:8px">$ <span class="vq-blink">&#9612;</span></div>
          </div>
          <div class="vq-ai-panel-foot">
            <span>MODEL: claude-sonnet-4</span>
            <span>TOOLS: 12</span>
            <span>TOKENS: 48.2k</span>
            <span style="color:var(--vq-quinary)">&#9650; EVAL 97%</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ===================== PROCESS ===================== -->
  <section id="process" class="vq-section vq-section--dark-grad">
    <div class="vq-section-inner">
      <div class="vq-section-head wow fadeInUp">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [02] &mdash; Our Process</div>
        <h2 class="vq-h2">Four stages. No surprises.</h2>
        <p class="vq-sub">The same rhythm for a $10k landing page and a $500k platform. It just scales.</p>
      </div>
      <div class="vq-process-grid">
        <?php
        $process_steps = [
            [ '01', 'Discover', 'Kickoff, goals, scope. We map what success looks like before a line of code.',  25  ],
            [ '02', 'Design',   'Wireframes &rarr; prototypes &rarr; hi-fi. You see and click it before we build it.', 50 ],
            [ '03', 'Build',    'Sprints with weekly demos. Staging access from day one.',                        75  ],
            [ '04', 'Launch',   'QA, monitoring, handoff docs. We stick around.',                                100  ],
        ];
        $pi = 0;
        foreach ( $process_steps as [ $n, $t, $d, $pct ] ) {
            $pdelay = number_format( $pi * 0.15, 2 ) . 's';
            echo '<div class="vq-process-step wow fadeInUp" data-wow-delay="' . $pdelay . '">';
            echo '  <div class="vq-process-num">' . $n . '</div>';
            echo '  <div class="vq-process-bar"><div class="vq-process-fill" style="width:' . $pct . '%"></div></div>';
            echo '  <h3 class="vq-process-title">' . $t . '</h3>';
            echo '  <p class="vq-process-desc">' . $d . '</p>';
            echo '</div>';
            $pi++;
        }
        ?>
      </div>
    </div>
  </section>

  <!-- ===================== WORK ===================== -->
  <section id="work" class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-section-head wow fadeInUp">
        <div class="vq-kicker"><span style="color:var(--vq-quinary)">&#9656;</span> [03] &mdash; Recent Work</div>
        <h2 class="vq-h2">Our work</h2>
        <p class="vq-sub">A slice of what we've shipped for clients across the Southeast and beyond.</p>
      </div>
      <div class="vq-work-grid">
        <?php
        $vq_accent_colors = [
            'var(--vq-secondary)',
            'var(--vq-quarternary)',
            'var(--vq-tertiary)',
            'var(--vq-quinary)',
            'var(--vq-secondary)',
            'var(--vq-quarternary)',
        ];

        $portfolio_query = new WP_Query( [
            'post_type'      => 'portfolio',
            'posts_per_page' => 6,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ] );

        $wi = 0;
        while ( $portfolio_query->have_posts() ) :
            $portfolio_query->the_post();
            $color = $vq_accent_colors[ $wi % count( $vq_accent_colors ) ];

            // Category label: try portcats first, fall back to standard category
            $terms = get_the_terms( get_the_ID(), 'portcats' );
            if ( ! $terms || is_wp_error( $terms ) ) {
                $terms = get_the_terms( get_the_ID(), 'category' );
            }
            $cat_label = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : '';

            $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
            $num_str   = str_pad( $wi + 1, 2, '0', STR_PAD_LEFT );
            $wdelay    = number_format( $wi * 0.1, 1 ) . 's';
        ?>
        <a href="<?php the_permalink(); ?>" class="vq-work-card wow fadeInUp" data-wow-delay="<?php echo $wdelay; ?>">
          <div class="vq-work-img<?php echo $thumb_url ? ' vq-work-img--photo' : ' ph'; ?>">
            <?php if ( $thumb_url ) : ?>
              <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
            <?php else : ?>
              <span><?php echo esc_html( strtoupper( str_replace( ' ', '_', get_the_title() ) ) ); ?>.png</span>
            <?php endif; ?>
            <span class="vq-work-num" style="color:<?php echo $color; ?>">&#9679; <?php echo $num_str; ?></span>
          </div>
          <div class="vq-work-meta">
            <div>
              <?php if ( $cat_label ) : ?>
                <div class="vq-font-mono vq-work-cat" style="color:<?php echo $color; ?>"><?php echo esc_html( $cat_label ); ?></div>
              <?php endif; ?>
              <div class="vq-work-title"><?php the_title(); ?></div>
            </div>
            <div class="vq-work-arrow">&#8594;</div>
          </div>
        </a>
        <?php
            $wi++;
        endwhile;
        wp_reset_postdata();
        ?>
      </div>
      <div class="vq-work-footer">
        <a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ?: home_url( '/portfolio' ) ); ?>" class="vq-btn">View All Work &#8594;</a>
      </div>
    </div>
  </section>

  <!-- ===================== PEGASUS FEATURED PRODUCT ===================== -->
  <section id="pegasus" class="vq-section">
    <div class="vq-section-inner">
      <div class="vq-pegasus-card">
        <div class="vq-pegasus-left wow fadeInLeft">
          <div class="vq-font-pixel" style="font-size:10px;color:var(--vq-quinary);letter-spacing:.12em;margin-bottom:16px">&#9733; FEATURED PRODUCT</div>
          <h2 style="font-size:52px;margin:0 0 16px;font-weight:700;letter-spacing:-0.02em;color:var(--vq-ink)">Pegasus Theme</h2>
          <p style="font-size:16px;color:var(--vq-ink-dim);line-height:1.6;margin:0 0 24px;max-width:480px">The WordPress + Bootstrap 5 theme we built and open-sourced. Hundreds of sites run on it. Suite of plugins, active community, free forever.</p>
          <div style="display:flex;gap:12px;flex-wrap:wrap">
            <a href="https://pegasustheme.com" class="vq-btn vq-btn--primary" style="font-size:9px" target="_blank" rel="noopener">&#9658; Visit Site</a>
            <a href="https://pegasustheme.com/docs" class="vq-btn" style="font-size:9px" target="_blank" rel="noopener">Docs</a>
          </div>
        </div>
        <div class="vq-pegasus-right wow fadeInRight">
          <div class="ph vq-pegasus-img"><img src="https://visionquestdevelopment.com/wp-content/uploads/2025/06/pegasus.png" alt="Pegasus Horse"></div>
          <div class="vq-pegasus-stats">
            <div>
              <div class="vq-font-pixel" style="font-size:14px;color:var(--vq-quinary)">50+</div>
              <div class="vq-font-mono" style="font-size:10px;color:var(--vq-ink-dim);text-transform:uppercase;letter-spacing:.1em;margin-top:4px">sites</div>
            </div>
            <div>
              <div class="vq-font-pixel" style="font-size:14px;color:var(--vq-quinary)">21+</div>
              <div class="vq-font-mono" style="font-size:10px;color:var(--vq-ink-dim);text-transform:uppercase;letter-spacing:.1em;margin-top:4px">plugins</div>
            </div>
            <div>
              <div class="vq-font-pixel" style="font-size:14px;color:var(--vq-quinary)">5&#9733;</div>
              <div class="vq-font-mono" style="font-size:10px;color:var(--vq-ink-dim);text-transform:uppercase;letter-spacing:.1em;margin-top:4px">rated</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== CTA / CONTACT ===================== -->
  <section id="contact" class="vq-cta-wrap">
    <div class="vq-cta-inner wow fadeInUp">
      <div class="vq-font-pixel" style="font-size:12px;color:var(--vq-quinary);letter-spacing:.1em;margin-bottom:24px">&#9658; PRESS START</div>
      <h2 class="vq-cta-title">
        Ready to start<br>
        <span class="vq-grad-3">your quest?</span>
      </h2>
      <p style="font-size:17px;color:var(--vq-ink-dim);max-width:560px;margin:0 auto 36px;line-height:1.6">
        Book a 30-minute discovery call. We'll walk through your goals, give you a realistic scope, and you decide where to go from there.
      </p>
      <div class="vq-start-steps">
        <div class="vq-start-step wow fadeInUp" data-wow-delay="0.1s">
          <div class="vq-font-pixel" style="font-size:11px;color:var(--vq-quinary)">01</div>
          <div style="font-size:15px;font-weight:600;margin-top:10px;color:var(--vq-ink)">Tell us your idea</div>
          <div style="font-size:13px;color:var(--vq-ink-dim);margin-top:4px">Quick form or a 30-min call.</div>
        </div>
        <div class="vq-start-step wow fadeInUp" data-wow-delay="0.2s">
          <div class="vq-font-pixel" style="font-size:11px;color:var(--vq-quinary)">02</div>
          <div style="font-size:15px;font-weight:600;margin-top:10px;color:var(--vq-ink)">Get a plan + quote</div>
          <div style="font-size:13px;color:var(--vq-ink-dim);margin-top:4px">Within 3 business days.</div>
        </div>
        <div class="vq-start-step wow fadeInUp" data-wow-delay="0.3s">
          <div class="vq-font-pixel" style="font-size:11px;color:var(--vq-quinary)">03</div>
          <div style="font-size:15px;font-weight:600;margin-top:10px;color:var(--vq-ink)">We build &amp; ship</div>
          <div style="font-size:13px;color:var(--vq-ink-dim);margin-top:4px">Weekly demos, staging access.</div>
        </div>
      </div>
      <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:36px">
        <a href="/get-started" class="vq-btn vq-btn--primary">&#9658; Get started</a>
        <a href="/contact" class="vq-btn">Contact us</a>
      </div>
    </div>
  </section>

</div><!-- #vq-home -->

<script>
(function () {

  /* ---- Typewriter ---- */
  var line1El = document.getElementById('vq-line1');
  var line2El = document.getElementById('vq-line2');
  var cur1    = document.getElementById('vq-cur1');
  var cur2    = document.getElementById('vq-cur2');

  function typewriter(el, text, speed, onDone) {
    var i = 0;
    el.textContent = '';
    var id = setInterval(function () {
      i++;
      el.textContent = text.slice(0, i);
      if (i >= text.length) { clearInterval(id); if (onDone) onDone(); }
    }, speed);
  }

  if (line1El) {
    typewriter(line1El, 'If you can dream it, we can build it.', 45, function () {
      if (cur1) cur1.style.display = 'none';
      if (cur2) cur2.style.display = 'inline';
      if (line2El) typewriter(line2El, 'Software development in Atlanta.', 35);
    });
  }

  /* ---- Starfield canvas ---- */
  var sfCanvas = document.getElementById('vq-starfield');
  if (sfCanvas) {
    var sfCtx = sfCanvas.getContext('2d');
    var sfW, sfH, stars;
    var sfColors = ['#8BC644','#2BB673','#1A8D85','#E9E6FF','#21648B'];

    function initStars() {
      sfW = sfCanvas.width  = sfCanvas.offsetWidth;
      sfH = sfCanvas.height = sfCanvas.offsetHeight;
      stars = [];
      for (var i = 0; i < 140; i++) {
        stars.push({
          x: Math.random() * sfW,
          y: Math.random() * sfH,
          s: Math.random() < 0.15 ? 2 : 1,
          tw: Math.random() * Math.PI * 2,
          sp: 0.02 + Math.random() * 0.05,
          c: sfColors[Math.floor(Math.random() * sfColors.length)]
        });
      }
    }

    function tickStars() {
      sfCtx.clearRect(0, 0, sfW, sfH);
      for (var i = 0; i < stars.length; i++) {
        var st = stars[i];
        st.tw += st.sp;
        var a = 0.3 + Math.abs(Math.sin(st.tw)) * 0.7;
        sfCtx.fillStyle = st.c;
        sfCtx.globalAlpha = a;
        sfCtx.fillRect(st.x, st.y, st.s, st.s);
      }
      sfCtx.globalAlpha = 1;
      requestAnimationFrame(tickStars);
    }

    initStars();
    tickStars();
    window.addEventListener('resize', initStars);
  }

  /* ---- Pixel particles canvas ---- */
  var ptCanvas = document.getElementById('vq-particles');
  if (ptCanvas) {
    var ptCtx = ptCanvas.getContext('2d');
    var ptW, ptH, parts;
    var ptColors = ['#8BC644','#2BB673','#1A8D85'];

    function initParts() {
      ptW = ptCanvas.width  = ptCanvas.offsetWidth;
      ptH = ptCanvas.height = ptCanvas.offsetHeight;
      parts = [];
      for (var i = 0; i < 40; i++) {
        parts.push({
          x: Math.random() * ptW,
          y: ptH + Math.random() * ptH,
          vy: 0.2 + Math.random() * 0.5,
          s: Math.random() < 0.3 ? 3 : 2,
          c: ptColors[Math.floor(Math.random() * ptColors.length)],
          a: 0.2 + Math.random() * 0.6
        });
      }
    }

    function tickParts() {
      ptCtx.clearRect(0, 0, ptW, ptH);
      for (var i = 0; i < parts.length; i++) {
        var p = parts[i];
        p.y -= p.vy;
        if (p.y < -10) { p.y = ptH + 20; p.x = Math.random() * ptW; }
        ptCtx.fillStyle = p.c;
        ptCtx.globalAlpha = p.a;
        ptCtx.fillRect(p.x, p.y, p.s, p.s);
      }
      ptCtx.globalAlpha = 1;
      requestAnimationFrame(tickParts);
    }

    initParts();
    tickParts();
    window.addEventListener('resize', initParts);
  }

  /* ---- AI agent panel animation ---- */
  var agentTick   = 0;
  var agentRows   = document.querySelectorAll('.vq-agent-row');
  var agentBar    = document.getElementById('vq-agent-bar');

  function tickAgents() {
    agentRows.forEach(function (row, i) {
      var color  = row.dataset.color || 'var(--vq-quinary)';
      var arrow  = row.querySelector('.vq-agent-arrow');
      var state  = row.querySelector('.vq-agent-state');
      if (i === agentTick) {
        arrow.textContent  = '▸';
        arrow.style.color  = color;
        state.textContent  = '[WORK]';
        state.style.color  = color;
      } else {
        arrow.textContent  = '•';
        arrow.style.color  = color;
        state.textContent  = '[IDLE]';
        state.style.color  = 'var(--vq-ink-faint)';
      }
    });
    if (agentBar) agentBar.style.width = (25 + agentTick * 20) + '%';
    agentTick = (agentTick + 1) % 4;
  }

  setInterval(tickAgents, 1400);
  tickAgents();

})();
</script>

<?php get_footer(); ?>
