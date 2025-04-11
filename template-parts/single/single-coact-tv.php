<?php

$enable_page_header = true;
$id = get_the_ID();
$video_uri = get_post_meta($id, 'video_embed', true);
$image = get_video_thumbnail_uri($video_uri);
$thumb = get_the_post_thumbnail_url($id, 'full');
$text_color = '#000000';
$text_background_color = 'rgba(69,194,191,0.93)';
$background_image = '';
if ($image) {
  $background_image = $image;
} else if ($thumb) {
  $background_image = $thumb;
}
$background_position = 'center';
$bg_image_class = '';
if ($background_position) {
  $bg_image_class = ' object-' . $background_position;
}
$title = get_the_title();
$text_style = $text_color ? 'color: ' . $text_color . ';' : '';
$text_bg_style = $text_background_color ? 'background-color: ' . $text_background_color . ';' : '';
$enable_breadcrumbs = true;
$video_embed = get_field('video_embed');
$description = get_field('description');

?>

<section class="bg-gradient-to-b from-brand-light-gray from-90% via-white via-90% to-white">
  <div class="max-w-screen-5xl px-4 mx-auto 4xl:px-8">
    <div class="relative rounded-lg xl:aspect-w-16 xl:aspect-h-6 xl:rounded-3xl overflow-hidden">
      <div class="bg-zinc-300 w-full h-full">
        <?php if ($background_image) : ?>
          <div class="absolute inset-0">
            <img class="object-cover w-full h-full <?php echo $bg_image_class ?>" src="<?php echo $background_image ?>" alt="">
          </div>
        <?php endif; ?>
        <div class="absolute top-0 left-0 w-[1300px] h-[1300px] rounded-full bg-brand-sea bg-opacity-80 -translate-y-1/4 -translate-x-1/4" style="<?php echo $text_bg_style ?>"></div>
        <div class="relative z-10 px-4 py-8 xl:absolute xl:inset-0 xl:flex xl:items-center xl:p-12">
          <div class="container max-w-screen-xxl mx-auto">
            <div class="max-w-lg font-montserrat" style="<?php echo $text_style ?>">
              <?php if ($enable_breadcrumbs) : ?>
                <?php
                if (function_exists('yoast_breadcrumb')) {
                  yoast_breadcrumb('<div class="breadcrumbs text-sm lg:text-base mb-8 xl:mb-16">', '</div>');
                }
                ?>
              <?php endif; ?>
              <?php if ($title) : ?>
                <h1 class="text-xl xl:text-5xl font-bold mb-4"><?php echo $title ?></h1>
              <?php endif; ?>
              <?php
              $post_date = get_the_date('d F Y');
              echo '<div class="text-base lg:text-lg text-black font-medium mt-8">' . $post_date . '</div>';
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-white">
  <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">
      <div class="w-full order-1 lg:w-2/3 xl:w-2/3">
        <?php if ($video_embed) {
          echo '<div class="aspect-w-16 aspect-h-9 mb-8 xl:mb-12 rounded-xl overflow-hidden">';
          echo $video_embed;
          echo '</div>';
        } ?>
        <div class="not-prose">
          <h2 class="mb-6 xl:mb-6 text-left text-3xl font-bold"><?php echo get_the_title() ?></h2>
        </div>
        <?php if ($description) : ?>
          <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
            <?php echo $description ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>