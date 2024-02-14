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

$section_id = $section_id ? 'id="' . $section_id . '"' : '';

$icon_numbers = get_sub_field('icon_numbers'); // Group
$icon_numbers = $icon_numbers['icon_numbers']; // Repeater

if ($icon_numbers) :

  $grid_count = count($icon_numbers);
  $grid_class = 'grid grid-cols-1 gap-y-8 md:grid-cols-' . $grid_count . ' md:divide-x';

?>

  <section <?php echo $section_id ?> style="<?php echo $section_style ?>">
    <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
      <?php if ($top_separator) : ?>
        <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
      <?php endif; ?>
      <div class="container max-w-screen-xxl mx-auto <?php echo $entrance_animation_class ?>">

        <div class="<?php echo $grid_class ?> divide-brand-purple">
          <?php if ($icon_numbers) : ?>
            <?php foreach ($icon_numbers as $data) : ?>
              <?php
              $svg_icon = $data['svg_icon'];
              $image_icon = $data['image_icon'];
              $prefix = $data['prefix'];
              $number = $data['number'];
              $suffix = $data['suffix'];
              $color = $data['color'];
              $label = $data['label'];
              $color_style = '';
              if ($color) {
                $color_style = 'color: ' . $color . ';';
              }
              ?>
              <div class="text-center py-4 px-8">
                <?php if ($svg_icon || $image_icon) : ?>
                  <div class="mb-4" style="<?php echo $color_style ?>">
                    <?php if ($svg_icon) {
                      echo coact_icon(array('icon' => $svg_icon, 'group' => 'content', 'size' => '96', 'class' => 'w-20 h-20 md:w-24 md:h-24 mx-auto'));
                    } else if ($image_icon) {
                      echo '<img src="' . $image_icon['url'] . '" />';
                    } ?>
                  </div>
                <?php endif; ?>
                <?php if ($number) : ?>
                  <div class="text-4xl md:text-6xl font-bold mb-3 md:mb-4" style="<?php echo $color_style ?>"><?php echo (!empty($prefix)) ? $prefix : ''; ?><?php echo '<span class="counterNumber">' . number_format($number) . '</span>' ?><?php echo (!empty($suffix)) ? $suffix : ''; ?></div>
                <?php endif; ?>
                <?php if ($label) : ?>
                  <div class="text-lg md:text-2xl font-medium"><?php echo $label ?></div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

      </div>
      <?php if ($bottom_separator) : ?>
        <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
      <?php endif; ?>
    </div>
  </section>

<?php endif; ?>