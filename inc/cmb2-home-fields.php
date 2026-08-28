<?php
/**
 * CMB2 fields for the Home Page template (tpl_home.php).
 *
 * Every metabox below is registered against the "page" object type and limited
 * to pages using the "Home Page" template, so these fields only appear on the
 * edit screen of the page that uses tpl_home.php.
 *
 * All metaboxes are numbered to match the order the sections render on the
 * front end, are collapsed by default ( 'closed' => true ), and every
 * repeatable group is collapsed by default as well ( group option
 * 'closed' => true ).
 *
 * Every scalar field ships a 'default' matching the hard-coded fallback in
 * tpl_home.php, so the admin boxes are pre-filled with the current copy and it
 * is obvious what content still needs real values. (Repeatable groups — hero
 * facts, marquee phrases, editorial columns — fall back to their default rows
 * in the template; CMB2 groups can't be pre-populated the same way.)
 *
 * @package pegasus-child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * Read helpers
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

/**
 * Read a single Home Page meta value with a fallback default.
 *
 * @param string $key     Full meta key ( including the section prefix ).
 * @param string $default Value to return when the field is empty.
 * @return string
 */
function sp_home_meta( $key, $default = '' ) {
	$val = get_post_meta( get_the_ID(), $key, true );
	return ( '' !== $val && null !== $val ) ? $val : $default;
}

/**
 * Read a repeatable ( group ) Home Page meta value with a fallback default.
 *
 * @param string $key     Full meta key ( including the section prefix ).
 * @param array  $default Array of rows to return when nothing is saved.
 * @return array
 */
function sp_home_group( $key, $default = array() ) {
	$val = get_post_meta( get_the_ID(), $key, true );
	return ( is_array( $val ) && ! empty( $val ) ) ? $val : $default;
}

/**
 * Back-compat reader for the original hero fields ( _sp_home_hero_<key> ).
 *
 * @param string $key     Hero field key ( without prefix ).
 * @param string $default Value to return when the field is empty.
 * @return string
 */
function sp_home_hero( $key, $default = '' ) {
	return sp_home_meta( '_sp_home_hero_' . $key, $default );
}


/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * Metabox registration
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

