<?php
/**
 * Compatibility shim for the wp-bootstrap-hooks plugin.
 *
 * features/content/embeds.php (the_content_embeds) calls the namespaced helper
 * benignware\wp\bootstrap_hooks\wrap() to wrap <iframe> embeds in a responsive
 * container, but THIS version of the plugin never defines it — it only ships the
 * global-namespace wp_bootstrap_dom_wrap() in lib/helpers.php. As a result, any
 * post/page whose content contains an <iframe> (e.g. the Contact page map) dies
 * with: Call to undefined function benignware\wp\bootstrap_hooks\wrap().
 *
 * We define the missing helper here (identical to wp_bootstrap_dom_wrap) so the
 * plugin's own code resolves. Kept in the child theme instead of edited into the
 * plugin so it stays in version control and survives plugin updates. The
 * function_exists() guard avoids a redeclare fatal if a future plugin version
 * ships its own wrap().
 */

namespace benignware\wp\bootstrap_hooks;

if ( ! function_exists( __NAMESPACE__ . '\\wrap' ) ) {
	/**
	 * Wrap a DOM element in a new parent element of the given tag name.
	 *
	 * @param \DOMElement $element  The element to wrap.
	 * @param string      $tag_name Tag name for the wrapper (e.g. 'div').
	 * @return \DOMElement The newly created wrapper element.
	 */
	function wrap( $element, $tag_name ) {
		$doc             = $element->ownerDocument;
		$parent_node     = $element->parentNode;
		$wrapper_element = $doc->createElement( $tag_name );
		$parent_node->insertBefore( $wrapper_element, $element );
		$wrapper_element->appendChild( $element );

		return $wrapper_element;
	}
}
