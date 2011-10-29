<?php

// Info class containing user information
include('include/log/info.php');

/**
 * Class for logging shortlink statistics
 *
 * @author Andrija Vucinic
 * @version 1.0
 */
class Log {

	// Database holder
	private $database;
	
	// Connect to database on construction
	public function __construct() {
		$this->database = Database::getInstance();
	}
	
	/**
	 * Log user info for a visited short URL
	 */
	public function log($shortCode) {
		$this->database->beginTransaction();
		
		$info = new Info();
		
		// Insert new statistics rows
		$result = $this->database->exec("INSERT INTO statistics (mapping_short_code, click_time, ip, operating_system, browser, country, referer)" .
				" VALUES (" .
				"'$shortCode', " . 
				"NOW(), " .
				"'" . $info->getIp() . "', " . 
				"'" . $info->getOperatingSystem() . "', " . 
				"'" . $info->getBrowser() . "', " . 
				"'" . $info->getCountry() . "', " . 
				"'" . $info->getReferer() . "')");
			
		if ($result) {
			$this->database->commit();
		} else {
			$this->database->rollBack();
		}
	}

}

?>