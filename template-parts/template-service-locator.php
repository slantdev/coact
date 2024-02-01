<?php

/**
 * Template Name: Service Locator
 * Template Post Type: page
 *
 */

get_header();

$site_locator_settings = get_field('site_locator_settings'); // Group
$headline = $site_locator_settings['headline'];
$headline_color = $site_locator_settings['headline_color'];
$headline_style = '';
if ($headline_color) {
  $headline_style .= 'color : ' . $headline_color . ';';
}
$description = $site_locator_settings['description'];

?>

<?php echo finderTaxonomyName(); ?>

<div id="service-locator" class="bg-[#F4F4F4] px-6 pb-16">

  <div class="service_locator-wrap bg-white rounded-xl shadow-xl pb-8">
    <div class="flex items-center py-10 px-8 gap-x-10">
      <div class="flex gap-x-16">
        <div class="inline-flex gap-x-4">
          <svg class="h-10 w-10" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M42.6656 18.3328C42.6649 14.9472 41.7267 11.628 39.955 8.74296C38.1834 5.85795 35.6474 3.51988 32.6282 1.98794C29.6091 0.455994 26.2247 -0.20999 22.8502 0.0638118C19.4757 0.337613 16.2429 1.5405 13.5102 3.53914C10.7775 5.53778 8.65168 8.2541 7.36828 11.387C6.08488 14.5199 5.69409 17.947 6.23921 21.2884C6.78434 24.6298 8.24409 27.755 10.4567 30.3176C12.6692 32.8801 15.5482 34.7799 18.7744 35.8064L24.2912 48L29.7632 35.848C33.5015 34.6876 36.7704 32.3616 39.0919 29.2101C41.4134 26.0586 42.6657 22.247 42.6656 18.3328ZM24.3328 26.08C22.8006 26.08 21.3027 25.6256 20.0287 24.7744C18.7547 23.9231 17.7617 22.7132 17.1753 21.2975C16.589 19.8819 16.4355 18.3242 16.7345 16.8214C17.0334 15.3186 17.7712 13.9382 18.8547 12.8547C19.9382 11.7713 21.3186 11.0334 22.8214 10.7345C24.3242 10.4355 25.8819 10.589 27.2975 11.1753C28.7131 11.7617 29.9231 12.7547 30.7744 14.0287C31.6256 15.3027 32.08 16.8006 32.08 18.3328C32.0802 19.3503 31.88 20.3578 31.4907 21.2978C31.1015 22.2378 30.5308 23.0919 29.8114 23.8114C29.0919 24.5308 28.2378 25.1015 27.2978 25.4907C26.3578 25.88 25.3502 26.0802 24.3328 26.08Z" fill="#000000" />
          </svg>
          <h2 class="text-4xl font-bold whitespace-nowrap">Site locator</h2>
        </div>
        <div class="max-w-screen-md">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
        </div>
      </div>
      <div class="ml-auto">
        <a href="#" class="inline-block bg-brand-sea px-6 py-4 rounded-full text-white whitespace-nowrap">Locate by State</a>
      </div>
    </div>
    <div class="service_locator">
      <div class="service_locator-content_wrapper">
        <div class="service_locator-progress">
          <div class="linear-progress-bar">
            <div class="bar bar1"></div>
            <div class="bar bar2"></div>
          </div>
        </div>
        <div class="service_locator-content flex">
          <div class="service_locator-sidepane flex flex-col relative w-[500px] shrink-0 overflow-hidden z-10 border-b border-[#ccc] bg-white rounded-tr-lg">
            <div class="service_locator-search grow-0 border-b border-[#ccc]">
              <div class="service_locator-panel bg-brand-sea rounded-lg shadow-md p-10 relative z-20">
                <div class="service_locator-title font-bold flex gap-x-3">
                  <svg class="w-6 h-6" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M46.9728 41.7348L35.6995 29.8938C38.2936 25.8236 39.2828 20.9303 38.4742 16.1683C37.6656 11.4062 35.1172 7.11703 31.3261 4.13722C27.5349 1.15742 22.7728 -0.299274 17.9687 0.0512528C13.1646 0.401779 8.6629 2.53439 5.34173 6.03313C2.02056 9.53188 0.118065 14.1458 0.00531363 18.9751C-0.107438 23.8043 1.57764 28.5025 4.73188 32.1533C7.88613 35.8041 12.2833 38.1457 17.0658 38.7213C21.8483 39.2969 26.6732 38.0654 30.5993 35.2668L41.6312 46.8529C42.3079 47.5639 43.2386 47.9761 44.2185 47.999C45.1983 48.0218 46.1471 47.6534 46.8561 46.9747C47.5651 46.296 47.9762 45.3627 47.999 44.38C48.0218 43.3973 47.6544 42.4458 46.9776 41.7348M5.97252 19.4461C5.97284 16.7856 6.75983 14.1848 8.23399 11.9728C9.70815 9.76077 11.8033 8.03678 14.2544 7.01885C16.7056 6.00091 19.4026 5.73474 22.0046 6.25398C24.6066 6.77323 26.9966 8.05458 28.8725 9.936C30.7483 11.8174 32.0257 14.2144 32.5432 16.8239C33.0607 19.4334 32.7949 22.1381 31.7796 24.5961C30.7643 27.0541 29.0449 29.155 26.839 30.6331C24.6331 32.1112 22.0397 32.9002 19.3867 32.9002C17.625 32.9002 15.8805 32.5522 14.2529 31.876C12.6254 31.1999 11.1465 30.2088 9.90087 28.9595C8.65523 27.7101 7.66719 26.227 6.99316 24.5946C6.31913 22.9623 5.97231 21.2129 5.97252 19.4461Z" fill="currentColor" />
                  </svg>
                  <span>Find your nearest service provider</span>
                </div>
                <?php echo finderSelectService(); ?>
                <?php echo finderPostCodeInput(); ?>
              </div>
              <!-- <div class="service_locator-view-mode">
                <button id="view-as-list" class="active" type="button">View as List</button><button id="view-on-map" class="" type="button">View on Map</button>
              </div> -->
              <div class="service_locator-listing_title relative z-10 bg-white pt-10 pl-14 pr-8 pb-6 -mt-4">Showing all Service Partners</div>
            </div>
            <div id="service_locator-listing" class="service_locator-listing grow overflow-y-auto relative z-20">
              <!-- <ul class="">
                <li class="block bg-[#F4F4F4]">
                  <div class="pl-14 pr-8 pt-8 pb-8">
                    <h4 class="text-xl leading-tight font-bold mb-2">CoAct Connect + Youth Projects Footscray</h4>
                    <div class="relative">
                      <svg class="absolute -left-10 h-6 w-6" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M42.6656 18.3328C42.6649 14.9472 41.7267 11.628 39.955 8.74296C38.1834 5.85795 35.6474 3.51988 32.6282 1.98794C29.6091 0.455994 26.2247 -0.20999 22.8502 0.0638118C19.4757 0.337613 16.2429 1.5405 13.5102 3.53914C10.7775 5.53778 8.65168 8.2541 7.36828 11.387C6.08488 14.5199 5.69409 17.947 6.23921 21.2884C6.78434 24.6298 8.24409 27.755 10.4567 30.3176C12.6692 32.8801 15.5482 34.7799 18.7744 35.8064L24.2912 48L29.7632 35.848C33.5015 34.6876 36.7704 32.3616 39.0919 29.2101C41.4134 26.0586 42.6657 22.247 42.6656 18.3328ZM24.3328 26.08C22.8006 26.08 21.3027 25.6256 20.0287 24.7744C18.7547 23.9231 17.7617 22.7132 17.1753 21.2975C16.589 19.8819 16.4355 18.3242 16.7345 16.8214C17.0334 15.3186 17.7712 13.9382 18.8547 12.8547C19.9382 11.7713 21.3186 11.0334 22.8214 10.7345C24.3242 10.4355 25.8819 10.589 27.2975 11.1753C28.7131 11.7617 29.9231 12.7547 30.7744 14.0287C31.6256 15.3027 32.08 16.8006 32.08 18.3328C32.0802 19.3503 31.88 20.3578 31.4907 21.2978C31.1015 22.2378 30.5308 23.0919 29.8114 23.8114C29.0919 24.5308 28.2378 25.1015 27.2978 25.4907C26.3578 25.88 25.3502 26.0802 24.3328 26.08Z" fill="#000000" />
                      </svg>
                      <div class="text-base">
                        2 Woodford Rd, Elizabeth SA, Australia<br />
                        <a href="#" class="font-medium underline">Get Directions</a>
                      </div>
                    </div>
                    <div class="text-base my-4">
                      New enquiries: <a href="#" class="underline hover:no-underline">1800 860 766</a><br />
                      Existing clients: <a href="#" class="underline hover:no-underline">1300 422 454</a>
                    </div>
                    <div class="mt-6">
                      <div class="flex flex-wrap gap-3">
                        <div class="text-sm px-3 py-1 rounded-md bg-white border border-brand-sea text-brand-sea shadow-md">Workforce Australia</div>
                        <div class="text-sm px-3 py-1 rounded-md bg-white border border-brand-sea text-brand-sea shadow-md">Workforce Australia - Transition to Work</div>
                      </div>
                    </div>
                  </div>
                  <div class="flex bg-[#E2E2E2] border-t border-b border-[#CCCCCC]">
                    <div class="w-1/2 border-r border-[#CCC]">
                      <a href="#" class="inline-flex gap-3 items-center hover:underline px-8 py-4">
                        <svg class="w-6 h-6 text-brand-purple" width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M24.1072 0C19.3604 0 14.7203 1.40758 10.7735 4.04473C6.82672 6.68188 3.75058 10.4302 1.93408 14.8156C0.117577 19.201 -0.357704 24.0266 0.568342 28.6822C1.49439 33.3377 3.78017 37.6141 7.13663 40.9706C10.4931 44.327 14.7695 46.6128 19.425 47.5388C24.0806 48.4649 28.9062 47.9896 33.2916 46.1731C37.677 44.3566 41.4253 41.2805 44.0625 37.3337C46.6996 33.3869 48.1072 28.7468 48.1072 24C48.1072 17.6348 45.5786 11.5303 41.0778 7.02944C36.5769 2.52856 30.4724 0 24.1072 0ZM21.0368 38.6192L16.04 33.6208L25.6592 24L16.04 14.3808L21.0368 9.384L35.656 24L21.0368 38.6192Z" fill="currentColor" />
                        </svg>
                        <span class="text-black font-bold text-base">Register</span></a>
                    </div>
                    <div class="w-1/2">
                      <a href="#" class="inline-flex gap-3 items-center hover:underline px-8 py-4">
                        <svg class="w-6 h-6 text-brand-purple" width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M24.1072 0C19.3604 0 14.7203 1.40758 10.7735 4.04473C6.82672 6.68188 3.75058 10.4302 1.93408 14.8156C0.117577 19.201 -0.357704 24.0266 0.568342 28.6822C1.49439 33.3377 3.78017 37.6141 7.13663 40.9706C10.4931 44.327 14.7695 46.6128 19.425 47.5388C24.0806 48.4649 28.9062 47.9896 33.2916 46.1731C37.677 44.3566 41.4253 41.2805 44.0625 37.3337C46.6996 33.3869 48.1072 28.7468 48.1072 24C48.1072 17.6348 45.5786 11.5303 41.0778 7.02944C36.5769 2.52856 30.4724 0 24.1072 0ZM21.0368 38.6192L16.04 33.6208L25.6592 24L16.04 14.3808L21.0368 9.384L35.656 24L21.0368 38.6192Z" fill="currentColor" />
                        </svg>
                        <span class="text-black font-bold text-base">More details</span></a>
                    </div>
                  </div>
                </li>
              </ul> -->
              <ul class="service_locator-listing_tabs">
              </ul>
            </div>
          </div>
          <div id="service_locator-map" class="service_locator-map z-0 bg-[#e5e3df] w-full -ml-2 border-b border-[#ccc]">
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="bg-white px-6 py-16">
  <div class="relative container max-w-screen-xxl mx-auto">
    <div>
      <?php if ($headline) : ?>
        <div class="not-prose">
          <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold" style="<?php echo $headline_style ?>"><?php echo $headline ?></h3>
        </div>
      <?php endif; ?>
      <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24">
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
    <input id="pac-input" class="controls" type="hidden" placeholder="Search Box">
    <div class="states-filter relative pt-10">
      <div class="px-12 lg:px-14 relative -mx-2 lg:-mx-0">
        <div class="swiper px-2 pt-2 pb-4">
          <div class="swiper-wrapper filter-buttons">
            <?php
            $terms = get_terms([
              'taxonomy' => 'state-suburb',
              'hide_empty' => false,
              'orderby' => 'term_order',
              'order' => 'ASC',
              'parent' => 0
            ]);
            ?>
            <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
              <?php
              $firstLoadId = $terms[0]->term_id;
              $firstLoadTitle = get_field('long_name', 'term_' . $firstLoadId);
              ?>
              <?php foreach ($terms as $key => $term) : ?>
                <?php
                $filter_button_class = '';
                if ($key == 0) {
                  $filter_button_class = 'filter-active';
                }
                $term_id = $term->term_id;
                $term_name = $term->name;
                $term_slug = $term->slug;
                $term_long_name = get_field('long_name', 'term_' . $term_id);
                $term_short_name = get_field('short_name', 'term_' . $term_id);
                if ($term_id) :
                ?>
                  <div class="swiper-slide w-auto">
                    <button type="button" class="filter-button inline-block rounded-full px-8 py-1.5 h-9 lg:h-auto text-sm lg:text-base lg:px-10 lg:py-2.5 bg-white border border-neutral-100 shadow-md hover:shadow-lg transition-all duration-200 disabled:cursor-not-allowed disabled:hover:shadow-md <?php echo $filter_button_class ?>" data-id="<?php echo $term_id ?>" data-title="<?php echo $term_long_name ?>" data-taxonomy="state-suburb">
                      <?php echo $term_name; ?>
                    </button>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
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
        new Swiper('.states-filter .swiper', {
          slidesPerView: 'auto',
          spaceBetween: 12,
          loop: false,
          watchOverflow: true,
          centerInsufficientSlides: true,
          navigation: {
            nextEl: '.states-filter .filter-button-next',
            prevEl: '.states-filter .filter-button-prev',
          },
          breakpoints: {
            768: {
              slidesPerView: 'auto',
              spaceBetween: 24
            },
            1280: {
              slidesPerView: 'auto',
              spaceBetween: 44
            }
          }
        });
      </script>
    </div>
    <div class="relative pt-10">
      <div class="suburb-grid">
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

        function load_suburb(id, title) {
          $('.suburb-grid').next('.posts-loader').show();
          let data = {
            data_id: id,
            data_title: title,
            action: 'load_state_suburb',
          };
          //console.log(data);
          $.post(ajaxurl, data, function(response) {
            //console.log(response);
            $('.suburb-grid').html('').prepend(response);
            $('.suburb-grid').next('.posts-loader').hide();
          });
        }
        load_suburb(<?php echo $firstLoadId ?>, '<?php echo $firstLoadTitle ?>');

        $('.states-filter .filter-button').on('click', function(event) {
          $('.states-filter .filter-button').removeClass('filter-active');
          $(this).addClass('filter-active');
          let data_id = $(this).data('id');
          let data_title = $(this).data('title');
          $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'html',
            data: {
              action: 'filter_state_suburb',
              data_id: data_id,
              data_title: data_title,
            },
            beforeSend: function() {
              $('.suburb-grid').next('.posts-loader').show();
            },
            success: function(res) {
              $('.suburb-grid').html(res);
              $('.suburb-grid').next('.posts-loader').hide();
            },
          });
        });

      });
    </script>

  </div>
