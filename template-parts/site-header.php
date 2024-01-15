<header class="site-header bg-brand-light-gray">
  <div class="bg-brand-sea h-6"></div>
  <div class="mx-auto max-w-screen-4xl px-4 relative">
    <div class="absolute right-0 px-4">
      <div class="flex">
        <!-- <div class="rounded-t-2xl w-8 h-9 bg-white">&nbsp;</div> -->
        <div class="rounded-b-2xl bg-brand-sea text-white px-6">
          <div class="flex gap-x-2 font-poppins font-semibold">
            <div class="px-4 pb-3"><a href="#" class="flex gap-x-2"><?php echo coact_icon(array('icon' => 'phone', 'group' => 'utilities', 'size' => '20', 'class' => 'text-white')); ?><span>1800 226 228</span></a></div>
            <div class="px-4 pb-3"><a href="/site-locator/" class="flex gap-x-2"><?php echo coact_icon(array('icon' => 'marker', 'group' => 'utilities', 'size' => '20', 'class' => 'text-white')); ?><span>Site locator</span></a></div>
            <div class="px-4 pb-3"><a href="#" class="flex gap-x-2"><?php echo coact_icon(array('icon' => 'register', 'group' => 'utilities', 'size' => '20', 'class' => 'text-white')); ?><span>Register</span></a></div>
          </div>
        </div>
        <!-- <div class="rounded-t-2xl w-8 h-full bg-white">&nbsp;</div> -->
      </div>
    </div>
    <div class="py-8 flex items-center">
      <a href="<?php echo site_url() ?>"><img src="<?php echo coact_asset('images/logo/logo-coact.svg') ?>" alt="CoAct" class="h-[100px] w-auto"></a>
      <div class="flex items-center gap-x-8">
        <div class="pl-8 h-16 border-r border-r-zinc-400 border-solid w-px"></div>
        <img src="<?php echo coact_asset('images/logo/logo-workforce-australia.png') ?>" alt="Workforce Australia" class="w-auto h-16">
        <img src="<?php echo coact_asset('images/logo/logo-disability-employment-service.png') ?>" alt="Disability Employment Service" class="w-auto h-16">
        <img src="<?php echo coact_asset('images/logo/logo-ndis.png') ?>" class="w-auto h-16">
      </div>
    </div>
    <?php get_template_part('template-parts/components/megamenu'); ?>
  </div>
</header>