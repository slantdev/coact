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

$posts_grid = get_sub_field('posts_grid'); // Group
$headline = $posts_grid['headline'];
$headline_color = $posts_grid['headline_color'];
$headline_style = '';
if ($headline_color) {
  $headline_style .= 'color : ' . $headline_color . ';';
}
$description = $posts_grid['description'];
$button = $posts_grid['button'];
$button_color = $posts_grid['button_color'];
$button_style = '';
if ($button_color) {
  $button_style .= 'background-color : ' . $button_color . ';';
}
$select_category = $posts_grid['select_category'];
$card_style = $posts_grid['card_style'];
$posts_per_page = $posts_grid['posts_per_page'];
$show_pagination = $posts_grid['show_pagination'];
$filter_settings = $posts_grid['filter_settings'];
$show_filter = $filter_settings['show_filter'];
$filter_style = $filter_settings['filter_style'];
$filter_categories = $filter_settings['filter_categories'];
$filter_tags = $filter_settings['filter_tags'];

//preint_r($filter_categories);
// preint_r($filter_tags);

$mergedFilters = array_merge((array) $filter_categories, (array) $filter_tags);

usort($mergedFilters, function ($a, $b) {
  return strcmp($a->name, $b->name);
});

// preint_r($mergedFilters);

$posts_grid_id = uniqid();

?>

