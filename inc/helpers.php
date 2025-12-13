<?php

/**
 * Slugify a string
 */
function coact_slugify($text)
{
  // Strip html tags
  $text = strip_tags($text);
  // Replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  // Transliterate
  setlocale(LC_ALL, 'en_US.utf8');
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // Remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  // Trim
  $text = trim($text, '-');
  // Remove duplicate -
  $text = preg_replace('~-+~', '-', $text);
  // Lowercase
  $text = strtolower($text);
  // Check if it is empty
  if (empty($text)) {
    return 'n-a';
  }
  // Return result
  return $text;
}

/**
 * Wrap printr Development
 */
function preint_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

/**
 * Get Icon
 * This function is in charge of displaying SVG icons across the site.
 *
 * Place each <svg> source in the /assets/icons/{group}/ directory, without adding
 * both `width` and `height` attributes, since these are added dynamically,
 * before rendering the SVG code.
 *
 * All icons are assumed to have equal width and height, hence the option
 * to only specify a `$size` parameter in the svg methods.
 *
 */
function coact_icon($atts = array())
{
  $atts = shortcode_atts(array(
    'icon'  => false,
    'icon_src' => '',
    'group'  => 'utility',
    'size'  => 16,
    'class'  => false,
    'label'  => false,
  ), $atts);

  if (empty($atts['icon']) && empty($atts['icon_src']))
    return;

  if ($atts['icon_src']) {
    $icon_path = get_attached_file($atts['icon_src']);
  } else {
    $icon_path = get_theme_file_path('/assets/icons/' . $atts['group'] . '/' . $atts['icon'] . '.svg');
  }
  if (!file_exists($icon_path))
    return;

  $icon = file_get_contents($icon_path);

  $class = 'svg-icon';
  if (!empty($atts['class']))
    $class .= ' ' . esc_attr($atts['class']);

  if (false !== $atts['size']) {
    $repl = sprintf('<svg class="' . $class . '" width="%d" height="%d" aria-hidden="true" role="img" focusable="false" ', $atts['size'], $atts['size']);
    $svg  = preg_replace('/^<svg /', $repl, trim($icon)); // Add extra attributes to SVG code.
  } else {
    $svg = preg_replace('/^<svg /', '<svg class="' . $class . '"', trim($icon));
  }
  $svg  = preg_replace("/([\n\t]+)/", ' ', $svg); // Remove newlines & tabs.
  $svg  = preg_replace('/>\s*</', '><', $svg); // Remove white space between SVG tags.

  if (!empty($atts['label'])) {
    $svg = str_replace('<svg class', '<svg aria-label="' . esc_attr($atts['label']) . '" class', $svg);
    $svg = str_replace('aria-hidden="true"', '', $svg);
  }

  return $svg;
}


function coact_svg($atts = array())
{
  $atts = shortcode_atts(array(
    'svg'  => false,
    'svg_src' => '',
    'group'  => 'shape',
    'size'  => 16,
    'class'  => false,
    'label'  => false,
  ), $atts);

  if (empty($atts['svg']) && empty($atts['svg_src']))
    return;

  if ($atts['svg_src']) {
    $icon_path = get_attached_file($atts['svg_src']);
  } else {
    $icon_path = get_theme_file_path('/assets/svg/' . $atts['group'] . '/' . $atts['svg'] . '.svg');
  }
  if (!file_exists($icon_path))
    return;

  $icon = file_get_contents($icon_path);

  $class = 'svg-icon';
  if (!empty($atts['class']))
    $class .= ' ' . esc_attr($atts['class']);

  if (false != $atts['size']) {
    $repl = sprintf('<svg class="' . $class . '" width="%d" height="%d" aria-hidden="true" role="img" focusable="false" ', $atts['size'], $atts['size']);
    $svg  = preg_replace('/^<svg /', $repl, trim($icon)); // Add extra attributes to SVG code.
  } else {
    $svg = preg_replace('/^<svg /', '<svg class="' . $class . '"', trim($icon));
  }
  $svg  = preg_replace("/([\n\t]+)/", ' ', $svg); // Remove newlines & tabs.
  $svg  = preg_replace('/>\s*</', '><', $svg); // Remove white space between SVG tags.

  if (!empty($atts['label'])) {
    $svg = str_replace('<svg class', '<svg aria-label="' . esc_attr($atts['label']) . '" class', $svg);
    $svg = str_replace('aria-hidden="true"', '', $svg);
  }

  return $svg;
}

