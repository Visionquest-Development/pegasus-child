<?php
/*
    Template Name: Resume Template
*/
?>
<?php get_header(); ?>

<div id="vq-resume" class="rv-dark">

  <!-- Scroll progress bar (fixed top) -->
  <div id="rv-scroll-progress"><div id="rv-scroll-bar"></div></div>

  <!-- Background layer (visible in dark mode only) -->
  <div class="rv-bg-wrap">
    <div class="rv-aurora"></div>
    <canvas id="rv-starfield"></canvas>
    <div class="rv-bg-fade"></div>
  </div>

  <!-- ===================== HEADER ===================== -->
  <header class="rv-header wow fadeInDown">
    <div class="rv-header-inner">
      <div class="rv-kicker">
        <span class="rv-kicker-dot">&#9679;</span>
        Software Engineer &nbsp;&middot;&nbsp; Web Developer &nbsp;&middot;&nbsp; DevOps
      </div>
      <h1 class="rv-name">Jim O&rsquo;Brien</h1>
      <div class="rv-contact-row">
        <span class="rv-contact-item"><i class="fa fa-map-marker"></i> Atlanta, GA</span>
        <a href="mailto:jim.obrien3@gmail.com" class="rv-contact-item"><i class="fa fa-paper-plane"></i> jim.obrien3@gmail.com</a>
        <a href="tel:4049177530" class="rv-contact-item"><i class="fa fa-phone"></i> (404) 917-7530</a>
      </div>
      <div class="rv-download-row">
        <a href="https://www.visionquestdevelopment.com/storage/2024/JMO_Final_Resume.pdf" target="_blank" rel="noopener" class="rv-btn rv-btn--primary">
          <i class="fa fa-file-pdf-o"></i> PDF R&eacute;sum&eacute;
        </a>
        <a href="https://www.visionquestdevelopment.com/storage/2024/JMO_Final_Resume.docx" target="_blank" rel="noopener" class="rv-btn">
          <i class="fa fa-file-word-o"></i> Word R&eacute;sum&eacute;
        </a>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <span class="rv-updated">Updated: <?php echo get_the_modified_date(); ?></span>
        <?php endwhile; endif; wp_reset_query(); ?>
      </div>
    </div>
  </header>

  <!-- ===================== OPTIONS WIDGET ===================== -->
  <div class="rv-options">
    <div class="rv-options-panel" id="rv-opts-panel">
      <div class="rv-opt-row">
        <span class="rv-opt-label">Dark Mode</span>
        <label class="rv-switch">
          <input type="checkbox" id="rv-dark-input" checked>
          <span class="rv-slider"></span>
        </label>
      </div>
      <div class="rv-opt-row">
        <span class="rv-opt-label">Details</span>
        <label class="rv-switch">
          <input type="checkbox" id="rv-details-input" checked>
          <span class="rv-slider"></span>
        </label>
      </div>
    </div>
    <button class="rv-options-toggle-btn" id="rv-opts-toggle" type="button" aria-label="Toggle options">
      <i class="fa fa-sliders"></i>
    </button>
  </div>

  <!-- ===================== BODY ===================== -->
  <main class="rv-body">
    <div class="rv-body-inner">

      <!-- ===== SIDEBAR ===== -->
      <aside class="rv-sidebar">

        <div class="rv-card wow fadeInLeft">
          <div class="rv-card-head"><span class="rv-section-num">00</span> Summary</div>
          <p class="rv-summary-text">Looking for a DevOps or Full-Stack software engineering position. Senior Technical lead and mentor. Teacher attitude but student approach. Problem solver and troubleshooting master.</p>
        </div>

        <div class="rv-card rv-skills">
          <div class="rv-card-head"><span class="rv-section-num">01</span> Skills</div>
          <div class="rv-skill-list">
            <?php
            $skills = [
              [ 'WordPress',  95 ],
              [ 'HTML / CSS', 99 ],
              [ 'JavaScript', 90 ],
              [ 'PHP',        90 ],
              [ 'Dev Ops',    90 ],
              [ 'Sys Admin',  85 ],
              [ 'UI / UX',    80 ],
            ];
            foreach ( $skills as [ $name, $pct ] ) :
            ?>
            <div class="rv-skill">
              <div class="rv-skill-meta">
                <span class="rv-skill-name"><?php echo esc_html( $name ); ?></span>
                <span class="rv-skill-pct"><?php echo $pct; ?>%</span>
              </div>
              <div class="rv-skill-bar">
                <div class="rv-skill-fill" style="--skill-pct:<?php echo $pct; ?>%" data-pct="<?php echo $pct; ?>%"></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="rv-card wow fadeInLeft" data-wow-delay="0.15s">
          <div class="rv-card-head"><span class="rv-section-num">02</span> Specializations</div>
          <ul class="rv-list">
            <li>Responsive Web Design</li>
            <li>PSD / Figma &rarr; HTML / WordPress</li>
            <li>Next.js &amp; React Native apps</li>
            <li>Database management / phpMyAdmin</li>
            <li>Bash / Linux command line</li>
            <li>Server maintenance &amp; administration</li>
            <li>E-commerce (WooCommerce, Stripe)</li>
            <li>WordPress plugin &amp; theme development</li>
          </ul>
        </div>

        <div class="rv-card wow fadeInLeft" data-wow-delay="0.2s">
          <div class="rv-card-head"><span class="rv-section-num">06</span> Interests</div>
          <div class="rv-pills">
            <?php
            $interests = [ 'multimedia streaming', 'building computers', 'camping', 'new technology', 'software development', 'range shooting', 'server maintenance', 'paint-balling', 'biking', 'networking', 'League of Legends', "Raspberry Pi's", 'touchscreen devices' ];
            foreach ( $interests as $interest ) echo '<span class="rv-pill">' . esc_html( $interest ) . '</span>';
            ?>
          </div>
        </div>

      </aside>

      <!-- ===== MAIN ===== -->
      <div class="rv-main">

        <!-- Work Experience -->
        <section class="rv-section" id="rv-experience">
          <div class="rv-section-header wow fadeInUp">
            <span class="rv-section-num">03</span>
            <h2 class="rv-section-title">Work Experience</h2>
          </div>

          <div class="rv-job wow fadeInUp" data-wow-delay="0.05s">
            <div class="rv-job-header">
              <div class="rv-job-logo">
                <img src="//visionquestdevelopment.com/wp-content/uploads/2013/12/VQD-Logo-blk-sml.png" alt="VisionQuest">
              </div>
              <div class="rv-job-meta">
                <h3 class="rv-job-company">VisionQuest</h3>
                <span class="rv-job-dates">2013 &ndash; Present &nbsp;&middot;&nbsp; Atlanta, GA</span>
              </div>
              <span class="rv-job-badge">Current</span>
            </div>
            <h4 class="rv-job-title">WordPress Developer (Freelance / Owner)</h4>
            <p class="rv-job-desc">Currently taking on leads, job opportunities, contracts, and for-hire positions. Owner of VisionQuest, working for myself on and off since 2013.</p>
          </div>

          <div class="rv-job wow fadeInUp" data-wow-delay="0.1s">
            <div class="rv-job-header">
              <div class="rv-job-logo">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ng.png" alt="Peraton / Northrop Grumman">
              </div>
              <div class="rv-job-meta">
                <h3 class="rv-job-company">Peraton / Northrop Grumman</h3>
                <span class="rv-job-dates">Dec 2016 &ndash; Sept 2024 &nbsp;&middot;&nbsp; Atlanta, GA</span>
              </div>
            </div>
            <h4 class="rv-job-title">Software Engineer &rarr; Technical Lead</h4>
            <p class="rv-job-desc">Technical Lead for the Digital Media Branch at CDC (Office of the Associate Director for Communications). Supported the WCMS project converting CDC from Percussion Rhythmix to WordPress &mdash; shipped 18 custom Visual Composer modules. Joined the TemplatePackage team, rolled out 200K+ pages for Template Package v4, cut build time 75%. Performed code reviews, production deployments, improved CI/CD pipelines (50% faster), converted 700+ SVG icons to webfonts. Supported the COVID outbreak &mdash; co-produced Vaccines.gov (Next.js on CDC infrastructure, mentioned by the President in 2021). Helped relaunch CDC.gov in May 2024.</p>
            <div class="rv-job-details">
              <p>Gained mastery of PHPStorm, regression testing, high-availability apps, git version control &amp; workflow management, GitHub Actions, pull request reviews. Switched build tooling Grunt &rarr; Gulp, implemented eslint/stylelint, built an ExpressJS dev server with browser-sync. Practiced Agile, SCRUM, and Kanban including JIRA triage, resource allocation, and stand-ups.</p>
            </div>
          </div>

          <div class="rv-job wow fadeInUp" data-wow-delay="0.15s">
            <div class="rv-job-header">
              <div class="rv-job-logo" style="background:#3863a0;padding:10px">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/toptal.png" alt="TopTal">
              </div>
              <div class="rv-job-meta">
                <h3 class="rv-job-company">TopTal</h3>
                <span class="rv-job-dates">May 2016 &ndash; Dec 2016 &nbsp;&middot;&nbsp; Remote</span>
              </div>
            </div>
            <h4 class="rv-job-title">Software Engineer (Contract)</h4>
            <p class="rv-job-desc">Passed Toptal&rsquo;s rigorous developer vetting process. Worked for a LA-based law agency on site customizations and updates.</p>
          </div>

          <div class="rv-job wow fadeInUp" data-wow-delay="0.2s">
            <div class="rv-job-header">
              <div class="rv-job-logo">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/s8.png" alt="Sideways 8">
              </div>
              <div class="rv-job-meta">
                <h3 class="rv-job-company">Sideways 8</h3>
                <span class="rv-job-dates">May 2016 &ndash; Dec 2016 &nbsp;&middot;&nbsp; Marietta, GA</span>
              </div>
            </div>
            <h4 class="rv-job-title">Developer (Contract)</h4>
            <p class="rv-job-desc">WordPress maintenance, support, and custom theme development for agency clients. Met the owner at WordCamp Atlanta.</p>
            <div class="rv-job-details">
              <p>Learned git version control, Foundation library, custom WordPress Customizer configurations, and Vagrant environment setup. Enhanced jQuery and JavaScript skills.</p>
            </div>
          </div>

          <div class="rv-job wow fadeInUp" data-wow-delay="0.25s">
            <div class="rv-job-header">
              <div class="rv-job-logo">
                <img src="/images/octane.svg" alt="Octane Marketing">
              </div>
              <div class="rv-job-meta">
                <h3 class="rv-job-company">Octane Marketing Solutions</h3>
                <span class="rv-job-dates">Sept 2014 &ndash; Dec 2016 &nbsp;&middot;&nbsp; Marietta, GA</span>
              </div>
            </div>
            <h4 class="rv-job-title">Development Director</h4>
            <p class="rv-job-desc">Lead developer and admin for a growing Marietta marketing agency. Managed all client technical needs: system administration, PHP development, HTML templates, CSS, database administration, and email configuration.</p>
            <div class="rv-job-details">
              <p>Gained deeper experience in sysadmin, PHP, CSS/JS animation, database administration, and email configuration.</p>
            </div>
          </div>

          <div class="rv-job wow fadeInUp" data-wow-delay="0.3s">
            <div class="rv-job-header">
              <div class="rv-job-logo">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/jamersan.png" alt="Jamersan">
              </div>
              <div class="rv-job-meta">
                <h3 class="rv-job-company">Jamersan</h3>
                <span class="rv-job-dates">May &ndash; Oct 2013 &nbsp;&middot;&nbsp; Opelika, AL</span>
              </div>
            </div>
            <h4 class="rv-job-title">Web Developer (Intern &rarr; Contract)</h4>
            <p class="rv-job-desc">Magento development shop where I learned CSS, responsive web design, WordPress plugin development, custom post types, and e-commerce solutions. Started as intern, stayed on through October 2013.</p>
            <div class="rv-job-details">
              <p>Learned CMS architecture, Magento and WooCommerce, and enhanced Photoshop skills.</p>
            </div>
          </div>

          <div class="rv-job wow fadeInUp" data-wow-delay="0.35s">
            <div class="rv-job-header">
              <div class="rv-job-logo">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/auburn.png" alt="Auburn University">
              </div>
              <div class="rv-job-meta">
                <h3 class="rv-job-company">Auburn University</h3>
                <span class="rv-job-dates">Aug 2012 &ndash; Aug 2013 &nbsp;&middot;&nbsp; Auburn, AL</span>
              </div>
            </div>
            <h4 class="rv-job-title">Research Assistant</h4>
            <p class="rv-job-desc">Research for Dr. Hamilton at the Auburn Cyber Research Center. Unity game development for Con-ops in 3D modeling; built PHP website for cyber.auburn.edu.</p>
            <div class="rv-job-details">
              <p>Learned VPNs, password cracking, network security, rainbow tables, GPU manipulation for password cracking, A* pathfinding algorithms.</p>
            </div>
          </div>

          <!-- Expand older jobs -->
          <div class="rv-expand-wrap">
            <button class="rv-btn rv-btn--ghost" id="rv-expand-past" type="button">
              <i class="fa fa-chevron-down"></i> Earlier work (2006&ndash;2012)
            </button>
            <div class="rv-expand-body" id="rv-expand-container" style="display:none">

              <div class="rv-job">
                <div class="rv-job-header">
                  <div class="rv-job-logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/coachcomm.png" alt="CoachComm"></div>
                  <div class="rv-job-meta">
                    <h3 class="rv-job-company">CoachComm</h3>
                    <span class="rv-job-dates">Aug 2011 &ndash; Aug 2012 &nbsp;&middot;&nbsp; Auburn, AL</span>
                  </div>
                </div>
                <h4 class="rv-job-title">Service Technician</h4>
                <p class="rv-job-desc">Audio equipment maintenance for college football systems. RHOS management, ESD protocols, R/F module configuration, wireless protocols (900MHz &amp; 2.4GHz).</p>
              </div>

              <div class="rv-job">
                <div class="rv-job-header">
                  <div class="rv-job-logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/the-loft.jpg" alt="The Loft"></div>
                  <div class="rv-job-meta">
                    <h3 class="rv-job-company">The Loft</h3>
                    <span class="rv-job-dates">May 2010 &ndash; Mar 2012 &nbsp;&middot;&nbsp; Columbus, GA</span>
                  </div>
                </div>
                <h4 class="rv-job-title">Web Developer</h4>
                <p class="rv-job-desc">Built and maintained website for Columbus, GA music &amp; comedy venue. Online ticket store, event calendar. Learned WordPress, ZenCart, HTML.</p>
              </div>

              <div class="rv-job">
                <div class="rv-job-header">
                  <div class="rv-job-logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/lowes.png" alt="Lowe's"></div>
                  <div class="rv-job-meta">
                    <h3 class="rv-job-company">Lowe&rsquo;s Home Improvement</h3>
                    <span class="rv-job-dates">Apr &ndash; Jul 2009 &nbsp;&middot;&nbsp; Auburn, AL</span>
                  </div>
                </div>
                <h4 class="rv-job-title">Customer Service Associate</h4>
                <p class="rv-job-desc">Lumber department, forklift training, customer service.</p>
              </div>

            </div>
          </div>

        </section>

        <!-- Education -->
        <section class="rv-section" id="rv-education">
          <div class="rv-section-header wow fadeInUp">
            <span class="rv-section-num">04</span>
            <h2 class="rv-section-title">Education</h2>
          </div>

          <div class="rv-edu wow fadeInUp" data-wow-delay="0.05s">
            <div class="rv-edu-meta">
              <h3 class="rv-edu-school">Auburn University</h3>
              <span class="rv-edu-dates">2012 &ndash; 2014 &nbsp;&middot;&nbsp; Auburn, AL</span>
            </div>
            <div class="rv-edu-body">
              <h4 class="rv-edu-degree">Bachelor&rsquo;s Degree, Computer Science (Junior)</h4>
              <p class="rv-edu-desc">Transferred to Auburn for CS degree &mdash; left to accept a full-time development position. Worked at the Auburn Cyber Research Center under Professor Hamilton in the Information Assurance Lab.</p>
            </div>
          </div>

          <div class="rv-edu wow fadeInUp" data-wow-delay="0.1s">
            <div class="rv-edu-meta">
              <h3 class="rv-edu-school">Southern Union State Community College</h3>
              <span class="rv-edu-dates">2008 &ndash; 2012 &nbsp;&middot;&nbsp; Opelika, AL</span>
            </div>
            <div class="rv-edu-body">
              <h4 class="rv-edu-degree">Associate&rsquo;s Degree, Science (Graduated 2012)</h4>
              <p class="rv-edu-desc">Achieved 69 credit hours for transfer to Auburn University.</p>
            </div>
          </div>

          <div class="rv-edu wow fadeInUp" data-wow-delay="0.15s">
            <div class="rv-edu-meta">
              <h3 class="rv-edu-school">Alan C. Pope High School</h3>
              <span class="rv-edu-dates">2004 &ndash; 2008 &nbsp;&middot;&nbsp; Marietta, GA</span>
            </div>
            <div class="rv-edu-body">
              <h4 class="rv-edu-degree">High School Diploma, College Prep</h4>
              <p class="rv-edu-desc">Electives: Database Management, Access/Excel, Telecommunications. Activities: Wrestling.</p>
            </div>
          </div>
        </section>

        <!-- Technical -->
        <section class="rv-section" id="rv-computers">
          <div class="rv-section-header wow fadeInUp">
            <span class="rv-section-num">05</span>
            <h2 class="rv-section-title">Technical</h2>
          </div>
          <div class="rv-tech-grid wow fadeInUp" data-wow-delay="0.05s">
            <div class="rv-tech-block">
              <h4 class="rv-tech-title">Languages</h4>
              <p><b>Proficient:</b> HTML, CSS, PHP, JavaScript, SQL/MySQL</p>
              <p><b>Intermediate:</b> TypeScript, Bash, PowerShell, Python, C++, C#, Java</p>
              <p><b>In Progress:</b> Rust, Ruby on Rails, Go</p>
            </div>
            <div class="rv-tech-block">
              <h4 class="rv-tech-title">Development</h4>
              <p><b>Proficient:</b> Vanilla JS, AJAX, Node.js, React, Next.js, Express, GraphQL, REST APIs, WordPress, WooCommerce, Stripe, Bootstrap, PHPStorm, VSCode</p>
              <p><b>Intermediate:</b> Angular, Laravel, Meteor, Gulp/Grunt/Webpack, ESLint, Babel, PHPUnit, GitLab CI</p>
              <p><b>In Progress:</b> Gatsby, Svelte, Vue.js, WebGL, PhoneGap/Cordova, Unity</p>
            </div>
            <div class="rv-tech-block">
              <h4 class="rv-tech-title">DevOps &amp; Cloud</h4>
              <p><b>Proficient:</b> Git, GitHub, GitHub Actions, GitLab, Bitbucket, Jenkins, CI/CD, Vagrant, WHM/cPanel, VMs</p>
              <p><b>Intermediate:</b> AWS (EC2, S3, Route 53, RDS), Kubernetes, Ansible, Docker, Chef, Puppet</p>
              <p><b>In Progress:</b> Travis CI, Azure, Google Cloud Platform</p>
            </div>
            <div class="rv-tech-block">
              <h4 class="rv-tech-title">Databases</h4>
              <p>MySQL, PostgreSQL, MariaDB, Firebase, Pusher, SQL Server, ERD diagramming, PDO PHP, phpMyAdmin</p>
            </div>
            <div class="rv-tech-block">
              <h4 class="rv-tech-title">Security &amp; Testing</h4>
              <p><b>Security:</b> Fortify, WebInspect, SSL/TLS, OAuth2, SAML, SSO, XSS prevention, NTLM/NLA</p>
              <p><b>Testing:</b> PHPUnit, WPMock, Selenium, Jest, Cypress, Puppeteer, xdebug, 508 Compliance, Regression</p>
            </div>
            <div class="rv-tech-block">
              <h4 class="rv-tech-title">Systems &amp; Tools</h4>
              <p><b>Linux:</b> SSH, CLI, Bash scripting, LAMP/LEMP, Nginx, Apache, Ubuntu, CentOS</p>
              <p><b>Windows:</b> Server 2008&ndash;2016, PowerShell, Active Directory, IIS</p>
              <p><b>Tools:</b> JIRA, Confluence, Slack, Adobe Launch, GA4, Verint/Foresee, OneTrust</p>
            </div>
          </div>
        </section>

        <!-- References -->
        <section class="rv-section" id="rv-references">
          <div class="rv-section-header wow fadeInUp">
            <span class="rv-section-num">07</span>
            <h2 class="rv-section-title">References</h2>
          </div>
          <div class="rv-refs-grid wow fadeInUp" data-wow-delay="0.05s">
            <?php
            $refs = [
              [ 'Dave Cummo',     'Architect at Pennant (Contractor to CDC)',  'Atlanta, GA',  '(404) 432-4780', 'Professional' ],
              [ 'Cass Pallansch', 'Architect at AditTech (Contractor to CDC)', 'Atlanta, GA',  '(770) 490-4534', 'Professional' ],
              [ 'Bill Scott',     'Project Manager at Peraton',                 'Cumming, GA',  '(678) 629-9458', 'Professional' ],
              [ 'Aaron Reinmann', 'Owner, Sideways8 / Clockwork WP',           'Cumming, GA',  '(404) 997-2784', 'Professional' ],
              [ 'Tom Jones',      'Restaurant Manager at The Loft',             'Columbus, GA', '(706) 992-3912', 'Personal'     ],
              [ 'Robert Edmunds', 'Regional Manager at Verizon',                'Newnan, GA',   '(334) 796-0220', 'Personal'     ],
            ];
            foreach ( $refs as [ $name, $title, $loc, $phone, $type ] ) :
            ?>
            <div class="rv-ref-card">
              <div class="rv-ref-type"><?php echo esc_html( $type ); ?></div>
              <div class="rv-ref-name"><?php echo esc_html( $name ); ?></div>
              <div class="rv-ref-title"><?php echo esc_html( $title ); ?></div>
              <div class="rv-ref-contact">
                <span><?php echo esc_html( $loc ); ?></span>
                <span><?php echo esc_html( $phone ); ?></span>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </section>

      </div><!-- .rv-main -->
    </div><!-- .rv-body-inner -->
  </main>

