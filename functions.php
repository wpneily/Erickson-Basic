<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)
require_once('library/plugins.php');          // plugins & extra functions (optional)

// Shortcodes
require_once('library/shortcodes.php');

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

// Custom Backend Footer
function bones_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://shawnjohnston.ca" target="_blank">Shawn Johnston</a></span>. Built using <a href="http://themble.com/bones" target="_blank">Bones</a>.';
}

// adding it to the admin area
add_filter('admin_footer_text', 'bones_custom_admin_footer');



/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'page-feature', 940, 385, true );
add_image_size ( 'wpf-home-featured', 1320, 385, true );
add_image_size ( 'new-wpf-home-featured', 970, 320, true );
add_image_size( 'bones-thumb-600', 600, 150, false );
add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'coaching-callouts', 456, 442, true );
add_image_size( 'book_image_size', 400, 275, true );
add_image_size( 'mentor-picture', 210, 132, true );
add_image_size( 'blog-featured', 635, 0, true);
add_image_size( 'blog-widget-image', 73, 53, true);
add_image_size( 'amazon-bestseller', 220, 0, true);
add_image_size( 'recent-blog-image', 389, 186, false);

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Main Sidebar',
    	'description' => 'Used on every page BUT the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Homepage Sidebar',
    	'description' => 'Used only on the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'id' => 'sidebar3',
    	'name' => 'Blog Sidebar',
    	'description' => 'Used on blog pages.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    /*
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call
    your new sidebar just use the following code:

    Just change the name to whatever your new
    sidebar's id is, for example:



    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php

    */
} // don't remove this bracket!

/************* ENQUEUE CSS AND JS *****************/

function theme_styles()
{
    // Bring in Open Sans from Google fonts
    wp_register_style( 'open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:300,800');
    wp_register_style( 'app', get_template_directory_uri() . '/stylesheets/app.css', array(), '3.0', 'all' );
    wp_register_style( 'foundation', get_template_directory_uri() . '/stylesheets/foundation.css', array(), '3.0', 'all' );
    wp_register_style( 'ie', get_template_directory_uri() . '/stylesheets/ie.css', array(), '3.0', 'all' );
    wp_register_style( 'dropmenu', get_template_directory_uri() . '/stylesheets/drop-down-style.css', array(), '3.0', 'all' );
    wp_register_style( 'flexslider', get_template_directory_uri() . '/stylesheets/flexslider.css', array(), '3.0', 'all' );
     wp_register_style( 'Erickson-Basic', get_template_directory_uri() . '/stylesheets/css/main-style.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'open-sans' );
    wp_enqueue_style( 'foundation' );
    wp_enqueue_style( 'app' );
    wp_enqueue_style( 'ie' );
    wp_enqueue_style( 'dropmenu' );
    wp_enqueue_style( 'flexslider' );
    wp_enqueue_style( 'Erickson-Basic' );
	if (in_array('page-template-page-management-training-php',get_body_class())) {
		wp_register_style( 'rss-aggregator', get_template_directory_uri() . '/stylesheets/rss-aggregator.css', array(), '1.0', 'all' );
		wp_enqueue_style(  'rss-aggregator' );
		echo "<!-- rss aggregator css -->";
	} else {
		echo "<!-- not loading rss aggregator css -->";
			}
}

add_action('wp_enqueue_scripts', 'theme_styles');

/************* ENQUEUE JS *************************/

/* pull jquery from google's CDN. If it's not available, grab the local copy. Code from wp.tutsplus.com :-) */

function load_external_jQuery() { // load external file
	wp_deregister_script( 'jquery' ); // deregisters the default WordPress jQuery
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' ); // register the external file
}

add_action('wp_enqueue_scripts', 'load_external_jQuery'); // initiate the function

/* load modernizr from foundation */
function modernize_it(){
    wp_register_script( 'modernizr', get_template_directory_uri() . '/javascripts/foundation/modernizr.foundation.js' );
    wp_enqueue_script( 'modernizr' );
}

add_action( 'wp_enqueue_scripts', 'modernize_it' );

function foundation_js(){
    wp_register_script( 'foundation-reveal', get_template_directory_uri() . '/javascripts/foundation/jquery.reveal.js' );
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    /*
wp_register_script( 'foundation-orbit', get_template_directory_uri() . '/javascripts/foundation/jquery.orbit-1.4.0.js' );
    wp_enqueue_script( 'foundation-orbit', 'jQuery', '1.4.0', true );
*/
    wp_register_script( 'foundation-custom-forms', get_template_directory_uri() . '/javascripts/foundation/jquery.customforms.js' );
    wp_enqueue_script( 'foundation-custom-forms', 'jQuery', '1.0', true );
    wp_register_script( 'foundation-placeholder', get_template_directory_uri() . '/javascripts/foundation/jquery.placeholder.min.js' );
    wp_enqueue_script( 'foundation-placeholder', 'jQuery', '2.0.7', true );
    wp_register_script( 'foundation-tooltips', get_template_directory_uri() . '/javascripts/foundation/jquery.tooltips.js' );
    wp_enqueue_script( 'foundation-tooltips', 'jQuery', '2.0.1', true );
    wp_register_script( 'foundation-app', get_template_directory_uri() . '/javascripts/app.js' );
    wp_enqueue_script( 'foundation-app', 'jQuery', '1.0', true );
    wp_register_script( 'foundation-off-canvas', get_template_directory_uri() . '/javascripts/foundation/off-canvas.js' );
    wp_enqueue_script( 'foundation-off-canvas', 'jQuery', '1.0', true );
    wp_register_script( 'flexslider', get_template_directory_uri() . '/javascripts/jquery.flexslider-min.js' );
    wp_enqueue_script( 'flexslider', 'jQuery', '1.1', true );
    wp_register_script( 'dropmenu', get_template_directory_uri() . '/javascripts/jquery.dropmenu.js' );
    wp_enqueue_script( 'dropmenu', 'jQuery', '1.1', true );
// 	wp_register_script( 'tweets', home_url() . '/twitter/jquery.tweet.js' );
/*     wp_enqueue_script( 'tweets', 'jQuery', '1.1', true ); */
	wp_register_script( 'scrollto', get_template_directory_uri() . '/javascripts/jquery.scrollTo.js' );
    wp_enqueue_script( 'scrollto', 'jQuery', '1.1', true );
}

add_action('wp_enqueue_scripts', 'foundation_js');

function wp_foundation_js(){
    wp_register_script( 'wp-foundation-js', get_template_directory_uri() . '/library/js/scripts.js', 'jQuery', '1.0', true);
    wp_enqueue_script( 'wp-foundation-js' );
}

add_action('wp_enqueue_scripts', 'wp_foundation_js');

function load_else_scripts_and_styles() {
	if ( is_single() ) {
		wp_enqueue_script( 'facebook-jssdk', '//connect.facebook.net/en_US/all.js#xfbml=1', null, null, false );
// 		wp_enqueue_script( 'twitter-wjs', '//platform.twitter.com/widgets.js', null, null, false );
		wp_enqueue_script( 'linkedin-share', '//platform.linkedin.com/in.js', null, null, false );
		wp_enqueue_script( 'google-share', '//apis.google.com/js/platform.js', null, null, false );
	}
}
add_action( 'wp_enqueue_scripts', 'load_else_scripts_and_styles' );

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="panel clearfix">
			<div class="comment-author vcard row clearfix">
                <div class="twelve columns">
                    <div class="
                        <?php
                        $authID = get_the_author_meta('ID');

                        if($authID == $comment->user_id)
                            echo "panel callout";
                        else
                            echo "panel";
                        ?>
                    ">
                        <div class="row">
            				<div class="avatar two columns">
            					<?php echo get_avatar($comment,$size='75',$default='<path_to_url>' ); ?>
            				</div>
            				<div class="ten columns">
            					<?php printf(__('<h4 class="span8">%s</h4>'), get_comment_author_link()) ?>
            					<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>

            					<?php edit_comment_link(__('Edit'),'<span class="edit-comment">', '</span>'); ?>

                                <?php if ($comment->comment_approved == '0') : ?>
                   					<div class="alert-box success">
                      					<?php _e('Your comment is awaiting moderation.') ?>
                      				</div>
            					<?php endif; ?>

                                <?php comment_text() ?>

                                <!-- removing reply link on each comment since we're not nesting them -->
            					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

// Add grid classes to comments
function add_class_comments($classes){
    array_push($classes, "twelve", "columns");
    return $classes;
}
add_filter('comment_class', 'add_class_comments');

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search the Site..." />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

/****************** password protected post form *****/

add_filter( 'the_password_form', 'custom_password_form' );

function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<div class="clearfix"><form action="' . get_option('siteurl') . '/wp-pass.php" method="post">
	' . __( "<p>This post is password protected. To view it please enter your password below:</p>" ) . '
	<div class="row collapse">
        <div class="twelve columns"><label for="' . $label . '">' . __( "Password:" ) . ' </label></div>
        <div class="eight columns">
            <input name="post_password" id="' . $label . '" type="password" size="20" class="input-text" />
        </div>
        <div class="four columns">
            <input type="submit" name="Submit" class="postfix button nice blue radius" value="' . esc_attr__( "Submit" ) . '" />
        </div>
	</div>
    </form></div>
	';
	return $o;
}

