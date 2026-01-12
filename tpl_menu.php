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
  "restaurant_name": "Mix Market",
  "updated": "2026-01-09",
  "tabs": [
    {
      "id": "pizzas",
      "label": "Pizzas",
      "description": "",
      "sections": [
        {
          "title": "Signature Pizzas",
          "note": "",
          "items": [
            {
              "name": "Margherita",
              "description": "Italian tomato sauce, EVOO, basil, fresh mozzarella",
              "price": "14",
              "badges": ["V"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Mix Deluxe",
              "description": "Pepperoni, Italian sausage, mushroom, caramelized onions, tomato sauce, Grande whole milk shredded mozzarella",
              "price": "18",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "All the Meats",
              "description": "Pepperoni, Italian sausage, ham, bacon, tomato sauce, Grande whole milk shredded mozzarella",
              "price": "18",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "BBQ Chicken",
              "description": "Grilled chicken, caramelized onions, bacon, BBQ sauce, Grande whole milk shredded mozzarella",
              "price": "18",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Chicken Pesto",
              "description": "EVOO, basil pesto, roasted tomatoes, fresh mozzarella, mushrooms",
              "price": "18",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "San Gennaro",
              "description": "Italian tomato sauce, Italian sausage, peppadew pepper, fresh mozzarella, mushrooms, basil, pecorino Romano",
              "price": "18",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Mama Kay's",
              "description": "EVOO, gorgonzola cream, crispy pancetta, roasted mushrooms, fresh mozzarella, baby spinach, pecorino Romano",
              "price": "17",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Goat Cheese-Dates",
              "description": "Goat cheese, ricotta cheese, caramelized onions, dates, bacon, hot-honey drizzle",
              "price": "18",
              "badges": [],
              "spicy_level": 1,
              "extras": []
            },
            {
              "name": "Classic Cheese",
              "description": "Grande whole milk shredded mozzarella, Italian tomato sauce",
              "price": "13",
              "badges": ["V"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "The Roni",
              "description": "Italian tomato sauce, pepperoni, Grande whole milk shredded mozzarella",
              "price": "15",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Add Ons",
          "note": "",
          "items": [
            {
              "name": "Pepperoni",
              "description": "",
              "price": "2",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Italian Sausage",
              "description": "",
              "price": "2",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Roasted Mushrooms",
              "description": "",
              "price": "2",
              "badges": ["V"],
              "spicy_level": 0,
              "extras": []
            }
          ]
        }
      ]
    },
	{
	  "id": "wings",
	  "label": "Wings",
	  "description": "Wood oven fired",
	  "sections": [
		{
		  "title": "Wings",
		  "note": "",
		  "items": [
			{
			  "name": "Traditional Buffalo",
			  "description": "",
			  "price": "",
			  "badges": ["GF"],
			  "spicy_level": 2,
			  "extras": [
				{ "label": "6 Wings", "price": "9" },
				{ "label": "12 Wings", "price": "18" }
			  ]
			},
			{
			  "name": "Garlic Parmesan",
			  "description": "",
			  "price": "",
			  "badges": ["GF"],
			  "spicy_level": 0,
			  "extras": [
				{ "label": "6 Wings", "price": "9" },
				{ "label": "12 Wings", "price": "18" }
			  ]
			},
			{
			  "name": "Korean BBQ",
			  "description": "",
			  "price": "",
			  "badges": [],
			  "spicy_level": 1,
			  "extras": [
				{ "label": "6 Wings", "price": "9" },
				{ "label": "12 Wings", "price": "18" }
			  ]
			},
			{
			  "name": "Nashville Hot",
			  "description": "",
			  "price": "",
			  "badges": [],
			  "spicy_level": 3,
			  "extras": [
				{ "label": "6 Wings", "price": "9" },
				{ "label": "12 Wings", "price": "18" }
			  ]
			},
			{
			  "name": "Southern BBQ",
			  "description": "",
			  "price": "",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": [
				{ "label": "6 Wings", "price": "9" },
				{ "label": "12 Wings", "price": "18" }
			  ]
			}
		  ]
		}
	  ]
	},

	{
	  "id": "apps",
	  "label": "Apps",
	  "description": "",
	  "sections": [
		{
		  "title": "Apps & Snacks",
		  "note": "",
		  "items": [
			{
			  "name": "Fried Green Beans",
			  "description": "Ranch dipping sauce",
			  "price": "9",
			  "badges": ["V"],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Vegetable Egg Rolls",
			  "description": "2 egg rolls, sweet chili sauce",
			  "price": "6",
			  "badges": ["V"],
			  "spicy_level": 1,
			  "extras": []
			},
			{
			  "name": "Edamame",
			  "description": "Steamed soybeans, Maldon sea salt",
			  "price": "7",
			  "badges": ["V", "GF"],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Steamed Pork Pot Stickers",
			  "description": "Ponzu sauce",
			  "price": "11",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Chips & Queso",
			  "description": "Spicy sausage, Rotel tomatoes, queso cheese, crispy tortilla chips",
			  "price": "11",
			  "badges": [],
			  "spicy_level": 2,
			  "extras": []
			},
			{
			  "name": "Mozzarella Cheese Sticks",
			  "description": "Marinara sauce",
			  "price": "10",
			  "badges": ["V"],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Dill French Fries",
			  "description": "",
			  "price": "7",
			  "badges": ["V"],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Soup of the Day",
			  "description": "",
			  "price": "6",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Chips & Salsa",
			  "description": "",
			  "price": "7",
			  "badges": ["V"],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Sweet Potato Fries",
			  "description": "",
			  "price": "7",
			  "badges": ["V"],
			  "spicy_level": 0,
			  "extras": []
			}
		  ]
		}
	  ]
	},

	{
	  "id": "tacos",
	  "label": "Street Tacos",
	  "description": "",
	  "sections": [
		{
		  "title": "Street Tacos",
		  "note": "Comes with 3 flour tacos. May be gluten free if corn tortillas requested.",
		  "items": [
			{
			  "name": "Flank Steak",
			  "description": "Pico de gallo, Monterey Jack cheese, cilantro, salsa verde",
			  "price": "15",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Blackened Shrimp",
			  "description": "Red cabbage, pico de gallo, avocado, Monterey Jack cheese, housemade sriracha mayo",
			  "price": "15",
			  "badges": [],
			  "spicy_level": 1,
			  "extras": []
			}
		  ]
		}
	  ]
	},
	
	
	{
	  "id": "quesadillas",
	  "label": "Quesadillas",
	  "description": "",
	  "sections": [
		{
		  "title": "Quesadillas",
		  "note": "Served with chips & salsa",
		  "items": [
			{
			  "name": "Chicken",
			  "description": "Flour tortilla, shredded chicken, Monterey Jack & cheddar cheese, pico de gallo, sour cream",
			  "price": "14",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Steak",
			  "description": "Flour tortilla, grilled flank steak, Monterey Jack & cheddar cheese, grilled onion, salsa verde, sour cream",
			  "price": "16",
			  "badges": [],
			  "spicy_level": 1,
			  "extras": []
			}
		  ]
		}
	  ]
	},
	
	{
	  "id": "sandwiches",
	  "label": "Sandwiches",
	  "description": "",
	  "sections": [
		{
		  "title": "Sandwiches",
		  "note": "Served with choice of dill fries or chips",
		  "items": [
			{
			  "name": "Hot Italian Melt",
			  "description": "Spicy soppressata, ham, pepperoni, marinated peppers, provolone, arugula, roasted garlic & red pepper aioli on a baguette",
			  "price": "15",
			  "badges": [],
			  "spicy_level": 2,
			  "extras": []
			},
			{
			  "name": "Turkey Bacon Ranch Wrap",
			  "description": "Sliced turkey, ham, Swiss cheese, lettuce, bacon, ranch dressing",
			  "price": "14",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "The Cuban",
			  "description": "Roast pork, ham, Swiss cheese, pickle, mustard, Cuban bread",
			  "price": "15",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Cheesesteak Hoagie",
			  "description": "Flank steak, marinated peppers, onions, white American cheese, hoagie roll",
			  "price": "17",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": []
			}
		  ]
		}
	  ]
	},

	{
	  "id": "pasta",
	  "label": "Pasta",
	  "description": "",
	  "sections": [
		{
		  "title": "Pasta",
		  "note": "",
		  "items": [
			{
			  "name": "Spaghetti Villa Nova",
			  "description": "Original Villa Nova meat sauce, parmesan and melted Grande whole milk mozzarella cheese",
			  "price": "18",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Creamy Mac N Cheese",
			  "description": "Cavatappi pasta, creamy cheddar cheese sauce, shredded chicken, BBQ sauce",
			  "price": "18",
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
			  "name": "The American",
			  "description": "Crispy romaine lettuce, carrots, red cabbage, cucumber, grape tomatoes, shredded cheddar & Jack cheese, chopped bacon, croutons, house-made ranch dressing",
			  "price": "12",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Greek Salad",
			  "description": "Chopped romaine, kalamata olives, grape tomato, cucumber, sliced red onion, bell pepper, crumbled feta cheese, classic Greek dressing",
			  "price": "12",
			  "badges": ["V"],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Apple Walnut",
			  "description": "Mixed baby greens, chopped granny smith apples, candied walnuts, chopped dates, blue cheese crumbles, citrus vinaigrette",
			  "price": "13",
			  "badges": ["V"],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Classic Caesar",
			  "description": "Romaine lettuce, cracked black pepper, croutons, shaved parmesan, creamy Caesar dressing",
			  "price": "12",
			  "badges": ["V"],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Soup & Salad Combo",
			  "description": "Soup of the day and a half of any of our signature salads",
			  "price": "12",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": [
				{ "label": "Add grilled or fried chicken", "price": "6" },
				{ "label": "Add grilled or fried shrimp", "price": "9" }
			  ]
			}
		  ]
		}
	  ]
	},

	{
	  "id": "burgers",
	  "label": "Burgers",
	  "description": "",
	  "sections": [
		{
		  "title": "Burgers",
		  "note": "All burgers have 2 all-beef patties. Served with choice of dill fries or chips.",
		  "items": [
			{
			  "name": "All-American",
			  "description": "Lettuce, tomato, pickle, grilled onion, mayo, American cheese",
			  "price": "15",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": [
				{ "label": "Make it a triple", "price": "4" }
			  ]
			},
			{
			  "name": "Steak Smash",
			  "description": "House-made steak sauce, grilled onions, American cheese",
			  "price": "15",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": [
				{ "label": "Make it a triple", "price": "4" }
			  ]
			},
			{
			  "name": "Mushroom Swiss",
			  "description": "Mushrooms, Swiss cheese, roasted garlic aioli",
			  "price": "15",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": [
				{ "label": "Make it a triple", "price": "4" }
			  ]
			},
			{
			  "name": "Smokey Smash",
			  "description": "Smoked bacon, BBQ sauce, smoked Gouda cheese, dill pickle",
			  "price": "15",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": [
				{ "label": "Make it a triple", "price": "4" }
			  ]
			}
		  ]
		}
	  ]
	},


	{
	  "id": "asian",
	  "label": "Asian",
	  "description": "",
	  "sections": [
		{
		  "title": "Asian",
		  "note": "Served with fried or steamed rice & egg roll",
		  "items": [
			{
			  "name": "House Fried Rice",
			  "description": "Peas, carrots, green onion, egg",
			  "price": "15",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": [
				{ "label": "Protein: Chicken", "price": "0" },
				{ "label": "Protein: Shrimp", "price": "0" }
			  ]
			},
			{
			  "name": "Honey Chicken",
			  "description": "Lightly fried chicken, honey sauce",
			  "price": "16",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "Mongolian Beef",
			  "description": "Sweet soy glaze, garlic, ginger, green onion",
			  "price": "17",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": []
			},
			{
			  "name": "General Tso’s",
			  "description": "Lightly fried chicken, zesty ginger sauce",
			  "price": "16",
			  "badges": [],
			  "spicy_level": 2,
			  "extras": []
			},
			{
			  "name": "Ginger Stir Fry",
			  "description": "Broccoli, napa cabbage, red cabbage, carrots, red bell peppers, green onion, fresh ginger, garlic, sweet soy sauce",
			  "price": "18",
			  "badges": [],
			  "spicy_level": 0,
			  "extras": [
				{ "label": "Protein: Chicken", "price": "0" },
				{ "label": "Protein: Beef", "price": "0" },
				{ "label": "Protein: Shrimp", "price": "0" }
			  ]
			}
		  ]
		}
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
				  class="tab-pane fade <?php echo esc_attr($active); ?>"
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
