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
$description = $posts_grid['description'];
$button = $posts_grid['button'];
$select_category = $posts_grid['select_category'];
$card_style = $posts_grid['card_style'];
$posts_per_page = $posts_grid['posts_per_page'];

?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <div class="relative container max-w-screen-xxl mx-auto">
      <div class="relative z-10">
        <div>
          <?php if ($headline) : ?>
            <div class="not-prose">
              <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold"><?php echo $headline ?></h3>
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
                <a href="<?php echo $button['url'] ?>" target="<?php echo $button['target'] ?>" class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-sea text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200"><?php echo $button['title'] ?></a>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="grid grid-cols-3 gap-8">

          <?php
          global $post;

          if ($card_style == 'featured') {
            $firstpost = get_posts(array(
              'posts_per_page' => '1',
              'category'       => $select_category
            ));

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

            $otherposts = get_posts(array(
              'posts_per_page' => '2',
              'offset' => '1',
              'category'       => $select_category
            ));

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
            $myposts = get_posts(array(
              'posts_per_page' => $posts_per_page,
              'category'       => $select_category
            ));

            if ($myposts) {

              foreach ($myposts as $post) :

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
    </div>
  </div>
</section>