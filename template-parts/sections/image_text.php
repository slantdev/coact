<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/

$section_id = $section_id ? 'id="' . $section_id . '"' : '';

$image_text = get_sub_field('image_text'); // Group
$headline = $image_text['headline'];
$headline_color = $image_text['headline_color'];
$headline_style = '';
if ($headline_color) {
  $headline_style = 'color:' . $headline_color . ';';
}
$lead_text = $image_text['lead_text'];
$content = $image_text['content'];
$components = $image_text['components'];
$image = $image_text['image'];
$rounded_corner = $image_text['rounded_corner'];

$rounded_corner_map = [
  'none' => 'rounded-none',
  'full' => 'rounded-full',
  'xs' => 'rounded-xs',
  'sm' => 'rounded-sm',
  'md' => 'rounded-md',
  'lg' => 'rounded-lg',
  'xl' => 'rounded-xl',
  '2xl' => 'rounded-2xl',
  'default' => 'rounded'
];
$rounded_class = $rounded_corner_map[$rounded_corner] ?? '';

$background_ornament = $image_text['background_ornament'];
$image_column_position = $image_text['image_column_position'];

$column_img_class = 'order-1';
$column_text_class = 'order-2';
if ($image_column_position == 'right') {
  $column_img_class = 'order-2';
  $column_text_class = 'order-1';
}

$icon_links = $image_text['icon_links']; // Repeater

?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="relative container max-w-screen-xxl mx-auto <?php echo $entrance_animation_class ?>">

      <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">

        <div class="w-full max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative <?php echo $column_img_class ?>">
          <?php if ($background_ornament) : ?>
            <?php if ($image_column_position == 'right') : ?>
              <div class="absolute top-0 -right-1/2 translate-x-[15%] scale-x-[-1]">
                <?php echo coact_svg(array('svg' => 'shape-2', 'group' => 'shapes', 'size' => false, 'class' => 'text-brand-sea w-[660px] h-auto')); ?>
              </div>
            <?php else : ?>
              <div class="absolute top-0 -left-1/2 -translate-x-[15%]">
                <?php echo coact_svg(array('svg' => 'shape-2', 'group' => 'shapes', 'size' => false, 'class' => 'text-brand-sea w-[660px] h-auto')); ?>
              </div>
            <?php endif ?>
          <?php endif; ?>
          <?php if ($image) : ?>
            <div class="mb-8 mx-auto xl:mb-12 max-w-full aspect-w-1 aspect-h-1 overflow-hidden <?php echo $rounded_class ?>"><img src="<?php echo $image['url'] ?>" class="mx-auto h-full w-full object-center object-cover <?php echo $rounded_class ?>" alt=""></div>
          <?php endif; ?>
          <?php if ($icon_links) : ?>
            <div class="flex flex-col gap-6">
              <?php foreach ($icon_links as $link) : ?>
                <div class="flex gap-x-6">
                  <div class="flex-none"><?php echo coact_icon(array('icon' => $link['icon'], 'group' => 'content', 'size' => '36', 'class' => 'text-brand-purple')); ?></div>
                  <div class="text-2xl font-medium"><a href="<?php echo $link['link']['url'] ?>" class="text-brand-purple hover:underline"><?php echo $link['link']['title'] ?></a></div>
                </div>
              <?php endforeach ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="w-full lg:w-2/3 xl:w-3/5 pt-6 <?php echo $column_text_class ?>">
          <?php if ($headline) : ?>
            <div class="not-prose">
              <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold" style="<?php echo $headline_style ?>"><?php echo $headline ?></h3>
            </div>
          <?php endif; ?>
          <?php if ($lead_text) : ?>
            <div class="prose prose-xl max-w-none font-medium mb-6">
              <?php echo $lead_text ?>
            </div>
          <?php endif; ?>
          <?php if ($content) : ?>
            <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
              <?php echo $content ?>
            </div>
          <?php endif; ?>
          <?php get_template_part('template-parts/components/components', '', array('field' => $components)); ?>
        </div>
      </div>

    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>