<?php

add_action('init', 'my_cpt_init');
function my_cpt_init()
{
  // register_post_type('service-partner', array(
  //   'label' => 'Service Partners',
  //   'description' => '',
  //   'public' => true,
  //   'exclude_from_search' => false,
  //   'publicly_queryable' => true,
  //   'show_ui' => true,
  //   'show_in_menu' => true,
  //   'capability_type' => 'post',
  //   'map_meta_cap' => true,
  //   'hierarchical' => true,
  //   'menu_icon' => 'dashicons-location',
  //   'rewrite' => array(
  //     'slug' => 'service-partner',
  //     'with_front' => false,
  //   ),
  //   'query_var' => true,
  //   'has_archive' => false,
  //   'show_in_rest'      => true,
  //   'supports' => array('title', 'editor', 'revisions', 'page-attributes'),
  //   'labels' => array(
  //     'name' => 'Service Partners',
  //     'singular_name' => 'Service Partner',
  //     'menu_name' => 'Service Partners',
  //     'add_new' => 'Add Service Partner',
  //     'add_new_item' => 'Add New Service Partner',
  //     'edit' => 'Edit',
  //     'edit_item' => 'Edit Service Partner',
  //     'new_item' => 'New Service Partner',
  //     'view' => 'View Service Partner',
  //     'view_item' => 'View Service Partner',
  //     'search_items' => 'Search Service Partners',
  //     'not_found' => 'No Service Partners Found',
  //     'not_found_in_trash' => 'No Service Partners Found in Trash',
  //     'parent' => 'Parent Service Partner',
  //   )
  // ));
  // register_taxonomy(
  //   'service_types',
  //   'service-partner',
  //   array(
  //     'hierarchical' => true,
  //     'label' => 'Service Types',
  //     'show_ui' => true,
  //     'query_var' => true,
  //     'show_in_rest' => true,
  //     'show_admin_column' => true,
  //   )
  // );

  // register_taxonomy(
  //   'serviced_areas',
  //   'service-partner',
  //   array(
  //     'hierarchical' => false,
  //     'label' => 'Serviced Areas',
  //     'show_ui' => true,
  //     'query_var' => true,
  //     'show_admin_column' => false,
  //     'publicly_queryable' => false,
  //     'show_in_rest' => false,
  //   )
  // );
}


// $post_type = 'service-partner';
// add_filter("rest_{$post_type}_collection_params", function ($params) {
//   $params['per_page']['maximum'] = 500; // number of posts fetched
//   return $params;
// });

// add_filter('rest_service_partner_params', 'my_prefix_change_post_per_page', 10, 1);
// function my_prefix_change_post_per_page($params)
// {
//   if (isset($params['per_page'])) {
//     $params['per_page']['maximum'] = 200;
//   }
//   return $params;
// }