<section <?php echo $section_id ?> class="relative" style="<?php echo $section_style ?>">
  <?php get_template_part('template-parts/layouts/background_ornament', '', array('shape' => $ornament_shape, 'style' => $ornament_style, 'class' => 'max-w-screen-4xl')); ?>
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="relative container max-w-screen-xxl mx-auto z-10">
      <div>
        <?php if ($headline) : ?>
          <div class="not-prose">
            <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold" style="<?php echo $headline_style ?>"><?php echo $headline ?></h3>
          </div>
        <?php endif; ?>
        <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
          <?php if ($description) : ?>
            <div class="w-full lg:w-2/3">
              <div class="prose xl:prose-lg mr-auto text-left">
                <?php echo $description ?>
              </div>
            </div>
          <?php endif; ?>
          <?php if (isset($button['url'])) : ?>
            <div class="w-full lg:w-1/3 text-right">
              <a href="<?php echo $button['url'] ?>" target="<?php echo $button['target'] ?>" class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-sea text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200" style="<?php echo $button_style ?>"><?php echo $button['title'] ?></a>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <?php if ($show_filter && $filter_style == 'tabs') : ?>
        <div class="posts-filter-<?php echo $posts_grid_id ?> relative">
          <div class="px-12 lg:px-14 relative -mx-2 lg:-mx-0">
            <div class="swiper px-2 pt-2 pb-4">
              <div class="swiper-wrapper filter-buttons">
                <?php
                $filter_button_class = '';
                $filter_button_disabled = '';
                ?>
                <div class="swiper-slide w-auto">
                  <button type="button" class="filter-button inline-block rounded-full px-6 py-1.5 h-9 lg:h-auto text-sm lg:text-base lg:px-10 lg:py-2.5 bg-white border border-neutral-100 shadow-md hover:shadow-lg transition-all duration-200 disabled:cursor-not-allowed disabled:hover:shadow-md filter-active" data-id="all" data-style="<?php echo $card_style ?>" <?php echo $filter_button_disabled ?>>All</button>
                </div>
                <?php foreach ($mergedFilters as $filter) : ?>
                  <?php
                  $filter_id = $filter->term_id;
                  $filter_title = $filter->name;
                  $filter_taxonomy = $filter->taxonomy;
                  if ($filter_id) :
                  ?>
                    <div class="swiper-slide w-auto">
                      <button type="button" class="filter-button inline-block rounded-full px-6 py-1.5 h-9 lg:h-auto text-sm lg:text-base lg:px-10 lg:py-2.5 bg-white border border-neutral-100 shadow-md hover:shadow-lg transition-all duration-200 disabled:cursor-not-allowed disabled:hover:shadow-md <?php echo $filter_button_class ?>" data-id="<?php echo $filter_id ?>" data-taxonomy="<?php echo $filter_taxonomy ?>" data-style="<?php echo $card_style ?>" <?php echo $filter_button_disabled ?>>
                        <?php echo $filter_title; ?>
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
            new Swiper('.posts-filter-<?php echo $posts_grid_id ?> .swiper', {
              slidesPerView: 'auto',
              spaceBetween: 12,
              loop: false,
              watchOverflow: true,
              centerInsufficientSlides: true,
              navigation: {
                nextEl: '.posts-filter-<?php echo $posts_grid_id ?> .filter-button-next',
                prevEl: '.posts-filter-<?php echo $posts_grid_id ?> .filter-button-prev',
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
      <?php endif; ?>
      <div class="relative pt-10">
        <div class="posts-grid-<?php echo $posts_grid_id ?>">
          <div class="grid grid-cols-3 gap-8">
            <?php
            global $post;
            if ($card_style == 'featured') {
              if ($select_category) {
                $firstpost = get_posts(array(
                  'post_status '      => 'publish',
                  'orderby'           => 'post_date',
                  'order'             => 'DESC',
                  'posts_per_page' => '1',
                  'category'       => $select_category
                ));
              } else {
                $firstpost = get_posts(array(
                  'post_status '      => 'publish',
                  'orderby'           => 'post_date',
                  'order'             => 'DESC',
                  'posts_per_page' => '1',
                ));
              }
              if ($firstpost) {
                echo '<div class="col-span-2">';
                foreach ($firstpost as $post) :
                  $post_id = $post->ID;
                  $title = $post->post_title;
                  $link = get_the_permalink($post_id);
                  $image = get_the_post_thumbnail_url($post_id);
                  featured_card($link, $image, $title, true);
                endforeach;
                wp_reset_postdata();
                echo '</div>';
              }
              if ($select_category) {
                $otherposts = get_posts(array(
                  'post_status '      => 'publish',
                  'orderby'           => 'post_date',
                  'order'             => 'DESC',
                  'posts_per_page' => '2',
                  'offset' => '1',
                  'category'       => $select_category
                ));
              } else {
                $otherposts = get_posts(array(
                  'post_status '      => 'publish',
                  'orderby'           => 'post_date',
                  'order'             => 'DESC',
                  'posts_per_page' => '2',
                  'offset' => '1',
                ));
              }
              if ($otherposts) {
                echo '<div class="col-span-1 grid grid-cols-1 gap-4">';
                foreach ($otherposts as $post) :
                  $post_id = $post->ID;
                  $title = $post->post_title;
                  $link = get_the_permalink($post_id);
                  $image = get_the_post_thumbnail_url($post_id);
                  featured_card($link, $image, $title);
                endforeach;
                wp_reset_postdata();
                echo '</div>';
              }
            } else {
              if ($select_category) {
                $theposts = get_posts(array(
                  'posts_per_page' => $posts_per_page,
                  'category'       => $select_category,
                  'post_status '      => 'publish',
                  'orderby'           => 'post_date',
                  'order'             => 'DESC',
                ));
              } else {
                $theposts = get_posts(array(
                  'posts_per_page' => $posts_per_page,
                  'post_status '      => 'publish',
                  'orderby'           => 'post_date',
                  'order'             => 'DESC',
                ));
              }
              if ($theposts) {
                foreach ($theposts as $post) :
                  $post_id = $post->ID;
                  $title = $post->post_title;
                  $link = get_the_permalink($post_id);
                  $excerpt = get_the_excerpt($post_id);
                  $image = get_the_post_thumbnail_url($post_id);
                  if ($card_style == 'card') {
                    shadow_card($link, $image, $title, $excerpt);
                  } else if ($card_style == 'featured') {
                    featured_card($link, $image, $title);
                  } else {
                    plain_card($link, $image, $title, $excerpt);
                  }
                endforeach;
                wp_reset_postdata();
              }
            }
            ?>
          </div>
        </div>
        <div class="posts-loader absolute inset-0 bg-white bg-opacity-80 z-10 transition-all duration-500 hidden">
          <div class="h-full w-full flex justify-center">
            <svg class="animate-spin h-8 w-8 text-brand-sea opacity-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        jQuery(document).ready(function($) {
          let ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

          function load_all_posts_<?php echo $posts_grid_id ?>(page) {
            $('.posts-grid-<?php echo $posts_grid_id ?>').next('.posts-loader').show();
            let select_category = <?php echo json_encode($select_category) ?>;
            let terms = '';
            let termsString = '';
            let pagination = '<?php echo $show_pagination ?>';
            if (select_category) {
              termsString = JSON.stringify(select_category);
            }
            //console.log(terms);
            let data = {
              page: page,
              card_style: '<?php echo $card_style ?>',
              per_page: <?php echo $posts_per_page ?>,
              terms: termsString,
              pagination: pagination,
              action: 'pagination_load_posts',
            };
            //console.log(data);
            $.post(ajaxurl, data, function(response) {
              //console.log(response);
              $('.posts-grid-<?php echo $posts_grid_id ?>').html('').prepend(response);
              $('.posts-grid-<?php echo $posts_grid_id ?>').next('.posts-loader').hide();
            });
          }
          load_all_posts_<?php echo $posts_grid_id ?>(1);

          $(document).on(
            'click',
            '.posts-grid-<?php echo $posts_grid_id ?> .posts-pagination li.active',
            function() {
              $('html').animate({
                  scrollTop: $(".posts-grid-<?php echo $posts_grid_id ?>").offset().top - 100,
                },
                800
              );
              let page = $(this).data('page');
              load_all_posts_<?php echo $posts_grid_id ?>(page);
            }
          );

          $('.posts-filter-<?php echo $posts_grid_id ?> .filter-button').on('click', function(event) {
            $('.posts-filter-<?php echo $posts_grid_id ?> .filter-button').removeClass('filter-active');
            $(this).addClass('filter-active');
            let data_id = $(this).data('id');
            let data_taxonomy = $(this).data('taxonomy');
            let data_style = '<?php echo $card_style ?>';
            let pagination = '<?php echo $show_pagination ?>';
            $.ajax({
              type: 'POST',
              url: ajaxurl,
              dataType: 'html',
              data: {
                action: 'filter_posts',
                data_id: data_id,
                data_taxonomy: data_taxonomy,
                data_style: data_style,
                per_page: <?php echo $posts_per_page ?>,
                //page: page,
                pagination: pagination,
              },
              beforeSend: function() {
                $('.posts-grid-<?php echo $posts_grid_id ?>').next('.posts-loader').show();
              },
              success: function(res) {
                $('.posts-grid-<?php echo $posts_grid_id ?>').html(res);
                $('.posts-grid-<?php echo $posts_grid_id ?>').next('.posts-loader').hide();
              },
            });
          });

        });
      </script>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>