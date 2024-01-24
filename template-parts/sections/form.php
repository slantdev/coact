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
$headline = $forms['headline'];
$description = $forms['description'];
$select_formidable_form = $forms['select_formidable_form'];
?>
<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <div class="relative container max-w-screen-xxl <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <?php get_template_part('template-parts/layouts/background_ornament', '', array('shape' => $ornament_shape, 'style' => $ornament_style, 'class' => 'max-w-screen-3xl')); ?>
    <div class="relative container max-w-screen-md mx-auto z-10">
      <?php if ($headline || $description) : ?>
        <div class="mb-8">
          <?php if ($headline) : ?>
            <div class="not-prose">
              <h3 class="mb-4 xl:mb-8 text-center text-4xl font-bold"><?php echo $headline ?></h3>
            </div>
          <?php endif; ?>
          <?php if ($description) : ?>
            <div class="prose max-w-prose text-center"><?php echo $description ?></div>
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