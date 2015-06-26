<script>
	jQuery(document).ready(function($){
		

		$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?ids=75335236@N08&lang=en-us&format=json&jsoncallback=?",
        function (data) {
            var count = 0,
                limit = 6,
                row_count = 0;
            $.each(data.items, function (index, item) {
                if (count < limit) {
                    image = $("<img />").attr("src", item.media.m);
                    if (count%3 === 0) {
                        row_count++;
                        if ($("#flickr-gallery .row-"+row_count).length <= 0) {
                            $('<div class="row row-'+row_count+'"></div>').appendTo("#flickr-gallery");
                        }
                    }
                    image.appendTo("#flickr-gallery .row-"+row_count).wrap("<a class='four columns' href='" + item.link + "'></a>");
                }
                count++;
            });
        }
    );
						
	});
</script>
<div class="flickr-gallery" id="flickr-gallery"></div>
