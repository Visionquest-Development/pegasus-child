<?php
/**
 * Menu — Mobile long-scroll view (Sugarpeddler bistro chalkboard styling).
 *
 * Renders a sticky horizontal section nav above a single scrolling list.
 * Expects: $tabs (array) — the "tabs" array from vqdev_toast_get_menu_data().
 */

if ( empty( $tabs ) || ! is_array( $tabs ) ) {
	return;
}

$all_sections  = array();
$all_footnotes = array();

foreach ( $tabs as $ti => $tab ) {
	$tab_id   = preg_replace( '/[^a-z0-9\-_]/i', '', (string) ( $tab['id'] ?? ( 'tab-' . $ti ) ) );
	$sections = $tab['sections'] ?? array();
	foreach ( $sections as $si => $section ) {
		$section_slug    = sanitize_title( ( $section['title'] ?? ( $tab_id . '-' . $si ) ) );
		$all_sections[]  = array(
			'slug'   => $section_slug,
			'title'  => (string) ( $section['title'] ?? '' ),
			'kicker' => (string) ( $section['kicker'] ?? '' ),
			'note'   => (string) ( $section['note'] ?? '' ),
			'items'  => $section['items'] ?? array(),
		);
	}
	if ( ! empty( $tab['footnotes'] ) && is_array( $tab['footnotes'] ) ) {
		$all_footnotes = array_merge( $all_footnotes, $tab['footnotes'] );
	}
}
?>

<nav class="sp-menu-mnav" aria-label="Menu sections">
	<ul class="sp-menu-mnav__list list-unstyled mb-0">
		<?php foreach ( $all_sections as $idx => $sec ) : ?>
			<li class="sp-menu-mnav__item">
				<a
					class="sp-menu-mnav__link fst-italic<?php echo 0 === $idx ? ' is-active' : ''; ?>"
					href="#mobile-<?php echo esc_attr( $sec['slug'] ); ?>"
					data-section="mobile-<?php echo esc_attr( $sec['slug'] ); ?>"
				>
					<?php echo esc_html( $sec['title'] ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<div class="sp-menu-mbody">
	<?php foreach ( $all_sections as $sec ) :
		$items = is_array( $sec['items'] ) ? $sec['items'] : array();
	?>
		<section class="sp-menu-msection" id="mobile-<?php echo esc_attr( $sec['slug'] ); ?>">
			<?php if ( $sec['title'] || $sec['kicker'] ) : ?>
				<div class="sp-menu-section__head sp-menu-msection__head d-flex align-items-center">
					<?php if ( $sec['kicker'] ) : ?>
						<span class="sp-menu-section__kicker"><?php echo esc_html( $sec['kicker'] ); ?></span>
					<?php endif; ?>
					<span class="sp-menu-section__rule flex-grow-1"></span>
					<?php if ( $sec['title'] ) : ?>
						<span class="sp-menu-section__title fst-italic"><?php echo esc_html( $sec['title'] ); ?></span>
					<?php endif; ?>
					<span class="sp-menu-section__rule flex-grow-1"></span>
				</div>
				<?php if ( $sec['note'] ) : ?>
					<p class="sp-menu-section__note text-center mt-2 mb-0"><?php echo esc_html( $sec['note'] ); ?></p>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( ! empty( $items ) ) : ?>
				<div class="sp-menu-msection__items mt-3">
					<?php foreach ( $items as $item ) :
						$name        = (string) ( $item['name'] ?? '' );
						$fr          = (string) ( $item['fr'] ?? '' );
						$description = (string) ( $item['description'] ?? '' );
						$price       = (string) ( $item['price'] ?? '' );
						$badges      = is_array( $item['badges'] ?? null ) ? $item['badges'] : array();
						$spicy       = (int) ( $item['spicy_level'] ?? 0 );
						$extras      = is_array( $item['extras'] ?? null ) ? $item['extras'] : array();
						$is_oos      = ! empty( $item['out_of_stock'] );
						$oos_class   = $is_oos ? ' sp-menu-item--oos' : '';
					?>
						<article class="sp-menu-item<?php echo esc_attr( $oos_class ); ?>">
							<div class="sp-menu-item__line d-flex align-items-baseline">
								<span class="sp-menu-item__name fst-italic"><?php echo esc_html( $name ); ?></span>
								<?php if ( $fr ) : ?>
									<span class="sp-menu-item__fr">&middot; <?php echo esc_html( $fr ); ?></span>
								<?php endif; ?>
								<span class="sp-menu-item__dots flex-grow-1"></span>
								<?php if ( '' !== $price ) : ?>
									<span class="sp-menu-item__price"><?php echo esc_html( vqmenu_money( $price ) ); ?></span>
								<?php endif; ?>
							</div>

							<?php if ( $is_oos ) : ?>
								<div class="sp-menu-item__oos mt-2">
									<span class="badge bg-secondary">Currently Unavailable</span>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $badges ) || $spicy > 0 ) : ?>
								<div class="sp-menu-item__badges d-flex flex-wrap gap-2 mt-2">
									<?php foreach ( $badges as $b ) :
										$b = (string) $b;
										if ( '' === $b ) continue;
									?>
										<span class="<?php echo esc_attr( vqmenu_badge_class( $b ) ); ?>"><?php echo esc_html( $b ); ?></span>
									<?php endforeach; ?>
									<?php if ( $spicy > 0 ) : ?>
										<span class="sp-menu-spice" aria-label="Spice level <?php echo esc_attr( (string) $spicy ); ?>">
											<?php echo str_repeat( '&#x1F336;&#xFE0F;', min( max( $spicy, 1 ), 3 ) ); ?>
										</span>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<?php if ( $description ) : ?>
								<p class="sp-menu-item__desc mt-2 mb-0"><?php echo esc_html( $description ); ?></p>
							<?php endif; ?>

							<?php if ( ! empty( $extras ) ) : ?>
								<div class="sp-menu-item__extras mt-3">
									<div class="sp-menu-item__extras-label text-uppercase">Options</div>
									<ul class="sp-menu-item__extras-list list-unstyled mb-0">
										<?php foreach ( $extras as $ex ) :
											$ex_label = (string) ( $ex['label'] ?? '' );
											$ex_price = (string) ( $ex['price'] ?? '' );
											if ( '' === $ex_label ) continue;
										?>
											<li class="d-flex">
												<span><?php echo esc_html( $ex_label ); ?></span>
												<span class="flex-grow-1 sp-menu-item__extras-dots"></span>
												<?php if ( '' !== $ex_price ) : ?>
													<span><?php echo esc_html( vqmenu_money( $ex_price ) ); ?></span>
												<?php endif; ?>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							<?php endif; ?>
						</article>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<p class="sp-menu-section__empty text-center mt-3 mb-0">No items in this section.</p>
			<?php endif; ?>
		</section>
	<?php endforeach; ?>

	<?php if ( ! empty( $all_footnotes ) ) : ?>
		<div class="sp-menu-footnotes mt-5">
			<h4 class="sp-menu-footnotes__title text-uppercase mb-2">Notes</h4>
			<ul class="sp-menu-footnotes__list list-unstyled mb-0">
				<?php foreach ( $all_footnotes as $note ) :
					$note = trim( (string) $note );
					if ( '' === $note ) continue;
				?>
					<li><?php echo esc_html( $note ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
</div>
