</main>

<?php do_action('coact_content_end'); ?>

</div>

<?php do_action('coact_content_after'); ?>

<?php get_template_part('template-parts/site', 'footer'); ?>

</div>

<?php wp_footer(); ?>

<div class="fixed z-50 right-4 bottom-16 text-blue-600">
  <a href="#reciteme" class="text-blue-600">
    <?php echo coact_icon(array('icon' => 'accesibility', 'group' => 'utilities', 'size' => '48', 'class' => 'w-12 h-12')); ?>
  </a>
</div>
</body>

</html>