/*********** update standard wp tag cloud widget so it looks better ************/

// filter tag clould output so that it can be styled by CSS
function add_tag_class( $taglinks ) {
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";
        foreach( $tags as $tag ) {
            $tagn[] = preg_replace($regex, "('$1$2 label radius tag-'.get_tag($2)->slug.'$3')", $tag );
        }
    $taglinks = implode('</a>', $tagn);
    return $taglinks;
}

add_action('wp_tag_cloud', 'add_tag_class');

add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );

function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}

add_filter('wp_tag_cloud','wp_tag_cloud_filter', 10, 2);

function wp_tag_cloud_filter($return, $args)
{
  return '<div id="tag-cloud"><p>'.$return.'</p></div>';
}

function add_class_the_tags($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a class="label success radius"',$html);
    return $html;
}
add_filter('the_tags','add_class_the_tags',10,1);

// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Disable jump in 'read more' link
function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

//Replaces "current-menu-item" with "active"
function current_to_active($text){
        $replace = array(
                //List of menu item classes that should be changed to "active"
                'current_page_item' => 'active',
                'current_page_parent' => 'active',
                'current_page_ancestor' => 'active',
        );
        $text = str_replace(array_keys($replace), $replace, $text);
                return $text;
        }
add_filter ('wp_nav_menu','current_to_active');

//more buttons to tinymce
function enable_more_buttons($buttons) {
  $buttons[] = 'table';

  /*
  Repeat with any other buttons you want to add, e.g.
	  $buttons[] = 'fontselect';
	  $buttons[] = 'sup';
  */

  return $buttons;
}
add_filter("mce_buttons", "enable_more_buttons");

function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'…';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}

/*
function new_excerpt_more($more) {
       global $post;
	return ' <a href="'. get_permalink($post->ID) . '">[Read more...]</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
*/

/*Time Ago Function */
function time_ago( $type = 'post' ) {
	$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';

	return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');

}


//BUTTON SHORTCODE

function button1( $atts, $content = 'Click Here' ) {
    extract(shortcode_atts(array(
        "url" => 'http://www.google.com'
    ), $atts));
    return '<a href="'. $url . '" class="button">'.$content.'</a>';
}
add_shortcode("button1", "button1");

function button2( $atts, $content = 'Click Here' ) {
    extract(shortcode_atts(array(
        "url" => 'http://www.google.com'
    ), $atts));
    return '<a href="'. $url . '" class="button secondary">'.$content.'</a>';
}
add_shortcode("button2", "button2");

function button3( $atts, $content = 'Click Here' ) {
    extract(shortcode_atts(array(
        "url" => 'http://www.google.com'
    ), $atts));
    return '<a href="'. $url . '" class="button green">'.$content.'</a>';
}
add_shortcode("button3", "button3");



//ADD BUTTON SHORTCODE TO TINYMCE EDITOR

add_action('init', 'add_button');

function add_button() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') && get_user_option('rich_editing'))
   {
     add_filter('mce_external_plugins', 'add_plugin');
     add_filter('mce_buttons', 'register_button');
   }
}

function register_button($buttons) {
   array_push($buttons, "button1");
   array_push($buttons, "button2");
   array_push($buttons, "button3");
   return $buttons;
}

function add_plugin($plugin_array) {
   $plugin_array['button1'] = get_bloginfo('template_url').'/javascripts/customcodes.js';
   $plugin_array['button2'] = get_bloginfo('template_url').'/javascripts/customcodes.js';
   $plugin_array['button3'] = get_bloginfo('template_url').'/javascripts/customcodes.js';
   return $plugin_array;
}

// Increase the redirect limit to 250

add_filter( 'srm_max_redirects', 'dbx_srm_max_redirects' );


register_post_type('modules', array(	'label' => 'Modules','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'page','hierarchical' => false,'rewrite' => array('slug' => '', 'with_front' => false),'query_var' => false,'exclude_from_search' => false,'menu_position' => 5,'supports' => array('title','editor','excerpt','revisions','thumbnail','page-attributes',),'labels' => array (
  'name' => 'Modules',
  'singular_name' => 'Module',
  'menu_name' => 'Modules',
  'add_new' => 'Add Module',
  'add_new_item' => 'Add New Module',
  'edit' => 'Edit',
  'edit_item' => 'Edit Module',
  'new_item' => 'New Module',
  'view' => 'View Module',
  'view_item' => 'View Module',
  'search_items' => 'Search Modules',
  'not_found' => 'No Modules Found',
  'not_found_in_trash' => 'No Modules Found in Trash',
  'parent' => 'Parent Module',
),) );

