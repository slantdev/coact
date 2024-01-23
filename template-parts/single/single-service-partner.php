<?php

$breadcrumbs = ($args['breadcrumbs'] === true);
$enable_page_header = true;
$button = true;

$site_name = get_field('site_name');
$hero_image = get_field('hero_image');
$logo = get_field('logo');
$description = get_field('description');
$description_2 = get_field('description_2');
$proof_points = get_field('proof_points');
$location_detail = get_field('location_detail');
$location_background_colour = $location_detail['location_background_colour'];
$opening_hours = $location_detail['opening_hours'];
$sup_header = $location_detail['sup_header'];
$location_site_name = $location_detail['location_site_name'];
$traditional_place_name = $location_detail['traditional_place_name'];
$transportation = $location_detail['transportation'];
$location = $location_detail['location']; // Map
$contact_numbers = $location_detail['contact_numbers']; // Repeater
$contact_email = $location_detail['contact_email']; // Repeater
$photo_gallery = get_field('photo_gallery');
$testimonials = get_field('testimonials')['testimonials_fields'];
$why_coact = get_field('why_coact');
$employers_logos = get_field('employers_logos'); // Unused
$staff_details = get_field('staff_details'); // Unused
$partner_stats = get_field('partner_stats');  // Unused
$related_tiles = get_field('related_tiles'); // Unused
$specialise_links = get_field('specialise_links'); // Unused
$tiles_one = get_field('tiles_one'); // Unused
$tiles_two = get_field('tiles_two'); // Unused
$related_content = get_field('related_content'); // Unused

//preint_r($logo);

if ($enable_page_header) :
  // $page_header = get_field('page_header', $the_id)['page_header'];
  $title = $site_name;
  $description = $description;
  $button = true;
  // $settings = $page_header['settings'] ?? '';
  $text_color = '#000000';
  $text_background_color = 'rgba(69,194,191,0.93)';
  $background_image = $hero_image;
  $background_position = 'center';
  $bg_image_class = '';
  if ($background_position) {
    $bg_image_class = ' object-' . $background_position;
  }

  if (!$title) {
    if (is_tax()) {
      $title = get_term($the_id)->name;
    } else {
      $title = get_the_title();
    }
  }

  $text_style = $text_color ? 'color: ' . $text_color . ';' : '';

  $text_bg_style = $text_background_color ? 'background-color: ' . $text_background_color . ';' : '';

  $enable_breadcrumbs = true;
?>
  <section class="bg-gradient-to-b from-brand-light-gray from-90% via-white via-90% to-white">
    <div class="max-w-screen-5xl px-4 mx-auto">
      <div class="aspect-w-16 aspect-h-5 rounded-3xl overflow-hidden">
        <div class="bg-zinc-300 w-full h-full">
          <?php if ($background_image) : ?>
            <img class="object-cover w-full h-full <?php echo $bg_image_class ?>" src="<?php echo $background_image; ?>" alt="">
          <?php endif; ?>
          <div class="absolute top-0 left-0 w-[1300px] h-[1300px] rounded-full bg-brand-sea bg-opacity-80 -translate-y-1/4 -translate-x-1/4" style="<?php echo $text_bg_style ?>"></div>
          <div class="absolute inset-0 flex items-center p-12">
            <div class="container max-w-screen-xxl mx-auto">
              <div class="max-w-lg font-montserrat" style="<?php echo $text_style ?>">
                <?php if ($enable_breadcrumbs) : ?>
                  <?php
                  if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<div class="breadcrumbs mb-10 text-black">', '</div>');
                  }
                  ?>
                <?php endif; ?>
                <?php if ($title) : ?>
                  <h2 class="text-4xl text-black font-bold mb-4"><?php echo $title ?></h2>
                <?php endif; ?>
                <?php if ($button) : ?>
                  <?php
                  // $button_link = isset($button['url']) ? $button['url'] : '';
                  // $button_target = isset($button['target']) ? $button['target'] : '_self';
                  // $button_title = isset($button['title']) ? $button['title'] : '';
                  $button_link = '#';
                  $button_target = '_self';
                  $button_title = 'Need some extra support';
                  ?>
                  <div class="flex gap-x-4 mt-8">
                    <a href="<?php echo $button_link ?>" target="<?php echo $button_target; ?>" class="px-6 py-3 rounded-full border border-solid font-semibold font-poppins text-xl bg-white border-transparent text-black"><?php echo $button_title; ?></a>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<style type="text/css">
  .acf-map {
    width: 100%;
    height: 100%;
  }

  .acf-map img {
    max-width: inherit !important;
  }
