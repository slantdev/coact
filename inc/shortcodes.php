<?php

// Add Shortcode
function eloqua_shortcode($atts)
{
  $atts = shortcode_atts(
    array(
      'id' => '',
    ),
    $atts
  );

  $eloqua_shortcodes = get_field('eloqua_shortcodes', 'option');
  $eloqua_shortcode = $eloqua_shortcodes['eloqua_shortcode'];

  $repeater_id = $atts['id'];

  if (is_admin()) {
    return;
  }
  if ($eloqua_shortcode && $repeater_id) {
    $repeater_row = $repeater_id - 1;
    $eloqua_embed_code = $eloqua_shortcode[$repeater_row]['eloqua_embed_code'];
    //preint_r($eloqua_embed_code);
    return $eloqua_embed_code;
  } else {
    return;
  }

  //preint_r($eloqua_shortcode);
}
add_shortcode('eloqua', 'eloqua_shortcode');