</div><!-- #vq-resume -->

<script>
(function () {

  var resume    = document.getElementById('vq-resume');
  var darkInput = document.getElementById('rv-dark-input');
  var detInput  = document.getElementById('rv-details-input');
  var optsBtn   = document.getElementById('rv-opts-toggle');
  var optsPanel = document.getElementById('rv-opts-panel');
  var expBtn    = document.getElementById('rv-expand-past');
  var expCont   = document.getElementById('rv-expand-container');
  var sfCanvas  = document.getElementById('rv-starfield');
  var scrollBar = document.getElementById('rv-scroll-bar');
  var sfCtx, sfW, sfH, stars, sfRunning = false;
  var sfColors  = ['#8BC644','#2BB673','#1A8D85','#E9E6FF','#21648B'];

  /* ---- Scroll progress ---- */
  function updateScrollBar() {
    if (!scrollBar) return;
    var scrolled = window.scrollY || document.documentElement.scrollTop;
    var total    = document.documentElement.scrollHeight - window.innerHeight;
    scrollBar.style.width = (total > 0 ? (scrolled / total) * 100 : 0).toFixed(2) + '%';
  }
  window.addEventListener('scroll', updateScrollBar, { passive: true });
  updateScrollBar();

  /* ---- Options panel ---- */
  if (optsBtn) {
    optsBtn.addEventListener('click', function () {
      optsPanel.classList.toggle('rv-opts-open');
    });
  }

  /* ---- Expand old jobs ---- */
  if (expBtn) {
    expBtn.addEventListener('click', function () {
      var open = expCont.style.display !== 'none';
      expCont.style.display = open ? 'none' : 'block';
      expBtn.innerHTML = open
        ? '<i class="fa fa-chevron-down"></i> Earlier work (2006&ndash;2012)'
        : '<i class="fa fa-chevron-up"></i> Hide earlier work';
    });
  }

  /* ---- Details toggle ---- */
  function applyDetails (show) {
    document.querySelectorAll('.rv-job-details').forEach(function (el) {
      el.style.display = show ? 'block' : 'none';
    });
  }
  applyDetails(true);
  if (detInput) {
    detInput.addEventListener('change', function () { applyDetails(this.checked); });
  }

  /* ---- Starfield ---- */
  function initStars () {
    sfW = sfCanvas.width  = sfCanvas.offsetWidth;
    sfH = sfCanvas.height = sfCanvas.offsetHeight;
    stars = [];
    for (var i = 0; i < 130; i++) {
      stars.push({
        x: Math.random() * sfW, y: Math.random() * sfH,
        s: Math.random() < 0.15 ? 2 : 1,
        tw: Math.random() * Math.PI * 2,
        sp: 0.02 + Math.random() * 0.04,
        c: sfColors[Math.floor(Math.random() * sfColors.length)]
      });
    }
  }
  function tickStars () {
    if (!resume.classList.contains('rv-dark')) { sfRunning = false; return; }
    sfCtx.clearRect(0, 0, sfW, sfH);
    for (var i = 0; i < stars.length; i++) {
      var st = stars[i];
      st.tw += st.sp;
      sfCtx.fillStyle     = st.c;
      sfCtx.globalAlpha   = 0.3 + Math.abs(Math.sin(st.tw)) * 0.7;
      sfCtx.fillRect(st.x, st.y, st.s, st.s);
    }
    sfCtx.globalAlpha = 1;
    requestAnimationFrame(tickStars);
  }

  /* Dark is default — init starfield immediately */
  if (sfCanvas) {
    sfCtx = sfCanvas.getContext('2d');
    initStars();
    sfRunning = true;
    tickStars();
    window.addEventListener('resize', initStars);
  }

  /* ---- Dark mode ---- */
  function setDark (on) {
    if (on) {
      resume.classList.add('rv-dark');
      darkInput.checked = true;
      if (!sfRunning) { sfRunning = true; tickStars(); }
    } else {
      resume.classList.remove('rv-dark');
      darkInput.checked = false;
      sfRunning = false;
    }
    try { localStorage.setItem('rv_dark', on ? '1' : '0'); } catch (e) {}
  }

  /* Respect saved preference — default is dark (null or '1' = dark, '0' = light) */
  try {
    if (localStorage.getItem('rv_dark') === '0') {
      setDark(false);
    }
  } catch (e) {}

  if (darkInput) {
    darkInput.addEventListener('change', function () { setDark(this.checked); });
  }

})();
</script>

<?php get_footer(); ?>
