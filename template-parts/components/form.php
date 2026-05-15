<?php

/**
 * Form Component
 * 
 * Optimized for Tailwind CSS v4 and adjusted to project standards.
 */

$field = $args['field'] ?? '';
$class = $args['class'] ?? '';

// Getting image component
$form_comp = is_array($field) ? $field : get_sub_field($field ?: 'form');

if (!$form_comp) return;

// Generate a stable ID based on Post ID and a static counter
static $form_count = 0;
$form_count++;
$form_id_attr = 'form-' . get_the_ID() . '-' . $form_count;

// Extracting form details
$form_data   = $form_comp['form'] ?? [];
$form_shortcode = $form_data['form_shortcode'] ?? [];

// Settings (Paddings, Borders, Shadows, Background)
$form_settings = $form_data['settings'] ?? [];

// Paddings
$box_paddings = $form_settings['box_paddings'] ?? [];
$padding_size = $box_paddings['padding_size'] ?? 'default';

$padding_map = [
  'none'    => 'p-0',
  'tighter' => 'p-4',
  'tight'   => 'p-6',
  'default' => 'p-8',
  'wide'    => 'p-10',
  'wider'   => 'p-12',
];
$padding_class = $padding_map[strtolower($padding_size)] ?? 'p-8';

// Shadows
$box_shadow_settings = $form_settings['box_shadow'] ?? [];
$box_shadow = $box_shadow_settings['box_shadow'] ?? 'none';

$shadow_map = [
  'none' => 'shadow-none',
  'sm'   => 'shadow-sm',
  'md'   => 'shadow-md',
  'lg'   => 'shadow-lg',
  'xl'   => 'shadow-xl',
  '2xl'  => 'shadow-2xl',
];
$shadow_class = $shadow_map[$box_shadow] ?? 'shadow-none';

// Borders
$border_settings = $form_settings['border'] ?? [];
$border_style = $border_settings['border_style'] ?? 'none';
$border_color = $border_settings['border_color'] ?? '#d1d5db';

// Rounded
$rounded_settings = $form_settings['box_rounded_corners'] ?? [];
$rounded_key   = $rounded_settings['rounded_corners'] ?? 'rounded_none';
$rounded_map = [
  'rounded_none' => 'rounded-none',
  'rounded_md'   => 'rounded-md',
  'rounded_lg'   => 'rounded-lg',
  'rounded_xl'   => 'rounded-xl',
  'rounded_2xl'  => 'rounded-2xl',
];
$rounded_class = $rounded_map[$rounded_key] ?? 'rounded-none';

$box_classes = [
  'group block relative w-full h-full flex flex-col overflow-hidden transition-all duration-300',
  $rounded_class,
  $padding_class,
  $shadow_class
];

$box_styles = [];
if ($border_style !== 'none') {
  $box_classes[] = 'border';
  if ($border_style === 'solid') {
    $box_classes[] = 'border-solid';
  }
  if (!empty($border_color)) {
    $box_styles[] = "border-color: {$border_color}";
  }
}

$final_box_class = implode(' ', $box_classes);
$final_box_style_attr = !empty($box_styles) ? 'style="' . esc_attr(implode('; ', $box_styles)) . '"' : '';

// Outputting form if shortcode exists
if ($form_shortcode) {
  $bg_data    = $form_settings['box_background']['box_background_background'] ?? ($form_settings['box_background'] ?? []);
  $background = ['background' => $bg_data];
?>

    <div class="<?php echo esc_attr($final_box_class); ?>" <?php echo $final_box_style_attr; ?>>

      <?php if (!empty(array_filter($bg_data))) : ?>
        <div class="absolute inset-0 z-0">
          <?php get_template_part('template-parts/components/background', '', ['field' => $background]); ?>
        </div>
      <?php endif; ?>

      <div class="relative z-10">
        <?php echo do_shortcode($form_shortcode); ?>
      </div>

    </div>

<?php
}
