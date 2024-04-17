<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/

$forms = get_sub_field('forms');
$headline = $forms['headline'] ?? '';
$headline_color = $forms['headline_color'] ?? '';
$headline_style = '';
if ($headline_color) {
  $headline_style .= 'color : ' . $headline_color . ';';
}
$headline_html_tag = $forms['headline_html_tag'] ?? 'h2';
if ($headline_html_tag == 'default') {
  $headline_html_tag = 'h2';
}
$description = $forms['description'] ?? '';
$description_color = $forms['description_color'] ?? '';
$description_style = '';
if ($description_color) {
  $description_style .= 'color : ' . $description_color . ';';
}
$select_formidable_form = $forms['select_formidable_form'] ?? '';
?>
<section <?php echo $section_id ?> class="relative <?php echo $section_class ?>" style="<?php echo $section_style ?>">
  <div class="relative container max-w-screen-xxl <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <?php get_template_part('template-parts/layouts/background_ornament', '', array('shape' => $ornament_shape, 'style' => $ornament_style, 'class' => 'max-w-screen-3xl')); ?>
    <div class="relative container max-w-screen-md mx-auto z-10 <?php echo $entrance_animation_class ?>">
      <?php if ($headline || $description) : ?>
        <div class="mb-8">
          <?php
          if ($headline) {
            echo '<div class="not-prose">';
            echo '<' . $headline_html_tag;
            echo ' class="mb-4 xl:mb-8 text-center text-4xl font-bold"';
            echo ' style="' . $headline_style . '">';
            echo $headline;
            echo '</' . $headline_html_tag . '>';
            echo '</div>';
          }
          ?>
          <?php if ($description) : ?>
            <div class="prose max-w-prose text-center" style="<?php echo $description_style ?>"><?php echo $description ?></div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <?php if ($select_formidable_form) : ?>
        <div>
          <?php echo FrmFormsController::get_form_shortcode(array('id' => $select_formidable_form)); ?>
        </div>
      <?php endif; ?>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>