<?php
/**
 * CMB2 metaboxes for the QBIQ Home (tpl_home.php) template.
 *
 * Every visible string, link, and asset on the V1 home design is wired here
 * so the homepage can be edited from the WP admin Page editor. Metaboxes
 * only appear on pages assigned the "Home" template.
 *
 * Prefix: qbh_  (QBIQ Home)
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'cmb2_admin_init', 'qbiq_register_home_metaboxes' );
function qbiq_register_home_metaboxes() {

	$prefix    = 'qbh_';
	$show_on   = array(
		'key'   => 'page-template',
		'value' => 'tpl_home.php',
	);

	/* -----------------------------------------------------------------
	 * HERO
	 * ----------------------------------------------------------------- */
	$hero = new_cmb2_box( array(
		'id'           => $prefix . 'hero',
		'title'        => __( 'Home — Hero', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $show_on,
	) );

	$hero->add_field( array(
		'name'    => 'Headline (line 1)',
		'id'      => $prefix . 'hero_headline_1',
		'type'    => 'text',
		'default' => 'Train your mind.',
	) );
	$hero->add_field( array(
		'name'    => 'Headline (line 2 — accent orange)',
		'id'      => $prefix . 'hero_headline_2',
		'type'    => 'text',
		'default' => 'Dominate the game.',
	) );
	$hero->add_field( array(
		'name'    => 'Lead paragraph',
		'id'      => $prefix . 'hero_lead',
		'type'    => 'textarea_small',
		'default' => 'The mental training system that teaches quarterbacks and receivers to read defenses in seconds — not minutes. Recognize coverage. Anticipate the blitz. Win the snap before it starts.',
	) );

	// Pill badges (repeatable)
	$pill_group = $hero->add_field( array(
		'id'         => $prefix . 'hero_pills',
		'type'       => 'group',
		'name'       => 'Pill badges',
		'options'    => array(
			'group_title'   => 'Pill {#}',
			'add_button'    => 'Add pill',
			'remove_button' => 'Remove pill',
			'sortable'      => true,
		),
	) );
	$hero->add_group_field( $pill_group, array(
		'name' => 'Text',
		'id'   => 'text',
		'type' => 'text',
	) );
	$hero->add_group_field( $pill_group, array(
		'name' => 'Show orange dot?',
		'id'   => 'has_dot',
		'type' => 'checkbox',
	) );

	// CTAs
	$hero->add_field( array( 'name' => 'Primary CTA — text', 'id' => $prefix . 'hero_cta_primary_text', 'type' => 'text', 'default' => 'Try Free — 2 Chapters' ) );
	$hero->add_field( array( 'name' => 'Primary CTA — URL',  'id' => $prefix . 'hero_cta_primary_url',  'type' => 'text_url' ) );
	$hero->add_field( array( 'name' => 'Secondary CTA — text', 'id' => $prefix . 'hero_cta_secondary_text', 'type' => 'text', 'default' => 'Watch 90-sec Demo' ) );
	$hero->add_field( array( 'name' => 'Secondary CTA — URL',  'id' => $prefix . 'hero_cta_secondary_url',  'type' => 'text_url' ) );
	$hero->add_field( array( 'name' => 'Secondary CTA — Bootstrap icon', 'id' => $prefix . 'hero_cta_secondary_icon', 'type' => 'text', 'default' => 'bi-play-circle', 'desc' => 'Bootstrap Icons class, e.g. bi-play-circle' ) );

	// Trust indicators (repeatable)
	$trust_group = $hero->add_field( array(
		'id'      => $prefix . 'hero_trust',
		'type'    => 'group',
		'name'    => 'Trust indicators (below CTAs)',
		'options' => array(
			'group_title'   => 'Indicator {#}',
			'add_button'    => 'Add indicator',
			'remove_button' => 'Remove indicator',
			'sortable'      => true,
		),
	) );
	$hero->add_group_field( $trust_group, array( 'name' => 'Bootstrap icon', 'id' => 'icon', 'type' => 'text', 'default' => 'bi-shield-check' ) );
	$hero->add_group_field( $trust_group, array( 'name' => 'Text',           'id' => 'text', 'type' => 'text' ) );

	// Video background (MP4) — fills the hero behind content
	$hero->add_field( array(
		'name'    => 'Hero background video (MP4 URL)',
		'id'      => $prefix . 'hero_video_url',
		'type'    => 'text_url',
		'default' => 'https://qbiqcamp.com/wp-content/uploads/2024/11/QBIQ-WEB-BANNER-VIDEO-1.mp4',
		'desc'    => 'Direct .mp4 URL. Leave blank to disable the video background.',
	) );
	$hero->add_field( array(
		'name'    => 'Hero video poster image (optional)',
		'id'      => $prefix . 'hero_video_poster',
		'type'    => 'file',
		'desc'    => 'Optional still shown before the video loads / if autoplay is blocked.',
		'options' => array( 'url' => false ),
		'text'    => array( 'add_upload_file_text' => 'Add image' ),
	) );

	// App mock side panel
	$hero->add_field( array(
		'name' => 'App mock — replacement image (optional)',
		'id'   => $prefix . 'hero_appmock_image',
		'type' => 'file',
		'desc' => 'Optional. If set, replaces the default SVG app mock with your image.',
		'options' => array( 'url' => false ),
		'text' => array( 'add_upload_file_text' => 'Add image' ),
	) );
	$hero->add_field( array( 'name' => 'App mock — eyebrow label', 'id' => $prefix . 'hero_appmock_eyebrow', 'type' => 'text', 'default' => 'Read Accelerator' ) );
	$hero->add_field( array( 'name' => 'App mock — coverage label (SVG)', 'id' => $prefix . 'hero_appmock_coverage', 'type' => 'text', 'default' => 'COVER 2' ) );
	$hero->add_field( array( 'name' => 'App mock — chip 1', 'id' => $prefix . 'hero_appmock_chip1', 'type' => 'text', 'default' => 'Mike' ) );
	$hero->add_field( array( 'name' => 'App mock — chip 2 (active)', 'id' => $prefix . 'hero_appmock_chip2', 'type' => 'text', 'default' => 'Cover 2' ) );
	$hero->add_field( array( 'name' => 'App mock — chip 3', 'id' => $prefix . 'hero_appmock_chip3', 'type' => 'text', 'default' => 'Cover 3' ) );
	$hero->add_field( array( 'name' => 'App mock — read title', 'id' => $prefix . 'hero_appmock_read_title', 'type' => 'text', 'default' => 'Pre-snap read' ) );
	$hero->add_field( array( 'name' => 'App mock — read body', 'id' => $prefix . 'hero_appmock_read_body', 'type' => 'textarea_small', 'default' => 'Safeties split 12 yards. Corners squatting flat. CB leverage outside — backside post is open. Decide.' ) );

	/* -----------------------------------------------------------------
	 * STAT BAND
	 * ----------------------------------------------------------------- */
	$stats = new_cmb2_box( array(
		'id'           => $prefix . 'stats',
		'title'        => __( 'Home — Stat Band', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
	) );
	$stat_group = $stats->add_field( array(
		'id'      => $prefix . 'stat_items',
		'type'    => 'group',
		'name'    => 'Stats (recommended: 4)',
		'options' => array(
			'group_title'   => 'Stat {#}',
			'add_button'    => 'Add stat',
			'remove_button' => 'Remove stat',
			'sortable'      => true,
		),
	) );
	$stats->add_group_field( $stat_group, array( 'name' => 'Number', 'id' => 'num',   'type' => 'text' ) );
	$stats->add_group_field( $stat_group, array( 'name' => 'Label',  'id' => 'label', 'type' => 'text' ) );

	/* -----------------------------------------------------------------
	 * WHAT IS QBIQ
	 * ----------------------------------------------------------------- */
	$intro = new_cmb2_box( array(
		'id'           => $prefix . 'intro',
		'title'        => __( 'Home — What is QBIQ', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
	) );
	$intro->add_field( array( 'name' => 'Eyebrow',  'id' => $prefix . 'intro_eyebrow',  'type' => 'text',          'default' => 'What is QBIQ' ) );
	$intro->add_field( array( 'name' => 'Heading',  'id' => $prefix . 'intro_heading',  'type' => 'text',          'default' => 'A mental rep system for the position that thinks the most.' ) );
	$intro->add_field( array( 'name' => 'Body',     'id' => $prefix . 'intro_body',     'type' => 'wysiwyg',       'options' => array( 'textarea_rows' => 5, 'media_buttons' => false ) ) );

	$intro_b = $intro->add_field( array(
		'id'      => $prefix . 'intro_bullets',
		'type'    => 'group',
		'name'    => 'Bullets',
		'options' => array(
			'group_title'   => 'Bullet {#}',
			'add_button'    => 'Add bullet',
			'remove_button' => 'Remove bullet',
			'sortable'      => true,
		),
	) );
	$intro->add_group_field( $intro_b, array( 'name' => 'Text', 'id' => 'text', 'type' => 'text' ) );

	$intro->add_field( array( 'name' => 'CTA — text', 'id' => $prefix . 'intro_cta_text', 'type' => 'text', 'default' => 'See the full system' ) );
	$intro->add_field( array( 'name' => 'CTA — URL',  'id' => $prefix . 'intro_cta_url',  'type' => 'text_url' ) );
	$intro->add_field( array( 'name' => 'Video label', 'id' => $prefix . 'intro_video_label', 'type' => 'text', 'default' => 'Watch How It Works · 1:34' ) );
	$intro->add_field( array( 'name' => 'Video URL (link target for play button)', 'id' => $prefix . 'intro_video_url', 'type' => 'text_url' ) );

	/* -----------------------------------------------------------------
	 * TRUST STRIP
	 * ----------------------------------------------------------------- */
	$trust = new_cmb2_box( array(
		'id'           => $prefix . 'trust',
		'title'        => __( 'Home — Trust Strip', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
	) );
	$trust->add_field( array( 'name' => 'Eyebrow',  'id' => $prefix . 'trust_eyebrow',  'type' => 'text', 'default' => 'Trusted on the sideline' ) );
	$trust->add_field( array( 'name' => 'Subtitle', 'id' => $prefix . 'trust_subtitle', 'type' => 'text', 'default' => 'Used by HS, college and select pro programs across 38 states.' ) );

	$trust_logos = $trust->add_field( array(
		'id'      => $prefix . 'trust_logos',
		'type'    => 'group',
		'name'    => 'Trust logos / names',
		'options' => array(
			'group_title'   => 'Logo {#}',
			'add_button'    => 'Add logo',
			'remove_button' => 'Remove logo',
			'sortable'      => true,
		),
	) );
	$trust->add_group_field( $trust_logos, array( 'name' => 'Name', 'id' => 'name', 'type' => 'text' ) );

	/* -----------------------------------------------------------------
	 * TRAINING SYSTEM (Features)
	 * ----------------------------------------------------------------- */
	$feat = new_cmb2_box( array(
		'id'           => $prefix . 'features',
		'title'        => __( 'Home — Training System (Feature Cards)', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
	) );
	$feat->add_field( array( 'name' => 'Eyebrow',  'id' => $prefix . 'features_eyebrow',  'type' => 'text', 'default' => 'The QBIQ training system' ) );
	$feat->add_field( array( 'name' => 'Heading',  'id' => $prefix . 'features_heading',  'type' => 'text', 'default' => 'Everything you need to elevate your mental game.' ) );
	$feat->add_field( array( 'name' => 'Subhead',  'id' => $prefix . 'features_sub',      'type' => 'textarea_small', 'default' => 'Six tools, one workflow. Read, react, repeat — built around the way QBs actually learn.' ) );

	$feat_g = $feat->add_field( array(
		'id'      => $prefix . 'features_items',
		'type'    => 'group',
		'name'    => 'Features',
		'options' => array(
			'group_title'   => 'Feature {#}',
			'add_button'    => 'Add feature',
			'remove_button' => 'Remove feature',
			'sortable'      => true,
		),
	) );
	$feat->add_group_field( $feat_g, array( 'name' => 'Bootstrap icon', 'id' => 'icon',  'type' => 'text', 'default' => 'bi-book-fill', 'desc' => 'Bootstrap Icons class, e.g. bi-book-fill' ) );
	$feat->add_group_field( $feat_g, array( 'name' => 'Title',          'id' => 'title', 'type' => 'text' ) );
	$feat->add_group_field( $feat_g, array( 'name' => 'Description',    'id' => 'desc',  'type' => 'textarea_small' ) );

	/* -----------------------------------------------------------------
	 * COACH AUTHORITY
	 * ----------------------------------------------------------------- */
	$coach = new_cmb2_box( array(
		'id'           => $prefix . 'coach',
		'title'        => __( 'Home — Coach Authority', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
	) );
	$coach->add_field( array( 'name' => 'Portrait image (optional)', 'id' => $prefix . 'coach_image', 'type' => 'file', 'desc' => 'Replaces the initials circle if set.', 'options' => array( 'url' => false ), 'text' => array( 'add_upload_file_text' => 'Add image' ) ) );
	$coach->add_field( array( 'name' => 'Initials (fallback)', 'id' => $prefix . 'coach_initials', 'type' => 'text', 'default' => 'CH' ) );
	$coach->add_field( array( 'name' => 'Role label',          'id' => $prefix . 'coach_role',     'type' => 'text', 'default' => 'Founder' ) );
	$coach->add_field( array( 'name' => 'Full name',           'id' => $prefix . 'coach_name',     'type' => 'text', 'default' => 'Coach Steve Hixson' ) );
	$coach->add_field( array( 'name' => 'Quote',               'id' => $prefix . 'coach_quote',    'type' => 'textarea', 'default' => 'The best quarterbacks aren\'t just physically gifted — they\'re mentally elite. QBIQ trains the part of the game that wins championships.' ) );
	$coach->add_field( array( 'name' => 'Bio paragraph',       'id' => $prefix . 'coach_bio',      'type' => 'textarea_small', 'default' => '30+ years coaching QBs at the high school, college, and private-camp level. Author of the QBIQ Training Book. Featured at clinics nationwide.' ) );

	/* -----------------------------------------------------------------
	 * HOW IT WORKS
	 * ----------------------------------------------------------------- */
	$how = new_cmb2_box( array(
		'id'           => $prefix . 'how',
		'title'        => __( 'Home — How It Works', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
	) );
	$how->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'how_eyebrow', 'type' => 'text', 'default' => 'How it works' ) );
	$how->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'how_heading', 'type' => 'text', 'default' => 'Start improving your quarterback IQ in three steps.' ) );

	$how_g = $how->add_field( array(
		'id'      => $prefix . 'how_steps',
		'type'    => 'group',
		'name'    => 'Steps',
		'options' => array(
			'group_title'   => 'Step {#}',
			'add_button'    => 'Add step',
			'remove_button' => 'Remove step',
			'sortable'      => true,
		),
	) );
	$how->add_group_field( $how_g, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$how->add_group_field( $how_g, array( 'name' => 'Body',  'id' => 'body',  'type' => 'textarea_small' ) );

	// Read accelerator subsection (paired with the play diagram)
	$how->add_field( array( 'name' => 'Read Accelerator — eyebrow', 'id' => $prefix . 'how_acc_eyebrow', 'type' => 'text', 'default' => 'Read Accelerator' ) );
	$how->add_field( array( 'name' => 'Read Accelerator — heading', 'id' => $prefix . 'how_acc_heading', 'type' => 'text', 'default' => 'See it. Name it. Throw it.' ) );
	$how->add_field( array( 'name' => 'Read Accelerator — body',    'id' => $prefix . 'how_acc_body',    'type' => 'textarea_small', 'default' => 'QBIQ trains the three-step rep that elite quarterbacks run a thousand times a season — identifying the front, the rotation, and the leverage in under three seconds.' ) );

	$acc_g = $how->add_field( array(
		'id'      => $prefix . 'how_acc_bullets',
		'type'    => 'group',
		'name'    => 'Read Accelerator — numbered bullets',
		'options' => array(
			'group_title'   => 'Bullet {#}',
			'add_button'    => 'Add bullet',
			'remove_button' => 'Remove bullet',
			'sortable'      => true,
		),
	) );
	$how->add_group_field( $acc_g, array( 'name' => 'Heading', 'id' => 'title', 'type' => 'text' ) );
	$how->add_group_field( $acc_g, array( 'name' => 'Body',    'id' => 'body',  'type' => 'text' ) );

	/* -----------------------------------------------------------------
	 * TESTIMONIALS
	 * ----------------------------------------------------------------- */
	$test = new_cmb2_box( array(
		'id'           => $prefix . 'testimonials',
		'title'        => __( 'Home — Testimonials', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
	) );
	$test->add_field( array( 'name' => 'Eyebrow',         'id' => $prefix . 'test_eyebrow', 'type' => 'text', 'default' => 'What players are saying' ) );
	$test->add_field( array( 'name' => 'Heading',         'id' => $prefix . 'test_heading', 'type' => 'text', 'default' => 'Built for the field. Tested under the lights.' ) );
	$test->add_field( array( 'name' => 'Reviews link — text', 'id' => $prefix . 'test_link_text', 'type' => 'text', 'default' => 'Read all 240 reviews' ) );
	$test->add_field( array( 'name' => 'Reviews link — URL',  'id' => $prefix . 'test_link_url',  'type' => 'text_url' ) );

	$test_g = $test->add_field( array(
		'id'      => $prefix . 'test_items',
		'type'    => 'group',
		'name'    => 'Quotes',
		'options' => array(
			'group_title'   => 'Quote {#}',
			'add_button'    => 'Add quote',
			'remove_button' => 'Remove quote',
			'sortable'      => true,
		),
	) );
	$test->add_group_field( $test_g, array( 'name' => 'Quote', 'id' => 'quote', 'type' => 'textarea_small' ) );
	$test->add_group_field( $test_g, array( 'name' => 'Name',  'id' => 'name',  'type' => 'text' ) );
	$test->add_group_field( $test_g, array( 'name' => 'Role',  'id' => 'role',  'type' => 'text' ) );

	/* -----------------------------------------------------------------
	 * CTA BAND
	 * ----------------------------------------------------------------- */
	$cta = new_cmb2_box( array(
		'id'           => $prefix . 'cta',
		'title'        => __( 'Home — Bottom CTA Band', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
	) );
	$cta->add_field( array( 'name' => 'Pill text',  'id' => $prefix . 'cta_pill',    'type' => 'text', 'default' => 'Plans from $15/month' ) );
	$cta->add_field( array( 'name' => 'Heading',    'id' => $prefix . 'cta_heading', 'type' => 'text', 'default' => 'Ready to elevate your game?' ) );
	$cta->add_field( array( 'name' => 'Body',       'id' => $prefix . 'cta_body',    'type' => 'textarea_small', 'default' => 'Join thousands of quarterbacks training smarter with QBIQ. 30-day money-back guarantee. Cancel anytime.' ) );
	$cta->add_field( array( 'name' => 'Primary CTA — text',   'id' => $prefix . 'cta_primary_text',   'type' => 'text', 'default' => 'View Pricing' ) );
	$cta->add_field( array( 'name' => 'Primary CTA — URL',    'id' => $prefix . 'cta_primary_url',    'type' => 'text_url' ) );
	$cta->add_field( array( 'name' => 'Secondary CTA — text', 'id' => $prefix . 'cta_secondary_text', 'type' => 'text', 'default' => 'Start Free Trial' ) );
	$cta->add_field( array( 'name' => 'Secondary CTA — URL',  'id' => $prefix . 'cta_secondary_url',  'type' => 'text_url' ) );
}