register_post_type('mentors', array(	'label' => 'Mentors','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => '', 'with_front' => false),'query_var' => true,'exclude_from_search' => false,'menu_position' => 5,'supports' => array('title','editor','thumbnail','page-attributes',),'labels' => array (
  'name' => 'Mentors',
  'singular_name' => 'Mentor',
  'menu_name' => 'Mentors',
  'add_new' => 'Add Mentor',
  'add_new_item' => 'Add New Mentor',
  'edit' => 'Edit',
  'edit_item' => 'Edit Mentor',
  'new_item' => 'New Mentor',
  'view' => 'View Mentor',
  'view_item' => 'View Mentor',
  'search_items' => 'Search Mentors',
  'not_found' => 'No Mentors Found',
  'not_found_in_trash' => 'No Mentors Found in Trash',
  'parent' => 'Parent Mentor',
),) );

register_post_type('geo-calendar', array(	'label' => 'Calendar','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => '', 'with_front' => false),'query_var' => true,'exclude_from_search' => false,'menu_position' => 5,'supports' => array('title','editor','thumbnail','page-attributes',),'labels' => array (
  'name' => 'Calendar',
  'singular_name' => 'Calendar Event',
  'menu_name' => 'Calendar',
  'add_new' => 'Add Calendar Event',
  'add_new_item' => 'Add New Calendar Event',
  'edit' => 'Edit',
  'edit_item' => 'Edit Calendar Event',
  'new_item' => 'New Calendar Event',
  'view' => 'View Calendar Event',
  'view_item' => 'View Calendar Event',
  'search_items' => 'Search Calendar',
  'not_found' => 'No Calendar Found',
  'not_found_in_trash' => 'No Calendar Found in Trash',
  'parent' => 'Parent Calendar Event',
),) );

register_taxonomy('calendar-location',array (
  0 => 'geo-calendar',
),array( 'hierarchical' => true, 'label' => 'Locations','show_ui' => true,'query_var' => true,'rewrite' => array('slug' => ''),'singular_label' => 'Location') );

register_taxonomy('calendar-region',array (
  0 => 'geo-calendar',
),array( 'hierarchical' => true, 'label' => 'Regions','show_ui' => true,'query_var' => true,'rewrite' => array('slug' => ''),'singular_label' => 'Region') );

// This code is used to show the template when viewing the site front end
/*
add_action('wp_head', 'show_template');
function show_template() {
	global $template;
	print_r($template);
}
*/
// End show template

