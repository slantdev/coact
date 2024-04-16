<?php
/* ######
 * Ajax function load posts with pagination 
 * ###### 
 */

// Load Posts
add_action('wp_ajax_pagination_load_posts', 'pagination_load_posts');
add_action('wp_ajax_nopriv_pagination_load_posts', 'pagination_load_posts');
function pagination_load_posts()
{
  global $wpdb;
  // Set default variables
  $msg = '';
  if (isset($_POST['page'])) {
    // Sanitize the received page
    $page = sanitize_text_field($_POST['page']);
    $per_page = sanitize_text_field($_POST['per_page']);
    $pagination = sanitize_text_field($_POST['pagination']);
    $card_style = sanitize_text_field($_POST['card_style']);
    $terms = sanitize_text_field($_POST['terms']);
    $terms = json_decode(stripslashes($terms));
    $tags = sanitize_text_field($_POST['tags']);
    $tags = json_decode(stripslashes($tags));
    $cur_page = $page;
    $page -= 1;
    $previous_btn = true;
    $next_btn = true;
    $first_btn = true;
    $last_btn = true;
    $start = $page * $per_page;

    if ($terms) {
      if (!empty($tags)) {
        $all_blog_posts = new WP_Query(
          array(
            'post_type'         => 'post',
            'post_status '      => 'publish',
            'orderby'           => 'post_date',
            'order'             => 'DESC',
            'posts_per_page'    => $per_page,
            'offset'            => $start,
            'tax_query' => array(
              'relation' => 'AND',
              array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $terms,
              ),
              array(
                'taxonomy' => 'post_tag',
                'field' => 'id',
                'terms' => $tags,
              ),
            ),
          )
        );
        $count = new WP_Query(
          array(
            'post_type'         => 'post',
            'post_status '      => 'publish',
            'posts_per_page'    => -1,
            'tax_query' => array(
              'relation' => 'AND',
              array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $terms,
              ),
              array(
                'taxonomy' => 'post_tag',
                'field' => 'id',
                'terms' => $tags,
              ),
            ),
          )
        );
      } else {
        $all_blog_posts = new WP_Query(
          array(
            'post_type'         => 'post',
            'post_status '      => 'publish',
            'orderby'           => 'post_date',
            'order'             => 'DESC',
            'posts_per_page'    => $per_page,
            'offset'            => $start,
            'tax_query' => array(
              array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $terms,
              ),
            ),
          )
        );
        $count = new WP_Query(
          array(
            'post_type'         => 'post',
            'post_status '      => 'publish',
            'posts_per_page'    => -1,
            'tax_query' => array(
              array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $terms,
              ),
            ),
          )
        );
      }
    } else {
      $all_blog_posts = new WP_Query(
        array(
          'post_type'         => 'post',
          'post_status '      => 'publish',
          'orderby'           => 'post_date',
          'order'             => 'DESC',
          'posts_per_page'    => $per_page,
          'offset'            => $start
        )
      );
      $count = new WP_Query(
        array(
          'post_type'         => 'post',
          'post_status '      => 'publish',
          'posts_per_page'    => -1
        )
      );
    }

    $count = $count->post_count;
    if ($all_blog_posts->have_posts()) {
      echo '<div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">';
      while ($all_blog_posts->have_posts()) {
        $all_blog_posts->the_post();
        $image = get_the_post_thumbnail_url(get_the_ID(), 'large');
        $title =  get_the_title();
        $date =  get_the_date();
        $excerpt = wp_trim_words(get_the_excerpt(), $num_words = 30, $more = null);
        $link = get_the_permalink();
        if ($card_style == 'card') {
          shadow_card($link, $image, $title, $excerpt);
        } else if ($card_style == 'featured') {
          featured_card($link, $image, $title, $excerpt);
        } else {
          plain_card($link, $image, $title, $excerpt);
        }
      }
      echo '</div>';
    }

    if ($pagination) :
      // Paginations
      $no_of_paginations = ceil($count / $per_page);
      if ($cur_page >= 7) {
        $start_loop = $cur_page - 3;
        if ($no_of_paginations > $cur_page + 3)
          $end_loop = $cur_page + 3;
        else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
          $start_loop = $no_of_paginations - 6;
          $end_loop = $no_of_paginations;
        } else {
          $end_loop = $no_of_paginations;
        }
      } else {
        $start_loop = 1;
        if ($no_of_paginations > 7)
          $end_loop = 7;
        else
          $end_loop = $no_of_paginations;
      }
      // Pagination Buttons logic
