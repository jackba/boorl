<?php

// Number converter
include_once('converter.php');

/**
 * URL Shortener class
 *
 * @author Andrija Vucinic
 * @version 1.1
 */
class Shortener {

	// Database holder
	private $database;
	// Short Code Regular Expression
	private $keyRegex = "/[^A-Za-z0-9\+\=]/";
	// URL Regular Expression
	private $urlRegex = '/^((https?|ftp):\/\/)?[A-Za-z0-9_\-]+(\.[A-Za-z0-9_\-]+)+(\/|(\/[A-Za-z0-9_\-\?\+\=\&\.\#\/\:\%]+)+)?\/?$/';

	// Connect to database on construction
	public function __construct() {
		$this->database = Database::getInstance();
	}

	/**
	 * Get long URL for given key
	 * 
	 * @param key - the long URL short code
	 * @return Long URL
	 */
	public function getLongURL($key) {
		// Validate the key to contain only characters used in the mapping
		if (preg_match($this->keyRegex, $key)) {
			throw new Exception("Key contains characters that are not allowed!");
		}

		// Search for the key in the database
		$result = $this->database->query("SELECT long_url FROM mapping WHERE BINARY short_code = '" . $key . "'")->fetchAll();

		if (sizeof($result) == 1) {
			$url = $result[0]['long_url'];
		} else {
			throw new Exception("Key invalid!");
		}

		return $url;
	}

	/**
	 * Shortens an URL if it doesn't exist, otherwise returns short code
	 * 
	 * @param url - URL to be shortened
	 * @return Short Code for given URL
	 */
	public function insertNewURL($url) {
		// Check if form was submitted and add the URL to the database if it doesn't exist,
		// otherwise return the shortcode of the long_url

		// Validate entered URL
		if (!preg_match($this->urlRegex, $url)) {
			throw new Exception('You have entered an invalid URL.');
		}

		/*
		 * This is a potential pitfall, since it can be misused
		 * for attacking a HTTP server (Denial-of-Service)
		 */
		// Check if the URL exists using cURL
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		curl_close($ch);
		if ($code == 0) {
			throw new Exception('URL doesn\'t exist.');
		}
		
		$url = addslashes($url);
		$this->database->beginTransaction();
		// Search for the url in the database
		$result = $this->database->query("SELECT short_code FROM mapping WHERE " .
			" BINARY long_url = '" . $url . "'")->fetchAll();

		// If found, return short url
		if (sizeof($result) == 1) {
			$short = $result[0]['short_code'];
		} else {
			// Create a new short_code for the given URL
			$result = $this->database->query("SELECT COALESCE(MAX(id + 1), 1) FROM mapping")->fetchAll();
			if (sizeof($result) == 1) {
				$id = intval($result[0][0]);
			} else {
				$this->database->rollback();
				throw new Exception('Can\'t get id.');
			}

			// Convert the ID to a new base
			$short = NumberConverter::fromDecimalToBase($id, 62);

			// Insert the new URL data into the database
			$result = $this->database->exec("INSERT INTO mapping (id, short_code, long_url, insert_date)" .
					" VALUES ($id, '$short', '$url', NOW())");

			if ($result) {
				$this->database->commit();
			} else {
				$this->database->rollBack();
				throw new Exception('Could not add the URL.');
			}
		}

		return $short;
	}

}

?>