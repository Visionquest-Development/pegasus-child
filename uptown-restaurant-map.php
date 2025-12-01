
<?php
/**
 * Uptown Life Group Restaurant Map Shortcode
 *
 * Usage: [uptown_restaurant_map]
 *
 * This file should be placed in your child theme directory
 */

// Enqueue scripts and styles for the restaurant map
function uptown_restaurant_map_enqueue_scripts() {
    // Check if we're on the homepage or if the shortcode is used on the current page
    $should_enqueue = is_front_page() || is_home();
    
    if (!$should_enqueue) {
        global $post;
        if (is_a($post, 'WP_Post')) {
            $should_enqueue = has_shortcode($post->post_content, 'uptown_restaurant_map');
        }
    }
    
    if ($should_enqueue) {
        // Mapbox GL JS
        wp_enqueue_script('mapbox-gl-js', 'https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.js', array(), '3.0.1', true);
        wp_enqueue_style('mapbox-gl-css', 'https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.css', array(), '3.0.1');
        
        // Custom styles
        wp_enqueue_style('uptown-restaurant-map', get_stylesheet_directory_uri() . '/css/uptown-map.css', array(), '1.0.0');
        
        // Custom JavaScript
        wp_enqueue_script('uptownlife-map', get_stylesheet_directory_uri() . '/js/uptown-map.js', array('mapbox-gl-js'), '1.0.0', true);
        
        // Pass data to JavaScript
        wp_localize_script('uptownlife-map', 'uptownlife_map_data', array(
            'mapbox_token' => 'pk.eyJ1IjoiamltYm9vYnJpZW4iLCJhIjoiY21kZjlwcXZ2MGFxYTJqcHQwdHh3ajY2cCJ9.tD_YFIg-n5zAOnug76yDOg'
        ));
    }
}
add_action('wp_enqueue_scripts', 'uptown_restaurant_map_enqueue_scripts');

// Restaurant Map Shortcode
function uptown_restaurant_map_shortcode($atts) {
    // Shortcode attributes
    $atts = shortcode_atts(array(
        'height' => '700px'
    ), $atts, 'uptown_restaurant_map');
    
    ob_start();
    ?>
    <div class="uptown-restaurant-map">
        <div class="container" style="height: <?php echo esc_attr($atts['height']); ?>;">
            <div class="top-nav">
                <div class="nav-header">
                    <div>
                        <h1 class="nav-title">Uptown Life Group</h1>
                        <p class="nav-description">
                            Discover our 4 unique restaurant concepts in Columbus, GA. Click on any restaurant to explore details and view on the map.
                        </p>
                    </div>
                    <div>
                        <button class="reset-view" onclick="resetMapView()" style="margin-right: 10px;">
                            🗺️ Show All Restaurants
                        </button>
                        <button class="reset-view" onclick="toggleSatelliteLayer()" id="satellite-toggle">
                            🛰️ Toggle Satellite
                        </button>
                    </div>
                </div>
                
                <div class="restaurant-grid">
                    <div class="restaurant-card" data-restaurant="mabella">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/4466mabella_web.avif" alt="Mabella Italian Steakhouse" class="restaurant-image">
                        <div class="restaurant-info">
                            <div class="restaurant-name">
                                <span class="color-indicator" style="background-color: #d4af37;"></span>
                                Mabella Italian Steakhouse
                            </div>
                            <div class="restaurant-address">14 West 11th Street</div>
                            <div class="restaurant-phone">(706) 940-0070</div>
                        </div>
                    </div>
                    
                    <div class="restaurant-card" data-restaurant="loft">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/99354The_Loft_web_map.avif" alt="The Loft" class="restaurant-image">
                        <div class="restaurant-info">
                            <div class="restaurant-name">
                                <span class="color-indicator" style="background-color: #b85450;"></span>
                                The Loft
                            </div>
                            <div class="restaurant-address">1032 Broadway</div>
                            <div class="restaurant-phone">(706) 507-1308</div>
                        </div>
                    </div>
                    
                    <div class="restaurant-card" data-restaurant="mix">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/96721mix_market_web_page.avif" alt="Mix Market" class="restaurant-image">
                        <div class="restaurant-info">
                            <div class="restaurant-name">
                                <span class="color-indicator" style="background-color: #2c5f5a;"></span>
                                Mix Market
                            </div>
                            <div class="restaurant-address">1040 Broadway</div>
                            <div class="restaurant-phone">(706) 984-8004</div>
                        </div>
                    </div>
                    
                    <div class="restaurant-card" data-restaurant="saltcellar">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/98288salt_web_map.avif" alt="Saltcellar" class="restaurant-image">
                        <div class="restaurant-info">
                            <div class="restaurant-name">
                                <span class="color-indicator" style="background-color: #4a6fa5;"></span>
                                Saltcellar
                            </div>
                            <div class="restaurant-address">1039 1st Avenue</div>
                            <div class="restaurant-phone">(706) 507-1308</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="map-container">
                <div id="uptown-map"></div>
                <div id="uptown-info-panel" class="info-panel">
                    <span class="close-btn" onclick="closeInfoPanel()">&times;</span>
                    <div id="uptown-panel-content"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('uptown_restaurant_map', 'uptown_restaurant_map_shortcode');
?>