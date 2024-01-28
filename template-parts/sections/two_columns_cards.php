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

<section>
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="relative z-10 <?php echo $entrance_animation_class ?>">
      <div class="text-center max-w-prose mx-auto mb-14">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-12 text-4xl font-bold">Working with us</h3>
        </div>
        <div class="prose prose-xl max-w-none font-medium mb-6">
          When you visit your local CoAct office, you will be warmly greeted by a dedicated and friendly employment consultant who will assist you throughout your job search journey.
        </div>
      </div>
      <div class="grid grid-cols-2 gap-8">
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=22" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">Experience the power of many</h4>
          <div>Employment services are government-funded services designed to help you build a strong workforce. As a leading national partnership of for-purpose Service Partners, CoAct specialises in finding, recruiting, training, mentoring and supporting Australians who are looking to find and keep work.</div>
          <a href="#" class="text-brand-purple underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=23" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">What are employment services?</h4>
          <div>Employment services are government-funded services designed to help you build a strong workforce. As a leading national partnership of for-purpose Service Partners, CoAct specialises in finding, recruiting, training, mentoring and supporting Australians who are looking to find and keep work.</div>
          <a href="#" class="text-brand-purple underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
      </div>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>