<?php
include get_template_directory() . '/template-parts/layouts/section_settings.php';
/*
 * Available section variables
 * $section_id
 * $section_style
 * $section_padding_top
 * $section_padding_bottom
*/

$on_this_page = get_sub_field('on_this_page')['on_this_page'];
?>
<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <?php get_template_part('template-parts/layouts/background_ornament', '', array('shape' => $ornament_shape, 'style' => $ornament_style, 'class' => 'max-w-screen-3xl')); ?>
    <div class="container max-w-screen-md relative z-10 pt-24 <?php echo $entrance_animation_class ?>">
      <div class="dropdown dropdown-end w-full">
        <label tabindex="0" class="my-1 relative flex justify-between items-center w-full text-lg bg-white border border-zinc-300 rounded-full py-4 px-8">
          <span>On this page</span>
          <div>
            <?php echo coact_icon(array('icon' => 'chevron-down', 'group' => 'utilities', 'size' => '20', 'class' => 'text-zinc-400')); ?>
          </div>
        </label>
        <?php if ($on_this_page) : ?>
          <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-zinc-50 text-lg rounded-box w-full">
            <?php foreach ($on_this_page as $link) : ?>
              <li><a href="<?php echo $link['anchor_link']['url'] ?>"><?php echo $link['anchor_link']['title'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>