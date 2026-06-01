<?php
/*
	Template Name: Home
	Description: QBIQ V1 Dark Performance homepage. Content is editable via the
	             "Home —" CMB2 metaboxes on the page edit screen.
*/
?>
<?php get_header(); ?>

<?php
$pid    = get_the_ID();
$prefix = 'qbh_';

// Helper — read a single meta value with fallback.
$g = function ( $key, $default = '' ) use ( $pid, $prefix ) {
	$v = get_post_meta( $pid, $prefix . $key, true );
	return ( '' === $v || null === $v ) ? $default : $v;
};
// Helper — read a group (repeatable) meta value as an array.
$grp = function ( $key, $default = array() ) use ( $pid, $prefix ) {
	$v = get_post_meta( $pid, $prefix . $key, true );
	return is_array( $v ) && ! empty( $v ) ? $v : $default;
};
// Helper — get an image URL from a CMB2 file field (which stores _id companion).
$img_url = function ( $key ) use ( $pid, $prefix ) {
	$id  = get_post_meta( $pid, $prefix . $key . '_id', true );
	$url = get_post_meta( $pid, $prefix . $key, true );
	if ( $id ) {
		$src = wp_get_attachment_image_url( $id, 'large' );
		if ( $src ) return $src;
	}
	return $url;
};

// ============================================================ HERO
$hero_h1     = $g( 'hero_headline_1', 'Train your mind.' );
$hero_h2     = $g( 'hero_headline_2', 'Dominate the game.' );
$hero_lead   = $g( 'hero_lead', 'The mental training system that teaches quarterbacks and receivers to read defenses in seconds — not minutes. Recognize coverage. Anticipate the blitz. Win the snap before it starts.' );
$hero_pills  = $grp( 'hero_pills', array(
	array( 'text' => 'Built by Coach Hixson · 30+ yrs', 'has_dot' => 'on' ),
	array( 'text' => 'For QBs & WRs',                    'has_dot' => '' ),
) );
$hero_cta1_t = $g( 'hero_cta_primary_text',   'Try Free — 2 Chapters' );
$hero_cta1_u = $g( 'hero_cta_primary_url',    '#' );
$hero_cta2_t = $g( 'hero_cta_secondary_text', 'Watch 90-sec Demo' );
$hero_cta2_u = $g( 'hero_cta_secondary_url',  '#' );
$hero_cta2_i = $g( 'hero_cta_secondary_icon', 'bi-play-circle' );
$hero_trust  = $grp( 'hero_trust', array(
	array( 'icon' => 'bi-shield-check', 'text' => '30-day money-back' ),
	array( 'icon' => 'bi-star-fill',    'text' => '4.9 from 2,400+ players' ),
	array( 'icon' => 'bi-trophy-fill',  'text' => 'Used by 500+ programs' ),
) );
$hero_video  = $g( 'hero_video_url', 'https://qbiqcamp.com/wp-content/uploads/2024/11/QBIQ-WEB-BANNER-VIDEO-1.mp4' );
$hero_poster = $img_url( 'hero_video_poster' );
$mock_img      = $img_url( 'hero_appmock_image' );
$mock_eyebrow  = $g( 'hero_appmock_eyebrow', 'Read Accelerator' );
$mock_coverage = $g( 'hero_appmock_coverage', 'COVER 2' );
$mock_chip1    = $g( 'hero_appmock_chip1', 'Mike' );
$mock_chip2    = $g( 'hero_appmock_chip2', 'Cover 2' );
$mock_chip3    = $g( 'hero_appmock_chip3', 'Cover 3' );
$mock_rtitle   = $g( 'hero_appmock_read_title', 'Pre-snap read' );
$mock_rbody    = $g( 'hero_appmock_read_body',  'Safeties split 12 yards. Corners squatting flat. CB leverage outside — backside post is open. Decide.' );

// ============================================================ STATS
$stat_items = $grp( 'stat_items', array(
	array( 'num' => '10,000+', 'label' => 'QBs Trained' ),
	array( 'num' => '500+',    'label' => 'Teams Using QBIQ' ),
	array( 'num' => '95%',     'label' => 'Faster Reads in 30 Days' ),
	array( 'num' => '24/7',    'label' => 'Train Anywhere' ),
) );

