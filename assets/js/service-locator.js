(() => {
  // resources/js/service-locator.js
  var addToSessionStorageObject = function(name, key, value) {
    var existing = sessionStorage.getItem(name);
    existing = existing ? JSON.parse(existing) : {};
    existing[key] = value;
    sessionStorage.setItem(name, JSON.stringify(existing));
  };
  var radius_circle;
  var geocoder;
  var markers = [];
  var map;
  var markerClusterer;
  var mapCenter = { lat: -30.48941970550993, lng: 133.59244824999996 };
  var radius_km = 30;
  var location_distance;
  var markerImage = websiteData.urlTheme + "/assets/images/service-locator/common-location-purple.png";
  var centerMarkerImage = websiteData.urlTheme + "/assets/images/service-locator/bluedot48.png";
  jQuery(function($) {
    function setMapHeight() {
      const site_header_height = $(".site-header").outerHeight();
      const service_locator_form_height = $(".service_locator-search").outerHeight();
      const service_locator_infobar_height = 0;
      const map_height = $(window).height() - site_header_height + 150;
      $(".service_locator-map").css("height", map_height + "px");
      $(".service_locator-sidepane").css("height", "auto");
      $(".service_locator-listing").css("height", "auto");
      if (window.matchMedia("(max-width: 1024px)").matches) {
      }
      if (window.matchMedia("(min-width: 1024px)").matches) {
        $(".service_locator-content_wrapper").css("height", map_height + "px");
        $(".service_locator").css("height", map_height + "px");
        $(".service_locator-sidepane").css("height", map_height + "px");
      }
    }
    setMapHeight();
    $(window).resize(function() {
      setMapHeight();
    });
    function initializeMap() {
      const mapStyle = [
        {
          elementType: "geometry",
          stylers: [
            {
              color: "#e6e6e6"
            }
          ]
        },
        {
          elementType: "labels.icon",
          stylers: [
            {
              visibility: "off"
            }
          ]
        },
        {
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#616161"
            }
          ]
        },
        {
          elementType: "labels.text.stroke",
          stylers: [
            {
              color: "#e6e6e6"
            }
          ]
        },
        {
          featureType: "administrative.land_parcel",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#bdbdbd"
            }
          ]
        },
        {
          featureType: "poi",
          elementType: "geometry",
          stylers: [
            {
              color: "#eeeeee"
            }
          ]
        },
        {
          featureType: "poi",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#757575"
            }
          ]
        },
        {
          featureType: "poi.park",
          elementType: "geometry",
          stylers: [
            {
              color: "#e5e5e5"
            }
          ]
        },
        {
          featureType: "poi.park",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#9e9e9e"
            }
          ]
        },
        {
          featureType: "road",
          elementType: "geometry",
          stylers: [
            {
              color: "#ffffff"
            }
          ]
        },
        {
          featureType: "road.arterial",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#757575"
            }
          ]
        },
        {
          featureType: "road.highway",
          elementType: "geometry",
          stylers: [
            {
              color: "#dadada"
            }
          ]
        },
        {
          featureType: "road.highway",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#616161"
            }
          ]
        },
        {
          featureType: "road.local",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#9e9e9e"
            }
          ]
        },
        {
          featureType: "transit.line",
          elementType: "geometry",
          stylers: [
            {
              color: "#e5e5e5"
            }
          ]
        },
        {
          featureType: "transit.station",
          elementType: "geometry",
          stylers: [
            {
              color: "#eeeeee"
            }
          ]
        },
        {
          featureType: "water",
          elementType: "geometry",
          stylers: [
            {
              color: "#c9c9c9"
            }
          ]
        },
        {
          featureType: "water",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#9e9e9e"
            }
          ]
        }
      ];
      if (window.matchMedia("(min-width: 60rem)").matches) {
        var mapZoom = 5;
        var mapMinZoom = 5;
        var mapMaxZoom = 18;
      } else {
        var mapZoom = 4;
        var mapMinZoom = 4;
        var mapMaxZoom = 18;
      }
      map = new google.maps.Map(document.getElementById("service_locator-map"), {
        zoom: mapZoom,
        minZoom: mapMinZoom,
        maxZoom: mapMaxZoom,
        center: mapCenter,
        styles: mapStyle,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false,
        zoomControl: true,
        zoomControlOptions: {
          position: google.maps.ControlPosition.TOP_RIGHT
        }
      });
      geocoder = new google.maps.Geocoder();
      var initMapCenter = map.getCenter();
      var providerJson = "/wp-json/wp/v2/service-partner?status=publish&per_page=500";
      var searchBoxInput2 = document.getElementById("pac-input");
      var searchBox = new google.maps.places.Autocomplete(searchBoxInput2, {
        types: ["(regions)"],
        componentRestrictions: { country: "au" }
      });
      putMarkers("", providerJson, initMapCenter);
      serviceLocatorList(providerJson);
      postcodeAutocomplete(providerJson);
      searchSuburbListener(searchBox);
      sessionStorage.removeItem("service_locator");
      addToSessionStorageObject("service_locator", "provider_data", providerJson);
      addToSessionStorageObject("service_locator", "service_category", "");
      addToSessionStorageObject("service_locator", "pin_address", "");
    }
    window.addEventListener("load", initializeMap, { once: true });
    function putMarkers(type, serviceProvider, pinLatLng, radius) {
      $(".service_locator-listing_tabs").empty();
      $(".service_locator-progress").css("z-index", 100).animate({ opacity: 1 }, 300);
      $.getJSON(serviceProvider, function(data) {
        let num = 0;
        let nearby_provider_obj = [];
        $.each(data, function(key, value) {
          var provider_id = value.id;
          var title = value.title.rendered;
          var lat = value.acf.location.lat;
          var lng = value.acf.location.lng;
          var latLng = new google.maps.LatLng(lat, lng);
          var location_name = value.title.rendered;
          var location_city = value.acf.location.city;
          var location_postcode = value.acf.location.post_code;
          var service_types = value.service_types;
          var location_address = value.acf.location.address;
          var link = value.link;
          var location_lat = value.acf.location.lat;
          var location_lng = value.acf.location.lng;
          var contact_numbers = value.acf.contact_numbers;
          if (type == "nearby") {
            var distance_from_location = google.maps.geometry.spherical.computeDistanceBetween(pinLatLng, latLng);
            if (distance_from_location <= radius * 1e3) {
              var list_provider_obj = {
                id: provider_id,
                distance: distance_from_location,
                latitude: lat,
                longitude: lng,
                location_name,
                location_city,
                location_postcode,
                service_types,
                location_address,
                link,
                location_lat,
                location_lng,
                contact_numbers
              };
              nearby_provider_obj.push(list_provider_obj);
              var marker = new google.maps.Marker({
                position: latLng,
                map,
                icon: markerImage
              });
              markers.push(marker);
              var service_type_tags = "";
              for (var i = 0; i < service_types.length; i++) {
                var tag = $.map(service_types_tax, function(val) {
                  return val.term_id == service_types[i] ? val.term_name : null;
                });
                service_type_tags += '<span class="inline-block text-[11px] px-3 py-0.5 rounded-md bg-white border border-brand-sea text-brand-sea">' + tag[0] + "</span>";
              }
              var list_contact_numbers = "";
              contact_numbers.forEach(function(element) {
                var tel = element.phone_number;
                tel = tel.replace(/\s+/g, "");
                list_contact_numbers += '<div class="mb-1">' + element.phone_label + ':&nbsp;<a href="tel:' + tel + '" class="underline font-medium hover:no-underline">' + element.phone_number + "</a></div>";
              });
              var activeInfoWindow;
              var infowindow = new google.maps.InfoWindow();
              google.maps.event.addListener(marker, "click", function(evt) {
                map.panTo(marker.getPosition());
                var contentString = "<div class='max-w-md p-2'><h4 class='text-lg font-bold mb-2'>" + title + "</h4><div class='flex flex-wrap gap-3 mb-3'>" + service_type_tags + "</div><div class='mb-3'>" + location_address + ". <a href='https://www.google.com/maps/dir/?api=1&destination=" + lat + "," + lng + "' target='_blank' class='underline font-medium hover:no-underline'>Get Direction</a></div><div class='mb-3'>" + list_contact_numbers + "</div><div class='mt-8 flex gap-x-4'><a href='" + link + "' class='uppercase text-brand-sea font-semibold hover:underline'>More Details</a><a href='" + link + "#enquiry-form' class='uppercase text-brand-sea font-semibold hover:underline'>Register</a></div></div></div>";
                infowindow.close();
                infowindow.setContent(contentString);
                infowindow.open({
                  anchor: marker,
                  map
                });
              });
              num++;
            }
          } else {
            var distance_from_location = google.maps.geometry.spherical.computeDistanceBetween(pinLatLng, latLng);
            var list_provider_obj = {
              id: provider_id,
              distance: distance_from_location,
              latitude: lat,
              longitude: lng,
              location_name,
              location_city,
              location_postcode,
              service_types,
              location_address,
              link,
              location_lat,
              location_lng,
              contact_numbers
            };
            nearby_provider_obj.push(list_provider_obj);
            var marker = new google.maps.Marker({
              position: latLng,
              map,
              icon: markerImage
            });
            markers.push(marker);
            var service_type_tags = "";
            for (var i = 0; i < service_types.length; i++) {
              var tag = $.map(service_types_tax, function(val) {
                return val.term_id == service_types[i] ? val.term_name : null;
              });
              service_type_tags += '<span class="inline-block text-[11px] px-3 py-0.5 rounded-md bg-white border border-brand-sea text-brand-sea">' + tag[0] + "</span>";
            }
            var list_contact_numbers = "";
            contact_numbers.forEach(function(element) {
              var tel = element.phone_number;
              tel = tel.replace(/\s+/g, "");
              list_contact_numbers += '<div class="mb-1">' + element.phone_label + ':&nbsp;<a href="tel:' + tel + '" class="underline font-medium hover:no-underline">' + element.phone_number + "</a></div>";
            });
            var activeInfoWindow;
            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(marker, "click", function(evt) {
              map.panTo(marker.getPosition());
              var contentString = "<div class='max-w-md p-2'><h4 class='text-lg font-bold mb-2'>" + title + "</h4><div class='flex flex-wrap gap-3 mb-3'>" + service_type_tags + "</div><div class='mb-3'>" + location_address + ". <a href='https://www.google.com/maps/dir/?api=1&destination=" + lat + "," + lng + "' target='_blank' class='underline font-medium hover:no-underline'>Get Direction</a></div><div class='mb-3'>" + list_contact_numbers + "</div><div class='mt-8 flex gap-x-4'><a href='" + link + "' class='uppercase text-brand-sea font-semibold hover:underline'>More Details</a><a href='" + link + "#enquiry-form' class='uppercase text-brand-sea font-semibold hover:underline'>Register</a></div></div></div>";
              infowindow.close();
              infowindow.setContent(contentString);
              infowindow.open({
                anchor: marker,
                map
              });
            });
            num++;
          }
        });
        var nearby_provider = nearby_provider_obj.sort((a, b) => a.distance > b.distance ? 1 : -1);
        if (nearby_provider.length === 0) {
        }
        nearby_provider.forEach((element, index, array) => {
          serviceProviderItem(element.id, element.location_name, element.location_city, element.location_postcode, element.distance, element.service_types, element.location_address, element.link, element.location_lat, element.location_lng, element.contact_numbers);
        });
        markerClusterer = new MarkerClusterer(map, markers, {
          imagePath: "/wp-content/themes/coact/assets/images/service-locator/common-cluster.svg",
          averageCenter: true,
          enableRetinaIcons: true,
          gridSize: 68,
          styles: [
            {
              height: 40,
              textColor: "white",
              textSize: 14,
              url: "/wp-content/themes/coact/assets/images/service-locator/common-cluster.png",
              width: 40,
              textLineHeight: 40,
              fontWeight: "bold",
              fontFamily: "Arial, sans-serif"
            }
          ]
        });
        markerClusterer.addMarkers(markers);
        if (type == "nearby") {
          if (num > 0) {
            var provider_result = "Showing " + num + " Sites";
            $(".service_locator-listing_title").html(provider_result);
          } else {
            var provider_result = "Sorry, no service providers found";
            $(".service_locator-listing_title").html(provider_result);
          }
        } else {
          var provider_result = "Showing " + num + " Sites";
          $(".service_locator-listing_title").html(provider_result);
        }
      }).done(function(data) {
        $(".service_locator-progress").css("z-index", -1).animate({ opacity: 0 }, 300);
      });
    }
    function getNearestSitesRadius(serviceProvider, pinLatLng, radiusKm) {
      let res = 0;
      let radius = radiusKm;
      for (let i = 0; res < 1; i++) {
        $.ajax({
          url: serviceProvider,
          async: false,
          success: function(data) {
            let nearby_provider_obj = [];
            $.each(data, function(key, value) {
              var provider_id = value.id;
              var title = value.title.rendered;
              var lat = value.acf.location.lat;
              var lng = value.acf.location.lng;
              var latLng = new google.maps.LatLng(lat, lng);
              var location_name = value.title.rendered;
              var location_city = value.acf.location.city;
              var location_postcode = value.acf.location.post_code;
              var service_types = value.service_types;
              var location_address = value.acf.location.address;
              var link = value.link;
              var location_lat = value.acf.location.lat;
              var location_lng = value.acf.location.lng;
              var contact_numbers = value.acf.contact_numbers;
              let distance_from_location = google.maps.geometry.spherical.computeDistanceBetween(pinLatLng, latLng);
              if (distance_from_location <= radius * 1e3) {
                let list_provider_obj = {
                  id: provider_id,
                  distance: distance_from_location,
                  latitude: lat,
                  longitude: lng,
                  location_name,
                  location_city,
                  location_postcode,
                  service_types,
                  location_address,
                  link,
                  location_lat,
                  location_lng,
                  contact_numbers
                };
                nearby_provider_obj.push(list_provider_obj);
              }
            });
            let nearby_provider = nearby_provider_obj.sort((a, b) => a.distance > b.distance ? 1 : -1);
            res = nearby_provider.length;
            if (res == 0) {
              radius = radius + 50;
            } else {
              res = 1;
            }
          }
        });
      }
      return radius;
    }
    function serviceLocatorList(serviceProvider) {
      $.getJSON(serviceProvider, function(data) {
        $.each(data, function(key, value) {
          var provider_id = value.id;
          var location_name = value.title.rendered;
          var location_address = value.acf.location.address;
          var location_city = value.acf.location.city;
          var location_postcode = value.acf.location.post_code;
          var service_types = value.service_types;
          var link = value.link;
          var location_lat = value.acf.location.lat;
          var location_lng = value.acf.location.lng;
          var contact_numbers = value.acf.contact_numbers;
          serviceProviderItem(provider_id, location_name, location_city, location_postcode, location_distance, service_types, location_address, link, location_lat, location_lng, contact_numbers);
        });
      }).done(function(data) {
      });
    }
    function createProviderItem(link, location_name, location_address, map_url, new_enquiries, existing_client, service_type_tags) {
      return `
      <li class="block bg-[#F4F4F4]">
          <div class="pl-14 pr-8 pt-4 pb-4">
              <h4 class="text-lg leading-tight font-bold mb-2">
                  <a href="${link}" class="hover:underline">${location_name}</a>
              </h4>
              <div class="relative">
                  <svg class="absolute -left-10 h-6 w-6" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M42.6656 18.3328C42.6649 14.9472 41.7267 11.628 39.955 8.74296C38.1834 5.85795 35.6474 3.51988 32.6282 1.98794C29.6091 0.455994 26.2247 -0.20999 22.8502 0.0638118C19.4757 0.337613 16.2429 1.5405 13.5102 3.53914C10.7775 5.53778 8.65168 8.2541 7.36828 11.387C6.08488 14.5199 5.69409 17.947 6.23921 21.2884C6.78434 24.6298 8.24409 27.755 10.4567 30.3176C12.6692 32.8801 15.5482 34.7799 18.7744 35.8064L24.2912 48L29.7632 35.848C33.5015 34.6876 36.7704 32.3616 39.0919 29.2101C41.4134 26.0586 42.6657 22.247 42.6656 18.3328ZM24.3328 26.08C22.8006 26.08 21.3027 25.6256 20.0287 24.7744C18.7547 23.9231 17.7617 22.7132 17.1753 21.2975C16.589 19.8819 16.4355 18.3242 16.7345 16.8214C17.0334 15.3186 17.7712 13.9382 18.8547 12.8547C19.9382 11.7713 21.3186 11.0334 22.8214 10.7345C24.3242 10.4355 25.8819 10.589 27.2975 11.1753C28.7131 11.7617 29.9231 12.7547 30.7744 14.0287C31.6256 15.3027 32.08 16.8006 32.08 18.3328C32.0802 19.3503 31.88 20.3578 31.4907 21.2978C31.1015 22.2378 30.5308 23.0919 29.8114 23.8114C29.0919 24.5308 28.2378 25.1015 27.2978 25.4907C26.3578 25.88 25.3502 26.0802 24.3328 26.08Z" fill="#000000" />
                  </svg>
                  <div class="text-sm">${location_address}<br />
                      <a href="${map_url}" target="_blank" class="text-brand-blue font-medium underline">Get Directions</a>
                  </div>
              </div>
              <div class="text-sm my-4">
                  New enquiries: <a href="tel:61${new_enquiries.split(" ").join("")}" class="text-brand-blue underline hover:no-underline">${new_enquiries}</a><br />
                  Existing clients: <a href="tel:61${existing_client.split(" ").join("")}" class="text-brand-blue underline hover:no-underline">${existing_client}</a>
              </div>
              <div class="mt-4">
                  <div class="flex flex-wrap gap-3">${service_type_tags}</div>
              </div>
          </div>
          <div class="flex bg-[#E2E2E2] border-t border-b border-[#CCCCCC]">
              <div class="w-1/2 border-r border-[#CCC]">
                  <a href="${link}/#enquiry-form" class="inline-flex gap-3 items-center hover:underline px-8 py-3">
                      <svg class="w-4 h-4 text-brand-purple" width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M24.1072 0C19.3604 0 14.7203 1.40758 10.7735 4.04473C6.82672 6.68188 3.75058 10.4302 1.93408 14.8156C0.117577 19.201 -0.357704 24.0266 0.568342 28.6822C1.49439 33.3377 3.78017 37.6141 7.13663 40.9706C10.4931 44.327 14.7695 46.6128 19.425 47.5388C24.0806 48.4649 28.9062 47.9896 33.2916 46.1731C37.677 44.3566 41.4253 41.2805 44.0625 37.3337C46.6996 33.3869 48.1072 28.7468 48.1072 24C48.1072 17.6348 45.5786 11.5303 41.0778 7.02944C36.5769 2.52856 30.4724 0 24.1072 0ZM21.0368 38.6192L16.04 33.6208L25.6592 24L16.04 14.3808L21.0368 9.384L35.656 24L21.0368 38.6192Z" fill="currentColor" />
                      </svg>
                      <span class="text-black font-bold text-sm">Register</span>
                  </a>
              </div>
              <div class="w-1/2">
                  <a href="${link}" class="inline-flex gap-3 items-center hover:underline px-4 lg:px-8 py-3">
                      <svg class="w-4 h-4 text-brand-purple" width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M24.1072 0C19.3604 0 14.7203 1.40758 10.7735 4.04473C6.82672 6.68188 3.75058 10.4302 1.93408 14.8156C0.117577 19.201 -0.357704 24.0266 0.568342 28.6822C1.49439 33.3377 3.78017 37.6141 7.13663 40.9706C10.4931 44.327 14.7695 46.6128 19.425 47.5388C24.0806 48.4649 28.9062 47.9896 33.2916 46.1731C37.677 44.3566 41.4253 41.2805 44.0625 37.3337C46.6996 33.3869 48.1072 28.7468 48.1072 24C48.1072 17.6348 45.5786 11.5303 41.0778 7.02944C36.5769 2.52856 30.4724 0 24.1072 0ZM21.0368 38.6192L16.04 33.6208L25.6592 24L16.04 14.3808L21.0368 9.384L35.656 24L21.0368 38.6192Z" fill="currentColor" />
                      </svg>
                      <span class="text-black font-bold text-sm">More details</span>
                  </a>
              </div>
          </div>
      </li>`;
    }
    function serviceProviderItem(provider_id, location_name, location_city, location_postcode, location_distance2, service_types, location_address, link, location_lat, location_lng, contact_numbers) {
      if (!location_distance2) {
        location_distance2 = "";
      } else {
        location_distance2 = location_distance2 / 1e3;
        location_distance2 = '<span class="inline-block">&nbsp;&nbsp;|&nbsp;&nbsp;~' + location_distance2.toFixed(2) + " km</span>";
      }
      var service_type_tags = "";
      for (var i = 0; i < service_types.length; i++) {
        var tag = $.map(service_types_tax, function(val) {
          return val.term_id == service_types[i] ? val.term_name : null;
        });
        service_type_tags += '<span class="inline-block text-[11px] px-3 py-1 rounded-md bg-brand-sea border border-brand-sea text-black font-medium shadow-sm">' + tag[0] + "</span>";
      }
      var map_url = "https://www.google.com/maps/dir/?api=1&destination=" + location_lat + "," + location_lng;
      var new_enquiries = "";
      var existing_client = "";
      if (contact_numbers) {
        if (contact_numbers[0]) {
          new_enquiries = contact_numbers[0].phone_number;
        }
        if (contact_numbers[1]) {
          existing_client = contact_numbers[1].phone_number;
        }
      }
      $(".service_locator-listing_tabs").append(createProviderItem(link, location_name, location_address, map_url, new_enquiries, existing_client, service_type_tags));
    }
    $(".select_service_type").select2({
      placeholder: "Select a service type",
      allowClear: true,
      minimumResultsForSearch: Infinity,
      dropdownParent: $(".service_locator-panel")
    });
    $(".select_service_type").on("select2:select", function(e) {
      var data = e.params.data;
      var service_provider_category = data.id;
      $("#input_postcode").val("");
      $(".service_locator-postcode .btn-clear").hide();
      selectServiceType(service_provider_category);
    });
    $(".select_service_type").on("select2:clear", function(e) {
      var service_provider_category = "";
      $("#input_postcode").val("");
      $(".service_locator-postcode .btn-clear").hide();
      selectServiceType(service_provider_category);
    });
    function selectServiceType(service_provider_category) {
      if (service_provider_category) {
        var providerJson = "/wp-json/wp/v2/service-partner?status=publish&service_types=" + service_provider_category + "&per_page=500";
      } else {
        var providerJson = "/wp-json/wp/v2/service-partner?status=publish&per_page=500";
      }
      addToSessionStorageObject("service_locator", "service_category", service_provider_category);
      addToSessionStorageObject("service_locator", "provider_data", providerJson);
      if (radius_circle) {
        radius_circle.setMap(null);
        radius_circle = null;
      }
      deleteMarkers();
      markerClusterer.clearMarkers();
      $(".service_locator-listing_tabs").empty();
      var markCenter = map.getCenter();
      putMarkers("", providerJson, markCenter);
      map.setCenter(mapCenter);
      map.panTo(mapCenter);
      map.setZoom(5);
    }
    function postcodeAutocomplete(serviceProvider) {
      const input = document.getElementById("input_postcode");
      enableEnterKey(input);
      const autocomplete = new google.maps.places.Autocomplete(input, {
        types: ["(regions)"],
        componentRestrictions: { country: "au" }
      });
      autocomplete.addListener("place_changed", function() {
        var address = $("#input_postcode").val();
        var sessionObj = JSON.parse(sessionStorage.getItem("service_locator"));
        var providerJson = sessionObj.provider_data;
        const place = autocomplete.getPlace();
        if (!place.place_id) {
          return;
        }
        addToSessionStorageObject("service_locator", "provider_data", providerJson);
        addToSessionStorageObject("service_locator", "pin_address", address);
        showNearbySites(providerJson, address);
      });
    }
    $("#input_postcode").on("keyup blur", function(event) {
      if ($(this).val().length != 0) {
        $(".service_locator-postcode .btn-clear").show();
      }
    });
    $(document).on("click", ".service_locator-postcode .btn-clear", function(e) {
      e.preventDefault();
      $("#input_postcode").val("");
      $(".service_locator-postcode .btn-clear").hide();
      $(".select_service_type").trigger({
        type: "select2:clear"
      });
      $(".select_service_type").val(null).trigger("change");
    });
    function enableEnterKey(input) {
      const _addEventListener = input.addEventListener;
      const addEventListenerWrapper = function(type, listener) {
        if (type === "keydown") {
          const _listener = listener;
          listener = function(event) {
            const suggestionSelected = document.getElementsByClassName("pac-item-selected").length;
            if (event.key === "Enter" && !suggestionSelected) {
              const e = new KeyboardEvent("keydown", {
                key: "ArrowDown",
                code: "ArrowDown",
                keyCode: 40
              });
              _listener.apply(input, [e]);
            }
            _listener.apply(input, [event]);
          };
        }
        _addEventListener.apply(input, [type, listener]);
      };
      input.addEventListener = addEventListenerWrapper;
    }
    $(document).on("click", ".button-suburb", function(e) {
      var buttonText = $(this).text();
      $("#pac-input").val(buttonText);
      function noop() {
      }
      google.maps.event.trigger(searchBoxInput, "focus", {});
      setTimeout(() => {
        google.maps.event.trigger(searchBoxInput, "keydown", {
          keyCode: 40,
          stopPropagation: noop,
          preventDefault: noop
        });
        google.maps.event.trigger(searchBoxInput, "keydown", { keyCode: 13 });
        google.maps.event.trigger(this, "focus", {});
      }, 500);
      document.getElementById("service-locator").scrollIntoView({ behavior: "smooth" });
    });
    function searchSuburbListener(searchBox) {
      google.maps.event.addListener(searchBox, "place_changed", function() {
        var address = $("#pac-input").val();
        var sessionObj = JSON.parse(sessionStorage.getItem("service_locator"));
        var providerJson = sessionObj.provider_data;
        const place = searchBox.getPlace();
        if (!place.place_id) {
          return;
        }
        $("#pac-input").val("");
        addToSessionStorageObject("service_locator", "provider_data", providerJson);
        addToSessionStorageObject("service_locator", "pin_address", address);
        showNearbySites(providerJson, address);
      });
    }
    function showNearbySites(serviceProvider, address) {
      if (radius_circle) {
        radius_circle.setMap(null);
        radius_circle = null;
      }
      deleteMarkers();
      markerClusterer.clearMarkers();
      $("#service_locator-list").empty();
      if (geocoder) {
        geocoder.geocode({ address }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
              var pinLatLng = results[0].geometry.location;
              let radiusKm = radius_km;
              let radius = getNearestSitesRadius(serviceProvider, pinLatLng, radiusKm);
              radius_circle = new google.maps.Circle({
                center: pinLatLng,
                radius: radius * 1e3,
                strokeColor: "#B86AAB",
                strokeOpacity: 0.6,
                strokeWeight: 2,
                fillColor: "#B86AAB",
                fillOpacity: 0.1,
                clickable: false,
                map
              });
              if (radius_circle) {
                map.fitBounds(radius_circle.getBounds());
              }
              putMarkers("nearby", serviceProvider, pinLatLng, radius);
            } else {
              console.log("No results found while geocoding!");
            }
          } else {
            console.log("Geocode was not successful: " + status);
          }
        });
      }
    }
    $(document).on("click", ".link_overlay-btn", function(e) {
      e.preventDefault();
      var data_id = $(this).data("id");
    });
    function serviceLocatorPane(provider_id) {
      $(".service_locator-progress").css("z-index", 100).animate({ opacity: 1 }, 300);
      $.getJSON("/wp-json/wp/v2/service-partner/" + provider_id, function(data) {
        var title = data.title.rendered;
        var service_types_data = data.service_types;
        var details_service_type = "";
        for (var i = 0; i < service_types_data.length; i++) {
          var tag = $.map(service_types_tax, function(val) {
            return val.term_id == service_types_data[i] ? val.term_name : null;
          });
          if (i > 0) {
            details_service_type += '&comma;&nbsp;<span class="service_locator-listing_tag tag">' + tag[0] + "</span>";
          } else {
            details_service_type += '<span class="service_locator-listing_tag tag">' + tag[0] + "</span>";
          }
        }
        var contact_numbers = data.acf.contact_numbers;
        var list_contact_numbers = "";
        contact_numbers.forEach(function(element) {
          var tel = element.phone_number;
          tel = tel.replace(/\s+/g, "");
          list_contact_numbers += '<div class="service_locator-proofPoint"><span class="svg_icon"><div><div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="injected-svg" data-src="/wp-content/themes/coact/assets/images/service-locator/common-phone.svg"><path class="svg_inherit" d="M6.62 10.79a15.15 15.15 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1.02l-2.2 2.2z"></path></svg></div></div></span><a href="tel:' + tel + '" class="phantom-phone-number">' + element.phone_label + ":&nbsp;" + element.phone_number + "</a></div>";
        });
        var address_data = data.acf.location.address;
        var description_data = data.acf.description;
        var checkmark_data = data.acf.checkmark_list;
        var checkmark_list = "";
        checkmark_data.forEach(function(element) {
          checkmark_list += '<div class="service_locator-proofPoint"><span class="svg_icon"><div><div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="injected-svg" data-src="/wp-content/themes/coact/assets/images/service-locator/common-tick.svg"><title>icon / tick</title><g fill="none" fill-rule="evenodd"><path d="M0 0h24v24H0z"></path><path fill="#45C2BF" fill-rule="nonzero" d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z"></path></g></svg></div></div></span><span>' + element.point + "</span></div>";
        });
        var link_data = data.link;
        var details_body = "";
        details_body += '<div class="service_locator-details_title details_block">';
        if (title) {
          details_body += "<h3>" + title + "</h3>";
        }
        if (details_service_type) {
          details_body += '<div class="service_locator-details_tags"><div class="tags">';
          details_body += details_service_type;
          details_body += "</div></div>";
        }
        details_body += "</div>";
        details_body += '<div class="details_block">';
        details_body += '<div class="service_locator-details_contact list_block">';
        if (address_data) {
          details_body += '<div class="service_locator-proofPoint"><span class="svg_icon"><div><div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="injected-svg" data-src="/wp-content/themes/coact/assets/images/service-locator/common-location.svg"><path class="svg_inherit" d="M12 0C7.3 0 3.5 3.76 3.5 8.4 3.5 14.7 12 24 12 24s8.5-9.3 8.5-15.6C20.5 3.76 16.7 0 12 0zm0 12a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7z"></path></svg></div></div></span><span>' + address_data + "</span></div>";
        }
        if (list_contact_numbers) {
          details_body += list_contact_numbers;
        }
        details_body += "</div>";
        if (description_data) {
          details_body += '<div class="service_locator-details_description">' + description_data + "</div>";
        }
        details_body += "</div>";
        if (checkmark_list) {
          details_body += '<div class="service_locator-details_proofpoints details_block list_block">';
          details_body += checkmark_list;
          details_body += "</div>";
        }
        $(".service_locator-details_body").append(details_body);
        details_footer = "";
        if (link_data) {
          details_footer += '<a href="' + link_data + '#enquiry_form" class="button register-button">Register your interest</a>';
          details_footer += '<a href="' + link_data + '" class="button button--secondary">Learn More</a>';
        }
        $(".service_locator-details_footer").append(details_footer);
      }).done(function(data) {
        $(".service_locator-progress").css("z-index", -1).animate({ opacity: 0 }, 300);
        $(".service_locator-details").addClass("open");
        $("body").addClass("overflow-hidden");
      });
    }
    $(".service_locator-details_overlay, .service_locator-details_header .back-button, .service_locator-details_header .close-button").click(function(e) {
      e.preventDefault();
      $(".service_locator-details").removeClass("open");
      $(".service_locator-details").addClass("closed");
      $("body").removeClass("overflow-hidden");
      $(".service_locator-details_body").empty();
      $(".service_locator-details_footer").empty();
    });
    function setMapOnAll(map2) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map2);
      }
    }
    function hideMarkers() {
      setMapOnAll(null);
    }
    function showMarkers() {
      setMapOnAll(map);
    }
    function deleteMarkers() {
      hideMarkers();
      markers = [];
    }
    $("#view-as-list").click(function(e) {
      e.preventDefault();
      $(this).addClass("active");
      $("#view-on-map").removeClass("active");
      $(".service_locator-listing").show();
      $(".service_locator-listing_tabs").show();
      $(".service_locator-map").hide();
    });
    $("#view-on-map").click(function(e) {
      e.preventDefault();
      $(this).addClass("active");
      $("#view-as-list").removeClass("active");
      $(".service_locator-listing").hide();
      $(".service_locator-listing_tabs").hide();
      $(".service_locator-map").show();
    });
  });
})();
