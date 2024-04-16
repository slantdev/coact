<?php

$enable_page_header = true;

$text_color = '#000000';
$text_background_color = 'rgba(69,194,191,0.93)';
$background_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
$background_position = 'center';
$bg_image_class = '';
if ($background_position) {
  $bg_image_class = ' object-' . $background_position;
}

$title = get_the_title();

$text_style = $text_color ? 'color: ' . $text_color . ';' : '';

$text_bg_style = $text_background_color ? 'background-color: ' . $text_background_color . ';' : '';

$enable_breadcrumbs = true;

?>
<section class="bg-gradient-to-b from-brand-light-gray from-90% via-white via-90% to-white">
  <div class="max-w-screen-5xl px-4 mx-auto 4xl:px-8">
    <div class="relative rounded-lg xl:aspect-w-16 xl:aspect-h-6 xl:rounded-3xl overflow-hidden">
      <div class="bg-zinc-300 w-full h-full">
        <?php if ($background_image) : ?>
          <div class="absolute inset-0">
            <img class="object-cover w-full h-full <?php echo $bg_image_class ?>" src="<?php echo $background_image ?>" alt="">
          </div>
        <?php endif; ?>
        <div class="absolute top-0 left-0 w-[1300px] h-[1300px] rounded-full bg-brand-sea bg-opacity-80 -translate-y-1/4 -translate-x-1/4" style="<?php echo $text_bg_style ?>"></div>
        <div class="relative z-10 px-4 py-8 xl:absolute xl:inset-0 xl:flex xl:items-center xl:p-12">
          <div class="container max-w-screen-xxl mx-auto">
            <div class="max-w-lg font-montserrat" style="<?php echo $text_style ?>">
              <?php if ($enable_breadcrumbs) : ?>
                <?php
                if (function_exists('yoast_breadcrumb')) {
                  yoast_breadcrumb('<div class="breadcrumbs text-sm lg:text-base mb-8 xl:mb-16">', '</div>');
                }
                ?>
              <?php endif; ?>
              <?php if ($title) : ?>
                <h2 class="text-xl xl:text-5xl font-bold mb-4"><?php echo $title ?></h2>
              <?php endif; ?>
              <?php
              $post_date = get_the_date('d F Y');
              echo '<div class="text-base lg:text-lg text-black font-medium mt-8">' . $post_date . '</div>';
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-white" style="--section-link-color:#45C2BF;">
  <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">
      <div class="w-full order-1 lg:w-2/3 xl:w-2/3 pt-4">
        <div class="not-prose">
          <h2 class="text-2xl mb-8 xl:mb-12 text-left lg:text-3xl font-bold"><?php echo get_the_title() ?></h2>
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
          <?php the_content() ?>
        </div>
        <?php
        $tags = get_the_tags();
        if ($tags) {
          echo '<div class="mt-20">';
          echo '<strong>Tagged:</strong>&nbsp; &nbsp;';
          $tag_links = array();
          foreach ($tags as $tag) {
            $tag_link = '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="underline hover:no-underline">' . esc_html($tag->name) . '</a>';
            $tag_links[] = $tag_link;
          }
          echo implode(', ', $tag_links);

          echo '</div>';
        }
        ?>
      </div>
      <div class="w-full order-2 lg:w-1/3 xl:w-1/3 pt-4">
        <div class="mb-12">
          <h4 class="text-2xl font-semibold text-brand-sea mb-4">Post categories</h4>
          <?php
          $categories = get_categories(array(
            'hide_empty' => true,
            'orderby' => 'name',
            'order' => 'ASC',
          ));
          if ($categories) {
            echo '<ul class="flex flex-col gap-3">';
          }
          // Loop through each category
          foreach ($categories as $category) {
            echo '<li>';
            echo '<a href="' . get_category_link($category->term_id) . '" class="text-lg hover:underline">' . $category->name . '</a>';

            // Output post count after category name
            echo ' (' . $category->count . ')';

            // Add a line break after each category
            echo '</li>';
          }
          if ($categories) {
            echo '</ul>';
          }
          ?>
        </div>
        <div class="mb-12">
          <h4 class="text-2xl font-semibold text-brand-sea mb-6">Recent posts</h4>
          <?php
          // Define query arguments to get the three most recent posts
          $args = array(
            'posts_per_page' => 3, // Number of posts to retrieve
            'post_status' => 'publish', // Retrieve only published posts
            'orderby' => 'date', // Order by date
            'order' => 'DESC', // Sort in descending order (most recent first)
          );

          // Create a new query
          $query = new WP_Query($args);

          // Check if there are posts
          if ($query->have_posts()) {
            // Start the loop
            while ($query->have_posts()) {
              $query->the_post();
          ?>
              <div class="flex gap-x-8 mb-6">
                <div class="w-1/3">
                  <a href="<?php the_permalink(); ?>" class="block">
                    <?php if (has_post_thumbnail()) { ?>
                      <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                        <?php the_post_thumbnail('thumbnail'); ?>
                      </div>
                    <?php } else { ?>
                      <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                        <div class="bg-slate-200"></div>
                      </div>
                    <?php } ?>
                  </a>
                </div>
                <div class="w-2/3">
                  <h2 class="text-lg font-semibold"><a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a></h2>
                  <div class="mt-4"><?php echo get_the_date('d F Y'); ?></div>
                </div>
              </div>
          <?php
            }
            // Restore original post data
            wp_reset_postdata();
          } else {
            // If no posts found
            echo 'No posts found.';
          }
          ?>

        </div>
      </div>
    </div>
  </div>
