<?php 
/*
* Template Name: Business
*/ 
get_header(); ?>
						
				<div id="main" class="twelve columns clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
					
							<div class="row top-row">
							
								<div class="eight columns video">
								
									<?php the_field('video'); ?>
								
								</div>
								
								<div class="four columns events">
								
									<h4><?php the_field('event_title'); ?></h4>
									
									<?php if(get_field('event_list')): ?>
	
										<?php $count = 1; ?>	
										<ul>
										
										<?php while(the_repeater_field('event_list')): ?>
							 
											<li>
																		
												<?php echo the_sub_field('event'); ?>
												
												<?php if(get_sub_field('your_time')){
													
													echo '<a href="#" class="time-link" data-reveal-id="time-'.$count.'">See the event in your timezone</a>';
													
												}?>
												
											</li>
							 
										 <?php $count++; ?>
										 
										<?php endwhile;	?>
										
										</ul>
									<?php endif; ?>
									
									<a href="<?php the_field('event_link'); ?>" class="button" ><?php the_field('event_link_text'); ?></a>
								
									<a href="<?php the_field('alternate_button_link'); ?>" class="button green" ><?php the_field('alternate_button_link_text'); ?></a>
									
								</div>
							
							</div>
					
							<div class="callouts">
							
									<?php if(get_field('callouts')): ?>
		
										
										<?php while(the_repeater_field('callouts')): ?>
							 
											<div class="callout">
												
												<div class="callout-image">
													<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'page-feature'); ?>
													<img class="content-img" src="<?php echo $image[0]; ?>" alt="Resource Center for Life and Business Coaches" />					
												</div>
												<div class="callout-content">
													<?php echo the_sub_field('content'); ?>
												</div>
											</div>
							 
										<?php endwhile;	?>
										
										</ul>
									<?php endif; ?>
								
							
							
							<div class="sub-callout">
								
								<?php the_field('sub_callout'); ?>
								
							</div>
							
							<?php if(is_page(18)) { ?> 
								<div class="tabsCallout">

									<div class="tabsCallout-button">
									
										<a href="<?php the_field('event_link'); ?>" class="button green" ><?php the_field('event_link_text'); ?></a>

									</div>
	
									<dl class="tabs">
										<dd class="active tabFirst"><a href="#meet-mentor">Meet Your Mentor</a></dd>
										<dd><a href="#week-by-week">Week By Week Outline</a></dd>
										<dd><a href="#tuition">Tuition</a></dd>
										<dd class="tabLast"><a href="#explore">Explore Entrepreneurship</a></dd>           
									</dl>
									    
									<ul class="tabs-content">
										<li class="active" id="meet-mentorTab">
											  	<?php the_field('meet_your_mentor'); ?>	
										</li>
										<li id="week-by-weekTab">
											<section class="timeline">
												<?php if(get_field('weekly_outline')): ?>
													<?php while(the_repeater_field('weekly_outline')): ?>
														<h2>Week by Week Outline</h2>
															<article>
																<div class="month">
																	<h3><?php echo the_sub_field('month'); ?></h3>
																</div>
																<div class="week">
																	<?php the_sub_field('weekly_outline'); ?>
																</div>
															</article>
													<?php endwhile;	?>
												<?php endif; ?>
											</section>
										</li>
										<li id="tuitionTab">
											<?php $recent = new WP_Query("page_id=4358"); while($recent->have_posts()) : $recent->the_post();?>
											<h2><?php the_title(); ?></h2>
											<?php the_content(); ?>
											<?php endwhile; wp_reset_query(); ?>
										</li>
										<li id="exploreTab">
											<?php the_field('explore_entrepreneurship'); ?>
										</li>
									</ul>
								
								</div>
							<?php } ?>
							
						</section> <!-- end article section -->
						
					
					</article> <!-- end article -->

					
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



<?php get_footer(); ?>