add_action( 'cmb2_admin_init', 'sp_register_home_metaboxes' );
function sp_register_home_metaboxes() {

	// Shared config applied to every Home Page metabox.
	$show_on = array( 'key' => 'page-template', 'value' => 'tpl_home.php' );

	/* ── 1. Hero ─────────────────────────────────────────────────────────── */
	$prefix = '_sp_home_hero_';
	$cmb = new_cmb2_box( array(
		'id'           => 'sp_home_hero',
		'title'        => __( '1. Home &mdash; Hero Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'desc'    => __( 'Small uppercase line above the headline.', 'pegasus-child' ),
		'id'      => $prefix . 'eyebrow',
		'type'    => 'text',
		'default' => 'Bistro &middot; Bakery &middot; Est. 2024',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Headline', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;br&gt; for line breaks and &lt;em&gt;...&lt;/em&gt; to color the italic accent pink.', 'pegasus-child' ),
		'id'      => $prefix . 'headline',
		'type'    => 'textarea_small',
		'default' => 'Pastries by day,<br/><em>petit d&icirc;ner</em> by night.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Body copy', 'pegasus-child' ),
		'id'      => $prefix . 'body',
		'type'    => 'textarea',
		'default' => 'Small-batch tarts, sourdough, and slow-cooked bistro plates from the corner of Broadway and 11th. Made in Columbus, Georgia &mdash; served the French way.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Primary button text', 'pegasus-child' ),
		'id'      => $prefix . 'btn1_text',
		'type'    => 'text',
		'default' => 'Shop the Bakery',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Primary button link', 'pegasus-child' ),
		'id'      => $prefix . 'btn1_link',
		'type'    => 'text_url',
		'default' => '#',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Secondary button text', 'pegasus-child' ),
		'id'      => $prefix . 'btn2_text',
		'type'    => 'text',
		'default' => 'Reserve a Table',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Secondary button link', 'pegasus-child' ),
		'id'      => $prefix . 'btn2_link',
		'type'    => 'text_url',
		'default' => '#',
	) );

	$hero_facts = $cmb->add_field( array(
		'id'          => $prefix . 'facts',
		'type'        => 'group',
		'description' => __( 'Small stats shown below the hero buttons. Drag to reorder. Default: 14 Daily breads / 32 Pastry varieties / 3718 2nd Ave, CGA.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Fact {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add another fact', 'pegasus-child' ),
			'remove_button' => __( 'Remove fact', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cmb->add_group_field( $hero_facts, array(
		'name' => __( 'Number', 'pegasus-child' ),
		'id'   => 'num',
		'type' => 'text_small',
	) );
	$cmb->add_group_field( $hero_facts, array(
		'name' => __( 'Label', 'pegasus-child' ),
		'id'   => 'label',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name'         => __( 'Hero image', 'pegasus-child' ),
		'desc'         => __( 'Right-side image. Leave empty to show a placeholder.', 'pegasus-child' ),
		'id'           => $prefix . 'image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'preview_size' => 'medium',
	) );


	/* ── 2. Marquee / Value strip ────────────────────────────────────────── */
	$prefix = '_sp_home_marquee_';
	$cmb = new_cmb2_box( array(
		'id'           => 'sp_home_marquee',
		'title'        => __( '2. Home &mdash; Marquee / Value Strip', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$marquee_group = $cmb->add_field( array(
		'id'          => $prefix . 'phrases',
		'type'        => 'group',
		'description' => __( 'Scrolling phrases in the value strip. Drag to reorder. Defaults: Sourdough fired at 5am / French butter, local cream / Wine list curated weekly / Saltcellar family of restaurants / Open six days a week.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Phrase {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add another phrase', 'pegasus-child' ),
			'remove_button' => __( 'Remove phrase', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cmb->add_group_field( $marquee_group, array(
		'name' => __( 'Phrase', 'pegasus-child' ),
		'id'   => 'text',
		'type' => 'text',
	) );


	/* ── 3. Story strip ──────────────────────────────────────────────────── */
	$prefix = '_sp_home_story_';
	$cmb = new_cmb2_box( array(
		'id'           => 'sp_home_story',
		'title'        => __( '3. Home &mdash; Story Strip', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Story image', 'pegasus-child' ),
		'desc'         => __( 'Left-side image. Leave empty to show a placeholder.', 'pegasus-child' ),
		'id'           => $prefix . 'image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'preview_size' => 'medium',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'eyebrow',
		'type'    => 'text',
		'default' => 'Our Story',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Title', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;br&gt; and &lt;em&gt;...&lt;/em&gt; for the italic accent.', 'pegasus-child' ),
		'id'      => $prefix . 'title',
		'type'    => 'textarea_small',
		'default' => 'A bakery on a bicycle,<br/><em>now with a bistro attached.</em>',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Body &mdash; first paragraph', 'pegasus-child' ),
		'id'      => $prefix . 'body',
		'type'    => 'textarea',
		'default' => 'Sugarpeddler started in 2018 as a one-person operation &mdash; desserts delivered around downtown Columbus by bicycle. In 2024 we took over the dining room next door, hired a French-trained chef, and started baking bread at 5am. The bistro opens at lunch.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Body &mdash; second paragraph', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed ( e.g. &lt;strong&gt; for restaurant names ).', 'pegasus-child' ),
		'id'      => $prefix . 'body2',
		'type'    => 'textarea',
		'default' => 'We&rsquo;re proud to be part of the same family as <strong>The Loft</strong>, <strong>Mabella Italian Steakhouse</strong>, and <strong>Saltcellar</strong>.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Link text', 'pegasus-child' ),
		'id'      => $prefix . 'link_text',
		'type'    => 'text',
		'default' => 'Read the full story',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Link URL', 'pegasus-child' ),
		'id'      => $prefix . 'link_url',
		'type'    => 'text_url',
		'default' => '#',
	) );


	/* ── 4. Featured products ────────────────────────────────────────────── */
	/* NOTE: the product cards themselves are pulled from Toast via the
	 * vqdev-toast plugin. Only the section heading/footer copy is editable here. */
	$prefix = '_sp_home_products_';
	$cmb = new_cmb2_box( array(
		'id'           => 'sp_home_products',
		'title'        => __( '4. Home &mdash; Featured Products ( heading )', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'eyebrow',
		'type'    => 'text',
		'default' => 'From the bakery',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Title', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;em&gt;...&lt;/em&gt; for the italic accent.', 'pegasus-child' ),
		'id'      => $prefix . 'title',
		'type'    => 'textarea_small',
		'default' => 'This week&rsquo;s <em>petits plaisirs</em>',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Intro copy', 'pegasus-child' ),
		'id'      => $prefix . 'intro',
		'type'    => 'textarea',
		'default' => 'A rotating selection of what came out of the oven this morning. Pre-order by 4pm for next-day pickup.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Footer button text', 'pegasus-child' ),
		'id'      => $prefix . 'footer_btn_text',
		'type'    => 'text',
		'default' => 'Shop all 84 items',
	) );
	$cmb->add_field( array(
		'name' => __( 'Footer button link', 'pegasus-child' ),
		'id'   => $prefix . 'footer_btn_link',
		'type' => 'text_url',
	) );


	/* ── 5. Bistro intro ─────────────────────────────────────────────────── */
	/* NOTE: the "Plat du jour" specials list is a menu, pulled from Toast via
	 * the vqdev-toast plugin. Only the surrounding copy is editable here. */
	$prefix = '_sp_home_bistro_';
	$cmb = new_cmb2_box( array(
		'id'           => 'sp_home_bistro',
		'title'        => __( '5. Home &mdash; Bistro Intro', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Bistro photo', 'pegasus-child' ),
		'desc'         => __( 'Left-side image. Leave empty to show a placeholder.', 'pegasus-child' ),
		'id'           => $prefix . 'image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'preview_size' => 'medium',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Chalkboard script line', 'pegasus-child' ),
		'desc'    => __( 'Small handwritten word above the chalkboard title ( e.g. "Today\'s" ).', 'pegasus-child' ),
		'id'      => $prefix . 'chalk_script',
		'type'    => 'text',
		'default' => 'Today&rsquo;s',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Chalkboard title', 'pegasus-child' ),
		'id'      => $prefix . 'chalk_title',
		'type'    => 'text',
		'default' => 'Plat du jour',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'eyebrow',
		'type'    => 'text',
		'default' => 'The Bistro',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Title', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;br&gt; and &lt;em&gt;...&lt;/em&gt; for the italic accent.', 'pegasus-child' ),
		'id'      => $prefix . 'title',
		'type'    => 'textarea_small',
		'default' => 'Lunch &amp; dinner,<br/><em>French at heart.</em>',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Body copy', 'pegasus-child' ),
		'id'      => $prefix . 'body',
		'type'    => 'textarea',
		'default' => 'A short, seasonal menu of sandwiches, cassoulets, ni&ccedil;oises, and whatever the chef picked up at the farmers&rsquo; market this week. Wines by the glass start at $8.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Primary button text', 'pegasus-child' ),
		'id'      => $prefix . 'btn1_text',
		'type'    => 'text',
		'default' => 'See the menu',
	) );
	$cmb->add_field( array(
		'name' => __( 'Primary button link', 'pegasus-child' ),
		'id'   => $prefix . 'btn1_link',
		'type' => 'text_url',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Secondary button text', 'pegasus-child' ),
		'id'      => $prefix . 'btn2_text',
		'type'    => 'text',
		'default' => 'Reserve',
	) );
	$cmb->add_field( array(
		'name' => __( 'Secondary button link', 'pegasus-child' ),
		'id'   => $prefix . 'btn2_link',
		'type' => 'text_url',
	) );


	/* ── 6. Editorial ────────────────────────────────────────────────────── */
	$prefix = '_sp_home_editorial_';
	$cmb = new_cmb2_box( array(
		'id'           => 'sp_home_editorial',
		'title'        => __( '6. Home &mdash; Editorial', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'    => __( 'Banner label', 'pegasus-child' ),
		'desc'    => __( 'Pill banner text ( e.g. "Spring menu &middot; in season now" ).', 'pegasus-child' ),
		'id'      => $prefix . 'banner_text',
		'type'    => 'text',
		'default' => 'Spring menu &middot; in season now',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Banner list', 'pegasus-child' ),
		'desc'    => __( 'Seasonal ingredients shown after the dash.', 'pegasus-child' ),
		'id'      => $prefix . 'banner_list',
		'type'    => 'text',
		'default' => 'Strawberry &middot; Asparagus &middot; Basil &middot; Rhubarb',
	) );

	$editorial_group = $cmb->add_field( array(
		'id'          => $prefix . 'columns',
		'type'        => 'group',
		'description' => __( 'Editorial columns. Drag to reorder ( numbering is automatic ). Defaults: Process / Sourcing / Community.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Column {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add another column', 'pegasus-child' ),
			'remove_button' => __( 'Remove column', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cmb->add_group_field( $editorial_group, array(
		'name' => __( 'Eyebrow', 'pegasus-child' ),
		'id'   => 'eyebrow',
		'type' => 'text',
	) );
	$cmb->add_group_field( $editorial_group, array(
		'name' => __( 'Title', 'pegasus-child' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	$cmb->add_group_field( $editorial_group, array(
		'name' => __( 'Body', 'pegasus-child' ),
		'desc' => __( 'HTML allowed.', 'pegasus-child' ),
		'id'   => 'body',
		'type' => 'textarea_small',
	) );


	/* ── 7. Visit us ─────────────────────────────────────────────────────── */
	$prefix = '_sp_home_visit_';
	$cmb = new_cmb2_box( array(
		'id'           => 'sp_home_visit',
		'title'        => __( '7. Home &mdash; Visit Us', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'eyebrow',
		'type'    => 'text',
		'default' => 'Find us',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Title', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;em&gt;...&lt;/em&gt; for the italic accent.', 'pegasus-child' ),
		'id'      => $prefix . 'title',
		'type'    => 'textarea_small',
		'default' => 'On the corner of <em>Broadway &amp; 11th.</em>',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Body copy', 'pegasus-child' ),
		'id'      => $prefix . 'body',
		'type'    => 'textarea',
		'default' => 'Three blocks south of the RiverCenter, with parking on 11th and a covered patio when the weather behaves.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Primary button text', 'pegasus-child' ),
		'id'      => $prefix . 'btn1_text',
		'type'    => 'text',
		'default' => 'Get directions',
	) );
	$cmb->add_field( array(
		'name' => __( 'Primary button link', 'pegasus-child' ),
		'id'   => $prefix . 'btn1_link',
		'type' => 'text_url',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Secondary button text', 'pegasus-child' ),
		'id'      => $prefix . 'btn2_text',
		'type'    => 'text',
		'default' => 'Call 706-330-3972',
	) );
	$cmb->add_field( array(
		'name' => __( 'Secondary button link', 'pegasus-child' ),
		'id'   => $prefix . 'btn2_link',
		'type' => 'text_url',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Address', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;br&gt; for line breaks.', 'pegasus-child' ),
		'id'      => $prefix . 'address',
		'type'    => 'textarea_small',
		'default' => '3718 2nd Ave<br/>Columbus, GA 31901',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Hours', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;br&gt; for line breaks.', 'pegasus-child' ),
		'id'      => $prefix . 'hours',
		'type'    => 'textarea_small',
		'default' => 'Mon &ndash; Fri<br/>7:30 &ndash; 5:00<br/><span class="sp-visit__info-muted">Sat &amp; Sun closed</span>',
	) );
}
