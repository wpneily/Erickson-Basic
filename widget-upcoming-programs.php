<?php if(get_field('upcoming_programs','3103')): ?>
	
	<div class="blog-widget-repeater row">
		
	<?php while(has_sub_field('upcoming_programs','3103')): ?>
		
		<div class="four columns">
			<?php $image = wp_get_attachment_image_src(get_sub_field('image','3103'), 'blog-widget-image'); ?>
			<img src="<?php echo $image[0]; ?>" />
		</div>
		
		<div class="eight columns">
			<p><?php the_sub_field('text'); 
			$date = DateTime::createFromFormat('Ymd',get_sub_field('date','3103')); ?> &nbsp; <span class="date">
			<?php echo $date->format('d-m-Y'); ?></span></p>
		</div>
		
	<?php endwhile; ?>
	
	</div>

<?php endif; ?>
