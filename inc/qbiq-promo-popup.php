<?php
/**
 * Homepage promo popup for QBIQ System.
 *
 * Works on the Pegasus child theme and as a drop-in for the live Divi child
 * theme. No Pegasus, CMB2, Bootstrap, or jQuery dependency. Front-end copy
 * falls back to the hardcoded Black Friday defaults (code: TOMBRADY) when
 * no saved meta exists. Background art will be handled later.
 *
 * ---------------------------------------------------------------------------
 * Divi child theme install
 * ---------------------------------------------------------------------------
 * 1. Copy qbiq-promo-popup.php and qbiq-promo.css into the Divi child theme
 *    root (the same folder as functions.php).
 * 2. Add this line to the child theme's functions.php:
 *
 *    require_once get_stylesheet_directory() . '/qbiq-promo-popup.php';
 *
 * The PHP file locates qbiq-promo.css beside itself first, then falls back
 * to assets/css/qbiq-promo.css (Pegasus layout). If a URL cannot be built,
 * the CSS is inlined.
 *
 * To disable the popup without CMB2, add this before the require:
 *
 *    define( 'QBIQ_PROMO_POPUP_ENABLED', false );
 *
 * Filters: qbiq_promo_popup_enabled, qbiq_promo_defaults, qbiq_promo_is_hidden.
 *
 * Also works as an mu-plugin: put both files in wp-content/mu-plugins/.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'QBIQ_PROMO_POPUP_ENABLED' ) ) {
	define( 'QBIQ_PROMO_POPUP_ENABLED', true );
}

if ( ! function_exists( 'qbiq_promo_is_enabled' ) ) {
	function qbiq_promo_is_enabled() {
		$enabled = defined( 'QBIQ_PROMO_POPUP_ENABLED' ) ? (bool) QBIQ_PROMO_POPUP_ENABLED : true;
		return (bool) apply_filters( 'qbiq_promo_popup_enabled', $enabled );
	}
}

if ( ! function_exists( 'qbiq_promo_defaults' ) ) {
	function qbiq_promo_defaults() {
		$defaults = array(
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
		return apply_filters( 'qbiq_promo_defaults', $defaults );
	}
}

if ( ! function_exists( 'qbiq_promo_get_field' ) ) {
	function qbiq_promo_get_field( $key ) {
		$defaults = qbiq_promo_defaults();
		$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
		$front_id = function_exists( 'get_option' ) ? (int) get_option( 'page_on_front' ) : 0;
		if ( ! $front_id || ! function_exists( 'get_post_meta' ) ) {
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
		$hidden   = false;
		$front_id = function_exists( 'get_option' ) ? (int) get_option( 'page_on_front' ) : 0;
		if ( $front_id && function_exists( 'get_post_meta' ) ) {
			$hidden = 'on' === get_post_meta( $front_id, 'qbiq_promo_hide', true );
		}
		return (bool) apply_filters( 'qbiq_promo_is_hidden', $hidden );
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

if ( ! function_exists( 'qbiq_promo_normalize_path' ) ) {
	function qbiq_promo_normalize_path( $path ) {
		$path = str_replace( '\\', '/', (string) $path );
		return rtrim( $path, '/' );
	}
}

if ( ! function_exists( 'qbiq_promo_locate_css' ) ) {
	/**
	 * Find qbiq-promo.css: beside this file first (Divi root), then
	 * assets/css relative to this file or its parent (Pegasus inc/ layout).
	 *
	 * @return array{path:string,url:string,ver:string|false}
	 */
	function qbiq_promo_locate_css() {
		$dir = qbiq_promo_normalize_path( dirname( __FILE__ ) );
		$candidates = array(
			$dir . '/qbiq-promo.css',
			$dir . '/assets/css/qbiq-promo.css',
			dirname( $dir ) . '/assets/css/qbiq-promo.css',
		);

		$path = '';
		foreach ( $candidates as $candidate ) {
			if ( is_readable( $candidate ) ) {
				$path = $candidate;
				break;
			}
		}

		$url = '';
		if ( $path ) {
			$url = qbiq_promo_path_to_url( $path );
		}

		$ver = $path ? (string) filemtime( $path ) : false;

		return array(
			'path' => $path,
			'url'  => $url,
			'ver'  => $ver,
		);
	}
}

