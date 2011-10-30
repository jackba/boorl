<?php

	// Configurations
	include('include/config/config.php');
	// URL Shortener Class
	include("include/shortener/shortener.php");
	// Database Singleton
	include("include/config/database.php");
	
	$key = $_GET['key'];
	// Instantiate Shortener
	$shortener = new Shortener();
	// Get Long URL for the given key
	$url = $shortener->getLongURL($key);
	echo $url;
?>