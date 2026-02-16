<?php
/**
 * Menu Tabs Template
 *
 * Expects: $tabs (array) — the "tabs" array from menu.json
 */

if ( empty( $tabs ) || ! is_array( $tabs ) ) {
	return;
}
?>

<!-- Tabs -->
<ul class="nav nav-tabs vqmenu-tabs" id="vqmenuTabs" role="tablist">
  <?php foreach ($tabs as $i => $tab) :
	$tab_id = preg_replace('/[^a-z0-9\-_]/i', '', (string)($tab['id'] ?? ('tab-' . $i)));
	$label  = (string)($tab['label'] ?? 'Menu');
	$active = ($i === 0) ? 'active' : '';
	$selected = ($i === 0) ? 'true' : 'false';
  ?>
	<li class="nav-item" role="presentation">
	  <button
		class="nav-link <?php echo esc_attr($active); ?>"
		id="tab-<?php echo esc_attr($tab_id); ?>"
		data-bs-toggle="tab"
		data-bs-target="#panel-<?php echo esc_attr($tab_id); ?>"
		type="button"
		role="tab"
		aria-controls="panel-<?php echo esc_attr($tab_id); ?>"
		aria-selected="<?php echo esc_attr($selected); ?>"
	  >
		<?php echo esc_html($label); ?>
	  </button>
	</li>
  <?php endforeach; ?>
</ul>

