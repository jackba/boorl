<?php

	/**
	 * Class for parsing HTTP_USER_AGENT to get the Operating System and Browser name
	 * 
	 * @author Andrija Vucinic
	 * @version 1.0
	 */
	Class OSBrowser {
		// Default return value, if browser or OS not found
		private $default = 'Other';
		// HTTP_USER_AGENT from PHP
		private $HTTP_USER_AGENT;
		// List of Operating Systems we want to detect, else return 'Other'
		private $os = array(
							// Mobile OS
							array('search' => 'android', 'return' => 'Android'),
							array('search' => 'blackberry', 'return' => 'BlackBerry'),
							array('search' => 'ipad', 'return' => 'iPad'),
							array('search' => 'iphone', 'return' => 'iPhone'),
							array('search' => 'palm', 'return' => 'PalmOS'),
							array('search' => 'symbian', 'return' => 'Symbian'),
							// Desktop OS
							array('search' => 'linux', 'return' => 'Linux'),
							array('search' => 'macintosh', 'return' => 'Mac OS'),
							array('search' => 'mac', 'return' => 'Mac OS'),
							array('search' => 'unix', 'return' => 'Unix'),
							array('search' => 'windows', 'return' => 'Windows'),
							array('search' => 'win', 'return' => 'Windows')
							);
		private $browser = array(
							array('search' => 'chrome', 'return' => 'Chrome'),
							array('search' => 'firefox', 'return' => 'Firefox'),
							array('search' => 'msie', 'return' => 'Internet Explorer'),
							array('search' => 'mobile', 'return' => 'Mobile'),
							array('search' => 'opera', 'return' => 'Opera'),
							array('search' => 'Safari', 'return' => 'Safari')
							);
							
		public function __construct() {
			// Set the HTTP_USER_AGENT
			$this->HTTP_USER_AGENT = (isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '');
		}
		
		/**
		 * Function returns an associative array with ['os'] and ['browser']
		 * 
		 * @return array()
		 */
		public function getData() {
			// return data
			$data = array();
			// Get OS
			$data['os'] = $this->getOS();
			// Get Browser
			$data['browser'] = $this->getBrowser();
			return $data;
		}
		
		/**
		 * Function returns the Operating system name
		 * 
		 * @return String, returns the name of the OS or $default if not found
		 */
		private function getOS() {
			
			for ($i = 0; $i < sizeof($this->os); $i++) {
				if (strpos($this->HTTP_USER_AGENT, $this->os[$i]['search'])) {
					return $this->os[$i]['return'];
				}
			}
			return $this->default;
						
		}
		
		/**
		 * Function returns the Browser name
		 * 
		 * @return String, returns the name of the browser or $default if not found
		 */
		private function getBrowser() {
			for ($i = 0; $i < sizeof($this->browser); $i++) {
				if (strpos($this->HTTP_USER_AGENT, $this->browser[$i]['search'])) {
					return $this->browser[$i]['return'];
				}
			}
			return $this->default;
		}
	}
	
?>