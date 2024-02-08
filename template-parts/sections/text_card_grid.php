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

$text_card_grid = get_sub_field('text_card_grid');
$intro = $text_card_grid['intro'];
$headline = $intro['headline'];
$description = $intro['description'];
$text_cards = $text_card_grid['text_cards']; // Repeater

?>

<section <?php echo $section_id ?> style="<?php echo $section_style ?>">
  <?php get_template_part('template-parts/layouts/background_ornament', '', array('shape' => $ornament_shape, 'style' => $ornament_style, 'class' => 'max-w-screen-4xl')); ?>
  <div class="relative <?php echo $section_padding_top . ' ' . $section_padding_bottom ?>">
    <?php if ($top_separator) : ?>
      <div class="absolute h-12 w-px top-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $top_separator_style ?>"></div>
    <?php endif; ?>
    <div class="container max-w-screen-xxl mx-auto animation-wrapper">
      <div class="relative z-10 mx-auto <?php echo $entrance_animation_class ?>">
        <?php if ($headline || $description) : ?>
          <div class="text-center max-w-prose mx-auto mb-14">
            <?php if ($headline) : ?>
              <div class="not-prose">
                <h3 class="mb-8 xl:mb-12 text-4xl font-bold"><?php echo $headline ?></h3>
              </div>
            <?php endif; ?>
            <?php if ($description) : ?>
              <div class="prose prose-xl max-w-none font-medium mb-6">
                <?php echo $description ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <?php if ($text_cards) : ?>
          <div class="grid grid-cols-3 gap-8">
            <?php foreach ($text_cards as $card) : ?>
              <?php
              $title = $card['title'];
              $excerpt = $card['excerpt'];
              $link = $card['link'];
              ?>
              <div class="relative flex flex-col shadow-lg p-8 rounded-lg border border-solid border-gray-200">
                <?php if ($title) { ?>
                  <?php if ($link) {
                    echo '<h4 class="text-2xl font-semibold my-4"><a href="' . $link['url'] . '" class="hover:underline">' . $title . '</a></h4>';
                  } else {
                    echo '<h4 class="text-2xl font-semibold my-4">' . $title . '</h4>';
                  } ?>
                <?php } ?>
                <?php if ($excerpt) {
                  echo '<div>' . $excerpt . '</div>';
                } ?>
                <?php if ($link) {
                  echo '<div class="mt-auto">';
                  echo '<a href="' . $link['url'] . '" class="text-brand-purple underline uppercase font-medium inline-block mt-4 hover:no-underline">' . $link['title'] . '</a>';
                  echo '</div>';
                } ?>
              </div>

            <?php endforeach ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <?php if ($bottom_separator) : ?>
      <div class="absolute h-12 w-px bottom-0 left-1/2 border-l border-solid border-brand-purple" style="<?php echo $bottom_separator_style ?>"></div>
    <?php endif; ?>
  </div>
</section>

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