?>
      <div class='posts-pagination mt-10 pt-4 border-t border-slate-200'>
        <ul>
          <?php if ($first_btn && $cur_page > 1) { ?>
            <li data-page='1' class='active'>&laquo;</li>
          <?php } else if ($first_btn) { ?>
            <li data-page='1' class='inactive'>&laquo;</li>
          <?php } ?>
          <?php if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
          ?>
            <li data-page='<?php echo $pre; ?>' class='active'>&lsaquo;</li>
          <?php } else if ($previous_btn) { ?>
            <li class='inactive p-2'>&lsaquo;</li>
          <?php } ?>
          <?php for ($i = $start_loop; $i <= $end_loop; $i++) {
            if ($cur_page == $i) {
          ?>
              <li data-page='<?php echo $i; ?>' class='selected'><?php echo $i; ?></li>
            <?php } else { ?>
              <li data-page='<?php echo $i; ?>' class='active'><?php echo $i; ?></li>
          <?php }
          } ?>
          <?php if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1; ?>
            <li data-page='<?php echo $nex; ?>' class='active'>&rsaquo;</li>
          <?php } else if ($next_btn) { ?>
            <li class='inactive'>&rsaquo;</li>
          <?php } ?>
          <?php if ($last_btn && $cur_page < $no_of_paginations) { ?>
            <li data-page='<?php echo $no_of_paginations; ?>' class='active'>&raquo;</li>
          <?php } else if ($last_btn) { ?>
            <li data-page='<?php echo $no_of_paginations; ?>' class='inactive'>&raquo;</li>
          <?php } ?>
        </ul>
      </div>
    <?php
    endif;
  }
  exit();
}

