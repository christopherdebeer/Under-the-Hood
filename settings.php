<?php

// Under the Hood : Semantic skinnable mobile framework
// SETTINGS

// The Title of your mobile web app.

$app_title = "Under the Hood";

// The prefered order of your pages.
// Any outstanding pages will be appended in alphabetical order.
// Any listed pages that dont exist, will be ignored.

$prefered_order_of_pages = array("Home.html","The_Event.html","The_Brief.html","Gallery.html");

// if you would like underthehood to auto generate a gallery page from a flickr account hten set the bellow value to true
// and supply the relevant usid  below that.
// please note: if you want an auto galery, you NEED to specify "Gallery.html" in the $prefered_order_of_pages above,
// this will be doen automagically in a later build but is not yet implemented.

$autogenerate_gallery = false;

// enter the usid (flickr user id) of the user accoutn from whence you'd like to fetch images

$flickr_nsid = '88399767@N00';

?>