<?php
/*
	Template Name: Investment Approach Template
*/
?>
<?php get_header(); ?>
<?php
if ( have_posts() ) : the_post(); endif;
$pid             = get_the_ID();
$subhero_img_url = get_the_post_thumbnail_url( $pid, 'full' ) ?: '';
$ext_icon        = '<svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true" focusable="false" style="margin-left:4px;flex-shrink:0"><path d="M4 1H12V9"/><path d="M12 1L5 8"/><path d="M9 12H1V4"/></svg>';

/* =====================================================================
   READ ALL CMB2 FIELDS — fall back to built-in defaults when empty
   ===================================================================== */

/* ---- Sub-hero ---- */
$hero_heading = get_post_meta( $pid, 'rcf_ia_hero_heading', true )
	?: "A multi-strategy approach\nfocused on risk and reward.";
$hero_sub     = get_post_meta( $pid, 'rcf_ia_hero_sub', true )
	?: 'Research driven. Risk aware. Opportunistic. A disciplined framework for finding asymmetry across public markets — and protecting capital when the odds turn.';

/* ---- §01 Overview ---- */
$ov_eyebrow = get_post_meta( $pid, 'rcf_ia_overview_eyebrow', true ) ?: 'Our Approach';
$ov_heading = get_post_meta( $pid, 'rcf_ia_overview_heading', true ) ?: "Research driven.\nRisk aware.\nOpportunistic.";
$ov_body_1  = get_post_meta( $pid, 'rcf_ia_overview_body_1', true )  ?: 'Rice Capital evaluates opportunities across public markets using fundamentals, valuation, technical structure, macro conditions, liquidity, and catalysts.';
$ov_body_2  = get_post_meta( $pid, 'rcf_ia_overview_body_2', true )  ?: 'The objective is to identify attractive risk/reward opportunities while maintaining a strong focus on portfolio construction, drawdown control, and capital preservation.';

/* ---- §02 What we evaluate (lenses) ---- */
$lenses_eyebrow = get_post_meta( $pid, 'rcf_ia_lenses_eyebrow', true ) ?: 'What We Evaluate';
$lenses_heading = get_post_meta( $pid, 'rcf_ia_lenses_heading', true ) ?: 'Six lenses on every position.';
$lenses_lede    = get_post_meta( $pid, 'rcf_ia_lenses_lede', true )    ?: 'No single factor earns a position a place in the book. Each opportunity is pressure-tested across the same six dimensions before it is sized.';
$lenses_raw     = get_post_meta( $pid, 'rcf_ia_lenses', true );
if ( ! empty( $lenses_raw ) && is_array( $lenses_raw ) ) {
	$lenses = $lenses_raw;
} else {
	$lenses = array(
		array( 'label' => 'Fundamentals',       'desc' => 'Business quality, balance-sheet strength, and the durability of earnings power.' ),
		array( 'label' => 'Valuation',          'desc' => 'What we pay relative to intrinsic value — and the margin of safety it affords.' ),
		array( 'label' => 'Technical Structure', 'desc' => 'Positioning, flows, and the market structure surrounding a security.' ),
		array( 'label' => 'Macro Conditions',   'desc' => 'The rate, liquidity, and cycle backdrop that frames every opportunity.' ),
		array( 'label' => 'Liquidity',          'desc' => 'The ability to enter and exit at scale without impairing the thesis.' ),
		array( 'label' => 'Catalysts',          'desc' => 'The identifiable events expected to close the gap between price and value.' ),
	);
}

/* ---- §03 The process ---- */
$proc_eyebrow = get_post_meta( $pid, 'rcf_ia_process_eyebrow', true ) ?: 'The Process';
$proc_heading = get_post_meta( $pid, 'rcf_ia_process_heading', true ) ?: "From idea to position,\nby a repeatable path.";
$proc_lede    = get_post_meta( $pid, 'rcf_ia_process_lede', true )    ?: 'Every position travels the same four stages — deliberate at the front end, disciplined at the back.';
$proc_raw     = get_post_meta( $pid, 'rcf_ia_process_steps', true );
if ( ! empty( $proc_raw ) && is_array( $proc_raw ) ) {
	$proc_steps = $proc_raw;
} else {
	$proc_steps = array(
		array( 'num' => '01', 'title' => 'Idea Generation',       'body' => 'Market dislocations, earnings trends, sector rotations, volatility, and macro shifts.' ),
		array( 'num' => '02', 'title' => 'Research',              'body' => 'Valuation, catalysts, structure, liquidity, and downside risk.' ),
		array( 'num' => '03', 'title' => 'Portfolio Construction', 'body' => 'Exposure, sizing, liquidity, correlation, and concentration.' ),
		array( 'num' => '04', 'title' => 'Risk Management',       'body' => 'Position sizing, hedging where appropriate, and ongoing review.' ),
	);
}

/* ---- CTA ---- */
$cta_eyebrow   = get_post_meta( $pid, 'rcf_ia_cta_eyebrow', true )   ?: 'For Qualified Investors';
$cta_heading   = get_post_meta( $pid, 'rcf_ia_cta_heading', true )   ?: 'See the approach applied.';
$cta_lede      = get_post_meta( $pid, 'rcf_ia_cta_lede', true )      ?: 'Request the current strategy presentation, or speak with our Investor Relations team about how the process translates into the live portfolio.';
$cta_btn1_text = get_post_meta( $pid, 'rcf_ia_cta_btn1_text', true ) ?: 'Request the Deck';
$cta_btn1_url  = get_post_meta( $pid, 'rcf_ia_cta_btn1_url', true )  ?: '#';
$cta_btn2_text = get_post_meta( $pid, 'rcf_ia_cta_btn2_text', true ) ?: 'Speak with IR';
$cta_btn2_url  = get_post_meta( $pid, 'rcf_ia_cta_btn2_url', true )  ?: '#';
$cta_btn1_class = get_post_meta( $pid, 'rcf_ia_cta_btn1_class', true ) ?: 'rcf-btn rcf-btn--light';
$cta_btn2_class = get_post_meta( $pid, 'rcf_ia_cta_btn2_class', true ) ?: 'rcf-btn rcf-btn--outline-light';
?>