// Load Coact TV
add_action('wp_ajax_pagination_load_coact_tv', 'pagination_load_coact_tv');
add_action('wp_ajax_nopriv_pagination_load_coact_tv', 'pagination_load_coact_tv');
function pagination_load_coact_tv()
{
  global $wpdb;
  // Set default variables
  $msg = '';
  if (isset($_POST['page'])) {
    // Sanitize the received page
    $page = sanitize_text_field($_POST['page']);
    $per_page = sanitize_text_field($_POST['per_page']);
    $pagination = sanitize_text_field($_POST['pagination']);
    $card_style = sanitize_text_field($_POST['card_style']);
    $terms = sanitize_text_field($_POST['terms']);
    $terms = json_decode(stripslashes($terms));
    $cur_page = $page;
    $page -= 1;
    $previous_btn = true;
    $next_btn = true;
    $first_btn = true;
    $last_btn = true;
    $start = $page * $per_page;

    if ($terms) {
      $all_blog_posts = new WP_Query(
        array(
          'post_type'         => 'coact-tv',
          'post_status '      => 'publish',
          'orderby'           => 'post_date',
          'order'             => 'DESC',
          'posts_per_page'    => $per_page,
          'offset'            => $start,
          'tax_query' => array(
            array(
              'taxonomy' => 'coact-tv-category',
              'field' => 'id',
              'terms' => $terms,
            ),
          ),
        )
      );
      $count = new WP_Query(
        array(
          'post_type'         => 'coact-tv',
          'post_status '      => 'publish',
          'posts_per_page'    => -1,
          'tax_query' => array(
            array(
              'taxonomy' => 'coact-tv-category',
              'field' => 'id',
              'terms' => $terms,
            ),
          ),
        )
      );
    } else {
      $all_blog_posts = new WP_Query(
        array(
          'post_type'         => 'coact-tv',
          'post_status '      => 'publish',
          'orderby'           => 'post_date',
          'order'             => 'DESC',
          'posts_per_page'    => $per_page,
          'offset'            => $start
        )
      );
      $count = new WP_Query(
        array(
          'post_type'         => 'coact-tv',
          'post_status '      => 'publish',
          'posts_per_page'    => -1
        )
      );
    }

    $count = $count->post_count;
    if ($all_blog_posts->have_posts()) {
      $postCount = 0;
      //echo $count;
      echo '<div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">';
      while ($all_blog_posts->have_posts()) {
        $postCount++;
        $all_blog_posts->the_post();
        $id = get_the_ID();
        //$image = get_the_post_thumbnail_url($id, 'large');
        $title =  get_the_title();
        $video_uri = get_post_meta($id, 'video_embed', true);
        $date =  get_the_date();
        $image = get_video_thumbnail_uri($video_uri);
        $excerpt = wp_trim_words(get_the_excerpt(), $num_words = 30, $more = null);
        $link = get_the_permalink();
        if ($card_style == 'card') {
          shadow_card($link, $image, $title, $excerpt);
        } else if ($card_style == 'featured') {
          if ($count > 1 && $postCount == 1) {
            echo '<div class="lg:col-span-2">';
            featured_card($link, $image, $title, $excerpt, true);
            echo '</div>';
          } else {
            if ($count > 1 && $postCount == 2) {
              echo '<div class="lg:col-span-1 grid grid-cols-1 gap-4">';
              featured_card($link, $image, $title, $excerpt, false);
            }
            if ($count == 2 && $postCount == 2) {
              echo '</div>';
            }
            if ($count > 2 && $postCount == 3) {
              featured_card($link, $image, $title, $excerpt, false);
              echo '</div>';
            }
            if ($count > 2 && $postCount > 3) {
              featured_card($link, $image, $title, $excerpt, false);
            }
          }
        } else {
          plain_card($link, $image, $title, $excerpt);
        }
      }
      echo '</div>';
    }

    if ($pagination) :
      // Paginations
      $no_of_paginations = ceil($count / $per_page);
      if ($cur_page >= 7) {
        $start_loop = $cur_page - 3;
        if ($no_of_paginations > $cur_page + 3)
          $end_loop = $cur_page + 3;
        else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
          $start_loop = $no_of_paginations - 6;
          $end_loop = $no_of_paginations;
        } else {
          $end_loop = $no_of_paginations;
        }
      } else {
        $start_loop = 1;
        if ($no_of_paginations > 7)
          $end_loop = 7;
        else
          $end_loop = $no_of_paginations;
      }
      // Pagination Buttons logic
    ?>
      <div class='posts-pagination mt-10 pt-4 border-t border-slate-200'>
        <ul>
          <?php if ($first_btn && $cur_page > 1) { ?>
            <li data-page='1' class='active'>&laquo;</li>
          <?php } else if ($first_btn) { ?>
            <li data-page='1' class='inactive'>&laquo;</li>
          <?php } ?>
          <?php if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
          ?>
            <li data-page='<?php echo $pre; ?>' class='active'>&lsaquo;</li>
          <?php } else if ($previous_btn) { ?>
            <li class='inactive p-2'>&lsaquo;</li>
          <?php } ?>
          <?php for ($i = $start_loop; $i <= $end_loop; $i++) {
            if ($cur_page == $i) {
          ?>
              <li data-page='<?php echo $i; ?>' class='selected'><?php echo $i; ?></li>
            <?php } else { ?>
              <li data-page='<?php echo $i; ?>' class='active'><?php echo $i; ?></li>
          <?php }
          } ?>
          <?php if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1; ?>
            <li data-page='<?php echo $nex; ?>' class='active'>&rsaquo;</li>
          <?php } else if ($next_btn) { ?>
            <li class='inactive'>&rsaquo;</li>
          <?php } ?>
          <?php if ($last_btn && $cur_page < $no_of_paginations) { ?>
            <li data-page='<?php echo $no_of_paginations; ?>' class='active'>&raquo;</li>
          <?php } else if ($last_btn) { ?>
            <li data-page='<?php echo $no_of_paginations; ?>' class='inactive'>&raquo;</li>
          <?php } ?>
        </ul>
      </div>
    <?php
    endif;
  }
  exit();
}

