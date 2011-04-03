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

    
    // if "DELETE_ME_TO_RESET" doesnt exist:
    
    if (!file_exists("DELETE_ME_TO_RESET")) {
	
	// initiate UnderTheHood
	
	
	// if /app/header.html exists
	if (file_exists("app/header.html")) {
	    
	    // get header.html + $framework head
	    $header = file_get_contents("app/header.html");
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
	
	$path = 'app/pages/';
	$dh = opendir($path);
	$home_list = "<ol id='main-nav'>"."\n";
	$sections = array();
	if($dh){
	    while(($page = readdir($dh)) !== false) {
		if ($page != "." && $page != ".." && $page != "README") {  
		    $title = str_replace(".html","",$page);
		    $sections[] = $title;
		    $title = str_replace("_"," ",$title);
		    $home_list .= "<li><a href='$page'>$title</a></li>"."\n";
		}
	    }
	}
	$home_list .= "</ol>"."\n";
	
	
	// for each file in /app/pages/ do:
	foreach ($sections as $item) {
	    
	    // create a page.html using contents of $page + /app/header.html + $main-nav
	    $content = file_get_contents("app/pages/$item.html");
	    $header .= "<title>$app_title</title>";
	
	    $html = "<!DOCTYPE html>\n<html>\n<head>"."\n";
	    $html .= $header;
	    $html .= "</head>\n<body>\n<div id='wrapper'>"."\n";
	    $html .= "<h1>$app_title</h1><div id='content'>" . file_get_contents("app/pages/$item.html") . "</div>"."\n";
	    $html .= $home_list;
	    $html .= $footer;
	    $html .= "</div>\n</body>"."\n";
	    
	    $homefile =fopen("$item.html", 'w');
	    fwrite($homefile, $html);
	    fclose($homefile);
	    
	    
	}
	
	$homefile =fopen("DELETE_ME_TO_RESET", 'w');
	fwrite($homefile, $homecontents);
	fclose($homefile);
	
	    
    }
    
    include($pages[0]);
    
    
   

?>


