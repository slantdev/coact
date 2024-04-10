<?php
/*
 * Section Settings Variables
 */

$section_settings = get_sub_field('section_settings') ?: [];
$section_background_color = $section_settings['section_background_color'] ?? '';
$section_text_color = $section_settings['section_text_color'] ?? '';
$section_link_color = $section_settings['section_link_color'] ?? '';
$add_section_anchor = $section_settings['add_section_anchor'] ?? false;
$section_id = $add_section_anchor ? ($section_settings['section_id'] ?? '') : '';
$section_class = '';

$spacing_top = $section_settings['section_spacing']['spacing_top'] ?? '';
$spacing_bottom = $section_settings['section_spacing']['spacing_bottom'] ?? '';

$spacing_top_map = [
  'none' => 'pt-0',
  'xs' => 'pt-4 lg:pt-8 xl:pt-8',
  'sm' => 'pt-4 lg:pt-6 xl:pt-14',
  'md' => 'pt-8 lg:pt-12 xl:pt-20',
  'lg' => 'pt-10 lg:pt-16 xl:pt-28',
  'xl' => 'pt-12 lg:pt-20 xl:pt-36',
  '2xl' => 'pt-12 lg:pt-24 xl:pt-40',
  'default' => 'pt-8 lg:pt-12 xl:pt-20'
];
$spacing_bottom_map = [
  'none' => 'pb-0',
  'xs' => 'pb-4 lg:pb-8 xl:pb-8',
  'sm' => 'pb-4 lg:pb-6 xl:pb-14',
  'md' => 'pb-8 lg:pb-12 xl:pb-20',
  'lg' => 'pb-10 lg:pb-16 xl:pb-28',
  'xl' => 'pb-12 lg:pb-20 xl:pb-36',
  '2xl' => 'pb-12 lg:pb-24 xl:pb-40',
  'default' => 'pb-8 lg:pb-12 xl:pb-20'
];

$section_padding_top = $spacing_top_map[$spacing_top] ?? '';
$section_padding_bottom = $spacing_bottom_map[$spacing_bottom] ?? '';

$top_separator = $section_settings['line_separator']['top_separator']['show_top_separator'] ?? '';
$top_separator_color = $section_settings['line_separator']['top_separator']['top_separator_color'] ?? '';
$bottom_separator = $section_settings['line_separator']['bottom_separator']['show_bottom_separator'] ?? '';
$bottom_separator_color = $section_settings['line_separator']['bottom_separator']['bottom_separator_color'] ?? '';
$top_separator_style = '';
if ($top_separator) {
  $top_separator_style .= 'border-color : ' . $top_separator_color . ';';
}
$bottom_separator_style = '';
if ($bottom_separator) {
  $bottom_separator_style .= 'border-color : ' . $bottom_separator_color . ';';
}
$ornament_shape = $section_settings['background_ornament']['ornament_shape'] ?? '';
$ornament_color = $section_settings['background_ornament']['ornament_color'] ?? '';
$ornament_style = '';
if ($ornament_shape !== 'none' && $ornament_color) {
  $ornament_style .= 'color : ' . $ornament_color . ';';
}

$section_fullwidth = $section_settings['section_full_width'] ?? false;

$section_container_class = $section_padding_top . ' ' . $section_padding_bottom  . ' ';

if (!$section_fullwidth) {
  $section_container_class .= 'relative container mx-auto ';
} else {
  $section_container_class .= 'px-4 xl:px-8';
}

$section_style = '';
if ($section_background_color) {
  $section_style .= ' background-color:' . $section_background_color . ';';
}
if ($section_text_color && $section_text_color !== 'default') {
  $section_style .= ' color:' . $section_text_color . ';';
}
if ($section_link_color) {
  $section_style .= ' --section-link-color:' . $section_link_color . ';';
}

$entrance_animation = $section_settings['animations']['entrance_animation'] ?? '';
$entrance_animation_map = [
  'none' => '',
  'fadeInUp' => 'animation-item animation-fadeInUp',
];
$entrance_animation_class = $entrance_animation_map[$entrance_animation] ?? '';

$show_hide = $section_settings['show_hide'];
$hide_on_sm = $show_hide['hide_on_sm'] ?? false;
$hide_on_md = $show_hide['hide_on_md'] ?? false;
$hide_on_lg = $show_hide['hide_on_lg'] ?? false;
$hide_on_xl = $show_hide['hide_on_xl'] ?? false;

$combined_flags = ($hide_on_sm ? 1 : 0) | ($hide_on_md ? 2 : 0) | ($hide_on_lg ? 4 : 0) | ($hide_on_xl ? 8 : 0);

$show_hide_class = '';

switch ($combined_flags) {
  case 0: // Show on all sizes
    $show_hide_class = '';
    break;
  case 1: // Hide on sm
    $show_hide_class = 'hidden md:block lg:block xl:block';
    break;
  case 2: // Hide on md
    $show_hide_class = 'md:hidden lg:block xl:block';
    break;
  case 3: // Hide on sm and md
    $show_hide_class = 'hidden md:hidden lg:block xl:block';
    break;
  case 4: // Hide on lg
    $show_hide_class = 'lg:hidden xl:block';
    break;
  case 5: // Hide on sm and lg
    $show_hide_class = 'hidden md:block lg:hidden xl:block';
    break;
  case 6: // Hide on md and lg
    $show_hide_class = 'md:hidden lg:hidden xl:block';
    break;
  case 7: // Hide on sm, md, and lg
    $show_hide_class = 'hidden md:hidden lg:hidden xl:block';
    break;
  case 8: // Hide on xl
    $show_hide_class = 'xl:hidden';
    break;
  case 9: // Hide on sm and xl
    $show_hide_class = 'hidden md:block lg:block xl:hidden';
    break;
  case 10: // Hide on md and xl
    $show_hide_class = 'md:hidden lg:block xl:hidden';
    break;
  case 11: // Hide on sm, md, and xl
    $show_hide_class = 'hidden md:hidden lg:block xl:hidden';
    break;
  case 12: // Hide on lg and xl
    $show_hide_class = 'lg:hidden xl:hidden';
    break;
  case 13: // Hide on sm, lg, and xl
    $show_hide_class = 'hidden md:block lg:hidden xl:hidden';
    break;
  case 14: // Hide on md, lg, and xl
    $show_hide_class = 'md:hidden lg:hidden xl:hidden';
    break;
  case 15: // Hide on all sizes
    $show_hide_class = 'hidden';
    break;
  default:
    $show_hide_class = '';
    break;
}

$section_class .= $show_hide_class;