// Load Jobs
add_action('wp_ajax_pagination_load_jobs', 'pagination_load_jobs');
add_action('wp_ajax_nopriv_pagination_load_jobs', 'pagination_load_jobs');
function pagination_load_jobs()
{
  global $wpdb;
  // Set default variables
  $msg = '';
  if (isset($_POST['page'])) {
    // Sanitize the received page
    $page = sanitize_text_field($_POST['page']);
    $per_page = sanitize_text_field($_POST['per_page']);
    $pagination = sanitize_text_field($_POST['pagination']);
    $card_style = sanitize_text_field($_POST['card_style']);
    $terms = sanitize_text_field($_POST['terms']);
    $terms = json_decode(stripslashes($terms));
    $cur_page = $page;
    $page -= 1;
    $previous_btn = true;
    $next_btn = true;
    $first_btn = true;
    $last_btn = true;
    $start = $page * $per_page;

    if ($terms) {
      $all_blog_posts = new WP_Query(
        array(
          'post_type'         => 'job',
          'post_status '      => 'publish',
          'orderby'           => 'post_date',
          'order'             => 'DESC',
          'posts_per_page'    => $per_page,
          'offset'            => $start,
          'tax_query' => array(
            array(
              'taxonomy' => 'position-type',
              'field' => 'id',
              'terms' => $terms,
            ),
          ),
        )
      );
      $count = new WP_Query(
        array(
          'post_type'         => 'job',
          'post_status '      => 'publish',
          'posts_per_page'    => -1,
          'tax_query' => array(
            array(
              'taxonomy' => 'position-type',
              'field' => 'id',
              'terms' => $terms,
            ),
          ),
        )
      );
    } else {
      $all_blog_posts = new WP_Query(
        array(
          'post_type'         => 'job',
          'post_status '      => 'publish',
          'orderby'           => 'post_date',
          'order'             => 'DESC',
          'posts_per_page'    => $per_page,
          'offset'            => $start
        )
      );
      $count = new WP_Query(
        array(
          'post_type'         => 'job',
          'post_status '      => 'publish',
          'posts_per_page'    => -1
        )
      );
    }

    $count = $count->post_count;
    if ($all_blog_posts->have_posts()) {
      echo '<div class="grid grid-cols-1 lg:gap-4">';
      while ($all_blog_posts->have_posts()) {
        $all_blog_posts->the_post();
        $image = get_the_post_thumbnail_url(get_the_ID(), 'large');
        $title =  get_the_title();
        $excerpt = wp_trim_words(get_the_excerpt(), $num_words = 30, $more = null);
        $link = get_the_permalink();
        echo '<div class="border-b border-solid border-slate-200 py-6">';
        echo '<h3 class="text-xl lg:text-2xl font-medium"><a href="' . $link . '" class="hover:underline">' . $title . '</a></h3>';
        echo '<div class="flex flex-col lg:flex-row lg:items-center lg:gap-8 pt-4">';
        echo '<div class="w-full lg:w-3/4 text-sm lg:text-base">' . $excerpt . '</div>';
        echo '<div class="w-full pt-4 lg:pt-0 lg:w-1/4 lg:text-right">
              <a href="' . $link . '" class="inline-block rounded-full font-poppins font-semibold px-6 py-2 text-sm lg:text-lg lg:px-8 lg:py-3 bg-brand-orange text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">View Details</a>
            </div>';
        echo '</div>';
        echo '</div>';
      }
      echo '</div>';
    }

    if ($pagination) :
      // Paginations
      $no_of_paginations = ceil($count / $per_page);
      if ($cur_page >= 7) {
        $start_loop = $cur_page - 3;
        if ($no_of_paginations > $cur_page + 3)
          $end_loop = $cur_page + 3;
        else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
          $start_loop = $no_of_paginations - 6;
          $end_loop = $no_of_paginations;
        } else {
          $end_loop = $no_of_paginations;
        }
      } else {
        $start_loop = 1;
        if ($no_of_paginations > 7)
          $end_loop = 7;
        else
          $end_loop = $no_of_paginations;
      }
      // Pagination Buttons logic
    ?>
      <div class='ajax-pagination mt-10 pt-4'>
        <ul>
          <?php if ($first_btn && $cur_page > 1) { ?>
            <li data-page='1' class='active'>&laquo;</li>
          <?php } else if ($first_btn) { ?>
            <li data-page='1' class='inactive'>&laquo;</li>
          <?php } ?>
          <?php if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
          ?>
            <li data-page='<?php echo $pre; ?>' class='active'>&lsaquo;</li>
          <?php } else if ($previous_btn) { ?>
            <li class='inactive p-2'>&lsaquo;</li>
          <?php } ?>
          <?php for ($i = $start_loop; $i <= $end_loop; $i++) {
            if ($cur_page == $i) {
          ?>
              <li data-page='<?php echo $i; ?>' class='selected'><?php echo $i; ?></li>
            <?php } else { ?>
              <li data-page='<?php echo $i; ?>' class='active'><?php echo $i; ?></li>
          <?php }
          } ?>
          <?php if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1; ?>
            <li data-page='<?php echo $nex; ?>' class='active'>&rsaquo;</li>
          <?php } else if ($next_btn) { ?>
            <li class='inactive'>&rsaquo;</li>
          <?php } ?>
          <?php if ($last_btn && $cur_page < $no_of_paginations) { ?>
            <li data-page='<?php echo $no_of_paginations; ?>' class='active'>&raquo;</li>
          <?php } else if ($last_btn) { ?>
            <li data-page='<?php echo $no_of_paginations; ?>' class='inactive'>&raquo;</li>
          <?php } ?>
        </ul>
      </div>
    <?php
    endif;
  }
  exit();
}

