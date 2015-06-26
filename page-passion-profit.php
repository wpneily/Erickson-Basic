<?php 
/*
* Template Name: Passion for Profit
*/ 
get_header(); ?>
						
				<div id="main" class="twelve columns clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							<?php if(get_field('multi_font_title')) { ?>
								<h1 class="page-title" itemprop="headline"><?php the_field('multi_font_title'); ?></h1>
							<?php } else { ?>
								<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
							<?php } ?>
											
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
					
							<div class="row top-row">
							
								<div class="eight columns video">
								
									<?php the_field('video'); ?>
								
								</div>
								
								<div class="four columns events">
								
									<div class="special-header-wrapper">
										<?php the_field('header_callout'); ?>
									</div>
								
									<h4><?php the_field('event_title'); ?></h4>
									
									<?php if(get_field('event_list')): ?>
	
										<?php $count = 1; ?>	
										<ul>
										
										<?php while(the_repeater_field('event_list')): ?>
							 
											<li>
																		
												<?php echo the_sub_field('event'); ?>
												
												<?php if(get_sub_field('location')){ ?>
													<a href="<?php the_sub_field('location_link') ?>">
														<?php the_sub_field('location'); ?>
													</a>
												<?php } ?>
												
												<?php if(get_sub_field('your_time')){
													
													echo '<a href="#" class="time-link" data-reveal-id="time-'.$count.'">See the event in your timezone</a>';
													
												}?>
												
											</li>
							 
										 <?php $count++; ?>
										 
										<?php endwhile;	?>
										
										</ul>
									<?php endif; ?>
									
									<?php $calendar = get_field('calendar_event_associated'); ?>

									<a href="<?php the_field('event_link'); ?>" class="button" ><?php the_field('event_link_text'); ?></a>
								
									<a href="<?php the_field('alternate_button_link'); ?>" class="button green default" ><?php the_field('alternate_button_link_text'); ?></a>
									
								</div>
							
							</div>
					
							<?php if(get_field('callouts')):?>
				
							<div class="sub-callout">
								
								<?php the_field('sub_callout'); ?>			
																
								<dl class="tabs">
									<?php $the_callouts = get_field('callouts'); 
									$tab_count = 1; 
									$total_tabs = count($the_callouts); ?>

									<?php 
									
									foreach($the_callouts as $callout){ 
									
										// classes for the <dd> element
										$classes = ""; 
										if($tab_count == 1){
											$classes = "active tabFirst"; 
										}elseif($tab_count == 5){
											$classes = "tabLast"; 
										}
										
									?>

										<dd class="<?php echo $classes; ?>">
											<a href="#callout<?php echo $tab_count; ?>"><?php echo $callout['tab_title']; ?></a>
										</dd>
									<?php $tab_count++;  ?>
									
									<?php } //end foreach ?>
     
							   </dl>
							   								
							</div>					



							<div class="tabsCallout">

								   <ul class="tabs-content">
								   
								<?php 
									$tab_count = 1; 
								   
									foreach($the_callouts as $callout): 
								?>
									<li class="<?php if($tab_count == 1){ echo "active"; } ?>" id="callout<?php echo $tab_count; ?>Tab">
								   										   		
							   		<?php 
								   		$modules = $callout['content']; 
										if ( is_array( $modules ) ) foreach($modules as $post):   		
							   		?>
								   		<?php setup_postdata($post); ?>
											<!-- Module Callouts --> 
											
											<!-- Check to see which post type is being loaded and revise the template accordingly -->
											<?php if($post->post_type == "geo-calendar"){ ?>

												<h3 class="margin-h3"><?php the_title(); ?></h3>

													<?php if(get_field('modules')): ?>
													<?php $count = 1; ?>

														<?php while(has_sub_field('modules')): ?>
															
														 <div>
															<p> <?php if(get_sub_field('module')) { ?><span class="modules"><?php the_sub_field('module'); ?>: <?php } ?></span> <span class="date"><?php the_sub_field('date'); ?></span> 

															</p>
															<div class="time-widget-wrapper">
																<?php if(get_sub_field('time_widget')):?>
																<a href="#" class="content-time-reveal button">See the event in your timezone</a>
																<?php endif; ?>
																
																<?php if(get_sub_field('link_text')): ?>
																
																<a href="<?php the_sub_field('link'); ?>" class="button"><?php the_sub_field('link_text');  ?></a>
																
																<?php endif;  ?>
																
																<?php if(get_sub_field('time_widget')):?>																															
																	<div class="time-widget">
																		<?php the_sub_field('time_widget');?>
																	</div>

																<?php endif; ?>
																
															</div>

														 </div>
														 
														 
											
														<?php $count++; ?>
														<?php endwhile; ?>

											
													<?php endif; ?>

											    	<?php the_field('course_information'); ?>

													<?php the_field('venue_information'); ?>
											
													<?php 
													$mentors = get_field('mentors_for_course_info');
		
													if( $mentors ): ?>
														
														<?php foreach( $mentors as $post): ?>
													
												 		<?php setup_postdata($post); ?>
													 	<div id="mentorContent" <?php post_class('three columns'); ?>>
														    <article>
													
														    	<div id="post-<?php the_ID(); ?>">
																		<div class="mentorInner">
															            	<div class="mentorImg">
																				<a rel="shadowbox;width=970" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('mentor-picture'); ?></a>
																			</div><!-- /.productImg -->	
															                <div class="post-jm">
															                    <h4><a rel="shadowbox;width=970" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>				                  														<?php the_field('mentors_for_course_info_title'); ?>
															                </div> 	 
																		</div><!-- /.mentorInner -->												
																	</div><!-- /mentorPost -->
																	
														    </article>
														</div>
														
														<?php endforeach; ?>
														
														<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
												
													<?php endif; //mentors endif ?>
											
													<div style="clear:both;"></div>



										<?php }else{ ?>
											<div class="callouts full-width-callout ">
																									
												<?php if(get_field('callouts')): ?>
													
													<?php while(the_repeater_field('callouts')): ?>
										 
														<div class="callout">
															
															<div class="callout-image">
																<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'coaching-callouts'); ?>
																<img class="content-img" src="<?php echo $image[0]; ?>" alt="Life and Business Coaching Training - Online and On-location" />					
															</div>
															
															<div class="callout-content">
																<?php echo the_sub_field('content'); ?>
															</div>
															
														</div>
										 
													<?php endwhile;	?>
													
												<?php endif; ?>

											</div>
											<h2 class="black"><?php the_title(); ?></h2>
											<?php the_content(); ?>
										<?php } // end of content template change ?>	
									<?php 
										endforeach;
										wp_reset_postdata();  
									?>
									</li>
							   <?php 
								   $tab_count++; 
								   
								   endforeach;  
							   ?>
								   </ul>							    	  							
					
							</div><!-- end tabsCallout -->								
							
							<?php endif; // end if for callouts field ?>
							
						</section> <!-- end article section -->		
					
					</article> <!-- end article --> 
				
				<?php if(!get_field('no_footer')):?>
					
					<?php if(get_field('custom_footer_image')){ ?>
					<?php $custom_footer_img = wp_get_attachment_image_src(get_field('custom_footer_image'), 'new-wpf-home-featured'); ?>
					<footer class="footer-image" style="background-image: url(<?php echo $custom_footer_img[0]; ?>); ">
					<?php }else { ?>
					<footer class="footer-image">
					<?php } ?>

						<div class="featured-text">
							<h4><?php the_field('event_title'); ?></h4
							
							<?php if(get_field('event_list')): ?>

								<?php $count = 1; ?>	
								<ul class="events">
								
								<?php while(the_repeater_field('event_list')): ?>
					 
									<li>
																
										<?php echo the_sub_field('event'); ?>
										
										<?php if(get_sub_field('location')){ ?>
											<a href="<?php the_sub_field('location_link') ?>">
												<?php the_sub_field('location'); ?>
											</a>
										<?php } ?>
										
										<?php if(get_sub_field('your_time')){
											
											echo '<a href="#" class="time-link" data-reveal-id="time-'.$count.'">See the event in your timezone</a>';
											
										}?>
										
									</li>
					 
								 <?php $count++; ?>
								 
								<?php endwhile;	?>
								
								</ul>
							<?php endif; ?>

							<a href="<?php the_field('event_link'); ?>" class="button" ><?php the_field('event_link_text'); ?></a>

							<a href="<?php the_field('alternate_button_link'); ?>" class="button green default" ><?php the_field('alternate_button_link_text'); ?></a>
						
						</div><!-- end of footer content -->
					
					</footer>
					
				<?php endif; ?>
					
					<?php endwhile; ?>		
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1>Not Found</h1>
					    </header>
					    <section class="post_content">
					    	<p>Sorry, but the requested resource was not found on this site.</p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->

				<?php if(get_field('event_list')): ?>
					
					<?php $modal_count = 1; ?>
							
					<?php while(the_repeater_field('event_list')): ?>
		 
						<div id="time-<?php echo $modal_count; ?>" class="reveal-modal large">
							
			  				<a class="close-reveal-modal">&#215;</a>

							<?php echo the_sub_field('your_time'); ?>

						</div>
		 
						 <?php $modal_count++; ?>
		 
					<?php endwhile;	?>
															
				<?php endif; ?>

<script>
	(function($){
	$('.content-time-reveal').click(function(e){
	    $(this).siblings('.time-widget').slideToggle();
	    return false; 
	});
	})(jQuery);
</script>

 
<?php get_footer(); ?>
