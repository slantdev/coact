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

$icon_numbers = get_sub_field('icon_numbers'); // Group
$icon_numbers = $icon_numbers['icon_numbers']; // Repeater

if ($icon_numbers) :

  $grid_count = count($icon_numbers);
  $grid_class = 'grid grid-cols-' . $grid_count . ' divide-x';

?>

  <section <?php echo $section_id ?> style="<?php echo $section_style ?>">
    <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
      <div class="container max-w-screen-xxl mx-auto">

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
                      echo coact_icon(array('icon' => $svg_icon, 'group' => 'content', 'size' => '96', 'class' => 'mx-auto'));
                    } else if ($image_icon) {
                      echo '<img src="' . $image_icon['url'] . '" />';
                    } ?>
                  </div>
                <?php endif; ?>
                <?php if ($number) : ?>
                  <div class="text-6xl font-bold mb-4" style="<?php echo $color_style ?>"><?php echo (!empty($prefix)) ? $prefix : ''; ?><?php echo '<span class="counterNumber">' . number_format($number) . '</span>' ?><?php echo (!empty($suffix)) ? $suffix : ''; ?></div>
                <?php endif; ?>
                <?php if ($label) : ?>
                  <div class="text-2xl font-medium"><?php echo $label ?></div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </section>

<?php endif; ?>