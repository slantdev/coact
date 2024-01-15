<?php
$top_navigation = get_field('top_navigation', 'option')['top_navigation'];
$top_nav_links = $top_navigation['links'];
$header_logo = get_field('header_logo', 'option')['header_logo'];
$site_logo = $header_logo['site_logo'];
$partners_logo = $header_logo['partners_logo'];

?>

<header class="site-header bg-brand-light-gray">
  <div class="bg-brand-sea h-6"></div>
  <div class="mx-auto max-w-screen-4xl px-4 relative">
    <div class="absolute right-0 px-4">
      <div class="flex">
        <div class="rounded-tr-2xl w-4 h-8 bg-transparent shadow-[0_-14px_0_0_rgb(69,194,191)]"></div>
        <div class="rounded-b-2xl bg-brand-sea text-white px-2">
          <?php if ($top_nav_links) : ?>
            <div class="flex gap-x-2 font-poppins font-semibold">
              <?php foreach ($top_nav_links as $link) : ?>
                <div class="px-4 pb-3">
                  <a href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>" class="flex gap-x-2 hover:underline">
                    <?php if ($link['link_icon']) {
                      echo coact_icon(array('icon' => $link['link_icon'], 'group' => 'utilities', 'size' => '20', 'class' => 'text-white'));
                    } ?>
                    <span><?php echo $link['link']['title'] ?></span>
                  </a>
                </div>
              <?php endforeach ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="rounded-tl-2xl w-4 h-8 bg-transparent shadow-[0_-14px_0_0_rgb(69,194,191)]"></div>
      </div>
    </div>
    <div class="py-8 flex items-center">
      <?php if ($site_logo) : ?>
        <a href="<?php echo site_url() ?>"><img src="<?php echo $site_logo['url'] ?>" alt="CoAct" class="h-[100px] w-auto"></a>
      <?php else : ?>
        <a href="<?php echo site_url() ?>"><img src="<?php echo coact_asset('images/logo/logo-coact.svg') ?>" alt="CoAct" class="h-[100px] w-auto"></a>
      <?php endif; ?>
      <?php if ($partners_logo) : ?>
        <div class="flex items-center gap-x-8">
          <div class="pl-8 h-16 border-r border-r-zinc-400 border-solid w-px"></div>
          <?php foreach ($partners_logo as $partner) : ?>
            <img src="<?php echo $partner['logo']['url'] ?>" alt="<?php echo $partner['logo']['alt'] ?>" class="w-auto h-16">
          <?php endforeach ?>
        </div>
      <?php else : ?>
        <div class="flex items-center gap-x-8">
          <div class="pl-8 h-16 border-r border-r-zinc-400 border-solid w-px"></div>
          <img src="<?php echo coact_asset('images/logo/logo-workforce-australia.png') ?>" alt="Workforce Australia" class="w-auto h-16">
          <img src="<?php echo coact_asset('images/logo/logo-disability-employment-service.png') ?>" alt="Disability Employment Service" class="w-auto h-16">
          <img src="<?php echo coact_asset('images/logo/logo-ndis.png') ?>" class="w-auto h-16">
        </div>
      <?php endif; ?>
    </div>
    <?php get_template_part('template-parts/components/megamenu'); ?>
  </div>
</header>