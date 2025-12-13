<?php
$hello_bar = get_field('hello_bar', 'option')['hello_bar'];
$set_active = $hello_bar['set_active'] ?? '';
$hello_bar_text = $hello_bar['hello_bar_text'] ?? '';
$message = $hello_bar_text['message'] ?? '';
$description = $hello_bar_text['description'] ?? '';
$link = $hello_bar_text['link'] ?? '';
$link_url = $link['url'] ?? '';
$link_title = $link['title'] ?? 'Learn more';
$link_target = $link['target'] ?? '_self';

$hello_bar_settings = $hello_bar['hello_bar_settings'] ?? '';
$closeable = $hello_bar_settings['closeable'] ?? '';
$background_color = $hello_bar_settings['background_color'] ?? '';
$bg_style = '';
if ($background_color) {
  $bg_style = 'background-color: ' . $background_color . ';';
}
$text_color = $hello_bar_settings['text_color'] ?? '';
$text_style = '';
if ($text_color) {
  $text_style = 'color: ' . $text_color . ';';
}

$print_link = '';
if ($link_url) {
  $print_link = '&nbsp;&nbsp;<a href="' . $link_url . '" target="' . $link_target . '" class="text-white underline hover:no-underline" style="' . $text_style . '">' . $link_title . '</a>';
}

if ($set_active) :
?>
  <div id="hello-bar" class="bg-red text-white py-3 px-4 hidden" style="<?php echo $bg_style ?>">
    <div class="container mx-auto px-0">
      <div class="flex items-center gap-x-4">
        <div class="grow">
          <?php if ($message) : ?>
            <div class="text-sm lg:text-base text-center font-normal" style="<?php echo $text_style ?>">
              <div class="inline"><?php echo strip_tags($message, '<a><b><strong><i><u><em><br><span>'); ?></div>
              <div class="inline"><?php echo $print_link ?></div>
            </div>
          <?php endif; ?>
        </div>
        <?php if ($closeable) : ?>
          <div class="flex-none">
            <a href="#" id="close-hello" class="text-white" style="<?php echo $text_style ?>"><?php echo coact_icon(array('icon' => 'close', 'group'  => 'utilities', 'size' => 16)); ?></a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <script>
    jQuery(document).ready(function($) {
      // Show the hello bar only if it hasn't been closed in the current session
      if (sessionStorage.getItem('helloBarHidden') !== 'true') {
        $('#hello-bar').show();
      }

      // Hide the hello bar and set session storage on click
      $('#close-hello').on('click', function(e) {
        e.preventDefault();
        $('#hello-bar').hide();
        sessionStorage.setItem('helloBarHidden', 'true');
      });
    });
  </script>
<?php
endif;
?>

<?php
$top_navigation = get_field('top_navigation', 'option')['top_navigation'];
$top_nav_links = $top_navigation['links'];
$header_logo = get_field('header_logo', 'option')['header_logo'];
$site_logo = $header_logo['site_logo'];
$partners_logo = $header_logo['partners_logo'];

?>

<header class="site-header bg-brand-light-gray relative z-[1000]">
  <div class="hidden xl:block bg-brand-sea h-6"></div>
  <div class="mx-auto max-w-screen-4xl relative">
    <div class="xl:absolute xl:right-0 xl:px-4 z-10">
      <div class="block xl:flex">
        <div class="hidden xl:block rounded-tr-2xl w-4 h-8 bg-transparent shadow-[0_-14px_0_0_rgb(69,194,191)]"></div>
        <div class="xl:rounded-b-2xl bg-brand-sea text-black xl:px-2">
          <?php if ($top_nav_links) : ?>
            <div class="flex gap-x-1 justify-between md:gap-x-2 md:justify-end font-poppins font-semibold">
              <?php foreach ($top_nav_links as $key => $link) : ?>
                <?php if ($key == '0') { ?>
                  <div class="">
                    <a href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>" class="inline-flex px-3 py-3 md:px-4 md:pb-3 bg-brand-purple md:bg-transparent gap-x-1 md:gap-x-2 hover:underline">
                      <?php if ($link['link_icon']) {
                        echo coact_icon(array('icon' => $link['link_icon'], 'group' => 'content', 'size' => '20', 'class' => 'text-black'));
                      } ?>
                      <span class="hidden md:inline-block text-[12px] md:text-sm xl:text-base"><?php echo $link['link']['title'] ?></span>
                    </a>
                  </div>
                <?php } else { ?>
                  <div class="flex justify-end">
                    <a href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>" class="inline-flex justify-end px-3 py-3 md:px-4 xl:pb-3 gap-x-1 md:gap-x-2 whitespace-nowrap hover:underline">
                      <?php if ($link['link_icon']) {
                        echo coact_icon(array('icon' => $link['link_icon'], 'group' => 'content', 'size' => '20', 'class' => 'text-black'));
                      } ?>
                      <span class="inline-block text-[12px] md:text-sm xl:text-base"><?php echo $link['link']['title'] ?></span>
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
        <a href="<?php echo site_url() ?>"><img src="<?php echo $site_logo['url'] ?>" alt="CoAct" class="h-20 lg:h-[100px] w-auto max-w-full"></a>
      <?php else : ?>
        <a href="<?php echo site_url() ?>"><img src="<?php echo coact_asset('images/logo/logo-coact.svg') ?>" alt="CoAct" class="h-[100px] w-auto max-w-full"></a>
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
              <input id="searchform-mobile-input" type="text" class="w-auto xl:w-56 3xl:w-64 border-gray-300 shadow-inner !rounded-full bg-white !px-6 !py-2.5 2xl:!py-3 focus:border-brand-sea focus:ring-brand-sea" name="s" placeholder="Search" value="" role="searchbox" aria-label="Search">
              <button type="submit" class="absolute right-4 top-3" aria-label="Search">
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