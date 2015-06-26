<?php if(get_field('erickson_tv','3103')): ?>
	
	<div class="blog-widget-repeater row">

	<?php while(has_sub_field('erickson_tv','3103')): ?>
		


		<div class="twelve columns">
			<?php the_sub_field('youtube'); ?>
		</div>
		
	<?php endwhile; ?>
	
	</div>

<?php endif; ?>