</div>

<?php

function finderTaxonomyName()
{

  $output = '';

  $taxonomies = get_terms(array(
    'taxonomy' => 'service_types',
    'ignore_term_order' => TRUE,
    'orderby' => 'count',
    'order' => 'DESC',
    'hide_empty' => true,
  ));

  if (!empty($taxonomies)) :

    $output .= '<script type="text/javascript">';

    $output .= 'var service_types_tax = [';

    foreach ($taxonomies as $category) {

      $term_id = esc_attr($category->term_id);
      $term_name = esc_attr($category->name);

      $output .= '{"term_id":"' . $term_id . '","term_name":"' . $term_name . '"},';
    }

    $output .= '];';

    //$output .= 'console.log(service_types_tax);';

    $output .= '</script>';

  endif;

  return $output;
}

function finderSelectService()
{
  $output = '';
  $output .= '<select class="select_service_type">';

  $taxonomies = get_terms(array(
    'taxonomy' => 'service_types',
    'ignore_term_order' => TRUE,
    'orderby' => 'count',
    'order' => 'DESC',
    'hide_empty' => true,
  ));

  if (!empty($taxonomies)) :

    $output .= '<option value="">Select a service type</option>';

    foreach ($taxonomies as $category) {

      $output .= '<option value="' . esc_attr($category->term_id) . '">' . esc_attr($category->name) . '</option>';
    }
  endif;

  $output .= '</select>';

  return $output;
}

