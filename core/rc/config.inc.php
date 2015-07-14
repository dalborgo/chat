<?php
	/*
		Avatar Chat 1.0.0
		Configuration
	*/
	
	error_reporting(0);
	
	# Access permissions
	define('access', true);
	
	# Start Sessions
	session_start();
	
	$config = array(
		"keys" => array(),
		"time" => time(),
		"micro" => round(microtime(true) * 1000),
		"ver_num" => "1.0.0"
	);
	
	$time = time();
	
	# Connect to the MySQL database
	require_once("database.inc.php");
	
	if (!isset($DB_HOST))
	{
		header('location: ./install/');
		exit();	
	} 
	
	$db = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
	# Connection Check / Installation Check
	if (mysqli_connect_errno() || !isset($installed)) 
	{
		if (!isset($installed))
		{
			header('location: ./install/');
			exit();
		}
		else
		{
			die("MySQL connection error");
		}
	}
	
	# Website Timezone Configuration
	date_default_timezone_set('Europe/London');
	
	# Settings Table
	$settings_query = $db->query("SELECT * FROM `site_settings`");
	$settings = $settings_query->fetch_array();
?>
	