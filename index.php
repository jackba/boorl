<?php

// Configurations
include('include/config/config.php');
if (INSTALL != 1) {
        include('include/config/install.php');
        exit();
}

// Database Singleton
include("include/config/database.php");
// URL Shortener Class
include("include/shortener/shortener.php");
// QR Class
include("include/shortener/qr.php");
// Instantiate Shortener
$shortener = new Shortener();

try {
	// Show a simple form with URL field and a button
		
	?>
		<html>
		<head>
			<title>URL Shortener</title>
		</head>
		<body>
			<form name="input" action="" method="post">
				URL: <input type="text" name="url" /> <input type="submit" value="Shorten" />
			</form>
	<? 	

	$url = $_POST['url'];
	// Check if form was submitted and add the URL to the database if it doesn't exist,
	// otherwise return the shortcode of the long_url
	if (isset($url) && strlen($url) > 0) {
		// Get domain
		$domain = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		// Create new short code or get old if it already exists
		$shortCodeURL = $domain . $shortener->insertNewURL($url);
		// Show the shortcode
		echo $shortCodeURL . '<br />';
		// Get QR Image for the generated code
		$qr = QR::getQRforURL($shortCodeURL, 200);
		// Show image
		echo '<img src="' . $qr . '" alt="QR" />';
	}
	
	echo '</body>';
	echo '</html>';
} catch (Exception $e) {
	// Catch exceptions if any arise and show a message
	echo "Error! " . $e->getMessage();
	die();		
}

?>