if ( ! function_exists( 'qbiq_promo_path_to_url' ) ) {
	function qbiq_promo_path_to_url( $path ) {
		$path = qbiq_promo_normalize_path( $path );

		$maps = array();
		if ( function_exists( 'get_stylesheet_directory' ) && function_exists( 'get_stylesheet_directory_uri' ) ) {
			$maps[] = array(
				'dir' => qbiq_promo_normalize_path( get_stylesheet_directory() ),
				'uri' => get_stylesheet_directory_uri(),
			);
		}
		if ( function_exists( 'get_template_directory' ) && function_exists( 'get_template_directory_uri' ) ) {
			$maps[] = array(
				'dir' => qbiq_promo_normalize_path( get_template_directory() ),
				'uri' => get_template_directory_uri(),
			);
		}
		if ( defined( 'WPMU_PLUGIN_DIR' ) && defined( 'WPMU_PLUGIN_URL' ) ) {
			$maps[] = array(
				'dir' => qbiq_promo_normalize_path( WPMU_PLUGIN_DIR ),
				'uri' => WPMU_PLUGIN_URL,
			);
		}
		if ( defined( 'WP_PLUGIN_DIR' ) && function_exists( 'plugins_url' ) ) {
			$maps[] = array(
				'dir' => qbiq_promo_normalize_path( WP_PLUGIN_DIR ),
				'uri' => plugins_url(),
			);
		}
		if ( defined( 'WP_CONTENT_DIR' ) && function_exists( 'content_url' ) ) {
			$maps[] = array(
				'dir' => qbiq_promo_normalize_path( WP_CONTENT_DIR ),
				'uri' => content_url(),
			);
		}

		foreach ( $maps as $map ) {
			if ( $map['dir'] && ( 0 === strpos( $path, $map['dir'] . '/' ) || $path === $map['dir'] ) ) {
				$relative = substr( $path, strlen( $map['dir'] ) );
				return rtrim( $map['uri'], '/' ) . $relative;
			}
		}

		return '';
	}
}