function get_video_thumbnail_uri($video_uri, $max_width = 960, $max_height = 540)
{
  // https://support.advancedcustomfields.com/forums/topic/youtube-thumbnail-object-with-oembed-field/
  $thumbnail_uri = '';

  //get wp_oEmed object, not a public method. new WP_oEmbed() would also be possible
  $oembed = new WP_oEmbed();
  //get provider
  $provider = $oembed->get_provider($video_uri);
  //fetch oembed data as an object
  $oembed_data = $oembed->fetch($provider, $video_uri, array('width' => $max_width, 'height' => $max_height));
  //print_r($oembed_data);
  $thumbnail_uri = $oembed_data->thumbnail_url;

  // get default/placeholder thumbnail
  if (empty($thumbnail_uri) || is_wp_error($thumbnail_uri)) {
    $thumbnail_uri = '';
  }

  //return thumbnail uri
  return $thumbnail_uri;
}

function hexToRgb($hex)
{
  // Remove '#' if present
  $hex = str_replace('#', '', $hex);

  // Split the hex code into R, G, B components
  $r = hexdec(substr($hex, 0, 2));
  $g = hexdec(substr($hex, 2, 2));
  $b = hexdec(substr($hex, 4, 2));

  // Return the RGB values as an associative array
  return array('r' => $r, 'g' => $g, 'b' => $b);
}

/**
 * Accessible Caption Links
 *
 * Filter the caption shortcode output to improve accessibility.
 * If an image link has empty alt text, inject the caption text
 * as an aria-label on the anchor tag.
 */
function coact_accessible_caption_links($output, $attr, $content)
{
  $atts = shortcode_atts(array(
    'id'      => '',
    'align'   => 'alignnone',
    'width'   => '',
    'caption' => '',
    'class'   => '',
  ), $attr, 'caption');

  $atts['width'] = (int) $atts['width'];

  if ($atts['width'] < 1 || empty($atts['caption'])) {
    return $content;
  }

  if (!empty($atts['id'])) {
    $atts['id'] = 'id="' . esc_attr($atts['id']) . '" ';
  }

  $class = trim('wp-caption ' . $atts['align'] . ' ' . $atts['class']);

  $html5 = current_theme_supports('html5', 'caption');

  // Parse the content to find <a> tag wrapping an <img> with empty alt.
  if (preg_match('/<a([^>]*)>(.*?)<\/a>/is', $content, $matches)) {
    $a_attrs     = $matches[1];
    $img_content = $matches[2];

    if (strpos($img_content, '<img') !== false) {
      // Inject aria-label with caption text.
      $caption_text = strip_tags($atts['caption']);
      $new_a_tag    = '<a' . $a_attrs . ' aria-label="' . esc_attr($caption_text) . '">' . $img_content . '</a>';
      $content      = str_replace($matches[0], $new_a_tag, $content);
    }
  }

  if ($html5) {
    return '<figure ' . $atts['id'] . 'class="' . esc_attr($class) . '">'
      . do_shortcode($content) . '<figcaption class="wp-caption-text">' . $atts['caption'] . '</figcaption></figure>';
  }

  return '<div ' . $atts['id'] . 'class="' . esc_attr($class) . '">'
    . do_shortcode($content) . '<p class="wp-caption-text">' . $atts['caption'] . '</p></div>';
}
add_filter('img_caption_shortcode', 'coact_accessible_caption_links', 10, 3);
