<?php

// function that could do with alot of work, for auto populating the gallery page
// of the user ahs set $autogenerate_gallery to true in the setting.php

// need to update so only the images are pulled but the content is still in a gallery.html template withing app/pages

function get_gallery_content($userID) {
	$apiKey = '151c62d54822cf6b69cce277627ed051';
	//$userID = '88399767@N00';
	$secret = "b4717e27734f2c1c";
	$url = 'http://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key='
	    .$apiKey.'&user_id='.$userID.'&format=json';
	$options = Array('http' => Array('method' => 'GET'));
	$context = stream_context_create($options);
	$response = file_get_contents($url, false, $context);
	$response = str_replace("jsonFlickrApi(","", $response);
	$response = substr_replace($response,"",-1);
	$object = json_decode($response);
	$content = "<h2>Gallery</h2>";
	$content .= "<h4>Photos from the event</h4>";
	$content .= "<p>Lorem ipsum dolor sit amet, consecteture adippiscing elit <a href='http://www.flickr.com'>Flickr</a> liquam ac orici ac est posuere.</p>";
	foreach ($object->photos->photo as $photo) {
	    //print_r($photo);
	    $sv = $photo->server;
	    $f = $photo->farm;
	    $i = $photo->id;
	    $s = $photo->secret;
	    $content .= "<a href='http://farm$f.static.flickr.com/$sv/$i"."_$s"."_z.jpg'><img src='http://farm$f.static.flickr.com/$sv/$i"."_$s"."_s.jpg' alt='' /></a>"."\n";
	}
	$content .= "<h3>Watch videos from Under the hood</h3>";
	$content .= "<p>Lorem ipsum dolor sit amet, consecteture adippiscing elit <a href='http://www.vimeo.com'>Vimeo</a> liquam ac orici ac est posuere.</p>";
	$content .= "<iframe src='http://player.vimeo.com/video/20250134' width='300' height='170' frameborder='0'></iframe><p><a href='http://vimeo.com/20250134'>MIT Media Lab Identity, 2011</a> from <a href='http://vimeo.com/readyletsgo'>readyletsgo</a> on <a href='http://vimeo.com'>Vimeo</a>.</p>";
	
	return $content;
    }
    
?>