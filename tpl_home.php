<?php
/*
	Template Name: Home Template
*/
?>
<?php get_header(); ?>
<?php
if ( have_posts() ) : the_post(); endif;
$pid = get_the_ID();

/* ---- Hero ---- */
$hero_heading   = get_post_meta( $pid, 'rcf_hero_heading', true )    ?: 'Rice Capital Fund';
$hero_subtitle  = get_post_meta( $pid, 'rcf_hero_subtitle', true )   ?: 'Hedge Fund &amp; Advisory Firm';
$hero_lede      = get_post_meta( $pid, 'rcf_hero_lede', true )       ?: 'A multi-strategy hedge fund and advisory firm focused on identifying attractive risk/reward opportunities and delivering consistent, risk-adjusted returns.';
$hero_img_url   = get_the_post_thumbnail_url( $pid, 'full' ) ?: '';
$hero_btn1_text = get_post_meta( $pid, 'rcf_hero_btn1_text', true )  ?: 'Our Approach';
$hero_btn1_url  = get_post_meta( $pid, 'rcf_hero_btn1_url', true )   ?: '#';
$hero_btn2_text = get_post_meta( $pid, 'rcf_hero_btn2_text', true )  ?: 'Learn More';
$hero_btn2_url  = get_post_meta( $pid, 'rcf_hero_btn2_url', true )   ?: '#';

/* ---- Pillars (CMB2 group) ---- */
$home_pillars = get_post_meta( $pid, 'rcf_home_pillars_group', true );
if ( empty( $home_pillars ) || ! is_array( $home_pillars ) ) {
	$home_pillars = array(
		array( 'title' => 'Focused Strategy',      'icon' => 'bar-chart',   'content' => '<p>A disciplined, opportunistic multi-strategy approach focused on generating superior risk-adjusted returns.</p>' ),
		array( 'title' => 'Risk Management',        'icon' => 'shield',      'content' => '<p>Risk management is integrated throughout our investment process with a focus on capital preservation.</p>' ),
		array( 'title' => 'Alignment of Interests', 'icon' => 'handshake-o', 'content' => '<p>We are partners with our investors and committed to delivering strong, consistent results.</p>' ),
		array( 'title' => 'Investor Partnership',   'icon' => 'users',       'content' => '<p>We believe in building long-term partnerships based on trust, transparency and performance.</p>' ),
	);
}

/* ---- Investment Philosophy (CMB2 fields) ---- */
$phil_heading = get_post_meta( $pid, 'rcf_philosophy_heading', true ) ?: "Patient capital,\ndisciplined process,\nasymmetric outcomes.";
$phil_quote   = get_post_meta( $pid, 'rcf_philosophy_quote', true )   ?: '&#8220;We invest with the conviction that durable returns are earned through rigorous fundamental work, disciplined risk budgeting, and the patience to act only when the opportunity is genuinely asymmetric.&#8221;';
$phil_cite    = get_post_meta( $pid, 'rcf_philosophy_cite', true )    ?: '&#8212; Investment Committee, Rice Capital Fund';
$phil_tenets  = get_post_meta( $pid, 'rcf_philosophy_tenets', true );
if ( empty( $phil_tenets ) || ! is_array( $phil_tenets ) ) {
	$phil_tenets = array(
		array( 'num' => 'I.',   'title' => 'Fundamentals First',  'body' => 'Every position begins with bottom-up research — the business, the balance sheet, the people running it. We do not chase narratives; we earn conviction through reps.' ),
		array( 'num' => 'II.',  'title' => 'Asymmetry Always',     'body' => 'We size to upside, but engineer for the downside. A position only enters the book when the prospective reward is meaningfully larger than the probable loss.' ),
		array( 'num' => 'III.', 'title' => 'Capital Preservation', 'body' => 'Liquidity, leverage, and concentration are budgeted at the portfolio level — not optimized to it. We would rather miss a good year than risk a permanent impairment.' ),
	);
}

