<?php
$top_navigation = get_field('top_navigation', 'option')['top_navigation'];
$top_nav_links = $top_navigation['links'];
$header_logo = get_field('header_logo', 'option')['header_logo'];
$site_logo = $header_logo['site_logo'];
$partners_logo = $header_logo['partners_logo'];

?>

<header class="site-header bg-brand-light-gray relative z-40">
  <div class="hidden lg:block bg-brand-sea h-6"></div>
  <div class="mx-auto max-w-screen-4xl relative">
    <div class="lg:absolute lg:right-0 lg:px-4">
      <div class="block lg:flex">
        <div class="hidden lg:block rounded-tr-2xl w-4 h-8 bg-transparent shadow-[0_-14px_0_0_rgb(69,194,191)]"></div>
        <div class="lg:rounded-b-2xl bg-brand-sea text-white lg:px-2">
          <?php if ($top_nav_links) : ?>
            <div class="flex gap-x-2 font-poppins font-semibold">
              <?php foreach ($top_nav_links as $key => $link) : ?>
                <?php if ($key == '0') { ?>
                  <a href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>" class="flex p-3 lg:px-4 lg:pb-3 bg-brand-purple lg:bg-transparent gap-x-2 hover:underline">
                    <?php if ($link['link_icon']) {
                      echo coact_icon(array('icon' => $link['link_icon'], 'group' => 'utilities', 'size' => '20', 'class' => 'text-white'));
                    } ?>
                    <span class="hidden lg:inline-block text-sm lg:text-base"><?php echo $link['link']['title'] ?></span>
                  </a>
                <?php } else { ?>
                  <a href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>" class="flex grow p-3 lg:px-4 lg:pb-3 gap-x-2 hover:underline">
                    <?php if ($link['link_icon']) {
                      echo coact_icon(array('icon' => $link['link_icon'], 'group' => 'utilities', 'size' => '20', 'class' => 'text-white'));
                    } ?>
                    <span class="inline-block text-sm lg:text-base"><?php echo $link['link']['title'] ?></span>
                  </a>
                <?php } ?>
              <?php endforeach ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="hidden lg:block rounded-tl-2xl w-4 h-8 bg-transparent shadow-[0_-14px_0_0_rgb(69,194,191)]"></div>
      </div>
    </div>
    <div class="px-4 py-4 lg:py-8 flex items-center justify-between lg:justify-normal">
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
    </div>
    <?php get_template_part('template-parts/components/megamenu'); ?>
  </div>
</header>