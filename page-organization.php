<?php 
/* 
* Template Name: Organization 
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
							<?php 
								if(get_field('header_content')){ ?>
									
									<div class="featured-text">
										<?php the_field('header_content'); ?>
									</div>	
							<?php } ?>
							<div class="the-content">
								<?php the_content(); ?>
								
								<?php 
								$mentors = get_field('mentors');

								if( $mentors ): 
								?>
									
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
										                    <h4><a rel="shadowbox;width=970" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>				                  														<?php the_field('mentor_title'); ?>
										                </div> 	 
													
													</div><!-- /.mentorInner -->	
																								
												</div><!-- /mentorPost -->
												
									    </article>
									</div>
								
								<?php endforeach; ?>
								
								<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
							
								<?php endif; ?>


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
        

<?php get_footer(); ?>
