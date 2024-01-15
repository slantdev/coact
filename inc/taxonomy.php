<?php

register_taxonomy(
  'service_types',
  'service-partner',
  array(
    'hierarchical' => true,
    'label' => 'Service Types',
    'show_ui' => true,
    'query_var' => true,
    'show_in_rest' => true,
    'show_admin_column' => false,
  )
);

register_taxonomy(
  'serviced_areas',
  'service-partner',
  array(
    'hierarchical' => false,
    'label' => 'Serviced Areas',
    'show_ui' => true,
    'query_var' => true,
    'show_admin_column' => false,
    'publicly_queryable' => false,
    'show_in_rest' => false,
  )
);
