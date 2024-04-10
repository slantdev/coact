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

$text_card_grid = get_sub_field('text_card_grid');
$intro = $text_card_grid['intro'];
$headline = $intro['headline'];
$description = $intro['description'];
$text_cards = $text_card_grid['text_cards']; // Repeater

?>

<section <?php echo $section_id ?> class="relative <?php echo $section_class ?>" style="<?php echo $section_style ?>">
  <?php get_template_part('template-parts/layouts/background_ornament', '', array('shape' => $ornament_shape, 'style' => $ornament_style, 'class' => 'max-w-screen-4xl')); ?>
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="container max-w-screen-xxl mx-auto animation-wrapper">
      <div class="relative z-10 mx-auto <?php echo $entrance_animation_class ?>">
        <?php if ($headline || $description) : ?>
          <div class="text-center max-w-prose mx-auto mb-14">
            <?php if ($headline) : ?>
              <div class="not-prose">
                <h3 class="mb-8 xl:mb-12 text-4xl font-bold"><?php echo $headline ?></h3>
              </div>
            <?php endif; ?>
            <?php if ($description) : ?>
              <div class="prose prose-xl max-w-none font-medium mb-6">
                <?php echo $description ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <?php if ($text_cards) : ?>
          <div class="grid grid-cols-3 gap-8">
            <?php foreach ($text_cards as $card) : ?>
              <?php
              $title = $card['title'];
              $excerpt = $card['excerpt'];
              $link = $card['link'];
              ?>
              <div class="relative flex flex-col shadow-lg p-8 rounded-lg border border-solid border-gray-200">
                <?php if ($title) { ?>
                  <?php if ($link) {
                    echo '<h4 class="text-2xl font-semibold my-4"><a href="' . $link['url'] . '" class="hover:underline">' . $title . '</a></h4>';
                  } else {
                    echo '<h4 class="text-2xl font-semibold my-4">' . $title . '</h4>';
                  } ?>
                <?php } ?>
                <?php if ($excerpt) {
                  echo '<div>' . $excerpt . '</div>';
                } ?>
                <?php if ($link) {
                  echo '<div class="mt-auto">';
                  echo '<a href="' . $link['url'] . '" class="text-brand-purple underline font-medium inline-block mt-4 hover:no-underline" style="color: var(--section-link-color)">' . $link['title'] . '</a>';
                  echo '</div>';
                } ?>
              </div>

            <?php endforeach ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>