<?php

// Class for getting OS and Browser
include('osbrowser.php');
// Class for getting country based on IP
include('include/GeoIP/geoip.inc');

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

	// Country and referer default
	private $default = "Unknown";
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
     	if (strlen($this->country) == 0) {
     		$this->referer = $this->default;
     	}
     	geoip_close($gi);
	}
	
	/**
	 * Function parses the referer attribute, and extracts the domain
	 */
	private function parseReferer() {
		$this->referer = $_SERVER['HTTP_REFERER'];
		if (strlen($this->referer) > 0) {
			$position = strpos($this->referer, "://") + 3;
			if ($position == false) {
				$position = 0;
			}
			$this->referer = substr($this->referer, 0, strpos($this->referer, "/", $position));
		} else {
			$this->referer = $this->default;
		}
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