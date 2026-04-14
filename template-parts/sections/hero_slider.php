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
  <section <?php echo $section_id ?> class="relative <?php echo $section_class ?>" style="<?php echo $section_style ?>" aria-roledescription="carousel" aria-label="Hero Slider">
    <div class="relative bg-gradient-to-b from-brand-light-gray from-90% via-white via-90% to-white">
      <div class="max-w-screen-5xl px-4 4xl:px-8 mx-auto <?php echo $entrance_animation_class ?>">
        <div id="hero-slider" class="swiper relative rounded-xl md:rounded-2xl lg:rounded-3xl">
          <div class="swiper-wrapper">
            <?php foreach ($hero_slider as $slide) : ?>
              <?php
              $headline = $slide['headline'];
              $headline_text = $headline['headline'];
              $headline_color = $headline['headline_color'];
              $headline_style = '';
              if ($headline_color) {
                $headline_style .= 'color: ' . $headline_color . ';';
              }
              $headline_html_tag = $headline['headline_html_tag'] ?? 'h2';
              if ($headline_html_tag == 'default') {
                $headline_html_tag = 'h2';
              }
              $description = $slide['description'] ?? '';
              $description_text = $description['description'] ?? '';
              $description_mobile = $description['description_mobile'] ?? '';
              $description_color = $description['description_color'] ?? '';
              $description_style = '';
              if ($description_color) {
                $description_style .= 'color: ' . $description_color . ';';
              }
              $buttons = $slide['buttons'] ?? '';

              $background = $slide['background'] ?? '';
              $slide_image = $background['background_image'] ?? '';
              $slide_image_mobile = $background['background_image_mobile'] ?? '';
              $bg_overlay = $background['background_overlay_color'] ?? '';
              $overlay_style = '';
              if ($bg_overlay) {
                $overlay_style = 'background-color: ' . $bg_overlay;
              }
              ?>
              <div class="swiper-slide" role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr($headline_text) ?>">
                <div class="aspect-w-4 aspect-h-6 md:aspect-w-16 md:aspect-h-9 xl:aspect-w-16 xl:aspect-h-7">
                  <?php if ($slide_image || $slide_image_mobile) : ?>
                    <div class="absolute inset-0">
                      <div class="absolute inset-0 mix-blend-multiply" style="<?php echo $overlay_style ?>"></div>
                      <?php if ($slide_image_mobile) : ?>
                        <img src="<?php echo $slide_image_mobile['url'] ?>" alt="<?php echo $slide_image_mobile['alt'] ?: '' ?>" class="object-cover h-full w-full opacity-100 lg:hidden">
                        <img src="<?php echo $slide_image['url'] ?>" alt="<?php echo $slide_image['alt'] ?: '' ?>" class="object-cover h-full w-full opacity-100 hidden md:block">
                      <?php else : ?>
                        <img src="<?php echo $slide_image['url'] ?>" alt="<?php echo $slide_image['alt'] ?: '' ?>" class="object-cover h-full w-full opacity-100">
                      <?php endif ?>
                    </div>
                  <?php endif; ?>
                  <div class="absolute inset-0 flex items-end lg:items-center">
                    <div class="container max-w-screen-3xl mx-auto pb-8 md:pb-4 lg:pb-0">
                      <div class="w-full md:w-3/4 lg:w-1/2 font-montserrat">
                        <div class="w-full pr-6 md:pr-0">
                          <?php
                          if ($headline_text) {
                            echo '<div class="not-prose">';
                            echo '<' . $headline_html_tag;
                            echo ' class="hero-headline text-[28px] leading-tight md:text-4xl md:leading-tight xl:text-[64px] xl:leading-tight text-black font-bold mb-4"';
                            echo ' style="' . $headline_style . '">';
                            echo $headline_text;
                            echo '</' . $headline_html_tag . '>';
                            echo '</div>';
                          }
                          ?>
                          <?php if ($description_text) : ?>
                            <div class="hero-description text-sm md:text-base xl:text-2xl font-medium mt-4" style="<?php echo $description_style ?>">
                              <?php if ($description_mobile) : ?>
                                <div class="md:hidden"><?php echo $description_mobile; ?></div>
                                <div class="hidden md:block"><?php echo $description_text; ?></div>
                              <?php else : ?>
                                <div><?php echo $description_text; ?></div>
                              <?php endif ?>
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
          <div class="absolute left-0 bottom-3 md:bottom-2 lg:bottom-8 right-0 z-10">
            <div class="container max-w-screen-3xl mx-auto flex items-center gap-4">
              <div class="swiper-pagination text-left relative !w-auto" style="--swiper-pagination-bullet-size:12px;--swiper-pagination-bullet-inactive-color:#fff;--swiper-pagination-bullet-horizontal-gap:6px;--swiper-theme-color:#45C2BF;--swiper-pagination-bullet-inactive-opacity:1;"></div>
              <button class="swiper-play-pause text-white focus:outline-none" aria-label="Pause Autoplay">
                <span class="sr-only">Pause Autoplay</span>
                <?php echo coact_icon(array('icon' => 'pause', 'group' => 'utilities', 'size' => '16', 'class' => 'pause-icon')); ?>
                <?php echo coact_icon(array('icon' => 'play', 'group' => 'utilities', 'size' => '16', 'class' => 'play-icon hidden')); ?>
              </button>
            </div>
          </div>
          <div class="swiper-button-prev hidden md:block left-0 lg:left-4 xl:left-8 after:content-['prev'] after:text-lg after:lg:text-3xl text-brand-sea font-bold" aria-label="Previous slide"></div>
          <div class="swiper-button-next hidden md:block right-0 lg:right-4 xl:right-8 after:content-['next'] after:text-lg after:lg:text-3xl text-brand-sea font-bold" aria-label="Next slide"></div>
        </div>
        <script>
          const swiper = new Swiper('#hero-slider', {
            loop: true,
            watchOverflow: true,
            //effect: 'fade',
            speed: 1000,
            autoplay: {
              delay: 8000,
              disableOnInteraction: false,
            },
            navigation: {
              nextEl: '#hero-slider .swiper-button-next',
              prevEl: '#hero-slider .swiper-button-prev',
            },
            pagination: {
              el: "#hero-slider .swiper-pagination",
              clickable: true,
              renderBullet: function (index, className) {
                return '<button class="' + className + '" aria-label="Go to slide ' + (index + 1) + '"></button>';
              },
            },
            on: {
              init: function() {
                this.el.addEventListener('mouseenter', () => {
                  this.autoplay.stop();
                });
                this.el.addEventListener('mouseleave', () => {
                  if (!this.el.querySelector('.swiper-play-pause').classList.contains('is-paused')) {
                    this.autoplay.start();
                  }
                });
              }
            }
          });

          document.querySelector('.swiper-play-pause').addEventListener('click', function() {
            this.classList.toggle('is-paused');
            const isPaused = this.classList.contains('is-paused');
            this.querySelector('.pause-icon').classList.toggle('hidden', isPaused);
            this.querySelector('.play-icon').classList.toggle('hidden', !isPaused);
            this.setAttribute('aria-label', isPaused ? 'Play Autoplay' : 'Pause Autoplay');
            
            if (isPaused) {
              swiper.autoplay.stop();
            } else {
              swiper.autoplay.start();
            }
          });
        </script>
      </div>
    </div>
  </section>
<?php endif; ?>