// ============================================================ INTRO ("What is QBIQ")
$intro_eye  = $g( 'intro_eyebrow', 'What is QBIQ' );
$intro_h    = $g( 'intro_heading', 'A mental rep system for the position that thinks the most.' );
$intro_body = $g( 'intro_body', '<p>QBIQ (Quarterback IQ) trains how players <em>process</em> the field — coverage recognition, leverage, pre-snap tells, and post-snap movement. Built by experienced QB coaches and sport psychologists. The result: faster, more confident decisions.</p>' );
$intro_b    = $grp( 'intro_bullets', array(
	array( 'text' => 'Read defensive coverages in seconds, not series' ),
	array( 'text' => 'Make confident pre-snap decisions under pressure' ),
	array( 'text' => 'Develop elite pattern recognition through structured reps' ),
	array( 'text' => 'Build the mental habits of championship quarterbacks' ),
) );
$intro_ctat = $g( 'intro_cta_text', 'See the full system' );
$intro_ctau = $g( 'intro_cta_url',  '#' );
$intro_vl   = $g( 'intro_video_label', 'Watch How It Works · 1:34' );
$intro_vu   = $g( 'intro_video_url',   '#' );

// ============================================================ TRUST STRIP
$trust_eye = $g( 'trust_eyebrow',  'Trusted on the sideline' );
$trust_sub = $g( 'trust_subtitle', 'Used by HS, college and select pro programs across 38 states.' );
$trust_l   = $grp( 'trust_logos', array(
	array( 'name' => 'Eastside QB Academy' ),
	array( 'name' => 'Ridgeway Football'   ),
	array( 'name' => 'Coastal HS'          ),
	array( 'name' => 'Apex Football'       ),
	array( 'name' => 'Northstar Camp'      ),
) );

// ============================================================ FEATURES
$f_eye = $g( 'features_eyebrow', 'The QBIQ training system' );
$f_h   = $g( 'features_heading', 'Everything you need to elevate your mental game.' );
$f_sub = $g( 'features_sub',     'Six tools, one workflow. Read, react, repeat — built around the way QBs actually learn.' );
$f_i   = $grp( 'features_items', array(
	array( 'icon' => 'bi-book-fill',           'title' => 'QBIQ Training Book',     'desc' => 'The 220-page guide to defensive structures, coverage tells, leverage rules, and pre-snap reads.' ),
	array( 'icon' => 'bi-controller',          'title' => 'Flash Card Game',        'desc' => 'Gamified pattern-recognition reps. Watch a frame, name the coverage, beat your time.' ),
	array( 'icon' => 'bi-stopwatch-fill',      'title' => '2-Minute Mastery',       'desc' => 'Daily micro-drills built for pressure decisions. Fits between class, practice, and dinner.' ),
	array( 'icon' => 'bi-play-btn-fill',       'title' => 'Install Video Library',  'desc' => 'Broadcast-angle breakdowns of coverages, fronts, and tells. Pause, rewind, master.' ),
	array( 'icon' => 'bi-clipboard2-data-fill','title' => 'Game Prep Tools',        'desc' => 'Structured opponent-prep packets. Build your week from Sunday film through Friday lights.' ),
	array( 'icon' => 'bi-people-fill',         'title' => 'Live Training',          'desc' => 'Group sessions and 1-on-1 reviews with QBIQ coaches. Bring your film. Leave with a plan.' ),
) );

// ============================================================ COACH
$coach_img      = $img_url( 'coach_image' );
$coach_initials = $g( 'coach_initials', 'CH' );
$coach_role     = $g( 'coach_role',     'Founder' );
$coach_name     = $g( 'coach_name',     'Coach Steve Hixson' );
$coach_quote    = $g( 'coach_quote',    'The best quarterbacks aren\'t just physically gifted — they\'re mentally elite. QBIQ trains the part of the game that wins championships.' );
$coach_bio      = $g( 'coach_bio',      '30+ years coaching QBs at the high school, college, and private-camp level. Author of the QBIQ Training Book. Featured at clinics nationwide.' );

