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
  <section <?php echo $section_id ?> class="relative <?php echo $section_class ?>" style="<?php echo $section_style ?>">
    <div class="relative bg-gradient-to-b from-brand-light-gray from-90% via-white via-90% to-white">
      <div class="max-w-screen-5xl px-4 4xl:px-8 mx-auto <?php echo $entrance_animation_class ?>">
        <div id="hero-slider" class="swiper relative rounded-xl md:rounded-2xl lg:rounded-3xl">
          <div class="swiper-wrapper">
            <?php foreach ($hero_slider as $slide) : ?>
              <?php
              $background = $slide['background'];
              $slide_image = $background['background_image'];
              $bg_overlay = $background['background_overlay_color'];
              $headline = $slide['headline'];
              $headline_text = $headline['headline'];
              $headline_color = $headline['headline_color'];
              $headline_style = '';
              if ($headline_color) {
                $headline_style .= 'color: ' . $headline_color . ';';
              }
              $description = $slide['description'];
              $description_text = $description['description'];
              $description_color = $description['description_color'];
              $description_style = '';
              if ($description_color) {
                $description_style .= 'color: ' . $description_color . ';';
              }
              $buttons = $slide['buttons'];

              $overlay_style = '';
              if ($bg_overlay) {
                $overlay_style = 'background-color: ' . $bg_overlay;
              }
              ?>
              <div class="swiper-slide">
                <div class="aspect-w-4 aspect-h-6 md:aspect-w-16 md:aspect-h-7">
                  <?php if ($slide_image) : ?>
                    <div class="absolute inset-0">
                      <div class="absolute inset-0 mix-blend-multiply" style="<?php echo $overlay_style ?>"></div>
                      <img src="<?php echo $slide_image['url'] ?>" alt="<?php echo $slide_image['alt'] ?>" class="object-cover h-full w-full opacity-100">
                    </div>
                  <?php endif; ?>
                  <div class="absolute inset-0 flex items-end md:items-center">
                    <div class="container max-w-screen-3xl mx-auto pb-8 md:pb-0">
                      <div class="w-full md:w-1/2 font-montserrat">
                        <div class="w-2/3 md:w-full">
                          <?php if ($headline_text) : ?>
                            <h2 class="hero-headline text-2xl lg:text-[64px] lg:leading-tight text-brand-black font-bold mb-4" style="<?php echo $headline_style ?>"><?php echo $headline_text; ?></h2>
                          <?php endif; ?>
                          <?php if ($description_text) : ?>
                            <div class="hero-description text-base lg:text-2xl font-medium mt-4" style="<?php echo $description_style ?>">
                              <?php echo $description_text; ?>
                            </div>
                          <?php endif; ?>
                        </div>
                        <?php get_template_part('template-parts/components/buttons', '', array('field' => $buttons, 'class' => 'hero-buttons mt-6 xl:mt-10')); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="absolute left-0 bottom-3 md:bottom-8 right-0">
            <div class="container max-w-screen-3xl mx-auto">
              <div class="swiper-pagination text-left relative" style="--swiper-pagination-bullet-size:12px;--swiper-pagination-bullet-inactive-color:#fff;--swiper-pagination-bullet-horizontal-gap:6px;--swiper-theme-color:#45C2BF;--swiper-pagination-bullet-inactive-opacity:1;"></div>
            </div>
          </div>
          <div class="swiper-button-prev hidden md:block left-0 lg:left-4 xl:left-8 after:content-['prev'] after:text-lg after:lg:text-3xl text-brand-sea font-bold"></div>
          <div class="swiper-button-next hidden md:block right-0 lg:right-4 xl:right-8 after:content-['next'] after:text-lg after:lg:text-3xl text-brand-sea font-bold"></div>
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
    </div>
  </section>
<?php endif; ?>