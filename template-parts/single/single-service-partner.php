<?php

$breadcrumbs = ($args['breadcrumbs'] === true);
$enable_page_header = true;
$button = true;

$site_name = get_field('site_name');
$description = get_field('description');
$hero_image = get_field('hero_image');
$logo = get_field('logo');
$description_2 = get_field('description_2');
$proof_points = get_field('proof_points');
$location_detail = get_field('location_detail');
$location_background_colour = $location_detail['location_background_colour'];
$opening_hours = $location_detail['opening_hours'];
$sup_header = $location_detail['sup_header'];
$location_site_name = $location_detail['location_site_name'];
$location = $location_detail['location']; // Map
$contact_numbers = $location_detail['contact_numbers']; // Repeater
$contact_email = $location_detail['contact_email']; // Repeater
$testimonials = get_field('testimonials');
$employers_logos = get_field('employers_logos');
$staff_details = get_field('staff_details');
$partner_stats = get_field('partner_stats');
$related_tiles = get_field('related_tiles');
$specialise_links = get_field('specialise_links');
$tiles_one = get_field('tiles_one');
$tiles_two = get_field('tiles_two');
$related_content = get_field('related_content');

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
            <h3 class="mb-8 xl:mb-12 text-left text-2xl font-bold"><?php echo $site_name ?></h3>
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
              <div class="flex-none"><?php echo coact_icon(array('icon' => 'marker', 'group' => 'utilities', 'size' => '24', 'class' => 'mx-auto')); ?></div>
              <div>
                <ul>
                  <?php foreach ($contact_numbers as $contact) : ?>
                    <li><?php echo $contact['phone_label'] ?> : <?php echo $contact['phone_number'] ?></li>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($contact_email) : ?>
            <div class="flex gap-x-10">
              <div class="flex-none"><?php echo coact_icon(array('icon' => 'marker', 'group' => 'utilities', 'size' => '24', 'class' => 'mx-auto')); ?></div>
              <div>
                <ul>
                  <?php foreach ($contact_email as $contact) : ?>
                    <li><?php echo $contact['email_label'] ?> : <?php echo $contact['email_address'] ?></li>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
          <?php endif; ?>
          <div class="flex gap-x-10">
            <div class="flex-none"><?php echo coact_icon(array('icon' => 'marker', 'group' => 'utilities', 'size' => '24', 'class' => 'mx-auto')); ?></div>
            <div><?php echo $opening_hours ?></div>
          </div>
          <div class="flex gap-x-10">
            <div class="flex-none"><?php echo coact_icon(array('icon' => 'marker', 'group' => 'utilities', 'size' => '24', 'class' => 'mx-auto')); ?></div>
            <div>Traditional place name: <?php echo $location_site_name ?></div>
          </div>
        </div>

        <?php
        $term_obj_list = get_the_terms($post->ID, 'service_types');
        ?>
        <?php if ($term_obj_list) : ?>
          <div class="mt-12">
            <div class="not-prose">
              <h3 class="mb-8 xl:mb-12 text-left text-2xl font-bold">Services we offer :</h3>
            </div>
            <div class="flex flex-col gap-6 mb-6 xl:mb-8">
              <?php foreach ($term_obj_list as $term) : ?>
                <div class="flex gap-x-10">
                  <div class="flex-none"><?php echo coact_icon(array('icon' => 'marker', 'group' => 'utilities', 'size' => '24', 'class' => 'mx-auto')); ?></div>
                  <div><?php echo $term->name ?></div>
                </div>
              <?php endforeach ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($description) : ?>
          <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8 mt-12">
            <?php echo $description ?>
          </div>
        <?php endif; ?>

      </div>
      <div class="w-full order-2 max-w-[360px] lg:max-w-none lg:w-1/2 xl:w-1/2 relative">
        <div class="mb-8 mx-auto xl:mb-12 max-w-full aspect-w-1 aspect-h-1 rounded-md overflow-hidden">
          <div class="w-full h-full bg-slate-100 flex items-center justify-center">MAP</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-brand-light-gray">
  <div class="relative pt-12 lg:pt-20 xl:pt-36 pb-12 lg:pb-20 xl:pb-36">
    <div class="container mx-auto">
      <div class="max-w-screen-lg text-center mx-auto relative z-[1]">
        <div class="text-center max-w-prose mx-auto mb-14">
          <div class="not-prose">
            <h3 class="mb-8 xl:mb-12 text-4xl font-bold">What job seekers say about us</h3>
          </div>
        </div>
        <h3 class="text-brand-purple text-3xl font-bold">Going into CoAct I wasn’t sure what to expect but with continued support I’ve found myself setting and achieving goals while also meeting my requirements. I think what sets CoAct apart from regular job providers is the continued engagement, encouragement and empathy. They didn’t just do it for me; they helped me to help myself. </h3>
        <div class="mt-6 text-lg font-bold">Larissa, Job Seeker</div>
      </div>
    </div>
  </div>
