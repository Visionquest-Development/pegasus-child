<?php
/*
	Template Name: Pegasus Home
*/

/**
 * Pegasus Home page template.
 *
 * Bootstrap 5 markup driven by the CMB2 fields registered in
 * inc/cmb2-homepage-fields.php. Every value falls back to the Claude Design
 * defaults until real content is saved. Header and footer are handled by the
 * parent theme / theme options — this template only renders the page body.
 *
 * @package Pegasus_Child
 */

get_header();

$pegasus_home_id = get_the_ID();

// Guard: if the include was not loaded, define no-op fallbacks so the page
// still renders rather than fatally erroring.
if ( ! function_exists( 'pegasus_home_field' ) ) {
	require_once get_stylesheet_directory() . '/inc/cmb2-homepage-fields.php';
}

/**
 * Small helpers scoped to this template.
 */
if ( ! function_exists( 'pegasus_home_tags' ) ) {
	/**
	 * Turn a comma-separated string into a trimmed array of pills.
	 *
	 * @param string $tags Comma separated tags.
	 * @return array
	 */
	function pegasus_home_tags( $tags ) {
		if ( empty( $tags ) ) {
			return array();
		}
		return array_filter( array_map( 'trim', explode( ',', $tags ) ) );
	}
}

$hero_image = get_post_meta( $pegasus_home_id, 'pegasus_home_hero_image', true );

// On-page sections, used for the scrollspy dot-nav. The theme's sidebar/nav
// links are swapped to these same anchors via inc/section-nav.php.
$pegasus_home_nav = array(
	array( 'id' => 'home',     'label' => __( 'Home', 'pegasus-child' ) ),
	array( 'id' => 'overview', 'label' => __( 'Overview', 'pegasus-child' ) ),
	array( 'id' => 'install',  'label' => __( 'Install', 'pegasus-child' ) ),
	array( 'id' => 'plugins',  'label' => __( 'Plugins', 'pegasus-child' ) ),
	array( 'id' => 'docs',     'label' => __( 'Docs', 'pegasus-child' ) ),
);
?>

