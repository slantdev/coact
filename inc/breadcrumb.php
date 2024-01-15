<?php
/*
 * Multiple examples of how to customize the Yoast SEO breadcrumbs
 * https://gist.github.com/amboutwe/ea0791e184668a5c7bd7bbe357c598e9
 */

//add_filter('wpseo_breadcrumb_links', 'coact_yoast_seo_breadcrumb_append_link');
function coact_yoast_seo_breadcrumb_append_link($links)
{
  global $post;

  if (is_singular('services')) {
    $breadcrumb[] = array(
      'url' => site_url('/services/'),
      'text' => 'Services',
    );
    array_splice($links, 1, -2, $breadcrumb);
  } elseif (is_tax('industry')) {
    $breadcrumb[] = array(
      'url' => site_url('/industry/'),
      'text' => 'Industry',
    );
    array_splice($links, 1, -2, $breadcrumb);
  }

  return $links;
}


add_filter('wpseo_breadcrumb_separator', function ($separator) {
  return '<span class="inline-block px-2"><svg class="inline" xmlns="http://www.w3.org/2000/svg" width="9.245" height="15.38" viewBox="0 0 9.245 15.38"><path id="Arrow_2" data-name="Arrow 2" d="M1846.773,982.341a.677.677,0,0,1,.469.188l6.812,6.505a.687.687,0,0,1,0,.993l-6.812,6.505a.679.679,0,0,1-.963-.025.688.688,0,0,1,.024-.968l6.292-6.009-6.292-6.009a.688.688,0,0,1-.024-.968A.678.678,0,0,1,1846.773,982.341Z" transform="translate(-1845.52 -981.841)" fill="#f26b49" stroke="#f26b49" stroke-width="1" /></svg></span>';
});
