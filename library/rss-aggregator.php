<!-- Custom RSS Aggregator -->
<?php
	define("RSS_DEBUG", false);

	// HTML parsing library
	// We use this for finding & extracting img tags
	include( get_template_directory() . '/library/simple_html_dom.php');

	// Grab general parameters
	$rss_heading = get_field('aggregator_heading');
	$chars_per_excerpt = get_field('characters_per_excerpt');
	if (false == $chars_per_excerpt) {
		if (RSS_DEBUG) echo "<!-- no excerpt size -->";
		$chars_per_excerpt = 200;
	}
	
	$max_items = get_field('max_items_total');
	$max_items_per_feed = get_field('max_items_per_feed');
	if ( get_field('open_links_in_new_tab') ) {
		$target = ' target="_blank"';
	} else {
		$target = '';
	}
	if (RSS_DEBUG) echo "<!-- link target: {$target} -->";

	// default image is required field
	$image_atts = wp_get_attachment_image_src(get_field('default_image'), 'medium');
	$default_image_url = $image_atts[0];

	// Get the list of feeds
	$rows = get_field('feed');

	// Building then outputting the output rather than just outputting as we go along makes it easier to convert this to a shortcode
	$out = "<div id='rss-block'>";
	$out .= "<h2 id='rss-heading'>$rss_heading</h2>";

	if($rows) {
		
		$feeds_array = array();
		$feed_url_array = array();
		
		// Parse each line for the custom fields
		foreach( $rows as $row ) {
			$f = fetch_feed($row['rss_url']);
			
			if ( !is_wp_error( $f ) ) {
//				$dump = var_export($f, true);
//				if (RSS_DEBUG) echo "<!-- Feed: $dump -->";

				// Store the options for each feed source, plus the title (which we need to ref later on)
				$feeds_array[] = array( 'url' => $row['rss_url'],
										'default_image' => $row['default_image'],
										'always_use_default_image' => $row['always_use_default_image'],
										'title' => $f->get_title()
										);
										
				// Build an array of just the feed URLs to pass to SimplePie
				$feed_url_array[] = $row['rss_url'];
			}
		}

		// Build our actual RSS feed
		// This is where SimplePie does magic for us
		$feeds = fetch_feed($feed_url_array);
		$feeds->set_item_limit($max_items_per_feed);
		$limit = $feeds->get_item_quantity($max_items); // specify number of items
		$items = $feeds->get_items(0, $limit); // create an array of items


		// No items in the combined feed ?
		if ( 0 == $limit ) {
			$out .= '<div>The feed is either empty or unavailable.</div>';
		}
		else {
			// Process each item in our combined feed
			foreach ($items as $item) {
				
				if (RSS_DEBUG) echo "<!-- Start of item pass -->";

				if ( null == $item->get_description() ) {
					echo "<!-- No description in ". $item->get_feed()->get_title() ." -->";
					continue;
				}

				$feed_title = $item->get_feed()->get_title();
				
				// We need to identify which feed this item has come from so as to apply
				// appropriate options.
				// Loop through our list til we find a title match
				// Wish I could think of a better way of doing this
				$found_match = false;
				foreach ($feeds_array as $feed_array) {
					if (0 == strcmp($feed_array['title'], $feed_title)) {
						$found_match = true;
						break;
					}
				}

				if ( $found_match ) {
					$out .= "<div class='rss-feed row'>";
					
					$got_img = false;
					$html_description = null;
					$html_content = null;
					$html_img = null;
					$img_src = null;
					
					// If 'don't always take the default image', then try to extract an image from the feed content
					if ( !$feed_array['always_use_default_image'] ) {

						$html_description = str_get_html($item->get_description());
						if (RSS_DEBUG) echo "<!-- item desc: ".$item->get_description()." -->";
						if (RSS_DEBUG) echo "<!-- html desc: $html_description -->";

						if ( null != $html_description) $html_img = $html_description->find('img', 0);
						if ( null != $html_img ) $img_src = $html_img->src;
						if (RSS_DEBUG) echo "<!-- html src: {$img_src} -->";
						if ( null == $img_src ) {
							// couldn't find an image in the description, so try the content instead
							if (RSS_DEBUG) echo "<!-- Trying get_content -->";
							$html_content = str_get_html($item->get_content());
							if (RSS_DEBUG) echo "<!-- html content: $html_content -->";
							if ( null != $html_content) $html_img = $html_content->find('img', 0);
							if ( null != $html_img ) $img_src = $html_img->src;
							if (RSS_DEBUG) echo "<!-- img src: {$img_src} -->";
						}

						// Did we find an image link?
						if (null != $img_src) {
							$size = getimagesize($img_src);
							$dump = var_export($size, true);
							if (RSS_DEBUG) echo "<!-- got size $dump -->";
							// size elements: 0: width, 1:height
							// If image isn't tiny icon, we'll use it
							if ( 25 < $size[1] ) {
								$got_img = true;
							}
						}
					}
					
					// No image yet - either because we couldn't find one or because 
					// settings say to not look for one in the feed content
					if ( !$got_img ) {

						// If we have a default image for this feed then use it,
						if ( null != $feed_array['default_image'] ) {
							if (RSS_DEBUG) echo "<!-- Trying feed default image -->";

							$image_atts = wp_get_attachment_image_src($feed_array['default_image'], 'medium');
							if ( $image_atts ) {
								$img_src = $image_atts[0];
								$got_img = true;
							}
						}

						// ...otherwise fallback to the overall default image
						if ( !$got_img ) {
							if (RSS_DEBUG) echo "<!-- Using fallback default image -->";
							$img_src = $default_image_url;
							$got_img = true;
						}
					}


					if (RSS_DEBUG) echo "<!-- final img_url: $img_src -->";
					if ( $got_img ) {
						$out .= "<span class='feed-image three columns'><a href='{$item->get_permalink()}'$target><img src='" . esc_url($img_src) . "' /></a></span>";
					}

					$out .= "<span class='feed-text nine columns end'>";
					$out .= "<span class='feed-title'><a href='{$item->get_permalink()}'$target>{$item->get_title()}</a></span>";

					// Get excerpt - trim if necessary
					$desc = strip_tags($item->get_description());
					$excerpt = substr($desc,0,$chars_per_excerpt);
					if ( strlen($desc) > $chars_per_excerpt ) {
						$excerpt = substr($excerpt, 0, $chars_per_excerpt-3) . "...";
					}

					$out .= "<span class='feed-content'>$excerpt</span>";
					if (RSS_DEBUG) echo "<!-- excerpt: $excerpt -->";
					
					// Attribution line

					$author = $item->get_author();
					if ( null != $author ) {
						$out .= "<span class='feed-author'>{$author->get_name()}</span> / ";
					}
					$out .= "<span class='feed-date'>{$item->get_date()}</span> / <span class='feed-source'>{$feed_title}</span></span></div>";
				} // end 'if found match'
			} // end 'for each feed item'
		} // end 'if we've got some feed items returned'
	} // end 'if rows'

	$out .= "</div>";
	
	echo $out;
?>
<!-- End Custom RSS Aggregator -->
