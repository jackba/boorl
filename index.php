<?php

// Configurations
include_once('include/config/config.php');
if (INSTALL != 1) {
        include_once('include/config/install.php');
        exit();
}

// Database Singleton
include_once("include/config/database.php");
// URL Shortener Class
include_once("include/shortener/shortener.php");
// Instantiate Shortener
$shortener = new Shortener();

try {
	include('include/view/header.php'); 	
	
	$url = $_POST['url'];
	// Check if form was submitted and add the URL to the database if it doesn't exist,
	// otherwise return the shortcode of the long_url
	
	$submitted = isset($url) && strlen($url) > 0;
	
	if ($submitted) {
		// Get domain
		$domain = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		// Create new short code or get old if it already exists
		$short = $shortener->insertNewURL($url);
		$shortCodeURL = $domain . $short;
	}
	
	include('include/view/form.php');

} catch (Exception $e) {
	// Catch exceptions if any arise and show a message
	echo '<div class="center info error">';
		echo "Error! " . $e->getMessage();
	echo '</div>';
	$submitted = false;
	include('include/view/form.php');
}

	include('include/view/footer.php');

?>