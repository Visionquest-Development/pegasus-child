<?php
/**
 * Menu Mobile Template
 *
 * Renders one long-scroll panel per top-level menu tab with a sticky
 * horizontal section nav. A pill bar at top switches between menus.
 *
 * Expects: $tabs (array) — the "tabs" array from menu.json
 */

if ( empty( $tabs ) || ! is_array( $tabs ) ) {
	return;
}

// Normalize tab IDs once so markup IDs stay consistent.
$normalized_tabs = [];
foreach ( $tabs as $ti => $tab ) {
	$tab_id = preg_replace( '/[^a-z0-9\-_]/i', '', (string) ( $tab['id'] ?? ( 'tab-' . $ti ) ) );
	$normalized_tabs[] = [
		'id'        => $tab_id,
		'label'     => (string) ( $tab['label'] ?? 'Menu' ),
		'desc'      => (string) ( $tab['description'] ?? '' ),
		'download'  => $tab['download'] ?? null,
		'sections'  => $tab['sections'] ?? [],
		'footnotes' => $tab['footnotes'] ?? [],
	];
}
?>

<?php if ( count( $normalized_tabs ) > 1 ) : ?>
<nav class="vqmenu-mobile-tabs" aria-label="Menu version">
  <ul class="vqmenu-mobile-tabs__list" role="tablist">
	<?php foreach ( $normalized_tabs as $i => $tab ) :
	  $is_active = ( $i === 0 );
	?>
	  <li class="vqmenu-mobile-tabs__item" role="presentation">
		<button
		  type="button"
		  class="vqmenu-mobile-tabs__btn<?php echo $is_active ? ' is-active' : ''; ?>"
		  data-vqmenu-tab="mobile-tab-<?php echo esc_attr( $tab['id'] ); ?>"
		  role="tab"
		  aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
		  aria-controls="mobile-tab-<?php echo esc_attr( $tab['id'] ); ?>"
		>
		  <?php echo esc_html( $tab['label'] ); ?>
		</button>
	  </li>
	<?php endforeach; ?>
  </ul>
</nav>
<?php endif; ?>

