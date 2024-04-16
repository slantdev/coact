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

$two_column_card = get_sub_field('two_column_card');
$intro = $two_column_card['intro'] ?? '';
$headline = $intro['headline'] ?? '';
$headline_color = $intro['headline_color'] ?? '';
$headline_style = '';
if ($headline_color) {
  $headline_style .= 'color:' . $headline_color . ';';
}
$description = $intro['description'] ?? '';
$content_cards = $two_column_card['content_cards'] ?? []; // Repeater

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
            <?php if ($headline) : ?>
              <div class="not-prose">
                <h3 class="text-3xl lg:text-4xl font-bold mb-8 xl:mb-12" style="<?php echo $headline_style ?>"><?php echo $headline ?></h3>
              </div>
            <?php endif; ?>
            <?php if ($description) : ?>
              <div class="prose xl:prose-xl max-w-none font-medium">
                <?php echo $description ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <?php if ($content_cards) : ?>
          <div class="grid grid-cols-1 gap-y-8 lg:grid-cols-2 lg:gap-x-8 lg:gap-y-12">
            <?php foreach ($content_cards as $card) : ?>
              <?php
              $image = $card['image'];
              $title = $card['title'];
              $excerpt = $card['excerpt'];
              $link = $card['link'];
              ?>
              <div class="relative block">
                <?php if ($link) {
                  echo '<a href="' . $link['url'] . '" class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">';
                } else {
                  echo '<div class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">>';
                } ?>
                <?php if ($image) : ?>
                  <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" class="object-cover">
                <?php else : ?>
                  <div class="bg-slate-200 w-full h-full"></div>
                <?php endif; ?>
                <?php if ($link) {
                  echo '</a>';
                } else {
                  echo '</div>';
                } ?>
                <?php if ($title) { ?>
                  <?php if ($link) {
                    echo '<h4 class="text-xl font-semibold my-4"><a href="' . $link['url'] . '" class="hover:underline">' . $title . '</a></h4>';
                  } else {
                    echo '<h4 class="text-xl font-semibold my-4">' . $title . '</h4>';
                  } ?>
                <?php } ?>
                <?php if ($excerpt) {
                  echo '<div class="text-base">' . $excerpt . '</div>';
                } ?>
                <?php if ($link) {
                  echo '<a href="' . $link['url'] . '" class="text-brand-purple underline font-medium inline-block mt-4 hover:no-underline" style="color: var(--section-link-color)">' . $link['title'] . '</a>';
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