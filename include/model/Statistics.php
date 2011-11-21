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
		
		$this->country = $database->query("SELECT country, count(*) FROM statistics WHERE mapping_short_code = '" . $this->key . "' GROUP BY country")->fetchAll();
		$this->operatingSystem = $database->query("SELECT operating_system, count(*) FROM statistics WHERE mapping_short_code = '" . $this->key . "' GROUP BY operating_system")->fetchAll();
		$this->browser = $database->query("SELECT browser, count(*) FROM statistics WHERE mapping_short_code = '" . $this->key . "' GROUP BY browser")->fetchAll();
		$this->referer = $database->query("SELECT referer, count(*) FROM statistics WHERE mapping_short_code = '" . $this->key . "' GROUP BY referer")->fetchAll();
		
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