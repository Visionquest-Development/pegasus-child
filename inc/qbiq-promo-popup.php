<?php
/**
 * Homepage promo popup for QBIQ System.
 *
 * Black Friday copy is the default. Fields are editable on the front page
 * via the "Promo Popup (Homepage)" CMB2 metabox. Markup, trigger, and
 * copy-to-clipboard behavior match the QBIQ Camp popup. Background art
 * will be handled later.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'qbiq_promo_render_logo' ) ) {
	function qbiq_promo_render_logo() {
		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			echo '<div class="qbiq-promo-logo">';
			the_custom_logo();
			echo '</div>';
		}
	}
}

/**
 * Homepage promo popup — Black Friday defaults, editable via CMB2 on the front page.
 */
if ( ! function_exists( 'qbiq_promo_defaults' ) ) {
	function qbiq_promo_defaults() {
		return array(
			'heading'        => 'BLACK FRIDAY',
			'offer'          => '25% OFF ALL QBIQ PRODUCTS & QBIQ TRAINING CAMP',
			'products_label' => 'QBIQ PRODUCTS',
			'products_url'   => 'https://qbiqsystem.com',
			'camp_label'     => 'QBIQ TRAINING CAMP',
			'camp_url'       => 'https://qbiqcamp.com',
			'code_label'     => 'DISCOUNT CODE',
			'code'           => 'TOMBRADY',
			'modal_title'    => 'Special Offer',
		);
	}
}

if ( ! function_exists( 'qbiq_promo_get_field' ) ) {
	function qbiq_promo_get_field( $key ) {
		$defaults = qbiq_promo_defaults();
		$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
		$front_id = (int) get_option( 'page_on_front' );
		if ( ! $front_id ) {
			return $default;
		}
		$val = get_post_meta( $front_id, 'qbiq_promo_' . $key, true );
		if ( '' === $val || false === $val ) {
			return $default;
		}
		return $val;
	}
}

if ( ! function_exists( 'qbiq_promo_is_hidden' ) ) {
	function qbiq_promo_is_hidden() {
		$front_id = (int) get_option( 'page_on_front' );
		if ( ! $front_id ) {
			return false;
		}
		return 'on' === get_post_meta( $front_id, 'qbiq_promo_hide', true );
	}
}

if ( ! function_exists( 'qbiq_promo_host_label' ) ) {
	function qbiq_promo_host_label( $url, $fallback ) {
		$host = function_exists( 'wp_parse_url' ) ? wp_parse_url( $url, PHP_URL_HOST ) : parse_url( $url, PHP_URL_HOST );
		if ( ! $host ) {
			return $fallback;
		}
		return strtoupper( $host );
	}
}

