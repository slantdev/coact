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
$description = $steps['description'];
$steps_repeater = $steps['steps'];

?>

<section <?php echo $section_id ?> class="relative <?php echo $section_class ?>" style="<?php echo $section_style ?>">
  <?php get_template_part('template-parts/layouts/background_ornament', '', array('shape' => $ornament_shape, 'style' => $ornament_style, 'class' => 'max-w-screen-4xl')); ?>
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="container mx-auto <?php echo $entrance_animation_class ?>">
      <div class="max-w-screen-lg mx-auto text-center z-[1]">
        <?php if ($headline) : ?>
          <h3 class="text-black text-2xl md:text-3xl font-bold" style="<?php echo $headline_style ?>"><?php echo $headline ?></h3>
        <?php endif; ?>
        <?php if ($description) : ?>
          <div class="mt-6 text-lg font-medium"><?php echo $description ?></div>
        <?php endif; ?>
      </div>
      <?php if ($steps_repeater) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:flex lg:gap-x-24 lg:justify-center mt-8 lg:mt-20">
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
            <div class="relative flex gap-x-4 items-center lg:flex-col lg:text-center lg:max-w-[240px]">
              <div class="flex-none w-24 h-24 lg:w-40 lg:h-40 xl:w-48 xl:h-48 rounded-full mx-auto flex text-white items-center justify-center font-bold text-center text-sm leading-tight lg:text-xl xl:text-2xl p-5 lg:p-10 xl:p-12" style="<?php echo $circle_style ?>"><?php echo $cicle_title ?></div>
              <?php if ($step != $lastElement) {
                echo '<div class="hidden lg:block absolute top-16 -right-20 xl:-right-24 -translate-x-1">' . coact_icon(array('icon' => 'steps-arrow', 'group' => 'utilities', 'size' => '80', 'class' => 'w-12 h-12 xl:w-20 xl:h-20 mx-auto text-gray-300')) . '</div>';
              } ?>
              <div class="flex flex-col gap-y-4 lg:gap-y-4 lg:mt-10 xl:gap-y-8 xl:mt-16">
                <?php if ($icon) {
                  echo '<div class="w-full hidden lg:block">';
                  echo coact_icon(array('icon' => $icon, 'group' => 'content', 'size' => '80', 'class' => 'w-12 h-12 lg:w-12 lg:h-12 xl:w-20 xl:h-20 lg:mx-auto'));
                  echo '</div>';
                } ?>
                <?php if ($text) {
                  echo '<div class="w-full mt-4 text-sm xl:text-base">';
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