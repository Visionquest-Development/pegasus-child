<?php
/*
	Template Name: Team Template
*/
?>
<?php get_header(); ?>
<?php
if ( have_posts() ) : the_post(); endif;
$pid = get_the_ID();

/* ---- Team page settings (CMB2 fields) ---- */
$intro_headline = get_post_meta( $pid, 'rcf_team_page_intro_headline', true ) ?: 'Six partners. One investment culture.';
$intro_body_1   = get_post_meta( $pid, 'rcf_team_page_intro_body_1', true )   ?: "Rice Capital is intentionally small. Every partner sits in the investment dialogue, owns an explicit slice of the firm's economics, and has personal capital alongside our LPs. We hire slowly, train deeply, and turn over rarely — most of our team has worked together for more than seven years.";
$intro_body_2   = get_post_meta( $pid, 'rcf_team_page_intro_body_2', true )   ?: 'What follows is the full investment leadership of the firm. Anyone you meet at Rice Capital is empowered to speak for the firm — there is no second tier.';
$cta_eyebrow    = get_post_meta( $pid, 'rcf_team_page_cta_eyebrow', true )    ?: 'Beyond Investment Leadership';
$cta_heading    = get_post_meta( $pid, 'rcf_team_page_cta_heading', true )    ?: 'A 21-person team supporting every position we hold.';
$cta_lede       = get_post_meta( $pid, 'rcf_team_page_cta_lede', true )       ?: 'Sector analysts, risk, operations, compliance, technology, and investor relations — full team biographies are available upon request through our IR group.';
$cta_btn_text   = get_post_meta( $pid, 'rcf_team_page_cta_btn_text', true )   ?: 'Contact Investor Relations';
$cta_btn_url    = get_post_meta( $pid, 'rcf_team_page_cta_btn_url', true )    ?: '#';
$cta_btn_class  = get_post_meta( $pid, 'rcf_team_page_cta_btn_class', true )  ?: 'rcf-btn rcf-btn--light';

/* ---- Team members (CMB2 group — rcf_team_members_group) ---- */
$members_raw = get_post_meta( $pid, 'rcf_team_members_group', true );
$members     = is_array( $members_raw ) ? $members_raw : array();

/* ---- Page editor content (rendered via the_content below) ---- */
$has_page_content = trim( wp_strip_all_tags( get_the_content() ) ) !== '';

$subhero_img_url = get_the_post_thumbnail_url( $pid, 'full' ) ?: '';

