<?php

function coact_acf_init()
{
  if (function_exists('get_field')) {
    if (defined('GOOGLE_MAPS_API')) {
      acf_update_setting('google_api_key', GOOGLE_MAPS_API);
    }
  }

  // Disable ACFE Modules
  acf_update_setting('acfe/modules/options', false);
  acf_update_setting('acfe/modules/block_types', false);
  acf_update_setting('acfe/modules/options_pages', false);
  acf_update_setting('acfe/modules/post_types', false);
  acf_update_setting('acfe/modules/taxonomies', false);
  acf_update_setting('acfe/modules/forms', false);
}
add_action('acf/init', 'coact_acf_init');


/*
 * Add color picker pallete on admin
 */
function coact_acf_input_admin_footer()
{
  $palette_fields = [
    'primary_color',
    'secondary_color',
    'tertiary_color',
    'fourth_color',
    'body_text_color',
  ];

  $additional_color = get_field('additional_color', 'option');

  $primary_palette_array = [];
  foreach ($palette_fields as $field) {
    $color = get_field($field, 'option');
    if ($color) {
      $primary_palette_array[] = $color;
    }
  }

  $additional_color_array = [];
  if ($additional_color) {
    foreach ($additional_color as $color) {
      $additional_color_array[] = $color['color'];
    }
  }

  $primary_palette = implode("', '", $primary_palette_array);
  $additional_palette = implode("', '", $additional_color_array);

?>
  <script type="text/javascript">
    (function($) {

      acf.add_filter('color_picker_args', function(args, $field) {

        args.palettes = ['#000000', '#FFFFFF', '<?php echo $primary_palette ?>', '<?php echo $additional_palette ?>']

        return args;

      });

    })(jQuery);
  </script>
<?php
}
add_action('acf/input/admin_footer', 'coact_acf_input_admin_footer');

/*
 * ACF Icon Picker
 * Modify the path to the icons directory
 * https://github.com/smithfield-studio/acf-svg-icon-picker
 */
//add_filter('acf_icon_path_suffix', 'acf_icon_path_suffix');
add_filter('acf_svg_icon_picker_folder', 'acf_icon_path_suffix');
function acf_icon_path_suffix($path_suffix)
{
  return 'assets/icons/content/';
}

/*
 * ACF Extended Layout Thumbnails
 * https://www.acf-extended.com/features/fields/flexible-content/advanced-settings
 * @int/string  $thumbnail  Thumbnail ID/URL
 * @array       $field      Field settings
 * @array       $layout     Layout settings
 */
//add_filter('acfe/flexible/thumbnail/layout=accordion', 'accordion_layout_thumbnail', 10, 3);
function accordion_layout_thumbnail($thumbnail, $field, $layout)
{
  return get_stylesheet_directory_uri() . '/assets/images/layouts/accordion.jpg';
}

/* helper function to get formidable forms to ACF: */
function get_formidable_forms()
{
  $results = array();
  foreach (FrmForm::get_published_forms() as $published_form) {
    $results[$published_form->id] = $published_form->name;
  }
  return $results;
}
/* auto populate acf field with form IDs */
function load_forms_function($field)
{
  $result = get_formidable_forms();
  if (is_array($result)) {
    $field['choices'] = array();
    foreach ($result as $key => $match) {
      $field['choices'][$key] = $match;
    }
  }
  return $field;
}
add_filter('acf/load_field/name=select_formidable_form', 'load_forms_function');


/* Migrate old wysiwyg_editor field to new group field */
function migrate_wysiwyg_to_group($value, $post_id, $field) {
    // If the new field already has a value, return it (migration already happened)
    if (!empty($value)) {
        return $value;
    }

    // We need to figure out the old meta key based on the field's current name structure.
    // ACF passes the field name which will look like: 
    // section_0_text_center_components_0_content_editor_wysiwyg_editor
    
    // Let's replace the new structure with the old structure to find the old key
    $old_meta_key = str_replace('_content_editor_wysiwyg_editor', '_wysiwyg_editor', $field['name']);
    
    // Attempt to get the old value directly from the database
    $old_value = get_post_meta($post_id, $old_meta_key, true);

    if (!empty($old_value)) {
        return $old_value; // Return the old value to populate the new field
    }

    return $value;
}
// Use the exact field key of your new WYSIWYG field (after moving it into the group)
add_filter('acf/load_value/key=field_65ce45c32bf83', 'migrate_wysiwyg_to_group', 10, 3);


/**
 * Add Heroicons tab to ACF Icon Picker
 */
function coact_acf_icon_picker_tabs($tabs)
{
  $tabs['heroicons_solid'] = 'Heroicons Solid';

  return $tabs;
}
add_filter('acf/fields/icon_picker/tabs', 'coact_acf_icon_picker_tabs');

function coact_add_heroicons_icons(array $icons): array
{
  $icons_path = get_template_directory() . '/assets/icons/heroicons/solid/';
  $base_url   = get_template_directory_uri() . '/assets/icons/heroicons/solid/';

  // Scan directory for SVG files
  $files = glob($icons_path . '*.svg');

  if ($files) {
    foreach ($files as $file) {
      $filename = basename($file);
      $key      = str_replace('.svg', '', $filename);
      $label    = ucwords(str_replace(['-', '_'], ' ', $key));

      $icons[] = [
        'url'   => $base_url . $filename,
        'key'   => $key,
        'label' => $label,
      ];
    }
  }

  return $icons;
}
add_filter('acf/fields/icon_picker/heroicons_solid/icons', 'coact_add_heroicons_icons');

/**
 * Prevent specific shortcodes from rendering during ACFE Dynamic Render preview in the backend
 */
function coact_prevent_shortcodes_in_acfe_preview($return, $tag, $attr, $m) {
    if ($tag !== 'wpcode') {
        return $return;
    }

    $is_editor = false;

    // 1. Regular WP Admin screens (Classic Editor relies on post.php and post-new.php)
    global $pagenow;
    if (in_array($pagenow, ['post.php', 'post-new.php']) && !wp_doing_ajax()) {
        $is_editor = true;
    }
    // Fallback for is_admin() just in case
    elseif (is_admin() && !wp_doing_ajax()) {
        $is_editor = true;
    }
    // 2. ACF or ACFE AJAX requests (block previews, flexible content previews)
    elseif (wp_doing_ajax() && isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'acf') !== false) {
        $is_editor = true;
    }
    // 3. REST API requests (Gutenberg saves, block renders)
    elseif (defined('REST_REQUEST') && REST_REQUEST && current_user_can('edit_posts')) {
        $is_editor = true;
    }
    
    // 4. ACFE specific dynamic preview check
    if (function_exists('acfe_is_dynamic_preview') && acfe_is_dynamic_preview()) {
        $is_editor = true;
    }

    if ($is_editor) {
        $id = isset($attr['id']) ? $attr['id'] : 'Unknown';
        return '<div style="padding: 15px; background: #f9fafb; border: 2px dashed #d1d5db; color: #6b7280; text-align: center; border-radius: 8px; font-family: sans-serif; font-size: 14px; margin: 10px 0;">[WPCode Snippet ID: ' . esc_html($id) . ' Placeholder]</div>';
    }

    return $return;
}
add_filter('pre_do_shortcode_tag', 'coact_prevent_shortcodes_in_acfe_preview', 10, 4);
