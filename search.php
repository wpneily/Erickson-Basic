<?php get_header(); ?>
						
				<div id="main" class="eight columns clearfix" role="main">
				
					<h1 class=""><span>Search Results for:</span> <?php echo esc_attr(get_search_query()); ?></h1>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header>
						
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'blog-featured' ); ?></a>
							
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							
							<!-- <p class="meta"><?php _e("written by", "bonestheme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "bonestheme"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "bonestheme"); ?> <?php the_category(', '); ?>.</p> -->
							
							<p class="meta">
								<?php _e("written by", "bonestheme"); ?> <?php the_author_posts_link(); ?> 
								<time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> 
								<?php comments_number('0 comments','1 comment','% comments'); ?> 
								<?php $comment_count = get_comment_count($post->ID); ?>
								<?php if ($comment_count['approved'] > 0) { _e("latest ", "bonestheme"); echo time_ago();	} ?>
							</p>
													
						</header> <!-- end article header -->
					
						<section class="post_content clearfix">
							<!-- <?php the_content('Read more &raquo;'); ?> -->
							<!-- <?php echo excerpt(20); ?> -->
							<?php the_excerpt(); ?>
							
							<hr />
							
							<a class="button secondary" href="<?php the_permalink(); ?>">read more</a>
					
						</section> <!-- end article section -->
						
						<footer>
			
							<!-- <p class="tags"><?php the_tags('<span class="tags-title">Tags:</span> ', ' ', ''); ?></p> -->
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>
						
					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
							</ul>
						</nav>
					<?php } ?>			
					
					<?php else : ?>
					
					<!-- this area shows up if there are no results -->
					
					<article id="post-not-found">
					    <header>
					    	<h1>No Results Found</h1>
					    </header>
					    <section class="post_content">
					    	<p>Sorry, but the requested resource was not found on this site.</p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    			
    			<?php get_sidebar('sidebar3'); // sidebar 1 ?>
    
<?php get_footer(); ?>