function finderPostCodeInput()
{
  $output = '<div class="service_locator-postcode">';
  $output .= '<input id="input_postcode" type="text" placeholder="Or enter your postcode" />';
  $output .= '<div role="button" class="btn-clear"><svg height="20" width="20" viewBox="0 0 20 20" class="clear-icon" focusable="false" role="presentation"><path d="M14.348 14.849c-0.469 0.469-1.229 0.469-1.697 0l-2.651-3.030-2.651 3.029c-0.469 0.469-1.229 0.469-1.697 0-0.469-0.469-0.469-1.229 0-1.697l2.758-3.15-2.759-3.152c-0.469-0.469-0.469-1.228 0-1.697s1.228-0.469 1.697 0l2.652 3.031 2.651-3.031c0.469-0.469 1.228-0.469 1.697 0s0.469 1.229 0 1.697l-2.758 3.152 2.758 3.15c0.469 0.469 0.469 1.229 0 1.698z"></path></svg></div>';
  $output .= '</div>';
  return $output;
}

function finderSelectServiceType()
{
  $output = '';
  $output .= '<div class="mdc-select mdc-select--filled mb-4 w-full">';
  $output .= '<div class="mdc-select__anchor" role="button" aria-haspopup="listbox" aria-expanded="false" aria-labelledby="service-label service-selected-text">';
  $output .= '<span class="mdc-select__ripple"></span>';
  $output .= '<span id="service-label" class="mdc-floating-label">Select a service</span>';
  $output .= '<span class="mdc-select__selected-text-container">';
  $output .= '<span id="select-service-selected-text" class="mdc-select__selected-text"></span>';
  $output .= '</span>';

  $output .= '<span class="mdc-select__dropdown-icon">';
  $output .= '<svg class="mdc-select__dropdown-icon-graphic" viewBox="7 10 10 5" focusable="false">';
  $output .= '<polygon class="mdc-select__dropdown-icon-inactive" stroke="none" fill-rule="evenodd" points="7 10 12 15 17 10"></polygon>';
  $output .= '<polygon class="mdc-select__dropdown-icon-active" stroke="none" fill-rule="evenodd" points="7 15 12 10 17 15"></polygon>';
  $output .= '</svg>';
  $output .= '</span>';
  $output .= '<span class="mdc-line-ripple"></span>';
  $output .= '</div>';

  $output .= '<div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">';
  $output .= '<ul class="mdc-list" role="listbox" aria-label="Services listbox">';

  $taxonomies = get_terms(array(
    'taxonomy' => 'service_types',
    'hide_empty' => true,
  ));

  if (!empty($taxonomies)) :
    $output .= '<li class="mdc-list-item mdc-list-item--selected" aria-selected="true" data-value="" role="option">';
    $output .= '<span class="mdc-list-item__ripple"></span>';
    $output .= '</li>';

    foreach ($taxonomies as $category) {

      $output .= '<li class="mdc-list-item" aria-selected="false" data-value="' . esc_attr($category->term_id) . '" role="option">';
      $output .= '<span class="mdc-list-item__ripple"></span>';
      $output .= '<span class="mdc-list-item__text">' . esc_attr($category->name) . '</span>';
      $output .= '</li>';
    }
  endif;

  $output .= '</ul>';
  $output .= '</div>';
  $output .= '</div>';

  return $output;
}

?>

<?php get_footer(); ?>