// Load State Suburb
add_action('wp_ajax_pagination_load_state_suburb', 'load_state_suburb');
add_action('wp_ajax_nopriv_load_state_suburb', 'load_state_suburb');
function load_state_suburb()
{
  if (isset($_POST['data_id'])) {
    // Sanitize the received page
    $data_id = sanitize_text_field($_POST['data_id']);
    $data_title = sanitize_text_field($_POST['data_title']);

    //echo $data_title;

    $taxonomy = 'state-suburb';
    $parent_term_id = $data_id;
    $child_terms = get_term_children($parent_term_id, $taxonomy);

    if ($data_title) {
      echo '<h4 class="text-xl md:text-2xl text-brand-sea mb-8 mt-4 font-bold">' . $data_title . '</h4>';
    }

    if (!empty($child_terms) && !is_wp_error($child_terms)) {

      // Sort the child terms alphabetically by name
      usort($child_terms, function ($a, $b) {
        $term_a = get_term($a, 'state-suburb');
        $term_b = get_term($b, 'state-suburb');
        return strcmp($term_a->name, $term_b->name);
      });

      echo '<ul class="suburb-columns">';
      foreach ($child_terms as $child_term_id) {
        $child_term = get_term_by('id', $child_term_id, $taxonomy);
        echo '<li>';
        echo '<button class="button-suburb text-xl underline hover:font-medium py-3" type="button">' . $child_term->name . '</button>';
        echo '</li>';
      }
      echo '</ul>';
    } else {
      echo '<div class="text-center">No suburb found for this state.</div>';
    }
  }
  exit();
}

