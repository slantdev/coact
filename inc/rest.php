<?php

add_filter("rest_service-partner_collection_params", function ($params) {
  $params['per_page']['maximum'] = 500; // number of posts fetched
  return $params;
});
