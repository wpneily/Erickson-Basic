<?php get_header('simple'); ?>			
					<div id="singleMentors">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
						<!--<div class="close">
							<a onclick="Shadowbox.close()" title="Close"></a>
						</div>-->
						
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							
							<header class="row">
								<div class="twelve columns">
									<h1 class="single-title" itemprop="headline"><?php the_title(); ?>, <?php the_field('mentor_title');?></h1>
								<!--
								<p class="meta"><?php _e("Posted", "bonestheme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "bonestheme"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "bonestheme"); ?> <?php the_category(', '); ?>.</p>-->
								</div>
							</header> <!-- end article header -->
							
							<div class="row">
								<div class="four columns">
									<div id="pic"><?php the_post_thumbnail( 'mentor-picture' ); ?></div>
								</div>
								<div class="eight columns">
									<section class="post_content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
									</section> <!-- end article section -->
								</div>
							</div>
							
							<footer>
				
								<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ' ', '</p>'); ?>
								
							</footer> <!-- end article footer -->
						
						</article> <!-- end article -->
						
						<?php comments_template(); ?>
						
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
					</div><!-- end .singleMentors -->
