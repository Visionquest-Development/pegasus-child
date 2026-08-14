<?php
/**
 * Valor Care — Home page CMB2 fields & front-end defaults.
 *
 * This file is included from the child theme functions.php. It:
 *   1. Provides valorcare_home_defaults() — the design's default content, used
 *      as the front-end fallback (so the page renders the full Claude Design
 *      layout before any CMB2 field is filled in) and to pre-fill scalar fields
 *      in the admin.
 *   2. Registers the Home page metaboxes. Every metabox and every repeatable
 *      group is collapsed (closed) by default. Boxes only appear on pages using
 *      the "Home Page" template (tpl_home.php).
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * All default (design) content for the home page.
 *
 * @return array
 */
function valorcare_home_defaults() {
	static $defaults = null;
	if ( null !== $defaults ) {
		return $defaults;
	}

	$defaults = array(

		// ---- Hero ----------------------------------------------------------
		'hero_badge'      => 'Nurse founded · Locally owned',
		'hero_title_1'    => 'Care You Can Trust.',
		'hero_title_2'    => 'Service You Deserve.',
		'hero_text'       => "Valor Care provides compassionate, non-medical home care that helps your loved one stay safe, independent, and comfortable in the home they love. No doctor's order required.",
		'hero_btn1_text'  => 'Request a Free Consultation',
		'hero_btn1_link'  => '#consultation',
		'hero_btn2_text'  => '770-910-CARE',
		'hero_btn2_link'  => 'tel:+17709102273',
		'hero_image'      => '',

		// ---- Trust bar -----------------------------------------------------
		'trust' => array(
			array( 'icon' => 'fa-user-md',  'text' => 'Founded by an RN with 30+ years of experience' ),
			array( 'icon' => 'fa-home',     'text' => 'Locally owned, never a franchise' ),
			array( 'icon' => 'fa-heart',    'text' => 'Personalized plans for every client' ),
			array( 'icon' => 'fa-clock-o',  'text' => 'Flexible scheduling, responsive communication' ),
		),

		// ---- Services (section chrome only; cards live on the Services page)
		'services_eyebrow' => 'Our Services',
		'services_title'   => 'In-Home Care for Seniors',
		'services_intro'   => 'Every client receives a customized plan built around what they actually need — from a few hours a week to daily support.',

		// ---- Is It Time (signs) -------------------------------------------
		'signs_title'    => 'Is It Time for Home Care?',
		'signs_subtitle' => 'Your loved one may benefit from additional support if you notice:',
		'signs_image'    => '',
		'signs' => array(
			array( 'text' => 'Increased fall risk or balance concerns' ),
			array( 'text' => 'Difficulty with bathing, dressing, or meals' ),
			array( 'text' => 'Memory loss or increasing confusion' ),
			array( 'text' => 'Missed medications or appointments' ),
			array( 'text' => 'Loneliness or social isolation' ),
			array( 'text' => 'Family caregivers feeling overwhelmed' ),
		),
		'signs_cta_text' => "We're here to help you navigate the next step with confidence.",
		'signs_btn_text' => 'Talk with Wendi',
		'signs_btn_link' => '#consultation',

		// ---- Why choose us -------------------------------------------------
		'why_eyebrow' => 'Why Families Choose Us',
		'why_title'   => 'Guided by Honor. Driven by Compassion.',
		'why' => array(
			array( 'icon' => 'fa-user-md',    'title' => 'Nurse Founded',           'text' => 'Clinical judgment behind every care plan, even though our service is non-medical.' ),
			array( 'icon' => 'fa-home',       'title' => 'Locally Owned',           'text' => 'Not a franchise. We live and work in the community we serve.' ),
			array( 'icon' => 'fa-file-text-o','title' => "No Doctor's Order Needed", 'text' => 'Non-medical care you can arrange directly — care can often start within days.' ),
			array( 'icon' => 'fa-users',      'title' => 'Dependable Caregivers',   'text' => 'Consistent, vetted caregivers so your loved one sees a familiar face.' ),
			array( 'icon' => 'fa-flag',       'title' => 'Military Family Values',  'text' => 'Integrity, respect, and dignity shape every interaction.' ),
			array( 'icon' => 'fa-comments-o', 'title' => 'Responsive Communication','text' => "Questions answered by someone who knows your family's situation." ),
		),

		// ---- Founder -------------------------------------------------------
		'founder_eyebrow' => 'Meet the Founder',
		'founder_name'    => 'Wendi McCracken, RN, BSN',
		'founder_image'   => '',
		'founder_bio'     => "After more than 30 years as a Registered Nurse, I founded Valor Care to provide the kind of compassionate, personalized support I would want for my own family.\n\nMy mother's journey with Alzheimer's deepened my understanding of the challenges families face, and it continues to inspire the care we provide every day.",
		'founder_quote'   => 'The care I would want for my own family is the care I strive to provide every day.',

		// ---- Testimonials --------------------------------------------------
		'testimonials_eyebrow' => 'In Their Words',
		'testimonials_title'   => 'What Families Are Saying',
		'testimonials' => array(
			array( 'quote' => 'Testimonial copy goes here once the client collects reviews. Two to three sentences works best in this card.', 'name' => 'Client Name', 'meta' => 'Daughter of client, Kennesaw' ),
			array( 'quote' => 'Testimonial copy goes here once the client collects reviews. Two to three sentences works best in this card.', 'name' => 'Client Name', 'meta' => 'Son of client, Dallas GA' ),
			array( 'quote' => 'Testimonial copy goes here once the client collects reviews. Two to three sentences works best in this card.', 'name' => 'Client Name', 'meta' => 'Case manager, Marietta' ),
		),

		// ---- Service area --------------------------------------------------
		'area_eyebrow' => 'Service Area',
		'area_title'   => 'Proudly Serving Cobb & Paulding Counties',
		'area_text'    => "Local care, close by. If you don't see your city listed, call us — we may still be able to help.",
		'area_image'   => '',
		'area_counties' => array(
			array( 'name' => 'Cobb County',     'cities' => 'Marietta, Kennesaw, Acworth, Powder Springs, Austell, Smyrna' ),
			array( 'name' => 'Paulding County', 'cities' => 'Dallas, Hiram, Villa Rica, Rockmart, Braswell' ),
		),

		// ---- Consultation / contact ---------------------------------------
		'consult_title'      => 'Request a Free Consultation',
		'consult_text'       => "Whether you're exploring care for yourself or someone you love, we're here to help. Tell us a little about your situation and Wendi will follow up personally.",
		'consult_phone'      => '770-910-CARE (2273)',
		'consult_phone_link' => 'tel:+17709102273',
		'consult_email'      => 'valorcarega@gmail.com',
		'consult_payment'    => 'Private pay accepted · Medicaid & VA benefits coming soon',
		'form_note'          => 'We reply within one business day.',
		'consult_form_shortcode' => '',
		'care_options' => array(
			array( 'label' => 'Companionship' ),
			array( 'label' => 'Personal Care' ),
			array( 'label' => 'Respite Care' ),
			array( 'label' => 'Homemaking' ),
			array( 'label' => "Dementia & Alzheimer's Support" ),
			array( 'label' => 'Not sure yet' ),
		),

		// ---- FAQ -----------------------------------------------------------
		'faq_title' => 'Common Questions',
		'faq' => array(
			array( 'question' => "Do we need a doctor's order to start care?", 'answer' => 'No. Valor Care provides non-medical home care, so you can arrange services directly with us. No physician referral or prior authorization is required.' ),
			array( 'question' => 'What does non-medical home care include?', 'answer' => 'Companionship, personal care such as bathing and dressing, respite for family caregivers, homemaking, and support for clients living with dementia. We do not provide skilled nursing, therapy, or medication administration.' ),
			array( 'question' => 'How is care paid for?', 'answer' => "We currently accept private pay. Medicaid and VA benefits are coming soon — call us and we'll let you know where those stand." ),
			array( 'question' => 'How quickly can care begin?', 'answer' => 'In most cases within a few days. We start with a complimentary consultation, build a personalized care plan, and match a caregiver to your loved one.' ),
			array( 'question' => 'Is there a minimum number of hours?', 'answer' => "Schedules are flexible — from a few hours a week to daily support. We'll talk through what fits your family during the consultation." ),
		),

		// ---- Careers CTA ---------------------------------------------------
		'careers_title'    => 'Join Our Caregiving Team',
		'careers_text'     => "We're hiring compassionate, dependable caregivers across Cobb and Paulding Counties. Flexible schedules and a team that treats you like family.",
		'careers_btn_text' => 'Submit Your Resume',
		'careers_btn_link' => '/careers/',
	);

	return $defaults;
}

