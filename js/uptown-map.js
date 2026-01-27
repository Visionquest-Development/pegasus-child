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
      zoom: 17,
      pitch: 45,
      bearing: 0
  });

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
          image: "4466mabella_web.avif",
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
          image: "99354The_Loft_web_map.avif",
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
          image: "96721mix_market_web_page.avif",
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
          image: "98288salt_web_map.avif",
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
  let isMapInteractive = false;

  // Check if we're on desktop (width > 768px)
  const isDesktop = () => window.innerWidth > 768;

  // Disable scroll zoom by default on desktop
  if (isDesktop()) {
      map.scrollZoom.disable();
  }

  // Create and add the interaction overlay for desktop
  const mapWrapper = document.querySelector('.uptown-restaurant-map .map-wrapper');
  if (mapWrapper && isDesktop()) {
      // Create overlay element
      const interactionOverlay = document.createElement('div');
      interactionOverlay.className = 'map-interaction-overlay';
      interactionOverlay.innerHTML = '<span>Click to interact with map</span>';
      mapWrapper.appendChild(interactionOverlay);

      // Click on overlay enables map interaction
      interactionOverlay.addEventListener('click', () => {
          enableMapInteraction();
      });
  }

  function enableMapInteraction() {
      if (!isDesktop()) return;

      isMapInteractive = true;
      map.scrollZoom.enable();

      const overlay = document.querySelector('.map-interaction-overlay');
      if (overlay) {
          overlay.classList.add('hidden');
      }

      const wrapper = document.querySelector('.uptown-restaurant-map .map-wrapper');
      if (wrapper) {
          wrapper.classList.add('interactive');
      }
  }

  function disableMapInteraction() {
      if (!isDesktop()) return;

      isMapInteractive = false;
      map.scrollZoom.disable();

      const overlay = document.querySelector('.map-interaction-overlay');
      if (overlay) {
          overlay.classList.remove('hidden');
      }

      const wrapper = document.querySelector('.uptown-restaurant-map .map-wrapper');
      if (wrapper) {
          wrapper.classList.remove('interactive');
      }
  }

  // Click on map canvas also enables interaction
  map.on('click', () => {
      if (!isMapInteractive && isDesktop()) {
          enableMapInteraction();
      }
  });

  // Listen for clicks outside the map to disable interaction
  document.addEventListener('click', (e) => {
      if (!isDesktop()) return;

      const mapContainer = document.querySelector('.uptown-restaurant-map .map-wrapper');
      const isClickInside = mapContainer && mapContainer.contains(e.target);

      // Also check if click was on restaurant cards (those should enable interaction too)
      const isCardClick = e.target.closest('.uptown-restaurant-map .restaurant-card');

      if (!isClickInside && !isCardClick && isMapInteractive) {
          disableMapInteraction();
      }
  });

  // Handle window resize - enable scroll on mobile, maintain state on desktop
  window.addEventListener('resize', () => {
      if (!isDesktop()) {
          map.scrollZoom.enable();
          const overlay = document.querySelector('.map-interaction-overlay');
          if (overlay) overlay.style.display = 'none';
      } else {
          const overlay = document.querySelector('.map-interaction-overlay');
          if (overlay) overlay.style.display = '';
          if (!isMapInteractive) {
              map.scrollZoom.disable();
          }
      }
  });

  // Get the theme directory for images
  const getImagePath = (imageName) => {
      // Try to get from localized data, otherwise construct path
      if (typeof uptownlife_map_data !== 'undefined' && uptownlife_map_data.theme_url) {
          return uptownlife_map_data.theme_url + '/images/' + imageName;
      }
      // Fallback: try to find the theme path from existing elements
      const existingImg = document.querySelector('.uptown-restaurant-map .restaurant-image');
      if (existingImg && existingImg.src) {
          const pathParts = existingImg.src.split('/images/');
          if (pathParts.length > 1) {
              return pathParts[0] + '/images/' + imageName;
          }
      }
      return '/wp-content/themes/pegasus-child/images/' + imageName;
  };

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
              flyToRestaurant(key);
          });

          // Add click event to building polygon
          map.on("click", `${key}-fill`, () => {
              highlightRestaurant(key);
              showRestaurantInfo(key);
          });

          // Add hover effects to building polygon
          map.on("mouseenter", `${key}-fill`, () => {
              map.getCanvas().style.cursor = "pointer";
              const satelliteVisible = map.getLayoutProperty('satellite-layer', 'visibility') === 'visible';
              const hoverOpacity = satelliteVisible ? 0.6 : 0.8;
              map.setPaintProperty(`${key}-fill`, "fill-opacity", hoverOpacity);
          });

          map.on("mouseleave", `${key}-fill`, () => {
              map.getCanvas().style.cursor = "";
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
          flyToRestaurant(restaurantKey);
      });
  });

  function flyToRestaurant(restaurantKey) {
      // Enable map interaction when flying to a restaurant
      if (isDesktop() && !isMapInteractive) {
          enableMapInteraction();
      }

      map.flyTo({
          center: restaurants[restaurantKey].coordinates,
          zoom: 19,
          duration: 1000
      });
  }

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
              const satelliteVisible = map.getLayoutProperty('satellite-layer', 'visibility') === 'visible';
              const normalOpacity = satelliteVisible ? 0.4 : 0.6;
              map.setPaintProperty(`${key}-fill`, "fill-opacity", normalOpacity);
              map.setPaintProperty(`${key}-outline`, "line-width", 2);
          }
      });

      // Highlight selected building
      if (map.getLayer(`${restaurantKey}-fill`)) {
          const satelliteVisible = map.getLayoutProperty('satellite-layer', 'visibility') === 'visible';
          const highlightOpacity = satelliteVisible ? 0.6 : 0.9;
          map.setPaintProperty(`${restaurantKey}-fill`, "fill-opacity", highlightOpacity);
          map.setPaintProperty(`${restaurantKey}-outline`, "line-width", 3);
      }

      activeRestaurant = restaurantKey;
  }

  function showRestaurantInfo(restaurantKey) {
      const restaurant = restaurants[restaurantKey];
      const panel = document.getElementById("uptown-info-panel");

      if (!panel) return;

      // Populate panel content
      const panelImage = document.getElementById("panel-restaurant-image");
      const panelName = document.getElementById("panel-restaurant-name");
      const panelAddress = document.getElementById("panel-address");
      const panelPhone = document.getElementById("panel-phone");
      const panelCuisine = document.getElementById("panel-cuisine");
      const panelDescription = document.getElementById("panel-description");
      const panelFeatures = document.getElementById("panel-features");
      const callBtn = document.getElementById("panel-call-btn");
      const directionsBtn = document.getElementById("panel-directions-btn");

      if (panelImage) {
          panelImage.src = getImagePath(restaurant.image);
          panelImage.alt = restaurant.name;
      }

      if (panelName) {
          panelName.textContent = restaurant.name;
          panelName.style.borderColor = restaurant.color;
          panelName.style.color = restaurant.color;
      }

      if (panelAddress) panelAddress.textContent = restaurant.address;
      if (panelPhone) panelPhone.textContent = restaurant.phone;
      if (panelCuisine) panelCuisine.textContent = restaurant.cuisine;
      if (panelDescription) panelDescription.textContent = restaurant.description;

      if (panelFeatures) {
          panelFeatures.innerHTML = restaurant.features.map(feature =>
              `<span style="background: ${restaurant.color}20; color: ${restaurant.color};">${feature}</span>`
          ).join('');
      }

      if (callBtn) {
          callBtn.style.background = restaurant.color;
          callBtn.onclick = () => window.open(`tel:${restaurant.phone}`, '_self');
      }

      if (directionsBtn) {
          directionsBtn.onclick = () => getDirections(`${restaurant.coordinates[1]},${restaurant.coordinates[0]}`);
      }

      panel.classList.add("active");
  }

  window.getDirections = function(coordinates) {
      const url = `https://www.google.com/maps/dir/?api=1&destination=${coordinates}`;
      window.open(url, "_blank");
  };

  window.closeInfoPanel = function() {
      const panel = document.getElementById("uptown-info-panel");
      if (panel) {
          panel.classList.remove("active");
      }

      // Remove active state from cards
      document.querySelectorAll(".uptown-restaurant-map .restaurant-card").forEach(card => {
          card.classList.remove("active");
      });

      // Reset building highlighting
      Object.keys(restaurants).forEach(key => {
          if (map.getLayer(`${key}-fill`)) {
              const satelliteVisible = map.getLayoutProperty('satellite-layer', 'visibility') === 'visible';
              const normalOpacity = satelliteVisible ? 0.4 : 0.6;
              map.setPaintProperty(`${key}-fill`, "fill-opacity", normalOpacity);
              map.setPaintProperty(`${key}-outline`, "line-width", 2);
          }
      });

      activeRestaurant = null;
  };

  window.resetMapView = function() {
      closeInfoPanel();

      // Fly to overview of all restaurants
      map.flyTo({
          center: [-84.99256241133024, 32.466232730454614],
          zoom: 17,
          pitch: 45,
          bearing: 0,
          duration: 1500
      });
  };

  // Toggle satellite layer visibility
  window.toggleSatelliteLayer = function() {
      isSatelliteView = !isSatelliteView;
      const satelliteLayer = map.getLayer('satellite-layer');
      if (!satelliteLayer) return;

      const newVisibility = isSatelliteView ? 'visible' : 'none';
      map.setLayoutProperty('satellite-layer', 'visibility', newVisibility);

      const toggleBtn = document.getElementById('satellite-toggle');

      if (isSatelliteView) {
          map.moveLayer('satellite-layer');
          if (toggleBtn) toggleBtn.innerHTML = '🗺️ Map';

          Object.keys(restaurants).forEach(key => {
              if (map.getLayer(`${key}-fill`)) {
                  map.setPaintProperty(`${key}-fill`, 'fill-opacity', 0.4);
                  map.setPaintProperty(`${key}-outline`, 'line-opacity', 0.7);
              }
          });

          setTimeout(() => {
              Object.keys(restaurants).forEach(key => {
                  if (map.getLayer(`${key}-fill`)) {
                      map.moveLayer(`${key}-fill`);
                      map.moveLayer(`${key}-outline`);
                  }
              });
          }, 10);
      } else {
          if (toggleBtn) toggleBtn.innerHTML = '🛰️ Satellite';

          Object.keys(restaurants).forEach(key => {
              if (map.getLayer(`${key}-fill`)) {
                  const opacity = activeRestaurant === key ? 0.9 : 0.6;
                  map.setPaintProperty(`${key}-fill`, 'fill-opacity', opacity);
                  map.setPaintProperty(`${key}-outline`, 'line-opacity', 1);
              }
          });
      }
  };

  // Close info panel when clicking on map (not on a marker or building)
  map.on("click", (e) => {
      // Check if click was on a restaurant building
      let clickedOnRestaurant = false;
      Object.keys(restaurants).forEach(key => {
          const features = map.queryRenderedFeatures(e.point, { layers: [`${key}-fill`] });
          if (features.length > 0) {
              clickedOnRestaurant = true;
          }
      });

      // Only close if not clicking on a marker or building
      if (!e.originalEvent.target.closest(".mapboxgl-marker") && !clickedOnRestaurant) {
          closeInfoPanel();
      }
  });

  // Add navigation controls
  map.addControl(new mapboxgl.NavigationControl(), 'top-right');
}

// Initialize the map when the DOM is ready and Mapbox is loaded
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeMap);
} else {
  initializeMap();
  console.log('Map initialized');
}
