<?php
/*
	Template Name: About Us Template
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
$hero_heading = get_post_meta( $pid, 'rcf_about_hero_heading', true )
	?: "Investing with the\nstandards we\xe2\x80\x99d ask\nof our own capital.";
$hero_sub     = get_post_meta( $pid, 'rcf_about_hero_sub', true )
	?: "Five commitments that define how Rice Capital is governed, measured, and held accountable \xe2\x80\x94 by our LPs, our auditors, and ourselves.";

/* ---- §01 Mission ---- */
$mission_aside_heading = get_post_meta( $pid, 'rcf_about_mission_aside_heading', true )
	?: "Founded in 2014\non a single idea.";
$mission_aside_body    = get_post_meta( $pid, 'rcf_about_mission_aside_body', true )
	?: "That the patient, fundamental investor \xe2\x80\x94 operating in a small, aligned partnership \xe2\x80\x94 could still compound capital better than the institutional machinery they came from.";
$mission_body_1        = get_post_meta( $pid, 'rcf_about_mission_body_1', true )
	?: "We started Rice Capital Fund because we wanted to invest the way we would manage our own family\xe2\x80\x99s money \xe2\x80\x94 slowly, with conviction, and free of the structural pressures that distort large platforms.";
$mission_body_2        = get_post_meta( $pid, 'rcf_about_mission_body_2', true )
	?: "A decade later, that has translated into a deliberately small firm of senior investors, an institutional-grade operational backbone, and a single multi-strategy fund. We have no separate accounts, no co-invest vehicles, and no side pockets \xe2\x80\x94 every investor participates in the same portfolio on the same terms.";
$mission_body_3        = get_post_meta( $pid, 'rcf_about_mission_body_3', true )
	?: 'The pillars that follow are not marketing. They are the commitments we make to every limited partner at the moment of subscription, restated here for the avoidance of doubt.';

/* ---- §02 Stats ---- */
$stats_heading = get_post_meta( $pid, 'rcf_about_stats_heading', true )
	?: "Ten years of\ncompounding, measured.";
$stats_lede    = get_post_meta( $pid, 'rcf_about_stats_lede', true )
	?: "Figures are illustrative placeholders \xe2\x80\x94 please confirm your final numbers before publication. Detailed audited performance is available to qualified investors under NDA.";
$stats_raw     = get_post_meta( $pid, 'rcf_about_stats_items', true );
if ( ! empty( $stats_raw ) && is_array( $stats_raw ) ) {
	$stats_data = $stats_raw;
} else {
	$stats_data = array(
		array( 'value' => '$1.4', 'suffix' => 'B',  'label' => "Assets under\nmanagement" ),
		array( 'value' => '10',   'suffix' => 'YR', 'label' => "Continuous\noperating history" ),
		array( 'value' => '21',   'suffix' => '',   'label' => "Full-time\ninvestment professionals" ),
		array( 'value' => '38',   'suffix' => '%',  'label' => "Firm capital\ninvested in the Fund" ),
	);
}

