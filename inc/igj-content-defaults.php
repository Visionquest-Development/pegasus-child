<?php
/**
 * Insurance Guy Joe — content registry and DEFAULT content (single source of truth).
 *
 * Each template has numbered sections in the order they appear on the page. Each field's
 * 'default' is the content the site ships with. CMB2 admin fields (inc/igj-cmb2.php) are built
 * from this registry, and templates read it back through igj_section() (inc/igj-cms.php).
 *
 * Field types: text, textarea (HTML allowed), paras (paragraphs, blank line between),
 * list (one item per line), url, image (theme image slug as default), select, multicheck,
 * group (repeatable; 'item' names each row, e.g. "Step {#}").
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ---------- Tiny builders ---------- */

function igj_f( $id, $name, $type, $default = '', $extra = array() ) {
	return array_merge( array( 'id' => $id, 'name' => $name, 'type' => $type, 'default' => $default ), $extra );
}

function igj_g( $id, $name, $item, $fields, $default = array(), $extra = array() ) {
	return array_merge( array( 'id' => $id, 'name' => $name, 'type' => 'group', 'item' => $item, 'fields' => $fields, 'default' => $default ), $extra );
}

/**
 * Templates with editable content: key => [ page template file, admin label ].
 */
function igj_cms_templates() {
	return array(
		'home'     => array( 'file' => 'tpl_igj_home.php', 'label' => 'Home' ),
		'about'    => array( 'file' => 'tpl_igj_about.php', 'label' => 'About' ),
		'services' => array( 'file' => 'tpl_igj_services.php', 'label' => 'Services Hub' ),
		'service'  => array( 'file' => 'tpl_igj_service.php', 'label' => 'Service Page' ),
		'contact'  => array( 'file' => 'tpl_igj_contact.php', 'label' => 'Contact' ),
		'faq'      => array( 'file' => 'tpl_igj_faq.php', 'label' => 'FAQ' ),
	);
}

/* ---------- Option lists for selects ---------- */

function igj_cms_service_options() {
	$out = array();
	foreach ( igj_services() as $slug => $s ) {
		$out[ $slug ] = $s['title'];
	}
	return $out;
}

