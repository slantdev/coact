<?php
function plain_card($link, $image, $title, $excerpt)
{
  echo '<div class="relative block pb-4 group">';
  echo '<a href="' . $link . '" class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-lg lg:rounded-2xl">';
  if ($image) {
    echo '<img src="' . $image . '" alt="" class="object-cover w-full h-full transition duration-300 group-hover:scale-105">';
  } else {
    echo '<div class="w-full h-full bg-slate-100"></div>';
  }
  echo '</a>';
  echo '<h4 class="post-title text-lg lg:text-xl font-semibold my-4"><a href="' . $link . '" class="group-hover:underline">' . $title . '</a></h4>';
  echo '<div class="text-sm lg:text-base">' . wp_trim_words($excerpt, 20) . '</div>';
  echo '<a href="' . $link . '" class="text-sm lg:text-base text-brand-sea underline font-medium inline-block mt-4" style="color: var(--section-link-color);">LEARN MORE</a>';
  echo '</div>';
}

function shadow_card($link, $image, $title, $excerpt)
{
  echo '<div class="relative block bg-white rounded-lg lg:rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-2 transition duration-300">';
  echo '<a href="' . $link . '" class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-t-lg lg:rounded-t-2xl">';
  if ($image) {
    echo '<img src="' . $image . '" alt="" class="object-cover w-full h-full transition duration-300">';
  } else {
    echo '<div class="w-full h-full bg-slate-100"></div>';
  }
  echo '</a>';
  echo '<div class="p-6 lg:p-8 bg-white">';
  echo '<h4 class="post-title text-lg lg:text-xl font-semibold mb-4 text-brand-sea" style="color: var(--section-link-color);"><a href="' . $link . '" class="hover:underline">' . $title . '</a></h4>';
  echo '<div class="text-sm">' . wp_trim_words($excerpt, 20) . '</div>';
  echo '<a href="' . $link . '" class="text-brand-sea text-sm underline font-medium inline-block mt-8" style="color: var(--section-link-color);">LEARN MORE</a>';
  echo '</div>';
  echo '</div>';
}

function featured_card($link, $image, $title, $excerpt, $first = false)
{
  echo '<div class="relative block">';
  if ($first) {
    echo '<a href="' . $link . '" class="block aspect-w-16 aspect-h-9 lg:aspect-h-11 overflow-hidden rounded-lg lg:rounded-2xl group">';
  } else {
    echo '<a href="' . $link . '" class="block aspect-w-16 aspect-h-9 overflow-hidden rounded-lg lg:rounded-2xl group">';
  }
  if ($image) {
    echo '<img src="' . $image . '" alt="" class="object-cover w-full h-full transition duration-300 group-hover:scale-105">';
  } else {
    echo '<div class="w-full h-full bg-slate-100"></div>';
  }
  if ($first) {
    echo coact_icon(array('icon' => 'video', 'group' => 'utilities', 'size' => '128', 'class' => 'absolute w-16 h-16 lg:w-24 lg:h-24 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2'));
  } else {
    echo coact_icon(array('icon' => 'video', 'group' => 'utilities', 'size' => '128', 'class' => 'absolute w-16 h-16 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2'));
  }
  echo '</a>';
  if ($first) {
    echo '<h4 class="post-title text-base lg:text-2xl font-semibold mt-3 mb-2"><a href="' . $link . '" class="hover:underline">' . $title . '</a></h4>';
  } else {
    echo '<h4 class="post-title text-base font-semibold mt-3 mb-2"><a href="' . $link . '" class="hover:underline">' . $title . '</a></h4>';
  }
  if ($excerpt) {
    echo '<div class="text-sm">' . wp_trim_words($excerpt, 10) . '</div>';
  }
  echo '</div>';
}
