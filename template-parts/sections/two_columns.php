<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 *
 * @var string $section_id
 * @var string $section_style
 * @var string $section_class
 * @var string $section_padding_top
 * @var string $section_padding_bottom
 * @var string $top_separator_style
 * @var string $bottom_separator_style
 * @var string $entrance_animation_class
 * @var bool   $top_separator
 * @var bool   $bottom_separator
 */

// Generate stable ID if not set in section-settings.php
if (!$section_id) {
  static $two_columns_count = 0;
  $two_columns_count++;
  $section_id = 'section-two-cols-' . get_the_ID() . '-' . $two_columns_count;
}

$section_id_attr = 'id="' . esc_attr($section_id) . '"';
$section_class_name = 'section-two-columns-' . uniqid();

// Data
$two_columns      = get_sub_field('two_columns');
$columns_settings = $two_columns['columns_settings'] ?? [];
$left_components  = $two_columns['left_column_components_components'] ?? [];
$right_components = $two_columns['right_column_components_components'] ?? [];

// Column Settings & Width Mapping
$column_ratio  = $columns_settings['column_ratio'] ?? 'half';
$max_width_key = $columns_settings['max_width'] ?? 'default';
$column_style = $columns_settings['style'] ?? 'default';

$ratio_map = [
  'half'             => ['w-full lg:w-1/2', 'w-full lg:w-1/2'],
  'one_two_third'    => ['w-full lg:w-1/3', 'w-full lg:w-2/3'],
  'two_one_third'    => ['w-full lg:w-2/3', 'w-full lg:w-1/3'],
  'one_three_fourth' => ['w-full lg:w-1/4', 'w-full lg:w-3/4'],
  'three_one_fourth' => ['w-full lg:w-3/4', 'w-full lg:w-1/4'],
  'two_three_five'   => ['w-full lg:w-2/5', 'w-full lg:w-3/5'],
  'three_two_five'   => ['w-full lg:w-3/5', 'w-full lg:w-2/5'],
];

[$col_left_width, $col_right_width] = $ratio_map[$column_ratio] ?? $ratio_map['half'];

// Max Width Mapping
$max_width_map = [
  'none'    => 'max-w-none',
  'xs'      => 'max-w-screen-xs',
  'sm'      => 'max-w-screen-sm',
  'md'      => 'max-w-screen-md',
  'lg'      => 'max-w-screen-lg',
  'xl'      => 'max-w-screen-xl',
  '2xl'     => 'max-w-screen-xxl',
  'default' => '',
];
$mw_class = $max_width_map[$max_width_key] ?? '';

// Container Classes
$container_classes = array_filter([
  'container mx-auto px-4 sm:px-6 lg:px-8',
  $mw_class
]);
$final_container_class = implode(' ', $container_classes);

// Card Classes
$card_classes = ($column_style === 'card')
  ? 'p-4 rounded-lg bg-white shadow-md lg:p-8 lg:rounded-xl lg:shadow-lg xl:p-12 xl:rounded-2xl xl:shadow-xl'
  : '';

?>

<section <?php echo $section_id_attr; ?> class="section-two-columns <?php echo esc_attr($section_class); ?> section-wrapper relative overflow-x-hidden" style="<?php echo esc_attr($section_style); ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>

    <div class="section-container relative z-10">
      <div class="section-content-wrapper <?php echo esc_attr($final_container_class); ?> <?php echo $entrance_animation_class ?>">
        <div class="section-content flex flex-col lg:flex-row gap-8 xl:gap-20">
          <div class="column-left <?php echo esc_attr($col_left_width); ?><?php echo esc_attr($card_classes); ?>">
            <?php get_template_part('template-parts/components/components', '', array('field' => $left_components)); ?>
          </div>
          <div class="column-right <?php echo esc_attr($col_right_width); ?><?php echo esc_attr($card_classes); ?>">
            <?php get_template_part('template-parts/components/components', '', array('field' => $right_components)); ?>
          </div>
        </div>
      </div>
    </div>

    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>    