<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/
?>

<!-- Text Center -->
<section class="bg-brand-sea">
  <div class="relative container max-w-screen-xxl mx-auto py-12">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24 items-center">
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
    </div>
  </div>
</section>