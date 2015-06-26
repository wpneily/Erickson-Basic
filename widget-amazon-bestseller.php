<div class="amazon-bestseller">
	<!--<?php $image = wp_get_attachment_image_src(get_field('amazon_bestseller_image','3103'), 'amazon-bestseller'); ?>
	<img class="amazon-image" src="<?php echo $image[0]; ?>" />-->
	<img class="amazon-image" src="<?php the_field('amazon_bestseller_image','3103'); ?>" />
	
	<div class="amazon-info">
		<p class="amazon-price"><?php the_field('amazon_bestseller_price','3103'); ?></p>
		<a class="button" href="<?php the_field('amazon_bestseller_link','3103'); ?>"><?php the_field('amazon_bestseller_link_text','3103'); ?></a>
	</div>
</div>