if ( ! function_exists( 'qbiq_promo_enqueue_assets' ) ) {
	function qbiq_promo_enqueue_assets() {
		if ( ! qbiq_promo_is_enabled() ) {
			return;
		}
		if ( function_exists( 'is_front_page' ) && ! is_front_page() ) {
			return;
		}

		$css = qbiq_promo_locate_css();
		if ( $css['url'] ) {
			wp_enqueue_style( 'qbiq-promo', $css['url'], array(), $css['ver'] );
			return;
		}

		if ( $css['path'] ) {
			$contents = file_get_contents( $css['path'] );
			if ( false !== $contents ) {
				wp_register_style( 'qbiq-promo', false, array(), $css['ver'] );
				wp_enqueue_style( 'qbiq-promo' );
				wp_add_inline_style( 'qbiq-promo', $contents );
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'qbiq_promo_enqueue_assets' );

if ( ! function_exists( 'qbiq_promo_render_logo' ) ) {
	function qbiq_promo_render_logo() {
		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			echo '<div class="qbiq-promo-logo">';
			the_custom_logo();
			echo '</div>';
			return;
		}

		if ( function_exists( 'et_get_option' ) ) {
			$logo = et_get_option( 'divi_logo' );
			if ( $logo ) {
				$alt = function_exists( 'get_bloginfo' ) ? get_bloginfo( 'name' ) : 'QBIQ';
				echo '<div class="qbiq-promo-logo">';
				echo '<img class="qbiq-promo-logo-img" src="' . esc_url( $logo ) . '" alt="' . esc_attr( $alt ) . '" />';
				echo '</div>';
			}
		}
	}
}

if ( ! function_exists( 'qbiq_register_promo_popup_metabox' ) ) {
	function qbiq_register_promo_popup_metabox() {
		if ( ! function_exists( 'new_cmb2_box' ) ) {
			return;
		}

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
}
add_action( 'cmb2_admin_init', 'qbiq_register_promo_popup_metabox' );

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
			echo '<div class="qbiq-promo-heading qbiq-promo-gradient">' . esc_html( $heading ) . '</div>';
		}

		if ( $offer ) {
			echo '<div class="qbiq-promo-callout">' . esc_html( $offer ) . '</div>';
		}

		echo '<div class="qbiq-promo-links">';
		if ( $products_label && $products_url ) {
			echo '<div class="qbiq-promo-callout">';
			echo esc_html( $products_label ) . ': ';
			echo '<a href="' . esc_url( $products_url ) . '">' . esc_html( qbiq_promo_host_label( $products_url, 'QBIQSYSTEM.COM' ) ) . '</a>';
			echo '</div>';
		}
		if ( $camp_label && $camp_url ) {
			echo '<div class="qbiq-promo-callout">';
			echo esc_html( $camp_label ) . ': ';
			echo '<a href="' . esc_url( $camp_url ) . '">' . esc_html( qbiq_promo_host_label( $camp_url, 'QBIQCAMP.COM' ) ) . '</a>';
			echo '</div>';
		}
		echo '</div>';

		if ( $code ) {
			echo '<div class="qbiq-promo-code-wrap" role="status" aria-live="polite">';
			if ( $code_label ) {
				echo '<span class="qbiq-promo-code-label">' . esc_html( $code_label ) . ': </span>';
			}
			echo '<code class="qbiq-promo-code">' . esc_html( $code ) . '</code>';
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'vqdev_render_monthly_promo_from_hardcoded_json' ) ) {
	function vqdev_render_monthly_promo_from_hardcoded_json() {
		qbiq_render_black_friday_promo();
	}
}

if ( ! function_exists( 'qbiq_promo_render_modal' ) ) {
	function qbiq_promo_render_modal() {
		if ( ! qbiq_promo_is_enabled() ) {
			return;
		}
		if ( function_exists( 'is_front_page' ) && ! is_front_page() ) {
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

		// If the stylesheet URL could not be built, inline CSS as a last resort.
		$css = qbiq_promo_locate_css();
		if ( $css['path'] && ! $css['url'] && ! wp_style_is( 'qbiq-promo', 'done' ) && ! wp_style_is( 'qbiq-promo', 'enqueued' ) ) {
			$contents = file_get_contents( $css['path'] );
			if ( false !== $contents ) {
				echo '<style id="qbiq-promo-inline-css">' . $contents . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		$modal_title = qbiq_promo_get_field( 'modal_title' );
		$code        = qbiq_promo_get_field( 'code' );
		$close_label = function_exists( 'esc_attr__' ) ? esc_attr__( 'Close', 'qbiq-promo' ) : 'Close';

		?>
		<!-- QBIQ promo modal: self-contained vanilla JS. Flyer art comes later. -->
		<div class="qbiq-promo-modal" id="qbiq-promo-modal" role="dialog" aria-modal="true" aria-labelledby="qbiq-promo-title" aria-hidden="true">
			<div class="qbiq-promo-backdrop" data-qbiq-promo-close="true"></div>
			<div class="qbiq-promo-dialog" role="document">
				<div class="qbiq-promo-content">
					<div class="qbiq-promo-header">
						<h2 class="qbiq-promo-title" id="qbiq-promo-title"><?php echo esc_html( $modal_title ); ?></h2>
						<button type="button" class="qbiq-promo-close" data-qbiq-promo-close="true" aria-label="<?php echo $close_label; ?>">&times;</button>
					</div>
					<div class="qbiq-promo-body">
						<div class="qbiq-promo-hero">
							<?php qbiq_promo_render_logo(); ?>
							<div class="qbiq-promo-copy">
								<?php qbiq_render_black_friday_promo(); ?>
							</div>
						</div>
					</div>
					<div class="qbiq-promo-footer">
						<?php if ( $code ) : ?>
						<button type="button" class="qbiq-promo-btn qbiq-promo-btn-copy" id="qbiq-promo-copy-btn">Copy code</button>
						<?php endif; ?>
						<button type="button" class="qbiq-promo-btn qbiq-promo-btn-primary" data-qbiq-promo-close="true">Got it</button>
						<button type="button" class="qbiq-promo-btn qbiq-promo-btn-link" id="qbiq-promo-hide-btn">
							Don’t show for 7 days
						</button>
					</div>
				</div>
			</div>
		</div>
		<script>
		(function() {
			var HIDE_KEY = 'qbiqBfPromoHiddenUntil';
			var nowSec = Math.floor(Date.now() / 1000);
			try {
				var until = JSON.parse(localStorage.getItem(HIDE_KEY));
				if (until && nowSec < Number(until)) {
					return;
				}
			} catch (e) {}

			var modalEl = document.getElementById('qbiq-promo-modal');
			if (!modalEl) return;

			var dialogEl = modalEl.querySelector('.qbiq-promo-dialog');
			var lastFocus = null;
			var previouslyOverflow = '';

			function focusables() {
				return Array.prototype.slice.call(
					modalEl.querySelectorAll('a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])')
				).filter(function(el) {
					return !el.hasAttribute('disabled') && el.offsetParent !== null;
				});
			}

			function openModal() {
				lastFocus = document.activeElement;
				modalEl.classList.add('qbiq-promo-is-open');
				modalEl.setAttribute('aria-hidden', 'false');
				document.body.classList.add('qbiq-promo-scroll-lock');
				previouslyOverflow = document.body.style.overflow;
				document.body.style.overflow = 'hidden';
				var items = focusables();
				if (items.length) {
					items[0].focus();
				} else if (dialogEl) {
					dialogEl.setAttribute('tabindex', '-1');
					dialogEl.focus();
				}
			}

			function closeModal() {
				modalEl.classList.remove('qbiq-promo-is-open');
				modalEl.setAttribute('aria-hidden', 'true');
				document.body.classList.remove('qbiq-promo-scroll-lock');
				document.body.style.overflow = previouslyOverflow;
				if (lastFocus && typeof lastFocus.focus === 'function') {
					lastFocus.focus();
				}
			}

			window.setTimeout(openModal, 800);

			modalEl.addEventListener('click', function(event) {
				if (event.target && event.target.getAttribute && event.target.getAttribute('data-qbiq-promo-close')) {
					closeModal();
				}
			});

			document.addEventListener('keydown', function(event) {
				if (!modalEl.classList.contains('qbiq-promo-is-open')) return;

				if (event.key === 'Escape') {
					event.preventDefault();
					closeModal();
					return;
				}

				if (event.key !== 'Tab') return;
				var items = focusables();
				if (!items.length) return;
				var first = items[0];
				var last = items[items.length - 1];
				if (event.shiftKey && document.activeElement === first) {
					event.preventDefault();
					last.focus();
				} else if (!event.shiftKey && document.activeElement === last) {
					event.preventDefault();
					first.focus();
				}
			});

			var copyBtn = document.getElementById('qbiq-promo-copy-btn');
			if (copyBtn) {
				copyBtn.addEventListener('click', function() {
					var codeEl = modalEl.querySelector('.qbiq-promo-code');
					var text = codeEl ? codeEl.textContent.trim() : '';
					if (!text) return;
					if (navigator.clipboard && navigator.clipboard.writeText) {
						navigator.clipboard.writeText(text).then(function() {
							copyBtn.textContent = 'Copied!';
							setTimeout(function(){ copyBtn.textContent = 'Copy code'; }, 1500);
						});
					}
				});
			}

			var hide7Btn = document.getElementById('qbiq-promo-hide-btn');
			if (hide7Btn) {
				hide7Btn.addEventListener('click', function() {
					var SEVEN_DAYS = 7 * 24 * 60 * 60;
					try { localStorage.setItem(HIDE_KEY, JSON.stringify(nowSec + SEVEN_DAYS)); } catch (err) {}
					closeModal();
				});
			}
		})();
		</script>
		<?php
	}
}
add_action( 'wp_footer', 'qbiq_promo_render_modal', 100 );
