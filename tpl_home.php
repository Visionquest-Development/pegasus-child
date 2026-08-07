<?php
/*
	Template Name: Home Page
*/
get_header();
?>

<div class="sp sp-page" data-screen-label="Home">

	<?php /* ── HERO ─────────────────────────────────────────────────── */ ?>
	<?php
		$hero_eyebrow   = sp_home_hero( 'eyebrow',   'Bistro &middot; Bakery &middot; Est. 2024' );
		$hero_headline  = sp_home_hero( 'headline',  'Pastries by day,<br/><em>petit d&icirc;ner</em> by night.' );
		$hero_body      = sp_home_hero( 'body',      'Small-batch tarts, sourdough, and slow-cooked bistro plates from the corner of Broadway and 11th. Made in Columbus, Georgia &mdash; served the French way.' );
		$hero_btn1_text = sp_home_hero( 'btn1_text', 'Shop the Bakery' );
		$hero_btn1_link = sp_home_hero( 'btn1_link', '#' );
		$hero_btn2_text = sp_home_hero( 'btn2_text', 'Reserve a Table' );
		$hero_btn2_link = sp_home_hero( 'btn2_link', '#' );
		$hero_facts = get_post_meta( get_the_ID(), '_sp_home_hero_facts', true );
		if ( ! is_array( $hero_facts ) || empty( $hero_facts ) ) {
			$hero_facts = array(
				array( 'num' => '14',   'label' => 'Daily breads' ),
				array( 'num' => '32',   'label' => 'Pastry varieties' ),
				array( 'num' => '1040', 'label' => 'Broadway, CGA' ),
			);
		}
		$hero_image    = sp_home_hero( 'image' );
		$hero_image_id = get_post_meta( get_the_ID(), '_sp_home_hero_image_id', true );
	?>
	<section class="sp-hero position-relative">
		<div class="container sp-hero__inner position-relative">
			<div class="row align-items-center g-5">
				<div class="col-12 col-md-6 order-2 order-md-1">
					<span class="sp-eyebrow"><?php echo wp_kses_post( $hero_eyebrow ); ?></span>
					<h1 class="sp-hero__title fw-normal mt-4"><?php echo wp_kses_post( $hero_headline ); ?></h1>
					<p class="sp-hero__body mt-4"><?php echo wp_kses_post( $hero_body ); ?></p>
					<div class="d-flex flex-wrap gap-3 mt-4">
						<?php if ( $hero_btn1_text ) : ?>
							<a href="<?php echo esc_url( $hero_btn1_link ); ?>" class="sp-btn sp-btn--primary"><?php echo esc_html( $hero_btn1_text ); ?></a>
						<?php endif; ?>
						<?php if ( $hero_btn2_text ) : ?>
							<a href="<?php echo esc_url( $hero_btn2_link ); ?>" class="sp-btn sp-btn--ghost"><?php echo esc_html( $hero_btn2_text ); ?></a>
						<?php endif; ?>
					</div>
					<div class="sp-hero__facts d-flex flex-wrap mt-5 pt-4">
						<?php foreach ( $hero_facts as $fact ) :
							$num   = isset( $fact['num'] )   ? $fact['num']   : '';
							$label = isset( $fact['label'] ) ? $fact['label'] : '';
							if ( '' === $num && '' === $label ) continue; ?>
							<div>
								<div class="sp-script sp-hero__fact-num"><?php echo esc_html( $num ); ?></div>
								<div class="sp-eyebrow mt-1"><?php echo esc_html( $label ); ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="col-12 col-md-6 order-1 order-md-2">
					<?php if ( $hero_image ) : ?>
						<?php $alt = $hero_image_id ? get_post_meta( $hero_image_id, '_wp_attachment_image_alt', true ) : ''; ?>
						<img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( $alt ); ?>" class="d-block w-100 h-auto rounded" />
					<?php else : ?>
						<div class="sp-photo sp-photo--brown sp-hero__placeholder rounded">
							<span class="sp-photo__label">Hero image placeholder</span>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php /* ── MARQUEE / VALUE STRIP ──────────────────────────────────── */ ?>
	<?php
		$sp_marquee_rows = sp_home_group( '_sp_home_marquee_phrases', array(
			array( 'text' => 'Sourdough fired at 5am' ),
			array( 'text' => 'French butter, local cream' ),
			array( 'text' => 'Wine list curated weekly' ),
			array( 'text' => 'Saltcellar family of restaurants' ),
			array( 'text' => 'Open six days a week' ),
		) );
		$sp_marquee = array();
		foreach ( $sp_marquee_rows as $sp_row ) {
			$sp_txt = isset( $sp_row['text'] ) ? trim( $sp_row['text'] ) : '';
			if ( '' !== $sp_txt ) {
				$sp_marquee[] = $sp_txt;
			}
		}
		ob_start();
		foreach ( $sp_marquee as $sp_i => $sp_phrase ) :
			$tone = ( $sp_i % 2 === 0 ) ? 'sage' : 'pink'; ?>
			<span><?php echo esc_html( $sp_phrase ); ?></span>
			<span class="sp-marquee__star sp-marquee__star--<?php echo esc_attr( $tone ); ?>" aria-hidden="true">&#10022;</span>
		<?php endforeach;
		$sp_marquee_set = ob_get_clean();
	?>
	<section class="sp-marquee overflow-hidden py-3">
		<div class="sp-marquee__track">
			<div class="sp-marquee__inner d-flex align-items-center text-uppercase"><?php echo $sp_marquee_set; ?></div>
			<div class="sp-marquee__inner d-flex align-items-center text-uppercase" aria-hidden="true"><?php echo $sp_marquee_set; ?></div>
		</div>
	</section>

	<?php /* ── STORY STRIP ────────────────────────────────────────────── */ ?>
	<?php
		$story_eyebrow   = sp_home_meta( '_sp_home_story_eyebrow', 'Our Story' );
		$story_title     = sp_home_meta( '_sp_home_story_title', 'A bakery on a bicycle,<br/><em>now with a bistro attached.</em>' );
		$story_body      = sp_home_meta( '_sp_home_story_body', 'Sugarpeddler started in 2018 as a one-person operation &mdash; desserts delivered around downtown Columbus by bicycle. In 2024 we took over the dining room next door, hired a French-trained chef, and started baking bread at 5am. The bistro opens at lunch.' );
		$story_body2     = sp_home_meta( '_sp_home_story_body2', 'We&rsquo;re proud to be part of the same family as <strong>The Loft</strong>, <strong>Mabella Italian Steakhouse</strong>, and <strong>Saltcellar</strong>.' );
		$story_link_text = sp_home_meta( '_sp_home_story_link_text', 'Read the full story' );
		$story_link_url  = sp_home_meta( '_sp_home_story_link_url', '#' );
		$story_image     = sp_home_meta( '_sp_home_story_image' );
		$story_image_id  = get_post_meta( get_the_ID(), '_sp_home_story_image_id', true );
	?>
	<section class="sp-story position-relative">
		<div class="container">
			<div class="row align-items-center g-5">
				<div class="col-12 col-md-6">
					<?php if ( $story_image ) : ?>
						<?php $story_alt = $story_image_id ? get_post_meta( $story_image_id, '_wp_attachment_image_alt', true ) : ''; ?>
						<img src="<?php echo esc_url( $story_image ); ?>" alt="<?php echo esc_attr( $story_alt ); ?>" class="d-block w-100 h-auto rounded sp-story__img" />
					<?php else : ?>
						<div class="sp-photo sp-photo--cream sp-story__img rounded">
							<span class="sp-photo__label">Story image &mdash; kitchen detail</span>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-12 col-md-6">
					<span class="sp-eyebrow"><?php echo wp_kses_post( $story_eyebrow ); ?></span>
					<h2 class="sp-story__title mt-3"><?php echo wp_kses_post( $story_title ); ?></h2>
					<p class="sp-story__body mt-4"><?php echo wp_kses_post( $story_body ); ?></p>
					<?php if ( $story_body2 ) : ?>
						<p class="sp-story__body mt-3"><?php echo wp_kses_post( $story_body2 ); ?></p>
					<?php endif; ?>
					<?php if ( $story_link_text ) : ?>
						<a href="<?php echo esc_url( $story_link_url ); ?>" class="sp-story__link d-inline-flex align-items-center text-uppercase mt-4 pb-2">
							<?php echo esc_html( $story_link_text ); ?>
							<svg width="18" height="10" viewBox="0 0 18 10" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M1 5h16m0 0L13 1m4 4l-4 4"/></svg>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php /* ── FEATURED PRODUCTS ──────────────────────────────────────── */ ?>
	<?php
		$products_eyebrow    = sp_home_meta( '_sp_home_products_eyebrow', 'From the bakery' );
		$products_title      = sp_home_meta( '_sp_home_products_title', 'This week&rsquo;s <em>petits plaisirs</em>' );
		$products_intro      = sp_home_meta( '_sp_home_products_intro', 'A rotating selection of what came out of the oven this morning. Pre-order by 4pm for next-day pickup.' );
		$products_btn_text   = sp_home_meta( '_sp_home_products_footer_btn_text', 'Shop all 84 items' );
		$products_btn_link   = sp_home_meta( '_sp_home_products_footer_btn_link', '' );
	?>
	<section class="sp-products position-relative">
		<div class="container">
			<div class="sp-section-head">
				<div class="sp-divider"><span class="sp-eyebrow"><?php echo wp_kses_post( $products_eyebrow ); ?></span></div>
				<h2><?php echo wp_kses_post( $products_title ); ?></h2>
				<p class="sp-section-head__body mx-auto">
					<?php echo wp_kses_post( $products_intro ); ?>
				</p>
			</div>

			<div class="row g-4 mt-4">
				<?php
				$sp_products = array(
					array(
						'category'      => 'Tart',
						'name'          => 'Strawberry &amp; basil tart',
						'price'         => '$8',
						'old_price'     => '',
						'badge_label'   => 'New',
						'badge_tone'    => '',
						'photo_variant' => '',
						'tagline'       => 'Strawberry tart, top-down',
					),
					array(
						'category'      => 'Cheesecake',
						'name'          => 'Mama Kay&rsquo;s cheesecake',
						'price'         => '$9',
						'old_price'     => '',
						'badge_label'   => '',
						'badge_tone'    => '',
						'photo_variant' => 'sp-photo--cream',
						'tagline'       => 'Sliced cheesecake',
					),
					array(
						'category'      => 'Bread',
						'name'          => 'Country sourdough boule',
						'price'         => '$11',
						'old_price'     => '$14',
						'badge_label'   => 'Sale',
						'badge_tone'    => '',
						'photo_variant' => 'sp-photo--brown',
						'tagline'       => 'Sourdough loaf',
					),
					array(
						'category'      => 'Confection',
						'name'          => 'Pistachio macarons (6)',
						'price'         => '$18',
						'old_price'     => '',
						'badge_label'   => 'GF',
						'badge_tone'    => 'gf',
						'photo_variant' => 'sp-photo--cream',
						'tagline'       => 'Macaron box',
					),
				);
				foreach ( $sp_products as $p ) : ?>
					<div class="col-12 col-sm-6 col-lg-3">
						<article class="sp-card">
							<div class="sp-card__img sp-photo position-relative">
								<?php if ( $p['badge_label'] ) : ?>
									<span class="sp-badge<?php echo $p['badge_tone'] ? ' sp-badge--' . esc_attr( $p['badge_tone'] ) : ''; ?>"><?php echo esc_html( $p['badge_label'] ); ?></span>
								<?php endif; ?>
								<div class="sp-photo <?php echo esc_attr( $p['photo_variant'] ); ?> position-absolute top-0 start-0 w-100 h-100">
									<span class="sp-photo__label"><?php echo esc_html( $p['tagline'] ); ?></span>
								</div>
							</div>
							<div>
								<div class="sp-card__cat"><?php echo esc_html( $p['category'] ); ?></div>
								<h3 class="sp-card__title mt-1"><?php echo $p['name']; // entities intentional ?></h3>
							</div>
							<div class="sp-card__row">
								<div class="sp-card__price">
									<?php if ( $p['old_price'] ) : ?><s><?php echo esc_html( $p['old_price'] ); ?></s><?php endif; ?>
									<?php echo esc_html( $p['price'] ); ?>
								</div>
								<button class="sp-card__add">Add</button>
							</div>
						</article>
					</div>
				<?php endforeach; ?>
			</div>

			<?php if ( $products_btn_text ) : ?>
				<div class="d-flex justify-content-center mt-5">
					<?php if ( $products_btn_link ) : ?>
						<a href="<?php echo esc_url( $products_btn_link ); ?>" class="sp-btn sp-btn--dark"><?php echo esc_html( $products_btn_text ); ?></a>
					<?php else : ?>
						<button class="sp-btn sp-btn--dark"><?php echo esc_html( $products_btn_text ); ?></button>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php /* ── BISTRO INTRO ─────────────────────────────────────────── */ ?>
	<?php
		$bistro_image        = sp_home_meta( '_sp_home_bistro_image' );
		$bistro_image_id     = get_post_meta( get_the_ID(), '_sp_home_bistro_image_id', true );
		$bistro_chalk_script = sp_home_meta( '_sp_home_bistro_chalk_script', 'Today&rsquo;s' );
		$bistro_chalk_title  = sp_home_meta( '_sp_home_bistro_chalk_title', 'Plat du jour' );
		$bistro_eyebrow      = sp_home_meta( '_sp_home_bistro_eyebrow', 'The Bistro' );
		$bistro_title        = sp_home_meta( '_sp_home_bistro_title', 'Lunch &amp; dinner,<br/><em>French at heart.</em>' );
		$bistro_body         = sp_home_meta( '_sp_home_bistro_body', 'A short, seasonal menu of sandwiches, cassoulets, ni&ccedil;oises, and whatever the chef picked up at the farmers&rsquo; market this week. Wines by the glass start at $8.' );
		$bistro_btn1_text    = sp_home_meta( '_sp_home_bistro_btn1_text', 'See the menu' );
		$bistro_btn1_link    = sp_home_meta( '_sp_home_bistro_btn1_link', '' );
		$bistro_btn2_text    = sp_home_meta( '_sp_home_bistro_btn2_text', 'Reserve' );
		$bistro_btn2_link    = sp_home_meta( '_sp_home_bistro_btn2_link', '' );
	?>
	<section class="sp-bistro position-relative">
		<div class="row g-0 align-items-stretch sp-bistro__row">
			<div class="col-12 col-lg-4">
				<?php if ( $bistro_image ) : ?>
					<?php $bistro_alt = $bistro_image_id ? get_post_meta( $bistro_image_id, '_wp_attachment_image_alt', true ) : ''; ?>
					<img src="<?php echo esc_url( $bistro_image ); ?>" alt="<?php echo esc_attr( $bistro_alt ); ?>" class="sp-bistro__photo h-100 w-100" style="object-fit:cover;" />
				<?php else : ?>
					<div class="sp-photo sp-photo--dark sp-bistro__photo h-100">
						<span class="sp-photo__label">Bistro dining room &mdash; evening</span>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-12 col-lg-4 d-flex align-items-center justify-content-center py-5">
				<div class="sp-chalk sp-bistro__chalk">
					<div class="text-center mb-4">
						<span class="sp-bistro__chalk-script"><?php echo wp_kses_post( $bistro_chalk_script ); ?></span>
						<div class="sp-bistro__chalk-title fst-italic"><?php echo wp_kses_post( $bistro_chalk_title ); ?></div>
						<div class="sp-bistro__chalk-rule mx-auto"></div>
					</div>
					<ul class="sp-bistro__menu list-unstyled d-flex flex-column m-0 p-0">
						<?php
						$sp_specials = array(
							array( 'Croque Madame',  '12' ),
							array( 'Ni&ccedil;oise Salad', '16' ),
							array( 'Coq au Vin',     '24' ),
							array( 'Tarte Tatin',    '9' ),
						);
						foreach ( $sp_specials as $sp_special ) : ?>
							<li class="sp-bistro__menu-item d-flex align-items-baseline">
								<span class="fst-italic"><?php echo $sp_special[0]; // entity intentional ?></span>
								<span class="sp-bistro__dots flex-grow-1"></span>
								<span class="sp-bistro__price"><?php echo esc_html( $sp_special[1] ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="col-12 col-lg-4 d-flex align-items-center sp-bistro__copy">
				<div>
					<span class="sp-eyebrow sp-bistro__eyebrow"><?php echo wp_kses_post( $bistro_eyebrow ); ?></span>
					<h2 class="sp-bistro__title mt-3"><?php echo wp_kses_post( $bistro_title ); ?></h2>
					<p class="sp-bistro__body mt-4"><?php echo wp_kses_post( $bistro_body ); ?></p>
					<div class="d-flex flex-wrap gap-3 mt-4">
						<?php if ( $bistro_btn1_text ) : ?>
							<?php if ( $bistro_btn1_link ) : ?>
								<a href="<?php echo esc_url( $bistro_btn1_link ); ?>" class="sp-btn sp-btn--primary"><?php echo esc_html( $bistro_btn1_text ); ?></a>
							<?php else : ?>
								<button class="sp-btn sp-btn--primary"><?php echo esc_html( $bistro_btn1_text ); ?></button>
							<?php endif; ?>
						<?php endif; ?>
						<?php if ( $bistro_btn2_text ) : ?>
							<?php if ( $bistro_btn2_link ) : ?>
								<a href="<?php echo esc_url( $bistro_btn2_link ); ?>" class="sp-btn sp-btn--ghost-light"><?php echo esc_html( $bistro_btn2_text ); ?></a>
							<?php else : ?>
								<button class="sp-btn sp-btn--ghost-light"><?php echo esc_html( $bistro_btn2_text ); ?></button>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php /* ── EDITORIAL ────────────────────────────────────────────── */ ?>
	<?php
		$editorial_banner_text = sp_home_meta( '_sp_home_editorial_banner_text', 'Spring menu &middot; in season now' );
		$editorial_banner_list = sp_home_meta( '_sp_home_editorial_banner_list', 'Strawberry &middot; Asparagus &middot; Basil &middot; Rhubarb' );
		$sp_editorial = sp_home_group( '_sp_home_editorial_columns', array(
			array(
				'eyebrow' => 'Process',
				'title'   => 'Long ferments, slow days',
				'body'    => 'Our sourdough proofs for 36 hours. Croissants get three days. Patience is the secret ingredient &mdash; and the only one we won&rsquo;t put on the label.',
			),
			array(
				'eyebrow' => 'Sourcing',
				'title'   => 'A short ingredient list',
				'body'    => 'Butter from Vermont, flour from Carolina Ground, honey from a beekeeper in Cataula. We name them on the menu because they deserve it.',
			),
			array(
				'eyebrow' => 'Community',
				'title'   => 'Born on Broadway',
				'body'    => 'We share a kitchen line with three other restaurants in the Uptown Life family. When you eat here, you support a whole block of cooks.',
			),
		) );
	?>
	<section class="sp-editorial">
		<div class="container">
			<div class="sp-editorial__banner d-inline-flex align-items-center rounded-pill text-uppercase mb-5">
				<span class="sp-editorial__banner-icon rounded-circle d-inline-flex align-items-center justify-content-center">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
						<path d="M12 22c5-3 8-7 8-12V5l-8 3-8-3v5c0 5 3 9 8 12z"/>
						<path d="M12 11v11"/>
					</svg>
				</span>
				<span><?php echo wp_kses_post( $editorial_banner_text ); ?></span>
				<span class="sp-editorial__banner-dash fw-normal">&mdash;</span>
				<span class="sp-editorial__banner-list fw-normal"><?php echo wp_kses_post( $editorial_banner_list ); ?></span>
			</div>

			<div class="row g-4">
				<?php
				foreach ( $sp_editorial as $sp_idx => $sp_col ) :
					$sp_col = wp_parse_args( $sp_col, array( 'eyebrow' => '', 'title' => '', 'body' => '' ) ); ?>
					<div class="col-12 col-md-4">
						<article class="d-flex flex-column gap-3">
							<div class="sp-editorial__head d-flex align-items-center">
								<span class="sp-script sp-editorial__num">0<?php echo (int) $sp_idx + 1; ?></span>
								<span class="sp-eyebrow"><?php echo esc_html( $sp_col['eyebrow'] ); ?></span>
							</div>
							<h3 class="sp-editorial__title fst-italic fw-normal"><?php echo esc_html( $sp_col['title'] ); ?></h3>
							<p class="sp-editorial__body"><?php echo $sp_col['body']; // entities intentional ?></p>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php /* ── VISIT US ─────────────────────────────────────────────── */ ?>
	<?php
		$visit_eyebrow   = sp_home_meta( '_sp_home_visit_eyebrow', 'Find us' );
		$visit_title     = sp_home_meta( '_sp_home_visit_title', 'On the corner of <em>Broadway &amp; 11th.</em>' );
		$visit_body      = sp_home_meta( '_sp_home_visit_body', 'Three blocks south of the RiverCenter, with parking on 11th and a covered patio when the weather behaves.' );
		$visit_btn1_text = sp_home_meta( '_sp_home_visit_btn1_text', 'Get directions' );
		$visit_btn1_link = sp_home_meta( '_sp_home_visit_btn1_link', '' );
		$visit_btn2_text = sp_home_meta( '_sp_home_visit_btn2_text', 'Call (706) 984-8004' );
		$visit_btn2_link = sp_home_meta( '_sp_home_visit_btn2_link', '' );
		$visit_address   = sp_home_meta( '_sp_home_visit_address', '1040 Broadway<br/>Columbus, GA 31901' );
		$visit_hours     = sp_home_meta( '_sp_home_visit_hours', 'Mon &ndash; Sat<br/>11 &ndash; 9:45<br/><span class="sp-visit__info-muted">Sunday closed</span>' );
	?>
	<section class="sp-visit">
		<div class="container">
			<div class="sp-visit__card position-relative overflow-hidden rounded">
				<div class="row align-items-center g-5">
					<div class="col-12 col-md-7 position-relative">
						<span class="sp-eyebrow"><?php echo wp_kses_post( $visit_eyebrow ); ?></span>
						<h2 class="sp-visit__title mt-3"><?php echo wp_kses_post( $visit_title ); ?></h2>
						<p class="sp-visit__body mt-4"><?php echo wp_kses_post( $visit_body ); ?></p>
						<div class="d-flex flex-wrap gap-3 mt-4">
							<?php if ( $visit_btn1_text ) : ?>
								<?php if ( $visit_btn1_link ) : ?>
									<a href="<?php echo esc_url( $visit_btn1_link ); ?>" class="sp-btn sp-btn--dark"><?php echo esc_html( $visit_btn1_text ); ?></a>
								<?php else : ?>
									<button class="sp-btn sp-btn--dark"><?php echo esc_html( $visit_btn1_text ); ?></button>
								<?php endif; ?>
							<?php endif; ?>
							<?php if ( $visit_btn2_text ) : ?>
								<?php if ( $visit_btn2_link ) : ?>
									<a href="<?php echo esc_url( $visit_btn2_link ); ?>" class="sp-btn sp-btn--ghost"><?php echo esc_html( $visit_btn2_text ); ?></a>
								<?php else : ?>
									<button class="sp-btn sp-btn--ghost"><?php echo esc_html( $visit_btn2_text ); ?></button>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-12 col-md-5 position-relative">
						<div class="row g-4">
							<div class="col-6">
								<div class="sp-eyebrow mb-3">Address</div>
								<div class="sp-visit__info">
									<?php echo wp_kses_post( $visit_address ); ?>
								</div>
							</div>
							<div class="col-6">
								<div class="sp-eyebrow mb-3">Hours</div>
								<div class="sp-visit__info">
									<?php echo wp_kses_post( $visit_hours ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div><?php /* .sp.sp-page */ ?>

<?php get_footer(); ?>