<div id="page-wrap">
	<div class="pegasus-home">

		<?php /* ============================ HERO ============================ */ ?>
		<section id="home" class="ph-hero">
			<div class="ph-hero-bg" aria-hidden="true">
				<span class="ph-hero-aurora"></span>
				<span class="ph-hero-sun"></span>
				<span class="ph-hero-grid"></span>
				<span class="ph-hero-stars"></span>
			</div>

			<div class="container ph-hero-inner">
				<div class="row align-items-center g-5">
					<div class="col-lg-7 order-2 order-lg-1 ph-hero-copy">
						<?php $hero_badge = pegasus_home_field( $pegasus_home_id, 'hero_badge' ); ?>
						<?php if ( $hero_badge ) : ?>
							<span class="ph-badge">
								<span class="ph-badge-star">✦</span>
								<span class="ph-badge-text"><?php echo esc_html( $hero_badge ); ?></span>
							</span>
						<?php endif; ?>

						<h1 class="ph-hero-title">
							<?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'hero_heading_before' ) ); ?>
							<span class="ph-gradient"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'hero_heading_accent' ) ); ?></span><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'hero_heading_after' ) ); ?>
						</h1>

						<p class="ph-hero-lead"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'hero_text' ) ); ?></p>

						<?php $hero_buttons = pegasus_home_group( $pegasus_home_id, 'hero_buttons' ); ?>
						<?php if ( $hero_buttons ) : ?>
							<div class="ph-hero-actions">
								<?php foreach ( $hero_buttons as $btn ) : ?>
									<?php
									$btn_style = isset( $btn['style'] ) && 'ghost' === $btn['style'] ? 'ph-btn-ghost' : 'ph-btn-primary';
									$btn_url   = ! empty( $btn['url'] ) ? $btn['url'] : '#';
									$btn_icon  = ! empty( $btn['icon'] ) ? $btn['icon'] : '';
									?>
									<a class="ph-btn <?php echo esc_attr( $btn_style ); ?>" href="<?php echo esc_url( $btn_url ); ?>">
										<?php if ( $btn_icon ) : ?><i class="<?php echo esc_attr( $btn_icon ); ?>" aria-hidden="true"></i><?php endif; ?>
										<span><?php echo esc_html( $btn['label'] ?? '' ); ?></span>
									</a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<?php $hero_stats = pegasus_home_group( $pegasus_home_id, 'hero_stats' ); ?>
						<?php if ( $hero_stats ) : ?>
							<div class="row row-cols-auto ph-hero-stats">
								<?php foreach ( $hero_stats as $stat ) : ?>
									<div class="col">
										<div class="ph-stat-num <?php echo esc_attr( pegasus_home_accent_class( isset( $stat['accent'] ) ? $stat['accent'] : 'green' ) ); ?>"><?php echo esc_html( $stat['number'] ?? '' ); ?></div>
										<div class="ph-stat-label"><?php echo esc_html( $stat['label'] ?? '' ); ?></div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="col-lg-5 order-1 order-lg-2 ph-hero-art-col">
						<div class="ph-hero-art">
							<div class="ph-hero-art-box">
								<?php if ( $hero_image ) : ?>
									<img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="ph-hero-img" />
								<?php else : ?>
									<span class="ph-hero-img-placeholder">Pegasus</span>
								<?php endif; ?>
							</div>
							<?php $hero_caption = pegasus_home_field( $pegasus_home_id, 'hero_image_caption' ); ?>
							<?php if ( $hero_caption ) : ?>
								<span class="ph-hero-art-caption"><?php echo esc_html( $hero_caption ); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php /* ========================== OVERVIEW ========================== */ ?>
		<section id="overview" class="ph-section ph-section--mid">
			<div class="container">
				<div class="ph-section-head text-center">
					<div class="ph-eyebrow ph-accent-green"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'overview_eyebrow' ) ); ?></div>
					<h2 class="ph-h2"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'overview_heading' ) ); ?></h2>
					<p class="ph-section-lead"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'overview_text' ) ); ?></p>
				</div>

				<?php $overview_cards = pegasus_home_group( $pegasus_home_id, 'overview_cards' ); ?>
				<div class="row g-4">
					<?php foreach ( $overview_cards as $card ) : ?>
						<?php $accent = pegasus_home_accent_class( isset( $card['accent'] ) ? $card['accent'] : 'green' ); ?>
						<div class="col-md-6">
							<div class="ph-card ph-card--overview <?php echo esc_attr( $accent ); ?>">
								<span class="ph-card-topbar" aria-hidden="true"></span>
								<?php if ( ! empty( $card['eyebrow'] ) ) : ?>
									<div class="ph-card-eyebrow"><?php echo esc_html( $card['eyebrow'] ?? '' ); ?></div>
								<?php endif; ?>
								<h3 class="ph-card-title"><?php echo esc_html( $card['title'] ?? '' ); ?></h3>
								<p class="ph-card-desc"><?php echo esc_html( $card['desc'] ?? '' ); ?></p>
								<?php $tags = pegasus_home_tags( isset( $card['tags'] ) ? $card['tags'] : '' ); ?>
								<?php if ( $tags ) : ?>
									<div class="ph-pills">
										<?php foreach ( $tags as $tag ) : ?>
											<span class="ph-pill"><?php echo esc_html( $tag ); ?></span>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
								<?php if ( ! empty( $card['btn_label'] ) ) : ?>
									<div class="ph-card-actions">
										<a class="ph-btn ph-btn-primary" href="<?php echo esc_url( ! empty( $card['btn_url'] ) ? $card['btn_url'] : '#' ); ?>"<?php echo ( ! empty( $card['btn_url'] ) && false !== strpos( $card['btn_url'], 'http' ) ) ? ' target="_blank" rel="noopener"' : ''; ?>>
											<?php if ( ! empty( $card['btn_icon'] ) ) : ?><i class="<?php echo esc_attr( $card['btn_icon'] ); ?>" aria-hidden="true"></i><?php endif; ?>
											<span><?php echo esc_html( $card['btn_label'] ); ?></span>
										</a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<?php /* =========================== INSTALL ========================== */ ?>
		<section id="install" class="ph-section ph-section--dark">
			<div class="container">
				<div class="ph-section-head text-center">
					<div class="ph-eyebrow ph-accent-green"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'install_eyebrow' ) ); ?></div>
					<h2 class="ph-h2"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'install_heading' ) ); ?></h2>
					<p class="ph-section-lead"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'install_text' ) ); ?></p>
				</div>

				<?php $install_cards = pegasus_home_group( $pegasus_home_id, 'install_cards' ); ?>
				<div class="row g-4">
					<?php foreach ( $install_cards as $term ) : ?>
						<div class="col-md-6">
							<div class="ph-terminal">
								<div class="ph-terminal-bar">
									<span class="ph-dot ph-dot--blue"></span>
									<span class="ph-dot ph-dot--lime"></span>
									<span class="ph-dot ph-dot--green"></span>
									<span class="ph-terminal-label"><?php echo esc_html( $term['label'] ?? '' ); ?></span>
										<button type="button" class="ph-copy" aria-label="<?php esc_attr_e( 'Copy command to clipboard', 'pegasus-child' ); ?>">
											<svg class="ph-copy-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
											<span class="ph-copy-label"><?php esc_html_e( 'Copy', 'pegasus-child' ); ?></span>
										</button>
								</div>
								<div class="ph-terminal-body">
									<?php if ( ! empty( $term['comment'] ) ) : ?>
										<span class="ph-terminal-comment"><?php echo esc_html( $term['comment'] ?? '' ); ?></span>
									<?php endif; ?>
									<code class="ph-terminal-cmd"><?php echo esc_html( $term['command'] ?? '' ); ?></code>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<?php $install_note = pegasus_home_field( $pegasus_home_id, 'install_note' ); ?>
				<?php if ( $install_note ) : ?>
					<div class="ph-note"><?php echo wp_kses_post( $install_note ); ?></div>
				<?php endif; ?>
			</div>
		</section>

		<?php /* =========================== PLUGINS ========================== */ ?>
		<section id="plugins" class="ph-section ph-section--mid">
			<div class="container">
				<div class="ph-section-head text-center">
					<div class="ph-eyebrow ph-accent-teal"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'plugins_eyebrow' ) ); ?></div>
					<h2 class="ph-h2"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'plugins_heading' ) ); ?></h2>
					<p class="ph-section-lead"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'plugins_text' ) ); ?></p>
				</div>

				<?php
					// Plugin cards are powered by the shared demo JSON (visible plugins).
					if ( ! function_exists( 'pegasus_demo_visible_plugins' ) ) {
						require_once get_stylesheet_directory() . '/inc/demo-data.php';
					}
					$plugins_cards = pegasus_demo_visible_plugins();
					?>
				<div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4">
					<?php foreach ( $plugins_cards as $plugin ) : ?>
						<?php
						$accent = pegasus_home_accent_class( $plugin['accent'] ?? 'green' );
						$slug   = $plugin['id'] ?? ''; // already "pegasus-xxx"
						$link   = pegasus_demo_plugin_section_link( $plugin ); // → demo page #section
						?>
						<div class="col">
							<?php if ( $link ) : ?>
							<a class="ph-plugin <?php echo esc_attr( $accent ); ?>" href="<?php echo esc_url( $link ); ?>">
							<?php else : ?>
							<div class="ph-plugin <?php echo esc_attr( $accent ); ?>">
							<?php endif; ?>
								<div class="ph-plugin-head">
									<span class="ph-plugin-icon"><?php echo esc_html( $plugin['icon'] ?? '' ); ?></span>
									<?php if ( $slug ) : ?>
										<span class="ph-plugin-slug"><?php echo esc_html( $slug ); ?></span>
									<?php endif; ?>
								</div>
								<h3 class="ph-plugin-name"><?php echo esc_html( $plugin['title'] ?? '' ); ?></h3>
								<p class="ph-plugin-desc"><?php echo esc_html( $plugin['blurb'] ?? '' ); ?></p>
								<span class="ph-plugin-demo">View demo →</span>
							<?php echo $link ? '</a>' : '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<?php /* ============================ DOCS ============================ */ ?>
		<section id="docs" class="ph-section ph-section--dark">
			<div class="container">
				<div class="row g-5 align-items-center">
					<div class="col-lg-6">
						<div class="ph-eyebrow ph-accent-green"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'docs_eyebrow' ) ); ?></div>
						<h2 class="ph-h2 ph-h2--left"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'docs_heading' ) ); ?></h2>
						<p class="ph-section-lead ph-section-lead--left"><?php echo esc_html( pegasus_home_field( $pegasus_home_id, 'docs_text' ) ); ?></p>
						<?php
						// Docs preview + button are powered by the shared docs JSON.
						if ( ! function_exists( 'pegasus_docs_sections' ) ) {
							require_once get_stylesheet_directory() . '/inc/docs-data.php';
						}
						$docs_sections  = pegasus_docs_sections();
						$docs_page_url  = function_exists( 'pegasus_docs_page_url' ) ? pegasus_docs_page_url() : '';
						$docs_btn_label = pegasus_home_field( $pegasus_home_id, 'docs_btn_label' );
						$docs_btn_url   = $docs_page_url ? $docs_page_url : pegasus_home_field( $pegasus_home_id, 'docs_btn_url' );
						?>
						<?php if ( $docs_btn_label ) : ?>
							<a class="ph-btn ph-btn-primary" href="<?php echo esc_url( $docs_btn_url ? $docs_btn_url : '#' ); ?>">
								<span><?php echo esc_html( $docs_btn_label ); ?></span>
							</a>
						<?php endif; ?>
					</div>
					<div class="col-lg-6">
						<div class="ph-doc-list">
							<?php $docs_n = 1; ?>
							<?php foreach ( $docs_sections as $ds ) : ?>
								<a class="ph-doc-item" href="<?php echo esc_url( pegasus_docs_section_link( $ds['id'] ?? '' ) ); ?>">
									<span class="ph-doc-num"><?php echo esc_html( str_pad( (string) $docs_n, 2, '0', STR_PAD_LEFT ) ); ?></span>
									<span class="ph-doc-body">
										<span class="ph-doc-title"><?php echo esc_html( $ds['title'] ?? '' ); ?></span>
										<span class="ph-doc-sub"><?php echo esc_html( $ds['sub'] ?? '' ); ?></span>
									</span>
									<span class="ph-doc-arrow">→</span>
								</a>
								<?php $docs_n++; ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

	</div><!-- .pegasus-home -->

	<?php /* Right-hand dot navigation with scrollspy (same sections as the sidebar). */ ?>
	<nav id="dotnav" class="navbar nav pg-dotnav">
		<ul class="dotnav dotnav-vertical dotnav-right">
			<?php foreach ( $pegasus_home_nav as $item ) : ?>
				<li class="nav-tooltip nav-item" title="<?php echo esc_attr( $item['label'] ); ?>" data-bs-toggle="tooltip" data-placement="left">
					<a class="nav-link" href="#<?php echo esc_attr( $item['id'] ); ?>"></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>

</div><!-- #page-wrap -->

<?php get_footer(); ?>