<div id="page-wrap">

	<!-- ===== SUB-HERO ===== -->
	<section class="rcf-subhero">
		<?php if ( $subhero_img_url ) : ?>
			<div class="rcf-subhero__bg" style="background-image:url('<?php echo esc_url( $subhero_img_url ); ?>');" role="img" aria-hidden="true"></div>
		<?php endif; ?>
		<div class="container">
			<nav class="rcf-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Rice Capital Fund</a>
				<span class="sep" aria-hidden="true">/</span>
				<span class="cur"><?php the_title(); ?></span>
			</nav>
			<h1><?php echo nl2br( esc_html( $hero_heading ) ); ?></h1>
			<div class="rcf-subhero__rule" aria-hidden="true"></div>
			<p class="rcf-subhero__sub"><?php echo esc_html( $hero_sub ); ?></p>
		</div>
	</section>

	<!-- ===== §01 OVERVIEW ===== -->
	<section class="rcf-approach-overview">
		<div class="container">
			<div class="row g-5 align-items-start">
				<div class="col-lg-5">
					<div class="rcf-approach-overview__aside">
						<div class="rcf-section-num" aria-hidden="true">01</div>
						<div class="rcf-eyebrow"><?php echo esc_html( $ov_eyebrow ); ?></div>
						<h2 class="rcf-h2"><?php echo nl2br( esc_html( $ov_heading ) ); ?></h2>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="rcf-approach-overview__text">
						<?php if ( $ov_body_1 ) : ?><p class="rcf-lead-para"><?php echo esc_html( $ov_body_1 ); ?></p><?php endif; ?>
						<?php if ( $ov_body_2 ) : ?><p><?php echo esc_html( $ov_body_2 ); ?></p><?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ===== §02 WHAT WE EVALUATE ===== -->
	<?php if ( ! empty( $lenses ) ) : ?>
	<section class="rcf-lenses">
		<div class="container">
			<div class="rcf-lenses__head row g-5 align-items-end">
				<div class="col-lg-7">
					<div class="rcf-section-num" aria-hidden="true">02</div>
					<div class="rcf-eyebrow"><?php echo esc_html( $lenses_eyebrow ); ?></div>
					<h2 class="rcf-h2"><?php echo nl2br( esc_html( $lenses_heading ) ); ?></h2>
				</div>
				<div class="col-lg-5">
					<p class="rcf-body-text" style="max-width:440px;"><?php echo esc_html( $lenses_lede ); ?></p>
				</div>
			</div>
			<div class="rcf-lenses__grid">
				<?php foreach ( $lenses as $i => $lens ) :
					$l_label = isset( $lens['label'] ) ? $lens['label'] : '';
					$l_desc  = isset( $lens['desc'] )  ? $lens['desc']  : '';
				?>
				<div class="rcf-lens">
					<div class="rcf-lens__idx" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></div>
					<?php if ( $l_label ) : ?><h3 class="rcf-lens__label"><?php echo esc_html( $l_label ); ?></h3><?php endif; ?>
					<?php if ( $l_desc ) : ?><p class="rcf-lens__desc"><?php echo esc_html( $l_desc ); ?></p><?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== §03 THE PROCESS ===== -->
	<?php if ( ! empty( $proc_steps ) ) : ?>
	<section class="rcf-process rcf-process--approach">
		<div class="container">
			<div class="rcf-process__head row g-5 align-items-end">
				<div class="col-lg-6">
					<div class="rcf-section-num rcf-section-num--light" aria-hidden="true">03</div>
					<div class="rcf-eyebrow"><?php echo esc_html( $proc_eyebrow ); ?></div>
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
					<?php if ( $st ) : ?><h4><?php echo esc_html( $st ); ?></h4><?php endif; ?>
					<?php if ( $sb ) : ?><p><?php echo esc_html( $sb ); ?></p><?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== CTA BAND ===== -->
	<section class="rcf-cta">
		<div class="container">
			<div class="text-center mx-auto" style="max-width:780px;">
				<div class="rcf-eyebrow justify-content-center"><?php echo esc_html( $cta_eyebrow ); ?></div>
				<h2 class="rcf-h2"><?php echo esc_html( $cta_heading ); ?></h2>
				<p class="rcf-lede mx-auto"><?php echo esc_html( $cta_lede ); ?></p>
				<div class="rcf-cta__buttons">
					<a href="<?php echo esc_url( $cta_btn1_url ?: '#' ); ?>" class="<?php echo esc_attr( $cta_btn1_class ); ?>">
						<?php echo esc_html( $cta_btn1_text ); ?>
					</a>
					<a href="<?php echo esc_url( $cta_btn2_url ?: '#' ); ?>" class="<?php echo esc_attr( $cta_btn2_class ); ?>">
						<?php echo esc_html( $cta_btn2_text ); ?> <?php echo $ext_icon; ?>
					</a>
				</div>
			</div>
		</div>
	</section>

</div><!-- end page-wrap -->

<?php get_footer(); ?>
