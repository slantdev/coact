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
$intro = $text_card_grid['intro'] ?? [];
$headline = $intro['headline'] ?? '';
$headline_color = $intro['headline_color'] ?? '';
$headline_style = '';
if ($headline_color) {
  $headline_style .= 'color : ' . $headline_color . ';';
}
$headline_html_tag = $intro['headline_html_tag'] ?? 'h2';
if ($headline_html_tag == 'default') {
  $headline_html_tag = 'h2';
}
$description = $intro['description'] ?? '';
$description_color = $intro['description_color'] ?? '';
$description_style = '';
if ($description_color) {
  $description_style .= 'color : ' . $description_color . ';';
}

$text_cards = $text_card_grid['text_cards'] ?? []; // Repeater

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
          <div class="text-center max-w-prose mx-auto mb-10 lg:mb-14">
            <?php
            if ($headline) {
              echo '<div class="not-prose">';
              echo '<' . $headline_html_tag;
              echo ' class="text-3xl lg:text-4xl font-bold mb-8 xl:mb-12"';
              echo ' style="' . $headline_style . '">';
              echo $headline;
              echo '</' . $headline_html_tag . '>';
              echo '</div>';
            }
            ?>
            <?php if ($description) : ?>
              <div class="prose xl:prose-xl max-w-none font-medium mb-6" style="<?php echo $description_style ?>">
                <?php echo $description ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <?php if ($text_cards) : ?>
          <div class="grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-4 lg:gap-8">
            <?php foreach ($text_cards as $card) : ?>
              <?php
              $title = $card['title'] ?? '';
              $excerpt = $card['excerpt'] ?? '';
              $link = $card['link'] ?? '';
              ?>
              <div class="relative flex flex-col shadow-lg p-5 lg:p-6 xl:p-8 rounded-lg border border-solid border-gray-200">
                <?php if ($title) { ?>
                  <?php if ($link) {
                    echo '<h4 class="text-xl lg:text-2xl !leading-tight font-semibold mt-2 mb-4"><a href="' . $link['url'] . '" class="hover:underline">' . $title . '</a></h4>';
                  } else {
                    echo '<h4 class="text-xl lg:text-2xl !leading-tight font-semibold mt-2 mb-4">' . $title . '</h4>';
                  } ?>
                <?php } ?>
                <?php if ($excerpt) {
                  echo '<div class="text-sm lg:text-base">' . $excerpt . '</div>';
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