<?php

// Extracting field, class, and headline text alignment from args with null coalescing operator
$field = $args['field'] ?? '';
$class = $args['class'] ?? '';
$align = $args['align'] ?? '';
$size = $args['size'] ?? '';
$weight = $args['weight'] ?? '';
$leading = $args['leading'] ?? '';

// Getting headline component
$headline_comp = is_array($field) ? $field : get_sub_field($field ?: 'headline');

//preint_r($headline_comp);

// Extracting headline details
$headline_text = $headline_comp['headline_text'] ?? '';
$headline_color = $headline_comp['headline_color'] ?? '';

$settings = $headline_comp['headline_settings'] ?? [];
$advanced_settings = $settings['advanced_settings'] ?? false;

// Extracting advanced settings
$html_tag = $settings['headline_html_tag'] ?? 'h2';
if ($html_tag == 'default') {
  $html_tag = 'h2';
}
$text_size = $settings['headline_size'] ?? 'default';
$alignment = $settings['headline_alignment'] ?? '';
$margin_top = $settings['headline_margin']['margin_top'] ?? 'none';
$margin_bottom = $settings['headline_margin']['margin_bottom'] ?? 'default';

// Applying headline text style if color exists
$text_style = $headline_color ? 'color:' . $headline_color . ';' : '';

// Assigning default classes
$text_size_class = $size ? $size : 'text-5xl';
$text_align_class = $align ? $align : '';
$text_leading_class = $leading ? $leading : 'leading-tight';
$text_weight_class = $weight ? $weight : 'font-semibold';
$margin_top_class = 'mt-0';
$margin_bottom_class = 'mb-0';

// Assigning classes based on advanced settings
if ($text_size) {
  $text_size_classes = [
    "default" => 'text-3xl lg:text-4xl',
    "xs" => 'text-xs',
    "sm" => 'text-sm',
    "md" => 'text-sm lg:text-md',
    "lg" => 'text-md lg:text-lg',
    "xl" => 'text-lg lg:text-xl',
    "2xl" => 'text-xl lg:text-2xl',
    "3xl" => 'text-2xl lg:text-3xl',
    "4xl" => 'text-3xl lg:text-4xl',
    "5xl" => 'text-4xl lg:text-5xl'
  ];
  $text_size_class = isset($text_size_classes[$text_size]) ? $text_size_classes[$text_size] : $text_size_class;
}

if ($alignment) {
  $text_align_class = 'text-' . $alignment;
}

if ($margin_top) {
  $margin_top_classes = [
    "none" => 'mt-0',
    "xs" => 'mt-2',
    "sm" => 'mt-4',
    "md" => 'mt-6',
    "lg" => 'mt-8',
    "xl" => 'mt-10',
    "2xl" => 'mt-12'
  ];
  $margin_top_class = isset($margin_top_classes[$margin_top]) ? $margin_top_classes[$margin_top] : $margin_top_class;
}

if ($margin_bottom) {
  $margin_bottom_classes = [
    "none" => 'mb-0',
    "xs" => 'mb-2',
    "sm" => 'mb-4',
    "md" => 'mb-6',
    "lg" => 'mb-8',
    "xl" => 'mb-10',
    "2xl" => 'mb-12'
  ];
  $margin_bottom_class = isset($margin_bottom_classes[$margin_bottom]) ? $margin_bottom_classes[$margin_bottom] : $margin_bottom_class;
}

// Combining classes
$class_list = [$text_size_class, $text_align_class, $text_leading_class, $text_weight_class, $margin_top_class, $margin_bottom_class];
$class .= implode(' ', $class_list);

// Outputting headline if headline text exists
if ($headline_text) {
  echo '<' . $html_tag . ' class="' . $class . '" style="' . $text_style . '">' . $headline_text . '</' . $html_tag . '>';
}