/**
 * Convenience accessor for a single scalar default.
 *
 * @param string $key Default key.
 * @return string
 */
function valorcare_home_default( $key ) {
	$d = valorcare_home_defaults();
	return isset( $d[ $key ] ) && ! is_array( $d[ $key ] ) ? $d[ $key ] : '';
}

/**
 * Show metaboxes only on pages using the Home Page template.
 *
 * @param CMB2 $cmb CMB2 instance.
 * @return bool
 */
function valorcare_show_on_home_template( $cmb ) {
	$post_id = $cmb->object_id();
	if ( ! $post_id && isset( $_GET['post'] ) ) {
		$post_id = absint( $_GET['post'] );
	}
	if ( ! $post_id ) {
		return false;
	}
	$template = get_post_meta( $post_id, '_wp_page_template', true );
	return 'tpl_home.php' === $template;
}

/**
 * Register all Home page metaboxes.
 */
function valorcare_register_home_metaboxes() {

	$prefix    = 'vc_';
	$defaults  = valorcare_home_defaults();
	$show_args = array(
		'object_types' => array( 'page' ),
		'show_on_cb'   => 'valorcare_show_on_home_template',
		'closed'       => true,
	);

	// Shared group option helper (collapsed by default).
	$group_opts = function( $singular, $plural ) {
		return array(
			'closed'        => true,
			'group_title'   => $singular . ' {#}',
			'add_button'    => 'Add ' . $singular,
			'remove_button' => 'Remove ' . $singular,
			'sortable'      => true,
		);
	};

	/* ------------------------------------------------------------------ Hero */
	$hero = new_cmb2_box( array_merge( $show_args, array(
		'id'    => $prefix . 'hero_box',
		'title' => 'Home — Hero',
	) ) );
	$hero->add_field( array( 'name' => 'Badge', 'id' => $prefix . 'hero_badge', 'type' => 'text', 'default' => $defaults['hero_badge'] ) );
	$hero->add_field( array( 'name' => 'Title Line 1', 'id' => $prefix . 'hero_title_1', 'type' => 'text', 'default' => $defaults['hero_title_1'] ) );
	$hero->add_field( array( 'name' => 'Title Line 2 (gold)', 'id' => $prefix . 'hero_title_2', 'type' => 'text', 'default' => $defaults['hero_title_2'] ) );
	$hero->add_field( array( 'name' => 'Intro Text', 'id' => $prefix . 'hero_text', 'type' => 'textarea_small', 'default' => $defaults['hero_text'] ) );
	$hero->add_field( array( 'name' => 'Primary Button Text', 'id' => $prefix . 'hero_btn1_text', 'type' => 'text', 'default' => $defaults['hero_btn1_text'] ) );
	$hero->add_field( array( 'name' => 'Primary Button Link', 'id' => $prefix . 'hero_btn1_link', 'type' => 'text', 'default' => $defaults['hero_btn1_link'] ) );
	$hero->add_field( array( 'name' => 'Secondary Button Text', 'id' => $prefix . 'hero_btn2_text', 'type' => 'text', 'default' => $defaults['hero_btn2_text'] ) );
	$hero->add_field( array( 'name' => 'Secondary Button Link', 'id' => $prefix . 'hero_btn2_link', 'type' => 'text', 'default' => $defaults['hero_btn2_link'] ) );
	$hero->add_field( array( 'name' => 'Hero Photo', 'id' => $prefix . 'hero_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

	/* -------------------------------------------------------------- Trust bar */
	$trust = new_cmb2_box( array_merge( $show_args, array(
		'id'    => $prefix . 'trust_box',
		'title' => 'Home — Trust Bar',
	) ) );
	$trust_group = $trust->add_field( array(
		'id'      => $prefix . 'trust',
		'type'    => 'group',
		'options' => $group_opts( 'Trust Item', 'Trust Items' ),
	) );
	$trust->add_group_field( $trust_group, array( 'name' => 'Font Awesome Icon (e.g. fa-user-md)', 'id' => 'icon', 'type' => 'text' ) );
	$trust->add_group_field( $trust_group, array( 'name' => 'Text', 'id' => 'text', 'type' => 'textarea_small' ) );

	/* ---------------------------------------------------------------- Services */
	$svc = new_cmb2_box( array_merge( $show_args, array(
		'id'    => $prefix . 'services_box',
		'title' => 'Home — Services',
	) ) );
	$svc->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'services_eyebrow', 'type' => 'text', 'default' => $defaults['services_eyebrow'] ) );
	$svc->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'services_title', 'type' => 'text', 'default' => $defaults['services_title'] ) );
	$svc->add_field( array( 'name' => 'Intro', 'id' => $prefix . 'services_intro', 'type' => 'textarea_small', 'default' => $defaults['services_intro'] ) );
	$svc->add_field( array(
		'name' => 'Service cards',
		'id'   => $prefix . 'services_cards_note',
		'type' => 'title',
		'desc' => 'The cards shown in this section come from the <strong>Services page</strong> (the "Services Catalogue" metabox on the page using the Services Page template). Edit them there — they drive both this grid and the Services page.',
	) );

	/* --------------------------------------------------------- Is It Time (signs) */
	$signs = new_cmb2_box( array_merge( $show_args, array(
		'id'    => $prefix . 'signs_box',
		'title' => 'Home — Is It Time for Home Care?',
	) ) );
	$signs->add_field( array( 'name' => 'Photo', 'id' => $prefix . 'signs_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );
	$signs->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'signs_title', 'type' => 'text', 'default' => $defaults['signs_title'] ) );
	$signs->add_field( array( 'name' => 'Subheading', 'id' => $prefix . 'signs_subtitle', 'type' => 'text', 'default' => $defaults['signs_subtitle'] ) );
	$signs_group = $signs->add_field( array(
		'id'      => $prefix . 'signs',
		'type'    => 'group',
		'options' => $group_opts( 'Sign', 'Signs' ),
	) );
	$signs->add_group_field( $signs_group, array( 'name' => 'Sign', 'id' => 'text', 'type' => 'text' ) );
	$signs->add_field( array( 'name' => 'Call-out Text', 'id' => $prefix . 'signs_cta_text', 'type' => 'textarea_small', 'default' => $defaults['signs_cta_text'] ) );
	$signs->add_field( array( 'name' => 'Button Text', 'id' => $prefix . 'signs_btn_text', 'type' => 'text', 'default' => $defaults['signs_btn_text'] ) );
	$signs->add_field( array( 'name' => 'Button Link', 'id' => $prefix . 'signs_btn_link', 'type' => 'text', 'default' => $defaults['signs_btn_link'] ) );

	/* --------------------------------------------------------- Why choose us */
	$why = new_cmb2_box( array_merge( $show_args, array(
		'id'    => $prefix . 'why_box',
		'title' => 'Home — Why Families Choose Us',
	) ) );
	$why->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'why_eyebrow', 'type' => 'text', 'default' => $defaults['why_eyebrow'] ) );
	$why->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'why_title', 'type' => 'text', 'default' => $defaults['why_title'] ) );
	$why_group = $why->add_field( array(
		'id'      => $prefix . 'why',
		'type'    => 'group',
		'options' => $group_opts( 'Reason', 'Reasons' ),
	) );
	$why->add_group_field( $why_group, array( 'name' => 'Font Awesome Icon', 'id' => 'icon', 'type' => 'text' ) );
	$why->add_group_field( $why_group, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$why->add_group_field( $why_group, array( 'name' => 'Text', 'id' => 'text', 'type' => 'textarea_small' ) );

	/* ----------------------------------------------------------------- Founder */
	$founder = new_cmb2_box( array_merge( $show_args, array(
		'id'    => $prefix . 'founder_box',
		'title' => 'Home — Meet the Founder',
	) ) );
	$founder->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'founder_eyebrow', 'type' => 'text', 'default' => $defaults['founder_eyebrow'] ) );
	$founder->add_field( array( 'name' => 'Name', 'id' => $prefix . 'founder_name', 'type' => 'text', 'default' => $defaults['founder_name'] ) );
	$founder->add_field( array( 'name' => 'Portrait', 'id' => $prefix . 'founder_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );
	$founder->add_field( array( 'name' => 'Bio (one paragraph per line)', 'id' => $prefix . 'founder_bio', 'type' => 'textarea', 'default' => $defaults['founder_bio'] ) );
	$founder->add_field( array( 'name' => 'Pull Quote', 'id' => $prefix . 'founder_quote', 'type' => 'textarea_small', 'default' => $defaults['founder_quote'] ) );

	/* ------------------------------------------------------------- Testimonials */
	$test = new_cmb2_box( array_merge( $show_args, array(
		'id'    => $prefix . 'testimonials_box',
		'title' => 'Home — Testimonials',
	) ) );
	$test->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'testimonials_eyebrow', 'type' => 'text', 'default' => $defaults['testimonials_eyebrow'] ) );
	$test->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'testimonials_title', 'type' => 'text', 'default' => $defaults['testimonials_title'] ) );
	$test_group = $test->add_field( array(
		'id'      => $prefix . 'testimonials',
		'type'    => 'group',
		'options' => $group_opts( 'Testimonial', 'Testimonials' ),
	) );
	$test->add_group_field( $test_group, array( 'name' => 'Quote', 'id' => 'quote', 'type' => 'textarea_small' ) );
	$test->add_group_field( $test_group, array( 'name' => 'Name', 'id' => 'name', 'type' => 'text' ) );
	$test->add_group_field( $test_group, array( 'name' => 'Relationship / Location', 'id' => 'meta', 'type' => 'text' ) );

	/* ------------------------------------------------------------- Service area */
	$area = new_cmb2_box( array_merge( $show_args, array(
		'id'    => $prefix . 'area_box',
		'title' => 'Home — Service Area',
	) ) );
	$area->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'area_eyebrow', 'type' => 'text', 'default' => $defaults['area_eyebrow'] ) );
	$area->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'area_title', 'type' => 'text', 'default' => $defaults['area_title'] ) );
	$area->add_field( array( 'name' => 'Text', 'id' => $prefix . 'area_text', 'type' => 'textarea_small', 'default' => $defaults['area_text'] ) );
	$area->add_field( array( 'name' => 'Map Image', 'id' => $prefix . 'area_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );
	$area_group = $area->add_field( array(
		'id'      => $prefix . 'area_counties',
		'type'    => 'group',
		'options' => $group_opts( 'County', 'Counties' ),
	) );
	$area->add_group_field( $area_group, array( 'name' => 'County Name', 'id' => 'name', 'type' => 'text' ) );
	$area->add_group_field( $area_group, array( 'name' => 'Cities (comma separated)', 'id' => 'cities', 'type' => 'textarea_small' ) );

	/* ------------------------------------------------------ Consultation / form */
	$consult = new_cmb2_box( array_merge( $show_args, array(
		'id'    => $prefix . 'consult_box',
		'title' => 'Home — Consultation / Contact',
	) ) );
	$consult->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'consult_title', 'type' => 'text', 'default' => $defaults['consult_title'] ) );
	$consult->add_field( array( 'name' => 'Text', 'id' => $prefix . 'consult_text', 'type' => 'textarea_small', 'default' => $defaults['consult_text'] ) );
	$consult->add_field( array( 'name' => 'Phone (display)', 'id' => $prefix . 'consult_phone', 'type' => 'text', 'default' => $defaults['consult_phone'] ) );
	$consult->add_field( array( 'name' => 'Phone Link', 'id' => $prefix . 'consult_phone_link', 'type' => 'text', 'default' => $defaults['consult_phone_link'] ) );
	$consult->add_field( array( 'name' => 'Email', 'id' => $prefix . 'consult_email', 'type' => 'text', 'default' => $defaults['consult_email'] ) );
	$consult->add_field( array( 'name' => 'Payment Note', 'id' => $prefix . 'consult_payment', 'type' => 'text', 'default' => $defaults['consult_payment'] ) );
	$consult->add_field( array( 'name' => 'Form Reply Note', 'id' => $prefix . 'form_note', 'type' => 'text', 'default' => $defaults['form_note'] ) );
	$consult->add_field( array(
		'name' => 'Gravity Forms Shortcode',
		'desc' => 'Optional. Paste a Gravity Forms shortcode (e.g. <code>[gravityform id="1" title="false" description="false"]</code>) to replace the built-in contact form. Leave blank to keep the built-in form.',
		'id'   => $prefix . 'consult_form_shortcode',
		'type' => 'textarea_small',
	) );
	$care_group = $consult->add_field( array(
		'id'      => $prefix . 'care_options',
		'type'    => 'group',
		'options' => $group_opts( 'Care Option', 'Care Options' ),
	) );
	$consult->add_group_field( $care_group, array( 'name' => 'Option Label', 'id' => 'label', 'type' => 'text' ) );

	/* --------------------------------------------------------- FAQ & Careers CTA */
	$faq = new_cmb2_box( array_merge( $show_args, array(
		'id'    => $prefix . 'faq_box',
		'title' => 'Home — FAQ & Careers',
	) ) );
	$faq->add_field( array( 'name' => 'FAQ Heading', 'id' => $prefix . 'faq_title', 'type' => 'text', 'default' => $defaults['faq_title'] ) );
	$faq_group = $faq->add_field( array(
		'id'      => $prefix . 'faq',
		'type'    => 'group',
		'options' => $group_opts( 'Question', 'Questions' ),
	) );
	$faq->add_group_field( $faq_group, array( 'name' => 'Question', 'id' => 'question', 'type' => 'text' ) );
	$faq->add_group_field( $faq_group, array( 'name' => 'Answer', 'id' => 'answer', 'type' => 'textarea_small' ) );
	$faq->add_field( array( 'name' => 'Careers Heading', 'id' => $prefix . 'careers_title', 'type' => 'text', 'default' => $defaults['careers_title'] ) );
	$faq->add_field( array( 'name' => 'Careers Text', 'id' => $prefix . 'careers_text', 'type' => 'textarea_small', 'default' => $defaults['careers_text'] ) );
	$faq->add_field( array( 'name' => 'Careers Button Text', 'id' => $prefix . 'careers_btn_text', 'type' => 'text', 'default' => $defaults['careers_btn_text'] ) );
	$faq->add_field( array( 'name' => 'Careers Button Link', 'id' => $prefix . 'careers_btn_link', 'type' => 'text', 'default' => $defaults['careers_btn_link'] ) );
}
add_action( 'cmb2_admin_init', 'valorcare_register_home_metaboxes' );