/* Logos */
	function my_custom_login_logo() {
    echo '<style type="text/css">
		h1 a {
			background-image:url('.get_stylesheet_directory_uri().'/images/logo.png) !important;
			width: 130px !important;
			height: 132px !important;
			background-size: auto !important;
		}
    </style>
    <script type="text/javascript">window.onload = function(){document.getElementById("login").getElementsByTagName("a")[0].href = "'. site_url() . '";document.getElementById("login").getElementsByTagName("a")[0].title = "Go to site";}</script>';
	}

	add_action('login_head', 'my_custom_login_logo');


	// function change_wp_login_url()
	// {
	// 	echo bloginfo('url');
	// }add_filter('login_headerurl', 'change_wp_login_url');

	// function change_wp_login_title()
	// {
	// 	echo get_option('blogname');
	// }add_filter('login_headertitle', 'change_wp_login_title');

	function custom_admin_logo() {
		echo '<style type="text/css">#header-logo { background-image: url('.get_bloginfo('template_directory').'/images/logo-admin.png) !important; background-size:auto;}</style>';
	}

	function forge_youtube_id($link){

		$video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
		if (empty($video_id[1]))
		    $video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..
		if(empty($video_id[1]))
			$video_id = explode("&v=", $link); // for videos where v isnt the first parameter like http://www.youtube.com/watch?feature=player_embedded&v=XAzrl5KtVZk
		$video_id = explode("&", $video_id[1]); // Deleting any other params
		$video_id = $video_id[0];
		return $video_id;
	}


	//This code is the advanced custom fields

	include_once('acf/acf.php' );
	include_once('acf/acf-repeater/acf-repeater.php' );
	include_once('acf/acf-options-page/acf-options-page.php');
	if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_art-science-of-coaching',
		'title' => 'Art & Science of Coaching',
		'fields' => array (
			array (
				'key' => 'field_5075d948d0d45',
				'label' => 'The Art And Science of Coaching',
				'name' => 'the_art_and_science_of_coaching',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'default',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_blog-page',
		'title' => 'Blog Page',
		'fields' => array (
			array (
				'key' => 'field_50a5255f96aaf',
				'label' => 'Heading',
				'name' => 'heading',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_50a5255f97665',
				'label' => 'Sub Heading',
				'name' => 'sub_heading',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_50ad60f92745a',
				'label' => 'Heading Image',
				'name' => 'heading_image',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_50a588274bde6',
				'label' => 'Upcoming Programs',
				'name' => 'upcoming_programs',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_50a588274c1cb',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_50a588274c5b4',
						'label' => 'Text',
						'name' => 'text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_50a588274c99c',
						'label' => 'Date',
						'name' => 'date',
						'type' => 'date_picker',
						'column_width' => '',
						'date_format' => 'yymmdd',
						'display_format' => 'dd/mm/yy',
						'first_day' => 1,
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_50a588443226b',
				'label' => 'Erickson TV',
				'name' => 'erickson_tv',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_51785e124da2b',
						'label' => 'Youtube',
						'name' => 'youtube',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
						'the_content' => 'yes',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_50a689b1d6169',
				'label' => 'Amazon Bestseller Image',
				'name' => 'amazon_bestseller_image',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_50a689b1d6d1e',
				'label' => 'Amazon Bestseller Price',
				'name' => 'amazon_bestseller_price',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_50a689b1d752d',
				'label' => 'Amazon Bestseller Link',
				'name' => 'amazon_bestseller_link',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_50a689b1d988f',
				'label' => 'Amazon Bestseller Link Text',
				'name' => 'amazon_bestseller_link_text',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '3103',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_business-center',
		'title' => 'Business Center',
		'fields' => array (
			array (
				'key' => 'field_51a3c20de06a6',
				'label' => 'Slider',
				'name' => 'slider',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_506bba5a26792',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_506bba5a26b7b',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_506bba5a26f63',
						'label' => 'On-Location Link',
						'name' => 'on-location_link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'all',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_506bba5a2734a',
						'label' => 'On-Location Link Text',
						'name' => 'on-location_link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_506bba5a282d6',
						'label' => 'Online Link',
						'name' => 'online_link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'all',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_506bba5a286bc',
						'label' => 'Online Link Text',
						'name' => 'online_link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_513f6e9dc5ba1',
						'label' => 'Location Buttons',
						'name' => 'location_buttons',
						'type' => 'repeater',
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_513f6e9dc5f89',
								'label' => 'Region Location Link',
								'name' => 'region_location_link',
								'type' => 'page_link',
								'column_width' => '',
								'post_type' => array (
									0 => 'page',
								),
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_513f6e9dc6371',
								'label' => 'Region Location Link Text',
								'name' => 'region_location_link_text',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'html',
								'maxlength' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
							),
							array (
								'key' => 'field_513f6e9dc6758',
								'label' => 'City',
								'name' => 'region_location',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'html',
								'maxlength' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
							),
							array (
								'key' => 'field_514c848c999e7',
								'label' => 'Region',
								'name' => 'region',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'html',
								'maxlength' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
							),
						),
						'row_min' => 0,
						'row_limit' => '',
						'layout' => 'table',
						'button_label' => 'Add Row',
					),
					array (
						'key' => 'field_50ae9203ae681',
						'label' => 'Video Content',
						'name' => 'video_content',
						'type' => 'wysiwyg',
						'instructions' => 'If filled in, this will replace the content and links fields',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_51a3c20deae5c',
				'label' => 'Welcome Text',
				'name' => 'welcome_text',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_51a3c20de4141',
				'label' => 'Service Callouts',
				'name' => 'service_callouts',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_506bba5a29a43',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_506bba5a29e2a',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_506bba5a2a212',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_506bba5a2a5f9',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'all',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_506bba5a2a9e1',
						'label' => 'Link Text',
						'name' => 'link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_506bba5a2adc8',
						'label' => 'Special',
						'name' => 'special',
						'type' => 'true_false',
						'instructions' => 'Check this if the link button color should be red',
						'column_width' => '',
						'message' => '',
						'default_value' => 0,
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_51a3c26503ec4',
				'label' => 'User',
				'name' => 'user',
				'type' => 'user',
				'role' => array (
					0 => 'all',
				),
				'field_type' => 'select',
				'allow_null' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-business-center.php',
					'order_no' => '0',
					'group_no' => '0',
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_business-tab-wysiwygs',
		'title' => 'Business Tab Wysiwygs',
		'fields' => array (
			array (
				'key' => 'field_5089b5c2210c1',
				'label' => 'Meet Your Mentor',
				'name' => 'meet_your_mentor',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
			),
			array (
				'key' => 'field_5089b5c2214a2',
				'label' => 'Explore Entrepreneurship',
				'name' => 'explore_entrepreneurship',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-business.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_business-timeline',
		'title' => 'Business Timeline',
		'fields' => array (
			array (
				'key' => 'field_506e74e0cc8d8',
				'label' => 'Weekly Outline',
				'name' => 'weekly_outline',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_506e74e0cccbd',
						'label' => 'Month',
						'name' => 'month',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_506e74e0cd0a7',
						'label' => 'Weekly Outline',
						'name' => 'weekly_outline',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
						'the_content' => 'yes',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-business.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_calendar-event-fields',
		'title' => 'Calendar Event Fields',
		'fields' => array (
			array (
				'key' => 'field_5140c16e9d38e',
				'label' => 'Modules',
				'name' => 'modules',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5140c16e9d777',
						'label' => 'Module',
						'name' => 'module',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_5140c16e9db65',
						'label' => 'Date',
						'name' => 'date',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_5140c16e9df48',
						'label' => 'Times',
						'name' => 'times',
						'type' => 'repeater',
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_5140c16e9e32d',
								'label' => 'PST',
								'name' => 'pst',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'html',
								'maxlength' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
							),
							array (
								'key' => 'field_5140c16e9e714',
								'label' => 'EST',
								'name' => 'est',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'html',
								'maxlength' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
							),
						),
						'row_min' => 0,
						'row_limit' => '',
						'layout' => 'table',
						'button_label' => 'Add Row',
					),
					array (
						'key' => 'field_5143a0d269a34',
						'label' => 'Time Widget',
						'name' => 'time_widget',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'rows' => '',
					),
					array (
						'key' => 'field_5149db7baee0e',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'page',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5149db7baf1f5',
						'label' => 'Link Text',
						'name' => 'link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_5140c16e9eee7',
				'label' => 'Expiry Date',
				'name' => 'expiry_date',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_5140e0f40ce58',
				'label' => 'Read More Link',
				'name' => 'read_more_link',
				'type' => 'relationship',
				'post_type' => array (
					0 => 'page',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'max' => 1,
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_title',
					1 => 'post_type',
				),
				'return_format' => 'object',
			),
			array (
				'key' => 'field_5149f2d34b26b',
				'label' => 'Module Info',
				'name' => 'module_info',
				'type' => 'relationship',
				'post_type' => array (
					0 => 'modules',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'max' => '',
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_title',
					1 => 'post_type',
				),
				'return_format' => 'object',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'geo-calendar',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_coaching-modules',
		'title' => 'Coaching Modules',
		'fields' => array (
			array (
				'key' => 'field_506e5eaf515a6',
				'label' => 'Modules',
				'name' => 'modules',
				'type' => 'relationship',
				'post_type' => array (
					0 => 'modules',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'max' => '',
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_title',
					1 => 'post_type',
				),
				'return_format' => 'object',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '0',
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '0',
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '0',
					'group_no' => 3,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_coachingbusiness-fields',
		'title' => 'Coaching/Business Fields',
		'fields' => array (
			array (
				'key' => 'field_506d29e99d495',
				'label' => 'Video',
				'name' => 'video',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_506d2ab21bcab',
				'label' => 'Event Title',
				'name' => 'event_title',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_506d2ab21c862',
				'label' => 'Event List',
				'name' => 'event_list',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_506d2ab21cc48',
						'label' => 'Event',
						'name' => 'event',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'br',
						'maxlength' => '',
						'placeholder' => '',
						'rows' => '',
					),
					array (
						'key' => 'field_514c95140a99b',
						'label' => 'Your Time',
						'name' => 'your_time',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'rows' => '',
					),
					array (
						'key' => 'field_51533cd23698e',
						'label' => 'Location',
						'name' => 'location',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51533cd236d10',
						'label' => 'Location Link',
						'name' => 'location_link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'page',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_506d2ab21d801',
				'label' => 'Event Link',
				'name' => 'event_link',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_506d2ab21e3bb',
				'label' => 'Event Link Text',
				'name' => 'event_link_text',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_506d2ab21ef71',
				'label' => 'Alternate Button Link',
				'name' => 'alternate_button_link',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_506d2ab21fb28',
				'label' => 'Alternate Button Link Text',
				'name' => 'alternate_button_link_text',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_513f7870583c6',
				'label' => 'Geolocation Buttons',
				'name' => 'geolocation_buttons',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_513f78705875e',
						'label' => 'Region Location Link',
						'name' => 'region_location_link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'page',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_513f787058b06',
						'label' => 'Region Location Link Text',
						'name' => 'region_location_link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_513f7870590bf',
						'label' => 'Region Location',
						'name' => 'region_location',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_514c8dbab3d90',
						'label' => 'Region',
						'name' => 'region',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51a5228de2b6c',
						'label' => 'Country',
						'name' => 'country',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_506d2ab22125e',
				'label' => 'Callouts',
				'name' => 'callouts',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_506d2ab221646',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_506d2ab221a2d',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_506e61aa31aef',
				'label' => 'Sub Callout',
				'name' => 'sub_callout',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-business.php',
					'order_no' => '0',
					'group_no' => '0',
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '0',
					'group_no' => '1',
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => '2',
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_contact-info-and-social-media',
		'title' => 'Contact Info and Social Media',
		'fields' => array (
			array (
				'key' => 'field_506bb8f1c1cec',
				'label' => 'Contact Info',
				'name' => 'contact_info',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5193cf31ccddf',
				'label' => 'Geo Contact Info',
				'name' => 'geo_contact_info',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5193cf31cd1c4',
						'label' => 'Geo Contact Location',
						'name' => 'geo_contact_location',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5193cf31cd5ac',
						'label' => 'Geo Contact Content',
						'name' => 'geo_contact_content',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_506bcc37f2814',
				'label' => 'Phone',
				'name' => 'phone',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_506bb8f1c24bb',
				'label' => 'Twitter',
				'name' => 'twitter',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_506bb8f1c2c8b',
				'label' => 'Facebook',
				'name' => 'facebook',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_506bb8f1c345a',
				'label' => 'Google+',
				'name' => 'google+',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5493436d4041b',
				'label' => 'Pinterest',
				'name' => 'pinterest',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54b7e7b01d739',
				'label' => 'Instagram',
				'name' => 'instagram',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_506bb8f1c3c2a',
				'label' => 'LinkedIn',
				'name' => 'linkedin',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_517eff38ccacb',
				'label' => 'Footer Image',
				'name' => 'footer_image',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_517eff38cd683',
				'label' => 'Footer Image Link',
				'name' => 'footer_image_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5193d921c6627',
				'label' => 'Below Footer Image',
				'name' => 'below_footer_image',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_continuing-education',
		'title' => 'Continuing Education',
		'fields' => array (
			array (
				'key' => 'field_506d1f5a0f26a',
				'label' => 'Programs',
				'name' => 'programs',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_506d1f5a0fa3b',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_506d1f5a1028a',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'br',
						'maxlength' => '',
						'placeholder' => '',
						'rows' => '',
					),
					array (
						'key' => 'field_506d1f5a109d9',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'page',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_506d1f5a111a7',
						'label' => 'Video',
						'name' => 'video',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-continuing-education.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_course-information',
		'title' => 'Course Information',
		'fields' => array (
			array (
				'key' => 'field_507489dc138cc',
				'label' => 'Course Information',
				'name' => 'course_information',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
			),
			array (
				'key' => 'field_512be1d795ae7',
				'label' => 'Venue Information',
				'name' => 'venue_information',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'geo-calendar',
					'order_no' => '1',
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '2',
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'geo-calendar',
					'order_no' => '1',
					'group_no' => 3,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 4,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '2',
					'group_no' => 5,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'geo-calendar',
					'order_no' => '1',
					'group_no' => 6,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 7,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '2',
					'group_no' => 8,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'geo-calendar',
					'order_no' => '1',
					'group_no' => 9,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 10,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '2',
					'group_no' => 11,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_custom-rss-aggregator',
		'title' => 'Custom RSS Aggregator',
		'fields' => array (
			array (
				'key' => 'field_51a90c2ce5237',
				'label' => 'Aggregator Heading',
				'name' => 'aggregator_heading',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51a7b80799c8c',
				'label' => 'Feed',
				'name' => 'feed',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_51a7b81b99c8d',
						'label' => 'RSS URL',
						'name' => 'rss_url',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51a7b85099c8f',
						'label' => 'Default Image',
						'name' => 'default_image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_51a7de836b341',
						'label' => 'Always Use Default Image',
						'name' => 'always_use_default_image',
						'type' => 'true_false',
						'column_width' => 10,
						'message' => '',
						'default_value' => 0,
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_51a7b87999c91',
				'label' => 'Max Items Per Feed',
				'name' => 'max_items_per_feed',
				'type' => 'number',
				'default_value' => '',
				'min' => '',
				'max' => '',
				'step' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51a7bbf0b9354',
				'label' => 'Max Items Total',
				'name' => 'max_items_total',
				'type' => 'number',
				'default_value' => '',
				'min' => '',
				'max' => '',
				'step' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51a7dc85126ab',
				'label' => 'Characters per excerpt',
				'name' => 'characters_per_excerpt',
				'type' => 'number',
				'default_value' => '',
				'min' => '',
				'max' => '',
				'step' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51a88a760bef2',
				'label' => 'Default Image',
				'name' => 'default_image',
				'type' => 'image',
				'required' => 1,
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_51ba02da11ab0',
				'label' => 'Open Links In New Tab',
				'name' => 'open_links_in_new_tab',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-management-training.php',
					'order_no' => '0',
					'group_no' => '0',
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_dropdown-lists',
		'title' => 'Dropdown Lists',
		'fields' => array (
			array (
				'key' => 'field_507f2895b1dd4',
				'label' => 'Dropdown Content',
				'name' => 'dropdown_content',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_507f2895b21bc',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_507f2895b25a3',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
						'the_content' => 'yes',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-dropdown-list.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_fun-info',
		'title' => 'Fun Info',
		'fields' => array (
			array (
				'key' => 'field_507737c466099',
				'label' => 'Fun Info',
				'name' => 'fun_info',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-business.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_fun-info-img',
		'title' => 'Fun Info Img',
		'fields' => array (
			array (
				'key' => 'field_5077407b857dd',
				'label' => 'Fun Info Img',
				'name' => 'fun_info_img',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-business.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_geo-target',
		'title' => 'Geo Target',
		'fields' => array (
			array (
				'key' => 'field_5136802680f27',
				'label' => 'Video',
				'name' => 'video',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
			),
			array (
				'key' => 'field_51368b297a7b2',
				'label' => 'Show Random Clickable Image',
				'name' => 'show_random_clickable_image',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_513681ba2df56',
				'label' => 'Random Clickable Image',
				'name' => 'random_clickable_image',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_513681ba2e33d',
						'label' => 'Random Image',
						'name' => 'random_image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_513681ba2e729',
						'label' => 'Random Image Link',
						'name' => 'random_image_link',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_513691125b94e',
				'label' => 'Event Button',
				'name' => 'event_button',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_513691125bd34',
						'label' => 'Location',
						'name' => 'location',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_513691125c120',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_513691125c514',
						'label' => 'Link Text',
						'name' => 'link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_513685da8d623',
				'label' => 'Alternate Button',
				'name' => 'alternate_button',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_513685da8da0a',
						'label' => 'Location',
						'name' => 'location',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_513685da8ddf4',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_513685da8e1d8',
						'label' => 'Link Text',
						'name' => 'link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_5136802685ce0',
				'label' => 'Callouts',
				'name' => 'callouts',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_51368026860b4',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_513680268649d',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
						'the_content' => 'yes',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_5136802686c73',
				'label' => 'Sub Callout',
				'name' => 'sub_callout',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-geotarget.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_geolocation-calendar-selector',
		'title' => 'Geolocation Calendar Selector',
		'fields' => array (
			array (
				'key' => 'field_5149e32f98331',
				'label' => 'Calendar Event Associated',
				'name' => 'calendar_event_associated',
				'type' => 'relationship',
				'post_type' => array (
					0 => 'geo-calendar',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'max' => '',
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_title',
					1 => 'post_type',
				),
				'return_format' => 'object',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '1',
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-geotarget.php',
					'order_no' => '0',
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '1',
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-geotarget.php',
					'order_no' => '0',
					'group_no' => 3,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '1',
					'group_no' => 4,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-geotarget.php',
					'order_no' => '0',
					'group_no' => 5,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '1',
					'group_no' => 6,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-geotarget.php',
					'order_no' => '0',
					'group_no' => 7,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_got-questions',
		'title' => 'Got Questions',
		'fields' => array (
			array (
				'key' => 'field_507848e4a75a2',
				'label' => 'Got Questions',
				'name' => 'got_questions',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-business.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

/* Home page */

	register_field_group(array (
		'id' => 'acf_home-page',
		'title' => 'Home Page',
		'fields' => array (
			array (
				'key' => 'field_506bba5a25fc3',
				'label' => 'Slider',
				'name' => 'slider',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_506bba5a26792',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_506bba5a26b7b',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_506bba5a26f63',
						'label' => 'On-Location Link',
						'name' => 'on-location_link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'all',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_506bba5a2734a',
						'label' => 'On-Location Link Text',
						'name' => 'on-location_link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_506bba5a282d6',
						'label' => 'Online Link',
						'name' => 'online_link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'all',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_506bba5a286bc',
						'label' => 'Online Link Text',
						'name' => 'online_link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_513f6e9dc5ba1',
						'label' => 'Location Buttons',
						'name' => 'location_buttons',
						'type' => 'repeater',
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_513f6e9dc5f89',
								'label' => 'Region Location Link',
								'name' => 'region_location_link',
								'type' => 'page_link',
								'column_width' => '',
								'post_type' => array (
									0 => 'page',
								),
								'allow_null' => 0,
								'multiple' => 0,
							),
							array (
								'key' => 'field_513f6e9dc6371',
								'label' => 'Region Location Link Text',
								'name' => 'region_location_link_text',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_513f6e9dc6758',
								'label' => 'City',
								'name' => 'region_location',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_514c848c999e7',
								'label' => 'Region',
								'name' => 'region',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
						),
						'row_min' => '',
						'row_limit' => '',
						'layout' => 'table',
						'button_label' => 'Add Row',
					),
					array (
						'key' => 'field_50ae9203ae681',
						'label' => 'Video Content',
						'name' => 'video_content',
						'type' => 'wysiwyg',
						'instructions' => 'If filled in, this will replace the content and links fields',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_506bba954b9ba',
				'label' => 'Welcome Text',
				'name' => 'welcome_text',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_506bba5a29662',
				'label' => 'Service Callouts',
				'name' => 'service_callouts',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_506bba5a29a43',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_506bba5a29e2a',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_506bba5a2a212',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_506bba5a2a5f9',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'all',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_506bba5a2a9e1',
						'label' => 'Link Text',
						'name' => 'link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
//					array (
//						'key' => 'field_506bba5a2adc8',
//						'label' => 'Special',
//						'name' => 'special',
//						'type' => 'true_false',
//						'instructions' => 'Check this if the link button color should be red',
//						'column_width' => '',
//						'message' => '',
//						'default_value' => 0,
//					),
//					array (
//						'key' => 'field_51a4c761fe491',
//						'label' => 'Geo Location Bucket',
//						'name' => 'geo_location_bucket',
//						'type' => 'true_false',
//						'instructions' => 'Check this to create geo',
//						'column_width' => '',
//						'message' => '',
//						'default_value' => 0,
//					),
//					array (
//						'key' => 'field_51a4c86efe492',
//						'label' => 'Geo Content',
//						'name' => 'geo_content',
//						'type' => 'repeater',
//						'column_width' => '',
//						'sub_fields' => array (
//							array (
//								'key' => 'field_51a4c88ffe493',
//								'label' => 'Geo Title',
//								'name' => 'geo_title',
//								'type' => 'text',
//								'column_width' => '',
//								'default_value' => '',
//								'placeholder' => '',
//								'prepend' => '',
//								'append' => '',
//								'formatting' => 'html',
//								'maxlength' => '',
//							),
//							array (
//								'key' => 'field_51a4c8ecfe494',
//								'label' => 'Geo Content',
//								'name' => 'geo_content',
//								'type' => 'wysiwyg',
//								'column_width' => '',
//								'default_value' => '',
//								'toolbar' => 'full',
//								'media_upload' => 'yes',
//							),
//							array (
//								'key' => 'field_51a4c907fe495',
//								'label' => 'Geo Image',
//								'name' => 'geo_image',
//								'type' => 'image',
//								'column_width' => '',
//								'save_format' => 'id',
//								'preview_size' => 'thumbnail',
//								'library' => 'all',
//							),
//							array (
//								'key' => 'field_51a4c923fe496',
//								'label' => 'Geo Link',
//								'name' => 'geo_link',
//								'type' => 'page_link',
//								'column_width' => '',
//								'post_type' => array (
//									0 => 'page',
//								),
//								'allow_null' => 0,
//								'multiple' => 0,
//							),
//							array (
//								'key' => 'field_51a4c932fe497',
//								'label' => 'Geo Link Text',
//								'name' => 'geo_link_text',
//								'type' => 'text',
//								'column_width' => '',
//								'default_value' => '',
//								'placeholder' => '',
//								'prepend' => '',
//								'append' => '',
//								'formatting' => 'html',
//								'maxlength' => '',
//							),
//							array (
//								'key' => 'field_51a4c991fe498',
//								'label' => 'Special',
//								'name' => 'special',
//								'type' => 'true_false',
//								'column_width' => '',
//								'message' => '',
//								'default_value' => 0,
//							),
//							array (
//								'key' => 'field_51a4d73c32a50',
//								'label' => 'City',
//								'name' => 'city',
//								'type' => 'text',
//								'column_width' => '',
//								'default_value' => '',
//								'placeholder' => '',
//								'prepend' => '',
//								'append' => '',
//								'formatting' => 'html',
//								'maxlength' => '',
//							),
//							array (
//								'key' => 'field_51a4d77432a51',
//								'label' => 'Region',
//								'name' => 'region',
//								'type' => 'text',
//								'column_width' => '',
//								'default_value' => '',
//								'placeholder' => '',
//								'prepend' => '',
//								'append' => '',
//								'formatting' => 'html',
//								'maxlength' => '',
//							),
//							array (
//								'key' => 'field_51a4d77b32a52',
//								'label' => 'Country',
//								'name' => 'country',
//								'type' => 'text',
//								'column_width' => '',
//								'default_value' => '',
//								'placeholder' => '',
//								'prepend' => '',
//								'append' => '',
//								'formatting' => 'html',
//								'maxlength' => '',
//							),
//						),
//						'row_min' => '',
//						'row_limit' => '',
//						'layout' => 'row',
//						'button_label' => 'Add Row',
//					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Row',
			),
//			array (
//				'key' => 'field_54ae1e93da2dd',
//				'label' => 'Block Callout Main Top Title',
//				'name' => 'block_callout_main_title',
//				'type' => 'text',
//				'default_value' => '',
//				'placeholder' => '',
//				'prepend' => '',
//				'append' => '',
//				'formatting' => 'html',
//				'maxlength' => '',
//			),
//			array (
//				'key' => 'field_534be97649f51',
//				'label' => 'Block Callout Title',
//				'name' => 'block_callout_title',
//				'type' => 'text',
//				'default_value' => '',
//				'placeholder' => '',
//				'prepend' => '',
//				'append' => '',
//				'formatting' => 'html',
//				'maxlength' => '',
//			),
//			array (
//				'key' => 'field_534be98b49f52',
//				'label' => 'Block Callout Content',
//				'name' => 'block_callout_content',
//				'type' => 'wysiwyg',
//				'default_value' => '',
//				'toolbar' => 'full',
//				'media_upload' => 'yes',
//			),
//			array (
//				'key' => 'field_534be99f49f53',
//				'label' => 'Block Callout Image',
//				'name' => 'block_callout_image',
//				'type' => 'image',
//				'save_format' => 'id',
//				'preview_size' => 'thumbnail',
//				'library' => 'all',
//			),
//			array (
//				'key' => 'field_534c2bed2aa69',
//				'label' => 'Block Callout Link Text',
//				'name' => 'block_callout_link_text',
//				'type' => 'text',
//				'default_value' => 'read more',
//				'placeholder' => '',
//				'prepend' => '',
//				'append' => '',
//				'formatting' => 'html',
//				'maxlength' => '',
//			),
//			array (
//				'key' => 'field_534be9be49f54',
//				'label' => 'Block Callout Link',
//				'name' => 'block_callout_link',
//				'type' => 'page_link',
//				'post_type' => array (
//					0 => 'all',
//				),
//				'allow_null' => 0,
//				'multiple' => 0,
//			),

/****** Book Callout *******/
//			Book Callout Here
//array (
//	'key' => 'field_54fe7fb2641e5',
//	'label' => 'Book Callout Background',
//	'name' => 'book_callout_bg',
//	'type' => 'image',
//	'save_format' => 'object',
//	'preview_size' => 'thumbnail',
//	'library' => 'all',
//),
//array (
//	'key' => 'field_506bba5a2b984',
//	'label' => 'Book Callout Title',
//	'name' => 'book_callout_title',
//	'type' => 'text',
//	'default_value' => '',
//	'placeholder' => '',
//	'prepend' => '',
//	'append' => '',
//	'formatting' => 'html',
//	'maxlength' => '',
//),
//array (
//	'key' => 'field_506bba5a2c153',
//	'label' => 'Book Callout Content',
//	'name' => 'book_callout_content',
//	'type' => 'wysiwyg',
//	'default_value' => '',
//	'toolbar' => 'full',
//	'media_upload' => 'yes',
//),
//array (
//	'key' => 'field_506bba5a2c923',
//	'label' => 'Book Callout Image',
//	'name' => 'book_callout_image',
//	'type' => 'image',
//	'save_format' => 'id',
//	'preview_size' => 'thumbnail',
//	'library' => 'all',
//),
//array (
//	'key' => 'field_506bba5a2d0f2',
//	'label' => 'Book Callout Link',
//	'name' => 'book_callout_link',
//	'type' => 'page_link',
//	'post_type' => array (
//		0 => 'all',
//	),
//	'allow_null' => 0,
//	'multiple' => 0,
//),
//array (
//	'key' => 'field_550023ea7ef7c',
//	'label' => 'Book Callout Amazon Text',
//	'name' => 'book_callout_amazon_text',
//	'type' => 'text',
//	'default_value' => '',
//	'placeholder' => '',
//	'prepend' => '',
//	'append' => '',
//	'formatting' => 'html',
//	'maxlength' => '',
//),
//array (
//	'key' => 'field_506bba5a2d8c2',
//	'label' => 'Book Callout Amazon Link',
//	'name' => 'book_callout_amazon_link',
//	'type' => 'text',
//	'default_value' => '',
//	'placeholder' => '',
//	'prepend' => '',
//	'append' => '',
//	'formatting' => 'html',
//	'maxlength' => '',
//),

/****** Slider Widget *******/
//array (
//	'key' => 'field_50c50a3bf0c1d',
//	'label' => 'Show Blog Post Slider',
//	'name' => 'show_blog_post_slider',
//	'type' => 'true_false',
//	'message' => '',
//	'default_value' => 0,
//),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'home-new.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-management-training.php',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_mentor-title',
		'title' => 'Mentor Title',
		'fields' => array (
			array (
				'key' => 'field_5074b4bc1d495',
				'label' => 'Mentor Title',
				'name' => 'mentor_title',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'mentors',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_mentors-for-certificates',
		'title' => 'Mentors for Certificates',
		'fields' => array (
			array (
				'key' => 'field_5078502ac14af',
				'label' => 'Mentors',
				'name' => 'mentors',
				'type' => 'relationship',
				'post_type' => array (
					0 => 'mentors',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => '',
				'return_format' => 'object',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => '0',
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => '1',
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '0',
					'group_no' => '2',
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-organization.php',
					'order_no' => '0',
					'group_no' => '3',
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_mentors-for-course-info',
		'title' => 'Mentors for Course Info',
		'fields' => array (
			array (
				'key' => 'field_507d8722d2121',
				'label' => 'Mentors for Course Info',
				'name' => 'mentors_for_course_info',
				'type' => 'relationship',
				'post_type' => array (
					0 => 'mentors',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'max' => '',
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_title',
					1 => 'post_type',
				),
				'return_format' => 'object',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'geo-calendar',
					'order_no' => '1',
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '2',
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 3,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'geo-calendar',
					'order_no' => '1',
					'group_no' => 4,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '2',
					'group_no' => 5,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 6,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'geo-calendar',
					'order_no' => '1',
					'group_no' => 7,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '2',
					'group_no' => 8,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 9,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'geo-calendar',
					'order_no' => '1',
					'group_no' => 10,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '2',
					'group_no' => 11,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_module-v-template',
		'title' => 'Module V Template',
		'fields' => array (
			array (
				'key' => 'field_5193bd1c4b1ba',
				'label' => 'Included Modules',
				'name' => 'included_modules',
				'type' => 'relationship',
				'post_type' => array (
					0 => 'geo-calendar',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'max' => '',
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_title',
					1 => 'post_type',
				),
				'return_format' => 'object',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-module-v.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_multi-font-title',
		'title' => 'Multi Font Title',
		'fields' => array (
			array (
				'key' => 'field_50899b8e10905',
				'label' => 'Multi Font Title',
				'name' => 'multi_font_title',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => '0',
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '0',
					'group_no' => '1',
				),
			),
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '4243',
					'order_no' => '0',
					'group_no' => '2',
				),
			),
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '6',
					'order_no' => '0',
					'group_no' => '3',
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => '0',
					'group_no' => '4',
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-passion-profit.php',
					'order_no' => '0',
					'group_no' => '5',
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_new-home-page-slider-geo-slider',
		'title' => 'New Home Page Slider - Geo Slider',
		'fields' => array (
			array (
				'key' => 'field_51a61c26c14c5',
				'label' => 'Geo Slider',
				'name' => 'geo_slider',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_51a61c32c14c6',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_51a675d9b4382',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_51a61fafc14c7',
						'label' => 'On-Location Link',
						'name' => 'on-location_link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'page',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_51a61fe5c14c8',
						'label' => 'On-Location Link Text',
						'name' => 'on-location_link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51a62053c14c9',
						'label' => 'Online Link',
						'name' => 'online_link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'page',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_51a6206cc14ca',
						'label' => 'Online Link Text',
						'name' => 'online_link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_520bf0a63a69c',
						'label' => 'Video Url',
						'name' => 'video_url',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_520bf0ae3a69d',
						'label' => 'Video Text',
						'name' => 'video_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51a62089c14cb',
						'label' => 'City',
						'name' => 'city',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51a6208ec14cc',
						'label' => 'Region',
						'name' => 'region',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51a62094c14cd',
						'label' => 'Country',
						'name' => 'country',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-homepage-test.php',
					'order_no' => '0',
					'group_no' => '0',
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-homepage.php',
					'order_no' => '0',
					'group_no' => '1',
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_organization',
		'title' => 'Organization',
		'fields' => array (
			array (
				'key' => 'field_506d00ef2e8cf',
				'label' => 'Header Content',
				'name' => 'header_content',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-dropdown-list.php',
					'order_no' => '2',
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-continuing-education.php',
					'order_no' => '1',
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-organization.php',
					'order_no' => '0',
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-new-calendar.php',
					'order_no' => '3',
					'group_no' => 3,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-dropdown-list.php',
					'order_no' => '2',
					'group_no' => 4,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-continuing-education.php',
					'order_no' => '1',
					'group_no' => 5,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-organization.php',
					'order_no' => '0',
					'group_no' => 6,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-new-calendar.php',
					'order_no' => '3',
					'group_no' => 7,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-dropdown-list.php',
					'order_no' => '2',
					'group_no' => 8,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-continuing-education.php',
					'order_no' => '1',
					'group_no' => 9,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-organization.php',
					'order_no' => '0',
					'group_no' => 10,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-new-calendar.php',
					'order_no' => '3',
					'group_no' => 11,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-dropdown-list.php',
					'order_no' => '2',
					'group_no' => 12,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-continuing-education.php',
					'order_no' => '1',
					'group_no' => 13,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-organization.php',
					'order_no' => '0',
					'group_no' => 14,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-new-calendar.php',
					'order_no' => '3',
					'group_no' => 15,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_passion-for-profits-fields',
		'title' => 'Passion for Profits Fields',
		'fields' => array (
			array (
				'key' => 'field_5214efcfaf019',
				'label' => 'Video',
				'name' => 'video',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5214efcfae462',
				'label' => 'Event Title',
				'name' => 'event_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5214efcfac522',
				'label' => 'Event List',
				'name' => 'event_list',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_506d2ab21cc48',
						'label' => 'Event',
						'name' => 'event',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_514c95140a99b',
						'label' => 'Your Time',
						'name' => 'your_time',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'html',
					),
					array (
						'key' => 'field_51533cd23698e',
						'label' => 'Location',
						'name' => 'location',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_51533cd236d10',
						'label' => 'Location Link',
						'name' => 'location_link',
						'type' => 'page_link',
						'column_width' => '',
						'post_type' => array (
							0 => 'page',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_5214efcfafbd1',
				'label' => 'Event Link',
				'name' => 'event_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5214efcfb0789',
				'label' => 'Event Link Text',
				'name' => 'event_link_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5214efcfb1342',
				'label' => 'Alternate Button Link',
				'name' => 'alternate_button_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5214efcfb1ef8',
				'label' => 'Alternate Button Link Text',
				'name' => 'alternate_button_link_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5214efcfb2ab2',
				'label' => 'Callouts',
				'name' => 'callouts',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_506d2ab221646',
						'label' => 'Tab Title',
						'name' => 'tab_title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_506d2ab221a2d',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'relationship',
						'column_width' => '',
						'return_format' => 'object',
						'post_type' => array (
							0 => 'modules',
							1 => 'geo-calendar',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'filters' => array (
							0 => 'search',
						),
						'result_elements' => array (
							0 => 'post_type',
							1 => 'post_title',
						),
						'max' => '',
					),
				),
				'row_min' => '',
				'row_limit' => 5,
				'layout' => 'row',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_5214efcfb4236',
				'label' => 'Sub Callout',
				'name' => 'sub_callout',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_523c88a07c5e6',
				'label' => 'Header Callout',
				'name' => 'header_callout',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_523c8c5727346',
				'label' => 'Hide Upcoming Programs',
				'name' => 'no_footer',
				'type' => 'true_false',
				'message' => 'Set this to hide footer',
				'default_value' => 0,
			),
			array (
				'key' => 'field_523c8dc53a7b6',
				'label' => 'Upcoming Programs Custom Image',
				'name' => 'custom_footer_image',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-passion-profit.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-passion-profit-alt.php',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_special-title-callouts',
		'title' => 'Special Title & Callouts',
		'fields' => array (
			array (
				'key' => 'field_5151ee57c9b9e',
				'label' => 'Special Title',
				'name' => 'special_title',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_5214ecc0bd907',
				'label' => 'Callouts',
				'name' => 'callouts',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5214ecd7bd908',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_5214ece4bd909',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'modules',
					'order_no' => '0',
					'group_no' => '0',
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_tuitions',
		'title' => 'Tuitions',
		'fields' => array (
			array (
				'key' => 'field_50747250808c8',
				'label' => 'Tuitions',
				'name' => 'tuitions',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '1',
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '1',
					'group_no' => 3,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 4,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '1',
					'group_no' => 5,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching.php',
					'order_no' => '0',
					'group_no' => 6,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-coaching-online.php',
					'order_no' => '1',
					'group_no' => 7,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_twitter-hashtag',
		'title' => 'Twitter Hashtag',
		'fields' => array (
			array (
				'key' => 'field_51bf849347260',
				'label' => 'Twitter Title',
				'name' => 'twitter_page_title',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b6138f06635',
				'label' => 'Twitter Widget',
				'name' => 'twitter_tag',
				'type' => 'textarea',
				'instructions' => 'Add the widget code here. ',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'rows' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-management-training.php',
					'order_no' => '0',
					'group_no' => '0',
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_twitter-title',
		'title' => 'Twitter Title',
		'fields' => array (
			array (
				'key' => 'field_51ba3dc1328f2',
				'label' => 'Twitter Title',
				'name' => 'twitter_title',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => '0',
					'group_no' => '0',
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
define( 'ACF_LITE' , true );