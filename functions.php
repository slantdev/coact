<?php
define('GOOGLE_MAPS_API', 'AIzaSyALa7CVVKAaAPSw9-zopXMh2C7wcn6Zo10');

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/theme-setup.php';
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/acf.php';
require get_template_directory() . '/inc/post-type.php';
require get_template_directory() . '/inc/taxonomy.php';
//require get_template_directory() . '/inc/acf-debug.php';
//require get_template_directory() . '/inc/utilities.php';
require get_template_directory() . '/inc/enqueue.php';
//require get_template_directory() . '/inc/navigation.php';
require get_template_directory() . '/inc/breadcrumb.php';
require get_template_directory() . '/inc/ajax.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/cards.php';

add_filter("rest_service-partner_collection_params", function ($params) {
  $params['per_page']['maximum'] = 500; // number of posts fetched
  return $params;
});

function coact_excerpt_length($length)
{
  return 20;
}
add_filter('excerpt_length', 'coact_excerpt_length', 999);
