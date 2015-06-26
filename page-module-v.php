<?php 
/* 
* Template Name: Module V 
*/ 
get_header(); ?>
						
				<div id="main" class="twelve columns clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">

							<?php the_post_thumbnail('page-feature'); ?>

							<?php if(get_field('header_content')){ ?>
									<div class="featured-text">
										<?php the_field('header_content'); ?>
									</div>	
							<?php } ?>

							<div class="the-content">

								<?php the_content(); ?>

								<?php $posts = get_field('included_modules');

								if($posts): ?>

									<h2>Upcoming Programs</h2>

									<?php foreach( $posts as $post):
										setup_postdata($post); ?>

										<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

											<h3><?php the_title(); ?></h3>

											<?php if(get_field('modules')): ?>

												<?php while(has_sub_field('modules')): ?>

													<p><?php the_sub_field('module'); ?>: <?php the_sub_field('date'); ?></p>

													<?php if(get_sub_field('time_widget')):?>

														<a href="#" class="time-reveal button secondary">See the event in your timezone</a>

													<?php endif; ?>
																											
													<?php if(get_sub_field('time_widget')):?>																															
														<div class="time-widget">
															<?php the_sub_field('time_widget');?>
														</div>

													<?php endif; ?>

												<?php endwhile; ?>

											<?php endif; ?>

										</article>

									<?php endforeach; wp_reset_postdata(); endif; ?>

								<div style="clear:both;"></div>
								
							</div>

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

	<script>
	jQuery(document).ready(function($){
		        $('a.time-reveal').click(function(e){
			        e.preventDefault();
			        $(this).siblings('.time-widget').slideToggle();
		        });
		    });
		        </script>        

<?php get_footer(); ?>
