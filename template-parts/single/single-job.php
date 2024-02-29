<?php

$enable_page_header = false;
$text_color = '#000000';
$text_background_color = 'rgba(242,107,73,0.93)';
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

?>
<?php if ($enable_page_header) : ?>
  <section class="bg-gradient-to-b from-brand-light-gray from-90% via-white via-90% to-white">
    <div class="max-w-screen-5xl px-4 mx-auto 4xl:px-8">
      <div class="aspect-w-16 aspect-h-5 rounded-3xl overflow-hidden">
        <div class="bg-zinc-300 w-full h-full">
          <?php if ($background_image) : ?>
            <img class="object-cover w-full h-full <?php echo $bg_image_class ?>" src="<?php echo $background_image; ?>" alt="">
          <?php endif; ?>
          <div class="absolute top-0 left-0 w-[1300px] h-[1300px] rounded-full bg-brand-orange bg-opacity-80 -translate-y-1/4 -translate-x-1/4" style="<?php echo $text_bg_style ?>"></div>
          <div class="absolute inset-0 flex items-center p-12">
            <div class="container max-w-screen-xxl mx-auto">
              <div class="max-w-lg font-montserrat" style="<?php echo $text_style ?>">
                <?php if ($enable_breadcrumbs) : ?>
                  <?php
                  if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<div class="breadcrumbs mb-10 text-white">', '</div>');
                  }
                  ?>
                <?php endif; ?>
                <?php if ($title) : ?>
                  <h2 class="text-4xl text-white font-bold mb-4"><?php echo $title ?></h2>
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
        <?php if (!$enable_page_header && $enable_breadcrumbs) : ?>
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div class="breadcrumbs mb-10">', '</div>');
          }
          ?>
        <?php endif; ?>
        <div class="not-prose">
          <h2 class="mb-8 xl:mb-12 text-left text-3xl xl:text-4xl font-bold"><?php echo get_the_title() ?></h2>
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
          <?php the_content() ?>
          <?php
          $job_settings = get_field('job_settings');
          $url = isset($job_settings['external_link']['url']) ? $job_settings['external_link']['url'] : '';
          $title = isset($job_settings['external_link']['title']) ? $job_settings['external_link']['title'] : 'Apply';
          $target = isset($job_settings['external_link']['target']) ? $job_settings['external_link']['target'] : '_self';
          if ($url) {
            echo '<div class="mt-6 xl:mt-8">';
            echo '<a href="' . $url . '" target="' . $target . '" class="inline-block rounded-full font-poppins font-semibold px-6 py-2 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-orange text-white border border-transparent no-underline shadow-md hover:shadow-lg transition-all duration-200">' . $title . '</a>';
            echo '</div>';
          }
          ?>
        </div>
      </div>
      <div class="w-full order-2 lg:w-1/3 xl:w-1/3 pt-4">
        <div class="mb-12">
          <h4 class="text-2xl font-semibold text-brand-orange mb-4">Other jobs</h4>
          <?php
          $current_post_id = get_the_ID();

          $args = array(
            'post_type'      => 'job',
            'posts_per_page' => 10,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post__not_in'   => array($current_post_id),
          );

          $query = new WP_Query($args);
          if ($query->have_posts()) {
            while ($query->have_posts()) {
              $query->the_post();
          ?>
              <h5 class="border-b border-solid border-slate-300 py-3 text-lg"><a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a></h5>
          <?php
            }
            wp_reset_postdata();
          } else {
            echo 'No posts found.';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>