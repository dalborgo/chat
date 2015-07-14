<?php
	/**
	 * Virtual Chat 1.0.0 release
	 * Software by DesignSkate
	 */
	 
	if (!isset($_SESSION["admin_session"]))
	{
		header('location: login.php');
		exit();
	}

	unset($_SESSION["admin_session"]);
	
	header('location: login.php');
?>