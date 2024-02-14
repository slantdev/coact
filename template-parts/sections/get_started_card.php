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

$section_id = $section_id ? 'id="' . $section_id . '"' : '';

$get_started_cards = get_sub_field('get_started_cards'); // Group
$intro = $get_started_cards['intro']; // Group
$headline = $intro['headline'];
$description = $intro['description'];
$content_cards = $get_started_cards['content_cards']; // Repeater

?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class=" <?php echo $entrance_animation_class ?>">
      <div class="relative container max-w-screen-xxl mx-auto">
        <?php if ($headline) : ?>
          <div class="max-w-screen-lg mx-auto text-center z-[1]">
            <div class="not-prose">
              <h3 class="mb-4 xl:mb-8 text-center text-2xl md:text-4xl font-bold"><?php echo $headline ?></h3>
            </div>
            <?php if ($description) : ?>
              <div class="mt-6 text-base md:text-lg font-medium"><?php echo $description ?></div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
      <?php
      if ($content_cards) :
        $content_cards_id = uniqid();
      ?>
        <div class="content-cards-filter-<?php echo $content_cards_id ?> relative container max-w-screen-xxl mx-auto">
          <div class="px-12 lg:px-14 relative -mx-2 lg:-mx-0">
            <div class="swiper mt-6 md:mt-10 px-2 pt-2 pb-4">
              <div class="swiper-wrapper filter-buttons">

                <?php foreach ($content_cards as $key => $card) : ?>
                  <?php
                  $cards_group_title = $card['cards_group_title'];
                  $filter_content_card_class = '';
                  $filter_content_card_disabled = '';
                  if ($key == '0') {
                    $filter_content_card_class = 'filter-active';
                    $filter_content_card_disabled = 'disabled';
                  }
                  if ($cards_group_title) :
                  ?>
                    <div class="swiper-slide w-auto">
                      <button type="button" class="filter-content-card inline-block rounded-full px-6 py-1.5 h-9 lg:h-auto text-sm lg:text-base lg:px-10 lg:py-2.5 bg-white border border-neutral-100 shadow-md hover:shadow-lg transition-all duration-200 disabled:cursor-not-allowed disabled:hover:shadow-md <?php echo $filter_content_card_class ?>" data-id="<?php echo $key ?>" <?php echo $filter_content_card_disabled ?>>
                        <?php echo $cards_group_title; ?>
                      </button>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            </div>
            <button type="button" class="filter-button-prev absolute left-0 top-2 lg:top-[12px] w-9 h-9 lg:w-10 lg:h-10 flex items-center justify-center bg-white rounded-full shadow-md hover:bg-brand-sea text-gray-500 hover:text-white transition-all duration-200 swiper-button-disabled">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.49994 1.00001C7.63154 0.999249 7.76201 1.02447 7.88384 1.07424C8.00568 1.124 8.1165 1.19733 8.20994 1.29001C8.30367 1.38297 8.37806 1.49357 8.42883 1.61543C8.4796 1.73729 8.50574 1.868 8.50574 2.00001C8.50574 2.13202 8.4796 2.26273 8.42883 2.38459C8.37806 2.50645 8.30367 2.61705 8.20994 2.71001L4.89994 6.00001L8.07994 9.31001C8.26619 9.49737 8.37073 9.75082 8.37073 10.015C8.37073 10.2792 8.26619 10.5326 8.07994 10.72C7.98698 10.8137 7.87637 10.8881 7.75452 10.9389C7.63266 10.9897 7.50195 11.0158 7.36994 11.0158C7.23793 11.0158 7.10722 10.9897 6.98536 10.9389C6.8635 10.8881 6.7529 10.8137 6.65994 10.72L2.79994 6.72001C2.61671 6.53308 2.51408 6.28176 2.51408 6.02001C2.51408 5.75826 2.61671 5.50694 2.79994 5.32001L6.79994 1.32001C6.8897 1.22308 6.99777 1.14489 7.11792 1.08997C7.23807 1.03504 7.36791 1.00447 7.49994 1.00001V1.00001Z" fill="currentColor"></path>
              </svg>
            </button>
            <button type="button" class="filter-button-next absolute right-0 top-2 lg:top-[12px] w-9 h-9 lg:w-10 lg:h-10 flex items-center justify-center bg-white rounded-full shadow-md hover:bg-brand-sea text-gray-500 hover:text-white transition-all duration-200">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.49994 11C4.36833 11.0008 4.23787 10.9755 4.11603 10.9258C3.9942 10.876 3.88338 10.8027 3.78994 10.71C3.69621 10.617 3.62182 10.5064 3.57105 10.3846C3.52028 10.2627 3.49414 10.132 3.49414 9.99999C3.49414 9.86798 3.52028 9.73727 3.57105 9.61541C3.62182 9.49355 3.69621 9.38295 3.78994 9.28999L7.09994 5.99999L3.91994 2.68999C3.73369 2.50263 3.62915 2.24918 3.62915 1.98499C3.62915 1.7208 3.73369 1.46735 3.91994 1.27999C4.0129 1.18626 4.1235 1.11187 4.24536 1.0611C4.36722 1.01033 4.49793 0.984192 4.62994 0.984192C4.76195 0.984192 4.89266 1.01033 5.01452 1.0611C5.13638 1.11187 5.24698 1.18626 5.33994 1.27999L9.19994 5.27999C9.38317 5.46692 9.4858 5.71824 9.4858 5.97999C9.4858 6.24174 9.38317 6.49306 9.19994 6.67999L5.19994 10.68C5.11018 10.7769 5.00211 10.8551 4.88196 10.91C4.76181 10.965 4.63197 10.9955 4.49994 11V11Z" fill="currentColor"></path>
              </svg>
            </button>
          </div>
          <script>
            new Swiper('.content-cards-filter-<?php echo $content_cards_id ?> .swiper', {
              slidesPerView: 'auto',
              spaceBetween: 12,
              loop: false,
              watchOverflow: true,
              centerInsufficientSlides: true,
              navigation: {
                nextEl: '.filter-button-next',
                prevEl: '.filter-button-prev',
              },
              breakpoints: {
                768: {
                  slidesPerView: 'auto',
                  spaceBetween: 24
                },
                1280: {
                  slidesPerView: 'auto',
                  spaceBetween: 30
                }
              }
            });
          </script>
        </div>
        <div class="content-cards-grid-<?php echo $content_cards_id ?> relative mt-6 md:mt-10">
          <?php foreach ($content_cards as $key => $card) : ?>
            <?php
            if ($card) :
              $contents = $card['contents']; // Repeater
              $content_card_class = '';
              if ($key != '0') {
                $content_card_class = 'hidden';
              }
            ?>
              <?php if ($contents) : ?>
                <div class="content-card content-card-<?php echo $key; ?> relative container max-w-screen-3xl mx-auto <?php echo $content_card_class ?>">
                  <div class="swiper container max-w-screen-xxl mx-auto">
                    <div class="swiper-wrapper">
                      <?php foreach ($contents as $content) : ?>
                        <div class="swiper-slide w-auto">
                          <?php
                          $post_id = $content->ID;
                          $title = get_the_title($post_id);
                          $permalink = get_the_permalink($post_id);
                          $image = get_the_post_thumbnail_url($post_id, 'large');
                          if (get_post_type($post_id) == 'service') {
                            $service_images = get_field('service_images', $post_id);
                            $page_banner_image = $service_images['page_banner_image'];
                            $card_image = $service_images['card_image'];
                            //preint_r($service_images);
                            if ($card_image) {
                              $image = $card_image['url'];
                            } else {
                              if ($page_banner_image) {
                                $image = $page_banner_image['url'];
                              } else {
                                $image = get_the_post_thumbnail_url($post_id, 'large');
                              }
                            }
                          }
                          $excerpt = get_the_excerpt($post_id);
                          ?>
                          <a href="<?php echo $permalink; ?>" class="card-hover block h-full rounded-lg md:rounded-xl bg-slate-100 relative overflow-hidden cursor-pointer shadow-md">
                            <div class="aspect-w-1 aspect-h-1">
                              <?php if ($image) : ?>
                                <img class="card-image object-center object-cover" src="<?php echo $image; ?>">
                              <?php else : ?>
                                <div class="w-full h-full bg-slate-100"></div>
                              <?php endif; ?>
                            </div>
                            <div class="card-text">
                              <h3 class="card-title"><?php echo $title; ?></h3>
                              <div class="card-excerpt">
                                <?php echo wp_trim_words($excerpt, 20) ?>
                              </div>
                              <button type="button" class="bg-white p-4 absolute right-6 bottom-6 rounded-full w-8 h-8 xl:w-12 xl:h-12">
                                <span class="block w-4 h-1 bg-brand-sea absolute top-1/2 -translate-y-1/2"></span>
                                <span class="block w-1 h-4 bg-brand-sea absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2"></span>
                              </button>
                            </div>
                          </a>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <div class="absolute left-0 -bottom-16 right-0">
                    <div class="container max-w-screen-3xl mx-auto">
                      <div class="swiper-pagination text-center relative [&>.swiper-pagination-bullet]:rounded-sm [&>.swiper-pagination-bullet]:w-10 md:[&>.swiper-pagination-bullet]:w-20" style="--swiper-pagination-bullet-height:6px;--swiper-pagination-bullet-inactive-color:#E2E2E2;--swiper-pagination-bullet-horizontal-gap:6px;--swiper-theme-color:#45C2BF;--swiper-pagination-bullet-inactive-opacity:1;"></div>
                    </div>
                  </div>
                  <div class="swiper-button-prev left-0 lg:left-4 after:content-['prev'] after:text-lg after:lg:text-3xl text-brand-sea font-bold"></div>
                  <div class="swiper-button-next right-0 lg:right-4 after:content-['next'] after:text-lg after:lg:text-3xl text-brand-sea font-bold"></div>
                  <script>
                    new Swiper('.content-card-<?php echo $key; ?> .swiper', {
                      slidesPerView: 1,
                      spaceBetween: 16,
                      loop: false,
                      watchOverflow: true,
                      centerInsufficientSlides: true,
                      navigation: {
                        nextEl: '.content-card-<?php echo $key; ?> .swiper-button-next',
                        prevEl: '.content-card-<?php echo $key; ?> .swiper-button-prev',
                      },
                      pagination: {
                        el: ".content-card-<?php echo $key; ?> .swiper-pagination",
                        clickable: true,
                      },
                      breakpoints: {
                        640: {
                          slidesPerView: 2,
                          spaceBetween: 16,
                        },
                        768: {
                          slidesPerView: 2,
                          spaceBetween: 16,
                        },
                        1024: {
                          slidesPerView: 3,
                          spaceBetween: 32,
                        },
                      },
                    });
                  </script>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; ?>
          <div class="content-cards-loader absolute inset-0 bg-white bg-opacity-80 z-10 hidden transition-all duration-500">
            <div class="h-full w-full flex items-center justify-center">
              <svg class="animate-spin h-8 w-8 text-brand-sea opacity-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
  <script>
    jQuery(function($) {
      $('.content-cards-grid-<?php echo $content_cards_id ?>').height($('.content-cards-grid-<?php echo $content_cards_id ?>').height());

      var isAnimating = false;

      $(".content-cards-filter-<?php echo $content_cards_id ?> .filter-content-card").on("click", function() {

        if (isAnimating) {
          return;
        }

        var tabId = $(this).data("id");
        var contentCard = $(".content-cards-grid-<?php echo $content_cards_id ?> .content-card-" + tabId);

        $(".content-cards-filter-<?php echo $content_cards_id ?> .filter-content-card").prop("disabled", true);

        // Remove active class from all buttons and add it to the clicked button
        $(".content-cards-filter-<?php echo $content_cards_id ?> .filter-content-card").removeClass("filter-active");
        $(this).addClass("filter-active");

        // Show loader with fade-in effect
        $(".content-cards-grid-<?php echo $content_cards_id ?> .content-cards-loader").fadeIn(500);

        isAnimating = true;

        // Wait for 1 second
        setTimeout(function() {
          // Hide loader with fade-out effect
          $(".content-cards-grid-<?php echo $content_cards_id ?> .content-cards-loader").fadeOut(500);

          // Hide current content card with fade-out effect
          $(".content-card").fadeOut(800, function() {
            setTimeout(function() {
              // Show selected content card with fade-in effect
              contentCard.fadeIn(800, function() {
                $(".content-cards-filter-<?php echo $content_cards_id ?> .filter-content-card").prop("disabled", false);
                $(this).prop("disabled", true);

                isAnimating = false;
              });
            }, 1000);
          });
        }, 1000);
      });

      // $('.content-cards-filter-<?php echo $content_cards_id ?> .filter-content-card').click(function(e) {
      //   e.preventDefault();
      //   let dataid = $(this).data('id');
      //   $('.content-cards-filter-<?php echo $content_cards_id ?> .filter-content-card').removeClass('filter-active');
      //   $(this).addClass('filter-active');
      //   $('.content-cards-grid-<?php echo $content_cards_id ?> .content-cards-loader').fadeIn('slow');
      //   $('.content-cards-grid-<?php echo $content_cards_id ?> .content-card').fadeOut('slow', function() {
      //     setTimeout(() => {
      //       $('.content-cards-grid-<?php echo $content_cards_id ?> .content-cards-loader').fadeOut();
      //       $('.content-cards-grid-<?php echo $content_cards_id ?> .content-card-' + dataid).fadeIn();
      //     }, 1000);
      //   });
      // });
    });
  </script>
</section>