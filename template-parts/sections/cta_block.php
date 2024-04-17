<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
 * $top_separator
 * $top_separator_style
 * $bottom_separator
 * $bottom_separator_style 
*/

$cta_block = get_sub_field('cta_block');
$image = $cta_block['image'] ?? '';
$headline = $cta_block['headline'] ?? '';
$headline_color = $cta_block['headline_color'] ?? '';
$headline_style = '';
if ($headline_color) {
  $headline_style .= 'color : ' . $headline_color . ';';
}
$headline_html_tag = $cta_block['headline_html_tag'] ?? 'h2';
if ($headline_html_tag == 'default') {
  $headline_html_tag = 'h2';
}
$description = $cta_block['description'] ?? '';
$description_color = $cta_block['description_color'] ?? '';
if ($description_color) {
  $description_style .= 'color : ' . $description_color . ';';
}
$button = $cta_block['button'] ?? '';
?>

<section <?php echo $section_id ?> class="relative <?php echo $section_class ?>" style="<?php echo $section_style ?>">
  <div class="relative container max-w-screen-xxl <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24 items-center <?php echo $entrance_animation_class ?>">
      <?php if ($image) : ?>
        <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
          <div class="mb-8 mx-auto xl:mb-0 max-w-full"><img src="<?php echo $image['url'] ?>" class="" alt=""></div>
        </div>
      <?php else : ?>
        <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
          <div class="mb-8 mx-auto xl:mb-0 max-w-full"><img src="<?php echo coact_asset('images/content/illustration-1.png') ?>" class="" alt=""></div>
        </div>
      <?php endif; ?>
      <?php if ($headline || $description) : ?>
        <div class="w-full order-2 lg:w-2/3 xl:w-3/5 lg:pt-10">
          <?php
          if ($headline) {
            echo '<div class="not-prose">';
            echo '<' . $headline_html_tag;
            echo ' class="mb-6 lg:mb-8 text-left text-4xl lg:text-5xl font-bold text-white"';
            echo ' style="' . $headline_style . '">';
            echo $headline;
            echo '</' . $headline_html_tag . '>';
            echo '</div>';
          }
          ?>
          <?php if ($description) : ?>
            <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-6 text-white" style="<?php echo $description_style ?>">
              <?php echo $description ?>
            </div>
          <?php endif; ?>
          <?php get_template_part('template-parts/components/buttons', '', array('field' => $button, 'class' => 'mb-6 xl:mb-0 mt-6 xl:mt-8')); ?>
        </div>
      <?php endif; ?>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>