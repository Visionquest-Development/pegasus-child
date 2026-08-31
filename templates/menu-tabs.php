<?php
/**
 * Menu — Desktop Tabs (Sugarpeddler bistro chalkboard styling).
 *
 * Expects: $tabs (array) — the "tabs" array from vqdev_toast_get_menu_data().
 */

if ( empty( $tabs ) || ! is_array( $tabs ) ) {
	return;
}
?>

<ul class="nav sp-menu-tabs justify-content-center" id="vqmenuTabs" role="tablist">
	<?php foreach ( $tabs as $i => $tab ) :
		$tab_id   = preg_replace( '/[^a-z0-9\-_]/i', '', (string) ( $tab['id'] ?? ( 'tab-' . $i ) ) );
		$label    = (string) ( $tab['label'] ?? 'Menu' );
		$is_active = ! empty( $tab['is_active'] );
		$is_past   = isset( $tab['is_available'] ) && ! $tab['is_available'];
		$active    = $is_active ? 'active' : '';
		$selected  = $is_active ? 'true' : 'false';
		$past_cls  = $is_past ? ' sp-menu-tabs__btn--past' : '';
	?>
		<li class="nav-item" role="presentation">
			<a
				class="nav-link sp-menu-tabs__btn fst-italic <?php echo esc_attr( $active . $past_cls ); ?>"
				id="tab-<?php echo esc_attr( $tab_id ); ?>"
				data-bs-toggle="tab"
				data-bs-target="#panel-<?php echo esc_attr( $tab_id ); ?>"
				href="#panel-<?php echo esc_attr( $tab_id ); ?>"
				role="tab"
				aria-controls="panel-<?php echo esc_attr( $tab_id ); ?>"
				aria-selected="<?php echo esc_attr( $selected ); ?>"
				<?php echo $is_past ? 'title="Outside serving hours right now"' : ''; ?>
			>
				<?php echo esc_html( $label ); ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>

<div class="tab-content sp-menu-panels" id="vqmenuTabContent">
	<?php foreach ( $tabs as $i => $tab ) :
		$tab_id    = preg_replace( '/[^a-z0-9\-_]/i', '', (string) ( $tab['id'] ?? ( 'tab-' . $i ) ) );
		$desc      = (string) ( $tab['description'] ?? '' );
		$tab_hours = (string) ( $tab['hours'] ?? '' );
		$is_active = ! empty( $tab['is_active'] );
		$is_past   = isset( $tab['is_available'] ) && ! $tab['is_available'];
		$active    = $is_active ? 'show active' : '';
		$past_cls  = $is_past ? ' sp-menu-panel--past' : '';
		$sections  = $tab['sections'] ?? array();
	?>
		<section
			class="tab-pane fade <?php echo esc_attr( $active . $past_cls ); ?>"
			id="panel-<?php echo esc_attr( $tab_id ); ?>"
			role="tabpanel"
			aria-labelledby="tab-<?php echo esc_attr( $tab_id ); ?>"
			tabindex="0"
			data-vqmenu-panel
		>
			<?php if ( $tab_hours || $desc || $is_past ) : ?>
				<div class="sp-menu-tabmeta text-center mt-4 mb-5">
					<?php if ( $tab_hours ) : ?>
						<p class="sp-menu-tabhours text-uppercase mb-1"><?php echo esc_html( $tab_hours ); ?></p>
					<?php endif; ?>
					<?php if ( $is_past ) : ?>
						<p class="sp-menu-tabpast text-uppercase mb-1">Outside serving hours &mdash; showing for reference</p>
					<?php endif; ?>
					<?php if ( $desc ) : ?>
						<p class="sp-menu-tabdesc mb-0"><?php echo esc_html( $desc ); ?></p>
					<?php endif; ?>
				</div>
			<?php else : ?>
				<div class="mt-4"></div>
			<?php endif; ?>

			<?php if ( ! empty( $tab['download']['href'] ) ) : ?>
				<div class="d-flex justify-content-center mb-5">
					<a class="sp-btn sp-btn--ghost-light"
					   href="<?php echo esc_url( $tab['download']['href'] ); ?>"
					   target="<?php echo esc_attr( $tab['download']['target'] ?? '_blank' ); ?>"
					   rel="noopener">
						<?php echo esc_html( $tab['download']['text'] ?? 'Download Menu' ); ?>
					</a>
				</div>
			<?php endif; ?>

			<?php if ( is_array( $sections ) && ! empty( $sections ) ) : ?>
				<?php foreach ( $sections as $sx => $section ) :
					$section_title = (string) ( $section['title'] ?? '' );
					$section_note  = (string) ( $section['note'] ?? '' );
					$section_kicker = (string) ( $section['kicker'] ?? '' );
					$items         = $section['items'] ?? array();
				?>
					<div class="sp-menu-section mb-5">
						<?php if ( $section_title || $section_kicker ) : ?>
							<div class="sp-menu-section__head d-flex align-items-center">
								<?php if ( $section_kicker ) : ?>
									<span class="sp-menu-section__kicker"><?php echo esc_html( $section_kicker ); ?></span>
								<?php endif; ?>
								<span class="sp-menu-section__rule flex-grow-1"></span>
								<?php if ( $section_title ) : ?>
									<span class="sp-menu-section__title fst-italic"><?php echo esc_html( $section_title ); ?></span>
								<?php endif; ?>
								<span class="sp-menu-section__rule flex-grow-1"></span>
							</div>
							<?php if ( $section_note ) : ?>
								<p class="sp-menu-section__note text-center mt-2 mb-0"><?php echo esc_html( $section_note ); ?></p>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( is_array( $items ) && ! empty( $items ) ) : ?>
							<div class="row g-4 sp-menu-items mt-3">
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
									<div class="col-12 col-xl-6">
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
									</div>
								<?php endforeach; ?>
							</div>
						<?php else : ?>
							<p class="sp-menu-section__empty text-center mt-4 mb-0">No items in this section.</p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if ( ! empty( $tab['footnotes'] ) && is_array( $tab['footnotes'] ) ) : ?>
				<div class="sp-menu-footnotes mt-4">
					<h4 class="sp-menu-footnotes__title text-uppercase mb-2">Notes</h4>
					<ul class="sp-menu-footnotes__list list-unstyled mb-0">
						<?php foreach ( $tab['footnotes'] as $note ) :
							$note = trim( (string) $note );
							if ( '' === $note ) continue;
						?>
							<li><?php echo esc_html( $note ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</section>
	<?php endforeach; ?>
</div>