<div class="vqmenu-mobile-panes">
  <?php foreach ( $normalized_tabs as $i => $tab ) :
	$tab_id      = $tab['id'];
	$is_active   = ( $i === 0 );
	$pane_class  = 'vqmenu-mobile-pane' . ( $is_active ? ' is-active' : '' );

	// Build per-tab section list with slugs scoped to the tab id so duplicate
	// section titles across menus (e.g. "Sides") still get unique anchors.
	$tab_sections = [];
	foreach ( $tab['sections'] as $si => $section ) {
	  $title = (string) ( $section['title'] ?? '' );
	  $slug  = sanitize_title( $title !== '' ? $title : ( $tab_id . '-' . $si ) );
	  $tab_sections[] = [
		'slug'  => $tab_id . '-' . $slug,
		'title' => $title,
		'note'  => (string) ( $section['note'] ?? '' ),
		'items' => $section['items'] ?? [],
	  ];
	}
  ?>
	<div
	  class="<?php echo esc_attr( $pane_class ); ?>"
	  id="mobile-tab-<?php echo esc_attr( $tab_id ); ?>"
	  role="tabpanel"
	  data-vqmenu-pane
	  <?php if ( ! $is_active ) : ?>hidden<?php endif; ?>
	>
	  <?php if ( ! empty( $tab['desc'] ) ) : ?>
		<p class="vqmenu-tabdesc text-muted mt-3 mb-3"><?php echo esc_html( $tab['desc'] ); ?></p>
	  <?php endif; ?>

	  <?php if ( ! empty( $tab['download']['href'] ) ) : ?>
		<div class="vqmenu-download mb-3">
		  <a
			class="btn btn-primary"
			href="<?php echo esc_url( $tab['download']['href'] ); ?>"
			target="<?php echo esc_attr( $tab['download']['target'] ?? '_blank' ); ?>"
			rel="noopener"
		  >
			<?php echo esc_html( $tab['download']['text'] ?? 'Download Menu' ); ?>
		  </a>
		</div>
	  <?php endif; ?>

	  <?php if ( ! empty( $tab_sections ) ) : ?>
		<!-- Sticky horizontal section nav (one per menu pane) -->
		<nav class="vqmenu-mobile-nav" aria-label="Menu sections">
		  <ul class="vqmenu-mobile-nav__list">
			<?php foreach ( $tab_sections as $idx => $sec ) : ?>
			  <li class="vqmenu-mobile-nav__item">
				<a
				  class="vqmenu-mobile-nav__link<?php echo $idx === 0 ? ' is-active' : ''; ?>"
				  href="#mobile-<?php echo esc_attr( $sec['slug'] ); ?>"
				  data-section="mobile-<?php echo esc_attr( $sec['slug'] ); ?>"
				>
				  <?php echo esc_html( $sec['title'] ); ?>
				</a>
			  </li>
			<?php endforeach; ?>
		  </ul>
		</nav>

		<!-- Full scrolling menu for this tab -->
		<div class="vqmenu-mobile-body">
		  <?php foreach ( $tab_sections as $sec ) :
			$items = is_array( $sec['items'] ) ? $sec['items'] : [];
		  ?>
			<section class="vqmenu-mobile-section" id="mobile-<?php echo esc_attr( $sec['slug'] ); ?>">
			  <?php if ( $sec['title'] ) : ?>
				<div class="vqmenu-mobile-section__head">
				  <h2 class="vqmenu-mobile-section__title"><?php echo esc_html( $sec['title'] ); ?></h2>
				  <?php if ( $sec['note'] ) : ?>
					<div class="vqmenu-mobile-section__note text-muted"><?php echo esc_html( $sec['note'] ); ?></div>
				  <?php endif; ?>
				</div>
			  <?php endif; ?>

			  <?php if ( ! empty( $items ) ) : ?>
				<?php foreach ( $items as $item ) :
				  $name        = (string) ( $item['name'] ?? '' );
				  $description = (string) ( $item['description'] ?? '' );
				  $price       = (string) ( $item['price'] ?? '' );
				  $badges      = is_array( $item['badges'] ?? null ) ? $item['badges'] : [];
				  $spicy       = (int) ( $item['spicy_level'] ?? 0 );
				  $extras      = is_array( $item['extras'] ?? null ) ? $item['extras'] : [];
				  $image       = (string) ( $item['image'] ?? '' );
				  $is_oos      = ! empty( $item['out_of_stock'] );
				  $oos_class   = $is_oos ? ' vqmenu-mobile-card--oos' : '';
				?>
				  <article class="vqmenu-mobile-card<?php echo esc_attr( $oos_class ); ?>">
					<?php if ( $image ) : ?>
					  <a href="<?php echo esc_url( $image ); ?>" data-lightbox="menu-mobile" data-title="<?php echo esc_attr( $name ); ?>">
						<img
						  class="vqmenu-mobile-card__img"
						  src="<?php echo esc_url( $image ); ?>"
						  alt="<?php echo esc_attr( $name ); ?>"
						  loading="lazy"
						>
					  </a>
					<?php endif; ?>
					<div class="vqmenu-mobile-card__top">
					  <h3 class="vqmenu-mobile-card__name"><?php echo esc_html( $name ); ?></h3>
					  <?php if ( $price !== '' ) : ?>
						<span class="vqmenu-mobile-card__price"><?php echo esc_html( vqmenu_money( $price ) ); ?></span>
					  <?php endif; ?>
					</div>

					<?php if ( $is_oos ) : ?>
					  <div class="vqmenu-oos-badge mt-1">
						<span class="badge bg-secondary">Currently Unavailable</span>
					  </div>
					<?php endif; ?>

					<?php if ( ! empty( $badges ) || $spicy > 0 ) : ?>
					  <div class="vqmenu-badges mt-1">
						<?php foreach ( $badges as $b ) :
						  $b = (string) $b;
						  if ( $b === '' ) continue;
						?>
						  <span class="<?php echo esc_attr( vqmenu_badge_class( $b ) ); ?>"><?php echo esc_html( $b ); ?></span>
						<?php endforeach; ?>
						<?php if ( $spicy > 0 ) : ?>
						  <span class="vqmenu-spice" aria-label="Spice level <?php echo esc_attr( (string) $spicy ); ?>">
							<?php echo str_repeat( '🌶️', min( max( $spicy, 1 ), 3 ) ); ?>
						  </span>
						<?php endif; ?>
					  </div>
					<?php endif; ?>

					<?php if ( $description ) : ?>
					  <p class="vqmenu-mobile-card__desc"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $extras ) ) : ?>
					  <div class="vqmenu-mobile-card__extras">
						<div class="vqmenu-extraslabel">Options</div>
						<ul class="vqmenu-extraslist mb-0">
						  <?php foreach ( $extras as $ex ) :
							$ex_label = (string) ( $ex['label'] ?? '' );
							$ex_price = (string) ( $ex['price'] ?? '' );
							if ( $ex_label === '' ) continue;
						  ?>
							<li class="vqmenu-extrasitem">
							  <span class="vqmenu-extrasname"><?php echo esc_html( $ex_label ); ?></span>
							  <?php if ( $ex_price !== '' ) : ?>
								<span class="vqmenu-extrasprice"><?php echo esc_html( vqmenu_money( $ex_price ) ); ?></span>
							  <?php endif; ?>
							</li>
						  <?php endforeach; ?>
						</ul>
					  </div>
					<?php endif; ?>
				  </article>
				<?php endforeach; ?>
			  <?php else : ?>
				<div class="alert alert-secondary mb-0">No items available.</div>
			  <?php endif; ?>
			</section>
		  <?php endforeach; ?>
		</div>
	  <?php else : ?>
		<div class="alert alert-secondary mt-4">No sections available.</div>
	  <?php endif; ?>

	  <?php if ( ! empty( $tab['footnotes'] ) && is_array( $tab['footnotes'] ) ) : ?>
		<div class="vqmenu-footnotes mt-4">
		  <h4 class="vqmenu-footnotes-title mb-2">Notes</h4>
		  <ul class="vqmenu-footnotes-list mb-0">
			<?php foreach ( $tab['footnotes'] as $note ) :
			  $note = trim( (string) $note );
			  if ( $note === '' ) continue;
			?>
			  <li class="vqmenu-footnotes-item"><?php echo esc_html( $note ); ?></li>
			<?php endforeach; ?>
		  </ul>
		</div>
	  <?php endif; ?>
	</div>
  <?php endforeach; ?>
</div>