/* ---- How We Invest / Process (CMB2 fields) ---- */
$proc_heading = get_post_meta( $pid, 'rcf_process_heading', true ) ?: "A repeatable process\nthat compounds judgment.";
$proc_lede    = get_post_meta( $pid, 'rcf_process_lede', true )    ?: "Our investment process is deliberately slow at the front end and decisive at the back. Each step is designed to compound the firm's judgment — and to remove our own behavioral edge cases from the decision.";
$proc_steps   = get_post_meta( $pid, 'rcf_process_steps', true );
if ( empty( $proc_steps ) || ! is_array( $proc_steps ) ) {
	$proc_steps = array(
		array( 'num' => '01', 'title' => 'Sourcing &amp; Screening', 'body' => 'A continuously refreshed universe of catalysts, dislocations, and structurally mispriced businesses — surfaced by sector teams and quantitative screens.' ),
		array( 'num' => '02', 'title' => 'Underwriting',             'body' => 'Multi-week deep dives: management interviews, channel checks, financial modeling, and red-team review by an analyst outside the originating pod.' ),
		array( 'num' => '03', 'title' => 'Portfolio Construction',   'body' => 'Sizing reflects conviction, liquidity, and correlation to existing exposures — checked against firm-wide factor and scenario constraints.' ),
		array( 'num' => '04', 'title' => 'Monitoring &amp; Exit',    'body' => 'Active thesis tracking with pre-defined invalidation criteria. We harvest gains when the original asymmetry is gone — not when it is comfortable.' ),
	);
}

/* ---- Leadership preview — reads from the Team page CMB2 data ---- */
$team_page_results = get_posts( array(
	'post_type'      => 'page',
	'posts_per_page' => 1,
	'meta_query'     => array(
		array( 'key' => '_wp_page_template', 'value' => 'tpl_team.php' ),
	),
) );
$team_page       = ! empty( $team_page_results ) ? $team_page_results[0] : null;
$all_members_raw = $team_page ? get_post_meta( $team_page->ID, 'rcf_team_members_group', true ) : array();
$all_members     = is_array( $all_members_raw ) ? $all_members_raw : array();
$preview_members = array_slice( $all_members, 0, 3 );
$team_url        = $team_page ? get_permalink( $team_page->ID ) : '#';

/* ---- CTA Band (CMB2 fields) ---- */
$cta_eyebrow   = get_post_meta( $pid, 'rcf_home_cta_eyebrow', true )   ?: 'For Qualified Investors';
$cta_heading   = get_post_meta( $pid, 'rcf_home_cta_heading', true )   ?: 'Begin a conversation with our Investor Relations team.';
$cta_lede      = get_post_meta( $pid, 'rcf_home_cta_lede', true )      ?: 'Request the current strategy presentation, or schedule an introductory call with a member of the investment team. All inquiries are reviewed personally and held in confidence.';
$cta_btn1_text = get_post_meta( $pid, 'rcf_home_cta_btn1_text', true ) ?: 'Schedule a Call';
$cta_btn1_url  = get_post_meta( $pid, 'rcf_home_cta_btn1_url', true )  ?: '#';
$cta_btn2_text = get_post_meta( $pid, 'rcf_home_cta_btn2_text', true ) ?: 'Request the Deck';
$cta_btn2_url  = get_post_meta( $pid, 'rcf_home_cta_btn2_url', true )  ?: '#';

$ext_icon = '<svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true" focusable="false" style="margin-left:4px;flex-shrink:0"><path d="M4 1H12V9"/><path d="M12 1L5 8"/><path d="M9 12H1V4"/></svg>';
?>