</style>
<script type="text/javascript">
  (function($) {

    /**
     * initMap
     *
     * Renders a Google Map onto the selected jQuery element
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   jQuery $el The jQuery element.
     * @return  object The map instance.
     */
    function initMap($el) {

      // Find marker elements within map.
      var $markers = $el.find('.marker');

      const mapStyle = [{
          elementType: "geometry",
          stylers: [{
            color: "#e6e6e6",
          }, ],
        },
        {
          elementType: "labels.icon",
          stylers: [{
            visibility: "off",
          }, ],
        },
        {
          elementType: "labels.text.fill",
          stylers: [{
            color: "#616161",
          }, ],
        },
        {
          elementType: "labels.text.stroke",
          stylers: [{
            color: "#e6e6e6",
          }, ],
        },
        {
          featureType: "administrative.land_parcel",
          elementType: "labels.text.fill",
          stylers: [{
            color: "#bdbdbd",
          }, ],
        },
        {
          featureType: "poi",
          elementType: "geometry",
          stylers: [{
            color: "#eeeeee",
          }, ],
        },
        {
          featureType: "poi",
          elementType: "labels.text.fill",
          stylers: [{
            color: "#757575",
          }, ],
        },
        {
          featureType: "poi.park",
          elementType: "geometry",
          stylers: [{
            color: "#e5e5e5",
          }, ],
        },
        {
          featureType: "poi.park",
          elementType: "labels.text.fill",
          stylers: [{
            color: "#9e9e9e",
          }, ],
        },
        {
          featureType: "road",
          elementType: "geometry",
          stylers: [{
            color: "#ffffff",
          }, ],
        },
        {
          featureType: "road.arterial",
          elementType: "labels.text.fill",
          stylers: [{
            color: "#757575",
          }, ],
        },
        {
          featureType: "road.highway",
          elementType: "geometry",
          stylers: [{
            color: "#dadada",
          }, ],
        },
        {
          featureType: "road.highway",
          elementType: "labels.text.fill",
          stylers: [{
            color: "#616161",
          }, ],
        },
        {
          featureType: "road.local",
          elementType: "labels.text.fill",
          stylers: [{
            color: "#9e9e9e",
          }, ],
        },
        {
          featureType: "transit.line",
          elementType: "geometry",
          stylers: [{
            color: "#e5e5e5",
          }, ],
        },
        {
          featureType: "transit.station",
          elementType: "geometry",
          stylers: [{
            color: "#eeeeee",
          }, ],
        },
        {
          featureType: "water",
          elementType: "geometry",
          stylers: [{
            color: "#c9c9c9",
          }, ],
        },
        {
          featureType: "water",
          elementType: "labels.text.fill",
          stylers: [{
            color: "#9e9e9e",
          }, ],
        },
      ];

      // Create gerenic map.
      var mapArgs = {
        zoom: $el.data('zoom') || 16,
        styles: mapStyle,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false,
        zoomControl: true,
        zoomControlOptions: {
          position: google.maps.ControlPosition.TOP_RIGHT,
        },
      };
      var map = new google.maps.Map($el[0], mapArgs);

      // Add markers.
      map.markers = [];
      $markers.each(function() {
        initMarker($(this), map);
      });

      // Center map based on markers.
      centerMap(map);

      // Return map instance.
      return map;
    }

    /**
     * initMarker
     *
     * Creates a marker for the given jQuery element and map.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   jQuery $el The jQuery element.
     * @param   object The map instance.
     * @return  object The marker instance.
     */
    function initMarker($marker, map) {

      // Get position from marker.
      var lat = $marker.data('lat');
      var lng = $marker.data('lng');
      var latLng = {
        lat: parseFloat(lat),
        lng: parseFloat(lng)
      };

      // Create marker instance.
      var marker = new google.maps.Marker({
        position: latLng,
        map: map
      });

      // Append to reference for later use.
      map.markers.push(marker);

      // If marker contains HTML, add it to an infoWindow.
      if ($marker.html()) {

        // Create info window.
        var infowindow = new google.maps.InfoWindow({
          content: $marker.html()
        });

        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map, marker);
        });
      }
    }

    /**
     * centerMap
     *
     * Centers the map showing all markers in view.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   object The map instance.
     * @return  void
     */
    function centerMap(map) {

      // Create map boundaries from all map markers.
      var bounds = new google.maps.LatLngBounds();
      map.markers.forEach(function(marker) {
        bounds.extend({
          lat: marker.position.lat(),
          lng: marker.position.lng()
        });
      });

      // Case: Single marker.
      if (map.markers.length == 1) {
        map.setCenter(bounds.getCenter());

        // Case: Multiple markers.
      } else {
        map.fitBounds(bounds);
      }
    }

    // Render maps on page load.
    $(document).ready(function() {
      $('.acf-map').each(function() {
        var map = initMap($(this));
      });
    });

  })(jQuery);
