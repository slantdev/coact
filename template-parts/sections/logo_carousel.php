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

?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <div class="relative container max-w-screen-xxl mx-auto">

      <?php if ($headline || $description) : ?>
        <div class="text-center max-w-prose mx-auto mb-14">
          <?php if ($headline) : ?>
            <div class="not-prose">
              <h3 class="mb-8 xl:mb-12 text-4xl font-bold"><?php echo $headline ?></h3>
            </div>
          <?php endif; ?>
          <?php if ($description) : ?>
            <div class="prose prose-xl max-w-none font-medium mb-6">
              <?php echo $description ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <?php if ($logo_gallery) : ?>
        <?php
        $carousel_id = uniqid('carousel-');
        ?>
        <div class="py-6 lg:py-0 mt-20 container mx-auto">
          <div id="<?php echo $carousel_id ?>" class="swiper px-16" style="--swiper-navigation-color: #45C2BF; --swiper-navigation-size: 24px">
            <div class="swiper-wrapper items-center">
              <?php foreach ($logo_gallery as $logo) : ?>
                <div class="swiper-slide">
                  <div class="flex flex-col items-center justify-center">
                    <img class="w-full h-full object-contain" src="<?php echo esc_url($logo['url']); ?>" />
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="<?php echo $carousel_id ?>--button-prev swiper-button-prev"></div>
            <div class="<?php echo $carousel_id ?>--button-next swiper-button-next"></div>
          </div>
          <script>
            new Swiper("#<?php echo $carousel_id ?>", {
              slidesPerView: "1",
              spaceBetween: 16,
              watchOverflow: true,
              centerInsufficientSlides: true,
              breakpoints: {
                768: {
                  slidesPerView: "3",
                  spaceBetween: 32
                },
                1280: {
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
  </div>
</section>