<!doctype html>

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title('', true, 'right'); ?></title>
		<meta name='viewport' content='width=device-width', 'initial-scale=1.0'>
		<!-- icons & favicons -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!-- For everything else -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/ie.css">
		<![endif]-->
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

		<!--  TYPEKIT  -->
		<script type="text/javascript" src="//use.typekit.net/svq6hru.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		<!--  /TYPEKIT -->

	</head>

	<body <?php body_class(); ?>>

		<div class="container">
			<div class="header top">
				<div class="row">
					<div class="three columns logo">
						<header role="banner" id="top-header">

							<div class="siteinfo">
								<h1>
									<a class="brand" id="logo" href="<?php echo get_bloginfo('url'); ?>">
										<?php if(get_field('site_logo', 'options')){ ?>
										<img src="<?php the_field('site_logo', 'options'); ?>" alt="<?php bloginfo('name'); ?>: ICF Accredited Life Coach Training &amp; Certification" width="130" height="132" />

										<?php }else{ ?>
										<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/logo.png" alt="<?php bloginfo('name'); ?>: ICF Accredited Life Coach Training &amp; Certification" width="130" height="132" />
										<?php } ?>
									</a>
								</h1>
							</div>

						</header> <!-- end header -->
					</div>

					<div class="nine columns">
						<div class="row">
							<div class="five columns phone">
								<h3><span class="script-font"><?php the_field('phone_intro', 'options'); ?></span> <?php the_field('phone', 'options'); ?></h3>
							</div>
							<div class="seven columns top-menu">

								<?php
							    wp_nav_menu(
							    	array(
							    		'menu_class' => 'menu',
							    		'theme_location' => 'top_links', /* where in the theme it's assigned */
		    							'items_wrap' => '<ul id="top-nav" class="nav hide-on-phones">%3$s</ul>',

							    		//'walker' => new description_walker()
							    	)
							    );
						    ?>

							</div>
						</div>
					</div>
					<?php /* // soft deleted search box ?>
					<div class="nine columns search-box">
						<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
							<div>
								<input type="text" size="18" value="search" name="s" id="s" />
								<input type="submit" id="searchsubmit" value="find" class="" />
							</div>
						</form>
					</div>
					<?php */ ?>
					<div id="skip-to-menu"><a href="#responsive-footer" class="button">SKIP TO MENU</a></div>
					<div class="nine columns">
						<nav class="row main-nav">
							<?php
							    wp_nav_menu(
							    	array(
							    		'menu' => 'main_nav', /* menu name */
							    		'menu_class' => 'menu',
							    		'theme_location' => 'main_nav', /* where in the theme it's assigned */
							    		'fallback_cb' => 'bones_main_nav_fallback', /* menu fallback */
							    		'depth' => '0',
		    							'items_wrap' => '<ul id="main-nav" class="nav dropmenu hide-on-phones">%3$s</ul>',

							    		//'walker' => new description_walker()
							    	)
							    );
						    ?>
					    </nav>
					</div>
				</div>
			</div>
			<div class="row clearfix" id="content">