</script>

<section class="bg-white">
  <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-36 pb-12 lg:pb-20 xl:pb-36">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">
      <div class="w-full order-1 lg:w-1/2 xl:w-1/2 pt-4">
        <div class="flex divide-x divide-gray-500 gap-x-10 items-center mb-12">
          <div>
            <img src="<?php echo coact_asset('images/logo/logo-coact.svg') ?>" alt="CoAct" class="h-[100px] w-auto">
          </div>
          <div class="pl-10">
            <img src="<?php echo $logo ?>" alt="<?php echo $site_name ?>" class="h-[88px] w-auto">
          </div>
        </div>

        <?php if ($site_name) : ?>
          <div class="not-prose">
            <h3 class="mb-8 xl:mb-10 text-left text-2xl font-bold"><?php echo $site_name ?></h3>
          </div>
        <?php endif; ?>

        <div class="flex flex-col gap-6 mb-6 xl:mb-8">
          <?php if ($location) : ?>
            <div class="flex gap-x-10">
              <div class="flex-none"><?php echo coact_icon(array('icon' => 'marker', 'group' => 'utilities', 'size' => '24', 'class' => 'mx-auto')); ?></div>
              <div><?php echo $location['address'] ?><br />
                <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $location['lat'] ?>,<?php echo $location['lng'] ?>" class="underline hover:no-underline">Get Directions</a>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($contact_numbers) : ?>
            <div class="flex gap-x-10">
              <div class="flex-none"><?php echo coact_icon(array('icon' => 'cellphone', 'group' => 'content', 'size' => '24', 'class' => 'mx-auto')); ?></div>
              <div>
                <ul>
                  <?php foreach ($contact_numbers as $contact) : ?>
                    <li><?php echo $contact['phone_label'] ?> : <a href="tel:<?php echo preg_replace('/\s+/', '', $contact['phone_number']); ?>" target="_blank" class="underline hover:no-underline"><?php echo $contact['phone_number'] ?></a></li>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($contact_email) : ?>
            <div class="flex gap-x-10">
              <div class="flex-none"><?php echo coact_icon(array('icon' => 'mail', 'group' => 'content', 'size' => '24', 'class' => 'mx-auto')); ?></div>
              <div>
                <ul>
                  <?php foreach ($contact_email as $contact) : ?>
                    <li><?php echo $contact['email_label'] ?> : <a href="mailto:<?php echo $contact['email_address'] ?>" target="_blank" class="underline hover:no-underline"><?php echo $contact['email_address'] ?></a></li>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($opening_hours) : ?>
            <div class="flex gap-x-10">
              <div class="flex-none"><?php echo coact_icon(array('icon' => 'clock', 'group' => 'content', 'size' => '24', 'class' => 'mx-auto')); ?></div>
              <div><?php echo $opening_hours ?></div>
            </div>
          <?php endif; ?>
          <?php if ($traditional_place_name) : ?>
            <div class="flex gap-x-10">
              <div class="flex-none"><?php echo coact_icon(array('icon' => 'marker', 'group' => 'content', 'size' => '24', 'class' => 'mx-auto')); ?></div>
              <div>Traditional place name: <?php echo $traditional_place_name ?></div>
            </div>
          <?php endif; ?>
          <?php if ($transportation) : ?>
            <div class="flex gap-x-10">
              <div class="flex-none"><?php echo coact_icon(array('icon' => 'bus', 'group' => 'content', 'size' => '24', 'class' => 'mx-auto')); ?></div>
              <div><?php echo $transportation ?></div>
            </div>
          <?php endif; ?>
        </div>

        <?php
        $term_obj_list = get_the_terms($post->ID, 'service_types');
        ?>
        <?php if ($term_obj_list) : ?>
          <div class="mt-12">
            <div class="not-prose">
              <h3 class="mb-8 xl:mb-10 text-left text-2xl font-bold">Services we offer :</h3>
            </div>
            <div class="flex flex-col gap-6 mb-6 xl:mb-8">
              <?php foreach ($term_obj_list as $term) : ?>
                <div class="flex gap-x-10">
                  <div class="flex-none"><?php echo coact_icon(array('icon' => 'briefcase', 'group' => 'content', 'size' => '24', 'class' => 'mx-auto')); ?></div>
                  <div><?php echo $term->name ?></div>
                </div>
              <?php endforeach ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($description || $description_2) : ?>
          <div class="prose max-w-none xl:prose-lg text-left mb-6 xl:mb-8 mt-16">
            <?php if ($description) : ?>
              <p><?php echo $description ?></p>
            <?php endif; ?>

            <?php if ($description_2) : ?>
              <?php echo $description_2 ?>
            <?php endif; ?>
          </div>
        <?php endif ?>

      </div>
      <div class="w-full order-2 max-w-[360px] lg:max-w-none lg:w-1/2 xl:w-1/2 relative">
        <?php if ($location) : ?>
          <div class="mb-8 mx-auto xl:mb-12 max-w-full aspect-w-1 aspect-h-1 rounded-md overflow-hidden">
            <div class="w-full h-full bg-slate-100 flex items-center justify-center">
              <div class="acf-map" data-zoom="15">
                <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if ($photo_gallery) : ?>
          <div id="galleryContainer" class="grid gap-2">
            <div id="galleryCarousel" class="f-carousel rounded-md overflow-hidden">
              <?php foreach ($photo_gallery as $photo) : ?>
                <div class="f-carousel__slide aspect-w-6 aspect-h-4" data-thumb-src="<?php echo $photo['sizes']['thumbnail'] ?>" data-fancybox="gallery" data-src="<?php echo $photo['url'] ?>">
                  <img alt="" class="object-cover w-full h-full" data-lazy-src="<?php echo $photo['sizes']['medium_large'] ?>" />
                </div>
              <?php endforeach ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php if ($testimonials) : ?>
  <section class="bg-brand-light-gray">
    <div class="relative container mx-auto pt-12 lg:pt-20 xl:pt-36 pb-12 lg:pb-20 xl:pb-36">
      <div class="absolute top-5 right-0">
        <?php echo coact_svg(array('svg' => 'shape-3', 'group' => 'shapes', 'size' => false, 'class' => 'text-black opacity-5 w-[500px] h-auto')); ?>
      </div>
      <div class="text-center max-w-prose mx-auto mb-14">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-12 text-4xl font-bold">What job seekers say about us</h3>
        </div>
      </div>
      <div class="testimonial-swiper relative pb-20">
        <div class="swiper container max-w-screen-lg mx-auto">
          <div class="swiper-wrapper">
            <?php foreach ($testimonials as $testimony) : ?>
              <div class="swiper-slide text-center">
                <?php if ($testimony['testimonial_text']) {
                  echo '<h3 class="text-brand-purple text-3xl font-bold">' . $testimony['testimonial_text'] . '</h3>';
                } ?>
                <?php if ($testimony['testimonial_source']) {
                  echo '<div class="mt-6 text-lg font-bold">' . $testimony['testimonial_source'] . '</div>';
                } ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="absolute left-0 -bottom-4 right-0">
          <div class="container max-w-screen-3xl mx-auto">
            <div class="swiper-pagination text-center relative [&>.swiper-pagination-bullet]:rounded-full" style="--swiper-pagination-bullet-height:12px;--swiper-pagination-bullet-width:12px;--swiper-pagination-bullet-inactive-color:#E2E2E2;--swiper-pagination-bullet-horizontal-gap:6px;--swiper-theme-color:#B2519E;--swiper-pagination-bullet-inactive-opacity:1;"></div>
          </div>
        </div>
        <div class="swiper-button-prev left-0 lg:left-8 after:content-['prev'] after:text-lg after:lg:text-4xl text-brand-purple font-bold -mt-12 -translate-y-full"></div>
        <div class="swiper-button-next right-0 lg:right-8 after:content-['next'] after:text-lg after:lg:text-4xl text-brand-purple font-bold -mt-12 -translate-y-full"></div>
      </div>
      <script>
        new Swiper('.testimonial-swiper .swiper', {
          slidesPerView: 1,
          spaceBetween: 36,
          loop: jQuery(".testimonial-swiper .swiper-slide").length != 1,
          watchOverflow: true,
          centerInsufficientSlides: true,
          navigation: {
            nextEl: '.testimonial-swiper .swiper-button-next',
            prevEl: '.testimonial-swiper .swiper-button-prev',
          },
          pagination: {
            el: ".testimonial-swiper .swiper-pagination",
            clickable: true,
          },
        });
      </script>
    </div>
  </section>
