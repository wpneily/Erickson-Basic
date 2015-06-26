<?php get_header(); ?>

				<div id="main" class="eight columns clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						<header>
							<?php the_post_thumbnail( 'wpbs-featured' ); ?>

							<?php if(get_field('multi_font_title')) { ?>
								<h1 class="page-title" itemprop="headline"><?php the_field('multi_font_title'); ?></h1>
							<?php } else { ?>
								<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
							<?php } ?>

							<!-- <p class="meta"><?php _e("Posted", "bonestheme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "bonestheme"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "bonestheme"); ?> <?php the_category(', '); ?>.</p> -->

							<p class="meta">
								<?php _e("written by", "bonestheme"); ?> <?php the_author_posts_link(); ?>
								<time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time>
								<?php comments_number('0 comments','1 comment','% comments'); ?>
								<?php $comment_count = get_comment_count($post->ID); ?>
								<?php if ($comment_count['approved'] > 0) { _e("latest ", "bonestheme"); echo time_ago();	} ?>
							</p>
						</header> <!-- end article header -->

						<section class="post_content clearfix" itemprop="articleBody">
							<?php the_content(); ?>
							<div class="clear"></div>
						</section> <!-- end article section -->

						<footer>
							<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ' ', '</p>'); ?>

							<?php $permalink = get_permalink() ?>
							<div id="fb-root"></div>
							<div class="social-share">
								<div class="fb-share-button" data-href="<?php echo esc_url( $permalink ) ?>" data-type="button"></div>
								<a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>
								<script type="IN/Share"></script>
								<div class="g-plus" data-action="share" data-annotation="none"></div>
							</div>
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

				</div> <!-- end #main -->

				<?php get_sidebar('sidebar3'); // sidebar 1 ?>

<?php get_footer(); ?>
