<?php

// Class for getting OS and Browser
include('osbrowser.php');
// Class for getting country based on IP
include('../GeoIP/geoip.inc');

/**
 * Class for getting user information
 *
 * @author Andrija Vucinic
 * @version 1.0
 */
class Info {

	private $ip;	
	private $operatingSystem;
	private $browser;
	private $country;
	private $referer;
	
	/**
	 * Set all attributes on construction
	 */
	public function __construct() {
		$this->parseIP();
		$this->parseBrowserAndOperatingSystem();
		$this->parseCountry();
		$this->parseReferer();
	}


	/**
	 * Function sets the IP attribute
	 */
	private function parseIP() {
		$this->ip = $_SERVER['REMOTE_ADDR'];
	}
	
	/**
	 * Function sets the browser and operating system attribute
	 */
	private function parseBrowserAndOperatingSystem() {
		$osb = new OSBrowser();
		$data = $osb->getData();
		$this->browser = $data['browser'];
		$this->operatingSystem = $data['os'];	
	}
	
	/**
	 * Function sets the country attribute based on users IP
	 */
	private function parseCountry() {
		$gi = geoip_open("include/GeoIP/GeoIP.dat", GEOIP_STANDARD);
     	$this->country = geoip_country_name_by_addr($gi, $this->ip);
     	geoip_close($gi);
	}
	
	/**
	 * Function sets the referer attribute
	 */
	private function parseReferer() {
		$this->referer = $_SERVER['HTTP_REFERER'];
	}

	/**
	 * IP getter method
	 */
	public function getIp() {
		return $this->ip;
	}
	
	/**
	 * Operating system getter method
	 */
	public function getOperatingSystem() {
		return $this->operatingSystem;
	}
	
	/**
	 * Browser getter method
	 */
	public function getBrowser() {
		return $this->browser;
	}
	
	/**
	 * Country getter method
	 */
	public function getCountry() {
		return $this->country;
	}
	
	/**
	 * Referer getter method
	 */
	public function getReferer() {
		return $this->referer;
	}

}

?>