<?php endif; ?>

<?php if ($partner_stats['numbers']) : ?>
  <section class="bg-brand-light-gray">
    <div class="relative pb-12 lg:pb-20 xl:pb-36">
      <div class="container max-w-screen-xxl mx-auto">

        <div class="grid grid-cols-3 divide-x divide-brand-purple">
          <?php foreach ($partner_stats['numbers'] as $key => $data) : ?>
            <?php
            //$svg_icon = $data['svg_icon'];
            $svg_icon = '';
            if ($key == '0') {
              $svg_icon = 'thumb';
            } elseif ($key == '1') {
              $svg_icon = 'target';
            } elseif ($key == '2') {
              $svg_icon = 'people';
            }
            $image_icon = $data['icon'];
            $formatter = $data['formatter'];
            $number = $data['number'];
            //$color = $data['colour'];
            $color = '';
            $label = $data['label'];
            if ($formatter == 'percentage') {
              $prefix = '';
              $suffix = '%';
            } elseif ($formatter == 'dollar') {
              $prefix = '$';
              $suffix = '';
            } else {
              $prefix = '';
              $suffix = '';
            }

            $color_style = '';
            if ($color) {
              $color_style = 'color: ' . $color . ';';
            }
            ?>
            <div class="text-center py-4 px-8">
              <?php if ($svg_icon || $image_icon) : ?>
                <div class="mb-4 text-brand-purple" style="<?php echo $color_style ?>">
                  <?php if ($svg_icon) {
                    echo coact_icon(array('icon' => $svg_icon, 'group' => 'content', 'size' => '96', 'class' => 'mx-auto'));
                  } else if ($image_icon) {
                    echo '<img src="' . $image_icon['url'] . '" />';
                  } ?>
                </div>
              <?php endif; ?>
              <?php if ($number) : ?>
                <div class="text-6xl font-bold mb-4 text-brand-purple" style="<?php echo $color_style ?>"><?php echo (!empty($prefix)) ? $prefix : ''; ?><?php echo '<span class="counterNumber">' . number_format($number) . '</span>' ?><?php echo (!empty($suffix)) ? $suffix : ''; ?></div>
              <?php endif; ?>
              <?php if ($label) : ?>
                <div class="text-2xl font-medium"><?php echo $label ?></div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($why_coact['headline']) :
  $why_headline = $why_coact['headline'];
  $why_lead_text = $why_coact['lead_text'];
  $why_content = $why_coact['content'];
  $why_image = $why_coact['image'];