add_action( 'cmb2_admin_init', 'qbiq_register_promo_popup_metabox' );
function qbiq_register_promo_popup_metabox() {
	$homepage_id = get_option( 'page_on_front' );
	if ( ! $homepage_id ) {
		return;
	}

	$defaults = qbiq_promo_defaults();

	$cmb = new_cmb2_box( array(
		'id'           => 'qbiq_promo_metabox',
		'title'        => __( 'Promo Popup (Homepage)', 'cmb2' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'id', 'value' => array( $homepage_id ) ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );

	$cmb->add_field( array(
		'name' => __( 'Hide this popup', 'cmb2' ),
		'desc' => __( 'Check to stop showing the homepage promo popup.', 'cmb2' ),
		'id'   => 'qbiq_promo_hide',
		'type' => 'checkbox',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Modal title', 'cmb2' ),
		'id'      => 'qbiq_promo_modal_title',
		'type'    => 'text',
		'default' => $defaults['modal_title'],
	) );

	$cmb->add_field( array(
		'name'    => __( 'Heading', 'cmb2' ),
		'id'      => 'qbiq_promo_heading',
		'type'    => 'text',
		'default' => $defaults['heading'],
	) );

	$cmb->add_field( array(
		'name'    => __( 'Offer text', 'cmb2' ),
		'id'      => 'qbiq_promo_offer',
		'type'    => 'text',
		'default' => $defaults['offer'],
	) );

	$cmb->add_field( array(
		'name'    => __( 'Products label', 'cmb2' ),
		'id'      => 'qbiq_promo_products_label',
		'type'    => 'text',
		'default' => $defaults['products_label'],
	) );

	$cmb->add_field( array(
		'name'    => __( 'Products URL', 'cmb2' ),
		'id'      => 'qbiq_promo_products_url',
		'type'    => 'text_url',
		'default' => $defaults['products_url'],
	) );

	$cmb->add_field( array(
		'name'    => __( 'Training Camp label', 'cmb2' ),
		'id'      => 'qbiq_promo_camp_label',
		'type'    => 'text',
		'default' => $defaults['camp_label'],
	) );

	$cmb->add_field( array(
		'name'    => __( 'Training Camp URL', 'cmb2' ),
		'id'      => 'qbiq_promo_camp_url',
		'type'    => 'text_url',
		'default' => $defaults['camp_url'],
	) );

	$cmb->add_field( array(
		'name'    => __( 'Discount code label', 'cmb2' ),
		'id'      => 'qbiq_promo_code_label',
		'type'    => 'text',
		'default' => $defaults['code_label'],
	) );

	$cmb->add_field( array(
		'name'    => __( 'Discount code', 'cmb2' ),
		'id'      => 'qbiq_promo_code',
		'type'    => 'text',
		'default' => $defaults['code'],
		'desc'    => __( 'Copied to the clipboard by the Copy code button.', 'cmb2' ),
	) );
}

if ( ! function_exists( 'qbiq_render_black_friday_promo' ) ) {
	function qbiq_render_black_friday_promo() {
		$heading        = qbiq_promo_get_field( 'heading' );
		$offer          = qbiq_promo_get_field( 'offer' );
		$code           = qbiq_promo_get_field( 'code' );
		$products_label = qbiq_promo_get_field( 'products_label' );
		$products_url   = qbiq_promo_get_field( 'products_url' );
		$camp_label     = qbiq_promo_get_field( 'camp_label' );
		$camp_url       = qbiq_promo_get_field( 'camp_url' );
		$code_label     = qbiq_promo_get_field( 'code_label' );

		if ( '' === $heading && '' === $offer && '' === $code ) {
			return;
		}

		if ( $heading ) {
			echo '<div class="qbiq-title qbiq-gradient">' . esc_html( $heading ) . '</div>';
		}

		if ( $offer ) {
			echo '<div class="qbiq-callout">' . esc_html( $offer ) . '</div>';
		}

		echo '<div class="qbiq-links">';
		if ( $products_label && $products_url ) {
			echo '<div class="qbiq-callout">';
			echo esc_html( $products_label ) . ': ';
			echo '<a href="' . esc_url( $products_url ) . '">' . esc_html( qbiq_promo_host_label( $products_url, 'QBIQSYSTEM.COM' ) ) . '</a>';
			echo '</div>';
		}
		if ( $camp_label && $camp_url ) {
			echo '<div class="qbiq-callout">';
			echo esc_html( $camp_label ) . ': ';
			echo '<a href="' . esc_url( $camp_url ) . '">' . esc_html( qbiq_promo_host_label( $camp_url, 'QBIQCAMP.COM' ) ) . '</a>';
			echo '</div>';
		}
		echo '</div>';

		if ( $code ) {
			echo '<div class="qbiq-promo mt-2" role="status" aria-live="polite">';
			if ( $code_label ) {
				echo '<span class="text-1">' . esc_html( $code_label ) . ': </span>';
			}
			echo '<code class="code-block">' . esc_html( $code ) . '</code>';
			echo '</div>';
		}
	}
}

// Keep the previous function name as a wrapper in case anything else still calls it.
if ( ! function_exists( 'vqdev_render_monthly_promo_from_hardcoded_json' ) ) {
	function vqdev_render_monthly_promo_from_hardcoded_json() {
		qbiq_render_black_friday_promo();
	}
}

// Output the modal in the footer only on the homepage, unless it is hidden in CMB2.
add_action( 'wp_footer', function () {
	if ( ! is_front_page() ) {
		return;
	}
	if ( qbiq_promo_is_hidden() ) {
		return;
	}

	ob_start();
	qbiq_render_black_friday_promo();
	$promo_html = trim( ob_get_clean() );

	if ( '' === $promo_html ) {
		return;
	}

	$modal_title = qbiq_promo_get_field( 'modal_title' );
	$code        = qbiq_promo_get_field( 'code' );

	?>
	<!-- Home Promo Modal -->
	<div class="modal fade" id="homePromoModal" tabindex="-1" aria-labelledby="homePromoLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">

		  <div class="modal-header">
			<h2 class="modal-title fs-5" id="homePromoLabel"><?php echo esc_html( $modal_title ); ?></h2>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo esc_attr__( 'Close', 'textdomain' ); ?>"></button>
		  </div>

		  <div class="modal-body">

			<!-- Existing popup background is left alone; flyer art will be handled later. -->

			<div class="qbiq-hero">
			  <?php qbiq_promo_render_logo(); ?>

			  <div class="">
				<?php qbiq_render_black_friday_promo(); ?>
			  </div>
			</div>

		  </div>

		  <div class="modal-footer">
			<?php if ( $code ) : ?>
			<button type="button" id="promoCopyBtn" class="btn btn-outline-secondary">Copy code</button>
			<?php endif; ?>
			<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got it</button>
			<button type="button" id="promoHide7dBtn" class="btn btn-link ms-auto" data-bs-dismiss="modal" style="text-decoration:none">
			  Don’t show for 7 days
			</button>
		  </div>
		</div>
	  </div>
	</div>

	<script>
	(function() {
	  const HIDE_KEY = 'qbiqBfPromoHiddenUntil';
	  const nowSec = Math.floor(Date.now() / 1000);
	  try {
		const until = JSON.parse(localStorage.getItem(HIDE_KEY));
		if (until && nowSec < Number(until)) {
		  return; // still within hide window
		}
	  } catch (e) {}

	  const modalEl = document.getElementById('homePromoModal');
	  if (!modalEl || typeof bootstrap === 'undefined' || !bootstrap.Modal) return;

	  const modal = new bootstrap.Modal(modalEl);

	  // Auto-show after a brief delay
	  window.setTimeout(function() {
		modal.show();
	  }, 800);

	  // Copy code button
	  const copyBtn = document.getElementById('promoCopyBtn');
	  if (copyBtn) {
		copyBtn.addEventListener('click', function() {
		  const codeEl = modalEl.querySelector('#homePromoModal .code-block');
		  const text = codeEl ? codeEl.textContent.trim() : '';
		  if (!text) return;
		  if (navigator.clipboard && navigator.clipboard.writeText) {
			navigator.clipboard.writeText(text).then(function() {
			  copyBtn.textContent = 'Copied!';
			  setTimeout(function(){ copyBtn.textContent = 'Copy code'; }, 1500);
			});
		  }
		});
	  }

	  // Hide for 7 days
	  const hide7Btn = document.getElementById('promoHide7dBtn');
	  if (hide7Btn) {
		hide7Btn.addEventListener('click', function() {
		  const SEVEN_DAYS = 7 * 24 * 60 * 60;
		  const until = nowSec + SEVEN_DAYS;
		  try { localStorage.setItem(HIDE_KEY, JSON.stringify(until)); } catch (e) {}
		});
	  }
	})();
	</script>
	<?php
}, 100);

