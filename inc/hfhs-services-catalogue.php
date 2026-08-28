<?php
/**
 * Hart Family of Home Services — shared Services Catalogue + helpers.
 *
 * Mirrors the valorcare_theme approach: one canonical place that holds every
 * service's DEFAULT (design) content. The reusable Service Detail Page template
 * (tpl_service_single.php) matches the current page to its entry here by slug and
 * uses these values as defaults; per-page CMB2 fields override them when filled.
 *
 * Content transcribed from the per-service design mockups in
 * /home/jim/Downloads/HFHS/services/.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The full catalogue: shared section labels + one entry per service (by slug).
 *
 * @return array
 */
function hfhs_services_catalogue() {
	static $c = null;
	if ( null !== $c ) {
		return $c;
	}

	$img = 'https://hfhsgeorgia.com/wp-content/uploads/';
	$svc = trailingslashit( get_stylesheet_directory_uri() ) . 'images/services/';

	// Generic process fallback (rarely used — each service defines its own).
	$c = array(
		'shared' => array(
			'overview_eyebrow' => 'What We Do',
			'scope_heading'    => 'Scope',
			'principle_script' => 'Plainly put.',
			'process_eyebrow'  => 'Our Process',
			'process_script'   => 'How we work.',
			'process_title'    => 'Four steps. <em>No surprises.</em>',
			'recent_eyebrow'   => 'Recent Work',
			'recent_script'    => 'From the field.',
			'pricing_eyebrow'  => 'Pricing',
			'warranty_eyebrow' => 'Warranty',
			'related_eyebrow'  => 'Related Services',
			'related_script'   => 'Keep exploring.',
			'related_title'    => 'Other ways we <em>protect your home.</em>',
			'testi_script'     => 'From a client.',
			'cta_script'       => 'Ready to get started?',
		),
		'catalogue' => array(

			'gutters' => array(
				'gallery' => array(
					array( 'image' => $svc . 'gutters/gutters-full-cleaning-and-hanger-replacement.webp', 'caption' => 'Full cleaning & hanger replacement', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'gutters/gutters-seasonal-cleaning.webp', 'caption' => 'Seasonal cleaning', 'meta' => 'HOA · Vinings Forest' ),
					array( 'image' => $svc . 'gutters/gutters-downspout-and-elbow-repair.webp', 'caption' => 'Downspout & elbow repair', 'meta' => 'Residential · Suwanee' ),
					array( 'image' => $svc . 'gutters/gutters-downspout-extension.webp', 'caption' => 'Downspout extension', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'gutters/gutters-full-system-cleaning.webp', 'caption' => 'Full system cleaning', 'meta' => 'Property Management · Atlanta' ),
					array( 'image' => $svc . 'gutters/gutters-corner-seam-repair.webp', 'caption' => 'Corner seam repair', 'meta' => 'Residential · Greater Atlanta' ),
				),
				'number'         => '01',
				'title'          => 'Gutters',
				'script'         => 'Where protection begins.',
				'lead'           => 'Your gutters are your home’s first line of defense against water damage. From seasonal cleaning to full replacement, the Hart Family team handles every aspect of gutter care with the precision and integrity your home deserves.',
				'img'            => $img . '2024/12/gutters-small.webp',
				'overview_title' => 'Every aspect of gutter care — <em>cleaned, repaired, or replaced.</em>',
				'overview_body'  => '<p>When gutters fail, water fails with them. Overflow damages your fascia, your foundation, and your landscape. Clogs freeze and split seams. A small gap in a downspout sends runoff straight to your siding. We handle all of it — from a one-time seasonal cleaning to a full replacement run over several hundred feet of home.</p><p>Our approach is the same on every job: inspect honestly, document thoroughly, and leave your property cleaner than we found it.</p>',
				'scope'          => array( 'Seasonal gutter cleaning', 'Clog removal and flushing', 'Seam and joint repair', 'Downspout repair & extension', 'Hanger and bracket replacement', 'Full gutter replacement', 'Custom gutter installation', 'Gutter guards & leaf protection', 'Post-work photo documentation' ),
				'principle'      => 'Water does not wait.',
				'process'        => array(
					array( 'title' => 'Inspection', 'text' => 'We walk the entire gutter system, document condition with photos, and flag anything we see — from failing hangers to rotted fascia underneath.' ),
					array( 'title' => 'Estimate', 'text' => 'Written, itemized estimate within 24 hours. You know exactly what the work is, what the materials cost, and what the timeline looks like before we lift a tool.' ),
					array( 'title' => 'The Work', 'text' => 'Scheduled at your convenience. Jobsite is kept clean. We communicate progress via text if you’re not home, and we stay on-site until the work is done right.' ),
					array( 'title' => 'Photo Record', 'text' => 'Before/during/after photos delivered after every job. You know what was done, why, and what the finished system looks like — whether you were on-site or not.' ),
				),
				'pricing_line'   => 'Most gutter jobs start at $125.',
				'pricing_body'   => 'Final pricing depends on the length of the run, the height and accessibility of the work, and the materials involved. Every estimate is written, itemized, and delivered within 24 hours of our inspection. No change-order games.',
				'warranty_line'  => '2–5 year workmanship warranty, standard.',
				'warranty_body'  => 'Select premium products carry lifetime warranties. If something is not right — seam leak, loose hanger, downspout issue — we come back and make it right. Every client receives their warranty terms in writing at job completion.',
				'related'        => array( 'roofing', 'exterior-repairs', 'tree-services', 'handyman' ),
				'testi_eyebrow'  => 'Gutter Services',
				'testi_quote'    => 'I had HFHS repair the awning on my house and clean my gutters and spouts out. Outstanding professional service. They are upfront, honest and on time. I would recommend them to anyone. Thank you!',
				'testi_name'     => 'Magnus Sorensen',
			),

			'fencing' => array(
				'gallery' => array(
					array( 'image' => $svc . 'fencing/fencing-new-privacy-fence-line.webp', 'caption' => 'New privacy fence line', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'fencing/fencing-full-property-line-fence.webp', 'caption' => 'Full property-line fence', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'fencing/fencing-post-replacement-and-repair.webp', 'caption' => 'Post replacement & repair', 'meta' => 'Residential · Suwanee' ),
					array( 'image' => $svc . 'fencing/fencing-crew-at-work.webp', 'caption' => 'Crew at work', 'meta' => 'HOA · Vinings Forest' ),
					array( 'image' => $svc . 'fencing/fencing-700-foot-property-run.webp', 'caption' => '700-foot property run', 'meta' => 'Residential · North Atlanta' ),
					array( 'image' => $svc . 'fencing/fencing-rotten-section-replacement.webp', 'caption' => 'Rotten section replacement', 'meta' => 'Residential · Atlanta' ),
				),
				'number'         => '02',
				'title'          => 'Fencing',
				'script'         => 'Where your property begins.',
				'lead'           => 'A good fence marks your property, protects what matters, and adds curb appeal. From standard privacy fencing to custom property-line installations stretching hundreds of feet, the Hart Family team builds and repairs fences across the Greater Atlanta area.',
				'img'            => $img . '2024/12/fencing-header.webp',
				'overview_title' => 'Every kind of fence — <em>built, repaired, or replaced.</em>',
				'overview_body'  => '<p>A fence does three jobs: it marks your property, it protects what’s inside, and it adds to the look of your home. When any of those fail, the whole fence feels the weight of it. A leaning post means a compromised line. A rotting board means an open invitation to pests. A broken gate means you stop using it altogether.</p><p>We’ve installed runs of over 700 feet — no job is too long, and no repair is too small. Our approach is the same on every project: inspect honestly, document thoroughly, and leave your property cleaner than we found it.</p>',
				'scope'          => array( 'Wood privacy fencing', 'Picket & split-rail fencing', 'Chain link installation', 'Custom gates & hardware', 'Property-line installations', 'Post replacement & straightening', 'Board and section repair', 'Staining, sealing & weatherproofing', 'Full fence replacement' ),
				'principle'      => 'A good fence holds the line.',
				'process'        => array(
					array( 'title' => 'Inspection', 'text' => 'We walk the full fence line, check every post and board, and flag anything we see — leaning sections, rot, failed hardware, or uneven ground that affects the build.' ),
					array( 'title' => 'Estimate', 'text' => 'Written, itemized estimate within 24 hours. Materials, linear footage, gate count, and timeline are all spelled out clearly so you know exactly what you’re approving.' ),
					array( 'title' => 'The Build', 'text' => 'Posts are set straight, boards are aligned, and the line holds plumb. Jobsite stays clean throughout. If we’re on your property, we treat it like our own.' ),
					array( 'title' => 'Photo Record', 'text' => 'Before, during, and finished photos delivered after every fencing project — so you have a complete visual record of what was done, whether you were on-site or not.' ),
				),
				'pricing_line'   => 'Written, itemized estimates — every time.',
				'pricing_body'   => 'Every fencing estimate is written up in detail: materials, linear footage, gate count, labor, and timeline all spelled out clearly. You know exactly what you’re approving before we lift a tool. No surprises, no change-order games, no pressure to commit on the spot.',
				'warranty_line'  => '2–5 year workmanship warranty, standard.',
				'warranty_body'  => 'If a post pulls, a board warps beyond expected tolerance, or a gate sags — we come back and make it right. Every client receives their warranty terms in writing at job completion.',
				'related'        => array( 'gutters', 'decking', 'tree-services', 'custom-projects' ),
				'testi_eyebrow'  => 'Fencing Services',
				'testi_quote'    => '',
				'testi_name'     => '',
			),

			'exterior-repairs' => array(
				'gallery' => array(
					array( 'image' => $svc . 'exterior-repairs/exterior-repairs-chimney-siding-repair.webp', 'caption' => 'Chimney siding repair', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'exterior-repairs/exterior-repairs-soffit-and-fascia-replacement.webp', 'caption' => 'Soffit & fascia replacement', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'exterior-repairs/exterior-repairs-siding-repaint.webp', 'caption' => 'Siding repaint', 'meta' => 'Residential · Suwanee' ),
					array( 'image' => $svc . 'exterior-repairs/exterior-repairs-door-frame-rebuild.webp', 'caption' => 'Door frame rebuild', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'exterior-repairs/exterior-repairs-roof-rot-repair.webp', 'caption' => 'Roof rot repair', 'meta' => 'Residential · North Atlanta' ),
					array( 'image' => $svc . 'exterior-repairs/exterior-repairs-rodent-damage-repair.webp', 'caption' => 'Rodent damage repair', 'meta' => 'HOA · Vinings Forest' ),
				),
				'number'         => '03',
				'title'          => 'Exterior Repairs',
				'script'         => 'Against the seasons.',
				'lead'           => 'Your home’s exterior takes a beating — sun, storms, humidity, pests. When something needs fixing, repairing, or replacing on the outside of your home, the Hart Family team handles it with the care, honesty, and documentation we bring to every project.',
				'img'            => $img . '2024/12/sofit-siding-header.webp',
				'overview_title' => 'Every part of the outside of your home — <em>repaired, restored, or replaced.</em>',
				'overview_body'  => '<p>Your exterior is where the weather does its work. Sun bleaches paint. Rain finds every gap. Wind lifts loose flashing. Pests find their way in through rotted soffit or pulled-away siding. Left alone, small issues turn into structural problems — and structural problems turn into expensive ones.</p><p>We handle everything from small repairs to full replacements and complete rebuilds — siding, soffit, fascia, chimney, trim, paint, full window and door replacement, dormer rebuilds, rot removal, and pest damage. Some jobs need a careful patch. Others need to be rebuilt from the sheathing up. Our approach is the same on both: inspect honestly, document thoroughly, and leave the job better than we found it.</p>',
				'scope'          => array( 'Siding repair & full replacement', 'Soffit & fascia repair', 'Chimney repair & painting', 'Full window & door replacement', 'Door & window frame repair', 'Full dormer & feature rebuilds', 'Trim & molding replacement', 'Paint, stain & finish work', 'Pressure washing', 'Flashing & caulking repair', 'Rot removal & rebuild', 'Pest & rodent damage repair' ),
				'principle'      => 'Catch it early. Fix it right.',
				'process'        => array(
					array( 'title' => 'Inspection', 'text' => 'We walk the full exterior of your home and note everything we see — rot, failed caulking, flashing issues, pest damage, worn paint, or anything else that needs attention.' ),
					array( 'title' => 'Estimate', 'text' => 'Written, itemized estimate within 24 hours. Scope of work, materials, and timeline are all spelled out clearly so you know exactly what you’re approving.' ),
					array( 'title' => 'The Repair', 'text' => 'Rotten material is cut back to solid wood. Replacement is matched to the original. Paint and finish blend in so the repair disappears. Jobsite stays clean throughout.' ),
					array( 'title' => 'Photo Record', 'text' => 'Before, during, and finished photos delivered after every repair — a complete visual record of what was damaged, what we did, and how it looks now.' ),
				),
				'pricing_line'   => 'Written, itemized estimates — every time.',
				'pricing_body'   => 'Every exterior estimate is written up in detail: scope of work, materials, labor, and timeline all spelled out clearly. If we discover additional damage once we open things up, you get a written change-order before we proceed. No surprises, no pressure, no commitment on the spot.',
				'warranty_line'  => '2–5 year workmanship warranty, standard.',
				'warranty_body'  => 'If a repair fails under normal conditions — paint lifts, caulking cracks, flashing leaks — we come back and make it right. Every client receives their warranty terms in writing at job completion.',
				'related'        => array( 'gutters', 'fencing', 'roofing', 'handyman' ),
				'testi_eyebrow'  => 'Exterior Repairs',
				'testi_quote'    => '',
				'testi_name'     => '',
			),

			'roofing' => array(
				'gallery' => array(
					array( 'image' => $svc . 'roofing/roofing-pipe-stack-and-shingle-replacement.webp', 'caption' => 'Pipe stack & shingle replacement', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'roofing/roofing-shingle-replacement.webp', 'caption' => 'Shingle replacement', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'roofing/roofing-pipe-boot-repair.webp', 'caption' => 'Pipe boot repair', 'meta' => 'Residential · Suwanee' ),
					array( 'image' => $svc . 'roofing/roofing-storm-damage-assessment.webp', 'caption' => 'Storm damage assessment', 'meta' => 'Residential · North Atlanta' ),
					array( 'image' => $svc . 'roofing/roofing-rotten-decking-rebuild.webp', 'caption' => 'Rotten decking rebuild', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'roofing/roofing-leak-diagnosis-and-repair.webp', 'caption' => 'Leak diagnosis & repair', 'meta' => 'HOA · Vinings Forest' ),
				),
				'number'         => '04',
				'title'          => 'Roofing',
				'script'         => 'What’s above matters most.',
				'lead'           => 'Your roof protects everything underneath it. Whether you need a small patch, a leak diagnosed, a pipe stack repaired, or a full inspection before storm season, the Hart Family team approaches roofing with safety, transparency, and the long-term health of your home in mind.',
				'img'            => $img . '2024/12/roofing-header.webp',
				'overview_title' => 'The full scope of roofing — <em>inspected, repaired, or replaced.</em>',
				'overview_body'  => '<p>Your roof is the single most important barrier between your home and the weather. When it works, everything underneath stays dry. When it fails — even in a small, unnoticed way — water finds its path, insulation rots, ceilings stain, and structural wood starts to go. Small leaks become big problems quickly.</p><p>We handle shingle repair, leak diagnosis, storm damage assessment, pipe stack repair, flashing replacement, rotten decking rebuilds, and full inspections for homeowners planning ahead. If the right answer is a small patch, we say so. If the right answer is full replacement, we give you a written breakdown so you can plan. Safety and honesty on every project.</p>',
				'scope'          => array( 'Roof inspection & assessment', 'Shingle repair & replacement', 'Leak diagnosis & repair', 'Storm damage assessment', 'Pipe stack repair & replacement', 'Flashing repair & replacement', 'Chimney flashing', 'Rotten decking & sheathing replacement', 'Roof vent repair', 'Full replacement planning', 'Storm-season preventive inspection', 'Photo documentation of every repair' ),
				'principle'      => 'Everything below depends on it.',
				'process'        => array(
					array( 'title' => 'Inspection', 'text' => 'We walk the full roof safely, check every penetration, valley, and flashing line, and photograph anything that needs attention — damaged shingles, failed pipe boots, flashing gaps, or rotten decking.' ),
					array( 'title' => 'Estimate', 'text' => 'Written, itemized estimate within 24 hours. Repair scope, materials, and timeline are spelled out clearly. If we’re recommending full replacement, you get the evidence and the reasoning in writing.' ),
					array( 'title' => 'The Repair', 'text' => 'Shingles are matched and installed to manufacturer spec. Flashing is sealed properly. Decking is replaced where needed. Safety is non-negotiable — for our crew and for your home.' ),
					array( 'title' => 'Photo Record', 'text' => 'Before, during, and finished photos delivered after every roofing job — so you can see exactly what was damaged, what we did, and what the roof looks like now.' ),
				),
				'pricing_line'   => 'Written, itemized estimates — every time.',
				'pricing_body'   => 'Every roofing estimate is written up in detail: repair scope, materials, and timeline all spelled out clearly. If we open up a roof and find additional damage underneath, you get a written change-order before we proceed. No surprises, no pressure, no commitment on the spot.',
				'warranty_line'  => '2–5 year workmanship warranty, standard.',
				'warranty_body'  => 'If a repair fails under normal conditions — shingles lift, a seal leaks, a pipe boot splits — we come back and make it right. Every client receives their warranty terms in writing at job completion.',
				'related'        => array( 'gutters', 'exterior-repairs', 'tree-services', 'handyman' ),
				'testi_eyebrow'  => 'Roofing Services',
				'testi_quote'    => '',
				'testi_name'     => '',
			),

			'tree-services' => array(
				'gallery' => array(
					array( 'image' => $svc . 'tree-services/tree-services-dead-tree-removal.webp', 'caption' => 'Dead tree removal', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'tree-services/tree-services-limb-removal.webp', 'caption' => 'Limb removal', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'tree-services/tree-services-full-takedown.webp', 'caption' => 'Full takedown', 'meta' => 'Residential · Suwanee' ),
					array( 'image' => $svc . 'tree-services/tree-services-hazard-tree-assessment.webp', 'caption' => 'Hazard tree assessment', 'meta' => 'HOA · Vinings Forest' ),
					array( 'image' => $svc . 'tree-services/tree-services-storm-response.webp', 'caption' => 'Storm response', 'meta' => 'Residential · North Atlanta' ),
					array( 'image' => $svc . 'tree-services/tree-services-full-cleanup-and-haul.webp', 'caption' => 'Full cleanup & haul', 'meta' => 'Residential · Atlanta' ),
				),
				'number'         => '05',
				'title'          => 'Tree Services',
				'script'         => 'Between your roof and the sky.',
				'lead'           => 'Atlanta’s tree canopy is beautiful — until a limb threatens your roof or a dead tree threatens your safety. We handle tree work with the same care we give your home: respect for the property, safety for the crew, and cleanup that leaves the landscape looking intentional.',
				'img'            => $img . '2024/12/Finished-Dead-Tree-Removal.webp',
				'overview_title' => 'Tree work that <em>respects your home and the landscape.</em>',
				'overview_body'  => '<p>Trees are part of what makes Atlanta feel like Atlanta — but they don’t always cooperate with the house they’re next to. A dead tree is a slow emergency. A storm-weakened limb doesn’t ask permission before it falls. An overgrown canopy dumps debris into your gutters every season and rubs against your siding in every wind.</p><p>We handle everything from hazard-tree assessment and dead-tree removal to careful limb trimming, storm response, stump grinding, and full property cleanup. Every cut is planned. Every limb comes down where we intend it to. And we haul away every piece so your yard looks intentional when we leave — not like a worksite.</p>',
				'scope'          => array( 'Hazard tree assessment', 'Dead tree removal', 'Full tree takedown', 'Limb & branch trimming', 'Crown thinning & pruning', 'Storm damage cleanup', 'Emergency response', 'Stump grinding', 'Dead bush & shrub removal', 'Debris hauling & disposal', 'Property-safe removal planning', 'Post-work site cleanup' ),
				'principle'      => 'A dead tree is a warning.',
				'process'        => array(
					array( 'title' => 'Assessment', 'text' => 'We walk the property, identify every tree or limb that poses a risk, and photograph what we see — including root issues, canopy rot, and any conflict between the tree and your home.' ),
					array( 'title' => 'Estimate', 'text' => 'Written, itemized estimate within 24 hours. Scope of removal, disposal, and cleanup is spelled out clearly so you know exactly what you’re approving before any saws come on-site.' ),
					array( 'title' => 'The Work', 'text' => 'Every cut is planned. Limbs come down where we intend them to — away from roofs, fences, and landscaping. Full PPE, ground coordination, and careful sequencing on every job.' ),
					array( 'title' => 'Haul & Record', 'text' => 'We haul away every piece — logs, limbs, debris — and grind stumps below grade when requested. Before, during, and finished photos follow every job.' ),
				),
				'pricing_line'   => 'Written, itemized estimates — every time.',
				'pricing_body'   => 'Every tree estimate is written up in detail: scope of removal, disposal, cleanup, and any optional stump grinding are spelled out clearly. If a storm creates an emergency on short notice, we’ll give you a verbal estimate and document it in writing before we leave. No surprises, no pressure.',
				'warranty_line'  => '2–5 year workmanship warranty, standard.',
				'warranty_body'  => 'If a stump regrows where it should have been ground flush, or cleanup was incomplete, we come back and make it right. Every client receives their service terms in writing at job completion.',
				'related'        => array( 'gutters', 'exterior-repairs', 'roofing', 'handyman' ),
				'testi_eyebrow'  => 'Tree Services',
				'testi_quote'    => '',
				'testi_name'     => '',
			),

			'decking' => array(
				'gallery' => array(
					array( 'image' => $svc . 'decking/decking-new-deck-build.webp', 'caption' => 'New deck build', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'decking/decking-custom-deck-details.webp', 'caption' => 'Custom deck details', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'decking/decking-full-decking-project.webp', 'caption' => 'Full decking project', 'meta' => 'Residential · Suwanee' ),
					array( 'image' => $svc . 'decking/decking-pergola-installation.jpg', 'caption' => 'Pergola installation', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'decking/decking-deck-bannisters-and-railing.jpg', 'caption' => 'Deck bannisters & railing', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'decking/decking-rotten-board-replacement.jpg', 'caption' => 'Rotten board replacement', 'meta' => 'Residential · North Atlanta' ),
				),
				'number'         => '06',
				'title'          => 'Decking',
				'script'         => 'Where the house meets the yard.',
				'lead'           => 'A well-built deck extends your living space into the outdoors. Whether you’re planning a brand-new build, reviving a weathered deck with refinishing, or replacing worn boards and failing railings, the Hart Family team approaches every decking project with the same care we bring to the rest of your home.',
				'img'            => $img . '2025/03/decking-services.webp',
				'overview_title' => 'New builds, repairs, and <em>full second-life refinishing.</em>',
				'overview_body'  => '<p>A deck is where your house ends and your yard begins — the outdoor room you actually use. Built right, it holds its line for decades. Built carelessly, it starts to tell on itself fast: cupped boards, loose balusters, a soft spot near the step. Atlanta’s heat and humidity don’t forgive shortcuts.</p><p>We build new decks from the footings up, repair existing ones board-by-board, and bring worn decks back to life with refinishing, sanding, and staining. We also build pergolas, custom outdoor structures, and the connecting features that make a deck feel like part of the home — not an afterthought attached to it.</p>',
				'scope'          => array( 'New deck construction', 'Full deck replacement', 'Board replacement & repair', 'Railing installation & repair', 'Step & stair construction', 'Refinishing, sanding & staining', 'Weather sealing & protection', 'Pergola construction', 'Custom outdoor structures', 'Structural inspection', 'Footing & post repair', 'Photo documentation of every build' ),
				'principle'      => 'A good deck is a second living room.',
				'process'        => array(
					array( 'title' => 'Inspection', 'text' => 'We walk the existing deck (or the space for a new build), check structure, footings, fasteners, and boards, and photograph everything that needs attention or informs the design.' ),
					array( 'title' => 'Estimate', 'text' => 'Written, itemized estimate within 24 hours. Material choice, linear footage, rail count, stain options, and timeline are all spelled out clearly so you know what you’re approving.' ),
					array( 'title' => 'The Build', 'text' => 'Footings set properly. Boards aligned and fastened to last. Railings plumb and sturdy. Finishes applied in the right conditions. Jobsite stays clean throughout.' ),
					array( 'title' => 'Photo Record', 'text' => 'Before, during, and finished photos delivered after every decking project — so you have a complete visual record of the build and the materials underneath it.' ),
				),
				'pricing_line'   => 'Written, itemized estimates — every time.',
				'pricing_body'   => 'Every decking estimate is written up in detail: material choice, linear footage, railing count, stain and finish options, and timeline are all spelled out. If we open a deck up and find rotten structural wood underneath, you get a written change-order before we proceed. No surprises.',
				'warranty_line'  => '2–5 year workmanship warranty, standard.',
				'warranty_body'  => 'If a board lifts, a rail loosens, or a finish fails beyond expected wear — we come back and make it right. Every client receives their warranty terms in writing at job completion.',
				'related'        => array( 'fencing', 'exterior-repairs', 'custom-projects', 'handyman' ),
				'testi_eyebrow'  => 'Decking Services',
				'testi_quote'    => '',
				'testi_name'     => '',
			),

			'handyman' => array(
				'gallery' => array(
					array( 'image' => $svc . 'handyman/handyman-cracked-brick-assessment.jpg', 'caption' => 'Cracked brick assessment', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'handyman/handyman-trim-repair.jpg', 'caption' => 'Trim repair', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'handyman/handyman-mailbox-rebuild.jpg', 'caption' => 'Mailbox rebuild', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'handyman/handyman-paint-touch-ups.webp', 'caption' => 'Paint touch-ups', 'meta' => 'Residential · Suwanee' ),
					array( 'image' => $svc . 'handyman/handyman-door-frame-tune-up.webp', 'caption' => 'Door frame tune-up', 'meta' => 'Residential · North Atlanta' ),
					array( 'image' => $svc . 'handyman/handyman-general-repair-work.webp', 'caption' => 'General repair work', 'meta' => 'Residential · Atlanta' ),
					array( 'image' => $svc . 'handyman/handyman-sliding-door-replacement.jpg', 'caption' => 'Sliding door replacement', 'meta' => 'Residential · Greater Atlanta' ),
				),
				'number'         => '07',
				'title'          => 'Handyman Services',
				'script'         => 'The list you keep meaning to get to.',
				'lead'           => 'Some projects don’t fit neatly into one category — they’re just things around the house that need to get done. That’s where our handyman services come in. One call, one crew, and a list you’ve been looking at for months finally gets crossed off.',
				'img'            => $img . '2024/12/home-repair-small.webp',
				'overview_title' => 'The punch list, <em>handled.</em>',
				'overview_body'  => '<p>Every home has a running list: the squeaky door, the shelf that never got hung, the caulking around the tub that needs redoing, the TV that should be on the wall by now, the light switch that sometimes works. Individually, each one isn’t worth a contractor call. Together, they add up to a home that doesn’t quite feel finished.</p><p>That’s where our handyman service comes in. One visit, one crew, and everything on the list gets crossed off. We bring the tools, the ladders, and the parts. You give us the list. We work through it efficiently, document each item with a photo, and leave you with a home that feels cared for again.</p>',
				'scope'          => array( 'TV & art mounting', 'Shelving & cabinet installation', 'Door & window adjustments', 'Light fixture & ceiling fan install', 'Drywall patching & texture', 'Caulking & weatherstripping', 'Small trim repair', 'Furniture assembly', 'Minor plumbing fixes', 'Small paint touch-ups', 'Hardware replacement', 'One-call punch-list work' ),
				'principle'      => 'No job too small. None too odd.',
				'process'        => array(
					array( 'title' => 'The List', 'text' => 'Send us your list — by text, email, or a walk-through in person. Every item, big or small, odd or urgent. We photograph anything we need reference for and ask questions where it helps.' ),
					array( 'title' => 'Estimate', 'text' => 'Written, itemized estimate within 24 hours. Each line item priced separately so you can approve the whole list or just the pieces you want done first. No minimum number of items required.' ),
					array( 'title' => 'The Work', 'text' => 'One scheduled visit, one crew, one efficient run through everything. We bring tools, parts, and ladders. You don’t need to prep the house — just point at the list.' ),
					array( 'title' => 'Photo Record', 'text' => 'Every item on the list gets a finished photo. You get the complete record, the list crossed off, and a home that finally feels done.' ),
				),
				'pricing_line'   => 'Written, itemized estimates — every time.',
				'pricing_body'   => 'Every handyman estimate is itemized line-by-line: each task, each material cost, each labor estimate spelled out separately. Approve the full list or just part of it — your call. If something on-site turns out bigger than expected, you get a written update before we proceed.',
				'warranty_line'  => '2–5 year workmanship warranty, standard.',
				'warranty_body'  => 'If a fix fails under normal conditions — a shelf pulls, a mount loosens, caulking fails before its time — we come back and make it right. Every client receives their service terms in writing at job completion.',
				'related'        => array( 'exterior-repairs', 'interior-repairs', 'custom-projects', 'gutters' ),
				'testi_eyebrow'  => 'Handyman Services',
				'testi_quote'    => '',
				'testi_name'     => '',
			),

			'interior-repairs' => array(
				'gallery' => array(
					array( 'image' => $svc . 'interior-repairs/interior-repairs-bathroom-refresh-flooring-vanity-and-trim.jpg', 'caption' => 'Bathroom refresh — flooring, vanity & trim', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'interior-repairs/interior-repairs-kitchen-refresh-paint-counters-and-lighting.jpg', 'caption' => 'Kitchen refresh — paint, counters & lighting', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'interior-repairs/interior-repairs-sink-and-faucet-install.jpg', 'caption' => 'Sink & faucet install', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'interior-repairs/interior-repairs-bathroom-rebuild-vanity-and-subfloor.jpg', 'caption' => 'Bathroom rebuild — vanity & subfloor', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'interior-repairs/interior-repairs-floor-joist-and-subfloor-restoration.jpg', 'caption' => 'Floor joist & subfloor restoration', 'meta' => 'Residential · Greater Atlanta' ),
				),
				'number'         => '08',
				'title'          => 'Interior Repairs',
				'script'         => 'Where your home comes home.',
				'lead'           => 'The inside of your home carries the weight of daily life — scuffed trim, hairline cracks in drywall, a settled door that no longer latches, a wall begging for fresh paint. From a single fix to a full kitchen or bathroom renovation, we handle interior work with the same careful hands we bring to every HFHS job.',
				'img'            => $img . '2024/12/sofit-repairs.webp',
				'overview_title' => 'Every wall, every room — <em>made right again.</em>',
				'overview_body'  => '<p>Interior repairs are where a house starts to feel like your home again. A crisp corner of trim. A patched wall where a stud finder once strayed. A freshly painted ceiling. A kitchen reworked from the subfloor up. Whether it’s a single fix, a new floor, or a full kitchen or bathroom renovation, we handle it cleanly so your rooms read finished.</p><p>We work indoors the way we work outdoors: dropcloths down, surfaces protected, dust contained, and every fix photographed when it’s done. Whether it’s a single hallway or every room in the house, you get the same careful hands and the same itemized, honest estimate.</p>',
				'scope'          => array( 'Full kitchen renovations', 'Full bathroom renovations', 'Flooring installation — hardwood, LVP & tile', 'Subfloor repair & replacement', 'Cabinetry install & refresh', 'Countertop install & fixture fitting', 'Interior painting — walls, trim & ceilings', 'Accent walls & color consultation', 'Drywall repair — cracks, holes, water damage', 'Drywall installation', 'Trim & baseboard installation', 'Crown molding & chair rail', 'Interior door install & adjustment', 'Caulking & finish carpentry', 'Wall texture matching & blending', 'Tile repair & small tile install' ),
				'principle'      => 'A careful hand on the inside of your home.',
				'process'        => array(
					array( 'title' => 'Walk-Through', 'text' => 'We walk the rooms together or take notes from your photos — every patch, every crack, every baseboard, every wall that needs a fresh coat. No item too small to mention.' ),
					array( 'title' => 'Estimate', 'text' => 'Written, itemized estimate within 24 hours — paint, drywall, trim, caulking, labor, all separated out. Approve the full list or the pieces you want first. Materials disclosed before we start.' ),
					array( 'title' => 'Careful Work', 'text' => 'Floors covered, furniture moved or masked, dust contained. We work room-by-room on a schedule that fits your week, text you updates if you’re not home, and leave each space cleaner than we found it.' ),
					array( 'title' => 'Photo Record', 'text' => 'Before, during, and after photos of every fix — delivered in writing along with your warranty. You know exactly what was done, where, and what the finished work looks like.' ),
				),
				'pricing_line'   => 'Written, itemized estimates — every time.',
				'pricing_body'   => 'Every interior estimate is itemized line-by-line: paint, drywall, trim, caulking, materials, and labor spelled out separately. Approve the full scope or just the rooms you want done first. Paint colors, sheens, and products are written into the estimate so there’s no guesswork later.',
				'warranty_line'  => '2–5 year workmanship warranty, standard.',
				'warranty_body'  => 'If a patch cracks, a seam splits, or trim pulls under normal conditions, we come back and make it right. Premium paints and finishes carry their own manufacturer warranties, which we hand off to you in writing at job completion.',
				'related'        => array( 'handyman', 'exterior-repairs', 'custom-projects', 'decking' ),
				'testi_eyebrow'  => 'Interior Repairs',
				'testi_quote'    => '',
				'testi_name'     => '',
			),

			'custom-projects' => array(
				'gallery' => array(
					array( 'image' => $svc . 'custom-projects/custom-projects-custom-pergola-framed-on-site.jpg', 'caption' => 'Custom pergola — framed on-site', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'custom-projects/custom-projects-wood-burning-sauna.jpg', 'caption' => 'Wood-burning sauna', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'custom-projects/custom-projects-backyard-climbing-wall.jpg', 'caption' => 'Backyard climbing wall', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'custom-projects/custom-projects-custom-chicken-coop.jpg', 'caption' => 'Custom chicken coop', 'meta' => 'Residential · Greater Atlanta' ),
					array( 'image' => $svc . 'custom-projects/custom-projects-custom-speaker-enclosure.jpg', 'caption' => 'Custom speaker enclosure', 'meta' => 'Commercial · Atlanta' ),
				),
				'number'         => '09',
				'title'          => 'Custom Projects',
				'script'         => 'Built from scratch, built to last.',
				'lead'           => 'Some projects don’t fit into a standard category — a custom pergola build over your patio, a chicken coop perfect for your backyard friends, a climbing wall for the kids, a custom gate at the driveway, a wood-burning sauna. If you can dream it, the HFHS team can build it.',
				'img'            => $img . '2025/03/Dry-sauna-3.webp',
				'overview_title' => 'If you can picture it, <em>we can build it.</em>',
				'overview_body'  => '<p>Custom Projects are the one-off, one-of-a-kind builds that don’t fit neatly into any other service. A backyard sauna. A cedar chicken coop. A garage climbing wall. A pergola stretched across the patio. A gate that makes the driveway feel like an entrance. If you’ve got a picture in your head, a rough sketch on a napkin, or a reference you saved on your phone — bring it to us.</p><p>Josh built his own sauna, coop, and climbing wall in his backyard before HFHS existed. That custom-build habit is baked into the company from the top down. Every project starts with a conversation about what you want, becomes a written design and estimate, and ends with something your family will actually use for years.</p>',
				'scope'          => array( 'Outdoor saunas & sweat rooms', 'Chicken coops & backyard animal structures', 'Climbing walls & backyard recreation builds', 'Pergolas & custom shade structures', 'Custom gates & entry features', 'Garden boxes & raised beds', 'Outdoor storage & shed modifications', 'Playhouses & kid-spec builds', 'Unique architectural features & one-off builds' ),
				'principle'      => 'Built by hand. Built to stay.',
				'process'        => array(
					array( 'title' => 'The Idea', 'text' => 'Bring us what you’ve got — a Pinterest board, a rough sketch on a napkin, a phone photo of something you saw. We listen, ask questions, measure the space, and talk through what’s realistic, what’s buildable, and what it will take.' ),
					array( 'title' => 'Design & Estimate', 'text' => 'We sketch the build, spec the materials, and deliver a written, itemized estimate with a clear timeline. Lumber type, hardware, finish options, labor — all spelled out so you know what you’re approving before a saw turns on.' ),
					array( 'title' => 'The Build', 'text' => 'We schedule a window, stage materials, and build on-site. Jobsite kept clean, daily updates via text, and a standing welcome to walk the project at any stage. If the build needs to shift mid-stream, you’re the first to know.' ),
					array( 'title' => 'Handoff', 'text' => 'Before, during, and after photos delivered when the build is done. Finishes sealed, hardware tightened, debris hauled. You walk the finished project with us, get your warranty paperwork, and take it from there.' ),
				),
				'pricing_line'   => 'Written, itemized estimates — every custom build.',
				'pricing_body'   => 'Every custom estimate spells out the lumber grade, hardware, fasteners, finish materials, and labor separately — so you can see exactly where each dollar goes. We flag trade-offs (cedar vs. pressure-treated, premium vs. standard hardware) so you can choose what fits your budget before the first cut.',
				'warranty_line'  => '2–5 year workmanship warranty, standard.',
				'warranty_body'  => 'If a joint loosens, a hinge sags, or finish work fails under normal use, we come back and make it right. Premium lumber, hardware, and finishes carry their own manufacturer warranties, which we hand off to you in writing at project completion.',
				'related'        => array( 'decking', 'handyman', 'exterior-repairs', 'fencing' ),
				'testi_eyebrow'  => 'Custom Projects',
				'testi_quote'    => '',
				'testi_name'     => '',
			),

		),
	);

	return $c;
}

/**
 * Get a single service's catalogue entry by slug (empty array if none).
 *
 * @param string $slug Page slug, e.g. 'gutters'.
 * @return array
 */
function hfhs_service_entry( $slug ) {
	$c = hfhs_services_catalogue();
	return isset( $c['catalogue'][ $slug ] ) ? $c['catalogue'][ $slug ] : array();
}

/**
 * Get a shared (non per-service) catalogue label with a fallback.
 *
 * @param string $key     Shared key.
 * @param string $default Fallback.
 * @return string
 */
function hfhs_service_shared( $key, $default = '' ) {
	$c = hfhs_services_catalogue();
	return isset( $c['shared'][ $key ] ) ? $c['shared'][ $key ] : $default;
}
