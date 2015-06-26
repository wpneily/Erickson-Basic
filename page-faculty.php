<?php 
/* 
* Template Name: Faculty 
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
								
								<?php $mentorspost = 0 ?>

								<div id="mentorContent" class="row">

									<?php $my_query = new WP_Query('post_type=mentors&orderby=menu_order&order=ASC&posts_per_page=-1'); ?>

									<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>

									<?php $mentorspost = $mentorspost+1 ?>

										<div id="post-<?php the_ID(); ?>" <?php post_class('three columns'); ?>>

											<div class="mentorInner">

								            	<div class="mentorImg">
													<a rel="shadowbox;width=970" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('mentor-picture'); ?></a>
												</div><!-- /.productImg -->	

								                <div class="post-jm">
								                    <h4><a rel="shadowbox;width=970" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
													<?php the_field('mentor_title'); ?>

								                </div> 	 

											</div><!-- /.productInner -->

										</div><!-- /productPost -->

										<?php endwhile; wp_reset_query(); ?>
										
								</div><!-- /.mentorContent -->		    


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