// Load FAQS
add_action('wp_ajax_pagination_load_faqs', 'pagination_load_faqs');
add_action('wp_ajax_nopriv_pagination_load_faqs', 'pagination_load_faqs');
function pagination_load_faqs()
{
  global $wpdb;
  // Set default variables
  $msg = '';
  if (isset($_POST['page'])) {
    // Sanitize the received page
    $faq_id = sanitize_text_field($_POST['faq_id']);
    $page = sanitize_text_field($_POST['page']);
    $per_page = sanitize_text_field($_POST['per_page']);
    $pagination = sanitize_text_field($_POST['pagination']);
    $terms = sanitize_text_field($_POST['terms']);
    $terms = json_decode(stripslashes($terms));
    $cur_page = $page;
    $page -= 1;
    $previous_btn = true;
    $next_btn = true;
    $first_btn = true;
    $last_btn = true;
    $start = $page * $per_page;

    if ($terms) {
      $all_faqs = new WP_Query(
        array(
          'post_type'         => 'faq',
          'post_status '      => 'publish',
          'orderby'           => 'menu_order',
          'order'             => 'ASC',
          'posts_per_page'    => $per_page,
          'offset'            => $start,
          'tax_query' => array(
            array(
              'taxonomy' => 'faq-category',
              'field' => 'id',
              'terms' => $terms,
            ),
          ),
        )
      );
      $count = new WP_Query(
        array(
          'post_type'         => 'faq',
          'post_status '      => 'publish',
          'orderby'           => 'menu_order',
          'order'             => 'ASC',
          'posts_per_page'    => -1,
          'tax_query' => array(
            array(
              'taxonomy' => 'faq-category',
              'field' => 'id',
              'terms' => $terms,
            ),
          ),
        )
      );
    } else {
      $all_faqs = new WP_Query(
        array(
          'post_type'         => 'faq',
          'post_status '      => 'publish',
          'orderby'           => 'menu_order',
          'order'             => 'ASC',
          'posts_per_page'    => $per_page,
          'offset'            => $start
        )
      );
      $count = new WP_Query(
        array(
          'post_type'         => 'faq',
          'post_status '      => 'publish',
          'orderby'           => 'menu_order',
          'order'             => 'ASC',
          'posts_per_page'    => -1
        )
      );
    }

    $count = $count->post_count;
    if ($all_faqs->have_posts()) {
      while ($all_faqs->have_posts()) {
        $all_faqs->the_post();
        echo '<div class="collapse collapse-plus bg-brand-light-gray rounded-lg border border-slate-300 shadow-md mb-6">';
        echo '<input type="checkbox" class="faq-radio-btn w-full h-full block" name="faq-' . $faq_id . '" />';
        echo '<div class="collapse-title bg-white text-xl lg:text-2xl border-b border-slate-300 font-medium py-5 pl-8 pr-12 after:font-thin after:!end-8 after:text-brand-sea after:!top-2 after:text-3xl after:lg:text-5xl">';
        echo get_the_title();
        echo '</div>';
        echo '<div class="collapse-content p-0">';
        echo '<div class="p-8">';
        echo '<div class="prose lg:prose-lg max-w-none">';
        the_content();
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    }

    if ($pagination) :
      // Paginations
      $no_of_paginations = ceil($count / $per_page);
      if ($cur_page >= 7) {
        $start_loop = $cur_page - 3;
        if ($no_of_paginations > $cur_page + 3)
          $end_loop = $cur_page + 3;
        else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
          $start_loop = $no_of_paginations - 6;
          $end_loop = $no_of_paginations;
        } else {
          $end_loop = $no_of_paginations;
        }
      } else {
        $start_loop = 1;
        if ($no_of_paginations > 7)
          $end_loop = 7;
        else
          $end_loop = $no_of_paginations;
      }
      // Pagination Buttons logic
    ?>
      <div class='posts-pagination mt-10 pt-4 border-t border-slate-200'>
        <ul>
          <?php if ($first_btn && $cur_page > 1) { ?>
            <li data-page='1' class='active'>&laquo;</li>
          <?php } else if ($first_btn) { ?>
            <li data-page='1' class='inactive'>&laquo;</li>
          <?php } ?>
          <?php if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
          ?>
            <li data-page='<?php echo $pre; ?>' class='active'>&lsaquo;</li>
          <?php } else if ($previous_btn) { ?>
            <li class='inactive p-2'>&lsaquo;</li>
          <?php } ?>
          <?php for ($i = $start_loop; $i <= $end_loop; $i++) {
            if ($cur_page == $i) {
          ?>
              <li data-page='<?php echo $i; ?>' class='selected'><?php echo $i; ?></li>
            <?php } else { ?>
              <li data-page='<?php echo $i; ?>' class='active'><?php echo $i; ?></li>
          <?php }
          } ?>
          <?php if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1; ?>
            <li data-page='<?php echo $nex; ?>' class='active'>&rsaquo;</li>
          <?php } else if ($next_btn) { ?>
            <li class='inactive'>&rsaquo;</li>
          <?php } ?>
          <?php if ($last_btn && $cur_page < $no_of_paginations) { ?>
            <li data-page='<?php echo $no_of_paginations; ?>' class='active'>&raquo;</li>
          <?php } else if ($last_btn) { ?>
            <li data-page='<?php echo $no_of_paginations; ?>' class='inactive'>&raquo;</li>
          <?php } ?>
        </ul>
      </div>
<?php
    endif;
  }
  exit();
}

/* ######
 * Ajax function filter posts
 * ###### 
 */
