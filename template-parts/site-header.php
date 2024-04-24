<?php
$top_navigation = get_field('top_navigation', 'option')['top_navigation'];
$top_nav_links = $top_navigation['links'];
$header_logo = get_field('header_logo', 'option')['header_logo'];
$site_logo = $header_logo['site_logo'];
$partners_logo = $header_logo['partners_logo'];

?>

<header class="site-header bg-brand-light-gray relative z-40">
  <div class="hidden xl:block bg-brand-sea h-6"></div>
  <div class="mx-auto max-w-screen-4xl relative">
    <div class="xl:absolute xl:right-0 xl:px-4 z-10">
      <div class="block xl:flex">
        <div class="hidden xl:block rounded-tr-2xl w-4 h-8 bg-transparent shadow-[0_-14px_0_0_rgb(69,194,191)]"></div>
        <div class="xl:rounded-b-2xl bg-brand-sea text-white xl:px-2">
          <?php if ($top_nav_links) : ?>
            <div class="flex gap-x-2 md:justify-end font-poppins font-semibold">
              <?php foreach ($top_nav_links as $key => $link) : ?>
                <?php if ($key == '0') { ?>
                  <div class="">
                    <a href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>" class="inline-flex p-3 md:px-4 md:pb-3 bg-brand-purple md:bg-transparent gap-x-2 hover:underline">
                      <?php if ($link['link_icon']) {
                        echo coact_icon(array('icon' => $link['link_icon'], 'group' => 'utilities', 'size' => '20', 'class' => 'text-white'));
                      } ?>
                      <span class="hidden md:inline-block text-sm xl:text-base"><?php echo $link['link']['title'] ?></span>
                    </a>
                  </div>
                <?php } else { ?>
                  <div class="flex justify-end">
                    <a href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>" class="inline-flex justify-end p-3 xl:px-4 xl:pb-3 gap-x-2 whitespace-nowrap hover:underline">
                      <?php if ($link['link_icon']) {
                        echo coact_icon(array('icon' => $link['link_icon'], 'group' => 'utilities', 'size' => '20', 'class' => 'text-white'));
                      } ?>
                      <span class="inline-block text-sm xl:text-base"><?php echo $link['link']['title'] ?></span>
                    </a>
                  </div>
                <?php } ?>
              <?php endforeach ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="hidden xl:block rounded-tl-2xl w-4 h-8 bg-transparent shadow-[0_-14px_0_0_rgb(69,194,191)]"></div>
      </div>
    </div>
    <div class="relative z-0 px-4 py-4 lg:py-8 flex items-center justify-between xl:justify-normal">
      <button class="menu-open-btn xl:hidden">
        <?php echo coact_icon(array('icon' => 'menu', 'group' => 'utilities', 'size' => '24', 'class' => 'w-7 h-7')); ?>
      </button>
      <?php if ($site_logo) : ?>
        <a href="<?php echo site_url() ?>"><img src="<?php echo $site_logo['url'] ?>" alt="CoAct" class="h-20 lg:h-[100px] w-auto"></a>
      <?php else : ?>
        <a href="<?php echo site_url() ?>"><img src="<?php echo coact_asset('images/logo/logo-coact.svg') ?>" alt="CoAct" class="h-[100px] w-auto"></a>
      <?php endif; ?>
      <?php if ($partners_logo) : ?>
        <div class="hidden xl:flex items-center gap-x-8">
          <div class="pl-8 h-16 border-r border-r-zinc-400 border-solid w-px"></div>
          <?php foreach ($partners_logo as $partner) : ?>
            <?php
            $logo = $partner['logo']['url'] ?? '';
            $alt = $partner['logo']['alt'] ?? '';
            $url = $partner['link']['url'] ?? '';
            $target = $partner['link']['target'] ?? '_self';
            if ($url) {
              echo '<a href="' . $url . '" target="' . $target . '">';
            }
            if ($logo) {
              echo '<img src="' . $logo . '" alt="' . $alt . '" class="w-auto h-16">';
            }
            if ($url) {
              echo '</a>';
            }
            ?>
          <?php endforeach ?>
        </div>
      <?php endif; ?>
      <button class="menu-search-btn xl:hidden">
        <?php echo coact_icon(array('icon' => 'search', 'group' => 'utilities', 'size' => '24', 'class' => 'w-6 h-6')); ?>
      </button>
      <div id="mobile-search" class="absolute top-0 left-0 right-0 bottom-0 bg-brand-light-gray hidden">
        <div class="px-4 py-4 flex items-center w-full h-full">
          <div class="flex w-full gap-x-4 items-center">
            <form id="header-mobile-searchform" class="relative grow" method="get" action="<?php echo esc_url(home_url('/')); ?>">
              <input id="searchform-mobile-input" type="text" class="w-auto xl:w-56 3xl:w-64 border-gray-300 shadow-inner !rounded-full bg-white !px-6 !py-2.5 2xl:!py-3 focus:border-brand-sea focus:ring-brand-sea" name="s" placeholder="Search" value="">
              <button type="submit" class="absolute right-4 top-3">
                <?php echo coact_icon(array('icon' => 'search', 'group' => 'utilities', 'size' => '24', 'class' => 'text-brand-sea w-5 h-5 2xl:w-6 2xl:h-6')); ?>
              </button>
            </form>
            <div class="flex-none">
              <button id="close-mobile-searchform">
                <?php echo coact_icon(array('icon' => 'close', 'group' => 'utilities', 'size' => '24', 'class' => 'w-6 h-6 text-brand-purple')); ?>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php get_template_part('template-parts/components/megamenu'); ?>
  </div>
</header>