<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/

$section_id = $section_id ? 'id="' . $section_id . '"' : '';

// $text_center = get_sub_field('text_center');
// $headline = $text_center['headline'];
// $description = $text_center['description'];

// $components = $text_center['components'];


?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="container mx-auto">
      <div class="max-w-screen-lg text-center mx-auto relative z-[1]">
        <div class="text-center max-w-prose mx-auto mb-14">
          <div class="not-prose">
            <h3 class="mb-8 xl:mb-12 text-4xl font-bold">What job seekers say about us</h3>
          </div>
        </div>
        <h3 class="text-brand-purple text-3xl font-bold">Going into CoAct I wasn’t sure what to expect but with continued support I’ve found myself setting and achieving goals while also meeting my requirements. I think what sets CoAct apart from regular job providers is the continued engagement, encouragement and empathy. They didn’t just do it for me; they helped me to help myself. </h3>
        <div class="mt-6 text-lg font-bold">Larissa, Job Seeker</div>
      </div>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>