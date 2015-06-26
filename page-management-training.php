<?php
/*
Template Name: Management Training - with RSS
*/
?>

<?php get_header(); ?>

				</div> <!-- Closing main content div for slider -->
			</div><!-- /End of .Container -->
				<div class="featured" align="center">

					<?php
						$locations = get_terms('calendar-location', 'hide_empty=0&parent=203');
						$cities = array();
						foreach($locations as $location){
							$cities[]= $location->slug;
						}
						$region_terms = get_terms('calendar-region');
						$regions = array();
						foreach($region_terms as $region){
							$regions[] = $region ->name;
						}
						//new code - gets the regions from the repeater field
						if(get_field('slider')){

							$set_cities = array();
							$set_regions = array();
							$set_countries = array();
							$slider_regions = get_field('slider');
							$the_regions = $slider_regions[0]['location_buttons'];
						    foreach($the_regions as $region ){
							    $set_cities[] = $region['region_location'];
							    $set_regions[] = $region['region'];
						    }
						}
					?>

					<!-- Hook up the FlexSlider -->

					<script type="text/javascript">
						jQuery(document).ready(function($) {

							$('.geoslider').flexslider({
								animation: "fade",
								slideshow: false,
								controlNav: false,
								directionNav: true,
								controlsContainer: '.navigation-container',
								start: function(){
									jQuery('.geoslider').animate({opacity: 1}, 1000);
								}
							});
							<?php
								$js_array = json_encode($cities);
								$js_regions = json_encode($regions);
								$js_array = json_encode($set_cities);
								$js_regions = json_encode($set_regions);
								echo "var regions_array = ".$js_regions."; ";
								echo "var locations_array = ". $js_array . ";\n";
							?>
								var region_check = false;
								var default_link = jQuery('.default');
								var term_city = mmjsCity.replace(/\s+/g, '-').toLowerCase();
								var region = mmjsRegion;

								if(jQuery.inArray(term_city, locations_array) != -1){

									default_link.hide();
									jQuery('.'+term_city).css('display', 'inline-block');
									region_check = true;
								}
								if(region_check == false && jQuery.inArray(region, regions_array) != -1){
									default_link.hide();
									jQuery('.'+region).css('display', 'inline-block');
									region_check = true;
								}
						});
					</script>


					<div class="flexslider geoslider">
					    <ul class="slides">
				    	<?php if(get_field('slider')): ?>


							<?php while(the_repeater_field('slider')): ?>

								<li>

									<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'new-wpf-home-featured'); ?>
									<img class="slider-img" src="<?php echo $image[0]; ?>" alt="Professional Coach Training for Business, Life and Career" width="1318" height="384" />


									<div class="slider-text">

											<?php echo the_sub_field('content'); ?>
											<a href="<?php the_sub_field('on-location_link'); ?>" class="button default"><?php echo the_sub_field('on-location_link_text'); ?></a>
											<?php

												if(get_sub_field('location_buttons'))
												{
													while(has_sub_field('location_buttons'))
													{ ?>
														<a href="<?php the_sub_field('region_location_link'); ?>" class="button hide <?php the_sub_field('region_location');?> <?php the_sub_field('region');?>"><?php echo the_sub_field('region_location_link_text'); ?></a>
											<?php
													}

												}
											?>

											<a href="<?php the_sub_field('online_link'); ?>" class="button"><?php echo the_sub_field('online_link_text'); ?></a>

									</div>

								</li>
				 				<?php endwhile; ?>
						<?php endif; ?>
					    </ul>

					    <div class="navigation-container">
					    </div>
					</div>

				</div> <!-- end featured -->
		<div class="container"><!-- Reopening Container -->
		    <div class="row main-body">
			    <div class="welcome twelve columns text-center">
				    <?php the_field('welcome_text');  ?>
			    </div>

			    <div class="callouts twelve columns">
					<div class="row">

				    	<?php if(get_field('service_callouts')): ?>


							<?php while(has_sub_field('service_callouts')): ?>

								<div class="four columns">
									<?php
										if(get_sub_field('geo_location_bucket')):
											$callout_cities = array();
											$callout_regions = array();
											$callout_countries = array();
											//load geo specific content if set
											if( get_sub_field('geo_content') ):
												while( has_sub_field('geo_content') ):
										?>
												<div class="callout hide <?php the_sub_field('city'); the_sub_field('region'); the_sub_field('country'); ?>">
													<?php $image = wp_get_attachment_image_src(get_sub_field('geo_image'), 'medium'); ?>
													<a href="<?php the_sub_field('geo_link'); ?>" >
														<img class="slider-img" src="<?php echo $image[0]; ?>" alt="ICF Life Coach Certification" width="300" height="200" />
													</a>
													<h3><?php echo the_sub_field('geo_title'); ?></h3>
													<?php echo the_sub_field('geo_content'); ?>
													<a href="<?php the_sub_field('geo_link'); ?>" class="button <?php if(get_sub_field('special')){echo "secondary"; }?>"><?php echo the_sub_field('geo_link_text'); ?></a>

												</div>
										<?php
												if(get_sub_field('city')){
													$callout_cities[] = get_sub_field('city');
												}
												if(get_sub_field('region')){
													$callout_regions[] = get_sub_field('region');
												}
												if(get_sub_field('country')){
													$callout_countries[] = get_sub_field('country');
												}
												endwhile;

										?>
										<script>

	(function($) {
	  $(function() {
		<?php
			$js_cities = json_encode($callout_cities);
			$js_regions = json_encode($callout_regions);
			$js_countries = json_encode($callout_countries);

			echo "var callout_cities = ".$js_cities."; ";
			echo "var callout_regions = ". $js_regions . ";";
			echo "var callout_countries = ".$js_countries.";";
		?>
			var callout_check = false;
			var default_link = jQuery('#default-callout');
 			var term_city = mmjsCity.replace(/\s+/g, '-').toLowerCase();
			var region = mmjsRegion;

			if(jQuery.inArray(term_city, callout_cities) != -1){
				console.log('yep - city');

				default_link.hide();
				jQuery('.callout.'+term_city).css('display', 'block');
				callout_check = true;
			}
			if(callout_check == false && jQuery.inArray(mmjsRegion, callout_regions) != -1){
				default_link.hide();
				console.log('yep - region');
				jQuery('.callout.'+mmjsRegion).css('display', 'block');
				callout_check = true;
			}
			if(callout_check == false && jQuery.inArray(mmjsCountryCode, callout_countries) != -1){
				default_link.hide();
				console.log('yep - country');
				jQuery('.callout.'+mmjsCountryCode).css('display', 'block');
				callout_check = true;
			}
			console.log('callouts checked');


			});
	  });
	})(jQuery);
