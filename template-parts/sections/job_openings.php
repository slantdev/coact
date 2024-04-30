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

$job_openings = get_sub_field('job_openings'); // Group

$headline = $job_openings['headline'] ?? '';
$headline_color = $job_openings['headline_color'] ?? '';
$headline_style = '';
if ($headline_color) {
  $headline_style .= 'color : ' . $headline_color . ';';
}
$headline_html_tag = $job_openings['headline_html_tag'] ?? 'h2';
if ($headline_html_tag == 'default') {
  $headline_html_tag = 'h2';
}
$description = $job_openings['description'] ?? '';
$description_color = $job_openings['description_color'] ?? '';
$description_style = '';
if ($description_color) {
  $description_style .= 'color : ' . $description_color . ';';
}

$select_category = $job_openings['select_category'] ?? '';
$posts_per_page = $job_openings['posts_per_page'] ?? '';
$show_pagination = $job_openings['show_pagination'] ?? '';
$filter_settings = $job_openings['filter_settings'] ?? '';
$show_filter = $filter_settings['show_filter'] ?? '';

$job_openings_id = uniqid();

?>

<section <?php echo $section_id ?> class="relative <?php echo $section_class ?>" style="<?php echo $section_style ?>">
  <?php get_template_part('template-parts/layouts/background_ornament', '', array('shape' => $ornament_shape, 'style' => $ornament_style, 'class' => 'max-w-screen-4xl')); ?>
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="relative container max-w-screen-xxl mx-auto z-10 <?php echo $entrance_animation_class ?>">
      <div class="flex flex-col gap-y-4 lg:flex-row lg:gap-x-10 xl:gap-x-20 lg:items-end">
        <div class="w-full xl:w-2/3">
          <?php
          if ($headline) {
            echo '<div class="not-prose">';
            echo '<' . $headline_html_tag;
            echo ' class="mb-4 xl:mb-8 text-left text-3xl lg:text-4xl font-bold"';
            echo ' style="' . $headline_style . '">';
            echo $headline;
            echo '</' . $headline_html_tag . '>';
            echo '</div>';
          }
          ?>
          <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24">
            <?php if ($description) : ?>
              <div class="w-full lg:w-2/3">
                <div class="prose max-w-none xl:prose-lg mr-auto text-left" style="<?php echo $description_style ?>">
                  <?php echo $description ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <?php
        if ($show_filter) :
          $taxonomy = 'position-type';
          $terms = get_terms(array(
            'taxonomy' => 'position-type',
            'hide_empty' => false
          ));
        ?>
          <div class="w-full xl:w-1/3 flex justify-end">
            <div class="filter-dropdown-<?php echo $job_openings_id ?> dropdown dropdown-end block gap-x-8 min-w-[300px] relative z-20">
              <div tabindex="0" role="button" class="dropdown-button flex justify-between items-center font-bold border-b border-solid border-slate-300 pb-1 mb-1">
                <span class="dropdown-title">Filter</span>
                <?php echo coact_icon(array('icon' => 'chevron-down', 'group' => 'utilities', 'size' => '16', 'class' => 'w-3 h-3')); ?>
              </div>
              <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded border border-slate-200 w-[300px]">
                <?php
                foreach ($terms as $term) :
                ?>
                  <li><button class="filter-button" type="button" data-id="<?php echo $term->term_id ?>"><?php echo $term->name ?></button></li>
                <?php endforeach ?>
              </ul>
            </div>
          </div>
        <?php endif ?>
      </div>
      <div class="relative pt-10">
        <div class="jobs-grid-<?php echo $job_openings_id ?>">
        </div>
        <div class="posts-loader absolute inset-0 bg-white bg-opacity-80 z-10 transition-all duration-500 hidden">
          <div class="h-full w-full flex justify-center">
            <svg class="animate-spin h-8 w-8 text-brand-orange opacity-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="color: var(--section-link-color)">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        jQuery(document).ready(function($) {
          let ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

          function load_all_posts_<?php echo $job_openings_id ?>(page) {
            $('.jobs-grid-<?php echo $job_openings_id ?>').next('.posts-loader').show();
            let select_category = <?php echo json_encode($select_category) ?>;
            let terms = '';
            let pagination = '<?php echo $show_pagination ?>';
            if (select_category) {
              terms = JSON.stringify(select_category);
            }
            //console.log(terms);
            let data = {
              page: page,
              per_page: <?php echo $posts_per_page ?>,
              terms: terms,
              pagination: pagination,
              action: 'pagination_load_jobs',
            };
            //console.log(data);
            $.post(ajaxurl, data, function(response) {
              //console.log(response);
              $('.jobs-grid-<?php echo $job_openings_id ?>').html('').prepend(response);
              $('.jobs-grid-<?php echo $job_openings_id ?>').next('.posts-loader').hide();
            });
          }
          load_all_posts_<?php echo $job_openings_id ?>(1);

          $(document).on(
            'click',
            '.jobs-grid-<?php echo $job_openings_id ?> .ajax-pagination li.active',
            function() {
              $('html').animate({
                  scrollTop: $(".jobs-grid-<?php echo $job_openings_id ?>").offset().top - 100,
                },
                800
              );
              let page = $(this).data('page');
              load_all_posts_<?php echo $job_openings_id ?>(page);
            }
          );

          function filter_jobsgrid_<?php echo $job_openings_id ?>(page, terms) {
            $('.jobs-grid-<?php echo $job_openings_id ?>').next('.posts-loader').show();
            let pagination = false;
            // if (select_category) {
            //   terms = JSON.stringify(select_category);
            // }
            //console.log(terms);
            let data = {
              page: page,
              per_page: <?php echo $posts_per_page ?>,
              terms: terms,
              pagination: pagination,
              action: 'filter_jobsgrid',
            };
            //console.log(data);
            $.post(ajaxurl, data, function(response) {
              //console.log(response);
              $('.jobs-grid-<?php echo $job_openings_id ?>').html('').prepend(response);
              $('.jobs-grid-<?php echo $job_openings_id ?>').next('.posts-loader').hide();
            });
          }

          $(document).on(
            'click',
            '.filter-dropdown-<?php echo $job_openings_id ?> .filter-button',
            function() {
              $term_id = $(this).data('id');
              $term_name = $(this).text();
              $('.filter-dropdown-<?php echo $job_openings_id ?> .dropdown-title').text($term_name);
              $(this).blur();
              filter_jobsgrid_<?php echo $job_openings_id ?>(1, $term_id);
            }
          );

          $('.posts-filter-<?php echo $job_openings_id ?> .filter-button').on('click', function(event) {
            $('.posts-filter-<?php echo $job_openings_id ?> .filter-button').removeClass('filter-active');
            $(this).addClass('filter-active');
            let data_id = $(this).data('id');
            let select_category = <?php echo json_encode($select_category) ?>;
            let data_category = '';
            if (select_category) {
              data_category = JSON.stringify(select_category);
            }
            let data_taxonomy = $(this).data('taxonomy');
            let pagination = '<?php echo $show_pagination ?>';
            $.ajax({
              type: 'POST',
              url: ajaxurl,
              dataType: 'html',
              data: {
                action: 'filter_posts',
                data_id: data_id,
                data_category: data_category,
                data_taxonomy: data_taxonomy,
                per_page: <?php echo $posts_per_page ?>,
                //page: page,
                pagination: pagination,
              },
              beforeSend: function() {
                $('.jobs-grid-<?php echo $job_openings_id ?>').next('.posts-loader').show();
              },
              success: function(res) {
                $('.jobs-grid-<?php echo $job_openings_id ?>').html(res);
                $('.jobs-grid-<?php echo $job_openings_id ?>').next('.posts-loader').hide();
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