<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/

$section_id = $section_id ? 'id="' . $section_id . '"' : '';

$testimonials = get_sub_field('testimonials');
$intro = $testimonials['intro'];
$headline = $intro['headline'];
$description = $intro['description'];
$choose_testimonial = $testimonials['choose_testimonial'];
$testimonials_id = uniqid('testimonials-');
?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <?php get_template_part('template-parts/layouts/background_ornament', '', array('shape' => $ornament_shape, 'style' => $ornament_style, 'class' => 'max-w-screen-4xl')); ?>
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="container mx-auto animation-wrapper">
      <div class="relative mx-auto z-[1] <?php echo $entrance_animation_class ?>">
        <div class="text-center max-w-prose mx-auto mb-14">
          <?php if ($headline) : ?>
            <div class="not-prose">
              <h3 class="mb-8 xl:mb-12 text-4xl font-bold"><?php echo $headline ?></h3>
            </div>
          <?php endif; ?>
          <?php if ($description) : ?>
            <div class="mt-6 text-lg font-medium"><?php echo $description ?></div>
          <?php endif; ?>
        </div>
        <div id="<?php echo $testimonials_id ?>" class="testimonial-swiper relative pb-20">
          <div class="swiper container max-w-screen-lg mx-auto">
            <div class="swiper-wrapper">
              <?php foreach ($choose_testimonial as $testimony) : ?>
                <?php
                $testimonial_title = get_the_title($testimony->ID);
                $testimonial_text = get_the_content('null', false, $testimony->ID);
                ?>
                <div class="swiper-slide text-center">
                  <?php if ($testimonial_text) {
                    echo '<div class="text-brand-purple text-3xl font-bold">' . $testimonial_text . '</div>';
                  } ?>
                  <?php if ($testimonial_title) {
                    echo '<div class="mt-6 text-lg font-bold">' . $testimonial_title . '</div>';
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
          new Swiper('#<?php echo $testimonials_id ?> .swiper', {
            slidesPerView: 1,
            spaceBetween: 36,
            loop: jQuery("#<?php echo $testimonials_id ?> .swiper-slide").length != 1,
            watchOverflow: true,
            centerInsufficientSlides: true,
            navigation: {
              nextEl: '#<?php echo $testimonials_id ?> .swiper-button-next',
              prevEl: '#<?php echo $testimonials_id ?> .swiper-button-prev',
            },
            pagination: {
              el: "#<?php echo $testimonials_id ?> .swiper-pagination",
              clickable: true,
            },
          });
        </script>
      </div>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>