</script>
										<?php
											endif;
										?>

									<div class="callout" id="default-callout">
										<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'medium'); ?>
										<a href="<?php the_sub_field('link'); ?>">
											<img class="slider-img" src="<?php echo $image[0]; ?>" alt="ICF Life Coach Certification" width="300" height="200" />
										</a>
										<h3><?php echo the_sub_field('title'); ?></h3>
										<?php echo the_sub_field('content'); ?>
										<a href="<?php the_sub_field('link'); ?>" class="button <?php if(get_sub_field('special')){echo "secondary"; }?>"><?php echo the_sub_field('link_text'); ?></a>
									</div>

									<?php

										// if there is no geo content load the content normally.
										else:

									?>

										<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'medium'); ?>
										<a href="<?php the_sub_field('link'); ?>">
											<img class="slider-img" src="<?php echo $image[0]; ?>" alt="ICF Life Coach Certification" width="300" height="200" />
										</a>
										<h3><?php echo the_sub_field('title'); ?></h3>
										<?php echo the_sub_field('content'); ?>
										<a href="<?php the_sub_field('link'); ?>" class="button <?php if(get_sub_field('special')){echo "secondary"; }?>"><?php echo the_sub_field('link_text'); ?></a>

									<?php
										//end of service callout if statement
										endif;
									?>



								</div>

							<?php endwhile;	?>
						<?php endif; ?>
					</div>
			    </div>

			    <?php if(get_field('show_blog_post_slider')) : ?>
			    <div class="twelve columns recent-blog">
			    	<!--<div class="flexslider">
					    <ul class="slides">
							<?php
								$temp = $wp_query;
								$wp_query= null;
								$wp_query = new WP_Query();
								$wp_query->query('posts_per_page=5'.'&paged='.$paged);
								while ($wp_query->have_posts()) : $wp_query->the_post();
							?>


							<li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

								<header class="row">
									<div class="eight columns">
										<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
										<p class="meta">
											<?php _e("written by", "bonestheme"); ?> <?php the_author_posts_link(); ?>
											<time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time>
											<?php comments_number('0 comments','1 comment','% comments'); ?>
											<?php $comment_count = get_comment_count($post->ID); ?>
											<?php if ($comment_count['approved'] > 0) { _e("latest ", "bonestheme"); echo time_ago();	} ?>
										</p>
									</div>
									<div class="four columns">
										<p>&nbsp;</p>
									</div>
								</header>

								<section class="post_content clearfix row">
									<div class="five columns">
										<?php the_excerpt(); ?>
										<p><a class="button secondary" href="<?php the_permalink(); ?>">read more</a></p>
									</div>
									<div class="six columns">
										<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'recent-blog-image' ); ?></a>
									</div>
								</section>
							</li>
							<?php endwhile; ?>
							<?php $wp_query = null; $wp_query = $temp;?>
							<?php wp_reset_query(); ?>
					    </ul> <!-- slides close --*>
			    	</div>--> <!-- flexslider close -->
			    </div>
			    <?php endif; ?>

			    <div class="row">
					<div class="eight columns">
					<?php
						if (get_field('feed')) {
							include( get_template_directory() . '/library/rss-aggregator.php');
						}
					?>
					</div>
					<div class="four columns twitter-feed-management">
					<h2 id="rss-heading"><?php if(get_field('twitter_page_title')){ the_field('twitter_page_title'); }?></h2>
						<?php the_field('twitter_tag'); ?>


						<div class="tweet2">

						</div>
					</div>

				</div>

				<?php //get_sidebar(); // sidebar 1 ?>


<?php get_footer(); ?>
