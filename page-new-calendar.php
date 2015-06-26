<?php 
/* 
* Template Name: Calendar Page
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
										
											<?php 

											if(get_field('location_selection_text')) {
												$choose_selection = get_field('location_selection_text');
											} else {
												$choose_selection = 'Choose a selection';
											}
											
											
											$locations = get_terms('calendar-location'); 
											echo '<select class="selector">';
											echo '<option>'. $choose_selection . '</option>';
											foreach($locations as $location){
												if($location->slug != 'offline'){
													echo '<option value="#'.$location->slug.'">'.$location->name.'</option>';
												}
											}
											echo '</select>';
											if(get_field('dropdown_content')): ?>
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

								<?php
									$date = date('Ymd'); 
 	
									foreach($locations as $location){
										
										if($location->slug != 'offline'){
										
											$meta = array(
													array(
														'key' => 'expiry_date',
														'value' => $date,
														'compare' => '>='
													)
												); 
											
											$location_args = array(
												'post_type' => 'geo-calendar',
												'posts_per_page' => -1,
												'tax_query' => array(
													array(
														'taxonomy' => $location->taxonomy,
														'field' => 'slug',
														'terms' =>  $location->slug,
														'include_children' => false
													)
												), 
												'meta_query' => $meta,
												'orderby' => 'meta_value',
												'order' => "ASC",
												'meta_key' => 'expiry_date'
											);
											
											$location_posts = new WP_Query($location_args);
											if($location_posts->have_posts()):
												
												echo "<h2 id='".$location->slug."'>".$location->name."</h2>";
												echo $location->description;
											
												while($location_posts->have_posts()): $location_posts->the_post(); 
												
												?>
												
												<article class="dropdown-content">
					
													<h3><?php the_title(); ?></h3>
													<?php 
													if(get_field('modules')): ?>
													 
														<?php while(has_sub_field('modules')): ?>
														 <div>
															<p> <?php if(get_sub_field('module')) { ?><span class="modules"><?php the_sub_field('module'); ?>: <?php } ?></span> <span class="date"><?php the_sub_field('date'); ?></span> 

															</p>

																<?php if(get_sub_field('time_widget')):?>
																<a href="#" class="time-reveal button">See the event in your timezone</a>
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
														<?php endwhile; ?>
													 												 
													<?php endif; ?>
												
													<?php 
													
														if(get_field('read_more_link')){
															$link_post = get_field('read_more_link'); 
															//print_r($link); 
															$link = get_permalink($link_post[0]->ID);
															echo '<a href="'.$link.'" class="button">Read More</a>';
	  	
														}
													?>
												</article>
												
												<?php 
												
												endwhile; wp_reset_query(); 
												
											endif;
										}// end of if for offline	
									} // end of foreach
									
								?>

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
		        
		        $('a.time-reveal').click(function(e){
			        e.preventDefault();
			        $(this).siblings('.time-widget').slideToggle();
		        });
			});
		</script>
<?php get_footer(); ?>
