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
//require get_template_directory() . '/inc/ajax.php';

function coact_excerpt_length($length)
{
  return 20;
}
add_filter('excerpt_length', 'coact_excerpt_length', 999);


function plain_card($link, $image, $title, $excerpt)
{
  echo '<div class="relative block">';
  echo '<a href="' . $link . '" class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">';
  echo '<img src="' . $image . '" alt="" class="object-cover">';
  echo '</a>';
  echo '<h4 class="text-xl font-semibold my-4"><a href="' . $link . '">' . $title . '</a></h4>';
  echo '<div>' . $excerpt . '</div>';
  echo '<a href="' . $link . '" class="text-brand-sea underline font-medium inline-block mt-4">LEARN MORE</a>';
  echo '</div>';
}

function shadow_card($link, $image, $title, $excerpt)
{
  echo '<div class="relative block bg-white rounded-2xl overflow-hidden shadow-xl">';
  echo '<a href="' . $link . '" class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-t-2xl">';
  echo '<img src="' . $image . '" alt="" class="object-cover">';
  echo '</a>';
  echo '<div class="p-8 bg-white">';
  echo '<h4 class="text-xl font-semibold mb-4 text-brand-sea"><a href="' . $link . '">' . $title . '</a></h4>';
  echo '<div class="text-sm">' . $excerpt . '</div>';
  echo '<a href="' . $link . '" class="text-brand-sea text-sm underline font-medium inline-block mt-8">LEARN MORE</a>';
  echo '</div>';
  echo '</div>';
}

function featured_card($link, $image, $title, $first = false)
{
  echo '<div class="relative block">';
  if ($first) {
    echo '<a href="' . $link . '" class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">';
  } else {
    echo '<a href="' . $link . '" class="block aspect-w-16 aspect-h-9 overflow-hidden rounded-2xl">';
  }
  echo '<img src="' . $image . '" alt="" class="object-cover">';
  echo coact_icon(array('icon' => 'video', 'group' => 'utilities', 'size' => '128', 'class' => 'absolute w-28 h-28 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2'));
  echo '</a>';
  if ($first) {
    echo '<h4 class="text-2xl font-semibold mt-4"><a href="' . $link . '">' . $title . '</a></h4>';
  } else {
    echo '<h4 class="text-base font-semibold mt-4"><a href="' . $link . '">' . $title . '</a></h4>';
  }
  echo '</div>';
}