$ext_icon = '<svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true" focusable="false" style="margin-left:4px;flex-shrink:0"><path d="M4 1H12V9"/><path d="M12 1L5 8"/><path d="M9 12H1V4"/></svg>';
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
			<h1>The people behind<br>the portfolio.</h1>
			<div class="rcf-subhero__rule" aria-hidden="true"></div>
			<p class="rcf-subhero__sub">A senior, low-ego investment team that has worked together for the better part of a decade — across multi-strategy funds, single-manager platforms, and institutional allocators.</p>
		</div>
	</section>

	<!-- ===== TEAM INTRO ===== -->
	<section class="rcf-team-intro">
		<div class="container">
			<div class="row g-5 align-items-start">
				<div class="col-lg-5">
					<div class="rcf-eyebrow">Our Team</div>
					<h2 class="rcf-h2"><?php echo nl2br( esc_html( $intro_headline ) ); ?></h2>
				</div>
				<div class="col-lg-7">
					<?php if ( $intro_body_1 ) : ?>
						<p class="rcf-body-text" style="font-size:17px;line-height:1.76;"><?php echo esc_html( $intro_body_1 ); ?></p>
					<?php endif; ?>
					<?php if ( $intro_body_2 ) : ?>
						<p class="rcf-body-text mt-4" style="font-size:17px;line-height:1.76;"><?php echo esc_html( $intro_body_2 ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- ===== TEAM ROWS ===== -->
	<section class="rcf-team-rows">
		<div class="container">
			<?php if ( ! empty( $members ) ) : ?>
				<?php foreach ( $members as $idx => $member ) :
					$m_name       = isset( $member['name'] )         ? $member['name']        : '';
					$m_role       = isset( $member['role'] )         ? $member['role']        : '';
					$m_credential = isset( $member['credential'] )   ? $member['credential']  : '';
					$m_bio        = isset( $member['bio'] )          ? $member['bio']         : '';
					$m_img_url    = isset( $member['portrait'] )     ? $member['portrait']    : '';
					$m_meta1_v    = isset( $member['meta_1_value'] ) ? $member['meta_1_value']: '';
					$m_meta1_l    = isset( $member['meta_1_label'] ) ? $member['meta_1_label']: '';
					$m_meta2_v    = isset( $member['meta_2_value'] ) ? $member['meta_2_value']: '';
					$m_meta2_l    = isset( $member['meta_2_label'] ) ? $member['meta_2_label']: '';
					$m_meta3_v    = isset( $member['meta_3_value'] ) ? $member['meta_3_value']: '';
					$m_meta3_l    = isset( $member['meta_3_label'] ) ? $member['meta_3_label']: '';
					// CMB2 file field stores URL by default; if numeric treat as attachment ID.
					if ( is_numeric( $m_img_url ) ) {
						$m_img_url = wp_get_attachment_image_url( (int) $m_img_url, 'large' ) ?: '';
					}
					$rev_class = ( $idx % 2 === 1 ) ? ' rcf-team-row--rev' : '';
					$metas = array();
					if ( $m_meta1_v || $m_meta1_l ) $metas[] = array( $m_meta1_v, $m_meta1_l );
					if ( $m_meta2_v || $m_meta2_l ) $metas[] = array( $m_meta2_v, $m_meta2_l );
					if ( $m_meta3_v || $m_meta3_l ) $metas[] = array( $m_meta3_v, $m_meta3_l );
				?>
				<div class="rcf-team-row<?php echo esc_attr( $rev_class ); ?>">
					<div class="rcf-team-row__portrait"
						 <?php if ( $m_img_url ) : ?>style="background-image:url('<?php echo esc_url( $m_img_url ); ?>')"<?php endif; ?>
						 role="img"
						 <?php if ( $m_name ) : ?>aria-label="<?php echo esc_attr( 'Portrait of ' . $m_name ); ?>"<?php endif; ?>></div>
					<div class="rcf-team-row__bio">
						<?php if ( $m_role ) : ?><div class="rcf-team-row__role"><?php echo esc_html( $m_role ); ?></div><?php endif; ?>
						<?php if ( $m_name ) : ?><h2 class="rcf-team-row__name"><?php echo esc_html( $m_name ); ?></h2><?php endif; ?>
						<?php if ( $m_credential ) : ?><div class="rcf-team-row__credential"><?php echo esc_html( $m_credential ); ?></div><?php endif; ?>
						<?php if ( $m_bio ) : ?>
							<div class="rcf-team-row__bio-text"><?php echo wp_kses_post( apply_filters( 'the_content', $m_bio ) ); ?></div>
						<?php endif; ?>
						<?php if ( ! empty( $metas ) ) : ?>
						<div class="rcf-team-row__meta">
							<?php foreach ( $metas as $meta ) : ?>
							<div class="rcf-team-row__meta-item">
								<strong><?php echo esc_html( $meta[0] ); ?></strong>
								<?php echo esc_html( $meta[1] ); ?>
							</div>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endforeach; ?>
			<?php else : ?>
				<p class="py-5 text-center" style="color:var(--rc-ink-3);">
					Team members will appear here once added via the <strong>Team Members</strong> panel in WordPress admin.
				</p>
			<?php endif; ?>
		</div>
	</section>

	<!-- ===== EDITORIAL NOTE (WordPress editor content via the_content) ===== -->
	<?php if ( $has_page_content ) : ?>
	<section class="rcf-team-note">
		<div class="container">
			<div class="rcf-team-note__inner">
				<div class="rcf-eyebrow justify-content-center">In Their Own Words</div>
				<div class="rcf-team-note__rule" aria-hidden="true"></div>
				<div class="rcf-team-note__body rcf-prose">
					<?php the_content(); ?>
				</div>
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
					<a href="<?php echo esc_url( $cta_btn_url ?: '#' ); ?>" class="<?php echo esc_attr( $cta_btn_class ); ?>"><?php echo esc_html( $cta_btn_text ); ?></a>
				</div>
			</div>
		</div>
	</section>

</div><!-- end page-wrap -->

<?php get_footer(); ?>
