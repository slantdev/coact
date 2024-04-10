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

$text_center = get_sub_field('text_center');
$headline = isset($text_center['headline']) ? $text_center['headline'] : '';
$headline_color = isset($text_center['headline_color']) ? $text_center['headline_color'] : '';
$headline_style = '';
if ($headline_color) {
  $headline_style .= 'color:' . $headline_color . ';';
}
$description = $text_center['description'];
$description = isset($text_center['description']) ? $text_center['description'] : '';

$components = isset($text_center['components']) ? $text_center['components'] : '';

$column_settings = $text_center['column_settings'];
$alignment = $column_settings['alignment'] ?? '';
$alignment_classes = [
  "left" => 'text-left',
  "center" => 'text-center',
  "right" => 'text-right',
];
$alignment_class = $alignment_classes[$alignment] ?? 'text-center';
$max_width = $column_settings['max_width'] ?? '';
$max_width_classes = [
  "default" => 'max-w-screen-lg',
  "none" => 'max-w-none',
  "xs" => 'max-w-screen-xs',
  "sm" => 'max-w-screen-sm',
  "md" => 'max-w-screen-md',
  "lg" => 'max-w-screen-lg',
  "xl" => 'max-w-screen-xl',
  "2xl" => 'max-w-screen-2xl',
];
$max_width_class = $max_width_classes[$max_width] ?? '';

// Combining classes
$class_list = ['text-brand-dark-blue', $alignment_class, $max_width_class];
$content_class = implode(' ', $class_list);

?>

<section <?php echo $section_id ?> class="relative <?php echo $section_class ?>" style="<?php echo $section_style ?>">
  <?php get_template_part('template-parts/layouts/background_ornament', '', array('shape' => $ornament_shape, 'style' => $ornament_style, 'class' => 'max-w-screen-4xl')); ?>
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="container mx-auto animation-wrapper">
      <div class="<?php echo $content_class ?> mx-auto text-center z-[1] <?php echo $entrance_animation_class ?>">
        <?php if ($headline) : ?>
          <h3 class="text-black text-2xl md:text-3xl font-bold" style="<?php echo $headline_style ?>"><?php echo $headline ?></h3>
        <?php endif; ?>
        <?php if ($description) : ?>
          <div class="mt-6 text-base md:text-lg font-medium"><?php echo $description ?></div>
        <?php endif; ?>
        <?php get_template_part('template-parts/components/components', '', array('field' => $components)); ?>
      </div>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>