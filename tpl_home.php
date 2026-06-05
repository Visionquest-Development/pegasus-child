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
		$hero_headline  = sp_home_hero( 'headline',  'Pastries by day,<br/><em style="font-style: italic; color: var(--sp-pink);">petit d&icirc;ner</em> by night.' );
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
		$hero_image     = sp_home_hero( 'image' );
		$hero_image_id  = get_post_meta( get_the_ID(), '_sp_home_hero_image_id', true );
	?>
	<section style="position: relative; background: var(--sp-paper);">

		<div class="sp-container" style="padding: 72px 56px 96px; position: relative;">
			<div class="row align-items-center g-5">
				<?php /* Content column — second on mobile, first on md+ */ ?>
				<div class="col-12 col-md-6 order-2 order-md-1">
					<span class="sp-eyebrow"><?php echo wp_kses_post( $hero_eyebrow ); ?></span>
					<h1 style="font-size: 82px; margin-top: 22px; line-height: 1.0; font-weight: 400;">
						<?php echo wp_kses_post( $hero_headline ); ?>
					</h1>
					<p style="margin-top: 28px; font-size: 18px; line-height: 1.7; color: var(--sp-brown); max-width: 480px;">
						<?php echo wp_kses_post( $hero_body ); ?>
					</p>
					<div style="display: flex; gap: 14px; margin-top: 38px; flex-wrap: wrap;">
						<?php if ( $hero_btn1_text ) : ?>
							<a href="<?php echo esc_url( $hero_btn1_link ); ?>" class="sp-btn sp-btn--primary"><?php echo esc_html( $hero_btn1_text ); ?></a>
						<?php endif; ?>
						<?php if ( $hero_btn2_text ) : ?>
							<a href="<?php echo esc_url( $hero_btn2_link ); ?>" class="sp-btn sp-btn--ghost"><?php echo esc_html( $hero_btn2_text ); ?></a>
						<?php endif; ?>
					</div>

					<?php /* Quick facts strip */ ?>
					<div style="display: flex; gap: 36px; margin-top: 56px; padding-top: 28px; border-top: 1px solid var(--sp-line); flex-wrap: wrap;">
						<?php foreach ( $hero_facts as $fact ) :
							$num   = isset( $fact['num'] )   ? $fact['num']   : '';
							$label = isset( $fact['label'] ) ? $fact['label'] : '';
							if ( '' === $num && '' === $label ) continue; ?>
							<div>
								<div class="sp-script" style="font-size: 38px;"><?php echo esc_html( $num ); ?></div>
								<div class="sp-eyebrow" style="margin-top: 4px;"><?php echo esc_html( $label ); ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<?php /* Image column — first on mobile, second on md+ */ ?>
				<div class="col-12 col-md-6 order-1 order-md-2">
					<?php if ( $hero_image ) : ?>
						<?php
							$alt = $hero_image_id ? get_post_meta( $hero_image_id, '_wp_attachment_image_alt', true ) : '';
						?>
						<img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( $alt ); ?>" style="width: 100%; height: auto; border-radius: 4px; display: block;" />
					<?php else : ?>
						<div class="sp-photo sp-photo--brown" style="aspect-ratio: 4 / 5; border-radius: 4px;">
							<span class="sp-photo__label">Hero image placeholder</span>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php /* ── MARQUEE / VALUE STRIP ──────────────────────────────────── */ ?>
	<section style="background: var(--sp-wood); color: var(--sp-cream); padding: 22px 0; overflow: hidden;">
		<div style="display: flex; gap: 64px; justify-content: center; align-items: center; font-size: 13px; letter-spacing: 0.28em; text-transform: uppercase; font-family: var(--sp-body);">
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
				<?php if ( $sp_i < $sp_marquee_last ) : ?>
					<span style="color: <?php echo $sp_i % 2 === 0 ? 'var(--sp-sage-soft)' : 'var(--sp-pink)'; ?>;">&#10022;</span>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</section>

	<?php /* ── STORY STRIP ────────────────────────────────────────────── */ ?>
	<section style="padding: 120px 0; background: var(--sp-paper); position: relative;">
		<div class="sp-container">
			<div style="display: grid; grid-template-columns: 1fr 1.1fr; gap: 80px; align-items: center;">
				<div class="sp-photo sp-photo--cream" style="height: 540px; border-radius: 4px;">
					<span class="sp-photo__label">Story image &mdash; kitchen detail</span>
				</div>
				<div>
					<span class="sp-eyebrow">Our Story</span>
					<h2 style="font-size: 64px; margin-top: 18px; line-height: 1.02;">
						A bakery on a bicycle,<br/>
						<em style="font-style: italic; color: var(--sp-pink);">now with a bistro attached.</em>
					</h2>
					<p style="margin-top: 26px; font-size: 17px; line-height: 1.75; color: var(--sp-brown); max-width: 520px;">
						Sugarpeddler started in 2018 as a one-person operation &mdash; desserts
						delivered around downtown Columbus by bicycle. In 2024 we took
						over the dining room next door, hired a French-trained chef, and
						started baking bread at 5am. The bistro opens at lunch.
					</p>
					<p style="margin-top: 22px; font-size: 17px; line-height: 1.75; color: var(--sp-brown); max-width: 520px;">
						We&rsquo;re proud to be part of the same family as <strong style="color: var(--sp-wood);">The Loft</strong>,
						<strong style="color: var(--sp-wood);"> Mabella Italian Steakhouse</strong>, and
						<strong style="color: var(--sp-wood);"> Saltcellar</strong>.
					</p>
					<a href="#" style="margin-top: 32px; display: inline-flex; align-items: center; gap: 12px; font-family: var(--sp-body); font-size: 13px; letter-spacing: 0.22em; text-transform: uppercase; color: var(--sp-pink); border-bottom: 1px solid var(--sp-pink); padding-bottom: 6px;">
						Read the full story
						<svg width="18" height="10" viewBox="0 0 18 10" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M1 5h16m0 0L13 1m4 4l-4 4"/></svg>
					</a>
				</div>
			</div>
		</div>
	</section>

	<?php /* ── FEATURED PRODUCTS ──────────────────────────────────────── */ ?>
	<section style="background: var(--sp-sage-wash); padding: 120px 0; position: relative; border-top: 1px solid var(--sp-line); border-bottom: 1px solid var(--sp-line);">
		<div class="sp-container">
			<div class="sp-section-head">
				<div class="sp-divider"><span class="sp-eyebrow">From the bakery</span></div>
				<h2>This week&rsquo;s <em>petits plaisirs</em></h2>
				<p style="max-width: 600px; color: var(--sp-brown); font-size: 16px; line-height: 1.7;">
					A rotating selection of what came out of the oven this morning. Pre-order by 4pm for next-day pickup.
				</p>
			</div>

			<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 32px; margin-top: 64px;">
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
					<article class="sp-card">
						<div class="sp-card__img sp-photo" style="position: relative;">
							<?php if ( $p['badge_label'] ) : ?>
								<span class="sp-badge<?php echo $p['badge_tone'] ? ' sp-badge--' . esc_attr( $p['badge_tone'] ) : ''; ?>"><?php echo esc_html( $p['badge_label'] ); ?></span>
							<?php endif; ?>
							<div class="sp-photo <?php echo esc_attr( $p['photo_variant'] ); ?>" style="position: absolute; inset: 0;">
								<span class="sp-photo__label"><?php echo esc_html( $p['tagline'] ); ?></span>
							</div>
						</div>
						<div>
							<div class="sp-card__cat"><?php echo esc_html( $p['category'] ); ?></div>
							<h3 class="sp-card__title" style="margin-top: 6px;"><?php echo $p['name']; // entities intentional ?></h3>
						</div>
						<div class="sp-card__row">
							<div class="sp-card__price">
								<?php if ( $p['old_price'] ) : ?><s><?php echo esc_html( $p['old_price'] ); ?></s><?php endif; ?>
								<?php echo esc_html( $p['price'] ); ?>
							</div>
							<button class="sp-card__add">Add</button>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<div style="display: flex; justify-content: center; margin-top: 64px;">
				<button class="sp-btn sp-btn--dark">Shop all 84 items</button>
			</div>
		</div>
	</section>

	<?php /* ── BISTRO INTRO ─────────────────────────────────────────── */ ?>
	<section style="position: relative; background: var(--sp-wood);">
		<div style="display: grid; grid-template-columns: 1fr 380px 1fr; align-items: stretch; min-height: 720px;">
			<?php /* Left: photo */ ?>
			<div class="sp-photo sp-photo--dark" style="min-height: 720px; border-radius: 0;">
				<span class="sp-photo__label">Bistro dining room &mdash; evening</span>
			</div>

			<?php /* Middle: chalkboard card */ ?>
			<div style="display: flex; align-items: center; justify-content: center; padding: 80px 0;">
				<div class="sp-chalk" style="width: 380px; padding: 40px 42px 36px;">
					<div style="text-align: center; margin-bottom: 22px;">
						<span style="font-family: var(--sp-script); font-size: 30px; color: var(--sp-pink-soft);">Today&rsquo;s</span>
						<div style="font-family: var(--sp-display); font-size: 28px; font-style: italic; letter-spacing: 0.04em;">
							Plat du jour
						</div>
						<div style="height: 1px; background: rgba(242,230,214,.25); margin: 14px auto 18px; width: 80px;"></div>
					</div>
					<ul style="list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 14px;">
						<?php
						$sp_specials = array(
							array( 'Croque Madame',  '12' ),
							array( 'Ni&ccedil;oise Salad', '16' ),
							array( 'Coq au Vin',     '24' ),
							array( 'Tarte Tatin',    '9' ),
						);
						foreach ( $sp_specials as $sp_special ) : ?>
							<li style="display: flex; align-items: baseline; gap: 8px; font-size: 18px;">
								<span style="font-style: italic;"><?php echo $sp_special[0]; // entity intentional ?></span>
								<span style="flex: 1; border-bottom: 1px dotted rgba(242,230,214,.3); margin: 0 6px; transform: translateY(-4px);"></span>
								<span style="color: var(--sp-pink-soft);"><?php echo esc_html( $sp_special[1] ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>

			<?php /* Right: copy */ ?>
			<div style="display: flex; align-items: center; padding: 80px 64px 80px 24px;">
				<div>
					<span class="sp-eyebrow" style="color: var(--sp-pink-soft);">The Bistro</span>
					<h2 style="font-size: 60px; color: var(--sp-cream); margin-top: 18px; line-height: 1.02;">
						Lunch &amp; dinner,<br/>
						<em style="font-style: italic; color: var(--sp-pink);">French at heart.</em>
					</h2>
					<p style="margin-top: 26px; font-size: 16.5px; line-height: 1.75; color: rgba(245,237,228,.78); max-width: 420px;">
						A short, seasonal menu of sandwiches, cassoulets, ni&ccedil;oises, and
						whatever the chef picked up at the farmers&rsquo; market this week.
						Wines by the glass start at $8.
					</p>
					<div style="display: flex; gap: 14px; margin-top: 36px; flex-wrap: wrap;">
						<button class="sp-btn sp-btn--primary">See the menu</button>
						<button class="sp-btn sp-btn--ghost-light">Reserve</button>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php /* ── EDITORIAL ────────────────────────────────────────────── */ ?>
	<section style="padding: 120px 0 80px; background: var(--sp-paper);">
		<div class="sp-container">
			<?php /* Seasonal banner */ ?>
			<div style="display: inline-flex; align-items: center; gap: 14px; background: var(--sp-sage-wash); color: var(--sp-sage-deep); padding: 10px 18px 10px 14px; border-radius: 999px; font-size: 12px; letter-spacing: 0.22em; text-transform: uppercase; font-weight: 500; margin-bottom: 36px;">
				<span style="width: 26px; height: 26px; border-radius: 999px; background: var(--sp-sage); display: inline-flex; align-items: center; justify-content: center; color: #fff;">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
						<path d="M12 22c5-3 8-7 8-12V5l-8 3-8-3v5c0 5 3 9 8 12z"/>
						<path d="M12 11v11"/>
					</svg>
				</span>
				<span>Spring menu &middot; in season now</span>
				<span style="color: var(--sp-sage); font-weight: 400;">&mdash;</span>
				<span style="color: var(--sp-sage); font-weight: 400; letter-spacing: 0.18em;">Strawberry &middot; Asparagus &middot; Basil &middot; Rhubarb</span>
			</div>

			<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px;">
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
					<article style="display: flex; flex-direction: column; gap: 16px;">
						<div style="display: flex; align-items: center; gap: 14px;">
							<span class="sp-script" style="font-size: 36px; color: var(--sp-pink);">0<?php echo (int) $sp_idx + 1; ?></span>
							<span class="sp-eyebrow"><?php echo esc_html( $sp_col['eyebrow'] ); ?></span>
						</div>
						<h3 style="font-size: 32px; font-style: italic; font-weight: 400;"><?php echo esc_html( $sp_col['title'] ); ?></h3>
						<p style="font-size: 15.5px; line-height: 1.75; color: var(--sp-brown);"><?php echo $sp_col['body']; // entities intentional ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php /* ── VISIT US ─────────────────────────────────────────────── */ ?>
	<section style="padding: 0 0 120px; background: var(--sp-paper);">
		<div class="sp-container">
			<div style="background: var(--sp-pink-wash); border-radius: 6px; padding: 64px 72px; display: grid; grid-template-columns: 1.5fr 1fr; gap: 64px; align-items: center; position: relative; overflow: hidden; border-left: 4px solid var(--sp-sage);">
				<div style="position: relative;">
					<span class="sp-eyebrow">Find us</span>
					<h2 style="font-size: 56px; margin-top: 14px; line-height: 1.02; max-width: 620px;">
						On the corner of <em style="font-style: italic; color: var(--sp-wood);">Broadway &amp; 11th.</em>
					</h2>
					<p style="margin-top: 22px; font-size: 16px; color: var(--sp-brown); max-width: 460px; line-height: 1.7;">
						Three blocks south of the RiverCenter, with parking on 11th and
						a covered patio when the weather behaves.
					</p>
					<div style="display: flex; gap: 14px; margin-top: 32px;">
						<button class="sp-btn sp-btn--dark">Get directions</button>
						<button class="sp-btn sp-btn--ghost">Call (706) 984-8004</button>
					</div>
				</div>
				<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px; position: relative;">
					<div>
						<div class="sp-eyebrow" style="margin-bottom: 12px;">Address</div>
						<div style="font-size: 15px; line-height: 1.8; color: var(--sp-wood);">
							1040 Broadway<br/>Columbus, GA 31901
						</div>
					</div>
					<div>
						<div class="sp-eyebrow" style="margin-bottom: 12px;">Hours</div>
						<div style="font-size: 15px; line-height: 1.8; color: var(--sp-wood);">
							Mon &ndash; Sat<br/>11 &ndash; 9:45<br/>
							<span style="color: var(--sp-brown-mid);">Sunday closed</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div><?php /* .sp.sp-page */ ?>

<?php get_footer(); ?>
