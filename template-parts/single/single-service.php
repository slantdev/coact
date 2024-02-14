<?php

$enable_page_header = true;

if ($enable_page_header) :
  $text_color = '#000000';
  $text_background_color = 'rgba(69,194,191,0.93)';
  $background_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
  $background_position = 'center';
  $bg_image_class = '';
  if ($background_position) {
    $bg_image_class = ' object-' . $background_position;
  }

  $title = get_the_title();

  $text_style = $text_color ? 'color: ' . $text_color . ';' : '';

  $text_bg_style = $text_background_color ? 'background-color: ' . $text_background_color . ';' : '';

  $enable_breadcrumbs = true;

  $service_images = get_field('service_images');
  $page_banner_image = $service_images['page_banner_image'];
  if ($page_banner_image) {
    $background_image = $page_banner_image['url'];
  }

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
                <?php if ($description) : ?>
                  <div class="text-xl text-black font-medium mt-4">
                    <?php echo $description ?>
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
  <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">
      <div class="w-full order-1 lg:w-2/3 xl:w-2/3 pt-4">
        <div class="not-prose">
          <h2 class="mb-8 xl:mb-12 text-left text-3xl font-bold"><?php echo get_the_title() ?></h2>
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
          <?php the_content() ?>
        </div>
      </div>
    </div>
  </div>
</section>