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
  "restaurant_name": "The Loft",
  "updated": "2026-01-14",
  "tabs": [
    {
      "id": "food",
      "label": "Food",
      "description": "",
      "download": {
        "href": "https://media-cdn.getbento.com/accounts/1c1399494fd5b9fe83d59486e6681424/media/htYTFD9ESeKGrGDz9Zr4_3FYsdXy6SgO7QzVyJuU4_Loft%2520Menu%25202024%2520%283%29.pdf",
        "text": "Download PDF",
        "target": "_blank"
      },
      "sections": [
        {
          "title": "Opening Acts",
          "note": "",
          "items": [
            {
              "name": "Jalapeno & Cheddar Corn Muffins",
              "description": "Whipped butter.",
              "price": "7.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Cheddar Bacon Tater Tots",
              "description": "Smoked crumble bacon | beer cheddar cheese sauce | ranch drizzle.",
              "price": "11.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Crispy Fried Green Tomatoes",
              "description": "Feta cheese spread | bacon-onion jam.",
              "price": "9.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Smoked Shrimp Cocktail",
              "description": "Jumbo smoked shrimp | chipotle orange cocktail sauce.",
              "price": "15.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Shrimp Tacos",
              "description": "Tempura fried shrimp | chili glaze | napa slaw | soy citrus.",
              "price": "14.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Buffalo Chicken Dip",
              "description": "Celery | warm pita bread.",
              "price": "10.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Chicken Fingers",
              "description": "Honey mustard & cajun mayo dipping sauce.",
              "price": "12.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "The Green Room",
          "note": "Served with choice of grilled organic chicken breast, chicken fingers, or grilled shrimp. *Grilled beef tenderloin tips, please add 10.99.",
          "items": [
            {
              "name": "Caesar",
              "description": "Chopped romaine | house-made garlic croutons | parmesan cheese | classic Caesar dressing.",
              "price": "15.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Southwestern",
              "description": "Iceberg lettuce | romaine lettuce | pepper jack cheese | sliced avocado | chopped bacon | pico de gallo | tortilla strips | mango-habanero ranch.",
              "price": "16.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "The Tanya",
              "description": "Mixed baby lettuces | white cheddar cheese | grape tomatoes | pumpkin seeds | dried cranberries | fresh red bell peppers | house-made balsamic dressing.",
              "price": "15.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Broadway Burgers",
          "note": "You may choose between a 1/2 lb of Angus beef burger, organic chicken breast or Boca veggie burger. Served on a brioche bun.",
          "items": [
            {
              "name": "Chef's Burger*",
              "description": "Please ask your server about today's inspiration.",
              "price": "16.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Classic Bacon Cheese*",
              "description": "Smoked bacon | cheddar cheese | lettuce | tomato | red onion | pickles.",
              "price": "15.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Pimento Cheese Burger*",
              "description": "House-made pimento cheese | bacon-onion jam.",
              "price": "15.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Ham & Cheese*",
              "description": "Smoked ham | swiss cheese | spicy honey mustard | lettuce | tomato | red onion | pickles.",
              "price": "16.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Sandwiches & Wraps",
          "note": "",
          "items": [
            {
              "name": "Gulf Coast Fish Sandwich",
              "description": "Grilled mahi-mahi filet | lettuce | tomato | tartar sauce | brioche bun.",
              "price": "16.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Southwest Chicken Wrap",
              "description": "Sliced organic chicken | pepper jack cheese | chopped bacon | shredded lettuce | avocado | pico de gallo | tortilla strips | mango-habanero ranch | whole wheat tortilla.",
              "price": "16.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Spicy Fried Chicken Sandwich",
              "description": "Ranch dressing | lettuce | tomatoes | pickles | brioche bun.",
              "price": "15.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Cuban Pork Wrap",
              "description": "Sliced roast pork | smoked ham | Swiss cheese | spicy honey mustard | pickles | whole wheat tortilla.",
              "price": "15.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Main Stage",
          "note": "",
          "items": [
            {
              "name": "Seared Salmon*",
              "description": "Lemon-butter | sauteed baby spinach | mashed potatoes.",
              "price": "26.99",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Fork Tender BBQ St. Louis Ribs",
              "description": "1/2 rack | BBQ sauce | French fries | creamy slaw.",
              "price": "22.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Unstuffed Chicken",
              "description": "Spinach | goat cheese | mashed potatoes | lemon-butter.",
              "price": "23.99",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Cajun Shrimp Pasta",
              "description": "Sauteed shrimp | andouille sausage | pepper & onion medley | spicy cream sauce | pappardelle pasta.",
              "price": "26.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Braised Lamb Shank",
              "description": "Mashed potatoes | Brussels sprouts | red wine sauce.",
              "price": "29.99",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Herb Crusted Double Cut Pork Chop*",
              "description": "Roasted shallot port wine sauce | cheese grits.",
              "price": "27.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Grilled Filet Medallions*",
              "description": "Two 4oz medallions | mushroom red wine demi | choice of two sides.",
              "price": "30.99",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Ribeye (16oz)*",
              "description": "Choice of two sides.",
              "price": "41.00",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Sides",
          "note": "",
          "items": [
            {
              "name": "Mashed Potatoes",
              "description": "",
              "price": "3.99",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Soulful Mac N Cheese",
              "description": "",
              "price": "3.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Sauteed Button Mushrooms",
              "description": "",
              "price": "3.99",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Spicy Creamed Corn",
              "description": "",
              "price": "3.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Green Beans",
              "description": "",
              "price": "3.99",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Brussels Sprouts, Bacon & Hot Honey",
              "description": "",
              "price": "3.99",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Sauteed Baby Spinach",
              "description": "",
              "price": "3.99",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "French Fries",
              "description": "",
              "price": "3.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Sweet Potato Fries",
              "description": "",
              "price": "3.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "White Cheddar Grits",
              "description": "",
              "price": "3.99",
              "badges": ["GF"],
              "spicy_level": 0,
              "extras": []
            }
          ]
        }
      ],
      "footnotes": [
        "All burgers, sandwiches, and wraps served with a choice of side.",
        "20% automatic gratuity added to parties of 8 or more. These items are served raw or undercooked. Consuming raw or undercooked meats, poultry, seafood, shellfish, or eggs may increase your risk of foodborne illness, especially if you have certain medical conditions."
      ]
    },
    {
      "id": "drinks",
      "label": "Drinks",
      "description": "",
      "sections": [
        {
          "title": "Premium & Domestic Beer By the Bottle",
          "note": "",
          "items": [
            {
              "name": "Premium",
              "description": "Angry Orchard, Corona, Dos Equis lager, Guinness, Heineken, Modelo Especial, Shiner Bock, Stella Artois, Yuengling, Voodoo Ranger IPA.",
              "price": "5.25",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Domestic",
              "description": "Budweiser, Bud Light, Coors Light, Miller High Life, Miller Lite, PBR, Michelob Ultra* (4.5).",
              "price": "4.25",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Non - Alcoholic Beer",
          "note": "",
          "items": [
            {
              "name": "Heineken 0.0",
              "description": "",
              "price": "5.50",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Stella NA",
              "description": "",
              "price": "5.50",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Sam Adams Just The Haze",
              "description": "",
              "price": "5.50",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Cocktails",
          "note": "",
          "items": [
            {
              "name": "Bourbon's Unchained Melody",
              "description": "Maker's Mark bourbon | lime juice | simple | mint | cucumber.",
              "price": "10.00",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Walking on Sunshine Spritz",
              "description": "Grey Goose vodka | apricot fruitful liqueur | peach de vigne liqueur | lime juice.",
              "price": "13.00",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Pretty in Pink Lemonade",
              "description": "Strawberry Parrot Bay rum | strawberry fruitful liqueur | simple | lemon juice | Sprite.",
              "price": "10.00",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Watermelon Crawl Margarita",
              "description": "Camarena tequila | Watermelon Pucker | lime juice | simple | sour mix.",
              "price": "12.00",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Purple Haze Martini",
              "description": "Gray Whale gin | triple sec | blackberry puree | lemon juice | simple.",
              "price": "12.00",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Old Time Rock & Roll Old Fashion",
              "description": "Old Forester bourbon | Angostura bitters | simple.",
              "price": "13.00",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Peach Mambo #9 Mojito",
              "description": "Denizen rum | peach de vigne liqueur | peach puree | lime juice | simple | mint.",
              "price": "11.00",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Brown Eyed Girl Bourbon",
              "description": "Blade & Bow bourbon | ginger fruitful liqueur | lemon juice | simple.",
              "price": "11.00",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Twist & Shout Mule",
              "description": "New Amsterdam vodka | ginger fruitful liqueur | rosemary simple | lemon juice | Fever-Tree ginger beer.",
              "price": "11.00",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Seltzers & Hard Teas",
          "note": "",
          "items": [
            {
              "name": "High Noon",
              "description": "Black cherry, peach, pineapple, watermelon.",
              "price": "6.00",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Sun Cruiser Lemonade Tea",
              "description": "",
              "price": "6.00",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Red Wine",
          "note": "",
          "items": [
            {
              "name": "J Vineyards",
              "description": "Pinot noir | California. Glass $12 / Bottle $46.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Love Oregon",
              "description": "Pinot noir | Willamette Valley, Oregon. Glass $13 / Bottle $50.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Oberon",
              "description": "Cabernet sauvignon | Napa Valley, California. Glass $13 / Bottle $50.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "San Simeon",
              "description": "Cabernet sauvignon | Paso Robles, California. Glass $12 / Bottle $46.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Highlands 41, Black Granite",
              "description": "Red blend | Paso Robles, California. Glass $11 / Bottle $42.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Sterling",
              "description": "Merlot | Napa Valley, California. Glass $11 / Bottle $42.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Unshackled",
              "description": "Red blend | California. Glass $12 / Bottle $46.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "White Wine",
          "note": "",
          "items": [
            {
              "name": "Diora",
              "description": "Chardonnay | Monterey, California. Glass $12 / Bottle $46.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Frei Brothers Reserve",
              "description": "Chardonnay | Russian River Valley, California. Glass $13 / Bottle $50.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Whitehaven",
              "description": "Sauvignon blanc | Marlborough, New Zealand. Glass $12 / Bottle $46.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "The Champion",
              "description": "Sauvignon blanc | Marlborough, New Zealand. Glass $13 / Bottle $50.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Barone Fini",
              "description": "Pinot grigio | Valdadige, Italy. Glass $10 / Bottle $38.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Escher Haus",
              "description": "Riesling | Rheinhessen, Germany. Glass $10 / Bottle $38.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "The Pale",
              "description": "Rose | Provence, France. Glass $12 / Bottle $46.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Sparkling",
          "note": "",
          "items": [
            {
              "name": "Placido",
              "description": "Moscato d'Asti | Italy. Glass $11 / Bottle $42.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "La Marca",
              "description": "Prosecco | DOC, Italy. Glass $11 / Bottle $42.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            },
            {
              "name": "Marenco Brachetto d'Acqui",
              "description": "Pineto | Italy. Glass $11 / Bottle $42.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        }
      ],
      "footnotes": [
        "All alcohol sales are final."
      ]
    },
    {
      "id": "weekly-specials",
      "label": "Weekly Specials",
      "description": "",
      "sections": [
        {
          "title": "Uptown Blues Plates",
          "note": "",
          "items": [
            {
              "name": "Made fresh daily.",
              "description": "Limited availability.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Tuesday",
          "note": "",
          "items": [
            {
              "name": "Smothered Chicken",
              "description": "Grilled chicken breast | sauteed peppers & onions | melted Swiss cheese | mashed potatoes | green beans | bacon | hot honey.",
              "price": "20.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Wednesday",
          "note": "",
          "items": [
            {
              "name": "Roast Pork Tenderloin",
              "description": "Mashed potatoes | Brussels sprouts | apricot - mustard glaze.",
              "price": "20.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Thursday",
          "note": "",
          "items": [
            {
              "name": "Chef's Choice Pasta of The Day",
              "description": "Side house salad. Priced weekly.",
              "price": "",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Friday",
          "note": "",
          "items": [
            {
              "name": "Shrimp & Grits",
              "description": "Cheesy grits | tomato & andouille sausage gravy | side house salad.",
              "price": "22.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
            }
          ]
        },
        {
          "title": "Saturday",
          "note": "",
          "items": [
            {
              "name": "Ultimate Surf N Turf",
              "description": "4oz filet medallion | Maryland-style crab cake | grilled shrimp | lemon butter | choice of two sides.",
              "price": "35.99",
              "badges": [],
              "spicy_level": 0,
              "extras": []
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
				<li class="" role="presentation">
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
											  // show up to 3 spicy markers
											  $count = min(max($spicy, 1), 3);
											  echo trim(str_repeat('Spicy ', $count));
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
