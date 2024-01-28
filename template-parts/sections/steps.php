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

$steps = get_sub_field('steps');
$headline = $steps['headline'];
$headline_color = $steps['headline_color'];
$headline_style = '';
if ($headline_color) {
  $headline_style .= 'color:' . $headline_color . ';';
}
$description = $text_center['description'];
$steps_repeater = $steps['steps'];

?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <?php get_template_part('template-parts/layouts/background_ornament', '', array('shape' => $ornament_shape, 'style' => $ornament_style, 'class' => 'max-w-screen-4xl')); ?>
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="container mx-auto <?php echo $entrance_animation_class ?>">
      <div class="max-w-screen-lg mx-auto text-center z-[1]">
        <?php if ($headline) : ?>
          <h3 class="text-black text-3xl font-bold" style="<?php echo $headline_style ?>"><?php echo $headline ?></h3>
        <?php endif; ?>
        <?php if ($description) : ?>
          <div class="mt-6 text-lg font-medium"><?php echo $description ?></div>
        <?php endif; ?>
      </div>
      <?php if ($steps_repeater) : ?>
        <div class="mt-20 flex gap-x-24 justify-center">
          <?php foreach ($steps_repeater as $key => $step) : ?>
            <?php
            $step_circle = $step['step_circle'];
            $cicle_title = $step_circle['title'];
            $cicle_color = $step_circle['color'];
            $circle_style = '';
            if ($cicle_color) {
              $circle_style = 'background-color:' . $cicle_color . ';';
            }
            $icon = $step['icon'];
            $text = $step['text'];
            $button = $step['button'];
            $lastElement = end($steps_repeater);
            ?>
            <div class="text-center max-w-[240px] relative">
              <div class="w-48 h-48 rounded-full mx-auto flex text-white items-center justify-center font-bold text-3xl p-12" style="<?php echo $circle_style ?>"><?php echo $cicle_title ?></div>
              <?php if ($step != $lastElement) {
                echo '<div class="absolute top-16 -right-24 -translate-x-1">' . coact_icon(array('icon' => 'steps-arrow', 'group' => 'utilities', 'size' => '80', 'class' => 'mx-auto text-gray-300')) . '</div>';
              } ?>
              <div class="mt-16 flex flex-col gap-y-8">
                <?php if ($icon) {
                  echo '<div class="w-full">';
                  echo coact_icon(array('icon' => $icon, 'group' => 'content', 'size' => '80', 'class' => 'mx-auto'));
                  echo '</div>';
                } ?>
                <?php if ($text) {
                  echo '<div class="w-full">';
                  echo $text;
                  echo '</div>';
                } ?>
                <div class="w-full">
                  <?php get_template_part('template-parts/components/button', '', array('field' => $button, 'class' => 'mx-auto')); ?>
                </div>
              </div>

            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>