// ============================================================ HOW
$how_eye   = $g( 'how_eyebrow', 'How it works' );
$how_h     = $g( 'how_heading', 'Start improving your quarterback IQ in three steps.' );
$how_steps = $grp( 'how_steps', array(
	array( 'title' => 'Choose your plan',    'body' => 'Individual, team, or full program. Start with 2 free chapters.' ),
	array( 'title' => 'Access the system',   'body' => 'Book, flash card game, video library, and prep tools — all in one place.' ),
	array( 'title' => 'Train daily',         'body' => '2-minute drills, weekly install. Watch your football IQ climb week over week.' ),
) );
$acc_eye = $g( 'how_acc_eyebrow', 'Read Accelerator' );
$acc_h   = $g( 'how_acc_heading', 'See it. Name it. Throw it.' );
$acc_b   = $g( 'how_acc_body',    'QBIQ trains the three-step rep that elite quarterbacks run a thousand times a season — identifying the front, the rotation, and the leverage in under three seconds.' );
$acc_bul = $grp( 'how_acc_bullets', array(
	array( 'title' => 'Identify the shell.',  'body' => 'Two-high or single-high? Where are the safeties?' ),
	array( 'title' => 'Find the trigger.',    'body' => 'Corner leverage, alignment, walked-up nickel.' ),
	array( 'title' => 'Pick your throw.',     'body' => 'Confidence before the snap — execution after.' ),
) );

// ============================================================ TESTIMONIALS
$t_eye  = $g( 'test_eyebrow', 'What players are saying' );
$t_h    = $g( 'test_heading', 'Built for the field. Tested under the lights.' );
$t_lt   = $g( 'test_link_text', 'Read all 240 reviews' );
$t_lu   = $g( 'test_link_url', '#' );
$t_i    = $grp( 'test_items', array(
	array( 'quote' => 'QBIQ completely changed how I see the field. I went from guessing at coverages to knowing them before the snap.', 'name' => 'Marcus T.',     'role' => 'Division I Quarterback' ),
	array( 'quote' => 'The flash card game is addictive. My recognition speed jumped in two weeks of daily reps.',                       'name' => 'Jake R.',       'role' => 'High School Varsity QB' ),
	array( 'quote' => 'As a coach, I\'ve seen the difference QBIQ makes. Our quarterbacks are more confident and make better decisions.', 'name' => 'Coach Williams','role' => 'Head Football Coach' ),
) );

// ============================================================ CTA BAND
$cta_pill   = $g( 'cta_pill',    'Plans from $15/month' );
$cta_h      = $g( 'cta_heading', 'Ready to elevate your game?' );
$cta_body   = $g( 'cta_body',    'Join thousands of quarterbacks training smarter with QBIQ. 30-day money-back guarantee. Cancel anytime.' );
$cta_p_t    = $g( 'cta_primary_text',   'View Pricing' );
$cta_p_u    = $g( 'cta_primary_url',    '#' );
$cta_s_t    = $g( 'cta_secondary_text', 'Start Free Trial' );
$cta_s_u    = $g( 'cta_secondary_url',  '#' );

// Numbered-circle icon class lookup for accelerator bullets.
$num_icon = array( 'bi-1-circle-fill', 'bi-2-circle-fill', 'bi-3-circle-fill', 'bi-4-circle-fill', 'bi-5-circle-fill' );
?>

<div class="qb-home">