// Filter Posts
function filter_state_suburb()
{
  $data_id = sanitize_text_field($_POST['data_id']);
  $data_title = sanitize_text_field($_POST['data_title']);
  $taxonomy = 'state-suburb';
  $parent_term_id = $data_id;
  $child_terms = get_term_children($parent_term_id, $taxonomy);
  $response = '';
  if ($data_title) {
    $response .= '<h4 class="text-xl md:text-2xl text-brand-sea mb-8 mt-4 font-bold">' . $data_title . '</h4>';
  }
  if (!empty($child_terms) && !is_wp_error($child_terms)) {
    // Sort the child terms alphabetically by name
    usort($child_terms, function ($a, $b) {
      $term_a = get_term($a, 'state-suburb');
      $term_b = get_term($b, 'state-suburb');
      return strcmp($term_a->name, $term_b->name);
    });
    $response .= '<ul class="suburb-columns">';
    foreach ($child_terms as $child_term_id) {
      $child_term = get_term_by('id', $child_term_id, $taxonomy);
      $response .= '<li>';
      $response .= '<button class="button-suburb text-base lg:text-xl underline hover:font-medium py-1.5 md:py-2 lg:py-3" type="button">' . $child_term->name . '</button>';
      $response .= '</li>';
    }
    $response .= '</ul>';
  } else {
    $response .= '<div class="text-center">No suburb found for this state.</div>';
  }
  echo $response;
  exit;
}
add_action('wp_ajax_filter_state_suburb', 'filter_state_suburb');
add_action('wp_ajax_nopriv_filter_state_suburb', 'filter_state_suburb');

