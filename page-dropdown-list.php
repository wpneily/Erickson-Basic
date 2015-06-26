<?php 
/* 
* Template Name: Dropdown List 
*/ 
get_header(); ?>
						
				<div id="main" class="twelve columns clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
						
							

						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
							<div class="content-header">
								<?php the_post_thumbnail('page-feature'); ?>
								<?php 
									if(get_field('header_content')){ ?>
										
										<div class="featured-text">
											<?php the_field('header_content'); ?>
										
											<?php if(get_field('dropdown_content')): ?>
												<select class="selector">
													<option>Choose a selection</option>
												<?php $count = 1; ?>
												<?php while(the_repeater_field('dropdown_content')): ?>
												
													<option value="#section<?php echo $count; ?>"><?php the_sub_field('title');?></option>
													<?php $count++; ?>
												<?php endwhile; ?>
												</select>
											<?php endif; ?>
										
										</div>	
										
										
								<?php } ?>
							</div>
							<div class="the-content">
								<?php  the_content(); ?>

								<?php if(get_field('dropdown_content')): ?>
									
									<?php $linkcount = 1; ?>
									<?php while(the_repeater_field('dropdown_content')): ?>
									
										<article id="section<?php echo $linkcount; ?>" class="dropdown-content">
											<h2><?php the_sub_field('title'); ?></h2>
											<?php the_sub_field('content'); ?>
										
										</article>
										<?php $linkcount++; ?>
									<?php endwhile; ?>
									</select>
								
								<?php endif; ?>
								
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
        
        <script>
	        jQuery(function($){
		        $('.selector').change(function(){
			        var fontid = $(this).attr('value');
			        $.scrollTo( fontid, 1000);
		        });
			});
		</script>
<?php get_footer(); ?>
