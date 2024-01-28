<?php
$term_id = get_queried_object()->term_id ?? null;
$the_id = $term_id ? 'term_' . $term_id : get_the_ID();

if (have_rows('section', $the_id)) :

  // Loop through rows.
  while (have_rows('section', $the_id)) : the_row();

    if (get_row_layout() == 'text_center') :
      get_template_part('template-parts/sections/text_center');

    elseif (get_row_layout() == 'hero_slider') :
      get_template_part('template-parts/sections/hero_slider');

    elseif (get_row_layout() == 'get_started_card') :
      get_template_part('template-parts/sections/get_started_card');

    elseif (get_row_layout() == 'icon_numbers') :
      get_template_part('template-parts/sections/icon_numbers');

    elseif (get_row_layout() == 'who_we_help') :
      get_template_part('template-parts/sections/who_we_help');

    elseif (get_row_layout() == 'image_text') :
      get_template_part('template-parts/sections/image_text');

    elseif (get_row_layout() == 'logo_carousel') :
      get_template_part('template-parts/sections/logo_carousel');

    elseif (get_row_layout() == 'cta_block') :
      get_template_part('template-parts/sections/cta_block');

    elseif (get_row_layout() == 'on_this_page') :
      get_template_part('template-parts/sections/on_this_page');

    elseif (get_row_layout() == 'posts_grid') :
      get_template_part('template-parts/sections/posts_grid');

    elseif (get_row_layout() == 'coact_tv') :
      get_template_part('template-parts/sections/coact_tv');

    elseif (get_row_layout() == 'two_columns_cards') :
      get_template_part('template-parts/sections/two_columns_cards');

    elseif (get_row_layout() == 'testimonials') :
      get_template_part('template-parts/sections/testimonials');

    elseif (get_row_layout() == 'newsletter') :
      get_template_part('template-parts/sections/newsletter');

    elseif (get_row_layout() == 'form') :
      get_template_part('template-parts/sections/form');

    endif;

  // End loop.
  endwhile;

// No value.
else :
// Do something...
endif;