/* ---- §03 Trust Pillars ----
   CMB2 group stores body_1/body_2 as plain text and items_wysiwyg as HTML.
   Defaults use pre-built HTML for items_html.
--------------------------------------------------------------------- */
$pillars_raw = get_post_meta( $pid, 'rcf_about_trust_pillars', true );
if ( ! empty( $pillars_raw ) && is_array( $pillars_raw ) ) {
	$trust_pillars = array();
	foreach ( $pillars_raw as $p ) {
		$body = array_values( array_filter( array(
			! empty( $p['body_1'] ) ? $p['body_1'] : '',
			! empty( $p['body_2'] ) ? $p['body_2'] : '',
		) ) );
		$items_html = ! empty( $p['items_wysiwyg'] ) ? wp_kses_post( $p['items_wysiwyg'] ) : '';
		$trust_pillars[] = array(
			'num'        => isset( $p['num'] )    ? $p['num']    : '',
			'kicker'     => isset( $p['kicker'] ) ? $p['kicker'] : '',
			'title'      => isset( $p['title'] )  ? $p['title']  : '',
			'body'       => $body,
			'items_html' => $items_html,
		);
	}
} else {
	$trust_pillars = array(
		array(
			'num'        => 'I.',
			'kicker'     => 'Skin in the Game',
			'title'      => 'Alignment of interests, by design.',
			'body'       => array(
				"The principals of Rice Capital have collectively invested the substantial majority of their liquid net worth in the Fund. We do not believe in talking about alignment \xe2\x80\x94 we ensure that when our LPs win or lose a dollar, we feel the same dollar.",
				"Our fee structure reinforces the same principle. The general partner is compensated only above a high-water mark, with a multi-year clawback on incentive allocations and a hard cap on management fee revenue once the Fund crosses a defined AUM threshold.",
			),
			'items_html' => '<ul class="rcf-pillar-list"><li>Principals\xe2\x80\x99 capital represents the firm\xe2\x80\x99s single largest LP</li><li>High-water mark with three-year clawback on incentive fees</li><li>Management fee revenue capped above a defined AUM threshold</li><li>No side-pocket vehicles or differentiated economics for insiders</li></ul>',
		),
		array(
			'num'        => 'II.',
			'kicker'     => 'Reporting & Audit',
			'title'      => 'Audited financials. Transparent reporting.',
			'body'       => array(
				'Rice Capital Fund is audited annually by a Big Four accounting firm. Audited financial statements are delivered to all LPs within 120 days of fiscal year-end, accompanied by full GP commentary.',
				'Beyond the audit, LPs receive monthly performance estimates, mid-month risk and exposure reporting, and an unedited quarterly letter that addresses portfolio mistakes alongside successes.',
			),
			'items_html' => '<ul class="rcf-pillar-list"><li>Annual financial audit by a Big Four firm \xe2\x80\x94 unqualified opinion every year since inception</li><li>Monthly performance estimates, audited NAV within five business days of month-end</li><li>Quarterly LP letter \xe2\x80\x94 published unedited, including discussion of detractors</li><li>Annual in-person Investor Day with full Q&amp;A access to the investment team</li></ul>',
		),
		array(
			'num'        => 'III.',
			'kicker'     => 'Risk Discipline',
			'title'      => 'Risk management as a first-class function.',
			'body'       => array(
				"Risk is not a reporting function at Rice Capital \xe2\x80\x94 it is an independent decision-maker. Our Head of Risk reports directly to the Investment Committee and has the authority to reduce or unwind any position that exceeds firm-wide budgets, regardless of the originating portfolio manager.",
				'Daily VaR, factor exposure, stress, and liquidity reports are produced by a team that sits outside the portfolio management function. Pre-defined invalidation criteria are attached to every position at initiation.',
			),
			'items_html' => '<ul class="rcf-pillar-list"><li>Independent Head of Risk reporting directly to the Investment Committee</li><li>Daily VaR, factor, scenario, and liquidity reporting \xe2\x80\x94 pre-defined firm-wide budgets</li><li>Pre-defined invalidation thesis attached to every position at inception</li><li>Quarterly external stress tests run by an institutional risk-analytics partner</li></ul>',
		),
		array(
			'num'        => 'IV.',
			'kicker'     => 'Track Record',
			'title'      => 'A decade of compounding through cycles.',
			'body'       => array(
				"Rice Capital has operated continuously since 2014. The Fund has navigated multiple regime changes \xe2\x80\x94 the 2015\xe2\x80\x9316 commodity drawdown, the 2020 pandemic dislocation, the 2022 rate shock \xe2\x80\x94 without breaching any drawdown or liquidity covenant, and without altering its core investment process.",
				'Our long-term annualized return materially exceeds the relevant hedge fund benchmarks at lower realized volatility. Detailed, audited performance attribution is available to qualified investors under NDA.',
			),
			'items_html' => '<ul class="rcf-pillar-list"><li>Continuous operating history since 2014 \xe2\x80\x94 same investment process</li><li>No suspended redemptions, gates, or side-pocket conversions through any market regime</li><li>Independent attribution analysis available to qualified investors under NDA</li><li>Strategy capacity is monitored monthly and the Fund will close to new capital as warranted</li></ul>',
		),
		array(
			'num'        => 'V.',
			'kicker'     => 'Service Providers',
			'title'      => 'Independent, institutional infrastructure.',
			'body'       => array(
				"We deliberately use the same institutional-grade service providers that the largest allocators expect when conducting operational due diligence. Custody, prime brokerage, administration, audit, and legal are all independent of the firm \xe2\x80\x94 no related-party arrangements anywhere in the stack.",
				"Our prime brokerage relationships are diversified across three tier-one counterparties, with daily reconciliation between the administrator\xe2\x80\x99s books and counterparty records.",
			),
			'items_html' => '<ul class="rcf-pillar-list"><li>Custody and prime brokerage diversified across three tier-one counterparties</li><li>Independent fund administrator strikes the official NAV \xe2\x80\x94 full daily reconciliation</li><li>Big Four auditor; long-standing engagement letter with no scope limitations</li><li>SEC-registered investment adviser; ADV Parts 1 and 2 available on request</li></ul>',
		),
	);
}

