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
$headline = $who_we_help['headline'];
$description = $who_we_help['description'];
$background_ornament = $who_we_help['background_ornament'];
$button = $who_we_help['button'];
$image_cards = $who_we_help['image_cards']; // Repeater
?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="relative container max-w-screen-xxl mx-auto">
      <?php if ($background_ornament) : ?>
        <div class="absolute top-0 left-0 rounded-full bg-brand-yellow w-[528px] h-[528px] -translate-y-[20%] -translate-x-1/2"></div>
      <?php endif; ?>
      <div class="relative z-10 <?php echo $entrance_animation_class ?>">
        <div>
          <?php if ($headline) : ?>
            <div class="not-prose">
              <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold"><?php echo $headline ?></h3>
            </div>
          <?php endif; ?>
          <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
            <?php if ($description) : ?>
              <div class="w-full lg:w-2/3">
                <div class="prose xl:prose-lg mr-auto text-left">
                  <?php echo $description ?>
                </div>
              </div>
            <?php endif; ?>
            <?php if (isset($button['url'])) : ?>
              <div class="w-full lg:w-1/3 text-right">
                <a href="<?php echo $button['url'] ?>" target="<?php echo $button['target'] ?>" class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-sea text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200"><?php echo $button['title'] ?></a>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <?php if ($image_cards) : ?>
          <div class="grid grid-cols-3 gap-5">
            <?php foreach ($image_cards as $card) : ?>
              <?php
              $image = $card['image'];
              $label = $card['label'];
              ?>
              <div class="relative block">
                <div class="aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
                  <?php if ($image) : ?>
                    <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" class="object-cover">
                  <?php else : ?>
                    <div class="bg-slate-100"></div>
                  <?php endif; ?>
                </div>
                <?php if ($label) : ?>
                  <div class="absolute bottom-0 left-0 right-0">
                    <div class="mb-4 ml-4">
                      <div class="inline-block bg-white rounded-lg py-3 px-4 font-bold"><?php echo $label ?></div>
                    </div>
                  </div>
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