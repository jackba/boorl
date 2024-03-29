<?php

Class Statistics {
	
	private $country = array();
	private $operatingSystem = array();
	private $browser = array();
	private $referer = array();
	private $key;
	
	public function __construct($key) {
		
		$this->key = $key;
		
		$database = Database::getInstance();
		
		$this->country = $database->query("SELECT country, count(*) as count FROM statistics WHERE mapping_short_code = '" . $this->key . "' GROUP BY country ORDER BY count DESC LIMIT 5")->fetchAll();
		$this->operatingSystem = $database->query("SELECT operating_system, count(*) as count FROM statistics WHERE mapping_short_code = '" . $this->key . "' GROUP BY operating_system ORDER BY count DESC LIMIT 5")->fetchAll();
		$this->browser = $database->query("SELECT browser, count(*) as count FROM statistics WHERE mapping_short_code = '" . $this->key . "' GROUP BY browser ORDER BY count DESC LIMIT 5")->fetchAll();
		$this->referer = $database->query("SELECT referer, count(*) as count FROM statistics WHERE mapping_short_code = '" . $this->key . "' GROUP BY referer ORDER BY count DESC LIMIT 5")->fetchAll();
		
		if ($this->country == false || $this->operatingSystem == false || $this->browser == false || $this->referer == false) {
			throw new Exception("Failed to get database data.");
		}
		
	}
	
	public function getCountries() {
		return $this->country;
	}
	
	public function getOperatingSystems() {
		return $this->operatingSystem;
	}
	
	public function getBrowsers() {
		return $this->browser;
	}
		
	public function getReferers() {
		return $this->referer;
	}
	
	public function getKey() {
		return $this->key;
	}
}

?>