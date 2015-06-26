<?php 
/* 
* Template Name: Continuing Education 
*/ 
get_header(); ?>
						
				<div id="main" class="twelve columns clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							<h1 class="page-title" itemprop="headline"><?php echo get_the_title(); ?></h1>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">

							<?php the_post_thumbnail('page-feature'); ?>
							<?php 
								if(get_field('header_content')){ ?>
									
									<div class="featured-text">
										<?php the_field('header_content'); ?>
									</div>	
							<?php } ?>


							<?php if(get_field('programs')): ?>
			
					 
								<?php while(the_repeater_field('programs')): ?>
					 
									<article class="program">
										<h3><?php the_sub_field('title'); ?></h3>
										
										<p><?php echo the_sub_field('content'); ?></p>
										
										<a href="<?php the_sub_field('link'); ?>" class="button">read more</a>
										
										<?php if(get_sub_field('video')) { ?>
										<a href="<?php the_sub_field('video'); ?>" class="button secondary" rel="shadowbox">watch video</a>
										<?php } ?>
									</article>
					 
								<?php endwhile;	?>
					 				 
							<?php endif; ?>
					
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
