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
<section class="bg-white relative mt-10">
  <div class="relative max-w-screen-3xl h-1">
    <div class="absolute top-0 right-0">
      <?php echo coact_svg(array('svg' => 'shape-1', 'group' => 'shapes', 'size' => false, 'class' => 'text-brand-orange w-[500px] h-auto')); ?>
    </div>
  </div>
  <div class="container max-w-screen-md relative z-10 pt-24">
    <select name="" id="" class="w-full border-zinc-300 rounded-full py-4 pl-8">
      <option value="">On this page</option>
      <option value="">Option 1</option>
      <option value="">Option 2</option>
    </select>
  </div>
</section>