<?php
/**
 * Menu Mobile Template
 *
 * Renders a long-scroll mobile menu with a sticky horizontal category nav.
 * Expects: $tabs (array) — the "tabs" array from menu.json
 */

if ( empty( $tabs ) || ! is_array( $tabs ) ) {
	return;
}

// Flatten all sections across every tab so we can build the nav + scroll list.
$all_sections = [];
$all_footnotes = [];
foreach ( $tabs as $ti => $tab ) {
	$tab_id = preg_replace( '/[^a-z0-9\-_]/i', '', (string) ( $tab['id'] ?? ( 'tab-' . $ti ) ) );
	$sections = $tab['sections'] ?? [];
	foreach ( $sections as $si => $section ) {
		$section_slug  = sanitize_title( $section['title'] ?? $tab_id . '-' . $si );
		$all_sections[] = [
			'slug'    => $section_slug,
			'title'   => (string) ( $section['title'] ?? '' ),
			'note'    => (string) ( $section['note'] ?? '' ),
			'items'   => $section['items'] ?? [],
		];
	}
	if ( ! empty( $tab['footnotes'] ) && is_array( $tab['footnotes'] ) ) {
		$all_footnotes = array_merge( $all_footnotes, $tab['footnotes'] );
	}
}
?>

<!-- Sticky horizontal section nav -->
<nav class="vqmenu-mobile-nav" aria-label="Menu sections">
  <ul class="vqmenu-mobile-nav__list" id="vqmenuMobileNav">
	<?php foreach ( $all_sections as $idx => $sec ) : ?>
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

<!-- Full scrolling menu -->
<div class="vqmenu-mobile-body">
  <?php foreach ( $all_sections as $sec ) :
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
		?>
		  <article class="vqmenu-mobile-card">
			<div class="vqmenu-mobile-card__top">
			  <h3 class="vqmenu-mobile-card__name"><?php echo esc_html( $name ); ?></h3>
			  <?php if ( $price !== '' ) : ?>
				<span class="vqmenu-mobile-card__price"><?php echo esc_html( vqmenu_money( $price ) ); ?></span>
			  <?php endif; ?>
			</div>

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
				<div class="vqmenu-extraslabel">Add-ons</div>
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

  <?php if ( ! empty( $all_footnotes ) ) : ?>
	<div class="vqmenu-footnotes mt-4">
	  <h4 class="vqmenu-footnotes-title mb-2">Notes</h4>
	  <ul class="vqmenu-footnotes-list mb-0">
		<?php foreach ( $all_footnotes as $note ) :
		  $note = trim( (string) $note );
		  if ( $note === '' ) continue;
		?>
		  <li class="vqmenu-footnotes-item"><?php echo esc_html( $note ); ?></li>
		<?php endforeach; ?>
	  </ul>
	</div>
  <?php endif; ?>
</div>
