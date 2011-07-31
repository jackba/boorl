<?php

// URL Shortener class
include("shortener.php");
// QR Class
include("qr.php");
// Instantiate Shortener
$shortener = new Shortener();
		
// Extract the key
$key = split("/", $_SERVER['REQUEST_URI']);
$key = $key[sizeof($key) - 1];

try {
	// If there is a key supplied, try to find it in the database,
	// otherwise show the page for shortening URLs
	if (strlen($key) > 0) {
		// Get Long URL for the given key
		$url = $shortener->getLongURL($key);
		// Redirect
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: ' . $url);
		exit();
	} else {
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
	}
} catch (Exception $e) {
	// Catch exceptions if any arise and show a message
	echo "Error! " . $e->getMessage();
	die();		
}

?>