<?php get_header(); ?>

<div class="container max-w-screen-lg mx-auto my-8">
	<div class="flex items-center justify-center py-8 xl:py-16">
		<div class="max-w-screen-lg m-8 bg-white">
			<div class="text-5xl md:text-15xl text-gray-800 border-brand-sea border-b">404</div>
			<div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>
			<p class="text-gray-800 text-2xl md:text-3xl font-light mb-8"><?php _e('Sorry, the page you are looking for could not be found.', 'tailpress'); ?></p>
			<a href="<?php echo get_bloginfo('url'); ?>" class="bg-brand-sea px-4 py-2 rounded text-white">
				<?php _e('Go to Homepage', 'tailpress'); ?>
			</a>
		</div>
	</div>
</div>

<?php
get_footer();
