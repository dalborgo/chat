<?php
	/*
		Avatar Chat 1.0.0
		Configuration
	*/
	
	include("core/rc/config.inc.php");
	include("core/ac.functions.php");
	include("core/ac.sessions.php");
	
	if (!isset($installed) || isset($installed) && $installed != true)
	{
		header('location: ./install/');
	}
	
	if (file_exists("install/index.php") && $installed == true)
	{
		die("Please delete the install folder.");
	}
	
	if (!isset($_SESSION["myID"]) || $_SESSION["myID"] == 0)
	{
		$_SESSION["myID"] = rand(1,4000);
	}
	
	$_SESSION["lastPoll"] = $config["micro"];
	$_SESSION["chatPoll"] = $config["micro"];
	$_SESSION["token"] = md5(rand(1, 4000));
	
	/*
		Template
	*/
	
	include("static/html/index.html.php");
?>