<div id="page-wrap">

	<!-- ===== HERO ===== -->
	<section class="rcf-hero" aria-label="Hero">
		<?php if ( $hero_img_url ) : ?>
			<div class="rcf-hero__img" style="background-image:url('<?php echo esc_url( $hero_img_url ); ?>');" role="img" aria-hidden="true"></div>
		<?php endif; ?>
		<div class="container">
			<div class="rcf-hero__body">
				<h1><?php echo esc_html( $hero_heading ); ?></h1>
				<div class="rcf-hero__eyebrow-rule" aria-hidden="true"></div>
				<div class="rcf-hero__sub"><?php echo esc_html( $hero_subtitle ); ?></div>
				<p class="rcf-hero__lede"><?php echo esc_html( $hero_lede ); ?></p>
				<div class="rcf-hero__buttons">
					<a href="<?php echo esc_url( $hero_btn1_url ); ?>" class="rcf-btn rcf-btn--light"><?php echo esc_html( $hero_btn1_text ); ?></a>
					<a href="<?php echo esc_url( $hero_btn2_url ); ?>" class="rcf-btn rcf-btn--outline-light"><?php echo esc_html( $hero_btn2_text ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<!-- ===== PILLARS ===== -->
	<section class="rcf-pillars" aria-label="Core investment pillars">
		<div class="container">
			<div class="row g-0">
				<?php foreach ( $home_pillars as $pillar ) :
					$pt = isset( $pillar['title'] )   ? $pillar['title']       : '';
					$pi = isset( $pillar['icon'] )    ? trim( $pillar['icon'] ) : '';
					$pc = isset( $pillar['content'] ) ? $pillar['content']     : '';
				?>
				<div class="rcf-pillar col-12 col-sm-6 col-lg-3">
					<?php if ( $pi ) : ?>
						<div class="rcf-pillar__icon"><i class="fa fa-<?php echo esc_attr( $pi ); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if ( $pt ) : ?><h3><?php echo esc_html( $pt ); ?></h3><?php endif; ?>
					<div class="rcf-pillar__rule" aria-hidden="true"></div>
					<?php echo wp_kses_post( apply_filters( 'the_content', $pc ) ); ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ===== INVESTMENT PHILOSOPHY ===== -->
	<section class="rcf-section rcf-section--cream">
		<div class="container">
			<div class="rcf-philosophy__top row g-5 align-items-end">
				<div class="col-lg-6">
					<div class="rcf-eyebrow">Investment Philosophy</div>
					<h2 class="rcf-h2"><?php echo nl2br( esc_html( $phil_heading ) ); ?></h2>
				</div>
				<div class="col-lg-6">
					<blockquote class="rcf-philosophy__quote">
						<?php echo wp_kses_post( $phil_quote ); ?>
						<cite><?php echo wp_kses_post( $phil_cite ); ?></cite>
					</blockquote>
				</div>
			</div>
			<div class="rcf-tenets row g-0">
				<?php foreach ( $phil_tenets as $tenet ) :
					$tn = isset( $tenet['num'] )   ? $tenet['num']   : '';
					$tt = isset( $tenet['title'] ) ? $tenet['title'] : '';
					$tb = isset( $tenet['body'] )  ? $tenet['body']  : '';
				?>
				<div class="rcf-tenet col-12 col-lg-4">
					<?php if ( $tn ) : ?><div class="rcf-tenet__num"><?php echo esc_html( $tn ); ?></div><?php endif; ?>
					<?php if ( $tt ) : ?><h4><?php echo esc_html( $tt ); ?></h4><?php endif; ?>
					<?php if ( $tb ) : ?><p><?php echo esc_html( $tb ); ?></p><?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ===== HOW WE INVEST ===== -->
	<section class="rcf-process">
		<div class="container">
			<div class="rcf-process__head row g-5 align-items-end">
				<div class="col-lg-6">
					<div class="rcf-eyebrow">How We Invest</div>
					<h2 class="rcf-h2"><?php echo nl2br( esc_html( $proc_heading ) ); ?></h2>
				</div>
				<div class="col-lg-6">
					<p class="rcf-lede"><?php echo esc_html( $proc_lede ); ?></p>
				</div>
			</div>
			<div class="rcf-process__steps row g-0">
				<?php foreach ( $proc_steps as $step ) :
					$sn = isset( $step['num'] )   ? $step['num']   : '';
					$st = isset( $step['title'] ) ? $step['title'] : '';
					$sb = isset( $step['body'] )  ? $step['body']  : '';
				?>
				<div class="rcf-step col-12 col-sm-6 col-lg-3">
					<?php if ( $sn ) : ?><div class="rcf-step__num"><?php echo esc_html( $sn ); ?></div><?php endif; ?>
					<?php if ( $st ) : ?><h4><?php echo wp_kses_post( $st ); ?></h4><?php endif; ?>
					<?php if ( $sb ) : ?><p><?php echo esc_html( $sb ); ?></p><?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ===== LEADERSHIP PREVIEW ===== -->
	<section class="rcf-leadership">
		<div class="container">
			<div class="rcf-leadership__head row g-5 align-items-end">
				<div class="col-lg-6">
					<div class="rcf-eyebrow">Leadership</div>
					<h2 class="rcf-h2">Decades of investment<br>experience, one table.</h2>
				</div>
				<div class="col-lg-6">
					<p class="rcf-body-text" style="max-width:480px;">Our investment committee has spent careers across multi-strategy funds, single-manager platforms, and institutional allocators — and has worked together for the better part of a decade.</p>
					<a href="<?php echo esc_url( $team_url ); ?>" class="rcf-btn rcf-btn--ghost mt-4 d-inline-flex align-items-center">
						Meet the Team <?php echo $ext_icon; ?>
					</a>
				</div>
			</div>
			<div class="row g-4">
				<?php if ( ! empty( $preview_members ) ) : ?>
					<?php foreach ( $preview_members as $member ) :
						$m_name    = isset( $member['name'] )     ? $member['name']     : '';
						$m_role    = isset( $member['role'] )     ? $member['role']     : '';
						$m_bio_raw = isset( $member['bio'] )      ? $member['bio']      : '';
						$m_img_url = isset( $member['portrait'] ) ? $member['portrait'] : '';
						if ( is_numeric( $m_img_url ) ) {
							$m_img_url = wp_get_attachment_image_url( (int) $m_img_url, 'large' ) ?: '';
						}
						$m_short = wp_trim_words( wp_strip_all_tags( $m_bio_raw ), 30, '&hellip;' );
					?>
					<div class="col-12 col-md-6 col-lg-4">
						<div class="rcf-leader-card">
							<div class="rcf-leader-card__img"
								 <?php if ( $m_img_url ) : ?>style="background-image:url('<?php echo esc_url( $m_img_url ); ?>')"<?php endif; ?>
								 role="img"
								 <?php if ( $m_name ) : ?>aria-label="<?php echo esc_attr( $m_name ); ?>"<?php endif; ?>></div>
							<?php if ( $m_role ) : ?><div class="role"><?php echo esc_html( $m_role ); ?></div><?php endif; ?>
							<?php if ( $m_name ) : ?><h3 class="name"><?php echo esc_html( $m_name ); ?></h3><?php endif; ?>
							<?php if ( $m_short ) : ?><p class="bio"><?php echo esc_html( $m_short ); ?></p><?php endif; ?>
						</div>
					</div>
					<?php endforeach; ?>
				<?php else : ?>
					<?php
					$placeholders = array(
						array( 'role' => 'Founder &amp; Chief Investment Officer', 'name' => 'Jonathan A. Rice',    'bio' => 'Founder and CIO. Previously a senior portfolio manager at a $14B multi-strategy fund; began his career on the special situations desk at Goldman Sachs.' ),
						array( 'role' => 'President &amp; Chief Operating Officer','name' => 'Elena Marquez-Hahn', 'bio' => 'President and COO. Built and led operations teams at Citadel and Point72; oversees firm-wide infrastructure, controls, and counterparty relationships.' ),
						array( 'role' => 'Head of Research',                       'name' => 'David S. Whitfield', 'bio' => 'Head of Research. Former portfolio manager at Lone Pine; leads the sector pods and oversees underwriting standards across all strategies.' ),
					);
					foreach ( $placeholders as $ph ) : ?>
					<div class="col-12 col-md-6 col-lg-4">
						<div class="rcf-leader-card">
							<div class="rcf-leader-card__img" aria-hidden="true"></div>
							<div class="role"><?php echo wp_kses_post( $ph['role'] ); ?></div>
							<h3 class="name"><?php echo esc_html( $ph['name'] ); ?></h3>
							<p class="bio"><?php echo esc_html( $ph['bio'] ); ?></p>
						</div>
					</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- ===== CTA BAND ===== -->
	<section class="rcf-cta">
		<div class="container">
			<div class="text-center mx-auto" style="max-width:780px;">
				<div class="rcf-eyebrow justify-content-center"><?php echo esc_html( $cta_eyebrow ); ?></div>
				<h2 class="rcf-h2"><?php echo esc_html( $cta_heading ); ?></h2>
				<p class="rcf-lede mx-auto"><?php echo esc_html( $cta_lede ); ?></p>
				<div class="rcf-cta__buttons">
					<a href="<?php echo esc_url( $cta_btn1_url ?: '#' ); ?>" class="rcf-btn rcf-btn--light"><?php echo esc_html( $cta_btn1_text ); ?></a>
					<a href="<?php echo esc_url( $cta_btn2_url ?: '#' ); ?>" class="rcf-btn rcf-btn--outline-light"><?php echo esc_html( $cta_btn2_text ); ?> <?php echo $ext_icon; ?></a>
				</div>
			</div>
		</div>
	</section>

</div><!-- end page-wrap -->

<?php get_footer(); ?>