?>
  <section class="bg-white">
    <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-36 pb-12 lg:pb-20 xl:pb-36">
      <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">
        <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
          <div class="absolute top-0 -left-1/2 -translate-x-[15%]">
            <?php echo coact_svg(array('svg' => 'shape-2', 'group' => 'shapes', 'size' => false, 'class' => 'text-brand-sea w-[660px] h-auto')); ?>
          </div>
          <div class="mb-8 mx-auto xl:mb-12 max-w-full aspect-w-1 aspect-h-1 rounded-full overflow-hidden">
            <?php if ($why_image) : ?>
              <img src="<?php echo $why_image['url'] ?>" class="rounded-full mx-auto h-full w-full object-center object-cover" alt="">
            <?php else : ?>
              <div class="bg-slate-200 rounded-full h-full w-full"></div>
            <?php endif; ?>
          </div>
        </div>
        <div class="w-full order-2 lg:w-2/3 xl:w-3/5 pt-10">
          <div class="not-prose">
            <?php if ($why_headline) : ?>
              <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold"><?php echo $why_headline ?></h3>
            <?php else : ?>
              <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold">Why <?php echo $site_name ?></h3>
            <?php endif; ?>
          </div>
          <?php if ($why_lead_text) : ?>
            <div class="prose prose-xl max-w-none font-medium mb-6">
              <?php echo $why_lead_text ?>
            </div>
          <?php endif; ?>
          <?php if ($why_content) : ?>
            <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
              <?php echo $why_content ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php
