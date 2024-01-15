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

<!-- Card TV -->
<section>
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="relative z-10">
      <div>
        <div class="not-prose">
          <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold">CoAct TV</h3>
        </div>
        <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
          <div class="w-full lg:w-2/3">
            <div class="prose xl:prose-lg mr-auto text-left">
              <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>
            </div>
          </div>
          <div class="w-full lg:w-1/3 text-right">
            <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-orange text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">View all</a>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-8">
        <div class="col-span-2">
          <div class="relative block">
            <a class="block relative aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
              <img src="https://picsum.photos/800/400?random=22" alt="" class="object-cover">
              <?php echo coact_icon(array('icon' => 'video', 'group' => 'utilities', 'size' => '128', 'class' => 'absolute w-28 h-28 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2')); ?>
            </a>
            <h4 class="text-2xl font-semibold my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          </div>
        </div>
        <div class="col-span-1 grid grid-cols-1 gap-4">
          <div class="relative block">
            <a class="block aspect-w-16 aspect-h-9 overflow-hidden rounded-2xl">
              <img src="https://picsum.photos/400/300?random=23" alt="" class="object-cover">
              <?php echo coact_icon(array('icon' => 'video', 'group' => 'utilities', 'size' => '128', 'class' => 'absolute w-16 h-16 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2')); ?>
            </a>
            <h4 class="text-base font-semibold mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          </div>
          <div class="relative block">
            <a class="block aspect-w-16 aspect-h-9 overflow-hidden rounded-2xl">
              <img src="https://picsum.photos/400/300?random=25" alt="" class="object-cover">
              <?php echo coact_icon(array('icon' => 'video', 'group' => 'utilities', 'size' => '128', 'class' => 'absolute w-16 h-16 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2')); ?>
            </a>
            <h4 class="text-base font-semibold mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>