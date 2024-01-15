<?php
/*
 * Page Settings
 */
$term_id = get_queried_object()->term_id ?? null;
$the_id = $term_id ? 'term_' . $term_id : get_the_ID();

$breadcrumbs = ($args['breadcrumbs'] === true);
$enable_page_header = get_field('enable_page_header', $the_id);

if ($enable_page_header) :
  $page_header = get_field('page_header', $the_id)['page_header'];
  $title = $page_header['title'] ?? '';
  $description = $page_header['description'] ?? '';
  $button = $page_header['button'] ?? '';
  $settings = $page_header['settings'] ?? '';
  $text_color = $settings['text_color'] ?? '';
  $text_background_color = $settings['text_background_color'] ?? '';
  $background_image = $settings['background_image'] ?? '';
  $background_position = $settings['background_position'] ?? '';
  $bg_image_class = '';
  if ($background_position) {
    $bg_image_class = ' object-' . $background_position;
  }

  if (!$title) {
    if (is_tax()) {
      $title = get_term($the_id)->name;
    } else {
      $title = get_the_title();
    }
  }

  $text_style = $text_color ? 'color: ' . $text_color . ';' : '';

  $text_bg_style = $text_background_color ? 'background-color: ' . $text_background_color . ';' : '';

  $enable_breadcrumbs = $page_header['enable_breadcrumbs'];
?>
  <section class="bg-gradient-to-b from-brand-light-gray from-90% via-white via-90% to-white">
    <div class="max-w-screen-5xl px-4 mx-auto">
      <div class="aspect-w-16 aspect-h-6 rounded-3xl overflow-hidden">
        <div class="bg-zinc-300 w-full h-full">
          <?php if ($background_image) : ?>
            <img class="object-cover w-full h-full <?php echo $bg_image_class ?>" src="<?php echo $background_image['url'] ?>" alt="">
          <?php endif; ?>
          <div class="absolute top-0 left-0 w-[1300px] h-[1300px] rounded-full bg-brand-sea bg-opacity-80 -translate-y-1/4 -translate-x-1/4" style="<?php echo $text_bg_style ?>"></div>
          <div class="absolute inset-0 flex items-center p-12">
            <div class="container max-w-screen-xxl mx-auto">
              <div class="max-w-lg font-montserrat" style="<?php echo $text_style ?>">
                <?php if ($enable_breadcrumbs) : ?>
                  <?php
                  if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<div class="breadcrumbs mb-16">', '</div>');
                  }
                  ?>
                <?php endif; ?>
                <?php if ($title) : ?>
                  <h2 class="text-5xl font-bold mb-4"><?php echo $title ?></h2>
                <?php endif; ?>
                <?php if ($description) : ?>
                  <div class="text-xl font-medium mt-4">
                    <?php echo $description ?>
                  </div>
                <?php endif; ?>
                <?php if ($button) : ?>
                  <?php
                  $button_link = isset($button['url']) ? $button['url'] : '';
                  $button_target = isset($button['target']) ? $button['target'] : '_self';
                  $button_title = isset($button['title']) ? $button['title'] : '';
                  ?>
                  <div class="flex gap-x-4 mt-8">
                    <a href="<?php echo $button_link ?>" target="<?php echo $button_target; ?>" class="px-6 py-3 rounded-full border border-solid font-semibold font-poppins text-xl bg-white border-transparent text-black"><?php echo $button_title; ?></a>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


<?php endif; ?>