if ($proof_points['checkmark_list']) :
  $count = count($proof_points['checkmark_list']);
?>
  <section class="bg-white">
    <div class="relative container max-w-screen-xxl mx-auto pt-12 pb-12 lg:pb-20 xl:pb-36">
      <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold">The CoAct difference</h3>
      <div class="grid grid-cols-<?php echo $count ?> gap-x-8">
        <?php foreach ($proof_points['checkmark_list'] as $check) : ?>
          <div class="bg-white shadow-lg rounded p-12 flex flex-col items-center">
            <svg class="text-brand-sea" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="71.028" height="52.179" viewBox="0 0 71.028 52.179">
              <path d="M71.028,4.3a7.293,7.293,0,0,1-1.956,2.707Q47.165,28.894,25.28,50.8a3.617,3.617,0,0,1-3.93,1.184,4.556,4.556,0,0,1-1.664-1.07C13.521,44.786,7.4,38.618,1.227,32.5A3.586,3.586,0,0,1,2.7,26.306a3.4,3.4,0,0,1,2.951.6,8.191,8.191,0,0,1,.821.744q7.678,7.671,15.35,15.348c.179.179.339.378.672.752a5.8,5.8,0,0,1,.556-.8Q43.809,22.17,64.576,1.4A3.757,3.757,0,0,1,68.3.107a3.522,3.522,0,0,1,2.554,2.318c.047.121.116.234.174.35Z" transform="translate(0 0)" fill="currentColor" />
            </svg>
            <div class="text-center text-lg mt-8"><?php echo $check['point'] ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<!-- <section class="bg-white">
  <div class="relative container max-w-screen-xxl mx-auto pt-12 pb-12 lg:p5-20 lg:pb-20 xl:pt-36 xl:pb-36">
    <div class="flex gap-x-20">
      <div class="w-1/2">
        <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold">We specialise in the following</h3>
        <div class="prose max-w-none xl:prose-lg text-left mt-16">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ullamcorper eu, nunc adipiscing risus sit tristique eget lacinia. Lacus, velit eget molestie quis tellus neque, vel, consectetur.</p>
        </div>

      </div>
      <div class="w-1/2">
        <div class="grid grid-cols-<?php echo $count ?> gap-x-8">
          <?php foreach ($proof_points['checkmark_list'] as $check) : ?>
            <div class="bg-white shadow-lg rounded p-12 flex flex-col items-center">
              <svg class="text-brand-sea" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="71.028" height="52.179" viewBox="0 0 71.028 52.179">
                <path d="M71.028,4.3a7.293,7.293,0,0,1-1.956,2.707Q47.165,28.894,25.28,50.8a3.617,3.617,0,0,1-3.93,1.184,4.556,4.556,0,0,1-1.664-1.07C13.521,44.786,7.4,38.618,1.227,32.5A3.586,3.586,0,0,1,2.7,26.306a3.4,3.4,0,0,1,2.951.6,8.191,8.191,0,0,1,.821.744q7.678,7.671,15.35,15.348c.179.179.339.378.672.752a5.8,5.8,0,0,1,.556-.8Q43.809,22.17,64.576,1.4A3.757,3.757,0,0,1,68.3.107a3.522,3.522,0,0,1,2.554,2.318c.047.121.116.234.174.35Z" transform="translate(0 0)" fill="currentColor" />
              </svg>
              <div class="text-center text-lg mt-8"><?php echo $check['point'] ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

  </div>
