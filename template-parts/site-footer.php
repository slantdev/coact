<?php

$site_footer = get_field('site_footer', 'option');
$footer_top = $site_footer['footer_top'];
$columns = $footer_top['columns'];
$column_count = '3';
if ($columns) {
  $column_count = count($columns);
}
$about = $site_footer['about'];
$address = $about['address'];
$phone = $about['phone'];
$email = $about['email'];
$logo = $about['logo'];
$popular_content = $site_footer['popular_content'];
$popular_heading = $popular_content['heading'];
$popular_links = $popular_content['links'];
$connect = $site_footer['connect'];
$connect_heading = $connect['heading'];
$connect_links = $connect['links'];
$quick_links = $site_footer['quick_links'];
$quick_links_heading = $quick_links['heading'];
$quick_links_links = $quick_links['links'];
$copyright_info = $site_footer['copyright_info'];
$copyright_site_name = $copyright_info['copyright_site_name'];
$copyright_links = $copyright_info['copyright_links'];

$subscribe = get_field('subscribe', 'option')['subscribe'];
$subscribe_heading = $subscribe['heading'];
$subscribe_desciption = $subscribe['description'];
$subscribe_form_shortcode = $subscribe['form_shortcode'];
$subscribe_image = $subscribe['image'];
$subscribe_colors = $subscribe['subscribe_colors'];
$subscribe_background_color = $subscribe_colors['background_color'];
$subscribe_text_color = $subscribe_colors['text_color'];
$subscribe_style = '';
if ($subscribe_background_color) {
  $subscribe_style .= 'background-color: ' . $subscribe_background_color . ';';
}
if ($subscribe_text_color) {
  $subscribe_style .= 'color: ' . $subscribe_text_color . ';';
}

$term_id = '';
if (is_archive()) {
  $term_id = get_queried_object()->term_id;
}
if ($term_id) {
  $the_id = 'term_' . $term_id;
} else {
  $the_id = get_the_ID();
}
//echo $the_id;
$disable_subscribe = get_field('disable_subscribe', $the_id);

?>