/* ---- §04 Service Providers ----
   Default names use \n; always rendered with nl2br(esc_html()).
--------------------------------------------------------------------- */
$providers_raw = get_post_meta( $pid, 'rcf_about_providers', true );
if ( ! empty( $providers_raw ) && is_array( $providers_raw ) ) {
	$service_providers = $providers_raw;
} else {
	$service_providers = array(
		array( 'role' => 'Auditor',               'name' => "[ Big Four\nAudit Firm ]",             'note' => "Engagement since inception \xc2\xb7 Unqualified opinion every year" ),
		array( 'role' => 'Administrator',         'name' => "[ Independent\nFund Admin ]",          'note' => "Strikes official NAV \xc2\xb7 Daily counterparty reconciliation" ),
		array( 'role' => 'Prime Brokerage',       'name' => "[ Tier-One\nPrime \xc3\x973 ]",        'note' => 'Diversified across three tier-one counterparties' ),
		array( 'role' => 'Legal Counsel',         'name' => "[ Institutional\nFund Counsel ]",      'note' => 'Fund formation, ongoing regulatory, and LP-side counsel' ),
		array( 'role' => 'Custodian',             'name' => "[ Qualified\nCustodian ]",             'note' => 'Securities and cash held in segregated client accounts' ),
		array( 'role' => 'Compliance Consultant', 'name' => "[ Outsourced\nCompliance ]",           'note' => "Independent annual review \xc2\xb7 Mock SEC exam program" ),
		array( 'role' => 'Cybersecurity',         'name' => "[ Managed\nDetection & Response ]",   'note' => "24/7 SOC monitoring \xc2\xb7 Annual penetration testing" ),
		array( 'role' => 'Regulatory',            'name' => "SEC Registered\nInvestment Adviser",  'note' => 'Form ADV Parts 1 & 2 available on request' ),
	);
}

