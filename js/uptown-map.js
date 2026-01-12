// Mapbox Restaurant Map JavaScript
function initializeMap() {
    // Check if mapboxgl is loaded, if not, wait and try again
    if (typeof mapboxgl === "undefined") {
        console.warn("Mapbox GL JS not loaded yet, retrying in 100ms");
        setTimeout(initializeMap, 100);
        return;
    }
  
    // Set Mapbox access token from localized data or use default
    if (typeof uptownlife_map_data !== 'undefined' && uptownlife_map_data.mapbox_token) {
        mapboxgl.accessToken = uptownlife_map_data.mapbox_token;
    } else {
        // Fallback token - you should replace this with your actual token
        mapboxgl.accessToken = 'pk.eyJ1IjoiamltYm9vYnJpZW4iLCJhIjoiY21kZjlwcXZ2MGFxYTJqcHQwdHh3ajY2cCJ9.tD_YFIg-n5zAOnug76yDOg';
    }
  
    // Initialize map centered on Uptown Columbus, GA
    const map = new mapboxgl.Map({
        container: 'uptown-map',
        style: "mapbox://styles/mapbox/streets-v12",
        center: [-84.99256241133024, 32.466232730454614],
        zoom: 18,
        pitch: 45,
        bearing: 0
    });
  
    // Restaurant data with coordinates and building polygons
  
    // Restaurant data with coordinates and building polygons
    const restaurants = {
        mabella: {
            name: "Mabella Italian Steakhouse",
            address: "14 West 11th Street",
            phone: "(706) 940-0070",
            color: "#d4af37",
            coordinates: [-84.99245146490927, 32.46639415602547],
            description: "Multi-level Italian steakhouse featuring uncharted flavors and dynamic menu options.",
            cuisine: "Italian Steakhouse",
            established: "2015",
            features: ["Multiple levels", "Dynamic menu", "Italian cuisine", "Premium steaks"],
            polygon: [
                [-84.99249010481925, 32.46656562695475],
                [-84.99241297479105, 32.46656288695575],
                [-84.99241053910596, 32.466206001373266],
                [-84.99248929292422, 32.46620531637079],
                [-84.99249010481925, 32.46656562695475]
            ]
        },
        loft: {
            name: "The Loft",
            address: "1032 Broadway",
            phone: "(706) 507-1308",
            color: "#b85450",
            coordinates: [-84.99281161524569, 32.46610941596706],
            description: "Restaurant, bar and venue dedicated to quality, entertainment, food and fun. Operating for 22+ years.",
            cuisine: "American Cuisine & Bar",
            established: "22+ years ago",
            features: ["Live music venue", "Private event space", "Full bar", "Historic location"],
            polygon: [
                [-84.99298189531332, 32.46615154360332],
                [-84.99266512458195, 32.46614945016559],
                [-84.99266512458195, 32.46605524541635],
                [-84.99298189531332, 32.46605454760303],
                [-84.99298189531332, 32.46615154360332]
            ]
        },
        mix: {
            name: "Mix Market",
            address: "1040 Broadway",
            phone: "(706) 984-8004",
            color: "#2c5f5a",
            coordinates: [-84.99292446865678, 32.46636492180623],
            description: "Food market concept offering fresh, diverse dining options.",
            cuisine: "Market & Dining",
            established: "Recent addition",
            features: ["Fresh market", "Diverse options", "Casual dining", "Local ingredients"],
            polygon: [
                [-84.99295294759976, 32.46643136601637],
                [-84.9925443712517, 32.46642717915384],
                [-84.9925559503385, 32.46632390314947],
                [-84.99295046636688, 32.466324600960725],
                [-84.99295294759976, 32.46643136601637]
            ]
        },
        saltcellar: {
            name: "Saltcellar",
            address: "1039 1st Avenue",
            phone: "(706) 507-1308",
            color: "#4a6fa5",
            coordinates: [-84.99208854783348, 32.466079054988896],
            description: "Fresh, bold flavors in a comfortable atmosphere with historic flair.",
            cuisine: "Contemporary American",
            established: "Recent addition",
            features: ["Historic atmosphere", "Fresh ingredients", "Bold flavors", "Large group seating"],
            polygon: [
                [-84.99219075752598, 32.466188864283886],
                [-84.99202368784519, 32.46618607303469],
                [-84.99202203368993, 32.465953701236195],
                [-84.99219406583649, 32.46596067937701],
                [-84.99219075752598, 32.466188864283886]
            ]
        }
    };
  
    let activeRestaurant = null;
    let isSatelliteView = false;
  
    // Add building polygons and markers when map loads
    map.on("load", () => {
        // Add satellite layer source and layer
        map.addSource('satellite', {
            'type': 'raster',
            'url': 'mapbox://mapbox.satellite',
            'tileSize': 256
        });
  
        map.addLayer({
            'id': 'satellite-layer',
            'type': 'raster',
            'source': 'satellite',
            'paint': {
                'raster-opacity': 1
            }
        });
  
        // Initially hide the satellite layer
        map.setLayoutProperty('satellite-layer', 'visibility', 'none');
  
        Object.keys(restaurants).forEach(key => {
            const restaurant = restaurants[key];
  
            // Add building polygon source
            map.addSource(`${key}-building`, {
                "type": "geojson",
                "data": {
                    "type": "Feature",
                    "geometry": {
                        "type": "Polygon",
                        "coordinates": [restaurant.polygon]
                    },
                    "properties": {
                        "restaurant": key,
                        "name": restaurant.name
                    }
                }
            });
  
            // Add fill layer for building
            map.addLayer({
                "id": `${key}-fill`,
                "type": "fill",
                "source": `${key}-building`,
                "layout": {},
                "paint": {
                    "fill-color": restaurant.color,
                    "fill-opacity": 0.6
                }
            });
  
            // Add outline layer for building
            map.addLayer({
                "id": `${key}-outline`,
                "type": "line",
                "source": `${key}-building`,
                "layout": {},
                "paint": {
                    "line-color": restaurant.color,
                    "line-width": 2
                }
            });
  
            // Create marker
            const marker = new mapboxgl.Marker({
                color: restaurant.color,
                scale: 0.8
            })
            .setLngLat(restaurant.coordinates)
            .addTo(map);
  
            // Add click event to marker
            marker.getElement().addEventListener("click", () => {
                highlightRestaurant(key);
                showRestaurantInfo(key);
            });
  
            // Add click event to building polygon
            map.on("click", `${key}-fill`, () => {
                highlightRestaurant(key);
                showRestaurantInfo(key);
            });
  
            // Add hover effects to building polygon
            map.on("mouseenter", `${key}-fill`, () => {
                map.getCanvas().style.cursor = "pointer";
                // Check if satellite layer is visible to adjust hover opacity
                const satelliteVisible = map.getLayoutProperty('satellite-layer', 'visibility') === 'visible';
                const hoverOpacity = satelliteVisible ? 0.6 : 0.8;
                map.setPaintProperty(`${key}-fill`, "fill-opacity", hoverOpacity);
            });
  
            map.on("mouseleave", `${key}-fill`, () => {
                map.getCanvas().style.cursor = "";
                // Check if satellite layer is visible to adjust normal opacity
                const satelliteVisible = map.getLayoutProperty('satellite-layer', 'visibility') === 'visible';
                if (satelliteVisible) {
                    const opacity = activeRestaurant === key ? 0.6 : 0.4;
                    map.setPaintProperty(`${key}-fill`, "fill-opacity", opacity);
                } else {
                    const opacity = activeRestaurant === key ? 0.9 : 0.6;
                    map.setPaintProperty(`${key}-fill`, "fill-opacity", opacity);
                }
            });
        });
    });
  
    // Sidebar restaurant card click handlers
    document.querySelectorAll(".uptown-restaurant-map .restaurant-card").forEach(card => {
        card.addEventListener("click", () => {
            const restaurantKey = card.dataset.restaurant;
            highlightRestaurant(restaurantKey);
            showRestaurantInfo(restaurantKey);
  
            // Fly to restaurant location
            map.flyTo({
                center: restaurants[restaurantKey].coordinates,
                zoom: 19,
                duration: 1000
            });
        });
    });
  
    function highlightRestaurant(restaurantKey) {
        // Remove previous highlighting from sidebar
        document.querySelectorAll(".uptown-restaurant-map .restaurant-card").forEach(card => {
            card.classList.remove("active");
        });
  
        // Add highlighting to selected restaurant card
        const targetCard = document.querySelector(`.uptown-restaurant-map [data-restaurant="${restaurantKey}"]`);
        if (targetCard) {
            targetCard.classList.add("active");
        }
  
        // Reset all building opacities
        Object.keys(restaurants).forEach(key => {
            if (map.getLayer(`${key}-fill`)) {
                // Check if satellite layer is visible to adjust normal opacity
                const satelliteVisible = map.getLayoutProperty('satellite-layer', 'visibility') === 'visible';
                const normalOpacity = satelliteVisible ? 0.4 : 0.6;
                map.setPaintProperty(`${key}-fill`, "fill-opacity", normalOpacity);
                map.setPaintProperty(`${key}-outline`, "line-width", 2);
            }
        });
  
        // Highlight selected building
        if (map.getLayer(`${restaurantKey}-fill`)) {
            // Check if satellite layer is visible to adjust highlight opacity
            const satelliteVisible = map.getLayoutProperty('satellite-layer', 'visibility') === 'visible';
            const highlightOpacity = satelliteVisible ? 0.6 : 0.9;
            map.setPaintProperty(`${restaurantKey}-fill`, "fill-opacity", highlightOpacity);
            map.setPaintProperty(`${restaurantKey}-outline`, "line-width", 3);
        }
  
        activeRestaurant = restaurantKey;
    }
  
    function showRestaurantInfo(restaurantKey) {
        const restaurant = restaurants[restaurantKey];
        const panel = document.querySelector(".uptown-restaurant-map .info-panel");
        const content = document.getElementById("uptown-panel-content");
  
        if (!panel || !content) return;
  
        const featuresList = restaurant.features.map(feature =>
            `<span style="background: ${restaurant.color}20; color: ${restaurant.color}; padding: 2px 6px; border-radius: 12px; font-size: 12px; margin: 2px;">${feature}</span>`
        ).join(" ");
  
        content.innerHTML = `
            <h3 style="margin-top: 0; color: ${restaurant.color}; border-bottom: 2px solid ${restaurant.color};">
                ${restaurant.name}
            </h3>
            <div >
                <p ><strong>📍 Address:</strong> ${restaurant.address}</p>
                <p ><strong>📞 Phone:</strong> ${restaurant.phone}</p>
                <p ><strong>🍽️ Cuisine:</strong> ${restaurant.cuisine}</p>
                <p ><strong>📅 Established:</strong> ${restaurant.established}</p>
            </div>
            <div >
                <p style=" color: #666;"><strong>About:</strong></p>
                <p style="font-size: 14px; line-height: 1.4; color: #555;">${restaurant.description}</p>
            </div>
            <div >
                <p style=" color: #666;"><strong>Features:</strong></p>
                <div style="line-height: 1.8;">
                    ${featuresList}
                </div>
            </div>
            <div style=" padding-top: 5px; border-top: 1px solid #eee; text-align: center;">
                <button onclick="window.open('tel:${restaurant.phone}', '_self')"
                        style="background: ${restaurant.color}; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; margin-right: 10px;">
                    Call Now
                </button>
                <button onclick="getDirections('${restaurant.coordinates[1]},${restaurant.coordinates[0]}')"
                        style="background: #666; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
                    Directions
                </button>
            </div>
        `;
  
        panel.classList.add("active");
    }
  
    window.getDirections = function(coordinates) {
        const url = `https://www.google.com/maps/dir/?api=1&destination=${coordinates}`;
        window.open(url, "_blank");
    };
  
    window.closeInfoPanel = function() {
        const panel = document.querySelector(".uptown-restaurant-map .info-panel");
        if (panel) {
            panel.classList.remove("active");
        }
    };
  
    window.resetMapView = function() {
        // Reset all highlighting
        document.querySelectorAll(".uptown-restaurant-map .restaurant-card").forEach(card => {
            card.classList.remove("active");
        });
  
        // Reset all building opacities
        Object.keys(restaurants).forEach(key => {
            if (map.getLayer(`${key}-fill`)) {
                map.setPaintProperty(`${key}-fill`, "fill-opacity", 0.6);
                map.setPaintProperty(`${key}-outline`, "line-width", 2);
            }
        });
  
        // Close info panel
        closeInfoPanel();
  
        // Fly to overview of all restaurants
        map.flyTo({
            center: [-84.99256241133024, 32.466232730454614],
            zoom: 17,
            pitch: 45,
            bearing: 0,
            duration: 1500
        });
  
        activeRestaurant = null;
    };
  
    // Toggle satellite layer visibility
    window.toggleSatelliteLayer = function() {
        isSatelliteView = !isSatelliteView;
        const satelliteLayer = map.getLayer('satellite-layer');
        if (!satelliteLayer) return;
  
        const newVisibility = isSatelliteView ? 'visible' : 'none';
        map.setLayoutProperty('satellite-layer', 'visibility', newVisibility);
  
        // When showing satellite, move it to the top and adjust opacities
        if (isSatelliteView) {
            map.moveLayer('satellite-layer');
            document.getElementById('satellite-toggle').innerHTML = '🗺️ Toggle Map';
  
            // Reduce opacity of custom layers for better satellite visibility
            Object.keys(restaurants).forEach(key => {
                if (map.getLayer(`${key}-fill`)) {
                    map.setPaintProperty(`${key}-fill`, 'fill-opacity', 0.4);
                    map.setPaintProperty(`${key}-outline`, 'line-opacity', 0.7);
                }
            });
  
            // Move building layers to top after satellite layer
            setTimeout(() => {
                Object.keys(restaurants).forEach(key => {
                    if (map.getLayer(`${key}-fill`)) {
                        map.moveLayer(`${key}-fill`);
                        map.moveLayer(`${key}-outline`);
                    }
                });
            }, 10);
        } else {
            document.getElementById('satellite-toggle').innerHTML = '🛰️ Toggle Satellite';
  
            // Restore opacity of custom layers when satellite is hidden
            Object.keys(restaurants).forEach(key => {
                if (map.getLayer(`${key}-fill`)) {
                    const opacity = activeRestaurant === key ? 0.9 : 0.6;
                    map.setPaintProperty(`${key}-fill`, 'fill-opacity', opacity);
                    map.setPaintProperty(`${key}-outline`, 'line-opacity', 1);
                }
            });
        }
    };
  
    // Update hover effects to work with satellite view
    function updateHoverEffects() {
        Object.keys(restaurants).forEach(key => {
            // Remove existing hover events
            map.off("mouseenter", `${key}-fill`);
            map.off("mouseleave", `${key}-fill`);
  
            // Add new hover events
            map.on("mouseenter", `${key}-fill`, () => {
                map.getCanvas().style.cursor = "pointer";
                // Check if satellite layer is visible to adjust hover opacity
                const satelliteVisible = map.getLayoutProperty('satellite-layer', 'visibility') === 'visible';
                const hoverOpacity = satelliteVisible ? 0.6 : 0.8;
                map.setPaintProperty(`${key}-fill`, "fill-opacity", hoverOpacity);
            });
  
            map.on("mouseleave", `${key}-fill`, () => {
                map.getCanvas().style.cursor = "";
                // Check if satellite layer is visible to adjust normal opacity
                const satelliteVisible = map.getLayoutProperty('satellite-layer', 'visibility') === 'visible';
                if (satelliteVisible) {
                    const opacity = activeRestaurant === key ? 0.6 : 0.4;
                    map.setPaintProperty(`${key}-fill`, "fill-opacity", opacity);
                } else {
                    const opacity = activeRestaurant === key ? 0.9 : 0.6;
                    map.setPaintProperty(`${key}-fill`, "fill-opacity", opacity);
                }
            });
        });
    }
  
    // Close info panel when clicking on map
    map.on("click", (e) => {
        // Only close if not clicking on a marker
        if (!e.originalEvent.target.closest(".mapboxgl-marker")) {
            closeInfoPanel();
        }
    });
  }
  
  // Initialize the map when the DOM is ready and Mapbox is loaded
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeMap);
  } else {
    // DOM is already ready
    initializeMap();
    console.log('Map initialized');
  }
  