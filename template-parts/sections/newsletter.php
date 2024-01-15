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

<section class="bg-brand-purple">
  <div class="relative container max-w-screen-xxl mx-auto py-12">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24 items-center">
      <div class="w-full order-2 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-1/2 relative">
        <div class="mb-8 mx-auto xl:mb-0 max-w-full"><img src="<?php echo coact_asset('images/content/illustration-2.png') ?>" class="" alt=""></div>
      </div>
      <div class="w-full order-1 lg:w-2/3 xl:w-1/2 pt-10">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-8 text-left text-[48px] leading-tight font-bold text-white">Subscribe to the my JobCoach newsletter:</h3>
        </div>
        <div class="my-6">
          <div class="grid grid-cols-2 gap-3">
            <input type="text" placeholder="First name*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
            <input type="text" placeholder="Last name*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
            <input type="text" placeholder="Email*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
            <input type="text" placeholder="Postcode*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
          </div>
        </div>
        <div class="prose max-w-none leading-snug mr-auto text-left mb-6 xl:mb-6 text-white">
          <p>We can help you navigate the world of work with the latest job search tips, news and updates direct to your inbox each week.</p>
        </div>
      </div>
    </div>
  </div>
</section>