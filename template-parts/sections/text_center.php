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
$headline = $text_center['headline'];
$description = $text_center['description'];

$components = $text_center['components'];

// Notes:
// Columns settings doesn't work yet
$column_settings = $text_center['column_settings'];
$alignment = $column_settings['alignment'];
$max_width = $column_settings['max_width'];
$section_ornament = $column_settings['section_ornament'];

?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <?php if ($section_ornament) : ?>
    <div class="relative max-w-screen-4xl h-1">
      <div class="absolute top-0 right-0">
        <?php echo coact_svg(array('svg' => 'shape-1', 'group' => 'shapes', 'size' => false, 'class' => 'text-brand-orange w-[500px] h-auto')); ?>
      </div>
    </div>
  <?php endif; ?>
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <div class="container mx-auto">
      <div class="max-w-screen-lg mx-auto text-center z-[1]">
        <?php if ($headline) : ?>
          <h3 class="text-black text-3xl font-bold"><?php echo $headline ?></h3>
        <?php endif; ?>
        <?php if ($description) : ?>
          <div class="mt-6 text-lg font-medium"><?php echo $description ?></div>
        <?php endif; ?>
        <?php get_template_part('template-parts/components/components', '', array('field' => $components)); ?>
      </div>
    </div>
  </div>
</section>