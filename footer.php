</main>

<?php do_action('coact_content_end'); ?>

</div>

<?php do_action('coact_content_after'); ?>

<?php get_template_part('template-parts/site', 'footer'); ?>

</div>

<?php wp_footer(); ?>

<div class="fixed z-50 right-2.5 bottom-3 md:bottom-[2px] rounded-full shadow-[0_0_8px_0_rgba(0,0,0,0.5)] text-blue-600">
  <a href="#reciteme" class="text-blue-600">
    <?php echo coact_icon(array('icon' => 'accesibility', 'group' => 'utilities', 'size' => '48', 'class' => 'w-[46px] h-[46px] md:w-[44px] md:h-[44px]')); ?>
  </a>
</div>
</body>

</html>