// Filter Posts
function filter_posts()
{
  $data_id = $_POST['data_id'];
  $data_taxonomy = $_POST['data_taxonomy'];
  $data_style = $_POST['data_style'];
  $data_category = sanitize_text_field($_POST['data_category']);
  $data_category = json_decode(stripslashes($data_category));
  if (isset($_POST['per_page'])) {
    $postsPerPage = $_POST['per_page'];
  } else {
    $postsPerPage = -1;
  }

  if ($data_id == 'all') {
    if ($data_category) {
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => $postsPerPage,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'tax_query' => array(
          array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $data_category,
          ),
        ),
      );
    } else {
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => $postsPerPage,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
      );
    }
  } else {
    if ($data_taxonomy) {
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => $postsPerPage,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'tax_query' => array(
          array(
            'taxonomy' => $data_taxonomy,
            'field'    => 'term_id',
            'terms'    => $data_id,
          ),
        ),
      );
    }
  }

  $ajaxposts = new WP_Query($args);

  $response = '';

  if ($ajaxposts->have_posts()) {
    echo '<div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">';
    while ($ajaxposts->have_posts()) {
      $ajaxposts->the_post();
      $image = get_the_post_thumbnail_url(get_the_ID(), 'large');
      $title =  get_the_title();
      $date =  get_the_date();
      $excerpt = wp_trim_words(get_the_excerpt(), $num_words = 30, $more = null);
      $link = get_the_permalink();
      if ($data_style == 'card') {
        shadow_card($link, $image, $title, $excerpt);
      } else if ($data_style == 'featured') {
        featured_card($link, $image, $title, $excerpt);
      } else {
        plain_card($link, $image, $title, $excerpt);
      }
    }
    echo '</div>';
  } else {
    $response = '<div class="text-center py-4 px-8">No Posts Found</div>';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');

// Filter Coact TV
function filter_coact_tv()
{
  $data_id = $_POST['data_id'];
  $data_taxonomy = $_POST['data_taxonomy'];
  $data_style = $_POST['data_style'];
  $data_category = sanitize_text_field($_POST['data_category']);
  $data_category = json_decode(stripslashes($data_category));
  if (isset($_POST['per_page'])) {
    $postsPerPage = $_POST['per_page'];
  } else {
    $postsPerPage = -1;
  }

  if ($data_id == 'all') {
    if ($data_category) {
      $args = array(
        'post_type' => 'coact-tv',
        'posts_per_page' => $postsPerPage,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'tax_query' => array(
          array(
            'taxonomy' => 'coact-tv-category',
            'field' => 'term_id',
            'terms' => $data_category,
          ),
        ),
      );
    } else {
      $args = array(
        'post_type' => 'coact-tv',
        'posts_per_page' => $postsPerPage,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
      );
    }
  } else {
    if ($data_taxonomy) {
      $args = array(
        'post_type' => 'coact-tv',
        'posts_per_page' => $postsPerPage,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'tax_query' => array(
          array(
            'taxonomy' => $data_taxonomy,
            'field'    => 'term_id',
            'terms'    => $data_id,
          ),
        ),
      );
    }
  }

  $ajaxposts = new WP_Query($args);

  $response = '';

  $count = $ajaxposts->post_count;
  if ($ajaxposts->have_posts()) {
    $postCount = 0;
    //echo $count;
    echo '<div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">';
    while ($ajaxposts->have_posts()) {
      $postCount++;
      $ajaxposts->the_post();
      $id = get_the_ID();
      //$image = get_the_post_thumbnail_url($id, 'large');
      $title =  get_the_title();
      $video_uri = get_post_meta($id, 'video_embed', true);
      $date =  get_the_date();
      $image = get_video_thumbnail_uri($video_uri);
      $excerpt = wp_trim_words(get_the_excerpt(), $num_words = 30, $more = null);
      $link = get_the_permalink();
      if ($data_style == 'card') {
        shadow_card($link, $image, $title, $excerpt);
      } else if ($data_style == 'featured') {
        if ($count > 1 && $postCount == 1) {
          echo '<div class="col-span-2">';
          featured_card($link, $image, $title, $excerpt, true);
          echo '</div>';
        } else {
          if ($count > 1 && $postCount == 2) {
            echo '<div class="col-span-1 grid grid-cols-1 gap-4">';
            featured_card($link, $image, $title, $excerpt, false);
          }
          if ($count == 2 && $postCount == 2) {
            echo '</div>';
          }
          if ($count > 2 && $postCount == 3) {
            featured_card($link, $image, $title, $excerpt, false);
            echo '</div>';
          }
          if ($count > 2 && $postCount > 3) {
            featured_card($link, $image, $title, $excerpt, false);
          }
        }
      } else {
        plain_card($link, $image, $title, $excerpt);
      }
    }
    echo '</div>';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_filter_coact_tv', 'filter_coact_tv');
add_action('wp_ajax_nopriv_filter_coact_tv', 'filter_coact_tv');

// Filter FAQ
function filter_faqs()
{
  $faq_id = sanitize_text_field($_POST['faq_id']);
  $faq_term = sanitize_text_field($_POST['faq_term']);

  $args = array(
    'post_type'         => 'faq',
    'post_status '      => 'publish',
    'orderby'           => 'menu_order',
    'order'             => 'ASC',
    'posts_per_page'    => '-1',
    'tax_query' => array(
      array(
        'taxonomy' => 'faq-category',
        'field' => 'id',
        'terms' => $faq_term,
      ),
    ),
  );

  $ajaxposts = new WP_Query($args);

  $response = '';

  if ($ajaxposts->have_posts()) {
    while ($ajaxposts->have_posts()) {
      $ajaxposts->the_post();
      $id = get_the_ID();
      $content = get_the_content('null', false, $id);
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);

      $response .= '<div class="collapse collapse-plus bg-brand-light-gray rounded-lg border border-slate-300 shadow-md mb-6">';
      $response .=  '<input type="radio" class="faq-radio-btn w-full h-full block" name="faq-' . $faq_id . '" />';
      $response .=  '<div class="collapse-title bg-white text-xl lg:text-2xl border-b border-slate-300 font-medium py-5 pl-8 pr-12 after:font-thin after:!end-8 after:text-brand-sea after:!top-2 after:text-3xl after:lg:text-5xl">';
      $response .=  get_the_title();
      $response .=  '</div>';
      $response .=  '<div class="collapse-content p-0">';
      $response .=  '<div class="p-8">';
      $response .=  '<div class="prose lg:prose-lg max-w-none">';
      $response .= $content;
      $response .=  '</div>';
      $response .=  '</div>';
      $response .=  '</div>';
      $response .=  '</div>';
    }
  } else {
    $response = '<div class="text-center py-4 px-8">No FAQs Found</div>';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_filter_faqs', 'filter_faqs');
add_action('wp_ajax_nopriv_filter_faqs', 'filter_faqs');
