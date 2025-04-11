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

$who_we_help = get_sub_field('who_we_help'); // Group

$headline = $who_we_help['headline'] ?? '';
$headline_color = $who_we_help['headline_color'] ?? '';
$headline_style = '';
if ($headline_color) {
  $headline_style .= 'color : ' . $headline_color . ';';
}
$headline_html_tag = $who_we_help['headline_html_tag'] ?? 'h2';
if ($headline_html_tag == 'default') {
  $headline_html_tag = 'h2';
}
$description = $who_we_help['description'] ?? '';
$description_color = $who_we_help['description_color'] ?? '';
$description_style = '';
if ($description_color) {
  $description_style .= 'color : ' . $description_color . ';';
}

$background_ornament = $who_we_help['background_ornament'] ?? '';
$button = $who_we_help['button'] ?? '';
$button_color = $who_we_help['button_color'] ?? '';
$button_style = '';
if ($button_color) {
  $button_style .= 'background-color : ' . $button_color . ';';
}
$image_cards = $who_we_help['image_cards'] ?? []; // Repeater
?>

<section <?php echo $section_id ?> class="relative <?php echo $section_class ?>" style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="relative container max-w-screen-xxl mx-auto">
      <?php if ($background_ornament) : ?>
        <div class="absolute top-0 left-0 rounded-full bg-brand-yellow w-[320px] h-[320px] lg:w-[528px] lg:h-[528px] -translate-y-[10%] lg:-translate-y-[20%] -translate-x-1/2"></div>
      <?php endif; ?>
      <div class="relative z-10 <?php echo $entrance_animation_class ?>">
        <div>
          <?php
          if ($headline) {
            echo '<div class="not-prose">';
            echo '<' . $headline_html_tag;
            echo ' class="mb-4 xl:mb-8 text-left text-3xl lg:text-4xl font-bold"';
            echo ' style="' . $headline_style . '">';
            echo $headline;
            echo '</' . $headline_html_tag . '>';
            echo '</div>';
          }
          ?>
          <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
            <?php if ($description) : ?>
              <div class="w-full lg:w-2/3">
                <div class="prose xl:prose-lg mr-auto text-left" style="<?php echo $description_style ?>">
                  <?php echo $description ?>
                </div>
              </div>
            <?php endif; ?>
            <?php if (isset($button['url'])) : ?>
              <div class="w-full pt-4 lg:pt-0 lg:w-1/3 lg:text-right">
                <a href="<?php echo $button['url'] ?>" target="<?php echo $button['target'] ?>" class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-sea text-black border border-transparent shadow-md hover:shadow-lg transition-all duration-200" style="<?php echo $button_style ?>"><?php echo $button['title'] ?></a>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <?php if ($image_cards) : ?>
          <div class="grid grid-cols-1 gap-3 lg:grid-cols-3 lg:gap-5">
            <?php foreach ($image_cards as $card) : ?>
              <?php
              $image = $card['image'] ?? '';
              $label = $card['label'] ?? '';
              $link = $card['link'] ?? '';
              ?>
              <div class="relative block">
                <?php if (isset($link['url'])) : ?>
                  <a href="<?php echo $link['url'] ?>" class="block hover:[&_img]:scale-110">
                  <?php endif; ?>
                  <div class="aspect-w-16 aspect-h-10 overflow-hidden rounded-lg lg:rounded-2xl">
                    <?php if ($image) : ?>
                      <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" class="object-cover transition duration-300">
                    <?php else : ?>
                      <div class="bg-slate-100"></div>
                    <?php endif; ?>
                  </div>
                  <?php if ($label) : ?>
                    <div class="absolute bottom-0 left-0 right-0">
                      <div class="mb-4 ml-4 mr-4">
                        <div class="inline-block bg-white rounded lg:rounded-lg py-2 px-3 lg:py-3 lg:px-4 text-sm lg:text-base font-bold"><?php echo $label ?></div>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php if (isset($link['url'])) : ?>
                  </a>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>