</section>

<section class="bg-brand-light-gray">
  <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <?php
    $previous_post = get_previous_post() ?? '';
    $previous_post_link = '';
    if ($previous_post) {
      $previous_post_link = get_permalink($previous_post->ID) ?? '';
    }
    $next_post = get_next_post() ?? '';
    $next_post_link = '';
    if ($next_post) {
      $next_post_link = get_permalink($next_post->ID) ?? '';
    }

    if ($previous_post) {
      echo '<div class="grid grid-cols-2 divide-x divide-slate-300">';
    ?>
      <div class="flex justify-start grow">
        <div class="max-w-sm pr-4">
          <div class="mb-8 flex justify-start">
            <a class="flex gap-x-2 md:gap-x-3 items-center text-brand-sea text-base md:text-lg xl:text-xl font-semibold" href="<?php echo esc_url($previous_post_link); ?>">
              <?php echo coact_icon(array('icon' => 'chevron-circle', 'group' => 'utilities', 'size' => '12', 'class' => 'w-4 h-4 md:w-6 md:h-6 rotate-180 text-brand-sea')); ?>
              <span class="inline-block py-2 border-b border-solid border-brand-sea">Previous post</span>
            </a>
          </div>
          <a href="<?php echo esc_url($previous_post_link); ?>" class="block w-full hover:underline">
            <?php
            $the_thumbnail = get_the_post_thumbnail_url($previous_post->ID, 'large');
            if ($the_thumbnail) {
              echo '<div class="aspect-w-16 aspect-h-9 rounded md:rounded-md lg:rounded-xl overflow-hidden">';
              echo '<img src="' . $the_thumbnail . '" class="w-full h-full object-cover">';
              echo '</div>';
            } else {
              echo '<div class="aspect-w-16 aspect-h-9 rounded md:rounded-md lg:rounded-xl overflow-hidden">';
              echo '<div class="bg-slate-200 w-full h-full"></div>';
              echo '</div>';
            }
            ?>
            <h4 class="text-sm md:text-base lg:text-lg font-medium mt-5"><?php echo esc_html($previous_post->post_title); ?></h4>
          </a>
        </div>
      </div>
    <?php
    }
    if ($next_post) {
    ?>
      <div class="flex justify-end grow">
        <div class="max-w-md pl-4">
          <div class="mb-8 flex justify-end">
            <a class="flex gap-x-3 items-center text-brand-sea text-base md:text-lg xl:text-xl font-semibold" href="<?php echo esc_url($next_post_link); ?>">
              <span class="inline-block py-2 border-b border-solid border-brand-sea">Next post</span>
              <?php echo coact_icon(array('icon' => 'chevron-circle', 'group' => 'utilities', 'size' => '12', 'class' => 'w-4 h-4 md:w-6 md:h-6 text-brand-sea')); ?>
            </a>
          </div>
          <a href="<?php echo esc_url($next_post_link); ?>" class="block w-full hover:underline">
            <?php
            $the_thumbnail = get_the_post_thumbnail_url($next_post->ID, 'large');
            if ($the_thumbnail) {
              echo '<div class="aspect-w-16 aspect-h-9 rounded md:rounded-md lg:rounded-xl  overflow-hidden">';
              echo '<img src="' . $the_thumbnail . '" class="w-full h-full object-cover">';
              echo '</div>';
            } else {
              echo '<div class="aspect-w-16 aspect-h-9 rounded md:rounded-md lg:rounded-xl  overflow-hidden">';
              echo '<div class="bg-slate-200 w-full h-full"></div>';
              echo '</div>';
            }
            ?>
            <h4 class="text-sm md:text-base lg:text-lg font-medium mt-5"><?php echo esc_html($next_post->post_title); ?></h4>
          </a>
        </div>
      </div>
    <?php
      echo '</div>';
    }
    ?>

  </div>
</section>