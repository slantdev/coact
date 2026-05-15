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

$section_id_attr = !empty($section_id) ? 'id="' . esc_attr($section_id) . '"' : '';
$section_class .= 'section-onecolumn-' . uniqid();

// Components
$one_column = get_sub_field('one_column');
$components = $one_column['components'] ?? [];

// Column Settings
$column_settings = get_sub_field('column_settings') ?? [];

// Max Width Mapping
$max_width_map = [
  'none'    => 'max-w-none',
  'xs'      => 'max-w-screen-xs',
  'sm'      => 'max-w-screen-sm',
  'md'      => 'max-w-5xl',
  'lg'      => 'max-w-screen-lg',
  'xl'      => 'max-w-screen-xl',
  '2xl'     => 'max-w-screen-2xl',
  'default' => '',
];
$mw_key = $column_settings['max_width'] ?? 'default';
$mw_class = $max_width_map[$mw_key] ?? $max_width_map['default'];

// Alignment Mapping
$alignment_map = [
  'left'   => 'text-left',
  'center' => 'text-center',
  'right'  => 'text-right',
];
$align_key = $column_settings['alignment'] ?? 'center';
$align_class = $alignment_map[$align_key] ?? $alignment_map['center'];

// Consolidate classes for the inner container
$container_classes = array_filter([
  'container mx-auto',
  'px-4 md:px-6 lg:px-8',
  $mw_class,
  $align_class
]);
$final_container_class = implode(' ', $container_classes);

?>

<section <?php echo $section_id_attr; ?> class="coact-onecolumn-section <?php echo esc_attr($section_class); ?> section-wrapper relative overflow-x-hidden" style="<?php echo esc_attr($section_style); ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>

    <div class="coact-section-container section-container relative z-10">
      <div class="coact-section-content-wrapper <?php echo esc_attr($final_container_class); ?> <?php echo $entrance_animation_class ?>">
        <div class="coact-section-content section-content">
          <?php get_template_part('template-parts/components/components', '', array('field' => $components)); ?>
        </div>
      </div>
    </div>

    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>