</section> -->

<?php
$term_obj_list = get_the_terms($post->ID, 'serviced_areas');
if ($term_obj_list) :
  $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
?>
  <section class="bg-brand-light-gray">
    <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-36 pb-12 lg:pb-20 xl:pb-36">
      <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold">Areas we service:</h3>
      <div class="flex flex-col gap-10">
        <div class="flex gap-x-10">
          <div class="flex-none"><?php echo coact_icon(array('icon' => 'marker', 'group' => 'utilities', 'size' => '24', 'class' => 'mx-auto')); ?></div>
          <div>
            <?php echo $terms_string ?>
          </div>
        </div>
        <!-- <div class="flex gap-x-10">
        <div class="flex-none"><?php echo coact_icon(array('icon' => 'marker', 'group' => 'utilities', 'size' => '24', 'class' => 'mx-auto')); ?></div>
        <div>
          <ul>
            <?php foreach ($contact_numbers as $contact) : ?>
              <li><?php echo $contact['phone_label'] ?> : <?php echo $contact['phone_number'] ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      </div> -->
      </div>
    </div>
  </section>
<?php endif; ?>

<?php
$theposts = get_posts(array(
  'posts_per_page' => 3,
  'category'       => '1460' // Real Stories Category ID
));
$posts_title = 'Real Stories';
$posts_description = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>';
$view_all = '#';
if ($theposts) :
?>
  <section>
    <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
      <div class="relative z-10">
        <div>
          <?php if ($posts_title) : ?>
            <div class="not-prose">
              <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold">Real Stories</h3>
            </div>
          <?php endif; ?>
          <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
            <div class="w-full lg:w-2/3">
              <?php if ($posts_description) : ?>
                <div class="prose xl:prose-lg mr-auto text-left">
                  <?php echo $posts_description ?>
                </div>
              <?php endif; ?>
            </div>
            <div class="w-full lg:w-1/3 text-right">
              <a href="<?php echo $view_all ?>" class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-purple text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">View all</a>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-3 gap-8">
          <?php
          foreach ($theposts as $post) :
            $post_id = $post->ID;
            $title = $post->post_title;
            $link = get_the_permalink($post_id);
            $excerpt = get_the_excerpt($post_id);
            $image = get_the_post_thumbnail_url($post_id);
          ?>
            <div class="relative block">
              <a href="<?php echo $link ?>" class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
                <?php if ($image) : ?>
                  <img src="<?php echo $image ?>" alt="" class="object-cover">
                <?php else : ?>
                  <div class="bg-slate-100 h-full w-full"></div>
                <?php endif; ?>
              </a>
              <h4 class="text-xl font-semibold my-4"><a href="<?php echo $link ?>" class="hover:underline"><?php echo $title ?></a></h4>
              <div><?php echo $excerpt ?></div>
              <a href="<?php echo $link ?>" class="text-brand-purple underline font-medium inline-block mt-4">LEARN MORE</a>
            </div>
          <?php
          endforeach;
          wp_reset_postdata();
          ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<section id="enquiry-form" class="bg-brand-light-gray">
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="relative container max-w-screen-md mx-auto z-10">
      <div class="mb-8">
        <div class="not-prose">
          <h3 class="mb-4 xl:mb-8 text-center text-4xl font-bold">Enquire Now</h3>
        </div>
        <div class="prose max-w-prose text-center">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</div>
      </div>
      <div>
        <?php echo FrmFormsController::get_form_shortcode(array('id' => 2)); ?>
      </div>
    </div>
  </div>
</section>