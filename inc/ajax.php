<?php

function filter_posts()
{
  $data_id = $_POST['data_id'];
  $data_taxonomy = $_POST['data_taxonomy'];
  $data_style = $_POST['data_style'];
  if (isset($_POST['per_page'])) {
    $postsPerPage = $_POST['per_page'];
  } else {
    $postsPerPage = -1;
  }

  if ($data_id == 'all') {
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => $postsPerPage,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_status' => 'publish',
    );
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
    echo '<div class="grid grid-cols-3 gap-8">';
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
        featured_card($link, $image, $title);
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


/* ###### Ajax function for pagination ###### */
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
          'post_type'         => 'post',
          'post_status '      => 'publish',
          'orderby'           => 'post_date',
          'order'             => 'DESC',
          'category__in'      => json_decode($terms),
          'posts_per_page'    => $per_page,
          'offset'            => $start
        )
      );
      $count = new WP_Query(
        array(
          'post_type'         => 'post',
          'post_status '      => 'publish',
          'category__in'      => json_decode($terms),
          'posts_per_page'    => -1
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
      echo '<div class="grid grid-cols-3 gap-8">';
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
          featured_card($link, $image, $title);
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