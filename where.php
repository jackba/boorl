<?php

	// Configurations
	include_once('include/config/config.php');
	// URL Shortener Class
	include_once('include/shortener/shortener.php');
	// Database Singleton
	include_once('include/config/database.php');
	
	include('include/view/header.php');
	
	try {
		$key = $_GET['key'];
		// Instantiate Shortener
		$shortener = new Shortener();
		// Get Long URL for the given key
		$url = $shortener->getLongURL($key);
		$short = "<a class=\"highlight\" href=\"$key\">$url</a>";
	} catch (Exception $e) {
		$short = "<span class=\"highlight\">Nowhere...</span>";
	}
	
	include('include/view/where.php');
	
	include('include/view/footer.php');
?>