<div class="tab-content vqmenu-panels" id="vqmenuTabContent">
  <?php foreach ($tabs as $i => $tab) :
	$tab_id = preg_replace('/[^a-z0-9\-_]/i', '', (string)($tab['id'] ?? ('tab-' . $i)));
	$desc   = (string)($tab['description'] ?? '');
	$active = ($i === 0) ? 'show active' : '';
	$sections = $tab['sections'] ?? [];
  ?>
	<section
	  class="tab-pane fade <?php echo esc_attr($active); ?><?php echo ($tab_id === 'salads') ? ' vqmenu-panel--salads' : ''; ?>"
	  id="panel-<?php echo esc_attr($tab_id); ?>"
	  role="tabpanel"
	  aria-labelledby="tab-<?php echo esc_attr($tab_id); ?>"
	  tabindex="0"
	  data-vqmenu-panel
	>
	  <?php if (!empty($desc)) : ?>
		<p class="vqmenu-tabdesc text-muted mt-3 mb-4"><?php echo esc_html($desc); ?></p>
	  <?php else : ?>
		<div class="mt-3"></div>
	  <?php endif; ?>

	  <?php if (!empty($tab['download']['href'])) : ?>
		  <div class="vqmenu-download mb-4">
			<a
			  class="btn btn-primary"
			  href="<?php echo esc_url($tab['download']['href']); ?>"
			  target="<?php echo esc_attr($tab['download']['target'] ?? '_blank'); ?>"
			  rel="noopener"
			>
			  <?php echo esc_html($tab['download']['text'] ?? 'Download Menu'); ?>
			</a>
		  </div>
		<?php endif; ?>

	  <?php if (is_array($sections) && !empty($sections)) : ?>
		<?php foreach ($sections as $section) :
		  $section_title = (string)($section['title'] ?? '');
		  $section_note  = (string)($section['note'] ?? '');
		  $items = $section['items'] ?? [];
		?>
		  <div class="vqmenu-section mb-5">
			<?php if ($section_title) : ?>
			  <div class="vqmenu-sectionhead">
				<h2 class="vqmenu-sectiontitle mb-1"><?php echo esc_html($section_title); ?></h2>
				<?php if ($section_note) : ?>
				  <div class="vqmenu-sectionnote text-muted"><?php echo esc_html($section_note); ?></div>
				<?php endif; ?>
			  </div>
			<?php endif; ?>

			<div class="row g-3 vqmenu-items">
			  <?php if (is_array($items) && !empty($items)) : ?>
				<?php foreach ($items as $item) :
				  $name = (string)($item['name'] ?? '');
				  $description = (string)($item['description'] ?? '');
				  $price = (string)($item['price'] ?? '');
				  $badges = is_array($item['badges'] ?? null) ? $item['badges'] : [];
				  $spicy = (int)($item['spicy_level'] ?? 0);
				  $extras = is_array($item['extras'] ?? null) ? $item['extras'] : [];
				?>
				  <div class="col-12 col-lg-6">
					<article class="card vqmenu-card h-100">
					  <div class="card-body">
						<div class="vqmenu-itemtop">
						  <h3 class="vqmenu-itemname mb-0">
							<?php echo esc_html($name); ?>
						  </h3>

						  <?php if ($price !== '') : ?>
							<div class="vqmenu-price">
							  <?php echo esc_html(vqmenu_money($price)); ?>
							</div>
						  <?php endif; ?>
						</div>

						<?php if (!empty($badges) || $spicy > 0) : ?>
						  <div class="vqmenu-badges mt-2">
							<?php foreach ($badges as $b) :
							  $b = (string)$b;
							  if ($b === '') continue;
							?>
							  <span class="<?php echo esc_attr(vqmenu_badge_class($b)); ?>">
								<?php echo esc_html($b); ?>
							  </span>
							<?php endforeach; ?>

							<?php if ($spicy > 0) : ?>
							  <span class="vqmenu-spice" aria-label="Spice level <?php echo esc_attr((string)$spicy); ?>">
								<?php
								  // show up to 3 peppers
								  $count = min(max($spicy, 1), 3);
								  echo str_repeat('🌶️', $count);
								?>
							  </span>
							<?php endif; ?>
						  </div>
						<?php endif; ?>

						<?php if ($description) : ?>
						  <p class="vqmenu-itemdesc mt-2 mb-0">
							<?php echo esc_html($description); ?>
						  </p>
						<?php endif; ?>

						<?php if (!empty($extras)) : ?>
						  <div class="vqmenu-extras mt-3">
							<div class="vqmenu-extraslabel">Add-ons</div>
							<ul class="vqmenu-extraslist mb-0">
							  <?php foreach ($extras as $ex) :
								$ex_label = (string)($ex['label'] ?? '');
								$ex_price = (string)($ex['price'] ?? '');
								if ($ex_label === '') continue;
							  ?>
								<li class="vqmenu-extrasitem">
								  <span class="vqmenu-extrasname"><?php echo esc_html($ex_label); ?></span>
								  <?php if ($ex_price !== '') : ?>
									<span class="vqmenu-extrasprice"><?php echo esc_html(vqmenu_money($ex_price)); ?></span>
								  <?php endif; ?>
								</li>
							  <?php endforeach; ?>
							</ul>
						  </div>
						<?php endif; ?>

					  </div>
					</article>
				  </div>
				<?php endforeach; ?>
			  <?php else : ?>
				<div class="col-12">
				  <div class="alert alert-secondary mb-0">No items available.</div>
				</div>
			  <?php endif; ?>
			</div>
		  </div>
		<?php endforeach; ?>
	  <?php else : ?>
		<div class="alert alert-secondary mt-4">No sections available.</div>
	  <?php endif; ?>
	</section>
  <?php endforeach; ?>
</div>

<?php if (!empty($tab['footnotes']) && is_array($tab['footnotes'])) : ?>
  <div class="vqmenu-footnotes mt-4">
	<h4 class="vqmenu-footnotes-title mb-2">Notes</h4>
	<ul class="vqmenu-footnotes-list mb-0">
	  <?php foreach ($tab['footnotes'] as $note) :
		$note = trim((string)$note);
		if ($note === '') continue;
	  ?>
		<li class="vqmenu-footnotes-item"><?php echo esc_html($note); ?></li>
	  <?php endforeach; ?>
	</ul>
  </div>
<?php endif; ?>
