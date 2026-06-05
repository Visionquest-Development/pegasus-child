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
	<section class="sp-marquee overflow-hidden py-3">
		<div class="sp-marquee__inner d-flex flex-wrap justify-content-center align-items-center text-uppercase">
			<?php
			$sp_marquee = array(
				'Sourdough fired at 5am',
				'French butter, local cream',
				'Wine list curated weekly',
				'Saltcellar family of restaurants',
				'Open six days a week',
			);
			$sp_marquee_last = count( $sp_marquee ) - 1;
			foreach ( $sp_marquee as $sp_i => $sp_phrase ) : ?>
				<span><?php echo esc_html( $sp_phrase ); ?></span>
				<?php if ( $sp_i < $sp_marquee_last ) :
					$tone = ( $sp_i % 2 === 0 ) ? 'sage' : 'pink'; ?>
					<span class="sp-marquee__star sp-marquee__star--<?php echo esc_attr( $tone ); ?>">&#10022;</span>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</section>

	<?php /* ── STORY STRIP ────────────────────────────────────────────── */ ?>
	<section class="sp-story position-relative">
		<div class="container">
			<div class="row align-items-center g-5">
				<div class="col-12 col-md-6">
					<div class="sp-photo sp-photo--cream sp-story__img rounded">
						<span class="sp-photo__label">Story image &mdash; kitchen detail</span>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<span class="sp-eyebrow">Our Story</span>
					<h2 class="sp-story__title mt-3">
						A bakery on a bicycle,<br/>
						<em>now with a bistro attached.</em>
					</h2>
					<p class="sp-story__body mt-4">
						Sugarpeddler started in 2018 as a one-person operation &mdash; desserts
						delivered around downtown Columbus by bicycle. In 2024 we took
						over the dining room next door, hired a French-trained chef, and
						started baking bread at 5am. The bistro opens at lunch.
					</p>
					<p class="sp-story__body mt-3">
						We&rsquo;re proud to be part of the same family as <strong>The Loft</strong>,
						<strong>Mabella Italian Steakhouse</strong>, and <strong>Saltcellar</strong>.
					</p>
					<a href="#" class="sp-story__link d-inline-flex align-items-center text-uppercase mt-4 pb-2">
						Read the full story
						<svg width="18" height="10" viewBox="0 0 18 10" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M1 5h16m0 0L13 1m4 4l-4 4"/></svg>
					</a>
				</div>
			</div>
		</div>
	</section>

	<?php /* ── FEATURED PRODUCTS ──────────────────────────────────────── */ ?>
	<section class="sp-products position-relative">
		<div class="container">
			<div class="sp-section-head">
				<div class="sp-divider"><span class="sp-eyebrow">From the bakery</span></div>
				<h2>This week&rsquo;s <em>petits plaisirs</em></h2>
				<p class="sp-section-head__body mx-auto">
					A rotating selection of what came out of the oven this morning. Pre-order by 4pm for next-day pickup.
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

			<div class="d-flex justify-content-center mt-5">
				<button class="sp-btn sp-btn--dark">Shop all 84 items</button>
			</div>
		</div>
	</section>

	<?php /* ── BISTRO INTRO ─────────────────────────────────────────── */ ?>
	<section class="sp-bistro position-relative">
		<div class="row g-0 align-items-stretch sp-bistro__row">
			<div class="col-12 col-lg-4">
				<div class="sp-photo sp-photo--dark sp-bistro__photo h-100">
					<span class="sp-photo__label">Bistro dining room &mdash; evening</span>
				</div>
			</div>
			<div class="col-12 col-lg-4 d-flex align-items-center justify-content-center py-5">
				<div class="sp-chalk sp-bistro__chalk">
					<div class="text-center mb-4">
						<span class="sp-bistro__chalk-script">Today&rsquo;s</span>
						<div class="sp-bistro__chalk-title fst-italic">Plat du jour</div>
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
					<span class="sp-eyebrow sp-bistro__eyebrow">The Bistro</span>
					<h2 class="sp-bistro__title mt-3">
						Lunch &amp; dinner,<br/>
						<em>French at heart.</em>
					</h2>
					<p class="sp-bistro__body mt-4">
						A short, seasonal menu of sandwiches, cassoulets, ni&ccedil;oises, and
						whatever the chef picked up at the farmers&rsquo; market this week.
						Wines by the glass start at $8.
					</p>
					<div class="d-flex flex-wrap gap-3 mt-4">
						<button class="sp-btn sp-btn--primary">See the menu</button>
						<button class="sp-btn sp-btn--ghost-light">Reserve</button>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php /* ── EDITORIAL ────────────────────────────────────────────── */ ?>
	<section class="sp-editorial">
		<div class="container">
			<div class="sp-editorial__banner d-inline-flex align-items-center rounded-pill text-uppercase mb-5">
				<span class="sp-editorial__banner-icon rounded-circle d-inline-flex align-items-center justify-content-center">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
						<path d="M12 22c5-3 8-7 8-12V5l-8 3-8-3v5c0 5 3 9 8 12z"/>
						<path d="M12 11v11"/>
					</svg>
				</span>
				<span>Spring menu &middot; in season now</span>
				<span class="sp-editorial__banner-dash fw-normal">&mdash;</span>
				<span class="sp-editorial__banner-list fw-normal">Strawberry &middot; Asparagus &middot; Basil &middot; Rhubarb</span>
			</div>

			<div class="row g-4">
				<?php
				$sp_editorial = array(
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
				);
				foreach ( $sp_editorial as $sp_idx => $sp_col ) : ?>
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
	<section class="sp-visit">
		<div class="container">
			<div class="sp-visit__card position-relative overflow-hidden rounded">
				<div class="row align-items-center g-5">
					<div class="col-12 col-md-7 position-relative">
						<span class="sp-eyebrow">Find us</span>
						<h2 class="sp-visit__title mt-3">
							On the corner of <em>Broadway &amp; 11th.</em>
						</h2>
						<p class="sp-visit__body mt-4">
							Three blocks south of the RiverCenter, with parking on 11th and
							a covered patio when the weather behaves.
						</p>
						<div class="d-flex flex-wrap gap-3 mt-4">
							<button class="sp-btn sp-btn--dark">Get directions</button>
							<button class="sp-btn sp-btn--ghost">Call (706) 984-8004</button>
						</div>
					</div>
					<div class="col-12 col-md-5 position-relative">
						<div class="row g-4">
							<div class="col-6">
								<div class="sp-eyebrow mb-3">Address</div>
								<div class="sp-visit__info">
									1040 Broadway<br/>Columbus, GA 31901
								</div>
							</div>
							<div class="col-6">
								<div class="sp-eyebrow mb-3">Hours</div>
								<div class="sp-visit__info">
									Mon &ndash; Sat<br/>11 &ndash; 9:45<br/>
									<span class="sp-visit__info-muted">Sunday closed</span>
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
