<?php
/*
	Template Name: Menu Template
*/
?>
	<?php get_header(); ?>

	<?php
		$header_choice = pegasus_get_option( 'header_select' );
		//var_dump($header_choice);
		if ( 'header-three' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}
	?>

	<div id="page-wrap">

		<?php
			//full container page options
			$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
			//full container theme option
			$global_full_container_option = pegasus_get_option('full_container_chk' );

			//assign post class
			$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
			//assign global class
			$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container' ;
			//check global first then post
			$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

			//left align right sidebar?
			$left_align_sidebar_chk =  pegasus_get_option( 'sidebar_left_chk' ) ? pegasus_get_option( 'sidebar_left_chk' ) : 'off';
			//enable both sidebars?
			$pegasus_left_sidebar_option = ( 'on' === pegasus_get_option( 'both_sidebar_chk' ) ) ? pegasus_get_option( 'both_sidebar_chk' ) : 'off';
			//change content class if both sidebars
			$page_body_content_class = ( 'on' === $pegasus_left_sidebar_option  ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xg-6' : 'col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9';

			//page header page options
			$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
			//page header theme option
			$global_disable_page_header_option =  pegasus_get_option('page_header_chk' ) ? pegasus_get_option('page_header_chk' ) : 'off';
			//check theme option for page header before page option
			$page_title = $post->post_title;
			$is_this_home = is_home();
			if ( 'on' === $global_disable_page_header_option ) {
				$final_page_header_option = 'on';
			} elseif ( 'on' === $post_disable_page_header_choice ) {
				$final_page_header_option = 'on';
			} else {
				$final_page_header_option = 'off';
			}

			if ( true === $is_this_home ) {
				$final_page_header_option = 'off';
			}
		?>


		<div class="<?php echo $final_container_class; ?>">
		<!-- Example row of columns -->
			<div class="">

				<div class="inner-content">
					<div class="content-no-sidebar">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php if( 'off' === $final_page_header_option ) { ?>
								<div class="page-header">
									<?php
									if( '' === $page_title ) {
										echo '';
									} elseif ( $page_title ) {
										echo '<h1>';
										echo the_title();
										echo '</h1>';
									}
									?>
								</div>
							<?php }else{ ?>
								<!--<div class="page-header-spacer"></div>-->
							<?php } ?>

							<?php the_content(); ?>

						<?php endwhile; else: ?>
							<?php /* kinda a 404 of sorts when not working */ ?>
							<div class="page-header">
								<h1>Oh no!</h1>
							</div>
							<p>No content is appearing for this page!</p>
						<?php endif; ?>
						<?php
							if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
								// Edit post link
								wp_bootstrap_edit_post_link(
									sprintf(
										/* translators: %s: Name of current post */
										__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus' ),
										get_the_title()
									),
									'<span class="edit-link">',
									'</span>'
								);
							}
							if ( function_exists( 'wp_bootstrap_posts_pagination' ) ) {
								wp_bootstrap_posts_pagination( array(
									'prev_text'          => __( 'Previous page', 'pegasus' ),
									'next_text'          => __( 'Next page', 'pegasus' ),
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pegasus' ) . ' </span>'
								) );
							}
						?>
					</div>
				</div><!--end inner content-->

			</div><!--end row -->
		</div><!-- end container -->
		<?php
		$menu_json = <<<JSON
{
  "restaurant_name": "Salt Cellar",
  "updated": "2026-02-14",
  "tabs": [
    {
      "id": "starters",
      "label": "Starters",
      "description": "",
      "sections": [
        {
          "title": "Starters",
          "note": "",
          "items": [
            {
              "name": "Tempura Fried Shiitake Mushrooms",
              "description": "Soy citrus dipping sauce.",
              "price": "13.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Raw Oysters*",
              "description": "Six cocktail oysters, served with Chalaca cocktail sauce, remoulade, and saltine crackers.",
              "price": "Market Price",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Lamb Meatballs",
              "description": "Saffron risotto, tzatziki & chermoula sauce.",
              "price": "14.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Truffled-Parmesan French Fries",
              "description": "Hand-cut fries, truffle oil, grated Parmesan cheese.",
              "price": "8.95",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Appetizer Trio",
              "description": "Mini crab cakes, coconut shrimp, pan-seared sea scallops.",
              "price": "Market Price",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Jumbo Lump 4 oz. Crab Cake",
              "description": "Spicy creamed corn, lemon wedge, topped with micro greens.",
              "price": "23.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Sweet Vidalia Onion Rings",
              "description": "Avocado lemon-herbed dipping sauce.",
              "price": "12.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Ahi Tuna Tataki",
              "description": "Acevichada sauce, passion fruit gelée, criolla salad.",
              "price": "15.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        }
      ]
    },

    {
      "id": "salads",
      "label": "Salads",
      "description": "",
      "sections": [
        {
          "title": "Salads",
          "note": "",
          "items": [
            {
              "name": "Saltcellar Salad",
              "description": "Mixed greens, chickpeas, heart of palm, roasted tomatoes, smoked blue cheese, red onions, creamy lemon herb dressing.",
              "price": "13.95",
              "badges": ["GF", "V"],
              "spicy_level": 0,
              "extras": [
                { "label": "Add grilled chicken", "price": "9" },
                { "label": "Add jumbo gulf shrimp", "price": "14" }
              ]
            },
            {
              "name": "Crab Salad",
              "description": "Lump crab, micro arugula, crispy sunchokes, pickled onion. Dijon horseradish cream.",
              "price": "18.95",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Harvest Greens Salad",
              "description": "Mixed greens, roasted sweet potatoes, pumpkin seeds, dried cherries, feta cheese, honey mustard vinaigrette.",
              "price": "13.95",
              "badges": ["GF", "V"],
              "spicy_level": 0,
              "extras": [
                { "label": "Add grilled chicken", "price": "9" },
                { "label": "Add jumbo gulf shrimp", "price": "14" }
              ]
            }
          ]
        }
      ]
    },

    {
      "id": "entrees",
      "label": "Entrées",
      "description": "",
      "sections": [
        {
          "title": "Entrées — Land",
          "note": "",
          "items": [
            {
              "name": "Grilled Lamb Chop",
              "description": "Saffron risotto, garlic, balsamic reduction.",
              "price": "43.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Braised Boneless Short Rib*",
              "description": "Herbed mashed potatoes, grilled asparagus, red wine sauce.",
              "price": "39.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Center Cut Filet* (8oz)",
              "description": "Charred leek puree, truffled mushrooms, green peppercorn sauce.",
              "price": "49.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Ribeye Steak* (16oz)",
              "description": "Herbed mashed potatoes, chimichurri sauce.",
              "price": "44.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Saltcellar Burger*",
              "description": "Two 4 oz Angus beef patties, American cheese, fried onion rings, bacon jam, secret sauce, brioche bun, seasoned fries.",
              "price": "17.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "The Produce Platter",
              "description": "Leek confit, glazed turnip root, broccoli puree, roasted maitake mushrooms.",
              "price": "22.95",
              "badges": ["GF", "Vegan"],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Entrées — Sea",
          "note": "",
          "items": [
            {
              "name": "Seafood Fettuccini",
              "description": "Shrimp, scallops, lobster, creamy garlic Parmesan cheese sauce.",
              "price": "36.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Grilled Florida Grouper",
              "description": "Lobster cream sauce, herbed mashed potatoes, grilled asparagus.",
              "price": "44.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Mediterranean Salmon",
              "description": "Heirloom tomatoes, Kalamata olives, olive oil, fresh dill, couscous.",
              "price": "37.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Seared Rainbow Trout",
              "description": "Smashed fingerling potatoes, seasonal vegetables, lemon butter.",
              "price": "34.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Chilean Sea Bass",
              "description": "Miso broth, sesame ginger roasted baby bok choy, crispy shiitake mushrooms.",
              "price": "42.95",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        }
      ]
    },

    {
      "id": "sides",
      "label": "Sides",
      "description": "",
      "sections": [
        {
          "title": "Sides",
          "note": "All sides $6.50",
          "items": [
            {
              "name": "Herbed Mashed Potatoes",
              "description": "",
              "price": "6.50",
              "badges": ["V"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Hand-Cut French Fries",
              "description": "With Bay Seasoning.",
              "price": "6.50",
              "badges": ["GF", "V"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Sautéed Shiitake Mushrooms",
              "description": "",
              "price": "6.50",
              "badges": ["V"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Grilled Asparagus",
              "description": "",
              "price": "6.50",
              "badges": ["GF", "V"],
              "spicy_level": 0,
              "extras": [
                { "label": "Add extra", "price": "2" }
              ]
            },
            {
              "name": "Sautéed Baby Spinach",
              "description": "",
              "price": "6.50",
              "badges": ["GF", "V"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Seasonal Vegetables",
              "description": "",
              "price": "6.50",
              "badges": ["V"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Spicy Creamed Corn",
              "description": "",
              "price": "6.50",
              "badges": ["V"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Risotto",
              "description": "",
              "price": "6.50",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Baked Potato",
              "description": "",
              "price": "6.50",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": [
                { "label": "Loaded", "price": "2.75" }
              ]
            },
            {
              "name": "Side Saltcellar Salad",
              "description": "",
              "price": "6.50",
              "badges": ["GF", "V"],
              "spicy_level": 0,
              "extras": [
                { "label": "Add extra", "price": "2" }
              ]
            },
            {
              "name": "Side Harvest Salad",
              "description": "",
              "price": "6.50",
              "badges": ["GF", "V"],
              "spicy_level": 0,
              "extras": [
                { "label": "Add extra", "price": "2" }
              ]
            }
          ]
        }
      ]
    },

    {
      "id": "additions",
      "label": "Additions",
      "description": "",
      "sections": [
        {
          "title": "Additions",
          "note": "",
          "items": [
            {
              "name": "Seared Sea Scallops (2)",
              "description": "",
              "price": "7",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Grilled Jumbo Gulf Shrimp (2)",
              "description": "",
              "price": "7",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Maine Lobster Tail (4oz)",
              "description": "",
              "price": "14",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Jumbo Lump 4oz. Crab Cake",
              "description": "",
              "price": "18",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Sauces",
              "description": "Green peppercorn, lemon butter, bourbon glaze, chimichurri, remoulade, cocktail.",
              "price": "2.50",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        }
      ],
      "footnotes": [
        "*These items can be cooked to order. Consuming raw or undercooked meats, poultry, seafood, shellfish, or eggs may increase your risk of foodborne illness.",
        "We cannot guarantee well done steaks. All sales are final.",
        "GF - gluten friendly.",
        "V - vegetarian.",
        "If you have a severe food allergy, please inform your server.",
        "20% automatic gratuity added to parties of 8 or more."
      ]
    }
  ]
}
JSON;


		$menu_data = json_decode($menu_json, true);
		if (!is_array($menu_data) || empty($menu_data['tabs'])) {
		  $menu_data = ['restaurant_name' => '', 'updated' => '', 'tabs' => []];
		}

		// Format helpers
		function vqmenu_money($value) {
		  // accepts strings like "14" or "14.00"
		  $num = is_numeric($value) ? number_format((float)$value, 2, '.', '') : $value;
		  // If you prefer no cents when .00, tweak here:
		  if (is_numeric($value) && fmod((float)$value, 1.0) === 0.0) {
			$num = number_format((float)$value, 0, '.', '');
		  }
		  return '$' . $num;
		}

		function vqmenu_badge_class($label) {
		  $label = strtoupper(trim((string)$label));
		  return match ($label) {
			'V'   => 'vqmenu-badge vqmenu-badge--veg',
			'GF'  => 'vqmenu-badge vqmenu-badge--gf',
			'GF*' => 'vqmenu-badge vqmenu-badge--gf',
			default => 'vqmenu-badge'
		  };
		}

		// Enqueue the CSS/JS (separate files as requested)
		$theme_uri = get_stylesheet_directory_uri();
		$theme_dir = get_stylesheet_directory();

		// You can change these paths to match where you put the files
		$css_rel = '/assets/restaurant-menu/restaurant-menu.css';
		$js_rel  = '/assets/restaurant-menu/restaurant-menu.js';

		if (file_exists($theme_dir . $css_rel)) {
		  wp_enqueue_style('vq-restaurant-menu', $theme_uri . $css_rel, [], filemtime($theme_dir . $css_rel));
		}
		if (file_exists($theme_dir . $js_rel)) {
		  // depends on Bootstrap JS being present on the page; if your theme doesn't load it, you can still run w/ minimal features
		  wp_enqueue_script('vq-restaurant-menu', $theme_uri . $js_rel, [], filemtime($theme_dir . $js_rel), true);
		}

		$tabs = $menu_data['tabs'];
		$first_tab_id = $tabs[0]['id'] ?? 'menu';

		?>
		<main id="primary" class="site-main">
		  <div class="container py-5 vqmenu">
			<header class="vqmenu-header mb-4">
			  <?php if (!empty($menu_data['restaurant_name'])) : ?>
				<h1 class="vqmenu-title mb-1"><?php echo esc_html($menu_data['restaurant_name']); ?></h1>
			  <?php else : ?>
				<h1 class="vqmenu-title mb-1"><?php the_title(); ?></h1>
			  <?php endif; ?>

			  <?php if (!empty($menu_data['updated'])) : ?>
				<div class="vqmenu-meta text-muted">
				  Updated: <?php echo esc_html($menu_data['updated']); ?>
				</div>
			  <?php endif; ?>
			</header>

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
		  </div>
		</main>

		<?php /*
		<section class="py-5 mb-5">
			<?php echo do_shortcode( '[uptown_restaurant_map height="600px"]' ); ?>
		</section>
		*/ ?>


	</div><!-- end page wrap -->
    <?php get_footer(); ?>
