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
// QR Class
include_once("include/shortener/qr.php");
// Instantiate Shortener
$shortener = new Shortener();

try {
	include('include/view/header.php'); 	

	include('include/view/form.php');
	
	$url = $_POST['url'];
	// Check if form was submitted and add the URL to the database if it doesn't exist,
	// otherwise return the shortcode of the long_url
	if (isset($url) && strlen($url) > 0) {
		// Get domain
		$domain = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		// Create new short code or get old if it already exists
		$shortCodeURL = $domain . $shortener->insertNewURL($url);
		
		include('include/view/select.php');
		/*
		// Show the shortcode
		echo $shortCodeURL . '<br />';
		// Get QR Image for the generated code
		$qr = QR::getQRforURL($shortCodeURL, 200);
		// Show image
		echo '<img src="' . $qr . '" alt="QR" />';
		*/
	}

} catch (Exception $e) {
	// Catch exceptions if any arise and show a message
	echo "Error! " . $e->getMessage();
}

	include('include/view/footer.php');

?>