function igj_cms_guide_options() {
	$out = array();
	foreach ( get_posts( array( 'post_type' => 'post', 'posts_per_page' => 100, 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC' ) ) as $p ) {
		$out[ $p->post_name ] = get_the_title( $p );
	}
	return $out;
}

function igj_cms_rows( $key, $values ) {
	return array_map( function ( $v ) use ( $key ) {
		return array( $key => $v );
	}, array_values( (array) $values ) );
}

/* ---------- Shared section definitions (used on several templates) ---------- */

function igj_cms_sec_page_hero( $eyebrow, $title, $lead ) {
	return array(
		'title'  => 'Page Hero',
		'fields' => array(
			igj_f( 'eyebrow', 'Eyebrow (small text above the title)', 'text', $eyebrow ),
			igj_f( 'title', 'Page title (H1)', 'text', $title ),
			igj_f( 'lead', 'Intro paragraph', 'textarea', $lead ),
		),
	);
}

function igj_cms_sec_free_services() {
	return array(
		'title'  => 'Free Services',
		'desc'   => 'The compensation disclosure under this box is site-wide: IGJ Site Info → 06.',
		'fields' => array(
			igj_f( 'eyebrow', 'Eyebrow', 'text', 'No fees. No pressure.' ),
			igj_f( 'title', 'Heading', 'text', 'Our Services Are Always Free to You!' ),
			igj_f( 'lead', 'Intro paragraph', 'textarea', 'We help you explore health insurance options, compare plans, understand your benefits, and find coverage that fits your needs and budget — at no additional cost for our services.' ),
			igj_g( 'items', 'Free services checklist', 'Item', array( igj_f( 'text', 'Text', 'text' ) ), igj_cms_rows( 'text', array( 'Free consultations', 'Free plan comparisons', 'Free enrollment assistance', 'Free ongoing help with your coverage' ) ) ),
		),
	);
}

function igj_cms_sec_steps() {
	return array(
		'title'  => 'Four-Step Process',
		'fields' => array(
			igj_f( 'eyebrow', 'Eyebrow', 'text', 'How we work with you' ),
			igj_f( 'title', 'Heading', 'text', 'Our Four-Step Process' ),
			igj_f( 'intro', 'Intro', 'text', 'We’re here to help you, not simply sell you a policy.' ),
			igj_g(
				'steps',
				'Steps',
				'Step',
				array(
					igj_f( 'word', 'Step word', 'text' ),
					igj_f( 'sub', 'Step subtitle', 'text' ),
					igj_f( 'text', 'Description', 'textarea' ),
				),
				array(
					array( 'word' => 'Discover', 'sub' => 'Seek First to Understand', 'text' => 'We take time to understand your healthcare needs, preferred providers, prescriptions, financial situation and budget.' ),
					array( 'word' => 'Obtain', 'sub' => 'Research Available Options', 'text' => 'We explore the health insurance options available to you based on your needs and eligibility.' ),
					array( 'word' => 'Gather', 'sub' => 'Construct Solutions', 'text' => 'We identify coverage solutions that line up with your priorities.' ),
					array( 'word' => 'Educate', 'sub' => 'Explain the Options', 'text' => 'We help you understand premiums, deductibles, networks, out-of-pocket costs, benefits and limitations so you can make an informed decision.' ),
				)
			),
		),
	);
}

function igj_cms_sec_states() {
	return array(
		'title'  => 'States We Serve',
		'desc'   => 'The headline and the state list are site-wide (IGJ Site Info → 04) because they also feed the footer and search-engine schema.',
		'fields' => array(
			igj_f( 'eyebrow', 'Eyebrow', 'text', 'States we serve' ),
			igj_f( 'intro', 'Intro ({state_count} = number of states)', 'textarea', 'From our home base in Roswell, Georgia, we help clients by phone and online in {state_count} states. Don’t see your state? Ask us — our licensing footprint grows regularly, and we obtain any required licenses and appointments before offering coverage in a new state.' ),
			igj_f( 'badge', 'Home state badge', 'text', 'Home state' ),
			igj_f( 'more', 'Last list item', 'text', 'And growing!' ),
			igj_f( 'note', 'Note under the list', 'textarea', 'Plans, carriers and Marketplace options vary by state and agent. Insurance is offered only where we are licensed and appointed. State license numbers are available on request.' ),
		),
	);
}

function igj_cms_sec_carriers() {
	return array(
		'title'  => 'Carriers & Private Options',
		'desc'   => 'The carrier and program names are site-wide: IGJ Site Info → 05.',
		'fields' => array(
			igj_f( 'eyebrow', 'Eyebrow', 'text', 'More choices, one conversation' ),
			igj_f( 'title', 'Heading', 'text', 'ACA Marketplace & Private Health Insurance Options' ),
			igj_f( 'intro', 'Intro', 'textarea', 'We help you explore both ACA Marketplace plans and private health insurance, and we explain the differences clearly.' ),
			igj_f( 'carriers_title', 'Marketplace card: heading', 'text', 'Marketplace carriers we work with' ),
			igj_f( 'carriers_more', 'Marketplace card: last chip', 'text', 'Other state-specific carriers' ),
			igj_f( 'carriers_note', 'Marketplace card: note', 'textarea', 'Carrier appointments vary by state and by agent. Not every carrier is available in every state.' ),
			igj_f( 'private_title', 'Private card: heading', 'text', 'Private health insurance options' ),
			igj_f( 'private_more', 'Private card: last chip', 'text', 'Other individual, family & employer-group options' ),
			igj_f( 'private_note', 'Private card: note (HTML links allowed)', 'textarea', 'Private products have different eligibility, underwriting, networks, benefits and state availability, and may not be ACA-compliant major medical coverage. <a href="' . esc_url( wp_make_link_relative( igj_learn_url( 'aca-vs-private-health-insurance' ) ) ) . '">ACA vs. private health insurance, explained</a>.' ),
		),
	);
}

function igj_cms_sec_cta( $title = 'Ready to compare your options?', $text = null ) {
	return array(
		'title'  => 'Bottom Call-to-Action',
		'desc'   => 'The Schedule button label/link and phone number are site-wide: IGJ Site Info → 01.',
		'fields' => array(
			igj_f( 'title', 'Heading', 'text', $title ),
			igj_f( 'text', 'Text', 'textarea', null !== $text ? $text : 'Tell us a little about your situation and we’ll walk you through plans that fit your budget, your doctors and your timeline. Our services are always free to you. No pressure, no obligation.' ),
			igj_f( 'alt_label', 'Form link label', 'text', 'Prefer a form? Request a free quote' ),
		),
	);
}

function igj_cms_sec_testimonials() {
	return array(
		'title'  => 'Testimonials',
		'desc'   => 'Testimonials are site-wide: IGJ Site Info → 07. The section is hidden until at least one is added.',
		'fields' => array( igj_f( 'title', 'Heading', 'text', 'What clients say' ) ),
	);
}

/* ---------- Template schemas ---------- */

/**
 * Sections for a template, in page order. Keys are section IDs; numbering is by position.
 *
 * @param string $tpl     Template key (see igj_cms_templates()) or 'site'.
 * @param int    $post_id Page ID (service pages take their defaults from data/services.json).
 */
function igj_cms_schema( $tpl, $post_id = 0 ) {
	static $cache = array();
	$ck = $tpl . '|' . ( 'service' === $tpl ? (int) $post_id : 0 );
	if ( isset( $cache[ $ck ] ) ) {
		return $cache[ $ck ];
	}
	$fn = 'igj_cms_schema_' . $tpl;
	$s  = function_exists( $fn ) ? call_user_func( $fn, (int) $post_id ) : array();
	$cache[ $ck ] = $s;
	return $s;
}

/* Home ------------------------------------------------------------------------ */

function igj_cms_home_faq_teaser() {
	$teaser = array();
	foreach ( (array) ( igj_data( 'faq' )['groups'] ?? array() ) as $g ) {
		foreach ( $g['items'] as $it ) {
			if ( false === strpos( $it['a'], '{{todo:' ) && count( $teaser ) < 4 ) {
				$teaser[] = array( 'q' => $it['q'], 'a' => $it['a'] );
			}
		}
	}
	return $teaser;
}

function igj_cms_schema_home() {
	$guides = array( 'open-enrollment-guide', 'aca-vs-private-health-insurance', 'ppo-vs-hmo-vs-epo' );
	return array(
		'hero'     => array(
			'title'  => 'Hero',
			'desc'   => 'The Schedule button, phone number and Open Enrollment banner are managed elsewhere (IGJ Site Info → 01; Appearance → Customize → Open Enrollment Banner).',
			'fields' => array(
				igj_f( 'eyebrow', 'Eyebrow', 'text', 'Insurance Guy Joe Solutions · Joe & Dianna Avena' ),
				igj_f( 'title', 'Main heading (H1)', 'text', 'Health insurance for individuals, families, the self-employed & small businesses' ),
				igj_f( 'lead', 'Intro paragraph', 'textarea', 'We’re a husband-and-wife team of licensed health insurance professionals. We help you understand your options, from ACA Marketplace plans to private coverage, so you can make an informed decision for your health needs and budget.' ),
				igj_f( 'alt_label', 'Quote form link label', 'text', 'Or request a free quote online' ),
				igj_g( 'trust', 'Checkmark bullets ({state_count} = number of states)', 'Bullet', array( igj_f( 'text', 'Text', 'text' ) ), igj_cms_rows( 'text', array( 'Our services are always free to you', 'Licensed in {state_count} states — and growing', 'ACA Marketplace & private health insurance options' ) ) ),
				igj_f( 'image', 'Photo', 'image', 'joe-dianna-indoor' ),
			),
		),
		'free'     => igj_cms_sec_free_services(),
		'who'      => array(
			'title'  => 'Who We Help (service cards)',
			'desc'   => 'Each card’s title, summary and icon are edited on that service page (Service Page → 02).',
			'fields' => array(
				igj_f( 'eyebrow', 'Eyebrow', 'text', 'Who we help' ),
				igj_f( 'title', 'Heading', 'text', 'Coverage for where you are in life and work' ),
				igj_g( 'cards', 'Service cards', 'Card', array( igj_f( 'service', 'Service', 'select', '', array( 'options_cb' => 'igj_cms_service_options' ) ) ), igj_cms_rows( 'service', array( 'individual-family-health-insurance', 'self-employed-health-insurance', 'small-business-health-insurance', 'aca-marketplace-health-insurance', 'private-health-insurance', 'cobra-alternatives' ) ) ),
				igj_f( 'button_label', 'Button label', 'text', 'See all 13 health insurance services' ),
				igj_f( 'button_url', 'Button link', 'url', '/services/' ),
			),
		),
		'steps'    => igj_cms_sec_steps(),
		'meet'     => array(
			'title'  => 'Meet Joe & Dianna',
			'desc'   => 'The names and titles listed under the text come from IGJ Site Info → 03 Team Members.',
			'fields' => array(
				igj_f( 'image', 'Photo', 'image', 'joe-dianna-closeup' ),
				igj_f( 'eyebrow', 'Eyebrow', 'text', 'Your trusted partners in health coverage' ),
				igj_f( 'title', 'Heading', 'text', 'Meet Joe & Dianna Avena' ),
				igj_f( 'lead', 'Intro paragraph', 'textarea', 'Insurance Guy Joe Solutions is a husband-and-wife team based in Roswell, Georgia. Our business is built around helping people understand their health insurance options and make informed decisions based on their healthcare needs and budget.' ),
				igj_f( 'text', 'Paragraph', 'textarea', 'We take a personal approach. We’re here to help you, not simply sell you a policy, and we work with clients by phone and online.' ),
				igj_f( 'button_label', 'Button label', 'text', 'Meet Joe & Dianna' ),
				igj_f( 'button_url', 'Button link', 'url', '/about/' ),
			),
		),
		'states'   => igj_cms_sec_states(),
		'reviews'  => igj_cms_sec_testimonials(),
		'learn'    => array(
			'title'  => 'Learn & Quick Answers',
			'fields' => array(
				igj_f( 'eyebrow', 'Eyebrow', 'text', 'Learn' ),
				igj_f( 'title', 'Heading', 'text', 'Health insurance, explained' ),
				igj_g( 'guides', 'Featured guides', 'Guide', array( igj_f( 'guide', 'Guide (post)', 'select', '', array( 'options_cb' => 'igj_cms_guide_options' ) ) ), igj_cms_rows( 'guide', $guides ) ),
				igj_f( 'faq_title', 'Quick answers heading', 'text', 'Quick answers' ),
				igj_g(
					'faq',
					'Quick answers',
					'Question',
					array(
						igj_f( 'q', 'Question', 'text' ),
						igj_f( 'a', 'Answer (HTML links allowed)', 'textarea' ),
					),
					igj_cms_home_faq_teaser()
				),
				igj_f( 'faq_link_label', 'FAQ link label', 'text', 'See all FAQs' ),
				igj_f( 'faq_link_url', 'FAQ link', 'url', '/faq/' ),
			),
		),
		'cta'      => igj_cms_sec_cta(),
	);
}

/* About ----------------------------------------------------------------------- */

function igj_cms_schema_about() {
	$site = igj_data( 'site' );
	return array(
		'hero'     => igj_cms_sec_page_hero( 'About Insurance Guy Joe Solutions', 'Meet Joe & Dianna Avena', 'A husband-and-wife team of licensed health insurance professionals in Roswell, Georgia, helping individuals, families and small businesses across multiple states.' ),
		'story'    => array(
			'title'  => 'Our Story',
			'fields' => array(
				igj_f( 'image', 'Photo', 'image', 'joe-dianna-outdoor' ),
				igj_f( 'title', 'Heading', 'text', 'Personal care meets tailored coverage' ),
				igj_f( 'lead', 'Intro paragraph', 'textarea', 'Insurance Guy Joe Solutions is a husband-and-wife team. Our business is built around helping people understand their health insurance options and make informed decisions based on their healthcare needs and budget.' ),
				igj_f( 'text', 'Paragraph', 'textarea', 'We take a personal approach. We want our clients to know that we’re here to help them, not simply sell them a policy. Whether you’re just starting to research coverage or you’re ready to enroll, you can reach out with questions any time.' ),
				igj_f( 'quote', 'Quote', 'textarea', (string) ( $site['agent']['bio_from_site'] ?? '' ) ),
				igj_f( 'quote_by', 'Quote attribution', 'text', (string) ( $site['agent']['name'] ?? '' ) ),
				igj_f( 'local', 'Where we work', 'textarea', 'We’re based in Roswell, Georgia, and work with clients primarily by phone and online. We serve Roswell, Alpharetta, Johns Creek, East Cobb, Atlanta and all of Georgia, plus clients in the many other states where we’re licensed.' ),
			),
		),
		'team'     => array(
			'title'  => 'Licensing & Team',
			'desc'   => 'Names, photos, NPNs, emails and licensed states for each person are in IGJ Site Info → 03 Team Members.',
			'fields' => array(
				igj_f( 'eyebrow', 'Eyebrow', 'text', 'Your licensed team' ),
				igj_f( 'title', 'Heading', 'text', 'Licensing & Marketplace certifications' ),
				igj_f( 'intro', 'Intro', 'textarea', 'Both Joe and Dianna are certified with the Federally Facilitated Marketplace (HealthCare.gov) for the 2027 plan year in applicable states, and with Georgia Access and Get Covered Illinois.' ),
				igj_f( 'npn_label', 'NPN line ({npn} = number)', 'text', 'National Producer Number (NPN) {npn}' ),
				igj_f( 'cert_line', 'Certification line on each card', 'text', 'Certified with HealthCare.gov (FFM) for 2027, Georgia Access and Get Covered Illinois' ),
				igj_f( 'states_label', 'States toggle ({count} = number of states)', 'text', 'Licensed in {count} states — and growing!' ),
			),
		),
		'steps'    => igj_cms_sec_steps(),
		'states'   => igj_cms_sec_states(),
		'carriers' => igj_cms_sec_carriers(),
		'free'     => igj_cms_sec_free_services(),
		'reviews'  => igj_cms_sec_testimonials(),
		'cta'      => igj_cms_sec_cta( 'Let’s find your coverage, together' ),
	);
}

/* Services hub ---------------------------------------------------------------- */

function igj_cms_schema_services() {
	$basics = array();
	foreach ( array( 'aca-vs-private-health-insurance', 'open-enrollment-guide', 'ppo-vs-hmo-vs-epo' ) as $slug ) {
		$basics[] = array( 'label' => igj_learn_title( $slug ), 'url' => wp_make_link_relative( igj_learn_url( $slug ) ) );
	}
	$basics[] = array( 'label' => 'Health insurance FAQs', 'url' => '/faq/' );
	return array(
		'hero'     => igj_cms_sec_page_hero( '', 'Health Insurance Services', 'Whatever your situation, from a new family to a new business, a job change or early retirement, Joe & Dianna help you find coverage that fits. Pick the one that sounds like you.' ),
		'groups'   => array(
			'title'  => 'Service Groups',
			'desc'   => 'Each card’s title, summary and icon are edited on that service page (Service Page → 02).',
			'fields' => array(
				igj_g(
					'groups',
					'Groups of service cards',
					'Group',
					array(
						igj_f( 'label', 'Group heading', 'text' ),
						igj_f( 'services', 'Services in this group', 'multicheck', array(), array( 'options_cb' => 'igj_cms_service_options' ) ),
					),
					array(
						array( 'label' => 'Individuals & families', 'services' => array( 'individual-family-health-insurance', 'turning-26-health-insurance', 'early-retiree-health-insurance' ) ),
						array( 'label' => 'Self-employed, 1099 & business owners', 'services' => array( 'self-employed-health-insurance', 'health-insurance-for-1099', 'small-business-health-insurance', 'realtor-health-insurance', 'travel-nurse-health-insurance' ) ),
						array( 'label' => 'Plan types & coverage changes', 'services' => array( 'aca-marketplace-health-insurance', 'private-health-insurance', 'cobra-alternatives' ) ),
						array( 'label' => 'Supplemental coverage', 'services' => array( 'supplemental-insurance', 'dental-vision-insurance' ) ),
					)
				),
			),
		),
		'howhelp'  => array(
			'title'  => 'How We Help',
			'fields' => array(
				igj_f( 'image', 'Photo', 'image', 'dianna-laptop' ),
				igj_f( 'eyebrow', 'Eyebrow', 'text', 'How we help' ),
				igj_f( 'title', 'Heading', 'text', 'Personal help comparing ACA Marketplace and private health insurance' ),
				igj_f(
					'body',
					'Text (leave a blank line between paragraphs)',
					'paras',
					array(
						'We help people understand their health insurance options and make informed decisions based on their healthcare needs and budget. We look at your preferred providers, prescriptions, financial situation and budget, research what’s available to you, and explain premiums, deductibles, networks, out-of-pocket costs, benefits and limitations in plain English.',
						'Our consultations, plan comparisons, enrollment assistance and ongoing help with your coverage are always free to you.',
					)
				),
			),
		),
		'carriers' => igj_cms_sec_carriers(),
		'fit'      => array(
			'title'  => 'Not Sure Where You Fit?',
			'desc'   => 'Anything typed in the main page editor appears under this text.',
			'fields' => array(
				igj_f( 'title', 'Heading', 'text', 'Not sure where you fit?' ),
				igj_f( 'text', 'Text', 'textarea', 'Many people fit more than one category, like a self-employed parent covering a family, or an early retiree weighing COBRA. That’s normal. A short, free call with us sorts out which options are actually open to you, and when you can enroll.' ),
			),
		),
		'basics'   => array(
			'title'  => 'Start With the Basics',
			'fields' => array(
				igj_f( 'title', 'Heading', 'text', 'Start with the basics' ),
				igj_g(
					'links',
					'Links',
					'Link',
					array(
						igj_f( 'label', 'Link text', 'text' ),
						igj_f( 'url', 'Link', 'url' ),
					),
					$basics
				),
			),
		),
		'cta'      => igj_cms_sec_cta(),
	);
}

/* Service pages (13 pages; defaults per page from data/services.json) --------- */

function igj_cms_service_slug_for( $post_id ) {
	$slug = $post_id ? get_post_field( 'post_name', $post_id ) : '';
	return ( $slug && igj_service( $slug ) ) ? $slug : '';
}

function igj_cms_schema_service( $post_id ) {
	$slug = igj_cms_service_slug_for( $post_id );
	$svc  = $slug ? igj_service( $slug ) : array();
	$secs = array();
	foreach ( (array) ( $svc['sections'] ?? array() ) as $sec ) {
		$secs[] = array(
			'heading' => $sec['h'] ?? '',
			'body'    => array_values( (array) ( $sec['p'] ?? array() ) ),
			'list'    => array_values( (array) ( $sec['list'] ?? array() ) ),
		);
	}
	$faq = array();
	foreach ( (array) ( $svc['faq'] ?? array() ) as $it ) {
		$faq[] = array( 'q' => $it['q'], 'a' => $it['a'] );
	}
	return array(
		'hero'    => igj_cms_sec_page_hero( 'Health insurance services', $svc['title'] ?? '', $svc['lead'] ?? '' ),
		'card'    => array(
			'title'  => 'Service Card',
			'desc'   => 'How this service appears in card grids (Home, Services, FAQ sidebar, related links). The card title is the page title from 01.',
			'fields' => array(
				igj_f( 'summary', 'Card summary', 'textarea', $svc['summary'] ?? '' ),
				igj_f( 'icon', 'Card icon (Font Awesome 4 class, e.g. fa-users)', 'text', $svc['icon'] ?? 'fa-heartbeat' ),
			),
		),
		'content' => array(
			'title'  => 'Page Content',
			'desc'   => 'Anything typed in the main page editor appears after these sections.',
			'fields' => array(
				igj_g(
					'sections',
					'Content sections',
					'Section',
					array(
						igj_f( 'heading', 'Heading (H2)', 'text' ),
						igj_f( 'body', 'Text (blank line between paragraphs; HTML links allowed)', 'paras' ),
						igj_f( 'list', 'Checklist (one item per line, optional)', 'list' ),
					),
					$secs
				),
				igj_f( 'children_title', 'Heading above child service cards (only shown when this page has child pages)', 'text', 'Supplemental coverage options' ),
			),
		),
		'faq'     => array(
			'title'  => 'FAQ',
			'desc'   => 'These questions are also published as FAQ structured data for search engines.',
			'fields' => array(
				igj_f( 'title', 'Heading ({title} = page title)', 'text', '{title}: frequently asked questions' ),
				igj_g(
					'items',
					'Questions',
					'Question',
					array(
						igj_f( 'q', 'Question', 'text' ),
						igj_f( 'a', 'Answer (HTML links allowed)', 'textarea' ),
					),
					$faq
				),
				igj_f( 'more_label', 'Link to the FAQ page', 'text', 'More health insurance FAQs' ),
			),
		),
		'sidebar' => array(
			'title'  => 'Sidebar',
			'fields' => array(
				igj_f( 'talk_title', 'Quote card: heading', 'text', 'Talk to Joe & Dianna' ),
				igj_f( 'talk_text', 'Quote card: text', 'textarea', 'Get a free, no-obligation quote and straight answers about your options.' ),
				igj_f( 'talk_button', 'Quote card: button label', 'text', 'Get a Free Quote' ),
				igj_f( 'related_title', 'Related coverage: heading', 'text', 'Related coverage' ),
				igj_g( 'related', 'Related coverage', 'Related service', array( igj_f( 'service', 'Service', 'select', '', array( 'options_cb' => 'igj_cms_service_options' ) ) ), igj_cms_rows( 'service', (array) ( $svc['related'] ?? array() ) ) ),
				igj_f( 'all_label', 'Related coverage: “all services” link', 'text', 'All services' ),
				igj_f( 'guides_title', 'Helpful guides: heading', 'text', 'Helpful guides' ),
				igj_g( 'guides', 'Helpful guides', 'Guide', array( igj_f( 'guide', 'Guide (post)', 'select', '', array( 'options_cb' => 'igj_cms_guide_options' ) ) ), igj_cms_rows( 'guide', (array) ( $svc['learn'] ?? array() ) ) ),
			),
		),
		'cta'     => igj_cms_sec_cta( 'Questions about {title}?' ),
	);
}

/* Contact --------------------------------------------------------------------- */

function igj_cms_schema_contact() {
	return array(
		'hero'     => array(
			'title'  => 'Page Hero',
			'fields' => array(
				igj_f( 'title', 'Page title (H1)', 'text', 'Contact Joe & Dianna: Free Health Insurance Help' ),
				igj_f( 'lead', 'Intro paragraph', 'textarea', 'Schedule a free consultation, call, or send a few details and we’ll get back to you. Our services are always free to you, with no obligation.' ),
			),
		),
		'schedule' => array(
			'title'  => 'Schedule a Consultation',
			'desc'   => 'The scheduling link (Picktime) is site-wide: IGJ Site Info → 01.',
			'fields' => array(
				igj_f( 'title', 'Heading', 'text', 'Schedule Your Free Health Insurance Consultation' ),
				igj_f( 'text', 'Text', 'textarea', 'Pick a time that works for you. To help us prepare, please share your name, email, phone, ZIP code, who needs coverage, your desired effective date and a brief description of what you’re looking for.' ),
				igj_f( 'button', 'Button label', 'text', 'Schedule Now' ),
			),
		),
		'form'     => array(
			'title'  => 'Quote Request Form',
			'desc'   => 'Where requests are emailed: IGJ Site Info → 02. The “What are you looking for?” list is built from the service page titles.',
			'fields' => array(
				igj_f( 'title', 'Heading', 'text', 'Request a quote' ),
				igj_f( 'msg_ok', 'Message after sending', 'text', 'Thanks! Your request was sent. Joe or Dianna will be in touch soon.' ),
				igj_f( 'msg_missing', 'Message when fields are missing', 'text', 'Please add your name, a phone number or email, and check the consent box.' ),
				igj_f( 'msg_error', 'Message on error ({phone} = phone number)', 'text', 'Sorry, something went wrong. Please call {phone}.' ),
				igj_g( 'who', '“Who needs coverage?” choices', 'Choice', array( igj_f( 'label', 'Choice', 'text' ) ), igj_cms_rows( 'label', array( 'Just me', 'Me and my spouse/partner', 'My family (with children)', 'My child(ren) only', 'My employees / business', 'Other' ) ) ),
				igj_f( 'topic_other', 'Last “What are you looking for?” choice', 'text', 'Not sure yet' ),
				igj_f( 'privacy_note', 'Note under the message box', 'text', 'Please don’t include Social Security numbers or detailed medical information here.' ),
				igj_f( 'consent', 'Consent checkbox text (HTML links allowed)', 'textarea', 'I agree that Insurance Guy Joe Solutions may contact me by phone, text or email about health insurance options. Consent isn’t required to buy. See our <a href="/privacy-policy/">Privacy Policy</a>.' ),
				igj_f( 'submit', 'Submit button label', 'text', 'Send my quote request' ),
			),
		),
		'sidebar'  => array(
			'title'  => 'Sidebar',
			'desc'   => 'Phone, emails, location and the scheduling link are site-wide: IGJ Site Info → 01 and 03.',
			'fields' => array(
				igj_f( 'talk_title', 'Contact card: heading', 'text', 'Prefer to talk?' ),
				igj_f( 'image', 'Photo', 'image', 'joe-laptop' ),
				igj_f( 'ready_title', 'Checklist card: heading', 'text', 'Helpful to have ready' ),
				igj_g( 'ready', 'Checklist', 'Item', array( igj_f( 'text', 'Text', 'text' ) ), igj_cms_rows( 'text', array( 'Who needs coverage and their dates of birth', 'Your ZIP code', 'An estimate of this year’s household income', 'Doctors and prescriptions you want covered', 'Any coverage you have now or are losing, and when' ) ) ),
				igj_g(
					'links',
					'Links under the checklist',
					'Link',
					array(
						igj_f( 'label', 'Link text', 'text' ),
						igj_f( 'url', 'Link', 'url' ),
					),
					array(
						array( 'label' => 'When can I enroll?', 'url' => wp_make_link_relative( igj_learn_url( 'open-enrollment-guide' ) ) ),
						array( 'label' => 'FAQs', 'url' => '/faq/' ),
					)
				),
			),
		),
	);
}

/* FAQ page -------------------------------------------------------------------- */

function igj_cms_schema_faq() {
	$items = array();
	foreach ( (array) ( igj_data( 'faq' )['groups'] ?? array() ) as $g ) {
		foreach ( $g['items'] as $it ) {
			$items[] = array( 'group' => $g['group'], 'q' => $it['q'], 'a' => $it['a'] );
		}
	}
	return array(
		'hero'    => array(
			'title'  => 'Page Hero',
			'fields' => array(
				igj_f( 'title', 'Page title (H1)', 'text', 'Health Insurance FAQs' ),
				igj_f( 'lead', 'Intro paragraph', 'textarea', 'Straight answers to the questions we hear most. Don’t see yours? Just ask.' ),
			),
		),
		'faq'     => array(
			'title'  => 'Questions & Answers',
			'desc'   => 'Questions with the same Category in a row are shown under one heading. Also published as FAQ structured data for search engines.',
			'fields' => array(
				igj_g(
					'items',
					'Questions',
					'Question',
					array(
						igj_f( 'group', 'Category heading', 'text' ),
						igj_f( 'q', 'Question', 'text' ),
						igj_f( 'a', 'Answer (HTML links allowed)', 'textarea' ),
					),
					$items
				),
			),
		),
		'sidebar' => array(
			'title'  => 'Sidebar',
			'fields' => array(
				igj_f( 'title', 'Quote card: heading', 'text', 'Still have questions?' ),
				igj_f( 'text', 'Quote card: text', 'text', 'We’re happy to walk you through it, free.' ),
				igj_f( 'button', 'Quote card: button label', 'text', 'Get a Free Quote' ),
				igj_f( 'nav_title', 'Service links: heading', 'text', 'Coverage by situation' ),
			),
		),
		'cta'     => igj_cms_sec_cta(),
	);
}

/* Site-wide facts: IGJ Site Info options page ----------------------------------- */

function igj_cms_schema_site() {
	$s      = igj_data( 'site' );
	$agents = array();
	foreach ( (array) ( $s['agents'] ?? array() ) as $a ) {
		$agents[] = array(
			'id'             => $a['id'] ?? '',
			'name'           => $a['name'] ?? '',
			'full_name'      => $a['full_name'] ?? '',
			'job_title'      => $a['job_title'] ?? '',
			'npn'            => $a['npn'] ?? '',
			'email'          => $a['email'] ?? '',
			'phone_display'  => $a['phone_display'] ?? '',
			'phone_e164'     => $a['phone_e164'] ?? '',
			'photo'          => $a['photo'] ?? '',
			'resident_state' => $a['resident_state'] ?? '',
			'states'         => array_values( (array) ( $a['states'] ?? array() ) ),
			'marketplace'    => $a['marketplace'] ?? '',
			'carriers_note'  => $a['carriers_note'] ?? '',
		);
	}
	return array(
		'contact'  => array(
			'title'  => 'Business & Contact',
			'fields' => array(
				igj_f( 'name', 'Business name', 'text', $s['name'] ?? '' ),
				igj_f( 'tagline', 'Top bar tagline', 'text', $s['tagline'] ?? '' ),
				igj_f( 'phone_display', 'Phone (as shown)', 'text', $s['phone_display'] ?? '' ),
				igj_f( 'phone_e164', 'Phone (for tap-to-call, e.g. +14046448072)', 'text', $s['phone_e164'] ?? '' ),
				igj_f( 'email', 'Public email', 'text', $s['email'] ?? '' ),
				igj_f( 'location_line', 'Location line', 'text', $s['location_line'] ?? '' ),
				igj_f( 'schedule_cta', 'Schedule button label', 'text', $s['schedule_cta'] ?? '' ),
				igj_f( 'quote_url', 'Online scheduling link (Picktime)', 'url', $s['quote_url'] ?? '' ),
				igj_f( 'quote_url_label', 'Scheduling link label (footer & contact sidebar)', 'text', $s['quote_url_label'] ?? '' ),
				igj_f( 'hours_text', 'Hours (optional)', 'text', $s['hours_text'] ?? '' ),
			),
		),
		'leads'    => array(
			'title'  => 'Quote Form Recipients',
			'fields' => array(
				igj_g( 'lead_recipients', 'Send quote requests to', 'Recipient', array( igj_f( 'email', 'Email', 'text' ) ), igj_cms_rows( 'email', (array) ( $s['lead_recipients'] ?? array() ) ), array( 'flatten' => 'email' ) ),
			),
		),
		'team'     => array(
			'title'  => 'Team Members',
			'desc'   => 'Used on Home (05), About (03), Contact, the footer and in search-engine schema.',
			'fields' => array(
				igj_g(
					'agents',
					'Team members',
					'Team member',
					array(
						igj_f( 'id', 'Anchor ID (e.g. joe)', 'text' ),
						igj_f( 'name', 'Name', 'text' ),
						igj_f( 'full_name', 'Full legal name', 'text' ),
						igj_f( 'job_title', 'Job title', 'text' ),
						igj_f( 'npn', 'National Producer Number (NPN)', 'text' ),
						igj_f( 'email', 'Email', 'text' ),
						igj_f( 'phone_display', 'Direct phone (optional)', 'text' ),
						igj_f( 'phone_e164', 'Direct phone for tap-to-call (optional)', 'text' ),
						igj_f( 'photo', 'Headshot', 'image' ),
						igj_f( 'resident_state', 'Resident state', 'text' ),
						igj_f( 'states', 'Licensed states (one per line)', 'list' ),
						igj_f( 'marketplace', 'Marketplace certifications (internal note)', 'text' ),
						igj_f( 'carriers_note', 'Carrier appointments (internal note)', 'text' ),
					),
					$agents
				),
			),
		),
		'states'   => array(
			'title'  => 'States We Serve',
			'fields' => array(
				igj_f( 'states_headline', 'Headline', 'text', $s['states_headline'] ?? '' ),
				igj_f( 'home_state', 'Home state (highlighted)', 'text', 'Georgia' ),
				igj_g( 'service_area', 'States', 'State', array( igj_f( 'state', 'State', 'text' ) ), igj_cms_rows( 'state', (array) ( $s['service_area'] ?? array() ) ), array( 'flatten' => 'state' ) ),
			),
		),
		'carriers' => array(
			'title'  => 'Carriers & Private Programs',
			'fields' => array(
				igj_g( 'carriers', 'Marketplace carriers', 'Carrier', array( igj_f( 'name', 'Carrier', 'text' ) ), igj_cms_rows( 'name', (array) ( $s['carriers'] ?? array() ) ), array( 'flatten' => 'name' ) ),
				igj_g( 'private_programs', 'Private programs', 'Program', array( igj_f( 'name', 'Program', 'text' ) ), igj_cms_rows( 'name', (array) ( $s['private_programs'] ?? array() ) ), array( 'flatten' => 'name' ) ),
			),
		),
		'disclose' => array(
			'title'  => 'Compensation Disclosure',
			'fields' => array(
				igj_f( 'compensation_text', 'Disclosure (Free Services band and footer)', 'textarea', $s['compensation_text'] ?? '' ),
			),
		),
		'reviews'  => array(
			'title'  => 'Testimonials',
			'desc'   => 'Only add real client reviews you have permission to publish.',
			'fields' => array(
				igj_g(
					'testimonials',
					'Testimonials',
					'Testimonial',
					array(
						igj_f( 'quote', 'Quote', 'textarea' ),
						igj_f( 'name', 'Client name / initials', 'text' ),
					),
					array_values( array_map( function ( $t ) {
						return array( 'quote' => $t['quote'] ?? '', 'name' => $t['name'] ?? '' );
					}, (array) ( $s['testimonials'] ?? array() ) ) )
				),
			),
		),
	);
}
