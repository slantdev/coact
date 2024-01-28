<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
 * $top_separator
 * $top_separator_style
 * $bottom_separator
 * $bottom_separator_style
*/

$hero_slider = get_sub_field('hero_slider');

if ($hero_slider) : ?>
  <section class="relative bg-gradient-to-b from-brand-light-gray from-90% via-white via-90% to-white">
    <div class="max-w-screen-5xl px-4 4xl:px-12 mx-auto <?php echo $entrance_animation_class ?>">
      <div id="hero-slider" class="swiper relative rounded-3xl">
        <div class="swiper-wrapper">
          <?php foreach ($hero_slider as $slide) : ?>
            <?php
            $background = $slide['background'];
            $slide_image = $background['background_image'];
            $bg_overlay = $background['background_overlay_color'];
            $headline = $slide['headline'];
            $description = $slide['description'];
            $buttons = $slide['buttons'];

            $overlay_style = '';
            if ($bg_overlay) {
              $overlay_style = 'background-color: ' . $bg_overlay;
            }
            ?>
            <div class="swiper-slide">
              <div class="aspect-w-16 aspect-h-7">
                <?php if ($slide_image) : ?>
                  <div class="absolute inset-0">
                    <div class="absolute inset-0 mix-blend-multiply" style="<?php echo $overlay_style ?>"></div>
                    <img src="<?php echo $slide_image['url'] ?>" alt="<?php echo $slide_image['alt'] ?>" class="object-cover h-full w-full opacity-100">
                  </div>
                <?php endif; ?>
                <div class="absolute inset-0 flex items-center">
                  <div class="container max-w-screen-3xl mx-auto">
                    <div class="w-full xl:w-1/2 font-montserrat">
                      <?php if ($headline) : ?>
                        <h2 class="hero-headline text-5xl lg:text-[64px] lg:leading-tight text-brand-black font-bold mb-4 [&>span]:text-brand-sea"><?php echo $headline; ?></h2>
                      <?php endif; ?>
                      <?php if ($description) : ?>
                        <div class="hero-description text-xl lg:text-2xl text-2xl font-medium mt-4">
                          <?php echo $description; ?>
                        </div>
                      <?php endif; ?>
                      <?php get_template_part('template-parts/components/buttons', '', array('field' => $buttons, 'class' => 'hero-buttons mt-6 xl:mt-10')); ?>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="absolute left-0 bottom-8 right-0">
          <div class="container max-w-screen-3xl mx-auto">
            <div class="swiper-pagination text-left relative" style="--swiper-pagination-bullet-size:12px;--swiper-pagination-bullet-inactive-color:#fff;--swiper-pagination-bullet-horizontal-gap:6px;--swiper-theme-color:#45C2BF;--swiper-pagination-bullet-inactive-opacity:1;"></div>
          </div>
        </div>
        <div class="swiper-button-prev left-0 lg:left-4 after:content-['prev'] after:text-lg after:lg:text-3xl text-brand-sea font-bold"></div>
        <div class="swiper-button-next right-0 lg:right-4 after:content-['next'] after:text-lg after:lg:text-3xl text-brand-sea font-bold"></div>
      </div>
      <script>
        const swiper = new Swiper('#hero-slider', {
          loop: true,
          watchOverflow: true,
          //effect: 'fade',
          speed: 1000,
          autoplay: {
            delay: 8000,
          },
          navigation: {
            nextEl: '#hero-slider .swiper-button-next',
            prevEl: '#hero-slider .swiper-button-prev',
          },
          pagination: {
            el: "#hero-slider .swiper-pagination",
          },
        });
      </script>
    </div>
  </section>
<?php endif; ?>