</section>

<section class="bg-brand-light-gray">
  <div class="relative pb-12 lg:pb-20 xl:pb-36">
    <div class="container max-w-screen-xxl mx-auto">

      <div class="grid grid-cols-3 divide-x divide-brand-purple">
        <?php if ($partner_stats['numbers']) : ?>
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
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<!-- Image Left + Text -->
<section class="bg-white">
  <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-36 pb-12 lg:pb-20 xl:pb-36">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">
      <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
        <div class="absolute top-0 -left-1/2 -translate-x-[15%]">
          <?php echo coact_svg(array('svg' => 'shape-2', 'group' => 'shapes', 'size' => false, 'class' => 'text-brand-sea w-[660px] h-auto')); ?>
        </div>
        <div class="mb-8 mx-auto xl:mb-12 max-w-full aspect-w-1 aspect-h-1 rounded-full overflow-hidden"><img width="989" height="659" src="<?php echo $background_image ?>" class="rounded-full mx-auto h-full w-full object-center object-cover" alt=""></div>
      </div>
      <div class="w-full order-2 lg:w-2/3 xl:w-3/5 pt-10">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold">Why <?php echo $site_name ?></h3>
        </div>
        <div class="prose prose-xl max-w-none font-medium mb-6">
          With a network of Service Partners across the country, we work together to deliver you the best possible outcome – the right job sooner.
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>
    </div>
  </div>
</section>

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
            <svg id="Group_2402" data-name="Group 2402" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="71.028" height="52.179" viewBox="0 0 71.028 52.179">
              <defs>
                <clipPath id="clip-path">
                  <rect id="Rectangle_1201" data-name="Rectangle 1201" width="71.028" height="52.179" fill="#45c2bf" />
                </clipPath>
              </defs>
              <g id="Group_2401" data-name="Group 2401" clip-path="url(#clip-path)">
                <path id="Path_1683" data-name="Path 1683" d="M71.028,4.3a7.293,7.293,0,0,1-1.956,2.707Q47.165,28.894,25.28,50.8a3.617,3.617,0,0,1-3.93,1.184,4.556,4.556,0,0,1-1.664-1.07C13.521,44.786,7.4,38.618,1.227,32.5A3.586,3.586,0,0,1,2.7,26.306a3.4,3.4,0,0,1,2.951.6,8.191,8.191,0,0,1,.821.744q7.678,7.671,15.35,15.348c.179.179.339.378.672.752a5.8,5.8,0,0,1,.556-.8Q43.809,22.17,64.576,1.4A3.757,3.757,0,0,1,68.3.107a3.522,3.522,0,0,1,2.554,2.318c.047.121.116.234.174.35Z" transform="translate(0 0)" fill="#45c2bf" />
              </g>
            </svg>
            <div class="text-center text-lg mt-8"><?php echo $check['point'] ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<section class="bg-brand-light-gray">
  <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-36 pb-12 lg:pb-20 xl:pb-36">
    <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold">Areas we service:</h3>
    <div class="flex flex-col gap-10">
      <div class="flex gap-x-10">
        <div class="flex-none"><?php echo coact_icon(array('icon' => 'marker', 'group' => 'utilities', 'size' => '24', 'class' => 'mx-auto')); ?></div>
        <div>
          <?php
          $term_obj_list = get_the_terms($post->ID, 'serviced_areas');
          $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
          echo $terms_string
          ?>
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

<!-- Card Stories -->
<section>
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="relative z-10">
      <div>
        <div class="not-prose">
          <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold">Real Stories</h3>
        </div>
        <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
          <div class="w-full lg:w-2/3">
            <div class="prose xl:prose-lg mr-auto text-left">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
            </div>
          </div>
          <div class="w-full lg:w-1/3 text-right">
            <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-purple text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">View all</a>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-8">
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=22" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          <div>Lorem ipsum dolor sit amet, ipsum labitur lucilius mel id, ad has appareat.</div>
          <a href="#" class="text-brand-purple underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=23" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          <div>Lorem ipsum dolor sit amet, ipsum labitur lucilius mel id, ad has appareat.</div>
          <a href="#" class="text-brand-purple underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=25" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          <div>Lorem ipsum dolor sit amet, ipsum labitur lucilius mel id, ad has appareat.</div>
          <a href="#" class="text-brand-purple underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Card Stories -->
<section id="enquiry-form">
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="relative z-10">
      <div>
        <div class="not-prose">
          <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold">Enquiry Form</h3>
        </div>
      </div>
    </div>
  </div>
</section>