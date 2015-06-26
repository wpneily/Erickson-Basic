<ul class="menu social-media">

	<?php if(is_home() || is_single()) : ?>

		<li>
			<a class="rss" href="<?php bloginfo('url'); ?>/?feed" target="_blank">
				<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/icon-rss-dark.png" alt="RSS" />
			</a>
		</li>

	<?php endif; ?>

	<li>
		<a class="facebook" href="<?php the_field('facebook', 'options'); ?>" target="_blank">
			<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/icon-facebook-dark.png" alt="Facebook"/>
		</a> 
	</li>
	<li>
		<a class="twitter" href="<?php the_field('twitter', 'options'); ?>" target="_blank">
			<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/icon-twitter-dark.png" alt="Twitter"/>
		</a> 
	</li>
	<li>
		<a class="google" href="<?php the_field('google+', 'options'); ?>" target="_blank">
			<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/icon-google-dark.png" alt="Google+"/>
		</a> 
	</li>
	<li>
		<a class="linkedin" href="<?php the_field('linkedin', 'options'); ?>" target="_blank">
			<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/icon-linkedin-dark.png" alt="Linkedin"/>
		</a> 
	</li>
</ul>
