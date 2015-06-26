		</div>

<!-- end of #content div -->
			</div> <!-- end #container -->

	<footer role="contentinfo">
<div class="panel">
<div class="row" id="responsive-footer">
						<nav class="row main-nav">
						<?php
								wp_nav_menu(
									array(
										'menu' => 'main_nav', /* menu name */
										'menu_class' => 'menu',
										'theme_location' => 'main_nav', /* where in the theme it's assigned */
										'fallback_cb' => 'bones_main_nav_fallback', /* menu fallback */
										'depth' => '0',
										'items_wrap' => '<ul id="footer-response" class="nav hide-on-phones">%3$s</ul>',

										//'walker' => new description_walker()
									)
								);
							?>
						</nav>
					</div>
<div class="row">
<div class="four columns twitter-list clearfix">
							<h5><?php the_field('twitter_title', 'options'); ?></h5>
							<div class="tweet"></div>
						</div>

<!-- Contact Form-->
						<div class="four columns contact-form">
							<h5>Contact</h5>
							<?php the_field('contact_info', 'options'); ?>

							<?php if(get_field('geo_contact_info','options')) : ?>
								<div class="geo-contact">
									<?php while(has_sub_field('geo_contact_info','options')) : ?>
										<div class="<?php the_sub_field('geo_contact_location'); ?>">

											<?php the_sub_field('geo_contact_content'); ?>

										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
							<!-- Gravity Form Goes Here -->
						 <?php /* gravity_form(1, false, false, false, '', true); */ ?>
							<!--End Gravity forms here -->
						</div>
						<!--End Contact Form -->
<!-- Social List-->
						<div class="four columns social-list">
							<ul class="menu social-media">
								<li>
									<a class="facebook" href="<?php the_field('facebook', 'options'); ?>" target="_blank">
										<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/icon-facebook.png" alt="Life Coach Training on Facebook" width="42" height="42" />
									</a>
								</li>
								<li>
									<a class="twitter" href="<?php the_field('twitter', 'options'); ?>" target="_blank">
										<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/icon-twitter.png" alt="Business Coach Certification Twitter" width="41" height="42"/>
									</a>
								</li>
								<li>
									<a class="google" href="<?php the_field('google+', 'options'); ?>" target="_blank">
										<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/icon-google.png" alt="How to Become a Life Coach on Google+" width="42" height="42"/>
									</a>
								</li>
								<li>
									<a class="linkedin" href="<?php the_field('linkedin', 'options'); ?>" target="_blank">
										<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/icon-linkedin.png" alt="Connect with Professional Coaches on Linkedin" width="42" height="42"/>
									</a>
								</li>
							</ul>
							<?php /* gravity_form(2, false, true, false, '', true); */ ?>

							<a href="<?php the_field('footer_image_link','options'); ?>" target="_blank"><img class="footer-bottom-image" src="<?php the_field('footer_image','options'); ?>" /></a>

							<?php the_field('below_footer_image','options'); ?>

						</div>

						<!--End Social List -->

</div>


</div>
</footer>

<!-- end footer -->


	<script type="text/javascript">

jQuery(document).ready(function() {

  jQuery('.read-more').on('click', function(e) {
    e.preventDefault();
    var that = jQuery(this);
    e.preventDefault();

    jQuery(that).siblings('.more-content').slideToggle();

    if (that.text() == "read more") {
      that.text('read less');
    } else if (that.text() == "read less") {
      that.text('read more')
    }
  });

});

	</script>




		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>
</html>