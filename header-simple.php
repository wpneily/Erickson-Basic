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

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- icons & favicons -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
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

		<!-- Start of Async HubSpot Analytics Code --> <script type="text/javascript">(function(d,s,i,r){ if (d.getElementById(i)){return;} var n=d.createElement(s),e=d.getElementsByTagName(s)[0]; n.id=i;n.src='//js.hubspot.com/analytics/'+(Math.ceil(new Date()/r)*r)+'/197838.js'; e.parentNode.insertBefore(n, e);})(document,"script","hs-analytics",300000);</script>
<!-- End of Async HubSpot Analytics Code -->

	</head>

	<body class="body-single-mentor">
