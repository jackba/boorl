<?php
	// Configurations
	include_once('include/config/config.php');
	// Database Singleton
	include_once('include/config/database.php');
	// Model for holding statistics
	include_once('include/model/Statistics.php');
	
	include('include/view/header.php');
	
	$key = $_GET['key'];
	$statistics = new Statistics($key);
	
	include('include/view/stats.php');
	
	include('include/view/footer.php');
?>