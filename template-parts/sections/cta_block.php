<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
 * $top_separator
 * $top_separator_style
 * $bottom_separator
 * $bottom_separator_style 
*/

$cta_block = get_sub_field('cta_block');
$image = $cta_block['image'];
$headline = $cta_block['headline'];
$description = $cta_block['description'];
$button = $cta_block['button'];
?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <div class="relative container max-w-screen-xxl <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24 items-center <?php echo $entrance_animation_class ?>">
      <?php if ($image) : ?>
        <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
          <div class="mb-8 mx-auto xl:mb-0 max-w-full"><img src="<?php echo $image['url'] ?>" class="" alt=""></div>
        </div>
      <?php else : ?>
        <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
          <div class="mb-8 mx-auto xl:mb-0 max-w-full"><img src="<?php echo coact_asset('images/content/illustration-1.png') ?>" class="" alt=""></div>
        </div>
      <?php endif; ?>
      <?php if ($headline || $description) : ?>
        <div class="w-full order-2 lg:w-2/3 xl:w-3/5 lg:pt-10">
          <?php if ($headline) : ?>
            <div class="not-prose">
              <h3 class="mb-6 lg:mb-8 text-left text-4xl lg:text-5xl font-bold text-white"><?php echo $headline ?></h3>
            </div>
          <?php endif; ?>
          <?php if ($description) : ?>
            <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-6 text-white">
              <?php echo $description ?>
            </div>
          <?php endif; ?>
          <?php get_template_part('template-parts/components/buttons', '', array('field' => $button, 'class' => 'mb-6 xl:mb-0 mt-6 xl:mt-8')); ?>
        </div>
      <?php endif; ?>
    </div>
    <!-- <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24 items-center">
      <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
        <div class="mb-8 mx-auto xl:mb-0 max-w-full"><img src="<?php echo coact_asset('images/content/illustration-1.png') ?>" class="" alt=""></div>
      </div>
      <div class="w-full order-2 lg:w-2/3 xl:w-3/5 pt-10">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-8 text-left text-[48px] font-bold text-white">Find your local CoAct Provider</h3>
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-6 text-white">
          <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna erat.</p>
        </div>        
        <div class="mb-6 xl:mb-0 mt-6 xl:mt-8 text-left"><a href="#" class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-lg lg:px-10 lg:py-3 bg-white text-brand-sea border border-transparent shadow-md hover:shadow-lg transition-all duration-200">Find Support & Services</a></div>
      </div>
    </div> -->
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>