<?php if ($subscribe && !$disable_subscribe) : ?>
  <section class="bg-brand-purple" style="<?php echo $subscribe_style ?>">
    <div class="relative container max-w-screen-xxl mx-auto py-12">
      <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24 items-center">
        <div class="w-full order-2 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-1/2 relative">
          <?php if ($subscribe_image) : ?>
            <div class="mb-8 mx-auto xl:mb-0 max-w-full"><img src="<?php echo $subscribe_image['url'] ?>" class="" alt="<?php echo $subscribe_image['alt'] ?>"></div>
          <?php endif ?>
        </div>
        <div class="w-full order-1 lg:w-2/3 xl:w-1/2 pt-10">
          <?php if ($subscribe_heading) : ?>
            <div class="not-prose">
              <h3 class="mb-8 xl:mb-8 text-left text-[48px] leading-tight font-bold text-white"><?php echo $subscribe_heading ?></h3>
            </div>
          <?php endif ?>
          <?php if ($subscribe_form_shortcode) : ?>
            <?php echo do_shortcode($subscribe_form_shortcode) ?>
          <?php else : ?>
            <div class="my-6">
              <div class="grid grid-cols-2 gap-3">
                <input type="text" placeholder="First name*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
                <input type="text" placeholder="Last name*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
                <input type="text" placeholder="Email*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
                <input type="text" placeholder="Postcode*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
              </div>
            </div>
          <?php endif ?>
          <?php if ($subscribe_desciption) : ?>
            <div class="prose max-w-none leading-snug mr-auto text-left mb-6 xl:mb-6 text-white">
              <?php echo $subscribe_desciption ?>
            </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<section class="bg-brand-light-gray">
  <div class="relative container max-w-screen-xxl mx-auto py-16">
    <?php if ($columns) : ?>
      <div class="grid grid-cols-<?php echo $column_count ?> gap-12">
        <?php foreach ($columns as $column) : ?>
          <div>
            <?php
            $flag_images = $column['flag_images'];
            $title = $column['title'];
            $description = $column['description'];
            if ($flag_images) :
              echo '<div class="flex gap-x-4 mb-6">';
              foreach ($flag_images as $key => $flag) {
                echo '<img src="' . $flag['url'] . '" alt="' . $flag['alt'] . '">';
              }
              echo '</div>';
            endif;
            if ($title) {
              echo '<h4 class="font-bold font-poppins my-3">' . $title . '</h4>';
            }
            if ($description) {
              echo '<div class="text-sm">' . $description . '</div>';
            }
            ?>
          </div>
        <?php endforeach ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<div class="bg-brand-black py-28">
  <div class="mx-auto max-w-screen-4xl px-4 relative">
    <div class="flex gap-x-24">
      <div class="w-1/4">
        <a href="<?php echo site_url() ?>"><img src="<?php echo coact_asset('images/logo/logo-coact-white.svg') ?>" alt="CoAct" class="h-[128px] w-auto"></a>
        <div class="text-white mt-6">
          <h5 class="text-lg font-bold">CoAct Head Office</h5>
          <div class="text-sm">
            level 1/416 Logan Rd, Greenslopes QLD 4120<br />
            <strong>Freecall:</strong> 1800 860 770 &nbsp;&nbsp;<span class="text-brand-sea">|</span>&nbsp;&nbsp; <strong>Email:</strong> mail@coact.org.au
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-x-16">
        <div class="px-6 relative">
          <div class="h-28 w-px bg-brand-sea absolute top-0 left-0"></div>
          <?php if ($popular_heading) : ?>
            <h5 class="text-brand-sea font-bold text-2xl mb-4"><?php echo $popular_heading ?></h5>
          <?php endif; ?>
          <?php if ($popular_links) : ?>
            <ul class="flex flex-col gap-3 text-white">
              <?php foreach ($popular_links as $link) : ?>
                <li class="">
                  <?php if ($link['link']) : ?>
                    <div><a href="<?php echo $link['link']['url'] ?>" class="hover:underline"><?php echo $link['link']['title'] ?></a></div>
                  <?php endif; ?>
                </li>
              <?php endforeach ?>
            </ul>
          <?php endif; ?>
        </div>
        <div class="px-6 relative">
          <div class="h-28 w-px bg-brand-sea absolute top-0 left-0"></div>
          <?php if ($connect_heading) : ?>
            <h5 class="text-brand-sea font-bold text-2xl mb-4"><?php echo $connect_heading ?></h5>
          <?php endif; ?>
          <?php if ($connect_links) : ?>
            <ul class="flex flex-col gap-3 text-white">
              <?php foreach ($connect_links as $link) : ?>
                <li class="flex gap-x-4">
                  <?php if ($link['icon']) : ?>
                    <div class="flex-none"><?php echo coact_icon(array('icon' => $link['icon'], 'group' => 'content', 'size' => '24', 'class' => 'mx-auto')); ?></div>
                  <?php endif; ?>
                  <?php if ($link['link']) : ?>
                    <div><a href="<?php echo $link['link']['url'] ?>" class="hover:underline"><?php echo $link['link']['title'] ?></a></div>
                  <?php endif; ?>
                </li>
              <?php endforeach ?>
            </ul>
          <?php endif; ?>
        </div>
        <div class="px-6 relative">
          <div class="h-28 w-px bg-brand-sea absolute top-0 left-0"></div>
          <?php if ($quick_links_heading) : ?>
            <h5 class="text-brand-sea font-bold text-2xl mb-4"><?php echo $quick_links_heading ?></h5>
          <?php endif; ?>
          <?php if ($quick_links_links) : ?>
            <ul class="flex flex-col gap-3 text-white">
              <?php foreach ($quick_links_links as $link) : ?>
                <li class="">
                  <?php if ($link['link']) : ?>
                    <div><a href="<?php echo $link['link']['url'] ?>" class="hover:underline"><?php echo $link['link']['title'] ?></a></div>
                  <?php endif; ?>
                </li>
              <?php endforeach ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="bg-brand-sea">
  <div class="mx-auto max-w-screen-4xl px-4 py-4 relative">
    <div class="flex justify-between text-white">
      <?php if ($copyright_site_name) : ?>
        <div class="font-bold">&copy; <?php echo date('Y') ?> <?php echo $copyright_site_name ?></div>
      <?php endif ?>
      <?php if ($copyright_site_name) : ?>
        <div>
          <?php foreach ($copyright_links as $link) : ?>
            <a href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>" class="hover:underline font-semibold"><?php echo $link['link']['title'] ?></a>
          <?php endforeach ?>
        </div>
      <?php endif ?>
    </div>
  </div>
</div>

</footer>