/* ---- CTA ---- */
$cta_eyebrow   = get_post_meta( $pid, 'rcf_about_cta_eyebrow', true )   ?: 'Operational Due Diligence';
$cta_heading   = get_post_meta( $pid, 'rcf_about_cta_heading', true )   ?: 'Request the full diligence pack.';
$cta_lede      = get_post_meta( $pid, 'rcf_about_cta_lede', true )      ?: "DDQ, service-provider letters, ADV filings, audited financials, and a redacted sample of our monthly risk report \xe2\x80\x94 released to qualified investors under standard NDA.";
$cta_btn1_text = get_post_meta( $pid, 'rcf_about_cta_btn1_text', true ) ?: 'Request the Diligence Pack';
$cta_btn1_url  = get_post_meta( $pid, 'rcf_about_cta_btn1_url', true )  ?: '#';
$cta_btn2_text = get_post_meta( $pid, 'rcf_about_cta_btn2_text', true ) ?: 'Speak with IR';
$cta_btn2_url  = get_post_meta( $pid, 'rcf_about_cta_btn2_url', true )  ?: '#';
$cta_btn1_class = get_post_meta( $pid, 'rcf_about_cta_btn1_class', true ) ?: 'rcf-btn rcf-btn--light';
$cta_btn2_class = get_post_meta( $pid, 'rcf_about_cta_btn2_class', true ) ?: 'rcf-btn rcf-btn--outline-light';
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

	<!-- ===== §01 MISSION ===== -->
	<section class="rcf-mission">
		<div class="container">
			<div class="row g-5 align-items-start">
				<div class="col-lg-4">
					<div class="rcf-mission__aside">
						<div class="rcf-section-num" aria-hidden="true">01</div>
						<div class="rcf-eyebrow">Our Story</div>
						<h2 class="rcf-h2"><?php echo nl2br( esc_html( $mission_aside_heading ) ); ?></h2>
						<p class="rcf-body-text mt-4" style="max-width:380px;"><?php echo esc_html( $mission_aside_body ); ?></p>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="rcf-mission__text">
						<?php if ( $mission_body_1 ) : ?><p><?php echo esc_html( $mission_body_1 ); ?></p><?php endif; ?>
						<?php if ( $mission_body_2 ) : ?><p><?php echo esc_html( $mission_body_2 ); ?></p><?php endif; ?>
						<?php if ( $mission_body_3 ) : ?><p><?php echo esc_html( $mission_body_3 ); ?></p><?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ===== §02 STATS BAND ===== -->
	<section class="rcf-stats">
		<div class="container">
			<div class="rcf-stats__head row g-5 align-items-end">
				<div class="col-lg-6">
					<div class="rcf-section-num" aria-hidden="true">02</div>
					<div class="rcf-eyebrow">By the Numbers</div>
					<h2 class="rcf-h2"><?php echo nl2br( esc_html( $stats_heading ) ); ?></h2>
				</div>
				<div class="col-lg-6">
					<p class="rcf-lede"><?php echo esc_html( $stats_lede ); ?></p>
				</div>
			</div>
			<div class="rcf-stats__grid row g-0">
				<?php foreach ( $stats_data as $stat ) :
					$sv = isset( $stat['value'] )  ? $stat['value']  : '';
					$ss = isset( $stat['suffix'] ) ? $stat['suffix'] : '';
					$sl = isset( $stat['label'] )  ? $stat['label']  : '';
				?>
				<div class="rcf-stat col-6 col-lg-3">
					<div class="rcf-stat__value">
						<?php echo esc_html( $sv ); ?><?php if ( $ss ) : ?><span class="small"><?php echo esc_html( $ss ); ?></span><?php endif; ?>
					</div>
					<div class="rcf-stat__label"><?php echo nl2br( esc_html( $sl ) ); ?></div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ===== §03 FIVE TRUST PILLARS ===== -->
	<section class="rcf-pillars-deep">
		<div class="container">
			<div class="rcf-pillars-deep__head">
				<div class="rcf-section-num" aria-hidden="true">03</div>
				<div class="rcf-eyebrow">Why Rice Capital</div>
				<h2 class="rcf-h2">Five commitments that<br>define how we operate.</h2>
			</div>
			<?php foreach ( $trust_pillars as $pillar ) :
				$p_num        = isset( $pillar['num'] )        ? $pillar['num']        : '';
				$p_kicker     = isset( $pillar['kicker'] )     ? $pillar['kicker']     : '';
				$p_title      = isset( $pillar['title'] )      ? $pillar['title']      : '';
				$p_body       = isset( $pillar['body'] ) && is_array( $pillar['body'] ) ? $pillar['body'] : array();
				$p_items_html = isset( $pillar['items_html'] ) ? $pillar['items_html'] : '';
			?>
			<div class="rcf-pillar-row">
				<div class="rcf-pillar-row__num"><?php echo esc_html( $p_num ); ?></div>
				<div class="rcf-pillar-row__title">
					<div class="kicker"><?php echo esc_html( $p_kicker ); ?></div>
					<h3><?php echo esc_html( $p_title ); ?></h3>
				</div>
				<div class="rcf-pillar-row__body">
					<?php foreach ( $p_body as $para ) : ?>
						<p><?php echo esc_html( $para ); ?></p>
					<?php endforeach; ?>
					<?php if ( $p_items_html ) : ?>
					<div class="rcf-pillar-row__items"><?php echo $p_items_html; ?></div>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- ===== §04 SERVICE PROVIDERS ===== -->
	<section class="rcf-providers">
		<div class="container">
			<div class="rcf-providers__head row g-5 align-items-end">
				<div class="col-lg-6">
					<div class="rcf-section-num" aria-hidden="true">04</div>
					<div class="rcf-eyebrow">Institutional Infrastructure</div>
					<h2 class="rcf-h2">Our service providers.</h2>
				</div>
				<div class="col-lg-5">
					<p class="rcf-body-text" style="max-width:420px;">Independent counterparties with no related-party arrangements. Full operational due-diligence documentation available on request.</p>
				</div>
			</div>
			<div class="rcf-providers__grid">
				<?php foreach ( $service_providers as $provider ) :
					$pr_role = isset( $provider['role'] ) ? $provider['role'] : '';
					$pr_name = isset( $provider['name'] ) ? $provider['name'] : '';
					$pr_note = isset( $provider['note'] ) ? $provider['note'] : '';
				?>
				<div class="rcf-provider">
					<div class="rcf-provider__role"><?php echo esc_html( $pr_role ); ?></div>
					<div class="rcf-provider__name"><?php echo nl2br( esc_html( $pr_name ) ); ?></div>
					<div class="rcf-provider__note"><?php echo esc_html( $pr_note ); ?></div>
				</div>
				<?php endforeach; ?>
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
