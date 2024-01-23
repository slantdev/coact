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

<!-- Card News -->
<section class="bg-brand-light-gray">
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="relative z-10">
      <div>
        <div class="not-prose">
          <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold">News & resources</h3>
        </div>
        <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
          <div class="w-full lg:w-2/3">
            <div class="prose xl:prose-lg mr-auto text-left">
              <p>When you register with CoAct, our dedicated local team invests in you from the start. </p>
            </div>
          </div>
          <div class="w-full lg:w-1/3 text-right">
            <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-sea text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">View all</a>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-8">
        <div class="relative block rounded-2xl overflow-hidden shadow-xl">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-t-2xl">
            <img src="https://picsum.photos/400/300?random=26" alt="" class="object-cover">
          </a>
          <div class="p-8">
            <h4 class="text-xl font-semibold mb-4 text-brand-sea">What does the 2023 Budget mean for job seekers?</h4>
            <div class="text-sm">Everyone on Jobseeker The JobSeeker rate will undergo a permanent rise for all beneficiaries, by $40 per fortnight. </div>
            <a href="#" class="text-brand-sea text-sm underline font-medium inline-block mt-8">LEARN MORE</a>
          </div>
        </div>
        <div class="relative block rounded-2xl overflow-hidden shadow-xl">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-t-2xl">
            <img src="https://picsum.photos/400/300?random=27" alt="" class="object-cover">
          </a>
          <div class="p-8">
            <h4 class="text-xl font-semibold mb-4 text-brand-sea">Your guide to Workforce Australia</h4>
            <div class="text-sm">On Monday 4 July, the employment support jobactive customers receive will change. Find out how the new Workforce Australia service affects you.</div>
            <a href="#" class="text-brand-sea text-sm underline font-medium inline-block mt-8">LEARN MORE</a>
          </div>
        </div>
        <div class="relative block rounded-2xl overflow-hidden shadow-xl">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-t-2xl">
            <img src="https://picsum.photos/400/300?random=28" alt="" class="object-cover">
          </a>
          <div class="p-8">
            <h4 class="text-xl font-semibold mb-4 text-brand-sea">How much can I earn on the DSP?</h4>
            <div class="text-sm">Wondering if you’ll lose your Disability Support Pension (DSP) if you start working? Want to find a job but not sure how many hours you can work and still receive the full DSP.?</div>
            <a href="#" class="text-brand-sea text-sm underline font-medium inline-block mt-8">LEARN MORE</a>
          </div>
        </div>
      </div>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>