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
$dynamic_custom = $testimonials['dynamic_custom'];
$choose_testimonial = $testimonials['choose_testimonial'];
$select_testimonial_categories = $testimonials['select_testimonial_categories'];
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
              <h3 class="mb-6 xl:mb-12 text-2xl xl:text-4xl font-bold"><?php echo $headline ?></h3>
            </div>
          <?php endif; ?>
          <?php if ($description) : ?>
            <div class="mt-6 text-base xl:text-lg font-medium"><?php echo $description ?></div>
          <?php endif; ?>
        </div>
        <?php if ($dynamic_custom == 'custom' && $choose_testimonial) : ?>
          <div id="<?php echo $testimonials_id ?>" class="testimonial-swiper relative pb-16 xl:pb-20">
            <div class="swiper container max-w-screen-lg mx-auto">
              <div class="swiper-wrapper">
                <?php foreach ($choose_testimonial as $testimony) : ?>
                  <?php
                  $testimonial_title = get_the_title($testimony->ID);
                  $testimonial_text = get_the_content('null', false, $testimony->ID);
                  ?>
                  <div class="swiper-slide text-center">
                    <?php if ($testimonial_text) {
                      echo '<div class="text-brand-purple text-lg xl:text-3xl font-bold" style="color: var(--section-link-color)">' . $testimonial_text . '</div>';
                    } ?>
                    <?php if ($testimonial_title) {
                      echo '<div class="mt-6 text-base xl:text-lg font-bold">' . $testimonial_title . '</div>';
                    } ?>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="absolute left-0 -bottom-4 right-0">
              <div class="container max-w-screen-3xl mx-auto">
                <div class="swiper-pagination text-center relative [&>.swiper-pagination-bullet]:rounded-full" style="--swiper-pagination-bullet-height:12px;--swiper-pagination-bullet-width:12px;--swiper-pagination-bullet-inactive-color:#E2E2E2;--swiper-pagination-bullet-horizontal-gap:6px;--swiper-theme-color:var(--section-link-color);--swiper-pagination-bullet-inactive-opacity:1;"></div>
              </div>
            </div>
            <div class="swiper-button-prev -left-4 lg:left-8 after:content-['prev'] after:text-lg after:lg:text-4xl text-brand-purple font-bold -mt-12 -translate-y-full"></div>
            <div class="swiper-button-next -right-4 lg:right-8 after:content-['next'] after:text-lg after:lg:text-4xl text-brand-purple font-bold -mt-12 -translate-y-full"></div>
          </div>
        <?php endif; ?>
        <?php if ($dynamic_custom == 'dynamic' && $select_testimonial_categories) : ?>
          <div id="<?php echo $testimonials_id ?>" class="testimonial-swiper relative pb-20">
            <div class="swiper container max-w-screen-lg mx-auto">
              <div class="swiper-wrapper">

                <?php
                $term_ids = $select_testimonial_categories;

                $args = array(
                  'post_type'      => 'testimonial',
                  'posts_per_page' => -1,
                  'orderby'        => 'date',
                  'order'          => 'DESC',
                  'tax_query'      => array(
                    array(
                      'taxonomy' => 'testimonial-category',
                      'field'    => 'term_id',
                      'terms'    => $term_ids,
                      'operator' => 'IN',
                    ),
                  ),
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                  while ($query->have_posts()) {
                    $query->the_post();
                ?>
                    <?php
                    $testimonial_id = get_the_ID();
                    $testimonial_title = get_the_title($testimonial_id);
                    $testimonial_text = get_the_content('null', false, $testimonial_id);
                    ?>
                    <div class="swiper-slide text-center">
                      <?php if ($testimonial_text) {
                        echo '<div class="text-brand-purple text-lg xl:text-3xl font-bold" style="color: var(--section-link-color)">' . $testimonial_text . '</div>';
                      } ?>
                      <?php if ($testimonial_title) {
                        echo '<div class="mt-6 text-base xl:text-lg font-bold">' . $testimonial_title . '</div>';
                      } ?>
                    </div>
                <?php
                  }
                  wp_reset_postdata();
                } else {
                  // If no posts found
                  echo 'No testimonials found.';
                }
                ?>
              </div>
            </div>
            <div class="absolute left-0 -bottom-4 right-0">
              <div class="container max-w-screen-3xl mx-auto">
                <div class="swiper-pagination text-center relative [&>.swiper-pagination-bullet]:rounded-full" style="--swiper-pagination-bullet-height:12px;--swiper-pagination-bullet-width:12px;--swiper-pagination-bullet-inactive-color:#E2E2E2;--swiper-pagination-bullet-horizontal-gap:6px;--swiper-theme-color:var(--section-link-color);--swiper-pagination-bullet-inactive-opacity:1;"></div>
              </div>
            </div>
            <div class="swiper-button-prev -left-4 lg:left-8 after:content-['prev'] after:text-lg after:lg:text-4xl text-brand-purple font-bold -mt-12 -translate-y-full" style="color: var(--section-link-color)"></div>
            <div class="swiper-button-next -right-4 lg:right-8 after:content-['next'] after:text-lg after:lg:text-4xl text-brand-purple font-bold -mt-12 -translate-y-full" style="color: var(--section-link-color)"></div>
          </div>
        <?php endif; ?>
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