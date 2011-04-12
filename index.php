<?php

// Under the Hood semantic skinable mobile site framework
// Christopher de beer 2011
// v1

//	--------------------------------------------------------------------------------
//	|										|
//	|	To RESET: delete "DELETE_ME_TO_RESET" file in the Root directory 	|
//	|										|
//	--------------------------------------------------------------------------------



include("settings.php");
    
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

    $order = array();

    $path = 'app/pages/';
    $dh = opendir($path);
    $pages = array();
    if($dh){
	while(($page = readdir($dh)) !== false) {
	    if ($page != "." && $page != ".." && $page != "README") {
		$pages[] = $page;
	    }
	}
    }
    
    // for each item in $prefered_order_of_pages if it is in $pages then append to $order
    
    foreach ($prefered_order_of_pages as $item) {
	if ( in_array($item, $pages) || $item == "Gallery.html") { $order[] = $item; }
    }
     
    // for each item in $pages that isnt in $order append to order
     
    foreach ($pages as $item) {
	if ( !in_array($item, $order)) { $order[] = $item; }
    }

    
    $firstpage = $order[0];
    
    // if "DELETE_ME_TO_RESET" doesnt exist:
    
    if (!file_exists("DELETE_ME_TO_RESET")) {
	
	// initiate UnderTheHood
	
	
	// if /app/header.html exists
	if (file_exists("app/head.html")) {
	    
	    // get header.html + $framework head
	    $header = file_get_contents("app/head.html");
	    $header .= file_get_contents("core/head.php");
	
	} else {
	// else
	    
	    //create a blank /app/header.html
	    
	    // get $framework head
	    $header = file_get_contents("core/head.php");
	
	}
	
	// get footer from /app/footer.html
	if (file_exists("app/footer.html")) {
	    
	    $footer = file_get_contents("app/footer.html");
	
	}
	
	// create a #main-nav template
	
	
	$sections = array();
	foreach ($order as $page) {
	    if ($page != "." && $page != ".." && $page != "README") {  
		$title = str_replace(".html","",$page);
		$sections[] = $title;
		$title = str_replace("_"," ",$title);		
	    }
	}

	
	
	
	// for each file in /app/pages/ do:
	foreach ($sections as $item) {
		
		
	    // create a #main-nav template
	
		$home_list = "<ol id='main-nav'>"."\n";
		foreach ($order as $page) {
		    if ($page != "." && $page != ".." && $page != "README") {  
			$title = str_replace(".html","",$page);
			$title = str_replace("_"," ",$title);
			$item_new = str_replace("_"," ",$item);
			if ($title == $item_new) {
				$home_list .= "<li><a class='current $item_new' href='$page'>$title</a></li>"."\n";
			} else {
				$home_list .= "<li><a class='$item_new' href='$page'>$title</a></li>"."\n";
			}
			
		    }
		}
		$home_list .= "</ol>"."\n";
	    
	    // create a page.html using contents of $page + /app/header.html + $main-nav
	    
	    
	    if ($autogenerate_gallery && $item == "Gallery") {
		$content = get_gallery_content($flickr_nsid);
	    } else {
		$content = file_get_contents("app/pages/$item.html");
	    }
	    $header .= "<title>$app_title</title>";
	
	    $html = "<!DOCTYPE html>\n<html>\n<head>"."\n";
	    $html .= $header;
	    $html .= "</head>\n<body class='$item'>\n<div id='wrapper'>"."\n";
	    $html .= "<h1><a href='$firstpage'>$app_title</a></h1><div id='content'>" . $content . "</div>"."\n";
	    $html .= $home_list;
	    $html .= "<div id='footer'>" . $footer . "</div>";
	    $html .= "</div>\n</body>"."\n";
	    
	    $homefile =fopen("$item.html", 'w');
	    fwrite($homefile, $html);
	    fclose($homefile);
	    
	    
	}
	
	$homefile =fopen("DELETE_ME_TO_RESET", 'w');
	fwrite($homefile, $homecontents);
	fclose($homefile);
	
	    
    }
    
    include($firstpage);
    
    
   

?>


