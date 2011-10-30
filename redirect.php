<?php

	// Configurations
	include('include/config/config.php');
	// URL Shortener Class
	include("include/shortener/shortener.php");
	// Database Singleton
	include("include/config/database.php");
	// Log Class
	include("include/log/log.php");
	
	$key = $_GET['key'];
	// Instantiate Shortener
	$shortener = new Shortener();
	// Get Long URL for the given key
	$url = $shortener->getLongURL($key);
	// Redirect
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: ' . $url);
	$log = new Log();
	$log->log($key);
	exit();
	
?>