<!-- ============================================ HERO -->
<header class="v1-hero<?php echo $hero_video ? ' has-video' : ''; ?>">

	<?php if ( $hero_video ) : ?>
		<!-- Background video — pattern from qbiqcamp_theme #large-header swap -->
		<div class="w-embed-youtubevideo youtube losangeles _2" aria-hidden="true">
			<video autoplay muted loop playsinline preload="auto"<?php echo $hero_poster ? ' poster="' . esc_url( $hero_poster ) . '"' : ''; ?>>
				<source src="<?php echo esc_url( $hero_video ); ?>" type="video/mp4">
			</video>
		</div>
	<?php endif; ?>

	<div class="container position-relative">
		<div class="row align-items-center g-5">
			<div class="col-lg-7">
				<?php if ( $hero_pills ) : ?>
					<div class="v1-chips">
						<?php foreach ( $hero_pills as $pill ) :
							if ( empty( $pill['text'] ) ) continue;
							$dot = ! empty( $pill['has_dot'] ) ? ' qb-pill-dot' : '';
						?>
							<span class="qb-pill qb-pill-dark<?php echo esc_attr( $dot ); ?>"><?php echo esc_html( $pill['text'] ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<h1 class="qb-display mb-4">
					<?php echo esc_html( $hero_h1 ); ?>
					<?php if ( $hero_h2 ) : ?><span class="accent"><?php echo esc_html( $hero_h2 ); ?></span><?php endif; ?>
				</h1>

				<p class="lead mb-4"><?php echo esc_html( $hero_lead ); ?></p>

				<div class="d-flex flex-wrap gap-3 mb-5">
					<?php if ( $hero_cta1_t ) : ?>
						<a href="<?php echo esc_url( $hero_cta1_u ); ?>" class="btn btn-qb btn-qb-primary"><?php echo esc_html( $hero_cta1_t ); ?></a>
					<?php endif; ?>
					<?php if ( $hero_cta2_t ) : ?>
						<a href="<?php echo esc_url( $hero_cta2_u ); ?>" class="btn btn-qb btn-qb-outline-light">
							<?php if ( $hero_cta2_i ) : ?><i class="bi <?php echo esc_attr( $hero_cta2_i ); ?> me-2"></i><?php endif; ?><?php echo esc_html( $hero_cta2_t ); ?>
						</a>
					<?php endif; ?>
				</div>

				<?php if ( $hero_trust ) : ?>
					<div class="d-flex flex-wrap align-items-center gap-4 small text-muted">
						<?php foreach ( $hero_trust as $ti ) :
							if ( empty( $ti['text'] ) ) continue;
							$icon = ! empty( $ti['icon'] ) ? $ti['icon'] : 'bi-check2-circle';
						?>
							<div class="d-flex align-items-center gap-2">
								<i class="bi <?php echo esc_attr( $icon ); ?> text-warning"></i>
								<?php echo esc_html( $ti['text'] ); ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-lg-5">
				<?php if ( $mock_img ) : ?>
					<div class="v1-appmock-img">
						<img src="<?php echo esc_url( $mock_img ); ?>" alt="<?php echo esc_attr( $mock_eyebrow ); ?>" />
					</div>
				<?php else : ?>
					<div class="v1-appmock" aria-label="QBIQ app preview">
						<div class="v1-appbar">
							<span class="qb-eyebrow"><?php echo esc_html( $mock_eyebrow ); ?></span>
							<div class="v1-appdot"><span></span><span></span><span></span></div>
						</div>
						<div class="v1-appfield" aria-hidden="true">
							<svg viewBox="0 0 100 60" preserveAspectRatio="none">
								<g fill="#fff">
									<circle cx="20" cy="14" r="2.2"/><circle cx="40" cy="14" r="2.2"/>
									<circle cx="60" cy="14" r="2.2"/><circle cx="80" cy="14" r="2.2"/>
									<circle cx="30" cy="26" r="2.2"/><circle cx="70" cy="26" r="2.2"/>
									<circle cx="50" cy="20" r="2.2"/>
								</g>
								<g fill="#e98318">
									<circle cx="50" cy="48" r="2.6"/>
									<circle cx="18" cy="42" r="2.2"/><circle cx="34" cy="42" r="2.2"/>
									<circle cx="66" cy="42" r="2.2"/><circle cx="82" cy="42" r="2.2"/>
								</g>
								<g stroke="#e98318" stroke-width="0.7" fill="none" stroke-dasharray="1.5 1.5">
									<path d="M18 42 L18 30 L26 24"/>
									<path d="M82 42 L82 30 L74 24"/>
									<path d="M34 42 L40 28"/>
									<path d="M66 42 L60 28"/>
								</g>
								<text x="6" y="9" fill="#b5bac3" font-size="4" font-family="Inter" font-weight="700"><?php echo esc_html( $mock_coverage ); ?></text>
							</svg>
						</div>
						<div class="v1-appcta">
							<div class="v1-appchip"><?php echo esc_html( $mock_chip1 ); ?></div>
							<div class="v1-appchip active"><?php echo esc_html( $mock_chip2 ); ?></div>
							<div class="v1-appchip"><?php echo esc_html( $mock_chip3 ); ?></div>
						</div>
						<div class="v1-appread">
							<strong><?php echo esc_html( $mock_rtitle ); ?></strong>
							<?php echo esc_html( $mock_rbody ); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>

<!-- ============================================ STAT BAND -->
<?php if ( $stat_items ) : ?>
<section class="qb-stat-band">
	<div class="container">
		<div class="row text-center py-4">
			<?php $count = count( $stat_items ); foreach ( $stat_items as $i => $s ) :
				$mt = ( $i >= 2 ) ? ' mt-4 mt-md-0' : '';
				$col = ( 4 === $count ) ? 'col-6 col-md-3' : 'col-6 col-md-' . max( 2, intval( 12 / max( 1, $count ) ) );
			?>
				<div class="<?php echo esc_attr( $col . $mt ); ?>">
					<div class="qb-stat-num"><?php echo esc_html( $s['num'] ); ?></div>
					<div class="qb-stat-label"><?php echo esc_html( $s['label'] ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ============================================ WHAT IS QBIQ -->
<section class="qb-section qb-bg-dark">
	<div class="container">
		<div class="row align-items-center g-5">
			<div class="col-lg-6">
				<span class="qb-eyebrow"><?php echo esc_html( $intro_eye ); ?></span>
				<h2 class="qb-display mt-3 mb-3 v1-section-title"><?php echo esc_html( $intro_h ); ?></h2>
				<div class="text-muted mb-4"><?php echo wp_kses_post( wpautop( $intro_body ) ); ?></div>
				<?php if ( $intro_b ) : ?>
					<ul class="list-unstyled v1-bullets mb-4">
						<?php foreach ( $intro_b as $b ) :
							if ( empty( $b['text'] ) ) continue;
						?>
							<li><span class="v1-bullets-i"><i class="bi bi-check2-circle"></i></span><?php echo esc_html( $b['text'] ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<?php if ( $intro_ctat ) : ?>
					<a href="<?php echo esc_url( $intro_ctau ); ?>" class="btn btn-qb btn-qb-outline-light"><?php echo esc_html( $intro_ctat ); ?></a>
				<?php endif; ?>
			</div>
			<div class="col-lg-6">
				<a href="<?php echo esc_url( $intro_vu ); ?>" class="v1-video text-decoration-none">
					<span class="v1-play"><i class="bi bi-play-fill"></i></span>
					<span class="v1-vlabel text-white"><?php echo esc_html( $intro_vl ); ?></span>
				</a>
			</div>
		</div>
	</div>
</section>

<!-- ============================================ TRUST STRIP -->
<?php if ( $trust_l ) : ?>
<section class="v1-trust qb-section-tight">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-3">
				<p class="qb-eyebrow mb-2"><?php echo esc_html( $trust_eye ); ?></p>
				<p class="mb-0 small text-muted"><?php echo esc_html( $trust_sub ); ?></p>
			</div>
			<div class="col-md-9 mt-4 mt-md-0">
				<div class="d-flex flex-wrap gap-4 gap-md-5 justify-content-md-end align-items-center">
					<?php foreach ( $trust_l as $tl ) :
						if ( empty( $tl['name'] ) ) continue;
					?>
						<span class="v1-trustlogo"><?php echo esc_html( $tl['name'] ); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ============================================ TRAINING SYSTEM (FEATURES) -->
<section class="qb-section qb-bg-dark">
	<div class="container">
		<div class="text-center mb-5">
			<span class="qb-eyebrow v1-eyebrow-center"><?php echo esc_html( $f_eye ); ?></span>
			<h2 class="qb-display mt-3 mb-3 v1-section-title"><?php echo esc_html( $f_h ); ?></h2>
			<p class="text-muted mx-auto" style="max-width: 640px;"><?php echo esc_html( $f_sub ); ?></p>
		</div>

		<?php if ( $f_i ) : ?>
		<div class="row g-4">
			<?php foreach ( $f_i as $feat ) :
				if ( empty( $feat['title'] ) ) continue;
				$icon = ! empty( $feat['icon'] ) ? $feat['icon'] : 'bi-stars';
			?>
				<div class="col-md-6 col-lg-4">
					<article class="qb-feature">
						<span class="qb-feature-icon"><i class="bi <?php echo esc_attr( $icon ); ?>"></i></span>
						<h3><?php echo esc_html( $feat['title'] ); ?></h3>
						<p><?php echo esc_html( $feat['desc'] ); ?></p>
					</article>
				</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<!-- ============================================ COACH AUTHORITY -->
<section class="qb-section qb-bg-ink2">
	<div class="container">
		<div class="v1-authority">
			<div class="row align-items-center g-5">
				<div class="col-md-3 text-center">
					<div class="v1-portrait">
						<?php if ( $coach_img ) : ?>
							<img src="<?php echo esc_url( $coach_img ); ?>" alt="<?php echo esc_attr( $coach_name ); ?>" />
						<?php else : ?>
							<?php echo esc_html( $coach_initials ); ?>
						<?php endif; ?>
					</div>
					<p class="mb-0 mt-3 qb-eyebrow v1-eyebrow-center"><?php echo esc_html( $coach_role ); ?></p>
					<p class="mb-0 fw-bold mt-1"><?php echo esc_html( $coach_name ); ?></p>
				</div>
				<div class="col-md-9">
					<p class="qb-display fs-3 mb-3" style="text-transform:none; letter-spacing:-0.01em; line-height: 1.2;">
						&ldquo;<?php echo esc_html( $coach_quote ); ?>&rdquo;
					</p>
					<p class="text-muted mb-0"><?php echo wp_kses_post( $coach_bio ); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ============================================ HOW IT WORKS -->
<section class="qb-section qb-bg-dark">
	<div class="container">
		<div class="text-center mb-5">
			<span class="qb-eyebrow v1-eyebrow-center"><?php echo esc_html( $how_eye ); ?></span>
			<h2 class="qb-display mt-3 mb-3 v1-section-title"><?php echo esc_html( $how_h ); ?></h2>
		</div>

		<?php if ( $how_steps ) : ?>
		<div class="row g-4 g-md-5 text-center">
			<?php
			$step_count = count( $how_steps );
			$step_col   = ( 0 < $step_count ) ? 'col-md-' . max( 3, intval( 12 / $step_count ) ) : 'col-md-4';
			foreach ( $how_steps as $i => $step ) :
				if ( empty( $step['title'] ) ) continue;
			?>
				<div class="<?php echo esc_attr( $step_col ); ?>">
					<div class="qb-step-num mx-auto mb-3"><?php echo intval( $i + 1 ); ?></div>
					<h3 class="qb-display fs-5 mb-2"><?php echo esc_html( $step['title'] ); ?></h3>
					<p class="text-muted mx-auto" style="max-width:280px;"><?php echo esc_html( $step['body'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<div class="row mt-5 pt-4 g-4 align-items-center">
			<div class="col-lg-6">
				<div class="v1-playdiagram">
					<span class="v1-yardline" style="top:25%"></span>
					<span class="v1-yardline" style="top:50%"></span>
					<span class="v1-yardline" style="top:75%"></span>
					<span class="v1-marker def" style="left:18%; top:18%">$</span>
					<span class="v1-marker def" style="left:38%; top:18%">F</span>
					<span class="v1-marker def" style="left:62%; top:18%">S</span>
					<span class="v1-marker def" style="left:82%; top:18%">$</span>
					<span class="v1-marker def" style="left:30%; top:38%">M</span>
					<span class="v1-marker def" style="left:70%; top:38%">W</span>
					<span class="v1-marker off" style="left:50%; top:78%">QB</span>
					<span class="v1-marker off" style="left:18%; top:65%">X</span>
					<span class="v1-marker off" style="left:34%; top:65%">Y</span>
					<span class="v1-marker off" style="left:66%; top:65%">H</span>
					<span class="v1-marker off" style="left:82%; top:65%">Z</span>
				</div>
			</div>
			<div class="col-lg-6">
				<span class="qb-eyebrow"><?php echo esc_html( $acc_eye ); ?></span>
				<h3 class="qb-display fs-2 mt-3 mb-3" style="line-height:1.05;"><?php echo esc_html( $acc_h ); ?></h3>
				<p class="text-muted mb-3"><?php echo esc_html( $acc_b ); ?></p>
				<?php if ( $acc_bul ) : ?>
					<ul class="list-unstyled v1-bullets">
						<?php foreach ( $acc_bul as $i => $b ) :
							if ( empty( $b['title'] ) && empty( $b['body'] ) ) continue;
							$ic = isset( $num_icon[ $i ] ) ? $num_icon[ $i ] : 'bi-dot';
						?>
							<li>
								<span class="v1-bullets-i"><i class="bi <?php echo esc_attr( $ic ); ?>"></i></span>
								<span><strong class="text-white"><?php echo esc_html( $b['title'] ); ?></strong> <?php echo esc_html( $b['body'] ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<!-- ============================================ TESTIMONIALS -->
<section class="qb-section qb-bg-ink2">
	<div class="container">
		<div class="d-flex flex-wrap align-items-end justify-content-between mb-5 gap-3">
			<div>
				<span class="qb-eyebrow"><?php echo esc_html( $t_eye ); ?></span>
				<h2 class="qb-display mt-3 mb-0 v1-section-title"><?php echo esc_html( $t_h ); ?></h2>
			</div>
			<?php if ( $t_lt ) : ?>
				<a class="btn btn-qb btn-qb-ghost" href="<?php echo esc_url( $t_lu ); ?>"><?php echo esc_html( $t_lt ); ?> <i class="bi bi-arrow-right ms-1"></i></a>
			<?php endif; ?>
		</div>

		<?php if ( $t_i ) : ?>
		<div class="row g-4">
			<?php foreach ( $t_i as $q ) :
				if ( empty( $q['quote'] ) ) continue;
			?>
				<div class="col-md-4">
					<article class="qb-quote">
						<i class="bi bi-quote text-warning fs-3 d-block mb-2"></i>
						<p><?php echo esc_html( $q['quote'] ); ?></p>
						<?php if ( ! empty( $q['name'] ) ) : ?><div class="qb-quote-name"><?php echo esc_html( $q['name'] ); ?></div><?php endif; ?>
						<?php if ( ! empty( $q['role'] ) ) : ?><div class="qb-quote-role"><?php echo esc_html( $q['role'] ); ?></div><?php endif; ?>
					</article>
				</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<!-- ============================================ CTA BAND -->
<section class="v1-cta-band">
	<div class="container">
		<div class="row align-items-center g-4">
			<div class="col-lg-8">
				<?php if ( $cta_pill ) : ?>
					<span class="qb-pill" style="background: rgba(255,255,255,.18); color:#fff;"><?php echo esc_html( $cta_pill ); ?></span>
				<?php endif; ?>
				<h2 class="qb-display mt-3 mb-2" style="font-size: clamp(2rem, 4vw, 3rem);"><?php echo esc_html( $cta_h ); ?></h2>
				<p class="mb-0" style="color: rgba(255,255,255,.92); max-width: 600px;"><?php echo esc_html( $cta_body ); ?></p>
			</div>
			<div class="col-lg-4 text-lg-end">
				<?php if ( $cta_p_t ) : ?>
					<a href="<?php echo esc_url( $cta_p_u ); ?>" class="btn btn-qb btn-qb-dark me-2"><?php echo esc_html( $cta_p_t ); ?></a>
				<?php endif; ?>
				<?php if ( $cta_s_t ) : ?>
					<a href="<?php echo esc_url( $cta_s_u ); ?>" class="btn btn-qb" style="background:#fff; color: var(--qb-accent);"><?php echo esc_html( $cta_s_t ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

</div><!-- /.qb-home -->

<?php get_footer(); ?>
