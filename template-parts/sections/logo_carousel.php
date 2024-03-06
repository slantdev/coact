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

$logo_carousel = get_sub_field('logo_carousel'); // Group
$headline = $logo_carousel['headline'];
$description = $logo_carousel['description'];
$logo_gallery = $logo_carousel['logo_gallery'];
$logo_link = $logo_carousel['logo_link']; // Repeater

?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="<?php echo $entrance_animation_class ?>">
      <div class="relative container max-w-screen-xxl mx-auto">
        <?php if ($headline || $description) : ?>
          <div class="text-center max-w-prose mx-auto lg:mb-14">
            <?php if ($headline) : ?>
              <div class="not-prose">
                <h3 class="mb-8 xl:mb-12 text-3xl lg:text-4xl font-bold"><?php echo $headline ?></h3>
              </div>
            <?php endif; ?>
            <?php if ($description) : ?>
              <div class="prose lg:prose-xl max-w-none font-medium mb-6">
                <?php echo $description ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
      <?php if ($logo_link) : ?>
        <?php
        $carousel_id = uniqid('carousel-');
        ?>
        <div class="py-6 lg:py-0 mt-6 lg:mt-20 container max-w-none mx-auto">
          <div class="relative" style="--swiper-navigation-color: #45C2BF; --swiper-navigation-size: 24px">
            <div id="<?php echo $carousel_id ?>" class="swiper mx-6 md:mx-16 lg:mx-24 px-0">
              <div class="swiper-wrapper items-center">
                <?php foreach ($logo_link as $logo) : ?>
                  <?php
                  $logo_image = isset($logo['logo_image']) ? $logo['logo_image'] : '';
                  $logo_link = isset($logo['logo_link']) ? $logo['logo_link'] : '';
                  if ($logo_image) :
                  ?>
                    <div class="swiper-slide">
                      <div class="flex flex-col items-center justify-center">
                        <?php
                        if ($logo_link) {
                          echo '<a href="' . $logo_link . '" target="_blank">';
                        } ?>
                        <img class="w-full h-full object-contain max-h-[100px]" src="<?php echo esc_url($logo_image['url']); ?>" />
                        <?php
                        if ($logo_link) {
                          echo '</a>';
                        } ?>
                      </div>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="<?php echo $carousel_id ?>--button-prev swiper-button-prev -left-2 lg:left-0 after:content-['prev'] after:text-[16px] md:after:text-[24px]"></div>
            <div class="<?php echo $carousel_id ?>--button-next swiper-button-next -right-2 lg:right-0 after:content-['next'] after:text-[16px] md:after:text-[24px]"></div>
          </div>
          <script>
            new Swiper("#<?php echo $carousel_id ?>", {
              slidesPerView: "2",
              spaceBetween: 24,
              watchOverflow: true,
              centerInsufficientSlides: true,
              breakpoints: {
                768: {
                  slidesPerView: "2",
                  spaceBetween: 64
                },
                1024: {
                  slidesPerView: "3",
                  spaceBetween: 64
                },
                1280: {
                  slidesPerView: "4",
                  spaceBetween: 80
                },
                1536: {
                  slidesPerView: "5",
                  spaceBetween: 80
                }
              },
              navigation: {
                nextEl: ".<?php echo $carousel_id ?>--button-next",
                prevEl: ".<?php echo $carousel_id ?>--button-prev",
              },
              loop: true,
              // autoplay: {
              //   delay: 3000,
              //   disableOnInteraction: false,
              // }
            });
          </script>
        </div>
      <?php endif; ?>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>